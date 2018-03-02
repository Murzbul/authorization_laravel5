<?php

namespace App;

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
}
