<div class="space-y-6">
    
    <div>
        <x-input-label for="nombre" :value="__('Nombre')"/>
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $editoriale?->nombre)" autocomplete="nombre" placeholder="Nombre"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre')"/>
    </div>
    <div>
        <x-input-label for="direccion" :value="__('Direccion')"/>
        <x-text-input id="direccion" name="direccion" type="text" class="mt-1 block w-full" :value="old('direccion', $editoriale?->direccion)" autocomplete="direccion" placeholder="Direccion"/>
        <x-input-error class="mt-2" :messages="$errors->get('direccion')"/>
    </div>
    <div>
        <x-input-label for="telefono" :value="__('Telefono')"/>
        <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $editoriale?->telefono)" autocomplete="telefono" placeholder="Telefono"/>
        <x-input-error class="mt-2" :messages="$errors->get('telefono')"/>
    </div>
    <div>
        <x-input-label for="correo_electronico" :value="__('Correo Electronico')"/>
        <x-text-input id="correo_electronico" name="correo_electronico" type="text" class="mt-1 block w-full" :value="old('correo_electronico', $editoriale?->correo_electronico)" autocomplete="correo_electronico" placeholder="Correo Electronico"/>
        <x-input-error class="mt-2" :messages="$errors->get('correo_electronico')"/>
    </div>
    <div>
        <x-input-label for="sitio_web" :value="__('Sitio Web')"/>
        <x-text-input id="sitio_web" name="sitio_web" type="text" class="mt-1 block w-full" :value="old('sitio_web', $editoriale?->sitio_web)" autocomplete="sitio_web" placeholder="Sitio Web"/>
        <x-input-error class="mt-2" :messages="$errors->get('sitio_web')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>