@extends('layouts.adminLY')

@section('content')
    <div class="mx-auto max-w-(--breakpoint-2xl) pb-20 md:p-6 md:pb-6">
        <h5 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white/90">Panel de Control del Doctor</h5>
        <div class="grid grid-cols-12 gap-2 md:gap-4">

            <!-- ====== Chart 2 ====== -->
            <div class="col-span-12 h-full xl:col-span-5">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <!-- Título -->
                    <div class="px-5 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-2">
                            Tipos de Afectación Atendidos
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Distribución de pacientes según su tipo de afectación
                        </p>
                    </div>

                    <!-- Gráfico -->
                    <div id="chart-afectaciones" class="p-4"></div>

                    <!-- Información adicional -->
                    <div
                        class="border-t border-gray-200 text-md dark:border-gray-800 px-5 py-6 grid grid-cols-2 gap-6 text-sm">
                        <div>
                            <h2 class="font-semibold text-gray-800 dark:text-white/90">Afectación más frecuente:</h2>
                            <p id="afectacion-mas-comun" class="text-gray-500 dark:text-gray-400">Cargando...</p>
                        </div>

                        <div>
                            <h2 class="font-semibold text-gray-800 dark:text-white/90">Total de pacientes:</h2>
                            <p id="total-pacientes" class="text-gray-500 dark:text-gray-400">Cargando...</p>
                        </div>
                    </div>

                    <!-- Script del gráfico -->
                    <script>
                        fetch('/api/doctor/pacientes-por-afectacion')
                            .then(res => res.json())
                            .then(data => {
                                console.log('Datos de pacientes por afectación:', data);

                                const labels = data.map(item => item.tipo_afectacion);
                                const series = data.map(item => item.total_pacientes);

                                const options = {
                                    series: series,
                                    chart: {
                                        type: 'donut',
                                        height: 390
                                    },
                                    labels: labels,
                                    colors: ['#1ab7ea', '#25D366', '#39539E', '#FF9800'],
                                    legend: {
                                        position: 'bottom'
                                    }
                                };

                                const chart = new ApexCharts(document.querySelector("#chart-afectaciones"), options);
                                chart.render();

                                // Datos adicionales dinámicos
                                const totalPacientes = series.reduce((a, b) => a + b, 0);
                                const afectacionMasComunIndex = series.indexOf(Math.max(...series));
                                const afectacionMasComun = labels[afectacionMasComunIndex] || 'N/A';

                                document.querySelector('#total-pacientes').textContent = `${totalPacientes} pacientes`;
                                document.querySelector('#afectacion-mas-comun').textContent = afectacionMasComun;
                            })
                            .catch(err => console.error('Error al cargar pacientes por afectación:', err));
                    </script>
                </div>

            </div>
            <!-- Panel de control del Fabricante - Ni.Robots -->
            <div class="col-span-12 space-y-6 xl:col-span-7">
                <!-- Métricas Generales -->
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 md:gap-4">
                    <!-- Clientes -->
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <!-- Ícono -->
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H6Zm7.25-2.095c.478-.86.75-1.85.75-2.905a5.973 5.973 0 0 0-.75-2.906 4 4 0 1 1 0 5.811ZM15.466 20c.34-.588.535-1.271.535-2v-1a5.978 5.978 0 0 0-1.528-4H18a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2h-4.535Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Pacientes Totales</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $metrics['total_pacientes'] }}
                                </h4>
                            </div>
                            <span
                                class="flex items-center gap-1 rounded-full bg-blue-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-blue-600 dark:bg-blue-500/15 dark:text-blue-500">
                                <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z" />
                                </svg>
                                +5.2%
                            </span>
                        </div>
                    </div>
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <!-- Ícono -->
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                            </svg>


                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Citas Pendientes</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $metrics['citas_pendientes'] }}
                                </h4>
                            </div>
                            <span
                                class="flex items-center gap-1 rounded-full bg-blue-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-blue-600 dark:bg-blue-500/15 dark:text-blue-500">
                                <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z" />
                                </svg>
                                2.01%
                            </span>
                        </div>
                    </div>

                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <!-- Ícono -->
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 5h6m-6 4h6M10 3v4h4V3h-4Z" />
                            </svg>

                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Total de Citas</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $metrics['citas_atendidas'] }}
                                </h4>
                            </div>
                            <span
                                class="flex items-center gap-1 rounded-full bg-blue-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-blue-600 dark:bg-blue-500/15 dark:text-blue-500">
                                <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.56462 1.62393C5.70193 1.47072 5.90135 1.37432 6.12329 1.37432L9.65514 4.5918C9.94814 4.88459 9.94831 5.35947 9.65552 5.65246C9.36273 5.94546 8.88785 5.94562 8.59486 5.65283L6.87329 3.93247L6.87329 10.125C6.87329 10.5392 6.53751 10.875 6.12329 10.875C5.70908 10.875 5.37329 10.5392 5.37329 10.125L5.37329 3.93578L3.65516 5.65282C3.36218 5.94562 2.8873 5.94547 2.5945 5.65248C2.3017 5.35949 2.30185 4.88462 2.59484 4.59182L5.56462 1.62393Z" />
                                </svg>
                                11.01%
                            </span>
                        </div>
                    </div>


                    <!-- Órdenes -->
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                            <!-- Ícono -->
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>

                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Citas Canceladas</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $metrics['citas_canceladas'] }}
                                </h4>
                            </div>
                            <span
                                class="flex items-center gap-1 rounded-full bg-red-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-red-600 dark:bg-red-500/15 dark:text-red-500">
                                <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z" />
                                </svg>
                                9.05%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ====== Chart 1: Citas semanales ====== -->
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Citas agendadas en la última
                            semana</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Cantidad de citas registradas por día</p>
                    </div>

                    <div id="chart-citas" class="max-w-full no-scrollbar"></div>

                    <script>
                        async function cargarCitas() {
                            try {
                                const response = await fetch('/api/doctor/citas-semana');
                                const text = await response.text();
                                console.log("📅 Respuesta cruda del backend:", text);

                                const data = JSON.parse(text);
                                console.log("✅ Datos procesados:", data);

                                const options = {
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    series: [{
                                        name: 'Citas',
                                        data: data.citas
                                    }],
                                    xaxis: {
                                        categories: data.dias,
                                        title: {
                                            text: 'Fecha'
                                        }
                                    },
                                    yaxis: {
                                        title: {
                                            text: 'Número de citas'
                                        },
                                        min: 0
                                    },
                                    colors: ['#1ab7ea'],
                                    dataLabels: {
                                        enabled: false
                                    }
                                };

                                const chart = new ApexCharts(document.querySelector("#chart-citas"), options);
                                chart.render();

                            } catch (error) {
                                console.error("❌ Error al cargar las citas:", error);
                            }
                        }
                        cargarCitas();
                    </script>
                </div>

            </div>


            <!-- ====== Chart 3 ====== -->
            <div class="col-span-12">
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Niveles de Afectación de Pacientes
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Distribución de pacientes por nivel de afectación
                        </p>
                    </div>

                    <div id="chart-niveles" class="p-4"></div>

                    <script>
                        async function cargarNiveles() {
                            try {
                                const response = await fetch('/api/doctor/niveles-afectacion');
                                const data = await response.json();

                                console.log("📊 Datos de niveles de afectación:", data);

                                const categorias = data.map(item => item.nivel_afectacion || 'Sin definir');
                                const valores = data.map(item => item.total_pacientes);

                                const options = {
                                    series: [{
                                        data: valores
                                    }],
                                    chart: {
                                        type: 'bar',
                                        height: 350
                                    },
                                    plotOptions: {
                                        bar: {
                                            borderRadius: 4,
                                            borderRadiusApplication: 'end',
                                            horizontal: true,
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    xaxis: {
                                        categories: categorias
                                    }
                                };

                                const chart = new ApexCharts(document.querySelector("#chart-niveles"), options);
                                chart.render();

                            } catch (error) {
                                console.error("❌ Error al cargar los niveles de afectación:", error);
                            }
                        }

                        cargarNiveles();
                    </script>
                </div>

            </div>

            <div class="col-span-12  ">
                <!-- ====== Pacientes Atendidos ====== -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6 mt-8">
                    <!-- Título -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Pacientes Atendidos</h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Lista de los pacientes que has atendido recientemente
                    </p>

                    <!-- Tabla de pacientes -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
                                <thead
                                    class="bg-gray-100 dark:bg-gray-700 uppercase text-xs font-semibold text-gray-700 dark:text-gray-200">
                                    <tr>
                                        <th class="px-6 py-3">Foto</th>
                                        <th class="px-6 py-3">Nombre</th>
                                        <th class="px-6 py-3">Edad</th>
                                        <th class="px-6 py-3">Teléfono</th>
                                        <th class="px-6 py-3">Condición</th>
                                        <th class="px-6 py-3">Correo</th>
                                        <th class="px-6 py-3 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pacientes as $paciente)
                                        <tr
                                            class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                            <td class="px-6 py-3">
                                                <div
                                                    class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                    @if ($paciente->role->user->profile_picture)
                                                        <img src="{{ asset('storage/' . $paciente->role->user->profile_picture) }}"
                                                            alt="{{ $paciente->role->user->name }}"
                                                            class="w-full h-full object-cover">
                                                    @else
                                                        <i class="fas fa-user text-gray-400"></i>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">
                                                {{ $paciente->role->user->name ?? 'Sin nombre' }}
                                            </td>
                                            <td class="px-6 py-3">{{ $paciente->edad ?? 'N/A' }}</td>
                                            <td class="px-6 py-3">{{ $paciente->telefono ?? 'N/A' }}</td>
                                            <td class="px-6 py-3">{{ $paciente->condicion ?? 'N/A' }}</td>
                                            <td class="px-6 py-3">{{ $paciente->role->user->email ?? 'N/A' }}</td>
                                            <td class="px-6 py-3 text-center">
                                                <a href="{{ route('expedientes.show', $paciente->id) }}"
                                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 p-2 rounded-full hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors"
                                                    title="Ver Expediente">
                                                    <i class="fas fa-file-medical"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"
                                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                <i class="fas fa-info-circle mr-2"></i>No tienes pacientes registrados
                                                todavía.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
