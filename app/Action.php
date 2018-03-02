<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route as Route;
use Illuminate\Routing\RouteCollection as RouteCollection;

class Action extends Model
{
    protected $table = 'actions';
    protected $fillable = ['name', 'uri', 'method', 'uses'];
    protected $guarded = ['id'];

    public static function setAllActionsByRouteCollection( RouteCollection $routeCollection )
    {
        if ( self::all()->isEmpty() )
        {
            $array_routes = $routeCollection->getRoutes();

            foreach ( $array_routes as $route )
            {
                self::setActionByRoute($route);
            }
        }
    }

    public static function setActionByRoute( Route $route )
    {
        $action = new Action();
        $action->name = $route->getName();
        $action->uri = $route->uri();
        $action->method = $route->getActionMethod();
        $action->uses = str_replace("App\Http\Controllers\\", "", $route->action["controller"]);
        $action->save();
    }
}
