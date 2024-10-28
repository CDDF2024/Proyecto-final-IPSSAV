<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class PacienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
    
        // Verifica si el usuario tiene el rol específico y si no está en la ruta 'inicio'
        if ($user && $user->rol->id_rol === 4 && !$request->is('inicio')) {
            return redirect('inicio'); 
        }
    
        return $next($request); 
    }
}
