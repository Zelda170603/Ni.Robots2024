<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Expediente;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ExpedientesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ExpedienteController extends Controller
{
    public function show($pacienteId)
    {
        Log::info("=== EXPEDIENTE CONTROLLER SHOW ===");
        Log::info("Paciente ID recibido: " . $pacienteId);
        
        $doctor = Auth::user();
        Log::info("Doctor ID: " . $doctor->id . ", Nombre: " . $doctor->name);

        // Obtener el paciente con su usuario relacionado
        $paciente = Paciente::with(['role.user'])->find($pacienteId);
        
        if (!$paciente) {
            Log::error("PACIENTE NO ENCONTRADO con ID: " . $pacienteId);
            abort(404, 'Paciente no encontrado.');
        }

        Log::info("PACIENTE ENCONTRADO:");
        Log::info(" - Paciente ID: " . $paciente->id);
        Log::info(" - Nombre: " . ($paciente->role->user->name ?? 'N/A'));

        // Obtener historial de expedientes (consultas anteriores)
        $historialExpedientes = Expediente::where('patient_id', $pacienteId)
            ->where('doctor_id', $doctor->id)
            ->with('doctor')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Crear un expediente vacío para el formulario actual
        $expedienteActual = new Expediente([
            'patient_id' => $pacienteId,
            'doctor_id' => $doctor->id
        ]);

        return view('expedientes.show', compact('paciente', 'expedienteActual', 'historialExpedientes'));
    }

    public function store(Request $request)
    {
        Log::info("=== CREANDO NUEVO EXPEDIENTE ===");
        
        $request->validate([
            'patient_id' => 'required|exists:pacientes,id',
            'diagnostico' => 'required|string|max:1000',
            'tratamiento' => 'nullable|string|max:1000',
            'medicamentos' => 'nullable|string|max:1000',
            'notas_adicionales' => 'nullable|string|max:1000',
            'presion_arterial' => 'nullable|string|max:20|regex:/^\d{2,3}\/\d{2,3}$/',
            'temperatura' => 'nullable|numeric|min:30|max:45',
            'frecuencia_cardiaca' => 'nullable|integer|min:30|max:200',
            'frecuencia_respiratoria' => 'nullable|integer|min:8|max:60',
            'peso' => 'nullable|numeric|min:1|max:300',
            'altura' => 'nullable|numeric|min:0.3|max:2.5',
            'tipo_sangre' => 'nullable|string|max:10|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'alergias' => 'nullable|string|max:500',
            'enfermedades_cronicas' => 'nullable|string|max:500',
            'cirugias_previas' => 'nullable|string|max:500',
            'medicamentos_actuales' => 'nullable|string|max:500',
            'historial_familiar' => 'nullable|string|max:500',
        ], [
            'presion_arterial.regex' => 'El formato de presión arterial debe ser como: 120/80',
            'tipo_sangre.in' => 'El tipo de sangre debe ser uno de los siguientes: A+, A-, B+, B-, AB+, AB-, O+, O-',
            'temperatura.min' => 'La temperatura debe ser mayor a 30°C',
            'temperatura.max' => 'La temperatura debe ser menor a 45°C',
            'frecuencia_cardiaca.min' => 'La frecuencia cardíaca debe ser mayor a 30',
            'frecuencia_cardiaca.max' => 'La frecuencia cardíaca debe ser menor a 200',
            'frecuencia_respiratoria.min' => 'La frecuencia respiratoria debe ser mayor a 8',
            'frecuencia_respiratoria.max' => 'La frecuencia respiratoria debe ser menor a 60',
            'peso.min' => 'El peso debe ser mayor a 1kg',
            'peso.max' => 'El peso debe ser menor a 300kg',
            'altura.min' => 'La altura debe ser mayor a 0.3m',
            'altura.max' => 'La altura debe ser menor a 2.5m',
        ]);

        // Siempre crear NUEVO expediente (nueva consulta)
        $expediente = Expediente::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => Auth::id(),
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'medicamentos' => $request->medicamentos,
            'notas_adicionales' => $request->notas_adicionales,
            'presion_arterial' => $request->presion_arterial,
            'temperatura' => $request->temperatura,
            'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
            'frecuencia_respiratoria' => $request->frecuencia_respiratoria,
            'peso' => $request->peso,
            'altura' => $request->altura,
            'tipo_sangre' => $request->tipo_sangre,
            'alergias' => $request->alergias,
            'enfermedades_cronicas' => $request->enfermedades_cronicas,
            'cirugias_previas' => $request->cirugias_previas,
            'medicamentos_actuales' => $request->medicamentos_actuales,
            'historial_familiar' => $request->historial_familiar,
        ]);

        Log::info("NUEVA CONSULTA REGISTRADA - Expediente ID: " . $expediente->id);

        return redirect()->route('expedientes.show', $expediente->patient_id)
            ->with('success', 'Consulta médica registrada correctamente.');
    }

    public function getExpediente($expedienteId)
    {
        $expediente = Expediente::with(['patient.role.user', 'doctor'])
            ->findOrFail($expedienteId);

        return response()->json($expediente);
    }

     /**
     * Exportar expedientes a PDF
     */
    public function exportPDF(Request $request, $pacienteId = null)
    {
        $filters = $request->all();
        $doctor = Auth::user();

        // Construir consulta
        $query = Expediente::with(['patient.role.user', 'doctor']);

        if ($pacienteId) {
            $query->where('patient_id', $pacienteId);
            $paciente = Paciente::with(['role.user'])->find($pacienteId);
        }

        // Aplicar filtros
        if (!empty($filters['fecha_inicio']) && !empty($filters['fecha_fin'])) {
            $query->whereBetween('created_at', [
                $filters['fecha_inicio'] . ' 00:00:00',
                $filters['fecha_fin'] . ' 23:59:59'
            ]);
        }

        if (!empty($filters['diagnostico'])) {
            $query->where('diagnostico', 'like', '%' . $filters['diagnostico'] . '%');
        }

        $expedientes = $query->orderBy('created_at', 'desc')->get();

        $data = [
            'expedientes' => $expedientes,
            'filters' => $filters,
            'paciente' => $paciente ?? null,
            'doctor' => $doctor,
            'total' => $expedientes->count(),
            'fecha_generacion' => now()->format('d/m/Y H:i'),
            'filtros_aplicados' => $this->getFiltrosAplicados($filters, $pacienteId)
        ];

        $pdf = Pdf::loadView('expedientes.reporte-pdf', $data)
                  ->setPaper('a4', 'landscape')
                  ->setOption('defaultFont', 'DejaVu Sans');

        $filename = $pacienteId ? 
            "historial-{$paciente->role->user->name}.pdf" : 
            "reporte-consultas-completo.pdf";

        return $pdf->download($filename);
    }

    /**
     * Método auxiliar para obtener filtros aplicados
     */
    private function getFiltrosAplicados($filters, $pacienteId = null)
    {
        $filtros = [];

        if ($pacienteId) {
            $paciente = Paciente::with(['role.user'])->find($pacienteId);
            if ($paciente) {
                $filtros[] = "Paciente: " . ($paciente->role->user->name ?? 'N/A');
            }
        }

        if (!empty($filters['diagnostico'])) {
            $filtros[] = "Diagnóstico: {$filters['diagnostico']}";
        }

        if (!empty($filters['fecha_inicio']) && !empty($filters['fecha_fin'])) {
            $filtros[] = "Fecha: {$filters['fecha_inicio']} a {$filters['fecha_fin']}";
        } elseif (!empty($filters['fecha_inicio'])) {
            $filtros[] = "Desde: {$filters['fecha_inicio']}";
        } elseif (!empty($filters['fecha_fin'])) {
            $filtros[] = "Hasta: {$filters['fecha_fin']}";
        }

        return $filtros ? implode(' | ', $filtros) : 'Todas las consultas';
    }
}