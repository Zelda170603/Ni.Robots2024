@extends('layouts.adminLY')

@section('content')
    <div class="mx-auto max-w-(--breakpoint-2xl) pb-20 md:p-6 md:pb-6">
        <h5 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white/90">Panel de Control del Fabricante</h5>
        <div class="grid grid-cols-12 gap-2 md:gap-4">
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
                                <span class="text-sm text-gray-500 dark:text-gray-400">Clientes Totales</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $totalClientes }}</h4>
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
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                            </svg>

                        </div>

                        <div class="mt-5 flex items-end justify-between">
                            <div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Órdenes Pendientes</span>
                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                    {{ $ordenesPendientes }}</h4>
                            </div>
                            <span
                                class="flex items-center gap-1 rounded-full bg-red-50 py-0.5 pl-2 pr-2.5 text-sm font-medium text-red-600 dark:bg-red-500/15 dark:text-red-500">
                                <svg class="fill-current" width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.31462 10.3761C5.45194 10.5293 5.65136 10.6257 5.87329 10.6257L9.40514 7.4082C9.69814 7.11541 9.69831 6.64054 9.40552 6.34754C9.11273 6.05454 8.63785 6.05438 8.34486 6.34717L6.62329 8.06753L6.62329 1.875C6.62329 1.46079 6.28751 1.125 5.87329 1.125C5.45908 1.125 5.12329 1.46079 5.12329 1.875L5.12329 8.06422L3.40516 6.34719C3.11218 6.05439 2.6373 6.05454 2.3445 6.34752C2.0517 6.64051 2.05185 7.11538 2.34484 7.40818L5.31462 10.3761Z" />
                                </svg>
                                9.05%
                            </span>
                        </div>
                    </div>
                </div>

                <!-- ====== Chart 1 ====== -->
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <div class="px-5 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90"> Venta semanal de Productos</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Rendimiento de ventas de la ultima semana</p>
                    </div>

                    <div id="chart-1" class="max-w-full  no-scrollbar"></div>

                    <script>
                        async function cargarVentas() {
                            try {
                                const response = await fetch('/api/fabricante/ventas-semana');
                                const text = await response.text(); // obtenemos texto crudo para depurar
                                console.log("📦 Respuesta cruda del backend:", text);

                                const data = JSON.parse(text);
                                console.log("✅ Datos procesados:", data);

                                // Crea el gráfico con ApexCharts
                                const options = {
                                    chart: {
                                        type: 'bar'
                                    },
                                    series: [{
                                        name: 'Ventas',
                                        data: data.ventas
                                    }],
                                    xaxis: {
                                        categories: data.dias
                                    }
                                };

                                const chart = new ApexCharts(document.querySelector("#chart-1"), options);
                                chart.render();

                            } catch (error) {
                                console.error("❌ Error al cargar las ventas:", error);
                            }
                        }
                        cargarVentas();
                    </script>
                </div>
            </div>
            <!-- ====== Chart 2 ====== -->
            <div class="col-span-12 h-full xl:col-span-5">
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                    <!-- Título -->
                    <div class="px-5 pt-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-2">
                            Productos más vendidos
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Top 10 de productos más vendidos
                        </p>

                    </div>
                    <!-- Gráfico -->
                    <div id="chart-2" class="p-4"></div>
                    <!-- Información adicional -->
                    <div
                        class="border-t border-gray-200 text-md dark:border-gray-800 px-5 py-6 grid grid-cols-2 gap-6 text-sm">
                        <div>
                            <h2 class="font-semibold  text-gray-800 dark:text-white/90">Categoría más vendida:</h2>
                            <p id="categoria-mas-vendida" class="text-gray-500 dark:text-gray-400">Cargando...</p>
                        </div>

                        <div>
                            <h2 class="font-semibold   text-gray-800 dark:text-white/90">Total ventas:</h2>
                            <p id="total-ventas" class="text-gray-500 dark:text-gray-400">Cargando...</p>
                        </div>

                        <div>
                            <h2 class="font-semibold   text-gray-800 dark:text-white/90">Crecimiento en línea:</h2>
                            <p class="text-gray-500 dark:text-gray-400">+15% respecto al mes anterior gracias a campañas
                                digitales.</p>
                        </div>

                        <div>
                            <h2 class="font-semibold  text-gray-800 dark:text-white/90">Clientes nuevos:</h2>
                            <p class="text-gray-500 dark:text-gray-400">184 nuevos usuarios registrados en Ni.Robots.</p>
                        </div>
                    </div>
                    <!-- Script del gráfico -->
                    <script>
                        document.addEventListener("DOMContentLoaded", async () => {
                            try {
                                const res = await fetch('/api/fabricante/ventas-por-categoria');
                                if (!res.ok) throw new Error(`HTTP ${res.status}`);

                                const data = await res.json();
                                console.log('✅ Datos devueltos por la API:', data);

                                // Extraer labels y valores
                                const labels = data.map(item => item.tipo_producto);
                                const series = data.map(item => item.total_vendidos || 0);

                                // Colores dinámicos
                                const colors = ['#1ab7ea', '#25D366', '#39539E', '#0077B5'];
                                while (colors.length < labels.length) {
                                    colors.push('#' + Math.floor(Math.random() * 16777215).toString(16));
                                }

                                // Configurar gráfico
                                const options = {
                                    series: series,
                                    chart: {
                                        height: 390,
                                        type: 'radialBar',
                                    },
                                    plotOptions: {
                                        radialBar: {
                                            offsetY: 0,
                                            startAngle: 0,
                                            endAngle: 270,
                                            hollow: {
                                                margin: 5,
                                                size: '30%',
                                                background: 'transparent'
                                            },
                                            dataLabels: {
                                                name: {
                                                    show: false
                                                },
                                                value: {
                                                    show: false
                                                }
                                            },
                                            barLabels: {
                                                enabled: true,
                                                useSeriesColors: true,
                                                offsetX: -8,
                                                fontSize: '15px',
                                                formatter: function(seriesName, opts) {
                                                    return `${labels[opts.seriesIndex]}: ${opts.w.globals.series[opts.seriesIndex]}`;
                                                }
                                            }
                                        }
                                    },
                                    colors: colors,
                                    labels: labels
                                };

                                // Renderizar gráfico
                                const chart = new ApexCharts(document.querySelector("#chart-2"), options);
                                chart.render();

                                // 🔹 Información adicional dinámica
                                const totalVentas = series.reduce((acc, val) => acc + val, 0);
                                const categoriaMasVendidaIndex = series.indexOf(Math.max(...series));
                                const categoriaMasVendida = labels[categoriaMasVendidaIndex] || 'N/A';

                                document.querySelector('#total-ventas').textContent = `Aprox. ${totalVentas} unidades vendidas`;
                                document.querySelector('#categoria-mas-vendida').textContent =
                                    `${categoriaMasVendida} — La categoría más vendida`;

                            } catch (err) {
                                console.error('❌ Error al cargar ventas por categoría:', err);
                            }
                        });
                    </script>


                </div>
            </div>


            <!-- ====== Chart 3 ====== -->
            <div class="col-span-12">
                <div
                    class="rounded-2xl border border-gray-200 bg-white px-5 pb-5 pt-5 dark:border-gray-800 dark:bg-white/[0.03] sm:px-6 sm:pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-2"> Tendencia de precios de
                        componentes ortopédicos</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Evolución del costo de fabricación y venta</p>

                    <div id="chart-3" class="max-w-full overflow-x-auto"></div>

                    <script>
                        fetch('/api/fabricante/productos-mas-vendidos')
                            .then(res => res.json())
                            .then(data => {
                                console.log('Productos más vendidos:', data); // Revisar en consola

                                const categories = data.map(item => item.nombre_prod);
                                const series = data.map(item => item.total_vendidos || 0);

                                var options = {
                                    series: [{
                                        data: series
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
                                        categories: categories
                                    }
                                };

                                var chart3 = new ApexCharts(document.querySelector("#chart-3"), options);
                                chart3.render();
                            })
                            .catch(err => console.error('Error al cargar productos más vendidos:', err));
                    </script>

                </div>
            </div>


            <div class="col-span-12 xl:col-span-6">
                <!-- ====== Últimas Compras Start ====== -->
                <div
                    class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] sm:p-6">
                    <!-- Título -->
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-4">Últimas 10 Compras</h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Descripcion General de las ultimas 10 compras registradas
                    </p>
                    <!-- Tabla -->
                    <div class="relative max-h-[400px] overflow-y-auto no-scrollbar overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Usuario</th>
                                    <th scope="col" class="px-6 py-3">Cantidad de Productos</th>
                                    <th scope="col" class="px-6 py-3">Total</th>
                                    <th scope="col" class="px-6 py-3">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ultimasCompras as $compra)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">

                                        <td class="px-6 py-4">{{ $compra->user->name }}</td>
                                        <td class="px-6 py-4">{{ $compra->compraProductos->sum('cantidad') }}</td>
                                        <td class="px-6 py-4">${{ number_format($compra->total, 2) }}</td>
                                        <td class="px-6 py-4">{{ $compra->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- ====== Últimas Compras End ====== -->
            </div>


            <div class="col-span-12 xl:col-span-6">
                <!-- ====== Table One Start -->
                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white px-4 pt-4 pb-3 sm:px-6 dark:border-gray-800 dark:bg-white/[0.03]">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90 mb-2">
                        Distribución de compras por estado
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Cantidad de compras clasificadas según su estado: pendiente, pagado y enviado.
                    </p>
                    <div id="chart-4" class="max-w-full  "></div>
                </div>

                <script>
                    fetch('/api/fabricante/compras-por-estado')
                        .then(res => res.json())
                        .then(data => {
                            var options = {
                                series: data.series,
                                chart: {
                                    type: 'donut',
                                },
                                labels: data.labels,
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: 200
                                        },
                                        legend: {
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };

                            var chart4 = new ApexCharts(document.querySelector("#chart-4"), options);
                            chart4.render();
                        })
                        .catch(err => console.error('Error al cargar compras por estado:', err));
                </script>
                <!-- ====== Table One End -->
            </div>
        </div>
    </div>
@endsection
