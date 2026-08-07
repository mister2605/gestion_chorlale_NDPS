<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstMaitreDeChoeur
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->estMaitreDeChoeur()) {
            abort(403, "Réservé au maître de chœur.");
        }

        return $next($request);
    }
}
