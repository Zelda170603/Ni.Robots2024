<?php

namespace App\Exports;

use App\Models\Expediente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Carbon\Carbon;

class ExpedientesExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle, WithMapping
{
    protected $filters;
    protected $pacienteId;

    public function __construct(array $filters = [], $pacienteId = null)
    {
        $this->filters = $filters;
        $this->pacienteId = $pacienteId;
    }

    public function collection()
    {
        $query = Expediente::with(['patient.role.user', 'doctor']);

        // Filtrar por paciente específico si se proporciona
        if ($this->pacienteId) {
            $query->where('patient_id', $this->pacienteId);
        }

        // Aplicar filtros de fecha
        if (!empty($this->filters['fecha_inicio']) && !empty($this->filters['fecha_fin'])) {
            $query->whereBetween('created_at', [
                $this->filters['fecha_inicio'] . ' 00:00:00',
                $this->filters['fecha_fin'] . ' 23:59:59'
            ]);
        } elseif (!empty($this->filters['fecha_inicio'])) {
            $query->where('created_at', '>=', $this->filters['fecha_inicio'] . ' 00:00:00');
        } elseif (!empty($this->filters['fecha_fin'])) {
            $query->where('created_at', '<=', $this->filters['fecha_fin'] . ' 23:59:59');
        }

        // Filtrar por diagnóstico
        if (!empty($this->filters['diagnostico'])) {
            $query->where('diagnostico', 'like', '%' . $this->filters['diagnostico'] . '%');
        }

        // Filtrar por doctor
        if (!empty($this->filters['doctor_id'])) {
            $query->where('doctor_id', $this->filters['doctor_id']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function map($expediente): array
    {
        $data = [];

        // Encabezado de la consulta
        $data[] = ['CONSULTA MÉDICA #' . $expediente->id];
        $data[] = ['Fecha:', $expediente->created_at ? Carbon::parse($expediente->created_at)->format('d/m/Y H:i') : 'N/A'];
        $data[] = ['Paciente:', $expediente->patient->role->user->name ?? 'N/A'];
        $data[] = ['Doctor:', $expediente->doctor->name ?? 'N/A'];
        $data[] = []; // Línea vacía

        // Sección 1: Diagnóstico y Tratamiento
        $data[] = ['DIAGNÓSTICO Y TRATAMIENTO'];
        $data[] = ['Diagnóstico Principal:', $expediente->diagnostico ?: 'No especificado'];
        $data[] = ['Plan de Tratamiento:', $expediente->tratamiento ?: 'No especificado'];
        $data[] = ['Medicamentos Recetados:', $expediente->medicamentos ?: 'No especificados'];
        $data[] = []; // Línea vacía

        // Sección 2: Signos Vitales
        $data[] = ['SIGNOS VITALES'];
        $data[] = ['Presión Arterial:', $expediente->presion_arterial ?: 'No registrada'];
        $data[] = ['Temperatura:', $expediente->temperatura ? $expediente->temperatura . '°C' : 'No registrada'];
        $data[] = ['Frecuencia Cardíaca:', $expediente->frecuencia_cardiaca ? $expediente->frecuencia_cardiaca . ' lpm' : 'No registrada'];
        $data[] = ['Frecuencia Respiratoria:', $expediente->frecuencia_respiratoria ? $expediente->frecuencia_respiratoria . ' rpm' : 'No registrada'];
        $data[] = ['Peso:', $expediente->peso ? $expediente->peso . ' kg' : 'No registrado'];
        $data[] = ['Altura:', $expediente->altura ? $expediente->altura . ' m' : 'No registrada'];
        $data[] = []; // Línea vacía

        // Sección 3: Información Médica General
        $data[] = ['INFORMACIÓN MÉDICA GENERAL'];
        $data[] = ['Tipo de Sangre:', $expediente->tipo_sangre ?: 'No especificado'];
        $data[] = ['Alergias Conocidas:', $expediente->alergias ?: 'No registradas'];
        $data[] = ['Enfermedades Crónicas:', $expediente->enfermedades_cronicas ?: 'No registradas'];
        $data[] = ['Cirugías Previas:', $expediente->cirugias_previas ?: 'No registradas'];
        $data[] = ['Medicamentos Actuales:', $expediente->medicamentos_actuales ?: 'No especificados'];
        $data[] = ['Historial Familiar:', $expediente->historial_familiar ?: 'No registrado'];
        $data[] = []; // Línea vacía

        // Sección 4: Notas Adicionales
        $data[] = ['NOTAS Y OBSERVACIONES ADICIONALES'];
        $data[] = ['Observaciones:', $expediente->notas_adicionales ?: 'No hay observaciones adicionales'];
        
        // Separador entre consultas
        $data[] = [];
        $data[] = ['════════════════════════════════════════════════════════════════════════════════'];
        $data[] = [];

        return $data;
    }

    public function headings(): array
    {
        return [
            ['REPORTE DETALLADO DE CONSULTAS MÉDICAS'],
            ['Sistema de Gestión Médica - Expedientes Clínicos'],
            ['Filtros aplicados: ' . $this->getFiltrosAplicados()],
            ['Fecha de generación: ' . Carbon::now()->format('d/m/Y H:i')],
            [],
        ];
    }

    public function title(): string
    {
        return 'Reporte Consultas Detallado';
    }

    public function styles(Worksheet $sheet)
    {
        $dataCollection = $this->collection();
        $totalConsultas = $dataCollection->count();
        
        // Calcular filas totales (cada consulta ocupa aproximadamente 25 filas + encabezados)
        $totalRows = ($totalConsultas * 25) + 5;

        // Fuente general
        $sheet->getStyle("A1:B{$totalRows}")->getFont()->setName('Calibri')->setSize(11);

        // Título principal
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 18, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2F75B5']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Subtítulo
        $sheet->mergeCells('A2:B2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4F81BD']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Filtros aplicados
        $sheet->mergeCells('A3:B3');
        $sheet->getStyle('A3')->applyFromArray([
            'font' => ['italic' => true, 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9E1F2']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Fecha generación
        $sheet->mergeCells('A4:B4');
        $sheet->getStyle('A4')->applyFromArray([
            'font' => ['italic' => true, 'size' => 10],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E2EFDA']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Estilo para encabezados de sección
        $currentRow = 6;
        foreach ($dataCollection as $expediente) {
            // Encabezado de consulta
            $sheet->mergeCells("A{$currentRow}:B{$currentRow}");
            $sheet->getStyle("A{$currentRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '7030A0']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
            ]);
            $currentRow += 5; // Saltar a la primera sección

            // Estilo para títulos de sección
            for ($i = 0; $i < 4; $i++) {
                $sheet->mergeCells("A{$currentRow}:B{$currentRow}");
                $sheet->getStyle("A{$currentRow}")->applyFromArray([
                    'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '4472C4']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
                ]);
                $currentRow += 8 + ($i == 3 ? 3 : 0); // Saltar al siguiente título de sección
            }

            // Saltar separador
            $currentRow += 3;
        }

        // Estilo para etiquetas (columna A)
        $sheet->getStyle("A6:A{$totalRows}")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);

        // Estilo para valores (columna B) - wrap text para contenido largo
        $sheet->getStyle("B6:B{$totalRows}")->applyFromArray([
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT, 'wrapText' => true],
        ]);

        // Ajustar altura de filas automáticamente para contenido largo
        for ($row = 6; $row <= $totalRows; $row++) {
            $sheet->getRowDimension($row)->setRowHeight(-1); // Auto height
        }

        // Altura específica para filas de encabezado
        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getRowDimension(2)->setRowHeight(25);
        $sheet->getRowDimension(3)->setRowHeight(20);
        $sheet->getRowDimension(4)->setRowHeight(20);
        $sheet->getRowDimension(5)->setRowHeight(10);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,  // Etiquetas
            'B' => 70,  // Valores (muy ancho para texto largo)
        ];
    }

    private function getFiltrosAplicados()
    {
        $filtros = [];

        if ($this->pacienteId) {
            $paciente = \App\Models\Paciente::with(['role.user'])->find($this->pacienteId);
            if ($paciente) {
                $filtros[] = "Paciente: " . ($paciente->role->user->name ?? 'N/A');
            }
        }

        if (!empty($this->filters['diagnostico'])) {
            $filtros[] = "Diagnóstico: {$this->filters['diagnostico']}";
        }

        if (!empty($this->filters['doctor_id'])) {
            $doctor = \App\Models\User::find($this->filters['doctor_id']);
            if ($doctor) {
                $filtros[] = "Doctor: {$doctor->name}";
            }
        }

        if (!empty($this->filters['fecha_inicio']) || !empty($this->filters['fecha_fin'])) {
            $rango = [];
            if (!empty($this->filters['fecha_inicio'])) {
                $rango[] = Carbon::parse($this->filters['fecha_inicio'])->format('d/m/Y');
            }
            $rango[] = ' - ';
            if (!empty($this->filters['fecha_fin'])) {
                $rango[] = Carbon::parse($this->filters['fecha_fin'])->format('d/m/Y');
            }
            $filtros[] = "Fecha: " . implode('', $rango);
        }

        return $filtros ? implode(' | ', $filtros) : 'Todas las consultas';
    }
}