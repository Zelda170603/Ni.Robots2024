<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Horarios;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->role_type;
        $id_rol = $user->role->roleable_id;
        $layout = $role == 'doctor' ? 'layouts.adminLY' : 'layouts.app';
        // Construir la consulta base
        $query = Appointment::query();
        if ($role == 'doctor') {
            $query->where('doctor_id', $id_rol);
        } elseif ($role == 'paciente') {
            $query->where('patient_id', $id_rol);
        }

        // Obtener todas las citas
        $appointments = $query->get();

        // Almacenar la información de los usuarios (doctores o pacientes) en una variable
        $relatedUsers = [];

        foreach ($appointments as $appointment) {
            if ($role == 'paciente') {
                // Obtener el user_id del doctor
                $doctorRole = Role::where("roleable_id", $appointment->doctor_id)->first();
                $doctor = User::with('role.roleable')->find($doctorRole->user_id);
                // Almacenar en el array el doctor relacionado a esta cita
                $relatedUsers[$appointment->id] = $doctor;
            } elseif ($role == 'doctor') {
                // Obtener el user_id del paciente
                $patientRole = Role::where("roleable_id", $appointment->patient_id)->first();
                $patient = User::with('role.roleable')->find($patientRole->user_id);
                // Almacenar en el array el paciente relacionado a esta cita
                $relatedUsers[$appointment->id] = $patient;
            }
        }

        // Filtrar las citas basadas en el estado
        $confirmedAppointments = $appointments->where('status', 'Confirmada');
        $pendingAppointments = $appointments->where('status', 'Reservada');
        $oldAppointments = $appointments->whereIn('status', ['Atendida', 'Cancelada']);

        // Pasar las citas y los usuarios relacionados a la vista
        return view('appointments.index', compact('confirmedAppointments', 'pendingAppointments', 'oldAppointments', 'role', 'relatedUsers', 'layout'));
    }



    //
    public function create(HorarioServiceInterface $horarioServiceInterface)
    {
        $specialties = Specialty::all();
        $specialtyId = old('specialty_id');
        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $horarioServiceInterface->getAvaiableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        }


        return view('appointments.create', compact('specialties', 'intervals'));
    }

    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface)
    {

        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' =>  'exists:users,id',
            'specialty' => 'required'
        ];


        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora valida para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta',
            'description' => 'Debe poner sus sintomas.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $horarioServiceInterface) {
            $date = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');

            if ($date && $doctorId && $scheduled_time) {
                $start = new Carbon($scheduled_time);
            } else {
                return;
            }

            if (!$horarioServiceInterface->isAvaibleInterval($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'available_time',
                    'La hora seleccionada ya se encuentra seleccionada por otro paciente.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'scheduled_date',
            'scheduled_time',
            'type',
            'description',
            'doctor_id',
            'specialty'
        ]);
        $user = auth()->user();
        // Obtener el ID del paciente asociado
        $patientRole = Role::where("user_id", $user->id)->first();

        // Verificar el rol del usuario y asignar el ID del paciente
        if ($user->role->role_type === 'admin') {
            $request->validate([
                'patient_id' => 'required|exists:pacientes,id',
            ]);
            $data['patient_id'] = $request->input('patient_id');
        } else {
            // Asignar el roleable_id como patient_id
            $data['patient_id'] = $patientRole->roleable_id;
        }

        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        Appointment::create($data);

        $notification = 'La cita se ha relizado correctamente.';
        return redirect('/miscitas')->with(compact('notification'));
    }

    public function cancel(Appointment $appointment, Request $request)
    {

        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by_id = auth()->id();

            $appointment->cancellation()->save($cancellation);
        }
        $appointment->status = 'Cancelada';
        $appointment->save();
        $notification = 'La cita se ha cancelado correctamente.';
        return redirect('/miscitas')->with(compact('notification'));
    }

    public function confirm(Appointment $appointment)
    {


        $appointment->status = 'Confirmada';
        $appointment->save();
        $notification = 'La cita se ha confirmado.';
        return redirect('/miscitas')->with(compact('notification'));
    }


    public function formCancel(Appointment $appointment)
    {
        if ($appointment->status == 'Confirmada') {
            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment', 'role'));
        }
        return redirect('/miscitas');
    }

    public function show(Appointment $appointment)
    {

        $role = Auth::user()->role->role_type;
        return view('appointments.show', compact('appointment', 'role'));
    }
}
