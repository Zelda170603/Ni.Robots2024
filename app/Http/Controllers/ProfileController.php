<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de 'paciente'
        if ($user->role && $user->role->role_type === 'paciente') {
            // Trae los datos del paciente relacionados
            $user = User::with('role.roleable') // Carga la relación morphTo con el modelo Paciente
                ->where('id', $user->id)
                ->first();
        }

        return view('usuarios.settings', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function index()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();

        // Verifica si el usuario tiene el rol de 'paciente'
        if ($user->role && $user->role->role_type === 'paciente') {
            // Trae los datos del paciente relacionados
            $user = User::with('role.roleable') // Carga la relación morphTo con el modelo Paciente
                ->where('id', $user->id)
                ->first();
        }

        // Devuelve la vista con la información del perfil del usuario
        return view('usuarios.profile', compact('user'));
    }
    public function update(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'domicilio' => 'nullable|string|max:255',
            'departamento' => 'nullable|exists:departamentos,id',
            'municipio' => 'nullable|exists:municipios,id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Si es paciente, validar también estos campos
            'biografia' => 'nullable|string|max:1000',
            'edad' => 'nullable|integer|min:0|max:120',
            'peso' => 'nullable|numeric|min:0|max:500',
            'altura' => 'nullable|numeric|min:0|max:300',
            'genero' => 'nullable|string|in:Masculino,Femenino,Otro',
            'condicion' => 'nullable|string|max:255',
            'tipo_afectacion' => 'nullable|string|max:255',
            'nivel_afectacion' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Actualizar la información básica del usuario
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'domicilio' => $validated['domicilio'],
            'departamento_id' => $validated['departamento'],
            'municipio_id' => $validated['municipio'],
        ]);

        // Subir la foto de perfil si existe
        if ($request->hasFile('profile_picture')) {
            // Eliminar la foto de perfil antigua si existe
            if ($user->profile_picture) {
                Storage::disk('public')->delete('profile_pictures/' . $user->profile_picture);
            }

            // Guardar la nueva foto de perfil
            $imageName = time() . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->storeAs('profile_pictures', $imageName, 'public');
            $user->profile_picture = $imageName;
        }

        // Si el usuario es paciente, actualizar también sus campos
        if ($user->role && $user->role->role_type === 'paciente') {
            $user->role->roleable->update([
                'biografia' => $request->biografia,
                'edad' => $request->edad,
                'peso' => $request->peso,
                'altura' => $request->altura,
                'genero' => $request->genero,
                'condicion' => $request->condicion,
                'tipo_afectacion' => $request->tipo_afectacion,
                'nivel_afectacion' => $request->nivel_afectacion,
            ]);
        }

        // Guardar los cambios
        $user->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('edit_profile')->with('success', 'Perfil actualizado exitosamente.');
    }
}
