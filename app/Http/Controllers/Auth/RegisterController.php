<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    protected $redirectTo = '/home';

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
            'departamento' => DB::table('departamentos') ->where('id', $data['departamento'])->value('nombre'), 
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
}
