<?php

namespace App\Http\Controllers;

use App\Models\Mensajes;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Notifications\NewMessageNotification;

class MensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("mensajes.index");
    }

    public function contact_list_messages()
    {
        // Obtener los IDs de los usuarios con los que el usuario autenticado ha tenido mensajes
        $userIdsWithMessages = Mensajes::where('incoming_msg_id', Auth::id())
            ->orWhere('outgoing_msg_id', Auth::id())
            ->pluck('incoming_msg_id')
            ->merge(Mensajes::where('incoming_msg_id', Auth::id())
                ->orWhere('outgoing_msg_id', Auth::id())
                ->pluck('outgoing_msg_id'))
            ->unique()
            ->filter(fn($id) => $id != Auth::id()) // Excluir el usuario autenticado
            ->toArray();

        // Obtener los usuarios con los IDs obtenidos
        $users = User::whereIn('id', $userIdsWithMessages)->get();
        // Inicializar una variable para almacenar el HTML
        $html = '';
        // Construir el HTML para cada usuario
        if ($users->isEmpty()) {
            // No hay contactos disponibles
            $html .= '<p class="text-gray-500 dark:text-gray-400">No hay contactos disponibles.</p>';
        } else {
            // Hay contactos disponibles, construir el HTML para cada usuario
            foreach ($users as $user) {
                // Determinar el estado del usuario (activo o inactivo)
                $estado = $user->activo ? 'bg-green-500' : 'bg-red-500';

                // Obtener el último mensaje relacionado con el usuario
                $ultimoMensaje = Mensajes::where('incoming_msg_id', $user->id)
                    ->orWhere('outgoing_msg_id', $user->id)->latest()->first();

                // Determinar si el último mensaje fue enviado o recibido por el usuario y obtener la hora
                $horaMensaje = '';
                $mensajeMostrar = 'Sin mensajes';

                if ($ultimoMensaje) {
                    $horaMensaje = $ultimoMensaje->created_at->format('H:i'); // Obtener la hora del mensaje (formato 24 horas)
                    // Si necesitas formato de 12 horas puedes usar: $ultimoMensaje->created_at->format('h:i A');

                    // Determinar quién envió el mensaje
                    if ($ultimoMensaje->outgoing_msg_id == Auth::id()) {
                        // El mensaje fue enviado por el usuario autenticado
                        $mensajeMostrar = 'You: ' . $ultimoMensaje->message;
                    } else {
                        // El mensaje fue enviado por otro usuario
                        $mensajeMostrar = $ultimoMensaje->message;
                    }
                }

                // Construir el HTML para el usuario actual
                $html .= view::make("Mensajes.partials.contact_list",compact('user', 'estado', 'ultimoMensaje', 'horaMensaje'))->render() ;
            }
        }
        return response()->json($html);
        // Retornar una respuesta JSON con el HTML generado

    }
    public function get_users(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $users = User::where('name', 'LIKE', '%' . $searchTerm . '%')->get();
        $html = '';
        // Construir el HTML para cada usuario
        if ($users->isEmpty()) {
            // No hay contactos disponibles
            $html .= '<p class="text-gray-500 dark:text-gray-400">No hay contactos disponibles.</p>';
        } else {
            // Hay contactos disponibles, construir el HTML para cada usuario
            foreach ($users as $user) {
                // Determinar el estado del usuario (activo o inactivo)
                $estado = $user->activo ? 'bg-green-500' : 'bg-red-500';
                // Obtener el último mensaje relacionado con el usuario
                $ultimoMensaje = Mensajes::where('incoming_msg_id', $user->id)
                    ->orWhere('outgoing_msg_id', $user->id)->latest()->first();

                // Determinar si el último mensaje fue enviado o recibido por el usuario y obtener la hora
                $horaMensaje = '';
                if ($ultimoMensaje) {
                    $horaMensaje = $ultimoMensaje->created_at->format('H:i'); // Obtener la hora del mensaje (formato 24 horas)
                    // Si necesitas formato de 12 horas puedes usar: $ultimoMensaje->created_at->format('h:i A');
                }

                // Construir el HTML para el usuario actual
                $html .= '<a class="flex items-center space-x-4 py-2 px-1 rounded-md last-of-type:pb-0 hover:bg-slate-200 dark:hover:bg-slate-600" href="/mensajes/'.$user->name.'/' . $user->id . '">
                            <div class="flex-shrink-0 relative">
                                <img class="w-12 h-12 object-cover rounded-full" src="' . Storage::url('images/profile_pictures/' . $user->profile_picture) . '" alt="">
                                <div class="absolute before:w-3 before:h-3 rounded-full bottom-1 right-1 ' . $estado . '"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-xl lg:text-base font-semibold lg:font-medium text-gray-800 truncate dark:text-white">' . $user->name . '</p>
                                </div>
                                <p class="text-base lg:text-sm text-gray-500 truncate dark:text-gray-400">' . $user->email. '</p>
                            </div>
                        </a>';
            }
        }

        $response = ['html' => $html];
        return response()->json($response);

    }

    public function searchByName(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        // Obtener los IDs de los usuarios con los que el usuario autenticado ha tenido mensajes
        $userIdsWithMessages = Mensajes::where('incoming_msg_id', Auth::id())
            ->orWhere('outgoing_msg_id', Auth::id())
            ->pluck('incoming_msg_id')
            ->merge(Mensajes::where('incoming_msg_id', Auth::id())
                ->orWhere('outgoing_msg_id', Auth::id())
                ->pluck('outgoing_msg_id'))
            ->unique()
            ->filter(fn($id) => $id != Auth::id()) // Excluir el usuario autenticado
            ->toArray();

        // Buscar usuarios por nombre entre los IDs obtenidos
        $users = User::whereIn('id', $userIdsWithMessages)
            ->where('name', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        $html = '';
        // Construir el HTML para cada usuario
        if ($users->isEmpty()) {
            // No hay contactos disponibles
            $html .= '<p class="text-gray-500 dark:text-gray-400">No hay contactos disponibles.</p>';
        } else {
            // Hay contactos disponibles, construir el HTML para cada usuario
            foreach ($users as $user) {
                // Determinar el estado del usuario (activo o inactivo)
                $estado = $user->activo ? 'bg-green-500' : 'bg-red-500';
                // Obtener el último mensaje relacionado con el usuario
                $ultimoMensaje = Mensajes::where('incoming_msg_id', $user->id)
                    ->orWhere('outgoing_msg_id', $user->id)->latest()->first();

                // Determinar si el último mensaje fue enviado o recibido por el usuario y obtener la hora
                $horaMensaje = '';
                if ($ultimoMensaje) {
                    $horaMensaje = $ultimoMensaje->created_at->format('H:i'); // Obtener la hora del mensaje (formato 24 horas)
                    // Si necesitas formato de 12 horas puedes usar: $ultimoMensaje->created_at->format('h:i A');
                }

                // Construir el HTML para el usuario actual
                $html .= view::make("Mensajes.partials.contact_list",compact('user', 'estado', 'ultimoMensaje', 'horaMensaje'))->render() ;
            }
        }

        $response = ['html' => $html];
        return response()->json($response);
    }

    public function chat_with($name, $id)
    {
        // Obtener los datos del usuario por ID
        $user = User::find($id);
        // Verificar si el usuario existe
        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
        // Formatear la última vez que el usuario se conectó
        $lastSeenFormatted = $user->estado ? 'Activo' : \Carbon\Carbon::parse($user->last_seen_at)->diffForHumans();
        // Pasar los datos del usuario y la hora formateada a la vista
        return view('mensajes.chat_with', compact('user', 'lastSeenFormatted'));
    }
    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos
            $validated = $request->validate([
                'message' => 'required|string',
                'receiver_id' => 'required|exists:users,id',
            ]);
            // Crear el mensaje
            $message = Mensajes::create([
                'incoming_msg_id' => $validated['receiver_id'],
                'outgoing_msg_id' => Auth::id(),
                'message' => $validated['message'],
            ]);
            // Obtener el usuario receptor
            $receiver = User::find($validated['receiver_id']);
            // Obtener el remitente
            $sender = [
                'name' => Auth::user()->name,
                'avatar' => Auth::user()->profile_picture,
            ];
            // Enviar la notificación
            $receiver->notify(new NewMessageNotification("message", $message->message, $sender));
            return response()->json(['status' => 'Mensaje enviado']);
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error creating message: ' . $e->getMessage());
            // Responder con error
            return response()->json(['status' => 'error', 'message' => 'Failed to send message.'], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($receiver_id)
    {
        $userId = Auth::id();
        // Obtener los mensajes
        $messages = Mensajes::where(function ($query) use ($userId, $receiver_id) {
            $query->where('outgoing_msg_id', $userId)->where('incoming_msg_id', $receiver_id);
        })->orWhere(function ($query) use ($userId, $receiver_id) {
            $query->where('outgoing_msg_id', $receiver_id)->where('incoming_msg_id', $userId);
        })->get();

        // Formatear los mensajes
        $formattedMessages = '';
        foreach ($messages as $message) {
            $time = $message->created_at->format('H:i');
            $content = htmlspecialchars($message->message);

            if ($message->outgoing_msg_id == $userId) {
                // Mensaje enviado por el usuario autenticado
                $formattedMessages .= view::make('Mensajes.partials.sent_messages', compact("time","content"))->render();
            } else {
                // Mensaje recibido por el usuario autenticado
                $user = User::find($message->outgoing_msg_id);
                $formattedMessages .= view::make('Mensajes.partials.received_message', compact("time","content", "user"))->render();
            }
        }
        return response()->json($formattedMessages);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mensajes $mensajes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mensajes $mensajes) {}
}
