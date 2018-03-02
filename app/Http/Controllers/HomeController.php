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
        // $user = User::find(1);
        // $roles = $user->roles;

        // $data = $request->session()->all();
        // dd($data);
        //
        // foreach ($roles as $role) {
        //     dd($role);
        // }
        //
        // dd($roles);


        // dd("ASD");
        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }
    public function nada1()
    {
        return view('welcome');
    }
    public function nada2()
    {
        return view('welcome');
    }
    public function nada3()
    {
        return view('welcome');
    }
    public function nada4()
    {
        return view('welcome');
    }
}
