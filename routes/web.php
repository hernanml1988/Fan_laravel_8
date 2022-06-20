<?php

use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DeclaracionController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use PHPUnit\TextUI\XmlConfiguration\Group;

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


Route::controller(WelcomeController::class)->group(function(){
    Route::get('/','index')->name('home');
    Route::get('/registro_editor', 'indexRegistro')->name('registro.index');
    Route::get('/configuracion', 'indexConfiguracion')->name('config.index');
    Route::get('/declaracion/declaracion',  'indexDeclaracion')->name('declaracion.index');
    Route::get('historial/reporte_editor',   'indexHistorial')->name('historial.index');
    Route::get('historial/descarga_editor',  'descargas_editor')->name('historial.descarga');
    Route::get('informe/informe',  'indexInforme')->name('informe.index');
    Route::get('mapas/mapa_editor', 'indexMapa')->name('mapa.index');
    Route::get('mapas/mapa_colab_editor',  'mapa_colab_editor')->name('mapa.colab');
});

// ==============Rutas Registro=====================//
Route::controller(RegistroController::class)->group(function(){
    Route::get('registro_editor/load_registro', 'loadRegistro')->name('registro.load.registro');//
    Route::get('registro_editor/load_diatomeas', 'loadDiatomeas')->name('registro.load.diatomeas');//
    Route::get('registro_editor/load_dinoflagelados', 'loadDinoflagelados')->name('registro.load.dinoflagelados');//
    Route::get('registro_editor/load_oespecies', 'loadOespecies')->name('registro.load.oespecies');//
    Route::get('registro_editor/load_pambientales', 'loadPambientales')->name('registro.load.pambientales');//
    Route::get('registro_editor/load_pambientalesotros', 'loadPambientalesOtros')->name('registro.load.pambientalesotros');//
    Route::post('registro_editor/load_options_prof', 'loadOptionsProf')->name('registro.load.options.prof');//
    Route::post('registro_editor/existe_fecha_muestreo', 'existeFechaMuestreo')->name('registro.existe.fecha.muestreo');//
    Route::post('registro_editor/save_registro', 'saveRegistro')->name('registro.save.registro');//
    Route::get('registro_editor/load_fan_reporte', 'loadFanReporte')->name('registro.fan.reporte');//
    Route::post('registro_editor/save_archivo_registro', 'saveArchivoRegistro')->name('registro.save.archivo.registro');//
    Route::get('registro_editor/load_historial_centro_pdf', 'loadHistorialCentrosPDF')->name('registro.load.historial.centro.pdf');//
    Route::post('registro_editor/destinatario_alarma', 'destinatarioAlarma')->name('registro.destinatario.alarma');//
    Route::post('registro_editor/send', 'sendAlarma')->name('registro.send.alarma');//
    Route::get('registro_editor/load_pambientales_reporte', 'loadPAmbientalesReporte')->name('registro.load.pambientales.reporte');
    
});


// ==============Rutas Historial=====================//


// ==============Rutas Mapas=====================//



// ==============Rutas Informe=====================//


// ==============Rutas Declaracion=====================//



// ==============Rutas Configuracion=====================//



