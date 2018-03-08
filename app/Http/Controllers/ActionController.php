<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QueryException;
use App\Action as Action;
use App\Role as Role;

class ActionController extends Controller
{
    public function assignedAction( Request $request )
    {
        $roles_has_actions = Role::getRolesHasActionsStatus();
        $actions = Action::orderBy('name')->get();
        $roles = Role::orderBy('name')->get();

        return view('action/assigned_action', [ 'roles' => $roles, 'actions' => $actions, 'roles_has_actions' => $roles_has_actions ] );
    }

    public function assignAction( Request $request )
    {
        $respond = $request->all();

        try
        {
            $sync_data = array();

            foreach ( $respond as $key => $value )
            {
                if( $key != '_token' and $key != 'table_length'  )
                {
                    $role_action = explode( '-', $key );
                    $role_id = $role_action[0];
                    $action_id = $role_action[1];

                    $role = Role::find( $role_id );

                    if ( array_key_exists( $action_id, $sync_data ) === false )
                    {
                        $sync_data[$action_id] = array();

                        if ( $value == "on" )
                        {
                            array_push( $sync_data[$action_id], $role_id );
                        }
                    }
                    else
                    {
                        if ( $value == "on" )
                        {
                            array_push( $sync_data[$action_id], $role_id );
                        }
                    }

                }
            }

            foreach ( $sync_data as $action_id => $roles_id )
            {
                $action = Action::find( $action_id );
                $action->roles()->sync( $roles_id );
            }

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Las acciones se han actualizado correctamente');

        }
        catch (\Exception $e)
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Las acciones no se han actualizado correctamente');
        }

        return redirect('accion/asignando_accion');
    }
}
