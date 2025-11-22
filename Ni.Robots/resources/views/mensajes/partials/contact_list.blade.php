<a class="flex items-center space-x-4 py-2 px-1 rounded-md last-of-type:pb-0 hover:bg-slate-200 dark:hover:bg-slate-600" href="/mensajes/{{ $user->name }}/{{ $user->id }}">
    <div class="flex-shrink-0 relative">
        <img class="w-12 h-12 object-cover rounded-full" src="{{ Storage::url('images/profile_pictures/' . $user->profile_picture) }}" alt="">
        <div class="absolute before:w-3 before:h-3 rounded-full bottom-1 right-1 {{ $estado }}"></div>
    </div>
    <div class="flex-1 min-w-0">
        <div class="flex justify-between">
            <p class="text-xl lg:text-base font-semibold lg:font-medium text-gray-800 truncate dark:text-white">{{ $user->name }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $horaMensaje }}</p>
        </div>
        <p class="text-base lg:text-sm text-gray-500 truncate dark:text-gray-400">{{ $mensajeMostrar ?? 'Sin mensajes' }}</p>
        
        <!-- Mostrar información de la próxima cita si está disponible -->
        @if(isset($nextAppointmentInfo) && $nextAppointmentInfo)
            <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                Próxima cita: {{ \Carbon\Carbon::parse($nextAppointmentInfo['date'])->format('d/m/Y') }} 
                a las {{ \Carbon\Carbon::parse($nextAppointmentInfo['time'])->format('H:i') }}
                ({{ $nextAppointmentInfo['status'] }})
            </p>
        @endif
    </div>
</a>