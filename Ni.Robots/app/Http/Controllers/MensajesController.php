<?php

namespace App\Http\Controllers;

use App\Models\Mensajes;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Role as UserRole;
use App\Models\VideoCall;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

use App\Notifications\NewMessageNotification;
use App\Events\VideoCallEvent;

// Agora (peterujah/php-agora-tokens)
use Peterujah\Agora\Agora;
use Peterujah\Agora\User as AgoraUser;
use Peterujah\Agora\Roles;
use Peterujah\Agora\Builders\RtcToken;

class MensajesController extends Controller
{
    public function index()
    {
        return view('mensajes.index');
    }

    // ================== CONTACT LIST ==================
    public function contact_list_messages()
    {
        try {
            $authUser = Auth::user();
            if (!$authUser || !$authUser->role) {
                return response()->json([
                    'success' => false,
                    'html' => '<p class="text-gray-500 dark:text-gray-400">Error: usuario sin rol.</p>'
                ]);
            }

            $roleType   = $authUser->role->role_type;
            $roleableId = $authUser->role->roleable_id;

            $users = collect(); $appointmentUsers = collect(); $otherUsers = collect();

            if ($roleType === 'doctor') {
                $startDate = now()->toDateString();
                $endDate   = now()->addDays(10)->toDateString();

                $appointments = Appointment::where('doctor_id', $roleableId)
                    ->whereIn('status', ['Reservada', 'Confirmada'])
                    ->whereBetween('scheduled_date', [$startDate, $endDate])
                    ->with('patient')
                    ->orderBy('scheduled_date')
                    ->get();

                $appointmentUserIds = [];
                foreach ($appointments as $appointment) {
                    $patientRole = UserRole::where('role_type', 'paciente')
                        ->where('roleable_id', $appointment->patient_id)
                        ->first();
                    if ($patientRole) $appointmentUserIds[] = $patientRole->user_id;
                }
                $appointmentUserIds = array_values(array_unique($appointmentUserIds));
                $appointmentUsers   = User::whereIn('id', $appointmentUserIds)->get();

                $userIdsWithMessages = Mensajes::where(function ($q) {
                        $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
                    })->pluck('incoming_msg_id')
                    ->merge(
                        Mensajes::where(function ($q) {
                            $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
                        })->pluck('outgoing_msg_id')
                    )->unique()->filter(fn($id)=>$id!=Auth::id())->toArray();

                $otherContactIds = array_diff($userIdsWithMessages, $appointmentUserIds);
                $otherUsers      = User::whereIn('id', $otherContactIds)->get();

                $users = $appointmentUsers->merge($otherUsers);
            } else {
                $userIdsWithMessages = Mensajes::where(function ($q) {
                        $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
                    })->pluck('incoming_msg_id')
                    ->merge(
                        Mensajes::where(function ($q) {
                            $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
                        })->pluck('outgoing_msg_id')
                    )->unique()->filter(fn($id)=>$id!=Auth::id())->toArray();

                $users = User::whereIn('id', $userIdsWithMessages)->get();
            }

            $html = '';
            if ($users->isEmpty()) {
                $html = '<p class="text-gray-500 dark:text-gray-400">No hay contactos disponibles.</p>';
            } else {
                if ($roleType === 'doctor' && $appointmentUsers->count() > 0) {
                    $html .= '<div class="mb-4"><h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Pacientes con Citas Próximas</h3>';
                    foreach ($appointmentUsers as $user) {
                        $html .= $this->generateContactHtml($user, true, $roleableId, now()->toDateString(), now()->addDays(10)->toDateString());
                    }
                    $html .= '</div>';
                }
                if ($roleType === 'doctor' && $otherUsers->count() > 0) {
                    $html .= '<div class="mt-4"><h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Otros Contactos</h3>';
                    foreach ($otherUsers as $user) $html .= $this->generateContactHtml($user, false);
                    $html .= '</div>';
                }
                if ($roleType !== 'doctor') {
                    foreach ($users as $user) $html .= $this->generateContactHtml($user, false);
                }
            }

            return response()->json([
                'success'  => true,
                'html'     => $html,
                'count'    => $users->count(),
                'roleType' => $roleType,
            ]);
        } catch (\Throwable $e) {
            Log::error('contact_list_messages: '.$e->getMessage());
            return response()->json(['success'=>false,'html'=>'<p class="text-red-500">Error al cargar contactos</p>'],500);
        }
    }

    private function generateContactHtml($user, $showAppointmentInfo = false, $doctorRoleableId = null, $startDate = null, $endDate = null)
    {
        $isActive = !!($user->activo ?? $user->estado ?? false);
        $estado   = $isActive ? 'bg-green-500' : 'bg-red-500';

        $ultimoMensaje = Mensajes::where(function ($q) use ($user) {
                $q->where('incoming_msg_id', $user->id)->orWhere('outgoing_msg_id', $user->id);
            })->where(function ($q) {
                $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
            })->latest()->first();

        $horaMensaje     = $ultimoMensaje ? $ultimoMensaje->created_at->format('H:i') : '';
        $mensajeMostrar  = $ultimoMensaje
            ? ($ultimoMensaje->outgoing_msg_id == Auth::id() ? 'You: '.$ultimoMensaje->message : $ultimoMensaje->message)
            : 'Sin mensajes aún';

        $nextAppointmentInfo = null;
        if ($showAppointmentInfo && $doctorRoleableId) {
            $patientRole = UserRole::where('user_id', $user->id)->where('role_type', 'paciente')->first();
            if ($patientRole) {
                $nextAppointment = Appointment::where('doctor_id', $doctorRoleableId)
                    ->where('patient_id', $patientRole->roleable_id)
                    ->whereIn('status', ['Reservada', 'Confirmada'])
                    ->whereBetween('scheduled_date', [$startDate, $endDate])
                    ->orderBy('scheduled_date')->orderBy('scheduled_time')->first();
                if ($nextAppointment) {
                    $nextAppointmentInfo = [
                        'date'   => $nextAppointment->scheduled_date,
                        'time'   => $nextAppointment->scheduled_time,
                        'status' => $nextAppointment->status,
                    ];
                }
            }
        }

        $avatar = ($user->profile_picture && $user->profile_picture !== 'null.jpg')
            ? Storage::url('images/profile_pictures/'.$user->profile_picture)
            : asset('images/default-avatar.jpg');

        return View::make('mensajes.partials.contact_list', [
            'user'               => $user,
            'estado'             => $estado,
            'ultimoMensaje'      => $ultimoMensaje,
            'horaMensaje'        => $horaMensaje,
            'mensajeMostrar'     => $mensajeMostrar,
            'nextAppointmentInfo'=> $nextAppointmentInfo,
            'avatar'             => $avatar,
        ])->render();
    }

    // ================== BUSQUEDA / LISTADO ==================
    public function get_users(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $users = User::where('name', 'LIKE', '%'.$searchTerm.'%')->get();

        $html = '';
        if ($users->isEmpty()) {
            $html .= '<p class="text-gray-500 dark:text-gray-400">No hay contactos disponibles.</p>';
        } else {
            foreach ($users as $user) {
                $estado = (!!($user->activo ?? $user->estado ?? false)) ? 'bg-green-500' : 'bg-red-500';
                $img  = ($user->profile_picture && $user->profile_picture !== 'null.jpg')
                    ? Storage::url('images/profile_pictures/'.$user->profile_picture)
                    : asset('images/default-avatar.jpg');

                $last = Mensajes::where(function ($q) use ($user) {
                    $q->where('incoming_msg_id',$user->id)->orWhere('outgoing_msg_id',$user->id);
                })->latest()->first();
                $hora = $last ? $last->created_at->format('H:i') : '';

                $html .= '<a class="flex items-center space-x-4 py-2 px-1 rounded-md last-of-type:pb-0 hover:bg-slate-200 dark:hover:bg-slate-600" href="/mensajes/'.e($user->name).'/'.$user->id.'">
                    <div class="flex-shrink-0 relative">
                        <img class="w-12 h-12 object-cover rounded-full" src="'.e($img).'" alt="">
                        <div class="absolute before:w-3 before:h-3 rounded-full bottom-1 right-1 '.$estado.'"></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex justify-between">
                            <p class="text-xl lg:text-base font-semibold lg:font-medium text-gray-800 truncate dark:text-white">'.e($user->name).'</p>
                            <span class="text-xs text-gray-400">'.e($hora).'</span>
                        </div>
                        <p class="text-base lg:text-sm text-gray-500 truncate dark:text-gray-400">'.e($user->email).'</p>
                    </div>
                </a>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function searchByName(Request $request)
    {
        try {
            $searchTerm = $request->input('searchTerm');

            $userIdsWithMessages = Mensajes::where(function ($q) {
                    $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
                })->pluck('incoming_msg_id')
                ->merge(
                    Mensajes::where(function ($q) {
                        $q->where('incoming_msg_id', Auth::id())->orWhere('outgoing_msg_id', Auth::id());
                    })->pluck('outgoing_msg_id')
                )->unique()->filter(fn($id)=>$id!=Auth::id())->toArray();

            $users = User::whereIn('id', $userIdsWithMessages)
                ->where('name', 'LIKE', '%'.$searchTerm.'%')->get();

            $html = '';
            if ($users->isEmpty()) {
                $html = '<p class="text-gray-500 dark:text-gray-400">No hay contactos disponibles.</p>';
            } else {
                foreach ($users as $user) {
                    $estado = (!!($user->activo ?? $user->estado ?? false)) ? 'bg-green-500' : 'bg-red-500';
                    $last   = Mensajes::where(function ($q) use ($user) {
                            $q->where('incoming_msg_id',$user->id)->orWhere('outgoing_msg_id',$user->id);
                        })->latest()->first();
                    $hora   = $last ? $last->created_at->format('H:i') : '';
                    $avatar = ($user->profile_picture && $user->profile_picture !== 'null.jpg')
                        ? Storage::url('images/profile_pictures/'.$user->profile_picture)
                        : asset('images/default-avatar.jpg');

                    $html .= View::make('mensajes.partials.contact_list', [
                        'user'          => $user,
                        'estado'        => $estado,
                        'ultimoMensaje' => $last,
                        'horaMensaje'   => $hora,
                        'mensajeMostrar'=> $last ? $last->message : 'Sin mensajes aún',
                        'avatar'        => $avatar,
                    ])->render();
                }
            }

            return response()->json(['success'=>true,'html'=>$html]);
        } catch (\Throwable $e) {
            Log::error('searchByName: '.$e->getMessage());
            return response()->json(['success'=>false,'html'=>'<p class="text-red-500">Error en la búsqueda</p>'],500);
        }
    }

    public function chat_with($name, $id)
    {
        $user = User::find($id);
        if (!$user) return redirect()->back()->with('error', 'Usuario no encontrado');

        $lastSeenFormatted = ($user->estado ?? $user->activo ?? false) ? 'Activo' : optional($user->last_seen_at)->diffForHumans();
        return view('mensajes.chat_with', compact('user','lastSeenFormatted'));
    }

    // ================== MENSAJES ==================
    public function store(Request $request)
    {
        $this->ensureSessionCurrent();
        try {
            $validated = $request->validate([
                'message'     => 'required|string',
                'receiver_id' => 'required|exists:users,id',
            ]);

            $message = Mensajes::create([
                'incoming_msg_id' => $validated['receiver_id'],
                'outgoing_msg_id' => Auth::id(),
                'message'         => $validated['message'],
            ]);

            $receiver = User::find($validated['receiver_id']);
            if ($receiver) {
                $sender = [
                    'name'   => Auth::user()->name,
                    'avatar' => Auth::user()->profile_picture ?: 'default-avatar.jpg',
                ];
                $receiver->notify(new NewMessageNotification('message', $message->message, $sender));
            }

            return response()->json(['status' => 'Mensaje enviado']);
        } catch (\Throwable $e) {
            Log::error('store message: '.$e->getMessage());
            return response()->json(['status'=>'error','message'=>'Failed to send message.'],500);
        }
    }

    public function show($receiver_id)
    {
        $me = Auth::id();
        $messages = Mensajes::where(function ($q) use ($me,$receiver_id) {
                $q->where('outgoing_msg_id',$me)->where('incoming_msg_id',$receiver_id);
            })->orWhere(function ($q) use ($me,$receiver_id) {
                $q->where('outgoing_msg_id',$receiver_id)->where('incoming_msg_id',$me);
            })->orderBy('created_at','asc')->get();

        $html = '';
        foreach ($messages as $m) {
            $time = $m->created_at->format('H:i');
            $content = e($m->message);
            if ($m->outgoing_msg_id == $me) {
                $html .= View::make('mensajes.partials.sent_messages', compact('time','content'))->render();
            } else {
                $user = User::find($m->outgoing_msg_id) ?: (object)['name'=>'Usuario','profile_picture'=>'default-avatar.jpg'];
                $html .= View::make('mensajes.partials.received_message', ['time'=>$time,'content'=>$content,'user'=>$user])->render();
            }
        }
        return response()->json(['html'=>$html]);
    }

    // ================== AGORA TOKEN ==================
    private function generateAgoraToken(string $channelName, int $uid): array
    {
        $appID          = config('services.agora.app_id', env('AGORA_APP_ID'));
        $appCertificate = config('services.agora.certificate', env('AGORA_APP_CERTIFICATE'));
        if (empty($appID) || empty($appCertificate)) {
            throw new \Exception('Agora no configurado: services.agora.app_id / certificate');
        }

        $expireSeconds      = (int) env('AGORA_TOKEN_EXPIRE_SECONDS', 3600);
        $privilegeExpiredTs = time() + $expireSeconds;

        $client = new Agora($appID, $appCertificate);
        $client->setExpiration($privilegeExpiredTs);

        $agoraUser = (new AgoraUser($uid))
            ->setPrivilegeExpire($privilegeExpiredTs)
            ->setChannel($channelName)
            ->setRole(Roles::RTC_PUBLISHER);

        $token = RtcToken::buildTokenWithUid($client, $agoraUser);

        return [
            'token'        => $token,
            'channel_name' => $channelName,
            'uid'          => $uid,
            'app_id'       => $appID,
            'expire_at'    => $privilegeExpiredTs
        ];
    }

    /**
     * UID de Agora estable por SESIÓN (evita conflictos multi-navegador).
     */
    private function getAgoraUid(): int
    {
        $uid = Session::get('agora_uid');
        if (!$uid) {
            $uid = abs(crc32(Session::getId())); // uint32 estable por sesión
            Session::put('agora_uid', $uid);
        }
        return (int) $uid;
    }

    /**
     * Defensa extra: si la sesión no es la vigente del usuario, corta.
     */
    private function ensureSessionCurrent(): void
    {
        if (!Auth::check()) return;

        $user = Auth::user();
        $sid  = Session::getId();

        if (!empty($user->current_session_id) && $user->current_session_id !== $sid) {
            abort(response()->json([
                'success' => false,
                'code'    => 'DUPLICATE_SESSION',
                'message' => 'Sesión duplicada detectada. Vuelve a iniciar sesión en esta ventana.',
            ], 409));
        }
    }

    // ================== VIDEOLLAMADA (flujo controlado) ==================
    public function startVideoCall(Request $request)
    {
        try {
            $validated = $request->validate([
                'receiver_id' => 'required|exists:users,id',
                'call_type'   => 'required|in:telehealth,presential',
            ]);

            $fromUserId  = Auth::id();
            $toUserId    = (int) $validated['receiver_id'];
            $callType    = $validated['call_type'];
            $channelName = $this->generateStableChannelName($fromUserId, $toUserId);

            // cierra ringings previos
            VideoCall::where(function ($q) use ($fromUserId,$toUserId) {
                    $q->where('from_user_id',$fromUserId)->where('to_user_id',$toUserId);
                })->orWhere(function ($q) use ($fromUserId,$toUserId) {
                    $q->where('from_user_id',$toUserId)->where('to_user_id',$fromUserId);
                })->where('status','ringing')->update(['status'=>'ended']);

            $this->ensureSessionCurrent();

            // Crea la fila SIN token
            $videoCall = VideoCall::create([
                'from_user_id' => $fromUserId,
                'to_user_id'   => $toUserId,
                'call_type'    => $callType,
                'channel_name' => $channelName,
                'expires_at'   => now()->addMinutes(2),
                'status'       => 'ringing',
            ]);

            // Token SOLO para el que llama (UID de sesión)
            $callerUid = $this->getAgoraUid();
            $agora     = $this->generateAgoraToken($channelName, $callerUid);

            try {
                broadcast(new VideoCallEvent([
                    'id'=>$videoCall->id,
                    'from_user_id'=>$fromUserId,
                    'to_user_id'=>$toUserId,
                    'call_type'=>$callType,
                    'channel_name'=>$channelName,
                    'status'=>'ringing',
                    'is_incoming'=>true
                ], $toUserId));
            } catch (\Throwable $e) {
                Log::warning('VideoCallEvent start: '.$e->getMessage());
            }

            return response()->json([
                'success'       => true,
                'call_id'       => $videoCall->id,
                'channel_name'  => $channelName,
                'app_id'        => $agora['app_id'],
                'uid'           => $callerUid,
                'agora_token'   => $agora['token'],
                'token_expire_at' => $agora['expire_at'],
            ]);
        } catch (\Throwable $e) {
            Log::error('startVideoCall: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>'Error al iniciar la videollamada'],500);
        }
    }

    public function acceptVideoCall(Request $request)
    {
        try {
            $validated = $request->validate(['call_id'=>'required|exists:video_calls,id']);

            $videoCall = VideoCall::where('id',$validated['call_id'])
                ->where('to_user_id', Auth::id())
                ->where('status','ringing')->first();

            if (!$videoCall) {
                return response()->json(['success'=>false,'message'=>'Llamada no encontrada o expirada'],404);
            }

            $this->ensureSessionCurrent();

            // Actualiza estado (NO guardes token aquí)
            $videoCall->update([
                'status'     => 'accepted',
                'expires_at' => now()->addHours(1),
            ]);

            // Token SOLO para el receptor (UID de sesión)
            $calleeUid = $this->getAgoraUid();
            $agora     = $this->generateAgoraToken($videoCall->channel_name, $calleeUid);

            try {
                broadcast(new VideoCallEvent([
                    'id'=>$videoCall->id,
                    'from_user_id'=>$videoCall->from_user_id,
                    'to_user_id'=>$videoCall->to_user_id,
                    'call_type'=>$videoCall->call_type,
                    'channel_name'=>$videoCall->channel_name,
                    'status'=>'accepted',
                    'is_incoming'=>false
                ], $videoCall->from_user_id));
            } catch (\Throwable $e) {
                Log::warning('VideoCallEvent accept: '.$e->getMessage());
            }

            return response()->json([
                'success'       => true,
                'channel_name'  => $videoCall->channel_name,
                'app_id'        => $agora['app_id'],
                'uid'           => $calleeUid,
                'agora_token'   => $agora['token'],
                'token_expire_at' => $agora['expire_at'],
            ]);
        } catch (\Throwable $e) {
            Log::error('acceptVideoCall: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>'Error al aceptar la videollamada'],500);
        }
    }

    public function declineVideoCall(Request $request)
    {
        $this->ensureSessionCurrent();
        try {
            $validated = $request->validate(['call_id'=>'required|exists:video_calls,id']);

            $videoCall = VideoCall::where('id',$validated['call_id'])
                ->where(function ($q) {
                    $q->where('to_user_id',Auth::id())->orWhere('from_user_id',Auth::id());
                })->where('status','ringing')->first();

            if (!$videoCall) {
                return response()->json(['success'=>false,'message'=>'Llamada no encontrada o ya no suena'],404);
            }

            $videoCall->update(['status'=>'declined','expires_at'=>now()]);

            try {
                $otherUserId = $videoCall->from_user_id == Auth::id() ? $videoCall->to_user_id : $videoCall->from_user_id;
                broadcast(new VideoCallEvent([
                    'id'=>$videoCall->id,'status'=>'declined','declined_by'=>Auth::id()
                ], $otherUserId));
            } catch (\Throwable $e) {
                Log::warning('VideoCallEvent decline: '.$e->getMessage());
            }

            return response()->json(['success'=>true]);
        } catch (\Throwable $e) {
            Log::error('declineVideoCall: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>'Error al rechazar la llamada'],500);
        }
    }

    public function endVideoCall(Request $request)
    {
        $this->ensureSessionCurrent();
        try {
            $validated = $request->validate(['call_id'=>'required|exists:video_calls,id']);

            $videoCall = VideoCall::where('id',$validated['call_id'])
                ->where(function ($q) {
                    $q->where('from_user_id',Auth::id())->orWhere('to_user_id',Auth::id());
                })->whereIn('status',['ringing','accepted'])->first();

            if ($videoCall) {
                $videoCall->update(['status'=>'ended']);
                $otherUserId = $videoCall->from_user_id == Auth::id() ? $videoCall->to_user_id : $videoCall->from_user_id;
                try {
                    broadcast(new VideoCallEvent(['id'=>$videoCall->id,'status'=>'ended','ended_by'=>Auth::id()], $otherUserId));
                } catch (\Throwable $e) {
                    Log::warning('VideoCallEvent end: '.$e->getMessage());
                }
            }
            return response()->json(['success'=>true,'message'=>'Llamada finalizada']);
        } catch (\Throwable $e) {
            Log::error('endVideoCall: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>'Error al finalizar la videollamada'],500);
        }
    }

    public function checkVideoCallStatus(Request $request)
    {
        $this->ensureSessionCurrent();
        try {
            $validated = $request->validate(['receiver_id'=>'required|exists:users,id']);

            $me = Auth::id(); $other = (int)$validated['receiver_id'];

            $videoCall = VideoCall::where(function ($q) use ($me,$other) {
                    $q->where('from_user_id',$other)->where('to_user_id',$me); // entrante
                })->orWhere(function ($q) use ($me,$other) {
                    $q->where('from_user_id',$me)->where('to_user_id',$other); // saliente
                })->whereIn('status',['ringing','accepted'])
                ->where('expires_at','>',now())->latest()->first();

            if ($videoCall) {
                return response()->json([
                    'success'=>true,
                    'call'=>[
                        'id'           => $videoCall->id,
                        'from_user_id' => $videoCall->from_user_id,
                        'to_user_id'   => $videoCall->to_user_id,
                        'call_type'    => $videoCall->call_type,
                        'channel_name' => $videoCall->channel_name,
                        'status'       => $videoCall->status,
                        'is_incoming'  => $videoCall->to_user_id == $me,
                    ],
                ]);
            }
            return response()->json(['success'=>true,'call'=>null]);
        } catch (\Throwable $e) {
            Log::error('checkVideoCallStatus: '.$e->getMessage());
            return response()->json(['success'=>false,'message'=>'Error al verificar estado de llamada'],500);
        }
    }

    public function cleanupExpiredCalls()
    {
        try {
            $expired = VideoCall::where('expires_at','<',now())
                ->whereIn('status',['ringing','accepted'])
                ->update(['status'=>'ended']);
            return response()->json(['success'=>true,'cleaned'=>$expired]);
        } catch (\Throwable $e) {
            Log::error('cleanupExpiredCalls: '.$e->getMessage());
            return response()->json(['success'=>false],500);
        }
    }

    private function generateStableChannelName($userId1, $userId2)
{
    $a = (int) $userId1;
    $b = (int) $userId2;
    $pair = [$a, $b];
    sort($pair);

    // Canal único por llamada, pero fácil de identificar por pares de usuarios
    $uniqueSuffix = substr(sha1(uniqid((string)microtime(true), true)), 0, 8);

    return 'dm_' . $pair[0] . '_' . $pair[1] . '_' . $uniqueSuffix;
}

}
