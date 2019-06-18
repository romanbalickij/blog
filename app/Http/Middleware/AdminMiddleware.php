<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, Role $role)
    {
        if(Auth::check() and Auth::user()->hasRole($role)){
            return $next($request);
        }
            abort(404);
    }
}
