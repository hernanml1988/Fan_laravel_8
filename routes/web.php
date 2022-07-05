<?php

use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\DeclaracionController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\InformeController;
use App\Http\Controllers\MapaController;
use App\Http\Controllers\PDFController;
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
    Route::get('/registro_editor', 'ingresoRegistro')->name('registro.index');
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
    Route::post('registro_editor/load_centros_usuarios', 'loadCentrosUsuarios')->name('registro.load.centro.usuarios');//
    
    Route::get('registro_editor/load_archivo_registro', 'loadArchivoRegistro')->name('registro.load.archivo.registro');//
    Route::get('registro_editor/load_fan_reporte', 'loadFanReporte')->name('registro.load.fan.reporte');//
    Route::post('registro_editor/load_pambientales_reporte', 'loadPAmbientalesReporte')->name('registro.load.pambientales.reporte');
    Route::post('registro_editor/load_fan_edit_reporte', 'loadFanEditReporte')->name('registro.load.fan.edit.reporte');//
    Route::post('registro_editor/load_pambientales_edit_reporte', 'loadPAmbientalesEditReporte')->name('registro.load.pambientales.edit.reporte');//
    Route::post('registro_editor/save_edit_reporte', 'saveEditReporte')->name('registro.save.edit.reporte');//
    Route::post('registro_editor/delete', 'delete')->name('registro.delete');//
    Route::get('registro_editor/load_coordenada_centro', 'loadCoordenadaCentro')->name('registro.load.coordenada.centro');//
    Route::post('registro_editor/existe_fecha_muestreo', 'existeFechaMuestreo')->name('registro.existe.fecha.muestreo');//
    Route::post('registro_editor/save_registro', 'saveRegistro')->name('registro.save.registro');//    
    Route::post('registro_editor/save_archivo_registro', 'saveArchivoRegistro')->name('registro.save.archivo.registro');//

    Route::post('registro_editor/destinatario_alarma', 'destinatarioAlarma')->name('registro.destinatario.alarma');//
    
    Route::post('registro_editor/send_alarma', 'sendAlarma')->name('registro.send.alarma');//
    Route::post('registro_editor/load_historial_centro_pdf', 'loadHistorialCentrosPDF')->name('registro.load.historial.centro.pdf');//
    Route::get('registro_editor/search_especie_registro', 'searchEspecieRegistro')->name('registro.search.especie.registro');//
    Route::post('registro_editor/carga_registro_automatico', 'cargaRegistroAutomatico')->name('registro.carga.registro.automatico');//
    Route::get('registro_editor/search_especie_no_existe', 'searchEspecieNoExiste')->name('registro.search.especie.no.existe');//
    Route::get('registro_editor/search_siep_no_existe', 'searchSiepNoExiste')->name('registro.search.siep.no.existe');//
    Route::post('registro_editor/save_especie_no_existe', 'saveEspecieNoExiste')->name('registro.save.especie.no.existe');//
    Route::post('registro_editor/delete_especie_no_existe', 'deleteEspecieNoExiste')->name('registro.delete.especie.no.existe');//
    Route::get('registro_editor/get_archivo/{id?}' ,'getArchivo' )->name('registro.get.archivo');
    Route::get('registro_editor/get_imagen_especie/{id?}/{numImg?}' ,'getImagenEspecie' )->name('registro.get.imagen.especie');
    //Route::put('registro_editor/get_archivo/{id?}', 'getArchivo')->name('registro.get.archivo');//



});


// ==============Rutas Historial=====================//


// ==============Rutas Mapas=====================//



// ==============Rutas Informe=====================//


// ==============Rutas Declaracion=====================//



// ==============Rutas Configuracion=====================//



Route::get('registro_editor/alarma_generar_registro/', [PDFController::class, 'alarmaGenerarRegistro'])->name('registro.alarma.generar.registro');
Route::get('registro_editor/alarma_generar_registro_web/{m?}/{i?}/{Alarma?}', [PDFController::class, 'verPDFAlarma'])->name('registro.alarma.generar.registro.web');