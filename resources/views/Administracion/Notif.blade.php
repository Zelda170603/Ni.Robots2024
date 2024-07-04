<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-800 mx-auto">
    @include('index.nav-bar')
    <main class="p-4 sm:ml-64 mt-14">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="container mx-auto mt-5">
                    <h1 class="text-2xl font-bold mb-4">Send Message to All Users</h1>
            
                    @if (session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
            
                    <form action="{{ route('send-notification.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea id="message" name="message" rows="4" class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                        </div>
                        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded-md">Send Message</button>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Send Notification') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('notifications.send') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('User') }}</label>
    
                                <div class="col-md-6">
                                    <select id="user_id" class="form-control @error('user_id') is-invalid @enderror" name="user_id" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
    
                                    @error('user_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="message" class="col-md-4 col-form-label text-md-end">{{ __('Message') }}</label>
    
                                <div class="col-md-6">
                                    <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required></textarea>
    
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Notification') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @vite('resources/js/dark-mode.js')
</body>
</html>