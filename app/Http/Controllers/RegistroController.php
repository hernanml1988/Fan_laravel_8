<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Especie;
use App\Models\Medicion;
use App\Models\Pambientales;
use App\Models\Permisos;
use App\Models\User;
use App\Models\Usuario_fan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PhpParser\Node\Stmt\Echo_;

class RegistroController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function load_registro(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        $user_id = $request->input('user_id');
		$search = $request->input('search');
		$order = $request->input('order');  //siempre es asc
		$limit = $request->input('limit');
		$offset = $request->input('offset');
        $IDcentro = $request->input('IDcentro');


      
        $medicion = new Medicion();

        // $Fecha_reporte = $medicion::where('IDcentro', $IDcentro)
        //                             ->pluck('Fecha_Reporte');
                                    
        
        // var_dump($Fecha_reporte);


        $registros_count = $medicion::where('IDcentro', $IDcentro)
                                            ->Where(
                                                function($query) use ($search, $medicion){
                                                    $query->Where('Estado_Alarma' , 'like', '%' . $search . '%')
                                                            ->orWhere('Comentario' , 'like', '%' . $search . '%')
                                                            ->orWhere('Observaciones' , 'like', '%' . $search . '%')
                                                            ->orWhere('Firma' , 'like', '%' . $search . '%')
                                                            ->orWhere('Mortalidad' , 'like', '%' . $search . '%');
                                                            
                                                }
                                            )                                          
									->count();
        
        $registros = $medicion::where('IDcentro', $IDcentro)
                                    ->Where(
                                        function($query) use ($search){
                                            $query->Where('Estado_Alarma' , 'like', '%' . $search . '%')
                                                    ->orWhere('Comentario' , 'like', '%' . $search . '%')
                                                    ->orWhere('Observaciones' , 'like', '%' . $search . '%')
                                                    ->orWhere('Firma' , 'like', '%' . $search . '%')
                                                    ->orWhere('Mortalidad' , 'like', '%' . $search . '%');
                                                }
                                            )
                                    ->select('IDmedicion AS id',
                                            'Fecha_Envio',
                                            DB::raw('DATE_FORMAT(Fecha_Reporte, "%Y-%m-%d %H:%i " ) as Fecha_Reporte'),
                                            DB::raw('DATE_FORMAT(Fecha_Reporte, "%d-%m-%Y" ) as Date_Reporte'),
                                            DB::raw('DATE_FORMAT(Fecha_Reporte, "%H:%i" ) as Time_Reporte'),
                                            'Fecha_Analisis',
                                            'Mortalidad',
                                            'Comentario',
                                            'Estado_Alarma',
                                            
                                            DB::raw("CASE WHEN Estado = 0 then 'No' ELSE 'Si' END as Estado"),
                                            'Laboratorio',
                                            'Firma'
                                    )                                         
									->get();
        
                                    $response = array(
                                        'total' => $registros_count,
                                        'rows' => $registros,
                                        'idcentro' => $IDcentro
                                    );
                                    
       
        return Response::json($response);//response([$registros_count, $registros], 200, []);
        

    }

    /*===================================================================================================================*/

    public function load_diatomeas(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        
        $especie = new Especie();
	    $error = 0;
        $user_id = $request->input('user_id');
        $diatomeas_count = $especie->where('Grupo', 'Diatomeas')
                                ->select(
                                    'IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    'Fiscaliza',
                                    'Estado'
                                )
                                ->where('Estado', 1)
                                ->count();



        $usuario_fan = new Usuario_fan();
        $empresa = $usuario_fan->select('IDempresa')
                                    ->where('user_id', $user_id)                                    
                                    ->get();
       

        //echo $empresa;

        $diatomeas = $especie->where('Grupo', 'Diatomeas')                                
                                ->select(
                                    'IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    DB::raw("CASE WHEN Fiscaliza = 0 then 'No' ELSE 'Si' END as Fiscaliza"),
                                    'Nivel_Critico',
                                    'Estado'
                                )
                                ->where('Estado', 1)
                                //->where('IDempresa', $empresa)
                                
                                ->get();

                                $response = array(
                                    'total' => $diatomeas_count,
                                    'rows' => $diatomeas
                                );
        return Response::json($response);

        //aun falta realizar la seleccion de la empresa segun el usuario.  
        //esta parte AND IDempresa = (SELECT IDempresa FROM as_users WHERE user_id = '$user_id') ORDER BY Nombre ASC")


        //return response([$diatomeas_count, $diatomeas, $empresa], 200, []);
       
        
    //     $consulta = mysqli_query($con,"SELECT IDespecie,Nombre,Nociva,Fiscaliza as Fiscaliza_edit,
    //                                                                                 Nivel_Fiscaliza,
    //                                                                                 Nivel_Fiscaliza_Pre,
    //                                                                                 Nivel_Fiscaliza_Alerta,
    //                                                                                 Nivel_Critico,Imagen,
    //                                                                                 Alarma_Rojo,
    //                                                                                 Alarma_Amarillo,
    //                                                                                 Detalle,
	// 	CASE
    //         WHEN Fiscaliza = '1'
    //            THEN 'Si'
    //            ELSE '-'
    //    END as Fiscaliza, IDempresa FROM $table WHERE Grupo = 'Diatomeas' AND Estado = 1 
    //    AND IDempresa = (SELECT IDempresa FROM as_users WHERE user_id = '$user_id') ORDER BY Nombre ASC")
	//    or die ($error ="Error description: " . mysqli_error($consulta));

    }
    /*===================================================================================================================*/

    public function load_dinoflagelados(Request $request)
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        
        $especie = new Especie();
	    $error = 0;
        $user_id = $request->input('user_id');
        $dinoflagelados_count = $especie->where('Grupo', 'Dinoflagelados')
                                ->select(
                                    'IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    'Fiscaliza',
                                    'Estado'
                                )
                                ->where('Estado', 1)
                                ->count();

        $dinoflagelados = $especie->where('Grupo', 'Dinoflagelados')                                
                                ->select(
                                    'IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    DB::raw("CASE WHEN Fiscaliza = 0 then 'No' ELSE 'Si' END as Fiscaliza"),
                                    'Nivel_Critico',
                                    'Estado'
                                )
                                ->where('Estado', 1)
                                //->where('IDempresa', $empresa)
                                
                                ->get();

                                $response = array(
                                    'total' => $dinoflagelados_count,
                                    'rows' => $dinoflagelados
                                );
        return Response::json($response);
    }

     /*===================================================================================================================*/

     public function load_oespecies(Request $request)
     {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        
        $especie = new Especie();
	    $error = 0;
        $user_id = $request->input('user_id');
        $Otras_Especies_count = $especie->where('Grupo', 'Otras Especies')
                                ->select(
                                    'IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    'Fiscaliza',
                                    'Estado'
                                )
                                ->where('Estado', 1)
                                ->count();

        $Otras_Especies = $especie->where('Grupo', 'Otras Especies')                                
                                ->select(
                                    'IDespecie',
                                    'Nombre',
                                    'Nociva',
                                    DB::raw("CASE WHEN Fiscaliza = 0 then 'No' ELSE 'Si' END as Fiscaliza"),
                                    'Nivel_Critico',
                                    'Estado'
                                )
                                ->where('Estado', 1)
                                //->where('IDempresa', $empresa)
                                
                                ->get();

                                $response = array(
                                    'total' => $Otras_Especies_count,
                                    'rows' => $Otras_Especies
                                );
        return Response::json($response);
     }


