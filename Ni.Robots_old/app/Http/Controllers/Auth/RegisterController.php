<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Role;
use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'max:2048'], // Validación de la imagen
        ]);
    }




    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // En el método `create` del controlador de registro
    protected function create(array $data)
    {

        // Crear el usuario con los datos proporcionados
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'departamento' => DB::table('departamentos')->where('id', $data['departamento'])->value('nombre'),
            'municipio' => DB::table('municipios')->where('id', $data['municipio'])->value('nombre'),
            'domicilio' => $data['domicilio']
        ]);
        // Verificar si se ha subido una foto de perfil
        if (request()->hasFile('profile_picture')) {
            // Obtener la extensión original del archivo
            $extension = request()->file('profile_picture')->getClientOriginalExtension();
            // Generar un nombre único para la imagen
            $imageName = time() . '.' . $extension;
            // Guardar el archivo en el directorio 'profile_pictures' dentro del almacenamiento público
            request()->file('profile_picture')->storeAs('images/profile_pictures', $imageName, 'public');
            $user->profile_picture = $imageName;
            $user->save();
        }
        return $user;
    }

    public function register_patient()
    {
        return view('auth.register-patient');
    }


    public function create_patient(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'departamento' => ['required', 'string'],
            'municipio' => ['required', 'string'],
            'domicilio' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:20', 'unique:pacientes'],
            'biografia' => ['required', 'string'],
            'edad' => ['required', 'integer', 'min:0'],
            'peso' => ['required', 'numeric', 'min:0'],
            'altura' => ['required', 'numeric', 'min:0'],
            'genero' => ['required', 'string', 'max:10'],
            'condicion' => ['required', 'string', 'max:255'],
            'tipo_afectacion' => ['required', 'string', 'max:255'],
            'nivel_afectacion' => ['required', 'string', 'max:255'],
        ]);
        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'departamento' => $validated['departamento'],
            'municipio' => $validated['municipio'],
            'domicilio' => $validated['domicilio'],
        ]);

        // Subir la foto de perfil si existe
        if ($request->hasFile('profile_picture')) {
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $request->file('profile_picture')->storeAs('images/profile_pictures', $imageName, 'public');
            $user->profile_picture = $imageName;
            $user->save();
        }

        $tipo_afectacion = DB::table('categorias_afectaciones')
            ->select('nombre')
            ->where('id', $validated['tipo_afectacion'])
            ->first();

        // Seleccionar un tipo de afectación basado en la categoría seleccionada
        $nivel_afectacion = DB::table('tipos_afectaciones')
            ->select('tipo')
            ->where('id', $validated['nivel_afectacion'])
            ->first();

        // Crear el paciente asociado al usuario
        $paciente = Paciente::create([
            'cedula' => $validated['cedula'],
            'biografia' => $validated['biografia'],
            'edad' => $validated['edad'],
            'peso' => $validated['peso'],
            'altura' => $validated['altura'],
            'genero' => $validated['genero'],
            'condicion' => $validated['condicion'],
            'tipo_afectacion' => $tipo_afectacion->nombre,
            'nivel_afectacion' => $nivel_afectacion->tipo,
        ]);

        // Crear el rol para el paciente
        Role::create([
            'user_id' => $user->id,
            'role_type' => 'paciente',
            'roleable_id' => $paciente->id,
            'roleable_type' => Paciente::class,
        ]);

        // Iniciar sesión automáticamente (opcional)
        Auth::login($user);
        // Redirigir al dashboard o página principal
        return redirect('')->with('success', 'Paciente registrado con éxito.');
    }

    public function register_doctor()
    {
        $specialties = Specialty::all();
        return view('auth.register-doctor', compact('specialties'));
    }

    public function create_doctor(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'departamento' => ['required', 'string'],
            'municipio' => ['required', 'string'],
            'domicilio' => ['required', 'string', 'max:255'],
            'cedula' => ['required', 'string', 'max:20', 'unique:pacientes'],
            'biografia' => ['required', 'string'],
            'edad' => ['required', 'integer', 'min:0'],
            'especialidad' => ['required', 'string'],
            'telefono' => ['required', 'integer', 'min:8'],
            'area' => ['required', 'string'],
            'genero' => ['required', 'string'],
            'direccion_consultorio' => ['required', 'string'],
            'google_map_direction' => ['required', 'string'],
            'titulacion' => ['required', 'string'],
            'cod_minsa' => ['required', 'string']
        ]);
        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'departamento' => $validated['departamento'],
            'municipio' => $validated['municipio'],
            'domicilio' => $validated['domicilio'],
        ]);

        if ($request->hasFile('profile_picture')) {
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            $imageName = time() . '.' . $extension;
            $request->file('profile_picture')->storeAs('images/profile_pictures', $imageName, 'public');
            $user->profile_picture = $imageName;
            $user->save();
        }
        $doctor = Doctor::create([
            'cedula' => $validated['cedula'],
            'biografia' => $validated['biografia'],
            'edad' => $validated['edad'],
            'genero' => $validated['genero'],
            'especialidad' => $validated['especialidad'],
            'telefono' => $validated['telefono'],
            'area' => $validated['area'],
            'direccion_consultorio' => $validated['direccion_consultorio'],
            'google_map_direction' => $validated['google_map_direction'],
            'titulacion' => $validated['titulacion'],
            'cod_minsa' => $validated['cod_minsa'],
        ]);
         // Crear el rol para el paciente
         Role::create([
            'user_id' => $user->id,
            'role_type' => 'doctor',
            'roleable_id' => $doctor->id,
            'roleable_type' => Doctor::class,
        ]);

        // Iniciar sesión automáticamente (opcional)
        Auth::login($user);
        // Redirigir al dashboard o página principal
        return redirect('Administracion/doctor/index')->with('success', 'Medico registrado con éxito.');
    }
}
