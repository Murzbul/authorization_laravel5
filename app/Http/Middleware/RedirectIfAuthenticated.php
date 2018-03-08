<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role as Role;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle( $request, Closure $next, $guard = null )
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/welcome');
        }
        else
        {
            $request->session()->put('username', 'anonymous');

            $roles = Role::find(4);
            $request->session()->put('roles', $roles);
        }

        return $next($request);
    }
}
