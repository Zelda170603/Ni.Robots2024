@extends('layouts.app')

@section('title', 'Atencion medica')

@section('content')
    <!-- Hero -->
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative">
        <!-- Grid -->
        <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
            <div>
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                    Mejora tu calidad de vida con <span class="text-blue-600">Nuestro Apoyo</span>
                </h1>
                <p class="mt-3 text-lg text-gray-800 dark:text-neutral-400">
                    Profesionales especializados y centros adaptados para brindar atención integral a personas con
                    discapacidades. Nuestro equipo está dedicado a mejorar tu bienestar.
                </p>

                <!-- Botones -->
                <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        href="#">
                        Solicita una consulta
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                    <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                        href="#">
                        Únete a nuestro equipo
                    </a>
                </div>

                <div class="mt-6 lg:mt-10 grid grid-cols-3 gap-x-5">
                    <div class="py-5">
                        <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200">
                            <span class="font-bold text-xl text-blue-600">300 +</span> <br> médicos especialistas en
                            diversas áreas en toda Nicaragua
                        </p>
                    </div>
                    <div class="py-5">
                        <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200">
                            <span class="font-bold text-xl text-blue-600">500 +</span> <br> centros de atención accesibles
                            en toda Nicaragua
                        </p>
                    </div>
                    <div class="py-5">
                        <p class="mt-3 text-sm text-gray-800 dark:text-neutral-200">
                            <span class="font-bold dark text-xl text-blue-600">5000 + </span> <br>personas atendidas y
                            mejoradas sus condiciones de vida
                        </p>
                    </div>
                </div>
            </div>


            <div class="relative ms-4">
                <img class="w-full rounded-md"
                    src="https://images.unsplash.com/photo-1665686377065-08ba896d16fd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=700&h=800&q=80"
                    alt="Hero Image">
            </div>
            <!-- End Col -->
        </div>
        <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#80a2ff] to-[#9089fc] opacity-30"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <!-- End Grid -->
    </div>
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Servicios</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">Descubre nuestros servicios especializados para personas con
                discapacidades.</p>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Card -->
            <a class="group relative flex flex-col w-full min-h-60 bg-[url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')] bg-center bg-cover rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg transition"
                href="#">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white"><span class="font-bold">Rehabilitación
                            Física</span> – Terapias personalizadas para mejorar la movilidad y calidad de vida de nuestros
                        pacientes.</h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div
                        class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70 group-focus:text-white/70">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- End Card -->

            <!-- Card -->
            <a class="group relative flex flex-col w-full min-h-60 bg-[url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8MHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')] bg-center bg-cover rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg transition"
                href="#">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white"><span class="font-bold">Atención
                            Psicológica</span> – Apoyo emocional y psicológico para personas con discapacidades y sus
                        familias.</h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div
                        class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70 group-focus:text-white/70">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- End Card -->

            <!-- Card -->
            <a class="group relative flex flex-col w-full min-h-60 bg-[url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')] bg-center bg-cover rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg transition"
                href="#">
                <div class="flex-auto p-4 md:p-6">
                    <h3 class="text-xl text-white/90 group-hover:text-white"><span class="font-bold">Centros de Atención
                            Especializada</span> – Acceso a instalaciones equipadas para brindar el mejor cuidado a personas
                        con discapacidades.</h3>
                </div>
                <div class="pt-0 p-4 md:p-6">
                    <div
                        class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70 group-focus:text-white/70">
                        Más información
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </div>
                </div>
            </a>
            <!-- End Card -->
        </div>
        <!-- Approach -->
        
    </div>
    <div class="max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative">
        <!-- Title -->
        <div class="mb-10 lg:mb-14">
            <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">¡Regístrate y accede a más
                beneficios!</h2>
            <p class="mt-1 text-neutral-400">
                Al registrarte como paciente en nuestra plataforma, tendrás acceso exclusivo a una atención
                personalizada, recursos especializados y un seguimiento continuo de tu salud. Aprovecha todas las
                herramientas que Nirobots tiene para ofrecerte y mejora tu calidad de vida hoy mismo.
            </p>
        </div>

        <!-- End Title -->

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 lg:items-center relative">
            
            <div class="aspect-w-16 aspect-h-9 lg:aspect-none">
                <img class="w-full object-cover rounded-xl"
                    src="https://images.unsplash.com/photo-1587614203976-365c74645e83?q=80&w=480&h=600&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Imagen de Beneficios de Registro">
            </div>
            <!-- Columna Derecha -->
            <div>
                <!-- Encabezado -->
                <div class="mb-4">
                    <h3 class="text-blue-700 dark:text-blue-300 text-lg font-medium uppercase">
                        Pasos para Registrarse en Nirobots
                    </h3>
                </div>
                <!-- Fin Encabezado -->

                <!-- Primer Paso -->
                <div class="flex gap-x-5 ms-1">
                    <!-- Ícono -->
                    <div
                        class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800 dark:after:bg-gray-200">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span
                                class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-xs uppercase rounded-full">
                                1
                            </span>
                        </div>
                    </div>
                    <!-- Fin Ícono -->

                    <!-- Contenido Derecho -->
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm lg:text-base  font-medium  dark:text-neutral-400 text-neutral-700 ">
                            <span class="dark:text-blue-300 text-blue-700 ">Creación de Perfil Personalizado:</span>
                            Al registrarte, podrás crear un perfil de paciente donde se almacenará tu información médica
                            de manera segura y confidencial.
                        </p>
                    </div>
                    <!-- Fin Contenido Derecho -->
                </div>
                <!-- Fin Primer Paso -->

                <!-- Segundo Paso -->
                <div class="flex gap-x-5 ms-1">
                    <div
                        class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800 dark:after:bg-gray-200">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span
                                class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-xs uppercase rounded-full">
                                2
                            </span>
                        </div>
                    </div>
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm lg:text-base font-medium dark:text-neutral-400 text-neutral-700">
                            <span class="dark:text-blue-300 text-blue-700">Acceso a Diagnósticos y Tratamientos:</span>
                            Obtén recomendaciones personalizadas de diagnóstico y tratamiento en función de tu perfil y
                            condición médica.
                        </p>
                    </div>
                </div>
                <!-- Fin Segundo Paso -->

                <!-- Tercer Paso -->
                <div class="flex gap-x-5 ms-1">
                    <div
                        class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800 dark:after:bg-gray-200">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span
                                class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-xs uppercase rounded-full">
                                3
                            </span>
                        </div>
                    </div>
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm md:text-base font-medium dark:text-neutral-400 text-neutral-700">
                            <span class="dark:text-blue-300 text-blue-700">Consulta con Especialistas:</span>
                            Podrás acceder a una red de médicos especializados y solicitar consultas en línea de manera
                            fácil y rápida.
                        </p>
                    </div>
                </div>
                <!-- Fin Tercer Paso -->

                <!-- Cuarto Paso -->
                <div class="flex gap-x-5 ms-1">
                    <div
                        class="relative last:after:hidden after:absolute after:top-8 after:bottom-0 after:start-4 after:w-px after:-translate-x-[0.5px] after:bg-neutral-800 dark:after:bg-gray-200">
                        <div class="relative z-10 size-8 flex justify-center items-center">
                            <span
                                class="flex shrink-0 justify-center items-center size-8 border border-neutral-800 dark:border-gray-200 text-blue-800 dark:text-gray-200 font-semibold text-xs uppercase rounded-full">
                                4
                            </span>
                        </div>
                    </div>
                    <div class="grow pt-0.5 pb-8 sm:pb-12">
                        <p class="text-sm md:text-base font-medium dark:text-neutral-400 text-neutral-700">
                            <span class="dark:text-blue-300 text-blue-700">Seguimiento Continuo:</span>
                            Recibe un seguimiento regular y actualizaciones de tus tratamientos para mantener un control
                            óptimo de tu salud.
                        </p>
                    </div>
                </div>
                <!-- Fin Cuarto Paso -->

                <!-- Botón de Registro -->
                <a class="group inline-flex items-center gap-x-2 py-2 px-3 bg-blue-700 font-medium text-sm text-gray-200 rounded-full focus:outline-none"
                    href="{{route("create_patient")}}">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                        <path
                            class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 group-hover:delay-100 transition"
                            d="M14.05 2a9 9 0 0 1 8 7.94"></path>
                        <path class="opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition"
                            d="M14.05 6A5 5 0 0 1 18 10"></path>
                    </svg>
                    Regístrate ahora
                </a>
                <!-- Fin Botón de Registro -->
            </div>

            <div class="absolute left-1/2 top-0 -z-10 -translate-x-1/2 blur-3xl xl:-top-6" aria-hidden="true">
                <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#80a2ff] to-[#9089fc] opacity-30"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>


    </div>
    <div class=" max-w-[85rem] mx-auto px-4 mb-8 sm:px-6 lg:px-8 relative  grid lg:grid-cols-2 gap-6">
        <div class="lg:col-span-2 lg:mb-14">
            <h2 class="text-white font-semibold text-2xl md:text-4xl md:leading-tight">¡Regístrate y accede a más
                beneficios!</h2>
            <p class="mt-1 text-neutral-400">
                Al registrarte como paciente en nuestra plataforma, tendrás acceso exclusivo a una atención
                personalizada, recursos especializados y un seguimiento continuo de tu salud. Aprovecha todas las
                herramientas que Nirobots tiene para ofrecerte y mejora tu calidad de vida hoy mismo.
            </p>
        </div>
        <!-- Card -->
        <a class="group relative block rounded-xl focus:outline-none" href="{{route("view_doctores_user")}}">
            <div
                class="shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">
                <img class="size-full absolute top-0 start-0 object-cover"
                    src="https://images.unsplash.com/photo-1669828230990-9b8583a877ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                    alt="Health Professionals">
            </div>
            <div class="absolute bottom-0 inset-x-0 z-10">
                <div class="flex flex-col h-full p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/80 group-focus:text-white/80">
                        Encuentra profesionales de la salud y agenda tu consulta
                    </h3>
                    <p class="mt-2 text-white/80">
                        Accede a una lista de expertos médicos y selecciona el profesional que mejor se adapte a tus necesidades para agendar una consulta de forma rápida y sencilla.
                    </p>
                </div>
            </div>
        </a>
        
        <!-- End Card -->

        <!-- Card -->
        <a class="group relative block rounded-xl focus:outline-none" href="{{route("CentroAtencion.index")}}">
            <div
                class="shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">
                <img class="size-full absolute top-0 start-0 object-cover"
                    src="https://images.unsplash.com/photo-1611625618313-68b87aaa0626?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
                    alt="Geolocalized Care Centers">
            </div>
            <div class="absolute bottom-0 inset-x-0 z-10">
                <div class="flex flex-col h-full p-4 sm:p-6">
                    <h3
                        class="text-lg sm:text-3xl font-semibold text-white group-hover:text-white/80 group-focus:text-white/80">
                        Encuentra centros de atención geolocalizados
                    </h3>
                    <p class="mt-2 text-white/80">
                        Descubre los centros de atención más cercanos a tu ubicación para recibir servicios de salud de manera eficiente y rápida.
                    </p>
                </div>
            </div>
        </a>
        
        <!-- End Card -->
    </div>

@endsection
