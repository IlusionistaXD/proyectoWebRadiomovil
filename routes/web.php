<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ParadaController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\EstadisticaController;
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

//Route::resource('paradas',ParadaController::class);

Route::get('/', function () {
    if(Auth::user()){
        if((Auth::user()->is_admin)==2){
            return view('welcome_admin');
        }else{
            return view('welcome_user');
        }
    }else{
        return view('auth.login');
    }
});

Route::get('/welcome_user', function () {
    return view('welcome_user');
})->name('welcome_user')->middleware('auth');

Route::get('/welcome_admin', function () {
    return view('welcome_admin');
})->name('welcome_admin')->middleware('is_admin');


//CRUD USER/
Route::get('/usuarios', 'Auth\RegisterController@index')->name('users')->middleware('is_admin');
Route::resource('users', 'Auth\RegisterController')->middleware('is_admin');

Route::get('/tarifass', 'TarifaController@index')->name('tarifas')->middleware('is_admin');
Route::get('/tarifasss', 'TarifaController@indexusu')->name('utarifas')->middleware('auth');
Route::resource('tarifas', 'TarifaController')->middleware('is_admin');

Route::get('/paradass', 'ParadaController@index')->name('paradas')->middleware('is_admin');
Route::get('/paradasss', 'ParadaController@indexusu')->name('uparadas')->middleware('auth');
Route::resource('paradas', 'ParadaController')->middleware('is_admin');

Route::get('/promociones', 'PromocionController@index')->name('promocions')->middleware('is_admin');
Route::resource('promocions', 'PromocionController')->middleware('is_admin');

Route::get('/moviles', 'MovilController@index')->name('movils')->middleware('is_admin');
Route::get('/moviless', 'MovilController@indexusu')->name('umovils')->middleware('auth');
Route::resource('movils', 'MovilController')->middleware('is_admin');

Route::get('/servicioss', 'ServicioController@index')->name('servicios')->middleware('is_admin');
Route::get('/serviciosss', 'ServicioController@indexusu')->name('uservicios')->middleware('auth');
Route::resource('servicios', 'ServicioController')->middleware('is_admin');

Route::get('/permisoss', 'PermisoController@index')->name('permisos')->middleware('is_admin');
Route::resource('permisos', 'PermisoController')->middleware('is_admin');

Route::get('/viajess', 'ViajeController@index')->name('viajes');
Route::post('nuevoviaje', 'ViajeController@update')->name('nuevoviaje');
Route::resource('viajes', 'ViajeController')->middleware('auth');

Route::get('/viajessadmin', 'ViajeControlleradmin@index')->name('viajesadmin')->middleware('is_admin');
Route::resource('viajesadmin', 'ViajeControlleradmin')->middleware('is_admin');

Route::get('/estadisticas', 'EstadisticaController@index')->name('estadistica')->middleware('is_admin');
Route::resource('estadistica', 'EstadisticaController')->middleware('is_admin');

Route::get('/nuevoreportes', 'ReporteController@index')->name('nuevoreporte')->middleware('is_admin');
Route::resource('nuevoreporte', 'ReporteController')->middleware('is_admin');


Route::get('busquedas/{dato}/{rol}', ['as' => 'busquedas.index', 'uses' => 'BusquedaController@index']);



Route::get('/permiso-list-pdf','PermisoController@exporpdf')->name('permisopdf')->middleware('is_admin'); //
Route::get('/tarifa-list-pdf','TarifaController@exporpdf')->name('tarifapdf')->middleware('is_admin');  //
Route::get('/promocion-list-pdf','PromocionController@exporpdf')->name('promocionpdf')->middleware('is_admin'); //
Route::get('/servicio-list-pdf','ServicioController@exporpdf')->name('serviciopdf')->middleware('is_admin'); //
Route::get('/movil-list-pdf','MovilController@exporpdf')->name('movilpdf')->middleware('is_admin'); //
Route::get('/parada-list-pdf','ParadaController@exporpdf')->name('paradapdf')->middleware('is_admin'); //
Route::get('/user-list-pdf','Auth\RegisterController@exporpdf')->name('userpdf')->middleware('is_admin'); //
Route::get('/viaje-list-pdf','ViajeControlleradmin@exporpdf')->name('viajepdf')->middleware('is_admin'); //


Auth::routes();
//Route::get('chartjs', [EstadisticaController::class, 'index'])->name('chartjs.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('layouts.name.menu')->middleware('is_admin');


//vista de prueba menu
//Route::view('/menu', 'layouts.menu')->name('menu');
//Route::view('/usu', 'layouts.usu')->name('usu');
