<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route as Route;
use Illuminate\Routing\RouteCollection as RouteCollection;
use Illuminate\Support\Facades\DB as DB;

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

    public function roles()
    {
        return $this->belongsToMany( 'App\Role', 'roles_has_actions' );
    }

    public static function getActionsByRole( int $action_id )
      {
          return DB::select(DB::raw("SELECT
                                             R.id as id_role,
                                             R.name as role_name,
                                             A.id as id_action,
                                             A.uses as action_uses,
                                             'unassigned' as status

                                          FROM
                                             roles R
                                          CROSS JOIN
                                             actions A
                                          WHERE
                                             R.id NOT IN
                                               (
                                                  SELECT
                                                     RA.role_id
                                                  FROM
                                                     roles_has_actions RA
                                                  WHERE
                                                     RA.action_id = A.id
                                               ) AND A.id = $action_id

                                          UNION

                                          SELECT

                                             R.id as id_role,
                                             R.name as role_name,
                                             A.id as id_action,
                                             A.uses as action_uses,
                                             'assigned' as status

                                          FROM
                                             roles R

                                          LEFT JOIN roles_has_actions RA
                                          ON R.id = RA.role_id

                                          JOIN actions A
                                          ON A.id = RA.action_id

                                          AND A.id = $action_id

                                          ORDER BY role_name"));
      }

      public static function getRolesHasActionsStatus()
      {
          $actions = self::all();
          $actionsByRole = array();

          foreach ( $actions as $key => $action )
          {
              $rolesByUser[$user->name] = Role::getActionsByRole( $user->id );
          }

          return $rolesByUser;
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
