<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsNotTherapist
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->role->name === 'therapist') {
            return redirect()->route('home')->with('info', 'This section is only for patients.');
        }

        return $next($request);
    }
} 