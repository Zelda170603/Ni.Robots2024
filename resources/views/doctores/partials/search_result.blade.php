@foreach ($doctores as $doctor)
    <a href="" class="flex gap-2 my-2">
        <div class="flex items-center aspect-square w-16 h-16 shrink-0">
            <img class="hidden h-auto w-full max-h-full dark:block" src="" alt="imac image" />
        </div>
        <div href="#" class="flex flex-col items-start font-medium text-gray-900 gap-1 dark:text-gray-200 w-full">
            <div class="flex flex-col gap-1">
                <span class="leading-4 text-medium font-bold">
                    {{ $doctor->name }}
                </span>
                <span class="text-sm font-bold leading-4 text-gray-400">
                    {{ $doctor->doctor->especialidad }}
                </span>
            </div>
            <div class="flex justify-items-start items-center gap-2 mt-2 ">
                <svg class="size-3 text-gray-800 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                </svg>
                <span class="text-gray-600 text-sm dark:text-gray-400">{{ $doctor->departamento }},
                    {{ $doctor->municipio }}</span>
            </div>
        </div>
    </a>
@endforeach
