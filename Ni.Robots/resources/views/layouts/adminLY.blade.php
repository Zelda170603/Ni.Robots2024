<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administracion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notificaciones.js', 'resources/js/dark-mode.js'])
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    @include('Administracion.nav-bar')

    @switch(auth()->user()->role->role_type)
        @case('fabricante')
            @include('components.aside-fabricante')
        @break

        @case('administrador')
            @include('components.aside-admin')
        @break

        @case('doctor')
            @include('components.aside-doctor')
        @break
        @default
    @endswitch

    <!-- Contenedor principal -->
    <div class="lg:pl-64 pt-20">

        
        <main class="px-4 flex flex-col gap-6">
            <!-- Contenedor centrado y responsive -->
            <div class="max-w-7xl w-full mx-auto">
                @yield('content')
            </div>
        </main>

        @include('components.footer-admin')

        <p class="my-10 text-sm text-center text-gray-500">
            &copy; 2023-2024 <a href="/" class="hover:underline" target="_blank">Ni.Robots.com</a>.
            All rights reserved.
        </p>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejo seguro del sidebar
            const toggleButton = document.getElementById('sidebar_button');
            const sidebar = document.getElementById('sidebar');

            if (toggleButton && sidebar) {
                function toggleSidebar() {
                    sidebar.classList.toggle('-translate-x-full');
                }

                toggleButton.addEventListener('click', toggleSidebar);

                function checkScreenSize() {
                    if (window.innerWidth >= 1024) {
                        sidebar.classList.remove('-translate-x-full');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                    }
                }

                window.addEventListener('load', checkScreenSize);
                window.addEventListener('resize', checkScreenSize);
            }

            console.log('Layout cargado correctamente');
        });
    </script>

    @stack('scripts')
</body>
<script>
(function(){
  const ping = async () => {
    try {
      const res = await fetch('{{ route('session.check') }}', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
      if (res.status === 409) {
        alert('Tu sesión expiró porque iniciaste sesión en otro dispositivo o navegador.');
        location.reload();
      }
    } catch (e) {}
  };
  setInterval(ping, 10000);
})();
</script>

</html>
