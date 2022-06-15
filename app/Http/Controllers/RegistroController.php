<?php

namespace App\Http\Controllers;

use App\Models\Centro;
use App\Models\Especie;
use App\Models\Medicion;
use App\Models\Opciones;
use App\Models\Pambientales;
use App\Models\Permisos;
use App\Models\User;
use App\Models\Usuario_fan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Stmt\Echo_;
use PHPUnit\Framework\Constraint\Count;

class RegistroController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
