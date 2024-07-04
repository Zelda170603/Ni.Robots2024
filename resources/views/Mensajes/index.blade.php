<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mensajes</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white dark:bg-gray-800 mx-auto">

    @include('Index.nav-bar')
    <main class="flex  h-screen overflow-hidden pt-14 ">
        <!-- user list section -->
        <section
            class=" bg-inherit px-4 pt-4  lg:w-80 w-full  lg:border-r border-r-slate-200 dark:border-r-slate-500 flex flex-col h-screen">
            <div class="text-slate-600 dark:text-white max-w-sm  pb-6">
                <h1 class="text-3xl font-bold">Mensajes</h1>
            </div>
            <div class="flex items-center w-full pb-6">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-6 h-6 text-slate-700 dark:text-gray-50" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search-bar"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Buscar a un usuario..." required />
                </div>
            </div>
            <!-- lista de chats -->
            <div id="contact-list" class="flex-1 overflow-y-auto no-scrollbar">
            </div>
        </section>
        <!--main chat area-->
        <section class="bg-inherit hidden  lg:flex flex-1 items-center justify-center">
            <div class="text-slate-600 dark:text-white max-w-sm  pb-6">
                <h1 class="text-3xl font-bold">Selecciona un usuario de la lista para conversar</h1>
            </div>
        </section>
    </main>
    @vite('resources/js/dark-mode.js')
    @vite('resources/js/Mensajes/contactos_search.js')
    @vite('resources/js/notificaciones.js')
    <script>
        function MarkAsRead(notificationId) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "/notifications/mark-as-read", true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Notificación marcada como leída');
                    } else {
                        console.error('Request failed with status:', xhr.status);
                    }
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            xhr.send(JSON.stringify({
                id: notificationId
            }));
        }

        function DeleteNotification(notificationId) {
            console.log();
            let xhr = new XMLHttpRequest();
            xhr.open("DELETE", `/notifications/${notificationId}`, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Notificación eliminada');
                    } else {
                        console.error('Request failed with status:', xhr.status);
                    }
                }
            };
            xhr.onerror = function() {
                console.error('Request failed');
            };
            xhr.send();
        }
    </script>

</body>

</html>
