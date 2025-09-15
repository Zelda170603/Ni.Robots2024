@extends($layout)

@section('title', 'Citas')

@section('content')
    <div class="justify-self-center col-span-4 w-full">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex justify-evenly -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-styled-tab"
                        data-tabs-target="#styled-profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">citas confirmadas</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="dashboard-styled-tab" data-tabs-target="#styled-dashboard" type="button" role="tab"
                        aria-controls="dashboard" aria-selected="false">Citas pedientes</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="settings-styled-tab" data-tabs-target="#styled-settings" type="button" role="tab"
                        aria-controls="settings" aria-selected="false">Historial de citas</button>
                </li>
            </ul>
        </div>
        <div id="default-styled-tab-content">
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-profile" role="tabpanel"
                aria-labelledby="profile-tab">
                @include('appointments.tables.confirmed-appointments')
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-dashboard" role="tabpanel"
                aria-labelledby="dashboard-tab">
                @include('appointments.tables.pending-appointments')
            </div>
            <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="styled-settings" role="tabpanel"
                aria-labelledby="settings-tab">
                @include('appointments.tables.old-appointments')
            </div>
        </div>
        <!-- Overlay -->
        <div id="overlay"
            class="fixed inset-0 bg-gray-900 bg-opacity-70 transition-opacity opacity-0 pointer-events-none">
        </div>

        <!-- Main modal -->
        <div id="calendar-modal" tabindex="-1" aria-hidden="true"
            class="hidden fixed inset-0 z-50 justify-center items-center">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="modal-title">
                            Detalles de la Cita
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            id="close-modal-button">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <!-- Doctor Information -->
                        <div class="flex items-center space-x-4">
                            <img id="modal-doctor-picture" src="" alt=""
                                class="w-10 h-10 rounded-full">
                            <div>
                                <p><strong>Doctor:</strong> <span id="modal-doctor-name"></span></p>
                                <p><strong>Correo:</strong> <span id="modal-doctor-email"></span></p>
                            </div>
                        </div>

                        <!-- Patient Information -->
                        <div class="flex items-center space-x-4">
                            <img id="modal-patient-picture" src="" alt=""
                                class="w-10 h-10 rounded-full">
                            <div>
                                <p><strong>Paciente:</strong> <span id="modal-patient-name"></span></p>
                                <p><strong>Correo:</strong> <span id="modal-patient-email"></span></p>
                            </div>
                        </div>

                        <p><strong>Descripción:</strong> <span id="modal-description"></span></p>
                        <p><strong>Fecha y Hora:</strong> <span id="modal-datetime"></span></p>
                        <p><strong>Estado:</strong> <span id="modal-status"></span></p>
                        <p><strong>Tipo:</strong> <span id="modal-type"></span></p>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button id="close-modal-button" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="calendar"></div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.getElementById('overlay');
            const modal = document.getElementById('calendar-modal');
            const closeModalButtons = document.querySelectorAll('#close-modal-button');

            // Initialize FullCalendar
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events), // Pass events from the controller
                locale: 'es',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                eventClick: function(info) {
                    // Fill modal fields with event data
                    document.getElementById('modal-title').textContent = info.event.title;
                    document.getElementById('modal-description').textContent = info.event.extendedProps
                        .description || 'Sin descripción';
                    document.getElementById('modal-doctor-name').textContent = info.event.extendedProps
                        .doctor.name || 'No disponible';
                    document.getElementById('modal-doctor-email').textContent = info.event.extendedProps
                        .doctor.email || 'No disponible';
                    document.getElementById('modal-doctor-picture').src = info.event.extendedProps
                        .doctor.profile_picture || ''; // URL de la foto del médico
                    document.getElementById('modal-patient-name').textContent = info.event.extendedProps
                        .patient.name || 'No disponible';
                    document.getElementById('modal-patient-email').textContent = info.event
                        .extendedProps.patient.email || 'No disponible';
                    document.getElementById('modal-patient-picture').src = info.event.extendedProps
                        .patient.profile_picture || ''; // URL de la foto del paciente
                    document.getElementById('modal-datetime').textContent = info.event.start
                        .toLocaleString();
                    document.getElementById('modal-status').textContent = info.event.extendedProps
                        .status || 'No especificado';
                    document.getElementById('modal-type').textContent = info.event.extendedProps.type ||
                        'No especificado';

                    // Show modal and overlay
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    overlay.classList.remove('opacity-0', 'pointer-events-none');
                }


            });

            calendar.render();

            // Close modal logic
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    modal.classList.add('hidden'); // Hide modal
                    modal.classList.remove('flex');
                    overlay.classList.add('opacity-0', 'pointer-events-none'); // Hide overlay
                });
            });

            // Close modal when clicking on the overlay
            overlay.addEventListener('click', function() {
                modal.classList.add('hidden'); // Hide modal
                modal.classList.remove('flex');
                overlay.classList.add('opacity-0', 'pointer-events-none'); // Hide overlay
            });
        });
    </script>

    <!-- Footer -->
@endsection
