<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Centro de Atención</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('Index.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <section class="text-gray-400 bg-gray-900 body-font relative">
            <div class="container px-5 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
                <div class="lg:w-2/3 md:w-1/2 bg-gray-900 rounded-lg overflow-hidden sm:mr-10 p-10 flex items-end justify-start relative">
                    <div id="map" class="w-full h-full absolute inset-0"></div>
                    <div class="bg-gray-900 relative flex flex-wrap py-6 rounded shadow-md">
                        <div class="lg:w-1/2 px-6">
                            <h2 class="title-font font-semibold text-white tracking-widest text-xs">ADDRESS</h2>
                            <p class="mt-1">Photo booth tattooed prism, Portland taiyaki hoodie neutra typewriter</p>
                        </div>
                        <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                            <h2 class="title-font font-semibold text-white tracking-widest text-xs">EMAIL</h2>
                            <a class="text-indigo-400 leading-relaxed">{{ $centro->correo }}</a>
                            <h2 class="title-font font-semibold text-white tracking-widest text-xs mt-4">PHONE</h2>
                            <p class="leading-relaxed">{{ $centro->telefono }}</p>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/3 md:w-1/2 flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                    <h2 class="text-white text-lg mb-1 font-medium title-font">Feedback</h2>
                    <p class="leading-relaxed mb-5">Post-ironic Portland shabby chic echo park, banjo fashion axe</p>
                    <div class="relative mb-4">
                        <label for="name" class="leading-7 text-sm text-gray-400">Name</label>
                        <input type="text" id="name" name="name"
                            class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="email" class="leading-7 text-sm text-gray-400">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 text-base outline-none text-gray-100 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <div class="relative mb-4">
                        <label for="message" class="leading-7 text-sm text-gray-400">Message</label>
                        <textarea id="message" name="message"
                            class="w-full bg-gray-800 rounded border border-gray-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-900 h-32 text-base outline-none text-gray-100 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                    </div>
                    <button
                        class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
                    <p class="text-xs text-gray-400 text-opacity-90 mt-3">Chicharrones blog helvetica normcore iceland
                        tousled brook viral artisan.</p>
                </div>
            </div>
        </section>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/notificaciones.js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_YZ_TU27pADC0ThLH7U5QvSgG42fsuv8&callback=initMap" async defer></script>
    <script>
        function initMap() {
            // Obtener las coordenadas desde el servidor en el formato lat,lng
            const gMaps = '{{ $centro->google_map_direction }}';
            const coordinates = gMaps.split(',').map(Number);

            // Crear el mapa
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: { lat: coordinates[0], lng: coordinates[1] },
                styles: [
                    {
                        "stylers": [
                            { "grayscale": 1 },
                            { "contrast": 1.2 },
                            { "opacity": 0.16 }
                        ]
                    }
                ]
            });

            // Añadir un marcador en las coordenadas
            new google.maps.Marker({
                position: { lat: coordinates[0], lng: coordinates[1] },
                map: map
            });
        }
    </script>
</body>

</html>

