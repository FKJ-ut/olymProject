<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HostGuard
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and their role_id is 1
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);  // Allow the request to proceed
        }

        // If not, redirect to the unauthorized page
        return redirect()->route('unauthorized');
    }
}
