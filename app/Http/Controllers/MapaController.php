<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Centro;
use App\Models\Documento;
use App\Models\Medicion;
use App\Models\MedicionFan;
use App\Models\Opciones;
use App\Models\Pambientales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class MapaController extends Controller
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

    public function loadUbicacionCentro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;
        $user_id = $miuser->id;
        $Nombre_Region = $request->input('Nombre_Region');
        $Colaborativo = $request->input('Colaborativo');
        $Operando = $request->input('Operando');
        $Historia = $request->input('Historia');

        $whereestado = "";
        if($Operando == 1 && $Historia == 0){
            $whereestado = "gtr_centro.Estado = 1";
        }else if($Operando == 1 && $Historia == 1){
            $whereestado = "gtr_centro.Estado >= 0";
        }else if($Operando == 0 && $Historia == 0){
            $whereestado = "gtr_centro.Estado < 0";
        }else if($Operando == 0 && $Historia == 1){
            $whereestado = "gtr_centro.Estado = 0";
        }

        //$where = " AND c.IDregion = ( SELECT IDregion FROM region WHERE r.Nombre = '$Nombre_Region' AND IDempresa = (SELECT IDempresa FROM usuario_permiso WHERE user_id = '$user_id') )";

        $wherecolab = "gtr_centro.IDempresa = $miuser->IDempresa";
        if($Colaborativo == 1){
            if($whereestado != ""){
                $wherecolab = "gtr_centro.Colaborativo = '1'";
            }else{
                $wherecolab = "gtr_centro.Colaborativo = '1'";
            }
        }



        //AND IDregion = ( SELECT IDregion FROM region WHERE Nombre = '$Nombre_Region' )
        $consulta = Centro::join('barrio', 'centro.IDbarrio','=','barrio.IDbarrio')
                            //->where('centro.Estado', '=', 1)
                            ->whereRaw($wherecolab)
                            ->whereRaw($whereestado)
                            ->select('centro.IDcentro',
                                        'centro.Nombre',
                                        'centro.TopLeft',
                                        'centro.Codigo',
                                        'centro.Especie',
                                        'centro.Estado',
                                        DB::raw("DATE_FORMAT(gtr_centro.Siembra, '%d-%m-%Y') as Siembra"),
                                        DB::raw("DATE_FORMAT(gtr_centro.Cosecha, '%d-%m-%Y') as Cosecha"),
                                        'barrio.Nombre as Barrio')
                            ->get();
        // mysqli_query($con,"SELECT c.IDcentro,
        //                     c.Nombre,
        //                     c.TopLeft,
        //                     c.Codigo,
        //                     c.Especie,
        //                     c.Estado,DATE_FORMAT(c.Siembra, '%d-%m-%Y') as
        //                     Siembra,
        //                     DATE_FORMAT(c.Cosecha, '%d-%m-%Y') as Cosecha,
        //                     b.Nombre as Barrio
        // FROM centro c INNER JOIN barrio b ON (c.IDbarrio = b.IDbarrio)
        // WHERE ".$whereestado.$wherecolab." ORDER BY c.Nombre");
        // //or die ($error ="Error description: " . mysqli_error($consulta));



        $Resultado = array();
        $existe = 0;
        foreach($consulta as $row)
        {
            $Resultado['TopLeft'][]  = $row->TopLeft;
            $Resultado['IDcentro'][] = $row->IDcentro;
            $Resultado['Nombre'][]   = $row->Nombre;
            $Resultado['Codigo'][]   = $row->Codigo;
            $Resultado['Especie'][]  = $row->Especie;
            $Resultado['Estado'][]   = $row->Estado;
            $Resultado['Siembra'][]  = $row->Siembra;
            $Resultado['Cosecha'][]  = $row->Cosecha;
            $Resultado['Barrio'][]   = $row->Barrio;
            $existe = 1;
        }

        //Busca ubicacion centro del usuario
        $consulta = Centro::join('usuario_permiso', 'centro.IDcentro', '=' ,'usuario_permiso.IDcentro')
                            ->join('region', 'region.IDregion', '=', 'centro.IDregion')
                            ->whereRaw($whereestado)
                            ->where('usuario_permiso.Estado', 1)
                            ->select('centro.TopLeft','region.Nombre')
                            ->first();

        $row = $consulta;
        if($row){
            $Resultado['TopLeft_Usuario']  = $row->TopLeft;
            $Resultado['Region_Usuario']  = $row->Nombre;
        }else{
            $Resultado['TopLeft_Usuario']  = "";
            $Resultado['Region_Usuario']  = "";
        }
        $Res = array();
        if($existe == 1 ){
            $Res = $Resultado;
            //$Res['TopLeft'] = $Resultado['TopLeft'];
        //		$Res['TopLeft_Usuario'] = $Resultado['TopLeft_Usuario'];
        //		$Res['Region_Usuario'] = $Resultado['Region_Usuario'];
        //		$Res['IDcentro'] = $Resultado['IDcentro'];
        //		$Res['Nombre']  = $Resultado['Nombre'];
                //if($existerojo == 1){
        //		$Res['Alarma_Rojo'] = $Resultado['Alarma_Rojo'];}else{$Res['Alarma_Rojo'] = "";}
        //		if($existeamarillo == 1){
        //		$Res['Alarma_Amarillo'] = $Resultado['Alarma_Amarillo'];}else{$Res['Alarma_Amarillo'] = "";}
        //		if($existegris == 1){
        //		$Res['Alarma_Gris'] = $Resultado['Alarma_Gris'];}else{$Res['Alarma_Gris'] = "";}
        //		if($existetodo == 1){
        //		$Res['Alarma_Existe'] = $Resultado['Alarma_Existe'];}else{$Res['Alarma_Existe'] = "";}
            $Res['Error'] = $error;
        }else {$Res['Error'] = "No existe";}

        return Response::json($Res);

    }


    /*===================================================================================================================*/

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

    public function loadHistorialCentros(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;
        $IDcentro = $request->input('IDcentro');
        $Especies = $request->input('Especies');
        $Medicion = $request->input('Medicion');
        date_default_timezone_set('america/santiago');
        $Fecha_Inicio = date('Y-m-d', strtotime($request->input('Fecha_Inicio')));
        $Fecha_Inicio = date('Y-m-d 00:00:00', strtotime($Fecha_Inicio));
        $Fecha_Termino = date('Y-m-d', strtotime($request->input('Fecha_Termino'). ' +1 day'));
        $Fecha_Termino = date('Y-m-d 00:00:00', strtotime($Fecha_Termino));
        $minaux = ($request->input('Axesmin'))/1000;
        $fechamin = date('Y-m-d 00:00:00', $minaux );

        $maxaux = ($request->input('Axesmax'))/1000;
        $fechamax = date('Y-m-d 00:00:00', $maxaux );



        //if($minaux > 0){
        //		$Fecha_Inicio = $fechamin;
        //		$Fecha_Termino = $fechamax;
        //	}

        $where = " ";
        if($Especies == 1){
            $where = "gtr_e.Fiscaliza = 1 ";
        }else if($Especies == 2){
            $where = $where."gtr_e.Nivel_Critico > 0 ";
        }else if($Especies == 3){
            $where = $where."gtr_e.Nociva = 1 ";
        }

        $wheremed = " ";
        if($Medicion == 1){
            $wheremed = "gtr_m.Laboratorio = 0 ";
        }else if($Medicion == 2){
            $wheremed = $wheremed."gtr_m.Laboratorio = 1 ";
        }


        //Fiscaliza = 1
        $consulta = DB::connection('mysql')->table('medicion as m')
                                            ->join('medicion_fan as mf', 'm.IDmedicion', '=', 'mf.IDmedicion')
                                            // ->join('medicion_fan', function($query) use ($IDcentro){
                                            //             $query->on('m.IDmedicion', '=', 'mf.IDmedicion')
                                            //                     ->where('m.IDcentro', '=', $IDcentro)
                                            //                     ->where('m.Estado', '=', 1);            
                                            //             })
                                            ->join('especie', 'e.IDespecie', '=', 'mf.IDespecie')
                                            ->where([['m.IDcentro', '=', $IDcentro],
                                                    ['m.Estado', '=', 1],
                                                    ['m.Fecha_Reporte', '>', $Fecha_Inicio],
                                                    ['m.Fecha_Reporte', '<=', $Fecha_Termino],])
                                            ->where(function($query){
                                                        $query->where('mf.Medicion_1', '>', 0 )
                                                                ->orWhere('mf.Medicion_2', '>', 0 )
                                                                ->orWhere('mf.Medicion_3', '>', 0 )
                                                                ->orWhere('mf.Medicion_4', '>', 0 )
                                                                ->orWhere('mf.Medicion_5', '>', 0 )
                                                                ->orWhere('mf.Medicion_6', '>', 0 )
                                                                ->orWhere('mf.Medicion_7', '>', 0 );
                                                    })
                                            ->select('m.Fecha_Reporte as fecha', 
                                                        DB::raw("DATE_FORMAT(gtr_m.Fecha_Reporte, '%d-%m-%Y %H:%i') as Fecha_Reporte"), 
                                                        'e.Nombre',
                                                        'mf.Medicion_1',
                                                        'mf.Medicion_2',
                                                        'mf.Medicion_3',
                                                        'mf.Medicion_4', 
                                                        'mf.Medicion_5', 
                                                        'mf.Medicion_6', 
                                                        'mf.Medicion_7',
                                                        'e.Nivel_Critico',
                                                        'e.Grupo',
                                                        'm.IDmedicion',
                                                        'm.Laboratorio'
                                                        )
                                            ->orderBy('e.Nombre', 'ASC')
                                            ->orderBy('fecha', 'ASC')
                                            ->get();
                            //return Response::json($consulta);
        // mysqli_query($con,"SELECT m.Fecha_Reporte as fecha, 
        // DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i') as Fecha_Reporte, 
        // e.Nombre,
        // mf.Medicion_1,
        // mf.Medicion_2,
        // mf.Medicion_3,
        // mf.Medicion_4, 
        // mf.Medicion_5, 
        // mf.Medicion_6, 
        // mf.Medicion_7,
        // e.Nivel_Critico,
        // e.Grupo,
        // m.IDmedicion,
        // m.Laboratorio
        // FROM (medicion m INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.IDcentro = '$IDcentro' AND m.Estado = 1) ), 
        // especie e
        // WHERE  e.IDespecie = mf.IDespecie  "
        // .$where.$wheremed." AND m.Fecha_Reporte > '$Fecha_Inicio' AND m.Fecha_Reporte <= '$Fecha_Termino'
        // AND e.IDespecie = mf.IDespecie
        // AND (mf.Medicion_1 > 0 
        // OR mf.Medicion_2 > 0 
        // OR mf.Medicion_3 > 0 
        // OR mf.Medicion_4 > 0 
        // OR mf.Medicion_5 > 0 
        // OR mf.Medicion_6 > 0 
        // OR mf.Medicion_7 > 0)
        // ORDER BY e.Nombre ASC, fecha DESC")
        // or die ($error ="Error description: " . mysqli_error($consulta));

        $Resultado = array();
        $med = array();
        $med_norm = array();
        $nombreaux = "";
        $Max_norm = array("100","100","100","100","100","100","100");
        $Max = array("0","0","0","0","0","0","0");
        //$Max = 0;
        $timestampmax = 0;
        $timestampmin = 0;
        $n = 0;
        $critico = 1;
        foreach($consulta as $row )
        {
            if($nombreaux != $row->Nombre){$nombre = $row->Nombre; $nombreaux = $nombre; $Resultado['Nombre'][] = $nombre; $Resultado['Grupo'][] = $row->Grupo;}
            $timestamp = strtotime($row->Fecha_Reporte)*1000;
            if($row->Medicion_1){
                if($row->Nivel_Critico>0){
                $med_1_norm = 100*$row->Medicion_1/$row->Nivel_Critico;
                }else{$med_1_norm = $row->Medicion_1;}
                $Resultado[$nombre."1norm"][] = array($timestamp, $med_1_norm ,$row->Medicion_1,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."1"][] = array($timestamp, $row->Medicion_1 ,$row->Medicion_1,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                //Medicion externa
                if($row->Laboratorio == 1){
                    $Resultado[$nombre."1norm_ext"][] = array($timestamp, $med_1_norm ,$row->Medicion_1,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                    $Resultado[$nombre."1_ext"][] = array($timestamp, $row->Medicion_1 ,$row->Medicion_1,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                }

                if($med_1_norm > $Max_norm[0]){$Max_norm[0] = $med_1_norm ;};
                if($row->Medicion_1 > $Max[0]){$Max[0] = $row->Medicion_1 ;};
            }
            if($row->Medicion_2){
                if($row->Nivel_Critico>0){
                $med_2_norm = 100*$row->Medicion_2/$row->Nivel_Critico;
                }else{$med_2_norm = $row->Medicion_2;}
                $Resultado[$nombre."2norm"][] = array($timestamp, $med_2_norm,$row->Medicion_2,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."2"][] = array($timestamp, $row->Medicion_2,$row->Medicion_2,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                if($med_2_norm > $Max_norm[1]){$Max_norm[1] = $med_2_norm ;};
                if($row->Medicion_2 > $Max[1]){$Max[1] = $row->Medicion_2 ;};
            }
            if($row->Medicion_3){
                if($row->Nivel_Critico>0){
                $med_3_norm = 100*$row->Medicion_3/$row->Nivel_Critico;
                }else{$med_3_norm = $row->Medicion_3;}
                $Resultado[$nombre."3norm"][] = array($timestamp, $med_3_norm,$row->Medicion_3,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."3"][] = array($timestamp,$row->Medicion_3,$row->Medicion_3,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                if($med_3_norm > $Max_norm[2]){$Max_norm[2] = $med_3_norm ;};
                if($row->Medicion_3 > $Max[2]){$Max[2] = $row->Medicion_3 ;};
            }
            if($row->Medicion_4){
                if($row->Nivel_Critico>0){
                $med_4_norm = 100*$row->Medicion_4/$row->Nivel_Critico;
                }else{$med_4_norm = $row->Medicion_4;}
                $Resultado[$nombre."4norm"][] = array($timestamp, $med_4_norm,$row->Medicion_4,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."4"][] = array($timestamp, $row->Medicion_4,$row->Medicion_4,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                if($med_4_norm > $Max_norm[3]){$Max_norm[3] = $med_4_norm ;};
                if($row->Medicion_4 > $Max[3]){$Max[3] = $row->Medicion_4 ;};
            }
            if($row->Medicion_5){
                if($row->Nivel_Critico>0){
                $med_5_norm = 100*$row->Medicion_5/$row->Nivel_Critico;
                }else{$med_5_norm = $row->Medicion_5;}
                $Resultado[$nombre."5norm"][] = array($timestamp, $med_5_norm,$row->Medicion_5,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."5"][] = array($timestamp, $row->Medicion_5,$row->Medicion_5,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                if($med_5_norm > $Max_norm[4]){$Max_norm[4] = $med_5_norm ;};
                if($row->Medicion_5 > $Max[4]){$Max[4] = $row->Medicion_5 ;};
            }
            if($row->Medicion_6){
                if($row->Nivel_Critico>0){
                $med_6_norm = 100*$row->Medicion_6/$row->Nivel_Critico;
                }else{$med_6_norm = $row->Medicion_6;}
                $Resultado[$nombre."6norm"][] = array($timestamp, $med_4_norm,$row->Medicion_6,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."6"][] = array($timestamp, $row->Medicion_6,$row->Medicion_6,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                if($med_6_norm > $Max_norm[5]){$Max_norm[5] = $med_6_norm ;};
                if($row->Medicion_6 > $Max[5]){$Max[5] = $row->Medicion_6 ;};
            }
            if($row->Medicion_7){
                if($row->Nivel_Critico>0){
                $med_7_norm = 100*$row->Medicion_7/$row->Nivel_Critico;
                }else{$med_7_norm = $row->Medicion_7;}
                $Resultado[$nombre."7norm"][] = array($timestamp, $med_7_norm,$row->Medicion_7,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."7"][] = array($timestamp, $row->Medicion_7,$row->Medicion_7,$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                if($med_7_norm > $Max_norm[6]){$Max_norm[6] = $med_7_norm ;};
                if($row->Medicion_7 > $Max[6]){$Max[6] = $row->Medicion_7 ;};
            }


            //Maxima concentración
            $med[$n] = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);

            if($row->Nivel_Critico>0){
                $med_norm[$n] = 100*$med[$n]/$row->Nivel_Critico;
            }else{$med_norm[$n] = $med[$n];$critico = 0;}
            $Resultado[$nombre."8norm"][] = array($timestamp, $med_norm[$n],$med[$n],$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
            $Resultado[$nombre."8"][] = array($timestamp, $med[$n],$med[$n],$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
            if($row->Laboratorio == 1){
                $Resultado[$nombre."8norm_ext"][] = array($timestamp, $med_norm[$n],$med[$n],$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
                $Resultado[$nombre."8_ext"][] = array($timestamp, $med[$n],$med[$n],$row->Nivel_Critico,$row->IDmedicion,$row->Fecha_Reporte);
            }


            if($timestampmin == 0){$timestampmin = $timestamp;}
            if($timestamp > $timestampmax){$timestampmax = $timestamp;}
            if($timestamp < $timestampmin){$timestampmin = $timestamp;}

            $n++;
        }

        if($n > 0){
        $Resultado['Error'] = $error;
        if($Max_norm < 100){$Max_norm = 100;};
        $Resultado['Max_norm'] = $Max_norm;
        array_unshift($Resultado['Max_norm'], max($Max_norm));
        $Resultado['Max_norm'][] = max($Max_norm);
        $Resultado['Max'] = $Max;
        array_unshift($Resultado['Max'], max($Max));
        $Resultado['Max'][] = max($Max);
        $Resultado['F_Min'] = $timestampmin;
        $Resultado['F_Max'] = $timestampmax;
        $Resultado['Fecha_Inicio'] = $Fecha_Inicio;
        $Resultado['Fecha_Termino'] = $Fecha_Termino;
        $Resultado['min'] = $minaux;
        $Resultado['Critico'] = $critico;

        }else{
            $Resultado['Error'] = $error;
        }

        return response::json($Resultado);


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

    public function loadResumenReporte(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $error = 0;
        $Nombre_Region = $request->input('Nombre_Region');
        $Dias = $request->input('Dias');
        $Especies = $request->input('Especies');
        $Operando = $request->input('Operando');
        $Historia = $request->input('Historia');

        $max = 0;
        if($request->input('Medicion') == 0){ //Máxima concentración (independiente de la profundidad)
            $max = 1;
        }else{
            $Medicion = "Medicion_".$request->input('Medicion');
        }


        $whereestado = "";
        if($Operando == 1 && $Historia == 0){
            $whereestado = "gtr_c.Estado = 1";
        }else if($Operando == 1 && $Historia == 1){
            $whereestado = "gtr_c.Estado >= 0";
        }else if($Operando == 0 && $Historia == 0){
            $whereestado = "gtr_c.Estado < 0";
        }else if($Operando == 0 && $Historia == 1){
            $whereestado = "gtr_c.Estado = 0";
        }

        $Colaborativo = $request->input('Colaborativo');
        $user_id = $miuser->id;

        date_default_timezone_set('america/santiago');
        // $Fecha_Inicio = date('Y-m-d', strtotime(date('Y-m-d'). (-$Dias+1).' day'));
        // $Fecha_Inicio = date('Y-m-d 00:00:00', strtotime($Fecha_Inicio));

        $Fecha_Inicio = date('Y-m-d', strtotime($request->input('fecha_filtro_1')));
        $Fecha_Termino = date('Y-m-d', strtotime($Fecha_Inicio. ' +7 day'));

        //IDempresa usuario
        
        $IDempresa = $miuser->IDempresa;
        


        $All_Date = array();
        $All_Date[0] = date('d-m-Y', strtotime($Fecha_Termino. '-1 day'));;//date('d-m-Y');
        $All_Date_aux = array();
        $All_Date_aux[0] = date('d-m', strtotime($Fecha_Termino. '-1 day'));//date('d-m');
        for($i=2; $i<($Dias+1); $i++){
            $All_Date[$i-1] = date('d-m-Y', strtotime($Fecha_Termino. -$i.' day'));
            $All_Date_aux[$i-1] = date('d-m', strtotime($Fecha_Termino. -$i.' day'));
        }
        //return Response::json($All_Date);
        $whereespecies = "";
        if($Especies == '1'){
            $whereespecies = "gtr_e.Fiscaliza = '1' ";
        }else if($Especies == '2'){
            $whereespecies = $whereespecies." "." gtr_e.Nociva = 1 ";
        }

        $wherecolab = "gtr_c.IDempresa = $IDempresa";
        if($Colaborativo == 1){
            $wherecolab = "gtr_c.Colaborativo = 1";
        }

        $where = "";//" c.IDregion = (SELECT IDregion FROM region WHERE Nombre = '$Nombre_Region' ) ";
        //echo 'hola';die();

        $consulta = DB::connection('mysql')->table('medicion as m')
                                            ->join('medicion_fan as mf', 'm.IDmedicion', '=', 'mf.IDmedicion')
                                            ->join('centro as c', function($query){
                                                $query->join('barrio as b', 'c.IDbarrio', '=', 'b.IDbarrio');
                                            })
                                            ->join('empresa as em', 'c.IDempresa', '=', 'em.IDempresa')
                                            ->join('area as a', 'c.IDarea', '=', 'a.IDarea')
                                            ->join('especie as e', 'mf.IDespecie', '=', 'e.IDespecie')
                                            //->whereRaw($whereespecies)
                                            ->whereRaw($wherecolab)
                                            //->whereRaw($where)
                                            ->whereRaw($whereestado)
                                            ->where('m.Estado', '=', 1)
                                            ->select('a.Nombre as Area',
                                                    'em.Nombre as Empresa',
                                                    'c.Nombre as Centro',
                                                    'c.IDcentro',
                                                    'c.TopLeft',
                                                    'm.TopLeft as TopLeftM',
                                                    'm.Fecha_Reporte',   
                                                    DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
                                                    'm.IDmedicion',
                                                    'mf.Medicion_1',
                                                    'mf.Medicion_2',
                                                    'mf.Medicion_3',
                                                    'mf.Medicion_4',
                                                    'mf.Medicion_5',
                                                    'mf.Medicion_6',
                                                    'mf.Medicion_7',
                                                    'e.Nombre as Especie',
                                                    DB::raw("CASE WHEN gtr_e.Fiscaliza = '1' THEN 'Fiscalizada' ELSE '' END as Fiscaliza"),
                                                    DB::raw("CASE WHEN gtr_e.Nociva = '1' THEN 'Nociva' ELSE '' END as Nociva"),
                                                    'e.Nivel_Critico',
                                                    'e.Alarma_Rojo',
                                                    'e.Alarma_Amarillo',
                                                    'e.Grupo',
                                                    'b.Nombre as ACS'   
                                                    )
                                            ->get();
                                            
                                            
                //return response::json($consulta);
        //     (centro c INNER JOIN barrio b ON c.IDbarrio = b.IDbarrio),
        //     area a,
        //     empresa em,
        //     especie e
        //     WHERE c.IDempresa = em.IDempresa  AND c.IDarea = a.IDarea AND c.IDcentro = m.IDcentro AND e.IDespecie = mf.IDespecie "
                
        // mysqli_query($con,"SELECT a.Nombre as Area,
        // em.Nombre as Empresa,
        // c.Nombre as Centro,
        // c.IDcentro,
        // c.TopLeft,
        // m.TopLeft as TopLeftM,
        // m.Fecha_Reporte,
        // DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,
        // m.IDmedicion,
        // mf.Medicion_1,
        // mf.Medicion_2,
        // mf.Medicion_3,
        // mf.Medicion_4,
        // mf.Medicion_5,
        // mf.Medicion_6,
        // mf.Medicion_7,
        // e.Nombre as Especie,
        //     CASE
        //         WHEN e.Fiscaliza = '1'
        //         THEN 'Fiscalizada'
        //         ELSE ''
        // END as Fiscaliza,
        // CASE
        //         WHEN e.Nociva = '1'
        //         THEN 'Nociva'
        //         ELSE ''
        // END as Nociva,
        //     e.Nivel_Critico,
        //     e.Alarma_Rojo,
        //     e.Alarma_Amarillo,
        //     e.Grupo,
        //     b.Nombre as ACS
        //     FROM (medicion m INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.Fecha_Reporte > '$Fecha_Inicio' AND m.Fecha_Reporte < '$Fecha_Termino') ),
        //     (centro c INNER JOIN barrio b ON c.IDbarrio = b.IDbarrio),
        //     area a,
        //     empresa em,
        //     especie e
        //     WHERE c.IDempresa = em.IDempresa  AND c.IDarea = a.IDarea AND c.IDcentro = m.IDcentro AND e.IDespecie = mf.IDespecie "
        //.$whereespecies.$wherecolab.$where.$whereestado." AND m.Estado = 1 ORDER BY em.Nombre, a.Nombre, c.Nombre, e.Nombre ASC")
           
           //$consulta = explode(',', $consulta);         
           //return Response::json($consulta);
           //$consulta = explode(',', $consulta); 

        $ultimaesp = array();
        $Resultado = array();
        $centroespecie = array();
        $lista_idcentro = array();
        
        foreach($consulta as $row)
        {
            if(array_search($row->Centro.$row->Especie, $centroespecie) === false){
                $Resultado[] = $row;
                $centroespecie[] = $row->Centro.$row->Especie;
                $lista_idcentro[] = $row->IDcentro;
            }
            //para ausencia de registros agregar la ultima esp
            
            /*###################################################################### */
            /*------------Comentado solo param avanzar---------------------- */    
            
           
            $ultimaesp = array_slice($row, -8);
             
            if($max == 1 ){
                $med = max($row->Medicion_1,$row->Medicion_2,$row->Medicion_3,$row->Medicion_4,$row->Medicion_5,$row->Medicion_6,$row->Medicion_7);
            }else{
                $med = $row->$Medicion;
                }

            if( isset($Resultado[array_search($row->Centro.$row->Especie, $centroespecie)][array_search($row->Date_Reporte, $All_Date)]) ){
                if($Resultado[array_search($row->Centro.$row->Especie, $centroespecie)][array_search($row->Date_Reporte, $All_Date)] < $med){
                    $Resultado[array_search($row->Centro.$row->Especie, $centroespecie)][array_search($row->Date_Reporte, $All_Date)] = $med;
                    $Resultado[array_search($row->Centro.$row->Especie, $centroespecie)][array_search($row->Date_Reporte, $All_Date).'_TopLeftM'] = $row->TopLeftM;
                }
            }else{
                $Resultado[array_search($row->Centro.$row->Especie, $centroespecie)][array_search($row->Date_Reporte, $All_Date)] = $med;
                $Resultado[array_search($row->Centro.$row->Especie, $centroespecie)][array_search($row->Date_Reporte, $All_Date).'_TopLeftM'] = $row->TopLeftM;
            }



        }


        //Registros vacios (Ausencia de algas)
        $consulta = DB::connection('mysql')->table('medicion as m')
                                            ->join('centro as c', 'c.IDcentro', '=', 'm.IDcentro')
                                            ->where([['m.Fecha_Reporte', '>', $Fecha_Inicio],
                                                        ['m.Fecha_Reporte', '<', $Fecha_Termino],
                                                        ['c.IDempresa', '=', $IDempresa],
                                                        ['m.Estado', '=', 1]
                                                        ])
                                            //->where($where)
                                            ->select('c.Nombre as Centro',
                                                            'c.IDcentro',
                                                            'm.Fecha_Reporte',
                                                            DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"),
                                                            'm.TopLeft as TopLeftM')
                                            ->orderBy('c.Nombre', 'ASC')
                                            ->get();
                            //return response::json($consulta);
        // mysqli_query($con,"SELECT c.Nombre as Centro,
        //                 c.IDcentro,
        //                 m.Fecha_Reporte,
        //                 DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte,
        //                 m.TopLeft as TopLeftM
        //                 FROM medicion m, centro c
        //                 WHERE c.IDcentro = m.IDcentro
        //                 AND m.Fecha_Reporte > '$Fecha_Inicio'
        //                 AND m.Fecha_Reporte < '$Fecha_Termino'
        //                 AND c.IDempresa = '$IDempresa' ".$where."
        //                 AND m.Estado = 1
        //                 ORDER BY c.Nombre ASC");
        //or die ($error ="Error description 2: " . mysqli_error($con));

        $entro = 0;
        $centros_ausencia = array();
        foreach($consulta as $row)
        {
            $entro = 0;
            foreach($lista_idcentro as $i => $lista_idcentrovalue){
                if($lista_idcentrovalue == $row->IDcentro){
                    if(!isset($Resultado[$i][array_search($row->Date_Reporte, $All_Date)]) ){
                        $Resultado[$i][array_search($row->Date_Reporte, $All_Date)] = 0;
                        $Resultado[$i][array_search($row->Date_Reporte, $All_Date).'_TopLeftM'] = $row->TopLeftM;
                    }
                $entro = 1;

                }

            }
            if($entro == 0){
                if(array_search($row->IDcentro, $centros_ausencia) === false){
                    $centros_ausencia[] = $row->IDcentro;
                }
            }
        }

        $centros_ausencia1 = implode("', '", $centros_ausencia);

        //Buscar info centros que en la ultima semana tengan puros registros con ausencia
        $consulta = DB::connection('mysql')->table('medicion as m')
                                            ->join('centro as c', 'm.IDcentro', '=', 'c.IDcentro')
                                            ->join('barrio as b', 'c.IDbarrio', '=', 'b.IDbarrio')
                                            ->join('area as a', 'c.IDarea', '=', 'a.IDarea')
                                            ->join('empresa as em', 'c.IDempresa', '=', 'em.IDempresa')
                                            ->whereIn('c.IDcentro', $centros_ausencia1)
                                            ->whereRaw($wherecolab)
                                            //->whereRaw($where)
                                            ->whereRaw($whereestado)
                                            ->where('m.Estado', '=', 1)
                                            ->select('a.Nombre as Area',
                                                        'em.Nombre as Empresa',
                                                        'c.Nombre as Centro',
                                                        'c.IDcentro',
                                                        'c.TopLeft',
                                                        'm.TopLeft as TopLeftM',
                                                        'm.Fecha_Reporte', 
                                                        DB::raw("DATE_FORMAT(CAST(gtr_m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte"), 
                                                        'm.IDmedicion')
                                            ->orderBy('em.Nombre', 'ASC')
                                            ->orderBy('a.Nombre', 'ASC')
                                            ->orderBy('c.Nombre', 'ASC')
                                            ->get();
                 //return Response::json($consulta);
        // mysqli_query($con,"SELECT a.Nombre as Area
        // ,em.Nombre as Empresa
        // , c.Nombre as Centro
        // ,c.IDcentro
        // ,c.TopLeft
        // ,m.TopLeft as TopLeftM
        // , m.Fecha_Reporte, 
        // DATE_FORMAT(CAST(m.Fecha_Reporte AS DATE), '%d-%m-%Y') as Date_Reporte, 
        // m.IDmedicion
        // FROM medicion m INNER JOIN centro c 
        // ON (m.IDcentro = c.IDcentro AND m.Fecha_Reporte > '$Fecha_Inicio' AND m.Fecha_Reporte < '$Fecha_Termino'),
        // barrio b, area a, empresa em 
        // WHERE c.IDbarrio = b.IDbarrio AND c.IDempresa = em.IDempresa AND c.IDcentro IN ('$centros_ausencia1')
        // AND c.IDarea = a.IDarea ".$wherecolab.$where.$whereestado." AND m.Estado = 1 
        // ORDER BY em.Nombre, a.Nombre, c.Nombre ASC")
        // or die ($error ="Error description 3: " . mysqli_error($con));

        $Resultado2 = array();
        $centroespecie2 = array();
        foreach($consulta as $row)
        {
            if(array_search($row->Centro.$ultimaesp['Especie'], $centroespecie) === false){
                $Resultado[] = $row+$ultimaesp;
                $centroespecie[] = $row->Centro.$ultimaesp['Especie'];
            }

            $Resultado[array_search($row->Centro.$ultimaesp['Especie'], $centroespecie)][array_search($row->Date_Reporte, $All_Date)] = 0;
            $Resultado[array_search($row->Centro.$ultimaesp['Especie'], $centroespecie)][array_search($row->Date_Reporte, $All_Date).'_TopLeftM'] = $row->TopLeftM;

        }


        //Completa la columna de la tabla con Crituico y Precaución
        foreach ($Resultado as $key => $value) {
            $max= MAX($value[0],$value[1],$value[2],$value[3],$value[4],$value[5],$value[6]);
            if ( (intval($max) >= intval($value['Alarma_Rojo']) && $value['Alarma_Rojo']>0) || (intval($max) >= intval($value['Alarma_Amarillo']) && $value['Alarma_Amarillo']>0) ) {
                $Resultado[$key]['Alarmas'] = 'Crítico y Precaución';
            }
            // if ($max >= $value['Alarma_Rojo'] || $max >= $value['Alarma_Amarillo']) {
            // 	$Resultado[$key]['Alarmas_max2'] =$max;
            // }
        }


        $Resultado[] = $All_Date_aux;

        $Res = array();
        $Res = array(
            'Resultado' => $Resultado,
            'centroespecie' => $centroespecie,
            'ce' => $centroespecie
        );

        return Response::json($Res);
    }


    /*===================================================================================================================*/

    public function loadPambientalesReporte(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;

		$IDmedicion = $request->input('IDmedicion');

		$PAmb = Pambientales    ::where('pambientales.Grupo','Columna de Agua')
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

    public function sendReporte(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

            $mail = new PHPMailer(true);
            $Page = $request->input('Page');

        try {
            //Server settings
            $mail->SMTPDebug = false;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'gtr@veterfish.com';                 // SMTP username
            $mail->Password = 'xVB@bDNXJjt0qlwn8wkC6IsFo';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 465;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('Soporte.GTR@veterfish.com', 'GTR GESTIÓN');
            $mail->addAddress('sebastian.lhh@gmail.com', 'Sebastián LHuissier');     // Add a recipient
        // 	$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('Soporte.GTR@veterfish.com', 'Soporte GTR Gestión');
        //    $mail->addCC('cc@example.com');
        //    $mail->addBCC('bcc@example.com');

            //Attachments
            $mail->addAttachment('GtrGestion-Transporte&Retiro.png');         // Add attachments
        //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reporte Diario | ';
            $mail->Body    = $Page;
            $mail->AltBody = '';

            $mail->CharSet = 'UTF-8';

            $mail->send();
        // echo 'Message has been sent';
        } catch (Exception $e) {
        //  echo 'Message could not be sent.';
        // echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

    }
    /*===================================================================================================================*/

    /*================================= rutas mapa colab ============================================*/
    
    public function loadHistorialCentrosPdfColab(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $error = 0;
        $user_id = $_POST['user_id'];
        $IDcentro = $_POST['IDcentro'];
        $IDmedicion = $_POST['IDmed'];
        $Especies = $_POST['Especies'];
        date_default_timezone_set('america/santiago');
        //	$Fecha = date('Y-m-d H:i:s', strtotime($_POST['Fecha']));
        $Fecha_Termino = date('Y-m-d', strtotime($_POST['Fecha']. ' +1 day'));
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
            FROM especie WHERE IDempresa = '$IDempresa' ".$whereespecies)or die ($error ="Error description: " . mysqli_error($consulta));
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
            $consulta = mysqli_query($con,"SELECT m.IDmedicion,DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y %H:%i') as fecha_reporte_format, DATE_FORMAT(m.Fecha_Reporte, '%d-%m-%Y') as Date_Reporte, e.Nombre,mf.Medicion_1,mf.Medicion_2,mf.Medicion_3,mf.Medicion_4, mf.Medicion_5, mf.Medicion_6, mf.Medicion_7,e.IDespecie_general,m.IDmedicion FROM (medicion m INNER JOIN medicion_fan mf ON (m.IDmedicion = mf.IDmedicion AND m.IDcentro = '$IDcentro' AND m.Estado = 1 ".$wherelab.") ), especie e WHERE  e.IDespecie = mf.IDespecie AND e.IDespecie_general IN (".implode(',',$IDespecie_filto).") AND m.Fecha_Reporte > '$Fecha_Inicio' AND m.Fecha_Reporte <= '$Fecha_Termino' AND (mf.Medicion_1 > 0 OR mf.Medicion_2 > 0 OR mf.Medicion_3 > 0 OR mf.Medicion_4 > 0 OR mf.Medicion_5 > 0 OR mf.Medicion_6 > 0 OR mf.Medicion_7 > 0) ORDER BY e.Nombre ASC, m.Fecha_Reporte DESC")or die ($error ="Error description: " . mysqli_error($consulta));
            
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
        $consulta = mysqli_query($con,"SELECT c.IDcentro,c.Nombre,c.TopLeft,c.Codigo,c.Especie,c.Estado, b.Nombre as Barrio,c.IDempresa FROM centro c INNER JOIN barrio b ON (c.IDbarrio = b.IDbarrio) WHERE ".$whereestado.$wherecolab." ORDER BY (CASE WHEN c.IDempresa = '$IDempresa' THEN 0 ELSE 1 END), c.IDcentro")
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
        $consulta = mysqli_query($con,"SELECT c.TopLeft,r.Nombre FROM centro c INNER JOIN usuario_permiso up ON (c.IDcentro = up.IDcentro AND up.user_id = '$user_id') INNER JOIN region r ON (r.IDregion = c.IDregion) WHERE ".$whereestado." AND up.Estado = 1 LIMIT 1")
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
        $consulta = mysqli_query($con,"SELECT b.TopLeft_1,r.Nombre FROM centro c INNER JOIN usuario_permiso up ON (c.IDcentro = up.IDcentro AND up.user_id = '$user_id') INNER JOIN region r ON (r.IDregion = c.IDregion) INNER JOIN barrio b WHERE up.Estado = 1 LIMIT 1")
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
