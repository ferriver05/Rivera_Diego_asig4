<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidarApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('API-KEY')) {
            return response()->json([
                'error' => 'Acceso denegado.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
