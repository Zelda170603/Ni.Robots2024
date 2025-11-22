<?php

namespace App\Http\Controllers;

use App\Interfaces\HorarioServiceInterface;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Reserva_cita;
use Illuminate\Support\Facades\Log; 


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

        $events = []; // Inicializar el array de eventos
        $relatedUsers = []; // Array para almacenar los usuarios relacionados

        function createEvent($appointment, $relatedUser)
        {
            return [
                'title' => $appointment->specialty,
                'start' => $appointment->scheduled_date . 'T' . $appointment->scheduled_time,
                'description' => $appointment->description,
                'status' => $appointment->status,
                'type' => $appointment->type,
                'doctor' => [
                    'name' => $relatedUser->name ?? 'No disponible', // Nombre del médico
                    'email' => $relatedUser->email ?? 'No disponible', // Correo del médico
                    'profile_picture' => $relatedUser->profile_picture ?? '', // Foto de perfil del médico
                ],
                'patient' => [
                    'name' => $appointment->patient->name ?? 'No disponible', // Nombre del paciente
                    'email' => $appointment->patient->email ?? 'No disponible', // Correo del paciente
                    'profile_picture' => $appointment->patient->profile_picture ?? '', // Foto de perfil del paciente
                ],
            ];
        }

        foreach ($appointments as $appointment) {
            // Verifica el rol del usuario actual
            if ($role == 'paciente') {
                // Obtener el user_id del doctor
                $doctorRole = Role::where("roleable_id", $appointment->doctor_id)
                    ->where('role_type', 'doctor')->first();
                    
                $relatedUser = User::with('role.roleable')->find($doctorRole->user_id);

                // Almacenar en el array el doctor relacionado a esta cita
                $relatedUsers[$appointment->id] = $relatedUser;

                // Agregar el evento usando la función createEvent
                $events[] = createEvent($appointment, $relatedUser);
            } elseif ($role == 'doctor') {
                // Obtener el user_id del paciente
                $patientRole = Role::where("roleable_id", $appointment->patient_id)
                    ->where('role_type', 'paciente')->first();
                $relatedUser = User::with('role.roleable')->find($patientRole->user_id);

                // Almacenar en el array el paciente relacionado a esta cita
                $relatedUsers[$appointment->id] = $relatedUser;

                // Agregar el evento usando la función createEvent
                $events[] = createEvent($appointment, $relatedUser);
            }
        }

        // Filtrar las citas basadas en el estado
        $confirmedAppointments = $appointments->where('status', 'Confirmada');
        $pendingAppointments = $appointments->where('status', 'Reservada');
        $oldAppointments = $appointments->whereIn('status', ['Atendida', 'Cancelada']);

        // Pasar las citas, usuarios relacionados, el rol, y el layout a la vista
        return view('appointments.index', compact('confirmedAppointments', 'pendingAppointments', 'oldAppointments', 'role', 'events', 'layout', 'relatedUsers'));
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

    public function create_with_medico($medicoId, HorarioServiceInterface $horarioServiceInterface)
{
    // El parámetro $medicoId es el user_id del doctor
    // Buscar el doctor por su user_id
    $medico = User::whereHas('role', function ($query) use ($medicoId) {
            $query->where('role_type', 'doctor')
                  ->where('user_id', $medicoId); // Buscar por user_id
        })->with(['role', 'doctor'])->first();

    // Verificar si el doctor fue encontrado
    if (!$medico) {
        abort(404, 'Doctor no encontrado.');
    }

    // Obtener el doctor_id real (id de la tabla doctor) para los intervalos
    $realDoctorId = $medico->role->roleable_id;
    
    // Cargar la especialidad relacionada con el doctor
    $specialty = $medico->doctor->especialidad ?? 'General';

    // Obtener la fecha y validar si se seleccionó una fecha específica para obtener los intervalos disponibles
    $date = old('scheduled_date');
    
    if ($date && $realDoctorId) {
        // Obtener los intervalos disponibles en la fecha y el doctor específico
        // Pasar el realDoctorId (id de tabla doctor) no el user_id
        $intervals = $horarioServiceInterface->getAvaiableIntervals($date, $realDoctorId);
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
        'doctor_id' => 'required|exists:users,id', // Asegurar que viene el doctor_id
        'specialty' => 'required'
    ];

    // Mensajes de error
    $messages = [
        'scheduled_time.required' => 'Debe seleccionar una hora valida para su cita.',
        'type.required' => 'Debe seleccionar el tipo de consulta',
        'description.required' => 'Debe poner sus sintomas.',
        'doctor_id.required' => 'Debe seleccionar un doctor.',
        'doctor_id.exists' => 'El doctor seleccionado no existe.'
    ];

    // Validación
    $validator = Validator::make($request->all(), $rules, $messages);

    // Validación adicional después de crear el validador
    $validator->after(function ($validator) use ($request, $horarioServiceInterface) {
        $date = $request->input('scheduled_date');
        $doctorUserId = $request->input('doctor_id'); // Este es el user_id del doctor
        $scheduled_time = $request->input('scheduled_time');

        if ($date && $doctorUserId && $scheduled_time) {
            // Obtener el doctor_id real (id de la tabla doctor)
            $doctorRole = Role::where('user_id', $doctorUserId)
                            ->where('role_type', 'doctor')
                            ->first();
            
            if ($doctorRole) {
                $realDoctorId = $doctorRole->roleable_id;
                $start = new Carbon($scheduled_time);
                
                if (!$horarioServiceInterface->isAvaibleInterval($date, $realDoctorId, $start)) {
                    $validator->errors()->add(
                        'available_time',
                        'La hora seleccionada ya se encuentra seleccionada por otro paciente.'
                    );
                }
            }
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
        'doctor_id', // Este es el user_id del doctor del formulario
        'specialty'
    ]);

    $user = Auth::user();
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

    // CORRECCIÓN: Convertir el user_id del doctor al doctor_id real
    $doctorRole = Role::where('user_id', $data['doctor_id'])
                      ->where('role_type', 'doctor')
                      ->first();
    
    if (!$doctorRole) {
        return back()->withErrors(['doctor_id' => 'Doctor no encontrado.'])->withInput();
    }
    
    // Aquí asignamos el doctor_id correcto para la tabla appointments
    $data['doctor_id'] = $doctorRole->roleable_id;

    // Convertir el tiempo a formato 24 horas
    $carbonTime = Carbon::createFromFormat('g:i A', $data['scheduled_time']);
    $data['scheduled_time'] = $carbonTime->format('H:i:s');

    // Crear la cita
    $appointment = Appointment::create($data);

    $notification = 'La cita se ha realizado correctamente.';

    // Obtener el usuario receptor (doctor) - Usar el user_id original del formulario
    $receiver = User::find($request->input('doctor_id')); // El user_id original del doctor

    if ($receiver) {
        // Obtener el remitente (paciente o admin)
        $sender = [
            'name' => Auth::user()->name,
            'avatar' => Auth::user()->profile_picture,
        ];

        // Enviar la notificación si el usuario receptor existe
        if ($receiver) {
            $receiver->notify(new Reserva_cita("reserva_cita", $sender));
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
            $cancellation->cancelled_by_id = Auth::id();
            //$cancellation->cancelled_by_id = auth()->id();

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
            $role = Auth::user()->role;
            //$role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment', 'role'));
        }
        return redirect('/miscitas');
    }

    public function show(Appointment $appointment)
    {

        $role = Auth::user()->role->role_type;
        $layout = $role == 'doctor' ? 'layouts.adminLY' : 'layouts.app';
        return view('appointments.show', compact('appointment', 'role', "layout"));
    }
}
