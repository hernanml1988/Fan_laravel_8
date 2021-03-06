@extends('layouts/master')

<style type="text/css"> 
.multiselect.dropdown-toggle {
    text-align: left;
}
.multiselect.dropdown-toggle > .caret {
	float:right;
	margin-top:5px;
}



.highlighted {
    background-color:#9ad1d7 !important;
}
.emptyBlock1000 {
    height:1000px;
}
.emptyBlock2000 {
    height:2000px;
}
#sticky-modal {
    padding: 0.5ex;
}


#sticky-modal.stick {
    margin-top: 0px !important;
    position: sticky;
    top: 0;
    z-index: 1000001;
    border-radius: 0 0 0.5em 0.5em;
}
body{
	padding-right:0px !important;
		
	}
ul.ui-autocomplete {
    z-index: 1100;
}	
.ui-front {
    z-index: 9999999 !important;
}

@media (min-width: 992px){
	#myModalreporte .modal-lg  {
		width: 1100px !important;
	}
	
}

</style>

@section('content')

	
    
    
	<div id="">
        
       	<div id="">
            <div class="row" style="padding:20px;">
            	<button id="abrirmodalreporte" type="submit" class="btn btn-cerrada"><i class="fa fa-plus-circle"> </i>  Ingresar Registro</button>
                <form method="post" enctype="multipart/form-data" style="display:inline" class="form2_cargarexcel" >
                	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                	<input id="cargarexcel" type="file" style="display:none" name="select_file" />
               	</form>
                <div class="dropdown" style="display:inline">
                    <button id="btnload" type="button" data-toggle="dropdown" class="btn btn-default" title="Cargar registro laboratorio"><i class="fa fa-upload"> </i></button>
                <ul class="dropdown-menu" style="margin-top: 9px;">
                    <li style="cursor:pointer;"><a onClick="loadregistro();"><i class="fa fa-upload fa-fw"></i> Cargar Registro</a>
                    </li>
                    <li class="divider"></li>
                    <li class="text-center"><a onClick="formatoestandar();" style="color:#07C; text-decoration:underline; cursor:pointer;">Descargar Formato Planilla (V2.1)</a>
                    </li>
                </ul>
                </div>
               
                <!--<label for="file-upload" class="custom-file-upload">
                    <i class="fa fa-upload"></i> Carga Autom??tica
                </label>-->
                
               
            </div>
            <div class="row">
            	<div class="panel panel-black" style="margin-left:20px; margin-right:20px">
                    <div class="panel-heading" >
                        <div class="row text-center">
                        	
                            <span class="text-center" style="display:inline; font-weight:bold"> H I S T O R IA L  &emsp; D E &emsp; R E G I S T R O S</span>
                            
                        </div>
                        <div class="row" style="padding-top:9px;">
                            <div class="text-center">
                                <select id="opcionescentros" class="form-control multipleselect_single" size="1" style="display:inline; width:100%" >
                                    @foreach ($centro as $c)
                                         @foreach ($permisos as $p)
                                            @if($p->IDcentro == $c->IDcentro)
                                                <option value ="{{$c->IDcentro}}" >{{$c->Nombre}}</option>
                                            @endif
                                         @endforeach
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                    </div>
                        <div class="panel-body"> 
                            <div id="sticky-anchor"></div>
                                <div id="sticky">
                                    <div id="modal_toolbar_new" class="btn-group " >
                                        <button id="verreporte"  type="button" class="btn label-enviada" data-toggle="" data-target="">
                                            <span class="far fa-eye hidden-xs"> Ver Registro </span>
                                        </button>
                                         <button id="edit" class="btn label-enviada" data-title="Edit" data-toggle="" data-target="#edit">
                                            <span class="far fa-edit"> Editar</span>
                                        </button>
                                        <button id="trash" class="btn label-enviada" data-title="Delete" data-toggle="modal" data-target="#delete">
                                            <span class="far fa-trash-alt"> Eliminar</span>
                                         </button>
                                    </div>
                                </div>
                            <div class="text-info"  style="margin-top:25px; margin-bottom:-47px;">
                            </div>
                    
                            <div class="dataTable_wrapper">
                                
                                <table cellSpacing="0" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="{{ url('ingreso-editor/load_registro') }}" data-query-params="queryParams" data-show-refresh="true" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer" style="text-align-last:center" data-click-to-select="true" data-single-select="true"  data-row-style="rowStyle" id="dataTables" >
                                    <thead>
                                        <tr >
                                         
                                         	<th data-checkbox="true" ></th>
                                            <th data-formatter="runningFormatterhistorialreporte" data-switchable="false" data-width = "35px" >#</th>
                                            <th data-field="Date_Reporte" data-sortable="false" data-switchable="false"  class="" data-valign = ""  data-width = "90px">Toma Muestra</th>
                                            <th data-field="Time_Reporte" data-sortable="false" data-switchable="false"  class="" data-valign = ""  data-width = "90px">Hora</th>
                                            <th data-field="Fecha_Analisis" data-sortable="false" data-visible="false"> An??lisis Muestra </th>
                                            <th data-field="Fecha_Envio" data-sortable="false" data-visible="false"> Env??o Registro </th>
                                            <th data-field="Mortalidad" data-sortable="false" data-switchable="false" data-cell-style="cellStylepeces" data-width = "90px">Mortalidad</th>
                                            
                                            <th data-field="Comentario" data-sortable="false" data-switchable="false">Comentario</th>
                                            <th data-field="Estado_Alarma" data-sortable="false" data-switchable="false" data-width = "90px" data-cell-style="cellStyleestadoalarma" data-width = "35px">Condici??n</th>
                                            <th data-field="Estado" data-sortable="false" data-switchable="false" data-width = "35px">Enviado</th>
                                            <th data-field="Laboratorio" data-formatter="formatearLaboratorio" data-switchable="true" data-visible="false" data-width = "100">Registro</th>
                                            <th data-field="Firma" data-sortable="false" data-visible="true" data-width = "100px">Firma</th>
                                            
											<th data-field="IDmedicion" data-sortable="false" data-visible="false" data-width = "35px">ID</th>
                                    	</tr>  
                                    </thead>
                                    
                                </table>
                                
                            </div>
                      	</div>
                 	</div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="myModalreporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">INGRESO REGISTRO DIARIO</h4>
                    <h4 class="modal-title text-center" id="titulocentro" style=" margin-right:180px;margin-top:9px;"></h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row" style="padding-left: 25px;">
                            <div class="row" >	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> Toma Muestra </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-xs-6">
                                    <div class="input-group date" id="timepickerreporte">
                                       <input id="timereporte" value="" type="text" class="form-control"/>	
                                       <span class="input-group-addon">
                                           <span class="glyphicon-time glyphicon">
                                           </span>
                                       </span>
                                    </div> 
                                </div>
                                <div class="col-lg-2 col-md-3 col-xs-6">
                                    <div class="input-group date" id="datetimepickerreporte">
                                       <input id="fechareporte" value="" type="text" class="form-control"/>	
                                       <span class="input-group-addon">
                                           <span class="glyphicon-calendar glyphicon">
                                           </span>
                                       </span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row" >	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> An??lisis </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-xs-6">
                                    <div class="input-group date" id="timepickeranalisis">
                                       <input id="timeanalisis" value="" type="text" class="form-control"/>	
                                       <span class="input-group-addon">
                                           <span class="glyphicon-time glyphicon">
                                           </span>
                                       </span>
                                    </div> 
                                </div>
                                <div class="col-lg-2 col-md-3 col-xs-6">
                                    <div class="input-group date" id="datetimepickeranalisis">
                                       <input id="fechaanalisis" value="" type="text" class="form-control"/>	
                                       <span class="input-group-addon">
                                           <span class="glyphicon-calendar glyphicon">
                                           </span>
                                       </span>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> T??cnica Utilizada </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-5 col-md-8 col-xs-8">
                                    <select id="tecnicareporte" class="form-control">
                                        <option>C??mara de recuento Sedgewick Rafter</option>
                                        <option>Otra</option>
                                    </select>                        
                                </div>
                            </div>
                            <div class="row hidden" id="otratecnica">	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> Otra </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-8 col-md-8 col-xs-8">  
                                 <input id="tecnicareporteotra" class="form-control" placeholder="Indique t??cnica utilizada">
                                </div>
                            </div>
                            <div class="row">	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> Archivo </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-8 col-md-8 col-xs-8">
                                	<form class="form-horizontal form-label-left form1_archivos">
                                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    	<input type="file" id="inputarchivo" class="archivos" name="archivo[]" accept="" multiple/>
                                   	</form>
                                </div>
                            </div>
                            <div class="row">	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> Obs. </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-5 col-md-8 col-xs-8">
                                    <textarea id="obsreporte" class="form-control" placeholder="Observaciones Generales"></textarea>                              
                                </div>
                            </div>
                            <div class="row">	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> Firma </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-5 col-md-8 col-xs-8">
                                    <select id="firmareporte" class="form-control">
                                    	<option value="Centro">Centro Cultivo</option>
                                        <option value="Laboratorio">Laboratorio</option>
                                    </select>                             
                                </div>  
                            </div>
                            <div class="row">
                            	<div id="firma_nombre_div" class="col-lg-5 col-lg-offset-4 col-md-8 col-md-offset-4 col-xs-8 col-xs-offset-4">
                                	<input id="firma_nombre" class="form-control" placeholder="Indique su Nombre y Apellido" value="{{$miuser->name}}">
                                </div>
                           	</div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" style="margin-top:25px;">
                            <li class="active" id="tabdiato"><a href="#Diatomeas" data-toggle="tab">1. Diatomeas</a>
                            </li>
                            <li id=""><a href="#Dinoflagelados" data-toggle="tab">2. Dinoflagelados</a>
                            </li>
                            <li id=""><a href="#OEspecies" data-toggle="tab">3. Otros                  </a>
                            </li>
                            <li id="ultimo"><a href="#PAmbientales" data-toggle="tab">4. Ambiente            </a>
                            </li>
                        </ul>
                        <div id="sticky-anchor-modal"></div>
                        <div id="sticky-modal">
                        	<div id="buscadoresp" class="controls col-lg-5 pull-right" style="margin-right:-19px; margin-top:4px; margin-bottom:-8px;">
                                <div class="form-group input-group pull-right" style="margin-left:0px; margin-right:0px;">
                                    <input id="search-term" class="form-control" type="text" placeholder="Buscador de Especies" width="200px"/> <br>
                                     <span id="btnsearch" class="input-group-addon btn" style="background-color: #fff;"><i title="Buscar" class="icon-append fa fa-search"></i></span>
                                </div>
                            </div>
                      	</div>
                        <div class="tab-content" id="bodyContainer">
                            <div class="tab-pane fade  in active" id="Diatomeas">
                            	
                                
                                <div class="dataTable_wrapper" style="margin-top:25px;" id="Diatomeas-form">
                                
                                    <table cellSpacing="0" data-toggle="table" data-url="{{ url('vistas/load_diatomeas') }}" data-filter-control="true" data-query-params="queryParams"  data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladiatomeas" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-filter-control="input" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                
                                
                           	</div>     
                            
                            <div class="tab-pane fade" id="Dinoflagelados">
                                <div class="dataTable_wrapper" style="margin-top:25px;" id="Dinoflagelados-form">
                                    
                                        <table cellSpacing="0" data-toggle="table"  data-url="{{ url('vistas/load_dinoflagelados') }}" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladinoflagelados" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                </tr>  
                                            </thead>
                                            
                                        </table>
                                        
                                    </div>
                            
                            </div> 
                            <div class="tab-pane fade" id="OEspecies">
                            	<div class="dataTable_wrapper" style="margin-top:25px;" id="OEspecies-form">
                                
                                    <table cellSpacing="0" data-toggle="table"  data-url="{{ url('vistas/load_oespecies') }}" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tablaoespecies" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                            </div> 
                            <div class="tab-pane fade" id="PAmbientales">
                            	<div class="dataTable_wrapper" style="margin-top:25px;" id="PAmbientales-form">
                                
                                    <table cellSpacing="0" data-toggle="table"  data-url="{{ url('vistas/load_pambientales') }}" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientales" >
                                        <thead>
                                            <tr>
                                            	<th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "243px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "42px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "400px">Nombre</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                              	</div>
                              	<div class="dataTable_wrapper" style="margin-top:25px;" id="PAmbientalesotros-form">  
                                    <table cellSpacing="0" data-toggle="table"  data-url="{{ url('vistas/load_pambientalesotros') }}" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotros" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "231px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "40px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "380px">Nombre</th>
                                                <th data-formatter="runningFormattermicionambientalesotros" data-align= "center" data-valign = "middle" >Estados</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                
                            </div>    
                                
                    	</div>
                        <div class="row" id="tabnext">
                          <div class="col-md-12">
                            <div class="btn-toolbar pull-right">
                              <div class="btn-group">
                                <button class="btn btn-default change-tab" data-direction="previous" data-target="#myTab"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Anterior </button>
                                <button class="btn btn-default change-tab" data-direction="next" data-target="#myTab"> Siguiente <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                  	</div>
                  </div>
                  <div class="modal-footer" >
                  		<button id="closereporte" type="button" class="btn btn-default pull-left" data-dismiss="modal" style="margin-left:30px;">Cerrar</button>
                        <button id = "guardarreporte" type="button" class="btn btn-default" onclick="buscardatosreporte(0)"><i class="fa fa-save"> </i> Borrador</button>
                        <button id = "enviarreporte" type="button" class="btn btn-primary">Enviar Registro</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <!-- Modal -->
            <div class="modal fade" id="myModalverreporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg"  style="width:1180px;" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:15px;"> REGISTRO DIARIO</h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row">
                        	<div class="col-lg-6 col-md-6 col-xs-6">
                                <table class="infopdf pull-right " style="width:100%;table-layout: fixed;" >
                                  <tr>
                                    <th style="font-size:14px !important;" width = "55px">Centro</th>
                                    <th style="font-size:14px !important;font-weight:normal;" width = "30px">:</th> 
                                    <th style=" font-weight:normal;"><output style="font-size:13px !important; margin-top:-7px !important;" id="nombreverreporte"></output></th>
                                    <th width = "30px"></th>
                                    <th style="font-size:14px !important;" width = "70px">Muestra</th>
                                    <th style="font-size:14px !important;font-weight:normal;" width = "30px">:</th> 
                                    <th style="font-weight:normal;"><output style="font-size:13px !important;margin-top:-7px !important;" id="fechaverreporte"></output></th>
                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" width = "55px"><b>SIEP</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td><output style="font-size:13px !important; margin-top:-7px !important;" id="siepverreporte"></output></td>
                                    <td width = "30px"></td> 
                                    <td style="font-size:14px !important;" width = "70px"><b>An??lisis</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td> <output style="font-size:13px !important; margin-top:-7px !important;" id="fechaanalisisverreporte"></output></td>
                                    
                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" width = "55px"><b>ACS</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td><output style="font-size:13px !important;  margin-top:-7px !important;" id="acsverreporte"></output></td>
                                    <td width = "30px"></td> 
                                    <td style="font-size:14px !important;" width = "70px"><b>Env??o</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td> <output style="font-size:13px !important;   margin-top:-7px !important;" id="fechaenvioverreporte"></output></td>
                                    
                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" width = "55px"><b>Especie</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td><output style="font-size:13px !important; margin-top:-7px !important; " id="especieverreporte"></output></td>
                                    <td width = "30px"></td> 
                                    <td style="font-size:14px !important;" width = "70px"><b>Mortalidad </b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td> <output style="font-size:13px !important; margin-top:-7px !important;" id="pecesverreporte"></output></td>
                                    
                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" width = "55px"><b>Archivo</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td><output id="archivoverreporte"></output></td>   <!--onclick="verarchivo()" name="outputver"-->
                                    <td width = "30px"></td> 
                                    <td style="font-size:14px !important;" width = "65px"><b>Firma</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td> <output style="font-size:13px !important; margin-top:-7px !important;" id="firmaverreporte"></output></td>
                                    
                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" max-width = "55px"><b>Obs.</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td> 
                                    <td colspan="5"><output style="font-size:13px !important; margin-top:-7px !important;" id="obsverreporte"></output></td>
                                    
                                    
                                    
                                  </tr>
                                </table>
                            </div>
                             <div class="col-lg-6 col-md-6 col-xs-6">
                                <div id="content">
                                	<div id="titulo_grafico" class="text-center" style="font-size:14px; margin-top:-16px; margin-right:50px;"><b>Tendencia Especies Nocivas en la Semana</b> (M??x. concentraci??n)</div>
                                    <div id="titulo_grafico_ausencia" class="text-center hidden" style="font-size:14px; margin-top:-16px; margin-right:50px;"><b>Ausencia de Microalgas Nocivas en la Semana</b></div>
                                     <div class="demo-container">
                                        <div id="placeholder" class="demo-placeholder" style="display:inherit; float:left; width:405px; height:175px;"></div>
                                        <div style="float:right; width:25%; font-size:13px; max-height:170px; overflow-y:auto;" id="legendholder"></div>
                                    </div>
                                </div>
                       	 	</div>
                        </div>
                    
                    
                    
                    
                    
                        <!--<div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <div class="row" style="margin-top:-20px;">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> Centro </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                        <output id="nombreverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row" style="margin-top:-20px;">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> ACS </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                        <output id="acsverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row" style="margin-top:-20px;">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> Especie </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                        <output id="especieverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row hidden" style="margin-top:-20px;">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> Siembra </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                        <output id="siembraverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row hidden" style="margin-top:-20px;">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> Cosecha </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                        <output id="cosechaverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> Archivo </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7" style="margin-top:10px;">
                                         <output style="text-decoration:underline; vertical-align:middle; cursor: pointer;" id="archivoverreporte" onclick="verarchivo()" name="outputver"></output>                            
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                        <p class="arealabel"> Obs. </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                        <output id="obsverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-6" style="margin-bottom:10px;">
                                <div class="row" style="margin-top:-20px;">	
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> Muestra </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-xs-8">
                                        <output id="fechaverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> An??lisis</p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-xs-8">
                                        <output id="fechaanalisisverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row" >	
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> Env??o </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-xs-8">
                                        <output id="fechaenvioverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row hidden">	
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> T??cnica </p>
                                    </div>
        
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-xs-8">
                                        <output id="tecnicaverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                                <div class="row">	
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> Firma </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-xs-8">
                                        <output id="firmaverreporte" name="outputver"></output>                              
                                    </div>
                                </div>
                            </div>  
                        </div>-->
                    
                    	
                        
                        <ul class="nav nav-tabs" id="myTabver" style="margin-top:25px;">
                            <li class="active"><a href="#Diatomeasver" data-toggle="tab" id="tabdiatover">1. Diatomeas</a>
                            </li>
                            <li ><a href="#Dinoflageladosver" data-toggle="tab" id="tabdinover">2. Dinoflagelados</a>
                            </li>
                            <li ><a href="#OEspeciesver" data-toggle="tab" id="taboespver">3. Otros                  </a>
                            </li>
                            <li ><a href="#PAmbientalesver" data-toggle="tab" id="tabpambver">4. Ambiente            </a>
                            </li>
                        </ul>
                      	 
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Diatomeasver">
                                <div class="dataTable_wrapper" style="margin-top:25px;" >
                                
                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Diatomeas"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover" id="tabladiatomeasver" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_2"  data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                
                                
                            </div>     
                            
                            <div class="tab-pane fade" id="Dinoflageladosver">
                                <div class="dataTable_wrapper" style="margin-top:25px;" >
                                    
                                        <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Dinoflagelados"}'   data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladinoflageladosver" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                    <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                    <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                    <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                    <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                    <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                	<th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                	<th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                    
                                                </tr>  
                                            </thead>
                                            
                                        </table>
                                        
                                    </div>
                            
                            </div> 
                            <div class="tab-pane fade" id="OEspeciesver">
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                
                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Otras Especies"}'  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tablaoespeciesver" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                            </div> 
                            <div class="tab-pane fade" id="PAmbientalesver">
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                
                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Par??metros Ambientales"}'  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesver" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "240px">Nombre</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center"  data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                </div>
                                <div class="dataTable_wrapper" style="margin-top:25px;">  
                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Par??metros Ambientales"}'  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotrosver" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "100px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle"  data-width = "220px">Nombre</th>
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle">Estados</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                
                            </div>    
                                
                        </div>
                        
                        <div class="row" id="tabnextver">
                          <div class="col-md-12">
                            <div class="btn-toolbar pull-right">
                              <div class="btn-group">
                                <button class="btn btn-default change-tab" data-direction="previous" data-target="#myTabver"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Anterior </button>
                                <button class="btn btn-default change-tab" data-direction="next" data-target="#myTabver"> Siguiente <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                  	</div>
                  </div>
                  <div id="footerprint" class="modal-footer" >
                  		<button id="closereporte" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id="editarreportever" type="button" class="btn btn-primary hidden" class="hidden" ><i class="fa fa-edit fa-fw" ></i> Editar</button>
                        <!--<button id = "print" type="button" class="btn btn-info">Imprimir <i class="fa fa-print fa-fw" ></i></button>-->
                        <button id = "descargarpdf" type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o fa-fw" ></i> PDF </button>
                        
                  </div>
                </div>
              </div>
            </div>
            
            
            
            <!-- Modal -->
            <div class="modal fade" id="myModaleditreporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeeditup" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel"> EDITAR REGISTRO DIARIO</h4>
                   	<output id="idcentroeditreporte" class="hidden"></output>
                    <output id="idmedicioneditreporte" class="hidden"></output>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                        <div class="row" >	
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <p class="arealabel"> Toma Muestra </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-6">
                                <div class="input-group date" id="timepickereditreporte">
                                   <input id="timeeditreporte" value="" type="text" class="form-control reseteditinput" name=""/>	
                                   <span class="input-group-addon">
                                       <span class="glyphicon-time glyphicon">
                                       </span>
                                   </span>
                                </div> 
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-6">
                                <div class="input-group date" id="datetimepickereditreporte">
                                   <input id="fechaeditreporte" value="" type="text" class="form-control reseteditinput" name=""/>	
                                   <span class="input-group-addon">
                                       <span class="glyphicon-calendar glyphicon">
                                       </span>
                                   </span>
                                </div> 
                            </div>
                        </div>
                        <div class="row" >	
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <p class="arealabel"> An??lisis </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-xs-6">
                                <div class="input-group date" id="timepickereditanalisis">
                                   <input id="timeeditanalisis" value="" type="text" class="form-control reseteditinput" name=""/>	
                                   <span class="input-group-addon">
                                       <span class="glyphicon-time glyphicon">
                                       </span>
                                   </span>
                                </div> 
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-6">
                                <div class="input-group date" id="datetimepickereditanalisis">
                                   <input id="fechaeditanalisis" value="" type="text" class="form-control reseteditinput" name=""/>	
                                   <span class="input-group-addon">
                                       <span class="glyphicon-calendar glyphicon">
                                       </span>
                                   </span>
                                </div> 
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Fecha Envio </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="fechaenvioeditreporte" name="resetedit"></output>                              
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> T??cnica </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="tecnicaeditreporte" name="resetedit"></output>                              
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Obs. </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <input id="obseditreporte" class="form-control reseteditinput" name=""/>                              
                            </div>
                        </div>
                         <div class="row" >	
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <p class="arealabel"> Archivos Actuales </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-xs-8">
                            	<output id="archivoeditreporte" class="reseteditinput"> - </output>
                                <!--<input type="file" id="inputeditarchivo" accept="" name="reseteditinput"/>-->
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <p class="arealabel"> Archivo </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-8 col-xs-8">
                            	<form class="form-horizontal form-label-left form1_edit_archivos">
                                    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    	<input type="file" id="inputeditarchivo" class="archivos" name="archivo[]" accept="" multiple/>
                                </form>
                                <!--<input type="file" id="inputeditarchivo" accept="" name="reseteditinput"/>-->
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Firma </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="firmaeditreporte" name="resetedit"></output>                              
                            </div>
                        </div>
                        
                        <ul class="nav nav-tabs" id="myTabedit" style="margin-top:25px;">
                            <li class="active"><a href="#Diatomeasedit" data-toggle="tab" id="tabdiatover">1. Diatomeas</a>
                            </li>
                            <li ><a href="#Dinoflageladosedit" data-toggle="tab" id="tabdinover">2. Dinoflagelados</a>
                            </li>
                            <li ><a href="#OEspeciesedit" data-toggle="tab" id="taboespver">3. Otros                  </a>
                            </li>
                            <li ><a href="#PAmbientalesedit" data-toggle="tab" id="tabpambver">4. Ambiente            </a>
                            </li>
                        </ul>
                      	 
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Diatomeasedit">
                                <div class="dataTable_wrapper" style="margin-top:25px;" >
                                
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladiatomeasedit" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                
                                
                            </div>     
                            
                            <div class="tab-pane fade" id="Dinoflageladosedit">
                                <div class="dataTable_wrapper" style="margin-top:25px;" >
                                    
                                        <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladinoflageladosedit" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                    <th data-field="Medicion_1" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_2" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_3" data-visible="false" data-editable="true"   data-editable-emptytext="Vac??o"  data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_4" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o"  data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_5" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                	<th data-field="Medicion_6" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                	<th data-field="Medicion_7" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    
                                                </tr>  
                                            </thead>
                                            
                                        </table>
                                        
                                    </div>
                            
                            </div> 
                            <div class="tab-pane fade" id="OEspeciesedit">
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tablaoespeciesedit" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-editable="true"  data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-editable="true"  data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                            </div> 
                            <div class="tab-pane fade" id="PAmbientalesedit">
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesedit" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "240px">Nombre</th>
                                                <th data-field="Medicion_1" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-editable="true" data-editable-emptytext="Vac??o" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                </div>
                                <div class="dataTable_wrapper" style="margin-top:25px;" id="PAmbientalesotros-form">  
                                    <table cellSpacing="0" data-toggle="table"  data-url="{{ url('vistas/load_pambientalesotros') }}" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotrosedit" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "143px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "44px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "311px">Nombre</th>
                                                <th data-formatter="runningFormattermicionambientalesotrosedit" data-align= "center" data-valign = "middle" >Estados</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                <!--<div class="dataTable_wrapper" style="margin-top:25px;">  
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotrosedit" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "100px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "220px">Nombre</th>
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle" >Estados</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>-->
                                
                            </div>    
                                
                        </div>
                        
                        <div class="row" id="tabnextedit">
                          <div class="col-md-12">
                            <div class="btn-toolbar pull-right">
                              <div class="btn-group">
                                <button class="btn btn-default change-tab" data-direction="previous" data-target="#myTabedit"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Anterior </button>
                                <button class="btn btn-default change-tab" data-direction="next" data-target="#myTabedit"> Siguiente <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                  	</div>
                  </div>
                  <div id="footerprint" class="modal-footer" >
                  		<button id="closeedit" type="button" class="btn btn-default pull-left" data-dismiss="" style="margin-left:30px;">Cerrar</button>
                        <button id = "guardaredit" type="button" class="btn btn-default" onclick="editregistro(0)"><i class="fa fa-save"> </i> Borrador</button>
                        <button id = "saveedit" type="button" class="btn btn-primary" onclick="editregistrocorreo(1)">Enviar Registro</button>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!--Modal Print-->
            <div class="modal fade" id="myModalverreporteprint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:15px;"> REGISTRO DIARIO </h4>
                    <output id="idmedicionverreporte" class="hidden"></output>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row" style="margin-top:-20px;">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Centro </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="nombreverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row" style="margin-top:-20px;">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Especie </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="especieverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row" style="margin-top:-20px;">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Siembra </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="siembraverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row" style="margin-top:-20px;">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Cosecha </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="cosechaverreporteprint"></output>                              
                            </div>
                        </div>
                    	<div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Fecha Registro </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="fechaverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Fecha Env??o </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="fechaenvioverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> T??cnica </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="tecnicaverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Archivo </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                 <output style="text-decoration:underline; vertical-align:middle; cursor: pointer;" id="archivoverreporteprint" onclick="verarchivo()"></output>                             
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Obs. </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="obsverreporteprint"></output>                              
                            </div>
                        </div>
                        <div class="row">	
                            <div class="col-lg-3 col-md-2 col-xs-3">
                                <p class="arealabel"> Firma </p>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <p class="arealabel">  : </p>
                            </div>
                            <div class="col-lg-8 col-md-9 col-xs-7">
                                <output id="firmaverreporteprint"></output>                              
                            </div>
                        </div>
                                <div class="dataTable_wrapper" style="margin-top:25px;" >
                                	<h4 class="text-center"> DIATOMEAS </h4>
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tabladiatomeasverprint" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                
                                
                                <div class="dataTable_wrapper" style="margin-top:25px;" >
                                    <h4 class="text-center"> DINOFLAGELADOS </h4>
                                        <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tabladinoflageladosverprint" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                    <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                    
                                                </tr>  
                                            </thead>
                                            
                                        </table>
                                        
                                    </div>
                            
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                	<h4 class="text-center"> OTROS </h4>
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablaoespeciesverprint" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                	<h4 class="text-center"> AMBIENTE </h4>
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesverprint" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "240px">Nombre</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                                
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                </div>
                                <div class="dataTable_wrapper" style="margin-top:25px;">  
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotrosverprint" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "100px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "220px">Nombre</th>
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle" >Estados</th>
                                            </tr>  
                                        </thead>
                                        
                                    </table>
                                    
                                </div>
                                   
                                
                        </div>
                        <div id="footerprint" class="modal-footer text-center"  >
                            <div class="text-center" style="font-size:16px; margin-top:15px;">Atte.</div>
                            <br/>
                            <img src="GTRgestion.png" class="center-block"/>
                            <div class="text-center" style="font-size:16px; margin-bottom:15px;">www.gtrgestion.cl</div>
                      	</div>
                        
                  	</div>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!-- Modal -->
            <div class="modal fade" id="myModaldetalleimagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:14px;"> <output id="nombreespecieimagen" style="display:inline; text-transform:uppercase; font-size:20px !important;"></output> </h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row">	
                            <div class="col-lg-6 col-md-6 col-xs-12">
                            	<img id="detalleimagen" src="" class="img-circle-wide center-block" style="max-width:100% !important;"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                                <table>
                                    <thead>
                                        <tr>
                                            <th ></th>
                                            <th ></th>
                                            <th></th>				
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<tr>
                                            <td><p class="text-danger" style="display:inline;  text-transform:uppercase; font-weight:bold">Alarma Cr??tico</p></td>
                                            <td><p class="text-danger" style="display:inline;  text-transform:uppercase; font-weight:bold">:</p></td>
                                            <td><output id="especienivelrojo" style="display:inline;"></output></td>
                                        </tr>
                                        <tr>
                                            <td><p class=" text-warning" style="display:inline; color:#e5cc3a; text-transform:uppercase;">Alarma Precauci??n</p></td>
                                            <td><p class=" text-warning" style="display:inline; color:#e5cc3a;">:</p></td>
                                            <td><output id="especienivelamarillo" style="display:inline;"></output></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <p id="descripcionespecieimagen" style="text-align:justify;"></p>
                            </div>
                       	</div>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            
            
             <!-- Modal -->
            <div class="modal fade" id="myModalcargaexcel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-right:100px; margin-top:9px;">CARGA AUTOM??TICA</h4>
                  </div>
                  <div class="modal-body">
                  	<div class="panel-body">
                     		
                            <div class="row">	
                                <div class="col-lg-4 col-md-4 col-xs-11">
                                    <p class="arealabel"> Firma </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <select id="firma" class="form-control">
                                        <option>Laboratorio Plancton Andino</option>
                                        <option>Laboratorio Fitolab</option>
                                        <option>Laboratorio Annaliza</option>
                                        <option>Laboratorio Lamar</option>
                                        <option>Universidad Austral de Chile</option>
                                        <option>@FAN</option>
                                        <option>North Patagonia</option>
                                        <option>Centro Cultivo (Medici??n Interna)</option>
                                    </select>                              
                                </div>
                            </div>
                            <!--<div class="row">	
                                <div class="col-lg-3 col-md-3 col-xs-3">
                                    <p class="arealabel"> Observaciones </p>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-6">
                                    <input id="Observaciones" class="form-control" placeholder="">                               
                                </div>
                            </div>-->
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-11">
                                    <a data-toggle="tooltip" title="Ver registro despu??s de cargar" style="cursor:help; color:#333;">
                                    <p class="arealabel"> Ver Registro Salida </p></a>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <input class="form-control checkbox" type="checkbox" id="abrirregistro">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-xs-11">
                                    <a data-toggle="tooltip" title="Enviar notificaciones autom??ticas al correo despu??s de cargar." style="cursor:help; color:#333;">
                                    <p class="arealabel"> Enviar Notificaciones </p></a>
                                </div>
                                <div class="col-lg-1 col-md-1 col-xs-1">
                                  <p class="arealabel">  : </p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <input class="form-control checkbox" type="checkbox" id="enviarnotificaciones">
                                </div>
                            </div>
                            <div class="row" style="margin-left: 0px; margin-top:15px;">
                    			<p class=" text-danger" style="display:inline">*Importante:</p>
                                Revisar el registro de salida, debido a que pueden existir diferencias.
		                    </div>	
                    	 </div>
                    <div class="modal-footer" style="margin-top:15px;">
                    	<button id="closecargaexcel" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button id = "enviarcargaexcel" type="button" class="btn btn-primary pull-right"><i class="fa fa-upload"> </i> Cargar Registro</button>
                         <button id="" type="button" class="btn btn-default pull-right hidden" onClick="formatoestandar()">Descargar Formato</button>
                   	</div>
                  </div>
                </div>
              </div>
            </div>
                  
            
             <!-- Modal -->
            <div class="modal fade" id="myModalespecienoencontrada" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeupnoexiste" type="button" class="close" data-dismiss="" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-right:100px; margin-top:9px;">ESPECIE NO ENCONTRADA</h4>
                  </div>
                  <div class="modal-body">
                  	<div class="panel-body">
                    		<p style="margin-top:-15px; margin-bottom:15px;"> Se ha detectado que alguna de las especies no han sido reconocida por el sistema, por favor b??squela en la lista de coincidencias. </p>
                            
                            <table cellSpacing="0" data-toggle="table" data-url="" data-filter-control="true"  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablaespeciesnoencontradas" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "15px">#</th>
                                                <th data-field="Nombre" data-filter-control="input" data-align= "left" data-halign="center" data-valign = "middle" data-width = "170px">Especie No Encontrada</th>
                                                <th data-formatter="runningFormatterespeciegeneral" data-align= "center" data-valign = "middle" data-width = "170px">Buscar</th>
                                                
                                                <th data-field="IDmedicionfan"  data-align= "center" data-visible="false" data-valign = "middle" data-width = "50px">ID</th>
                                            </tr>  
                                        </thead>
                                        
                            </table>
                    	 </div>
                    <div class="modal-footer" style="margin-top:15px;">
                        <button id="closenoexiste" type="button" class="btn btn-default pull-left" data-dismiss="">Cerrar</button>
                        <button id="guardarespecienoexiste" type="button" class="btn btn-primary">Guardar</button>
                   	</div>
                  </div>
                </div>
              </div>
            </div>
            
            
             <!-- Modal -->
            <div class="modal fade" id="myModalsiepnoencontrado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeupsiepnoexiste" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('GTR_Fan.png') }}" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-right:100px; margin-top:9px;">C??DIGO SIEP NO ENCONTRADO</h4>
                  </div>
                  <div class="modal-body">
                  	<div class="panel-body">
                    		<p style="margin-top:-15px; margin-bottom:15px;"> Se ha detectado que el c??digo SIEP no coincide con los centros registrados. Por favor, buscar en la lista de coincidencias. </p>
                            
                            <table cellSpacing="0" data-toggle="table" data-url="" width="100%" class="table table-striped table-bordered table-hover"   id="" >
                                        <thead>
                                            <tr>
                                                <th  data-align= "left" data-halign="center" data-valign = "middle" data-width = "170px">SIEP No Encontrado</th>
                                                <th data-align= "center" data-valign = "middle" data-width = "170px"> Buscar</th>
                                                
                                            </tr>  
                                        </thead>
                                        <tr>
                                            <td data-align= "left" data-halign="center" data-valign = "middle" data-width = "170px"><output id="siepnoencontrado" class="form-control"></output></td>
                                            <td data-align= "center" data-valign = "middle" data-width = "170px"> <input id="buscarsiepnombre" class="form-control" placeholder="Buscar"></td>
                                        </tr>
                                        
                            </table>
                    	 </div>
                    <div class="modal-footer" style="margin-top:15px;">
                        <button id="closesiepnoexiste" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button id="guardarsiepnoexiste" type="button" class="btn btn-primary">Guardar</button>
                   	</div>
                  </div>
                </div>
              </div>
            </div>
            
            
            <!-- Modal Loading--> 
            <div class="modal fade" id="modalloading" tabindex="-1" role="dialog">
                <div class="modal-dialog " role="document" >
                    <div class="modal-content" style="height:120px; width:400px; alignment-adjust:central">
                        <div class="modal-body center-block text-center">
                             <img src='loader.gif' /><h5 id="loadingtext"> Loading... Please Wait </h5>
                        </div>
                     </div>
                </div>
            </div>
    

