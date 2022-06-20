<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use App\Models\Centro;
use App\Models\Configuracion;
use App\Models\Declaracion;
use App\Models\Documento;
use App\Models\Especie;
use App\Models\Medicion;
use App\Models\MedicionFan;
use App\Models\MedicionPAmbientales;
use App\Models\Notificacion;
use App\Models\Opciones;
use App\Models\Pambientales;
use App\Models\Permisos;
use App\Models\User;


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

class RegistroController extends Controller
{
   
  
    public function loadRegistro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $user_id = $request->input('user_id');
		$search = $request->input('search');
		$order = $request->input('order');  //siempre es asc
		$limit = $request->input('limit');
		$offset = $request->input('offset');
        $IDcentro = $request->input('IDcentro');
              
       $registros = Medicion::where('IDcentro', $IDcentro)
									->where(
										function ($query) use ($search,$IDcentro)  {
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
                                                'Declarado','Laboratorio',
												DB::raw("CASE WHEN Estado = 0 then 'No' ELSE 'Si' END as Estado")
											) 
									//->selectRaw("SUM(gtr_ingreso_medicion.consumo) as consumo_total")
									//->selectRaw("SUM(gtr_ingreso_medicion.dias_funcionamiento) as dias_funcionamiento_total")
									//->groupBy('ingreso_registro.id')
									->orderBy('Fecha_Order', 'desc')
									->orderBy('IDmedicion', 'desc')
									//->orderBy('ingreso_ficha.valor', 'asc')
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

        
        $especie = new Especie();
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
                                    ->leftjoin('opciones','opciones.IDpambientales','pambientales.IDpambientales')
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
			
			$Resultado = array('Error' =>$error, 'Alarma' => $alarma,'Nombre_Centro' => $Centro,'IDcentro' => $IDcentro, 'IDmedicion' => $IDmedicion, 'Comentario' => $aux, 'Concentracion' => $Concentracion, 'Nocivo' => $Nocivo, 'Nocivo_P' => $Nocivo_P, 'Comentario_Precaucion' => $aux_prec, 'Concentracion_Precaucion' => $Concentracion_precaucion, 'Mortalidad' => $Mortalidad, 'Declarar' => $Fecha_semana );
			
			return Response::json($Resultado);
	
		}else{
			
			//Error al insertar
			$Resultado = array('Error' =>$error);
			return Response::json($Resultado);
			
		}

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
                        'IDmedicion')
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
public function loadPAmbientalesReporte(Request $request)//falta ruta
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        
		$error = 0;
		
		$IDmedicion = $request->input('IDmedicion');
		
		$PAmb = PAmbientales::where('pambientales.Grupo','Columna de Agua')
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

public function saveArchivoRegistro(Request $request)
{
    $miuser = Auth::user();  
    $this->cambiar_bd($miuser->IDempresa);
    
    $error = 0;
    if($miuser->user_role_fan == 1 || $miuser->user_role_fan == 2){
        
    }else {
        return 'Acceso Restringido';
    }
    
    
    $files = $request->file('archivo'); //get the files
    $IDmedicion = $request->input('IDmedicion');
    
    
    if ($files !=null && $IDmedicion!=null ){
        
        $contents = Storage::disk('local');		
        
        foreach ($files as $file) {	
                
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
            
         }
         $response = array(
        'status' => 'success',
        'msg' => 'Setting created successfully',
        'files' => $files
        );
     }else{
         $error = 1;
     }

    return Response::json($error);
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
                                'centro.Codigo'
                            )
                        ->first();

        // $archivos = Documento::where('IDempresa', $miuser->IDempresa)
        //                 ->where('IDmedicion', $IDmedicion)
        //                 ->get();

        $Fecha_Envio  = $tabla->Fecha_Envio;
        $Fecha_Analisis  = $tabla->Fecha_Analisis;
        $Fecha_Reporte  = $tabla->Fecha_Reporte;
        $Tecnica  = $tabla->Tecnica;
        $Observaciones  = $tabla->Observaciones;
        //$Archivo  = $archivos;
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

        $barrio_aux = Barrio::find($IDbarrio);
		$Barrio = $barrio_aux->Nombre;
		
		$Resultado = array();
		$Resultado['Diatomeas'] = $Diato;
		$Resultado['Dinoflagelados'] = $Dino;
		$Resultado['OEsp'] = $OEsp;
		$Resultado['Fecha_Envio'] = $Fecha_Envio;
		$Resultado['Fecha_Analisis'] = $Fecha_Analisis;
		$Resultado['Fecha_Reporte'] = $Fecha_Reporte;
		$Resultado['Tecnica'] = $Tecnica;
		$Resultado['Observaciones'] = $Observaciones;
		//$Resultado['Archivo'] = $Archivo;
		$Resultado['Firma'] = $Firma;
		$Resultado['Mortalidad'] = $Mortalidad;
		$Resultado['Nombre'] = $Nombre;
		$Resultado['Codigo'] = $Codigo;
		$Resultado['IDcentro'] = $IDcentro;
		$Resultado['Barrio'] = $Barrio;
		$Resultado['Especie'] = $Especie;
		$Resultado['Siembra'] = $Siembra;
		$Resultado['Cosecha'] = $Cosecha;
		$Resultado['Estado_Alarma'] = $Estado_Alarma;
		
		return Response::json($Resultado);
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
		
		$user_id = $request->input('user_id');
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
										->select('user_id')
										->get();
			$user_aux = array();			
			foreach($notificacion as $val){
				if(!in_array($val->user_id, $user_aux)){
					array_push($user_aux, $val->user_id);
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
    $Concentracion = $request->input('Concentracion');
    $Concentracion_Precaucion = $request->input('Concentracion_Precaucion');
    $Nocivo = $request->input('Nocivo');
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
