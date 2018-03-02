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

});

// ROUTE HOME
Route::get('/home', ['as' => 'home', 'uses'=>'HomeController@index']);
Route::get('/welcome', ['as' => 'home/welcome', 'uses'=>'HomeController@welcome']);
Route::get('/nada1', ['as' => 'home/nada1', 'uses'=>'HomeController@nada1']);
Route::get('/nada2', ['as' => 'home/nada2', 'uses'=>'HomeController@nada2']);
Route::get('/nada3', ['as' => 'home/nada3', 'uses'=>'HomeController@nada3']);
Route::get('/nada4', ['as' => 'home/nada4', 'uses'=>'HomeController@nada4']);
Route::get('/nada5', ['as' => 'home/nada5', 'uses'=>'HomeController@nada5']);

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


Route::middleware(['search.actions'])->group(function ()
{
    /* ROUTES ACTIONS */
    // Eliminar Accion
    Route::get('accion/eliminar/{id}', ['as' => 'action/delete', 'uses'=>'ActionController@delete']);
    // Listar Acciones
    Route::get('accion/listar', ['as' => 'action/list', 'uses'=>'ActionController@list']);
    // Crear Acción
    Route::post('accion/crear', ['as' => 'action/create', 'uses'=>'ActionController@create']);
    // Editar Acción
    Route::get('accion/editar/{id}', ['as' => 'action/edit', 'uses'=>'ActionController@edit']);
});