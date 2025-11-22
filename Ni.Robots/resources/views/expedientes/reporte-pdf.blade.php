@extends('layouts.pdf')

@section('title', $paciente ? 'Historial Médico de ' . ($paciente->role->user->name ?? 'N/A') : 'Reporte de Consultas Médicas')
@section('subtitle', $paciente ? 'Historial Clínico Completo' : 'Consultas Médicas del Sistema')
@section('description', $paciente ? 'Registro detallado de todas las consultas médicas del paciente' : 'Reporte completo de consultas médicas registradas en el sistema')
@section('company', 'Sistema Médico - Gestión de Expedientes')

@section('total_count', $expedientes->count())
@section('filters_applied', $filtros_aplicados)

@section('additional_stats')
<div class="stat-item">
    <span class="stat-number">{{ $expedientes->unique('patient_id')->count() }}</span>
    <span class="stat-label">Pacientes Únicos</span>
</div>
<div class="stat-item">
    <span class="stat-number">{{ $expedientes->unique('doctor_id')->count() }}</span>
    <span class="stat-label">Doctores</span>
</div>
<div class="stat-item">
    <span class="stat-number">{{ $expedientes->where('created_at', '>=', now()->subDays(30))->count() }}</span>
    <span class="stat-label">Últimos 30 días</span>
</div>
@endsection

@section('content')
<!-- Información del reporte -->
<div class="report-header">
    <strong>Información del Reporte:</strong> 
    @if($paciente)
        Este documento contiene el <strong>historial médico completo</strong> de <strong>{{ $paciente->role->user->name ?? 'N/A' }}</strong> 
        con <strong>{{ $expedientes->count() }}</strong> consultas registradas.
    @else
        Este documento contiene <strong>{{ $expedientes->count() }}</strong> consultas médicas registradas en el sistema 
        por <strong>{{ $expedientes->unique('doctor_id')->count() }}</strong> doctores diferentes.
    @endif
</div>