/*===================================================================================================================*/

     public function load_pambientales(Request $request)
     {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);

        
        $especie = new Pambientales();
	    $error = 0;
        $user_id = $request->input('user_id');
        $Otras_Especies_count = $especie->where('Grupo', 'Columna de Agua')
                                ->select(
                                    'IDpambientales',
                                    'Nombre',
                                    'Grupo',
                                    'Alarma_Rojo',
                                    'Alarma_Amarillo'
                                )
                                
                                ->count();

        $Otras_Especies = $especie->where('Grupo', 'Columna de Agua')                                
                                ->select(
                                    'IDpambientales',
                                    'Nombre',
                                    'Grupo',
                                    'Alarma_Rojo',
                                    'Alarma_Amarillo'
                                    
                                )
                                
                                //->where('IDempresa', $empresa)
                                
                                ->get();

                                $response = array(
                                    'total' => $Otras_Especies_count,
                                    'rows' => $Otras_Especies
                                );
        return Response::json($response);
     }

     /*===================================================================================================================*/

    public function load_pambientalesotros()
    {

    }

    public function ingresarRegistro(Request $request)
    {
        $miuser = Auth::user();  
		
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
		
        
        
        var_dump($ingreso_registro);
        
        
        
        
        // $ingreso_registro->save();
		
		// $IDmedicion = $ingreso_registro->id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


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
