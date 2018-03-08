<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect('login');
    }

    public function welcome( Request $request )
    {
        return view('home');
    }
}
