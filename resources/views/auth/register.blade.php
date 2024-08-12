@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="profile_picture"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Profile Picture') }}</label>

                                <div class="col-md-6">
                                    <input id="profile_picture" type="file"
                                        class="form-control @error('profile_picture') is-invalid @enderror"
                                        name="profile_picture" accept="image/*">

                                    @error('profile_picture')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="departamento"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Departamento') }}</label>

                                <div class="col-md-6">
                                    <select id="departamento" name="departamento"
                                        class="form-control @error('departamento') is-invalid @enderror" required>
                                        <option value="">Selecciona un departamento</option>
                                        
                                    </select>

                                    @error('departamento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="municipio"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Municipio') }}</label>

                                <div class="col-md-6">
                                    <select id="municipio" name="municipio"
                                        class="form-control @error('municipio') is-invalid @enderror" required>
                                        <option value="">Selecciona un municipio</option>
                                        
                                    </select>

                                    @error('municipio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="domicilio"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Domicilio') }}</label>
                                <div class="col-md-6">
                                    <input id="domicilio" type="text"
                                        class="form-control @error('domicilio') is-invalid @enderror" name="domicilio"
                                        value="{{ old('domicilio') }}" required>
                                    @error('domicilio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const departamentoSelect = document.getElementById('departamento');
            const municipioSelect = document.getElementById('municipio');
        
            // Función para cargar los departamentos
            function loadDepartamentos() {
                fetch('/departamentos')
                    .then(response => response.json())
                    .then(data => {
                        departamentoSelect.innerHTML = ''; // Limpiar el select actual
        
                        // Añadir un elemento de selección vacía
                        const defaultOption = document.createElement('option');
                        defaultOption.textContent = 'Seleccione un departamento';
                        defaultOption.value = '';
                        departamentoSelect.appendChild(defaultOption);
        
                        // Añadir los departamentos recibidos
                        Object.entries(data).forEach(([id, nombre]) => {
                            const option = document.createElement('option');
                            option.value = id;
                            option.textContent = nombre;
                            departamentoSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener departamentos:', error));
            }
        
            // Función para cargar municipios según el departamento seleccionado
            function loadMunicipios(departamentoId) {
                fetch(`/municipios/${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
                        Object.entries(data).forEach(([id, nombre]) => {
                            const option = document.createElement('option');
                            option.value = id;
                            option.textContent = nombre;
                            municipioSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al obtener municipios:', error);
                        municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
                    });
            }
        
            // Cargar los departamentos al iniciar
            loadDepartamentos();
        
            // Añadir evento al cambio de departamento
            departamentoSelect.addEventListener('change', function() {
                const departamentoId = this.value;
                if (departamentoId) {
                    loadMunicipios(departamentoId);
                } else {
                    municipioSelect.innerHTML = '<option value="">Selecciona un municipio</option>';
                }
            });
        });
        </script>
        
@endsection
