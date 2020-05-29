<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// redireccionar cuando este iniciada la sesion y no deje entrar al login
Route::group(['middleware' => 'guest'], function () {
    Route::get('Login', ['as' => 'Login', 'uses' => 'LoginController@Index' ]);
});

Route::get('registro', ['as' => 'registro', 'uses' => 'AdministradorController@registro' ]);

// ruta para iniciar sesion
Route::post('IniciasSession', 'LoginController@show');
// registro de usuario
Route::post('RegistrarUsuario', 'LoginController@Registrodelusuario');
// vista principal
Route::get('principal', 'AdministradorController@MostrarAdministradores')->name('principal');
//salir del administrador
Route::get('salir', 'LoginController@destroy')->name('salir');
//eliminar administrador
Route::post('EliminarAdministrador', 'AdministradorController@EliminarAdmin')->name('EliminarAdministrador');
//traer los usuarios por id
Route::post('UsuariosId','AdministradorController@TraerUsu')->name('UsuariosId');
//traer los administradores
Route::get('TraerAdmins','AdministradorController@TraerAdmins')->name('TraerAdmins');
//actualizar los administradores
Route::post('UpdateUser','AdministradorController@UpdateUser')->name('UpdateUser');
//agregar la informacion para las cards
Route::get('AgregarInformacion', 'AdministradorController@AgregarInformacion')->name('AgregarInformacion');
//ajax para guardar los datos de inicio cards
Route::post('GuardarDatos', 'AdministradorController@GuardarDatos')->name('GuardarDatos');
//mostrar los proyectos
Route::get('MostrarPro','AdministradorController@MostrarPro')->name('MostrarPro');