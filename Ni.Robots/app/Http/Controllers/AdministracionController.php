<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Compra;
use App\Models\Appointment;
use App\Models\Role;

class AdministracionController extends Controller
{

    public function index()
    {
        return view('Administracion.index');
    }

    public function doctor()
{
    $doctorUser = Auth::user();

    // Obtener el doctor_id real (id de la tabla doctor)
    $doctorRole = Role::where('user_id', $doctorUser->id)
        ->where('role_type', 'doctor')
        ->first();

    if (!$doctorRole) {
        $metrics = [
            'total_pacientes' => 0,
            'citas_pendientes' => 0,
            'citas_atendidas' => 0,
            'citas_canceladas' => 0,
        ];
        $pacientes = collect(); // Colección vacía
    } else {
        $doctorId = $doctorRole->roleable_id;

        // Pacientes únicos asociados a este doctor
        $pacientes = Appointment::where('doctor_id', $doctorId)
            ->with(['patient.role.user'])
            ->get()
            ->pluck('patient')
            ->filter()
            ->unique('id');

        $totalPacientes = $pacientes->count();

        // Contar citas pendientes
        $citasPendientes = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'Reservada')
            ->count();

        // Contar citas canceladas
        $citasCanceladas = Appointment::where('doctor_id', $doctorId)
            ->where('status', 'Cancelada')
            ->count();

        // Contar citas atendidas (todas)
        $citasAtendidas = Appointment::where('doctor_id', $doctorId)
            ->count();

        $metrics = [
            'total_pacientes' => $totalPacientes,
            'citas_pendientes' => $citasPendientes,
            'citas_atendidas' => $citasAtendidas,
            'citas_canceladas' => $citasCanceladas,
        ];
    }

    return view('Administracion.Doctor.index', compact('metrics', 'pacientes'));
}


    public function fabricante()
    {
        $user = Auth::user();
        $role = $user->role->role_type;
        $layout = $role == 'fabricante' ? 'layouts.adminLY' : 'layouts.app';

        // Contar usuarios únicos que hayan hecho compras
        $totalClientes = Compra::distinct('user_id')->count('user_id');
        // Contar compras pendientes
        $ordenesPendientes = Compra::where('status', 'pendiente')->count();
        $ultimasCompras = Compra::with('user', 'compraProductos')->orderBy('created_at', 'desc')->take(10)->get();

        return view('Administracion.fabricante.index', compact('layout', 'totalClientes', 'ordenesPendientes', 'ultimasCompras'));
    }
}
