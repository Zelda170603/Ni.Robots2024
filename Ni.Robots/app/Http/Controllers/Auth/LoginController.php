<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user && $user->role) {
            switch ($user->role->role_type) {
                case 'fabricante':
                    return '/Administracion/fabricante/index';
                case 'administrador':
                    return '/Administracion';
                case 'doctor':
                    return '/Administracion/doctor/index';
                default:
                    return '/';
            }
        }

        return '/';
    }

    /**
     * Se ejecuta tras autenticación exitosa.
     * - Guarda el ID de sesión actual en users.current_session_id
     * - Elimina la sesión anterior (si existía) para evitar duplicidades
     */
    protected function authenticated(Request $request, $user)
    {
        $newSessionId = $request->session()->getId();

        if (!empty($user->current_session_id) && $user->current_session_id !== $newSessionId) {
            DB::table('sessions')->where('id', $user->current_session_id)->delete();
        }

        // Asignación directa para evitar warnings de Intelephense y problemas de fillable
        $user->current_session_id = $newSessionId;
        $user->save();
    }

    /**
     * Logout: limpia la marca de sesión si corresponde.
     */
    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user && $user->current_session_id === $request->session()->getId()) {
                $user->current_session_id = null;
                $user->save();
            }
        }

        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
