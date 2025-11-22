@extends('layouts.adminLY')

@section('content')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="p-6 max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Expediente Médico</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Historial médico de {{ $paciente->role->user->name ?? 'N/A' }}</p>
        </div>
        <div class="flex gap-2">
            <!-- Botones de Exportar -->
            <div class="flex gap-2 mr-4">
                <!-- Botón Exportar PDF -->
                <a href="{{ route('expedientes.export.pdf', $paciente->id) }}" 
                   class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                    <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                </a>
            </div>

            <!-- Botón para ver historial -->
            <button onclick="openHistorialModal()" 
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                <i class="fas fa-history mr-2"></i>Ver Historial
            </button>
            <a href="{{ route('doctor.pacientes') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Volver a Pacientes
            </a>
        </div>
    </div>

    <!-- Información del Paciente -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Datos del Paciente</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->role->user->name ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Edad</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->edad ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Género</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->genero ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->telefono ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Condición</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->condicion ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tipo Afectación</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->tipo_afectacion ?? 'N/A' }}</p>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Nivel Afectación</label>
                <p class="text-gray-900 dark:text-white">{{ $paciente->nivel_afectacion ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Formulario para NUEVA Consulta -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Nueva Consulta Médica</h2>
        
        <form action="{{ route('expedientes.store') }}" method="POST" id="expedienteForm">
            @csrf
            <input type="hidden" name="patient_id" value="{{ $paciente->id }}">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Columna Izquierda -->
                <div class="space-y-6">
                    <!-- Signos Vitales -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Signos Vitales</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Presión Arterial</label>
                                <input type="text" name="presion_arterial" value="{{ old('presion_arterial') }}"
                                    placeholder="Ej: 120/80"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                @error('presion_arterial')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Temperatura (°C)</label>
                                <input type="number" step="0.1" name="temperatura" value="{{ old('temperatura') }}"
                                    placeholder="Ej: 36.5"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                @error('temperatura')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Frecuencia Cardíaca</label>
                                <input type="number" name="frecuencia_cardiaca" value="{{ old('frecuencia_cardiaca') }}"
                                    placeholder="Ej: 72"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                @error('frecuencia_cardiaca')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Frecuencia Respiratoria</label>
                                <input type="number" name="frecuencia_respiratoria" value="{{ old('frecuencia_respiratoria') }}"
                                    placeholder="Ej: 16"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                @error('frecuencia_respiratoria')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Peso (kg)</label>
                                <input type="number" step="0.1" name="peso" value="{{ old('peso') }}"
                                    placeholder="Ej: 70.5"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                @error('peso')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Altura (m)</label>
                                <input type="number" step="0.01" name="altura" value="{{ old('altura') }}"
                                    placeholder="Ej: 1.75"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                @error('altura')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Información Médica General -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Información Médica General</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Sangre</label>
                                <select name="tipo_sangre" class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                                    <option value="">Seleccionar tipo</option>
                                    <option value="A+" {{ old('tipo_sangre') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('tipo_sangre') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('tipo_sangre') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('tipo_sangre') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="AB+" {{ old('tipo_sangre') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('tipo_sangre') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                    <option value="O+" {{ old('tipo_sangre') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('tipo_sangre') == 'O-' ? 'selected' : '' }}>O-</option>
                                </select>
                                @error('tipo_sangre')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Alergias</label>
                                <textarea name="alergias" rows="3" placeholder="Lista de alergias conocidas"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('alergias') }}</textarea>
                                @error('alergias')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Enfermedades Crónicas</label>
                                <textarea name="enfermedades_cronicas" rows="3" placeholder="Enfermedades crónicas del paciente"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('enfermedades_cronicas') }}</textarea>
                                @error('enfermedades_cronicas')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="space-y-6">
                    <!-- Diagnóstico y Tratamiento -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Diagnóstico y Tratamiento</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Diagnóstico *</label>
                                <textarea name="diagnostico" rows="4" required placeholder="Diagnóstico principal de la consulta"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('diagnostico') }}</textarea>
                                @error('diagnostico')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tratamiento</label>
                                <textarea name="tratamiento" rows="4" placeholder="Plan de tratamiento indicado"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('tratamiento') }}</textarea>
                                @error('tratamiento')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Medicamentos Recetados</label>
                                <textarea name="medicamentos" rows="3" placeholder="Medicamentos recetados en esta consulta"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('medicamentos') }}</textarea>
                                @error('medicamentos')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Información Adicional</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cirugías Previas</label>
                                <textarea name="cirugias_previas" rows="3" placeholder="Historial de cirugías"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('cirugias_previas') }}</textarea>
                                @error('cirugias_previas')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Medicamentos Actuales</label>
                                <textarea name="medicamentos_actuales" rows="3" placeholder="Medicamentos que toma actualmente"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('medicamentos_actuales') }}</textarea>
                                @error('medicamentos_actuales')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Historial Familiar</label>
                                <textarea name="historial_familiar" rows="3" placeholder="Enfermedades hereditarias"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('historial_familiar') }}</textarea>
                                @error('historial_familiar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Notas Adicionales</label>
                                <textarea name="notas_adicionales" rows="3" placeholder="Observaciones adicionales"
                                    class="w-full p-2 border border-gray-300 rounded-lg dark:bg-gray-600 dark:border-gray-500 dark:text-white">{{ old('notas_adicionales') }}</textarea>
                                @error('notas_adicionales')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón de Guardar -->
            <div class="mt-6 flex justify-end">
                <button type="submit" id="submitButton"
                    class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Registrar Nueva Consulta
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal para Historial -->
<div id="historialModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-6xl max-h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Historial de Consultas</h3>
            <button onclick="closeHistorialModal()" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        
        <div class="p-6 overflow-y-auto max-h-[70vh]">
            <!-- Contenido del historial se cargará aquí -->
            <div id="historialContent">
                <div class="space-y-4">
                    @forelse($historialExpedientes as $consulta)
                    <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors"
                         onclick="loadExpedienteDetails({{ $consulta->id }})">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $consulta->diagnostico ?: 'Consulta sin diagnóstico' }}
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $consulta->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full">
                                {{ $consulta->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                        <i class="fas fa-file-medical text-4xl mb-4"></i>
                        <p>No hay consultas registradas para este paciente.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Paginación -->
                @if($historialExpedientes->hasPages())
                <div class="mt-6">
                    {{ $historialExpedientes->links() }}
                </div>
                @endif
            </div>

            <!-- Detalles de la consulta seleccionada -->
            <div id="expedienteDetails" class="hidden mt-6 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
                <div id="detailsContent" class="text-gray-900 dark:text-gray-100"></div>
                <div class="mt-4 flex justify-between">
                    <button onclick="showHistorialList()" class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 text-white px-4 py-2 rounded transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Volver al listado
                    </button>
                    <button onclick="closeHistorialModal()" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white px-4 py-2 rounded transition-colors">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Funciones para el modal de historial
function openHistorialModal() {
    document.getElementById('historialModal').classList.remove('hidden');
}

function closeHistorialModal() {
    document.getElementById('historialModal').classList.add('hidden');
    showHistorialList();
}

function showHistorialList() {
    document.getElementById('historialContent').classList.remove('hidden');
    document.getElementById('expedienteDetails').classList.add('hidden');
}

function loadExpedienteDetails(expedienteId) {
    // Mostrar loading con modo oscuro
    document.getElementById('detailsContent').innerHTML = `
        <div class="text-center py-8">
            <i class="fas fa-spinner fa-spin text-2xl text-blue-500 dark:text-blue-400"></i>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Cargando detalles...</p>
        </div>
    `;
    
    // Ocultar listado y mostrar detalles
    document.getElementById('historialContent').classList.add('hidden');
    document.getElementById('expedienteDetails').classList.remove('hidden');
    
    // Hacer petición AJAX para obtener los detalles
    fetch(`/expedientes/${expedienteId}/details`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('detailsContent').innerHTML = `
                <h4 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">Consulta del ${new Date(data.created_at).toLocaleDateString()}</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h5 class="font-semibold text-gray-900 dark:text-white mb-2">📋 Diagnóstico y Tratamiento</h5>
                            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Diagnóstico:</strong> ${data.diagnostico || 'No especificado'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Tratamiento:</strong> ${data.tratamiento || 'No especificado'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Medicamentos:</strong> ${data.medicamentos || 'No especificados'}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h5 class="font-semibold text-gray-900 dark:text-white mb-2">💊 Información Médica</h5>
                            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Tipo de Sangre:</strong> ${data.tipo_sangre || 'No especificado'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Alergias:</strong> ${data.alergias || 'No registradas'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Enfermedades Crónicas:</strong> ${data.enfermedades_cronicas || 'No registradas'}</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h5 class="font-semibold text-gray-900 dark:text-white mb-2">💓 Signos Vitales</h5>
                            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Presión Arterial:</strong> ${data.presion_arterial || 'No registrada'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Temperatura:</strong> ${data.temperatura ? data.temperatura + '°C' : 'No registrada'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Frecuencia Cardíaca:</strong> ${data.frecuencia_cardiaca || 'No registrada'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Frecuencia Respiratoria:</strong> ${data.frecuencia_respiratoria || 'No registrada'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Peso:</strong> ${data.peso ? data.peso + ' kg' : 'No registrado'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Altura:</strong> ${data.altura ? data.altura + ' m' : 'No registrada'}</p>
                        </div>
                        <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                            <h5 class="font-semibold text-gray-900 dark:text-white mb-2">📝 Información Adicional</h5>
                            <p class="text-sm text-gray-700 dark:text-gray-300"><strong>Cirugías Previas:</strong> ${data.cirugias_previas || 'No registradas'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Medicamentos Actuales:</strong> ${data.medicamentos_actuales || 'No especificados'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Historial Familiar:</strong> ${data.historial_familiar || 'No registrado'}</p>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mt-2"><strong>Notas Adicionales:</strong> ${data.notas_adicionales || 'No hay notas adicionales'}</p>
                        </div>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <p class="text-sm text-blue-700 dark:text-blue-300">
                        <strong>Registrado por:</strong> ${data.doctor.name} • ${new Date(data.created_at).toLocaleString()}
                    </p>
                </div>
            `;
        })
        .catch(error => {
            document.getElementById('detailsContent').innerHTML = `
                <div class="text-center text-red-500 dark:text-red-400">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                    <p class="mt-2">Error al cargar los detalles</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Intente nuevamente</p>
                </div>
            `;
        });
}

// Cerrar modal con ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeHistorialModal();
    }
});

// Cerrar modal al hacer clic fuera del contenido
document.getElementById('historialModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeHistorialModal();
    }
});
</script>

<!-- Mensajes de sesión -->
@if(session('success'))
<div class="fixed top-4 right-4 bg-green-500 text-white p-4 rounded-lg shadow-lg z-50">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<style>
.fixed {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection