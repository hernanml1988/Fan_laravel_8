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
            return view('administrador', ['centro' => $centro, 'permisos' => $permisos, 'miuser' => $miuser, 'menu' =>$menu]);
        }else if ($miuser->user_role == 3){
            $menu = 'historial';
            return view('historial', ['miuser' => $miuser, 'menu' => $menu]);
        }else if ($miuser->user_role == 2){
            $centro = Centro::all();
            $permisos = Permisos::all(); 
            $menu = 'ingreso';
            return view('centro', ['miuser' => $miuser, 'menu' => $menu, 'centro' => $centro, 'permisos' => $permisos]);
        }else if ($miuser->user_role == 4) {            
            $menu = 'ingreso';   
            return view('centro_restringido',['miuser' => $miuser, 'menu' =>$menu]);
        }
        
        

        //return view('registro', ['centro' => $centro, 'miuser' => $miuser, 'menu' => $menu]);

        //return view('home', compact("centro"));
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
