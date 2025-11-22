@extends('layouts.adminLY')

@section('content')
    <div class="col-span-4">
        <div class="mx-auto max-w-7xl lg:px-8 mb-4">
            <div class="mx-auto lg:max-w-4xl lg:px-0">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Comentarios de los compradores</h1>
                <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                    A tomarlo con calma, los comentarios ayudan a mejorar.
                </p>
            </div>
        </div>
        <div class="mx-auto w-full flex-none lg:max-w-4xl xl:max-w-7xl">

            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div
                        class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-900 dark:border-neutral-700">
                        <!-- Header -->
                        <!-- Table -->
                        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Product</span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Reviewer</span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Review</span>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-start">
                                        <div class="flex items-center gap-x-2">
                                            <span
                                                class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">Date</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($reviews as $review)
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-800">
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="#">
                                                <div class="flex items-center gap-x-4">
                                                    <img class="shrink-0 size-[38px] rounded-lg"
                                                        src="{{ Storage::url('images/productos/' . $review['producto']->foto_prod) }}"
                                                        alt="Product Image">
                                                    <div>
                                                        <span
                                                            class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $review['producto']->nombre_prod }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="#">
                                                <div class="flex items-center gap-x-3">
                                                    <img class="inline-block size-[38px] rounded-full"
                                                        src="{{ Storage::url('images/profile_pictures/' . $review['buyer']->profile_picture) }}"
                                                        alt="Reviewer Image">
                                                    <div class="grow">
                                                        <span
                                                            class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $review['buyer']->name }}</span>
                                                        <span
                                                            class="block text-sm text-gray-500 dark:text-neutral-500">{{ $review['buyer']->email }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="h-px w-72 min-w-72 align-top">
                                            <a class="block p-6" href="#">
                                                <div class="flex gap-x-1 mb-2">
                                                    @for ($i = 0; $i < $review['calificacion']->puntuacion; $i++)
                                                        <svg class="shrink-0 size-3 text-gray-800 dark:text-neutral-200"
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" viewBox="0 0 16 16">
                                                            <path
                                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="block text-sm text-gray-500 dark:text-neutral-500">
                                                    <p> {{ $review['calificacion']->comentario }}</p>
                                                </span>
                                            </a>
                                        </td>
                                        <td class="size-px whitespace-nowrap align-top">
                                            <a class="block p-6" href="#">
                                                <span class="text-sm text-gray-600 dark:text-neutral-400">
                                                    {{ \Carbon\Carbon::parse($review['calificacion']->created_at)->format('d/m/Y H:i') }}
                                                </span>
                                                
                                              
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Card -->
    </div>
@endsection
