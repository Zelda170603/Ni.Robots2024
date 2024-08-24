<div class="space-y-6">
    
    <div>
        <x-input-label for="nombre" :value="__('Nombre')"/>
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $autore?->nombre)" autocomplete="nombre" placeholder="Nombre"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre')"/>
    </div>
    <div>
        <x-input-label for="apellido" :value="__('Apellido')"/>
        <x-text-input id="apellido" name="apellido" type="text" class="mt-1 block w-full" :value="old('apellido', $autore?->apellido)" autocomplete="apellido" placeholder="Apellido"/>
        <x-input-error class="mt-2" :messages="$errors->get('apellido')"/>
    </div>
    <div>
        <x-input-label for="fecha_nacimiento" :value="__('Fecha Nacimiento')"/>
        <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="mt-1 block w-full" :value="old('fecha_nacimiento', $autore?->fecha_nacimiento)" autocomplete="fecha_nacimiento" placeholder="Fecha Nacimiento"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')"/>
    </div>
    <div>
        <x-input-label for="fecha_fallecimiento" :value="__('Fecha Fallecimiento')"/>
        <x-text-input id="fecha_fallecimiento" name="fecha_fallecimiento" type="text" class="mt-1 block w-full" :value="old('fecha_fallecimiento', $autore?->fecha_fallecimiento)" autocomplete="fecha_fallecimiento" placeholder="Fecha Fallecimiento"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_fallecimiento')"/>
    </div>
    <div>
        <x-input-label for="nacionalidad" :value="__('Nacionalidad')"/>
        <x-text-input id="nacionalidad" name="nacionalidad" type="text" class="mt-1 block w-full" :value="old('nacionalidad', $autore?->nacionalidad)" autocomplete="nacionalidad" placeholder="Nacionalidad"/>
        <x-input-error class="mt-2" :messages="$errors->get('nacionalidad')"/>
    </div>
    <div>
        <x-input-label for="biografia" :value="__('Biografia')"/>
        <x-text-input id="biografia" name="biografia" type="text" class="mt-1 block w-full" :value="old('biografia', $autore?->biografia)" autocomplete="biografia" placeholder="Biografia"/>
        <x-input-error class="mt-2" :messages="$errors->get('biografia')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>