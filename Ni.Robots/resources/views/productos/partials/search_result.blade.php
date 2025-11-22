@foreach ($productos as $producto)
    <div class="flex gap-2 my-2">
        <a href="#" class="flex items-center aspect-square w-16 h-16 shrink-0">
            <img class="hidden h-auto w-full max-h-full dark:block"
                src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg" alt="imac image" />
        </a>
        <div href="#" class="flex flex-col items-start font-medium text-gray-900 dark:text-white gap-1 w-full">
            <div class="flex justify-between w-full">
                <span class="leading-4 text-base font-bold">
                    {{ $producto->nombre_prod }}
                </span>
                <span class="text-base font-extrabold leading-4">
                    ${{ $producto->precio }}
                </span>
            </div>
            <p class="leading-2 text-sm font-medium text-wrap">
                {{ $producto->descripcion }}
            </p>
            <div class="flex justify-between">
                <span
                    class="me-2 rounded bg-blue-100 px-2 py-0.5 text-xs font-normal text-green-800 dark:bg-green-900 dark:text-green-300">
                    {{ $producto->tipo_producto }} </span>
                <span
                    class="me-2 max-w-full rounded bg-blue-100 px-2 py-0.5 text-xs font-normal text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    {{ $producto->nivel_afectacion }}</span>
            </div>
        </div>
    </div>
@endforeach