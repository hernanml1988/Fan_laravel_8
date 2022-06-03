@extends('layouts.app')

@include('layouts.master')

@section('content')



<div class="container primera_capa_home ">

<div class="container tituloConfig">
    <h3>CONFIGURACIÓN DE PARAMETROS</h3>
</div>
<hr>
<div class="conatiner row py-3 px-3">

    <div class="container col-3 card">
        <div class="card-body card-config">
            
            <h1 class="card-tittle"><i class="fa-solid fa-bell"></i> Alarmas</h1>
        <hr>        
        </div><div>
        <label for="">Editar Configuración <i class="fa-solid fa-circle-arrow-right"></i></label>
        
    </div>
    </div>
    <div class="container col-3 card">
        <div class="card-body card-config">
            
            <h1 class="card-tittle"><i class="fa-solid fa-tree"></i>Especies</h1>
        <hr>
        <label for="">Editar Configuración</label>
        <i class="fa-solid fa-circle-arrow-right"></i>
        </div>
    </div>
    <div class="container col-3 card">
        <div class="card-body card-config">
            
            <h1 class="card-tittle"><i class="fa-solid fa-location-dot"></i> Centro</h1>
        <hr>
        <label for="">Editar Configuración</label>
        <i class="fa-solid fa-circle-arrow-right"></i>
        </div>
    </div>
    <div class="container col-3 card">
        <div class="card-body card-config">
            
            <h1 class="card-tittle"><i class="fa-solid fa-envelope"></i> Notificación</h1>
        <hr>
        <label for="">Editar Configuración</label>
        <i class="fa-solid fa-circle-arrow-right"></i>
        </div>
    </div>
    <div class="container col-3 card">
        <div class="card-body card-config">
            
            <h1 class="card-tittle"><i class="fa-solid fa-user"></i> Usuario</h1>
        <hr>
        <label for="">Editar Configuración</label>
        <i class="fa-solid fa-circle-arrow-right"></i>
        </div>
    </div>


</div>

</div>

@endsection