<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QueryException;
use App\User as User;
use App\Role as Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $user = User::find(Auth::user()->id);
        // $roles = $user->roles;
        //
        // return view('home');
    }

    public function list()
    {
        $users = User::all();

        return view('user/list',[ 'users' => $users ]);
    }

    public function create( Request $request )
    {
        try
        {
            if ( $request->password == $request->repassword )
            {
                $user = new User;
                $user->name = $request->name;
                $user->password = bcrypt($request->password);
                $user->email = $request->email;

                if ( $user->save() )
                {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.content', 'El usuario fue creado con exito');

                    $role = Role::find(1);
                    $last_user = User::where('email', $request->email)->first();
                    $last_user->roles()->attach( $role->id );

                    return redirect()->route( 'user/list' );
                }
            }
        }
        catch ( QueryException $e)
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'El email ya fue usado en otra cuenta');

            return redirect()->route( 'user/list' );
        }

        $request->session()->flash('message.level', 'danger');
        $request->session()->flash('message.content', 'Hubo un error al crear al usuario');

        return redirect()->route('user/list');
    }

    public function delete( Request $request )
    {
        $user = User::find( $request->id );

        if ( $user->delete() )
        {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'El usuario ha sido eliminado con exito');
        }
        else
        {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'El usuario no ha podido ser eliminado');
        }

        return redirect()->route( 'user/list' );
    }

    public function editing( Request $request )
    {
        $user = User::find( $request->id );

        return view('user/edit',[ 'user' => $user ]);
    }

    public function edited( Request $request )
    {
        $user_edit = new User();

        if ( $request->password == $request->repassword )
        {
            $user_edit = User::find($request->id);
            $user_edit->password = bcrypt($request->password);
            $user_edit->name = $request->name;
            $user_edit->email = $request->email;

            try
            {
                $user_edit->save();

                $request->session()->flash('message.level', 'success');
                $request->session()->flash('message.content', 'El usuario ha sido modificado satisfactoriamente');

                return redirect()->route( 'user/list' );
            }
            catch ( QueryException $e)
            {
                $request->session()->flash('message.level', 'danger');
                $request->session()->flash('message.content', 'El email ya esta en uso');

                return redirect()->route( 'user/list' );
            }
        }
    }

}
