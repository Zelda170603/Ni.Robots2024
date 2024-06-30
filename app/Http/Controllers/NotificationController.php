<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\GlobalNotification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

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
            $user->notify(new GlobalNotification($message));
        }
        return view('administracion.index')->with('success', 'Global notification sent successfully!');
    }

    public function index()
    {
        $notifications = Auth::user()->unreadNotifications;
        return response()->json($notifications);
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
