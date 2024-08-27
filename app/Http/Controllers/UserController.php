<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mensajes;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', compact('users'));
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
            'departamento' => 'required|exists:departamentos,id',
            'municipio' => 'required|exists:municipios,id',
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
            'departamento_id' => $validated['departamento'],
            'municipio_id' => $validated['municipio'],
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
        return redirect()->route('usuarios.index')->with('success', 'User registered successfully with the administrador role.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