@endsection




@section('javascript')  
    
<script>
	var user_id = {{$miuser->id}};
	var id_empresa = {{$miuser->IDempresa}};
	
	var role = {{$miuser->user_role_fan}};
	roles(role);
	
	var dataTables = $('#dataTables');
	
	function queryParams(params) {
		params.user_id = user_id;
		params.IDcentro = document.getElementById("opcionescentros").value;
        return params;
    }
	$('#opcionescentros').on('change', function() {
		dataTables.bootstrapTable("refresh");
		changefirmas($("#opcionescentros").val());
	});
	
	$('.multipleselect_single').multiselect({
		includeSelectAllOption: false,
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		buttonWidth: '250px',
		maxHeight: 400
	});
	
			
	//Mensaje Loding, despues de 1 seg.
	$( document ).ajaxStop(function () {
		$('#modalloading').modal('hide');
	});
	
	//Load opciones profundidad
	var listacentros = [];
	$( document ).ready(function() {
		
		$.ajax({
				url: '{{ url("vistas/load_options_prof")}}',
            	data: {
                    _token: "{{ csrf_token() }}"
                  },
				type: 'post',
				dataType: 'json',
				success: function(dato)
				{ 
					if(dato != ""){
						var opt = dato.split(",");
						//Todas las tablas
						for(var j=1; j<=4; j++){
							var tabla = "";
							var esp = "";
							switch(j) {
								case 1:
									tabla = "tabladiatomeas";
									esp = "diato";
									break;
								case 2:
									tabla = "tabladinoflagelados";
									esp = "dino";
									break;
								case 3:
									tabla = "tablaoespecies";
									esp = "oesp";
									break;
								case 4:
									tabla = "tablapambientales";
									esp = "pamb";
									break;
							}
							
							$('#'+tabla).bootstrapTable('destroy');
							for(var i = 0; i<opt.length; i++){
								var th = '<th data-formatter="runningFormatter'+esp+'prof'+i+'" data-align= "center" data-valign = "middle" data-width = "100px"></th>';
								$('#'+tabla+' tr').append($(th));
								$('#'+tabla+' thead tr>th:last').html(opt[i]);
								
								//Modal Ver
								$('#'+tabla+'ver').bootstrapTable('showColumn', 'Medicion_'+(i+1));
								
								//Modal Edit
								$('#'+tabla+'edit').bootstrapTable('showColumn', 'Medicion_'+(i+1));
								
								//Modal Print
								$('#'+tabla+'verprint').bootstrapTable('showColumn', 'Medicion_'+(i+1));
							}
							
							$('#'+tabla).bootstrapTable();
							
							
							
							$('#'+tabla).bootstrapTable('refresh');
							for(var i = 0; i<opt.length; i++){
								//Modal Ver
								$('#'+tabla+'ver thead [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
								
								//Modal Edit
								$('#'+tabla+'edit thead [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
								
								//Modal Print
								$('#'+tabla+'verprint [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
							}
						}
					}
				}               
			});
			
			//Busca lista firmas
			listacentros = {!! json_encode($permisos) !!};
			dataTables.bootstrapTable("refresh");
			changefirmas($("#opcionescentros").val());
			
			
	});
	
	function changefirmas(IDcentro){
		$("#titulocentro").text($("#opcionescentros option:selected").text());
	}
	
	$("#firmareporte").change(function(){
		
		if($("#firmareporte").val() == 'Laboratorio'){
			
			$("#firma_nombre_div").html('<select id="firma_nombre" class="form-control">'+
				'<option value="Laboratorio Plancton Andino">Laboratorio Plancton Andino</option>'+
				'<option value="Laboratorio Fitolab">Laboratorio Fitolab</option>'+
				'<option value="Laboratorio Annaliza">Laboratorio Annaliza</option>'+
				'<option value="Laboratorio Lamar">Laboratorio Lamar</option>'+
				'<option value="Universidad Austral de Chile">Universidad Austral de Chile</option>'+
				'<option value="@FAN">@FAN</option>'+
				'<option value="North Patagonia">North Patagonia</option>'+
			'</select>');
			
		}else{
			$("#firma_nombre_div").html('<input id="firma_nombre" class="form-control" placeholder="Indique su Nombre y Apellido" value="{{$miuser->name}}">');
		}
		
	});
	
	
	
	dataTables.on('check.bs.table',function () {
		if(dataTables.bootstrapTable('getSelections')[0]){
			//$('#verreporte').click(); 
		}
	});
	
	var idmedicion = "";
	
	$('#verreporte').click( function(){
		samegrupo2 = 0;
		res2 = 0;
		n2 = 0;
		rowsp2 = [];
		indx2 = [];
		samegrupo1 = 0;
		res1 = 0;
		n1 = 0;
		rowsp1 = [];
		indx1 = [];
		if(dataTables.bootstrapTable('getSelections')[0].Estado == "Si"){
			idmedicion = dataTables.bootstrapTable('getSelections')[0].IDmedicion;
			tablasverreporte(idmedicion);
			$('#myModalverreporte').modal('show');
		}else{alert("Registro no enviado, favor editar para continuar.")}
	});
	
	function verregistroenviado(aux){
		if(aux != 0){
			samegrupo2 = 0;
			res2 = 0;
			n2 = 0;
			rowsp2 = [];
			indx2 = [];
			samegrupo1 = 0;
			res1 = 0;
			n1 = 0;
			rowsp1 = [];
			indx1 = [];
			idmedicion = aux;
			tablasverreporte(idmedicion);
			$('#myModalverreporte').modal('show');
		}
	}
	
	$("#descargarpdf").click( function(){
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
					url: '{{ url("/archivos/Registros_Alarma/generar_registro.php") }}',
					type: 'post',
					dataType: 'json',
					data: {
						 _token: "{{ csrf_token() }}",
						f:	fechareportepdf,
						c:	$('#nombreverreporte').text(),
						a:	estadoalarmapdf,
						m:  	idmedicion,    
						i:    user_id
					},
					success: function(dato)
					{ 
						//window.open("archivos/Registros_Alarma/descargar_registro.php?n="+dato, "_blank");
						window.location.href = "archivos/Registros_Alarma/descargar_registro.php?n="+dato;
						
					},
					error: function(msg)
					{
						console.log(msg);
						
					}
			});
	});
	
	$('#inputarchivo').change(function() {
		if($('#inputarchivo').prop('files').length > 0 ){
			if($(this).get(0).files[0].size > 1000000){
				swal("", "El archivo excede el tama??o m??ximo 1[mb]", "warning");
				document.getElementById("inputarchivo").value = "";
			}else{
				
			};
		}
	});
	$('#inputeditarchivo').change(function() {
		if($('#inputeditarchivo').prop('files').length > 0 ){
			if($(this).get(0).files[0].size > 1000000){
				swal("", "El archivo excede el tama??o m??ximo 1[mb]", "warning");
				document.getElementById("inputeditarchivo").value = "";
			}else{
				
			};
		}
	});
	
	function verarchivo(){
			$.ajax({
						url: '{{ url("vistas/load_archivo_registro.php") }}',
						type: 'post',
						data: {  _token: "{{ csrf_token() }}",  IDmedicion: idmedicionarchivo},
						success: function(dato)
						{ 	
							var nombrearchivo = "";
							if(dato){
								$.each(dato, function(){
									nombrearchivo = nombrearchivo + '<a style="display:inline;"  class="like eliminar_doc_'+this.id+'" href=\"{{url("vistas/getarchivo/")}}/'+this.id+'\" target="_blank" > '
												+ this.titulo+
											' </a> ';
								});
							}
							$('#archivoverreporteprint').html(nombrearchivo);
							//var obj = JSON.parse(dato);
							//window.open(obj['Archivo'], "_blank");
						}               
					});
					
			
		};
	
	var idcentro = "";
	var especie_rojo = [];
	var especie_amarillo = [];
	var especie_otro = [];
	var especie_nocivo = [];
	var especie_nocivo_no = [];
	var idmedicionarchivo = "";
	var fechareportepdf = "";
	var estadoalarmapdf = "";
	function tablasverreporte(idmedicion){
		 
			$('#tabladiatomeasver').bootstrapTable("removeAll");	
			$('#tabladinoflageladosver').bootstrapTable("removeAll");
			$('#tablaoespeciesver').bootstrapTable("removeAll");
			$('[name="outputver"]').text("");
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: '{{ url("/vistas/load_fan_reporte") }}',
					type: 'get',
					data: {		
						_token: "{{ csrf_token() }}", IDmedicion: 	 idmedicion,
					},
					dataType: 'json',
					success: function(dato)
					{ 
						$('#tabladiatomeasver').bootstrapTable("removeAll");	
						$('#tabladinoflageladosver').bootstrapTable("removeAll");
						$('#tablaoespeciesver').bootstrapTable("removeAll");
						if(dato != 0){
							var datos = dato;//JSON.parse(dato);
							especie_rojo = [];
							especie_amarillo = [];
							especie_otro = [];
							especie_nocivo = [];
							especie_nocivo_no = [];
							$('#tabladiatomeasver').bootstrapTable("load", datos['Diatomeas']);
							$('#tabladinoflageladosver').bootstrapTable("load", datos['Dinoflagelados']);
							$('#tablaoespeciesver').bootstrapTable("load", datos['OEsp']);
							$('#fechaverreporte').text(datos['Fecha_Reporte']);
							$('#fechaanalisisverreporte').text(datos['Fecha_Analisis']);
							$('#fechaenvioverreporte').text(datos['Fecha_Envio']);
							$('#tecnicaverreporte').text(datos['Tecnica']);
							$('#obsverreporte').text(datos['Observaciones']);
							
							var nombrearchivo = "";
							if(datos['Archivo']){
								$.each(datos['Archivo'], function(){
									nombrearchivo = nombrearchivo + '<a style="display:inline;"  class="like" href=\"{{url("vistas/getarchivo/")}}/'+this.id+'\" target="_blank" > '
												+ this.titulo+
											' </a>';
								});
							}
							$('#archivoverreporte').html(nombrearchivo);
							$('#firmaverreporte').text(datos['Firma']);
							$('#nombreverreporte').text(datos['Nombre']);
							$('#acsverreporte').text(datos['Barrio']);
							$('#especieverreporte').text(datos['Especie']);
							$('#pecesverreporte').text(datos['Mortalidad']);
							$('#siepverreporte').text(datos['Codigo']);
							$('#siembraverreporte').text(datos['Siembra']);
							$('#cosechaverreporte').text(datos['Cosecha']);
							
							//
							$('#tabladiatomeasverprint').bootstrapTable("load", datos['Diatomeas']);
							$('#tabladinoflageladosverprint').bootstrapTable("load", datos['Dinoflagelados']);
							$('#tablaoespeciesverprint').bootstrapTable("load", datos['OEsp']);
							$('#fechaverreporteprint').text(datos['Fecha_Reporte']);
							$('#fechaenvioverreporteprint').text(datos['Fecha_Envio']);
							$('#tecnicaverreporteprint').text(datos['Tecnica']);
							$('#obsverreporteprint').text(datos['Observaciones']);
							$('#archivoverreporteprint').text(nombrearchivo);
							$('#firmaverreporteprint').text(datos['Firma']);
							$('#nombreverreporteprint').text(datos['Nombre']);
							$('#especieverreporteprint').text(datos['Especie']);
							$('#siembraverreporteprint').text(datos['Siembra']);
							$('#cosechaverreporteprint').text(datos['Cosecha']);
							
							idcentro = datos['IDcentro'];
							loaddatagrafico();
							idmedicionarchivo = idmedicion;
							$('#idmedicionverreporte').val(idmedicion);
							fechareportepdf = datos['Fecha_Reporte'];
							estadoalarmapdf = datos['Estado_Alarma'];
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}               
				});
			//Par??metros Ambientales	
			$.ajax({
					url: '{{ url("/vistas/load_pambientales_reporte") }}',
					type: 'get',
					data: {
						_token: "{{ csrf_token() }}",		
						IDmedicion: 	 idmedicion,
						user_id:		user_id
					},
					success: function(dato)
					{ 
						$('#tablapambientalesver').bootstrapTable("removeAll");	
						$('#tablapambientalesotrosver').bootstrapTable("removeAll");
						if(dato != 0){
							var datos = dato;//JSON.parse(dato);
							$('#tablapambientalesver').bootstrapTable("load", datos['PAmbientales']);
							$('#tablapambientalesotrosver').bootstrapTable("load", datos['PAmbientalesotros']);
							
							//Print
							//$('#tablapambientalesverprint').bootstrapTable("load", datos['PAmbientales']);
							//$('#tablapambientalesotrosverprint').bootstrapTable("load", datos['PAmbientalesotros']);
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}               
				});
	
	}
	
	
	//Edit
	var editvaluefan = Array();
	var editvaluepamb = Array();
	$('#tabladiatomeasedit, #tabladinoflageladosedit, #tablaoespeciesedit').on('editable-save.bs.table', foofan);
	$('#tablapambientalesedit').on('editable-save.bs.table', foopamb);	
	function foofan(field, row, Value, $el) {
		var idmed = "";
		if(Value['IDmedicionfan']){
			idmed = Value['IDmedicionfan'];
		}
		editvaluefan.push({"Medicion": row,	"Valor": Value[row], "IDmedicionfan": idmed, "IDespecie": Value['IDespecie'] });
	}
	function foopamb(field, row, Value, $el) {
		var idmed = "";
		if(Value['IDmedicionpambientales']){
			idmed = Value['IDmedicionpambientales'];
		}
		editvaluepamb.push({"Medicion": row,	"Valor": Value[row], "IDmedicionpambientales": idmed, "IDpambientales": Value['IDpambientales']});
	}
	
	$('#edit').click( function(){ 
		var selects = "";
		selects = dataTables.bootstrapTable('getSelections')[0];
			if(selects){
				funcioneditarregistro( selects.IDmedicion,selects.Estado,selects.Declarado); 
			}
	});
	$('#editarreportever').click( function(){ 
		$('#myModalverreporte').modal('hide');
		funcioneditarregistro($('#idmedicionverreporte').val() ,"No"); 
	});	
	
	function funcioneditarregistro(idmedcionaux, estadoaux,declaradoaux){
		
				if(estadoaux == 'No' ||  role == "admin_fan_empresa"  ){
					if(declaradoaux != 1){
						if(estadoaux =='Si'){ $('#guardaredit').addClass("hidden"); }else{ $('#guardaredit').removeClass("hidden");}
						samegrupo2 = 0;
						res2 = 0;
						n2 = 0;
						rowsp2 = [];
						indx2 = [];
						samegrupo1 = 0;
						res1 = 0;
						n1 = 0;
						rowsp1 = [];
						indx1 = [];
						$('#tabladiatomeasedit').bootstrapTable("removeAll");	
						$('#tabladinoflageladosedit').bootstrapTable("removeAll");
						$('#tablaoespeciesedit').bootstrapTable("removeAll");
						$('[name="resetedit"]').text("");
						$('.reseteditinput').val("");
						$('#modalloading').modal({backdrop: 'static', keyboard: false});
						$.ajax({
								url: '{{ url("/ingreso-editor/load_fan_edit_reporte") }}',
								type: 'post',
								data: {	
									 _token: "{{ csrf_token() }}",	
									IDmedicion: 	 idmedcionaux,
									user_id:		user_id
								},
								success: function(dato)
								{ 
									$('#tabladiatomeasedit').bootstrapTable("removeAll");	
									$('#tabladinoflageladosedit').bootstrapTable("removeAll");
									$('#tablaoespeciesedit').bootstrapTable("removeAll");
									if(dato != 0){
										var datos = dato;//JSON.parse(dato);
										$('#tabladiatomeasedit').bootstrapTable("load", datos['Diatomeas']);
										$('#tabladinoflageladosedit').bootstrapTable("load", datos['Dinoflagelados']);
										$('#tablaoespeciesedit').bootstrapTable("load", datos['OEsp']);
										var fechareporte = datos['Fecha_Reporte'].split(" ");
										document.getElementById("fechaeditreporte").value = fechareporte[0];
										var timereporte = fechareporte[1].split(":");
										document.getElementById("timeeditreporte").value = timereporte[0].concat(":").concat(timereporte[1]);
										var fechaanalisis = datos['Fecha_Analisis'].split(" ");
										document.getElementById("fechaeditanalisis").value = fechaanalisis[0];
										var timeanalisis = fechaanalisis[1].split(":");
										document.getElementById("timeeditanalisis").value = timeanalisis[0].concat(":").concat(timeanalisis[1]);
										$('#fechaenvioeditreporte').text(datos['Fecha_Envio']);
										$('#tecnicaeditreporte').text(datos['Tecnica']);
										$('#obseditreporte').val(datos['Observaciones']);
										$('#firmaeditreporte').text(datos['Firma']);
										$('#idcentroeditreporte').val(datos['IDcentro']);
										$('#idmedicioneditreporte').val(datos['IDmedicion']);
										
										var nombrearchivo = "";
										if(datos['Archivo']){
											$.each(datos['Archivo'], function(){
												nombrearchivo = nombrearchivo + '<a style="display:inline;"  class="like eliminar_doc_'+this.id+'" href=\"{{url("vistas/getarchivo/")}}/'+this.id+'\" target="_blank" > '
															+ this.titulo+
														' </a> '+
														'<a title="Eliminar Archivo" type="button" class="close eliminar_doc_'+this.id+'" aria-label="Close" style="color: blue;margin-top: -5px;margin-left:10px;float:none !important;" onclick="eliminar_doc('+this.id+')"><span aria-hidden="true">&times;</span></a> ';
											});
										}
										$('#archivoeditreporte').html(nombrearchivo);
										
										
										
									}else{swal("Error", "Error al cargar el reporte.", "error");}
								}               
							});
							
						//Par??metros Ambientales
						$('#modalloading').modal({backdrop: 'static', keyboard: false});	
						$.ajax({
								url:  '{{ url("/ingreso-editor/load_pambientales_edit_reporte") }}',
								type: 'post',
								data: {	
									_token: "{{ csrf_token() }}",	
									IDmedicion: 	 idmedcionaux,
									user_id:		user_id
								},
								success: function(dato)
								{ 
								
								
									
									$('#tablapambientalesedit').bootstrapTable("removeAll");	
									//$('#tablapambientalesotrosedit').bootstrapTable("removeAll");
									if(dato != 0){
										var datos = dato;//JSON.parse(dato);
										$('#tablapambientalesedit').bootstrapTable("load", datos['PAmbientales']);
										
										//Cargar pamb
										var pambedit = $('#tablapambientalesotrosedit').bootstrapTable('getData');
										for(var i = 0; i < pambedit.length; i++){
											for(var x = 0; x < datos['PAmbientalesotros'].length; x++){
												if(pambedit[i].IDpambientales == datos['PAmbientalesotros'][x]['IDpambientales']){
													document.getElementById("pamboedit".concat(i)).value =  datos['PAmbientalesotros'][x]['Medicion_1'];
													document.getElementById("pamboedit".concat(i)).name =  datos['PAmbientalesotros'][x]['IDmedicionpambientales'];
													break;
												}
												
											}
													//Guarda ID Mortalidad
													/*if($('#tablapambientalesotros').bootstrapTable('getData')[i].Nombre == "Mortalidad por FAN"){idmortalidad = $('#tablapambientalesotros').bootstrapTable('getData')[i].IDpambientales;}
													idpambo[k] = pambedit[i].IDpambientales;	
													pambo0[k] = document.getElementById("pambo".concat(i)).value;	
													k++;
												}
											}*/
										}
									}else{swal("Error", "Error al cargar el reporte.", "error");}
								}               
							});
						editvaluefan = [];
						editvaluepamb = [];
						document.getElementById("inputeditarchivo").value = "";
						$('#myModaleditreporte').modal({backdrop: 'static', keyboard: false}); 	
						$('#myModaleditreporte').modal('show');
					}else{ swal("", "No se puede editar un registro declarado", "warning");};
				}else{ swal("", "S??lo se puede editar un registro guardado (no enviado)", "warning");};
			
			//}else{ swal("", "No se puede editar un registro anterior", "warning");};
	};
	
	//If close modal until save data
	$('#closeeditup, #closeedit').click(function(){
			swal({
				  title: "Salir sin guardar?",
				  text: "??Esta seguro que desea salir sin guardar las modificaciones?",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Si, Salir!",
				  cancelButtonText: "Cancelar",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
					      $('#myModaleditreporte').modal('hide');       
				
			  	  } else {}
			});
	});
	
	function eliminar_doc(id){
		var msg1 = "Eliminar";
		var msg2 = "??Est?? seguro que desea eliminar el archivo?";
		swal({
				  title: msg1,
				  text: msg2,
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Si, Eliminar",
				  cancelButtonText: "No",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
						$.ajax({
								type: "POST",
								url: '{{ url("ingreso-editor/eliminar_archivo") }}',
								data: {_token: '{{ csrf_token() }}', id: id },
								success: function( msg ) {
									//loadequipo();
									if(msg.status = 'success'){
										$('.eliminar_doc_'+id).remove();	
									}
									
								}
						});
				  }
				}
		)
	}
	
	
	
	//Editar registro y preguntar si enviar correo notificaci??n
	function editregistrocorreo(guardar){
		if(role == "admin_fan_empresa"){
			swal({
				  title: "Env??ar notificaciones?",
				  text: "??Desea enviar notificaciones autom??ticas?",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Si",
				  cancelButtonText: "No",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
					  editregistro(guardar,1);
			  	  } else {
					  editregistro(guardar,0);
				  }
				  
			});
		}else{editregistro(guardar,1);}
	};
	
	function editregistro(guardar,notificar){
		/*var idpamboedit = [""];
		var pamboedit0 = [""];
		var idmortalidadedit = "";
		var k = 0;*/
		var mortalidadedit = "";
		var editvaluepamboedit = Array();
		var datostabla = $('#tablapambientalesotrosedit').bootstrapTable('getData');
		
		for(var i = 0; i < datostabla.length; i++){
				if(document.getElementById("pamboedit".concat(i))){
					//Guarda ID Mortalidad
					if(datostabla[i].Nombre == "Mortalidad por FAN"){mortalidadedit = document.getElementById("pamboedit".concat(i)).value;}
					editvaluepamboedit.push({
						"Valor": document.getElementById("pamboedit".concat(i)).value, 
						"IDmedicionpambientales": document.getElementById("pamboedit".concat(i)).name, 
						"IDpambientales": datostabla[i].IDpambientales
					});
					
					/*idpamboedit[k] = datostabla[i].IDpambientales;	
					pamboedit0[k] = document.getElementById("pamboedit".concat(i)).value;	
					k++;*/
				}
		}
				
		var IDmedicion = $('#idmedicioneditreporte').val(); 
		var IDcentro = $('#idcentroeditreporte').val();
		var obsedit = document.getElementById("obseditreporte").value;
		var fechaedit = document.getElementById("fechaeditreporte").value;
		var timeedit = document.getElementById("timeeditreporte").value;
		var fechaeditanalisis = document.getElementById("fechaeditanalisis").value;
		var timeeditanalisis = document.getElementById("timeeditanalisis").value;
		
		if(fechaedit != "" && timeedit != "" && fechaeditanalisis != "" && timeeditanalisis != ""){
					 
			fechaedit = fechaedit.concat(" ").concat(timeedit);
			fechaeditanalisis = fechaeditanalisis.concat(" ").concat(timeeditanalisis);
			
			$('#modalloading').modal({backdrop: 'static', keyboard: false});		  
			$.ajax({
				url: '{{ url("/ingreso-editor/save_edit_reporte") }}',
				type: 'post',
				data: {
					_token: "{{ csrf_token() }}",
					IDmedicion: IDmedicion, 
					Nuevas_Observaciones: obsedit, 
					Nueva_Fecha_Reporte: fechaedit,
					Nueva_Fecha_Analisis: fechaeditanalisis, 
					Edit_Fan: editvaluefan, 
					Edit_Pamb: editvaluepamb,
					Edit_Pambo: 	  editvaluepamboedit,
				 	Mortalidad:	mortalidadedit,
					user_id: user_id,Estado: guardar, IDcentro: IDcentro},
				success: function(msg)
				{ 
					
					//msg = JSON.parse(msg);
					
					if(msg['Error'] == 0){	
						var form1_edit_archivos = document.getElementsByClassName('form1_edit_archivos')[0];
						var form_data = new FormData( form1_edit_archivos );
						var fp = $(form1_edit_archivos["inputeditarchivo"]);
						var lg = fp[0].files.length; 
						var fechamedicion = fechaedit;
						
						if (lg > 0 ){           
							//form_data.append('file', file_name);
							form_data.append('IDmedicion', IDmedicion);
							//form_data.append('Imagen', document.getElementById("inputeditarchivo").value);
							//form_data.append('user_id', user_id);
							
							
							if(notificar == 0){msg['Alarma'] = "";}
							savearchivo(form_data,msg['Alarma'],msg['Comentario'],msg['Concentracion'],msg['Nocivo'],msg['Nocivo_P'],msg['Comentario_Precaucion'],msg['Concentracion_Precaucion'],msg['Mortalidad'],IDcentro,msg['Nombre_Centro'],fechamedicion,IDmedicion,guardar);
							
						}else{
							if(guardar == 1){
								if(msg['Alarma'] != "" && notificar == 1){
									sendalarma(msg['Alarma'],msg['Comentario'],msg['Concentracion'],msg['Nocivo'],msg['Nocivo_P'],msg['Comentario_Precaucion'],msg['Concentracion_Precaucion'],msg['Mortalidad'],IDcentro,msg['Nombre_Centro'],fechamedicion,IDmedicion);
								}else{
									dataTables.bootstrapTable('refresh');
									$('#myModaleditreporte').modal('hide');
									swal("", "Registro enviado con ??xito!", "success");
									verregistroenviado(IDmedicion);
								}
								//swal("Enviado", "Registro enviado con ??xito", "success"); 
							}else{
								dataTables.bootstrapTable('refresh');
								$('#myModaleditreporte').modal('hide');
							}
						}
					}else{
						swal("Error", "Error al modificar el reporte", "error");
					}
					
				}               
			});
		}else{alert("Debe indicar la fecha de la toma de muestra y su an??lisis")}
		
	};
	
	$('#trash').click(function()
	{
		var selects = "";
		selects = dataTables.bootstrapTable('getSelections')[0];
		//if(dataTables.bootstrapTable('getSelections')[0].Date_Reporte == moment().format("DD-MM-YYYY")){
			if(selects){
				if(selects.Estado == 'No' || role == "admin_fan_empresa"){
						
						
							swal({
								  title: "Estas Seguro?",
								  text: "??Esta seguro que desea eliminar el reporte?",
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: "#DD6B55",
								  confirmButtonText: "Si, Eliminar!",
								  cancelButtonText: "No, Cancelar!",
								  closeOnConfirm: true,
								  closeOnCancel: true
								},
								function(isConfirm){
								  if (isConfirm) {
									$('#modalloading').modal({backdrop: 'static', keyboard: false});
									$.ajax({
									url: '{{ url("/ingreso-editor/delete") }}',
									type: 'post',
									data: {_token: "{{ csrf_token() }}",IDmedicion: selects.IDmedicion},
									success: function(msg)
									{ 
										if(msg == 0){	
											swal("Eliminado", "El reporte ha sido eliminada", "success"); 
											dataTables.bootstrapTable('refresh');
										}else{
											swal("Error", "Error al eliminar el reporte", "error");
										}
										
									}               
								});
							  } else {
								//swal("Cancelado", "", "error");
							  }
							});
						
					
				}else{ swal("", "No se puede eliminar un registro enviado", "warning");};
			}
		//}else{ swal("", "No se puede eliminar un registro anterior", "warning");};
	});
	
	
	$( "#abrirmodalreporte" ).click( function(){
		//alert("En este momento se est?? realizando una actualizaci??n del sistema. Por favor, reintente m??s tarde.");
		var nombre = '';
		var estado = 0; 
		$.each(listacentros,function(){
			if(this.IDcentro == $("#opcionescentros").val()){
				estado = this.Estado;
				return false;	
			}
		})
		if(estado == 1){
			samegrupo2 = 0;
				res2 = 0;
				n2 = 0;
				rowsp2 = [];
				indx2 = [];
				samegrupo1 = 0;
				res1 = 0;
				n1 = 0;
				rowsp1 = [];
				indx1 = [];
			$('#tabladiatomeas').bootstrapTable('refresh');
			$('#tabladinoflagelados').bootstrapTable('refresh');
			$('#tablaoespecies').bootstrapTable('refresh');
			$('#tablapambientales').bootstrapTable('refresh');
			$('#tablapambientalesotros').bootstrapTable('refresh');
			$('#myModalreporte').modal('show');
		}else{
			swal("", nombre + " se ecuentra deshabilitado para cargar registros. Por favor contacte a su administrador", "warning");	
		}
	});
	
	
	$( "#tecnicareporte").click(function(){
		if(document.getElementById("tecnicareporte").value == "Otra"){
			$( "#otratecnica").removeClass('hidden');
		}else{
			$( "#otratecnica").addClass('hidden');
		}
		
	});
	
	moment.locale('en', {
	  week: { dow: 1 } // Monday is the first day of the week
	});
	var date = new Date();
	date.setDate(date.getDate());
	$('#datetimepickerreporte').datetimepicker({
    format: 'DD-MM-YYYY',
	defaultDate: date,
	maxDate: date
	});
	
	$('#timepickerreporte').datetimepicker({
    format: 'HH:mm',
	defaultDate: date,
	//maxDate: date
	});
	
	$('#datetimepickeranalisis').datetimepicker({
    format: 'DD-MM-YYYY',
	defaultDate: date,
	maxDate: date
	});
	
	$('#timepickeranalisis').datetimepicker({
    format: 'HH:mm',
	defaultDate: date,
	//maxDate: date
	});
	
	
	$('#datetimepickereditreporte').datetimepicker({
    format: 'DD-MM-YYYY',
	maxDate: date//daysOfWeekDisabled: [0, 6]
	
	});
	$('#timepickereditreporte').datetimepicker({
    format: 'HH:mm',
	//maxDate: date//daysOfWeekDisabled: [0, 6]
	
	});
	
	$('#datetimepickereditanalisis').datetimepicker({
    format: 'DD-MM-YYYY',
	maxDate: date//daysOfWeekDisabled: [0, 6]
	
	});
	
	$('#timepickereditanalisis').datetimepicker({
    format: 'HH:mm',
	//maxDate: date//daysOfWeekDisabled: [0, 6]
	
	});
	
	
	function existefechamuestreo(){
		if($('#fechareporte').val() != "" && $('#timereporte').val() != "" && $('#fechaanalisis').val() != "" && $('#timeanalisis').val() != ""){
			$.ajax({
					url: '{{ url("/ingreso-editor/existefechamuestreo") }}',
					type: 'post',
					data: {
						_token: "{{ csrf_token() }}",
						IDcentro: $("#opcionescentros").val(),
						Fecha_Muestreo: $('#fechareporte').val(),
						Hora_Muestreo: $('#timereporte').val(),
					},
					success: function(msg)
					{ 
						
						if(msg == 0){	
							enviarreporte();
						}else{
							swal({
								  title: "Existe",
								  text: "Un registros con la misma fecha y hora ya existe. ??Desea enviar de todas formas?",
								  type: "warning",
								  showCancelButton: true,
								  confirmButtonColor: "#DD6B55",
								  confirmButtonText: "Si, Enviar Registro",
								  cancelButtonText: "No",
								  closeOnConfirm: true,
								  closeOnCancel: true
								},
								function(isConfirm){
								  if (isConfirm) {
										buscardatosreporte(1);   
								  } else {
									 // console.log("noo");
								  }
							});
						}
						
					} 
			});
		}else{alert("Debe indicar la fecha de la toma de muestra y su an??lisis")}   
		
	}
	
	$( "#enviarreporte").click(function(){
		if( !$( "#firma_nombre").val()){alert('Debe completar nombre y apellido en campo "Firma"'); return ;}
		existefechamuestreo();
	});
	
	function enviarreporte(){
		
			var alarma = "";
			if($( '[name="profundidad"]' ).hasClass( "label-yellow" ) ){alarma = "Amarilla";}
			if($( '[name="profundidad"]' ).hasClass( "label-red" ) ){alarma = "Roja";}
			var msg1 = "Enviar Registro";
			var msg2 = "??Est?? seguro que desea enviar el registro?";
			if(alarma != ""){
				msg1 = "Alarma "+alarma+" Activada";
				msg2 = "Se ha detectado que al menos una especie supera el l??mite alarma "+alarma+", ??desea enviar el registro?";
			}
			 
			swal({
					  title: msg1,
					  text: msg2,
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "Si, Enviar Registro",
					  cancelButtonText: "No",
					  closeOnConfirm: true,
					  closeOnCancel: true
					},
					function(isConfirm){
					  if (isConfirm) {
							buscardatosreporte(1);   
					  } else {
						 // console.log("noo");
					  }
				});
		
	};
	
	
	function buscardatosreporte(guardar){	
		var empty = "";
		var diato = 0;
		var dino = 0;
		var oesp = 0;
		var pamb = 0;
		$('#Diatomeas-form input:empty').each(function(i){
			if( !this.value && diato == 0) {
				empty = empty.concat("Diatomeas").concat(", ");
				diato = 1;
			}
		});
		$('#Dinoflagelados-form input:empty' ).each(function(){
			if( !this.value && dino == 0 ) {
				empty = empty.concat("Dinoflagelados").concat(", ");
				dino = 1;
			}
		});
		$('#OEspecies-form input:empty' ).each(function(){
			if( !this.value && oesp == 0) {
				empty = empty.concat("Otras Especies").concat(", ");
				oesp = 1;
			}
		});
		$('#PAmbientales-form input:empty' ).each(function(){
			if( !this.value && pamb == 0) {
				empty = empty.concat("Par??metros Ambientales").concat(", ");
				pamb = 1;
			}
		});
		$('#PAmbientalesotros-form input:empty' ).each(function(){
			if( !this.value && pamb == 0) {
				empty = empty.concat("Par??metros Ambientales").concat(", ");
				pamb = 1;
			}
		});
		
		if(empty != ""){
			var iddiato = [""];
			var diato0 = [""];
			var diato1 = [""];
			var diato2 = [""];
			var diato3 = [""];
			var diato4 = [""];
			var diato5 = [""];
			var diato6 = [""];
			var iddino = [""];
			var dino0 = [""];
			var dino1 = [""];
			var dino2 = [""];
			var dino3 = [""];
			var dino4 = [""];
			var dino5 = [""];
			var dino6 = [""];
			var idoesp = [""];
			var oesp0 = [""];
			var oesp1 = [""];
			var oesp2 = [""];
			var oesp3 = [""];
			var oesp4 = [""];
			var oesp5 = [""];
			var oesp6 = [""];
			var idpamb = [""];
			var pamb0 = [""];
			var pamb1 = [""];
			var pamb2 = [""];
			var pamb3 = [""];
			var pamb4 = [""];
			var pamb5 = [""];
			var pamb6 = [""];
			var idpambo = [""];
			var pambo0 = [""];
			var idmortalidad = "";
			var tecnica = document.getElementById("tecnicareporte").value;
			if(tecnica == "Otra"){
				tecnica = document.getElementById("tecnicareporteotra").value;
			}
			var k = 0;
			for(var i = 0; i < $('#tabladiatomeas').bootstrapTable('getData').length; i++){
				var entro = 0;
					
				if(document.getElementById("diato0".concat(i))){
					if(document.getElementById("diato0".concat(i)).value){
						diato0[k] = document.getElementById("diato0".concat(i)).value;
						entro = 1;
					}
				}
			
				if(document.getElementById("diato1".concat(i))){
					if(document.getElementById("diato1".concat(i)).value){
						diato1[k] = document.getElementById("diato1".concat(i)).value;
						entro = 1;
					}
				}
			
				if(document.getElementById("diato2".concat(i))){
					if(document.getElementById("diato2".concat(i)).value){
						diato2[k] = document.getElementById("diato2".concat(i)).value;
						entro = 1;
					}
				}
				
				if(document.getElementById("diato3".concat(i))){
					if(document.getElementById("diato3".concat(i)).value){
						diato3[k] = document.getElementById("diato3".concat(i)).value;
						entro = 1;
					}
				}
				
				if(document.getElementById("diato4".concat(i))){
					if(document.getElementById("diato4".concat(i)).value){
						diato4[k] = document.getElementById("diato4".concat(i)).value;
						entro = 1;
					}
				}
				
				if(document.getElementById("diato5".concat(i))){
					if(document.getElementById("diato5".concat(i)).value){
						diato5[k] = document.getElementById("diato5".concat(i)).value;
						entro = 1;
					}
				}
				
				if(document.getElementById("diato6".concat(i))){
					if(document.getElementById("diato6".concat(i)).value){
						diato6[k] = document.getElementById("diato6".concat(i)).value;
						entro = 1;
					}
				}
					
				if(entro == 1){
					iddiato[k] = $('#tabladiatomeas').bootstrapTable('getData')[i].IDespecie;
					if(!diato0[k]){
						diato0[k] = "";
					}
					if(!diato1[k]){
						diato1[k] = "";
					}
					if(!diato2[k]){
						diato2[k] = "";
					}
					if(!diato3[k]){
						diato3[k] = "";
					}
					if(!diato4[k]){
						diato4[k] = "";
					}
					if(!diato5[k]){
						diato5[k] = "";
					}
					if(!diato6[k]){
						diato6[k] = "";
					}
					k++;	
					entro = 0;
				}
			}
			//Dinoflagelados
			k = 0;
			for(var i = 0; i < $('#tabladinoflagelados').bootstrapTable('getData').length; i++){
				var entro = 0;
				
				if(document.getElementById("dino0".concat(i))){
					if(document.getElementById("dino0".concat(i)).value){
						dino0[k] = document.getElementById("dino0".concat(i)).value;
						entro = 1;
					}
				}
				
				if(document.getElementById("dino1".concat(i))){
					if(document.getElementById("dino1".concat(i)).value){
						dino1[k] = document.getElementById("dino1".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("dino2".concat(i))){
					if(document.getElementById("dino2".concat(i)).value){
						dino2[k] = document.getElementById("dino2".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("dino3".concat(i))){
					if(document.getElementById("dino3".concat(i)).value){
						dino3[k] = document.getElementById("dino3".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("dino4".concat(i))){
					if(document.getElementById("dino4".concat(i)).value){
						dino4[k] = document.getElementById("dino4".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("dino5".concat(i))){
					if(document.getElementById("dino5".concat(i)).value){
						dino5[k] = document.getElementById("dino5".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("dino6".concat(i))){
					if(document.getElementById("dino6".concat(i)).value){
						dino6[k] = document.getElementById("dino6".concat(i)).value;
						entro = 1;
					}
				}
				
						
				if(entro == 1){
					iddino[k] = $('#tabladinoflagelados').bootstrapTable('getData')[i].IDespecie;
					
					if(!dino0[k]){
						dino0[k] = "";
					}
					if(!dino1[k]){
						dino1[k] = "";
					}
					if(!dino2[k]){
						dino2[k] = "";
					}
					if(!dino3[k]){
						dino3[k] = "";
					}
					if(!dino4[k]){
						dino4[k] = "";
					}
					if(!dino5[k]){
						dino5[k] = "";
					}
					if(!dino6[k]){
						dino6[k] = "";
					}
					k++;	
					entro = 0;
				}
			}
			
			//Otras Especies
			k = 0;
			for(var i = 0; i < $('#tablaoespecies').bootstrapTable('getData').length; i++){
				var entro = 0;
				if(document.getElementById("oesp0".concat(i))){
					if(document.getElementById("oesp0".concat(i)).value){
						oesp0[k] = document.getElementById("oesp0".concat(i)).value;
						entro = 1;	
					}
				}
				if(document.getElementById("oesp1".concat(i))){
					if(document.getElementById("oesp1".concat(i)).value){
						oesp1[k] = document.getElementById("oesp1".concat(i)).value;	
						entro = 1;
					}
				}
				if(document.getElementById("oesp2".concat(i))){
					if(document.getElementById("oesp2".concat(i)).value){
						oesp2[k] = document.getElementById("oesp2".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("oesp3".concat(i))){
					if(document.getElementById("oesp3".concat(i)).value){
						oesp3[k] = document.getElementById("oesp3".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("oesp4".concat(i))){
					if(document.getElementById("oesp4".concat(i)).value){
						oesp4[k] = document.getElementById("oesp4".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("oesp5".concat(i))){
					if(document.getElementById("oesp5".concat(i)).value){
						oesp5[k] = document.getElementById("oesp5".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("oesp6".concat(i))){
					if(document.getElementById("oesp6".concat(i)).value){
						oesp6[k] = document.getElementById("oesp6".concat(i)).value;
						entro = 1;
					}
				}
						
				
				if(entro == 1){
						idoesp[k] = $('#tablaoespecies').bootstrapTable('getData')[i].IDespecie;
						if(!oesp0[k]){
							oesp0[k] = "";
						}
						if(!oesp1[k]){
							oesp1[k] = "";
						}
						if(!oesp2[k]){
							oesp2[k] = "";
						}
						if(!oesp3[k]){
							oesp3[k] = "";
						}
						if(!oesp4[k]){
							oesp4[k] = "";
						}
						if(!oesp5[k]){
							oesp5[k] = "";
						}
						if(!oesp6[k]){
							oesp6[k] = "";
						}
						k++;	
						entro = 0;
					}
			}
			
			//Par??metros ambientales
			k = 0;
			for(var i = 0; i < $('#tablapambientales').bootstrapTable('getData').length; i++){
				var entro = 0;
				
				if(document.getElementById("pamb0".concat(i))){
					if(document.getElementById("pamb0".concat(i)).value){
						pamb0[k] = document.getElementById("pamb0".concat(i)).value;
						entro = 1;
					}
				}
				if(document.getElementById("pamb1".concat(i))){
					if(document.getElementById("pamb1".concat(i)).value){
						pamb1[k] = document.getElementById("pamb1".concat(i)).value;	
						entro = 1;
					}
				}
				if(document.getElementById("pamb2".concat(i))){
					if(document.getElementById("pamb2".concat(i)).value){
						pamb2[k] = document.getElementById("pamb2".concat(i)).value;
						entro = 1;	
					}
				}
				if(document.getElementById("pamb3".concat(i))){
					if(document.getElementById("pamb3".concat(i)).value){
						pamb3[k] = document.getElementById("pamb3".concat(i)).value;
						entro = 1;	
					}
				}
				if(document.getElementById("pamb4".concat(i))){
					if(document.getElementById("pamb4".concat(i)).value){
						pamb4[k] = document.getElementById("pamb4".concat(i)).value;
						entro = 1;	
					}
				}
				if(document.getElementById("pamb5".concat(i))){
					if(document.getElementById("pamb5".concat(i)).value){
						pamb5[k] = document.getElementById("pamb5".concat(i)).value;
						entro = 1;	
					}
				}
				if(document.getElementById("pamb6".concat(i))){
					if(document.getElementById("pamb6".concat(i)).value){
						pamb6[k] = document.getElementById("pamb6".concat(i)).value;
						entro = 1;	
					}
				}
				
				if(entro == 1){
					idpamb[k] = $('#tablapambientales').bootstrapTable('getData')[i].IDpambientales;
					if(!pamb0[k]){
						pamb0[k] = "";
					}
					if(!pamb1[k]){
						pamb1[k] = "";
					}
					if(!pamb2[k]){
						pamb2[k] = "";
					}
					if(!pamb3[k]){
						pamb3[k] = "";
					}
					if(!pamb4[k]){
						pamb4[k] = "";
					}
					if(!pamb5[k]){
						pamb5[k] = "";
					}
					if(!pamb6[k]){
						pamb6[k] = "";
					}
					k++;	
					entro = 0;
				}
			}
			
			for(var i = 0; i < $('#tablapambientalesotros').bootstrapTable('getData').length; i++){
				if(document.getElementById("pambo".concat(i))){
					if(document.getElementById("pambo".concat(i)).value){
						//Guarda ID Mortalidad
						if($('#tablapambientalesotros').bootstrapTable('getData')[i].Nombre == "Mortalidad por FAN"){idmortalidad = $('#tablapambientalesotros').bootstrapTable('getData')[i].IDpambientales;}
						idpambo[k] = $('#tablapambientalesotros').bootstrapTable('getData')[i].IDpambientales;	
						pambo0[k] = document.getElementById("pambo".concat(i)).value;	
						k++;
					}
				}
			}
			var fechamedicion = document.getElementById("fechareporte").value;
			var timemedicion = document.getElementById("timereporte").value;
			fechamedicion = fechamedicion.concat(" ").concat(timemedicion);
			var fechaanalisis = document.getElementById("fechaanalisis").value;
			var timeanalisis = document.getElementById("timeanalisis").value;
			fechaanalisis = fechaanalisis.concat(" ").concat(timeanalisis);
			
			guardarreporte(tecnica,iddiato,diato0,diato1,diato2,diato3,diato4,diato5,diato6,iddino,dino0,dino1,dino2,dino3,dino4,dino5,dino6,idoesp,oesp0,oesp1,oesp2,oesp3,oesp4,oesp5,oesp6,idpamb,pamb0,pamb1,pamb2,pamb3,pamb4,pamb5,pamb6,idpambo,pambo0,idmortalidad,fechamedicion,fechaanalisis,guardar)
			
		}else{empty = empty.replace(/, $/, ''); swal("", "Existen campos vacios en pesta??a: "+empty, "warning");};		
	};
	
	
	function guardarreporte(tecnica,iddiato,diato0,diato1,diato2,diato3,diato4,diato5,diato6,iddino,dino0,dino1,dino2,dino3,dino4,dino5,dino6,idoesp,oesp0,oesp1,oesp2,oesp3,oesp4,oesp5,oesp6,idpamb,pamb0,pamb1,pamb2,pamb3,pamb4,pamb5,pamb6,idpambo,pambo0,idmortalidad,fechamedicion,fechaanalisis,guardar){
		
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
				url: '{{ url("ingreso-editor/save_registro") }}',
				type: 'post',
				data: {
				 _token: "{{ csrf_token() }}",
				 Tecnica: 	   						tecnica,
				 IDdiatomeas: 				  		iddiato,
				 Medicion0_Diatomeas: 			 	diato0,
				 Medicion1_Diatomeas: 				diato1,
				 Medicion2_Diatomeas: 				diato2,
				 Medicion3_Diatomeas: 				diato3,
				 Medicion4_Diatomeas: 				diato4,
				 Medicion5_Diatomeas: 				diato5,
				 Medicion6_Diatomeas: 				diato6,
				 IDdinoflagelados: 				   iddino,
				 Medicion0_Dinoflagelados: 		   dino0,
				 Medicion1_Dinoflagelados: 		   dino1,
				 Medicion2_Dinoflagelados: 		   dino2,
				 Medicion3_Dinoflagelados: 		   dino3,
				 Medicion4_Dinoflagelados: 		   dino4,
				 Medicion5_Dinoflagelados: 		   dino5,
				 Medicion6_Dinoflagelados: 		   dino6,
				 IDoespecies: 				  		idoesp,
				 Medicion0_oespecies: 			 	oesp0,
				 Medicion1_oespecies: 				oesp1,
				 Medicion2_oespecies: 				oesp2,
				 Medicion3_oespecies: 				oesp3,
				 Medicion4_oespecies: 				oesp4,
				 Medicion5_oespecies: 				oesp5,
				 Medicion6_oespecies: 				oesp6,
				 IDpambientales: 				  	 idpamb,
				 Medicion0_pambientales: 			 pamb0,
				 Medicion1_pambientales: 			 pamb1,
				 Medicion2_pambientales: 			 pamb2,
				 Medicion3_pambientales: 			 pamb3,
				 Medicion4_pambientales: 			 pamb4,
				 Medicion5_pambientales: 			 pamb5,
				 Medicion6_pambientales: 			 pamb6,
				 IDpambientalesotros: 				idpambo,
				 Medicion0_pambientalesotros: 		pambo0,
				 IDmortalidad:					   idmortalidad,
				 Observaciones:					  document.getElementById("obsreporte").value,
				 Fecha_Medicion:					 fechamedicion,
				 Fecha_Analisis:					 fechaanalisis,
				 Firma:							  $('#firma_nombre').val(),
				 Laboratorio:						$('#firmareporte option:selected').text()=="Laboratorio" ? 1:0,
				 IDcentro:						   $("#opcionescentros").val(),
				 Estado:							guardar
				},
				success: function(msg)
				{
					
					//msg = JSON.parse(msg);
					if(msg['Error'] == 0){
						//var form_data = new FormData();  
						//var file_name = $('#inputarchivo').prop('files')[0];   
						var form1_archivo = document.getElementsByClassName('form1_archivos')[0];
						var form_data = new FormData( form1_archivo );
						var fp = $(form1_archivo["inputarchivo"]);
						var lg = fp[0].files.length;
						if (lg > 0 ){         
							//form_data.append('file', file_name);
							form_data.append('IDmedicion', msg['IDmedicion']);
							//form_data.append('Imagen', document.getElementById("inputarchivo").value);
							//form_data.append('user_id', user_id);
							
							savearchivo(form_data,msg['Alarma'],msg['Comentario'],msg['Concentracion'],msg['Nocivo'],msg['Nocivo_P'],msg['Comentario_Precaucion'],msg['Concentracion_Precaucion'],msg['Mortalidad'],msg['IDcentro'],msg['Nombre_Centro'],fechamedicion,msg['IDmedicion'],guardar);
						} else {
							
							if(guardar == 1){
								if(msg['Alarma'] != ""){
									sendalarma(msg['Alarma'],msg['Comentario'],msg['Concentracion'],msg['Nocivo'],msg['Nocivo_P'],msg['Comentario_Precaucion'],msg['Concentracion_Precaucion'],msg['Mortalidad'],msg['IDcentro'],msg['Nombre_Centro'],fechamedicion,msg['IDmedicion']);
								}else{
									dataTables.bootstrapTable('refresh');
									$('#myModalreporte').modal('hide');
									swal("", "Registro enviado con ??xito!", "success");
									verregistroenviado(msg['IDmedicion']);
								}
							}else{
									dataTables.bootstrapTable('refresh');
									$('#myModalreporte').modal('hide');
							}
						
						}
						
					}else{
						dataTables.bootstrapTable('refresh');
						$('#myModalreporte').modal('hide');
						swal("Error", "Error al enviar el reporte!", "error");
					}
					
					
				}, error: function(msg)
				{console.log(msg);   
				}
			});	
	}
	
	function savearchivo(form_data,Alarma,Comentario,Concentracion,Nocivo,Nocivo_P,Comentario_Precaucion,Concentracion_Precaucion,Mortalidad,IDcentro,Nombre_Centro,fechamedicion,idmed,guardar){
		
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
				url: '{{ url("/ingreso-editor/save_archivo_registro") }}',
				dataType: 'text', 
				cache: false,
				contentType: false,
				processData: false,
				type: 'post',
				data: form_data,
				success: function(msg)
				{  
					
					if(msg == 0){
						if(guardar == 1){
							//if(edit == 1){
//									swal("Modificado", "El reporte ha sido modificado", "success"); 
//									dataTables.bootstrapTable('refresh');
//									$('#myModaleditreporte').modal('hide');  
//							}else{
								if(Alarma != ""){
									sendalarma(Alarma,Comentario,Concentracion,Nocivo,Nocivo_P,Comentario_Precaucion,Concentracion_Precaucion,Mortalidad,IDcentro,Nombre_Centro,fechamedicion,idmed);
								}else{
									dataTables.bootstrapTable('refresh');
									$('#myModalreporte').modal('hide');
									$('#myModaleditreporte').modal('hide');
									swal("", "Registro enviado con ??xito!", "success");
									verregistroenviado(idmed);
								}
							//}
						}else{
								dataTables.bootstrapTable('refresh');
								$('#myModalreporte').modal('hide');
								$('#myModaleditreporte').modal('hide');
						}

					}else{
						swal("Error", "Error al guardar el archivo, por favor reintente modificando el registro", "error");
						if(msg['Alarma'] != ""){
							sendalarma(Alarma,Comentario,Concentracion,Nocivo,Nocivo_P,Comentario_Precaucion,Concentracion_Precaucion,Mortalidad,IDcentro,Nombre_Centro,fechamedicion,idmed);
						}else{
							dataTables.bootstrapTable('refresh');
							$('#myModalreporte').modal('hide');
							$('#myModaleditreporte').modal('hide');
							swal("", "Registro enviado con ??xito!", "success");
							verregistroenviado(idmed);
						}
						
					}
					
				
				}               
			});
	}
	
	function sendalarma(Alarma,Comentario,Concentracion,Nocivo,Nocivo_P,Comentario_Precaucion,Concentracion_Precaucion,Mortalidad,IDcentro,Nombre_Centro,fechamedicion,idmed){
			//Agregar destinatarios
			//dataTables.bootstrapTable('refresh');
//			$('#myModalreporte').modal('hide');
//			swal("", "Registro enviado con ??xito!", "success");
			
			//$.ajax({
//				url: "movil/Notificaciones_test.php",
//				type: 'post',
//				data: {
//				 Alarma:	 Alarma,
//				 IDcentro:   IDcentro,
//				 user_id:	user_id
//				},
//				success: function()
//				{	
//					
//				}
//			});
//			
			
				$('#loadingtext').html("Enviando notificaciones autom??ticas... <br><br> Por favor espere");
				$('#modalloading').modal({backdrop: 'static', keyboard: false});
				$.ajax({
					url: '{{ url("/ingreso-editor/destinatarios_alarma") }}',
					type: 'post',
					data: {
					 _token: "{{ csrf_token() }}",
					 Alarma:	 Alarma,
					 IDcentro:   IDcentro,
					 user_id:	user_id
					},
					success: function(msg)
					{	
						
						var msg2 = msg;//JSON.parse(msg);
						var fechaaux = fechamedicion.split(" ");
						var dia = fechaaux[0];
						var hora = fechaaux[1];
						if(msg2['Error'] == 0 && msg2['Destinatarios'].length > 0){
							$.ajax({
								url: '{{ url("/ingreso-editor/send_alarma") }}',
								type: 'post',
								data: {
								 _token: "{{ csrf_token() }}",
								 Alarma:	 		Alarma,
								 Comentario:		Comentario,
								 Comentario_Precaucion:		Comentario_Precaucion,
								 Concentracion:     Concentracion,
								 Concentracion_Precaucion:     Concentracion_Precaucion,
								 Nocivo:			Nocivo,
								 Nocivo_P:		  Nocivo_P,
								 Mortalidad:		Mortalidad,
								 Dia:	 		   dia,
								 Hora:	 		  hora,
								 Firma:			 $('#firma_nombre').val(),
								 Destinatarios: 	 msg2['Destinatarios'],
								 Nombre_Centro:	 Nombre_Centro,
								 IDcentro:	 	  IDcentro,
								 idmed:			 parseInt(idmed),
								 user_id:		   parseInt(user_id)
								},
								success: function(msg)
								{
									
									if(msg == 0){
										swal("Registro enviado con ??xito! ", "Se han enviado notificaciones autom??ticas a lista de contactos pre-establecidos." , "success");
										// a: \n\n "+msg2['Nombres_Destinatarios']
									}else{
										swal("", "Registro enviado con ??xito! \n\n Se ha producido un Error al enviar notificaciones autom??ticas!", "success");
										
									}
									dataTables.bootstrapTable('refresh');
									$('#myModalreporte').modal('hide');
									$('#myModaleditreporte').modal('hide');
									$('#loadingtext').html(" Loading... Please Wait");
									verregistroenviado(idmed);
									
								}
							});	
						}else{
							dataTables.bootstrapTable('refresh');
							$('#myModalreporte').modal('hide');
							$('#myModaleditreporte').modal('hide');
							if(idmed == 0){swal("", "Registro cargado con ??xito", "success"); $('#editarreportever').addClass("hidden");}
							$('#loadingtext').html(" Loading... Please Wait");
							verregistroenviado(idmed);
							
						}
					},error: function(msg)
					{//console.log(msg);
					}
				});
	}
	
	var samegrupo0 = 0;
	var res0 = 0;
	var n0 = 0;
	var rowsp0 = [];
	var indx0 = [];
	function runningFormatterhistorialreporte(value, row, index) {
		
		var grupo = row['Date_Reporte'];
		
		if(samegrupo0 != grupo ){
			
			rowsp0[n0] = index-res0;
			indx0[n0] = index;
			n0++;
			res0 = index; 
			samegrupo0 = grupo;
			
		}
		rowsp0[n0] = index-res0+1;
		
		return index+1;
	}
	
	function formatearLaboratorio(value, row, index) {
		if(value == 1 ){
			return 'Externo';
			
		}else if(value == 0 ){
			return 'Interno';
			
		}else{
			return '-';	
		}
	}
	
   
	dataTables.on('post-body.bs.table', function () { 
		for(var i = 0; i<= indx0.length ; i++){
        	dataTables.bootstrapTable('mergeCells', {index: indx0[i], field: "Date_Reporte", colspan: 1, rowspan: rowsp0[i+1]});
		}
    });
	
	
	
	
	$(".tabledetalle").on('click-cell.bs.table', function (field, value, row, $element) {
		if($element['Imagen'] != "" && value == 1){
			$("#detalleimagen").attr("src",$element['Imagen']);
			$('#nombreespecieimagen').text($element['Nombre']);
			if($element['Alarma_Rojo'] > 0){
				$('#especienivelrojo').text($element['Alarma_Rojo']+" [cel/ml]");
			}else{$('#especienivelrojo').text("No definido");}
			if($element['Alarma_Amarillo'] > 0){
				$('#especienivelamarillo').text($element['Alarma_Amarillo']+" [cel/ml]");
			}else{$('#especienivelamarillo').text("No definido");}
			
			$('#descripcionespecieimagen').text($element['Detalle']);
			$('#myModaldetalleimagen').modal('show');
		}
	});
	
	
	//Dinoflagrlados
	function runningFormatterreporte(value, row, index) {
		return (index + 1);
	}
	function runningFormatterfoto(value, row, index) {
		var img = row['Imagen'];//GtrFan-MonitoreoAlgasNocivas_symbol.png;
		return '<img src="'+img+'" class="img-circle center-block"/>';
	}
	
	
	
	function runningFormatterdiatoprof0(value, row, index) {
		return '<input id="diato0'+index+'" class="form-control"  type="number" min="0" step="1" placeholder="" name = "profundidad">';
	}
	function runningFormatterdiatoprof1(value, row, index) {
		return '	<input id="diato1'+index+'" class="form-control" type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdiatoprof2(value, row, index) {
		return '	<input id="diato2'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdiatoprof3(value, row, index) {
		return '	<input id="diato3'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdiatoprof4(value, row, index) {
		return '	<input id="diato4'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdiatoprof5(value, row, index) {
		return '	<input id="diato5'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdiatoprof6(value, row, index) {
		return '	<input id="diato6'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	
	//Dinoflagrlados
	function runningFormatterdinoprof0(value, row, index) {
		return '	<input id="dino0'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdinoprof1(value, row, index) {
		return '	<input id="dino1'+index+'" class="form-control" type="number" min="0" placeholder="" name = "profundidad">';
	}
	
	function runningFormatterdinoprof2(value, row, index) {
		return '	<input id="dino2'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdinoprof3(value, row, index) {
		return '	<input id="dino3'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdinoprof4(value, row, index) {
		return '	<input id="dino4'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdinoprof5(value, row, index) {
		return '	<input id="dino5'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatterdinoprof6(value, row, index) {
		return '	<input id="dino6'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	
	//Otras especies
	function runningFormatteroespprof0(value, row, index) {
		return '	<input id="oesp0'+index+'" class="form-control has-error"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatteroespprof1(value, row, index) {
		return '	<input id="oesp1'+index+'" class="form-control" type="number" min="0" placeholder="" name = "profundidad">';
	}
	
	function runningFormatteroespprof2(value, row, index) {
		return '	<input id="oesp2'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatteroespprof3(value, row, index) {
		return '	<input id="oesp3'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatteroespprof4(value, row, index) {
		return '	<input id="oesp4'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatteroespprof5(value, row, index) {
		return '	<input id="oesp5'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	function runningFormatteroespprof6(value, row, index) {
		return '	<input id="oesp6'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
	}
	
	
	function runningFormatterpambprof0(value, row, index) {
		return '	<input id="pamb0'+index+'" class="form-control"  type="number" step=".1" min="0" name = "pambientales">';
	}
	function runningFormatterpambprof1(value, row, index) {
		return '	<input id="pamb1'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales">';
	}
	function runningFormatterpambprof2(value, row, index) {
		return '	<input id="pamb2'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales">';
	}
	function runningFormatterpambprof3(value, row, index) {
		return '	<input id="pamb3'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales">';
	}
	function runningFormatterpambprof4(value, row, index) {
		return '	<input id="pamb4'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales">';
	}
	function runningFormatterpambprof5(value, row, index) {
		return '	<input id="pamb5'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales">';
	}
	function runningFormatterpambprof6(value, row, index) {
		return '	<input id="pamb6'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales">';
	}
	
	
	function runningFormattermicionambientalesotros(value, row, index) {
		
		var opt = row['Opciones'];
		if(opt){
			opt = opt.split(",");
			if(opt[0] == "Formato-Numero"){
				return '	<input id="pambo'+index+'" class="form-control"   type="number" step="1" min="0"" >';
			}else if(opt[0] == "Formato-Numero-Decimal"){
				return '	<input id="pambo'+index+'" class="form-control"   type="number" step="0.1" min="0"" >';
			}else{
				var option = "";
				for(var i=0; i<opt.length ; i++){
					option = option.concat("<option>").concat(opt[i]).concat("</option>");
				}
				return '	<select id="pambo'+index+'" class="form-control">'+option+'</select>';
			}
		}else{
			return '	<input id="pambo'+index+'" class="form-control"  type="text" >';	
		}
	}
	
	function runningFormattermicionambientalesotrosedit(value, row, index) {
		
		var opt = row['Opciones'];
		if(opt){
			opt = opt.split(",");
			if(opt[0] == "Formato-Numero"){
				return '	<input id="pamboedit'+index+'" class="form-control"   type="number" step="1" min="0"" >';
			}else if(opt[0] == "Formato-Numero-Decimal"){
				return '	<input id="pamboedit'+index+'" class="form-control"   type="number" step="0.1" min="0"" >';
			}else{
				var option = "";
				for(var i=0; i<opt.length ; i++){
					option = option.concat("<option>").concat(opt[i]).concat("</option>");
				}
				return '	<select id="pamboedit'+index+'" class="form-control">'+option+'</select>';
			}
		}else{
			return '	<input id="pamboedit'+index+'" class="form-control"  type="text" >';	
		}
	}
	
	var samegrupo1 = 0;
	var res1 = 0;
	var n1 = 0;
	var rowsp1 = [];
	var indx1 = [];
	function runningFormatterambientales(value, row, index) {
		
		var grupo = row['Grupo'];
		
		if(samegrupo1 != grupo ){
			
			rowsp1[n1] = index-res1;
			indx1[n1] = index;
			n1++;
			res1 = index; 
			samegrupo1 = grupo;
			
		}
		rowsp1[n1] = index-res1+1;
		
		var aux = index - res1+1;
		return aux;
	}
	
   
	$('#tablapambientales').on('post-body.bs.table', function () { 
		for(var i = 0; i<= indx1.length ; i++){
        	$('#tablapambientales').bootstrapTable('mergeCells', {index: indx1[i], field: "Grupo", colspan: 1, rowspan: rowsp1[i+1]});
		}
    });
	$('#tablapambientalesver').on('post-body.bs.table', function () { 
		for(var i = 0; i<= indx1.length ; i++){
        	$('#tablapambientalesver').bootstrapTable('mergeCells', {index: indx1[i], field: "Grupo", colspan: 1, rowspan: rowsp1[i+1]});
		}
    });
	$('#tablapambientalesverprint').on('post-body.bs.table', function () { 
		for(var i = 0; i<= indx1.length ; i++){
        	$('#tablapambientalesverprint').bootstrapTable('mergeCells', {index: indx1[i], field: "Grupo", colspan: 1, rowspan: rowsp1[i+1]});
		}
    });
	$('#tablapambientalesedit').on('post-body.bs.table', function () { 
		for(var i = 0; i<= indx1.length ; i++){
        	$('#tablapambientalesedit').bootstrapTable('mergeCells', {index: indx1[i], field: "Grupo", colspan: 1, rowspan: rowsp1[i+1]});
		}
    });
	
	
	
	
	
	var samegrupo2 = 0;
	var res2 = 0;
	var n2 = 0;
	var rowsp2 = [];
	var indx2 = [];
	function runningFormatterambientalesotros(value, row, index) {
		
		var grupo = row['Grupo'];
		
		if(samegrupo2 != grupo ){
			
			rowsp2[n2] = index-res2;
			indx2[n2] = index;
			n2++;
			res2 = index; 
			samegrupo2 = grupo;
			
		}
		rowsp2[n2] = index-res2+1;
		
		var aux = index - res2+1;
		return aux;
	}
	
   
	$('#tablapambientalesotros').on('post-body.bs.table', function () { 
		for(var i = 0; i<= indx2.length ; i++){
        	$('#tablapambientalesotros').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
		}
    });
	$('#tablapambientalesotrosver').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx2.length ; i++){
			$('#tablapambientalesotrosver').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
		}
	});
	$('#tablapambientalesotrosverprint').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx2.length ; i++){
        	$('#tablapambientalesotrosverprint').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
		}
    });
	$('#tablapambientalesotrosedit').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx2.length ; i++){
        	$('#tablapambientalesotrosedit').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
		}
    });
	
	
	
	function cellStyleestadoalarma(value, row, index) {
		var classes = ['label-green','label-gray','label-yellow','label-red'];
		
		var aux = "";
		
		if( value.indexOf("Presencia")>=0){
			aux=classes[1];
		} else if( value.indexOf("Precauci")>=0){
			aux=classes[2];
		} else if( value.indexOf("Nivel")>=0){
			aux=classes[3];
		} else if( value.indexOf("Ausencia")>=0){
			aux=classes[0];
		}
		
		return {
			classes: aux
		};
	}
	
	function cellStylepeces(value, row, index) {
		var classes = ['label-danger','label-warning'];
		
		var aux = "";
		
		if( value.indexOf("Si")>=0){
			aux=classes[0];
		} else if( value.indexOf("No")>=0){
			//aux=classes[1];
		} 
		
		return {
			classes: aux
		};
	}
	
	function rowStyle(row, index) {
    var classes = ['active', 'success', 'info', 'warning', 'danger'];
    if(row.Estado == "No"){
        return {classes : "danger" }
    }
    return {};
}
	
	
	
	$("<div id='tooltip'></div>").css({
			position: "absolute",
			display: "none",
			"border-radius": "11px",
			"z-index": 100000,
			padding: "7px",
			"background-color": "#d23737",
			opacity: 1.80
		}).appendTo("body");
		
	$(document).on('click', function(e) {
		if ( e.target.name != 'profundidad' ) {
			$("#tooltip").hide();
		}
	});
	
		
	
	$(document).on('change', '[name="profundidad"]', function(aux) {
		var tabla = "";
		var id = aux['currentTarget'].id;
		var idsplit = "";
		
		
		if(id.split("diato")[1]){
			tabla = $('#tabladiatomeas');
			idsplit = id.split("diato");
		}else{
			if(id.split("dino")[1]){
				tabla = $('#tabladinoflagelados');
				idsplit = id.split("dino");
			}else{
				if( id.split("oesp")[1]){
					tabla = $('#tablaoespecies');
					idsplit = id.split("oesp");
				}
			}
		}
				
		row = idsplit[1].substring(1);
		
		var rojo = tabla.bootstrapTable('getData')[row].Alarma_Rojo;
		var amarillo = tabla.bootstrapTable('getData')[row].Alarma_Amarillo;
		var especie = tabla.bootstrapTable('getData')[row].Nombre;
		var current = parseInt(aux['currentTarget'].value);
		var idinput = $('#'+aux['currentTarget'].id);
		
		//console.log(aux['currentTarget'].value);
//		idinput.val().match(",e") ? console.log("pattern") : console.log("bien");
		
		
		if( current >= rojo && rojo > 0){
			
			idinput.removeClass("label-yellow");
			idinput.addClass("label-red");
			$("#tooltip").html("<b>ALARMA ROJA ACTIVADA </b><br>Especie: "+especie+" <br><b>Nivel Alarma Rojo: " + rojo + " [cel/ml] </b><br>Nivel Alarma Amarillo: " + amarillo + " [cel/ml] ")								
						.css({top: idinput.offset().top-95, left: idinput.offset().left+60, "background-color": "#a70606",color:"#ffffff"})
						.fadeIn(200);
		}else if( current >= amarillo && amarillo > 0){
			idinput.removeClass("label-red");
			idinput.addClass("label-yellow");
			$("#tooltip").html("<b>ALARMA AMARILLA ACTIVADA </b><br>Especie: "+especie+" <br>Nivel Alarma Rojo: " + rojo + " [cel/ml] <br><b>Nivel Alarma Amarillo: " + amarillo + " [cel/ml] </b>")								
						.css({top: idinput.offset().top-95, left: idinput.offset().left+60, "background-color": "#e5cc3a",
						color:"#000"})
						.fadeIn(200);
		}else{
			idinput.removeClass("label-red");
			idinput.removeClass("label-yellow");
			$("#tooltip").hide();
		}
	
	});

	
	
	
	$('.change-tab').click(function() {
	  var $this = $(this);
	  var $nav = $($this.data('target'))
	  var $tabs = $nav.find('li');
	  var $curTab = $tabs.filter('.active');
	  var cur = $tabs.index($curTab);
	  if ($this.data('direction') == 'next') var $showTab = cur == $tabs.length - 1 ? $tabs.eq(0).find('a') : $tabs.eq(cur + 1).find('a');
	  else var $showTab = cur == 0 ? $tabs.eq($tabs.length - 1).find('a') : $tabs.eq(cur - 1).find('a');
	  $showTab.tab('show');
	  
	});
	
	
	$('#tabladiatomeasver, #tabladinoflageladosver, #tablaoespeciesver,#tabladiatomeasverprint, #tabladinoflageladosverprint, #tablaoespeciesverprint').bootstrapTable({
		formatNoMatches: function () {
        	return 'Ausencia de Microalgas';
   	 	},
		formatLoadingMessage: function (a,b,c,d,e) {
			return '';
		}
	});
	
	$('#tablapambientalesver, #tablapambientalesverprint, #tablapambientalesotrosverprint').bootstrapTable({
		formatNoMatches: function () {
        	return 'Sin Registro';
   	 	},
		formatLoadingMessage: function () {
			return '';
		}
	});
		
			
			
	 $('#print').click( function(){
		 
		 	
			//$('#myTabver').hide();
			//$headings = $('#myTabver li a');
//			$('#myModalverreporte .tab-content .tab-pane').each(function(i, el){console.log(this);
//				$(this)
//				   .addClass('active').prepend('<h3>' + $($headings.get(i)).text() + '</h3>')
//			});			
			var prtContent = document.getElementById("myModalverreporteprint");
			
			var WinPrint = window.open('', '', 'left=0,top=0,width=1000,height=900,toolbar=0,scrollbars=0,status=0');
			WinPrint.document.write('<html><head><title></title>');
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/bootstrap.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/metisMenu.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/timeline.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/sb-admin-2.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/morris.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/bootstrap-table.css\" type=\"text/css\" media=\"screen\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/bootstrap-datetimepicker.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/font-awesome.css\" type=\"text/css\" media=\"print\"/>" );
			WinPrint.document.write( "<link rel=\"stylesheet\" href=\"css/jquery-ui.css\" type=\"text/css\" media=\"print\"/>" );
//			
			
			WinPrint.document.write('</head><body >');
			
			WinPrint.document.write(prtContent.innerHTML);
			
//			prtContent = document.getElementById("tabsprint");
//			WinPrint.document.write(prtContent.innerHTML);
//			
//			prtContent = document.getElementById("tabsprint");
//			WinPrint.document.write(prtContent.innerHTML);
//			
//			prtContent = document.getElementById("tabsprint");
//			WinPrint.document.write(prtContent.innerHTML);
			

			WinPrint.document.write('</body></html>');
			
			
			WinPrint.document.close();
			WinPrint.focus();//WinPrint.print();
			setTimeout(function(){WinPrint.print();},700);
			
			
			
			
			
	});
	
	function cellStyleniveles(value, row, index) {
		var classes = ['label-green','label-gray','label-yellow','label-red'];
		var aux = 0;
		var value = parseInt(value);
		if(value == 0){
				//aux=classes[0];
		}else if(value > 0){
				//aux=classes[1];
		}
		if(value >= parseInt(row['Alarma_Rojo']) && parseInt(row['Alarma_Rojo']) > 0){
				aux=classes[3];
				especie_rojo.indexOf(row['IDespecie']) === -1 ? especie_rojo.push(row['IDespecie']) : "";
		}else if(value >= parseInt(row['Alarma_Amarillo']) && parseInt(row['Alarma_Amarillo']) > 0){
					aux=classes[2];
					especie_amarillo.indexOf(row['IDespecie']) === -1 ? especie_amarillo.push(row['IDespecie']) : "";
		}
		
		if(row['Nociva'] == "Si" && row['Nivel_Critico'] > 0){
			especie_nocivo.indexOf(row['IDespecie']) === -1 ? especie_nocivo.push(row['IDespecie']) : "";
		}else if(row['Nociva'] == "Si"){
			especie_nocivo_no.indexOf(row['IDespecie']) === -1 ? especie_nocivo_no.push(row['IDespecie']) : "";
		}
		
		especie_otro.indexOf(row['IDespecie']) === -1 ? especie_otro.push(row['IDespecie']) : "";
		
		return {
			classes: aux
		};
	}
	
		function sticky_relocate() {
		
		var window_top = $(window).scrollTop();
		var div_top = $('#sticky-anchor').offset().top;
		if (window_top > div_top) {
			$('#sticky').addClass('stick');
			$('#sticky-anchor').height($('#sticky').outerHeight());
		} else {
			$('#sticky').removeClass('stick');
			$('#sticky-anchor').height(0);
		}
		
	}
	
	function sticky_relocate_modal() {
		var window_top = $('#myModalreporte').scrollTop();
		var div_top = $('#sticky-anchor-modal').offset().top;
		if (window_top > div_top) {
			$('#sticky-modal').addClass('stick');
			$('#sticky-anchor-modal').height($('#sticky-modal').outerHeight());
		} else {
			$('#sticky-modal').removeClass('stick');
			$('#sticky-anchor-modal').height(0);
		}
		
	}
	
	
	
	$(function() {
		$(window).scroll(sticky_relocate);
		sticky_relocate();
	});
	$(function() {
		$('#myModalreporte').scroll(sticky_relocate_modal);
		sticky_relocate_modal();
	});
	
	
	var dato = [];
	function loaddatagrafico(){
		dato = [];
		var especie_grafico_1 = [];
		var especie_grafico_2 = [];
		var especie_grafico_21 = [];
		var especie_grafico_3 = [];
		
		if(especie_rojo != "" || especie_amarillo != ""){
			especie_grafico_1 = especie_rojo;
			for( var i =0; i<especie_amarillo.length; i++){
				especie_grafico_1.indexOf(especie_amarillo[i]) === -1 ? especie_grafico_1.push(especie_amarillo[i]) : "";
			}
			
		}
		if(especie_nocivo != ""){
			for( var i =0; i<especie_nocivo.length; i++){
				especie_grafico_2.indexOf(especie_nocivo[i]) === -1 &&  especie_grafico_1.indexOf(especie_nocivo[i]) === -1? especie_grafico_2.push(especie_nocivo[i]) : "";
			}
		}
		
		if(especie_nocivo_no != ""){
			for( var i =0; i<especie_nocivo_no.length; i++){
				especie_grafico_21.indexOf(especie_nocivo_no[i]) === -1 &&  especie_grafico_2.indexOf(especie_nocivo_no[i]) === -1 &&  especie_grafico_1.indexOf(especie_nocivo_no[i]) === -1? especie_grafico_21.push(especie_nocivo_no[i]) : "";
			}
		}
		
		for( var i =0; i<especie_otro.length; i++){
				especie_grafico_3.indexOf(especie_otro[i]) === -1 &&  especie_grafico_21.indexOf(especie_otro[i]) === -1 && especie_grafico_2.indexOf(especie_otro[i]) === -1 && especie_grafico_1.indexOf(especie_otro[i]) === -1? especie_grafico_3.push(especie_otro[i]) : "";
			}
		
		//if(especie_grafico_1 != "" || especie_grafico_2 != "" || especie_grafico_3 != ""){
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
				url: '{{ url("/vistas/load_historial_centros_pdf") }}',
				type: 'get',
				dataType: 'json',
				data: {
					 _token: "{{ csrf_token() }}",
					IDcentro:		 idcentro,
					IDmedicion: 	   idmedicion,
					Especies_1: 	    especie_grafico_1,// especie_grafico.slice(0, 4)
					Especies_2: 	    especie_grafico_2,
					Especies_21: 	   especie_grafico_21,
					Especies_3:		especie_grafico_3
				},
				success: function(datoshist)
				{ 
					$('#modalloading').modal('hide');
					dato = [];
					if(datoshist['Error'] == 0){
						$('#titulo_grafico').removeClass('hidden');
						$('#titulo_grafico_ausencia').addClass('hidden');
						dato = datoshist; 
						graficar();
					}else if(datoshist['Error'] == 1){
						$('#placeholder').empty();
						$('#legendholder').empty();
						$('#titulo_grafico_ausencia').removeClass('hidden');
						$('#titulo_grafico').addClass('hidden');
					}else{swal("Error", "Error al traer los datos.", "error");}
				},
				error: function(result) {
					//console.log(result);
				}
			});
		//}else{dato = []; graficar();}
		//graficar();	
		
	}
	
	
	var data_grafico = Array();
	function graficar(){
		data_grafico = [];
		$('#placeholder').empty();
		$('#legendholder').empty();
		var medicion = "todo";
		var todo = 1;
		var prof = "";
		var nivel = "";
		var axislabel = "[cel/ml]";
		var maxy = null;
		var norm = "";		
		if(dato['Nombre']){
				/*if(dato['Nombre'].length != 1 && dato['Critico'] == 1){norm = "norm"; axislabel = "Nivel Nocivo [%]"}
				for(var i= 0; i<dato['Nombre'].length; i++){
					data_grafico.push({label: dato['Nombre'][i], data:dato[dato['Nombre'][i].concat(norm)],lines: {show: true},points: {show: true} });
				}*/
			
				if(dato['Nombre'].length != 1 && dato['Critico'] == 1){norm = "norm"; axislabel = "Nivel Nocivo [%]"}
				for(var i= 0; i<dato['Nombre'].length; i++){
					var dato_aux = [];
					for(var s = 0; s<dato['Semana'].length; s++){
						entro = -1;
						for(var d= 0; d<dato[dato['Nombre'][i].concat(norm)].length; d++){
							if(dato[dato['Nombre'][i].concat(norm)][d][8] == dato['Semana'][s]){
								entro = d;
								dato_aux.push( dato[dato['Nombre'][i].concat(norm)][entro] );
							}
						}
						if(entro == -1){
							dato_aux.push(null);
						}
						
						
					}
					
					data_grafico.push({label: dato['Nombre'][i], data: dato_aux,lines: {show: true},points: {show: true} });
				}
		}
		
		/*var i = 3;
		$.each(data_grafico, function(key, val) {
			val.color = i;
			++i;
		});*/
		
		//var i = 3;
		$.each(data_grafico, function(key, val) {
			var indexcolor = dato['Nombre'].indexOf(val.label)+3;
			if(indexcolor>=12){indexcolor = indexcolor+1;}
			val.color = indexcolor;// i;
			//++i;
		});
		
		if(dato['Nombre']){
			if(dato['Nombre'].length == 1 && dato['Critico'] != 0){
				maxy = parseInt(dato['Max'])*1.1;
				if(dato['Max'] < parseInt(dato['Rojo'])){ maxy = parseInt(dato['Rojo'])*1.1;}
				data_grafico.push({label:"Nivel Nocivo", data:[[dato['F_Min'],dato['Rojo'],maxy],[dato['F_Max'],dato['Rojo'],maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });
				
				//Nivel Alarma Amarillo
				//data_grafico.push({label:"Alarma Precauci??n", data:[[dato['F_Min'],dato['Amarillo'],dato['Rojo']],[dato['F_Max'],dato['Amarillo'],dato['Rojo']]],color: "yellow", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });
				
				
				
			}else if(dato['Critico'] == 1){
				
				maxy = parseInt(dato['Max_norm'])*1.1;
				if(parseInt(dato['Max_norm']) < 100){ maxy = 100*1.1;}
				
				data_grafico.push({label:"Nivel Nocivo", data:[[dato['F_Min'],100,maxy],[dato['F_Max'],100,maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });
				
				
			}else{
				maxy = parseInt(dato['Max'])*1.1;	
			}
		}
		function plotAccordingToChoices() {
			//if (data_grafico.length > 0) {
				plot = $.plot("#placeholder", data_grafico, {
					axisLabels: {
						show: true
					},
					xaxis:  { 
						//axisLabel: 'Fecha Registro', 
						mode: "time",
						timeformat : "%d-%m",  // %H:%M:%S
						timezone: "browser",
						zoomRange: [dato['F_Min'], dato['F_Max']],
						panRange: [dato['F_Min'], dato['F_Max']],
						min: dato['F_Min'],
						max: dato['F_Max'],
						},
					grid: {
						hoverable: true,
						clickable: true
					},
					legend: {position: "nw", container: $('#legendholder') },
					axisLabels: { show: true},
					yaxis: {
						zoomRange: [0, maxy],
						panRange: [0, maxy],
						axisLabel: axislabel,
						min: 0,
						max: maxy
					},
					zoom:   {interactive: true}, 
					pan:    {interactive: false},
					selection: {mode: "xy"}
				});
				
				$("#placeholder").bind("plotselected", function (event, ranges) {
						var opts = plot.getOptions();
						opts.xaxes[0].min= ranges.xaxis.from;
						opts.xaxes[0].max= ranges.xaxis.to;
						opts.yaxes[0].min= ranges.yaxis.from;
						opts.yaxes[0].max= ranges.yaxis.to;
						plot.setupGrid();
						plot.draw();
						plot.clearSelection();
				});
				
			//}
			
		
		}

		plotAccordingToChoices();
		
		$("<div id='tooltip_infowindow'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			"z-index": 100000,
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body");
		
		$("#placeholder").unbind('plothover').bind("plothover", function (event, pos, item,a,b,c,d) {
				
				if (item && item.series.label != "Nivel Nocivo") {
					var x = item.series.data[item.dataIndex][4];
						y = item.series.data[item.dataIndex][5]; if(y == null){y = "-";}
						f = item.series.data[item.dataIndex][6];

					$("#tooltip_infowindow").html(item.series.label + " <br> <b> Fecha Muestra: </b>" + f + " <br><b>Encontradas: </b>" + x + " [cel/ml] <br> <b>Nivel Nocivo: </b>" + y + " [cel/ml]")
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);
					
					document.body.style.cursor = 'pointer';
				} else {
					$("#tooltip_infowindow").hide();
					document.body.style.cursor = 'default';
				}
				
		});
		
	}
	
	//Para esconder el tooltip cuando se hace click fuera de el
	$(document).mouseup(function(e) 
	{
		var container = $("#tooltip_infowindow");
	
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			container.hide();
		}
		
		var container = $("#tooltip");
	
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0) 
		{
			container.hide();
		}
	});
	
	
	$(function() {
		$( "#search-term" ).autocomplete({
			minLength: 0,
			source: function (request, response) {
						$.ajax({
							  type: "GET",
							  url:'{{ url("ingreso-editor/search_especie_registro") }}',
							  data: { _token: "{{ csrf_token() }}",term:request.term},
							  success: response,
							  dataType: 'json',
						})
					},
			
			change: function(event, ui) {
					if(ui.item) {
						//searchAndHighlight(ui.item.value);
					}else{
						alert("Sin resultados, por favor seleccione una especie de la lista.");
						$('#tabladiatomeas tr').removeClass('highlighted');
						$('#tabladinoflagelados tr').removeClass('highlighted');
						$('#tablaoespecies tr').removeClass('highlighted');
					} 
					//return false;
				},
			select: function(event, ui) {
						searchAndHighlight(ui.item.value);
						//return false;
					},
			appendTo : '#myModalreporte'
		}).focus(function () {
			$(this).autocomplete("search", "");
		});
	});
	
	
var searchclick = 0;
function searchAndHighlight(searchTerm, selector) {
		if(searchTerm) {
			//var wholeWordOnly = new RegExp("\\g"+searchTerm+"\\g","ig"); //matches whole word only
			//var anyCharacter = new RegExp("\\g["+searchTerm+"]\\g","ig"); //matches any word with any of search chars characters
			var selector =  "#bodyContainer";    
			var searchTermRegEx = new RegExp(searchTerm,"ig");;
			var matches = $(selector).text().match(searchTermRegEx);
			if(matches) {
				$('#tabladiatomeas tr').removeClass('highlighted');
				$('#tabladinoflagelados tr').removeClass('highlighted');
				$('#tablaoespecies tr').removeClass('highlighted');
					
					searchclick = 1;
					if($('#tabladiatomeas').text().match(searchTermRegEx)){
						$('#myTab a[href="#Diatomeas"]').trigger('click');
						$('#tabladiatomeas tr').each(function(){
							if($(this).find('td').eq(2).text() == searchTerm){
								var row = $(this).index() + 1;
								$('#tabladiatomeas tr:eq('+row+')').addClass('highlighted');
							}
						});
						$('#myModalreporte').scrollTop($('.highlighted').position().top);
					}else if($('#tabladinoflagelados').text().match(searchTermRegEx)){
						$('#myTab a[href="#Dinoflagelados"]').trigger('click');
						$('#tabladinoflagelados tr').each(function(){
							if($(this).find('td').eq(2).text() == searchTerm){
								var row = $(this).index() + 1;
								$('#tabladinoflagelados tr:eq('+row+')').addClass('highlighted');
							}
						});
						$('#myModalreporte').scrollTop($('.highlighted').position().top);
					}else if($('#tablaoespecies').text().match(searchTermRegEx)){
						$('#myTab a[href="#OEspecies"]').trigger('click');
						$('#tablaoespecies tr').each(function(){
							if($(this).find('td').eq(2).text() == searchTerm){
								var row = $(this).index() + 1;
								$('#tablaoespecies tr:eq('+row+')').addClass('highlighted');
							}
						});
						$('#myModalreporte').scrollTop($('.highlighted').position().top);
					}else{alert("Sin resultados, por favor seleccione una especie de la lista.");searchclick = 0;}
					
					
					
				return true;
        	}else{alert("Sin resultados, por favor seleccione una especie de la lista.");}
    	}
    	return false;
}	

$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
	if(searchclick == 1){
		$('#myModalreporte').scrollTop($('.highlighted').position().top);
		searchclick = 0;
	}
	if($('#ultimo').hasClass('active') ){
	 $('#sticky-modal').addClass('hidden');
  }else{
	  $('#sticky-modal').removeClass('hidden');
  }
})	

/*$('#btnsearch').click(function(){
	searchAndHighlight($('#search-term').val());
});*/

//$('#btnload').click(
	function loadregistro(){
		$("#buscarsiepnombre").val(""); $('#cargarexcel').trigger('click'); 
	}
//);




$('#abrirregistro').lc_switch();
$('#enviarnotificaciones').lc_switch();
$('#abrirregistro').lcs_on();
$('#enviarnotificaciones').lcs_on();

var msgcargaexcel = [];
var existeregistro = 0;
function cargarexcelautomatico(form_data,file_name){
	
		if(file_name){    
			var siep = "";
			var siepnombre = $("#buscarsiepnombre").val();
			if(siepnombre != ""){
				siep = siepnombre.substring(0, siepnombre.indexOf(' - '));
			}
			
			
			
			
			form_data.append('file', $('#cargarexcel')[0].files[0]);
			form_data.append('user_id', user_id);
			form_data.append('Codigo', siep);
			form_data.append('Existe_Registro', existeregistro);
			form_data.append('Firma', $("#firma option:selected").text());
			msgcargaexcel = [];
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: '{{ url("/ingreso-editor/carga_registro_automatico") }}',
					cache: false,
					contentType: false,
					processData: false,
					type: 'post',
					data: form_data,
					success: function(msg)
					{  
						
						try {
						
							existeregistro = 0;
							dataTables.bootstrapTable('refresh');
							msgcargaexcel = JSON.parse(msg);
							if(msgcargaexcel['Error'] == 0){
										$("#buscarsiepnombre").val("");
										$('#cargarexcel').val("");
										$('#editarreportever').removeClass("hidden");
									//if(guardar == 1){
										if(msgcargaexcel['Alarma'] != "" && $('#enviarnotificaciones').is(':checked')){
											$('#abrirregistro').is(':checked') ? Idmediconaux = msgcargaexcel['IDmedicion']: Idmediconaux = 0;
											
											
											sendalarma(msgcargaexcel['Alarma'],msgcargaexcel['Comentario'],msgcargaexcel['Concentracion'],msgcargaexcel['Nocivo'],msgcargaexcel['Nocivo_P'],msgcargaexcel['Comentario_Precaucion'],msgcargaexcel['Concentracion_Precaucion'],msgcargaexcel['Mortalidad'],msgcargaexcel['IDcentro'],msgcargaexcel['Nombre_Centro'],msgcargaexcel['Fecha_Medicion'],Idmediconaux);
										}else{
											dataTables.bootstrapTable('refresh');
											//swal("", "Registro enviado con ??xito!", "success");
											$('#abrirregistro').is(':checked') ? verregistroenviado(msgcargaexcel['IDmedicion']): swal("", "Registro cargado con ??xito!", "success");
										}
								
							}else if(msgcargaexcel['Error'] == 1){
								$("#buscarsiepnombre").val("");
								$('#cargarexcel').val("");
								$('#tablaespeciesnoencontradas').bootstrapTable("removeAll");
								$('#tablaespeciesnoencontradas').bootstrapTable("load", msgcargaexcel['Nombre_Especie_No']);
								$(function() {
									$( 'input[name="nombreespeciegeneral"]' ).autocomplete({
										source: function (request, response) {
													$.ajax({
														  type: "GET",
														  url:"search_especie_no_existe.php",
														  dataType: 'json',
														  data: {
															  term: request.term
															  },
														  success: function(data) {
																response(data['response']);
															},
														  
													})
												},
										appendTo : '#myModalespecienoencontrada',
										minLength: 0
									
									}).focus(function(){
										if (this.value == ""){
											$(this).autocomplete("search");
										}
									});
								});
								$('#modalloading').modal('hide');
								$('#myModalespecienoencontrada').modal({backdrop: 'static', keyboard: false});
								$('#myModalespecienoencontrada').modal('show');
							}else if(msgcargaexcel['Error'] == 2){
								//$('#modalloading').modal('hide');
								//swal("", "El c??digo SIEP no coincide con los centros registrados", "warning");
								$("#buscarsiepnombre").val("");
								$('#siepnoencontrado').text(msgcargaexcel['SIEP']);
								$(function() {
									$( '#buscarsiepnombre' ).autocomplete({
										source: function (request, response) {
													$.ajax({
														  type: "GET",
														  url:"search_siep_no_existe.php",
														  data: {
															  user_id: user_id,
															  term:request.term},
														  success: function(data) {
																response(data['response']);
															},
														  dataType: 'json'
													})
												},
										appendTo : '#myModalsiepnoencontrado',
										minLength: 0
									
									}).focus(function(){
										if (this.value == ""){
											$(this).autocomplete("search");
										}
									});
								});
								$('#modalloading').modal('hide');
								$('#myModalsiepnoencontrado').modal({backdrop: 'static', keyboard: false});
								$('#myModalsiepnoencontrado').modal('show');
							
							}else if(msgcargaexcel['Error'] == 3){
								$("#buscarsiepnombre").val("");
								$('#cargarexcel').val("");
								$('#modalloading').modal('hide');
								swal("", "Error al cargar el archivo, compruebe que no est?? da??ado.", "warning");
							
							}else if(msgcargaexcel['Error'] == 4){  //Ya existe un reistro con la misma fecha y hora
								
								swal({
									  title: "Existe",
									  text: "Un registros con la misma fecha y hora ya existe. ??Desea enviar de todas formas?",
									  type: "warning",
									  showCancelButton: true,
									  confirmButtonColor: "#DD6B55",
									  confirmButtonText: "Si, Enviar Registro",
									  cancelButtonText: "No",
									  closeOnConfirm: true,
									  closeOnCancel: true
									},
									function(isConfirm){
									  if (isConfirm) {
											 existeregistro = 1;  
											 $("#enviarcargaexcel").click();
									  } else {
											existeregistro = 0;
											$("#buscarsiepnombre").val("");
									  }
								});
							}else{
								$("#buscarsiepnombre").val("");
								$('#cargarexcel').val("");
								dataTables.bootstrapTable('refresh');
								$('#modalloading').modal('hide');
								swal("Error", "Error al cargar el reporte, por favor aseg??rese que el formato est?? correcto.", "error");
							}
						} catch (e) {
							if (e instanceof SyntaxError) {
								alert(e);
							} else {
								alert(e);
							}
						}
					
					}               
				});
			}	
	
}

$("#guardarespecienoexiste").click(function() {
	var IDmedicionfan = Array();
	var Nombre_Especie = Array();
	$("input[name='nombreespeciegeneral']").each(function() { 
			var id = this.id;
			IDmedicionfan.push(id.replace("idmedfan", ""));
			Nombre_Especie.push(this.value);
	})
	$('#myModalespecienoencontrada').modal('hide');	
	$('#modalloading').modal({backdrop: 'static', keyboard: false});		  
			$.ajax({
				url: "save_especie_noexiste.php",
				type: 'post',
				data: {	 user_id: 		user_id,
							Fecha_Medicion: msgcargaexcel['Fecha_Medicion'],
							IDmedicion:	 msgcargaexcel['IDmedicion'],
							Centro:		 msgcargaexcel['Nombre_Centro'],
							IDcentro: 	   msgcargaexcel['IDcentro'],
							IDmedicionfan:  IDmedicionfan,
							Nombre_Especie: Nombre_Especie
				},
				success: function(msg)
				{ 
					
					msg = JSON.parse(msg);
					
					if(msg['Error'] == 0){
						
								//Mostrar boton de editar registro, luego de abrirlo
								$('#editarreportever').removeClass("hidden");
							//if(guardar == 1){
								if(msg['Alarma'] != "" && $('#enviarnotificaciones').is(':checked')){
									$('#abrirregistro').is(':checked') ? Idmediconaux = msg['IDmedicion']: Idmediconaux = 0;
									
									sendalarma(msg['Alarma'],msg['Comentario'],msg['Concentracion'],msg['Nocivo'],msg['Nocivo_P'],msg['Comentario_Precaucion'],msg['Concentracion_Precaucion'],msg['Mortalidad'],msg['IDcentro'],msg['Nombre_Centro'],msg['Fecha_Medicion'],Idmediconaux);
								}else{
									dataTables.bootstrapTable('refresh');
									//swal("", "Registro enviado con ??xito!", "success");
									$('#abrirregistro').is(':checked') ? verregistroenviado(msg['IDmedicion']): swal("", "Registro cargado con ??xito!", "success");
								}
						
					}else{
						dataTables.bootstrapTable('refresh');
						swal("Error", "Error al cargar el reporte, por favor aseg??rese que el formato est?? correcto.", "error");
					}
				}
			});

});

$('#myModalverreporte').on('hidden.bs.modal', function (e) {
	$('#editarreportever').addClass("hidden");
})

function runningFormatterespeciegeneral(value, row, index) {
		return '	 <input name="nombreespeciegeneral" id="idmedfan'+row['IDmedicionfan']+'" class="form-control" placeholder="Buscar"> ';
	}



//Descargar formato estandar
function formatoestandar(){
	window.location.href = '{{url("ingreso-editor/descargar_formato_estandar/")}}';
}


$("#cargarexcel").change(function() {
		var validExts = new Array(".xlsm",".xlsx",".xls");
		var fileExt = $('#cargarexcel').val();
		fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
		if (validExts.indexOf(fileExt) < 0) {
		  
		 swal({
				  title: "Formato Inv??lido",
				  text: "Por favor utilizar extensi??n " + validExts.toString(),
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#204d74",
				  confirmButtonText: "Descargar Formato",
				  cancelButtonText: "Cerrar",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
					  formatoestandar();
			  	  } else {
					  
				  }
			});
		}else{	
			$('#myModalcargaexcel').modal('show');
		}
});
$("#enviarcargaexcel").click(function() {	
		$('#myModalcargaexcel').modal('hide');
		var form2_cargarexcel = document.getElementsByClassName('form2_cargarexcel')[0];
		var form_data = new FormData( form2_cargarexcel );
		//var form_data = new FormData(); 
		var file_name = $('#cargarexcel').prop('files')[0]; 
		
		cargarexcelautomatico(form_data,file_name);
});
$("#guardarsiepnoexiste").click(function() {	
		$('#myModalsiepnoencontrado').modal('hide');
		var form_data = new FormData();  
		var file_name = $('#cargarexcel').prop('files')[0]; 
		
		cargarexcelautomatico(form_data,file_name);
});
$("#closesiepnoexiste, #closeupsiepnoexiste").click(function() {
	$("#buscarsiepnombre").val("");
});
$("#closenoexiste, #closeupnoexiste").click(function() {
	$.ajax({
				url: "delete_especie_noexiste.php",
				type: 'post',
				data: {	 
							IDmedicion:  msgcargaexcel['IDmedicion']
				},
				success: function(msg)
				{ 
					$('#myModalespecienoencontrada').modal('hide');
					funcioneditarregistro(msgcargaexcel['IDmedicion'], "No")
				}
	});
	
});

	
</script>
@endsection	
