<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Se usa: ->middleware('role:admin') o ->middleware('role:admin,empleado')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login.show');
        }

        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Acceso denegado');
        }

        return $next($request);
    }
}
