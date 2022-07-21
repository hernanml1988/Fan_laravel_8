<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Barrio;
use App\Models\Centro;
use App\Models\CentrosProductivos;
use App\Models\Configuracion;
use App\Models\Documento;
use App\Models\Medicion;
use App\Models\MedicionFan;
use App\Models\Opciones;
use App\Models\Pambientales;
use App\Models\Region;
use App\Models\User;
use App\Models\UsuarioPermiso;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;







class HistorialController extends Controller
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

    public function loadRegistroCentros(Request $request)
    {

        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;	
        $limit = $request->input('limit');// $_GET['limit'];
        $offset = $request->input('offset');//$_GET['offset'];	
        $user_id = $miuser->id;//$_GET['user_id'];
        $IDcentro = $request->input('IDcentro');//$_GET['IDcentro'];
        $search = $request->input('search');//$_GET['IDcentro'];
         
        

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

    /*------------------------------------------------------------------------------------------------------------------------------*/

    public function loadOptionsProf()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
	
		$opciones = Opciones::where('IDempresa',$miuser->IDempresa)
								->where('Nombre','Profundidad')
								->select('Opciones')
								->first();
		
        return Response::json($opciones->Opciones);
    }

    /*------------------------------------------------------------------------------------------------------------------------------*/

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

    /*------------------------------------------------------------------------------------------------------------------------------*/

    public function loadPAmbientalesReporte(Request $request)//falta ruta
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        
		$error = 0;
		
		$IDmedicion = $request->input('IDmedicion');
		
		$PAmb = Pambientales::where('pambientales.Grupo','Columna de Agua')
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

    /*------------------------------------------------------------------------------------------------------------------------------*/

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

    /*------------------------------------------------------------------------------------------------------------------------------*/

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

    /*------------------------------------------------------------------------------------------------------------------------------*/

    public function loadTablaDescargas(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;
    
        $limit = $request->input('limit');//$_GET['limit'];
        $offset = $request->input('offset');//$_GET['offset'];
        $Centros = $request->input('Centros');//$_GET['Centros'];
        $Centros = str_replace('"', '', $Centros);
        $Centros = str_replace('"', '', $Centros);
        
        
        $Inicio = date('Y-m-d', strtotime($request->input('Inicio')));
        $Inicio = date('Y-m-d 00:00:00', strtotime($Inicio));
        $Termino = date('Y-m-d', strtotime($request->input('Termino'). ' +1 day'));
        $Termino = date('Y-m-d 00:00:00', strtotime($Termino));
        $user_id = $miuser->id;
        
        $Inicio = new \DateTime ($Inicio);
        $Termino = new \DateTime ($Termino);

        $start3 = microtime(true);
        if ($Centros == '') {
            echo json_encode(array(
                'total' => 0, 			// select count(*) from table ...
                'rows' => 0
            ));
            die();
        }
        //return response::json($Centros);
        $anio_periodo =$request->input('anio_periodo');
    
        if($anio_periodo>0){
    
            $consultaDesde = DB::connection('mysql')->table('centrosproductivos as cp')
                                                        ->whereYear('Siembra', $anio_periodo)
                                                        ->orderBy('Siembra', 'ASC')
                                                        ->select('*')
                                                        ->first();
                
                // mysqli_query($con,"SELECT * FROM centrosproductivos WHERE YEAR(Siembra) = $anio_periodo ORDER BY Siembra ASC LIMIT 1")
                // or die ($error ="Error description: " . mysqli_error($consultaDesde));
            $row_menor = $consultaDesde;
            if($row_menor){
                $Inicio = $row_menor->Siembra;
    
                $Inicio= $anio_periodo."-01-01 00:00:00";
            }
            $consultaHasta = DB::connection('mysql')->table('centrosproductivos as cp')
                                                    ->whereYear('Siembra', $anio_periodo)
                                                    ->orderBy('Siembra', 'ASC')
                                                    ->select('*')
                                                    ->first();
            // mysqli_query($con,"SELECT * FROM centrosproductivos WHERE YEAR(Siembra) = $anio_periodo ORDER BY Siembra DESC LIMIT 1")
            // or die ($error ="Error description: " . mysqli_error($consultaHesta));
            $row_mayor = $consultaHasta;
    
            if($row_mayor){
                $Termino = $row_mayor->Siembra;
                $Termino=$anio_periodo."-12-31 00:00:00";
            }
        }
    
    
    
        $estado_alarma = [];
        if ($request->input('Critico')) {
            $estado_alarma[] = 'Nivel';
        }
        if ($request->input('Precaucion')) {
            $estado_alarma[] = 'Precauci';
        }
        if ($request->input('Presencia')) {
            $estado_alarma[] = 'Presencia Microalgas';
        }
        if ($request->input('Ausencia')) {
            $estado_alarma[] = 'Ausencia Microalgas';
        }
        //$estado_alarma_aux = implode("','",$estado_alarma);
          $estado_alarma_aux = $estado_alarma;//implode("','",$estado_alarma);

           $Centros = explode(',', $Centros);
         //return Response::json($Centros);
        // IDempresa        
        $IDempresa = $miuser->IDempresa;
        
    
        $start0 = microtime(true);
        //Contar las filas
        //return Response::json($anio_periodo);
        if($anio_periodo>0){
    
            $consulta1 = DB::connection('mysql')->table('medicion as m')
                                                ->join('centrosproductivos as cp',function($query) use ($anio_periodo, $Centros){
                                                                                $query->on('cp.IDcentro', '=', 'm.IDcentro')  
                                                                                        ->whereBetween('m.Fecha_Reporte', ['cp.Siembra', 'cp.Cosecha'])
                                                                                        ->where('cp.estado', '=', 1)
                                                                                        ->whereYear('cp.Siembra', '=', $anio_periodo) 
                                                                                        ->whereIn('cp.IDcentro', $Centros);                                  
                                                                                        
                                                                                    })
                                                ->join('medicion_fan as mf', function($query) use ($Inicio,$Termino,$estado_alarma_aux){
                                                                                $query->on('m.IDmedicion', '=', 'mf.IDmedicion')  
                                                                                        ->where('m.Fecha_Reporte', '>=', $Inicio) 
                                                                                        ->where('m.Fecha_Reporte', '<=', $Termino) 
                                                                                        ->where('m.Estado', '=', 1)
                                                                                        ->Where(function ($query) use($estado_alarma_aux) {
                                                                                            for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                                                               $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                                                            }      
                                                                                        });
                                                                                    })
                                                ->join('especie', 'e.IDespecie', '=', 'mf.IDespecie')
                                                ->Where(function ($query) use($estado_alarma_aux) {
                                                    for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                       $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                    }      
                                                })
                                                ->select(DB::raw("count('mf.IDmedicionfan') as cuenta"))
                                                ->first();
                // DB::connection('mysql')->table('medicion as m')
                //                                 ->join('centrosproductivos as cp','cp.IDcentro', '=', 'm.IDcentro')
                //                                 ->whereIn('cp.IDcentro', $Centros)
                //                                 ->join('medicion_fan as mf', 'm.IDmedicion', '=', 'mf.IDmedicion')
                //                                 ->join('especie as e', 'e.IDespecie', '=', 'mf.IDespecie')
                //                                 ->whereBetween('m.Fecha_Reporte', ['cp.Siembra','cp.Cosecha'])
                //                                 ->where([['cp.estado', '=', 1],
                //                                             ['m.Fecha_Reporte', '>=', $Inicio],
                //                                             ['m.Fecha_Reporte', '<=', $Termino],
                //                                             ['m.Estado', '=', 1],
                //                                             ['m.Estado', '=', 1],
                //                                             [],
                //                                             ])
                //                                 ->whereYear('cp.Siembra', $anio_periodo)                                                
                //                                 ->whereIn('m.Estado_Alarma', $estado_alarma_aux)
                //                                 ->select('mf.IDmedicionfan as cuenta')
                //                                 ->count();
            //     DB::select("SELECT COUNT(mf.IDmedicionfan) as cuenta
            // FROM gtr_medicion m INNER JOIN gtr_centrosproductivos cp 
            // ON (cp.IDcentro = m.IDcentro 
            // AND m.Fecha_Reporte BETWEEN cp.Siembra AND cp.Cosecha 
            // AND cp.estado = 1 
            // AND YEAR(cp.Siembra) = $anio_periodo 
            // AND cp.IDcentro IN ('$Centros')) 
            // INNER JOIN gtr_medicion_fan mf 
            // ON (m.IDmedicion = mf.IDmedicion 
            // AND m.Fecha_Reporte >= '$Inicio' 
            // AND m.Fecha_Reporte <= '$Termino' 
            // AND m.Estado = 1 
            // AND m.IDcentro IN ('$Centros') ),  
            // gtr_especie e 
            // WHERE e.IDespecie = mf.IDespecie 
            // AND m.Estado_Alarma IN ('$estado_alarma_aux') ");
            

            
            
    
        }else{
    
            $consulta1 = DB::connection('mysql')->table('medicion as m')
                                                ->join('medicion_fan as mf', function($query) use ($Inicio,$Termino,$Centros){
                                                                               $query->on('m.IDmedicion', '=', 'mf.IDmedicion') 
                                                                                        ->where([['m.Fecha_Reporte', '>=', $Inicio],
                                                                                                    ['m.Fecha_Reporte', '<=', $Termino],
                                                                                                    ['m.Estado', '=', 1 ],])
                                                                                        ->whereIn('m.IDcentro', $Centros);                                                                                        
                                                                        })
                                                ->join('especie as e', 'e.IDespecie', '=', 'mf.IDespecie')
                                                ->Where(function ($query) use($estado_alarma_aux) {
                                                    for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                       $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                    }      
                                                })
                                                ->select(DB::raw("count('mf.IDmedicionfan') as cuenta"))
                                                ->first();
                                                //return Response::json($consulta1);
                // DB::connection('mysql')->table('medicion as m')
                // ->join('medicion_fan as mf', 'm.IDmedicion', '=', 'mf.IDmedicion' )
                // ->join('especie as e', 'e.IDespecie', '=', 'mf.IDespecie' )
                // ->where([['m.Fecha_Reporte', '>=', $Inicio],
                //             ['m.Fecha_Reporte', '<=', $Termino],
                //             ['m.Estado', '=', 1 ],])
                // ->whereIn('m.IDcentro', $Centros)
                // ->whereIn('m.Estado_Alarma', $estado_alarma_aux)
                // ->select('mf.IDmedicionfan as cuenta')
                // ->count();
            // DB::select("SELECT COUNT(mf.IDmedicionfan) as cuenta
            // FROM gtr_medicion m INNER JOIN gtr_medicion_fan mf 
            // ON (m.IDmedicion = mf.IDmedicion 
            // AND m.Fecha_Reporte >= '$Inicio' 
            // AND m.Fecha_Reporte <= '$Termino' 
            // AND m.Estado = 1 
            // AND m.IDcentro IN ('$Centros') ),  
            // especie e 
            // WHERE e.IDespecie = mf.IDespecie 
            // AND m.Estado_Alarma IN ('$estado_alarma_aux') ");
                                  


            
        }
         //return Response::json($consulta1);

        if($consulta1){
            $count1 = $consulta1->cuenta;
        }
        //return Response::json($count1);
        // echo json_encode($count1);
        // die();
        //Contar las filas
    
        if($anio_periodo>0){
    
    
            $consulta1 = DB::connection('mysql')->table('medicion as m')
                                                ->join('centrosproductivos as cp', 'cp.IDcentro', '=', 'm.IDcentro')
                                                ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro')
                                                ->whereBetween('m.Fecha_Reporte', ['cp.Siembra', 'cp.Cosecha'])
                                                ->whereYear('cp.Siembra', $anio_periodo)
                                                ->where([ ['cp.estado', '=', 1],
                                                            ['c.IDempresa', '=', $IDempresa],
                                                            ['m.Fecha_Reporte', '>=', $Inicio],
                                                            ['m.Fecha_Reporte'. '<=', $Termino],
                                                            ['m.Estado', '=', 1]])
                                                ->whereIn('cp.IDcentro', $Centros)
                                                ->whereIn('m.IDcentro', $Centros)
                                                ->Where(function ($query) use($estado_alarma_aux) {
                                                    for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                       $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                    }      
                                                })
                                                ->select(DB::raw("count('m.IDcentro') as cuenta"))
                                                ->first();

            // mysqli_query($con,"SELECT COUNT(m.IDcentro) as cuenta
            // FROM medicion m INNER JOIN centrosproductivos cp 
            // ON (cp.IDcentro = m.IDcentro 
            // AND m.Fecha_Reporte BETWEEN cp.Siembra AND cp.Cosecha 
            // AND cp.estado = 1 
            // AND YEAR(cp.Siembra) = $anio_periodo 
            // AND cp.IDcentro IN ('$Centros')) 
            // INNER JOIN centro c 
            // ON (c.IDcentro = m.IDcentro 
            // AND m.Estado_Alarma = 'Ausencia Microalgas' 
            // AND m.IDcentro IN ('$Centros') 
            // AND c.IDempresa = '$IDempresa' 
            // AND m.Fecha_Reporte >= '$Inicio' 
            // AND m.Fecha_Reporte <= '$Termino' 
            // AND m.Estado = 1 
            // AND m.Estado_Alarma IN ('$estado_alarma_aux') ) ")
            // or die ($error ="Error description: " . mysqli_error($consulta1));
    
        }else{
    
            $consulta1 = DB::connection('mysql')->table('medicion as m')
                                                ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro')
                                                ->where([['c.IDempresa', '=', $IDempresa ],
                                                        ['m.Fecha_Reporte', '>=', $Inicio],
                                                        ['m.Fecha_Reporte', '<=', $Termino],
                                                        ['m.Estado', '=', 1]])
                                                ->whereIn('m.IDcentro', $Centros)
                                                ->Where(function ($query) use($estado_alarma_aux) {
                                                    for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                       $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                    }      
                                                })
                                                ->select(DB::raw("count('m.IDcentro') as cuenta"))
                                                ->first();


            // mysqli_query($con,"SELECT COUNT(m.IDcentro) as cuenta
            // FROM medicion m  INNER JOIN centro c 
            // ON (c.IDcentro = m.IDcentro 
            // AND m.Estado_Alarma = 'Ausencia Microalgas' 
            // AND c.IDempresa = '$IDempresa' 
            // AND m.Fecha_Reporte >= '$Inicio' 
            // AND m.Fecha_Reporte <= '$Termino' 
            // AND m.Estado = 1 
            // AND m.IDcentro IN ('$Centros') 
            // AND m.Estado_Alarma IN ('$estado_alarma_aux') ) ")
            // or die ($error ="Error description: " . mysqli_error($consulta1));
    
        }
    
       
        //return Response::json($row1);
        if($consulta1){
            $count = $consulta1->cuenta + $count1;
        }
        //return response::json($count);
    
        $time_elapsed_secs0 = microtime(true) - $start0;
    
        $start1 = microtime(true);
    
        //Ausencia Microalgas
    
        if($anio_periodo>0){
    
    
    
            $consulta = DB::connection('mysql')->table('medicion as m')
                                                            ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro'  )
                                                            ->join('centrosproductivos as cp', 'cp.IDcentro', '=', 'm.IDcentro')
                                                            ->join('region as r', 'c.IDregion', '=', 'r.IDregion')
                                                            ->join('area as a', 'c.IDarea', '=', 'a.IDarea')
                                                            ->join('barrio as b', 'c.IDbarrio', '=', 'b.IDbarrio')
                                                            ->whereYear('cp.Siembra', $anio_periodo)
                                                            ->whereBetween('m.Fecha_Reporte', ['cp.Siembra','cp.Cosecha' ])
                                                            ->whereIn('m.IDcentro', $Centros)
                                                            ->Where(function ($query) use($estado_alarma_aux) {
                                                                for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                                   $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                                }      
                                                            })
                                                            ->whereIn('cp.IDcentro', $Centros)
                                                            ->where([['c.IDempresa', '=', $IDempresa],
                                                                    ['m.Estado', '=', 1],
                                                                    ['cp.estado', '=', 1]])
                                                            ->offset($offset)
                                                            ->limit($limit)
                                                            ->orederBy('Fecha_Order', 'DESC')
                                                            ->select(
                                                            DB::raw("DATE_FORMAT(gtr_cp.Siembra, '%d-%m-%Y %H:%i:%s') as Siembra"), 
                                                            DB::raw("DATE_FORMAT(gtr_cp.Cosecha, '%d-%m-%Y %H:%i:%s') as Cosecha"), 
                                                            DB::raw("DATE_FORMAT(gtr_m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio"),
                                                            DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio"), 
                                                            DB::raw("CAST(gtr_m.Fecha_Envio AS TIME) as Time_Envio"), 
                                                            DB::raw("DATE_FORMAT(gtr_m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte"), 
                                                            DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
                                                            DB::raw("CAST(gtr_m.Fecha_Reporte AS TIME) as Time_Reporte, m.Fecha_Analisis"), 
                                                            DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis"),
                                                            DB::raw("CAST(gtr_m.Fecha_Analisis AS TIME) as Time_Analisis"), 
                                                            'm.Fecha_Reporte as Fecha_Order', 
                                                            'm.Estado_Alarma', 
                                                            'm.Tecnica', 
                                                            'm.Observaciones', 
                                                            'm.Firma', 
                                                            DB::raw(" '' as Medicion_1"),
                                                            DB::raw(" '' as Medicion_2"), 
                                                            DB::raw(" '' as Medicion_3"), 
                                                            DB::raw(" '' as Medicion_4"), 
                                                            DB::raw(" '' as Medicion_5"), 
                                                            DB::raw(" '' as Medicion_6"), 
                                                            DB::raw(" '' as Medicion_7"),
                                                            DB::raw(" '' as Nombre_Especie"), 
                                                            DB::raw(" '' as Grupo"),
                                                            DB::raw(" '' as Fiscaliza"), 
                                                            DB::raw(" '' as Nociva"),
                                                            DB::raw(" '' as Nivel_Critico"), 
                                                            DB::raw(" '' as Alarma_Rojo"), 
                                                            DB::raw(" '' as Alarma_Amarillo"), '"" as Medicion_1',
                                                            'a.Nombre as Area', 
                                                            'b.Nombre as Barrio', 
                                                            'r.Nombre as Region', 
                                                            'c.Nombre as Centro')
                                                            ->get();

           
            // mysqli_query($con,"SELECT   DATE_FORMAT(cp.Siembra, '%d-%m-%Y %H:%i:%s') as Siembra, 
            // DATE_FORMAT(cp.Cosecha, '%d-%m-%Y %H:%i:%s') as Cosecha, 
            // DATE_FORMAT(m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio,
            // DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio, 
            // CAST(m.Fecha_Envio AS TIME) as Time_Envio, 
            // DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte, 
            // DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,
            // CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, m.Fecha_Analisis, 
            // DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,
            // CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, 
            // m.Fecha_Reporte as Fecha_Order, 
            // m.Estado_Alarma, 
            // m.Tecnica, 
            // m.Observaciones, 
            // m.Firma, 
            // '' as Medicion_1,
            // '' as Medicion_2, 
            // '' as Medicion_3, 
            // '' as Medicion_4, 
            // '' as Medicion_5, 
            // '' as Medicion_6, 
            // '' as Medicion_7,
            // '' as Nombre_Especie, 
            // '' as Grupo,
            // '' as Fiscaliza, 
            // '' as Nociva,
            // '' as Nivel_Critico, 
            // '' as Alarma_Rojo, 
            // '' as Alarma_Amarillo, 
            // a.Nombre as Area, 
            // b.Nombre as Barrio, 
            // r.Nombre as Region, 
            // c.Nombre as Centro
            // FROM medicion m  INNER JOIN centro c 
            // ON (c.IDcentro = m.IDcentro 
            // AND m.Estado_Alarma = 'Ausencia Microalgas' 
            // AND m.IDcentro IN ('$Centros') 
            // AND c.IDempresa = '$IDempresa' 
            // AND m.Estado = 1 ) 
            // INNER JOIN centrosproductivos cp 
            // ON (cp.IDcentro = m.IDcentro 
            // AND m.Fecha_Reporte BETWEEN cp.Siembra AND cp.Cosecha 
            // AND cp.estado = 1 
            // AND YEAR(cp.Siembra) = $anio_periodo 
            // AND cp.IDcentro IN ('$Centros')),
            // region r, area a, barrio b  
            // WHERE  c.IDregion = r.IDregion 
            // AND c.IDarea = a.IDarea 
            // AND c.IDbarrio = b.IDbarrio 
            // AND m.Estado_Alarma IN ('$estado_alarma_aux') 
            // ORDER BY Fecha_Order DESC LIMIT $offset,$limit ")
            // or die ($error ="Error description: " . mysqli_error($consulta));
    
    
    
        }else{
            //return Response::json($estado_alarma_aux);
            $consulta = DB::connection('mysql')->table('medicion as m')
                                                ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro')
                                                ->join('region as r', 'c.IDregion', '=', 'r.IDregion')
                                                ->join('area as a', 'c.IDarea', '=', 'a.IDarea')
                                                ->join('barrio as b', 'c.IDbarrio', '=', 'b.IDbarrio')
                                                ->whereIn('m.IDcentro', $Centros)
                                                                                                
                                                ->where([   ['m.Estado_Alarma', '=', 'Ausencia Microalgas' ],
                                                            ['c.IDempresa', '=', $IDempresa],
                                                            ['m.Fecha_Reporte', '>=', $Inicio],
                                                            ['m.Fecha_Reporte', '<=', $Termino],
                                                            ['m.Estado', '=', 1]
                                                            ])
                                                ->offset($offset)
                                                ->limit($limit)
                                                ->select(
                                                DB::raw("DATE_FORMAT(gtr_m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio"),
                                                DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio"),
                                                DB::raw("CAST(gtr_m.Fecha_Envio AS TIME) as Time_Envio"), 
                                                DB::raw("DATE_FORMAT(gtr_m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte"), 
                                                DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
                                                DB::raw("CAST(gtr_m.Fecha_Reporte AS TIME) as Time_Reporte"), 
                                                'm.Fecha_Analisis', 
                                                DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis"),
                                                DB::raw("CAST(gtr_m.Fecha_Analisis AS TIME) as Time_Analisis"), 
                                                'm.Fecha_Reporte as Fecha_Order', 
                                                'm.Estado_Alarma', 
                                                'm.Tecnica', 
                                                'm.Observaciones', 
                                                'm.Firma', 
                                                DB::raw(" '' as Medicion_1"),
                                                DB::raw(" '' as Medicion_2"), 
                                                DB::raw(" '' as Medicion_3"), 
                                                DB::raw(" '' as Medicion_4"), 
                                                DB::raw(" '' as Medicion_5"), 
                                                DB::raw(" '' as Medicion_6"), 
                                                DB::raw(" '' as Medicion_7"),
                                                DB::raw(" '' as Nombre_Especie"), 
                                                DB::raw(" '' as Grupo"),
                                                DB::raw(" '' as Fiscaliza"), 
                                                DB::raw(" '' as Nociva"),
                                                DB::raw(" '' as Nivel_Critico"), 
                                                DB::raw(" '' as Alarma_Rojo"), 
                                                DB::raw(" '' as Alarma_Amarillo"), 
                                                'a.Nombre as Area', 
                                                'b.Nombre as Barrio', 
                                                'r.Nombre as Region', 
                                                'c.Nombre as Centro')
                                                ->orderBy('Fecha_Order', 'DESC')
                                                ->get();
                                            //return Response::json($consulta);
                //     mysqli_query($con,"SELECT 
                //     DATE_FORMAT(m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio,
                //     DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,
                //     CAST(m.Fecha_Envio AS TIME) as Time_Envio, 
                //     DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte, 
                //     DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,
                //     CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, m.Fecha_Analisis, 
                //     DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,
                //     CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, 
                //     m.Fecha_Reporte as Fecha_Order, 
                //     m.Estado_Alarma, 
                //     m.Tecnica, 
                //     m.Observaciones, 
                //     m.Firma, 
                //     '' as Medicion_1, 
                //     '' as Medicion_2, 
                //     '' as Medicion_3, 
                //     '' as Medicion_4, 
                //     '' as Medicion_5, 
                //     '' as Medicion_6, 
                //     '' as Medicion_7,
                //     '' as Nombre_Especie, 
                //     '' as Grupo,
                //     '' as Fiscaliza, 
                //     '' as Nociva,
                //     '' as Nivel_Critico, 
                //     '' as Alarma_Rojo, 
                //     '' as Alarma_Amarillo, 
                //     a.Nombre as Area, 
                //     b.Nombre as Barrio, 
                //     r.Nombre as Region, 
                //     c.Nombre as Centro
                //    FROM medicion m INNER JOIN centro c 
                //    ON (c.IDcentro = m.IDcentro 
                //    AND m.Estado_Alarma = 'Ausencia Microalgas' 
                //    AND m.IDcentro IN ('$Centros') 
                //    AND c.IDempresa = '$IDempresa' 
                //    AND m.Fecha_Reporte >= '$Inicio' 
                //    AND m.Fecha_Reporte <= '$Termino' 
                //    AND m.Estado = 1 ), 
                //    region r, area a, barrio b  
                //    WHERE  c.IDregion = r.IDregion 
                //    AND c.IDarea = a.IDarea 
                //    AND c.IDbarrio = b.IDbarrio 
                //    AND m.Estado_Alarma IN ('$estado_alarma_aux') 
                //    ORDER BY Fecha_Order DESC LIMIT $offset,$limit ")
                // or die ($error ="Error description: " . mysqli_error($consulta));
    
        }
    
    
        $Resultado1 = array();
        foreach($consulta as $row)
        {
            $Resultado1[]  = $row;
    
        }
    
            $time_elapsed_secs1 = microtime(true) - $start1;
    
    
        // FROM medicion m LEFT JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.Fecha_Reporte >= '$Inicio' AND m.Fecha_Reporte <= '$Termino' AND m.Estado = 1 AND m.IDcentro IN ('$Centros'))
        //	   LEFT JOIN centro c ON (c.IDcentro = m.IDcentro AND c.IDempresa = '$IDempresa')
        //	   LEFT JOIN especie e ON (e.IDespecie = mf.IDespecie)
        //	   LEFT JOIN region r ON (c.IDregion = r.IDregion)
        //	   LEFT JOIN area a ON (c.IDarea = a.IDarea)
        //	   LEFT JOIN barrio b ON (c.IDbarrio = b.IDbarrio)
        //	   WHERE m.Fecha_Reporte >= '$Inicio' AND m.Fecha_Reporte <= '$Termino' AND m.Estado = 1 AND m.IDcentro IN ('$Centros')
        
        
        
        //FROM medicion m INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.Fecha_Reporte >= '$Inicio' AND m.Fecha_Reporte <= '$Termino' AND m.Estado = 1 AND m.IDcentro IN ('$Centros') ), especie e, region r, area a, barrio b, centro c WHERE e.IDespecie = mf.IDespecie AND c.IDregion = r.IDregion AND c.IDarea = a.IDarea AND c.IDbarrio = b.IDbarrio AND c.IDcentro = m.IDcentro AND c.IDempresa = '$IDempresa'
    
            $start2 = microtime(true);
    
    
            if($anio_periodo>0){
    
                
                $consulta = DB::connection('mysql')->table('medicion as m')
                                                    ->join('centrosproductivos as cp', 'cp.IDcentro', '=', 'm.IDcentro')
                                                    ->join('medicion_fan as mf', 'm.IDmedicion', '=', 'mf.IDmedicion')
                                                    ->join('especie as e', 'e.IDespecie', '=', 'mf.IDespecie')
                                                    ->join('region as r', 'c.IDregion', '=', 'r.IDregion')
                                                    ->join('area as a', 'c.IDarea', '=', 'a.IDarea')
                                                    ->join('barrio as b', 'c.IDbarrio', '=', 'b.IDbarrio')
                                                    ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro')
                                                    ->whereBetween('m.Fecha_Reporte', ['cp.Siembra', 'cp.Cosecha'])
                                                    ->WhereYear('cp.Siembra', $anio_periodo)
                                                    ->whereIn('cp.IDcentro', $Centros)
                                                    ->whereIn('m.IDcentro', $Centros)
                                                    ->Where(function ($query) use($estado_alarma_aux) {
                                                        for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                           $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                        }      
                                                    })
                                                    ->where([['m.Fecha_Reporte', '>=', $Inicio],['m.Fecha_Reporte', '<=', $Termino],
                                                            ['m.Estado', '=', 1],['cp.estado', '=', 1],['c.IDempresa', '=', $IDempresa]])
                                                    ->offset($offset)
                                                    ->limit($limit)
                                                    ->select(DB::raw("DATE_FORMAT(gtr_cp.Siembra, '%d-%m-%Y %H:%i:%s') as Siembra"),
                                                    DB::raw("DATE_FORMAT(gtr_cp.Cosecha, '%d-%m-%Y %H:%i:%s') as Cosecha"), 
                                                    DB::raw("DATE_FORMAT(gtr_m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio"),
                                                    DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio"),
                                                    DB::raw("CAST(gtr_m.Fecha_Envio AS TIME) as Time_Envio"), 
                                                    DB::raw("DATE_FORMAT(gtr_m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte"), 
                                                    DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
                                                    DB::raw("CAST(gtr_m.Fecha_Reporte AS TIME) as Time_Reporte, m.Fecha_Analisis"), 
                                                    DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis"),
                                                    DB::raw("CAST(gtr_m.Fecha_Analisis AS TIME) as Time_Analisis"), 
                                                    'm.Fecha_Reporte as Fecha_Order', 
                                                    'm.Estado_Alarma', 
                                                    'm.Tecnica', 
                                                    'm.Observaciones', 
                                                    'm.Firma', 
                                                    'mf.Medicion_1',
                                                    'mf.Medicion_2', 
                                                    'mf.Medicion_3', 
                                                    'mf.Medicion_4', 
                                                    'mf.Medicion_5', 
                                                    'mf.Medicion_6', 
                                                    'mf.Medicion_7',
                                                    'e.Nombre as Nombre_Especie', 
                                                    'e.Grupo',
                                                    DB::raw("CASE WHEN gtr_e.Fiscaliza = '1' THEN 'Si' ELSE '' END as Fiscaliza"),
                                                    DB::raw("CASE WHEN gtr_e.Nociva = '1' THEN 'Nociva' ELSE '' END as Nociva"),
                                                    'e.Nivel_Critico', 
                                                    'e.Alarma_Rojo', 
                                                    'e.Alarma_Amarillo', 
                                                    'a.Nombre as Area', 
                                                    'b.Nombre as Barrio', 
                                                    'r.Nombre as Region', 
                                                    'c.Nombre as Centro')
                                                    ->orderBy('Fecha_Order', 'DESC')
                                                    ->get();
                                                    //return response::json($consulta); 
                    //         mysqli_query($con,"SELECT 
                    //         DATE_FORMAT(cp.Siembra, '%d-%m-%Y %H:%i:%s') as Siembra,
                    //         DATE_FORMAT(cp.Cosecha, '%d-%m-%Y %H:%i:%s') as Cosecha, 
                    //         DATE_FORMAT(m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio,
                    //         DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,
                    //         CAST(m.Fecha_Envio AS TIME) as Time_Envio, 
                    //         DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte, 
                    //         DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,
                    //         CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, m.Fecha_Analisis, 
                    //         DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,
                    //         CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, 
                    //         m.Fecha_Reporte as Fecha_Order, 
                    //         m.Estado_Alarma, 
                    //         m.Tecnica, 
                    //         m.Observaciones, 
                    //         m.Firma, 
                    //         mf.Medicion_1,
                    //         mf.Medicion_2, 
                    //         mf.Medicion_3, 
                    //         mf.Medicion_4, 
                    //         mf.Medicion_5, 
                    //         mf.Medicion_6, 
                    //         mf.Medicion_7,
                    //         e.Nombre as Nombre_Especie, 
                    //         e.Grupo,
                    //         CASE
                    //                 WHEN e.Fiscaliza = '1'
                    //                 THEN 'Si'
                    //                 ELSE ''
                    //         END as Fiscaliza,
                    //         CASE
                    //                 WHEN e.Nociva = '1'
                    //                 THEN 'Nociva'
                    //                 ELSE ''
                    //         END as Nociva,
                    //         e.Nivel_Critico, 
                    //         e.Alarma_Rojo, 
                    //         e.Alarma_Amarillo, 
                    //         a.Nombre as Area, 
                    //         b.Nombre as Barrio, 
                    //         r.Nombre as Region, 
                    //         c.Nombre as Centro
                
                    //     FROM medicion m INNER JOIN centrosproductivos cp 
                    //     ON (cp.IDcentro = m.IDcentro 
                    //     AND m.Fecha_Reporte BETWEEN cp.Siembra AND cp.Cosecha 
                    //     AND cp.estado = 1 
                    //     AND YEAR(cp.Siembra) = $anio_periodo 
                    //     AND cp.IDcentro IN ('$Centros')) 
                    //     INNER JOIN medicion_fan mf ON 
                    //     (m.IDmedicion = mf.IDmedicion 
                    //     AND m.Fecha_Reporte >= '$Inicio' 
                    //     AND m.Fecha_Reporte <= '$Termino' 
                    //     AND m.Estado = 1 
                    //     AND m.IDcentro IN ('$Centros') ), 
                    //     especie e, 
                    //     region r, 
                    //     area a, 
                    //     barrio b, 
                    //     centro c 
                    //     WHERE e.IDespecie = mf.IDespecie 
                    //     AND c.IDregion = r.IDregion 
                    //     AND c.IDarea = a.IDarea 
                    //     AND c.IDbarrio = b.IDbarrio 
                    //     AND c.IDcentro = m.IDcentro 
                    //     AND c.IDempresa = '$IDempresa' 
                    //     AND m.Estado_Alarma IN ('$estado_alarma_aux')    
                    //     ORDER BY Fecha_Order DESC LIMIT $offset,$limit ")
                    // or die ($error ="Error description: " . mysqli_error($consulta));
    
    
            }else{
                
    
    
                $consulta = DB::connection('mysql')->table('medicion as m')
                                                    ->join('medicion_fan as mf', 'm.IDmedicion', '=', 'mf.IDmedicion' )
                                                    ->join('especie as e', 'e.IDespecie', '=', 'mf.IDespecie'  )
                                                    ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro' )
                                                    ->join('barrio as b', 'c.IDbarrio', '=', 'b.IDbarrio' )
                                                    ->join('area as a', 'c.IDarea', '=', 'a.IDarea')
                                                    ->join('region as r', 'c.IDregion', '=', 'r.IDregion' )
                                                    ->whereIn('m.IDcentro', $Centros)
                                                    ->Where(function ($query) use($estado_alarma_aux) {
                                                        for ($i = 0; $i < count($estado_alarma_aux); $i++){
                                                           $query->orwhere('m.Estado_Alarma', 'like',  '%' . $estado_alarma_aux[$i] .'%');
                                                        }      
                                                    })
                                                    ->where([['m.Fecha_Reporte', '>=', $Inicio],['m.Fecha_Reporte', '<=', $Termino],
                                                                ['m.Estado', '=', 1], ['c.IDempresa', '=', $IDempresa]])
                                                    ->offset($offset)
                                                    ->limit($limit)
                                                    ->select(
                                                        DB::raw("DATE_FORMAT(gtr_m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio"),
                                                        DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio"),
                                                        DB::raw("CAST(gtr_m.Fecha_Envio AS TIME) as Time_Envio"), 
                                                        DB::raw("DATE_FORMAT(gtr_m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte"), 
                                                        DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
                                                        DB::raw("CAST(gtr_m.Fecha_Reporte AS TIME) as Time_Reporte"),
                                                        'm.Fecha_Analisis', 
                                                        DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis"),
                                                        DB::raw("CAST(gtr_m.Fecha_Analisis AS TIME) as Time_Analisis"),
                                                        'm.Fecha_Reporte as Fecha_Order', 
                                                        'm.Estado_Alarma', 
                                                        'm.Tecnica', 
                                                        'm.Observaciones', 
                                                        'm.Firma', 
                                                        'mf.Medicion_1',
                                                        'mf.Medicion_2', 
                                                        'mf.Medicion_3', 
                                                        'mf.Medicion_4', 
                                                        'mf.Medicion_5', 
                                                        'mf.Medicion_6', 
                                                        'mf.Medicion_7',
                                                        'e.Nombre as Nombre_Especie', 
                                                        'e.Grupo',
                                                        DB::raw("CASE WHEN gtr_e.Fiscaliza = '1' THEN 'Si' ELSE '' END as Fiscaliza"),
                                                        DB::raw("CASE WHEN gtr_e.Nociva = '1' THEN 'Nociva' ELSE '' END as Nociva"),
                                                        'e.Nivel_Critico', 
                                                        'e.Alarma_Rojo', 
                                                        'e.Alarma_Amarillo', 
                                                        'a.Nombre as Area', 
                                                        'b.Nombre as Barrio', 
                                                        'r.Nombre as Region', 
                                                        'c.Nombre as Centro'
                                                    )
                                                    ->orderBy('Fecha_Order', 'DESC')
                                                    ->get();
                              //return response::json($consulta);                           
                            // mysqli_query($con,"SELECT DATE_FORMAT(m.Fecha_Envio, '%d-%m-%Y %H:%i:%s') as Fecha_Envio,
                            // DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,
                            // CAST(m.Fecha_Envio AS TIME) as Time_Envio, 
                            // DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i:%s') as Fecha_Reporte, 
                            // DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,
                            // CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, m.Fecha_Analisis, 
                            // DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,
                            // CAST(m.Fecha_Analisis AS TIME) as Time_Analisis,
                            // m.Fecha_Reporte as Fecha_Order, 
                            // m.Estado_Alarma, 
                            // m.Tecnica, 
                            // m.Observaciones, 
                            // m.Firma, 
                            // mf.Medicion_1,
                            // mf.Medicion_2, 
                            // mf.Medicion_3, 
                            // mf.Medicion_4, 
                            // mf.Medicion_5, 
                            // mf.Medicion_6, 
                            // mf.Medicion_7,
                            // e.Nombre as Nombre_Especie, e.Grupo,
                            // CASE
                            //         WHEN e.Fiscaliza = '1'
                            //         THEN 'Si'
                            //         ELSE ''
                            // END as Fiscaliza,
                            // CASE
                            //         WHEN e.Nociva = '1'
                            //         THEN 'Nociva'
                            //         ELSE ''
                            // END as Nociva,
                            // e.Nivel_Critico, 
                            // e.Alarma_Rojo, 
                            // e.Alarma_Amarillo, 
                            // a.Nombre as Area, 
                            // b.Nombre as Barrio, 
                            // r.Nombre as Region, 
                            // c.Nombre as Centro
                
                            // FROM medicion m  INNER JOIN medicion_fan mf ON 
                            // (m.IDmedicion = mf.IDmedicion 
                            // AND m.Fecha_Reporte >= '$Inicio' 
                            // AND m.Fecha_Reporte <= '$Termino' 
                            // AND m.Estado = 1 
                            // AND m.IDcentro IN ('$Centros') ), 
                            // especie e, 
                            // region r, 
                            // area a, 
                            // barrio b, 
                            // centro c 
                            // WHERE e.IDespecie = mf.IDespecie 
                            // AND c.IDregion = r.IDregion 
                            // AND c.IDarea = a.IDarea 
                            // AND c.IDbarrio = b.IDbarrio 
                            // AND c.IDcentro = m.IDcentro 
                            // AND c.IDempresa = '$IDempresa' 
                            // AND m.Estado_Alarma IN ('$estado_alarma_aux')
                            // ORDER BY Fecha_Order DESC LIMIT $offset,$limit ")
                            // or die ($error ="Error description: " . mysqli_error($consulta));
    
    
            }
    
    
    
        $Resultado2 = array();
        foreach($consulta as $row)
        {
            $Resultado2[]  = $row;
    
        }
        $time_elapsed_secs2 = microtime(true) - $start2;
    
    
        $start = microtime(true);
        $Resultado = array_merge($Resultado2,$Resultado1);
    
    
        $fecha = array();
        foreach ($Resultado as $key => $row) {
            $fecha[$key] = strtotime($row->Fecha_Order);
        }
    
        array_multisort($fecha, SORT_DESC, $Resultado);
    
        $time_elapsed_secs = microtime(true) - $start;
    
        $time_elapsed_secs3 = microtime(true) - $start3;
    
         return Response::json(array(
            'total' => $count, 			// select count(*) from table ...
            'rows' => $Resultado, 	  // select * from table limit ...
            'Sort' => $time_elapsed_secs,
            'R0' => $time_elapsed_secs0,
            'R1' => $time_elapsed_secs1,
            'R2' => $time_elapsed_secs2,
            'Inicio' => $Inicio,
            'Termino' => $Termino,
            'TODO' => $time_elapsed_secs3,
            '$Centros' => $Centros
        ));
    
        //echo json_encode($Resultado);




    }

    /*------------------------------------------------------------------------------------------------------------------------------*/


    public function saveHistorialDescarga(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $error = 0;
	
        $Modificacion = $request->input('Modificacion'); //$_POST['Modificacion'];
        $Observaciones = $request->input('Observaciones');//$_POST['Observaciones'];
        $user_id = $miuser->id;
        $IDempresa = $miuser->IDempresa;
        $Firma = $miuser->name;

        date_default_timezone_set('america/santiago');
        $fecha = date('Y-m-d H:i:s');
        
        
            
        $consulta = new Configuracion;
        $consulta->IDempresa = $IDempresa;
        $consulta->Fecha = $fecha;
        $consulta->Modificacion = $Modificacion;
        $consulta->Observaciones = $Observaciones;
        $consulta->Firma = $Firma;
        $consulta->save();


        // mysqli_query($con,"INSERT INTO configuracion(IDempresa, Fecha, Modificacion, Observaciones, Firma) 
        // VALUES ('$IDempresa', '$fecha', '$Modificacion', '$Observaciones', '$Firma')" )or die ( $error ="Error description: " . mysqli_error($consulta) );

        
                
        
        echo json_encode($error);
    }

    /*------------------------------------------------------------------------------------------------------------------------------*/


    public function loadDistribucionDescargas(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;
        $user_id = $miuser->id;

        //IDempresa usuario
        // $consulta1 = mysqli_query($con,"SELECT IDempresa,user_role FROM as_users WHERE user_id = '$user_id'")
        // or die ($error ="Error description: " . mysqli_error($con));
        // $row = mysqli_fetch_assoc($consulta1);
        $IDempresa = $miuser->IDempresa;
        $UserRole = $miuser->user_role;

        //Para el caso de ser centro => sólo debe descargar su propio centro o los que tenga autorizados
        $where_id_centros = " ";
        if ($UserRole == 8) {
            $consulta = UsuarioPermiso::where([['user_id', $miuser->id],['IDempresa', $IDempresa]])
                                        ->distinct()
                                        ->get(['IDcentro']);
                                        
            // mysqli_query($con,"SELECT DISTINCT IDcentro FROM usuario_permiso WHERE  user_id = '$user_id' and IDempresa = '$IDempresa' ")
            // or die ($error ="Error description1: " . mysqli_error($con));

            $id_centros_user = array();
            foreach($consulta as $row)
            {
                $id_centros_user[]  = $row->IDcentro;
            }
                /* ===========???????============ */
            $where_id_centros = "centro.IDcentro IN ( $id_centros_user) ";

        }
        //return response::json($where_id_centros);

        //Barrios
        //AND c.Estado = 1
        $consulta = Barrio::join('centro', 'barrio.IDbarrio', '=', 'centro.IDbarrio')
                                ->where('IDempresa', '=', $IDempresa)
                                ->where('barrio.Estado', 1)
                                ->select('barrio.Nombre',
                                            'barrio.IDbarrio'            
                                )
                                ->orderBy('barrio.Nombre')
                                ->get();
        // mysqli_query($con,"SELECT DISTINCT b.Nombre, 
        //                                     b.IDbarrio 
        //                                     FROM barrio b INNER JOIN centro c ON(b.IDbarrio = c.IDbarrio AND IDempresa = '$IDempresa' ) 
        //                                     WHERE  b.Estado = 1  ORDER BY b.Nombre")
        // or die ($error ="Error description2: " . mysqli_error($con));

        $Resultado = array();
        foreach($consulta as $row)
        {
            $Resultado['Barrio'][]  = $row->Nombre;
        }


        //Areas
        $consulta = Area::where([['IDempresa', $IDempresa],['Estado', 1]])
                            ->select('Nombre','IDarea')
                            ->orderBy('Nombre')
                            ->get();
        // mysqli_query($con,"SELECT DISTINCT Nombre, IDarea FROM area WHERE IDempresa = '$IDempresa' AND Estado = 1 ORDER BY Nombre")
        // or die ($error ="Error description: " . mysqli_error($con));


        foreach($consulta as $row)
        {
            $Resultado['Area'][]  = $row->Nombre;
        }


        //Regiones
        //AND c.Estado = 1
        
        $consulta = Region::join('centro', 'region.IDregion', '=', 'centro.IDregion')
                            ->where('IDempresa', '=', $IDempresa)
                            ->where('region.Estado', 1)
                            ->orderBy('region.IDregion')
                            ->distinct()                                
                            ->get(['region.Nombre', 'region.IDregion']);
        // DB::select("SELECT DISTINCT r.Nombre, r.IDregion 
        //  FROM gtr_region r INNER JOIN gtr_centro c ON (r.IDregion = c.IDregion AND IDempresa = '$IDempresa' ) 
        //  WHERE r.Estado = 1  ORDER BY r.IDregion");
        
        //return response::json($consulta);
        // mysqli_query($con,"SELECT DISTINCT r.Nombre, r.IDregion 
        // FROM region r INNER JOIN centro c ON (r.IDregion = c.IDregion AND IDempresa = '$IDempresa' ) 
        // WHERE r.Estado = 1  ORDER BY r.IDregion")
        // or die ($error ="Error description: " . mysqli_error($con));


        foreach($consulta as $row)
        {
            $Resultado['Region'][]  = $row->Nombre;
        }

        //Centros por Region
        //AND c.Estado = 1
        $consulta = Centro::join('region', 'centro.IDregion', '=', 'region.IDregion')
                            ->where([['centro.IDempresa', $IDempresa],['region.Estado', 1]])
                            //->whereIn('centro.IDcentro',$where_id_centros)
                            ->select('centro.Nombre as Centro', 'centro.IDcentro', 'centro.Estado', 'region.Nombre as Region')
                            ->orderBy('centro.Nombre')
                            ->get();
        // DB::select("SELECT c.Nombre as Centro, c.IDcentro, c.Estado, r.Nombre as Region 
        //  FROM gtr_centro c INNER JOIN gtr_region r ON (c.IDregion = r.IDregion) 
        //  WHERE c.IDempresa = '$IDempresa' AND r.Estado = 1 ".$where_id_centros."  ORDER BY c.Nombre");
        
        //return response::json($consulta);
        // mysqli_query($con,"SELECT c.Nombre as Centro, c.IDcentro, c.Estado, r.Nombre as Region 
        // FROM centro c INNER JOIN region r ON (c.IDregion = r.IDregion) 
        // WHERE c.IDempresa = '$IDempresa' AND r.Estado = 1 ".$where_id_centros."  ORDER BY c.Nombre")
        // or die ($error ="Error description: " . mysqli_error($con));


        foreach($consulta as $row)
        {
            $Resultado['Region_Centro'][]  = array($row->IDcentro,$row->Centro,$row->Region,$row->Estado);
        }

        //Centros por Area
        //AND c.Estado = 1
        $consulta = Centro::join('area', 'centro.IDarea', '=', 'area.IDarea')
                                ->where('area.IDempresa', $IDempresa)
                                //->whereIn('centro.IDcentro', $where_id_centros)
                                ->select('centro.Nombre as Centro', 'centro.IDcentro', 'centro.Estado', 'area.Nombre as Area')
                                ->orderBy('centro.Nombre')
                                ->get();

        //     DB::select("SELECT c.Nombre as Centro, c.IDcentro,c.Estado, a.Nombre as Area 
        //   FROM gtr_centro c INNER JOIN gtr_area a ON(c.IDarea = a.IDarea) 
        //  WHERE a.IDempresa = '$IDempresa'  ".$where_id_centros."  ORDER BY c.Nombre");
        
        
        // mysqli_query($con,"SELECT c.Nombre as Centro, c.IDcentro,c.Estado, a.Nombre as Area 
        // --  FROM centro c INNER JOIN area a ON(c.IDarea = a.IDarea) 
        // WHERE a.IDempresa = '$IDempresa'  ".$where_id_centros."  ORDER BY c.Nombre")
        // or die ($error ="Error description: " . mysqli_error($con));


        foreach($consulta as $row)
        {
            $Resultado['Area_Centro'][]  = array($row->IDcentro,$row->Centro,$row->Area,$row->Estado);
        }

        //Centros por Barrio
        //AND c.Estado = 1
        $consulta = Centro::join('barrio', 'centro.IDbarrio', '=', 'barrio.IDbarrio')
                                ->where('centro.IDempresa', '=', $IDempresa)
                                ->where('barrio.Estado', 1)
                                //->where('centro.IDcentro', $where_id_centros)
                                ->select('centro.Nombre as Centro', 'centro.IDcentro', 'centro.Estado', 'barrio.Nombre as Barrio')
                                ->orderBy('centro.Nombre')
                                ->get();
        // DB::select("SELECT c.Nombre as Centro, c.IDcentro, c.Estado, b.Nombre as Barrio 
        //  FROM gtr_centro c INNER JOIN gtr_barrio b ON (c.IDbarrio = b.IDbarrio AND c.IDempresa = '$IDempresa' ) 
        //  WHERE  b.Estado = 1  ".$where_id_centros." ORDER BY c.Nombre");
        

        // // mysqli_query($con,"SELECT c.Nombre as Centro, c.IDcentro, c.Estado, b.Nombre as Barrio 
        // -- FROM centro c INNER JOIN barrio b ON (c.IDbarrio = b.IDbarrio AND c.IDempresa = '$IDempresa' ) 
        // -- WHERE  b.Estado = 1  ".$where_id_centros." ORDER BY c.Nombre")
        // -- or die ($error ="Error description: " . mysqli_error($con));


        foreach($consulta as $row)
        {
            $Resultado['Barrio_Centro'][]  = array($row->IDcentro,$row->Centro,$row->Barrio,$row->Estado);
        }


        //echo json_encode($Resultado);
        return Response::json($Resultado);
    }

    /*------------------------------------------------------------------------------------------------------------------------------*/

    public function loadAnioPeriodo(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;		
        $IDempresa = $miuser->IDempresa;//$_GET['id_empresa'];

            //$row["IDempresa"];

            $consulta = CentrosProductivos::join('centro', 'centro.IDcentro', '=', 'centrosproductivos.IDcentro')
                                            ->where([['centrosproductivos.estado', 1],['centrosproductivos.IDempresa', $IDempresa]])
                                            //->selectRaw('YEAR(centrosproductivos.Siembra) as anio')
                                            ->select('centrosproductivos.IDcentrosproductivos', 
                                                        'centrosproductivos.IDcentro as id_centro',
                                                        DB::raw('YEAR(gtr_centrosproductivos.Siembra) as anio'))
                                            ->get();

        //     DB::select("SELECT gtr_centrosproductivos.IDcentrosproductivos, YEAR ( gtr_centrosproductivos.Siembra) as anio, gtr_centrosproductivos.IDcentro as id_centro  
        //     FROM gtr_centrosproductivos INNER JOIN gtr_centro 
        //    ON gtr_centro.IDcentro = gtr_centrosproductivos.IDcentro 
        //     Where gtr_centrosproductivos.estado=1 
        //    and gtr_centrosproductivos.IDempresa =$IDempresa");
        
            // "SELECT centrosproductivos.id, YEAR ( centrosproductivos.Siembra) as anio, centrosproductivos.IDcentro as id_centro  
            // FROM centrosproductivos INNER JOIN centro 
            // ON centro.IDcentro=centrosproductivos.IDcentro 
            // Where centrosproductivos.estado=1 
            // and centrosproductivos.IDempresa =".$id_empresa." 
            // GROUP BY (anio)";

            
            

            
            //$sql2 ="INSERT INTO MyGuests (firstname, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";

            // $consulta = mysqli_query($con, $sql2);
            
            $data = [];

            if ($consulta) {
                foreach($consulta as $row)
                {	
                    $data[]  = $row;
                        
                }
            }

            
            
            $Resultado = array(
                'total' => count($data), 			// select count(*) from table ...	
                'rows' => $data 	  // select * from table limit ...
            );

            return Response::json($Resultado);

        // mysqli_close($con);
    }

    /*------------------------------------------------------------------------------------------------------------------------------*/

    public function alarmaGenerarExcel(Request $request)
    {

        // use Box\Spout\Writer\WriterFactory;
        // use Box\Spout\Common\Type;
        // use Box\Spout\Writer\Style\StyleBuilder;
        // use Box\Spout\Writer\Style\Color;

        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $start5 = microtime(true);
        set_time_limit(300);
        //ini_set('memory_limit', '4095M');

            $error = 0;
            $Centros = $_POST['Centros'];
            $Centros = str_replace('"', '', $Centros);
            $Centros = str_replace(",", "','", $Centros);
            $Inicio = date('Y-m-d', strtotime($_POST['Inicio']));
            $Inicio = date('Y-m-d 00:00:00', strtotime($Inicio));
            $Termino = date('Y-m-d', strtotime($_POST['Termino']. ' +1 day'));
            $Termino = date('Y-m-d 00:00:00', strtotime($Termino));;
            $user_id = $_POST['user_id'];

            $estado_alarma = [];
            if ($_POST['Critico']) {
                $estado_alarma[] = 'Nivel Crítico';
            }
            if ($_POST['Precaucion']) {
                $estado_alarma[] = 'Precaución';
            }
            if ($_POST['Presencia']) {
                $estado_alarma[] = 'Presencia Microalgas';
            }
            if ($_POST['Ausencia']) {
                $estado_alarma[] = 'Ausencia Microalgas';
            }
            $estado_alarma_aux = implode("','",$estado_alarma);


            $anio_periodo = $_POST['anio_periodo'];

            //
            // session_start();
            // $_SESSION['progress'] = 5;
            //  session_write_close();

            //IDempresa
            $consulta0 = mysqli_query($con,"SELECT IDempresa FROM as_users WHERE user_id = '$user_id' ")
            or die ($error ="Error description: " . mysqli_error($consulta0));
            $row0 = mysqli_fetch_assoc($consulta0);
            if($row0){
                $IDempresa = $row0['IDempresa'];
            }


            //Consulta por los nombres de los parámetros Ambientales
            $consulta = mysqli_query($con,"SELECT Nombre,Grupo FROM pambientales WHERE IDempresa = '$IDempresa'
        ORDER BY (CASE WHEN Grupo = 'Columna de Agua' THEN 0 ELSE 1 END), (CASE WHEN Grupo = 'Peces' THEN 0 ELSE 1 END),Grupo, Nombre ")
            or die ($error ="Error description: " . mysqli_error($consulta));

            $Pambientales_key = array();
            $Titulo_pamb = array();
            while($row = mysqli_fetch_assoc($consulta))
            {
                if($row['Grupo'] == "Columna de Agua"){
                    $Titulo_pamb[] = $row['Nombre']." | 0.5[m]";
                    $Titulo_pamb[] = $row['Nombre']." | 5[m]";
                    $Titulo_pamb[] = $row['Nombre']." | 10[m]";
                    $Titulo_pamb[] = $row['Nombre']." | 15[m]";
                    $Titulo_pamb[] = $row['Nombre']." | 20[m]";
                    $Titulo_pamb[] = $row['Nombre']." | 25[m]";
                    $Titulo_pamb[] = $row['Nombre']." | 30[m]";
                }else{
                    $Titulo_pamb[] = $row['Nombre'];
                }
            }


            $vacios = array();
            foreach($Titulo_pamb as $value){
                $vacios[] = "";
                }




            $start0 = microtime(true);

            //separa cada 3 meses
            $Pambientales = array();
            $Resultado_ausencia = array();
            $Resultado = array();

            $tramo = 86400*30*(0.5); //cada 3 meses
            $ti = strtotime($Inicio);
            $tf = strtotime($Termino);
            for($t=$ti; $t<=$tf; $t++){



                $Inicio = date('Y-m-d', $t);
                $t = $t + $tramo;
                if($t>$tf){
                    $Termino = date('Y-m-d', $tf);
                }else{ $Termino = date('Y-m-d', $t);}


                    if($anio_periodo>0){

                        //Consulta por los parámetros Ambientales
                    $consulta1 = mysqli_query($con,"SELECT  m.Fecha_Reporte as Fecha_Order, r.Nombre as Region, a.Nombre as Area, b.Nombre as Barrio,  c.Nombre as Centro,
                    DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,CAST(m.Fecha_Envio AS TIME) as Time_Envio,
                        '' as Grupo,
                        '' as Nombre_Especie,
                        '' as Fiscaliza,
                        '' as Nivel_Fiscaliza,
                        '' as Nociva,
                        '' as Nivel_Critico,
                        '' as Alarma_Rojo,
                        '' as Alarma_Amarillo,
                        '' as Nivel_Fiscaliza_Actual,
                        '' as Nociva_Actual,
                        '' as Nivel_Critico_Actual,
                        m.Estado_Alarma, '' as Medicion_1, '' as Medicion_2, '' as Medicion_3, '' as Medicion_4, '' as Medicion_5, '' as Medicion_6, '' as Medicion_7, m.Tecnica, m.Observaciones, m.Firma,
                        CASE
                            WHEN m.Laboratorio > '0'
                            THEN 'Externa'
                            ELSE 'Interna'
                        END as Laboratorio,
                        CASE
                            WHEN d.Fecha_Envio
                            THEN DATE_FORMAT(CAST(d.Fecha_Envio AS DATE), '%d-%m-%Y')
                            ELSE ''
                        END as Date_Declaracion,
                        CASE
                            WHEN cp.Siembra
                            THEN DATE_FORMAT(CAST(cp.Siembra AS DATE), '%d-%m-%Y')
                            ELSE '-'
                        END as Siembra,

                        CASE
                            WHEN cp.Cosecha
                            THEN DATE_FORMAT(CAST(cp.Cosecha AS DATE), '%d-%m-%Y')
                            ELSE '-'
                        END as Cosecha,
                        m.Modulo,m.Jaula,m.TopLeft,

                    mp.IDmedicion, mp.IDpambientales, p.Grupo as Grupop, p.Nombre as Nombrep, mp.Medicion_1 as Medicion_1p, mp.Medicion_2 as Medicion_2p, mp.Medicion_3 as Medicion_3p, mp.Medicion_4 as Medicion_4p, mp.Medicion_5 as Medicion_5p, mp.Medicion_6 as Medicion_6p, mp.Medicion_7 as Medicion_7p



                    FROM medicion m INNER JOIN centrosproductivos cp ON (cp.IDcentro = m.IDcentro AND m.Fecha_Reporte BETWEEN cp.Siembra AND cp.Cosecha AND cp.estado = 1 AND YEAR(cp.Siembra) = $anio_periodo AND cp.IDcentro IN ('$Centros')) INNER JOIN medicion_pambientales mp ON (m.IDmedicion = mp.IDmedicion AND m.IDcentro IN ('$Centros') AND m.Estado = 1 )  LEFT JOIN declaracion d  ON (m.IDmedicion = d.IDmedicion), region r, area a, barrio b, centro c, pambientales p WHERE c.IDregion = r.IDregion AND c.IDarea = a.IDarea AND c.IDbarrio = b.IDbarrio AND c.IDcentro = m.IDcentro AND c.IDempresa = '$IDempresa' AND p.IDpambientales = mp.IDpambientales AND m.Estado_Alarma IN ('$estado_alarma_aux')
                    ORDER BY (CASE WHEN Grupop = 'Columna de Agua' THEN 0 ELSE 1 END), Grupop, Nombrep")
                    or die ($error ="Error description: " . mysqli_error($consulta1));

                    }else{
                        //Consulta por los parámetros Ambientales
                    $consulta1 = mysqli_query($con,"SELECT m.Fecha_Reporte as Fecha_Order, r.Nombre as Region, a.Nombre as Area, b.Nombre as Barrio,  c.Nombre as Centro,
                    DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,CAST(m.Fecha_Envio AS TIME) as Time_Envio,
                        '' as Grupo,
                        '' as Nombre_Especie,
                        '' as Fiscaliza,
                        '' as Nivel_Fiscaliza,
                        '' as Nociva,
                        '' as Nivel_Critico,
                        '' as Alarma_Rojo,
                        '' as Alarma_Amarillo,
                        '' as Nivel_Fiscaliza_Actual,
                        '' as Nociva_Actual,
                        '' as Nivel_Critico_Actual,
                        m.Estado_Alarma, '' as Medicion_1, '' as Medicion_2, '' as Medicion_3, '' as Medicion_4, '' as Medicion_5, '' as Medicion_6, '' as Medicion_7, m.Tecnica, m.Observaciones, m.Firma,
                        CASE
                            WHEN m.Laboratorio > '0'
                            THEN 'Externa'
                            ELSE 'Interna'
                        END as Laboratorio,
                        CASE
                            WHEN d.Fecha_Envio
                            THEN DATE_FORMAT(CAST(d.Fecha_Envio AS DATE), '%d-%m-%Y')
                            ELSE ''
                        END as Date_Declaracion,
                        m.Modulo,m.Jaula,m.TopLeft,

                    mp.IDmedicion, mp.IDpambientales, p.Grupo as Grupop, p.Nombre as Nombrep, mp.Medicion_1 as Medicion_1p, mp.Medicion_2 as Medicion_2p, mp.Medicion_3 as Medicion_3p, mp.Medicion_4 as Medicion_4p, mp.Medicion_5 as Medicion_5p, mp.Medicion_6 as Medicion_6p, mp.Medicion_7 as Medicion_7p

                    FROM medicion m INNER JOIN medicion_pambientales mp ON (m.IDmedicion = mp.IDmedicion AND m.Fecha_Reporte >= '$Inicio' AND m.Fecha_Reporte < '$Termino' AND m.IDcentro IN ('$Centros') AND m.Estado = 1 )  LEFT JOIN declaracion d  ON (m.IDmedicion = d.IDmedicion), region r, area a, barrio b, centro c, pambientales p WHERE c.IDregion = r.IDregion AND c.IDarea = a.IDarea AND c.IDbarrio = b.IDbarrio AND c.IDcentro = m.IDcentro AND c.IDempresa = '$IDempresa' AND p.IDpambientales = mp.IDpambientales AND m.Estado_Alarma IN ('$estado_alarma_aux')
                    ORDER BY (CASE WHEN Grupop = 'Columna de Agua' THEN 0 ELSE 1 END), Grupop, Nombrep")
                    or die ($error ="Error description: " . mysqli_error($consulta1));
                    }



                    $time_elapsed_secs0 = microtime(true) - $start0;
                    $start1 = microtime(true);

                    while($row = mysqli_fetch_assoc($consulta1))
                    {
                        if(!isset($Pambientales[$row['IDmedicion']])){$Pambientales[$row['IDmedicion']] = $vacios;}
                        if($row['Grupop'] == "Columna de Agua"){
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 0.5[m]",$Titulo_pamb)]  = $row['Medicion_1p'];
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 5[m]",$Titulo_pamb)]    = $row['Medicion_2p'];
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 10[m]",$Titulo_pamb)]   = $row['Medicion_3p'];
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 15[m]",$Titulo_pamb)]   = $row['Medicion_4p'];
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 20[m]",$Titulo_pamb)]   = $row['Medicion_5p'];
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 25[m]",$Titulo_pamb)]   = $row['Medicion_6p'];
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep']." | 30[m]",$Titulo_pamb)]   = $row['Medicion_7p'];
                        }else{
                            $Pambientales[$row['IDmedicion']][array_search($row['Nombrep'],$Titulo_pamb)]  = $row['Medicion_1p'];
                        }

                        if($row['Estado_Alarma'] == "Ausencia Microalgas"){
                            $Resultado_ausencia[$row['IDmedicion']] = array_slice($row,0,-11);
                        }

                            //$i++;
                    }

                    $time_elapsed_secs1 = microtime(true) - $start1;
                    /*echo "<script>console.log(".json_encode($Pambientales).");</script>";*/
                    $start2 = microtime(true);

                    if($anio_periodo>0){


                        $consulta = mysqli_query($con,"SELECT  m.IDmedicion, m.Fecha_Reporte as Fecha_Order,r.Nombre as Region, a.Nombre as Area, b.Nombre as Barrio,  c.Nombre as Centro,
                    DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,CAST(m.Fecha_Envio AS TIME) as Time_Envio,
                    e.Grupo,e.Nombre as Nombre_Especie,
                    CASE
                            WHEN mf.Fiscaliza = '1'
                            THEN 'Si'
                            ELSE '-'
                    END as Fiscaliza,
                    CASE
                            WHEN mf.Nivel_Fiscaliza > '0'
                            THEN mf.Nivel_Fiscaliza
                            ELSE '-'
                    END as Nivel_Fiscaliza,
                    CASE
                            WHEN mf.Nociva = '1'
                            THEN 'Nociva'
                            ELSE '-'
                    END as Nociva,
                    CASE
                            WHEN mf.Nivel_Critico > '0'
                            THEN mf.Nivel_Critico
                            ELSE '-'
                    END as Nivel_Critico,
                    CASE
                            WHEN mf.Alarma_Rojo > '0'
                            THEN mf.Alarma_Rojo
                            ELSE '-'
                    END as Alarma_Rojo,
                    CASE
                            WHEN mf.Alarma_Amarillo > '0'
                            THEN mf.Alarma_Amarillo
                            ELSE '-'
                    END as Alarma_Amarillo,


                    CASE
                            WHEN e.Nivel_Fiscaliza > '0'
                            THEN e.Nivel_Fiscaliza
                            ELSE '-'
                    END as 	Nivel_Fiscaliza_Actual,
                    CASE
                            WHEN e.Nociva = '1'
                            THEN 'Nociva'
                            ELSE '-'
                    END as Nociva_Actual,
                    CASE
                            WHEN e.Nivel_Critico > '0'
                            THEN e.Nivel_Critico
                            ELSE '-'
                    END as Nivel_Critico_Actual,

                    m.Estado_Alarma,mf.Medicion_1,mf.Medicion_2, mf.Medicion_3, mf.Medicion_4, mf.Medicion_5, mf.Medicion_6, mf.Medicion_7, m.Tecnica, m.Observaciones, m.Firma,

                        CASE
                            WHEN m.Laboratorio > '0'
                            THEN 'Externa'
                            ELSE 'Interna'
                        END as Laboratorio,
                        CASE
                            WHEN d.Fecha_Envio
                            THEN DATE_FORMAT(CAST(d.Fecha_Envio AS DATE), '%d-%m-%Y')
                            ELSE ''
                        END as Date_Declaracion,

                        CASE
                            WHEN cp.Siembra
                            THEN DATE_FORMAT(CAST(cp.Siembra AS DATE), '%d-%m-%Y')
                            ELSE '-'
                        END as Siembra,

                        CASE
                            WHEN cp.Cosecha
                            THEN DATE_FORMAT(CAST(cp.Cosecha AS DATE), '%d-%m-%Y')
                            ELSE '-'
                        END as Cosecha,
                        m.Modulo,m.Jaula,m.TopLeft




                    FROM medicion m INNER JOIN centrosproductivos cp ON (cp.IDcentro = m.IDcentro AND m.Fecha_Reporte BETWEEN cp.Siembra AND cp.Cosecha AND cp.estado = 1 AND YEAR(cp.Siembra) = $anio_periodo AND cp.IDcentro IN ('$Centros')) INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.Estado = 1 AND m.IDcentro IN ('$Centros') ) LEFT JOIN declaracion d  ON (m.IDmedicion = d.IDmedicion), especie e, region r, area a, barrio b, centro c WHERE e.IDespecie = mf.IDespecie AND c.IDregion = r.IDregion AND c.IDarea = a.IDarea AND c.IDbarrio = b.IDbarrio AND c.IDcentro = m.IDcentro AND c.IDempresa = '$IDempresa'  AND m.Estado_Alarma IN ('$estado_alarma_aux')


                    ORDER BY m.Fecha_Reporte DESC")
                    or die ($error ="Error description: " . mysqli_error($con));




                    }else{


                        $consulta = mysqli_query($con,"SELECT m.IDmedicion, m.Fecha_Reporte as Fecha_Order,r.Nombre as Region, a.Nombre as Area, b.Nombre as Barrio,  c.Nombre as Centro,
                    DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,CAST(m.Fecha_Reporte AS TIME) as Time_Reporte, DATE_FORMAT(CAST(m.Fecha_Analisis AS DATE), '%d-%m-%Y') as Date_Analisis,CAST(m.Fecha_Analisis AS TIME) as Time_Analisis, DATE_FORMAT(CAST(m.Fecha_Envio AS DATE), '%d-%m-%Y') as Date_Envio,CAST(m.Fecha_Envio AS TIME) as Time_Envio,
                    e.Grupo,e.Nombre as Nombre_Especie,
                    CASE
                            WHEN mf.Fiscaliza = '1'
                            THEN 'Si'
                            ELSE '-'
                    END as Fiscaliza,
                    CASE
                            WHEN mf.Nivel_Fiscaliza > '0'
                            THEN mf.Nivel_Fiscaliza
                            ELSE '-'
                    END as Nivel_Fiscaliza,
                    CASE
                            WHEN mf.Nociva = '1'
                            THEN 'Nociva'
                            ELSE '-'
                    END as Nociva,
                    CASE
                            WHEN mf.Nivel_Critico > '0'
                            THEN mf.Nivel_Critico
                            ELSE '-'
                    END as Nivel_Critico,
                    CASE
                            WHEN mf.Alarma_Rojo > '0'
                            THEN mf.Alarma_Rojo
                            ELSE '-'
                    END as Alarma_Rojo,
                    CASE
                            WHEN mf.Alarma_Amarillo > '0'
                            THEN mf.Alarma_Amarillo
                            ELSE '-'
                    END as Alarma_Amarillo,


                    CASE
                            WHEN e.Nivel_Fiscaliza > '0'
                            THEN e.Nivel_Fiscaliza
                            ELSE '-'
                    END as 	Nivel_Fiscaliza_Actual,
                    CASE
                            WHEN e.Nociva = '1'
                            THEN 'Nociva'
                            ELSE '-'
                    END as Nociva_Actual,
                    CASE
                            WHEN e.Nivel_Critico > '0'
                            THEN e.Nivel_Critico
                            ELSE '-'
                    END as Nivel_Critico_Actual,


                        m.Estado_Alarma,mf.Medicion_1,mf.Medicion_2, mf.Medicion_3, mf.Medicion_4, mf.Medicion_5, mf.Medicion_6, mf.Medicion_7, m.Tecnica, m.Observaciones, m.Firma,

                        CASE
                            WHEN m.Laboratorio > '0'
                            THEN 'Externa'
                            ELSE 'Interna'
                        END as Laboratorio,
                        CASE
                            WHEN d.Fecha_Envio
                            THEN DATE_FORMAT(CAST(d.Fecha_Envio AS DATE), '%d-%m-%Y')
                            ELSE ''
                        END as Date_Declaracion,
                        m.Modulo,m.Jaula,m.TopLeft



                    FROM medicion m INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.Fecha_Reporte >= '$Inicio' AND m.Fecha_Reporte < '$Termino' AND m.Estado = 1 AND m.IDcentro IN ('$Centros') ) LEFT JOIN declaracion d  ON (m.IDmedicion = d.IDmedicion), especie e, region r, area a, barrio b, centro c WHERE e.IDespecie = mf.IDespecie AND c.IDregion = r.IDregion AND c.IDarea = a.IDarea AND c.IDbarrio = b.IDbarrio AND c.IDcentro = m.IDcentro AND c.IDempresa = '$IDempresa'  AND m.Estado_Alarma IN ('$estado_alarma_aux')


                    ORDER BY m.Fecha_Reporte DESC")
                    or die ($error ="Error description: " . mysqli_error($con));



                    }




                    while($row = mysqli_fetch_assoc($consulta))
                    {
                        $idmed = $row['IDmedicion'];
                        array_shift($row);
                        if(isset($Pambientales[$idmed])){
                            $Resultado[]  = array_merge($row, $Pambientales[$idmed]);
                        }else{
                            $Resultado[] = $row;
                        }
                            //array_pop($Resultado);
                            //echo json_encode($Resultado);
                    }


            }


            $time_elapsed_secs2 = microtime(true) - $start2;
            $start3 = microtime(true);

            foreach ($Resultado_ausencia as $key => $row) {
                $Resultado[]  = array_merge($row, $Pambientales[$key]);
            }


            foreach ($Resultado as $key => $row) {
                $fecha[$key] = strtotime($row['Fecha_Order']);
                array_shift($Resultado[ $key]);
            }



            array_multisort($fecha, SORT_DESC, $Resultado);

            $time_elapsed_secs3 = microtime(true) - $start3;
            $start4 = microtime(true);


        if($Resultado != ""){

            $consulta = mysqli_query($con,"SELECT Nombre FROM empresa WHERE IDempresa = '$IDempresa'
        AND Estado = 1 ")or die ($error ="Error description: " . mysqli_error($consulta));

            $row = mysqli_fetch_assoc($consulta);
            $nombre_pdf = str_replace(" ","_",$row['Nombre']);


            //Eliminar excel del servidor
            if(file_exists("archivos/Registros_Alarma/".$nombre_pdf.".xlsx")){
                unlink("archivos/Registros_Alarma/".$nombre_pdf.".xlsx");
            }

            $fis_actual =  "Nivel Fiscalizado Actual";
            $nociva_actual =  "Nociva Actual";
            $nociva_nivel_actual = "Nivel Nocivo Actual";
            if($IDempresa == 5 ){
                $fis_actual =  "SERNAPESCA";
                $nociva_actual =  "Nociva Actual";
                $nociva_nivel_actual = "PROMOFI";
            }



            if($anio_periodo>0){
                $titulos = array(
                            '0' => "Nombre Región",
                            '1' => "Nombre Área",
                            '2' => "ACS",
                            '3' => "Nombre Centro",
                            '4' => "Fecha Muestreo",
                            '5' => "Hora Muestreo",
                            '6' => "Fecha Análisis",
                            '7' => "Hora Análisis",
                            '8' => "Fecha Envío",
                            '9' => "Hora Envío",
                            '10' => "Grupo",
                            '11' => "Nombre Especie",
                            '12' => "Fiscalizada",
                            '13' => "Nivel Fiscalizado",
                            '14' => "Nociva",
                            '15' => "Nivel Nocivo",
                            '16' => "Alarma Crítico",
                            '17' => "Alarma Precaución",
                            '18' => $fis_actual,
                            '19' => $nociva_actual,
                            '20' => $nociva_nivel_actual,
                            '21' => "Estado Registro",
                            '22' => "Medición 0.5 [m] | [cel/ml]",
                            '23' => "Medición 5 [m] | [cel/ml]",
                            '24' => "Medición 10 [m] | [cel/ml]",
                            '25' => "Medición 15 [m] | [cel/ml]",
                            '26' => "Medición 20 [m] | [cel/ml]",
                            '27' => "Medición 25 [m] | [cel/ml]",
                            '28' => "Medición 30 [m] | [cel/ml]",
                            '29' => "Técnica Utilizada",
                            '30' => "Observaciones",
                            '31' => "Firma",
                            '32' => "Medición",
                            '33' => "Registro Declarado en GTR",
                            '34' => "Siembra",
                            '35' => "Cosecha",
                            '36' => "Módulo",
                            '37' => "Jaula",
                            '38' => "Grados Decimales (DD)"

                            );
            }else{
                $titulos = array(
                        '0' => "Nombre Región",
                            '1' => "Nombre Área",
                            '2' => "ACS",
                            '3' => "Nombre Centro",
                            '4' => "Fecha Muestreo",
                            '5' => "Hora Muestreo",
                            '6' => "Fecha Análisis",
                            '7' => "Hora Análisis",
                            '8' => "Fecha Envío",
                            '9' => "Hora Envío",
                            '10' => "Grupo",
                            '11' => "Nombre Especie",
                            '12' => "Fiscalizada",
                            '13' => "Nivel Fiscalizado",
                            '14' => "Nociva",
                            '15' => "Nivel Nocivo",
                            '16' => "Alarma Crítico",
                            '17' => "Alarma Precaución",
                            '18' => $fis_actual,
                            '19' => $nociva_actual,
                            '20' => $nociva_nivel_actual,
                            '21' => "Estado Registro",
                            '22' => "Medición 0.5 [m] | [cel/ml]",
                            '23' => "Medición 5 [m] | [cel/ml]",
                            '24' => "Medición 10 [m] | [cel/ml]",
                            '25' => "Medición 15 [m] | [cel/ml]",
                            '26' => "Medición 20 [m] | [cel/ml]",
                            '27' => "Medición 25 [m] | [cel/ml]",
                            '28' => "Medición 30 [m] | [cel/ml]",
                            '29' => "Técnica Utilizada",
                            '30' => "Observaciones",
                            '31' => "Firma",
                            '32' => "Medición",
                            '33' => "Registro Declarado en GTR",
                            // '34' => "Siembra",
                            // '35' => "Cosecha"
                            '34' => "Módulo",
                            '35' => "Jaula",
                            '36' => "Grados Decimales (DD)",
                            );
            }



            $titulos = array_merge($titulos,$Titulo_pamb);


            $style = (new StyleBuilder());
            $style = $style
                    ->setFontBold()
                //  ->setFontSize(15)
                //  ->setFontColor(Color::BLUE)
                //  ->setShouldWrapText()
                //  ->setBackgroundColor(Color::YELLOW)
                ->build();


        /*	$writer->setShouldAddBOM(false);
            $writer->setFieldDelimiter('|');
            $writer->setFieldEnclosure('@');
            $writer->setEndOfLineCharacter("\r");*/
            /*$writer = WriterFactory::create(Type::CSV);
            //->setTempFolder("")
            //->setShouldUseInlineStrings(true)
            // ->openToFile($nombre_pdf.".csv")
            // ->addRowWithStyle($titulos,$style)
            $writer->openToFile($nombre_pdf.".csv")
                ->addRows($Resultado)
            ->close();*/



            $writer = WriterFactory::create(Type::XLSX);
            $writer->setTempFolder("")
            ->setShouldUseInlineStrings(true)
            ->openToFile($nombre_pdf.".xlsx")
            ->addRowWithStyle($titulos,$style)
            ->addRows($Resultado)
            ->close();



            $time_elapsed_secs4 = microtime(true) - $start4;

            $time_elapsed_secs5 = microtime(true) - $start5;

            // session_start();
            // $_SESSION['progress'] = 100;
            // session_write_close();


                echo json_encode($nombre_pdf.".xlsx");

                // echo json_encode("Todo: ".$time_elapsed_secs4);
                // echo json_encode("Guarda: ".$time_elapsed_secs4);
                // echo json_encode("  |  Pamb: ".$time_elapsed_secs0);
                // echo json_encode("Medicion: ".$time_elapsed_secs2);
                // echo json_encode("Arreglo: ".$time_elapsed_secs3);*/
                //

            // 	echo json_encode(array(
            // 	'Consulta_pamb' => $time_elapsed_secs0,
            // 	'Pamb' => $time_elapsed_secs1,
            // 	'Fan' => $time_elapsed_secs2,
            // 	'RSort' => $time_elapsed_secs3,
            // 	'RExcel' => $time_elapsed_secs4,
            // 	'TODO' => $time_elapsed_secs5,
            // ));
        }
    }    
    /*------------------------------------------------------------------------------------------------------------------------------*/


    /*------------------------------------------------------------------------------------------------------------------------------*/

    private function cambiar_bd($id_empresa){
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
