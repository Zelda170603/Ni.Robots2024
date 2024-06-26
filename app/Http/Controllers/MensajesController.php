<?php

namespace App\Http\Controllers;

use App\Models\Mensajes;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MensajesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view("mensajes.index");   
    }

    public function contact_list_messages()
    {
        // Obtener todos los usuarios excepto el usuario autenticado
        $users = User::where('id', '!=', Auth::id())->get();
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
                $ultimoMensaje = Mensajes::where('incoming-msg-id', $user->id)
                    ->orWhere('outgoing-msg-id', $user->id)->latest()->first();
                // Determinar si el último mensaje fue enviado o recibido por el usuario y obtener la hora
                $horaMensaje = '';
                if ($ultimoMensaje) {
                    $horaMensaje = $ultimoMensaje->created_at->format('H:i'); // Obtener la hora del mensaje (formato 24 horas)
                    // Si necesitas formato de 12 horas puedes usar: $ultimoMensaje->created_at->format('h:i A');
                }
        
                // Construir el HTML para el usuario actual
                $html .= '<a class="flex items-center space-x-4 py-2 px-1 rounded-md last-of-type:pb-0 hover:bg-slate-200 dark:hover:bg-slate-600" href="/mensajes/' . $user->name . '/'.$user->id.'">
                            <div class="flex-shrink-0 relative">
                                <img class="w-14 h-14 lg:w-12 lg:h-12 object-cover rounded-full" src="" alt="Neil image">
                                <div class="absolute before:w-3 before:h-3 rounded-full bottom-1 right-1 ' . $estado . '"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-xl lg:text-base font-semibold lg:font-medium text-gray-800 truncate dark:text-white">' . $user->name . '</p>
                                    <span class="text-xl lg:text-base font-semibold lg:font-medium text-gray-600 dark:text-slate-500">' . $horaMensaje . '</span>
                                </div>
                                <p class="text-base lg:text-sm text-gray-500 truncate dark:text-gray-400">' . ($ultimoMensaje ? $ultimoMensaje->message : 'Sin mensajes') . '</p>
                            </div>
                        </a>';
            }
        }
        $response = ['html' => $html];

        // Mostrar en consola lo que se está devolviendo
        \Illuminate\Support\Facades\Log::info('Response from searchByName:', $response);

        return response()->json($html);
        // Retornar una respuesta JSON con el HTML generado
        
    }

    public function searchByName(Request $request)
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
                $ultimoMensaje = Mensajes::where('incoming-msg-id', $user->id)
                    ->orWhere('outgoing-msg-id', $user->id)->latest()->first();
        
                // Determinar si el último mensaje fue enviado o recibido por el usuario y obtener la hora
                $horaMensaje = '';
                if ($ultimoMensaje) {
                    $horaMensaje = $ultimoMensaje->created_at->format('H:i'); // Obtener la hora del mensaje (formato 24 horas)
                    // Si necesitas formato de 12 horas puedes usar: $ultimoMensaje->created_at->format('h:i A');
                }
        
                // Construir el HTML para el usuario actual
                $html .= '<a class="flex items-center space-x-4 py-2 px-1 rounded-md last-of-type:pb-0 hover:bg-slate-200 dark:hover:bg-slate-600" href="/mensajes/' . $user->id . '">
                            <div class="flex-shrink-0 relative">
                                <img class="w-14 h-14 lg:w-12 lg:h-12 object-cover rounded-full" src="" alt="Neil image">
                                <div class="absolute before:w-3 before:h-3 rounded-full bottom-1 right-1 ' . $estado . '"></div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between">
                                    <p class="text-xl lg:text-base font-semibold lg:font-medium text-gray-800 truncate dark:text-white">' . $user->name . '</p>
                                    <span class="text-xl lg:text-base font-semibold lg:font-medium text-gray-600 dark:text-slate-500">' . $horaMensaje . '</span>
                                </div>
                                <p class="text-base lg:text-sm text-gray-500 truncate dark:text-gray-400">' . ($ultimoMensaje ? $ultimoMensaje->message : 'Sin mensajes') . '</p>
                            </div>
                        </a>';
            }
        }

        $response = ['html' => $html];

        // Mostrar en consola lo que se está devolviendo
        \Illuminate\Support\Facades\Log::info('Response from searchByName:', $response);

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
        print_r($request);
        $validated = $request->validate([
            'message' => 'required|string',
            'receiver_id' => 'required|exists:users,id',
        ]);

        Mensajes::create([
            'incoming_msg_id' => $validated['receiver_id'],
            'outgoing_msg_id' => Auth::id(),
            'message' => $validated['message'],
        ]);
        
        return response()->json(['status' => 'success', 'message' => 'Message sent successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mensajes $mensajes)
    {
        //
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
    public function destroy(Mensajes $mensajes)
    {
        //
    }
}
