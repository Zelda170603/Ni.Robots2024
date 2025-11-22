<a href="{{ route('CentroAtencion.show', $centro->id) }}" class="flex rounded w-full p-1 items-center hover:bg-gray-200 dark:hover:bg-gray-600">
    <div class="w-20 h-20 flex-shrink-0 relative">
        <img src="{{ asset('storage/images/centros_atencion/' . $centro->foto_centro) }}" 
             class="absolute inset-0 w-full h-full object-cover rounded self-start justify-self" 
             alt="Foto Principal">
    </div>
    <div class="ml-4 w-full">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $centro->nombre }}</h3>
        <p class="text-md font-normal text-gray-600 dark:text-gray-300">{{ $centro->direccion }}</p>
        <div class="flex justify-between text-md font-normal text-gray-700 w-full dark:text-gray-500" >
            <span >{{ $centro->municipio }}</span>
            <span >{{ $centro->tipo }}</span>
        </div>
    </div>
</a>
