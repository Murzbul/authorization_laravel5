<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException as QueryException;
use App\Action as Action;

class ActionController extends Controller
{
  public function list()
    {
        $action = Action::all();

        // return view('action/list',[ 'action' => $action ]);
    }
}
