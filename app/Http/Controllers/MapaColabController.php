<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapaColabController extends Controller
{
    public function __construct()
	{
		//\DB::setDefaultConnection('mysql');

		//$this->middleware('guest');
		$this->middleware('auth');
		//$this->middleware('acceso.sistema');
		//$this->middleware('politica.empresa');


		//$this->middleware('auth.basic');
	}

    /*================================= rutas mapa colab ============================================*/
    
    public function loadHistorialCentrosPdfColab(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;
        $user_id = $request->input('user_id');
        $IDcentro = $request->input('IDcentro');
        $IDmedicion = $request->input('IDmed');
        $Especies = $request->input('Especies');
        date_default_timezone_set('america/santiago');
        //	$Fecha = date('Y-m-d H:i:s', strtotime($_POST['Fecha']));
        $Fecha_Termino = date('Y-m-d', strtotime($request->input('Fecha'). ' +1 day'));
        $Fecha_Termino = date('Y-m-d 00:00:00', strtotime($Fecha_Termino));
        $Fecha_Inicio = date('Y-m-d', strtotime($Fecha_Termino. ' -7 day'));

        
        $whereespecies = "";
        if($Especies == 1){
            $whereespecies = " AND Fiscaliza = 1 ";	
        }else if($Especies == 2){
            $whereespecies = " AND Nociva = 1 ";		
        }else if($Especies == 3){
            $whereespecies = " AND Grupo = 'Dinoflagelados' ";		
        }else if($Especies == 4){
            $whereespecies = " AND Grupo = 'Diatomeas' ";		
        //	}else if($Especies == 0){
        //		$whereespecies = "  ";		
        }else {
            
            $whereespecies = " AND Nombre = '".$Especies."'";		
        }
        
        
        //Profundidad
        $max = 0;
        if($_POST['Medicion'] == 0){ //Máxima concentración (independiente de la profundidad)
            $max = 1;
        }else{
            $Medicion = "Medicion_".$_POST['Medicion'];
        }
        
        
        //Dejar máximo de 10 días (primer dia de la semana sólo 3 días hacia atras)	
        $earlier = new DateTime($Fecha_Inicio);
        $later = new DateTime();
        
        $datediff = intval($later->diff($earlier)->format("%a"))+1;

        

        if($datediff > 10){
            $datediff = $datediff-10;
            $Fecha_Inicio = date('Y-m-d', strtotime($Fecha_Inicio. ' +'.intval($datediff).' day'));
        }

        
        
        $All_Date = array();
        $All_Date[0] = strtotime( $Fecha_Inicio );
        $d = 0;
        while ( $All_Date[$d] < strtotime(date('Y-m-d'))) {
            $All_Date[$d+1] = strtotime(date('Y-m-d',$All_Date[$d]). '+1 day');
            $d++;
        }
        
        $Interna = $_POST['Interna'];
        $Externa = $_POST['Externa'];
        
        $wherelab = "";
        if($Interna == 1 && $Externa == 0){
            $wherelab = " AND m.Laboratorio = 0 ";
        }else if($Interna == 1 && $Externa == 1){
            $wherelab = " AND  m.Laboratorio >= 0 ";
        }else if($Interna == 0 && $Externa == 0){
            $wherelab = " AND m.Laboratorio < 0 ";
        }else if($Interna == 0 && $Externa == 1){
            $wherelab = " AND m.Laboratorio = 1 ";
        }
        
        ////////Busca las alarmas y nivel critico de la propia empresa, para todas las especies/////
        ///////////////////////////////////////////////////////////////////
        //IDempresa usuario
        $consulta1 = mysqli_query($con,"SELECT IDempresa FROM as_users WHERE user_id = '$user_id'")
        or die ($error ="Error description: " . mysqli_error($consulta1));
        $row = mysqli_fetch_assoc($consulta1);
        $IDempresa = $row['IDempresa'];
        
        //Busca la configuracion de especies de la empresa
        $consulta = mysqli_query($con,"SELECT IDespecie_general,Nociva, Nivel_Critico, Alarma_Rojo, Alarma_Amarillo		
            FROM especie WHERE IDempresa = '$IDempresa' ".$whereespecies)or 
            die ($error ="Error description: " . mysqli_error($consulta));
        $Nivel_Critico_empresa = array();
        $Alarma_Rojo_empresa = array();
        $Alarma_Amarillo_empresa = array();
        $Nociva_empresa = array();
        $IDespecie_filto = array();
        while($row = mysqli_fetch_assoc($consulta))
        {
            $Nivel_Critico_empresa[$row['IDespecie_general']] = $row['Nivel_Critico'];
            $Alarma_Rojo_empresa[$row['IDespecie_general']] = $row['Alarma_Rojo'];
            $Alarma_Amarillo_empresa[$row['IDespecie_general']] = $row['Alarma_Amarillo'];
            $Nociva_empresa[$row['IDespecie_general']] = $row['Nociva'];
            $IDespecie_filto[] = $row['IDespecie_general'];
            
        }
        ////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////
        
        
        //Buscar especies de la muestra para buscar en la última semana
        /*$consulta = mysqli_query($con,"SELECT mf.IDespecie,e.IDespecie_general,mf.Medicion_1, mf.Medicion_2, mf.Medicion_3, mf.Medicion_4, mf.Medicion_5, mf.Medicion_6, mf.Medicion_7 FROM medicion m INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.IDmedicion = '$IDmedicion') INNER JOIN especie e ON (mf.IDespecie = e.IDespecie ".$whereespecies.")")or die ($error ="Error description: " . mysqli_error($consulta));
        
        $especie_rojo = array();
        $especie_amarillo = array();
        $especie_nocivo = array();
        $especie_otro = array();
        while($row = mysqli_fetch_assoc($consulta))
        {
            $max = max($row['Medicion_1'],$row['Medicion_2'],$row['Medicion_3'],$row['Medicion_4'],$row['Medicion_5'],$row['Medicion_6'],$row['Medicion_7']);
            
            
            $nociva = $Nociva_empresa[$row['IDespecie_general']];
            $alarmarojo = $Alarma_Rojo_empresa[$row['IDespecie_general']];
            $alarmaamarillo = $Alarma_Amarillo_empresa[$row['IDespecie_general']];
            
            if($max >= $alarmarojo && $alarmarojo > 0){
                    if(!in_array($row['IDespecie'], $especie_rojo)){$especie_rojo[] = $row['IDespecie'];}
            }else if($max >= $alarmaamarillo && $alarmaamarillo > 0){
                        if(!in_array($row['IDespecie'], $especie_amarillo)){$especie_amarillo[] = $row['IDespecie'];}
            }
            
            if($nociva == 1){
                if(!in_array($row['IDespecie'], $especie_nocivo)){$especie_nocivo[] = $row['IDespecie'];}
            }
            
            if(!in_array($row['IDespecie'], $especie_otro)){$especie_otro[] = $row['IDespecie'];}
            
            
        }
        
            $especie = array();
            if(!empty($especie_rojo) || !empty($especie_amarillo) || !empty($especie_nocivo)){
                $especie = $especie_rojo;
                foreach($especie_amarillo as $especie_amarillo_value){
                    if(!in_array($especie_amarillo_value, $especie)){$especie[] = $especie_amarillo_value;}
                }
                foreach($especie_nocivo as $especie_nocivo_value){
                    if(!in_array($especie_nocivo_value, $especie)){$especie[] = $especie_nocivo_value;}
                }
            }else {
                $especie = $especie_otro;
            }		
        //echo json_encode($especie);
        
        //$especie = array_slice($especie, 0, 5);
        
        $Inespecies = implode(', ',$especie);
        
        $where = " AND e.IDespecie IN ($Inespecies)";*/
        
        //Busca todas las especies en la semana que sea "Nociva" en este caso
        
        $where = "  ";
        
        
        $Inespecies = "algo";
        $n = 0;
        if($Inespecies != ""){
            //Fiscaliza = 1  
            $consulta = mysqli_query($con,"SELECT m.IDmedicion,DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i') 
            as fecha_reporte_format, DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y') as 
            Date_Reporte, e.Nombre,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4, mf.Medicion_5, mf.Medicion_6, 
            mf.Medicion_7,e.IDespecie_general,m.IDmedicion FROM (medicion m INNER JOIN medicion_fan mf 
            ON (m.IDmedicion = mf.IDmedicion AND m.IDcentro = '$IDcentro' AND m.Estado = 1 ".$wherelab.") ), 
            especie e WHERE  e.IDespecie = mf.IDespecie AND e.IDespecie_general IN (".implode(',',$IDespecie_filto).") 
            AND m.Fecha_Reporte > '$Fecha_Inicio' AND m.Fecha_Reporte <= '$Fecha_Termino' 
            AND (mf.Medicion_1 > 0 OR mf.Medicion_2 > 0 OR mf.Medicion_3 > 0 OR mf.Medicion_4 > 0 OR mf.Medicion_5 > 0 
            OR mf.Medicion_6 > 0 OR mf.Medicion_7 > 0) ORDER BY e.Nombre ASC, m.Fecha_Reporte DESC")or die ($error ="Error description: " . mysqli_error($consulta));
            
            $Resultado = array();
            $nombreaux = "";
            $timestampmax = 0;
            $timestampmin = 0;
            $med = array();
            $med_norm = array();
            $Alarma_Rojo = array();
            $Alarma_Amarillo = array();
            
            $critico = 1;
            $sinmedicionenprofundidad = 0;
            while($row = mysqli_fetch_assoc($consulta))
            {	
                
                if($max == 1 ){
                    $med[$n] = max($row['Medicion_1'],$row['Medicion_2'],$row['Medicion_3'],$row['Medicion_4'],$row['Medicion_5'],$row['Medicion_6'],$row['Medicion_7']);
                }else{
                    $med[$n] = $row[$Medicion];
                }
                if( $med[$n] != ""){
                
                    $nivelcritico = $Nivel_Critico_empresa[$row['IDespecie_general']];
                    $alarmarojo = $Alarma_Rojo_empresa[$row['IDespecie_general']];
                    $alarmaamarillo = $Alarma_Amarillo_empresa[$row['IDespecie_general']];
                    
                    if($nombreaux != $row['Nombre']){$nombre = $row['Nombre']; $nombreaux = $nombre; $Resultado['Nombre'][] = $nombre;}
                    $timestamp = strtotime($row['Date_Reporte'])*1000;
                    
                    
                    $Alarma_Rojo[$n] = $alarmarojo;
                    $Alarma_Amarillo[$n] = $alarmaamarillo;
                    
                    if($nivelcritico>0){
                        $med_norm[$n] = 100*$med[$n]/$nivelcritico;
                    }else{$med_norm[$n] = $med[$n]; $critico = 0;}
                    
                    
                    
                    if(isset($Fecha[$nombre])){
                        $key = array_search($timestamp, $Fecha[$nombre]);
                    }else{$key = false;}
                    
                    if ($key !== false){
                        $ant = $Resultado[$nombre][$key][1];
                        if($ant < $med[$n] ){
                            $Resultado[$nombre."norm"][$key] = array($timestamp, $med_norm[$n], $alarmarojo,$alarmaamarillo,$med[$n],$nivelcritico,$row['fecha_reporte_format'],$row['IDmedicion'],strtotime($row['Date_Reporte']) );
                            
                            $Resultado[$nombre][$key] = array($timestamp, $med[$n], $alarmarojo,$alarmaamarillo,$med[$n],$nivelcritico,$row['fecha_reporte_format'],$row['IDmedicion'],strtotime($row['Date_Reporte']) );
                            
                        }
                    }else{
                        
                        $Resultado[$nombre."norm"][] = array($timestamp, $med_norm[$n], $alarmarojo,$alarmaamarillo,$med[$n],$nivelcritico,$row['fecha_reporte_format'],$row['IDmedicion'],strtotime($row['Date_Reporte']) );
                    
                        $Resultado[$nombre][] = array($timestamp, $med[$n], $alarmarojo,$alarmaamarillo,$med[$n],$nivelcritico,$row['fecha_reporte_format'],$row['IDmedicion'],strtotime($row['Date_Reporte']) );
                        
                        $Fecha[$nombre][] = $timestamp;
                    }
                    
                    
                    
                    
                                    
                    if($timestampmin == 0){$timestampmin = $timestamp;}
                    if($timestamp > $timestampmax){$timestampmax = $timestamp;}
                    if($timestamp < $timestampmin){$timestampmin = $timestamp;}
                    $n++;
                }else{
                $sinmedicionenprofundidad = 1;	
                }
            }
            
        
        
            if($n > 0){
            $Resultado['Error'] = $error;
            $Resultado['Max_norm'] = max($med_norm);
            $Resultado['Max'] = max($med);
            $Resultado['Critico'] = $critico;
            $Resultado['Rojo'] =  max($Alarma_Rojo);
            $Resultado['Amarillo'] =  max($Alarma_Amarillo);
            $Resultado['F_Min'] = strtotime($Fecha_Inicio)*1000;//$timestampmin;
            $Resultado['F_Max'] = strtotime($Fecha_Termino. ' -1 day')*1000;//$timestampmax;
            $Resultado['Semana'] = $All_Date;
            
            }else if($sinmedicionenprofundidad == 1){
                $Resultado['Error'] = 11;	
            }else {
                $Resultado['Error'] = 1;	
            }	
        }else{$Resultado['Error'] = 1;}
        
        echo json_encode($Resultado);
    }


    /*===================================================================================================================*/

    public function loadUbicacionCentrosColab(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $Colaborativo = 1;//$_POST['Colaborativo'];
        $Operando = 1;//$_POST['Operando'];
        $Historia = 0;//$_POST['Historia'];
        
        $whereestado = "";
        if($Operando == 1 && $Historia == 0){
            $whereestado = "c.Estado = 1";
        }else if($Operando == 1 && $Historia == 1){
            $whereestado = "c.Estado >= 0";
        }else if($Operando == 0 && $Historia == 0){
            $whereestado = "c.Estado < 0";
        }else if($Operando == 0 && $Historia == 1){
            $whereestado = "c.Estado = 0";
        }
        
        //$where = " AND c.IDregion = ( SELECT IDregion FROM region WHERE r.Nombre = '$Nombre_Region' AND IDempresa = (SELECT IDempresa FROM usuario_permiso WHERE user_id = '$user_id') )";
        
        //IDempresa usuario
        $consulta1 = mysqli_query($con,"SELECT IDempresa FROM as_users WHERE user_id = '$user_id'")
        or die ($error ="Error description: " . mysqli_error($consulta1));
        $row = mysqli_fetch_assoc($consulta1);
        $IDempresa = $row['IDempresa'];
        
        
        $wherecolab = " AND c.IDempresa = '$IDempresa'";
        if($Colaborativo == 1){
            if($whereestado != ""){
                $wherecolab = " AND c.Colaborativo = '1'";
            }else{
                $wherecolab = " c.Colaborativo = '1'";
            }
        }
        
        
        //AND IDregion = ( SELECT IDregion FROM region WHERE Nombre = '$Nombre_Region' )
        $consulta = mysqli_query($con,"SELECT c.IDcentro,c.Nombre,c.TopLeft,c.Codigo,c.Especie,c.Estado, 
        b.Nombre as Barrio,c.IDempresa FROM centro c INNER JOIN barrio b ON (c.IDbarrio = b.IDbarrio) 
        WHERE ".$whereestado.$wherecolab." ORDER BY (CASE WHEN c.IDempresa = '$IDempresa' THEN 0 ELSE 1 END), c.IDcentro")
        or die ($error ="Error description: " . mysqli_error($consulta));

            
        
        $Resultado = array();
        $existe = 0;
        $i = 0;
        while($row = mysqli_fetch_assoc($consulta))
        {	
            $i++;
            $nombre_centro = "".$i."";
            //$nombre_centro = $row['IDcentro'];
            if($IDempresa == $row['IDempresa']){
                $nombre_centro = $row['Nombre'];
                $i--;
            }
            $Resultado['TopLeft'][]  = $row['TopLeft'];
            $Resultado['IDcentro'][] = $row['IDcentro'];
            $Resultado['Nombre'][]   = $nombre_centro;
            $Resultado['Codigo'][]   = "";
            $Resultado['Especie'][]  = "";//$row['Especie'];
            $Resultado['Estado'][]   = $row['Estado'];
            $Resultado['Siembra'][]  = "";
            $Resultado['Cosecha'][]  = "";
            $Resultado['Barrio'][]   = $row['Barrio'];
            $existe = 1;
        }
        
        //Busca ubicacion centro del usuario
        $consulta = mysqli_query($con,"SELECT c.TopLeft,r.Nombre FROM centro c INNER JOIN usuario_permiso up 
        ON (c.IDcentro = up.IDcentro AND up.user_id = '$user_id') INNER JOIN region r ON (r.IDregion = c.IDregion) 
        WHERE ".$whereestado." AND up.Estado = 1 LIMIT 1")
        or die ($error ="Error description: " . mysqli_error($consulta));
        
        $row = mysqli_fetch_assoc($consulta);
        if($row){
            $Resultado['TopLeft_Usuario']  = $row['TopLeft'];
            $Resultado['Region_Usuario']  = $row['Nombre'];
        }else{
            $Resultado['TopLeft_Usuario']  = "";
            $Resultado['Region_Usuario']  = "";
        }
            
        
        $Res = array();
        if($existe == 1 ){
            $Res = $Resultado;
            $Res['Error'] = $error;
        }else {$Res['Error'] = "No existe";}
        
        echo json_encode($Res);
    }


    /*===================================================================================================================*/

    public function loadUbicacionBarriosColab(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $error = 0;		
        $user_id = $_POST['user_id'];
        $Colaborativo = 1;//$_POST['Colaborativo'];
        
        //IDempresa usuario
        $consulta1 = mysqli_query($con,"SELECT IDempresa FROM as_users WHERE user_id = '$user_id'")
        or die ($error ="Error description: " . mysqli_error($consulta1));
        $row = mysqli_fetch_assoc($consulta1);
        $IDempresa = $row['IDempresa'];
        
        
        
        //AND IDregion = ( SELECT IDregion FROM region WHERE Nombre = '$Nombre_Region' )
        $consulta = mysqli_query($con,"SELECT * FROM barrio")
        or die ($error ="Error description: " . mysqli_error($consulta));

            
        
        $Resultado = array();
        while($row = mysqli_fetch_assoc($consulta))
        {	
            $coord = "";
            for($n = 1; $n<11; $n++){
                if($row['TopLeft_'.$n.''] != ""){
                    $topleft = explode(",",$row['TopLeft_'.$n.'']);
                    $Resultado['TopLeft'][$row['IDbarrio']][] = array(
                                                                    'lat' => floatval($topleft[0]), 
                                                                    'lng' => floatval($topleft[1]) 
                                                                    );
                }
            }
            
            /*if($coord != ""){
                $coord = rtrim($coord , ',');
                $Resultado['TopLeft'][$row['IDbarrio']]  = $coord;
            }*/
        }
        
        //Busca ubicacion centro del usuario
        $consulta = mysqli_query($con,"SELECT b.TopLeft_1,r.Nombre FROM centro c INNER JOIN usuario_permiso up 
        ON (c.IDcentro = up.IDcentro AND up.user_id = '$user_id') INNER JOIN region r ON (r.IDregion = c.IDregion) 
        INNER JOIN barrio b WHERE up.Estado = 1 LIMIT 1")
        or die ($error ="Error description: " . mysqli_error($consulta));
        
        $row = mysqli_fetch_assoc($consulta);
        if($row){
            $Resultado['TopLeft_Usuario']  = $row['TopLeft_1'];
            $Resultado['Region_Usuario']  = $row['Nombre'];
        }else{
            $Resultado['TopLeft_Usuario']  = "";
            $Resultado['Region_Usuario']  = "";
        }
            
        
        $Res = array();
        $Res = $Resultado;
        $Res['Error'] = $error;
        
        echo json_encode($Res);
    }
    /*===================================================================================================================*/
    /*===================================================================================================================*/

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
