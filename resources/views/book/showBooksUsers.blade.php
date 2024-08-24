<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($books as $book)
                <div class="block rounded-lg bg-gray-200 dark:bg-gray-800 shadow-secondary-1">
                    <a href="{{ route('books.visor', $book->id) }}">

                        <img class="rounded-t-lg"
                            src="{{ $book->portada ? asset( $book->portada) : 'https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg' }}"
                            alt="{{ $book->title }}" />
                    </a>
                    <div class="p-6 text-white dark:text-white">
                        <h5 class="mb-2 text-xl font-medium leading-tight">{{ $book->title }}</h5>
                        <p class="mb-4 text-base">
                            {{ $book->descripcion }}
                        </p>
                        <a href="{{ route('books.show', $book->id) }}"
                            class="inline-block rounded bg-primary px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out hover:bg-primary-accent-300 hover:shadow-primary-2 focus:bg-primary-accent-300 focus:shadow-primary-2 focus:outline-none focus:ring-0 active:bg-primary-600 active:shadow-primary-2 dark:shadow-black/30 dark:hover:shadow-dark-strong dark:focus:shadow-dark-strong dark:active:shadow-dark-strong">
                            {{ __('View Details') }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-8 px-4">
                {!! $books->withQueryString()->links() !!}
            </div>
        </div>
    </div>

</body>

</html>
