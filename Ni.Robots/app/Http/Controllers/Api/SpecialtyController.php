<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    public function doctors(Specialty $specialty)
    {
        // Obtener los usuarios con rol de "Doctor" asociados a esa especialidad
        return $specialty->users()->whereHas('role', function ($query) {
            $query->where('role_type', 'doctor');
        })->get([
            'users.id',
            'users.name'
        ]);
    }
}
