<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsReceptionniste
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && in_array(auth()->user()->role, ['admin', 'receptionniste'])) {
            return $next($request);
        }

        abort(403, 'Accès refusé - Réservé aux réceptionnistes');
    }
}