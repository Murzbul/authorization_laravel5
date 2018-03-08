<?php

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
// Route::get('/', ['as' => 'user/welcome', 'uses'=>'Auth\LoginController@login']);

Auth::routes();

Route::middleware(['authenticated'])->group(function () {

    Route::post('login', 'Auth\LoginController@login')->name('login');

    // ROUTE HOME
    Route::get('/home', ['as' => 'home', 'uses'=>'HomeController@index']);
    Route::get('/welcome', ['as' => 'home/welcome', 'uses'=>'HomeController@welcome']);

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

Route::middleware(['authenticated', 'search.actions'])->group(function ()
{
    /* ROUTES ACTIONS */
    // Asignando acciones a roles
    Route::get('accion/asignando_accion', ['as' => 'action/assigned_action', 'uses'=>'ActionController@assignedAction']);
    // Asignar acciones a roles
    Route::get('accion/asignar_accion', ['as' => 'action/assign_action', 'uses'=>'ActionController@assignAction']);
});