@if($expedientes->count() > 0)
    <!-- Estadísticas rápidas -->
    @php
        $consultasRecientes = $expedientes->where('created_at', '>=', now()->subDays(7))->count();
        $porcentajeRecientes = $expedientes->count() > 0 ? round(($consultasRecientes / $expedientes->count()) * 100, 1) : 0;
    @endphp

    @if($consultasRecientes > 0)
    <div class="activity-alert">
        <strong>Actividad Reciente:</strong> 
        <strong>{{ $consultasRecientes }}</strong> consultas en los últimos 7 días 
        ({{ $porcentajeRecientes }}% del total)
    </div>
    @endif

    <!-- Información del paciente -->
    @if($paciente)
    <div class="patient-info">
        <h3 class="section-title">👤 INFORMACIÓN DEL PACIENTE</h3>
        <div class="patient-grid">
            <div class="patient-field">
                <span class="field-name">Nombre completo:</span>
                <span class="field-value">{{ $paciente->role->user->name ?? 'N/A' }}</span>
            </div>
            <div class="patient-field">
                <span class="field-name">Edad:</span>
                <span class="field-value">{{ $paciente->edad ?? 'N/A' }} años</span>
            </div>
            <div class="patient-field">
                <span class="field-name">Género:</span>
                <span class="field-value">{{ $paciente->genero ?? 'N/A' }}</span>
            </div>
            <div class="patient-field">
                <span class="field-name">Teléfono:</span>
                <span class="field-value">{{ $paciente->telefono ?? 'N/A' }}</span>
            </div>
            <div class="patient-field">
                <span class="field-name">Condición:</span>
                <span class="field-value">{{ $paciente->condicion ?? 'N/A' }}</span>
            </div>
            <div class="patient-field">
                <span class="field-name">Tipo de afectación:</span>
                <span class="field-value">{{ $paciente->tipo_afectacion ?? 'N/A' }}</span>
            </div>
            <div class="patient-field">
                <span class="field-name">Nivel de afectación:</span>
                <span class="field-value">{{ $paciente->nivel_afectacion ?? 'N/A' }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Historial de consultas -->
    <div class="consultas-historial">
        <h3 class="section-title">🩺 HISTORIAL DE CONSULTAS MÉDICAS</h3>

        @foreach($expedientes as $index => $expediente)
        <div class="consulta">
            <!-- Encabezado de la consulta -->
            <div class="consulta-header">
                <div class="consulta-title">
                    <strong>CONSULTA MÉDICA #{{ $expediente->id }}</strong>
                    <span class="consulta-date">{{ $expediente->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="consulta-meta">
                    Atendido por: <strong>Dr. {{ $expediente->doctor->name ?? 'N/A' }}</strong>
                    @if(!$paciente)
                    | Paciente: <strong>{{ $expediente->patient->role->user->name ?? 'N/A' }}</strong>
                    @endif
                </div>
            </div>

            <!-- Diagnóstico y Tratamiento -->
            <div class="consulta-section">
                <h4 class="subsection-title">📋 Diagnóstico y Tratamiento</h4>
                <div class="section-content">
                    <div class="info-row">
                        <label>Diagnóstico Principal:</label>
                        <div class="info-content">{{ $expediente->diagnostico ?: 'No especificado' }}</div>
                    </div>
                    <div class="info-row">
                        <label>Plan de Tratamiento:</label>
                        <div class="info-content">{{ $expediente->tratamiento ?: 'No especificado' }}</div>
                    </div>
                    <div class="info-row">
                        <label>Medicamentos Recetados:</label>
                        <div class="info-content">{{ $expediente->medicamentos ?: 'No especificados' }}</div>
                    </div>
                </div>
            </div>

            <!-- Signos Vitales -->
            <div class="consulta-section">
                <h4 class="subsection-title">Signos Vitales</h4>
                <div class="vital-signs">
                    <div class="vital-row">
                        <div class="vital-item">
                            <span class="vital-label">Presión Arterial:</span>
                            <span class="vital-value">{{ $expediente->presion_arterial ?: 'No registrada' }}</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Temperatura:</span>
                            <span class="vital-value">{{ $expediente->temperatura ? $expediente->temperatura . '°C' : 'No registrada' }}</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Frecuencia Cardíaca:</span>
                            <span class="vital-value">{{ $expediente->frecuencia_cardiaca ? $expediente->frecuencia_cardiaca . ' lpm' : 'No registrada' }}</span>
                        </div>
                    </div>
                    <div class="vital-row">
                        <div class="vital-item">
                            <span class="vital-label">Frecuencia Respiratoria:</span>
                            <span class="vital-value">{{ $expediente->frecuencia_respiratoria ? $expediente->frecuencia_respiratoria . ' rpm' : 'No registrada' }}</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Peso:</span>
                            <span class="vital-value">{{ $expediente->peso ? $expediente->peso . ' kg' : 'No registrado' }}</span>
                        </div>
                        <div class="vital-item">
                            <span class="vital-label">Altura:</span>
                            <span class="vital-value">{{ $expediente->altura ? $expediente->altura . ' m' : 'No registrada' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Médica General -->
            <div class="consulta-section">
                <h4 class="subsection-title">🏥 Información Médica General</h4>
                <div class="section-content">
                    <div class="medical-grid">
                        <div class="medical-item">
                            <label>Tipo de Sangre:</label>
                            <span>{{ $expediente->tipo_sangre ?: 'No especificado' }}</span>
                        </div>
                        <div class="medical-item">
                            <label>Alergias Conocidas:</label>
                            <span>{{ $expediente->alergias ?: 'No registradas' }}</span>
                        </div>
                        <div class="medical-item">
                            <label>Enfermedades Crónicas:</label>
                            <span>{{ $expediente->enfermedades_cronicas ?: 'No registradas' }}</span>
                        </div>
                        <div class="medical-item">
                            <label>Cirugías Previas:</label>
                            <span>{{ $expediente->cirugias_previas ?: 'No registradas' }}</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <label>Medicamentos Actuales:</label>
                        <div class="info-content">{{ $expediente->medicamentos_actuales ?: 'No especificados' }}</div>
                    </div>
                    <div class="info-row">
                        <label>Historial Familiar:</label>
                        <div class="info-content">{{ $expediente->historial_familiar ?: 'No registrado' }}</div>
                    </div>
                </div>
            </div>

            <!-- Notas Adicionales -->
            @if($expediente->notas_adicionales)
            <div class="consulta-section">
                <h4 class="subsection-title">📝 Notas Adicionales</h4>
                <div class="notes-content">
                    {{ $expediente->notas_adicionales }}
                </div>
            </div>
            @endif

            <!-- Separador entre consultas -->
            @if(!$loop->last)
            <div class="consulta-separator">
                <span>▼ Siguiente consulta ▼</span>
            </div>
            @endif
        </div>
        @endforeach
    </div>

    <!-- Resumen estadístico -->
    <div class="summary">
        <h3 class="section-title">📊 RESUMEN ESTADÍSTICO</h3>
        <div class="summary-subtitle">Métricas generales del historial médico</div>
        
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-number">{{ $expedientes->count() }}</div>
                <div class="summary-label">🩺 Total Consultas</div>
            </div>

            <div class="summary-item">
                <div class="summary-number">{{ $expedientes->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                <div class="summary-label">📅 Últimos 30 días</div>
            </div>

            <div class="summary-item">
                <div class="summary-number">{{ $expedientes->unique('patient_id')->count() }}</div>
                <div class="summary-label">👥 Pacientes Únicos</div>
            </div>

            <div class="summary-item">
                <div class="summary-number">{{ $expedientes->unique('doctor_id')->count() }}</div>
                <div class="summary-label">👨‍⚕ Doctores</div>
            </div>
        </div>
    </div>

@else
    <!-- Estado vacío -->
    <div class="empty-state">
        <h3>🏥 No se encontraron consultas médicas</h3>
        <p>
            @if($paciente)
                No existen consultas registradas para el paciente {{ $paciente->role->user->name ?? 'N/A' }} 
                con los filtros aplicados.
            @else
                No existen consultas médicas que coincidan con los filtros aplicados. 
                Intenta ajustar los criterios de búsqueda.
            @endif
        </p>
    </div>
@endif

<!-- Notas del reporte médico -->
<div class="report-notes">
    <h4>📝 NOTAS DEL REPORTE MÉDICO:</h4>
    <ul>
        <li>Toda la información médica se presenta de forma completa y sin truncar</li>
        <li>Los signos vitales incluyen presión arterial, temperatura, frecuencia cardíaca y respiratoria</li>
        <li>Las consultas sin tratamiento específico aparecen como "No especificado"</li>
        <li>Los medicamentos recetados se listan según lo registrado en cada consulta</li>
        <li>Este reporte se genera con información actualizada al momento de la consulta</li>
        @if($paciente)
        <li>Historial médico confidencial - Uso exclusivo para fines médicos</li>
        @endif
    </ul>
</div>

<!-- Información de confidencialidad -->
@if($paciente)
<div class="confidential-notice">
    <h4>🔒 INFORMACIÓN CONFIDENCIAL</h4>
    <p>
        Este documento contiene información médica confidencial protegida por las leyes de privacidad. 
        Su uso está restringido a fines médicos y requiere autorización del paciente.
    </p>
</div>
@endif

<style>
/* Estilos generales */
.report-header {
    background: #e3f2fd;
    padding: 12px 15px;
    border-radius: 5px;
    border-left: 4px solid #2196f3;
    margin-bottom: 15px;
    font-size: 12px;
}

.activity-alert {
    background: #e8f5e8;
    padding: 10px 15px;
    border-radius: 5px;
    border-left: 4px solid #4caf50;
    margin-bottom: 20px;
    font-size: 11px;
}

.section-title {
    background: #2d3748;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    margin: 25px 0 15px 0;
    font-size: 14px;
}

/* Información del paciente */
.patient-info {
    margin-bottom: 20px;
}

.patient-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 8px;
    background: white;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #e0e0e0;
}

.patient-field {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    border-bottom: 1px solid #f5f5f5;
}

.patient-field:last-child {
    border-bottom: none;
}

.field-name {
    font-weight: 600;
    color: #555;
}

.field-value {
    color: #333;
}

/* Consultas médicas */
.consultas-historial {
    margin-bottom: 25px;
}

.consulta {
    background: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-bottom: 20px;
    padding: 0;
}

.consulta-header {
    background: #f8f9fa;
    padding: 12px 15px;
    border-bottom: 1px solid #dee2e6;
    border-radius: 6px 6px 0 0;
}

.consulta-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}

.consulta-date {
    color: #666;
    font-size: 11px;
}

.consulta-meta {
    font-size: 11px;
    color: #666;
}

.consulta-section {
    padding: 15px;
    border-bottom: 1px solid #f0f0f0;
}

.consulta-section:last-child {
    border-bottom: none;
}

.subsection-title {
    color: #2c5282;
    font-size: 13px;
    margin: 0 0 12px 0;
    padding-bottom: 5px;
    border-bottom: 1px solid #e2e8f0;
}

.section-content {
    margin-left: 5px;
}

.info-row {
    margin-bottom: 10px;
}

.info-row:last-child {
    margin-bottom: 0;
}

.info-row label {
    font-weight: 600;
    color: #4a5568;
    display: block;
    margin-bottom: 3px;
    font-size: 11px;
}

.info-content {
    background: #f8fafc;
    padding: 8px 10px;
    border-radius: 3px;
    border-left: 3px solid #cbd5e0;
    font-size: 11px;
    line-height: 1.4;
    white-space: pre-wrap;
}

/* Signos vitales */
.vital-signs {
    margin-left: 5px;
}

.vital-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
    margin-bottom: 8px;
}

.vital-row:last-child {
    margin-bottom: 0;
}

.vital-item {
    display: flex;
    justify-content: space-between;
    padding: 6px 0;
    border-bottom: 1px solid #f7fafc;
}

.vital-item:last-child {
    border-bottom: none;
}

.vital-label {
    font-weight: 600;
    color: #4a5568;
    font-size: 11px;
}

.vital-value {
    color: #2d3748;
    font-size: 11px;
}

/* Información médica general */
.medical-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 8px;
    margin-bottom: 12px;
}

.medical-item {
    display: flex;
    justify-content: space-between;
    padding: 5px 0;
    border-bottom: 1px solid #f7fafc;
    font-size: 11px;
}

.medical-item label {
    font-weight: 600;
    color: #4a5568;
}

/* Notas adicionales */
.notes-content {
    background: #f0f9ff;
    padding: 10px 12px;
    border-radius: 3px;
    border-left: 3px solid #0ea5e9;
    font-size: 11px;
    line-height: 1.4;
    white-space: pre-wrap;
}

/* Separador entre consultas */
.consulta-separator {
    text-align: center;
    padding: 10px;
    border-top: 1px dashed #cbd5e0;
}

.consulta-separator span {
    background: white;
    padding: 0 10px;
    color: #718096;
    font-size: 10px;
}

/* Resumen estadístico */
.summary {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    padding: 20px;
    margin-top: 25px;
}

.summary-subtitle {
    text-align: center;
    color: #666;
    font-size: 11px;
    margin-bottom: 15px;
}

.summary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 15px;
}

.summary-item {
    text-align: center;
    padding: 10px;
}

.summary-number {
    font-size: 24px;
    font-weight: bold;
    color: #2d3748;
    margin-bottom: 5px;
}

.summary-label {
    font-size: 10px;
    color: #666;
}

/* Notas del reporte */
.report-notes {
    background: #f8fafc;
    padding: 15px;
    border-radius: 5px;
    margin-top: 20px;
    border-left: 4px solid #667eea;
}

.report-notes h4 {
    font-size: 12px;
    margin-bottom: 8px;
    color: #2d3748;
}

.report-notes ul {
    font-size: 10px;
    color: #4a5568;
    margin-left: 15px;
    margin-bottom: 0;
}

.report-notes li {
    margin-bottom: 4px;
}

/* Aviso de confidencialidad */
.confidential-notice {
    background: linear-gradient(135deg, #fef2f2 0%, #fed7d7 100%);
    padding: 12px 15px;
    border-radius: 5px;
    margin-top: 15px;
    border-left: 4px solid #e53e3e;
}

.confidential-notice h4 {
    font-size: 11px;
    margin-bottom: 5px;
    color: #c53030;
}

.confidential-notice p {
    font-size: 9px;
    color: #742a2a;
    margin: 0;
}

/* Estado vacío */
.empty-state {
    text-align: center;
    padding: 40px 20px;
    color: #718096;
    background: white;
    border-radius: 8px;
    border: 2px dashed #cbd5e0;
}

.empty-state h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
}

.empty-state p {
    margin: 0;
    font-size: 12px;
}
</style>
@endsection