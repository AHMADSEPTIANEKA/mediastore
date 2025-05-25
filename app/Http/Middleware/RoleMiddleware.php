<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Cek apakah user memiliki role yang sesuai.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role (contoh: admin atau user)
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // belum login
            return redirect('/login');
        }

        $user = Auth::user();
        if ($user->role !== $role) {
            // kalau role tidak sesuai, bisa redirect atau abort 403
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
