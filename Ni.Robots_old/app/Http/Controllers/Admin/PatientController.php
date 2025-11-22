<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::patients()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
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
            'name.required' => 'El nombre del paciente es obligatorio',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres',
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
        User :: create(
            $request->only('name','email','cedula','address','phone')
            +[
                'role' => 'paciente',
                'password' => bcrypt($request->input('password'))
            ]
        );
    /**
     * al crear al usuario retornaremos a la pagina de los medicos
     */
    $notification= 'El paciente se ha creado exitosamente.';

    return redirect('/pacientes')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Scope creado dentro del modelo user
        $patient= User::Patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
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
            'name.required' => 'El nombre del paciente es obligatorio',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres',
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'Ingresa una direccion de correo valida',
            'cedula.required' => 'La cedula es obligatirio',
            'cedula.required' => 'El numero de cedula debe tener 15 digitos',
            'address.required' => 'La direcciond debe tener mas de 6 digitos',
            'phone.required' => 'El numero de telefono debe ser obligatorio',
        ];

        $this->validate($request, $rules, $messages);
        $user = User::Patients()->findOrFail($id);

        $data = $request->only('name','email','cedula','address','phone');
        $password = $request->input('password');
        
        if($password)
            $data['password'] = bcrypt($password);
        $user->fill($data);
        $user->save();
        
    /**
     * al crear al usuario retornaremos a la pagina de los medicos
     */
    $notification= 'El información del paciente se ha actualizado exitosamente.';
    return redirect('/pacientes')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::Patients()->findOrFail($id);
        $pacienteName = $user->name;
        $user->delete();

        $notification = "El paciente $pacienteName se ha eliminado con exito";

        return redirect('/pacientes')->with(compact('notification'));
    }
}
