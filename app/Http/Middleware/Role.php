<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

        public function handle($request, Closure $next, $role)
            {
                if(Auth::check() and Auth::user()->hasRole($role)){
                    return $next($request);
                }
                abort(404);
            }

}
