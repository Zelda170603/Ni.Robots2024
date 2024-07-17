<div class="flex justify-center items-center">
    <div class="w-12 h-12">
        <img src="{{ asset('storage/images/centro_atencion/' . $centro->fotoPrincipal->foto) }}" alt="Foto Principal">
    </div>
    <div>
        <h3 class="text-lg font-semibold">{{ $centro->nombre }}</h3>
        <p>{{ $centro->direccion }}</p>
        <span>{{ $centro->departamento }}</span>
    </div>
</div>
