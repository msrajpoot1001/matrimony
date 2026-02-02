<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Role-based redirect
            if ($user->userRole?->name === 'admin') {
                return redirect('/admin/dashboard');
            }

            if ($user->userRole?->name === 'agent') {
                return redirect('/agent/dashboard');
            }

            return redirect('/dashboard'); // normal users
        }

        return $next($request);
    }
}
