<div class="flex gap-1">
    <img class="w-8 h-8 object-cover rounded-full" 
         src="{{ $user && $user->profile_picture ? Storage::url('images/profile_pictures/' . $user->profile_picture) : '/images/default-avatar.jpg' }}" 
         alt="{{ $user ? $user->name : 'Usuario' }}"
         onerror="this.src='/images/default-avatar.jpg'">
    <div class="flex flex-col leading-3 sm:max-w-sm max-w-52 p-2 border-gray-200 bg-gray-200 rounded dark:bg-gray-700">
        <div class="flex justify-between gap-1 space-x-1">
            <span class="text-md font-semibold text-gray-900 dark:text-white">
                {{ $user ? $user->name : 'Usuario' }}
            </span>
            <span class="text-md font-normal text-gray-500 dark:text-gray-400">{{ $time }}</span>
        </div>
        <p class="text-md flex font-normal py-2.5 text-gray-900 dark:text-white leading-normal">{{ $content }}</p>
    </div>
</div>