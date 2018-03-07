<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException as QueryException;
use Illuminate\Http\Request;
use App\Role as Role;
use App\User as User;

class RoleController extends Controller
{
    public function create(Request $request)
    {
        try
        {
            $role = new Role;
            $role->name = $request->name;
            $role->description = $request->description;

            if ( $role->save() )
            {
                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'El rol fue creado con exito');

                return redirect()->route( 'role/list' );
            }
        }
        catch ( QueryException $e)
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'El rol ya existe');

            return redirect()->route( 'role/list' );
        }

        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'Hubo un error al crear el rol');

        return redirect()->route('role/list');
    }

    public function list()
    {
      $roles = Role::all();

      return view('role/list',[ 'roles' => $roles ]);
    }

    public function delete( Request $request )
    {
        $role = Role::find( $request->id );

        if ( $role->delete() )
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'El rol ha sido eliminado con exito');
        }
        else
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'El rol no ha podido ser eliminado');
        }

        return redirect()->route( 'role/list' );
    }

    public function editing( Request $request )
    {
        $role = Role::find( $request->id );

        return view('role/edit',[ 'role' => $role ]);
    }

    public function edited( Request $request )
    {
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->description = $request->description;

        try
        {
            $role->save();

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'El rol ha sido modificado satisfactoriamente');

            return redirect()->route( 'role/list' );
        }
        catch ( QueryException $e)
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'El rol ya existe');

            return redirect()->route( 'role/list' );
        }
    }

    public function assignedRole( Request $request )
    {
        $users_has_roles = User::getUsersHasRolesStatus();
        $roles = Role::orderBy('name')->get();
        $users = User::all();

        return view('role/assigned_role', [ 'users' => $users, 'roles' => $roles, 'users_has_roles' => $users_has_roles ] );
    }

    public function assignRole( Request $request )
    {
        $respond = $request->all();

        try
        {
            $sync_data = array();

            foreach ( $respond as $key => $value )
            {
                if( $key != '_token' and $key != 'table_length'  )
                {
                    $user_role = explode( '-', $key );
                    $user_id = $user_role[0];
                    $role_id = $user_role[1];

                    if ( array_key_exists( $user_id, $sync_data ) === false )
                    {
                        $sync_data[$user_id] = array();

                        if ( $value == "on" )
                        {
                            array_push( $sync_data[$user_id], $role_id );
                        }
                    }
                    else
                    {
                        if ( $value == "on" )
                        {
                            array_push( $sync_data[$user_id], $role_id );
                        }
                    }
                }
            }

            foreach ( $sync_data as $user_id => $roles_id )
            {
                $user = User::find( $user_id );
                $user->roles()->sync($roles_id);
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Los roles se han actualizado correctamente');

        }
        catch (\Exception $e)
        {
            dd($e);

            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Los roles no se han actualizado correctamente');
        }

        return redirect('rol/asignando_rol');
    }

}
