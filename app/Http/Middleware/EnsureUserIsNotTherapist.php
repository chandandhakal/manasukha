<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsNotTherapist
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role->name === 'therapist') {
            return redirect()->route('home')->with('info', 'This section is only for patients.');
        }

        return $next($request);
    }
} 