<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensajes;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Appointment;
use App\Models\Paciente;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_admin(Request $request)
    {
        $query = User::with(['role']);

        // Aplicar filtros
        if ($request->filled('role_type')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('role_type', $request->role_type);
            });
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('departamento')) {
            $query->where('departamento', 'like', '%' . $request->departamento . '%');
        }

        if ($request->filled('municipio')) {
            $query->where('municipio', 'like', '%' . $request->municipio . '%');
        }

        if ($request->filled('fecha_creacion_min') && $request->filled('fecha_creacion_max')) {
            $query->whereBetween('created_at', [$request->fecha_creacion_min, $request->fecha_creacion_max]);
        } elseif ($request->filled('fecha_creacion_min')) {
            $query->where('created_at', '>=', $request->fecha_creacion_min);
        } elseif ($request->filled('fecha_creacion_max')) {
            $query->where('created_at', '<=', $request->fecha_creacion_max);
        }

        $users = $query->paginate(10);

        // Obtener departamentos y municipios únicos para los filtros
        $departamentos = User::distinct()->whereNotNull('departamento')->pluck('departamento');
        $municipios = User::distinct()->whereNotNull('municipio')->pluck('municipio');
        $roles = Role::distinct()->pluck('role_type');

        return view('usuarios.index', compact('users', 'departamentos', 'municipios', 'roles'));
    }

    public function index()
    {
        $user = Auth::user();
        // Verifica si el usuario tiene el rol de 'paciente'
        if ($user->role && $user->role->role_type === 'paciente') {
            // Trae los datos del paciente relacionados
            $user = User::with('role.roleable')
                ->where('id', $user->id)
                ->first();
        }
        return view('usuarios.profile', compact('user'));
    }

    /**
     * Exportar usuarios a Excel
     */
    public function exportExcel(Request $request)
    {
        $filters = $request->all();
        return Excel::download(new UsersExport($filters), 'usuarios.xlsx');
    }

    /**
     * Exportar usuarios a PDF
     */
    public function exportPDF(Request $request)
    {
        $filters = $request->all();

        // Reutilizamos la lógica de filtros
        $export = new \App\Exports\UsersPdfExport($filters);
        $view = $export->view();

        $pdf = Pdf::loadView($view->name(), $view->getData())
            ->setPaper('a4', 'portrait');

        return $pdf->download('usuarios.pdf');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Define roles for the select dropdown
        $roles = ['administrador', 'normal'];
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'departamento' => 'required|string|max:255',
            'municipio' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
        ]);

        // Handle file upload if there's a profile picture
        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_picture' => $profilePicturePath,
            'departamento' => $validated['departamento'],
            'municipio' => $validated['municipio'],
            'domicilio' => $validated['domicilio'],
            'estado' => true,
        ]);

        // Assign the 'administrador' role to the user
        Role::create([
            'user_id' => $user->id,
            'role_type' => 'administrador',
            'roleable_id' => $user->id,
            'roleable_type' => User::class,
        ]);

        // Redirect to a success page or dashboard
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado exitosamente con el rol de administrador.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = Auth::user();
        // Verifica si el usuario tiene el rol de 'paciente'
        if ($user->role && $user->role->role_type === 'paciente') {
            // Trae los datos del paciente relacionados
            $user = User::with('role.roleable')
                ->where('id', $user->id)
                ->first();
        }
        // Retornar la vista con el formulario de edición
        return view('usuarios.settings', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'domicilio' => 'nullable|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'municipio' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|max:2048', // Opcional para la foto de perfil

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

        // Actualizar la información básica del usuario
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'domicilio' => $request->domicilio,
            'departamento' => $request->departamento,
            'municipio' => $request->municipio,
        ]);

        // Subir la foto de perfil si existe
        if ($request->hasFile('profile_picture')) {
            // Eliminar la foto de perfil antigua si existe
            if ($user->profile_picture) {
                $oldImagePath = storage_path('app/public/images/profile_pictures/' . $user->profile_picture);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            // Guardar la nueva foto de perfil
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $request->file('profile_picture')->storeAs('images/profile_pictures', $imageName, 'public');
            $user->profile_picture = $imageName;
        }

        // Si el usuario es paciente, actualizar también sus campos
        if ($user->esPaciente()) {
            $user->paciente->update([
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
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    //esto es para miscitas
    public function misPacientes()
    {
        $doctorUser = Auth::user();

        // Obtener el doctor_id real (id de la tabla doctor)
        $doctorRole = Role::where('user_id', $doctorUser->id)
            ->where('role_type', 'doctor')
            ->first();

        if (!$doctorRole) { 
            $pacientes = collect();
        } else {
            $doctorId = $doctorRole->roleable_id;
            // Obtener pacientes directamente como objetos Paciente
            $pacientes = Appointment::where('doctor_id', $doctorId)
                ->with(['patient.role.user']) // Cargar paciente con su usuario
                ->get()->pluck('patient') // Obtener los modelos Paciente
                ->filter()->unique('id'); // Eliminar duplicados
        }

        return view('Administracion.pacientes', compact('pacientes'));
    }
}
