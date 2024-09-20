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
                            {{ $appointment->specialty->name ?? 'No tiene especialidad' }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($role == 'paciente')
                                <div class="flex gap-2 justify-start">
                                    <img src="{{ Storage::url('images/profile_pictures/' . $relatedUsers[$appointment->id]->profile_picture) }}"
                                        class="size-7 rounded-full object-cover" alt="">
                                    <p>{{ $relatedUsers[$appointment->id]->name }}</p>
                                </div>
                            @elseif ($role == 'doctor')
                                <div class="flex gap-2 justify-start">
                                    <img src="{{ Storage::url('images/profile_pictures/' . $relatedUsers[$appointment->id]->profile_picture) }}"
                                        class="size-7 rounded-full object-cover" alt="">
                                    <p>{{ $relatedUsers[$appointment->id]->name }}</p>
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
                            @if ($role == 'administrador')
                                <a href="{{ url('/miscitas/' . $appointment->id) }}" class="btn btn-sm btn-info"
                                    title="Ver cita">
                                    <i class="ni far fa-eye"></i>
                                </a>
                            @endif

                            @if ($role == 'doctor' || $role == 'administrador')
                                <form action="{{ url('/miscitas/' . $appointment->id . '/confirm') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="" title="Confirmar cita">
                                        <svg class="w-6 h-6 text-green-800 dark:text-green-600" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ url('/miscitas/' . $appointment->id . '/cancel') }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button type="submit" class="" title="Cancelar cita">
                                    <svg class="w-6 h-6 text-red-800 dark:text-red-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z"
                                            clip-rule="evenodd" />
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
