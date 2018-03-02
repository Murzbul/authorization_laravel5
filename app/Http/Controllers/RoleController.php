<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException as QueryException;
use Illuminate\Http\Request;
use App\Role as Role;

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

}
