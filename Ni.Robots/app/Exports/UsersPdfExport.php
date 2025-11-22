<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersPdfExport implements FromView
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function view(): View
    {
        $query = User::with(['role']);

        if (!empty($this->filters['role_type'])) {
            $query->whereHas('role', function($q) {
                $q->where('role_type', $this->filters['role_type']);
            });
        }

        if (!empty($this->filters['estado'])) {
            $query->where('estado', $this->filters['estado']);
        }

        if (!empty($this->filters['departamento'])) {
            $query->where('departamento', 'like', '%' . $this->filters['departamento'] . '%');
        }

        if (!empty($this->filters['municipio'])) {
            $query->where('municipio', 'like', '%' . $this->filters['municipio'] . '%');
        }

        if (!empty($this->filters['fecha_creacion_min']) && !empty($this->filters['fecha_creacion_max'])) {
            $query->whereBetween('created_at', [$this->filters['fecha_creacion_min'], $this->filters['fecha_creacion_max']]);
        } elseif (!empty($this->filters['fecha_creacion_min'])) {
            $query->where('created_at', '>=', $this->filters['fecha_creacion_min']);
        } elseif (!empty($this->filters['fecha_creacion_max'])) {
            $query->where('created_at', '<=', $this->filters['fecha_creacion_max']);
        }

        $users = $query->get();

        // Calcular estadísticas
        $stats = [
            'total' => $users->count(),
            'activos' => $users->where('estado', true)->count(),
            'inactivos' => $users->where('estado', false)->count(),
            'administradores' => $users->filter(fn($u) => $u->role && $u->role->role_type === 'administrador')->count(),
            'pacientes' => $users->filter(fn($u) => $u->role && $u->role->role_type === 'paciente')->count(),
            'medicos' => $users->filter(fn($u) => $u->role && $u->role->role_type === 'doctor')->count(),
            'departamentos_count' => $users->whereNotNull('departamento')->groupBy('departamento')->count(),
            'departamento_mas_comun' => $users->whereNotNull('departamento')->groupBy('departamento')->map->count()->sortDesc()->keys()->first() ?? 'N/A'
        ];

        return view('usuarios.users-pdf', compact('users', 'stats'));
    }
}