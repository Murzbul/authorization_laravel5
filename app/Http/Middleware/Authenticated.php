<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User as User;
use App\Role as Role;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        $response = $next($request);

        // Setting user data in session with role
        if ( Auth::user() != null )
        {
            $user = User::find(Auth::user()->id);
            $roles = $user->roles;

            $request->session()->put('username', $user->name);
            $request->session()->put('roles', $roles);
        }
        else
        {
            $request->session()->put('username', 'anonymous');

            $roles = Role::find(4);
            $request->session()->put('roles', $roles);
        }

        return $response;
    }
}
