<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Administracion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/notificaciones.js', 'resources/js/dark-mode.js'])
    @vite([ 'resources/js/chart.js'])
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    

    @include("Administracion.nav-bar")
    
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
    
    @include("components.aside-admin")
    
    <div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop"></div>
      
      <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
        <main>
          <div class="px-4 pt-6">
            <div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3">
                @yield('content')
                
             </div>
        </main>

        @include("components.footer-admin")
        
        <p class="my-10 text-sm text-center text-gray-500">
            &copy; 2019-2023 <a href="https://flowbite.com/" class="hover:underline" target="_blank">Flowbite.com</a>. All rights reserved.
        </p>
       
      </div>
    
    </div>
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
        
       </body>

</html>
