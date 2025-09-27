<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     * Middleware general para acceso administrativo
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Verificar si el usuario tiene algún rol administrativo
        if (!$user->hasAnyRole(['super-admin', 'admin', 'moderator', 'operator'])) {
            abort(403, 'Acceso denegado. Se requieren permisos administrativos.');
        }

        return $next($request);
    }
}