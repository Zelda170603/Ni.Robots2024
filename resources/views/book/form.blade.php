@extends('Administracion.index')

@section('title', 'Crear Libro')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4 dark:text-gray-200">Libro</h1>
    <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <x-input-label for="autor_id" :value="__('Autor Id')" class="dark:text-gray-200"/>
            <select name="autor_id" id="autor_id" class="mt-1 block w-full form-control dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600{{ $errors->has('autor_id') ? ' is-invalid' : '' }}">
                <option value="" class="dark:text-gray-200">Selecciona un autor</option>
                @foreach($autores as $id => $nombre)
                    <option value="{{ $id }}" {{ old('autor_id', $book ? $book->autor_id : '') == $id ? 'selected' : '' }} class="dark:text-gray-200">{{ $nombre }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('autor_id')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="editorial_id" :value="__('Editorial Id')" class="dark:text-gray-200"/>
            <select name="editorial_id" id="editorial_id" class="mt-1 block w-full form-select dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600{{ $errors->has('editorial_id') ? ' border-red-500' : '' }}">
                <option value="" class="dark:text-gray-200">Selecciona una editorial</option>
                @foreach($editoriales as $id => $nombre)
                    <option value="{{ $id }}" {{ old('editorial_id', $book ? $book->editorial_id : '') == $id ? 'selected' : '' }} class="dark:text-gray-200">{{ $nombre }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('editorial_id')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="title" :value="__('Title')" class="dark:text-gray-200"/>
            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" :value="old('title', $book?->title)" autocomplete="title" placeholder="Title"/>
            <x-input-error class="mt-2" :messages="$errors->get('title')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="file_url" :value="__('File Url')" class="dark:text-gray-200"/>
            <input id="file_url" name="file_url" type="file" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
            <x-input-error class="mt-2" :messages="$errors->get('file_url')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="portada" :value="__('Portada')" class="dark:text-gray-200"/>
            <input id="portada" name="portada" type="file" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
            <x-input-error class="mt-2" :messages="$errors->get('portada')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="descripcion" :value="__('Descripcion')" class="dark:text-gray-200"/>
            <x-text-input id="descripcion" name="descripcion" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" :value="old('descripcion', $book?->descripcion)" autocomplete="descripcion" placeholder="Descripcion"/>
            <x-input-error class="mt-2" :messages="$errors->get('descripcion')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="fecha_publicacion" :value="__('Fecha Publicacion')" class="dark:text-gray-200"/>
            <x-text-input id="fecha_publicacion" name="fecha_publicacion" type="date" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" :value="old('fecha_publicacion', $book?->fecha_publicacion)" autocomplete="fecha_publicacion"/>
            <x-input-error class="mt-2" :messages="$errors->get('fecha_publicacion')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="isbn" :value="__('Isbn')" class="dark:text-gray-200"/>
            <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" :value="old('isbn', $book?->isbn)" autocomplete="isbn" placeholder="Isbn"/>
            <x-input-error class="mt-2" :messages="$errors->get('isbn')"/>
        </div>
        <div class="mb-4">
            <x-input-label for="paginas" :value="__('Paginas')" class="dark:text-gray-200"/>
            <x-text-input id="paginas" name="paginas" type="text" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600" :value="old('paginas', $book?->paginas)" autocomplete="paginas" placeholder="Paginas"/>
            <x-input-error class="mt-2" :messages="$errors->get('paginas')"/>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>Submit</x-primary-button>
        </div>
    </form>
</div>
@endsection
