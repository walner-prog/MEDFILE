<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class InactivityLogout
{
    public function handle($request, Closure $next)
    {
        $timeout = 1800; // Tiempo en segundos (ejemplo: 1800s = 30 minutos)

        if (Auth::guard('paciente')->check()) {
            $lastActivity = session('lastActivityTime');
            if ($lastActivity && (time() - $lastActivity > $timeout)) {
                Auth::guard('paciente')->logout(); // Cerrar sesión
                return redirect()->route('pacientes.login')->withErrors('Su sesión ha expirado por inactividad.');
            }
            session(['lastActivityTime' => time()]); // Actualizar tiempo de actividad
        }

        return $next($request);
    }
}

