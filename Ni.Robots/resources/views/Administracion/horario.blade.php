@extends('layouts.adminLY')

@section('content')
    <div class="rounded-lg overflow-hidden col-span-4">
        <div class="text-slate-900 dark:text-white p-4">
            <h1 class="text-2xl font-bold">Gestionar horarios de atencion</h1>
        </div>
        <div class="p-4">
            @if (session('success'))
                <div class="mb-4">
                    <p class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
                        {{ session('success') }}
                    </p>
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/horario') }}" method="POST" ">
                @csrf
                <div class="mb-4">
                     @if (session('notification'))
                <div class="alert alert-success" role="alert">
                    {{ session('notification') }}
                </div>
                @endif

                @if (session('errors'))
                    <div class="alert alert-danger" role="alert">
                        Los cambios se han realizado correctamente, pero se encontraron las siguientes novedades:
                        <ul>
                            @foreach (session('errors') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Día
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Activo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Turno mañana
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Turno tarde
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    @foreach ($horarios as $key => $horario)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $days[$key] }}
                            </th>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <label class="custom-toggle">
                                    <input type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" name="active[]" value="{{ $key }}"
                                        @if ($horario->active) checked @endif>
                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                        data-label-on="Yes"></span>
                                </label>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-4">
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="morning_start[]">
                                        @for ($i = 8; $i <= 11; $i++)
                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                                @if ($i . ':00 AM' == $horario->morning_start) selected @endif>
                                                {{ $i }}:00 AM</option>
                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                                @if ($i . ':30 AM' == $horario->morning_start) selected @endif>
                                                {{ $i }}:30 AM</option>
                                        @endfor
                                    </select>
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="morning_end[]">
                                        @for ($i = 8; $i <= 11; $i++)
                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                                @if ($i . ':00 AM' == $horario->morning_end) selected @endif>
                                                {{ $i }}:00 AM</option>
                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                                @if ($i . ':30 AM' == $horario->morning_end) selected @endif>
                                                {{ $i }}:30 AM</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex space-x-4">
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="afternoon_start[]">
                                        @for ($i = 1; $i <= 11; $i++)
                                            <option value="{{ $i + 12 }}:00"
                                                @if ($i . ':00 PM' == $horario->afternoon_start) selected @endif>
                                                {{ $i }}:00 PM</option>
                                            <option value="{{ $i + 12 }}:30"
                                                @if ($i . ':30 PM' == $horario->afternoon_start) selected @endif>
                                                {{ $i }}:30 PM</option>
                                        @endfor
                                    </select>
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="afternoon_end[]">
                                        @for ($i = 1; $i <= 11; $i++)
                                            <option value="{{ $i + 12 }}:00"
                                                @if ($i . ':00 PM' == $horario->afternoon_end) selected @endif>
                                                {{ $i }}:00 PM</option>
                                            <option value="{{ $i + 12 }}:30"
                                                @if ($i . ':30 PM' == $horario->afternoon_end) selected @endif>
                                                {{ $i }}:30 PM</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <div class="mt-4 flex justify-end">
            <button type="submit"
                class="py-3 px-5 text-sm font-medium text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Guardar cambios
            </button>
        </div>
        </form>
    </div>


@endsection
