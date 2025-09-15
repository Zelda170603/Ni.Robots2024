<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\Specialty;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function index_user()
    {
        $doctors = User::whereHas('role', function ($query) {
            $query->where('role_type', 'doctor');
        })->with('doctor')->paginate(12);

        return view('doctores.index_user', compact("doctors"));
    }

    public function show($doctor) {
        $medico = User::whereHas('role', function ($query) use ($doctor) {
            $query->where('role_type', 'doctor')->where('roleable_id', $doctor);
        })->with('doctor.specialty')->first();

        return view('doctores.show')->with('medico', $medico);
    }

    public function searchByName(Request $request)
    {
        try {
            $searchTerm = $request->input('searchTerm');

            $doctores = User::whereHas('role', function ($query) {
                $query->where('role_type', 'doctor');
            })->with('doctor')->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhereHas('doctor', function ($query) use ($searchTerm) {
                        $query->where('especialidad', 'LIKE', '%' . $searchTerm . '%');
                    });
            })
                ->get();

            $html = View::make('doctores.partials.search_result', ['doctores' => $doctores])->render();
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while searching for doctors: ' . $e->getMessage()], 500);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del medico es obligatorio',
            'name.min' => 'El nombre del medico debe tener mas de 3 caracteres',
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'Ingresa una direccion de correo valida',
            'cedula.required' => 'La cedula es obligatirio',
            'cedula.required' => 'El numero de cedula debe tener 15 digitos',
            'address.required' => 'La direcciond debe tener mas de 6 digitos',
            'phone.required' => 'El numero de telefono debe ser obligatorio',
        ];

        $this->validate($request, $rules, $messages);
        /**
         * creammos un arreglo asosiativo, la informacion del rquest
         */
        $user = User::create(
            $request->only('name', 'email', 'cedula', 'address', 'phone')
                + [
                    'role' => 'doctor',
                    'password' => bcrypt($request->input('password'))
                ]
        );

        $user->specialties()->attach($request->input('specialties'));
        /**
         * al crear al usuario retornaremos a la pagina de los medicos
         */
        $notification = 'El medico se ha creado exitosamente.';

        return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Specialty::all();

        $specialties_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialties_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del medico es obligatorio',
            'name.min' => 'El nombre del medico debe tener mas de 3 caracteres',
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'Ingresa una direccion de correo valida',
            'cedula.required' => 'La cedula es obligatirio',
            'cedula.required' => 'El numero de cedula debe tener 15 digitos',
            'address.required' => 'La direcciond debe tener mas de 6 digitos',
            'phone.required' => 'El numero de telefono debe ser obligatorio',
        ];

        $this->validate($request, $rules, $messages);
        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name', 'email', 'cedula', 'address', 'phone');
        $password = $request->input('password');

        if ($password)
            $data['password'] = bcrypt($password);
        $user->fill($data);
        $user->save();
        $user->specialties()->sync($request->input('specialties'));

        /**
         * al crear al usuario retornaremos a la pagina de los medicos
         */
        $notification = 'El información del medico se ha actualizado exitosamente.';
        return redirect('/medicos')->with(compact('notification'));
    }


    public function destroy(string $id)
    {
        //para obtener el id del usuario creamos user
        $user = User::doctors()->findOrFail($id);
        $doctorName = $user->name;
        $user->delete();

        $notification = "El médico $doctorName se ha eliminado con exito";

        return redirect('/medicos')->with(compact('notification'));
    }
}
