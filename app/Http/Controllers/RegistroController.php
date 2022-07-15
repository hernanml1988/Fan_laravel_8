<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Centro;
use App\Models\Configuracion;
use App\Models\Declaracion;
use App\Models\Documento;
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
    

use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Common\Type; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Stmt\Echo_;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use PDO;

class RegistroController extends Controller
{
   
  
    public function loadRegistro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $user_id = $miuser->id;
		$search = $request->input('search');
		$order = $request->input('order');  //siempre es asc
		$limit = $request->input('limit');
		$offset = $request->input('offset');
        $IDcentro = $request->input('IDcentro');
              
       $registros = Medicion::where('IDcentro', $IDcentro)
									->where(
										function ($query) use ($search)  {
											$query->where(DB::raw("(DATE_FORMAT(Fecha_Reporte,'%d-%m-%Y'))") , 'like', '%' . $search . '%')
											->orWhere('Mortalidad' , 'like', '%' . $search . '%')
											->orWhere('Comentario' , 'like', '%' . $search . '%')
											->orWhere('Estado_Alarma' , 'like', '%' . $search . '%')
											->orWhere('Firma' , 'like', '%' . $search . '%')
											->orWhere('Observaciones' , 'like', '%' . $search . '%');
										}
									)
									->select('IDmedicion',
												DB::raw("DATE_FORMAT(Fecha_Envio, '%d-%m-%Y %H:%i') as Fecha_Envio"),
												DB::raw("DATE_FORMAT(Fecha_Reporte, '%d-%m-%Y %H:%i') as Fecha_Reporte"),
												DB::raw("DATE_FORMAT(Fecha_Analisis, '%d-%m-%Y %H:%i') as Fecha_Analisis"),
												'Mortalidad',
                                                'Comentario',
                                                'Fecha_Reporte as Fecha_Order',
												DB::raw("DATE_FORMAT(CAST(Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
												DB::raw("DATE_FORMAT(Fecha_Reporte, '%H:%i') as Time_Reporte"),
												'Estado_Alarma',
                                                'Tecnica',
                                                'Observaciones',
                                                'Firma',
                                                'Declarado',
                                                'Laboratorio',
												DB::raw("CASE WHEN Estado = 0 then 'No' ELSE 'Si' END as Estado")
											) 
									
									->orderBy('Fecha_Order', 'desc')
									->orderBy('IDmedicion', 'desc')
									
									->skip($offset)
									->take($limit)
									->get();      
                                    $response = array(
                                        'total' => Count($registros),
                                        'rows' => $registros,
                                        'idcentro' => $IDcentro
                                    );
        return Response::json($response);//response([$registros_count, $registros], 200, []);
    }
    /*===================================================================================================================*/

   

    public function loadDiatomeas(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
	    $error = 0;
       
      
        $diatomeas = Especie::where('Grupo', 'Diatomeas')  
                            ->where('Estado',1)
                            ->select('IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    'Fiscaliza as Fiscaliza_edit',
                                    'Nivel_Fiscaliza',
                                    'Nivel_Fiscaliza_Pre',
                                    'Nivel_Fiscaliza_Alerta',
                                    'Nivel_Critico',
                                    'Imagen',
                                    'Alarma_Rojo',
                                    'Alarma_Amarillo',
                                    'Detalle',
                                    DB::raw("CASE WHEN gtr_especie.Fiscaliza  = 1 then 'Si' ELSE '-' END as Fiscaliza ")
                                            )
                            ->where('IDempresa',$miuser->IDempresa)
                            ->orderBy('Nombre', 'ASC')
                            ->get();

                                $response = array(
                                    'total' => Count($diatomeas),
                                    'rows' => $diatomeas
                                );
        return Response::json($response);

       

    }
    /*===================================================================================================================*/

    public function loadDinoflagelados(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);       
        
	    $error = 0;
      

