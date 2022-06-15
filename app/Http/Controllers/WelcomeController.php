<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centro;
use App\Models\Permisos;
use Illuminate\Support\Facades\Auth;


class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()    {

        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        
        if($miuser->user_role == 1){
            $centro = Centro::all();
            $permisos = Permisos::all(); 
            $menu = 'ingreso';
            return view('registro_editor', ['centro' => $centro, 'permisos'=>$permisos, 'miuser'=>$miuser, 'menu'=>$menu]);
        }else if ($miuser->user_role == 3){
            $menu = 'historial';
            return view('historial/reporte_editor', ['miuser' => $miuser, 'menu' => $menu]);
        }else if ($miuser->user_role == 2){
            $centro = Centro::all();
            $permisos = Permisos::all(); 
            $menu = 'ingreso';
            return view('registro_editor', ['miuser' => $miuser, 'menu' => $menu, 'centro' => $centro, 'permisos' => $permisos]);
        }else if ($miuser->user_role == 4) {            
            $menu = 'ingreso';   
            return view('historial/reporte_editor',['miuser' => $miuser, 'menu' =>$menu]);
        }
        
        

       
    }
    public function indexRegistro()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $centro = Centro::all();
            $permisos = Permisos::all(); 
            $menu = 'ingreso';        

            $currentUser = $miuser;
            $nombre = $currentUser->first_name." ".$currentUser->last_name;
            return view('registro_editor', ['centro' => $centro, 'permisos' => $permisos, 'miuser' => $miuser, 'menu' =>$menu, 'currentUser' => $currentUser,
            'nombre' => $nombre]);
        
    }
    public function indexConfiguracion()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $menu = 'configuracion';
        $currentUser= $miuser;
        return view('configuracion/configuracion_editor', ['miuser' => $miuser, 'menu'=> $menu, 'currentUser'=> $currentUser]);
    }
    public function indexDeclaracion()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $menu ='declaracion';
        $currentUser = $miuser;
        return view('declaracion/declaracion', ['menu'=>$menu, 'miuser' => $miuser, 'currentUser'=> $currentUser]);
    }
    public function indexHistorial()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
    
        $menu = 'historial';
        return view('historial/reporte_editor', ['miuser' => $miuser, 'menu' => $menu]);
    }
    public function descargas_editor()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        
        $menu="descargas";
        return view('historial/descargas_editor', ['miuser' => $miuser, 'menu'=> $menu]);
    }
    public function indexInforme()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $menu ='informe';
        $currentUser = $miuser;
        $nombre = $miuser->first_name." ".$miuser->last_name;
        return view('informe/informe',  ['menu' => $menu, 'nombre' => $nombre, 'currentUser' => $currentUser, 'miuser'=> $miuser]);
    }
    public function indexMapa()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $menu = 'mapa';
        return view('mapas/mapa_editor', ['miuser' => $miuser, 'menu' =>$menu]);
    }

    public function mapa_colab_editor()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $menu = 'colaborativo';
        return view('mapas/mapa_colab_editor', ['miuser' => $miuser, 'menu' =>$menu]);
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
