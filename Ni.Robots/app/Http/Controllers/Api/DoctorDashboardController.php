<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;
use App\Models\Paciente;
use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{

    public function pacientesPorAfectacion()
    {
        $doctorUser = Auth::user();

        // Obtener el doctor_id real (id de la tabla doctor)
        $doctorRole = Role::where('user_id', $doctorUser->id)
            ->where('role_type', 'doctor')
            ->first();

        if (!$doctorRole) {
            return response()->json([
                'message' => 'No se encontró el rol de doctor para este usuario.'
            ], 404);
        }

        $doctorId = $doctorRole->roleable_id;

        // Obtener los pacientes únicos que ha atendido el doctor
        $pacientes = Appointment::where('doctor_id', $doctorId)
            ->with('patient')
            ->get()
            ->pluck('patient')
            ->filter()
            ->unique('id');

        // Agrupar los pacientes por tipo de afectación
        $agrupado = $pacientes->groupBy('tipo_afectacion')->map(function ($grupo) {
            return $grupo->count();
        });

        // Formatear para el gráfico
        $data = $agrupado->map(function ($count, $tipo) {
            return [
                'tipo_afectacion' => $tipo,
                'total_pacientes' => $count
            ];
        })->values();

        return response()->json($data);
    }

    public function citasUltimaSemana()
    {
        $user = Auth::user();

        if (!$user->role || $user->role->role_type !== 'doctor') {
            return response()->json([
                'error' => 'No autorizado o no es doctor.'
            ], 403);
        }

        $doctorId = $user->role->roleable_id;


        $start = Carbon::now()->subDays(6)->startOfDay();
        $end = Carbon::now()->endOfDay();

        $citas = \App\Models\Appointment::where('doctor_id', $doctorId)
            ->whereBetween('created_at', [$start, $end])
            ->get(['id', 'created_at']); // solo campos necesarios

        $dias = collect();
        for ($i = 0; $i < 7; $i++) {
            $dias->push($start->copy()->addDays($i)->format('Y-m-d'));
        }

        $citasPorDia = $dias->mapWithKeys(function ($dia) use ($citas) {
            $totalDia = $citas->filter(function ($cita) use ($dia) {
                return $cita->created_at->format('Y-m-d') === $dia;
            })->count();

            return [$dia => $totalDia];
        });

        return response()->json([
            'dias' => $citasPorDia->keys()->values(),
            'citas' => $citasPorDia->values(),
        ]);
    }

    public function pacientesPorNivelAfectacion()
    {
        $doctorUser = Auth::user();

        // Obtener el doctor_id real (id en la tabla 'doctores')
        $doctorRole = Role::where('user_id', $doctorUser->id)
            ->where('role_type', 'doctor')
            ->first();

        if (!$doctorRole) {
            return response()->json([
                'message' => 'No se encontró el rol de doctor para este usuario.'
            ], 404);
        }

        $doctorId = $doctorRole->roleable_id;

        // Obtener pacientes únicos atendidos por el doctor
        $pacientes = Appointment::where('doctor_id', $doctorId)
            ->with('patient')
            ->get()
            ->pluck('patient')
            ->filter()
            ->unique('id');

        // Agrupar los pacientes por nivel de afectación
        $agrupado = $pacientes->groupBy('nivel_afectacion')->map(function ($grupo) {
            return $grupo->count();
        });

        // Formatear para el gráfico
        $data = $agrupado->map(function ($count, $nivel) {
            return [
                'nivel_afectacion' => $nivel,
                'total_pacientes' => $count
            ];
        })->values();

        return response()->json($data);
    }
}
