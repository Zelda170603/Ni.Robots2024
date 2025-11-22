@extends('layouts.adminLY')

@section('title', 'Editar Autor')

@section('content')
    <div class="col-span-4">
        <h1 class="text-2xl font-bold mb-4 dark:text-gray-200">Editar Autor: {{ $autore->nombre }} {{ $autore->apellido }}</h1>
        
        <form action="{{ route('autores.update', $autore->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('autore.form', ['autore' => $autore])

            <!-- Botones -->
            <div class="flex justify-end mt-6 gap-4">
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-700">
                    Actualizar
                </button>
                <a href="{{ route('autores.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-gray-400">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
