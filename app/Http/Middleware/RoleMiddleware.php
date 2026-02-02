<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Allow guest routes like login, register
        $excludedRoutes = ['login', 'register']; // add more if needed
        if (in_array($request->route()->getName(), $excludedRoutes)) {
            return $next($request);
        }

        // Not logged in
        if (!$user) {
            return redirect()->route('login');
        }

        // Admin can access everything
        if ($user->userRole && $user->userRole->name === 'admin') {
            return $next($request);
        }

        // Check roles for others
        if (!$user->userRole || !in_array($user->userRole->name, $roles)) {
            return redirect()->route('403_unauthorized');
        }

        return $next($request);
    }
}
