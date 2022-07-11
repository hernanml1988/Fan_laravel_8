<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Centro;
use App\Models\Configuracion;
use App\Models\Declaracion;
use App\Models\Documento;
use App\Models\Empresa;
use App\Models\EmpresaGeneral;
use App\Models\Especie;
use App\Models\EspecieEstandar;
use App\Models\EspecieGeneral;
use App\Models\HistorialEmail;
use App\Models\Medicion;
use App\Models\MedicionFan;
use App\Models\MedicionPAmbientales;
use App\Models\Notificacion;
use App\Models\Opciones;
use App\Models\Pambientales;
use App\Models\Permisos;
use App\Models\User;
use App\Models\MedicionEliminada;
//use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;
use PDF;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Response;

date_default_timezone_set('america/santiago');


use Illuminate\Http\Request;



class PDFController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//\DB::setDefaultConnection('mysql');

		//$this->middleware('guest');
		$this->middleware('auth');
		//$this->middleware('acceso.sistema');
		//$this->middleware('politica.empresa');


		//$this->middleware('auth.basic');
	}

    public function alarmaGenerarRegistro(Request $request)
    {   
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);   
        /*	 https://codebriefly.com/laravel-5-export-to-pdf-laravel-dompdf/
		1)composer require barryvdh/laravel-dompdf      o      composer require barryvdh/laravel-dompdf:0.8.2
		2)	'providers' => [
			  Barryvdh\DomPDF\ServiceProvider::class,
			],
			'aliases' => [
			  'PDF' => Barryvdh\DomPDF\Facade::class,
			]
		3) php artisan vendor:publish
		4) Si tira error:  Container.php line 741: Class dompdf.wrapper does not exist
			php artisan cache:clear
			php artisan config:cache
		5) ErrorException in AdobeFontMetrics.php line 45:
		   fopen(/home/ubuntu/sitios/dgs/storage/fonts//a8769c937f1ce00fa32bc26571a086c5.ufm): failed to open stream: No such file or directory
			a) crate "fonts" Folder inside storage
			b) create file "5ab413ede0c0d14abbb48febee3bfdfb.ufm" or other "File Name" Which show in error inside "fonts" Folder
			c) Giving Permission "fonts" Folder  ( sudo chmod 777 fonts -R  )

*/
            if ($request->input('i')) { 

            $i = $request->input('i');// $_POST['i'];
            $m =  $request->input('m');//$_POST['m'];
            $Alarma =  $request->input('a');//$_POST['a'];
            $Centro =  $request->input('c');//$_POST['c'];
            $Fecha =  $request->input('f');//$_POST['f'];
            $empresa = EmpresaGeneral::find($miuser->IDempresa);
            //echo $Alarma;
            //Nombre aleatorio para el pdf
             $min=1;
             $max=99;
             $random = rand($min,$max);
            
            //Eliminar pdf anterior
            
            $nombre_pdf = 'Centro_'.$Centro.'_'.$Fecha.'_GTRfan__'.$random.'__'.$m.'.pdf';
            $nombre_pdf = preg_replace('/\s+/', '_', $nombre_pdf);
            
            function elimina_acentos($text)
            {
                $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
                $text = strtolower($text);
                $patron = array (
                    // Espacios, puntos y comas por guion
                    //'/[\., ]+/' => ' ',
         
                    // Vocales
                    '/\+/' => '',
                    '/&agrave;/' => 'a',
                    '/&egrave;/' => 'e',
                    '/&igrave;/' => 'i',
                    '/&ograve;/' => 'o',
                    '/&ugrave;/' => 'u',
         
                    '/&aacute;/' => 'a',
                    '/&eacute;/' => 'e',
                    '/&iacute;/' => 'i',
                    '/&oacute;/' => 'o',
                    '/&uacute;/' => 'u',
         
                    '/&acirc;/' => 'a',
                    '/&ecirc;/' => 'e',
                    '/&icirc;/' => 'i',
                    '/&ocirc;/' => 'o',
                    '/&ucirc;/' => 'u',
         
                    '/&atilde;/' => 'a',
                    '/&etilde;/' => 'e',
                    '/&itilde;/' => 'i',
                    '/&otilde;/' => 'o',
                    '/&utilde;/' => 'u',
         
                    '/&auml;/' => 'a',
                    '/&euml;/' => 'e',
                    '/&iuml;/' => 'i',
                    '/&ouml;/' => 'o',
                    '/&uuml;/' => 'u',
         
                    '/&auml;/' => 'a',
                    '/&euml;/' => 'e',
                    '/&iuml;/' => 'i',
                    '/&ouml;/' => 'o',
                    '/&uuml;/' => 'u',
         
                    // Otras letras y caracteres especiales
                    '/&aring;/' => 'a',
                    '/&ntilde;/' => 'n',
         
                    // Agregar aqui mas caracteres si es necesario
         
                );
         
                $text = preg_replace(array_keys($patron),array_values($patron),$text);
                return $text;
            }

            
            
            $nombre_pdf = 'hola.pdf';//elimina_acentos($nombre_pdf);
            
            
            //$execute = shell_exec("wkhtmltopdf --disable-smart-shrinking --no-outline --page-size A3 --margin-top 2mm --margin-bottom 0mm --margin-right 0mm --margin-left 0mm 'https://127.0.0.1:8000/registro_editor/alarma_generar_registro_web/155271/550/Nivel%20Critico' --javascript-delay 1500 C:\Users\PC1GT\Documents\.$nombre_pdf.2>&1");
            $execute = exec('wkhtmltopdf "https://styde.net/generar-pdfs-en-laravel-5-1-con-snappy" docmento.pdf 2>&1');
             echo $execute;
             echo 'fin';
             return  $execute;
       
        }}          
        
        public function pdfview()
            {

                $pdf = PDF::loadHtml('<h1>test</h1>');
            return $pdf->stream('example.pdf');
               
            }
                
        
        public function verPDFAlarma(Request $request, $m, $i, $Alarma)
        {
           

            function obtenerDireccionIP()
            {
                if (!empty($_SERVER ['HTTP_CLIENT_IP'] ))
                    $ip=$_SERVER ['HTTP_CLIENT_IP'];
                elseif (!empty($_SERVER ['HTTP_X_FORWARDED_FOR'] ))
                    $ip=$_SERVER ['HTTP_X_FORWARDED_FOR'];
                else
                    $ip=$_SERVER ['REMOTE_ADDR'];

                return $ip;
            }

            $ipcliente = obtenerDireccionIP();
        
            if($ipcliente != "127.0.0.1"){//52.204.158.88
                    // return "Acceso denegado";
                    // die();
            }

            $miuser = User::where('id' , $i)
                                    ->where('estado', 1)
                                    ->where('fan', 1)
                                    ->select('IDempresa', 'id')           
                                    ->first(); 
            
            $this->cambiar_bd($miuser->IDempresa);  
            $empresa = EmpresaGeneral::find($miuser->IDempresa);
        //trae las opciones 
                $opciones = Opciones::where('IDempresa',$miuser->IDempresa)
                                        ->where('Nombre','Profundidad')
                                        ->select('Opciones')
                                        ->first();

                                        

                                        //Diatomeas
                                        $Diato = MedicionFan::where('medicion_fan.IDmedicion',$m)
                                                        ->join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
                                                        ->where('especie.Grupo','Diatomeas')
                                                        ->select('especie.Nombre',
                                                                'especie.Nivel_Critico',
                                                                DB::raw("CASE WHEN gtr_especie.Alarma_Rojo = 0 then '-' ELSE gtr_especie.Alarma_Rojo END as Alarma_Rojo "),
                                                                DB::raw("CASE WHEN gtr_especie.Alarma_Amarillo = 0 then '-' ELSE gtr_especie.Alarma_Amarillo END as Alarma_Amarillo "),
                                                                DB::raw("CASE WHEN gtr_especie.Nociva = 1 then 'Si' ELSE '-' END as Nociva "),
                                                                DB::raw("CASE WHEN gtr_especie.Fiscaliza = 1 then 'Si' ELSE '-' END as Fiscaliza "),
                                                                'especie.Imagen',
                                                                'especie.IDespecie as IDespecie',
                                                                'medicion_fan.Medicion_1',
                                                                'medicion_fan.Medicion_2',
                                                                'medicion_fan.Medicion_3',
                                                                'medicion_fan.Medicion_4',
                                                                'medicion_fan.Medicion_5',
                                                                'medicion_fan.Medicion_6',
                                                                'medicion_fan.Medicion_7' 
                                                            )
                                                        ->orderBy('especie.Nombre','ASC')
                                                        ->get();
                                
                                        //Dinoflagelados
                                        $Dino = MedicionFan::where('medicion_fan.IDmedicion',$m)
                                                        ->join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
                                                        ->where('especie.Grupo','Dinoflagelados')
                                                        ->select('especie.Nombre',
                                                                'especie.Nivel_Critico',
                                                                DB::raw("CASE WHEN gtr_especie.Alarma_Rojo = 0 then '-' ELSE gtr_especie.Alarma_Rojo END as Alarma_Rojo "),
                                                                DB::raw("CASE WHEN gtr_especie.Alarma_Amarillo = 0 then '-' ELSE gtr_especie.Alarma_Amarillo END as Alarma_Amarillo "),
                                                                DB::raw("CASE WHEN gtr_especie.Nociva = 1 then 'Si' ELSE '-' END as Nociva "),
                                                                DB::raw("CASE WHEN gtr_especie.Fiscaliza = 1 then 'Si' ELSE '-' END as Fiscaliza "),
                                                                'especie.Imagen',
                                                                'especie.IDespecie as IDespecie',
                                                                'medicion_fan.Medicion_1',
                                                                'medicion_fan.Medicion_2',
                                                                'medicion_fan.Medicion_3',
                                                                'medicion_fan.Medicion_4',
                                                                'medicion_fan.Medicion_5',
                                                                'medicion_fan.Medicion_6',
                                                                'medicion_fan.Medicion_7' 
                                                            )
                                                        ->orderBy('especie.Nombre','ASC')
                                                        ->get();
                                        
                                        //Otras Especies
                                        $OEsp = MedicionFan::where('medicion_fan.IDmedicion',$m)
                                                        ->join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
                                                        ->where('especie.Grupo','Otras Especies')
                                                        ->select('especie.Nombre','especie.Nivel_Critico',
                                                                DB::raw("CASE WHEN gtr_especie.Alarma_Rojo = 0 then '-' ELSE gtr_especie.Alarma_Rojo END as Alarma_Rojo "),
                                                                DB::raw("CASE WHEN gtr_especie.Alarma_Amarillo = 0 then '-' ELSE gtr_especie.Alarma_Amarillo END as Alarma_Amarillo "),
                                                                DB::raw("CASE WHEN gtr_especie.Nociva = 1 then 'Si' ELSE '-' END as Nociva "),
                                                                DB::raw("CASE WHEN gtr_especie.Fiscaliza = 1 then 'Si' ELSE '-' END as Fiscaliza "),
                                                                'especie.Imagen',
                                                                'especie.IDespecie as IDespecie',
                                                                'medicion_fan.Medicion_1',
                                                                'medicion_fan.Medicion_2',
                                                                'medicion_fan.Medicion_3',
                                                                'medicion_fan.Medicion_4',
                                                                'medicion_fan.Medicion_5',
                                                                'medicion_fan.Medicion_6',
                                                                'medicion_fan.Medicion_7' 
                                                            )
                                                        ->orderBy('especie.Nombre','ASC')
                                                        ->get();
                                
                                        //Tabla General Medición	
                                        $tabla = Medicion::where('medicion.IDmedicion',$m)
                                                        ->join('centro','centro.IDcentro','medicion.IDcentro')
                                                        ->where('medicion.Estado',1)
                                                        ->select(
                                                                DB::raw("DATE_FORMAT(Fecha_Envio, '%d-%m-%Y %H:%i') as Fecha_Envio"),
                                                                DB::raw("DATE_FORMAT(Fecha_Reporte, '%d-%m-%Y %H:%i') as Fecha_Reporte"),
                                                                DB::raw("DATE_FORMAT(Fecha_Analisis, '%d-%m-%Y %H:%i') as Fecha_Analisis"),
                                                                'medicion.Tecnica',
                                                                'medicion.Observaciones',
                                                                'medicion.Archivo',
                                                                'medicion.Mortalidad',
                                                                'medicion.Firma',
                                                                'medicion.Especie',
                                                                'medicion.Siembra',
                                                                'medicion.Cosecha',
                                                                'medicion.Estado_Alarma',
                                                                'centro.IDcentro as IDcentro',
                                                                'centro.Nombre',
                                                                'centro.IDbarrio',
                                                                'centro.Codigo',
                                                                'medicion.TopLeft',
                                                                'medicion.Modulo',
                                                                'medicion.Jaula'
                                                            )
                                                        ->get();
                                        
                                        $archivos = Documento::where('IDempresa', $miuser->IDempresa)
                                                        ->where('IDmedicion', $m)
                                                        ->first();
                                
                                                        function DDtoDMS1($dec)
                                                        {
                                                            // Converts decimal format to DMS ( Degrees / minutes / seconds )
                                                            $vars = explode(".",$dec);
                                                            $deg = $vars[0];
                                                            $tempma = "0.".$vars[1];
                                        
                                                            $tempma = $tempma * 3600;
                                                            $min = floor($tempma / 60);
                                                            $sec = $tempma - ($min*60);
                                        
                                                            return array("deg"=>-1*round($deg),"min"=>$min,"sec"=>round($sec,2),'$vars '=>$vars );
                                                                //Esta forzado los grados a -1 para que sea Sur Oeste
                                        
                                                        }
                                        foreach($tabla as $tabla){
                                        $Fecha_Envio  = $tabla->Fecha_Envio;
                                        $Fecha_Analisis  = $tabla->Fecha_Analisis;
                                        $Fecha_Reporte  = $tabla->Fecha_Reporte;
                                        $Tecnica  = $tabla->Tecnica;
                                        $Observaciones  = $tabla->Observaciones;
                                        $Archivo  = $archivos;
                                        $Firma  = $tabla->Firma;
                                        $Mortalidad  = $tabla->Mortalidad;
                                        $Nombre  = $tabla->Nombre;
                                        $Especie  = $tabla->Especie;
                                        $Siembra  = $tabla->Siembra;
                                        $Cosecha  = $tabla->Cosecha;
                                        $IDbarrio = $tabla->IDbarrio;
                                        $IDcentro = $tabla->IDcentro;
                                        $Codigo = $tabla->Codigo;
                                        $Estado_Alarma = $tabla->Estado_Alarma;
                                        $Modulo = $tabla->Modulo;
                                        $Jaula = $tabla->Jaula;
                                        $TopLeft = $tabla->TopLeft;
                                        if ($TopLeft) {
                                            $topleft = explode(',',$TopLeft);
                                            $latitud = DDtoDMS1($topleft[0]);
                                            $longitud = DDtoDMS1($topleft[1]);
                                        }else{
                                            $latitud = '';
                                            $longitud = '';
                                        }
                                        }
                                
                                        $barrio_aux = Barrio::find($IDbarrio);
                                        $Barrio = $barrio_aux->Nombre;
                                        
                                        $ResultadoFanReporte = array(
                                            'Diatomeas' => $Diato,            
                                        'Dinoflagelados'=>$Dino,
                                        'OEsp'=>$OEsp,
                                        'Fecha_Envio'=>$Fecha_Envio,
                                        'Fecha_Analisis'=>$Fecha_Analisis,
                                        'Fecha_Reporte'=>$Fecha_Reporte,
                                        'Tecnica'=>$Tecnica,
                                        'Observaciones'=>$Observaciones,
                                        'Archivo'=>$Archivo,
                                        'Firma'=>$Firma,
                                        'Mortalidad'=>$Mortalidad,
                                        'Nombre'=>$Nombre,
                                        'Codigo'=>$Codigo,
                                        'IDcentro'=>$IDcentro,
                                        'Barrio'=>$Barrio,
                                        'Especie'=>$Especie,
                                        'Siembra'=>$Siembra,
                                        'Cosecha'=>$Cosecha,
                                        'Estado_Alarma'=>$Estado_Alarma,
                                        'Modulo'=>$Modulo,
                                        'Jaula'=>$Jaula,
                                        'latitud'=>$latitud,
                                        'longitud'=>$longitud,
                                        );
                
                                    /*-----------------------------------------------------*/
                                    $PAmbientales = PAmbientales::join('medicion_pambientales','medicion_pambientales.IDpambientales','=','pambientales.IDpambientales')
                                                                    ->where('medicion_pambientales.IDmedicion',$m)
                                                                    ->where('pambientales.Grupo','Columna de Agua')
                                                                    ->select( 'pambientales.Nombre',
                                                                    'pambientales.Grupo',
                                                                    'medicion_pambientales.Medicion_1',
                                                                    'medicion_pambientales.Medicion_2',
                                                                    'medicion_pambientales.Medicion_3',
                                                                    'medicion_pambientales.Medicion_4',
                                                                    'medicion_pambientales.Medicion_5',
                                                                    'medicion_pambientales.Medicion_6',
                                                                    'medicion_pambientales.Medicion_7' 
                                                                        )
                                                                    ->orderByRaw("CASE WHEN gtr_pambientales.Nombre = 'Observaciones' THEN 1 ELSE 0 END")
                                                                    ->orderBy('pambientales.Grupo', 'DESC')
                                                                    ->orderBy('pambientales.Nombre', 'ASC')
                                                                    ->get();
								
		//Otros
		$PAmbientalesotros = PAmbientales::join('medicion_pambientales','medicion_pambientales.IDpambientales','=','pambientales.IDpambientales')
                                ->where('pambientales.Grupo','NOT LIKE','%Columna de Agua%')
								->where('medicion_pambientales.IDmedicion',$m)
								->select( 'pambientales.Nombre',
                                'pambientales.Grupo',
                                'medicion_pambientales.Medicion_1',
                                'medicion_pambientales.Medicion_2',
                                'medicion_pambientales.Medicion_3',
                                'medicion_pambientales.Medicion_4',
                                'medicion_pambientales.Medicion_5',
                                'medicion_pambientales.Medicion_6',
                                'medicion_pambientales.Medicion_7' 
                                )
								->orderByRaw("CASE WHEN gtr_pambientales.Nombre = 'Observaciones' THEN 1 ELSE 0 END")
								->orderBy('pambientales.Grupo', 'DESC')
								->orderBy('pambientales.Nombre', 'ASC')
								->get();
								
                                $ResultadopambientalesReporte = array(
                                    'PAmbientales' => $PAmbientales, 
                                    'PAmbientalesotros' => $PAmbientalesotros, 
                                );


                    /*------------------------------------------------------------------------------------*/
                   $Especies_1 = array();
                   $Especies_2 = array();
                   $Especies_21 = array();
                   $Especies_3 = array();
                   $error = 0;
                    $IDmedicion = $m;
                   $fecha_query = Medicion::find($IDmedicion);
                   $IDcentro = $fecha_query->IDcentro;
                   $Fecha_Termino = date('Y-m-d', strtotime($fecha_query->Fecha_Reporte. ' +1 day'));
                   $Fecha_Termino = date('Y-m-d 00:00:00', strtotime($Fecha_Termino));
                   $Fecha_Inicio = date('Y-m-d', strtotime($Fecha_Termino. ' -7 day'));
                   
                   $All_Date = array();
                   $All_Date[0] = strtotime( $Fecha_Inicio );
                   $d = 0;
                   while ( $All_Date[$d] < strtotime($Fecha_Termino)) {
                       $All_Date[$d+1] = strtotime(date('Y-m-d',$All_Date[$d]). '+1 day');
                       $d++;
                   }
                   rsort($All_Date);
                   
                   /*	$Inespecies = implode(', ',$Especies);
                   $where = " AND e.IDespecie IN ($Inespecies)";
                   
                   $Inespecies_1 = implode(', ',$Especies_1);
                   $where_1 = " AND e.IDespecie IN ($Inespecies_1)";
                   $Inespecies_2 = implode(', ',$Especies_2);
                   $where_2 = " AND e.IDespecie IN ($Inespecies_2)";*/
                   
                   $especies_priorizadas = array();
                   $especies_priorizadas = $Especies_1;
                   
                   
                   //Busca las alarma rojo y amarillo de la semana
                   /*$where_alarma_rojo = " AND (mf.Medicion_1 >= e.Alarma_Rojo OR mf.Medicion_2 >= e.Alarma_Rojo OR mf.Medicion_3 >= e.Alarma_Rojo OR mf.Medicion_4 >= e.Alarma_Rojo OR mf.Medicion_5 >= e.Alarma_Rojo OR mf.Medicion_6 >= e.Alarma_Rojo OR mf.Medicion_7 >= e.Alarma_Rojo) AND e.Alarma_Rojo > 0 ";		
           
                   $where_alarma_amarillo = " AND ( (mf.Medicion_1 >= e.Alarma_Amarillo AND mf.Medicion_1 < e.Alarma_Rojo) OR (mf.Medicion_2 >= e.Alarma_Amarillo AND mf.Medicion_2 < e.Alarma_Rojo) OR (mf.Medicion_3 >= e.Alarma_Amarillo AND mf.Medicion_3 < e.Alarma_Rojo) OR (mf.Medicion_4 >= e.Alarma_Amarillo AND mf.Medicion_4 < e.Alarma_Rojo) OR (mf.Medicion_5 >= e.Alarma_Amarillo AND mf.Medicion_5 < e.Alarma_Rojo) OR (mf.Medicion_6 >= e.Alarma_Amarillo AND mf.Medicion_6 < e.Alarma_Rojo) OR (mf.Medicion_7 >= e.Alarma_Amarillo AND mf.Medicion_7 < e.Alarma_Rojo) ) AND e.Alarma_Amarillo > 0 ";*/
                   
                   
                   //Rojo semana
                   $rojo_semana = Medicion::join('medicion_fan','medicion_fan.IDmedicion','=','medicion.IDmedicion')
                                   ->where('medicion.Estado',1)
                                   ->join('especie','especie.IDespecie','medicion_fan.IDespecie')
                                   ->join('centro','centro.IDcentro','medicion.IDcentro')
                                   ->where('centro.IDcentro',$IDcentro)
                                   ->where('medicion.Fecha_Reporte','>',$Fecha_Inicio)
                                   ->where('medicion.Fecha_Reporte','<',$Fecha_Termino)
                                   ->where(
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>',0)
                                                       ->orWhere('medicion_fan.Medicion_2','>',0)
                                                       ->orWhere('medicion_fan.Medicion_3','>',0)
                                                       ->orWhere('medicion_fan.Medicion_4','>',0)
                                                       ->orWhere('medicion_fan.Medicion_5','>',0)
                                                       ->orWhere('medicion_fan.Medicion_6','>',0)
                                                       ->orWhere('medicion_fan.Medicion_7','>',0);
                                                   }
                                           )
                                   ->where(//Busca las alarma rojode la semana
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>=',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_2','>=',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_3','>=',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_4','>=',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_5','>=',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_6','>=',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_7','>=',DB::raw('gtr_especie.Alarma_Rojo'));
                                                   }
                                           )
                                   ->where('especie.Alarma_Rojo','>',0)
                                   ->select('medicion_fan.IDespecie')
                                   ->distinct('medicion_fan.IDespecie')
                                   ->orderBy('medicion.Fecha_Reporte','DESC')
                                   ->get();
                                   
                       foreach($rojo_semana as $row){
                           if(!in_array($row->IDespecie,$especies_priorizadas)){
                               $especies_priorizadas[] = $row->IDespecie;
                           }	
                       }
                       
                       
                   //Amarillo semana
                   $amarillo_semana = Medicion::join('medicion_fan','medicion_fan.IDmedicion','=','medicion.IDmedicion')
                                   ->where('medicion.Estado',1)
                                   ->join('especie','especie.IDespecie','medicion_fan.IDespecie')
                                   ->join('centro','centro.IDcentro','=','medicion.IDcentro')
                                   ->where('centro.IDcentro',$IDcentro)
                                   ->where('medicion.Fecha_Reporte','>',$Fecha_Inicio)
                                   ->where('medicion.Fecha_Reporte','<',$Fecha_Termino)
                                   ->where(
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>',0)
                                                       ->orWhere('medicion_fan.Medicion_2','>',0)
                                                       ->orWhere('medicion_fan.Medicion_3','>',0)
                                                       ->orWhere('medicion_fan.Medicion_4','>',0)
                                                       ->orWhere('medicion_fan.Medicion_5','>',0)
                                                       ->orWhere('medicion_fan.Medicion_6','>',0)
                                                       ->orWhere('medicion_fan.Medicion_7','>',0);
                                                   }
                                           )
                                   ->where(//Busca las alarma rojo de la semana
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','<',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_2','<',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_3','<',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_4','<',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_5','<',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_6','<',DB::raw('gtr_especie.Alarma_Rojo'))
                                                       ->orWhere('medicion_fan.Medicion_7','<',DB::raw('gtr_especie.Alarma_Rojo'));
                                                   }
                                           )
                                   ->where(//Busca las alarma amarilla de la semana
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>=',DB::raw('gtr_especie.Alarma_Amarillo'))
                                                       ->orWhere('medicion_fan.Medicion_2','>=',DB::raw('gtr_especie.Alarma_Amarillo'))
                                                       ->orWhere('medicion_fan.Medicion_3','>=',DB::raw('gtr_especie.Alarma_Amarillo'))
                                                       ->orWhere('medicion_fan.Medicion_4','>=',DB::raw('gtr_especie.Alarma_Amarillo'))
                                                       ->orWhere('medicion_fan.Medicion_5','>=',DB::raw('gtr_especie.Alarma_Amarillo'))
                                                       ->orWhere('medicion_fan.Medicion_6','>=',DB::raw('gtr_especie.Alarma_Amarillo'))
                                                       ->orWhere('medicion_fan.Medicion_7','>=',DB::raw('gtr_especie.Alarma_Amarillo'));
                                                   }
                                           )
                                   ->where('especie.Alarma_Amarillo','>',0)
                                   ->select('medicion_fan.IDespecie')
                                   ->distinct('medicion_fan.IDespecie')
                                   ->orderBy('medicion.Fecha_Reporte','DESC')
                                   ->get();
                                   
                       foreach($amarillo_semana as $row){
                           if(!in_array($row->IDespecie,$especies_priorizadas)){
                               $especies_priorizadas[] = $row->IDespecie;
                           }	
                       }
                       
                       //Agrega las nocivas del día y si hay alarmas solo las que tengas nivel nocivo definido
                       if($request->input('Especies_2')){
                           $especies_priorizadas = array_merge($especies_priorizadas,$Especies_2);
                       }
                       
                       
                       
                       
                       if(count($especies_priorizadas)<=15){
                       
                           //Buscar nocivas de la semana		
                           if(count($especies_priorizadas) > 0){
                               $nocivas_semana = Medicion::join('medicion_fan','medicion_fan.IDmedicion','medicion.IDmedicion')
                                   ->where('medicion.Estado',1)
                                   ->join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
                                   ->join('centro','centro.IDcentro','=','medicion.IDcentro')
                                   ->where('centro.IDcentro',$IDcentro)
                                   ->where('medicion.Fecha_Reporte','>',$Fecha_Inicio)
                                   ->where('medicion.Fecha_Reporte','<',$Fecha_Termino)		
                                   ->where(
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>',0)
                                                       ->orWhere('medicion_fan.Medicion_2','>',0)
                                                       ->orWhere('medicion_fan.Medicion_3','>',0)
                                                       ->orWhere('medicion_fan.Medicion_4','>',0)
                                                       ->orWhere('medicion_fan.Medicion_5','>',0)
                                                       ->orWhere('medicion_fan.Medicion_6','>',0)
                                                       ->orWhere('medicion_fan.Medicion_7','>',0);
                                                   }
                                           )
                                   ->where('especie.Nociva',1)
                                   ->where('especie.Nivel_Critico','>',0)
                                   ->select('medicion_fan.IDespecie')
                                   ->distinct('medicion_fan.IDespecie')
                                   ->orderBy('medicion.Fecha_Reporte','DESC')
                                   ->get();
                           }else{
                               if($request->input('Especies_21')){
                                   $especies_priorizadas = array_merge($especies_priorizadas,$Especies_21);
                               }
                               
                               $nocivas_semana = Medicion::join('medicion_fan','medicion_fan.IDmedicion','medicion.IDmedicion')
                                   ->where('medicion.Estado',1)
                                   ->join('especie','especie.IDespecie','medicion_fan.IDespecie')
                                   ->join('centro','centro.IDcentro','=','medicion.IDcentro')
                                   ->where('centro.IDcentro',$IDcentro)
                                   ->where('medicion.Fecha_Reporte','>',$Fecha_Inicio)
                                   ->where('medicion.Fecha_Reporte','<',$Fecha_Termino)		
                                   ->where(
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>',0)
                                                       ->orWhere('medicion_fan.Medicion_2','>',0)
                                                       ->orWhere('medicion_fan.Medicion_3','>',0)
                                                       ->orWhere('medicion_fan.Medicion_4','>',0)
                                                       ->orWhere('medicion_fan.Medicion_5','>',0)
                                                       ->orWhere('medicion_fan.Medicion_6','>',0)
                                                       ->orWhere('medicion_fan.Medicion_7','>',0);
                                                   }
                                           )
                                   ->where('especie.Nociva',1)
                                   ->select('medicion_fan.IDespecie')
                                   ->distinct('medicion_fan.IDespecie')
                                   ->orderBy('medicion.Fecha_Reporte','DESC')
                                   ->get();
                               
                           }
                           
                           foreach($nocivas_semana as $row){
                               if(!in_array($row->IDespecie,$especies_priorizadas)){
                                   $especies_priorizadas[] = $row->IDespecie;
                               }	
                           }
                           
                           
                           if(count($especies_priorizadas)<=5){
                       
                               //Agrega resto del día
                               if($request->input('Especies_3')){
                                   //$especies_priorizadas = array_merge($especies_priorizadas,$Especies_3);
                               }
                                   
                               if(count($especies_priorizadas)<=10){
                               
                                   //Buscar el resto de la semana
                                   /*$no_nocivas_semana = IngresoRegistro::join('medicion_fan','medicion_fan.IDmedicion','=','ingreso_registro.id')
                                       ->where('ingreso_registro.Estado',1)
                                       ->join('especie','especie.id','=','medicion_fan.IDespecie')
                                       ->join('centro','centro.id','=','ingreso_registro.IDcentro')
                                       ->where('centro.id',$IDcentro)
                                       ->where('ingreso_registro.Fecha_Reporte','>',$Fecha_Inicio)
                                       ->where('ingreso_registro.Fecha_Reporte','<',$Fecha_Termino)		
                                       ->where(
                                                       function ($query) {
                                                           $query->where('medicion_fan.Medicion_1','>',0)
                                                           ->orWhere('medicion_fan.Medicion_2','>',0)
                                                           ->orWhere('medicion_fan.Medicion_3','>',0)
                                                           ->orWhere('medicion_fan.Medicion_4','>',0)
                                                           ->orWhere('medicion_fan.Medicion_5','>',0)
                                                           ->orWhere('medicion_fan.Medicion_6','>',0)
                                                           ->orWhere('medicion_fan.Medicion_7','>',0);
                                                       }
                                               )
                                       ->where('especie.Nociva',0)
                                       ->select('medicion_fan.IDespecie')
                                       ->distinct('medicion_fan.IDespecie')
                                       ->orderBy('ingreso_registro.Fecha_Reporte','DESC')
                                       ->get();
                                       
                                   foreach($no_nocivas_semana as $row){
                                       if(!in_array($row->IDespecie,$especies_priorizadas)){
                                           $especies_priorizadas[] = $row->IDespecie;
                                       }	
                                   }*/
                                   
                               }
                               
                           }
                           
                       }
                       
                       if(count($especies_priorizadas)>15){
                           $especies_priorizadas = array_slice($especies_priorizadas, 0, 15);
                       }
                       
                       /*$Inespecies = implode(', ',$especies_priorizadas);
                       $where = " AND e.IDespecie IN ($Inespecies)";*/
                       //Fiscaliza = 1  
                       if(count($especies_priorizadas)>0){
                           
                           $consulta = Medicion::join('medicion_fan','medicion_fan.IDmedicion','=','medicion.IDmedicion')
                                   ->where('medicion.Estado',1)
                                   ->where('medicion.IDcentro',$IDcentro)
                                   ->join('especie','especie.IDespecie','medicion_fan.IDespecie')
                                   ->whereIn('especie.IDespecie',$especies_priorizadas)	
                                   ->where('medicion.Fecha_Reporte','>',$Fecha_Inicio)
                                   ->where('medicion.Fecha_Reporte','<',$Fecha_Termino)
                                   ->where(
                                                   function ($query) {
                                                       $query->where('medicion_fan.Medicion_1','>',0)
                                                       ->orWhere('medicion_fan.Medicion_2','>',0)
                                                       ->orWhere('medicion_fan.Medicion_3','>',0)
                                                       ->orWhere('medicion_fan.Medicion_4','>',0)
                                                       ->orWhere('medicion_fan.Medicion_5','>',0)
                                                       ->orWhere('medicion_fan.Medicion_6','>',0)
                                                       ->orWhere('medicion_fan.Medicion_7','>',0);
                                                   }
                                           )
                                   ->select('medicion.Fecha_Reporte',
                                       DB::raw("DATE_FORMAT(gtr_medicion.Fecha_Reporte, '%d-%m-%Y') as Date_Reporte"),
                                       DB::raw("DATE_FORMAT(gtr_medicion.Fecha_Reporte, '%d-%m-%Y %H:%i') as fecha_reporte_format"),
                                       'especie.Nombre',
                                       'medicion_fan.Medicion_1',
                                       'medicion_fan.Medicion_2',
                                       'medicion_fan.Medicion_3',
                                       'medicion_fan.Medicion_4',
                                       'medicion_fan.Medicion_5',
                                       'medicion_fan.Medicion_6',
                                       'medicion_fan.Medicion_7',
                                       'especie.Nivel_Critico',
                                       'especie.Alarma_Rojo',
                                       'especie.Alarma_Amarillo',
                                       'medicion.IDmedicion')
                                   ->orderBy('especie.Nombre','ASC')
                                   ->orderBy('medicion.Fecha_Reporte','DESC')
                                   ->get();
                                   
                           $Resultado = array();
                           $nombreaux = "";
                           $timestampmax = 0;
                           $timestampmin = 0;
                           $med = array();
                           $med_norm = array();
                           $Alarma_Rojo = array();
                           $Alarma_Amarillo = array();
                           $n = 0;
                           $critico = 1;
                           foreach($consulta as $row){	
                               if($nombreaux != $row->Nombre){$nombre = $row->Nombre; $nombreaux = $nombre; $Resultado['Nombre'][] = $nombre;}
                               $timestamp = strtotime($row->Fecha_Reporte)*1000;
                               
                               $med[$n] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                               $Alarma_Rojo[$n] = $row->Alarma_Rojo;
                               $Alarma_Amarillo[$n] = $row->Alarma_Amarillo;
                               
                               if($row->Nivel_Critico>0){
                                   $med_norm[$n] = 100*$med[$n]/$row->Nivel_Critico;
                               }else{$med_norm[$n] = $med[$n]; $critico = 0;}
                               
                               
                               $Resultado[$nombre."norm"][] = array($timestamp, $med_norm[$n], $row->Alarma_Rojo,$row->Alarma_Amarillo,$med[$n],$row->Nivel_Critico,$row->fecha_reporte_format,$row->IDmedicion,strtotime($row->Date_Reporte) );
                               
                               $Resultado[$nombre][] = array($timestamp, $med[$n], $row->Alarma_Rojo,$row->Alarma_Amarillo,$med[$n],$row->Nivel_Critico,$row->fecha_reporte_format,$row->IDmedicion,strtotime($row->Date_Reporte) );
                               
                               //Máximo del día
                               /*if(isset($Fecha[$nombre])){
                                   $key = array_search($timestamp, $Fecha[$nombre]);
                               }else{$key = false;}
                               
                               if ($key != false){
                                   $ant = $Resultado[$nombre][$key][1];
                                   if($ant < $med[$n] ){
                                       $Resultado[$nombre."norm"][$key] = array($timestamp, $med_norm[$n], $row->Alarma_Rojo,$row->Alarma_Amarillo,$med[$n],$row->Nivel_Critico,$row->fecha_reporte_format,$row->IDmedicion,strtotime($row->Date_Reporte) );
                                       
                                       $Resultado[$nombre][$key] = array($timestamp, $med[$n], $row->Alarma_Rojo,$row->Alarma_Amarillo,$med[$n],$row->Nivel_Critico,$row->fecha_reporte_format,$row->IDmedicion,strtotime($row->Date_Reporte) );
                                       
                                   }
                               }else{
                                   
                                   $Resultado[$nombre."norm"][] = array($timestamp, $med_norm[$n], $row->Alarma_Rojo,$row->Alarma_Amarillo,$med[$n],$row->Nivel_Critico,$row->fecha_reporte_format,$row->IDmedicion,strtotime($row->Date_Reporte) );
                               
                                   $Resultado[$nombre][] = array($timestamp, $med[$n], $row->Alarma_Rojo,$row->Alarma_Amarillo,$med[$n],$row->Nivel_Critico,$row->fecha_reporte_format,$row->IDmedicion,strtotime($row->Date_Reporte) );
                                   
                                   $Fecha[$nombre][] = $timestamp;
                               }*/
                                               
                               if($timestampmin == 0){$timestampmin = $timestamp;}
                               if($timestamp > $timestampmax){$timestampmax = $timestamp;}
                               if($timestamp < $timestampmin){$timestampmin = $timestamp;}
                               $n++;
                           }
                           
                           if($n > 0){
                               $Resultado['Error'] = $error;
                               $Resultado['Max_norm'] = max($med_norm);
                               $Resultado['Max'] = max($med);
                               $Resultado['Critico'] = $critico;
                               $Resultado['Rojo'] =  max($Alarma_Rojo);
                               $Resultado['Amarillo'] =  max($Alarma_Amarillo);
                               $Resultado['F_Min'] = strtotime($Fecha_Inicio)*1000;//$timestampmin;
                               $Resultado['F_Max'] = strtotime($Fecha_Termino)*1000-1000;
                               $Resultado['Semana'] = $All_Date;
                           }else{
                               $Resultado['Error'] = $error;	
                           }
                               
                       }else{
                           $Resultado['Error'] = 1;	
                       }	

               


            // if(file_exists($nombre_pdf)){
            //     unlink($nombre_pdf); 
            // }
            return view('prueba',['user_id'  => $miuser->id,
                                               'idmedicion' =>  $m ,
                                               'alarma' => $Alarma,
                                                'empresa' =>$empresa,
                                                'opciones' =>$opciones->Opciones,
                                                'fanReporte' =>$ResultadoFanReporte,
                                                'pambientales' => $ResultadopambientalesReporte,
                                                'Resultado' => $Resultado,
                                            ]);

               
            $pdf = PDF::loadView('pdf_alarma_registro', [
                                              'user_id'  => $miuser->id,
                                              'idmedicion' =>  $m ,
                                               'alarma' => $Alarma,
                                               'empresa' =>$empresa,
                                               'opciones' =>$opciones->Opciones,
                                               'fanReporte' =>$ResultadoFanReporte,
                                                 'pambientales' => $ResultadopambientalesReporte,
                                                 'Resultado' => $Resultado,
                                            ]);
  
            return $pdf->download('hola.pdf');
            
            // if( 1 == 'ver'){
            //    
            // }
            // else{
                // $pdf->save(storage_path("app/").$id.'.pdf');
    
                // $response = array(
                //     'status'=> "success"
                // );
                                                                
                // return \Response::json($response);
           // }
                                                                
            
            //Crear pdf	
        //     shell_exec('wkhtmltopdf --disable-smart-shrinking --no-outline --page-size A3 --margin-top 2mm --margin-bottom 0mm --margin-right 0mm --margin-left 0mm "http://fan.gtrgestion.cl/pdf_alarma_registro.php?i='.$i.'&m='.$m.'&a='.$Alarma.'" --javascript-delay 1500 '.$nombre_pdf);
            
        //     if (file_exists($nombre_pdf)) {
                
        //         return Response::json($nombre_pdf);
        //         //echo json_encode($nombre_pdf);
            
        //     }
        //     else {
        //        echo 'Archivo no disponible.';
        //     }
            
            
        }
        
        
    

    public function descargaRegistro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa); 

        $currentUser = app('current_user');
	
        $nombre_pdf = $request->input('n');

        $nuevo_nombre = explode("__", $nombre_pdf); 
            
        $idmedicion = explode(".pdf", $nuevo_nombre[2]);
        $idmedicion = $idmedicion[0];
        
        $consulta = Medicion::join('centro',  function($query) use ($idmedicion){
                                            $query->on('medicion.IDcentro', '=', 'centro.IDcentro')
                                                    ->where('medicion.IDmedicion', '=', $idmedicion);
                                    }
                                )
                                ->first();
        // mysqli_query($con,"SELECT c.IDempresa FROM medicion m INNER JOIN centro c 
        // ON (m.IDcentro = c.IDcentro AND m.IDmedicion = '$idmedicion')")
        // or die ($error ="Error description: " . mysqli_error($consulta));
        //$row = mysqli_fetch_assoc($consulta);
        $idempresa = $consulta->IDempresa;
        
        //$iduser = $miuser->id;
        $consulta = User::where('user_id', $miuser->id)
                                ->select('IDempresa')
                                ->get();
        // mysqli_query($con,"SELECT IDempresa FROM as_users WHERE user_id = '$iduser'")
        // or die ($error ="Error description: " . mysqli_error($consulta));
        
        //$row = mysqli_fetch_assoc($consulta);
        $idempresa_user = $consulta->IDempresa;
        
        if(isset($nombre_pdf) && $idempresa == $idempresa_user){
            header('Content-Description: File Transfer');
            header('Content-Type: text/pdf');
            header('Content-Disposition: attachment; filename='.basename($nuevo_nombre[0].".pdf")); //
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate'); 
            header('Pragma: public');
            header('Content-Length: ' . filesize($nombre_pdf));
            ob_clean();
            flush();
            readfile($nombre_pdf);

            //Eliminar pdf del servidor
            if(file_exists($nombre_pdf)){
                unlink($nombre_pdf); 
            }
            
            exit;
            
        }else{
            
            echo $idmedicion ;
            echo "<BR>";
            echo isset($nombre_pdf);
            echo "<BR>";
            echo $idempresa ;
            echo "<BR>";
            echo $idempresa_user ;




        }
    }
    
    
    



    private function cambiar_bd($id_empresa)
    {
        $tipo = env('APP_TIPO');
        $prefix = env('PREFIX');
        $cla = env('DB_PASSWORD');
        $db_nombre = env('DB_DATABASE');
        $db_nombre3 = env('DB_DATABASE_THIRD');
        $user_name = env('DB_USERNAME');

       
        config(['database.connections.mysql.host' => "localhost"]);
        config(['database.connections.mysql.database' => $prefix.$db_nombre."_".$id_empresa]);
        config(['database.connections.mysql.username' => $user_name]);
        config(['database.connections.mysql.password' => $cla]);
    }
}


