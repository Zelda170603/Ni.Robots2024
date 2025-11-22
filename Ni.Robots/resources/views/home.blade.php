@extends('layouts.app')

@section('title', 'Ni.Robots')

@section('content')
    <div class="gap-8 py-8 px-4 mx-auto max-w-7xl relative lg:py-4">
        <h1
            class="mb-4 font-extrabold tracking-tight text-3xl md:text-6xl background-text dark-background-text bg-clip-text text-transparent">
            Descubre soluciones innovadoras para mejorar tu calidad de vida</h1>
        <p class="mb-6 font-medium dark:text-gray-400 xl:mb-8 md:text-lg lg:text-lg text-gray-700">
            En nuestra plataforma nos enfocamos en conectar a personas con discapacidades físicas con productos como
            prótesis y ortesis, además de ofrecer acceso a centros de atención médica geolocalizados y la posibilidad de
            contactar con doctores especializados.</p>
        <div class="sm:gap-16 gap-10 flex items-center sm:flex-row flex-col">
            <div class="mb-8 text-gray-500 sm:mb-0 dark:text-gray-400">
                <svg class="mb-3 size-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                        clip-rule="evenodd"></path>
                </svg>
                <h2 class="mb-3 text-lg font-semibold dark:text-gray-100 text-gray-900">
                    14 Octubre 2025</h2>
                <p class="mb-4 font-normal">Únete a nuestra comunidad para descubrir lo último en tecnología médica
                    y cómo nuestros productos pueden mejorar tu movilidad y bienestar.</p>
                <a href="#"
                    class="text-white relative bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Productos Innovadores
                </a>
            </div>
            <div class="mb-8 text-gray-500 sm:mb-0 dark:text-gray-400">
                <svg class="mb-3 size-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z"
                        clip-rule="evenodd"></path>
                </svg>
                <h2 class="mb-3 text-lg font-semibold dark:text-gray-100 text-gray-900">
                    25+ profesionales médicos</h2>
                <p class="mb-4 font-normal">Conéctate con doctores especializados en rehabilitación y ortopedia,
                    quienes te ayudarán a elegir los mejores productos para tu tratamiento y recuperación.</p>
                <a href="#"
                    class="text-white relative bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Contacta a un Doctor
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl py-10 px-4 lg:py-14 mx-auto relative">
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <a class="group flex flex-col focus:outline-none" href="{{ route('productos.index') }}">
                <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
                    <img class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                        src="{{ asset('images/index/header.avif') }}" alt="Blog Image">
                    <span
                        class="absolute top-0 end-0 rounded-se-xl rounded-es-xl text-xs font-medium bg-gray-800 text-white py-1.5 px-3 dark:bg-neutral-900">
                        Recomendado
                    </span>
                </div>

                <div class="mt-7">
                    <h3
                        class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                        Equipos de Asistencia
                    </h3>
                    <p class="mt-3 text-gray-800 dark:text-neutral-200">
                        Encuentra dispositivos y equipos de apoyo diseñados para facilitar tu día a día y mejorar tu calidad
                        de vida.
                    </p>
                    <p
                        class="mt-5 inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline group-focus:underline font-medium dark:text-blue-500">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </p>
                </div>
            </a>

            <a class="group flex flex-col focus:outline-none" href="{{ route('books.index') }}">
                <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
                    <img class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                        src="{{ asset('images/index/libros.webp') }}" alt="Blog Image">
                </div>

                <div class="mt-7">
                    <h3
                        class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                        Libros Educativos
                    </h3>
                    <p class="mt-3 text-gray-800 dark:text-neutral-200">
                        Accede a nuestra colección de libros especialmente seleccionados para mejorar tu comprensión sobre
                        condiciones médicas y cuidados personales.
                    </p>
                    <p
                        class="mt-5 inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline group-focus:underline font-medium dark:text-blue-500">
                        Leer más
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </p>
                </div>
            </a>

            <a class="group relative flex flex-col w-full min-h-60 bg-cover bg-center rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg transition"
                href="{{ route('atencion_medica') }}"
                style="background-image: url('{{ asset('images/index/card3.jpg') }}');">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white"><span class="font-bold">Atención Médica</span>
                        Especializada
                        para personas con discapacidades.</h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div
                        class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70 group-focus:text-white/70">
                        Conoce más
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6 w-full max-w-[72.1875rem] overflow-hidden"
            aria-hidden="true">
            <div class="aspect-[1155/678] w-full bg-gradient-to-tr from-[#80a2ff] to-[#9089fc] opacity-30"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>

    <div class="overflow-hidden py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pr-8 lg:pt-4">
                    <div class="lg:max-w-lg">
                        <h2 class="text-base font-semibold leading-7 text-indigo-500">Accede a productos especializados
                        </h2>
                        <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 dark:text-gray-300 sm:text-4xl">
                            Las mejores soluciones para personas con discapacidad
                        </p>
                        <p class="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
                            Encuentra prótesis, ortesis y dispositivos de asistencia diseñados para mejorar tu calidad de
                            vida. Accede a
                            productos que faciliten tu movilidad y rehabilitación.
                        </p>
                        <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 lg:max-w-none">
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900 dark:text-gray-100">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.5 17a4.5 4.5 0 01-1.44-8.765 4.5 4.5 0 018.302-3.046 3.5 3.5 0 014.504 4.272A4 4 0 0115 17H5.5zm3.75-2.75a.75.75 0 001.5 0V9.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0l-3.25 3.5a.75.75 0 101.1 1.02l1.95-2.1v4.59z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Envío de productos especializado.
                                </dt>
                                <dd class="inline text-gray-900 dark:text-gray-300">Recibe tus dispositivos médicos o de
                                    asistencia en tu domicilio o en tu centro de atención preferido.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900 dark:text-gray-100">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Productos certificados.
                                </dt>
                                <dd class="inline text-gray-900 dark:text-gray-300">Nuestros productos cuentan con
                                    certificaciones internacionales.</dd>
                            </div>
                            <div class="relative pl-9">
                                <dt class="inline font-semibold text-gray-900 dark:text-gray-100">
                                    <svg class="absolute left-1 top-1 h-5 w-5 text-indigo-600" viewBox="0 0 20 20"
                                        fill="currentColor" aria-hidden="true">
                                        <path
                                            d="M4.632 3.533A2 2 0 016.577 2h6.846a2 2 0 011.945 1.533l1.976 8.234A3.489 3.489 0 0016 11.5H4c-.476 0-.93.095-1.344.267l1.976-8.234z" />
                                        <path fill-rule="evenodd"
                                            d="M4 13a2 2 0 100 4h12a2 2 0 100-4H4zm11.24 2a.75.75 0 01.75-.75H16a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75h-.01a.75.75 0 01-.75-.75V15zm-2.25-.75a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75H13a.75.75 0 00.75-.75V15a.75.75 0 00-.75-.75h-.01z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Asesoría especializada.
                                </dt>
                                <dd class="inline text-gray-900 dark:text-gray-300">Nuestro equipo te ayuda a elegir el
                                    equipo adecuado.</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <img src="{{ asset('images/index/image5.avif') }}" alt="image"
                    class="w-full max-w-full rounded-xl shadow-xl ring-1 ring-gray-400/10 md:w-[48rem] lg:w-[57rem] mx-auto">
            </div>
        </div>
    </div>

    @guest
        <div class="max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div class="md:grid md:grid-cols-2 md:items-center md:gap-12 xl:gap-32">
                <div>
                    <img class="rounded-xl w-full"
                        src="https://images.unsplash.com/photo-1648737963503-1a26da876aca?auto=format&fit=crop&w=900&h=900&q=80"
                        alt="Features Image">
                </div>
                <div class="mt-5 sm:mt-10 lg:mt-0">
                    <div class="space-y-6 sm:space-y-8">
                        <div class="space-y-2 md:space-y-4">
                            <h2 class="font-bold text-3xl lg:text-4xl text-gray-800 dark:text-neutral-200">
                                Únete a nuestra red de médicos
                            </h2>
                            <p class="text-gray-500 dark:text-neutral-500">
                                Regístrate y conecta con pacientes que necesitan especialistas.
                            </p>
                        </div>
                        <ul class="space-y-2 sm:space-y-4">
                            <li class="flex gap-x-3">
                                <span
                                    class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                </span>
                                <div class="grow">
                                    <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                                        Proceso de registro rápido
                                    </span>
                                </div>
                            </li>
                            <li class="flex gap-x-3">
                                <span
                                    class="mt-0.5 size-5 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-800/30 dark:text-blue-500">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12" />
                                    </svg>
                                </span>
                                <div class="grow">
                                    <span class="text-sm sm:text-base text-gray-500 dark:text-neutral-500">
                                        Herramientas para gestión de pacientes
                                    </span>
                                </div>
                            </li>
                        </ul>
                        <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-blue-800 font-medium text-sm text-gray-200 rounded-full focus:outline-none"
                            href="{{ route('register_doctor') }}">
                            Registrarse como Médico
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endguest

    @auth
        <div id="productos-interes" class="py-4 pb-8">
            <h1 class="text-3xl font-bold text-gray-900 sm:text-2xl dark:text-white mb-6">
                Productos que te puedan interesar
            </h1>
            <swiper-container class="mySwiper pb-6" pagination-clickable="true"
                breakpoints='{
                    "640": { "slidesPerView": 1, "spaceBetween": 10 },
                    "768": { "slidesPerView": 2, "spaceBetween": 20 },
                    "1024": { "slidesPerView": 3, "spaceBetween": 30 }
                }'>
                {!! $productCardView !!}
            </swiper-container>
        </div>

        <div class="py-4 pb-8">
            <h1 class="text-3xl font-bold text-gray-900 sm:text-2xl dark:text-white mb-6">
                Libros mejor calificados
            </h1>
            <swiper-container class="mySwiper" pagination-clickable="true"
                breakpoints='{
                    "640": { "slidesPerView": 1, "spaceBetween": 10 },
                    "768": { "slidesPerView": 2, "spaceBetween": 20 },
                    "1024": { "slidesPerView": 3, "spaceBetween": 30 }
                }'>
                {!! $bookCardMejorCalificados !!}
            </swiper-container>
        </div>
    @endauth

    @include('Index.chatbot')
@endsection

<script>
(function () {
    // imagen de prótesis que PASASTE
    const FALLBACK = "https://www.ortossur.com/wp-content/uploads/2018/05/der.png";

    function applyFallbackToSection() {
        const section = document.getElementById('productos-interes');
        if (!section) return;

        const imgs = section.querySelectorAll('img');

        imgs.forEach(function (img) {
            // si viene sin src -> prótesis
            if (!img.getAttribute('src') || img.getAttribute('src').trim() === '') {
                img.setAttribute('src', FALLBACK);
            }

            // si falla -> prótesis
            img.onerror = function () {
                if (this.src !== FALLBACK) {
                    this.src = FALLBACK;
                }
            };
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        applyFallbackToSection();

        // por si el swiper inyecta slides después
        let tries = 0;
        const interval = setInterval(function () {
            applyFallbackToSection();
            tries++;
            if (tries > 15) {
                clearInterval(interval);
            }
        }, 800);
    });
})();
</script>
