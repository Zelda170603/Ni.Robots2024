@extends('Administracion.index')

@section('title', __('Update Book'))

@section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update') }} Book
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">{{ __('Update') }} Book</h1>
                            <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Update existing {{ __('Book') }}.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a href="{{ route('books.index') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-gray-600 dark:hover:bg-gray-700 dark:text-white">Back</a>
                        </div>
                    </div>

                    <div class="flow-root mt-8">
                        <div class="max-w-xl py-2 align-middle">
                            <form method="POST" action="{{ route('books.update', $book->id) }}" role="form" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                @include('book.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
