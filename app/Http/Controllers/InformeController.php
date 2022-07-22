<?php

namespace App\Http\Controllers;

use App\Models\Opciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class InformeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
