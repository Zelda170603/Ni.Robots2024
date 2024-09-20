@extends('layouts.adminLY')

@section('content')

<div class="col-span-4  rounded-lg">
    <div class="border-0 text-white">
        <div class="flex items-center justify-between">
            <h3 class="mb-0 font-bold">Cita #{{ $appointment->id }}</h3>
            <a href="{{ url('/miscitas') }}" class="btn btn-sm btn-success">
                <i class="fas fa-chevron-left"></i> Regresar
            </a>
        </div>
    </div>

    <div class=" bg-white dark:bg-gray-800 p-6">
        <ul class="space-y-4 text-gray-700 dark:text-gray-200">
            <li>
                <strong class="font-semibold">Fecha:</strong> {{ $appointment->scheduled_date }}
            </li>
            <li>
                <strong class="font-semibold">Hora de atención:</strong> {{ $appointment->scheduled_Time_12 }}
            </li>

            @if ($role == 'paciente' || $role == 'administrador')
                <li>
                    <strong class="font-semibold">Doctor:</strong> {{ $appointment->doctor->name }}
                </li>
            @endif

            @if ($role == 'doctor' || $role == 'administrador')
                <li>
                    <strong class="font-semibold">Paciente:</strong> {{ $appointment->patient->name }}
                </li>
            @endif

            <li>
                <strong class="font-semibold">Especialidad:</strong> {{ $appointment->specialty ?? 'No tiene especialidad' }}
            </li>

            <li>
                <strong class="font-semibold">Tipo de consulta:</strong> {{ $appointment->type }}
            </li>

            <li>
                <strong class="font-semibold">Estado:</strong>
                @if ($appointment->status == 'Cancelada')
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-red-700 bg-red-200 rounded-full">Cancelada</span>
                @else
                    <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-700 bg-blue-200 rounded-full">{{ $appointment->status }}</span>
                @endif
            </li>

            <li>
                <strong class="font-semibold">Síntomas:</strong> {{ $appointment->description }}
            </li>
        </ul>

        @if ($appointment->status == 'Cancelada')
            <div class="mt-6 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Detalles de la cancelación</h3>
                @if ($appointment->cancellation)
                    <ul class="mt-2 space-y-2 text-gray-600 dark:text-gray-300">
                        <li>
                            <strong>Fecha de la cancelación:</strong> {{ $appointment->cancellation->created_at }}
                        </li>
                        <li>
                            <strong>La cita fue cancelada por:</strong> {{ $appointment->cancellation->cancelled_by->name }}
                        </li>
                        <li>
                            <strong>Motivo de la cancelación:</strong> {{ $appointment->cancellation->justification }}
                        </li>
                    </ul>
                @else
                    <p class="text-gray-600 dark:text-gray-300">La cita fue cancelada antes de su confirmación</p>
                @endif
            </div>
        @endif
    </div>
</div>

@endsection