        $opciones = Especie::where('IDempresa',$miuser->IDempresa)
								->where('Grupo','Dinoflagelados')
								->where('Estado',1)
								->select('IDespecie',
                                'Nombre',
                                'Nociva',
                                'Fiscaliza as Fiscaliza_edit'
                                ,'Nivel_Fiscaliza',
                                'Nivel_Fiscaliza_Pre'
                                ,'Nivel_Fiscaliza_Alerta',
                                'Nivel_Critico',
                                'Imagen',
                                'Alarma_Rojo',
                                'Alarma_Amarillo','Detalle',
										DB::raw("CASE WHEN gtr_especie.Fiscaliza  = 1 then 'Si' ELSE '-' END as Fiscaliza ")
										)
								->orderBy('Nombre', 'ASC')
								->get();
		$response = array(
            	'total' => count($opciones),
            	'rows' => $opciones,
        	);
        return Response::json($response);
    }

        /*===================================================================================================================*/

    public function loadOespecies(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $opciones = Especie::where('IDempresa',$miuser->IDempresa)
								->where('Grupo','Otras Especies')
								->where('Estado',1)
								->select('IDespecie',
                                'Nombre',
                                'Nociva',
                                'Fiscaliza as Fiscaliza_edit',
                                'Nivel_Fiscaliza',
                                'Nivel_Fiscaliza_Pre',
                                'Nivel_Fiscaliza_Alerta',
                                'Nivel_Critico',
                                'Imagen',
                                'Alarma_Rojo',
                                'Alarma_Amarillo',
                                'Detalle',
										DB::raw("CASE WHEN gtr_especie.Fiscaliza  = 1 then 'Si' ELSE '-' END as Fiscaliza ")
										)
								->orderBy('Nombre', 'ASC')

								->get();
		$response = array(
            	'total' => count($opciones),
            	'rows' => $opciones,
        	);
        return Response::json($response);
        
    }


        /*===================================================================================================================*/

    public function loadPambientales(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);       
        
	    $error = 0;
       
     
	
		$resultado = Pambientales::where('IDempresa',$miuser->IDempresa)
								->where('Grupo','Columna de Agua')
								->where('Estado',1)
								->select('IDpambientales',
                                'Nombre',
                                'Grupo',
                                'Alarma_Rojo',
                                'Alarma_Amarillo')
								->orderBy('Nombre', 'ASC')
								->get();
		$response = array(
            	'total' => count($resultado),
            	'rows' => $resultado,
        	);
        return Response::json($response);
    }

        /*===================================================================================================================*/

    public function loadPambientalesOtros(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);       
        
	    $error = 0;

        $resultado = PAmbientales::where('pambientales.IDempresa',$miuser->IDempresa)
                                    ->where('pambientales.Grupo','NOT LIKE','%Columna de Agua%')
                                    ->where('pambientales.Estado',1)
                                    ->join('opciones','opciones.IDpambientales','pambientales.IDpambientales')
                                    ->where('opciones.IDempresa',$miuser->IDempresa)
                                    ->select('pambientales.IDpambientales as IDpambientales','pambientales.Nombre','pambientales.Grupo','opciones.Opciones')
                                    ->orderByRaw("CASE WHEN gtr_pambientales.Nombre = 'Observaciones' THEN 1 ELSE 0 END")
                                    ->orderBy('pambientales.Grupo', 'DESC')
                                    ->orderBy('pambientales.Nombre', 'ASC')
                                    ->get();   
                                    $response = array(
                                        'total' => count($resultado),
                                        'rows' => $resultado,
                                    );
                                return Response::json($response);

    }

    /*===================================================================================================================*/
    //cargar profundidades en tabla de registro
    public function loadOptionsProf(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
	
		$opciones = Opciones::where('IDempresa',$miuser->IDempresa)
								->where('Nombre','Profundidad')
								->select('Opciones')
								->first();
		
        return Response::json($opciones->Opciones);
    }
    
    /*===================================================================================================================*/

    public function alarmaGenerarRegistro()
    {
        if (isset($_POST['i'])) {
	
            $i = $_POST['i'];
            $m = $_POST['m'];
            $Alarma = $_POST['a'];
            $Centro = $_POST['c'];
            $Fecha = $_POST['f'];
                
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
            
            $nombre_pdf = elimina_acentos($nombre_pdf);
            
            if(file_exists($nombre_pdf)){
                unlink($nombre_pdf); 
            }
            
            //Crear pdf	
            shell_exec('wkhtmltopdf --disable-smart-shrinking --no-outline --page-size A3 --margin-top 2mm --margin-bottom 0mm --margin-right 0mm --margin-left 0mm "http://fan.gtrgestion.cl/pdf_alarma_registro.php?i='.$i.'&m='.$m.'&a='.$Alarma.'" --javascript-delay 1500 '.$nombre_pdf);
            
            if (file_exists($nombre_pdf)) {
                
                echo json_encode($nombre_pdf);
            
            }
            else {
               echo 'Archivo no disponible.';
            }
            
            
        }
        
    }
    

   /*===================================================================================================================*/

    public function loadArchivoRegistro(Request $request)
    {
        	
        // $table = "medicion"; 
        // $error = 0;
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);    
        
        // $IDmedicion = $_POST['IDmedicion'];
        $IDmedicion = $request->input('IDmedicion');
                    
        $consulta = Medicion::select('Archivo')
                                ->where('IDmedicion', $IDmedicion)
                                ->first();   
        
        // $consulta = mysqli_query($con,"SELECT Archivo FROM $table WHERE IDmedicion = '$IDmedicion'")
        // or die ("Error al traer los datos");	
                
        // $row = mysqli_fetch_assoc($consulta);
            
        return Response::json($consulta->Archivo);
        // echo json_encode($row);
    }

    /*===================================================================================================================*/

    public function loadFanReporte(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $IDmedicion = $request->input('IDmedicion');

        //Diatomeas
		$Diato = MedicionFan::where('medicion_fan.IDmedicion',$IDmedicion)
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
		$Dino = MedicionFan::where('medicion_fan.IDmedicion',$IDmedicion)
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
		$OEsp = MedicionFan::where('medicion_fan.IDmedicion',$IDmedicion)
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
		$tabla = Medicion::where('medicion.IDmedicion',$IDmedicion)
                        ->join('centro','centro.IDcentro','medicion.IDcentro')
                        ->where('medicion.Estado',1)
                        ->select(
                                DB::raw("DATE_FORMAT(Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio"),
                                DB::raw("DATE_FORMAT(Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte"),
                                DB::raw("DATE_FORMAT(Fecha_Analisis, '%d-%m-%Y %H:%i:%s') as Fecha_Analisis"),
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
                        ->where('IDmedicion', $IDmedicion)
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
		
		$Resultado = array(
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
		// $Resultado['Diatomeas'] = $Diato;
		// $Resultado['Dinoflagelados'] = $Dino;
		// $Resultado['OEsp'] = $OEsp;
		// $Resultado['Fecha_Envio'] = $Fecha_Envio;
		// $Resultado['Fecha_Analisis'] = $Fecha_Analisis;
		// $Resultado['Fecha_Reporte'] = $Fecha_Reporte;
		// $Resultado['Tecnica'] = $Tecnica;
		// $Resultado['Observaciones'] = $Observaciones;
		// $Resultado['Archivo'] = $Archivo;
		// $Resultado['Firma'] = $Firma;
		// $Resultado['Mortalidad'] = $Mortalidad;
		// $Resultado['Nombre'] = $Nombre;
		// $Resultado['Codigo'] = $Codigo;
		// $Resultado['IDcentro'] = $IDcentro;
		// $Resultado['Barrio'] = $Barrio;
		// $Resultado['Especie'] = $Especie;
		// $Resultado['Siembra'] = $Siembra;
		// $Resultado['Cosecha'] = $Cosecha;
		// $Resultado['Estado_Alarma'] = $Estado_Alarma;
        // $Resultado['Modulo'] = $Modulo;
        // $Resultado['Jaula'] = $Jaula;
        // $Resultado['latitud'] = $latitud;
        // $Resultado['longitud'] = $longitud;
		
		return Response::json($Resultado);
    }

    /*===================================================================================================================*/

    public function loadPAmbientalesReporte(Request $request)//falta ruta
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        
		$error = 0;
		
		$IDmedicion = $request->input('IDmedicion');
		
		$PAmb = PAmbientales::where('pambientales.Grupo','Columna de Agua')
								->join('medicion_pambientales','medicion_pambientales.IDpambientales','=','pambientales.IDpambientales')
								->where('medicion_pambientales.IDmedicion',$IDmedicion)
                                ->where('pambientales.IDempresa', $miuser->IDempresa)
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
		$PAmbo = PAmbientales::where('pambientales.Grupo','NOT LIKE','%Columna de Agua%')
								->join('medicion_pambientales','medicion_pambientales.IDpambientales','=','pambientales.IDpambientales')
								->where('medicion_pambientales.IDmedicion',$IDmedicion)
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
								
		$Resultado = array();
		$Resultado['PAmbientales'] = $PAmb;
		$Resultado['PAmbientalesotros'] = $PAmbo;
		return Response::json($Resultado);
							
	}


    /*===================================================================================================================*/

    public function loadFanEditReporte(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        //     $error = 0;
        // $user_id = $_POST['user_id'];
        // $IDmedicion = $_POST['IDmedicion'];
        $user_id = $miuser->id;
        $IDempresa = $miuser->IDempresa;
        $IDmedicion = $request->input('IDmedicion');


         //Diatomeas
        // $consulta= DB::select("SELECT gtr_especie.Nombre,gtr_especie.Nivel_Critico,
        //                         CASE
        //                          WHEN gtr_especie.Fiscaliza = '1'
        //                             THEN 'Si'
        //                             ELSE '-'
        //                             END as Fiscaliza,
        //                             gtr_especie.Imagen,
        //                             gtr_especie.IDespecie,
        //                             gtr_medicion_fan.IDmedicionfan,
        //                             gtr_medicion_fan.Medicion_1,
        //                             gtr_medicion_fan.Medicion_2,
        //                             gtr_medicion_fan.Medicion_3,
        //                             gtr_medicion_fan.Medicion_4,
        //                             gtr_medicion_fan.Medicion_5,
        //                             gtr_medicion_fan.Medicion_6,
        //                             gtr_medicion_fan.Medicion_7 
        //                         FROM gtr_especie  LEFT JOIN gtr_medicion_fan  
        //ON gtr_medicion_fan.IDespecie = gtr_especie.IDespecie  AND gtr_medicion_fan.IDmedicion = '$IDmedicion' 
        //          WHERE gtr_especie.Grupo = 'Diatomeas' AND gtr_especie.Estado = 1 
        //          AND gtr_especie.IDempresa = (SELECT IDempresa FROM gtr_users WHERE user_id = '$user_id') ORDER BY gtr_especie.Nombre ASC");
        $Diato = Especie::leftJoin('medicion_fan', function($query) use ($IDmedicion){
                                                        $query->on('medicion_fan.IDespecie', '=','especie.IDespecie' )
                                                                ->where('medicion_fan.IDmedicion','=',  $IDmedicion);
                                                    })                                                
                                ->where([   
                                            ['especie.IDempresa', $IDempresa],
                                            ['especie.Estado', 1],
                                            ['especie.Grupo',  'Diatomeas']                                        
                                        ])
                                ->select('especie.Nombre',
                                            'especie.Nivel_Critico',
                                            DB::raw("CASE WHEN gtr_especie.Fiscaliza = '1' then 'Si' ELSE '-' END as Fiscaliza "),
                                            'especie.Imagen',
                                            'especie.IDespecie',
                                            'medicion_fan.IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7'
                                            )                               
                                ->orderBy('especie.Nombre', 'ASC')
                                ->get();                    
               
                    // $Diato = array();
                   
                    // foreach($Diato as $row){
                    //     $Diato[]= $row;
                    // }   

        //         /*---------------------------------------------------------------------------------------------------------------------*/

  
        $Dino = Especie::leftJoin('medicion_fan', function($query) use ($IDmedicion){
                                                        $query->on('medicion_fan.IDespecie', '=','especie.IDespecie' )
                                                                ->where('medicion_fan.IDmedicion','=',  $IDmedicion);
                                                    }) 
                            ->select('especie.Nombre',
                                        'especie.Nivel_Critico',
                                        DB::raw("CASE WHEN gtr_especie.Fiscaliza = '1' then 'Si' ELSE '-' END as Fiscaliza "),
                                        'especie.Imagen',
                                        'especie.IDespecie',
                                        'medicion_fan.IDmedicionfan',
                                        'medicion_fan.Medicion_1',
                                        'medicion_fan.Medicion_2',
                                        'medicion_fan.Medicion_3',
                                        'medicion_fan.Medicion_4',
                                        'medicion_fan.Medicion_5',
                                        'medicion_fan.Medicion_6',
                                        'medicion_fan.Medicion_7'
                                        )
                            ->where([
                                ['IDempresa', $IDempresa],
                                ['especie.Estado', 1],
                                ['especie.Grupo',  'Dinoflagelados']
                            ])
                            ->orderBy('especie.Nombre', 'ASC')
                            ->get();
                            
        // $Dino = array();
        // foreach($Dino as $row )
        // {
        // 	$Dino[]  = $row;

        // }
       

        //     /*---------------------------------------------------------------------------------------------------------------------*/

        // //Otras Especies
        
        $OEsp = Especie::leftJoin('medicion_fan', function($query) use ($IDmedicion){
                                                        $query->on('medicion_fan.IDespecie', '=','especie.IDespecie' )
                                                                ->where('medicion_fan.IDmedicion','=',  $IDmedicion);
                                                    }) 
                            ->select('especie.Nombre',
                                        'especie.Nivel_Critico',
                                        DB::raw("CASE WHEN gtr_especie.Fiscaliza = '1' then 'Si' ELSE '-' END as Fiscaliza "),
                                        'especie.Imagen',
                                        'especie.IDespecie',
                                        'medicion_fan.IDmedicionfan',
                                        'medicion_fan.Medicion_1',
                                        'medicion_fan.Medicion_2',
                                        'medicion_fan.Medicion_3',
                                        'medicion_fan.Medicion_4',
                                        'medicion_fan.Medicion_5',
                                        'medicion_fan.Medicion_6',
                                        'medicion_fan.Medicion_7'
                                        )
                            ->where([
                                ['IDempresa', $IDempresa],
                                ['especie.Estado', 1],
                                ['especie.Grupo',  'Otras Especies']
                            ])
                            ->orderBy('especie.Nombre', 'ASC')
                            ->get();
        
      

        // $OEsp = array();
        // foreach($OEsp as $row )
        // {
        // 	$OEsp[]  = $row;
        //}
        

        // /*---------------------------------------------------------------------------------------------------------------------*/

        // //Convertir coodernada
        function DDtoDMS3($dec)
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

        // /*---------------------------------------------------------------------------------------------------------------------*/


        $medicion = Medicion::where('IDmedicion' , $IDmedicion)
                                ->select(
                                    DB::raw("DATE_FORMAT(Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio"),
                                    DB::raw("DATE_FORMAT(Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte"),
                                    DB::raw("DATE_FORMAT(Fecha_Analisis, '%d-%m-%Y %H:%i:%s') as Fecha_Analisis"),
                                    'Tecnica',
                                    'Observaciones',
                                    'Firma',
                                    'IDcentro',
                                    'TopLeft',
                                    'Modulo',
                                    'Jaula')
                                ->get();
        // // $Datos_Medicion = array();
        // // while($row = mysqli_fetch_assoc($consulta))
        // // {
        // // 	$Fecha_Envio  = $row['Fecha_Envio'];
        // // 	$Fecha_Reporte  = $row['Fecha_Reporte'];
        // // 	$Fecha_Analisis  = $row['Fecha_Analisis'];
        // // 	$Tecnica  = $row['Tecnica'];
        // // 	$Observaciones  = $row['Observaciones'];
        // // 	$Firma  = $row['Firma'];
        // // 	$IDcentro  = $row['IDcentro'];
        // // 	$Modulo  = $row['Modulo'];
        // // 	$Jaula  = $row['Jaula'];
        // // 	if ($row['TopLeft']) {
        // // 		$topleft = explode(',',$row['TopLeft']);
        // // 		$latitud = DDtoDMS($topleft[0]);
        // // 		$longitud = DDtoDMS($topleft[1]);
        // // 	}else{
        // // 		$latitud = '';
        // // 		$longitud = '';
        // // 	}
        // // }
            foreach ($medicion as $row){
                    $Fecha_Envio  = $row->Fecha_Envio;
                    $Fecha_Reporte  = $row->Fecha_Reporte;
                    $Fecha_Analisis  = $row->Fecha_Analisis;
                    $Tecnica  = $row->Tecnica;
                    $Observaciones  = $row->Observaciones;
                    $Firma  = $row->Firma;
                    $IDcentro  = $row->IDcentro;
                    $Modulo  = $row->Modulo;
                    $Jaula  = $row->Jaula;
                    $TopLeft = $row->TopLeft;
                    if ($TopLeft) {
                        $topleft = explode(',',$row->TopLeft);
                        $latitud = DDtoDMS3($topleft[0]);
                        $longitud = DDtoDMS3($topleft[1]);
                    }else{
                        $latitud = '';
                        $longitud = '';
                    }
            }
            
                /*--------------se debe agregar, esta en el laravel fan 5 pero no en el FAN---------------------------------------------/
                
                $archivos = Documento::where('IDempresa', $miuser->IDempresa)
								->where('IDmedicion', $IDmedicion)
								->get();*/


        $Resultado = array(
            'Diatomeas' =>  $Diato,
        'Dinoflagelados' =>  $Dino,
        'OEsp' =>  $OEsp,
        'Fecha_Envio' =>  $Fecha_Envio,
        'Fecha_Reporte' =>  $Fecha_Reporte,
        'Fecha_Analisis' =>  $Fecha_Analisis,
        'Tecnica' =>  $Tecnica,
        'Observaciones' =>  $Observaciones,
        'Firma' =>  $Firma,
        'IDcentro' =>  $IDcentro,
        'IDmedicion' =>  $IDmedicion,
        'Modulo' =>  $Modulo,
        'Jaula' =>  $Jaula,
        'latitud' =>  $latitud,
        'longitud' =>  $longitud,
        );
        // $Resultado['Diatomeas'] = $Diato;
        // $Resultado['Dinoflagelados'] = $Dino;
        // $Resultado['OEsp'] = $OEsp;
        // $Resultado['Fecha_Envio'] = $Fecha_Envio;
        // $Resultado['Fecha_Reporte'] = $Fecha_Reporte;
        // $Resultado['Fecha_Analisis'] = $Fecha_Analisis;
        // $Resultado['Tecnica'] = $Tecnica;
        // $Resultado['Observaciones'] = $Observaciones;
        // $Resultado['Firma'] = $Firma;
        // $Resultado['IDcentro'] = $IDcentro;
        // $Resultado['IDmedicion'] = $IDmedicion;
        // $Resultado['Modulo'] = $Modulo;
        // $Resultado['Jaula'] = $Jaula;
        // $Resultado['latitud'] = $latitud;
        // $Resultado['longitud'] = $longitud;
        // // echo json_encode($Resultado);
        //$Resultado = array();
		
        //return response([$diato,$consulta2, $consulta3, $consulta4],200);
     
        return Response::json($Resultado);

    }

    /*===================================================================================================================*/

    public function loadPAmbientalesEditReporte(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        if($miuser->user_role_fan == 1 || $miuser->user_role_fan == 2){
			
		}else {
			return 'Acceso Restringido';
		}
		
		
		$IDmedicion = $request->input('IDmedicion');
		//Diatomeas	
		$PAmb = PAmbientales::leftJoin('medicion_pambientales',function($query) use ($IDmedicion){
                                                                    $query->on('medicion_pambientales.IDpambientales', '=','pambientales.IDpambientales' )
                                                                            ->where('medicion_pambientales.IDmedicion','=',  $IDmedicion);
                                                                }) 
							->where('pambientales.Grupo','Columna de Agua')
							->where('pambientales.Estado',1)
							->where('pambientales.IDempresa',$miuser->IDempresa)
							->select(
								'pambientales.Nombre',
                                'pambientales.Grupo',
                                'pambientales.IDpambientales',
                                'medicion_pambientales.IDmedicionpambientales',
								'medicion_pambientales.Medicion_1',
                                'medicion_pambientales.Medicion_2',
                                'medicion_pambientales.Medicion_3',
                                'medicion_pambientales.Medicion_4',
                                'medicion_pambientales.Medicion_5'
                                ,'medicion_pambientales.Medicion_6'
                                ,'medicion_pambientales.Medicion_7'
							)
							->orderByRaw("CASE WHEN gtr_pambientales.Nombre = 'Observaciones' THEN 1 ELSE 0 END")
							->orderBy('pambientales.Grupo','ASC')
							->orderBy('pambientales.Nombre','ASC')
							->get();
		
		//Otros
		$PAmbo  = PAmbientales::join('medicion_pambientales',function($query) use ($IDmedicion){
                                                                    $query->on('medicion_pambientales.IDpambientales', '=','pambientales.IDpambientales' )
                                                                            ->where('medicion_pambientales.IDmedicion','=',  $IDmedicion);
                                                                })
							->where('pambientales.Grupo','NOT LIKE','%Columna de Agua%')
							->where('pambientales.Estado',1)
							->where('pambientales.IDempresa',$miuser->IDempresa)
							->select(
								'pambientales.Nombre',
                                'pambientales.Grupo',
                                'pambientales.IDpambientales',
                                'medicion_pambientales.IDmedicionpambientales',
								'medicion_pambientales.Medicion_1',
                                'medicion_pambientales.Medicion_2',
                                'medicion_pambientales.Medicion_3',
                                'medicion_pambientales.Medicion_4','medicion_pambientales.Medicion_5',
                                'medicion_pambientales.Medicion_6',
                                'medicion_pambientales.Medicion_7'
							)
							->orderByRaw("CASE WHEN gtr_pambientales.Nombre = 'Observaciones' THEN 1 ELSE 0 END")
							->get();
		$Resultado = array();
		$Resultado['PAmbientales'] = $PAmb;
		$Resultado['PAmbientalesotros'] = $PAmbo;
        return Response::json($Resultado);
		//return \Response::json($Resultado);
    }

    /*===================================================================================================================*/

    public function saveEditReporte()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
            $error = 0;

            $IDmedicion = $_POST['IDmedicion'];
            $Nuevas_Observaciones = $_POST['Nuevas_Observaciones'];
            $Nueva_Fecha_Reporte = $_POST['Nueva_Fecha_Reporte'];
            $Nueva_Fecha_Analisis = $_POST['Nueva_Fecha_Analisis'];
            $Estado = $_POST['Estado'];
            $IDcentro = $_POST['IDcentro'];
            if(isset($_POST['Edit_Fan'])){
            $Edit_Fan = $_POST['Edit_Fan'];}else{$Edit_Fan = "";}
            if(isset($_POST['Edit_Pamb'])){
            $Edit_Pamb = $_POST['Edit_Pamb'];}else{$Edit_Pamb = "";}
            if(isset($_POST['Vacio'])){
            $Vacio = $_POST['Vacio'];}else{$Vacio = "";}
            $Mortalidad = $_POST['Mortalidad'];
            $Edit_Pambo = $_POST['Edit_Pambo'];
            $user_id = $_POST['user_id'];

            $moduloreporte = $_POST['moduloreporte'];
            $jaulareporte = $_POST['jaulareporte'];
            $latitud_grados = $_POST['latitud_grados'];
            $latitud_min = $_POST['latitud_min'];
            $latitud_seg = $_POST['latitud_seg'];
            $longitud_grados = $_POST['longitud_grados'];
            $longitud_min = $_POST['longitud_min'];
            $longitud_seg = $_POST['longitud_seg'];


        //Comprueba que la coordenada ingresada no sea mayor a 5km de la coordenada del centro (osino se debe considerar como otro "centro")
            function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
            }

            //Covierte coordenada a Decimal
                function DMStoDD($deg,$min,$sec)
            {
                    // Converting DMS ( Degrees / minutes / seconds ) to decimal format
                    return round($deg+((($min*60)+($sec))/3600),5);
            }


            $topleft = '';
            if ($latitud_grados != '' && $latitud_min != '' && $latitud_seg != '' && $longitud_grados != '' && $longitud_min != '' && $longitud_seg != '') {
                $topleft = -1 * DMStoDD(abs($latitud_grados),$latitud_min,$latitud_seg).','. -1 * DMStoDD( abs($longitud_grados),$longitud_min,$longitud_seg);
            }

            if ($topleft != '') {
                //Busca la coordenada del centro para poner por defecto en el registro
                $consulta = Centro::where('IDcentro', $IDcentro)
                                    ->select('topleft')
                                    ->get();
                // mysqli_query($con,"SELECT topleft FROM centro WHERE IDcentro = '$IDcentro'")
                // or die ($error ="Error description: " . mysqli_error($consulta));
                //$row = mysqli_fetch_assoc($consulta);
                $topleft_centro = '';
                foreach($consulta as $row){
                    $topleft_centro = $row->topleft;
                }

                if ($topleft_centro != '') {
                    $lat_long = explode(',',$topleft);
                    $lat_long_centro = explode(',',$topleft_centro);
                    if (haversineGreatCircleDistance($lat_long[0], $lat_long[1], $lat_long_centro[0], $lat_long_centro[1]) > 1000) {
                        echo json_encode(array('Error' => 1,'msg' => 'La coordenada ingresada supera en 1[km] la ubicación del centro.'));
                        die();
                    }
                }

            }



            date_default_timezone_set('america/santiago');
            $Fecha_Medicion = date('Y-m-d H:i:s', strtotime($Nueva_Fecha_Reporte));
            $fecha = date('Y-m-d H:i:s');

            $Fecha_Analisis = date('Y-m-d H:i:s', strtotime($Nueva_Fecha_Analisis));
            
            $insertados = array();
            $IDmedvalue = "";
            $value = "";
            $row = "";
            $IDespvalue = "";
            $updatefan = 0;
            if($Edit_Fan){
                $updatefan = 1;
                foreach($Edit_Fan as $i => $editfanvalue){
                    $IDmedvalue = $editfanvalue["IDmedicionfan"];
                    $value = $editfanvalue["Valor"];
                    $row = $editfanvalue["Medicion"];
                    $IDespvalue = $editfanvalue["IDespecie"];

                    if($IDmedvalue){

                    $consulta = MedicionFan::where('IDmedicionfan', $IDmedvalue)
                                                ->update([
                                                    $row => $value,
                                                ]);
                    // mysqli_query($con,"UPDATE medicion_fan SET $row = '$value' 
                    // WHERE IDmedicionfan = '$IDmedvalue' ") 
                    // or die ($error ="Error description: " . mysqli_error($con));

                    }else if(!in_array($IDespvalue, $insertados)){

                        $insertados[] = $IDespvalue;
                        $especie = Especie::select('Fiscaliza',
                                                    'Nociva',
                                                    'Nivel_Critico',
                                                    'Alarma_Rojo',
                                                    'Alarma_Amarillo')
                                            ->where('IDespecie', $IDespvalue)
                                            ->first();
                        $consulta = MedicionFan::insert([
                                                    'IDmedicion'=> $IDmedicion,
                                                    'IDespecie'=> $IDespvalue,
                                                    $row=> $value,
                                                    'Fiscaliza'=> $especie->Fiscaliza,
                                                    'Nociva'=> $especie->Nociva,
                                                    'Nivel_Critico'=> $especie->Nivel_Critico,
                                                    'Alarma_Rojo'=> $especie->Alarma_Rojo,
                                                    'Alarma_Amarillo'=> $especie->Alarma_Amarillo
                        ]);
                        // mysqli_query($con,"INSERT INTO medicion_fan(IDmedicion, 
                        //                                 IDespecie ,
                        //                                 $row, 
                        //                                 Fiscaliza,
                        //                                 Nociva,Nivel_Critico,
                        //                                 Alarma_Rojo,
                        //                                 Alarma_Amarillo) 
                        //                         VALUES ('$IDmedicion', 
                        //                         '$IDespvalue', 
                        //                         '$value',
                        //                         (SELECT Fiscaliza FROM especie WHERE IDespecie = '$IDespvalue'),
                        //                         (SELECT Nociva FROM especie WHERE IDespecie = '$IDespvalue'),
                        //                         (SELECT Nivel_Critico FROM especie WHERE IDespecie = '$IDespvalue'),
                        //                         (SELECT Alarma_Rojo FROM especie WHERE IDespecie = '$IDespvalue'),
                        //                         (SELECT Alarma_Amarillo FROM especie WHERE IDespecie = '$IDespvalue') )" )
                        // or die ( $error ="Error description: " . mysqli_error($con) );

                    }else{

                        $consulta = MedicionFan::where([['IDmedicion',$IDmedicion],['IDespecie', $IDespvalue]])
                                                    ->update([
                                                        $row => $value
                                                    ]);
                        // mysqli_query($con,"UPDATE medicion_fan SET $row = '$value' 
                        // WHERE IDmedicion = '$IDmedicion' AND IDespecie = '$IDespvalue'") 
                        // or die ($error ="Error description: " . mysqli_error($con));

                    }

                }

                //Eliminar campos vacios
                $consulta = MedicionFan::where([['Medicion_1', ''],
                                                ['Medicion_2', ''],
                                                ['Medicion_3', ''],
                                                ['Medicion_4', ''],
                                                ['Medicion_5', ''],
                                                ['Medicion_6', ''],
                                                ['Medicion_7', '']
                                            ])
                                            ->delete();
                // mysqli_query($con,"DELETE FROM medicion_fan 
                // WHERE Medicion_1 = '' AND Medicion_2 = '' 
                // AND Medicion_3 = '' 
                // AND Medicion_4 = '' 
                // AND Medicion_5 = '' 
                // AND Medicion_6 = '' 
                // AND Medicion_7 = ''" )
                // or die ( $error ="Error description: " . mysqli_error($con) );

            }

            $insertados = array();
            $IDmedvalue = "";
            $value = "";
            $row = "";
            $IDpambvalue = "";
            if($Edit_Pamb){
                foreach($Edit_Pamb as $i => $editpambvalue){
                    $IDmedvalue = $editpambvalue["IDmedicionpambientales"];
                    $value = $editpambvalue["Valor"];
                    $row = $editpambvalue["Medicion"];
                    $IDpambvalue = $editpambvalue["IDpambientales"];

                    if($IDmedvalue){

                    $consulta = MedicionPAmbientales::where('IDmedicionpambientales', $IDmedvalue)
                                                        ->update([
                                                            $row => $value
                                                        ]);
                    // mysqli_query($con,"UPDATE medicion_pambientales SET $row = '$value' 
                    // WHERE IDmedicionpambientales = '$IDmedvalue' ") 
                    // or die ($error ="Error description: " . mysqli_error($con));

                    }else if(!in_array($IDpambvalue, $insertados)){

                        $insertados[] = $IDpambvalue;
                        $consulta = MedicionPAmbientales::insert([
                                                            'IDmedicion' => $IDmedicion,
                                                            'IDpambientales' => $IDpambvalue,
                                                            $row => $value
                                                        ]);
                        // mysqli_query($con,"INSERT INTO medicion_pambientales(IDmedicion, IDpambientales ,$row) 
                        // VALUES ('$IDmedicion', '$IDpambvalue', '$value')" )or die ( $error ="Error description: " . mysqli_error($con) );

                    }else{

                        $consulta = MedicionPAmbientales::where([['IDmedicion', $IDmedicion],['IDpambientales', $IDpambvalue ]])
                                                            ->update([
                                                                $row = $value
                                                            ]);
                        // mysqli_query($con,"UPDATE medicion_pambientales SET $row = '$value' 
                        // WHERE IDmedicion = '$IDmedicion' AND IDpambientales = '$IDpambvalue'")
                        // or die ($error ="Error description: " . mysqli_error($con));

                    }

                }
            }



            //Parametros ambientales otros
            $insertados = array();
            $IDmedvalue = "";
            $value = "";
            $row = "";
            $IDpambvalue = "";
            if($Edit_Pambo){
                foreach($Edit_Pambo as $i => $editpambovalue){
                    $IDmedvalue = $editpambovalue["IDmedicionpambientales"];
                    $value = $editpambovalue["Valor"];
                    $row = "Medicion_1";
                    $IDpambvalue = $editpambovalue["IDpambientales"];

                    if($IDmedvalue){

                    $consulta = MedicionPAmbientales::where('IDmedicionpambientales', $IDmedvalue)
                                                        ->update([
                                                            $row => $value
                                                        ]);
                    // mysqli_query($con,"UPDATE medicion_pambientales SET $row = '$value' 
                    // WHERE IDmedicionpambientales = '$IDmedvalue' ") 
                    // or die ($error ="Error description: " . mysqli_error($con));

                    }else if(!in_array($IDpambvalue, $insertados)){

                        $insertados[] = $IDpambvalue;
                        $consulta = MedicionPAmbientales::insert([
                                                               'IDmedicion' => $IDmedicion,
                                                               'IDpambientales' => $IDpambvalue ,
                                                               $row =>  $value
                                                            ]);
                        // mysqli_query($con,"INSERT INTO medicion_pambientales(IDmedicion, IDpambientales ,$row) 
                        // VALUES ('$IDmedicion', '$IDpambvalue', '$value')" )
                        // or die ( $error ="Error description: " . mysqli_error($con) );

                    }else{

                        $consulta = MedicionPAmbientales::where([['IDmedicion', $IDmedicion],['IDpambientales', $IDpambvalue]])
                                                            ->update([
                                                                $row => $value
                                                            ]);
                        // mysqli_query($con,"UPDATE medicion_pambientales SET $row = '$value' 
                        // WHERE IDmedicion = '$IDmedicion' AND IDpambientales = '$IDpambvalue'") 
                        // or die ($error ="Error description: " . mysqli_error($con));

                    }

                }
            }
            /*//Save Parámetros Ambientales
            if($IDpambientalesotros != ""){
                foreach($IDpambientalesotros as $i => $IDpambovalue){
                    $consulta = mysqli_query($con,"UPDATE medicion_pambientales SET (IDmedicion,IDpambientales, Medicion_1,Medicion_2,Medicion_3,Medicion_4) VALUES" .$string2)
            or die ( $error ="Error description: " . mysqli_error($con) );

                    if($IDpambovalue){
                    $string = $string."('$IDmedicion','$IDpambovalue','$Medicion0_pambientalesotros[$i]','','',''),";
                    }
                }
            }*/


            if ($topleft != '') {
                // $topleft = -1 * DMStoDD(abs($latitud_grados),$latitud_min,$latitud_seg).','. -1 * DMStoDD( abs($longitud_grados),$longitud_min,$longitud_seg);
                $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['TopLeft'=> $topleft]);
                //mysqli_query($con,"UPDATE medicion SET TopLeft = '$topleft' WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
            }else{
                $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['TopLeft'=> NULL]);
                //mysqli_query($con,"UPDATE medicion SET TopLeft = NULL WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
            }

            if ($moduloreporte != '') {
                $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['Modulo'=> $moduloreporte]);
                //mysqli_query($con,"UPDATE medicion SET Modulo = '$moduloreporte' WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
            }else{
                $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['Modulo'=> NULL]);
                //mysqli_query($con,"UPDATE medicion SET Modulo = NULL WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
            }
            if ($jaulareporte != '') {
                $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['Jaula'=> $jaulareporte]);
                //mysqli_query($con,"UPDATE medicion SET Jaula = '$jaulareporte' WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
            }else{
                $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['Jaula'=>NULL]);
                //mysqli_query($con,"UPDATE medicion SET Jaula = NULL WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
            }


            //Actualiza medicion
            function validateDate($date, $format = 'Y-m-d H:i:s')
                {
                    $aux = new \DateTime();
                    $d = $aux->createFromFormat($format, $date);
                    return $d && $d->format($format) == $date;
                }
            $update_fecha_analisis = $Fecha_Analisis;
            // if (validateDate($Fecha_Analisis)) {
            //     $update_fecha_analisis = ", Fecha_Analisis = '".$Fecha_Analisis."'";
            // }
           
            if($Estado == 1){ //incluye fecha modificacion si el registro no es borrador
                $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                        ->update([
                                            'Fecha_Reporte' => $update_fecha_analisis,
                                            'Fecha_Modificacion' => $fecha,
                                            'Observaciones' => $Nuevas_Observaciones,
                                            'Estado' => $Estado,
                                            'Mortalidad' => $Mortalidad
                                        ]);
                // mysqli_query($con,"UPDATE medicion SET                  Fecha_Reporte = '$Fecha_Medicion' ".$update_fecha_analisis." , 
                //                                                         Fecha_Modificacion = '$fecha',  
                //                                                         Observaciones = '$Nuevas_Observaciones', 
                //                                                         Estado = '$Estado', 
                //                                                         Mortalidad = '$Mortalidad' 
                //                                                         WHERE IDmedicion = '$IDmedicion' ") 
                // or die ($error ="Error description1: " . mysqli_error($con));
            }else{
                $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                            ->update([
                                                'Fecha_Reporte'=> $Fecha_Medicion . $update_fecha_analisis,
                                                'Observaciones'=> $Nuevas_Observaciones,
                                                'Estado'=> $Estado,
                                                'Mortalidad'=> $Mortalidad
                                            ]);
                // mysqli_query($con,"UPDATE medicion SET Fecha_Reporte = '$Fecha_Medicion' ".$update_fecha_analisis." , 
                //                                         Observaciones = '$Nuevas_Observaciones', 
                //                                         Estado = '$Estado', 
                //                                         Mortalidad = '$Mortalidad' 
                //                                         WHERE IDmedicion = '$IDmedicion' ") 
                // or die ($error ="Error description2: " . mysqli_error($con));
            }

                    //Fecha_Envio = '$fecha',



            //if($updatefan == 1){
                //Alarma para todas las especies, (no solo las que fiscaliza serna)

                //$consulta = mysqli_query($con,"SELECT mf.IDmedicionfan FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) WHERE (mf.Medicion_1 >= e.Alarma_Rojo OR mf.Medicion_2 >= e.Alarma_Rojo OR mf.Medicion_3 >= e.Alarma_Rojo OR mf.Medicion_4 >= e.Alarma_Rojo) AND e.Alarma_Rojo > 0 ")or die ($error ="Error description: " . mysqli_error($con));
        //		$alarma = "";
        //		while($row = mysqli_fetch_assoc($consulta))
        //		{
        //			$alarma = "Nivel Crítico";
        //		}
        //
        //		if($alarma == ""){
        //
        //			$consulta = mysqli_query($con,"SELECT mf.IDmedicionfan FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) WHERE (mf.Medicion_1 >= e.Alarma_Amarillo OR mf.Medicion_2 >= e.Alarma_Amarillo OR mf.Medicion_3 >= e.Alarma_Amarillo OR mf.Medicion_4 >= e.Alarma_Amarillo) AND e.Alarma_Amarillo > 0 ")or die ($error ="Error description: " . mysqli_error($con));
        //
        //
        //			while($row = mysqli_fetch_assoc($consulta))
        //			{
        //				$alarma = "Precaución";
        //			}
        //		}
        //
        //		if($alarma == ""){
        //
        //			$consulta = mysqli_query($con,"SELECT IDmedicionfan FROM medicion_fan WHERE IDmedicion = '$IDmedicion' AND (Medicion_1 > 0 OR Medicion_2 > 0 OR Medicion_3 > 0 OR Medicion_4 > 0) ")or die ($error ="Error description: " . mysqli_error($con));
        //
        //
        //			while($row = mysqli_fetch_assoc($consulta))
        //			{
        //				$alarma = "Presencia Microalgas";
        //			}
        //		}

                //Nombre e ID Centro
                $consulta = Centro::where('IDcentro', $IDcentro)
                                    ->select(
                                        'Nombre',
                                        'IDcentro',
                                        'IDempresa'
                                    )
                                    ->get();
                // mysqli_query($con,"SELECT Nombre,IDcentro,IDempresa FROM centro WHERE IDcentro = '$IDcentro' ")
                // or die ( $error ="Error description: " . mysqli_error($con) );

                foreach ($consulta as $row){
                    $Centro = $row->Nombre;
                    $IDcentro = $row->IDcentro;
                    $IDempresa = $row->IDempresa;
                }
                


                $consulta = MedicionFan::join('especie', function($query) use ($IDmedicion){
                                                $query->on('medicion_fan.IDespecie', '=', 'especie.IDespecie')
                                                        ->where('medicion_fan.IDmedicion', '=', $IDmedicion);
                                                })
                                            ->select(
                                                'medicion_fan.IDmedicionfan',
                                                'medicion_fan.Medicion_1',
                                                'medicion_fan.Medicion_2',
                                                'medicion_fan.Medicion_3',
                                                'medicion_fan.Medicion_4',
                                                'medicion_fan.Medicion_5',
                                                'medicion_fan.Medicion_6',
                                                'medicion_fan.Medicion_7',
                                                'especie.Alarma_Rojo',
                                                'especie.Alarma_Amarillo',
                                                'especie.Nombre', 
                                                'especie.Nivel_Critico'
                                            )
                                            ->where(function($query){
                                                    $query->where('medicion_fan.Medicion_1', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                            ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                            ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                            ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                            ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                            ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                            ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('gtr_especie.Alarma_Rojo'));
                                            })
                                            ->where('especie.Alarma_Rojo', '>', 0)
                                            ->get();
                // mysqli_query($con,"SELECT mf.IDmedicionfan,
                //                         mf.Medicion_1,
                //                         mf.Medicion_2,
                //                         mf.Medicion_3,
                //                         mf.Medicion_4,
                //                         mf.Medicion_5,
                //                         mf.Medicion_6,
                //                         mf.Medicion_7,
                //                         e.Alarma_Rojo,
                //                         e.Alarma_Amarillo,
                //                         e.Nombre, 
                //                         e.Nivel_Critico 
                //                         FROM ( medicion_fan mf INNER JOIN especie e 
                //                         ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                //                         WHERE (mf.Medicion_1 >= e.Alarma_Rojo 
                //                         OR mf.Medicion_2 >= e.Alarma_Rojo 
                //                         OR mf.Medicion_3 >= e.Alarma_Rojo 
                //                         OR mf.Medicion_4 >= e.Alarma_Rojo 
                //                         OR mf.Medicion_5 >= e.Alarma_Rojo 
                //                         OR mf.Medicion_6 >= e.Alarma_Rojo 
                //                         OR mf.Medicion_7 >= e.Alarma_Rojo) 
                //                         AND e.Alarma_Rojo > 0 ")or die ($error ="Error description: " . mysqli_error($con));
               
                $alarma = "";
                $Comentario = array();
                $Comentario_precaucion = array();
                $Concentracion = array();
                $Nocivo = array();
                $Nocivo_P = array();
                $Concentracion_precaucion = array();
                foreach($consulta as $row)
                {
                    $alarma = "Nivel Crítico";
                    $Comentario[] = $row->Nombre;
                    $Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                    $Nocivo[] = $row->Nivel_Critico;
        //			$datos_rojo['Alarma_Rojo'][] = $row['Alarma_Rojo'];
        //			$datos_rojo['Alarma_Amarillo'][] = $row['Alarma_Amarillo'];
        //			$datos_rojo['Medicion_1'][] = $row['Medicion_1'];
        //			$datos_rojo['Medicion_2'][] = $row['Medicion_2'];
        //			$datos_rojo['Medicion_3'][] = $row['Medicion_3'];
        //			$datos_rojo['Medicion_4'][] = $row['Medicion_4'];
                }
                $aux_prec = "";
                if($alarma == ""){

                    $consulta = MedicionFan::join('especie', function($query) use ($IDmedicion){
                                                                $query->on('medicion_fan.IDespecie', '=', 'especie.IDespecie')
                                                                        ->where('medicion_fan.IDmedicion', '=', $IDmedicion);
                                                                })
                                                ->select(
                                                    'medicion_fan.IDmedicionfan',
                                                    'medicion_fan.Medicion_1',
                                                    'medicion_fan.Medicion_2',
                                                    'medicion_fan.Medicion_3',
                                                    'medicion_fan.Medicion_4',
                                                    'medicion_fan.Medicion_5',
                                                    'medicion_fan.Medicion_6',
                                                    'medicion_fan.Medicion_7',
                                                    'especie.Nombre', 
                                                    'especie.Nivel_Critico'
                                                )
                                                ->where(function($query){
                                                        $query->where('medicion_fan.Medicion_1', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('gtr_especie.Alarma_Amarillo'));
                                                })
                                                ->where('especie.Alarma_Amarillo', '>', 0)
                                                ->get();
                    // mysqli_query($con,"SELECT mf.IDmedicionfan,
                    //                             mf.Medicion_1,
                    //                             mf.Medicion_2,
                    //                             mf.Medicion_3,
                    //                             mf.Medicion_4,
                    //                             mf.Medicion_5,
                    //                             mf.Medicion_6,
                    //                             mf.Medicion_7, 
                    //                             e.Nombre, 
                    //                             e.Nivel_Critico 
                    //                 FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    //                 WHERE (mf.Medicion_1 >= e.Alarma_Amarillo 
                    //                 OR mf.Medicion_2 >= e.Alarma_Amarillo 
                    //                 OR mf.Medicion_3 >= e.Alarma_Amarillo 
                    //                 OR mf.Medicion_4 >= e.Alarma_Amarillo 
                    //                 OR mf.Medicion_5 >= e.Alarma_Amarillo 
                    //                 OR mf.Medicion_6 >= e.Alarma_Amarillo 
                    //                 OR mf.Medicion_7 >= e.Alarma_Amarillo) 
                    //                 AND e.Alarma_Amarillo > 0 ")
                    //                 or die ($error ="Error description: " . mysqli_error($con));


                    foreach($consulta as $row )
                    {
                        $alarma = "Precaución";
                        $Comentario[] = $row->Nombre;
                        $Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                        $Nocivo[] = $row->Nivel_Critico;
                    }
                }else{
                    $consulta = MedicionFan::join('especie', function($query) use ($IDmedicion){
                                                                $query->on('medicion_fan.IDespecie', '=', 'especie.IDespecie')
                                                                        ->where('medicion_fan.IDmedicion', '=', $IDmedicion);
                                                                })
                                                ->select(
                                                    'medicion_fan.IDmedicionfan',
                                                    'medicion_fan.Medicion_1',
                                                    'medicion_fan.Medicion_2',
                                                    'medicion_fan.Medicion_3',
                                                    'medicion_fan.Medicion_4',
                                                    'medicion_fan.Medicion_5',
                                                    'medicion_fan.Medicion_6',
                                                    'medicion_fan.Medicion_7',
                                                    'especie.Nombre', 
                                                    'especie.Nivel_Critico'
                                                )
                                                ->where(function($query){
                                                        $query->where('medicion_fan.Medicion_1', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('gtr_especie.Alarma_Amarillo'))
                                                                ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('gtr_especie.Alarma_Amarillo'));
                                                })
                                                ->where(function($query){
                                                        $query->where('medicion_fan.Medicion_1', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                                ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                                ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                                ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                                ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                                ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('gtr_especie.Alarma_Rojo'))
                                                                ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('gtr_especie.Alarma_Rojo'));
                                            })
                                                ->where('especie.Alarma_Amarillo', '>', 0)
                                                ->get();
                    // mysqli_query($con,"SELECT mf.IDmedicionfan,
                    //                             mf.Medicion_1,
                    //                             mf.Medicion_2,
                    //                             mf.Medicion_3,
                    //                             mf.Medicion_4,
                    //                             mf.Medicion_5,
                    //                             mf.Medicion_6,
                    //                             mf.Medicion_7, 
                    //                             e.Nombre, 
                    //                             e.Nivel_Critico 
                    //     FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    //     WHERE (mf.Medicion_1 >= e.Alarma_Amarillo 
                    //     OR mf.Medicion_2 >= e.Alarma_Amarillo 
                    //     OR mf.Medicion_3 >= e.Alarma_Amarillo 
                    //     OR mf.Medicion_4 >= e.Alarma_Amarillo 
                    //     OR mf.Medicion_5 >= e.Alarma_Amarillo 
                    //     OR mf.Medicion_6 >= e.Alarma_Amarillo 
                    //     OR mf.Medicion_7 >= e.Alarma_Amarillo) 
                    //     AND (mf.Medicion_1 < e.Alarma_Rojo 
                    //     OR mf.Medicion_2 < e.Alarma_Rojo 
                    //     OR mf.Medicion_3 < e.Alarma_Rojo 
                    //     OR mf.Medicion_4 < e.Alarma_Rojo 
                    //     OR mf.Medicion_5 < e.Alarma_Rojo 
                    //     OR mf.Medicion_6 < e.Alarma_Rojo 
                    //     OR mf.Medicion_7 < e.Alarma_Rojo) 
                    //     AND e.Alarma_Amarillo > 0 ")
                    //     or die ($error ="Error description: " . mysqli_error($con));


                    foreach($consulta as $row)
                    {
                        if(!in_array($row->Nombre, $Comentario)){
                            $Comentario_precaucion[] = $row->Nombre;
                            $Concentracion_precaucion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                            $Nocivo_P[] = $row->Nivel_Critico;
                        }
                    }
                    $aux_prec = join(', ', $Comentario_precaucion);

                }

                if($alarma == ""){

                    $consulta = MedicionFan::select('IDmedicionfan')
                                                ->where('IDmedicion', $IDmedicion)
                                                ->where(function($query){
                                                    $query->where('Medicion_1', '>', 0)
                                                            ->orWhere('Medicion_2', '>', 0)
                                                            ->orWhere('Medicion_3', '>', 0)
                                                            ->orWhere('Medicion_4', '>', 0)
                                                            ->orWhere('Medicion_5', '>', 0)
                                                            ->orWhere('Medicion_6', '>', 0)
                                                            ->orWhere('Medicion_7', '>', 0);
                                                })
                                                ->get();
                    // mysqli_query($con,"SELECT IDmedicionfan FROM medicion_fan 
                    // WHERE IDmedicion = '$IDmedicion' 
                    // AND (Medicion_1 > 0 OR Medicion_2 > 0 OR Medicion_3 > 0 OR Medicion_4 > 0 OR Medicion_5 > 0 OR Medicion_6 > 0 OR Medicion_7 > 0) ")
                    // or die ($error ="Error description: " . mysqli_error($con));


                    if($consulta)
                    {
                        $alarma = "Presencia Microalgas";
                    }
                }


                if($alarma == ""){$alarma = "Ausencia Microalgas";}

                $aux = join(', ', $Comentario);


                //Select Conducata peces
                $IDpambiental = Pambientales::where([['Nombre', 'Mortalidad por FAN'],['IDempresa', $miuser->IDempresa]])
                                                ->select('IDpambientales')
                                                ->first();
                                                
                $consulta = MedicionPAmbientales::select('Medicion_1')
                                                    ->where('IDmedicion', $IDmedicion)
                                                    ->where('IDpambientales', $IDpambiental)                                                    
                                                    ->get();
                                                   
                // mysqli_query($con,"SELECT Medicion_1 FROM medicion_pambientales 
                // WHERE IDmedicion = '$IDmedicion' 
                // AND IDpambientales = (SELECT IDpambientales FROM pambientales WHERE Nombre = 'Mortalidad por FAN' 
                // AND IDempresa = (SELECT IDempresa FROM as_users WHERE user_id = '$user_id'))")
                // or die ($error ="Error description: " . mysqli_error($con));
                // $row = mysqli_fetch_assoc($consulta);
                foreach($consulta as $row){
                $Mortalidad = $row->Medicion_1;
                }
               
                $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                        ->update([
                                            'Estado_Alarma' => $alarma,
                                            'Comentario' => $aux,
                                            'Mortalidad' => $Mortalidad
                                        ]);
                // mysqli_query($con,"UPDATE medicion SET Estado_Alarma = '$alarma', Comentario = '$aux', Mortalidad = '$Mortalidad' 
                // WHERE IDmedicion = '$IDmedicion' ")
                // or die ( $error ="Error description: " . mysqli_error($con) );


                    //$consulta = mysqli_query($con,"UPDATE medicion SET Estado_Alarma = '$alarma' WHERE IDmedicion = '$IDmedicion' ")
        //	or die ( $error ="Error description: " . mysqli_error($con) );




                ////////////////////////////
                /////// Declaración ////////
                ////////////////////////////

                $consulta = Configuracion::select('Observaciones')
                                            ->where([['Modificacion', 'Estado Declaración'],['IDempresa', $IDempresa]])
                                            ->orderBy('Fecha')
                                            ->get();
                // mysqli_query($con,"SELECT Observaciones FROM configuracion 
                // WHERE Modificacion = 'Estado Declaración' AND IDempresa = '$IDempresa' ORDER BY Fecha DESC LIMIT 1")
                // or die ($error ="Error description: " . mysqli_error($con));

                $Resultado = 'Normal';
                foreach($consulta as $row)
                {
                    $Resultado  = $row->Observaciones;
                }

                if($Resultado == 'Normal'){

                        //Chequea si hay una especie a declarar a sernapesca
                        $consulta = MedicionFan::join('especie', function($query) use ($IDmedicion){
                                                                        $query->on('medicion_fan.IDespecie', '=', 'especie.IDespecie')
                                                                                ->where('medicion_fan.IDmedicion', '=', $IDmedicion);
                                                                        })
                                                    ->select('medicion_fan.IDmedicion',
                                                                'medicion_fan.Medicion_1',
                                                                'medicion_fan.Medicion_2',
                                                                'medicion_fan.Medicion_3',
                                                                'medicion_fan.Medicion_4',
                                                                'medicion_fan.Medicion_5',
                                                                'medicion_fan.Medicion_6',
                                                                'medicion_fan.Medicion_7', 
                                                                'especie.Nombre', 
                                                                'especie.Nivel_Fiscaliza')
                                                    ->where(function($query){
                                                                $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                        ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                        ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                        ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                        ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                        ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                        ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('especie.Nivel_Fiscaliza'));
                                                    })
                                                    ->where('especie.Fiscaliza', 1)
                                                    ->get();
                    //     mysqli_query($con,"SELECT mf.IDmedicion,
                    //                                 mf.Medicion_1,
                    //                                 mf.Medicion_2,
                    //                                 mf.Medicion_3,
                    //                                 mf.Medicion_4,
                    //                                 mf.Medicion_5,
                    //                                 mf.Medicion_6,
                    //                                 mf.Medicion_7, 
                    //                                 e.Nombre, 
                    //                                 e.Nivel_Fiscaliza 
                    // FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    // WHERE (mf.Medicion_1 >= e.Nivel_Fiscaliza 
                    // OR mf.Medicion_2 >= e.Nivel_Fiscaliza 
                    // OR mf.Medicion_3 >= e.Nivel_Fiscaliza 
                    // OR mf.Medicion_4 >= e.Nivel_Fiscaliza 
                    // OR mf.Medicion_5 >= e.Nivel_Fiscaliza 
                    // OR mf.Medicion_6 >= e.Nivel_Fiscaliza 
                    // OR mf.Medicion_7 >= e.Nivel_Fiscaliza) 
                    // AND e.Fiscaliza = 1 ")
                    // or die ($error ="Error description: " . mysqli_error($con));

                        $declarar = array();
                        $Especie_declarar = array();
                        foreach($consulta as $row)
                        {

                            $medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);

                            $declarar = array(
                                            'IDmedicion' => $row->IDmedicion,
                                            'Medicion' => $medmax,
                                            'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza
                                        );

                            $medup = 100*(($medmax-$row->Nivel_Fiscaliza)/$row->Nivel_Fiscaliza);
                            $medup = round($medup,0);
                            $Especie_declarar[] = "&".$medup."& ".$row->Nombre;
                            $Estado_Nocivo = 1;
                        }

                }else if($Resultado == 'Pre-Alerta'){

                    //Chequea si existe nivel Pre-Alerta Res. Ex. 6073 del 24 de diciembre de 2018
                    $consulta = MedicionFan::join('especie', function($query) use ($IDmedicion){
                                                                $query->on('medicion_fan.IDespecie', '=', 'especie.IDespecie')
                                                                        ->where('medicion_fan.IDmedicion', '=', $IDmedicion);
                                                                })
                                                ->select('medicion_fan.IDmedicion',
                                                            'medicion_fan.Medicion_1',
                                                            'medicion_fan.Medicion_2',
                                                            'medicion_fan.Medicion_3',
                                                            'medicion_fan.Medicion_4',
                                                            'medicion_fan.Medicion_5',
                                                            'medicion_fan.Medicion_6',
                                                            'medicion_fan.Medicion_7', 
                                                            'especie.Nombre', 
                                                            'especie.Nivel_Fiscaliza',
                                                            'especie.Nivel_Fiscaliza_Pre')
                                                ->where(function($query){
                                                    $query->where('medicion_fan.Medicion_1', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
                                                            ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
                                                            ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
                                                            ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
                                                            ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
                                                            ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
                                                            ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'));
                                                            })
                                                ->where('especie.Fiscaliza', 1)
                                                ->get();

                    // mysqli_query($con,"SELECT mf.IDmedicion,
                    //                             mf.Medicion_1,
                    //                             mf.Medicion_2,
                    //                             mf.Medicion_3,
                    //                             mf.Medicion_4,
                    //                             mf.Medicion_5,
                    //                             mf.Medicion_6,
                    //                             mf.Medicion_7, 
                    //                             e.Nombre, 
                    //                             e.Nivel_Fiscaliza, 
                    //                             e.Nivel_Fiscaliza_Pre 
                    //         FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    //         WHERE (mf.Medicion_1 >= e.Nivel_Fiscaliza_Pre 
                    //         OR mf.Medicion_2 >= e.Nivel_Fiscaliza_Pre 
                    //         OR mf.Medicion_3 >= e.Nivel_Fiscaliza_Pre 
                    //         OR mf.Medicion_4 >= e.Nivel_Fiscaliza_Pre 
                    //         OR mf.Medicion_5 >= e.Nivel_Fiscaliza_Pre 
                    //         OR mf.Medicion_6 >= e.Nivel_Fiscaliza_Pre 
                    //         OR mf.Medicion_7 >= e.Nivel_Fiscaliza_Pre) 
                    //         AND e.Fiscaliza = 1 ")
                    //         or die ($error ="Error description: " . mysqli_error($con));

                    $declarar = array();
                    $Especie_declarar = array();
                    $Fecha_semana = array();
                    foreach($consulta as $row)
                    {

                        $medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);

                        $declarar = array(
                                        'IDmedicion' => $row->IDmedicion,
                                        'Medicion' => $medmax,
                                        //'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza,
                                        'Nivel_Fiscaliza_Pre' => $row->Nivel_Fiscaliza_Pre
                                    );

                        $medup = 100*(($medmax-$row->Nivel_Fiscaliza_Pre)/$row->Nivel_Fiscaliza_Pre);
                        $medup = round($medup,0);
                        $Especie_declarar[] = "&".$medup."& ".$row->Nombre;
                        $Estado_Nocivo = 0;
                    }
                }else if($Resultado == 'Alerta'){

                    //

                    $consulta = MedicionFan::join('especie', function($query) use ($IDmedicion){
                        $query->on('medicion_fan.IDespecie', '=', 'especie.IDespecie')
                                ->where('medicion_fan.IDmedicion', '=', $IDmedicion);
                        })
                                                ->select('medicion_fan.IDmedicion',
                                                            'medicion_fan.Medicion_1',
                                                            'medicion_fan.Medicion_2',
                                                            'medicion_fan.Medicion_3',
                                                            'medicion_fan.Medicion_4',
                                                            'medicion_fan.Medicion_5',
                                                            'medicion_fan.Medicion_6',
                                                            'medicion_fan.Medicion_7', 
                                                            'especie.Nombre', 
                                                            'especie.Nivel_Fiscaliza',
                                                            'especie.Nivel_Fiscaliza_Alerta')
                                                ->where(function($query){
                                                    $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                            ->orWhere('medicion_fan.Medicion_2', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                            ->orWhere('medicion_fan.Medicion_3', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                            ->orWhere('medicion_fan.Medicion_4', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                            ->orWhere('medicion_fan.Medicion_5', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                            ->orWhere('medicion_fan.Medicion_6', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                            ->orWhere('medicion_fan.Medicion_7', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'));
                                                            })
                                                ->where('especie.Fiscaliza', 1)
                                                ->get();
                    
                    // mysqli_query($con,"SELECT mf.IDmedicion,
                    //                             mf.Medicion_1,
                    //                             mf.Medicion_2,
                    //                             mf.Medicion_3,
                    //                             mf.Medicion_4,
                    //                             mf.Medicion_5,
                    //                             mf.Medicion_6,
                    //                             mf.Medicion_7, 
                    //                             e.Nombre, 
                    //                             e.Nivel_Fiscaliza, 
                    //                             e.Nivel_Fiscaliza_Alerta 
                    //     FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    //     WHERE (mf.Medicion_1 >= e.Nivel_Fiscaliza_Alerta 
                    //     OR mf.Medicion_2 >= e.Nivel_Fiscaliza_Alerta 
                    //     OR mf.Medicion_3 >= e.Nivel_Fiscaliza_Alerta 
                    //     OR mf.Medicion_4 >= e.Nivel_Fiscaliza_Alerta 
                    //     OR mf.Medicion_5 >= e.Nivel_Fiscaliza_Alerta 
                    //     OR mf.Medicion_6 >= e.Nivel_Fiscaliza_Alerta 
                    //     OR mf.Medicion_7 >= e.Nivel_Fiscaliza_Alerta) 
                    //     AND e.Fiscaliza = 1 ")
                    //     or die ($error ="Error description: " . mysqli_error($con));

                    $declarar = array();
                    $Especie_declarar = array();
                    $Fecha_semana = array();
                    foreach($consulta as $row )
                    {

                        $medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);

                        $declarar = array(
                                        'IDmedicion' => $row->IDmedicion,
                                        'Medicion' => $medmax,
                                        //'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza,
                                        'Nivel_Fiscaliza_Alerta' => $row->Nivel_Fiscaliza_Alerta
                                    );

                        $medup = 100*(($medmax-$row->Nivel_Fiscaliza_Alerta)/$row->Nivel_Fiscaliza_Alerta);
                        $medup = round($medup,0);
                        $Especie_declarar[] = "&".$medup."& ".$row->Nombre;
                        $Estado_Nocivo = 2;
                    }

                }

                //Busca si el Registro (IDmedicion) está como declaración
                $consulta = Declaracion::where('IDmedicion', $IDmedicion)
                                            ->select('IDdeclaracion')
                                            ->get();
                // mysqli_query($con,"SELECT IDdeclaracion FROM declaracion WHERE IDmedicion = '$IDmedicion' LIMIT 1")
                // or die ($error ="Error description: " . mysqli_error($con));

                //$row = mysqli_fetch_assoc($consulta);
                $IDdeclaracion = null;
                if ($consulta) {
                    $IDdeclaracion = $row->IDdeclaracion;
                }

                if(!empty($declarar)){
                    $Especie_declarar_aux = join(', ', $Especie_declarar);

                    if(!empty($IDdeclaracion)){

                        $consulta = Declaracion::where('IDdeclaracion', $IDdeclaracion)
                                                    ->update([
                                                        'IDcentro' => $IDcentro,
                                                        'IDmedicion' => $IDmedicion,
                                                        'Fecha_Registro' => $Fecha_Medicion,
                                                        'Estado' => '0',
                                                        'Firma_user_id' => '0',
                                                        'Observaciones' => '',
                                                        'Especie' => $Especie_declarar_aux,
                                                        'Estado_Nocivo' => $Estado_Nocivo
                                                    ]);
                        // mysqli_query($con,"UPDATE declaracion 
                        // SET IDcentro = '$IDcentro' , 
                        //     IDmedicion = '$IDmedicion' , 
                        //     Fecha_Registro = '$Fecha_Medicion', 
                        //     Estado = '0', 
                        //     Firma_user_id = '0', 
                        //     Observaciones = '', 
                        //     Especie = '$Especie_declarar_aux',
                        //     Estado_Nocivo = '$Estado_Nocivo' 
                        //     WHERE IDdeclaracion = '$IDdeclaracion' ")
                        //     or die ( $error ="Error description: " . mysqli_error($con) );

                    }else{

                        $consulta = Declaracion::insert([
                                                    'IDcentro' => $IDcentro,
                                                    'IDmedicion' => $IDmedicion,
                                                    'Fecha_Registro' => $Fecha_Medicion,
                                                    'Estado' => '0',
                                                    'Firma_user_id' => '0',
                                                    'Observaciones' => '',
                                                    'Especie' => $Especie_declarar_aux,
                                                    'Estado_Nocivo' => $Estado_Nocivo
                        ]);
                    //     mysqli_query($con,"INSERT INTO declaracion(IDcentro, 
                    //                                                 IDmedicion, 
                    //                                                 Fecha_Registro, 
                    //                                                 Estado, 
                    //                                                 Firma_user_id, 
                    //                                                 Observaciones, 
                    //                                                 Especie, 
                    //                                                 Estado_Nocivo) 
                    // VALUES ('$IDcentro', '$IDmedicion', '$Fecha_Medicion', '0','0','','$Especie_declarar_aux','$Estado_Nocivo')")
                    //     or die ( $error ="Error description: " . mysqli_error($con) );

                    }

                }else{
                    if(!empty($IDdeclaracion)){
                        //Elimina registro declaracion si es que existe y ahora está bajo los limites
                        $consulta = Declaracion::where('IDdeclaracion', $IDdeclaracion)
                                                            ->delete();
                        // mysqli_query($con,"DELETE FROM declaracion WHERE IDdeclaracion = '$IDdeclaracion' ")
                        // or die ( $error ="Error description: " . mysqli_error($con) );

                    }
                }
                /*}else{


                    //Chequea si hay es un registro a declarar dentro de una semana de un hallazgo
                    $dias_declaracion = 7;
                    $Fecha_semana = date('Y-m-d 00:00:00',strtotime($Fecha_Medicion . '-'.$dias_declaracion .' days'));
                    $consulta = mysqli_query($con,"SELECT IDdeclaracion FROM declaracion WHERE IDcentro = '$IDcentro' AND Estado_Nocivo = 1 AND Fecha_Registro > '$Fecha_semana'")or die ($error ="Error description: " . mysqli_error($con));

                    $row = mysqli_fetch_assoc($consulta);
                    $existe_dec = $row['IDdeclaracion'];
                    if(!empty($existe_dec)){

                        if(!empty($IDdeclaracion)){

                            $consulta = mysqli_query($con,"UPDATE declaracion SET IDcentro = '$IDcentro' , IDmedicion = '$IDmedicion' , Fecha_Registro = '$Fecha_Medicion', Estado = '0', Firma_user_id = '', Observaciones = '', Especie = '&&Registro dentro de la semana de declaración',Estado_Nocivo = '0' WHERE IDdeclaracion = '$IDdeclaracion' ")or die ( $error ="Error description: " . mysqli_error($con) );

                        }else{

                            $consulta = mysqli_query($con,"INSERT INTO declaracion(IDcentro,IDmedicion,Fecha_Registro, Estado,Firma_user_id, Observaciones, Especie,Estado_Nocivo) VALUES ('$IDcentro','$IDmedicion','$Fecha_Medicion','0','','','&&Registro dentro de la semana de declaración','0')") or die ( $error ="Error description: " . mysqli_error($con) );

                        }
                        $declarar = 1;

                    }else{

                        if(!empty($IDdeclaracion)){
                            $consulta = mysqli_query($con,"DELETE FROM declaracion WHERE IDdeclaracion = '$IDdeclaracion'")
                    or die ( $error = "Error description: " . mysqli_error($con) );
                        }
                        $declarar = 0;

                    }



                }*/





                $Resultado = array('Error' =>$error, 
                'Alarma' => $alarma,
                'Nombre_Centro' => $Centro,
                'IDcentro' => $IDcentro, 
                'Comentario' => $aux, 
                'Concentracion' => $Concentracion, 
                'Nocivo' => $Nocivo, 
                'Nocivo_P' => $Nocivo_P,
                'Comentario_Precaucion' => $aux_prec, 
                'Concentracion_Precaucion' => $Concentracion_precaucion, 
                'Mortalidad' => $Mortalidad );






            return Response::json($Resultado);
            //echo json_encode($Resultado);

    }

    /*===================================================================================================================*/

    public function delete(Request $request)
    {
                $miuser = Auth::user();
                $this->cambiar_bd($miuser->IDempresa);
        //     date_default_timezone_set('america/santiago');

             $error = 0;

        //     $IDmedicion = $_POST['IDmedicion'];
        //     $user_id = $_POST['user_id'];
                $IDmedicion = $request->input('IDmedicion');
                $IDempresa = $miuser->IDempresa;
                $email = $miuser->email;
                //     //IDempresa usuario

                

        //     //Guarda información de la medición antes de eliminarla (Pensando principalmente en tener un registro de eliminados y enviar en API a Australis)

                // $consulta_med =DB::select("SELECT gtr_medicion.*, 
                //                                 gtr_centro.IDempresa,
                //                                 gtr_centro.Nombre,
                //                                 gtr_centro.Codigo FROM gtr_medicion join gtr_centro ON gtr_medicion.IDcentro = gtr_centro.IDcentro 
                //                                 WHERE gtr_medicion.IDmedicion = '$IDmedicion'");
     
                $consulta_med = Medicion::join('centro', 'medicion.IDcentro', '=', 'centro.IDcentro')
                                            ->where(                                               
                                                'medicion.IDmedicion', $IDmedicion
                                                )
                                            ->select('medicion.*',
                                            'centro.IDempresa',
                                            'centro.Nombre',
                                            'centro.Codigo')
                                            ->get();

        //     $row = mysqli_fetch_assoc($consulta_med);

        //     if ($IDempresa != $row['IDempresa']) { // Verifica que sea la misma empresa del registro
        //         echo json_encode('acceso restringido');
        //         return '';
        //     }
                foreach($consulta_med as $row){
                    if ($IDempresa != $row->IDempresa) { // Verifica que sea la misma empresa del registro
                        echo json_encode('acceso restringido');
                        return '';
                    }
                    $Estado = $row->Estado;
                    $Fecha_Reporte = $row->Fecha_Reporte;
                    $Estado_Alarma = $row->Estado_Alarma;
                    $Comentario = $row->Comentario;
                    $IDcentro = $row->IDcentro;
                    $Codigo = $row->Codigo;
                    $Nombre_Centro = $row->Nombre;
                    
                    
                }
                
                
                $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                        ->delete();
                //DB::delete("DELETE FROM gtr_medicion WHERE IDmedicion = '$IDmedicion'");
        //     $consulta = mysqli_query($con,"DELETE FROM medicion WHERE IDmedicion = '$IDmedicion'")
        //     or die ( $error = "Error description4: " . mysqli_error($con) );
                $consulta = MedicionFan::where('IDmedicion', $IDmedicion)
                                            ->delete();
                //DB::delete("DELETE FROM gtr_medicion_fan WHERE IDmedicion = '$IDmedicion'");
        //     $consulta = mysqli_query($con,"DELETE FROM medicion_fan WHERE IDmedicion = '$IDmedicion'")
        //     or die ( $error = "Error description5: " . mysqli_error($con) );
                $consulta = MedicionPAmbientales::where('IDmedicion', $IDmedicion)
                                                    ->delete();
                //DB::delete("DELETE FROM gtr_medicion_pambientales WHERE IDmedicion = '$IDmedicion'");
        //     $consulta = mysqli_query($con,"DELETE FROM medicion_pambientales WHERE IDmedicion = '$IDmedicion'")
        //     or die ( $error = "Error description6: " . mysqli_error($con) );

        //     //Guarda el registro eliminado
        if ($Estado == 0) { // Si no es borrador
                    
                    $Fecha_Eliminacion = date('Y-m-d H:i:s');
                    
                    $consulta_insert= MedicionEliminada::insert([
                                                                    'IDmedicion' => $IDmedicion,
                                                                    'IDcentro' => $IDcentro,
                                                                    'Codigo' => $Codigo,
                                                                    'Nombre_Centro' => $Nombre_Centro,
                                                                    'Fecha_Reporte' => $Fecha_Reporte,
                                                                    'Fecha_Eliminacion' => $Fecha_Eliminacion,
                                                                    'email' => $email,
                                                                    'Estado_Alarma' => $Estado_Alarma,
                                                                    'Comentario' => $Comentario,
                                                                ]);
                    // $insertarMedicionEliminada = new MEdicionEliminada();
                    // $insertarMedicionEliminada->IDmedicion = $IDmedicion;
                    // $insertarMedicionEliminada->IDempresa = $IDempresa;
                    // $insertarMedicionEliminada->IDcentro = $IDcentro;
                    // $insertarMedicionEliminada->Codigo = $Codigo;
                    // $insertarMedicionEliminada->Nombre_Centro = $Nombre_Centro;
                    // $insertarMedicionEliminada->Fecha_Reporte  = $Fecha_Reporte;
                    // $insertarMedicionEliminada->Fecha_Eliminacion  = $Fecha_Eliminacion;
                    // $insertarMedicionEliminada->email  = $email;
                    // $insertarMedicionEliminada->Estado_Alarma  = $Estado_Alarma;
                    // $insertarMedicionEliminada->Comentario  = $Comentario; 
                    // $insertarMedicionEliminada->save();
                }
        //     if ($row['Estado'] > 0) { // Si no es borrador
        //         $Fecha_Reporte = $row['Fecha_Reporte'];
        //         $Fecha_Eliminacion = date('Y-m-d H:i:s');
        //         $Estado_Alarma = $row['Estado_Alarma'];
        //         $Comentario = $row['Comentario'];
        //         $IDcentro = $row['IDcentro'];
        //         $Codigo = $row['Codigo'];
        //         $Nombre_Centro = $row['Nombre'];

        //         $consulta_insert = mysqli_query($con,"INSERT INTO medicion_eliminada(IDmedicion, IDempresa,IDcentro,Codigo,Nombre_Centro,Fecha_Reporte,Fecha_Eliminacion,email,Estado_Alarma,Comentario)
        //                 VALUES('$IDmedicion','$IDempresa','$IDcentro','$Codigo','$Nombre_Centro','$Fecha_Reporte','$Fecha_Eliminacion','$email','$Estado_Alarma','$Comentario')")
        //                 or die ($error ="Error description3: " . mysqli_error($con));

        //     }

         //echo json_encode($error);
        //  if($consulta_insert){
        //     echo 'se han ingresado los datos correctamente';
        //  }
        return Response::json($error);
        //return response([ $consulta, $IDempresa, $email], 200, []);


    }


    /*===================================================================================================================*/

    public function loadCoordenadaCentro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);   
                //     $error = 0;
                // $IDcentro = $_GET['IDcentro'];
        $IDcentro = $request->input('IDcentro');



            //     //Busca la coordenada del centro para poner por defecto en el registro

            $consulta = Centro::where('IDcentro', $IDcentro)
                                    ->select(
                                        'TopLeft',
                                        'Modulo',
                                        'Jaula'
                                    )
                                    ->get();
            //DB::select("SELECT TopLeft,Modulo,Jaula FROM gtr_centro WHERE IDcentro = '$IDcentro'");

                                 
            foreach($consulta as $row)
            {
                 $topleft = $row->TopLeft;
                 $Modulo = $row->Modulo;
                 $Jaula = $row->Jaula;
            }
          

            //     if($row){
            //         $topleft = $row['TopLeft'];
            //         $Modulo = $row['Modulo'];
            //         $Jaula = $row['Jaula'];
            //     }

                function DDtoDMS($dec)
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
                
                $topleft = explode(',',$topleft);
                $latitud = DDtoDMS($topleft[0]);
                $longitud = DDtoDMS($topleft[1]);


            // // 	function DMStoDD($deg,$min,$sec)
            // // {
            // //
            // //     // Converting DMS ( Degrees / minutes / seconds ) to decimal format
            // //     return $deg+((($min*60)+($sec))/3600);
            // // }



            //     echo json_encode(array(
            //         'latitud' => $latitud,
            //         'longitud' => $longitud,
            //         'Modulo' => $Modulo,
            //         'Jaula' => $Jaula
            //     ));
            $Resultado = array(
                    'latitud' => $latitud,
                    'longitud' => $longitud,
                     'Modulo' => $Modulo,
                     'Jaula' => $Jaula
            );
        return Response::json($Resultado);
            
        //return response([ $consulta, $latitud], 200, []);

    }

    /*===================================================================================================================*/



    public function existeFechaMuestreo(Request $request)
    {
        $miuser = Auth::user();  
        $this->cambiar_bd($miuser->IDempresa);
		
		if($miuser->user_role == 1 || $miuser->user_role == 2){
			
		}else {
			return 'Acceso Restringido';
		}
		
		$error = 0;
		$IDcentro = $request->input('IDcentro');
		date_default_timezone_set('america/santiago');
		$date = $request->input('Fecha_Muestreo');
		$time = $request->input('Hora_Muestreo');
		$Fecha_Muestreo = date('Y-m-d H:i:s', strtotime("$date $time"));
	
		$fecha_envio = Medicion::where('IDcentro',$IDcentro)
										->where('Fecha_Reporte',$Fecha_Muestreo)
										->pluck('Fecha_Envio')
                                        ->toArray();
										
		if (count($fecha_envio)>0) {
			 $fecha_envio = implode(',',$fecha_envio);
		}else{$fecha_envio = 0;}
		
		return Response::json($fecha_envio);
		
	}

    /*===================================================================================================================*/





    public function saveRegistro(Request $request)
    {
        //PHP para ver errores
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $miuser = Auth::user();  
		$this->cambiar_bd($miuser->IDempresa);

		if($miuser->user_role == 1 || $miuser->user_role == 2){
			
		}else {
			return 'Acceso Restringido';
		}

        $error = 0;
	 	   						
		$IDdiatomeas = $request->input('IDdiatomeas');				  		
		$Medicion0_Diatomeas = $request->input('Medicion0_Diatomeas');			
		$Medicion1_Diatomeas = $request->input('Medicion1_Diatomeas');				
		$Medicion2_Diatomeas = $request->input('Medicion2_Diatomeas');		
		$Medicion3_Diatomeas = $request->input('Medicion3_Diatomeas');
		$Medicion4_Diatomeas = $request->input('Medicion4_Diatomeas');
		$Medicion5_Diatomeas = $request->input('Medicion5_Diatomeas');
		$Medicion6_Diatomeas = $request->input('Medicion6_Diatomeas');		
		$IDdinoflagelados = $request->input('IDdinoflagelados');				  
		$Medicion0_Dinoflagelados = $request->input('Medicion0_Dinoflagelados');		   
		$Medicion1_Dinoflagelados = $request->input('Medicion1_Dinoflagelados');		   
		$Medicion2_Dinoflagelados = $request->input('Medicion2_Dinoflagelados');	
		$Medicion3_Dinoflagelados = $request->input('Medicion3_Dinoflagelados');
		$Medicion4_Dinoflagelados = $request->input('Medicion4_Dinoflagelados');
		$Medicion5_Dinoflagelados = $request->input('Medicion5_Dinoflagelados');
		$Medicion6_Dinoflagelados = $request->input('Medicion6_Dinoflagelados');		   
		$IDoespecies = $request->input('IDoespecies'); 				  		
		$Medicion0_oespecies = $request->input('Medicion0_oespecies'); 			 	
		$Medicion1_oespecies = $request->input('Medicion1_oespecies'); 				
		$Medicion2_oespecies = $request->input('Medicion2_oespecies'); 
		$Medicion3_oespecies = $request->input('Medicion3_oespecies');
		$Medicion4_oespecies = $request->input('Medicion4_oespecies');
		$Medicion5_oespecies = $request->input('Medicion5_oespecies');
		$Medicion6_oespecies = $request->input('Medicion6_oespecies'); 				
		$IDpambientales = $request->input('IDpambientales'); 				  	 
		$Medicion0_pambientales = $request->input('Medicion0_pambientales'); 			 
		$Medicion1_pambientales = $request->input('Medicion1_pambientales'); 			 
		$Medicion2_pambientales = $request->input('Medicion2_pambientales');
		$Medicion3_pambientales = $request->input('Medicion3_pambientales'); 
		$Medicion4_pambientales = $request->input('Medicion4_pambientales'); 
		$Medicion5_pambientales = $request->input('Medicion5_pambientales'); 
		$Medicion6_pambientales = $request->input('Medicion6_pambientales'); 			 
		$IDpambientalesotros = $request->input('IDpambientalesotros'); 				
		$Medicion0_pambientalesotros = $request->input('Medicion0_pambientalesotros'); 	
		$IDmortalidad = $request->input('IDmortalidad'); 	
		
		$Tecnica = $request->input('Tecnica'); 
		$Observaciones = $request->input('Observaciones'); 
		$Fecha_Medicion = $request->input('Fecha_Medicion');
		$Fecha_Analisis = $request->input('Fecha_Analisis');	 					 
		$Firma = $request->input('Firma');
		$Laboratorio = $request->input('Laboratorio');
		$IDcentro = $request->input('IDcentro');
		$Estado = $request->input('Estado');
        
        $moduloreporte = $_POST['moduloreporte'];
        $jaulareporte = $_POST['jaulareporte'];
        $latitud_grados = $_POST['latitud_grados'];
        $latitud_min = $_POST['latitud_min'];
        $latitud_seg = $_POST['latitud_seg'];
        $longitud_grados = $_POST['longitud_grados'];
        $longitud_min = $_POST['longitud_min'];
        $longitud_seg = $_POST['longitud_seg'];

		date_default_timezone_set('america/santiago');
		$Fecha_Medicion = date('Y-m-d H:i:s',strtotime($Fecha_Medicion));
		$Fecha_Analisis = date('Y-m-d H:i:s',strtotime($Fecha_Analisis));
		$fecha = date('Y-m-d H:i:s');
		
		$Fecha_semana = array();
		
		//Buscar Fechas Siembra, Cosecha y especie cultivada
		$centro_aux = Centro::find($IDcentro);
		$Especie = $centro_aux->Especie;
		$Siembra = $centro_aux->Siembra;
		$Cosecha = $centro_aux->Cosecha;
		$Centro = $centro_aux->Nombre;
		$IDempresa = $centro_aux->IDempresa;
		
        //Comprueba que la coordenada ingresada no sea mayor a 1km de la coordenada del centro (osino se debe considerar como otro "centro")
	 function haversineGreatCircleDistance1($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
  
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
  
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
          cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
      }
  
      //Covierte coordenada a Decimal
          function DMStoDD5($deg,$min,$sec)
      {
              // Converting DMS ( Degrees / minutes / seconds ) to decimal format
              return round($deg+((($min*60)+($sec))/3600),5);
      }
  
  
      $topleft = '';
      if ($latitud_grados != '' && $latitud_min != '' && $latitud_seg != '' && $longitud_grados != '' && $longitud_min != '' && $longitud_seg != '') {
          $topleft = -1 * DMStoDD5(abs($latitud_grados),$latitud_min,$latitud_seg).','. -1 * DMStoDD5( abs($longitud_grados),$longitud_min,$longitud_seg);
      }
  
      if ($topleft != '') {
          //Busca la coordenada del centro para poner por defecto en el registro
          $consulta = Centro::where('IDcentro', $IDcentro)
                                ->select('TopLeft')
                                ->first();
        //   mysqli_query($con,"SELECT topleft FROM centro WHERE IDcentro = '$IDcentro'")
        //   or die ($error ="Error description: " . mysqli_error($consulta));
         // $row = mysqli_fetch_assoc($consulta);
          $topleft_centro = $consulta->TopLeft;
        //   if($row){
        //       $topleft_centro = $row['topleft'];
        //   }
  
          if ($topleft_centro != '') {
              $lat_long = explode(',',$topleft);
              $lat_long_centro = explode(',',$topleft_centro);
              if (haversineGreatCircleDistance1($lat_long[0], $lat_long[1], $lat_long_centro[0], $lat_long_centro[1]) > 1000) {
                  echo json_encode(array('Error' => 1,'msg' => 'La coordenada ingresada supera en 1[km] la ubicación del centro.'));
                  die();
              }
          }
  
      }


		//Insertar medicion
		$Mortalidad = $Medicion0_pambientalesotros[array_search($IDmortalidad, $IDpambientalesotros)];
		$ingreso_registro = new Medicion();
		$ingreso_registro->IDcentro = $IDcentro;
		$ingreso_registro->Fecha_Envio = $fecha;
		$ingreso_registro->Fecha_Reporte = $Fecha_Medicion;
		$ingreso_registro->Fecha_Analisis = $Fecha_Analisis;
		$ingreso_registro->Estado_Alarma = 'Ausencia Microalgas';
		$ingreso_registro->Tecnica = $Tecnica;
		$ingreso_registro->Observaciones = $Observaciones;
		$ingreso_registro->Mortalidad = $Mortalidad;
		$ingreso_registro->Especie = $Especie;
		$ingreso_registro->Siembra = $Siembra;
		$ingreso_registro->Cosecha = $Cosecha;
		$ingreso_registro->Firma = $Firma;
		$ingreso_registro->Estado = $Estado;
		$ingreso_registro->Laboratorio = $Laboratorio;
     	$ingreso_registro->save();
		
		$IDmedicion = $ingreso_registro->IDmedicion;

        if ($topleft != '') {
            // $topleft = -1 * DMStoDD(abs($latitud_grados),$latitud_min,$latitud_seg).','. -1 * DMStoDD( abs($longitud_grados),$longitud_min,$longitud_seg);
            $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['TopLeft'=> $topleft]);
            //mysqli_query($con,"UPDATE medicion SET TopLeft = '$topleft' WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
        }
    
        if ($moduloreporte != '') {
            $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['Modulo'=> $moduloreporte]);
            //mysqli_query($con,"UPDATE medicion SET Modulo = '$moduloreporte' WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
        }
        if ($jaulareporte != '') {
            $consulta = Medicion::where('IDmedicion', $IDmedicion)->update(['Jaula'=> $jaulareporte]);
            //mysqli_query($con,"UPDATE medicion SET Jaula = '$jaulareporte' WHERE IDmedicion = '$IDmedicion' ") or die ($error ="Error description: " . mysqli_error($con));
        }

		if($error == 0){
			//Save Diatomeas
			if($IDdiatomeas != ""){
				foreach($IDdiatomeas as $i => $IDdiatovalue){

					if($IDdiatovalue){
						$especie_aux = Especie::find($IDdiatovalue);
						
						$medicion_fan = new MedicionFan;
						$medicion_fan->IDmedicion = $IDmedicion;
						$medicion_fan->IDespecie = $IDdiatovalue;
						$medicion_fan->Fiscaliza = $especie_aux->Fiscaliza;
						$medicion_fan->Nociva = $especie_aux->Nociva;
						$medicion_fan->Nivel_Critico =$especie_aux->Nivel_Critico;
						$medicion_fan->Nivel_Fiscaliza = $especie_aux->Nivel_Fiscaliza;
						$medicion_fan->Nivel_Fiscaliza_Pre = $especie_aux->Nivel_Fiscaliza_Pre;
						$medicion_fan->Nivel_Fiscaliza_Alerta = $especie_aux->Nivel_Fiscaliza_Alerta;
						$medicion_fan->Alarma_Rojo = $especie_aux->Alarma_Rojo;
						$medicion_fan->Alarma_Amarillo = $especie_aux->Alarma_Amarillo;

                        if($Medicion0_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_1 = $Medicion0_Diatomeas[$i];
                        }
                        if($Medicion1_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_2 = $Medicion1_Diatomeas[$i];
                        }
                        if($Medicion2_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_3 = $Medicion2_Diatomeas[$i];
                        }
                        if($Medicion3_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_4 = $Medicion3_Diatomeas[$i];
                        }
                        if($Medicion4_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_5 = $Medicion4_Diatomeas[$i];
                        }
                        if($Medicion5_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_6 = $Medicion5_Diatomeas[$i];
                        }
                        if($Medicion6_Diatomeas[$i] != '' ){
                            $medicion_fan->Medicion_7 = $Medicion6_Diatomeas[$i];
                        }
						
						// $medicion_fan->Medicion_2 = $Medicion1_Diatomeas[$i];
						// $medicion_fan->Medicion_3 = $Medicion2_Diatomeas[$i];
						// $medicion_fan->Medicion_4 = $Medicion3_Diatomeas[$i];
						// $medicion_fan->Medicion_5 = $Medicion4_Diatomeas[$i];
						// $medicion_fan->Medicion_6 = $Medicion5_Diatomeas[$i];
						// $medicion_fan->Medicion_7 = $Medicion6_Diatomeas[$i];
						$medicion_fan->save();
					}
				}
			}
          
			
			//Save Dinoflagelados
			if($IDdinoflagelados != ""){
				foreach($IDdinoflagelados as $i => $IDdinovalue){
					if($IDdinovalue){
						$especie_aux = Especie::find($IDdinovalue);
						
						$medicion_fan = new MedicionFan;
						$medicion_fan->IDmedicion = $IDmedicion;
						$medicion_fan->IDespecie = $IDdinovalue;
						$medicion_fan->Fiscaliza = $especie_aux->Fiscaliza;
						$medicion_fan->Nociva = $especie_aux->Nociva;
						$medicion_fan->Nivel_Critico =$especie_aux->Nivel_Critico;
						$medicion_fan->Nivel_Fiscaliza = $especie_aux->Nivel_Fiscaliza;
						$medicion_fan->Nivel_Fiscaliza_Pre = $especie_aux->Nivel_Fiscaliza_Pre;
						$medicion_fan->Nivel_Fiscaliza_Alerta = $especie_aux->Nivel_Fiscaliza_Alerta;
						$medicion_fan->Alarma_Rojo = $especie_aux->Alarma_Rojo;
						$medicion_fan->Alarma_Amarillo = $especie_aux->Alarma_Amarillo;

                        if($Medicion0_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_1 = $Medicion0_Dinoflagelados[$i];
                        }
                        if($Medicion1_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_2 = $Medicion1_Dinoflagelados[$i];
                        }
                        if($Medicion2_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_3 = $Medicion2_Dinoflagelados[$i];
                        }
                        if($Medicion3_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_4 = $Medicion3_Dinoflagelados[$i];
                        }
                        if($Medicion4_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_5 = $Medicion4_Dinoflagelados[$i];
                        }
                        if($Medicion5_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_6 = $Medicion5_Dinoflagelados[$i];
                        }
                        if($Medicion6_Dinoflagelados[$i] != '' ){
                            $medicion_fan->Medicion_7 = $Medicion6_Dinoflagelados[$i];
                        }
						
						// $medicion_fan->Medicion_1 = $Medicion0_Dinoflagelados[$i];
						// $medicion_fan->Medicion_2 = $Medicion1_Dinoflagelados[$i];
						// $medicion_fan->Medicion_3 = $Medicion2_Dinoflagelados[$i];
						// $medicion_fan->Medicion_4 = $Medicion3_Dinoflagelados[$i];
						// $medicion_fan->Medicion_5 = $Medicion4_Dinoflagelados[$i];
						// $medicion_fan->Medicion_6 = $Medicion5_Dinoflagelados[$i];
						// $medicion_fan->Medicion_7 = $Medicion6_Dinoflagelados[$i];
						$medicion_fan->save();
			
					}
				}
			}
			
			//Save Otras especies
			if($IDoespecies != ""){
				foreach($IDoespecies as $i => $IDoespvalue){
					if($IDoespvalue){
						$especie_aux = Especie::find($IDoespvalue);
						
						$medicion_fan = new MedicionFan;
						$medicion_fan->IDmedicion = $IDmedicion;
						$medicion_fan->IDespecie = $IDoespvalue;
						$medicion_fan->Fiscaliza = $especie_aux->Fiscaliza;
						$medicion_fan->Nociva = $especie_aux->Nociva;
						$medicion_fan->Nivel_Critico =$especie_aux->Nivel_Critico;
						$medicion_fan->Nivel_Fiscaliza = $especie_aux->Nivel_Fiscaliza;
						$medicion_fan->Nivel_Fiscaliza_Pre = $especie_aux->Nivel_Fiscaliza_Pre;
						$medicion_fan->Nivel_Fiscaliza_Alerta = $especie_aux->Nivel_Fiscaliza_Alerta;
						$medicion_fan->Alarma_Rojo = $especie_aux->Alarma_Rojo;
						$medicion_fan->Alarma_Amarillo = $especie_aux->Alarma_Amarillo;

                        if($Medicion0_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_1 = $Medicion0_oespecies[$i];
                        }
                        if($Medicion1_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_2 = $Medicion1_oespecies[$i];
                        }
                        if($Medicion2_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_3 = $Medicion2_oespecies[$i];
                        }
                        if($Medicion3_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_4 = $Medicion3_oespecies[$i];
                        }
                        if($Medicion4_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_5 = $Medicion4_oespecies[$i];
                        }
                        if($Medicion5_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_6 = $Medicion5_oespecies[$i];
                        }
                        if($Medicion6_oespecies[$i] != '' ){
                            $medicion_fan->Medicion_7 = $Medicion6_oespecies[$i];
                        }

						// $medicion_fan->Medicion_1 = $Medicion0_oespecies[$i];
						// $medicion_fan->Medicion_2 = $Medicion1_oespecies[$i];
						// $medicion_fan->Medicion_3 = $Medicion2_oespecies[$i];
						// $medicion_fan->Medicion_4 = $Medicion3_oespecies[$i];
						// $medicion_fan->Medicion_5 = $Medicion4_oespecies[$i];
						// $medicion_fan->Medicion_6 = $Medicion5_oespecies[$i];
						// $medicion_fan->Medicion_7 = $Medicion6_oespecies[$i];
						$medicion_fan->save();
						
					}
				}
			}
			
			//Save Parámetros Ambientales
			if($IDpambientales != ""){
				foreach($IDpambientales as $i => $IDpambvalue){
					if($IDpambvalue){
						
						$medicion_pambientales = new MedicionPAmbientales;
						$medicion_pambientales->IDmedicion = $IDmedicion;
						$medicion_pambientales->IDpambientales = $IDpambvalue;

                        if($Medicion0_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_1 = $Medicion0_pambientales[$i];
                        }
                        if($Medicion1_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_2 = $Medicion1_pambientales[$i];
                        }
                        if($Medicion2_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_3 = $Medicion2_pambientales[$i];
                        }
                        if($Medicion3_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_4 = $Medicion3_pambientales[$i];
                        }
                        if($Medicion4_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_5 = $Medicion4_pambientales[$i];
                        }
                        if($Medicion5_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_6 = $Medicion5_pambientales[$i];
                        }
                        if($Medicion6_pambientales[$i] != '' ){
                            $medicion_pambientales->Medicion_7 = $Medicion6_pambientales[$i];
                        }
						// $medicion_pambientales->Medicion_1 = $Medicion0_pambientales[$i];
						// $medicion_pambientales->Medicion_2 = $Medicion1_pambientales[$i];
						// $medicion_pambientales->Medicion_3 = $Medicion2_pambientales[$i];
						// $medicion_pambientales->Medicion_4 = $Medicion3_pambientales[$i];
						// $medicion_pambientales->Medicion_5 = $Medicion4_pambientales[$i];
						// $medicion_pambientales->Medicion_6 = $Medicion5_pambientales[$i];
						// $medicion_pambientales->Medicion_7 = $Medicion6_pambientales[$i];
						$medicion_pambientales->save();
					}
				}
			}
			
			//Save Parámetros Ambientales Otros
			if($IDpambientalesotros != ""){
				foreach($IDpambientalesotros as $i => $IDpambovalue){
					if($IDpambovalue){
						$medicion_pambientales = new MedicionPAmbientales;
						$medicion_pambientales->IDmedicion = $IDmedicion;
						$medicion_pambientales->IDpambientales = $IDpambovalue;
						$medicion_pambientales->Medicion_1 = $Medicion0_pambientalesotros[$i];
						$medicion_pambientales->Medicion_2 = '';
						$medicion_pambientales->Medicion_3 = '';
						$medicion_pambientales->Medicion_4 = '';
						$medicion_pambientales->Medicion_5 = '';
						$medicion_pambientales->Medicion_6 = '';
						$medicion_pambientales->Medicion_7 = '';
						$medicion_pambientales->save();
					}
				}
			}
			
			
			//Alarma para todas las especies, (no solo las que fiscaliza serna)	
			$con_aux = MedicionFan::join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
									->where('medicion_fan.IDmedicion',$IDmedicion)
									->where(//Busca las alarma rojo
											function ($query) {
												$query->where('medicion_fan.Medicion_1','>=', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_2','>=', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_3','>=', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_4','>=', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_5','>=', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_6','>=', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_7','>=', DB::raw('gtr_especie.Alarma_Rojo'));
											}
									)
									->where('especie.Alarma_Rojo','>',0)
									->select('IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7',
                                            'especie.Alarma_Rojo',
                                            'especie.Alarma_Amarillo',
                                            'especie.Nombre',
                                            'especie.Nivel_Critico')
									->get();
									
			$alarma = "";
			$Comentario = array();
			$Comentario_precaucion = array();
			$Concentracion = array();
			$Nocivo = array();
			$Nocivo_P = array();
			$Concentracion_precaucion = array();
			$aux_prec = "";
			
			foreach($con_aux as $row){
				$alarma = "Nivel Crí­tico";
				$Comentario[] = $row->Nombre;
				$Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
				$Nocivo[] = $row->Nivel_Critico;
                //          $datos_rojo['Alarma_Rojo'][] = $row->Alarma_Rojo;
                //			$datos_rojo['Alarma_Amarillo'][] = $row->Alarma_Amarillo;
                //			$datos_rojo['Medicion_1'][] = $row->Medicion_1;
                //			$datos_rojo['Medicion_2'][] = $row->Medicion_2;
                //			$datos_rojo['Medicion_3'][] = $row->Medicion_3;
                //			$datos_rojo['Medicion_4'][] = $row->Medicion_4;
				
			}
			
			
			if($alarma == ""){
				
				$con_aux = MedicionFan::join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
									->where('medicion_fan.IDmedicion',$IDmedicion)
									->where(//Busca las alarma rojo
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
									->select('IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7',
                                            'especie.Alarma_Rojo',
                                            'especie.Alarma_Amarillo',
                                            'especie.Nombre',
                                            'especie.Nivel_Critico')
									->get();
				
				foreach($con_aux as $row){
					$alarma = "Precaución";
					$Comentario[] = $row->Nombre;
					$Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
					$Nocivo[] = $row->Nivel_Critico;
				}
				
			}else{
				
				$con_aux = MedicionFan::join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
									->where('medicion_fan.IDmedicion',$IDmedicion)
									->where(//Busca las alarma rojo
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
									->where(//Busca las alarma rojo
											function ($query) {
												$query->where('medicion_fan.Medicion_1','<', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_2','<', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_3','<', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_4','<', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_5','<', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_6','<', DB::raw('gtr_especie.Alarma_Rojo'))
												->orWhere('medicion_fan.Medicion_7','<', DB::raw('gtr_especie.Alarma_Rojo'));
											}
									)
									->where('especie.Alarma_Amarillo','>',0)
									->select('IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7',
                                            'especie.Alarma_Rojo',
                                            'especie.Alarma_Amarillo',
                                            'especie.Nombre',
                                            'especie.Nivel_Critico')
									->get();
				
				foreach($con_aux as $row){
					if(!in_array($row->Nombre, $Comentario)){
						$Comentario_precaucion[] = $row->Nombre;
						$Concentracion_precaucion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,
                        $row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
						$Nocivo_P[] = $row->Nivel_Critico;
					}
				}
				$aux_prec = join(', ', $Comentario_precaucion);
				
			}
			
			if($alarma == ""){
				
				$con_aux2 = MedicionFan::where('IDmedicion',$IDmedicion)
									->where(
											function ($query) {
												$query->where('Medicion_1','>',0)
												->orWhere('Medicion_2','>',0)
												->orWhere('Medicion_3','>',0)
												->orWhere('Medicion_4','>',0)
												->orWhere('Medicion_5','>',0)
												->orWhere('Medicion_6','>',0)
												->orWhere('Medicion_7','>',0);
											}
									)
									->select('IDmedicionfan')
									->get();
									
				if(count($con_aux2)){
					$alarma = "Presencia Microalgas";
				}	
				
			}
			
			
			if($alarma != ""){
				
				$aux = join(', ', $Comentario);
				
				$ingreso_registro->Estado_Alarma = $alarma;
				$ingreso_registro->Comentario  = $aux;
				$ingreso_registro->save();
			}else{$alarma = "Ausencia Microalgas"; $aux = "";}	
			
			
				
			////////////////////////////
			/////// Declaración ////////
			////////////////////////////
			
			if($Estado == 1){  //Verifica que no sea borrador	
			
				$configuracion = Configuracion::where('Modificacion','Estado Declaración')
												->where('IDempresa',$IDempresa)
												->select('Observaciones')
												->orderBy('Fecha','DESC')
												->first();
												
				$Resultado = 'Normal';
				if($configuracion){
					$Resultado  = $configuracion->Observaciones;	
				}
				
				if($Resultado == 'Normal'){
				
					//Chequea si hay una especie a declarar a sernapesca
					$dec = MedicionFan::join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
									->where('medicion_fan.IDmedicion',$IDmedicion)
									->where(//Busca las alarma rojo
											function ($query) {
												$query->where('medicion_fan.Medicion_1','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'))
												->orWhere('medicion_fan.Medicion_2','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'))
												->orWhere('medicion_fan.Medicion_3','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'))
												->orWhere('medicion_fan.Medicion_4','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'))
												->orWhere('medicion_fan.Medicion_5','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'))
												->orWhere('medicion_fan.Medicion_6','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'))
												->orWhere('medicion_fan.Medicion_7','>=',DB::raw('gtr_especie.Nivel_Fiscaliza'));
											}
									)
									->where('especie.Fiscaliza',1)
									->where('especie.Nivel_Fiscaliza','>',0)
									->select('IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7',
                                            'especie.Alarma_Rojo',
                                            'especie.Alarma_Amarillo',
                                            'especie.Nombre',
                                            'especie.Nivel_Fiscaliza')
									->get();
				
					$declarar = array();
					$Especie_declarar = array();
					$Fecha_semana = array();
					foreach($dec as $row){
						$medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
						
						$declarar = array(
										'IDmedicion' => $row->IDmedicion,
										'Medicion' => $medmax,
										'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza
									);
									
						$medup = 100*(($medmax-$row->Nivel_Fiscaliza)/$row->Nivel_Fiscaliza);
						$medup = round($medup,0);
						$Especie_declarar[] = "&".$medup."& ".$row->Nombre;
						$Estado_Nocivo = 1;
						
					}
					
				}else if($Resultado == 'Pre-Alerta'){
					
					//Chequea si existe nivel Pre-Alerta Res. Ex. 6073 del 24 de diciembre de 2018
					$dec = MedicionFan::join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
									->where('medicion_fan.IDmedicion',$IDmedicion)
									->where(//Busca las alarma rojo
											function ($query) {
												$query->where('medicion_fan.Medicion_1','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
												->orWhere('medicion_fan.Medicion_2','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
												->orWhere('medicion_fan.Medicion_3','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
												->orWhere('medicion_fan.Medicion_4','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
												->orWhere('medicion_fan.Medicion_5','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
												->orWhere('medicion_fan.Medicion_6','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'))
												->orWhere('medicion_fan.Medicion_7','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Pre'));
											}
									)
									->where('especie.Fiscaliza',1)
									->where('especie.Nivel_Fiscaliza_Pre','>',0)
									->select('IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7',
                                            'especie.Alarma_Rojo',
                                            'especie.Alarma_Amarillo',
                                            'especie.Nombre',
                                            'especie.Nivel_Fiscaliza_Pre')
									->get();
				
					$declarar = array();
					$Especie_declarar = array();
					$Fecha_semana = array();
					foreach($dec as $row){
						$medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
						
						$declarar = array(
										'IDmedicion' => $row->IDmedicion,
										'Medicion' => $medmax,
										'Nivel_Fiscaliza_Pre' => $row->Nivel_Fiscaliza_Pre
									);
									
						$medup = 100*(($medmax-$row->Nivel_Fiscaliza_Pre)/$row->Nivel_Fiscaliza_Pre);
						$medup = round($medup,0);
						$Especie_declarar[] = "&".$medup."& ".$row->Nombre;
						$Estado_Nocivo = 0;
						
					}
					
				}else if($Resultado == 'Alerta'){
				
					//
					$dec = MedicionFan::join('especie','especie.IDespecie','=','medicion_fan.IDespecie')
									->where('medicion_fan.IDmedicion',$IDmedicion)
									->where(//Busca las alarma rojo
											function ($query) {
												$query->where('medicion_fan.Medicion_1','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'))
												->orWhere('medicion_fan.Medicion_2','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'))
												->orWhere('medicion_fan.Medicion_3','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'))
												->orWhere('medicion_fan.Medicion_4','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'))
												->orWhere('medicion_fan.Medicion_5','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'))
												->orWhere('medicion_fan.Medicion_6','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'))
												->orWhere('medicion_fan.Medicion_7','>=',DB::raw('gtr_especie.Nivel_Fiscaliza_Alerta'));
											}
									)
									->where('especie.Fiscaliza',1)
									->where('especie.Nivel_Fiscaliza_Alerta','>',0)
									->select('IDmedicionfan',
                                            'medicion_fan.Medicion_1',
                                            'medicion_fan.Medicion_2',
                                            'medicion_fan.Medicion_3',
                                            'medicion_fan.Medicion_4',
                                            'medicion_fan.Medicion_5',
                                            'medicion_fan.Medicion_6',
                                            'medicion_fan.Medicion_7',
                                            'especie.Alarma_Rojo',
                                            'especie.Alarma_Amarillo',
                                            'especie.Nombre',
                                            'especie.Nivel_Fiscaliza_Alerta')
									->get();
				
					$declarar = array();
					$Especie_declarar = array();
					$Fecha_semana = array();
					foreach($dec as $row){
						$medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
						
						$declarar = array(
										'IDmedicion' => $row->IDmedicion,
										'Medicion' => $medmax,
										'Nivel_Fiscaliza_Alerta' => $row->Nivel_Fiscaliza_Alerta
									);
									
						$medup = 100*(($medmax-$row->Nivel_Fiscaliza_Alerta)/$row->Nivel_Fiscaliza_Alerta);
						$medup = round($medup,0);
						$Especie_declarar[] = "&".$medup."& ".$row->Nombre;
						$Estado_Nocivo = 2;
						
					}
					
				}
				
				if(!empty($declarar)){
					$Especie_declarar_aux = join(', ', $Especie_declarar);
					
					$declaracion = new Declaracion;
					$declaracion->IDcentro = $IDcentro;
					$declaracion->IDmedicion = $IDmedicion;
					$declaracion->Fecha_Registro = $Fecha_Medicion;
					$declaracion->Estado = 0;
					$declaracion->Firma_user_id = 0;
					$declaracion->Observaciones = '';
					$declaracion->Especie = $Especie_declarar_aux;
					$declaracion->Estado_Nocivo = $Estado_Nocivo;
					$declaracion->save();
				}else{
					//Chequea si hay es un registro a declarar dentro de una semana de un hallazgo
					/*$dias_declaracion = 7;
					$Fecha_semana = date('Y-m-d 00:00:00',strtotime($Fecha_Medicion . '-'.$dias_declaracion .' days'));
					$consulta = mysqli_query($con,"SELECT IDdeclaracion FROM declaracion WHERE IDcentro = '$IDcentro' AND Estado_Nocivo = 1 AND Fecha_Registro > '$Fecha_semana'")or die ($error ="Error description: " . mysqli_error($con));
					
					$row = mysqli_fetch_assoc($consulta);
					$existe_dec = $row['IDdeclaracion'];		
					if(!empty($existe_dec)){
						
						$consulta = mysqli_query($con,"INSERT INTO declaracion(IDcentro,IDmedicion,Fecha_Registro, Estado,Firma_user_id, Observaciones, Especie,Estado_Nocivo) VALUES ('$IDcentro','$IDmedicion','$Fecha_Medicion','0','','','&&Registro dentro de la semana de declaraciÃ³n','0')") or die ( $error ="Error description: " . mysqli_error($con) );
						
						$declarar = 1;
						
					}else{
				
						$declarar = 0;
					
					}*/
					
				}
			}
			
			$Resultado = array('Error' =>$error, 
            'Alarma' => $alarma,
            'Nombre_Centro' => $Centro,
            'IDcentro' => $IDcentro, 
            'IDmedicion' => $IDmedicion, 
            'Comentario' => $aux, 
            'Concentracion' => $Concentracion, 
            'Nocivo' => $Nocivo, 
            'Nocivo_P' => $Nocivo_P, 
            'Comentario_Precaucion' => $aux_prec, 'Concentracion_Precaucion' => $Concentracion_precaucion, 'Mortalidad' => $Mortalidad, 'Declarar' => $Fecha_semana );
			
			return Response::json($Resultado);
	
		}else{
			
			//Error al insertar
			$Resultado = array('Error' =>$error);
			return Response::json($Resultado);
			
		}

    }


    /*===================================================================================================================*/

    public function saveArchivoRegistro(Request $request)
    {
        $miuser = Auth::user();  
        $this->cambiar_bd($miuser->IDempresa);
        
        $error = 0;
        if($miuser->user_role_fan == 1 || $miuser->user_role_fan == 2){
            
        }else {
            return 'Acceso Restringido';
        }
        
        
        $file = $request->file('file'); //get the files
        $IDmedicion = $request->input('IDmedicion');
        
        
        if ($file != null && $IDmedicion!=null ){
            
            $contents = Storage::disk('local');		
            
            //foreach ($files as $file) {	
                    
                $extensionantes = $file->getClientOriginalExtension();
                
                $solo_nombre_antes = $file->getClientOriginalName();
                $solo_nombre_antes = str_replace('%20', ' ', $solo_nombre_antes);
                $nombre_storge_antes = $IDmedicion.'_'.$solo_nombre_antes;
                
                Storage::disk($miuser->IDempresa)->put('Archivos_Registros/'.$nombre_storge_antes,  File::get($file));
                
                //Agrega documento
                $documento = new Documento;
                $documento->IDmedicion = $IDmedicion;
                $documento->IDempresa = $miuser->IDempresa;
                $documento->tipo= "Archivos_Registros";
                $documento->titulo = $solo_nombre_antes;
                $documento->url = $nombre_storge_antes;
                $documento->extencion = $file->getClientOriginalExtension();
                $documento->mime = $file->getClientMimeType();
                $documento->estado = 1;
                $documento->save();
                
                //Actualiza Ingreso Registro
                /*$ingreso_registro = IngresoRegistro::find($IDmedicion);
                $ingreso_registro->Archivo = $documento->id;
                $ingreso_registro->save();*/
                
            //}
            $response = array(
            'status' => 'success',
            'msg' => 'Setting created successfully',
            'files' => $file
            );
        }else{
            $error = 1;
        }

        return Response::json($error);
    }

    /*===================================================================================================================*/

    public function destinatarioAlarma(Request $request)
    {
        $miuser = Auth::user();  
        $this->cambiar_bd($miuser->IDempresa);
		
		if($miuser->user_role == 1 || $miuser->user_role == 2){
			
		}else {
			return 'Acceso Restringido';
		}
		
		$error = 0;
		
		$user_id = $miuser->id;
		$Alarma = $request->input('Alarma');
		$IDcentro = $request->input('IDcentro');
		
		
		$correo1 = "";//"gtrfan@veterfish.com";
		$nombre1 = "";//"Administrador GTR fan";
		switch (true) {
			case stristr($Alarma,'Nivel'):
				$Alarmaval = "Alarma_Rojo";
				break;
			case stristr($Alarma,'Precauci'):
				$Alarmaval = "Alarma_Amarillo";
				break;
			case stristr($Alarma,'Presencia Microalgas'):
				$Alarmaval = "Alarma_Gris";
				//$correo1 = "";
				break;
			case stristr($Alarma,'Ausencia Microalgas'):
				$Alarmaval = "Alarma_Sin";
				//$correo1 = "";
				break;
		}
		
		if($correo1 == ""){
			
			$notificacion = Notificacion::where('IDempresa',$miuser->IDempresa)
										->where('IDcentro',$IDcentro)
										->where('Mail',1)
										->where('Estado',1)
										->where($Alarmaval,1)
										->select('id_user')
										->get();
			$user_aux = array();			
			foreach($notificacion as $val){
				if(!in_array($val->id_user, $user_aux)){
					array_push($user_aux, $val->id_user);
				}
			}
             
			$correos = User::whereIn('id', $user_aux)
								->where('IDempresa', $miuser->IDempresa)
								->where('fan', 1)
								->where('estado', 1)
								->where(
										function ($query) {
											$query->where('email', 'like', '%@%')  // Solo a los centros o centros terceros
											->orWhere('email2', 'like', '%@%');
										}
									)
								->select('email','email2','name')
								->get();							
										
			
			$Resultado = array();
			$Nombres_Destinatarios = array();
			if(count($correos)>0){
				foreach($correos as $val){
					if($val->email2 != ''){
						if(!in_array($val->email2, $Resultado)){
							$Resultado[] = $val->email2;
						}
					}else{
						if(!in_array($val->email, $Resultado)){
							$Resultado[] = $val->email;
						}
						
					}
					$Nombres_Destinatarios[] = $val->name;
				}
				
			}
		
		}else{
			$Resultado[] = $correo1;
			$Nombres_Destinatarios[] = $nombre1;		
		}
		
		$centro = Centro::find($IDcentro);
		if($centro){
			$Nombre_Centro = $centro->Nombre;
		}else{
			$Nombre_Centro = '';
		}	
		if(empty($Nombres_Destinatarios)){$Nombres_Destinatarios = "";}
		
		$response = array(
							'Destinatarios' => $Resultado,
							'Nombres_Destinatarios' => $Nombres_Destinatarios,
							'Nombre_Centro' => $Nombre_Centro,
							'Error' => $error
						);
		return Response::json($response);
		
	}

    /*===================================================================================================================*/

    public function sendAlarma(Request $request)
    {
        $miuser = Auth::user();  
        $this->cambiar_bd($miuser->IDempresa);
        
        if($miuser->user_role == 1 || $miuser->user_role == 2){
            
        }else {
            return 'Acceso Restringido';
        }
        
        $error = 0;
        
        $i = $request->input('user_id');
        $m = $request->input('idmed');
        $Alarma = $request->input('Alarma');
        $Comentario = $request->input('Comentario');
        $Comentario_Precaucion = $request->input('Comentario_Precaucion');
        if($request->input('Concentracion')){$Concentracion = $request->input('Concentracion');}
        else{
            $Concentracion[0] = '';
        }
      
        $Concentracion_Precaucion = $request->input('Concentracion_Precaucion');
        if($request->input('Nocivo')){$Nocivo = $request->input('Nocivo');}
        else{
            $Nocivo[0] = '';
        }
        
        $Nocivo_P = $request->input('Nocivo_P');
        $Mortalidad = $request->input('Mortalidad');
        $Dia = $request->input('Dia');
        $Hora = $request->input('Hora');
        $Firma = $request->input('Firma');
        $Nombre_Centro = $request->input('Nombre_Centro');
        $IDcentro = $request->input('IDcentro');
        $Destinatarios = $request->input('Destinatarios');
        $email_aux = $Destinatarios;

            //	$m = 69; 
            //	$i= 7;
            
        //Eliminar pdf anterior
        /*if(file_exists($m.'-'.$IDcentro.'---.pdf')){
            unlink($m.'-'.$IDcentro.'---.pdf'); 
        }
        
        
        //Crear pdf	
        shell_exec('wkhtmltopdf --disable-smart-shrinking --no-outline --page-size A3 --margin-top 2mm --margin-bottom 0mm --margin-right 0mm --margin-left 0mm "http://fan.veterfish.com/pdf_alarma_registro_beta.php?i='.$i.'&m='.$m.'&a='.$Alarma.'" --javascript-delay 2000 '.$m.'-'.$IDcentro.'---.pdf');*/
        
        
        
        $asunto_mortalidad = '';
        if($Mortalidad == 'Si'){$asunto_mortalidad = ' | Mortalidad';}
        $asunto = 'Alarma: '.$Alarma.' | '.$Nombre_Centro.$asunto_mortalidad.' | '.$Comentario ;
        $aux = "la siguiente alarma";
        $titulo = 'Alarma Activada';
        $unidades = '[cel/ml]';
        $nocivo_aux = '( Nivel Nocivo: ';
        $unidades_nocivo = '[cel/ml] )';
        
        
        if($Alarma == "Presencia Microalgas"){
            $asunto = $Alarma.' | '.$Nombre_Centro.$asunto_mortalidad ;
            $aux = "el siguiente registro";
            $titulo = 'Registro';
            $Alarma = 'Presencia Microalgas';
            $Comentario = 'Ver pdf Adjunto';
            $unidades = '';
            $nocivo_aux = '';
            $unidades_nocivo = '';
        }else if($Alarma == "Ausencia Microalgas"){
            $asunto = $Alarma.' | '.$Nombre_Centro.$asunto_mortalidad ;
            $aux = "el siguiente registro";
            $titulo = 'Registro';
            $Alarma = 'Ausencia Microalgas';
            $Comentario = 'Ausencia Microalgas';
            $unidades = '';
            $nocivo_aux = '';
            $unidades_nocivo = '';
        }
        
        //crear tabla alarma
        $com = array();
        $com = explode(", ", $Comentario);
        if($Nocivo[0] > 0){$unidades_nocivo = '[cel/ml] )';
        }else if($Alarma == "Ausencia Microalgas" || $Alarma == "Presencia Microalgas"){$unidades_nocivo = ''; $Nocivo[0] = '';
        }else {$unidades_nocivo = ' definido)'; $Nocivo[0] = 'No';}
        $tablaespecie = '<tr style="border: 1px solid black; height:33px; margin-left:55px;">
                            <td><b>&nbsp; Especie '.$Alarma.'</b></td>
                            <td>:</td>
                            <td>'.$com[0].'</td>
                            <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                            <td align="right">'.$Concentracion[0].'</td>
                            <td>'.$unidades.'</td>
                            <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                            <td> '.$nocivo_aux.' </td>
                            <td align="right">'.$Nocivo[0].'</td>
                            <td>'.$unidades_nocivo.'</td>
                            
                            
                        </tr>';
                                
        for($i=1;$i<count($com);$i++){
            if($Nocivo[$i] > 0){$unidades_nocivo = '[cel/ml] )';
            }else if($Alarma == "Ausencia Microalgas" || $Alarma == "Presencia Microalgas"){$unidades_nocivo = ''; $Nocivo[$i] = '';
            }else{$unidades_nocivo = ' definido)'; $Nocivo[$i] = 'No';}
            $tablaespecie .= 	'<tr style="border: 1px solid black; height:33px; margin-left:55px;">
                                    <td></td>
                                    <td></td>
                                    <td>'.$com[$i].'</td>
                                    <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                                    <td align="right">'.$Concentracion[$i].'</td>
                                    <td>[cel/ml]</td>
                                    <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                                    <td> '.$nocivo_aux.' </td>
                                    <td align="right">'.$Nocivo[$i].'</td>
                                    <td>'.$unidades_nocivo.'</td>
                                </tr>';
        }
        
        if($Comentario_Precaucion != ""){
            $com = array();
            $com = explode(", ", $Comentario_Precaucion);
            if($Nocivo_P[0] > 0){$unidades_nocivo = '[cel/ml] )';
            }else if($Alarma == "Ausencia Microalgas" || $Alarma == "Presencia Microalgas"){$unidades_nocivo = ''; $Nocivo_P[0] = '';
            }else{$unidades_nocivo = ' definido)'; $Nocivo_P[0] = 'No';}
            $tablaespecie .= '<tr style="border: 1px solid black; height:33px; margin-left:55px;">
                                <td><b>&nbsp; Especie Nivel Precaución</b></td>
                                <td>:</td>
                                <td>'.$com[0].'</td>
                                <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                                <td align="right">'.$Concentracion_Precaucion[0].'</td>
                                <td>[cel/ml]</td>
                                <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                                <td> '.$nocivo_aux.' </td>
                                <td align="right">'.$Nocivo_P[0].'</td>
                                <td>'.$unidades_nocivo.'</td>
                                
                            </tr>';
                                    
            for($i=1;$i<count($com);$i++){
                if($Nocivo_P[$i] > 0){$unidades_nocivo = '[cel/ml] )';
                }else if($Alarma == "Ausencia Microalgas" || $Alarma == "Presencia Microalgas"){$unidades_nocivo = ''; $Nocivo_P[$i] = '';
                }else{$unidades_nocivo = ' definido)'; $Nocivo_P[$i] = 'No';}
                $tablaespecie .= 	'<tr style="border: 1px solid black; height:33px; margin-left:55px;">
                                        <td></td>
                                        <td></td>
                                        <td>'.$com[$i].'</td>
                                        <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                                        <td align="right">'.$Concentracion_Precaucion[$i].'</td>
                                        <td>[cel/ml]</td>
                                        <td>  &nbsp;&nbsp;&nbsp;&nbsp;  </td>
                                        <td> '.$nocivo_aux.' </td>
                                        <td align="right">'.$Nocivo_P[$i].'</td>
                                        <td>'.$unidades_nocivo.'</td>
                                    </tr>';
            }
        }
        
        
        
        //$emails = "gtremisiones@veterfish.com";
        Mail::send('emails.send-registro', ['aux' =>  $aux, 
                    'Alarma' => $Alarma, 
                    'Nombre_Centro' => $Nombre_Centro, 
                    'titulo' => $titulo,
                    'Mortalidad'=> $Mortalidad,
                    'Dia' =>$Dia,
                    'Hora' => $Hora, 
                    'tablaespecie' => $tablaespecie], 
                    function ($message) use ($email_aux,$asunto)
                        {

                            $message->from('gtrfan@veterfish.com', 'GTR FAN');
                            
                            $message->to($email_aux );
                            /*if($responder_a != ""){
                                $message->replyTo($responder_a, $nombre_responder);
                            }*/
                            $message->subject($asunto);
                
            });
            
        
        //Save Historial Envios
        $hitorial = new HistorialEmail; 
        $hitorial->id_empresa = $miuser->IDempresa;
        $hitorial->id_ingreso_registro = $m;
        $hitorial->tipo = 'Ingreso';
        $hitorial->fecha_envio = new \DateTime(); 
        if(count($email_aux)>0){
            $hitorial->email_para = implode (";", $email_aux);
        }else{
            $hitorial->email_para = '';
        }
        /*if(count($email_cc_aux)>0){
            $hitorial->email_cc = implode (";", $email_cc_aux_limpio);
        }else{*/
            $hitorial->email_cc = '';
        //}
        $hitorial->asunto = $asunto;
        $hitorial->detalle = $Alarma;
        $hitorial->save();	
        
        
        
        return Response::json($m.'-'.$IDcentro.'---.pdf');
        
    }


    /*===================================================================================================================*/

    public function loadHistorialCentrosPDF(Request $request)
    {
        $miuser = Auth::user();  
        $this->cambiar_bd($miuser->IDempresa);
        
        $error = 0;
        $IDcentro = $request->input('IDcentro');
        $IDmedicion = $request->input('IDmedicion');		
        if($request->input('Especies_1')){
            $Especies_1 = $request->input('Especies_1');
        }else{$Especies_1 = array();}
        if($request->input('Especies_2')){
            $Especies_2 = $request->input('Especies_2');
        }else{$Especies_2 = array();}
        if($request->input('Especies_21')){
            $Especies_21 = $request->input('Especies_21');
        }else{$Especies_21 = array();}
        if($request->input('Especies_3')){
            $Especies_3 = $request->input('Especies_3');
        }else{$Especies_3 = array();}
        date_default_timezone_set('america/santiago');
        
        //Buscar fecha de la medicion y ver ultima semana
        $fecha_query = Medicion::find($IDmedicion);
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
                
            return Response::json($Resultado);	
        
        
    }


    /*===================================================================================================================*/

    public function searchEspecieRegistro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        // $table = "especie";
        // $error = 0;		
        
        //get search term
        // $searchTerm = $_GET['term'];
        // $user_id = $_GET['user_id'];
        $searchTerm = $request->input('term');
        $user_id = $request->input('user_id');
        
        // //get matched data from skills table
        $consulta = Especie::where('Nombre', 'like', '%'.$searchTerm.'%')
                                ->where([
                                    ['Estado', 1],
                                    ['IDempresa', $miuser->IDempresa]
                                    ])
                                ->select('Nombre')
                                ->orderBy('Nombre', 'ASC')
                                ->get();
        
        // DB::select("SELECT Nombre FROM gtr_especie WHERE Nombre LIKE '%".$searchTerm."%' 
        //                         AND Estado = 1  AND IDempresa = (SELECT IDempresa FROM gtr_users WHERE user_id = '$user_id') ORDER BY Nombre ASC");
        // $query = $con->query("SELECT Nombre FROM $table WHERE Nombre LIKE '%".$searchTerm."%' 
        //AND Estado = 1  AND IDempresa = (SELECT IDempresa FROM as_users WHERE user_id = '$user_id') ORDER BY Nombre ASC");
        // $data = array();
        // while ($row = $query->fetch_assoc()) {
        //     $data[] = $row['Nombre'];
        // }
        $data = array();
        foreach ($consulta as $row) {
            $data[] = $row->Nombre;
        }
        
        // //return json data
        // echo json_encode($data);
        return Response::json($data);
    }


    /*===================================================================================================================*/

    public function cargaRegistroAutomatico(Request $request)//comparar con el de laravel 5 
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        include_once "conexion.php";
        set_time_limit(600);
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting( E_ALL | E_STRICT);ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting( E_ALL | E_STRICT);

        // 	$error = 0;

        // 	$user_id = $_POST['user_id'];
        // 	$Firma = $_POST['Firma'];
        // 	$Codigo = $_POST['Codigo'];
        // 	$existeregistro = $_POST['Existe_Registro'];
        // 	$Tecnica = "";
        $user_id = $request->input('user_id');
        $Firma = $request->input('Firma');
        $Codigo = $request->input('Codigo');
        $existeregistro = $request->input('Existe_Registro');
        $Tecnica = "";

                                /*Revisar donde se agregar, si al principio del archivo o aqui en la funcion*/
        /////////////////////  	require_once ("spout/src/Spout/Autoloader/autoload.php");           /////////////////////////
        ///////////////////// 	use Box\Spout\Reader\ReaderFactory;         /////////////////////////
        ///////////////////// 	use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;            /////////////////////////
        ///////////////////// 	use Box\Spout\Common\Type;          /////////////////////////
        


         	$Nombre_Especie = array();

        /*function eliminacomas($string2){
        	//Elimina la estupidez
        	$string = $string2;
        	$length = 0;
        	for ($i=0; $i<strlen($string); $i++) {
        			if($string[$i] > 0 || $string[$i] == "," || $string[$i] === "0"){
        				$length++;
        			}
        	}
        	if(strpos($string,",")>0){
        		$decimal_part = $length - strripos($string,",");
        	  	if( $decimal_part < 4 ){
        		 	$string = str_replace(',', '',substr($string, 0, -( $decimal_part + ( strlen($string)-$length ) )).".".substr($string,  -$decimal_part+1-(strlen($string)-$length)  ));
        	   	}else{
        		   	$string = str_replace(',', '',$string);
        		}
        	}
        	return $string;
        }*/
        function eliminacomas($num) {
            $dotPos = strrpos($num, '.');
            $commaPos = strrpos($num, ',');
            $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
                ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

            if (!$sep) {
                return floatval(preg_replace("/[^0-9]/", "", $num));
            }

            return floatval(
                preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
                preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
            );
        }
        	$formato = "Externo";
        	$version = 0;
        	// check file name is not empty
        if (!empty($_FILES['file']['name'])) {


            // Get File extension eg. 'xlsx' to check file is excel sheet
            $pathinfo = pathinfo($_FILES["file"]["name"]);


            // check file has extension xlsx, xls and also check
            // file is not empty9
           if (($pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xlsm' ) && $_FILES['file']['size'] > 0 ) {

        		$reader = ReaderFactory::create(Type::XLSX); // for XLSX files
        		//$reader = ReaderEntityFactory::createReaderFromFile(".xlsx");
        		//$reader = ReaderFactory::create(Type::CSV); // for CSV files
        		//$reader = ReaderFactory::create(Type::ODS); // for ODS files

                // Temporary file name
                $inputFileName = $_FILES['file']['tmp_name'];


        		$reader->open($inputFileName);

        		$trow = 1;
        		$formato_version_agrega1 = 0;

        		foreach ($reader->getSheetIterator() as $sheet) {



        			if ($sheet->getIndex() === 0) {
        				$arreglo =$sheet->getRowIterator();



        				foreach ($arreglo as $row) {


        					if($trow == 2 ){
        						if($row['18'] == "2a13sFNdlBlDFRsj1bsGvKdLIe9NBXap1oumU9lT1zMqkhN.DJGJXgfxW"){
        							$formato = "Interno";
        							$version = 0;
        						}
        						if($row['18'] == "2a13sFNdlBlDFRsj1bsGvKdLIe9NBXap1oumU7lT1zMqkhN.DJGJXgfxW"){
        							$formato = "Interno";
        							$version = 1;
        						}
        					}else if($trow == 3){
        						if($row['18'] == "2a13sFNdlBlDFRsj1bsGvKdLIe9NBXap1oumU7lT1zMqkhN.DJGJXgfxW"){
        							$formato = "Interno";
        							$version = 2; //Suma una fila más por que se agrego el numero de version en la fila1 del excel y eso hizo que se corra todo en +1
        						}
        					}
        					$trow++;

        				}
        			}

        		}







        		if($formato == "Externo"){
        			$totalrow = 0;
        			$finfito = 10000000;
        			foreach ($reader->getSheetIterator() as $sheet) {
        				if ($sheet->getIndex() === 0) {
        					foreach ($sheet->getRowIterator() as $row) {

        						if($row['0'] == "Observaciones:"){ $finfito = $totalrow;}
        						if($totalrow == 8){
        									$IDcentro_siep = str_replace(chr( 194 ) . chr( 160 ), '',$row['5']);
        									$IDcentro_siep = str_replace(' ', '',$IDcentro_siep);
        						}else
        						if($totalrow == 11){
        									$Fecha_Medicion = date_format($row[1],'Y-m-d');
        									$Fecha_Analisis = date_format($row[5],'Y-m-d');
        						}else
        						if($totalrow == 12){
        									//$Hora_Medicion = $row['1'];
        									$fecha =date_format($row[5],'Y-m-d');
        						}else
        						if($totalrow == 13){
        									$Disco = str_replace("'",chr(34),$row['1']);
        									$Conducta_Peces = str_replace("'",chr(34),$row['3']);
        						}else
        						if($totalrow == 16){
        									$Temperatura_1 = str_replace(",",".",$row['1']);
        									$Temperatura_2 = str_replace(",",".",$row['2']);
        									$Temperatura_3 = str_replace(",",".",$row['3']);
        									$Temperatura_4 = str_replace(",",".",$row['4']);
        						}else
        						if($totalrow == 17){
        									$Salinidad_1 = str_replace(",",".",$row['1']);
        									$Salinidad_2 = str_replace(",",".",$row['2']);
        									$Salinidad_3 = str_replace(",",".",$row['3']);
        									$Salinidad_4 = str_replace(",",".",$row['4']);
        						}else
        						if($totalrow == 18){
        									$o2_mg_1 = str_replace(",",".",$row['1']);
        									$o2_mg_2 = str_replace(",",".",$row['2']);
        									$o2_mg_3 = str_replace(",",".",$row['3']);
        									$o2_mg_4 = str_replace(",",".",$row['4']);
        						}else
        						if($totalrow == 19){
        									$o2_percent_1 = str_replace(",",".",$row['1']);
        									$o2_percent_2 = str_replace(",",".",$row['2']);
        									$o2_percent_3 = str_replace(",",".",$row['3']);
        									$o2_percent_4 = str_replace(",",".",$row['4']);
        						}else
        						if($totalrow > 20   && $totalrow < $finfito
        											&& $row['0'] != ""
        											&& $row['0'] != "Sub Total"
        											&& $row['0'] != "DIATOMEAS"
        											&& $row['0'] != "PROTOZOA"
        											&& $row['0'] != "ZOOPLANCTON"
        											&& $row['0'] != "DINOFLAGELADOS"
        											&& $row['0'] != "OTROS GRUPOS"
        											&& $row['0'] != "DICTYOCOFICEAS"
        											&& $row['0'] != "CRIPTOFICEAS"
        											&& $row['0'] != "CRISOFICEAS"
        											&& $row['0'] != "EUGLENOFICEAS"
        											&& $row['0'] != "RAFIDOFICEAS"
        											&& $row['0'] != "FITOPLANCTON TOTAL"
        											&& $row['0'] != "ZOOPLANCTON TOTAL"
        											&&
        											($row['1'] != "" || $row['2'] != "" || $row['3'] != "" || $row['4'] != "")
        											){

        									$espaux = str_replace("'",chr(34),$row['0']);
        									if(strpos($espaux,"(C") === false){
        										//$Nombre_Especie[] = $espaux;
        									}else{
        										$nelimina = (strlen($espaux) - strpos($espaux,"(C")+1)*-1;
        										$espaux = substr($espaux, 0, $nelimina);
        									}
        									if($row['1']){
        									$med1 = eliminacomas($row['1']);
        									}else{$med1 = "";}
        									if($row['2']){
        									$med2 = eliminacomas($row['2']);
        									}else{$med2 = "";}
        									if($row['3']){
        									$med3 = eliminacomas($row['3']);
        									}else{$med3 = "";}
        									if($row['4']){
        									$med4 = eliminacomas($row['4']);
        									}else{$med4 = "";}
        									$Nombre_Especie[] = array(
        													'Nombre' => $espaux,
        													'Medicion1' => eliminacomas($row['1']),
        													'Medicion2' => eliminacomas($row['2']),
        													'Medicion3' => eliminacomas($row['3']),
        													'Medicion4' => eliminacomas($row['4']),
        													);
        						}else
        						if (strpos($row['0'], 'Método Cuantitativo Utilizado:') !== false) {
        									$Tecnica = str_replace('Método Cuantitativo Utilizado: ','',$row['0']);
        						}

        						$totalrow++;
        					}
        				}
        			}

        		/////////////////
        		//Formato Interno
        		/////////////////
        		}else if ($formato == "Interno"){
        			$totalrow = 1;
        			$finfito = 200;
        			date_default_timezone_set('america/santiago');
        			$fecha=date('Y-m-d H:i:s');
        			foreach ($reader->getSheetIterator() as $sheet) {
        				if ($sheet->getIndex() === 0) {
        					foreach ($sheet->getRowIterator() as $row) {

        						if($totalrow == (2 + $version) ){
        									$IDcentro_siep = str_replace(chr( 194 ) . chr( 160 ), '',$row['3']);
        									$IDcentro_siep = str_replace(' ', '',$IDcentro_siep);
        									$Tecnica = str_replace("'",chr(34),$row['5']);
        						}else
        						if($totalrow == (3 + $version) ){
        									if($row[3] != ""){
        										$Fecha_Medicion = date_format($row[3],'Y-m-d');
        									}else{$Fecha_Medicion = "";}
        									$Observaciones = str_replace("'",chr(34),$row['5']);
        						}else
        						if($totalrow == (4 + $version) ){
        									if($row[3] != ""){
        										$hora_med = date_format($row[3],'H:i:s');
        									}else{$hora_med = "00:00:00";}
        									if($Fecha_Medicion != "" ){
        										$Fecha_Medicion = date('Y-m-d H:i:s', strtotime("$Fecha_Medicion $hora_med"));
        									}
        						}else
        						if($totalrow == (5 + $version) ){
        									if($row[3] != ""){
        										$Fecha_Analisis = date_format($row[3],'Y-m-d');
        									}else{$Fecha_Analisis = "";}
        						}else
        						if($totalrow == (6 + $version) ){
        									if($row[3] != ""){
        										$hora_analisis = date_format($row[3],'H:i:s');
        									}else{$hora_analisis = "00:00:00";}
        									if($Fecha_Analisis != "" ){
        										$Fecha_Analisis = date('Y-m-d H:i:s', strtotime("$Fecha_Analisis $hora_analisis"));
        									}
        						}else
        						if($totalrow == (9 + $version) ){
        									 $Conducta_Peces = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (10 + $version) ){
        									$Peso = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (11 + $version) ){
        									$Color = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (12 + $version) ){
        									$Disco = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (13 + $version) ){
        									$Espuma = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (14 + $version) ){
        									$Estado_mar = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (15 + $version) ){
        									$Marea = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (16 + $version) ){
        									$Medusas = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (17 + $version) ){
        									$Transparencia = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (18 + $version) ){
        									$Cielo = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (19 + $version) ){
        									$Precipitacion = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (20 + $version) ){
        									$Direccion_viento = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (21 + $version) ){
        									$Intensidad_viento = str_replace("'",chr(34),$row['2']);
        						}else
        						if($totalrow == (24 + $version) ){
        									$o2_percent_1 = str_replace(",",".",$row['2']);
        									$o2_percent_2 = str_replace(",",".",$row['3']);
        									$o2_percent_3 = str_replace(",",".",$row['4']);
        									$o2_percent_4 = str_replace(",",".",$row['5']);
        									$o2_percent_5 = str_replace(",",".",$row['6']);
        									$o2_percent_6 = str_replace(",",".",$row['7']);
        									$o2_percent_7 = str_replace(",",".",$row['8']);
        						}else
        						if($totalrow == (25 + $version) ){
        									$o2_mg_1 = str_replace(",",".",$row['2']);
        									$o2_mg_2 = str_replace(",",".",$row['3']);
        									$o2_mg_3 = str_replace(",",".",$row['4']);
        									$o2_mg_4 = str_replace(",",".",$row['5']);
        									$o2_mg_5 = str_replace(",",".",$row['6']);
        									$o2_mg_6 = str_replace(",",".",$row['7']);
        									$o2_mg_7 = str_replace(",",".",$row['8']);
        						}else
        						if($totalrow == (26 + $version) ){
        									$Salinidad_1 = str_replace(",",".",$row['2']);
        									$Salinidad_2 = str_replace(",",".",$row['3']);
        									$Salinidad_3 = str_replace(",",".",$row['4']);
        									$Salinidad_4 = str_replace(",",".",$row['5']);
        									$Salinidad_5 = str_replace(",",".",$row['6']);
        									$Salinidad_6 = str_replace(",",".",$row['7']);
        									$Salinidad_7 = str_replace(",",".",$row['8']);
        						}else
        						if($totalrow == (27 + $version) ){
        									$Temperatura_1 = str_replace(",",".",$row['2']);
        									$Temperatura_2 = str_replace(",",".",$row['3']);
        									$Temperatura_3 = str_replace(",",".",$row['4']);
        									$Temperatura_4 = str_replace(",",".",$row['5']);
        									$Temperatura_5 = str_replace(",",".",$row['6']);
        									$Temperatura_6 = str_replace(",",".",$row['7']);
        									$Temperatura_7 = str_replace(",",".",$row['8']);
        						}else
        						if($totalrow >= (29 + $version)   && $totalrow <= $finfito && $row['1'] != "" &&  ($row['2'] >= 0 || $row['3'] >= 0 || $row['4'] >= 0 || $row['5'] >= 0 || $row['6'] >= 0 || $row['7'] >= 0 || $row['8'] >= 0) ){


        									if($row['2'] >= 0){$med1 = $row['2'];}else{$med1 = "";}
        									if($row['3'] >= 0){$med2 = $row['3'];}else{$med2 = "";}
        									if($row['4'] >= 0){$med3 = $row['4'];}else{$med3 = "";}
        									if($row['5'] >= 0){$med4 = $row['5'];}else{$med4 = "";}
        									if($row['6'] >= 0){$med5 = $row['6'];}else{$med5 = "";}
        									if($row['7'] >= 0){$med6 = $row['7'];}else{$med6 = "";}
        									if($row['8'] >= 0){$med7 = $row['8'];}else{$med7 = "";}

        									$Nombre_Especie[] = array(
        													'Nombre' => $row['1'],
        													'Medicion1' => $med1,
        													'Medicion2' => $med2,
        													'Medicion3' => $med3,
        													'Medicion4' => $med4,
        													'Medicion5' => $med5,
        													'Medicion6' => $med6,
        													'Medicion7' => $med7,
        													);
        						}

        						$totalrow++;
        					}
        				}
        			}
        		}


         		$reader->close();

        	}else
        	if ($pathinfo['extension'] == 'xls' && $_FILES['file']['size'] > 0 ) {

        		require_once("Classes/PHPExcel.php");
        		$tmpfname = $_FILES['file']['tmp_name'];
        		 libxml_use_internal_errors(true);
        		$excelReader = PHPExcel_IOFactory::createReaderForFile($tmpfname);
        		$excelObj = $excelReader -> load($tmpfname);
        		$worksheet0 = $excelObj -> getSheet(0);
        		$objHoja= $worksheet0 -> toArray(null,true,true,true);
        		$lastrow0 = $worksheet0 -> getHighestRow();


        //		$n = 1;
        //	for($row = 2; $row <= $lastrow0; $row++){
        //		$nose = $worksheet0 -> getCell('A'.$row) -> getValue();
        //		if($nose == "FITOPLANCTON TOTAL "){
        //			//$Cantidad[] = $worksheet0 -> getCell('C'.$row) -> getValue();
        //			echo json_encode($worksheet0 -> getCell('A'.$row) -> getValue());
        //		}
        //	}

        		//echo json_encode("salio");
        		$totalrow = 0;
        		$finfito = 10000000;
        		$resultados = 23;
        		foreach ($objHoja as $row) {
        					//echo json_encode($row['A']);
        					if($row['A'] == "Observaciones: " || $row['A'] == "Observaciones:"){ $finfito = $totalrow;}
        					if($row['A'] == "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL) " || $row['A'] == "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL)"){ $resultados = $totalrow;}
        					if($totalrow == 8){
        					 			$IDcentro_siep = str_replace(chr( 194 ) . chr( 160 ), '',$row['F']);
        								$IDcentro_siep = str_replace(' ', '',$IDcentro_siep);
        					}else
        					if($totalrow == 11){
        								$fecha_med_aux = new DateTime($row['B']);
        							  	$Fecha_Medicion = date_format($fecha_med_aux,'Y-m-d');
        								$fecha_ana_aux = new DateTime($row['F']);
        							 	$Fecha_Analisis = date_format($fecha_ana_aux,'Y-m-d');
        					}else
        					if($totalrow == 12){
        								//$Hora_Medicion = $row['B'];
        								$fecha_aux = new DateTime($row['F']);
        								$fecha = date_format($fecha_aux,'Y-m-d');
        					}else
        					if($totalrow == 13){
        								$Disco = str_replace("'",chr(34),$row['B']);
        								$Conducta_Peces = str_replace("'",chr(34),$row['D']);
        					}else
        					if($row['A'] == "Temperatura(ºC)" || $row['A'] == "Temperatura(ºC) " || $row['A'] == "Temperatura(C)" || $row['A'] == "Temperatura(C) "){//$totalrow == 20){
        								$Temperatura_1 = str_replace(",",".",$row['B']);
        								$Temperatura_2 = str_replace(",",".",$row['C']);
        								$Temperatura_3 = str_replace(",",".",$row['D']);
        								$Temperatura_4 = str_replace(",",".",$row['E']);
        								if(isset($row['F'])){
        								$Temperatura_5 = str_replace(",",".",$row['F']);
        								}else{$Temperatura_5 = "";}
        								if(isset($row['G'])){
        								$Temperatura_6 = str_replace(",",".",$row['G']);
        								}else{$Temperatura_6 = "";}
        								if(isset($row['H'])){
        								$Temperatura_7 = str_replace(",",".",$row['H']);
        								}else{$Temperatura_7 = "";}
        					}else
        					if($row['A'] == "Salinidad (ppmil)" || $row['A'] == "Salinidad (ppmil) "){//if($totalrow == 21){
        								$Salinidad_1 = str_replace(",",".",$row['B']);
        								$Salinidad_2 = str_replace(",",".",$row['C']);
        								$Salinidad_3 = str_replace(",",".",$row['D']);
        								$Salinidad_4 = str_replace(",",".",$row['E']);
        								if(isset($row['F'])){
        									$Salinidad_5 = str_replace(",",".",$row['F']);
        								}else{$Salinidad_5 = "";}
        								if(isset($row['G'])){
        									$Salinidad_6 = str_replace(",",".",$row['G']);
        								}else{$Salinidad_6 = "";}
        								if(isset($row['H'])){
        									$Salinidad_7 = str_replace(",",".",$row['H']);
        								}else{$Salinidad_7 = "";}
        					}else
        					if($row['A'] == "Oxigeno (mg/L)" || $row['A'] == "Oxigeno (mg/L) "){ //if($totalrow == 22){
        								$o2_mg_1 = str_replace(",",".",$row['B']);
        								$o2_mg_2 = str_replace(",",".",$row['C']);
        								$o2_mg_3 = str_replace(",",".",$row['D']);
        								$o2_mg_4 = str_replace(",",".",$row['E']);
        								if(isset($row['F'])){
        									$o2_mg_5 = str_replace(",",".",$row['F']);
        								}else{$o2_mg_5 = "";}
        								if(isset($row['G'])){
        									$o2_mg_6 = str_replace(",",".",$row['G']);
        								}else{$o2_mg_6 = "";}
        								if(isset($row['H'])){
        									$o2_mg_7 = str_replace(",",".",$row['H']);
        								}else{$o2_mg_7 = "";}
        					}else
        					if($row['A'] == "Oxigeno (% Sat.)" || $row['A'] == "Oxigeno (% Sat.) "){ //if($totalrow == 23){
        								$o2_percent_1 = str_replace(",",".",$row['B']);
        								$o2_percent_2 = str_replace(",",".",$row['C']);
        								$o2_percent_3 = str_replace(",",".",$row['D']);
        								$o2_percent_4 = str_replace(",",".",$row['E']);
        								if(isset($row['F'])){
        									$o2_percent_5 = str_replace(",",".",$row['F']);
        								}else{$o2_percent_5 = "";}
        								if(isset($row['G'])){
        									$o2_percent_6 = str_replace(",",".",$row['G']);
        								}else{$o2_percent_6 = "";}
        								if(isset($row['H'])){
        									$o2_percent_7 = str_replace(",",".",$row['H']);
        								}else{$o2_percent_7 = "";}
        					}else
        					if($totalrow > $resultados   && $totalrow < $finfito

        										&& $row['A'] != ""
        										&& $row['A'] != "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL) "
        										&& $row['A'] != "Sub Total "
        										&& $row['A'] != "DIATOMEAS "
        										&& $row['A'] != "PROTOZOA "
        										&& $row['A'] != "ZOOPLANCTON "
        										&& $row['A'] != "DINOFLAGELADOS "
        										&& $row['A'] != "OTROS GRUPOS "
        										&& $row['A'] != "DICTYOCOFICEAS "
        										&& $row['A'] != "CRIPTOFICEAS "
        										&& $row['A'] != "CRISOFICEAS "
        										&& $row['A'] != "EUGLENOFICEAS "
        										&& $row['A'] != "RAFIDOFICEAS "
        										&& strpos($row['A'], " TOTAL ") >= 0
        										&& $row['A'] != "FITOPLANCTON TOTAL "
        										&& $row['A'] != "ZOOPLANCTON TOTAL "

        										&& $row['A'] != "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL)"
        										&& $row['A'] != "Sub Total"
        										&& $row['A'] != "DIATOMEAS"
        										&& $row['A'] != "PROTOZOA"
        										&& $row['A'] != "ZOOPLANCTON"
        										&& $row['A'] != "DINOFLAGELADOS"
        										&& $row['A'] != "OTROS GRUPOS"
        										&& $row['A'] != "DICTYOCOFICEAS"
        										&& $row['A'] != "CRIPTOFICEAS"
        										&& $row['A'] != "CRISOFICEAS"
        										&& $row['A'] != "EUGLENOFICEAS"
        										&& $row['A'] != "RAFIDOFICEAS"
        										&& strpos($row['A'], " TOTAL") >= 0
        										&& $row['A'] != "FITOPLANCTON TOTAL"
        										&& $row['A'] != "ZOOPLANCTON TOTAL"
        										&&
        										($row['B'] >= 0 || $row['C'] >= 0 || $row['D'] >= 0 || $row['E'] >= 0 || $row['F'] >= 0 || $row['G'] >= 0 || $row['H'] >= 0 )
        										){
        								$espaux = str_replace("'",chr(34),$row['A']);
        								if(strpos($espaux,"(C") === false){
        									//$Nombre_Especie[] = $espaux;
        								}else{
        									$nelimina = (strlen($espaux) - strpos($espaux,"(C")+1)*-1;
        									$espaux = substr($espaux, 0, $nelimina);
        								}

        								if(isset($row['B'])){
        									//if($totalrow == 37){echo " -----> ";}
        								$med1 = eliminacomas($row['B']);
        									//if($totalrow == 37){echo " <----- ";}
        								}else{$med1 = "";}
        								if(isset($row['C'])){
        								$med2 = eliminacomas($row['C']);
        								}else{$med2 = "";}
        								if(isset($row['D'])){
        								$med3 = eliminacomas($row['D']);
        								}else{$med3 = "";}
        								if(isset($row['E'])){
        								$med4 = eliminacomas($row['E']);
        								}else{$med4 = "";}
        								if(isset($row['F'])){
        								$med5 = eliminacomas($row['F']);
        								}else{$med5 = "";}
        								if(isset($row['G'])){
        								$med6 = eliminacomas($row['G']);
        								}else{$med6 = "";}
        								if(isset($row['H'])){
        								$med7 = eliminacomas($row['H']);
        								}else{$med7 = "";}
        								$Nombre_Especie[] = array(
        												'Nombre' => $espaux,
        												'Medicion1' => $med1,
        												'Medicion2' => $med2,
        												'Medicion3' => $med3,
        												'Medicion4' => $med4,
        												'Medicion5' => $med5,
        												'Medicion6' => $med6,
        												'Medicion7' => $med7,
        												);
        								//echo json_encode(" row ".$totalrow." - ".$espaux);
        					}else{
        						//echo json_encode($row['A']);
        					if (strpos($row['A'], "Cuantitativo Utilizado:") !== false) {
        								$Tecnica = str_replace('Mtodo Cuantitativo Utilizado: ','',$row['A']);
        					}
        					}
        					//echo json_encode("fila: ".$totalrow." : ".$row['A']);
        					$totalrow++;
        				}

        		//$excelReader->disconnectWorksheets();
        		unset($excelReader,$excelObj);




        	} else {

                echo json_encode("Please Select Valid Excel File");
            }


        	//Rescatado del modal
        	if($Codigo != ""){$IDcentro_siep = $Codigo;}


         	//IDempresa usuario
          
        	$IDempresa = $miuser->IDempresa;




        // 	//Buscar IDcentro
            $consulta = Centro::where([
                                    ['Codigo', $IDcentro_siep],
                                    ['IDempresa', $IDempresa]
                                    ])
                                ->select(
                                    'IDcentro',
                                    'Nombre'
                                )
                                ->get();
            //DB::select("SELECT IDcentro,Nombre FROM centro WHERE Codigo = '$IDcentro_siep' AND IDempresa = '$IDempresa' ");
        



        	$IDcentro = null;
        	$Centro = null;
        	if ($consulta) {
        		$IDcentro = $consulta->IDcentro;
        		$Centro = $consulta->Nombre;
        	}


        	if($Firma == "Centro Cultivo (Medición Interna)" ){
        		$Laboratorio = 0;
        		$Firma = $Centro;
        	}else{
        		$Laboratorio = 1; //ver si es Interno o Externo
        	}



        	if($Fecha_Medicion != ""){
        		if($IDcentro){

        			//Chequear que no existan especie iguales
        			$array_especies_iguales = array();
        			$especie_iguales = '';
        			foreach($Nombre_Especie as $i => $Espvalue){
        				if($Espvalue){
        					if (in_array($Espvalue['Nombre'],$array_especies_iguales)) {
        						$especie_iguales = $Espvalue['Nombre'];
        						break;
        					}
        					$array_especies_iguales[] = $Espvalue['Nombre'];
        				}
        			}

        			if ($especie_iguales == '') {

        				//Chequear que la muestra no haya sido ingresada antes (ver fecha y hora)

        				$Fecha_Medicion_existe = date('Y-m-d H:i:s', strtotime($Fecha_Medicion));

                        $consulta = Medicion::where([
                                                    ['IDcentro', $IDcentro],
                                                    ['Fecha_Reporte', $Fecha_Medicion_existe]
                                                ])
                                                ->select('Fecha_Envio')
                                                ->get();
                        //DB::select("SELECT Fecha_Envio FROM gtr_medicion WHERE IDcentro = '$IDcentro' AND Fecha_Reporte = '$Fecha_Medicion_existe' ");
        				

        				$fecha_envio = 0;
        				while($consulta)
        				{
        					$fecha_envio = 1;
        				}

        				if ($fecha_envio == 0 || $existeregistro == 1) {

        					//Buscar Fechas Siembra, Cosecha y especie cultivada
                            $consulta = Centro::where('IDcentro', $IDcentro)
                                                    ->select('Especie','Siembra','Cosecha')
                                                    ->get();
                            //DB::select("SELECT Especie, Siembra, Cosecha FROM gtr_centro WHERE IDcentro = '$IDcentro' ");
        					

        					//$row = mysqli_fetch_assoc($consulta);
        					$Especie = $consulta->Especie;
        					$Siembra = $consulta->Siembra;
        					$Cosecha = $consulta->Cosecha;


        					//Insertar medicion
        					$Mortalidad = "";//$Medicion0_pambientalesotros[array_search($IDmortalidad, $IDpambientalesotros)];
        					if(!isset($Observaciones)){$Observaciones = "";}

                            $consulta = Medicion::insert([
                                                    'IDcentro' => $IDcentro,
                                                    'Fecha_Envio' => $fecha,
                                                    'Fecha_Reporte' => $Fecha_Medicion,
                                                    'Fecha_Analisis' => $Fecha_Analisis,
                                                    'Estado_Alarma' => 'Ausencia Microalgas',
                                                    'Tecnica' => $Tecnica,
                                                    'Observaciones' => $Observaciones,
                                                    'Mortalidad' => $Mortalidad,
                                                    'Especie' => $Especie,
                                                    'Siembra' => $Siembra,
                                                    'Cosecha' => $Cosecha,
                                                    'Firma' => $Firma,    
                                                    'Estado' => '1',
                                                    'Laboratorio' => 'Laboratorio',
                                                    'Tipo_Carga' => 'Planilla Excel'
                            

                            ]);                          
                                                                
        					// $consulta = mysqli_query($con,"INSERT INTO medicion(IDcentro,Fecha_Envio,Fecha_Reporte,Fecha_Analisis,Estado_Alarma,Tecnica,Observaciones,Mortalidad,Especie,Siembra,Cosecha,Firma,Estado,Laboratorio,Tipo_Carga) VALUES ('$IDcentro', '$fecha', '$Fecha_Medicion','$Fecha_Analisis','Ausencia Microalgas', '$Tecnica','$Observaciones','$Mortalidad', '$Especie', '$Siembra', '$Cosecha', '$Firma','1','$Laboratorio','Planilla Excel')")
        					// or die ( $error ="Error description 5: ".mysqli_error($consulta) );

        					$IDmedicion = mysqli_insert_id($consulta); /*----------------------------------REVISAR FUNCION --------------------------------------------- */

        					if($error == 0){
        						//Save Especies
        						$string = "";
        						if($Nombre_Especie != ""){
        							foreach($Nombre_Especie as $i => $Espvalue){
        								if($Espvalue){
        									$nombre_aux = $Espvalue['Nombre'];
        									$Medicion1 = $Espvalue['Medicion1'];
        									$Medicion2 = $Espvalue['Medicion2'];
        									$Medicion3 = $Espvalue['Medicion3'];
        									$Medicion4 = $Espvalue['Medicion4'];
        									if(isset($Espvalue['Medicion5'])){
        									$Medicion5 = $Espvalue['Medicion5'];}else{$Medicion5 = "";}
        									if(isset($Espvalue['Medicion6'])){
        									$Medicion6 = $Espvalue['Medicion6'];}else{$Medicion6 = "";}
        									if(isset($Espvalue['Medicion7'])){
        									$Medicion7 = $Espvalue['Medicion7'];}else{$Medicion7 = "";}

                                            $consulta1 = EspecieGeneral::where('Nombre', $nombre_aux)
                                                                            ->select('IDespecie_general')
                                                                            ->get();
                                            
                                            //DB::select("SELECT IDespecie_general FROM gtr_especie_general WHERE Nombre = '$nombre_aux' ");
        									
        									$IDespecie_general = null;
        									if ($consulta1) {
        										$IDespecie_general = $consulta1->IDespecie_general;
        									}


        									if($formato == "Externo"){
                                                $IDespecie_general_aux = EspecieEstandar::where([
                                                                                                ['Nombre', $nombre_aux],
                                                                                                ['IDempresa', $IDempresa]
                                                                                                ])
                                                                                            ->select('IDespecie_general')
                                                                                            ->first();

                                                $consulta = Especie::select(
                                                                        DB::raw("COALESCE(IDespecie,0) as id"),
                                                                        'Fiscaliza',
                                                                        'Nociva',
                                                                        'Nivel_Critico',
                                                                        'Alarma_Rojo',
                                                                        'Alarma_Amarillo'
                                                                            )
                                                                    ->where('IDespecie_general', $IDespecie_general_aux->IDespecie_general)
                                                                    ->orWhere('IDespecie_general', 
                                                                                function($query) use ($IDespecie_general, $IDempresa){
                                                                                    $query->where(
                                                                                            ['IDespecie_general', $IDespecie_general],
                                                                                            ['IDempresa', $IDempresa]);
                                                                                            })
                                                                    ->first();
                                                                                                                                   
                                                // DB::select("SELECT  COALESCE(IDespecie,0) as id, Fiscaliza,Nociva,Nivel_Critico,Alarma_Rojo,Alarma_Amarillo 
                                                //                                    FROM gtr_especie WHERE ( IDespecie_general = (SELECT IDespecie_general FROM gtr_especie_estandar WHERE Nombre = '$nombre_aux' 
                                                //                                    LIMIT 1) AND IDempresa = '$IDempresa') OR (IDespecie_general = '$IDespecie_general' AND IDempresa = '$IDempresa') LIMIT 1");
        										                           




        									}else if ($formato == "Interno"){   
                                                $consulta = Especie::select(
                                                                            DB::raw("COALESCE(IDespecie,0) as id"),
                                                                            'Fiscaliza',
                                                                            'Nociva',
                                                                            'Nivel_Critico',
                                                                            'Alarma_Rojo',
                                                                            'Alarma_Amarillo'
                                                                            )
                                                                        ->where('IDespecie_general', $IDespecie_general_aux->IDespecie_general)
                                                                        ->orWhere('IDespecie_general', 
                                                                                    function($query) use ($IDespecie_general, $IDempresa){
                                                                                        $query->where(
                                                                                                ['IDespecie_general', $IDespecie_general],
                                                                                                ['IDempresa', $IDempresa]);
                                                                                                })
                                                                        ->first();
        										// $consulta = mysqli_query($con,"(SELECT  COALESCE(IDespecie,0) as id, Fiscaliza,Nociva,Nivel_Critico,Alarma_Rojo,Alarma_Amarillo 
                                                //                                 FROM especie WHERE (IDespecie_general = (SELECT IDespecie_general FROM especie_estandar WHERE Nombre = '$nombre_aux' LIMIT 1) 
                                                //                                 AND IDempresa = '$IDempresa') OR (IDespecie_general = '$IDespecie_general' AND IDempresa = '$IDempresa') LIMIT 1)")
                                                //                                 or die ( $error ="Error description 6: " . mysqli_error($con) );
        									}

        									//$row = mysqli_fetch_assoc($consulta);

        									if (!$row) {  //Si no encuentra la especie,
        											 // pero si está en especie_general o especie_estandar. Se debe agregar al listado primero
                                                    $consulta2 = EspecieGeneral::where('IDespecie_general', $IDespecie_general)
                                                                                    ->orWhere('IDespecie_general', 
                                                                                                    function ($query) use ($nombre_aux){
                                                                                                        $query->table('especie_estandar')
                                                                                                                ->select('IDespecie_general')
                                                                                                                ->where('Nombre', $nombre_aux)
                                                                                                                ->limit(1);
                                                                                                    })
                                                                                    ->select('IDespecie_general',
                                                                                                'Imagen',
                                                                                                'Detalle',
                                                                                                'Grupo',
                                                                                                'Nivel_Critico',
                                                                                                'Nombre')
                                                                                    ->get();
                                                                                    
                                                    // DB::select("SELECT IDespecie_general,
                                                    //                                     Imagen,
                                                    //                                     Detalle,
                                                    //                                     Grupo,
                                                    //                                     Nivel_Critico,
                                                    //                                     Nombre 
                                                    //                         FROM gtr_especie_general 
                                                    //                         WHERE IDespecie_general = '$IDespecie_general' 
                                                    //                         OR IDespecie_general = (SELECT IDespecie_general FROM gtr_especie_estandar WHERE Nombre = '$nombre_aux' LIMIT 1) ");
        											

        											foreach($consulta2 as $row2)
        											{
        												$IDespecie_general = $row2->especie_general;
        												$Nombre1 = $row2->Nombre;
        												$Imagen1 = $row2->Imagen;
        												$Detalle1 = $row2->Detalle;
        												$Grupo1 = $row2->Grupo;
        												$Nivel_Critico1 = $row2->Nivel_Critico;
        												$Nivel_Critico1 = ($Nivel_Critico1==0)? 'NULL' : "'$Nivel_Critico1'";
        											}

        											if ($IDespecie_general) {
                                                        $consulta3 = Especie::insert([
                                                                                    'IDempresa'=>   $IDempresa,
                                                                                    'IDespecie_general'=> $IDespecie_general,
                                                                                    'Nombre'=> $Nombre1,
                                                                                    'Grupo'=> $Grupo1,
                                                                                    'Imagen'=> $Imagen1,
                                                                                    'Detalle'=>$Detalle1,
                                                                                    'Nivel_Critico'=> $Nivel_Critico1,
                                                                                    'Estado'=> '1'
                                                                                ]);
                                                      

        												// $consulta3 = mysqli_query($con,"INSERT INTO especie(IDempresa,IDespecie_general,Nombre,Grupo,Imagen,Detalle,Nivel_Critico,Estado) 
                                                        //VALUES ('$IDempresa', '$IDespecie_general', '$Nombre1', '$Grupo1', '$Imagen1', '$Detalle1', $Nivel_Critico1,'1')")
        												// 	or die ( $error ="Error description3: " . mysqli_error($con) );

                                                        $consulta4 = Especie::where(
                                                                                    ['IDespecie_general', $IDespecie_general],
                                                                                    ['IDempresa', $IDempresa],
                                                                                    ['Grupo', $Grupo1])
                                                                                ->select(
                                                                                    DB::raw("COALESCE(IDespecie,0) as id"),
                                                                                    'Fiscaliza',
                                                                                    'Nociva',
                                                                                    'Nivel_Critico',
                                                                                    'Alarma_Rojo',
                                                                                    'Alarma_Amarillo'
                                                                                )
                                                                                ->get();

   
        												// $consulta4 = mysqli_query($con,"SELECT COALESCE(IDespecie,0) as id, Fiscaliza,Nociva,Nivel_Critico,Alarma_Rojo,Alarma_Amarillo 
                                                        // FROM especie WHERE IDespecie_general = '$IDespecie_general' AND IDempresa = '$IDempresa' AND Grupo = '$Grupo1' ")
                                                        // or die ( $error ="Error description4: " . mysqli_error($con) );
        												$row = $consulta4;
        											}
        									}

        									$IDespecie = '';
        									$Fiscaliza_aux = '';
        									$Nociva_aux = '';
        									$Nivel_Critico_aux = '';
        									$Alarma_Rojo_aux ='';
        									$Alarma_Amarillo_aux = '';

        									if ($row) {
        										$IDespecie = $row->id;
        										$Fiscaliza_aux = $row->Fiscaliza;
        										$Nociva_aux = $row->Nociva;
        										if($row->Nivel_Critico != ''){
        											$Nivel_Critico_aux = $row->Nivel_Critico;
        										}else{$Nivel_Critico_aux = 0;
        											//echo '<pre> vacio'; print_r($row[ 'Nivel_Critico']); echo '</pre>';
        										}
        										if($row->Alarma_Rojo){
        											$Alarma_Rojo_aux = $row->Alarma_Rojo;
        										}else{$Alarma_Rojo_aux = 0;}
        										if($row->Alarma_Amarillo){
        											$Alarma_Amarillo_aux = $row->Alarma_Amarillo;
        										}else{$Alarma_Amarillo_aux = 0;}
        									}

        									//$Alarma_Rojo_aux = $row[ 'Alarma_Rojo'];
        									//$Alarma_Amarillo_aux = $row[ 'Alarma_Amarillo'];
        									//echo '<pre>'; print_r($Nivel_Critico_aux); echo '</pre>';
        									if($IDespecie == '' || $IDespecie === 0){
        										$IDespecie = 0;
        										$string = $string."('$IDmedicion', ".$IDespecie.", '0', '0', '0', '0', '0', '$Medicion1', '$Medicion2', '$Medicion3', '$Medicion4', '$Medicion5', '$Medicion6', '$Medicion7'),";
        									}else{
        										$string = $string."('$IDmedicion', ".$IDespecie.", '$Fiscaliza_aux', '$Nociva_aux', '$Nivel_Critico_aux', '$Alarma_Rojo_aux', '$Alarma_Amarillo_aux', '$Medicion1', '$Medicion2', '$Medicion3', '$Medicion4', '$Medicion5', '$Medicion6', '$Medicion7'),";
        									}
        								}
        							}
        						}

        						if($string != ""){
        							$string2 = rtrim($string,", ");

        							//Save Medicion_fan
                                    //     $consulta = MedicionFan::insert(['IDmedicion'=>
                                    //                                     'IDespecie'=>
                                    //                                     'Fiscaliza'=>
                                    //                                     'Nociva'=>
                                    //                                     'Nivel_Critico'=>
                                    //                                     'Alarma_Rojo'=>
                                    //                                     'Alarma_Amarillo'=>
                                    //                                     'Medicion_1'=>
                                    //                                     'Medicion_2'=>
                                    //                                     'Medicion_3'=>
                                    //                                     'Medicion_4'=>
                                    //                                     'Medicion_5'=>
                                    //                                     'Medicion_6'=>
                                    //                                     'Medicion_7'=>
                                    // ]);
                                    //     DB::insert("INSERT INTO gtr_medicion_fan(IDmedicion,
                                    //                                                         IDespecie,
                                    //                                                         Fiscaliza,
                                    //                                                         Nociva,
                                    //                                                         Nivel_Critico,
                                    //                                                         Alarma_Rojo,
                                    //                                                         Alarma_Amarillo,
                                    //                                                         Medicion_1,
                                    //                                                         Medicion_2,
                                    //                                                         Medicion_3,
                                    //                                                         Medicion_4,
                                    //                                                         Medicion_5,
                                    //                                                         Medicion_6,
                                    //                                                         Medicion_7) 
                                    //                                             VALUES" .$string2);
        							// $consulta = mysqli_query($con,"INSERT INTO medicion_fan(IDmedicion,IDespecie,Fiscaliza,Nociva,Nivel_Critico,Alarma_Rojo,Alarma_Amarillo,Medicion_1,
                                    // Medicion_2,Medicion_3,Medicion_4,Medicion_5,Medicion_6,Medicion_7) VALUES" .$string2)or die ( $error ="Error description 6: " . mysqli_error($con) );

        						}


        						////////////////////////
        						//Parámetros Ambientales
        						////////////////////////
        						$string = "";
                                $IDconductaPeces = Pambientales::select('IDpambientales')->where([['Nombre', 'Conducta Peces'],['IDempresa', $IDempresa]]);
                                $string = $string."('$IDmedicion', $IDconductaPeces,'$Conducta_Peces','','','','','',''),";
                                //DB::select(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Conducta Peces' AND IDempresa = '$IDempresa')
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Conducta Peces' AND IDempresa = '$IDempresa'),'$Conducta_Peces','','','','','',''),";

        						if(isset($Peso)){
                                    $IDpeso = Pambientales::select('IDpambientales')->where([['Nombre', 'Peso Promedio [Kg]'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDpeso,'$Peso','','','','','',''),";
        							//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Peso Promedio [Kg]' AND IDempresa = '$IDempresa'),'$Peso','','','','','',''),";
        						}

        						if(isset($Color)){
                                    $IDcolor = Pambientales::select('IDpambientales')->where([['Nombre', 'Color'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDcolor,'$Color','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Color' AND IDempresa = '$IDempresa'),'$Color','','','','','',''),";
        						}

        						if(isset($Disco)){
                                    $IDdiscoSecchi = Pambientales::select('IDpambientales')->where([['Nombre', 'Disco Secchi [m]'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDdiscoSecchi,'$Disco','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Disco Secchi [m]' AND IDempresa = '$IDempresa'),'$Disco','','','','','',''),";
        						}

        						if(isset($Espuma)){
                                    $IDespuma = Pambientales::select('IDpambientales')->where([['Nombre', 'Espuma'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDespuma,'$Espuma','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Espuma' AND IDempresa = '$IDempresa'),'$Espuma','','','','','',''),";
        						}
                                
        						if(isset($Estado_mar)){
                                    $IDestado = Pambientales::select('IDpambientales')->where([['Nombre', 'Estado'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDestado,'$Estado_mar','','','','','',''),";
                                  //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Estado' AND IDempresa = '$IDempresa'),'$Estado_mar','','','','','',''),";
        						}

        						if(isset($Marea)){
                                    $IDmarea = Pambientales::select('IDpambientales')->where([['Nombre', 'Marea'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDmarea,'$Marea','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Marea' AND IDempresa = '$IDempresa'),'$Marea','','','','','',''),";
        						}

        						if(isset($Medusas)){
                                    $IDmedusas = Pambientales::select('IDpambientales')->where([['Nombre', 'Medusas'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDmedusas,'$Medusas','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Medusas' AND IDempresa = '$IDempresa'),'$Medusas','','','','','',''),";
        						}
                                
        						if(isset($Transparencia)){
                                    $IDtransparencia = Pambientales::select('IDpambientales')->where([['Nombre', 'Transparencia'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDtransparencia,'$Transparencia','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Transparencia' AND IDempresa = '$IDempresa'),'$Transparencia','','','','','',''),";
        						}

        						if(isset($Cielo)){
                                    $IDcielo = Pambientales::select('IDpambientales')->where([['Nombre', 'Cielo'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDcielo,'$Cielo','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Cielo' AND IDempresa = '$IDempresa'),'$Cielo','','','','','',''),";
        						}
                                
        						if(isset($Precipitacion)){
                                    $IDprecipitacion = Pambientales::select('IDpambientales')->where([['Nombre', 'Precipitación'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDprecipitacion,'$Precipitacion','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Precipitación' AND IDempresa = '$IDempresa'),'$Precipitacion','','','','','',''),";
        						}
                                
        						if(isset($Direccion_viento)){
                                    $IDviento = Pambientales::select('IDpambientales')->where([['Nombre', 'Viento'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDviento,'$Direccion_viento','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Viento' AND IDempresa = '$IDempresa'),'$Direccion_viento','','','','','',''),";
        						}

        						if(isset($Intensidad_viento)){
                                    $IDvientoIntensidad = Pambientales::select('IDpambientales')->where([['Nombre', 'Viento (Intensidad)'],['IDempresa', $IDempresa]]);
                                    $string = $string."('$IDmedicion', $IDvientoIntensidad,'$Intensidad_viento','','','','','',''),";
        							//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Viento (Intensidad)' AND IDempresa = '$IDempresa'),'$Intensidad_viento','','','','','',''),";
        						}



        						if(!isset($Temperatura_5)){$Temperatura_5 = "";}
        						if(!isset($Temperatura_6)){$Temperatura_6 = "";}
        						if(!isset($Temperatura_7)){$Temperatura_7 = "";}
                                $IDtemperatura = PAmbientales::select('IDpambientales')->where([['Nombre','Temperatura [ºC]'],['IDempresa', $IDempresa]]);
                                $string = $string."('$IDmedicion', $IDtemperatura,'$Temperatura_1','$Temperatura_2','$Temperatura_3','$Temperatura_4','$Temperatura_5','$Temperatura_6','$Temperatura_7'),";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Temperatura [ºC]' AND IDempresa = '$IDempresa'),'$Temperatura_1','$Temperatura_2','$Temperatura_3','$Temperatura_4','$Temperatura_5','$Temperatura_6','$Temperatura_7'),";

        						if(!isset($Salinidad_5)){$Salinidad_5 = "";}
        						if(!isset($Salinidad_6)){$Salinidad_6 = "";}
        						if(!isset($Salinidad_7)){$Salinidad_7 = "";}
                                $IDsalinidad = PAmbientales::select('IDpambientales')->where([['Nombre','Salinidad'],['IDempresa', $IDempresa]]);
                                $string = $string."('$IDmedicion', $IDsalinidad,'$Salinidad_1','$Salinidad_2','$Salinidad_3','$Salinidad_4','$Salinidad_5','$Salinidad_6','$Salinidad_7'),";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Salinidad' AND IDempresa = '$IDempresa'),'$Salinidad_1','$Salinidad_2','$Salinidad_3','$Salinidad_4','$Salinidad_5','$Salinidad_6','$Salinidad_7'),";

        						if(!isset($o2_mg_5)){$o2_mg_5 = "";}
        						if(!isset($o2_mg_6)){$o2_mg_6 = "";}
        						if(!isset($o2_mg_7)){$o2_mg_7 = "";}
                                $IDoxigenoDisuelto = PAmbientales::select('IDpambientales')->where([['Nombre','Oxigeno Disuelto [mg/l]'],['IDempresa', $IDempresa]]);
                                $string = $string."('$IDmedicion', $IDoxigenoDisuelto,'$o2_mg_1','$o2_mg_2','$o2_mg_3','$o2_mg_4','$o2_mg_5','$o2_mg_6','$o2_mg_7'),";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Oxigeno Disuelto [mg/l]' AND IDempresa = '$IDempresa'),'$o2_mg_1','$o2_mg_2','$o2_mg_3','$o2_mg_4','$o2_mg_5','$o2_mg_6','$o2_mg_7'),";

        						if(!isset($o2_percent_5)){$o2_percent_5 = "";}
        						if(!isset($o2_percent_6)){$o2_percent_6 = "";}
        						if(!isset($o2_percent_7)){$o2_percent_7 = "";}
                                $IDoxigenoDisueltoPorcent = PAmbientales::select('IDpambientales')->where([['Nombre','Oxigeno Disuelto [%]'],['IDempresa', $IDempresa]]);
                                $string = $string."('$IDmedicion', $IDoxigenoDisueltoPorcent,'$o2_percent_1', '$o2_percent_2', '$o2_percent_3', '$o2_percent_4','$o2_percent_5', '$o2_percent_6', '$o2_percent_7')";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Oxigeno Disuelto [%]' AND IDempresa = '$IDempresa'),'$o2_percent_1', '$o2_percent_2', '$o2_percent_3', '$o2_percent_4','$o2_percent_5', '$o2_percent_6', '$o2_percent_7')";


        						//Save Parametros Ambientales
                                // $consulta = MedicionPAmbientales::insert(['IDmedicion'=> ,
                                //                                             'IDpambientales'=> ,
                                //                                             'Medicion_1'=> ,
                                //                                             'Medicion_2'=> ,
                                //                                             'Medicion_3'=> ,
                                //                                             'Medicion_4'=> ,
                                //                                             'Medicion_5'=> ,
                                //                                             'Medicion_6'=> ,
                                //                                             ''=> ,

                                //                                             ]);
                                DB::insert("INSERT INTO gtr_medicion_pambientales(IDmedicion,IDpambientales,Medicion_1,Medicion_2,Medicion_3,Medicion_4,Medicion_5,Medicion_6,Medicion_7) VALUES" .$string);
        						// $consulta = mysqli_query($con,"INSERT INTO medicion_pambientales(IDmedicion,IDpambientales,Medicion_1,Medicion_2,Medicion_3,Medicion_4,Medicion_5,Medicion_6,Medicion_7) VALUES" .$string)
        						// or die ( $error ="Error description 7: " . mysqli_error($consulta) );




        // 						/*//Nombre e ID Centro
                                $consulta = Centro::select('Nombre','IDcentro')->where('IDcentro', $IDcentro)->get();                                
        // 						$consulta = mysqli_query($con,"SELECT Nombre,IDcentro FROM centro WHERE IDcentro = '$IDcentro' ")
        // 					    or die ( $error ="Error description: " . mysqli_error($consulta) );

        // 						$row = mysqli_fetch_assoc($consulta);
        // 						$Centro = $row['Nombre'];
        // 						$IDcentro = $row['IDcentro'];*/
                                $Centro = $consulta->Nombre;
            					$IDcentro = $consulta->IDcentro;

        // 						//Alarma para todas las especies, (no solo las que fiscaliza serna)
                                $consulta = MedicionFan::join('especie', 'especie.IDespecie' ,'=','medicion_fan.IDespecie')
                                                            ->select(   'medicion_fan.IDmedicionfan',
                                                                        'medicion_fan.Medicion_1',
                                                                        'medicion_fan.Medicion_2',
                                                                        'medicion_fan.Medicion_3',
                                                                        'medicion_fan.Medicion_4',
                                                                        'medicion_fan.Medicion_5',
                                                                        'medicion_fan.Medicion_6',
                                                                        'medicion_fan.Medicion_7',
                                                                        'especie.Alarma_Rojo',
                                                                        'especie.Alarma_Amarillo',
                                                                        'especie.Nombre',
                                                                        'especie.Nivel_Critico'
                                                                )
                                                            ->where([
                                                                ['medicion_fan.IDespecie', 'especie.IDespecie'],
                                                                ['medicion_fan.IDmedicion', $IDmedicion]
                                                                ])
                                                            ->where(
                                                                function($query){
                                                                    $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Alarma_Rojo'))
                                                                    ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                    ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Alarma_Rojo'))
                                                                    ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                    ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                    ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                    ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Alarma_Rojo'));
                                                                }) 
                                                            ->where('especie.Alarma_Rojo','>', 0)
                                                            ->get();                                
        // 						$consulta = mysqli_query($con,"SELECT mf.IDmedicionfan,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4,mf.Medicion_5,mf.Medicion_6,mf.Medicion_7,e.Alarma_Rojo,e.Alarma_Amarillo,e.Nombre, e.Nivel_Critico FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) WHERE (mf.Medicion_1 >= e.Alarma_Rojo OR mf.Medicion_2 >= e.Alarma_Rojo OR mf.Medicion_3 >= e.Alarma_Rojo OR mf.Medicion_4 >= e.Alarma_Rojo OR mf.Medicion_5 >= e.Alarma_Rojo OR mf.Medicion_6 >= e.Alarma_Rojo OR mf.Medicion_7 >= e.Alarma_Rojo) AND e.Alarma_Rojo > 0 ")or die ($error ="Error description 8: " . mysqli_error($consulta));
        						$alarma = "";
        						$Comentario = array();
        						$Comentario_precaucion = array();
        						$Concentracion = array();
        						$Nocivo = array();
        						$Nocivo_P = array();
        						$Concentracion_precaucion = array();
        						$aux_prec = "";
        						foreach($consulta as $row)
        						{
        							$alarma = "Nivel Crítico";
        							$Comentario[] = $row->Nombre;
        							$Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
        							$Nocivo[] = $row->Nivel_Critico;
        				//			$datos_rojo['Alarma_Rojo'][] = $row['Alarma_Rojo'];
        				//			$datos_rojo['Alarma_Amarillo'][] = $row['Alarma_Amarillo'];
        				//			$datos_rojo['Medicion_1'][] = $row['Medicion_1'];
        				//			$datos_rojo['Medicion_2'][] = $row['Medicion_2'];
        				//			$datos_rojo['Medicion_3'][] = $row['Medicion_3'];
        				//			$datos_rojo['Medicion_4'][] = $row['Medicion_4'];
        						}

        						if($alarma == ""){
                                    $consulta = MedicionFan::join('especie', 'especie.IDespecie' ,'=','medicion_fan.IDespecie')
                                                                ->where([
                                                                    ['medicion_fan.IDespecie', 'especie.IDespecie'],
                                                                    ['medicion_fan.IDmedicion', $IDmedicion]
                                                                    ])
                                                                    ->select('medicion_fan.IDmedicionfan',
                                                                                'medicion_fan.Medicion_1',
                                                                                'medicion_fan.Medicion_2',
                                                                                'medicion_fan.Medicion_3',
                                                                                'medicion_fan.Medicion_4',
                                                                                'medicion_fan.Medicion_5',
                                                                                'medicion_fan.Medicion_6',
                                                                                'medicion_fan.Medicion_7',
                                                                                'especie.Nombre',
                                                                                'especie.Nivel_Critico'
                                                                    )
                                                                ->where(
                                                                    function($query){
                                                                        $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Alarma_Amarillo'))
                                                                                ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Alarma_Amarillo'))
                                                                                ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Alarma_Amarillo'));
                                                                    })
                                                                ->where('especie.Alarma_Amarillo','>', 0)                                                                
                                                                ->get();
                                    
        							// $consulta = mysqli_query($con,"SELECT gtr_medicion_fan.IDmedicionfan,gtr_medicion_fan.Medicion_1,gtr_medicion_fan.Medicion_2,gtr_medicion_fan.Medicion_3,
                                    //             gtr_medicion_fan.Medicion_4,gtr_medicion_fan.Medicion_5,gtr_medicion_fan.Medicion_6,gtr_medicion_fan.Medicion_7, gtr_especie.Nombre, gtr_especie.Nivel_Critico 
                                    //             FROM ( medicion_fan mf INNER JOIN especie e ON (gtr_medicion_fan.IDespecie = gtr_especie.IDespecie AND gtr_medicion_fan.IDmedicion = '$IDmedicion') ) 
                                    //             WHERE (gtr_medicion_fan.Medicion_1 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_2 >= gtr_especie.Alarma_Amarillo 
                                    //             OR gtr_medicion_fan.Medicion_3 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_4 >= gtr_especie.Alarma_Amarillo
                                    //             OR gtr_medicion_fan.Medicion_5 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_6 >= gtr_especie.Alarma_Amarillo 
                                    //             OR gtr_medicion_fan.Medicion_7 >= gtr_especie.Alarma_Amarillo) AND gtr_especie.Alarma_Amarillo > 0 ")
                                    //             or die ($error ="Error description 9: " . mysqli_error($consulta));


        							while($consulta)
        							{
        								$alarma = "Precaución";
        								$Comentario[] = $consulta->Nombre;
        								$Concentracion[] = max($consulta->Medicion_1,$consulta->Medicion_2,$consulta->Medicion_3,$consulta->Medicion_4,$consulta->Medicion_5,
                                        $consulta->Medicion_6,$consulta->Medicion_7);
        								$Nocivo[] = $consulta->Nivel_Critico;
        							}
        						}else{
                                    $consulta = MedicionFan::join('especie', 'especie.IDespecie' ,'=','medicion_fan.IDespecie')
                                                                ->where([
                                                                    ['medicion_fan.IDespecie', 'especie.IDespecie'],
                                                                    ['medicion_fan.IDmedicion', $IDmedicion]
                                                                ])
                                                                ->select('medicion_fan.IDmedicionfan',
                                                                                'medicion_fan.Medicion_1',
                                                                                'medicion_fan.Medicion_2',
                                                                                'medicion_fan.Medicion_3',
                                                                                'medicion_fan.Medicion_4',
                                                                                'medicion_fan.Medicion_5',
                                                                                'medicion_fan.Medicion_6',
                                                                                'medicion_fan.Medicion_7',
                                                                                'especie.Nombre',
                                                                                'especie.Nivel_Critico'
                                                                        )
                                                                ->where(
                                                                    function($query){
                                                                        $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Alarma_Amarillo'))
                                                                                ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Alarma_Amarillo'))
                                                                                ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Alarma_Amarillo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Alarma_Amarillo'));
                                                                    })
                                                                ->where(
                                                                        function($query){
                                                                            $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Alarma_Rojo'))
                                                                                ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Alarma_Rojo'))
                                                                                ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Alarma_Rojo')) 
                                                                                ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Alarma_Rojo'));
                                                                            })
                                                                ->where('especie.Alarma_Amarillo','>', 0) 
                                                                ->get();

                                    
        							// $consulta = mysqli_query($con,"SELECT gtr_medicion_fan.IDmedicionfan,gtr_medicion_fan.Medicion_1,gtr_medicion_fan.Medicion_2,gtr_medicion_fan.Medicion_3,gtr_medicion_fan.Medicion_4,
                                    //             gtr_medicion_fan.Medicion_5,gtr_medicion_fan.Medicion_6,gtr_medicion_fan.Medicion_7, gtr_especie.Nombre, gtr_especie.Nivel_Critico FROM ( medicion_fan mf INNER JOIN especie e 
                                    //             ON (gtr_medicion_fan.IDespecie = gtr_especie.IDespecie AND gtr_medicion_fan.IDmedicion = '$IDmedicion') ) WHERE (gtr_medicion_fan.Medicion_1 >= gtr_especie.Alarma_Amarillo 
                                    //             OR gtr_medicion_fan.Medicion_2 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_3 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_4 >= gtr_especie.Alarma_Amarillo 
                                    //             OR gtr_medicion_fan.Medicion_5 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_6 >= gtr_especie.Alarma_Amarillo OR gtr_medicion_fan.Medicion_7 >= gtr_especie.Alarma_Amarillo) 
                                    //             AND (gtr_medicion_fan.Medicion_1 < gtr_especie.Alarma_Rojo OR gtr_medicion_fan.Medicion_2 < gtr_especie.Alarma_Rojo OR gtr_medicion_fan.Medicion_3 < gtr_especie.Alarma_Rojo 
                                    //             OR gtr_medicion_fan.Medicion_4 < gtr_especie.Alarma_Rojo OR gtr_medicion_fan.Medicion_5 < gtr_especie.Alarma_Rojo OR gtr_medicion_fan.Medicion_6 < gtr_especie.Alarma_Rojo 
                                    //             OR mf.Medicion_7 < gtr_especie.Alarma_Rojo) AND gtr_especie.Alarma_Amarillo > 0 ")or die ($error ="Error description 10: " . mysqli_error($consulta));


        							while($consulta)
        							{
        								if(!in_array($consulta->Nombre, $Comentario)){
        									$Comentario_precaucion[] = $consulta->Nombre;
        									$Concentracion_precaucion[] = max($consulta->Medicion_1,$consulta->Medicion_2,$consulta->Medicion_3,$consulta->Medicion_4,$consulta->Medicion_5,
                                            $consulta->Medicion_6,$consulta->Medicion_7);
        									$Nocivo_P[] = $consulta->Nivel_Critico;
        								}
        							}
        							$aux_prec = join(', ', $Comentario_precaucion);

        						}

        						if($alarma == ""){
                                    $consulta = MedicionFan::select('IDmedicionfan')
                                                                ->where('IDmedicion', $IDmedicion)
                                                                ->where(
                                                                    function($query){
                                                                        $query->where('Medicion_1', '>', 0)
                                                                                ->orWhere('Medicion_2', '>', 0)
                                                                                ->orWhere('Medicion_3', '>', 0)
                                                                                ->orWhere('Medicion_4', '>', 0)
                                                                                ->orWhere('Medicion_5', '>', 0)
                                                                                ->orWhere('Medicion_6', '>', 0)
                                                                                ->orWhere('Medicion_7', '>', 0);
                                                                    }
                                                                )
                                                                ->get();
                                   
        							// $consulta = mysqli_query($con,"SELECT IDmedicionfan FROM medicion_fan WHERE IDmedicion = '$IDmedicion' AND (Medicion_1 > 0 OR Medicion_2 > 0 OR Medicion_3 > 0 OR Medicion_4 > 0 OR Medicion_5 > 0 
                                    // OR Medicion_6 > 0 OR Medicion_7 > 0) ")or die ($error ="Error description 11: " . mysqli_error($consulta));


        							while($consulta)
        							{
        								$alarma = "Presencia Microalgas";
        							}
        						}


        						if($alarma != ""){

        							$aux = join(', ', $Comentario);
                                    $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                                            ->update([
                                                               'Estado_Alarma' => $alarma,
                                                               'Comentario' => $aux
                                                            ]);
                                    
        							// $consulta = mysqli_query($con,"UPDATE medicion SET Estado_Alarma = '$alarma', Comentario = '$aux' WHERE IDmedicion = '$IDmedicion' ")
        					        // or die ( $error ="Error description 12: " . mysqli_error($consulta) );

        						}else{$alarma = "Ausencia Microalgas"; $aux = "";}





        						////////////////////////////
        						/////// Declaración ////////
        						////////////////////////////
                                $consulta = Configuracion::select('Observaciones')
                                                            ->where(   [['Modificacion' , 'Estado Declaración'],
                                                                        ['IDempresa', $IDempresa]
                                                                        ])
                                                            ->orderBy('Fecha')
                                                            ->first();                                
        						// $consulta = mysqli_query($con,"SELECT Observaciones FROM configuracion WHERE Modificacion = 'Estado Declaración' AND IDempresa = '$IDempresa' ORDER BY Fecha DESC LIMIT 1")
        					    // or die ($error ="Error description 13: " . mysqli_error($consulta));

        						$Resultado = 'Normal';
        						foreach($consulta as  $row)
        						{
        							$Resultado  = $row->Observaciones;
        						}

        						if($Resultado == 'Normal'){

        							//Chequea si hay una especie a declarar a sernapesca
                                    $consulta = MedicionFan::join('especie', 'especie.IDespecie' ,'=','medicion_fan.IDespecie')
                                                                ->where([
                                                                    ['medicion_fan.IDespecie', 'especie.IDespecie'],
                                                                    ['medicion_fan.IDmedicion', $IDmedicion]
                                                                ])
                                                                ->select('medicion_fan.IDmedicionfan',
                                                                                'medicion_fan.Medicion_1',
                                                                                'medicion_fan.Medicion_2',
                                                                                'medicion_fan.Medicion_3',
                                                                                'medicion_fan.Medicion_4',
                                                                                'medicion_fan.Medicion_5',
                                                                                'medicion_fan.Medicion_6',
                                                                                'medicion_fan.Medicion_7',
                                                                                'especie.Nombre',
                                                                                'especie.Nivel_Fiscaliza'
                                                                        )
                                                                ->where(
                                                                        function($query){
                                                                            $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                                ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Nivel_Fiscaliza')) 
                                                                                ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Nivel_Fiscaliza'))
                                                                                ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Nivel_Fiscaliza')) 
                                                                                ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Nivel_Fiscaliza')) 
                                                                                ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Nivel_Fiscaliza')) 
                                                                                ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Nivel_Fiscaliza'));
                                                                            })
                                                                ->where('especie.Fiscaliza','>', 1)
                                                                ->get();
                                    
        							// $consulta = mysqli_query($con,"SELECT mf.IDmedicion,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4,mf.Medicion_5,mf.Medicion_6,mf.Medicion_7, e.Nombre, e.Nivel_Fiscaliza FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) WHERE (mf.Medicion_1 >= e.Nivel_Fiscaliza OR mf.Medicion_2 >= e.Nivel_Fiscaliza OR mf.Medicion_3 >= e.Nivel_Fiscaliza OR mf.Medicion_4 >= e.Nivel_Fiscaliza OR mf.Medicion_5 >= e.Nivel_Fiscaliza OR mf.Medicion_6 >= e.Nivel_Fiscaliza OR mf.Medicion_7 >= e.Nivel_Fiscaliza) AND e.Fiscaliza = 1 ")
                                    // or die ($error ="Error description 14: " . mysqli_error($consulta));

        							$declarar = array();
        							$Especie_declarar = array();
        							$Fecha_semana = array();
        							foreach($consulta as $row)
        							{

        								$medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,
                                                        $row->Medicion_5,$row->Medicion_6,$row->Medicion_7);

        								$declarar = array(
        												'IDmedicion' => $row->IDmedicion,
        												'Medicion' => $medmax,
        												'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza
        											);

        								$medup = 100*(($medmax-$row->Nivel_Fiscaliza)/$row->Nivel_Fiscaliza);
        								$medup = round($medup,0);
        								$Especie_declarar[0] = "&".$medup."& ".$row->Nombre;
        								$Estado_Nocivo = 1;
        							}


        						}else if($Resultado == 'Pre-Alerta'){

        							//Chequea si existe nivel Pre-Alerta Res. Ex. 6073 del 24 de diciembre de 2018
                                    $consulta = MedicionFan::join('especie', 'especie.IDespecie' ,'=','medicion_fan.IDespecie')
                                                                ->where([
                                                                    ['medicion_fan.IDespecie', 'especie.IDespecie'],
                                                                    ['medicion_fan.IDmedicion', $IDmedicion]
                                                                ])
                                                                ->select('medicion_fan.IDmedicionfan',
                                                                                'medicion_fan.Medicion_1',
                                                                                'medicion_fan.Medicion_2',
                                                                                'medicion_fan.Medicion_3',
                                                                                'medicion_fan.Medicion_4',
                                                                                'medicion_fan.Medicion_5',
                                                                                'medicion_fan.Medicion_6',
                                                                                'medicion_fan.Medicion_7',
                                                                                'especie.Nombre',
                                                                                'especie.Nivel_Fiscaliza',
                                                                                'especie.Nivel_Fiscaliza_Pre'

                                                                        )
                                                                ->where(
                                                                        function($query){
                                                                            $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre'))
                                                                                ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre')) 
                                                                                ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre'))
                                                                                ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre')) 
                                                                                ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre')) 
                                                                                ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre')) 
                                                                                ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Nivel_Fiscaliza_Pre'));
                                                                            })
                                                                ->where('especie.Fiscaliza','>', 1)
                                                                ->get();
        							// $consulta = mysqli_query($con,"SELECT mf.IDmedicion,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4,mf.Medicion_5,mf.Medicion_6,mf.Medicion_7, e.Nombre, e.Nivel_Fiscaliza, e.Nivel_Fiscaliza_Pre FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) WHERE (mf.Medicion_1 >= e.Nivel_Fiscaliza_Pre OR mf.Medicion_2 >= e.Nivel_Fiscaliza_Pre OR mf.Medicion_3 >= e.Nivel_Fiscaliza_Pre OR mf.Medicion_4 >= e.Nivel_Fiscaliza_Pre OR mf.Medicion_5 >= e.Nivel_Fiscaliza_Pre OR mf.Medicion_6 >= e.Nivel_Fiscaliza_Pre OR mf.Medicion_7 >= e.Nivel_Fiscaliza_Pre) AND e.Fiscaliza = 1 ")
                                    // or die ($error ="Error description 15: " . mysqli_error($consulta));

        							$declarar = array();
        							$Especie_declarar = array();
        							$Fecha_semana = array();
        							foreach($consulta as $row)
        							{

        								$medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,
                                                        $row->Medicion_6,$row->Medicion_7);

        								$declarar = array(
        												'IDmedicion' => $row->IDmedicion,
        												'Medicion' => $medmax,
        												//'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza,
        												'Nivel_Fiscaliza_Pre' => $row->Nivel_Fiscaliza_Pre
        											);

        								$medup = 100*(($medmax-$row->Nivel_Fiscaliza_Pre)/$row->Nivel_Fiscaliza_Pre);
        								$medup = round($medup,0);
        								$Especie_declarar[] = "&".$medup."& ".$row->Nombre;
        								$Estado_Nocivo = 0;
        							}

        						}else if($Resultado == 'Alerta'){

        							//
                                    $consulta = MedicionFan::join('especie', 'especie.IDespecie' ,'=','medicion_fan.IDespecie')
                                                                ->where([
                                                                    ['medicion_fan.IDespecie', 'especie.IDespecie'],
                                                                    ['medicion_fan.IDmedicion', $IDmedicion]
                                                                ])
                                                                ->select('medicion_fan.IDmedicionfan',
                                                                                'medicion_fan.Medicion_1',
                                                                                'medicion_fan.Medicion_2',
                                                                                'medicion_fan.Medicion_3',
                                                                                'medicion_fan.Medicion_4',
                                                                                'medicion_fan.Medicion_5',
                                                                                'medicion_fan.Medicion_6',
                                                                                'medicion_fan.Medicion_7',
                                                                                'especie.Nombre',
                                                                                'especie.Nivel_Fiscaliza',
                                                                                'especie.Nivel_Fiscaliza_Alerta'

                                                                        )
                                                                ->where(
                                                                        function($query){
                                                                            $query->where('medicion_fan.Medicion_1', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                                                ->orWhere(' medicion_fan.Medicion_2', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta')) 
                                                                                ->orWhere(' medicion_fan.Medicion_3', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'))
                                                                                ->orWhere(' medicion_fan.Medicion_4', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta')) 
                                                                                ->orWhere(' medicion_fan.Medicion_5', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta')) 
                                                                                ->orWhere(' medicion_fan.Medicion_6', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta')) 
                                                                                ->orWhere(' medicion_fan.Medicion_7', '>=', DB::raw('especie.Nivel_Fiscaliza_Alerta'));
                                                                            })
                                                                ->where('especie.Fiscaliza','>', 1)
                                                                ->get();                                  
        							// $consulta = mysqli_query($con,"SELECT mf.IDmedicion,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4,mf.Medicion_5,mf.Medicion_6,mf.Medicion_7, e.Nombre, e.Nivel_Fiscaliza, 
                                    // e.Nivel_Fiscaliza_Alerta FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) WHERE (mf.Medicion_1 >= e.Nivel_Fiscaliza_Alerta 
                                    // OR mf.Medicion_2 >= e.Nivel_Fiscaliza_Alerta OR mf.Medicion_3 >= e.Nivel_Fiscaliza_Alerta OR mf.Medicion_4 >= e.Nivel_Fiscaliza_Alerta OR mf.Medicion_5 >= e.Nivel_Fiscaliza_Alerta 
                                    // OR mf.Medicion_6 >= e.Nivel_Fiscaliza_Alerta OR mf.Medicion_7 >= e.Nivel_Fiscaliza_Alerta) AND e.Fiscaliza = 1 ")
                                    // or die ($error ="Error description 16: " . mysqli_error($consulta));

        							$declarar = array();
        							$Especie_declarar = array();
        							$Fecha_semana = array();
        							foreach($consulta as $row)
        							{

        								$medmax = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);

        								$declarar = array(
        												'IDmedicion' => $row->IDmedicion,
        												'Medicion' => $medmax,
        												//'Nivel_Fiscaliza' => $row->Nivel_Fiscaliza,
        												'Nivel_Fiscaliza_Alerta' => $row->Nivel_Fiscaliza_Alerta
        											);

        								$medup = 100*(($medmax-$row->Nivel_Fiscaliza_Alerta)/$row->Nivel_Fiscaliza_Alerta);
        								$medup = round($medup,0);
        								$Especie_declarar[] = "&".$medup."& ".$row->Nombre;
        								$Estado_Nocivo = 2;
        							}

        						}

        						if(!empty($declarar)){
        							$Especie_declarar_aux = join(', ', $Especie_declarar);
                                    $consulta = Declaracion::insert([
                                                                    'IDcentro'=> $IDcentro,
                                                                    'IDmedicion'=> $IDmedicion,
                                                                    'Fecha_Registro'=> $Fecha_Medicion,
                                                                    'Estado'=> '0',
                                                                    'Firma_user_id'=> '0',
                                                                    'Observaciones'=> '',
                                                                    'Especie'=> $Especie_declarar_aux,
                                                                    'Estado_Nocivo'=> $Estado_Nocivo,
                                    ]);
                                    
        							// $consulta = mysqli_query($con,"INSERT INTO declaracion(IDcentro,IDmedicion,Fecha_Registro,Estado,Firma_user_id,Observaciones,Especie,Estado_Nocivo) VALUES ('$IDcentro','$IDmedicion','$Fecha_Medicion','0','0','','$Especie_declarar_aux','$Estado_Nocivo')")
        							// or die ( $error ="Error description 17: " . mysqli_error($consulta) );

        						}else{


        						}

        // 						//Buscar especie que no este en la lista
                                $consulta = MedicionFan::select('IDespecie','IDmedicionfan')->where('IDmedicion', $IDmedicion)->get();
                                
        // 						$consulta = mysqli_query($con,"SELECT IDespecie, IDmedicionfan FROM medicion_fan WHERE IDmedicion = '$IDmedicion'")
                                //or die ($error ="Error description 18: " . mysqli_error($consulta));

        							$noexiste_index = array();
        							$IDmedicionfan = array();
        							$i = 0;
        							while($consulta)
        							{
        								if( $consulta->IDespecie == 0){
        									$noexiste_index[] = $i;
        									$IDmedicionfan[] = $consulta->IDmedicionfan;

        								}
        								$i++;
        							}

        							$Nombre_Especie_No = array();
        							if(sizeof($noexiste_index) > 0){
        								for($n=0;$n<sizeof($noexiste_index);$n++){
        									$Nombre_Especie_No[] = array(
        																'Nombre' => $Nombre_Especie[$noexiste_index[$n]]['Nombre'],
        																'IDmedicionfan' => $IDmedicionfan[$n],
        																);
        								}


        								//Si existe una especie no encontrada en tabla general, entonces guardar la medición como borrador
                                        $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                                                ->update(['Estado' => 0]);
        								// $consulta = mysqli_query($con,"UPDATE medicion SET Estado = 0 WHERE IDmedicion = '$IDmedicion' ")
        					            // or die ( $error ="Error description 19: " . mysqli_error($consulta) );
        								$error = 1;
        							}


        					}


        					$Resultado = array('Error' =>$error, 'Alarma' => $alarma,'Nombre_Centro' => $Centro,'IDcentro' => $IDcentro, 'IDmedicion' => $IDmedicion, 'Comentario' => $aux, 'Concentracion' => $Concentracion, 'Nocivo' => $Nocivo, 'Nocivo_P' => $Nocivo_P, 'Comentario_Precaucion' => $aux_prec, 'Concentracion_Precaucion' => $Concentracion_precaucion, 'Mortalidad' => $Mortalidad, 'Fecha_Medicion' => $Fecha_Medicion, 'Nombre_Especie_No' => $Nombre_Especie_No,'Fecha_aux' => $Fecha_Medicion_existe,'envio' => $fecha_envio, 'existe'=>$existeregistro,'array_especies_iguales'=> $array_especies_iguales,'$especie_iguales' => $especie_iguales);



        				}else{    //Cierra chequeo fecha registro anterior

        					//$fecha_envio = implode(',',$fecha_envio);
        					$Resultado = array('Error' =>4,'Fecha_Envio' => $fecha_envio);

        				}

        			}else{
        				$Resultado = array('Error' =>5,'Especie' => $especie_iguales);
        			}


        		}else{
        			$Resultado = array('Error' =>2,'SIEP' => $IDcentro_siep);
        		}
        	}else{
        		$Resultado = array('Error' =>3);
        	}
            return Response::json($Resultado);
        // 	echo json_encode($Resultado);



     	} else {
            return Response::json("Please Select Excel File");
        //  	echo json_encode("Please Select Excel File");




        }
    }

    /*===================================================================================================================*/

    public function searchEspecieNoExiste(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        // $table = "especie_general"; 
        // $error = 0;
        
        // //get search term
        // $searchTerm = $_GET['term'];
        $searchTerm = $request->input('term');
        
        $consulta = EspecieGeneral::where([['Estado', 1],['Nombre','like','%'.$searchTerm.'%']])
                                    ->select('Nombre')
                                    ->orderBy('Nombre', 'ASC')
                                    ->get();
       
        // //get matched data from skills table
        // $query = $con->query("SELECT Nombre FROM $table WHERE Nombre LIKE '%".$searchTerm."%' AND Estado = 1 ORDER BY Nombre ASC");
        // $imagen = array();
        // $data = array();
        // while ($row = $query->fetch_assoc()) {
        //     $data[] = $row['Nombre'];
        // }
        $data = array();
         foreach ($consulta as $row) {
             $data[] = $row->Nombre;
         }
        
        // //return json data
        // echo json_encode(array('response' => $data));
        $response = array(            
            'data' => $data,
        );
        return Response::json($response);
    }


    /*===================================================================================================================*/

    public function searchSiepNoExiste(Request $request)
    {   
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        
        // $table = "centro"; 
        // $error = 0;
        
        // //get search term
        // $searchTerm = $_GET['term'];
        // $user_id = $_GET['user_id'];
        $searchTerm = $request->input('term');
        $user_id = $request->input('user_id');
        
        // //get matched data from skills table
        $consulta = Centro::select('Nombre','Codigo')
                                ->where(
                                    function($query) use ($searchTerm){
                                        $query->where('Nombre', 'like', '%'.$searchTerm.'%')
                                                ->orWhere('Codigo', 'like', '%'.$searchTerm.'%');
                                    })
                                ->where('IDempresa', $miuser->IDempresa)
                                ->orderBy('Nombre', 'ASC')
                                ->get();

        // $query = $con->query("SELECT Nombre,Codigo FROM $table WHERE ( Nombre LIKE '%".$searchTerm."%' OR Codigo LIKE '%".$searchTerm."%' ) 
        //AND IDempresa = (SELECT IDempresa FROM as_users WHERE user_id = '$user_id')  ORDER BY Nombre ASC");

        // $siep = array();
        // $data = array();
        // while ($row = $query->fetch_assoc()) {
        //     $data[] = $row['Codigo']." - ".$row['Nombre'];
        // }
        $data = array();
        foreach ($consulta as $row) {
            $data[] = $row->Codigo." - ".$row->Nombre;
        }
        
        // //return json data
        // echo json_encode(array('response' => $data));
        $response = array(            
            'data' => $data,
        );
        return Response::json($response);
    }

    /*===================================================================================================================*/

    public function saveEspecieNoExiste(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
                 $error = 0;

        //     $user_id = $_POST['user_id'];
        //     $Fecha_Medicion =$_POST['user_id'];
        //     $IDmedicion = $_POST['IDmedicion'];
        //     $Centro = $_POST['Centro'];
        //     $IDcentro = $_POST['IDcentro'];
        //     $Nombre_Especie = $_POST['Nombre_Especie'];
        //     $IDmedicionfan = $_POST['IDmedicionfan'];
        //     $Mortalidad = "";//$Medicion0_pambientalesotros[array_search($IDmortalidad, $IDpambientalesotros)];
                $user_id = $request->input('user_id');
                $Fecha_Medicion =$request->input('user_id');
                $IDmedicion = $request->input('IDmedicion');
                $Centro = $request->input('Centro');
                $IDcentro = $request->input('IDcentro');
                $Nombre_Especie = $request->input('Nombre_Especie');
                $IDmedicionfan = $request->input('IDmedicionfan');
                $Mortalidad = "";//$Medicion0_pambientalesotros[array_search($IDmortalidad, $IDpambientalesotros)];

        //     //IDempresa usuario
        //     $consulta1 = mysqli_query($con,"SELECT IDempresa FROM as_users WHERE user_id = '$user_id'")
        //     or die ($error ="Error description: " . mysqli_error($consulta1));
                $IDempresa = $miuser->IDempresa;

            for($i=0;$i<sizeof($Nombre_Especie);$i++){
                $Nombre_Especie_aux = $Nombre_Especie[$i];
                $IDmedicionfan_aux = $IDmedicionfan[$i];
                $consulta1 = EspecieGeneral::select('IDespecie_general')
                                                ->where('Nombre', $Nombre_Especie_aux)
                                                ->get();
                // mysqli_query($con,"SELECT IDespecie_general FROM especie_general WHERE Nombre = '$Nombre_Especie_aux' ")
                // or die ($error ="Error description 2.1: " . mysqli_error($con));
                // $row = mysqli_fetch_assoc($consulta1);
                $IDespecie_general = $consulta1->IDespecie_general;

                $consulta2 = Especie::select('IDespecie')
                                        ->where([['IDespecie_general', $IDespecie_general], 
                                                    ['IDempresa', $IDempresa]
                                                ])
                                        ->get();
                // mysqli_query($con,"SELECT IDespecie FROM especie WHERE IDespecie_general = '$IDespecie_general' AND IDempresa = '$IDempresa'  ")
                // or die ($error ="Error description 2.2: " . mysqli_error($con));
                // $row = mysqli_fetch_assoc($consulta2);
                $IDespecie = $consulta2->IDespecie;
                
                if(!$IDespecie && $IDespecie_general) { //Si no encuentra la especie, pero si está en especie_general. Se debe agregar al listado primero

                    $consulta = EspecieGeneral::select('IDespecie_general','Imagen','Detalle','Grupo','Nivel_Critico','Nombre')
                                                ->where('IDespecie_general', $IDespecie_general)
                                                ->get();


                    // mysqli_query($con,"SELECT IDespecie_general,Imagen,Detalle,Grupo,Nivel_Critico,Nombre FROM especie_general 
                    // WHERE IDespecie_general = '$IDespecie_general'")
                    // or die ($error ="Error description 2.3: " . mysqli_error($con));;

                    foreach($consulta as $row)
                    {
                        $Nombre = $row->Nombre;
                        $Imagen = $row->Imagen;
                        $Detalle = $row->Detalle;
                        $Grupo = $row->Grupo;
                        $Nivel_Critico = $row->Nivel_Critico;
                        $Nivel_Critico = ($Nivel_Critico==0)? 'NULL' : "'$Nivel_Critico'";
                    }

                    $consulta = Especie::insert([
                                            'IDempresa'=> $IDempresa,
                                            'IDespecie_general'=> $IDespecie_general,
                                            'Nombre'=> $Nombre,
                                            'Grupo'=> $Grupo,
                                            'Imagen'=> $Imagen,
                                            'Detalle'=> $Detalle,
                                            'Nivel_Critico'=> $Nivel_Critico,
                                            'Estado'=> '1'
                                            ]);
                    // mysqli_query($con,"INSERT INTO especie(IDempresa,IDespecie_general,Nombre,Grupo,Imagen,Detalle,Nivel_Critico,Estado) 
                    //                 VALUES ('$IDempresa', '$IDespecie_general', '$Nombre', '$Grupo', '$Imagen', '$Detalle', $Nivel_Critico,'1')")
                    //     or die ( $error ="Error description3: " . mysqli_error($con) );

                    $consulta = Especie::select('IDespecie')
                                            ->where([['IDespecie_general', $IDespecie_general],['IDempresa', $IDempresa],['Grupo', $Grupo]])
                                            ->get();
                    // mysqli_query($con,"SELECT IDespecie FROM especie 
                    // WHERE IDespecie_general = '$IDespecie_general' AND IDempresa = '$IDempresa' AND Grupo = '$Grupo' ")
                    // or die ( $error ="Error description4: " . mysqli_error($con) );
                    // $row = mysqli_fetch_assoc($consulta);
                    $IDespecie = $consulta->IDespecie;

                }

                //Actualizar las especies que no existen
                $consulta = MedicionFan::where('IDmedicionfan', $IDmedicionfan_aux)
                                            ->update([
                                                        'IDespecie'=> $IDespecie,
                                            ]);
                // mysqli_query($con,"UPDATE medicion_fan SET IDespecie = '$IDespecie' WHERE IDmedicionfan = '$IDmedicionfan_aux' ")
                // or die ( $error ="Error description5: " . mysqli_error($con) );

            }

            //Elimina las IDespecie con 0
                $consulta = MedicionFan::where([['IDmedicion', $IDmedicion],['IDespecie', 0]])
                                            ->delete();
                // mysqli_query($con,"DELETE FROM medicion_fan WHERE IDmedicion = '$IDmedicion' AND IDespecie = 0")
                // or die ( $error ="Error description6: " . mysqli_error($con) );


                //Alarma para todas las especies, (no solo las que fiscaliza serna)
                $consulta = MedicionFan::join('especie', 'especie.IDespecie', '=', 'medicion_fan.IDespecie')
                                            ->where([['medicion_fan.IDmedicion', $IDmedicion],
                                                        ['medicion_fan.IDespecie', 'especie.IDespecie' ]
                                                    ])
                                            ->select('medicion_fan.IDmedicionfan',
                                                        'medicion_fan.Medicion_1',
                                                        'medicion_fan.Medicion_2',
                                                        'medicion_fan.Medicion_3',
                                                        'medicion_fan.Medicion_4', 
                                                        'medicion_fan.Medicion_5',
                                                        'medicion_fan.Medicion_6', 
                                                        'medicion_fan.Medicion_7',
                                                        'especie.Alarma_Rojo',
                                                        'especie.Alarma_Amarillo',
                                                        'especie.Nombre', 
                                                        'especie.Nivel_Critico'
                                            )
                                            ->where(
                                                function($query){
                                                    $query->where('MedicionFan.Medicion_1','>=', DB::raw('especie.Alarma_Rojo'))
                                                            ->orWhere('MedicionFan.Medicion_2','>=', DB::raw('especie.Alarma_Rojo'))
                                                            ->orWhere('MedicionFan.Medicion_3','>=', DB::raw('especie.Alarma_Rojo'))
                                                            ->orWhere('MedicionFan.Medicion_4','>=', DB::raw('especie.Alarma_Rojo'))
                                                            ->orWhere('MedicionFan.Medicion_5','>=', DB::raw('especie.Alarma_Rojo'))
                                                            ->orWhere('MedicionFan.Medicion_6','>=', DB::raw('especie.Alarma_Rojo'))
                                                            ->orWhere('MedicionFan.Medicion_7','>=', DB::raw('especie.Alarma_Rojo'));
                                                }
                                            )
                                            ->where('especie.Alarma_Rojo', '>' , 0)
                                            ->get();

                // mysqli_query($con,"SELECT mf.IDmedicionfan,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4, mf.Medicion_5,
                //  mf.Medicion_6, 
                // mf.Medicion_7,e.Alarma_Rojo,e.Alarma_Amarillo,e.Nombre, e.Nivel_Critico 
                // FROM ( medicion_fan mf INNER JOIN especie e 
                // ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                // WHERE (mf.Medicion_1 >= e.Alarma_Rojo 
                // OR mf.Medicion_2 >= e.Alarma_Rojo 
                // OR mf.Medicion_3 >= e.Alarma_Rojo 
                // OR mf.Medicion_4 >= e.Alarma_Rojo 
                // OR mf.Medicion_5 >= e.Alarma_Rojo 
                // OR mf.Medicion_6 >= e.Alarma_Rojo
                // OR mf.Medicion_7 >= e.Alarma_Rojo) 
                // AND e.Alarma_Rojo > 0 ")
                //or die ($error ="Error description 2: " . mysqli_error($con));
                $alarma = "";
                $Comentario = array();
                $Comentario_precaucion = array();
                $Concentracion = array();
                $Nocivo = array();
                $Nocivo_P = array();
                $Concentracion_precaucion = array();
                $aux_prec = "";
                foreach($consulta as $row )
                {
                    $alarma = "Nivel Crítico";
                    $Comentario[] = $row->Nombre;
                    $Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                    $Nocivo[] = $row->Nivel_Critico;
        //			$datos_rojo['Alarma_Rojo'][] = $row['Alarma_Rojo'];
        //			$datos_rojo['Alarma_Amarillo'][] = $row['Alarma_Amarillo'];
        //			$datos_rojo['Medicion_1'][] = $row['Medicion_1'];
        //			$datos_rojo['Medicion_2'][] = $row['Medicion_2'];
        //			$datos_rojo['Medicion_3'][] = $row['Medicion_3'];
        //			$datos_rojo['Medicion_4'][] = $row['Medicion_4'];
                }

                if($alarma == ""){

                    $consulta = MedicionFan::join('especie', 'especie.IDespecie', '=', 'medicion_fan.IDespecie')
                                                ->where([['medicion_fan.IDmedicion', $IDmedicion],
                                                            ['medicion_fan.IDespecie', 'especie.IDespecie' ]
                                                        ])
                                                ->select('medicion_fan.IDmedicionfan',
                                                            'medicion_fan.Medicion_1',
                                                            'medicion_fan.Medicion_2',
                                                            'medicion_fan.Medicion_3',
                                                            'medicion_fan.Medicion_4', 
                                                            'medicion_fan.Medicion_5',
                                                            'medicion_fan.Medicion_6', 
                                                            'medicion_fan.Medicion_7',
                                                            'especie.Nombre', 
                                                            'especie.Nivel_Critico'
                                                )
                                                ->where(
                                                    function($query){
                                                        $query->where('MedicionFan.Medicion_1','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_2','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_3','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_4','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_5','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_6','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_7','>=', DB::raw('especie.Alarma_Amarillo'));
                                                    }
                                                )
                                                ->where('especie.Alarma_Amarillo', '>' , 0)
                                                ->get();
                    // mysqli_query($con,"SELECT mf.IDmedicionfan,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4, 
                    // mf.Medicion_5, mf.Medicion_6, mf.Medicion_7, e.Nombre, e.Nivel_Critico 
                    // FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    // WHERE (mf.Medicion_1 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_2 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_3 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_4 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_5 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_6 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_7 >= e.Alarma_Amarillo) 
                    // AND e.Alarma_Amarillo > 0 ")or die ($error ="Error description 3: " . mysqli_error($con));


                    foreach($consulta as $row)
                    {
                        $alarma = "Precaución";
                        $Comentario[] = $row->Nombre;
                        $Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                        $Nocivo[] = $row->Nivel_Critico;
                    }
                }else{
                    $consulta = MedicionFan::join('especie', 'especie.IDespecie', '=', 'medicion_fan.IDespecie')
                                                ->where([['medicion_fan.IDmedicion', $IDmedicion],
                                                            ['medicion_fan.IDespecie', 'especie.IDespecie' ]
                                                        ])
                                                ->select('medicion_fan.IDmedicionfan',
                                                            'medicion_fan.Medicion_1',
                                                            'medicion_fan.Medicion_2',
                                                            'medicion_fan.Medicion_3',
                                                            'medicion_fan.Medicion_4', 
                                                            'medicion_fan.Medicion_5',
                                                            'medicion_fan.Medicion_6', 
                                                            'medicion_fan.Medicion_7',
                                                            'especie.Nombre', 
                                                            'especie.Nivel_Critico'
                                                )
                                                ->where(
                                                    function($query){
                                                        $query->where('MedicionFan.Medicion_1','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_2','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_3','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_4','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_5','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_6','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_7','>=', DB::raw('especie.Alarma_Amarillo'));
                                                    }
                                                )
                                                ->where(
                                                    function($query){
                                                        $query->where('MedicionFan.Medicion_1','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_2','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_3','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_4','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_5','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_6','>=', DB::raw('especie.Alarma_Amarillo'))
                                                                ->orWhere('MedicionFan.Medicion_7','>=', DB::raw('especie.Alarma_Amarillo'));
                                                    }
                                                )
                                                ->where('especie.Alarma_Amarillo', '>' , 0)
                                                ->get();
                    // mysqli_query($con,"SELECT mf.IDmedicionfan,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4, mf.Medicion_5, 
                    // mf.Medicion_6, mf.Medicion_7, e.Nombre, e.Nivel_Critico 
                    // FROM ( medicion_fan mf INNER JOIN especie e ON (mf.IDespecie = e.IDespecie AND mf.IDmedicion = '$IDmedicion') ) 
                    // WHERE (mf.Medicion_1 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_2 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_3 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_4 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_5 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_6 >= e.Alarma_Amarillo 
                    // OR mf.Medicion_7 >= e.Alarma_Amarillo) 
                    // AND (mf.Medicion_1 < e.Alarma_Rojo 
                    // OR mf.Medicion_2 < e.Alarma_Rojo 
                    // OR mf.Medicion_3 < e.Alarma_Rojo 
                    // OR mf.Medicion_4 < e.Alarma_Rojo 
                    // OR mf.Medicion_5 < e.Alarma_Rojo 
                    // OR mf.Medicion_6 < e.Alarma_Rojo 
                    // OR mf.Medicion_7 < e.Alarma_Rojo) 
                    // AND e.Alarma_Amarillo > 0 ")or die ($error ="Error description 4: " . mysqli_error($con));


                    foreach($consulta as $row )
                    {
                        if(!in_array($row->Nombre, $Comentario)){
                            $Comentario_precaucion[] = $row->Nombre;
                            $Concentracion_precaucion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
                            $Nocivo_P[] = $row->Nivel_Critico;
                        }
                    }
                    $aux_prec = join(', ', $Comentario_precaucion);

                }

                if($alarma == ""){

                    $consulta =  MedicionFan::select('IDmedicionfan')
                                                ->where('IDmedicion', $IDmedicion)
                                                ->where(
                                                    function($query){
                                                        $query->where('Medicion_1', '>',0)
                                                                ->orWhere('Medicion_2', '>',0)
                                                                ->orWhere('Medicion_3', '>',0)
                                                                ->orWhere('Medicion_4', '>',0)
                                                                ->orWhere('Medicion_5', '>',0)
                                                                ->orWhere('Medicion_6', '>',0)
                                                                ->orWhere('Medicion_7', '>',0);

                                                    }
                                                )
                                                ->first();
                    // mysqli_query($con,"SELECT IDmedicionfan FROM medicion_fan 
                    // WHERE IDmedicion = '$IDmedicion' 
                    // AND (Medicion_1 > 0 
                    // OR Medicion_2 > 0 
                    // OR Medicion_3 > 0 
                    // OR Medicion_4 > 0 
                    // OR Medicion_5 > 0 
                    // OR Medicion_6 > 0
                    // OR Medicion_7 > 0) ")
                    // or die ($error ="Error description 5: " . mysqli_error($con));


                    if($consulta)
                    {
                        $alarma = "Presencia Microalgas";
                    }
                }


                if($alarma != ""){

                    $aux = join(', ', $Comentario);

                    $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                            ->update([
                                                'Estado_Alarma'=> $alarma,
                                                'Comentario' => $aux
                                            ]);
                    // mysqli_query($con,"UPDATE medicion SET Estado_Alarma = '$alarma', Comentario = '$aux' 
                    // WHERE IDmedicion = '$IDmedicion' ")
                    // or die ( $error ="Error description 6: " . mysqli_error($con) );

                }else{$alarma = "Ausencia Microalgas"; $aux = "";}


                //Guardar el registro (ya no como borrador)
                $consulta = Medicion::where('IDmedicion', $IDmedicion)
                                        ->update([
                                            'Estado'=>1
                                        ]);
            //     mysqli_query($con,"UPDATE medicion SET Estado = 1 WHERE IDmedicion = '$IDmedicion' ")
            // or die ( $error ="Error description 7: " . mysqli_error($con) );


            $Resultado = array('Error' =>$error, 
                                'Alarma' => $alarma,
                                'Nombre_Centro' => $Centro,
                                'IDcentro' => $IDcentro, 
                                'IDmedicion' => $IDmedicion, 
                                'Comentario' => $aux, 
                                'Concentracion' => $Concentracion, 
                                'Nocivo' => $Nocivo, 
                                'Nocivo_P' => $Nocivo_P, 
                                'Comentario_Precaucion' => $aux_prec, 
                                'Concentracion_Precaucion' => $Concentracion_precaucion, 
                                'Mortalidad' => $Mortalidad, 
                                'Fecha_Medicion' => $Fecha_Medicion );
            //echo json_encode($Resultado);
            return Response::json($Resultado);
    }

    /*===================================================================================================================*/

    public function deleteEspecieNoExiste(Request $request)
    {
                 $error = 0;

        //     $IDmedicion = $_POST['IDmedicion'];
        $IDmedicion = $request->input('IDmedicion');

        
        $consulta = MedicionFan::where([['IDmedicion', $IDmedicion],['IDespecie', 0]])
                                    ->delete();
        //     //Elimina las IDespecie con 0
        //     $consulta = mysqli_query($con,"DELETE FROM medicion_fan WHERE IDmedicion = '$IDmedicion' AND IDespecie = 0")
        // or die ( $error ="Error description: " . mysqli_error($consulta) );

        if($consulta != 0)
        {   
            $error ="Error description: " . PDO::errorInfo($consulta) ;
        }
        return Response::json($error);	
        //     echo json_encode($error);
    }

    /*===================================================================================================================*/

  
    /*===================================================================================================================*/
    public function getArchivo($fileid)
	{
		$miuser = Auth::user();   
        $this->cambiar_bd($miuser->IDempresa);
        $entry = Documento::find($fileid);
        
		$file = Storage::disk($miuser->IDempresa)->get('Archivos_Registros/'.$entry->Url);
 		//return Response::json($entry);
		
		return Response($file, 200)->header('Content-Type', $entry->Mime);
	
	}
    /*===================================================================================================================*/

    public function getImagenEspecie($fileid, $numImg)
	{
		$miuser = Auth::user();   
        $this->cambiar_bd($miuser->IDempresa);
        $entry = Especie::find($fileid);

		$file = Storage::disk($miuser->IDempresa)->get('Especies/'.$entry->Imagen);
 		//return Response::json($entry);
		if($numImg == 1){
            $file = Storage::disk($miuser->IDempresa)->get('Especies/'.$entry->Imagen);
            return Response($file, 200)->header('Content-Type', $entry->Mime);
        }else if($numImg == 2){
            $file = Storage::disk($miuser->IDempresa)->get('Especies/'.$entry->Imagen);
            return Response($file, 200)->header('Content-Type', 'image/png');
        }
        else if($numImg == 3){
            $file = Storage::disk($miuser->IDempresa)->get('Especies/'.$entry->Imagen);
            return Response($file, 200)->header('Content-Type', 'image/jpeg');
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
