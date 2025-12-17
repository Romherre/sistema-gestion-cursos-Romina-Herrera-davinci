<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoordinadorMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Verificar si el usuario está autenticado
        // 2. Verificar si el usuario tiene el rol 'coordinador'
        if (Auth::check() && Auth::user()->rol === 'coordinador') {
            return $next($request); // Acceso concedido, continuar
        }

        abort(403, 'No tienes permiso para acceder a esta sección. (Solo Coordinadores)');
    }
}
