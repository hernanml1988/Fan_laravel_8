<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miuser = Auth::user();
        $this->cambiar_bd($miuser->IDempresa);
        $menu = 'configuracion';
        $currentUser= $miuser;
        return view('configuracion/configuracion_editor', ['miuser' => $miuser, 'menu'=> $menu, 'currentUser'=> $currentUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
