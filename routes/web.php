<?php

use App\ConfigSystem as ConfigSystem;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas para el recurso rol
// Route::resource('rol','MovieController');

// VER DESPUES

/*$auth = ConfigSystem::where("key", "auth")->get()[0]->value;
$authorized = ConfigSystem::where("key", "authorized")->get()[0]->value;
$midd = array();
$auth_midd = array();

if( $auth == "true" )
{
    array_push($midd, "auth");
}
if ( $authorized == "true" )
{
    array_push($midd, "authenticated");
    array_push($midd, "authorized");
    array_push($auth_midd, 'authenticated');
}*/

Auth::routes();

Route::middleware(['authenticated'])->group(function () {

    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::get('/', ['as' => 'home/index', 'uses'=>'HomeController@index']);

});

Route::middleware(['auth', 'authenticated', 'authorized'])->group(function () {

    // ROUTE HOME
    Route::get('/welcome', ['as' => 'home/welcome', 'uses'=>'HomeController@welcome']);

    // Routes password reset
    Route::post('password/email', ['as' => 'password.email', 'uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset', ['as' => 'password.request', 'uses'=>'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/reset', ['as' => 'password.resetForm', 'uses'=>'Auth\ResetPasswordController@reset ']);
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses'=>'Auth\ResetPasswordController@showResetForm ']);

    /* ROUTES USERS */
    // Eliminar Usuario
    Route::get('usuario/eliminar/{id}', ['as' => 'user/delete', 'uses'=>'UserController@delete']);
    // Listar Usuario
    Route::get('usuario/listar', ['as' => 'user/list', 'uses'=>'UserController@list']);
    // Crear Usuario
    Route::post('usuario/crear', ['as' => 'user/create', 'uses'=>'UserController@create']);
    // Editando Usuario
    Route::get('usuario/editando/{id}', ['as' => 'user/editing', 'uses'=>'UserController@editing']);
    // Editado Usuario
    Route::post('usuario/editado/{id}', ['as' => 'user/edited', 'uses'=>'UserController@edited']);

    /* ROUTES ROLES */
    // Eliminar Rol
    Route::get('rol/eliminar/{id}', ['as' => 'role/delete', 'uses'=>'RoleController@delete']);
    // Listar Roles
    Route::get('rol/listar', ['as' => 'role/list', 'uses'=>'RoleController@list']);
    // Crear Rol
    Route::post('rol/crear', ['as' => 'role/create', 'uses'=>'RoleController@create']);
    // Editando Rol
    Route::get('rol/editando/{id}', ['as' => 'role/editing', 'uses'=>'RoleController@editing']);
    // Editado Rol
    Route::post('rol/editado/{id}', ['as' => 'role/edited', 'uses'=>'RoleController@edited']);
    // Asignar roles a usuarios
    Route::get('rol/asignando_rol', ['as' => 'role/assigned_role', 'uses'=>'RoleController@assignedRole']);
    Route::get('rol/asignar_rol', ['as' => 'role/assign_role', 'uses'=>'RoleController@assignRole']);

});

Route::middleware(['auth','authenticated', 'authorized', 'search.actions'])->group(function ()
{
    /* ROUTES ACTIONS */
    // Asignando acciones a roles
    Route::get('accion/asignando_accion', ['as' => 'action/assigned_action', 'uses'=>'ActionController@assignedAction']);
    // Asignar acciones a roles
    Route::get('accion/asignar_accion', ['as' => 'action/assign_action', 'uses'=>'ActionController@assignAction']);
});
