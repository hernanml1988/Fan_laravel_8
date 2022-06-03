<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024" > <!-- content="width=device-width, initial-scale=1"-->
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="description" content="Partner Tecnológico">
    <meta name="author" content="GTR Gestión">
    <title>GTR Fan</title>  <!--agregarlo o dejar el titulo del header (como lo hace el motor de busqueda)-->
    
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
        <link href="{{ asset('css/sb-admin-2_v16.css') }}" rel="stylesheet">
        <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap-table.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
    	<link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
   		<link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
        <!--<link href="{{ asset('css/all.min.css') }}" rel="stylesheet"> 
         <link href="{{ asset('css/sistema.css') }}" rel="stylesheet"> 
         <link href="{{ asset('css/bootstrap-select.css')}}" rel="stylesheet"> -->
    
		<link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}" /> 
    	<link href="{{ asset('css/bootstrap-editable.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/lc_switch.css') }}">
    
    
    
    
    
    
	<style>
 		body { padding-right: 0 !important }
		.fixed-table-body {
			height: unset !important;
		}
 	</style>

    @yield('css')

    <link rel="icon" type="image/x-icon" href="{{ asset('GTR_Fan_symbol.png')}}" />
 <style>

 </style>     

    <script language="javascript" src="{{ asset('js/jquery.js') }}"> </script>


    
    
</head>

<body>


  
    <div>

      @section('nav')
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <li class="dropdown" style="color: #f8f8f8;">
                    <a title="Volver al Menu" class="navbar-brand" data-toggle="" href="https://gtrgestion.cl">
                        <p  style="display:inline;"> 
                            <img src="{{ asset('img/GtrFan-MonitoreoAlgasNocivas2.png') }}" class="logo_gtr" style="margin-top: -14px !important;"/> 
                        </p> 
                        <i class="fa fa-bars" style="bottom: 5px; position: relative;"></i>
                    </a>
                </li>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fas fa-user fa-fw" style="display:inline;"  ><output id="nombreusuario" class="hidden-xs" style="display:inline; color:#337ab7; margin-left:5px; " > {{$miuser->name}}</output> </i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url('administrador/perfil') }}"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        @if ($miuser->user_role == 1)
                        <li><a href="{{ url('administrador/usuarios') }}"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                        </li>
                        @endif
                        <li class="divider"></li>
                        <li><a href="{{ url('auth/logout') }}"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                        </li>
                        
                    </ul>
                    <!-- /.dropdown-user -->
                    
                </li>
                <img src="{{ asset('img/GTRgestion.png') }}" class="logo_gtr" style="margin-right:25px;margin-left:5px"/>
            </ul>
            <div id="sidebar-wrapper">
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse"  >
                        <ul class="nav" id="side-menu">
                             @if ($miuser->user_role == 1 || $miuser->user_role == 2) 
                            <li @if ($menu == "ingreso") class="activo" @endif>
                                <a href="{{ Route('registro.index') }}"><i class="fa fa-plus-square fa-fw"></i> Registro</a>
                            </li>
                            @endif
                            
                            <li class="">
                            	<a href="" style="background-color:inherit !important"><i class="fa fa-history fa-fw"></i> Historial<span class="fa arrow"></span></a>
                            	<ul class="nav nav-second-level">
                                    <li @if ($menu == "historial") class="activo" @endif>
                                        <a href="{{ route('historial.index') }}"><i class="fa fa-list-alt fa-fw"></i> Registros</a>
                                    </li>
                                    @if ($miuser->user_role == 1)
                                    <li @if ($menu == "descargas") class="activo" @endif>
                                        <a href="{{ route('historial.descarga') }}"><i class="fa fa-download fa-fw"></i>  Descargas</a>
                                    </li>
                                    @endif
                                </ul>
                            </li>
                            
                            <li class="">
                            	<a href="" style="background-color:inherit !important"><i class="fa-regular fa-location-dot"></i> Mapas<span class="fa arrow"></span></a>
                            	<ul class="nav nav-second-level">
                                    <li @if ($menu == "mapa") class="activo" @endif>
                                        <a href="{{ Route('mapa.index') }}"><i class="fas fa-map-marker-alt"></i> Interno</a>
                                    </li>
                                    <li @if ($menu == "colaborativo") class="activo" @endif>
                                        <a href="{{ Route('mapa.colab') }}"><i class="fas fa-globe-americas"></i>  Colaborativo</a>
                                    </li>
                                </ul>
                            </li>
                            
                            @if ($miuser->user_role == 1)
                           	<li @if ($menu == "informe") class="activo" @endif>
                                <a href="{{ Route('informe.index') }}"><i class="fa fa-bar-chart"></i>  Informe</a>
                            </li>
                            <li @if ($menu == "declaracion") class="activo" @endif>
                                <a href="{{ Route('declaracion.index') }}"><i class="far fa-check-square fa-fw"></i>  Declaración</a>
                                 <span class="badge" id="badge2_declarar" style="background-color: firebrick;color: white;position: absolute;right: 10px;top: 11px;padding: 2px 6px;background-color: #1ABB9C!important; cursor:pointer;">-
                                </span>
                            </li>
                            @endif
                            
                            @if ($miuser->user_role == 1)
                            <li @if ($menu == "configuracion") class="activo" @endif>
                                <a href="{{ Route('config.index') }}"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                            </li>
                            @endif
                            
                           <!--Roles
                        	role = 1 -> Administrado: Puede ver y editar todos los centros (independiente de usuario_permiso) y ver todas la vistas, 
                            role = 2 -> Centro: Puede ver Ingreso Registro, historial y configuración (sólo sus equipos), y cargar registro solo de lo permitido en usuario_permiso
                            role = 3 -> Solo Ver historial
                            role = 4 -> Centro Restringido: Puede ver sólo Ingreso Registro, y cargar registro sólo de lo permitido en usuario_permiso. 
                            			(Pensado originalmente para centro en arriendo)
                        	-->
                            
                        </ul>
                      
                    </div>
                </div>
            </div> 
      </nav>

        @show

        
        
        <div id="page-wrapper">

            @yield('content')
        
            
        </div>  


    </div>
            
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-table.js')}}"></script>
    
    <!-- DatetimePicker -->
   <script src="{{ asset('js/moment-with-locales.js')}}"></script>
   <script src="{{ asset('js/bootstrap-datetimepicker.js')}}"></script>   
   

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('js/sb-admin-2.js')}}"></script>
   
   
    <!-- Autocomplete --> 
