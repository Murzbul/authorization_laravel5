<?php

namespace App\Http\Middleware;

use Closure;

class Authorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
          $response = $next($request);

          // Setting user data in session with role
          $user = User::find(Auth::user()->id);
          $roles = $user->roles;

          $request->session()->put('username', $user->name);
          $request->session()->put('roles', $roles);

          dd($request->session()->all());

          return $response;
    }
}
