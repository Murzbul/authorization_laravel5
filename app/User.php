<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role as Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'users_has_roles');
    }

    public static function getUsersHasRolesStatus()
    {
        $users = self::all();
        $rolesByUser = array();

        foreach ( $users as $key => $user )
        {
            $rolesByUser[$user->name] = Role::getRolesByUser( $user->id );
        }

        return $rolesByUser;
    }
}
