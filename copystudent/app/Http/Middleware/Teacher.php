<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur a le rôle de professeur
        if ($request->user()->role !== 'teacher') {
            abort(403, "Accès interdit. Vous n'êtes pas autorisé à accéder à cette page.");
        }

        // L'utilisateur est un professeur, laisser passer la requête
        return $next($request);
    }
}
