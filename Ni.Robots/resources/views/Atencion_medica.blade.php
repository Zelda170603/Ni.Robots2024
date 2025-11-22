@extends('layouts.app')

@section('title', 'Atencion medica')

@section('content')
    <!-- Hero -->
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative">
        <!-- Grid -->
        <div class="grid md:grid-cols-2 gap-6 md:gap-8 xl:gap-20 md:items-center">
            <div class="order-2 md:order-1">
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-5xl lg:leading-tight dark:text-white">
                    Mejora tu calidad de vida con <span class="text-blue-600">Nuestro Apoyo</span>
                </h1>
                <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400">
                    Profesionales especializados y centros adaptados para brindar atención integral a personas con
                    discapacidades. Nuestro equipo está dedicado a mejorar tu bienestar.
                </p>

                <!-- Botones -->
                <div class="mt-7 flex flex-col sm:flex-row gap-3 w-full">
                    @auth
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            href="{{ route('view_doctores_user') }}">
                            Consultar Doctores
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            href="{{ route('CentroAtencion.index') }}">
                            Ver Centros de Atención
                        </a>
                    @else
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            href="{{ route('register') }}">
                            Registrarse como Paciente
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            href="{{ route('login') }}">
                            Iniciar Sesión
                        </a>
                    @endauth
                </div>

                <div class="mt-6 lg:mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-5">
                    <div class="text-center sm:text-left py-3 sm:py-5">
                        <p class="text-sm text-gray-800 dark:text-neutral-200">
                            <span class="font-bold text-xl text-blue-600 block">300 +</span> 
                            médicos especialistas en diversas áreas en toda Nicaragua
                        </p>
                    </div>
                    <div class="text-center sm:text-left py-3 sm:py-5">
                        <p class="text-sm text-gray-800 dark:text-neutral-200">
                            <span class="font-bold text-xl text-blue-600 block">500 +</span> 
                            centros de atención accesibles en toda Nicaragua
                        </p>
                    </div>
                    <div class="text-center sm:text-left py-3 sm:py-5">
                        <p class="text-sm text-gray-800 dark:text-neutral-200">
                            <span class="font-bold text-xl text-blue-600 block">5000 +</span> 
                            personas atendidas y mejoradas sus condiciones de vida
                        </p>
                    </div>
                </div>
            </div>

            <div class="relative order-1 md:order-2">
                <img class="w-full rounded-md"
                    src="https://images.unsplash.com/photo-1665686377065-08ba896d16fd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=700&h=800&q=80"
                    alt="Hero Image">
            </div>
        </div>
        <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6 w-full max-w-[72.1875rem] overflow-hidden" aria-hidden="true">
            <div class="aspect-[1155/678] w-full bg-gradient-to-tr from-[#80a2ff] to-[#9089fc] opacity-30"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Servicios</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">Descubre nuestros servicios especializados para personas con
                discapacidades.</p>
        </div>

        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <!-- Card -->
            <div class="group relative flex flex-col w-full min-h-60 bg-cover bg-center rounded-xl hover:shadow-lg transition"
                style="background-image: url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white">
                        <span class="font-bold">Rehabilitación Física</span> – Terapias personalizadas para mejorar la movilidad y calidad de vida de nuestros pacientes.
                    </h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="group relative flex flex-col w-full min-h-60 bg-cover bg-center rounded-xl hover:shadow-lg transition"
                style="background-image: url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white">
                        <span class="font-bold">Atención Psicológica</span> – Apoyo emocional y psicológico para personas con discapacidades y sus familias.
                    </h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card -->
            <div class="group relative flex flex-col w-full min-h-60 bg-cover bg-center rounded-xl hover:shadow-lg transition"
                style="background-image: url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white">
                        <span class="font-bold">Centros de Atención Especializada</span> – Acceso a instalaciones equipadas para brindar el mejor cuidado a personas con discapacidades.
                    </h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Registration Benefits Section -->
    @guest
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 lg:items-center">
            <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
                <img class="w-full object-cover rounded-xl"
                    src="https://images.unsplash.com/photo-1587614203976-365c74645e83?q=80&w=480&h=600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Imagen de Beneficios de Registro">
            </div>

            <div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold md:text-3xl md:leading-tight dark:text-white">¡Regístrate y accede a más beneficios!</h2>
                    <p class="mt-3 text-gray-600 dark:text-neutral-400">
                        Al registrarte como paciente en nuestra plataforma, tendrás acceso exclusivo a una atención
                        personalizada, recursos especializados y un seguimiento continuo de tu salud.
                    </p>
                </div>

                <!-- Steps -->
                <div class="space-y-6">
                    <!-- Step 1 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="flex justify-center items-center size-8 border border-gray-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-sm rounded-full">
                                1
                            </span>
                        </div>
                        <div class="grow">
                            <p class="text-gray-700 dark:text-neutral-300">
                                <span class="font-semibold text-blue-600 dark:text-blue-400">Creación de Perfil Personalizado:</span>
                                Al registrarte, podrás crear un perfil de paciente donde se almacenará tu información médica de manera segura.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="flex justify-center items-center size-8 border border-gray-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-sm rounded-full">
                                2
                            </span>
                        </div>
                        <div class="grow">
                            <p class="text-gray-700 dark:text-neutral-300">
                                <span class="font-semibold text-blue-600 dark:text-blue-400">Acceso a Diagnósticos y Tratamientos:</span>
                                Obtén recomendaciones personalizadas de diagnóstico y tratamiento en función de tu perfil.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="flex justify-center items-center size-8 border border-gray-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-sm rounded-full">
                                3
                            </span>
                        </div>
                        <div class="grow">
                            <p class="text-gray-700 dark:text-neutral-300">
                                <span class="font-semibold text-blue-600 dark:text-blue-400">Consulta con Especialistas:</span>
                                Podrás acceder a una red de médicos especializados y solicitar consultas en línea.
                            </p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex gap-4">
                        <div class="flex-shrink-0">
                            <span class="flex justify-center items-center size-8 border border-gray-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-sm rounded-full">
                                4
                            </span>
                        </div>
                        <div class="grow">
                            <p class="text-gray-700 dark:text-neutral-300">
                                <span class="font-semibold text-blue-600 dark:text-blue-400">Seguimiento Continuo:</span>
                                Recibe un seguimiento regular y actualizaciones de tus tratamientos para mantener un control óptimo.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Registration Button -->
                <div class="mt-8">
                    <a class="inline-flex items-center gap-x-2 py-3 px-6 bg-blue-600 font-medium text-sm text-white rounded-lg hover:bg-blue-700 focus:outline-none transition"
                        href="{{ route('register') }}">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                        Regístrate ahora
                    </a>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- For Logged In Users -->
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8">
        <div class="text-center mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Explora Nuestros Servicios</h2>
            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Como usuario registrado, tienes acceso completo a todos nuestros servicios especializados.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Doctors Card -->
            <a class="group relative block rounded-xl overflow-hidden focus:outline-none" href="{{ route('view_doctores_user') }}">
                <div class="relative h-64 sm:h-80 before:absolute before:inset-0 before:bg-gradient-to-t before:from-gray-900/70 before:z-10">
                    <img class="w-full h-full object-cover"
                        src="https://images.unsplash.com/photo-1669828230990-9b8583a877ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                        alt="Health Professionals">
                </div>
                <div class="absolute bottom-0 inset-x-0 z-20 p-6">
                    <h3 class="text-xl sm:text-2xl font-semibold text-white group-hover:text-white/80">
                        Encuentra profesionales de la salud
                    </h3>
                    <p class="mt-2 text-white/80 text-sm sm:text-base">
                        Accede a nuestra red de médicos especializados y agenda tu consulta de forma rápida y sencilla.
                    </p>
                </div>
            </a>

            <!-- Centers Card -->
            <a class="group relative block rounded-xl overflow-hidden focus:outline-none" href="{{ route('CentroAtencion.index') }}">
                <div class="relative h-64 sm:h-80 before:absolute before:inset-0 before:bg-gradient-to-t before:from-gray-900/70 before:z-10">
                    <img class="w-full h-full object-cover"
                        src="https://images.unsplash.com/photo-1611625618313-68b87aaa0626?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                        alt="Geolocalized Care Centers">
                </div>
                <div class="absolute bottom-0 inset-x-0 z-20 p-6">
                    <h3 class="text-xl sm:text-2xl font-semibold text-white group-hover:text-white/80">
                        Centros de atención cercanos
                    </h3>
                    <p class="mt-2 text-white/80 text-sm sm:text-base">
                        Descubre los centros de atención más cercanos a tu ubicación para recibir servicios de salud.
                    </p>
                </div>
            </a>
        </div>
    </div>
    @endguest

    <!-- Additional Features for All Users -->
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
            <!-- Feature 1 -->
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <div class="size-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <svg class="size-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>
                <div class="grow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Atención Confiable</h3>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">
                        Contamos con profesionales certificados y centros de atención avalados para garantizar tu bienestar.
                    </p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex gap-4">
                <div class="flex-shrink-0">
                    <div class="size-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <svg class="size-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <div class="grow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Acceso Rápido</h3>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">
                        Encuentra servicios médicos y profesionales de salud de manera rápida y eficiente.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection