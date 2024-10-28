<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
class FacturadorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $user = Auth::user(); // Obtener el usuario autenticado
        if ($user && $user->rol->id_rol=== 2) {
            return redirect('/home'); // Redirige a la vista 'home'
        }
        return $next($request); // Permite continuar si no es un Facturador
    }
}