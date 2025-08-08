<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\GlobalNotification;
use App\Notifications\UserNotification;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\View\ViewException;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        //$request->validate([
        //  'message' => 'required|string|max:255',
        //]);

        $message = $request->input('message');
        // Obtener todos los usuarios
        $users = User::all();
        // Enviar la notificación a cada usuario
        foreach ($users as $user) {
            $user->notify(new GlobalNotification('global', $message));
        }
        return redirect()->back()->with('success', 'Global notification sent successfully!');
    }
    
    public function create()
    {
        $users = User::all();
        return view('Administracion.Notify', compact('users'));
    }

    public function to_users(Request $request)
    {
        $user = User::find($request->user_id);
        $user->notify(new UserNotification('user', $request->message));
        return view('Administracion.Notify')->with('status', 'Notification sent successfully!');
    }

    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        $unreadNotifications = $notifications->whereNull('read_at'); // Filtrar notificaciones no leídas
        $readNotifications = $notifications->whereNotNull('read_at'); // Filtrar notificaciones leídas
        $html = '';
        // Mostrar notificaciones no leídas
        if (!$unreadNotifications->isEmpty()) {
            $html .= '<h2 class="text-lg p-1 font-semibold text-gray-800 dark:text-gray-300">Notificaciones no leídas</h2>';
            foreach ($unreadNotifications as $notification) {
                $html .= $this->formatNotification($notification);
            }
        }
        // Mostrar notificaciones leídas
        if (!$readNotifications->isEmpty()) {
            $html .= '<h2 class="p-1 text-lg font-semibold text-gray-800 dark:text-gray-300">Notificaciones leídas</h2>';
            foreach ($readNotifications as $notification) {
                $html .= $this->formatNotification($notification);
            }
        }
        // Si no hay notificaciones
        if ($notifications->isEmpty()) {
            $html .= '<p class="text-gray-500 dark:text-gray-400">No hay notificaciones disponibles.</p>';
        }

        return response()->json($html);
    }

    // Función para formatear una notificación en HTML
    private function formatNotification($notification)
    {
        $readClass = $notification->read_at ? 'bg-gray-100 dark:bg-gray-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700';
        $type = $notification->data['type']; // Obtener el tipo desde los datos de la notificación

        switch ($type) {
            case 'message':
                return $this->formatMessageNotification($notification, $readClass);
            case 'appointment':
                return $this->formatReserva_citaNotification($notification, $readClass);
            case 'global':
                return $this->formatGlobalNotification($notification, $readClass);
            case 'user':
                return $this->formatUserNotification($notification, $readClass);
            case 'order':
                return $this->formatOrderNotification($notification, $readClass);
            default:
                return '';
        }
    }

    private function formatReserva_citaNotification($notification, $readClass)
    {
        $senderName = $notification->data['sender']['name'];
        $senderAvatar = $notification->data['sender']['avatar'];
        $avatarUrl = Storage::url('images/profile_pictures/' . $senderAvatar);

        return '
        <div href="" class="flex px-4 py-3  ' . $readClass . '" data-id="' . $notification->id . '">
            <div class="flex-shrink-0 relative">
                <img class="rounded-full w-11 h-11" src="' . $avatarUrl . '">
                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                    <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                        <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                    </svg>
                </div>
            </div>
            <div class="w-full ps-3 text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                <div class=""> Tienes una solicitud para reservar una cita de
                    <span class="font-semibold  text-gray-900 dark:text-white">' . $senderName . '</span>: "
                </div>
                <button onclick="MarkAsRead(\'' . $notification->id . '\')" class="text-blue-600 dark:text-blue-500">Mark as read</button>
                <button onclick="DeleteNotification(\'' . $notification->id . '\')" class="text-red-600 dark:text-red-500">Borrar</button> 
                <div class="text-xs text-blue-600 dark:text-blue-500">' . $notification->created_at->diffForHumans() . '</div>
            </div>
        </div>';
    }

    private function formatMessageNotification($notification, $readClass)
    {
        $senderName = $notification->data['sender']['name'];
        $senderAvatar = $notification->data['sender']['avatar'];
        $avatarUrl = Storage::url('images/profile_pictures/' . $senderAvatar);

        return '
        <div href="#" class="flex px-4 py-3  ' . $readClass . '" data-id="' . $notification->id . '">
            <div class="flex-shrink-0 relative">
                <img class="rounded-full w-11 h-11" src="' . $avatarUrl . '">
                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                    <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                        <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                    </svg>
                </div>
            </div>
            <div class="w-full ps-3 text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                <div class=""> Nuevo mensaje de 
                    <span class="font-semibold  text-gray-900 dark:text-white">' . $senderName . '</span>: "' . $notification->data['message'] . '"
                </div>
                <button onclick="MarkAsRead(\'' . $notification->id . '\')" class="text-blue-600 dark:text-blue-500">Mark as read</button>
                <button onclick="DeleteNotification(\'' . $notification->id . '\')" class="text-red-600 dark:text-red-500">Borrar</button> 
                <div class="text-xs text-blue-600 dark:text-blue-500">' . $notification->created_at->diffForHumans() . '</div>
            </div>
        </div>';
    }

    private function formatGlobalNotification($notification, $readClass)
    {
        return '
        <div href="#" class="flex px-4 py-3 ' . $readClass . '" data-id="' . $notification->id . '">
            <div class="flex-shrink-0 relative">
                <img class="rounded-full w-11 h-11" src="">
                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                    <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                        <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                    </svg>
                </div>
            </div>
            <div class="w-full ps-3 text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"> Nuevo mensaje de 
                    <span class="font-semibold  text-gray-900 dark:text-white">Equipo de Ni.Robots</span>: "' . $notification->data['message'] . '"
                </div>
                    <button onclick="MarkAsRead(\'' . $notification->id . '\')" class="text-blue-600 dark:text-blue-500">Mark as read</button>
                    <button onclick="DeleteNotification(\'' . $notification->id . '\')" class="text-red-600 dark:text-red-500">Borrar</button>   
                <div class="text-xs text-blue-600 dark:text-blue-500">' . $notification->created_at->diffForHumans() . '</div>
            </div>
        </div>';
    }
    private function formatUserNotification($notification, $readClass)
    {
        return '
        <div href="#" class="flex px-4 py-3 ' . $readClass . '" data-id="' . $notification->id . '">
            <div class="flex-shrink-0 relative">
                <img class="rounded-full w-11 h-11" src="">
                <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                    <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                        <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                        <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                    </svg>
                </div>
            </div>
            <div class="w-full ps-3 text-gray-500 text-sm mb-1.5 dark:text-gray-400">
                <div class=""> Hola, ' . Auth::user()->name . '
                    <span class="font-semibold  text-gray-900 dark:text-white"></span>: "' . $notification->data['message'] . '"
                </div>
                <button onclick="MarkAsRead(\'' . $notification->id . '\')" class="text-blue-600 dark:text-blue-500">Mark as read</button>
                <button onclick="DeleteNotification(\'' . $notification->id . '\')" class="text-red-600 dark:text-red-500">Borrar</button> 
                <div class="text-xs text-blue-600 dark:text-blue-500">' . $notification->created_at->diffForHumans() . '</div>
            </div>
        </div>';
    }
    private function formatOrderNotification($notification, $readClass)
    {
        $compraId = $notification->data['details']['compra_id'];
        $producto = $notification->data['details']['producto'];
        $cantidad = $notification->data['details']['cantidad'];
        $total = $notification->data['details']['total'];
        return '
    <div href="#" class="flex px-4 py-3 ' . $readClass . '" data-id="' . $notification->id . '">
        <div class="flex-shrink-0 relative">
            <img class="rounded-full w-11 h-11" src="">
            <div class="absolute flex items-center justify-center w-5 h-5 ms-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z" />
                    <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z" />
                </svg>
            </div>
        </div>
        <div class="w-full ps-3 text-gray-500 text-sm mb-1.5 dark:text-gray-400">
            <div class="">Nueva orden de compra realizada por 
                Producto: <span class="font-semibold text-gray-900 dark:text-white">' . $producto . '</span>, 
                Cantidad: <span class="font-semibold text-gray-900 dark:text-white">' . $cantidad . '</span>, 
                Total: <span class="font-semibold text-gray-900 dark:text-white">$' . $total . '</span>
            </div>
            <button onclick="MarkAsRead(\'' . $notification->id . '\')" class="text-blue-600 dark:text-blue-500">Mark as read</button>
            <button onclick="DeleteNotification(\'' . $notification->id . '\')" class="text-red-600 dark:text-red-500">Borrar</button> 
            <div class="text-xs text-blue-600 dark:text-blue-500">' . $notification->created_at->diffForHumans() . '</div>
        </div>
    </div>';
    }


    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('id');
        $notification = Auth::user()->notifications->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
            return response()->json(['status' => 'Notificación marcada como leída']);
        }

        return response()->json(['status' => 'Notificación no encontrada'], 404);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user) {
            $notification = Auth::user()->notifications->where('id', $id)->first();
            if ($notification) {
                $notification->delete();
                return response()->json(['status' => 'Notificación eliminada']);
            }
            return response()->json(['status' => 'Notificación no encontrada'], 404);
        }
        return response()->json(['status' => 'Usuario no autenticado'], 401);
    }
}