<!--    <script src="js/jquery-1.10.2.js"></script>-->
    <script src="{{ asset('js/jquery-ui.js')}}"></script>
    
    
     <!-- Alertas --> 
    <script src="{{ asset('js/sweetalert.min.js')}}"></script>

    <!-- Inclueye los colores para los estados --> 
    <script src="{{ asset('js/color-estados.js')}}"></script>
    
    <!-- Edit table -->
    <script src="{{ asset('js/bootstrap-editable.js')}}"></script>
    <script src="{{ asset('js/bootstrap-table-editable.js')}}"></script>
    
    <!-- Export table -->
    <script src="{{ asset('js/tableExport.js')}}"></script>
    <script src="{{ asset('js/bootstrap-table-export.js')}}"></script>

    <!--  
    <script src="{{ asset('js/dateFormat.js')}}"></script>
    <script src="{{ asset('js/jquery.dateFormat.js')}}"></script>
    <script src="{{ asset('js/bootstrap3-typeahead.js')}}"></script>
    <script src="{{ asset('js/standalone/selectize.js')}}"></script>
    <script src="{{ asset('js/bootstrap-select.js')}}"></script>
    <script src="{{ asset('js/chosen.jquery.js')}}"></script>-->
    
    
    <script src="{{ asset('js/bootstrap-progressbar.min.js')}}"></script>
    
    <script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js')}}"></script>
    <!--<script src="{{ asset('chartjs/jquery.sparkline.min.js')}}"></script>
     <script src="{{ asset('js/exif.js')}}"></script>-->
    <script src="{{ asset('js/gauge.min.js')}}"></script>
    
    
   
    
    
    
    <!--<script src="{{ asset('js/jquery.canvasResize.js')}}"></script>
    <script src="{{ asset('js/canvasResize.js')}}"></script>
    <script src="{{ asset('js/binaryajax.js')}}"></script>
    <script src="{{ asset('js/exif.js')}}"></script>
    
     <script src="{{ asset('js/jquery.imageresize.js')}}"></script>-->
     
    
    <!-- Asigna menu para roles --> 
    <script src="{{ asset('js/menu_role.js')}}"></script>
    
    

    
	<!-- Canvas -->
    <script src="{{ asset('js/jspdf.min.js')}}"></script>
	
    <!-- Switch button -->
  	<script type="text/javascript" src="{{ asset('js/lc_switch.js')}}"></script>
     
     
     
     
	<script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.js')}}"> </script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.time.js')}}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.axislabels.js')}}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.navigate.js')}}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.threshold.js')}}"></script>
    <script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.selection.js')}}"></script>
    
    



    
    @yield('javascript')
    
    

</body>
</html>