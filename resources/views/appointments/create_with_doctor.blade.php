@extends('layouts.app')

@section('title', 'Crear Cita')

@section('content')
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <h1 class="text-xl mb-5 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Registrar una nueva cita con el medico {{ $medico->name }}
        </h1>
        <div class="card-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Por favor!</strong> {{ $error }}
                    </div>
                @endforeach
            @endif
            <form action="{{ url('/reservarcitas') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="mb-5">
                        <label for="specialty"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialidad</label>
                        <select name="specialty" id="specialty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Seleccionar especialidad</option>
                            <option value="{{ $specialty }}" @if (old('specialty') == $specialty) selected @endif>
                                {{ $specialty }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="doctor"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Médico</label>
                        <select name="doctor_id" id="doctor"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="">Seleccionar medico</option>
                            <option value="{{ $medico->doctor->id }}">
                                {{ $medico->name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="date" class="text-sm font-medium text-gray-900 dark:text-gray-300">Fecha</label>
                        <div class="relative flex items-center">
                            <span class="absolute left-3 text-gray-500 dark:text-gray-400">
                                <i class="ni ni-calendar-grid-58"></i>
                            </span>
                            <input
                                class="form-control datepicker w-full pl-10 p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                id="date" name="scheduled_date" placeholder="Seleccionar fecha" type="date"
                                value="{{ old('scheduled_date'), date('Y-m-d') }}" data-date-format="yyyy-mm-dd"
                                data-date-start-date="{{ date('Y-m-d') }}" data-date-end-date="+30d">
                        </div>
                    </div>

                    <div class="mb-5">
                        <label for="hours" class="text-sm font-medium text-gray-900 dark:text-gray-300">Hora de
                            atención</label>

                        <div class="col">
                            <h4 class="m-3" id="titleMorning"></h4>
                            <div id="hoursMorning">
                                @if ($intervals)
                                    <h4 class="m-3 text-lg font-semibold dark:text-gray-300">En la mañana</h4>
                                    @foreach ($intervals['morning'] as $key => $interval)
                                        <div class="flex items-center mb-3">
                                            <input type="radio" id="intervalMorning{{ $key }}"
                                                name="scheduled_time" value="{{ $interval['start'] }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="intervalMorning{{ $key }}"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $interval['start'] }} - {{ $interval['end'] }}
                                            </label>
                                        </div>
                                    @endforeach
                                @else
                                    <mark>
                                        <small class="text-warning display-5">Seleccione un medico y una fecha para ver las
                                            horas</small>
                                    </mark>
                                @endif
                            </div>
                        </div>

                        <div class="col">
                            <h4 class="m-3" id="titleAfternoon"></h4>
                            <div id="hoursAfternoon">
                                @if ($intervals)
                                    <h4 class="m-3 text-lg font-semibold  dark:text-gray-300">En la tarde</h4>
                                    @foreach ($intervals['afternoon'] as $key => $interval)
                                        <div class="flex items-center mb-3">
                                            <input type="radio" id="intervalAfternoon{{ $key }}"
                                                name="scheduled_time" value="{{ $interval['start'] }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="intervalAfternoon{{ $key }}"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                {{ $interval['start'] }} - {{ $interval['end'] }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <label class="text-sm font-medium text-gray-900 dark:text-gray-300">Tipo de consulta</label>

                        <div class="flex items-center mt-3 mb-3">
                            <input id="type1" type="radio" name="type" value="Consulta"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                @if (old('type') == 'Consulta') checked @endif>
                            <label for="type1"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Consulta</label>
                        </div>

                        <div class="flex items-center mb-3">
                            <input id="type2" type="radio" name="type" value="Examen"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                @if (old('type') == 'Examen') checked @endif>
                            <label for="type2"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Examen</label>
                        </div>

                        <div class="flex items-center mb-5">
                            <input id="type3" type="radio" name="type" value="Operacion"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                @if (old('type') == 'Operacion') checked @endif>
                            <label for="type3"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Operacion</label>
                        </div>
                    </div>


                    <div class="mb-5">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                        <textarea name="description" id="description" type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Descripcion breve de sus sintomas" required>
                    </textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">Reservar
                            cita</button>
                    </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    @vite('resources/js/appointments/create.js')
@endsection
