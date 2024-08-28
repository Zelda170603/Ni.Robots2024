@foreach ($books as $book)
    <div class="flex gap-2 my-2">
        <a href="#" class="flex items-center w-20 h-auto object-cover shrink-0">
            <img class="object-cover h-full rounded-lg"
                src="{{ $book->portada ? asset($book->portada) : 'https://tecdn.b-cdn.net/img/new/standard/nature/184.jpg' }}"
                alt="{{ $book->title }}" />
        </a>
        <div href="#" class="flex flex-col items-start font-medium text-gray-900 dark:text-white gap-1 w-full">
            <span class="leading-4 text-base font-bold">
                {{ $book->title }}
            </span>
            <ul class="mt-2 flex flex-col gap-1">
                <li class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ $book->autor->nombre }}
                    </p>
                </li>

                <li class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ $book->editorial->nombre }}
                    </p>
                </li>
            </ul>
        </div>
    </div>
@endforeach
