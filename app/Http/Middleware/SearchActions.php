<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route as Route;
use Illuminate\Routing\RouteCollection as RouteCollection;
use App\Action as Action;

class SearchActions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function searchAndDeleteActionByActionsCollection( string $uses, $actions )
    {
        foreach ( $actions as $value )
        {
            if ( $uses == $value->uses )
            {
                $action = $actions->find($value->id);
                $action->delete();
            }
        }
    }

    public function searchAndUpdateActionByRoutesCollection( string $uses, RouteCollection $routeCollection )
    {
        $array_routes = $routeCollection->getRoutes();

        foreach ( $array_routes as $route )
        {
            $uses_val = str_replace("App\Http\Controllers\\", "", $route->action["uses"]);

            if ( $uses == $uses_val )
            {
                Action::setActionByRoute( $route );
            }
        }
    }

    public function handle( $request, Closure $next )
    {
        $routeCollection = Route::getRoutes();
        $actions = Action::all();

        if ( $actions->isEmpty() )
        {
            Action::setAllActionsByRouteCollection( $routeCollection );
        }
        else
        {
            // New array with uses to delete o add
            $array_db = array();

            // Filter routeCollection to simple array with 'uses'
            $array_routes = $routeCollection->getRoutes();
            $array_simple_routes = array();

            foreach ( $array_routes as $key => $value )
            {
                array_push($array_simple_routes, str_replace("App\Http\Controllers\\", "", $value->action["controller"]));
            }

            // Filter actions to simple array with 'uses'
            $array_actions =  $actions->all();
            $array_simple_actions = array();

            foreach ( $actions as $key => $value )
            {
                array_push( $array_simple_actions, $value->uses);
            }

            // Comprobar un ruta dentro de una accion y agregarla al array_db
            // cuando la clave es null
            foreach ( $array_simple_routes as $route_value )
            {
                $clave = array_search($route_value, $array_simple_actions);

                if ( $clave === false )
                {
                    array_push( $array_db, ['uses' => $route_value, 'type' => 'update'] );
                }
            }

            // Comprobar un accion dentro de una ruta y agregarla al array_db
            // cuando la clave es null
            foreach ( $array_simple_actions as $action_value )
            {
                $clave = array_search( $action_value, $array_simple_routes );

                if ( $clave === false )
                {
                    array_push( $array_db, ['uses' => $action_value, 'type' => 'delete'] );
                }
            }

            foreach ( $array_db as $value )
            {
                if ( $value["type"] == "delete" )
                {
                    $this->searchAndDeleteActionByActionsCollection( $value["uses"], $actions );
                }
                else if( $value["type"] == "update" )
                {
                    $this->searchAndUpdateActionByRoutesCollection( $value["uses"], $routeCollection );
                }
            }

            // Modified actions when route change in RouteCollection
            // Note: If change routes without route has uses is different in actions
            $_routeCollection = Route::getRoutes()->getRoutes();
            $_actions = Action::all();
            $action_update = null;

            foreach ( $_routeCollection as $route_key => $route_value )
            {
                foreach ( $_actions as $action_key => $action_value )
                {
                    if ( str_replace("App\Http\Controllers\\", "", $route_value->action["controller"]) == $action_value->uses )
                    {
                        if ( $route_value->getName() != $action_value->name or $route_value->uri() != $action_value->uri)
                        {
                            $action_update = Action::find($action_value->id);
                            $action_update->uri = $route_value->uri();
                            $action_update->name = $route_value->getName();
                            $action_update->save();
                        }
                    }
                }
            }

            return $response;
        }
    }
}
