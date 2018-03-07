<?php

namespace App;

use Illuminate\Support\Facades\DB as DB;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'description'];
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany( 'App\User', 'users_has_roles' );
    }

    public function actions()
    {
        return $this->belongsToMany( 'App\Action', 'roles_has_actions' );
    }

    public static function getRolesByUser( $user_id )
    {
        return DB::select(DB::raw("SELECT
                                           U.id as id_user,
                                           U.name as user_name,
                                           R.id as id_role,
                                           R.name as role_name,
                                           'unassigned' as status

                                        FROM
                                           roles R
                                        CROSS JOIN
                                           users U
                                        WHERE
                                           U.id NOT IN
                                             (
                                                SELECT
                                                   RU.user_id
                                                FROM
                                                   users_has_roles RU
                                                WHERE
                                                   RU.role_id = R.id
                                             ) AND U.id = $user_id

                                        UNION

                                        SELECT
                                           U.id as id_user,
                                           U.name as user_name,
                                           R.id as id_role,
                                           R.name role_name,
                                           'assigned' as status

                                        FROM
                                           users U

                                        LEFT JOIN users_has_roles UR
                                        ON U.id = UR.user_id

                                        JOIN roles R
                                        ON R.id = UR.role_id

                                        AND U.id = $user_id

                                        ORDER BY role_name"));
    }
}
