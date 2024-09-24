@extends('layouts.adminLY')

@section('content')
    <div class="col-span-4">
        <div class="mx-auto max-w-4xl lg:px-8 mb-4">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Notificaciones de usuarios</h1>
            <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                Notifica a los usuarios de manera general de forma especifica
            </p>

            @if (session('success'))
                <div class="bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario para enviar mensaje -->
            <form action="{{ route('send-notification.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Escribe un
                        mensaje para todos los usuarios</label>
                    <textarea id="message" name="message" rows="4"
                        class="mt-1 block w-full p-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:text-gray-100 dark:focus:ring-indigo-400"
                        required></textarea>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Send Message
                </button>
            </form>
            <p class="mt-2 text-md text-gray-500 dark:text-gray-400">
                Notifica a los usuarios de manera general de forma especifica
            </p>
            <form method="POST" action="{{ route('notifications.send') }}" class="space-y-4">
                @csrf

                <div>


                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                    <select id="user_id"
                        class="mt-1 block w-full p-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100 dark:focus:ring-indigo-400"
                        name="user_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="text-red-600 text-sm dark:text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                    <textarea id="message"
                        class="mt-1 block w-full p-2.5 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:text-gray-100 dark:focus:ring-indigo-400"
                        name="message" required></textarea>

                    @error('message')
                        <span class="text-red-600 text-sm dark:text-red-400" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Send Notification
                </button>
            </form>

        </div>
    </div>
@endsection
