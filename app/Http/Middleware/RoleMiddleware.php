<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
    {
        // Pastikan pengguna telah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // Cek apakah pengguna memiliki role yang sesuai
        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized'); // Atau redirect ke halaman lain
        }

        return $next($request);
    }
}
