<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="py-4">
        <h2 class=" text-center text-gray-500 dark:text-gray-400 "></h2>
    </div>
    @if ($pendingAppointments->isEmpty())
        <div class="p-4 text-center text-gray-500 dark:text-gray-400">
            No hay citas disponibles.
        </div>
    @else
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Especialidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        @if ($role == 'paciente')
                            Médico
                        @elseif($role == 'doctor')
                            Paciente
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hora
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3">Opciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingAppointments as $appointment)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $appointment->description }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $appointment->specialty }}
                        </td>
                        <td class="px-6 py-4">

                            @if ($role == 'paciente')
                                <div class="flex gap-2 justify-start">
                                    <img src="{{ Storage::url('images/profile_pictures/' . $appointment->doctor->profile_picture) }}"
                                        class="size-7 rounded-full object-cover " alt="">
                                    <p>{{ $appointment->doctor->name }}</p>
                                </div>
                            @elseif($role == 'doctor')
                                <div class="flex gap-2 justify-start">
                                    <img src="{{ Storage::url('images/profile_pictures/' . $appointment->doctor->profile_picture) }}"
                                        class="size-7 rounded-full object-cover " alt="">
                                    <p>{{ $appointment->doctor->name }}</p>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->scheduled_date }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->scheduled_time }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $appointment->type }}
                        </td>
                        <td class="px-6 py-4 flex justify-center items-center">
                            @if ($role == 'admin')
                                <a href="{{ url('/miscitas/' . $appointment->id) }}" class="btn btn-sm btn-info"
                                    title="Ver cita">
                                    <i class="ni far fa-eye"></i>
                                </a>
                            @endif

                            @if ($role == 'doctor' || $role == 'admin')
                                <form action="{{ url('/miscitas/' . $appointment->id . '/confirm') }}" method="POST"
                                    class="d-inline-block">
                                    @csrf


                                    <button type="submit" class="" title="Confirmar cita">
                                        <i class="ni ni-check-bold">confirmar cita</i>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ url('/miscitas/' . $appointment->id . '/cancel') }}" method="POST"
                                class="d-inline-block">
                                @csrf


                                <button type="submit" class="" title="Cancelar cita">
                                    <svg class="w-6 h-6 text-red-800 dark:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                      </svg>
                                      
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
