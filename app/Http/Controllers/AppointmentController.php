<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Models\User;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Reserva_cita;

class AppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->role->role_type;  // Obtener el tipo de rol del usuario autenticado
        $id_rol = $user->role->roleable_id;  // Obtener el ID del roleable (doctor o paciente)
        $layout = $role == 'doctor' ? 'layouts.adminLY' : 'layouts.app';

        // Construir la consulta base
        $query = Appointment::query();

        // Filtrar las citas según el rol del usuario autenticado
        if ($role == 'doctor') {
            $query->where('doctor_id', $id_rol)->with('patient');
        } elseif ($role == 'paciente') {
            $query->where('patient_id', $id_rol)->with('doctor');
        }

        // Obtener todas las citas con los datos de los doctores/pacientes cargados
        $appointments = $query->get();

        // Almacenar la información de los usuarios relacionados (doctores o pacientes)
        $relatedUsers = [];

        foreach ($appointments as $appointment) {
            if ($role == 'paciente') {
                // Obtener el user_id del doctor
                $doctorRole = Role::where("roleable_id", $appointment->doctor_id)
                    ->where('role_type', 'doctor')->first();
                $relatedUser = User::with('role.roleable')->find($doctorRole->user_id);
                // Almacenar en el array el doctor relacionado a esta cita
                $relatedUsers[$appointment->id] = $relatedUser;
            } elseif ($role == 'doctor') {
                // Obtener el user_id del paciente
                $patientRole = Role::where("roleable_id", $appointment->patient_id)
                    ->where('role_type', 'paciente')->first();
                $relatedUser = User::with('role.roleable')->find($patientRole->user_id);
                // Almacenar en el array el paciente relacionado a esta cita
                $relatedUsers[$appointment->id] = $relatedUser;
            }
        }

        // Filtrar las citas basadas en el estado
        $confirmedAppointments = $appointments->where('status', 'Confirmada');
        $pendingAppointments = $appointments->where('status', 'Reservada');
        $oldAppointments = $appointments->whereIn('status', ['Atendida', 'Cancelada']);

        // Pasar las citas, usuarios relacionados, el rol, y el layout a la vista
        return view('appointments.index', compact('confirmedAppointments', 'pendingAppointments', 'oldAppointments', 'role', 'layout', 'relatedUsers'));
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

    public function create_with_medico($doctorId, HorarioServiceInterface $horarioServiceInterface)
    {
        // Obtener el doctor en específico basado en el ID pasado como parámetro
        $medico = User::whereHas('role', function ($query) use ($doctorId) {
            $query->where('role_type', 'doctor')->where('roleable_id', $doctorId);
        })->with('doctor.specialty')->first(); // Usar first() para obtener un único registro
        // Verificar si el doctor fue encontrado
        if (!$medico) {
            abort(404, 'Doctor no encontrado.');
        }
        // Cargar la especialidad relacionada con el doctor
        $specialty = $medico->doctor->especialidad; // Acceder a la especialidad del modelo Doctor

        // Obtener la fecha y validar si se seleccionó una fecha específica para obtener los intervalos disponibles
        $date = old('scheduled_date');
        if ($date) {
            // Obtener los intervalos disponibles en la fecha y el doctor específico
            $intervals = $horarioServiceInterface->getAvaiableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        }

        // Retornar la vista con los datos del doctor y los intervalos
        return view('appointments.create_with_doctor', compact('medico', 'specialty', 'intervals'));
    }



    public function store(Request $request, HorarioServiceInterface $horarioServiceInterface)
    {
        // Reglas de validación
        $rules = [
            'scheduled_time' => 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' =>  'exists:users,id',
            'specialty' => 'required'
        ];

        // Mensajes de error
        $messages = [
            'scheduled_time.required' => 'Debe seleccionar una hora valida para su cita.',
            'type.required' => 'Debe seleccionar el tipo de consulta',
            'description.required' => 'Debe poner sus sintomas.'
        ];

        // Validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Validación adicional después de crear el validador
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

        // Si hay errores de validación, regresar con los errores y la entrada anterior
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Obtener solo los datos necesarios del request
        $data = $request->only([
            'scheduled_date',
            'scheduled_time',
            'type',
            'description',
            'doctor_id',
            'specialty'
        ]);

        $user = auth()->user();
        // Obtener el ID del paciente asociado al rol
        $patientRole = Role::where("user_id", $user->id)->first();

        // Asignar el ID del paciente según el rol
        if ($user->role->role_type === 'admin') {
            $request->validate([
                'patient_id' => 'required|exists:pacientes,id',
            ]);
            $data['patient_id'] = $patientRole->roleable_id;
        } else {
            $data['patient_id'] = $patientRole->roleable_id;
        }

        // Convertir el tiempo a formato 24 horas
        $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        // Crear la cita
        Appointment::create($data);

        $notification = 'La cita se ha realizado correctamente.';

        // Obtener el usuario receptor (doctor)
        $receiver = Role::where('roleable_id', $request->input('doctor_id'))
            ->where('role_type', 'doctor')->first('user_id');

        if ($receiver) {
            // Encontrar el usuario receptor por ID
            $user = User::find($receiver->user_id);

            // Obtener el remitente (paciente o admin)
            $sender = [
                'name' => Auth::user()->name,
                'avatar' => Auth::user()->profile_picture,
            ];

            // Enviar la notificación si el usuario receptor existe
            if ($user) {
                $user->notify(new Reserva_cita("reserva_cita", $sender));
            }
        }

        // Redireccionar con notificación
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
