<?php

namespace App\Http\Controllers;

use App\Imports\RegistroAutoImport;
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
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Auth;
date_default_timezone_set('america/santiago');
use PDF;
use Excel;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
        set_time_limit(600);
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting( E_ALL | E_STRICT);ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting( E_ALL | E_STRICT);
		$error=0;
       
        $user_id = $miuser->id;
        $Firma = $request->input('Firma');
        $Codigo = $request->input('Codigo');
        $existeregistro = $request->input('Existe_Registro');
        $Tecnica = "";

		
		$data = Excel::toArray(new RegistroAutoImport, $request->file('select_file')->getRealPath());
		$data = $data[0];
		return Response::json($data);
				
		$Nombre_Especie = array();

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
        	
			
        if (count($data) > 0) {

			$extension = $request->file('select_file')->getClientOriginalExtension();
			$inputFileName = $request->file('select_file')->getClientOriginalName();
			
            
         
           if ($extension  == 'xlsx' || $extension  == 'xlsm' ) {

        		// Temporary file name
                
        		$trow = 1;
        		$formato_version_agrega1 = 0;


        				foreach ($data as $row) {

							
        					if($trow == 2 ){
        						if($row[18] == "2a13sFNdlBlDFRsj1bsGvKdLIe9NBXap1oumU9lT1zMqkhN.DJGJXgfxW"){
        							$formato = "Interno";
        							$version = 0;
        						}
        						if($row[18] == "2a13sFNdlBlDFRsj1bsGvKdLIe9NBXap1oumU7lT1zMqkhN.DJGJXgfxW"){
        							$formato = "Interno";
        							$version = 1;
        						}
        					}else if($trow == 3){
        						if($row[18] == "2a13sFNdlBlDFRsj1bsGvKdLIe9NBXap1oumU7lT1zMqkhN.DJGJXgfxW"){
        							$formato = "Interno";
        							$version = 2; //Suma una fila más por que se agrego el numero de version en la fila1 del excel y eso hizo que se corra todo en +1
        						}
        					}
        					$trow++;

        				}
        			

        		







        		if($formato == "Externo"){
        			$totalrow = 0;
        			$finfito = 10000000;
        			
        				
        					foreach ($data as $row) {

        						if($row[0] == "Observaciones:"){ $finfito = $totalrow;}
        						if($totalrow == 8){
        									$IDcentro_siep = str_replace(chr( 194 ) . chr( 160 ), '',$row[5]);
        									$IDcentro_siep = str_replace(' ', '',$IDcentro_siep);
        						}else
        						if($totalrow == 11){
        									$Fecha_Medicion = date_format($row[1],'Y-m-d');
        									$Fecha_Analisis = date_format($row[5],'Y-m-d');
        						}else
        						if($totalrow == 12){
        									//$Hora_Medicion = $row[1];
        									$fecha =date_format($row[5],'Y-m-d');
        						}else
        						if($totalrow == 13){
        									$Disco = str_replace("'",chr(34),$row[1]);
        									$Conducta_Peces = str_replace("'",chr(34),$row[3]);
        						}else
        						if($totalrow == 16){
        									$Temperatura_1 = str_replace(",",".",$row[1]);
        									$Temperatura_2 = str_replace(",",".",$row[2]);
        									$Temperatura_3 = str_replace(",",".",$row[3]);
        									$Temperatura_4 = str_replace(",",".",$row[4]);
        						}else
        						if($totalrow == 17){
        									$Salinidad_1 = str_replace(",",".",$row[1]);
        									$Salinidad_2 = str_replace(",",".",$row[2]);
        									$Salinidad_3 = str_replace(",",".",$row[3]);
        									$Salinidad_4 = str_replace(",",".",$row[4]);
        						}else
        						if($totalrow == 18){
        									$o2_mg_1 = str_replace(",",".",$row[1]);
        									$o2_mg_2 = str_replace(",",".",$row[2]);
        									$o2_mg_3 = str_replace(",",".",$row[3]);
        									$o2_mg_4 = str_replace(",",".",$row[4]);
        						}else
        						if($totalrow == 19){
        									$o2_percent_1 = str_replace(",",".",$row[1]);
        									$o2_percent_2 = str_replace(",",".",$row[2]);
        									$o2_percent_3 = str_replace(",",".",$row[3]);
        									$o2_percent_4 = str_replace(",",".",$row[4]);
        						}else
        						if($totalrow > 20   && $totalrow < $finfito
        											&& $row[0] != ""
        											&& $row[0] != "Sub Total"
        											&& $row[0] != "DIATOMEAS"
        											&& $row[0] != "PROTOZOA"
        											&& $row[0] != "ZOOPLANCTON"
        											&& $row[0] != "DINOFLAGELADOS"
        											&& $row[0] != "OTROS GRUPOS"
        											&& $row[0] != "DICTYOCOFICEAS"
        											&& $row[0] != "CRIPTOFICEAS"
        											&& $row[0] != "CRISOFICEAS"
        											&& $row[0] != "EUGLENOFICEAS"
        											&& $row[0] != "RAFIDOFICEAS"
        											&& $row[0] != "FITOPLANCTON TOTAL"
        											&& $row[0] != "ZOOPLANCTON TOTAL"
        											&&
        											($row[1] != "" || $row[2] != "" || $row[3] != "" || $row[4] != "")
        											){

        									$espaux = str_replace("'",chr(34),$row[0]);
        									if(strpos($espaux,"(C") === false){
        										//$Nombre_Especie[] = $espaux;
        									}else{
        										$nelimina = (strlen($espaux) - strpos($espaux,"(C")+1)*-1;
        										$espaux = substr($espaux, 0, $nelimina);
        									}
        									if($row[1]){
        									$med1 = eliminacomas($row[1]);
        									}else{$med1 = "";}
        									if($row[2]){
        									$med2 = eliminacomas($row[2]);
        									}else{$med2 = "";}
        									if($row[3]){
        									$med3 = eliminacomas($row[3]);
        									}else{$med3 = "";}
        									if($row[4]){
        									$med4 = eliminacomas($row[4]);
        									}else{$med4 = "";}
        									$Nombre_Especie[] = array(
        													'Nombre' => $espaux,
        													'Medicion1' => eliminacomas($row[1]),
        													'Medicion2' => eliminacomas($row[2]),
        													'Medicion3' => eliminacomas($row[3]),
        													'Medicion4' => eliminacomas($row[4]),
        													);
        						}else
        						if (strpos($row[0], 'Método Cuantitativo Utilizado:') !== false) {
        									$Tecnica = str_replace('Método Cuantitativo Utilizado: ','',$row[0]);
        						}

        						$totalrow++;
        					}
        				
        			

        		/////////////////
        		//Formato Interno
        		/////////////////
        		}else if ($formato == "Interno"){
        			$totalrow = 1;
        			$finfito = 200;
        			date_default_timezone_set('america/santiago');
        			$fecha=date('Y-m-d H:i:s');
					$Fecha_Medicion= '';
					$Fecha_Analisis= '';
        					foreach ($data as $row) {	
        						if($totalrow == (2 + $version) ){
        									$IDcentro_siep = str_replace(chr( 194 ) . chr( 160 ), '',$row[3]);		
																				
        									$IDcentro_siep = str_replace(' ', '',$IDcentro_siep);
        									$Tecnica = str_replace("'",chr(34),$row[5]);
        						}else
        						if($totalrow == (3 + $version) ){
        									if($row[3] != ""){
        										$Fecha_Medicion = date_format($row[3],'Y-m-d');
        									}else{$Fecha_Medicion = "";}
        									$Observaciones = str_replace("'",chr(34),$row[5]);
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
        									 $Conducta_Peces = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (10 + $version) ){
        									$Peso = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (11 + $version) ){
        									$Color = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (12 + $version) ){
        									$Disco = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (13 + $version) ){
        									$Espuma = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (14 + $version) ){
        									$Estado_mar = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (15 + $version) ){
        									$Marea = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (16 + $version) ){
        									$Medusas = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (17 + $version) ){
        									$Transparencia = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (18 + $version) ){
        									$Cielo = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (19 + $version) ){
        									$Precipitacion = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (20 + $version) ){
        									$Direccion_viento = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (21 + $version) ){
        									$Intensidad_viento = str_replace("'",chr(34),$row[2]);
        						}else
        						if($totalrow == (24 + $version) ){
        									$o2_percent_1 = str_replace(",",".",$row[2]);
        									$o2_percent_2 = str_replace(",",".",$row[3]);
        									$o2_percent_3 = str_replace(",",".",$row[4]);
        									$o2_percent_4 = str_replace(",",".",$row[5]);
        									$o2_percent_5 = str_replace(",",".",$row[6]);
        									$o2_percent_6 = str_replace(",",".",$row[7]);
        									$o2_percent_7 = str_replace(",",".",$row[8]);
        						}else
        						if($totalrow == (25 + $version) ){
        									$o2_mg_1 = str_replace(",",".",$row[2]);
        									$o2_mg_2 = str_replace(",",".",$row[3]);
        									$o2_mg_3 = str_replace(",",".",$row[4]);
        									$o2_mg_4 = str_replace(",",".",$row[5]);
        									$o2_mg_5 = str_replace(",",".",$row[6]);
        									$o2_mg_6 = str_replace(",",".",$row[7]);
        									$o2_mg_7 = str_replace(",",".",$row[8]);
        						}else
        						if($totalrow == (26 + $version) ){
        									$Salinidad_1 = str_replace(",",".",$row[2]);
        									$Salinidad_2 = str_replace(",",".",$row[3]);
        									$Salinidad_3 = str_replace(",",".",$row[4]);
        									$Salinidad_4 = str_replace(",",".",$row[5]);
        									$Salinidad_5 = str_replace(",",".",$row[6]);
        									$Salinidad_6 = str_replace(",",".",$row[7]);
        									$Salinidad_7 = str_replace(",",".",$row[8]);
        						}else
        						if($totalrow == (27 + $version) ){
        									$Temperatura_1 = str_replace(",",".",$row[2]);
        									$Temperatura_2 = str_replace(",",".",$row[3]);
        									$Temperatura_3 = str_replace(",",".",$row[4]);
        									$Temperatura_4 = str_replace(",",".",$row[5]);
        									$Temperatura_5 = str_replace(",",".",$row[6]);
        									$Temperatura_6 = str_replace(",",".",$row[7]);
        									$Temperatura_7 = str_replace(",",".",$row[8]);
        						}else
        						if($totalrow >= (29 + $version)   && $totalrow <= $finfito && $row[1] != "" &&  ($row[2] >= 0 || $row[3] >= 0 || $row[4] >= 0 || $row[5] >= 0 || $row[6] >= 0 || $row[7] >= 0 || $row[8] >= 0) ){


        									if($row[2] >= 0){$med1 = $row[2];}else{$med1 = "";}
        									if($row[3] >= 0){$med2 = $row[3];}else{$med2 = "";}
        									if($row[4] >= 0){$med3 = $row[4];}else{$med3 = "";}
        									if($row[5] >= 0){$med4 = $row[5];}else{$med4 = "";}
        									if($row[6] >= 0){$med5 = $row[6];}else{$med5 = "";}
        									if($row[7] >= 0){$med6 = $row[7];}else{$med6 = "";}
        									if($row[8] >= 0){$med7 = $row[8];}else{$med7 = "";}

        									$Nombre_Especie[] = array(
        													'Nombre' => $row[1],
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


         		

        	}else
        	if ($extension == 'xls') {


        		
        		
        		$totalrow = 0;
        		$finfito = 10000000;
        		$resultados = 23;
        		foreach ($data as $row) {
        					//echo json_encode($row[A']);
        					if($row[0] == "Observaciones: " || $row[0] == "Observaciones:"){ $finfito = $totalrow;}
        					if($row[0] == "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL) " || $row[0] == "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL)"){ $resultados = $totalrow;}
        					if($totalrow == 8){
        					 			$IDcentro_siep = str_replace(chr( 194 ) . chr( 160 ), '',$row[5]);
        								$IDcentro_siep = str_replace(' ', '',$IDcentro_siep);
        					}else
        					if($totalrow == 11){
        								$fecha_med_aux = new \DateTime($row[1]);
        							  	$Fecha_Medicion = date_format($fecha_med_aux,'Y-m-d');
        								$fecha_ana_aux = new \DateTime($row[5]);
        							 	$Fecha_Analisis = date_format($fecha_ana_aux,'Y-m-d');
        					}else
        					if($totalrow == 12){
        								//$Hora_Medicion = $row[1];
        								$fecha_aux = new \DateTime($row[5]);
        								$fecha = date_format($fecha_aux,'Y-m-d');
        					}else
        					if($totalrow == 13){
        								$Disco = str_replace("'",chr(34),$row[1]);
        								$Conducta_Peces = str_replace("'",chr(34),$row[3]);
        					}else
        					if($row[0] == "Temperatura(ºC)" || $row[0] == "Temperatura(ºC) " || $row[0] == "Temperatura(C)" || $row[0] == "Temperatura(C) "){//$totalrow == 20){
        								$Temperatura_1 = str_replace(",",".",$row[1]);
        								$Temperatura_2 = str_replace(",",".",$row[2]);
        								$Temperatura_3 = str_replace(",",".",$row[3]);
        								$Temperatura_4 = str_replace(",",".",$row[4]);
        								if(isset($row[5])){
        								$Temperatura_5 = str_replace(",",".",$row[5]);
        								}else{$Temperatura_5 = "";}
        								if(isset($row[6])){
        								$Temperatura_6 = str_replace(",",".",$row[6]);
        								}else{$Temperatura_6 = "";}
        								if(isset($row[7])){
        								$Temperatura_7 = str_replace(",",".",$row[7]);
        								}else{$Temperatura_7 = "";}
        					}else
        					if($row[0] == "Salinidad (ppmil)" || $row[0] == "Salinidad (ppmil) "){//if($totalrow == 21){
        								$Salinidad_1 = str_replace(",",".",$row[1]);
        								$Salinidad_2 = str_replace(",",".",$row[2]);
        								$Salinidad_3 = str_replace(",",".",$row[3]);
        								$Salinidad_4 = str_replace(",",".",$row[4]);
        								if(isset($row[5])){
        									$Salinidad_5 = str_replace(",",".",$row[5]);
        								}else{$Salinidad_5 = "";}
        								if(isset($row[6])){
        									$Salinidad_6 = str_replace(",",".",$row[6]);
        								}else{$Salinidad_6 = "";}
        								if(isset($row[7])){
        									$Salinidad_7 = str_replace(",",".",$row[7]);
        								}else{$Salinidad_7 = "";}
        					}else
        					if($row[0] == "Oxigeno (mg/L)" || $row[0] == "Oxigeno (mg/L) "){ //if($totalrow == 22){
        								$o2_mg_1 = str_replace(",",".",$row[1]);
        								$o2_mg_2 = str_replace(",",".",$row[2]);
        								$o2_mg_3 = str_replace(",",".",$row[3]);
        								$o2_mg_4 = str_replace(",",".",$row[4]);
        								if(isset($row[5])){
        									$o2_mg_5 = str_replace(",",".",$row[5]);
        								}else{$o2_mg_5 = "";}
        								if(isset($row[6])){
        									$o2_mg_6 = str_replace(",",".",$row[6]);
        								}else{$o2_mg_6 = "";}
        								if(isset($row[7])){
        									$o2_mg_7 = str_replace(",",".",$row[7]);
        								}else{$o2_mg_7 = "";}
        					}else
        					if($row[0] == "Oxigeno (% Sat.)" || $row[0] == "Oxigeno (% Sat.) "){ //if($totalrow == 23){
        								$o2_percent_1 = str_replace(",",".",$row[1]);
        								$o2_percent_2 = str_replace(",",".",$row[2]);
        								$o2_percent_3 = str_replace(",",".",$row[3]);
        								$o2_percent_4 = str_replace(",",".",$row[4]);
        								if(isset($row[5])){
        									$o2_percent_5 = str_replace(",",".",$row[5]);
        								}else{$o2_percent_5 = "";}
        								if(isset($row[6])){
        									$o2_percent_6 = str_replace(",",".",$row[6]);
        								}else{$o2_percent_6 = "";}
        								if(isset($row[7])){
        									$o2_percent_7 = str_replace(",",".",$row[7]);
        								}else{$o2_percent_7 = "";}
        					}else
        					if($totalrow > $resultados   && $totalrow < $finfito

        										&& $row[0] != ""
        										&& $row[0] != "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL) "
        										&& $row[0] != "Sub Total "
        										&& $row[0] != "DIATOMEAS "
        										&& $row[0] != "PROTOZOA "
        										&& $row[0] != "ZOOPLANCTON "
        										&& $row[0] != "DINOFLAGELADOS "
        										&& $row[0] != "OTROS GRUPOS "
        										&& $row[0] != "DICTYOCOFICEAS "
        										&& $row[0] != "CRIPTOFICEAS "
        										&& $row[0] != "CRISOFICEAS "
        										&& $row[0] != "EUGLENOFICEAS "
        										&& $row[0] != "RAFIDOFICEAS "
        										&& strpos($row[0], " TOTAL ") >= 0
        										&& $row[0] != "FITOPLANCTON TOTAL "
        										&& $row[0] != "ZOOPLANCTON TOTAL "

        										&& $row[0] != "RESULTADOS DE MUESTRAS DE AGUA (Cel/mL)"
        										&& $row[0] != "Sub Total"
        										&& $row[0] != "DIATOMEAS"
        										&& $row[0] != "PROTOZOA"
        										&& $row[0] != "ZOOPLANCTON"
        										&& $row[0] != "DINOFLAGELADOS"
        										&& $row[0] != "OTROS GRUPOS"
        										&& $row[0] != "DICTYOCOFICEAS"
        										&& $row[0] != "CRIPTOFICEAS"
        										&& $row[0] != "CRISOFICEAS"
        										&& $row[0] != "EUGLENOFICEAS"
        										&& $row[0] != "RAFIDOFICEAS"
        										&& strpos($row[0], " TOTAL") >= 0
        										&& $row[0] != "FITOPLANCTON TOTAL"
        										&& $row[0] != "ZOOPLANCTON TOTAL"
        										&&
        										($row[1] >= 0 || $row[2] >= 0 || $row[3] >= 0 || $row[4] >= 0 || $row[5] >= 0 || $row[6] >= 0 || $row[7] >= 0 )
        										){
        								$espaux = str_replace("'",chr(34),$row[0]);
        								if(strpos($espaux,"(C") === false){
        									//$Nombre_Especie[] = $espaux;
        								}else{
        									$nelimina = (strlen($espaux) - strpos($espaux,"(C")+1)*-1;
        									$espaux = substr($espaux, 0, $nelimina);
        								}

        								if(isset($row[1])){
        									//if($totalrow == 37){echo " -----> ";}
        								$med1 = eliminacomas($row[1]);
        									//if($totalrow == 37){echo " <----- ";}
        								}else{$med1 = "";}
        								if(isset($row[2])){
        								$med2 = eliminacomas($row[2]);
        								}else{$med2 = "";}
        								if(isset($row[3])){
        								$med3 = eliminacomas($row[3]);
        								}else{$med3 = "";}
        								if(isset($row[4])){
        								$med4 = eliminacomas($row[4]);
        								}else{$med4 = "";}
        								if(isset($row[5])){
        								$med5 = eliminacomas($row[5]);
        								}else{$med5 = "";}
        								if(isset($row[6])){
        								$med6 = eliminacomas($row[6]);
        								}else{$med6 = "";}
        								if(isset($row[7])){
        								$med7 = eliminacomas($row[7]);
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
        						//echo json_encode($row[0]);
        					if (strpos($row[0], "Cuantitativo Utilizado:") !== false) {
        								$Tecnica = str_replace('Metodo Cuantitativo Utilizado: ','',$row[0]);
        					}
        					}
        					//echo json_encode("fila: ".$totalrow." : ".$row[0]);
        					$totalrow++;
        				}
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
                                ->first();
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
        				if(!isset($consulta))
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
                                                    'Laboratorio' => $Laboratorio,
                                                    'Tipo_Carga' => 'Planilla Excel'
                            ]);                          
                                                                
        					// $consulta = mysqli_query($con,"INSERT INTO medicion(IDcentro,Fecha_Envio,Fecha_Reporte,Fecha_Analisis,Estado_Alarma,Tecnica,Observaciones,Mortalidad,Especie,Siembra,Cosecha,Firma,Estado,Laboratorio,Tipo_Carga) VALUES ('$IDcentro', '$fecha', '$Fecha_Medicion','$Fecha_Analisis','Ausencia Microalgas', '$Tecnica','$Observaciones','$Mortalidad', '$Especie', '$Siembra', '$Cosecha', '$Firma','1','$Laboratorio','Planilla Excel')")
        					// or die ( $error ="Error description 5: ".mysqli_error($consulta) );

        					$IDmedicion = $consulta->IDmedicion; //mysqli_insert_id($consulta); /*----------------------------------REVISAR FUNCION --------------------------------------------- */
							
        					if($error == 0){
        						//Save Especies
        						// $string = "";
								$insertData = [];
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
        									if (!isset($consulta1)) {
        										$IDespecie_general = $consulta1->IDespecie_general;
        									}

											$IDespecie_general_aux = EspecieEstandar::where([
												['Nombre', $nombre_aux],
												['IDempresa', $IDempresa]
												])
											->select('IDespecie_general')
											->first();
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

        									if (!isset($consulta)) {  //Si no encuentra la especie,
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
        												//$row = $consulta4;
        											}
        									}

        									$IDespecie = '';
        									$Fiscaliza_aux = '';
        									$Nociva_aux = '';
        									$Nivel_Critico_aux = '';
        									$Alarma_Rojo_aux ='';
        									$Alarma_Amarillo_aux = '';

        									if (!isset($consulta4)) {
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
												$insertData[] = ['IDmedicion' => $IDmedicion,
												                        'IDespecie'=> $IDespecie,
                                                                        'Fiscaliza'=> '0',
                                                                        'Nociva'=>'0',
                                                                        'Nivel_Critico'=>'0',
                                                                        'Alarma_Rojo'=>'0',
                                                                        'Alarma_Amarillo'=>'0',
                                                                        'Medicion_1'=>$Medicion1,
                                                                        'Medicion_2'=>$Medicion2,
                                                                        'Medicion_3'=>$Medicion3,
                                                                        'Medicion_4'=>$Medicion4,
																		'Medicion_5'=>$Medicion5,
                                                                        'Medicion_6'=>$Medicion6,
                                                                        'Medicion_7'=>$Medicion7];
        										//$string = $string."('$IDmedicion', ".$IDespecie.", '0', '0', '0', '0', '0', '$Medicion1', '$Medicion2', '$Medicion3', '$Medicion4', '$Medicion5', '$Medicion6', '$Medicion7'),";
        									}else{
												$insertData[] = ['IDmedicion' => $IDmedicion,
												                        'IDespecie'=> $IDespecie,
                                                                        'Fiscaliza'=> $Fiscaliza_aux,
                                                                        'Nociva'=>$Nociva_aux,
                                                                        'Nivel_Critico'=>$Nivel_Critico_aux,
                                                                        'Alarma_Rojo'=>$Alarma_Rojo_aux,
                                                                        'Alarma_Amarillo'=>$Alarma_Amarillo_aux,
                                                                        'Medicion_1'=>$Medicion1,
                                                                        'Medicion_2'=>$Medicion2,
                                                                        'Medicion_3'=>$Medicion3,
                                                                        'Medicion_4'=>$Medicion4,
																		'Medicion_5'=>$Medicion5,
                                                                        'Medicion_6'=>$Medicion6,
                                                                        'Medicion_7'=>$Medicion7];
        										//$string = $string."('$IDmedicion', ".$IDespecie.", '$Fiscaliza_aux', '$Nociva_aux', '$Nivel_Critico_aux', '$Alarma_Rojo_aux', '$Alarma_Amarillo_aux', '$Medicion1', '$Medicion2', '$Medicion3', '$Medicion4', '$Medicion5', '$Medicion6', '$Medicion7'),";
        									}
        								}
        							}
        						}

        						if(count($insertData)> 0){
        							//Save Medicion_fan
                                        $consulta = MedicionFan::insert($insertData);
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
								$insertData= [];
                                $IDconductaPeces = Pambientales::select('IDpambientales')->where([['Nombre', 'Conducta Peces'],['IDempresa', $IDempresa]])->first();
								$insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDconductaPeces->IDpambientales,
													'Medicion_1'=> $Conducta_Peces,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
                                //$string = $string."('$IDmedicion', $IDconductaPeces->IDpambientales,'$Conducta_Peces','','','','','',''),";
                                //DB::select(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Conducta Peces' AND IDempresa = '$IDempresa')
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Conducta Peces' AND IDempresa = '$IDempresa'),'$Conducta_Peces','','','','','',''),";

        						if(isset($Peso)){
                                    $IDpeso = Pambientales::select('IDpambientales')->where([['Nombre', 'Peso Promedio [Kg]'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDpeso->IDpambientales,
													'Medicion_1'=> $Peso,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDpeso->IDpambientales,'$Peso','','','','','',''),";
        							//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Peso Promedio [Kg]' AND IDempresa = '$IDempresa'),'$Peso','','','','','',''),";
        						}

        						if(isset($Color)){
                                    $IDcolor = Pambientales::select('IDpambientales')->where([['Nombre', 'Color'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDcolor->IDpambientales,
													'Medicion_1'=> $Color,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDcolor->IDpambientales,'$Color','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Color' AND IDempresa = '$IDempresa'),'$Color','','','','','',''),";
        						}

        						if(isset($Disco)){
                                    $IDdiscoSecchi = Pambientales::select('IDpambientales')->where([['Nombre', 'Disco Secchi [m]'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDdiscoSecchi->IDpambientales,
													'Medicion_1'=> $Disco,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDdiscoSecchi->IDpambientales,'$Disco','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Disco Secchi [m]' AND IDempresa = '$IDempresa'),'$Disco','','','','','',''),";
        						}

        						if(isset($Espuma)){
                                    $IDespuma = Pambientales::select('IDpambientales')->where([['Nombre', 'Espuma'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDespuma->IDpambientales,
													'Medicion_1'=> $Espuma,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDespuma->IDpambientales,'$Espuma','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Espuma' AND IDempresa = '$IDempresa'),'$Espuma','','','','','',''),";
        						}
                                
        						if(isset($Estado_mar)){
                                    $IDestado = Pambientales::select('IDpambientales')->where([['Nombre', 'Estado'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDestado->IDpambientales,
													'Medicion_1'=> $Estado_mar,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDestado->IDpambientales,'$Estado_mar','','','','','',''),";
                                  //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Estado' AND IDempresa = '$IDempresa'),'$Estado_mar','','','','','',''),";
        						}

        						if(isset($Marea)){
                                    $IDmarea = Pambientales::select('IDpambientales')->where([['Nombre', 'Marea'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDmarea->IDpambientales,
													'Medicion_1'=> $Marea,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDmarea->IDpambientales,'$Marea','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Marea' AND IDempresa = '$IDempresa'),'$Marea','','','','','',''),";
        						}

        						if(isset($Medusas)){
                                    $IDmedusas = Pambientales::select('IDpambientales')->where([['Nombre', 'Medusas'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDmedusas->IDpambientales,
													'Medicion_1'=> $Medusas,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDmedusas->IDpambientales,'$Medusas','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Medusas' AND IDempresa = '$IDempresa'),'$Medusas','','','','','',''),";
        						}
                                
        						if(isset($Transparencia)){
                                    $IDtransparencia = Pambientales::select('IDpambientales')->where([['Nombre', 'Transparencia'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDtransparencia->IDpambientales,
													'Medicion_1'=> $Transparencia,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDtransparencia->IDpambientales,'$Transparencia','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Transparencia' AND IDempresa = '$IDempresa'),'$Transparencia','','','','','',''),";
        						}

        						if(isset($Cielo)){
                                    $IDcielo = Pambientales::select('IDpambientales')->where([['Nombre', 'Cielo'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDcielo->IDpambientales,
													'Medicion_1'=> $Cielo,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDcielo->IDpambientales,'$Cielo','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Cielo' AND IDempresa = '$IDempresa'),'$Cielo','','','','','',''),";
        						}
                                
        						if(isset($Precipitacion)){
                                    $IDprecipitacion = Pambientales::select('IDpambientales')->where([['Nombre', 'Precipitación'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDprecipitacion->IDpambientales,
													'Medicion_1'=> $Precipitacion,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDprecipitacion->IDpambientales,'$Precipitacion','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Precipitación' AND IDempresa = '$IDempresa'),'$Precipitacion','','','','','',''),";
        						}
                                
        						if(isset($Direccion_viento)){
                                    $IDviento = Pambientales::select('IDpambientales')->where([['Nombre', 'Viento'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDviento->IDpambientales,
													'Medicion_1'=> $Direccion_viento,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDviento->IDpambientales,'$Direccion_viento','','','','','',''),";
                                    //$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Viento' AND IDempresa = '$IDempresa'),'$Direccion_viento','','','','','',''),";
        						}

        						if(isset($Intensidad_viento)){
                                    $IDvientoIntensidad = Pambientales::select('IDpambientales')->where([['Nombre', 'Viento (Intensidad)'],['IDempresa', $IDempresa]])->first();
                                    $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDvientoIntensidad->IDpambientales,
													'Medicion_1'=> $Intensidad_viento,
													'Medicion_2'=> '',
													'Medicion_3'=> '',
													'Medicion_4'=> '',
													'Medicion_5'=> '',
													'Medicion_6'=> '',
													'Medicion_7'=> ''];
									//$string = $string."('$IDmedicion', $IDvientoIntensidad->IDpambientales,'$Intensidad_viento','','','','','',''),";
        							//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM gtr_pambientales WHERE Nombre = 'Viento (Intensidad)' AND IDempresa = '$IDempresa'),'$Intensidad_viento','','','','','',''),";
        						}



        						if(!isset($Temperatura_5)){$Temperatura_5 = "";}
        						if(!isset($Temperatura_6)){$Temperatura_6 = "";}
        						if(!isset($Temperatura_7)){$Temperatura_7 = "";}
                                $IDtemperatura = PAmbientales::select('IDpambientales')->where([['Nombre','Temperatura [ºC]'],['IDempresa', $IDempresa]]);
                                $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDtemperatura->IDpambientales,
													'Medicion_1'=> $Temperatura_1,
													'Medicion_2'=> $Temperatura_2,
													'Medicion_3'=> $Temperatura_3,
													'Medicion_4'=> $Temperatura_4,
													'Medicion_5'=> $Temperatura_5,
													'Medicion_6'=> $Temperatura_6,
													'Medicion_7'=> $Temperatura_7];
								//$string = $string."('$IDmedicion', $IDtemperatura->IDpambientales,'$Temperatura_1','$Temperatura_2','$Temperatura_3','$Temperatura_4','$Temperatura_5','$Temperatura_6','$Temperatura_7'),";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Temperatura [ºC]' AND IDempresa = '$IDempresa'),'$Temperatura_1','$Temperatura_2','$Temperatura_3','$Temperatura_4','$Temperatura_5','$Temperatura_6','$Temperatura_7'),";

        						if(!isset($Salinidad_5)){$Salinidad_5 = "";}
        						if(!isset($Salinidad_6)){$Salinidad_6 = "";}
        						if(!isset($Salinidad_7)){$Salinidad_7 = "";}
                                $IDsalinidad = PAmbientales::select('IDpambientales')->where([['Nombre','Salinidad'],['IDempresa', $IDempresa]]);
                                $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDsalinidad->IDpambientales,
													'Medicion_1'=> $Salinidad_1,
													'Medicion_2'=> $Salinidad_2,
													'Medicion_3'=> $Salinidad_3,
													'Medicion_4'=> $Salinidad_4,
													'Medicion_5'=> $Salinidad_5,
													'Medicion_6'=> $Salinidad_6,
													'Medicion_7'=> $Salinidad_7];
								//$string = $string."('$IDmedicion', $IDsalinidad,'$Salinidad_1','$Salinidad_2','$Salinidad_3','$Salinidad_4','$Salinidad_5','$Salinidad_6','$Salinidad_7'),";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Salinidad' AND IDempresa = '$IDempresa'),'$Salinidad_1','$Salinidad_2','$Salinidad_3','$Salinidad_4','$Salinidad_5','$Salinidad_6','$Salinidad_7'),";

        						if(!isset($o2_mg_5)){$o2_mg_5 = "";}
        						if(!isset($o2_mg_6)){$o2_mg_6 = "";}
        						if(!isset($o2_mg_7)){$o2_mg_7 = "";}
                                $IDoxigenoDisuelto = PAmbientales::select('IDpambientales')->where([['Nombre','Oxigeno Disuelto [mg/l]'],['IDempresa', $IDempresa]]);
                                $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDoxigenoDisuelto->IDpambientales,
													'Medicion_1'=> $o2_mg_1,
													'Medicion_2'=> $o2_mg_2,
													'Medicion_3'=> $o2_mg_3,
													'Medicion_4'=> $o2_mg_4,
													'Medicion_5'=> $o2_mg_5,
													'Medicion_6'=> $o2_mg_6,
													'Medicion_7'=> $o2_mg_7];
								//$string = $string."('$IDmedicion', $IDoxigenoDisuelto,'$o2_mg_1','$o2_mg_2','$o2_mg_3','$o2_mg_4','$o2_mg_5','$o2_mg_6','$o2_mg_7'),";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Oxigeno Disuelto [mg/l]' AND IDempresa = '$IDempresa'),'$o2_mg_1','$o2_mg_2','$o2_mg_3','$o2_mg_4','$o2_mg_5','$o2_mg_6','$o2_mg_7'),";

        						if(!isset($o2_percent_5)){$o2_percent_5 = "";}
        						if(!isset($o2_percent_6)){$o2_percent_6 = "";}
        						if(!isset($o2_percent_7)){$o2_percent_7 = "";}
                                $IDoxigenoDisueltoPorcent = PAmbientales::select('IDpambientales')->where([['Nombre','Oxigeno Disuelto [%]'],['IDempresa', $IDempresa]]);
                                $insertData[] = ['IDmedicion'=> $IDmedicion,
													'IDpambientales'=> $IDoxigenoDisueltoPorcent->IDpambientales,
													'Medicion_1'=> $o2_percent_1,
													'Medicion_2'=> $o2_percent_2,
													'Medicion_3'=> $o2_percent_3,
													'Medicion_4'=> $o2_percent_4,
													'Medicion_5'=> $o2_percent_5,
													'Medicion_6'=> $o2_percent_6,
													'Medicion_7'=> $o2_percent_7];
								// $string = $string."('$IDmedicion', $IDoxigenoDisueltoPorcent,'$o2_percent_1', '$o2_percent_2', 
								// 			'$o2_percent_3', '$o2_percent_4','$o2_percent_5', '$o2_percent_6', '$o2_percent_7')";
        						//$string = $string."('$IDmedicion',(SELECT IDpambientales FROM pambientales WHERE Nombre = 'Oxigeno Disuelto [%]' AND IDempresa = '$IDempresa'),'$o2_percent_1', '$o2_percent_2', '$o2_percent_3', '$o2_percent_4','$o2_percent_5', '$o2_percent_6', '$o2_percent_7')";

											/*===========================la variable string============================= */
        						//Save Parametros Ambientales
                                $consulta = MedicionPAmbientales::insert($insertData);
                                
        // 						/*//Nombre e ID Centro
                                $consulta = Centro::select('Nombre','IDcentro')->where('IDcentro', $IDcentro)->first();                                
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


        							foreach($consulta as $row)
        							{
        								$alarma = "Precaución";
        								$Comentario[] = $row->Nombre;
        								$Concentracion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,
                                        $row->Medicion_6,$row->Medicion_7);
        								$Nocivo[] = $row->Nivel_Critico;
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


        							foreach($consulta as $row)
        							{
        								if(!in_array($row->Nombre, $Comentario)){
        									$Comentario_precaucion[] = $row->Nombre;
        									$Concentracion_precaucion[] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,
                                            $row->Medicion_6,$row->Medicion_7);
        									$Nocivo_P[] = $row->Nivel_Critico;
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
                                                                ->first();
                                   
        							// $consulta = mysqli_query($con,"SELECT IDmedicionfan FROM medicion_fan WHERE IDmedicion = '$IDmedicion' AND (Medicion_1 > 0 OR Medicion_2 > 0 OR Medicion_3 > 0 OR Medicion_4 > 0 OR Medicion_5 > 0 
                                    // OR Medicion_6 > 0 OR Medicion_7 > 0) ")or die ($error ="Error description 11: " . mysqli_error($consulta));


        							if($consulta)
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
        						if($consulta)
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
        							foreach($consulta as $row)
        							{
        								if( $row->IDespecie == 0){
        									$noexiste_index[] = $i;
        									$IDmedicionfan[] = $row->IDmedicionfan;

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
		

		public function descargaFormatopEstandar()
		{
			$miuser = Auth::user();
        	$this->cambiar_bd($miuser->IDempresa); 

			$file = Storage::disk('public')->get('Formato Carga Registro V2.2.xlsm');
 			//return \Response::json($entry);
		
			return Response($file, 200)->header('Content-Type', 'application/vnd.ms-excel.sheet.macroEnabled.12');
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
