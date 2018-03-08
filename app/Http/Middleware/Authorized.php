<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route as Route;
use App\Action as Action;
use App\Role as Role;
use App\ConfigSystem as ConfigSystem;

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
         $response = $next( $request );

         $currentActionUses = explode("App\Http\Controllers\\", Route::currentRouteAction())[1];
         $success = false;
         $currentAction = Action::where('uses', $currentActionUses)->get()->all()[0];
         $roles = $request->session()->all()["roles"];

         if( ConfigSystem::where("key", "authorized")->get()[0]->value != "false" )
         {
             foreach ( $roles as $role )
             {
                 $actions = $role->actions;

                 foreach ( $actions as $action )
                 {
                     if ( $action->uses == $currentActionUses )
                     {
                         $success = true;
                         break;
                     }
                 }
             }

             if( !$success )
             {
                 return abort(403, 'No está autorizado para ejecutar esta acción.');
             }
        }

         return $response;
    }
}
