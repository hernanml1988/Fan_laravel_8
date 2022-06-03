<?php

use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DeclaracionController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('home');

// ==============Rutas Registro=====================//
Route::get('registro_editor', [RegistroController::class, 'index'])->name('registro.index');


// ==============Rutas Historial=====================//
Route::controller(HistorialController::class)->group(function(){
Route::get('historial/reporte_editor',  'index')->name('historial.index');
Route::get('historial/descarga_editor', 'descargas_editor')->name('historial.descarga');
});

// ==============Rutas Mapas=====================//
Route::get('mapas/mapa_editor',[MapaController::class, 'index'])->name('mapa.index');
Route::get('mapas/mapa_colab_editor', [MapaController::class, 'mapa_colab_editor'])->name('mapa.colab');


// ==============Rutas Informe=====================//
Route::get('informe/informe', [InformeController::class, 'index'])->name('informe.index');

// ==============Rutas Declaracion=====================//
Route::get('declaracion/declaracion', [DeclaracionController::class, 'index'])->name('declaracion.index');


// ==============Rutas Configuracion=====================//
Route::get('configuracion', [ConfiguracionController::class, 'index'])->name('config.index');


