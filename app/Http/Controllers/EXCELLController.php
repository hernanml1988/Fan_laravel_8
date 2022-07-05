<?php

namespace App\Http\Controllers;


use App\Models\Barrio;
use App\Models\Centro;
use App\Models\Configuracion;
use App\Models\Declaracion;
use App\Models\Documento;
use App\Models\Empresa;
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

use Illuminate\Support\Facades\Auth;
date_default_timezone_set('america/santiago');
use PDF;
use Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class EXCELLController extends Controller
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

		public function cargaRegistroAutomatico(Request $request)
		{
			$miuser = Auth::user();
        	$this->cambiar_bd($miuser->IDempresa);   

			
			
			   
			  $path = $request->file('select_file')->getRealPath();
		  
			  $data = Excel::load($path, function($reader){})->get();

			  function sanear_string($string)
			  {
						   
				  $string = trim($string);
			   
				  $string = str_replace(
					  array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
					  array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
					  $string
				  );
			   
				  $string = str_replace(
					  array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
					  array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
					  $string
				  );
			   
				  $string = str_replace(
					  array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
					  array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
					  $string
				  );
			   
				  $string = str_replace(
					  array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
					  array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
					  $string
				  );
			   
				  $string = str_replace(
					  array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
					  array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
					  $string
				  );
			   
				  $string = str_replace(
					  array('ñ', 'Ñ', 'ç', 'Ç'),
					  array('n', 'N', 'c', 'C',),
					  $string
				  );
			   
				  //Esta parte se encarga de eliminar cualquier caracter extraño
				   $string = str_replace(
					  array("\\", "¨", "º", "~",
						   "#", "@", "|", "!", "\"",
						   "·", "$", "%", "&", 
						   "(", ")", "?", "'", "¡",
						   "¿", "[", "^", "<code>", "]",
						   "+", "}", "{", "¨", "´",
						   ">", "< ", "."),
					  '',
					  $string
				  );
				   $string = str_replace(
					  array("-","/",";", ",", ":"," "),
					  '_',
					  $string
				  );
			   
			   
				  return $string;
			  }
			  
			  function validateDate($date, $format = 'Y-m-d H:i:s')
			  {
				  $aux = new \DateTime();
				  $d = $aux->createFromFormat($format, $date);
				  return $d && $d->format($format) == $date;
			  }


			  $error = "";
			  $error2 = array();
			  if($data->count() > 0){
				  foreach($data as $n => $sheet){
					  if($n == 0){
						  foreach($sheet as $key => $row){
							  $parametros[] = $row;
						  }
						}
				  }
				}
			  return Response::json($data);

			
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
