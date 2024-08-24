@extends('Administracion.index')

@section('title', __('Books'))

@section('content')

<div class="py-12">
    <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg dark:bg-gray-800">
            <div class="w-full">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Books') }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">A list of all the {{ __('Books') }}.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('books.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new</a>
                    </div>
                </div>

                <div class="flow-root mt-8 overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <table class="w-full divide-y divide-gray-300 dark:divide-gray-600">
                            <thead class="bg-gray-200 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">No</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Title</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">File Url</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Autor Id</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Editorial Id</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Portada</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Descripcion</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Fecha Publicacion</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Isbn</th>
                                    <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300">Paginas</th>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-300"></th>
                                </tr>
                            </thead>
                            <tbody class="dark:divide-gray-600">
                                @foreach ($books as $book)
                                <tr class="{{ $loop->odd ? 'bg-gray-100 dark:bg-gray-800' : 'bg-white dark:bg-gray-700' }}">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900 dark:text-white">{{ ++$i }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->title }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->file_url }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->autor_id }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->editorial_id }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->portada }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->descripcion }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->fecha_publicacion }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->isbn }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 dark:text-white">{{ $book->paginas }}</td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-white">
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                            <a href="{{ route('books.show', $book->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>
                                            <a href="{{ route('books.edit', $book->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a>
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('books.destroy', $book->id) }}" class="text-red-600 font-bold hover:text-red-900" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;">{{ __('Delete') }}</a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4 px-4">
                            {!! $books->withQueryString()->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
