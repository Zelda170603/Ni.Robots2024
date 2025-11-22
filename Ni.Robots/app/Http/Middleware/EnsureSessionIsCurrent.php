<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSessionIsCurrent
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();
        $currentId = $request->session()->getId();

        // si el user aún no tiene guardada la sesión “oficial”, dejar pasar
        if (empty($user->current_session_id)) {
            return $next($request);
        }

        // si la sesión no coincide => cerrar sesión y avisar
        if ($user->current_session_id !== $currentId) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $message = 'Tu sesión expiró porque iniciaste sesión en otro dispositivo o navegador.';

            if ($request->expectsJson() || $request->wantsJson() || $request->ajax()) {
                return response()->json(['code' => 'DUPLICATE_SESSION', 'message' => $message], 409);
            }

            return redirect()->route('login')->with('status', $message);
        }

        return $next($request);
    }
}
