@extends('layouts/master')
@section('title', '- Mapa Interno')
<style>
    #map {
      width: 100%;
      height: 650px;
      background-color: grey;
    }
   
   
   
    .ubicacion2{
           border: 1px solid #fdd;
           padding: 3px;
           border-radius: 5%;
           background-color: #fee !important;
           opacity: 0.90;
           top: 10%;
           right: 3%;
       }
   
   
   
   
   @media print{
        /*
       .panel_tabla{
           display: none;
       }
   
       .indicador {
           background-size: 5px 5px;
           width: 15px;
           height: 15px;
           border-radius: 50%;
       }
   
       .ubicacion2{
           border: 1px solid #fdd;
           padding: 3px;
           border-radius: 5%;
           background-color: #fee !important;
           opacity: 0.90;
           top: 10%;
           right: 3%;
       }
       */
   
       #map {
           width: 100%;
           height: 850px;
           background-color: none;
       }
   
       .no-print, .no-print *
       {
           display: none !important;
       }
   
   
   
       /*
       .top_select{
           margin-top: 22px;
       }
   
       .top_form{
           margin-top: 65px;
       }
   
   
       #resumenreporte{
           font-size: smaller;
       }
       #resumenreporte_prima{
           font-size: smaller;
       }
   
   
   
   
   
       .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
           color: #fff;
           background-color: #337ab7;
       }
       */
   }
   
   
   
   
   </style>
   

@section('content')


<script type="text/javascript">

</script>


	<div id="wrapper">

     

       	<div id="page-wrapper" style="margin-left:-27px; margin-right: 1px">



            		<!--<div class="row">
            			<div class="col-lg-12">
                            <h4 class="page-header">REGIÓN DE LOS LAGOS</h4>
                        </div>
                    </div>-->

            		<div class="row">

                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-left:10px; margin-right:10px;">
                            <button title="Imprimir" type="button" id="" style="float: right;margin-top: 15px;" onclick="window.print();" class="btn btn-danger btn-sm no-print center-block">  <i class="fa fa-print"></i> </button>
                        	  <ul class="nav nav-pills" id="myTabmap" style="margin-top:15px;">
                                <li id="tabregion10" value="10"><a href="" data-toggle="tab" >X REGIÓN DE LOS LAGOS</a>
                                </li>
                                <li  class="" id="tabregion11" value="11"><a href="" data-toggle="tab" >XI REGIÓN DE AISÉN</a>
                                </li>
                                <li id="tabregion12" value="12"><a href="" data-toggle="tab" >XII REGIÓN DE MAGALLANES</a>
                                </li>
                            </ul>

                            <div class="panel panel-black " style="margin-top:5px; margin-right: 10px;">
                                <div class="panel-heading">

                                    <div class="row" style="margin:10px;">
                                          <div class="col-lg-8 col-md-8 col-xs-12 text-center" style="margin-top:15px;">
                                          <div class="input-group center-block" style="margin-top: -15px; margin-bottom: 20px;">
                                            <span class="" style=" font-weight:bold;"> C U R S O R &emsp; F E C H A &emsp; D E S D E
                                            </span>
                                            <div class="input-group-btn" style="display:inline-block;margin-left: 10px; color:black !important;">
                                              <div class="input-group date classinterno "   id="datetimepicker_filtro4_1" style="width:135px;float: left;margin-right: 10px;">
                                                  <input class="form-control" type="text" id="fecha_filtro_4_1" name ="fecha_filtro_4_1" value="" style="height: 26px;" >
                                                  <div class="input-group-addon" style="padding: 0px 10px;">
                                                      <span class="glyphicon-calendar glyphicon"></span>
                                                  </div>
                                              </div>
                                            </div>

                                          </div>
                                            <input style="width:100%" id="sidebarweek" type="text" data-slider-ticks="[6, 5, 4, 3, 2, 1, 0]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='[]' data-slider-step="1" data-slider-value="7" data-slider-tooltip="hide"/>

                                        </div>
                                        <div class="col-lg-4 col-md-4 col-xs-12 center-block">
                                            <select id="opcionescentros"  name="multipleselectsearch" class="form-control center-block" style="width:200px !important; margin-top:7px; ">
												@foreach ($centros as $c)
													@foreach ($permisos as $p)
														@if ($p->IDcentro == $c->IDcentro)
															<option value="{{$c->IDcentro}} ">{{$c->Nombre}} </option>
														@endif
													@endforeach	
												@endforeach
											</select>
                                            <select id="nromedicionresumen" class="form-control center-block" style="max-width:200px; margin-top:5px;">
                                            </select>
                                            <select id="especiesselectmap" name="multipleselectsearch" class="form-control center-block" style="width:200px; margin-top:7px;">
                                            </select>
                                            <div id="loading1" class="" style="display:inline; position:absolute; margin-top:-28px; width:68%"><img class="pull-right" style="width: 25px;" src="{{ asset('img/loader.gif')}}" /></div>



                                        </div>
                                    </div>

                                </div>
                                <div class="panel-body pb" style="padding:0px !important;">
                                    <div style="width:100%; position: relative;" >
                                    	<div id="map"></div>
                                        <!--<img id="imgregion" src="img/region_10.png" style="cursor: default !important;">-->
                                        <div class="counter no-print">
                                            <div id="showcentros" class="" >


                                            <!--Insertar Centros-->
                                            </div>
                                        </div>
                                        <div class="ubicacion no-print" style="top:3%; right:3%">
                                            <div class="btn-group ">
                                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                   Seleccionar Capas
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu" id="opciones" style="color:#000; padding-left:15px; padding-right:15px; width:255px">
                                                    <li class="divider" style="margin-top:0px;margin-bottom:5px;"></li>
                                                    <li class="text-center text-info ">
                                                        Mostrar | Ocultar
                                                    </li>
                                                    <li class="divider" style="margin-top:5px;"></li>
                                                    </li>

                                                    <li> <input class="form-control checkbox center-block"  type="checkbox" id="nombreswitch"><label style="margin-left:10px; font-weight:normal !important">Nombre Centros</label>
                                                    </li>
                                                    <li><input class="form-control checkbox center-block" type="checkbox" id="operandoswitch"><label style="margin-left:10px; font-weight:normal !important">Centros Operando </label>
                                                    </li>
                                                    <li><input class="form-control checkbox center-block" type="checkbox" id="nooperandoswitch"><label style="margin-left:10px; font-weight:normal !important" >Centros No Operando</label>
                                                    </li>
                                                    <li> <input class="form-control checkbox center-block" type="checkbox" id="acsswitch"><label style="margin-left:10px; font-weight:normal !important">Agrupación Concesiones</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="ubicacion ubicacion2" >
                                        	<div class=" indicador indicadoractivorojo ubicacion" style="animation:none !important; margin-right:20px;"></div>
                                            <b style="margin-left:22px;"> Nivel Crítico </b><br/>
                                            <div class=" indicador indicadoractivoamarillo ubicacion" style="animation:none !important;"></div><b style="margin-left:22px;"> Precaución </b><br />
                                            <div class=" indicador indicadoractivogris ubicacion"></div> <b style="margin-left:22px;"> Presencia Microalga </b><br />
                                            <div class=" indicador indicadoractivoverde ubicacion"></div> <b style="margin-left:22px;"> Ausencia Microalga </b><br />
                                        </div>

                                    </div>
                                    <div class="panel panel-default no-print  panel_tabla" style="margin-left:13px;margin-right:13px; margin-top:15px;">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a id="mostrartabla" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    	<i id="iconofiltro" class="fa fa-plus" style="color:#337ab7;">
                                                        	Ocultar Tabla Resumen
                                                        </i>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">

                                                    <div class="col-lg-6 col-md-12 col-xs-12 ">
                                                        <div class="row hidden">
                                                            <div class="col-lg-4 col-md-4 col-xs-4 ">
                                                                <p class="arealabel">Últimos Días</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-4 col-md-7 col-xs-7" >
                                                                <input id="dias" class="form-control" type="number" value="7" max="14" min="7" width="130px"/>
                                                           </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel">Ver Indicador</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-4 col-md-7 col-xs-7" >
                                                                <select id="verindicador" name="multipleselect" multiple="multiple">
                                                                    <option value="3" selected="selected">Alarma Crítico</option>
                                                                    <option value="2" selected="selected">Alarma Precaución</option>
                                                                    <option value="1">Presencia Algas</option>
                                                                    <option value="0">Ausencia Algas</option>
                                                                </select>
                                                           </div>
                                                        </div>
                                                   	</div>
                                                </div>
                                                <div id="resumenreporteload" class="dataTable_wrapper" style="padding:15px; max-height:500px; overflow:auto;" >

                                                    <table cellSpacing="0" data-toggle="table" data-show-columns="false"  data-search="true" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer" data-sort-name="Centro" id="resumenreporte" >
                                                        <thead>
                                                            <tr>


                                                                <th data-field="Centro" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false" data-width = "35px">Centro</th>
                                                                <th data-field="Area" data-align= "left" data-halign="center" data-valign = "middle" data-width = "35px">Área</th>
                                                                <th data-field="ACS" data-align= "center" data-halign="center" data-valign = "middle" data-switchable="false" data-width = "25px">ACS</th>
                                                                <th data-field="#" data-formatter="runningFormatterarea" data-align= "center" data-valign = "middle" data-switchable="false" data-width = "35px">#</th>
                                                                <th data-field="Especie" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false">Especie</th>
                                                                <th data-field="Grupo"  data-align= "center" data-valign = "middle" data-width = "40px" data-visible="false">Grupo</th>
                                                                <th data-field="Alarmas" data-formatter=""  data-align= "center" data-valign = "middle" data-width = "40px" data-visible="false">Crítico y Precaución</th>
                                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "40px" >Fiscalizada</th>
                             							                      <th data-field="Nociva"  data-align= "center" data-valign = "middle" data-width = "40px">Nociva</th>
                                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>

                                                                <!--<th data-field="Alarma_Rojo"  data-align= "center" data-valign = "middle" data-width = "105px" data-visible="false">Alarma Crítico<br /> [cel/ml]</th>
                                                                <th data-field="Alarma_Amarillo"  data-align= "center" data-valign = "middle" data-width = "105px" data-visible="false">Alarma Precaución<br /> [cel/ml]</th>-->

                                                            </tr>
                                                        </thead>

                                                    </table>

                                                </div>
                                    		</div>
                                    	</div>
                                	</div>

                             	</div>
                           	</div>
                     	</div>


                  	</div>


                    <div class="modal fade" id="myModalgrafico" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    		<h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">DETALLES <output id="modalnombrecentro" style="display:inline; text-transform:uppercase; font-size:20px;"></output></h4>
                          </div>
                          <div class="modal-body">
                            <div class="panel-body">
                                <div class="row">
                                	<div class="panel panel-default">
                        				<div class="panel-heading">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xs-12" >
                                                     <div class="row" >
                                                        <div class="col-lg-3 col-md-3 col-xs-3">
                                                            <p class="arealabel"> Inicio</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <div class="form-group" style="margin-bottom:0px !important;">
                                                                <div class="input-group date " id="datetimepickerinicio">
                                                                   <input id="fechadesde" value="" type="text" class="form-control"/>	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-12" >
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3">
                                                            <p class="arealabel">Término</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <div class="form-group" style="margin-bottom:0px !important;">
                                                                <div class="input-group date datetimepicker_modal" id="datetimepickertermino">
                                                                    <input id="fechahasta" value="" type="text" class="form-control" />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>

                                                                </div>
                                                            </div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xs-12" >
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3">
                                                            <p class="arealabel">Profundidad</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <select id="nromedicion" class="form-control">
                                                            </select>
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-12" >
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3">
                                                            <p class="arealabel">Nivel</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <select id="nivel" class="form-control">
                                                                <option value="0">Nivel Nocivo [%]</option>
                                                                <option value="1">Estandar [cel/ml] </option>
                                                            </select>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-xs-12" >
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3">
                                                            <p class="arealabel">Especies</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <select id="especiesselect" class="form-control">
                                                                <option value="2">Nivel Nocivo Definido [%]</option>
                                                                <option value="3">Nocivas [cel/ml]</option>
                                                                <option value="1">Fiscalizadas [cel/ml]</option>
                                                                <option value="0">Todas [cel/ml]</option>
                                                            </select>
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-xs-12" >
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-3 col-xs-3">
                                                            <p class="arealabel">Medicion</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <select id="medicion_interna" class="form-control">
                                                                <option value="0">Todo</option>
                                                                <option value="1">Interna </option>
                                                                <option value="2">Externa </option>
                                                            </select>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>


                                     	</div>
                                        <div class="panel-body">

                                            <div class="pull-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-default btn-xs  dropdown-toggle fa fa-gear" data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right" role="menu" style="padding:7px; width:220px;">
                                                        <li class="divider" style="margin-top:0px;margin-bottom:5px;"></li>
                                                        <li class="text-center text-info text-uppercase">
                                                            Seleccionar Especies
                                                        </li>
                                                        <li class="divider" style="margin-top:5px;"></li>
                                                        <input type='checkbox' checked='checked' id='choicesall'>
                                                        <span style='margin-bottom: 10px;'> Todas</span>
                                                        <br/><input type='checkbox'  id='choicesdiato'>
                                                        <span style='margin-bottom: 10px;'> Diatomeas</span>
                                                       	<br/><input type='checkbox'  id='choicesdino'>
                                                        <span style='margin-bottom: 10px;'> Dinoflagelados</span>
                                                        <li class="divider" style="margin-top:5px;"></li>

                                                        <div id="choices" style="margin-top:-19px; width:100%;"></div>
                                                    </ul>
                                               	</div>
                                           </div>


                                            <div id="content">
                                                 <div class="demo-container">
                                                 	<!--<div class="row" style="width:80%; padding-left:59px; padding-right:14px;">
                                                        <div class="btn-toolbar pull-left">
                                                          <div class="btn-group">
                                                            <button class="btn btn-default" onclick="cambiardia('anterior')"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Anterior </button>
                                                          </div>
                                                        </div>
                                                        <div class="btn-toolbar pull-right">
                                                          <div class="btn-group">
                                                            <button class="btn btn-default" onclick="cambiardia('siguiente')"> Siguiente <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                                            </button>
                                                          </div>
                                                        </div>
													</div>-->
                                                    <div id="placeholder" class="demo-placeholder" style="display:inherit; float:left; width:80%; height:350px;"></div>
                                                    <div style="float:right; width:20%;" id="legendholder"></div>
                                                </div>
                                            </div>


                                		</div>



                                    </div>
                                    <div id="nota">
                                        <p class="text-danger" style="display:inline; padding-left:5px;">*Nota:</p>
                                                Los valores estan normalizados de 0% a 100% según su propia concentración crítica [cel/ml].
                                            <div class="row" style="margin-bottom:10px;"></div>
                                  	</div>
                                </div>
                             </div>
                      	   </div>
                           <div id="footerprint" class="modal-footer" >
                                <button id="closereporte" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                               <!-- <button id = "print" type="button" class="btn btn-info">Imprimir <i class="fa fa-print fa-fw" ></i></button>-->
                           </div>
                        </div>
                      </div>
                    </div>




             <!-- Modal -->
            <div class="modal fade" id="myModalverreporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">REGISTRO DIARIO </h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                      <div class="row">
                        	<div class="col-lg-12 col-md-12 col-xs-12">
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
                                    <td style="font-size:14px !important;" width = "70px"><b>Análisis</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td>
                                    <td> <output style="font-size:13px !important; margin-top:-7px !important;" id="fechaanalisisverreporte"></output></td>

                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" width = "55px"><b>ACS</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td>
                                    <td><output style="font-size:13px !important;  margin-top:-7px !important;" id="acsverreporte"></output></td>
                                    <td width = "30px"></td>
                                    <td style="font-size:14px !important;" width = "70px"><b>Envío</b></td>
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
                                    <td><output style="text-decoration:underline; vertical-align:middle; cursor: pointer;" id="archivoverreporte" onclick="verarchivo()" name="outputver"></output></td>
                                    <td width = "30px"></td>
                                    <td style="font-size:14px !important;" width = "65px"><b>Firma</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td>
                                    <td> <output style="font-size:13px !important; margin-top:-7px !important;" id="firmaverreporte"></output></td>
                                  </tr>
                                  <tr id="hidden_ubicación">
                                    <td style="font-size:14px !important; padding:0px;" width = "55px"><b>Ubicación</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td>
                                    <td colspan="5"><output style="font-size:13px !important; margin-top:-7px !important;" id="ubicacionverreporte"></output></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:14px !important; padding:0px;" max-width = "55px"><b>Obs.</b></td>
                                    <td style="font-size:14px !important;" width = "30px">:</td>
                                    <td colspan="5"><output style="font-size:13px !important; margin-top:-7px !important;" id="obsverreporte"></output></td>
                                  </tr>
                                </table>
                            </div>
                             <!-- <div class="col-lg-6 col-md-6 col-xs-6">
                                <div id="content">
                                	<div id="titulo_grafico" class="text-center" style="font-size:14px; margin-top:-16px; margin-right:50px;"><b>Tendencia Especies Nocivas en la Semana</b> (Máx. concentración)</div>
                                    <div id="titulo_grafico_ausencia" class="text-center hidden" style="font-size:14px; margin-top:-16px; margin-right:50px;"><b>Ausencia de Microalgas Nocivas en la Semana</b></div>
                                     <div class="demo-container">
                                        <div id="placeholder" class="demo-placeholder" style="display:inherit; float:left; width:405px; height:175px;"></div>
                                        <div style="float:right; width:25%; font-size:13px; max-height:170px; overflow-y:auto;" id="legendholder"></div>
                                    </div>
                                </div> -->
                       	 	</div>
                        </div>
                    	<!-- <div class="row">
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
                                    <div class="col-lg-8 col-md-9 col-xs-7">
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
                                        <p class="arealabel"> Análisis</p>
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
                                        <p class="arealabel"> Envío </p>
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
                                        <p class="arealabel"> Técnica </p>
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
                        </div> -->

                        <ul class="nav nav-tabs" id="myTabver" style="margin-top:25px;">
                            <li class="active"><a href="#Diatomeasver" data-toggle="tab" id="tabdiatover">1. Diatomeas</a>
                            </li>
                            <li ><a href="#Dinoflageladosver" data-toggle="tab" id="tabdinover">2. Dinoflagelados</a>
                            </li>
                            <li ><a href="#OEspeciesver" data-toggle="tab" id="taboespver">3. Otros</a>
                            </li>
                            <li ><a href="#PAmbientalesver" data-toggle="tab" id="tabpambver">4. Ambiente</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Diatomeasver">
                                <div class="dataTable_wrapper" style="margin-top:25px;" >

                                    <table cellSpacing="0" data-toggle="table" data-show-export="false" data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover" id="tabladiatomeasver" >
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

                                        <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladinoflageladosver" >
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

                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tablaoespeciesver" >
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

                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesver" >
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
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotrosver" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "100px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "220px">Nombre</th>
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
                        <!--<button id = "print" type="button" class="btn btn-info">Imprimir <i class="fa fa-print fa-fw" ></i></button>-->
                       <button id = "descargarpdf" type="button" class="btn btn-danger">PDF <i class="fa fa-file-pdf-o fa-fw" ></i></button>
                  </div>
                </div>
              </div>
            </div>





            <!--Modal Print-->
       	<div id="content">
            <div class="modal fade" id="myModalverreporteprint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">REGISTRO DIARIO  </h4>
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
                                <p class="arealabel"> Fecha Envio </p>
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
                                <p class="arealabel"> Técnica </p>
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
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle" data-width = "65px">0 [m]</th>
                                                <th data-field="Medicion_2" data-align= "center" data-valign = "middle" data-width = "65px">5 [m]</th>
                                                <th data-field="Medicion_3" data-align= "center" data-valign = "middle" data-width = "65px">10 [m]</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
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
                                                    <th data-field="Medicion_1" data-align= "center" data-valign = "middle" data-width = "65px">0 [m]</th>
                                                    <th data-field="Medicion_2" data-align= "center" data-valign = "middle" data-width = "65px">5 [m]</th>
                                                    <th data-field="Medicion_3" data-align= "center" data-valign = "middle" data-width = "65px">10 [m]</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
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
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle" data-width = "65px">0 [m]</th>
                                                <th data-field="Medicion_2" data-align= "center" data-valign = "middle" data-width = "65px">5 [m]</th>
                                                <th data-field="Medicion_3" data-align= "center" data-valign = "middle" data-width = "65px">10 [m]</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
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
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle" data-width = "65px">0 [m]</th>
                                                <th data-field="Medicion_2" data-align= "center" data-valign = "middle" data-width = "65px">5 [m]</th>
                                                <th data-field="Medicion_3" data-align= "center" data-valign = "middle" data-width = "65px">10 [m]</th>
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
           </div>
           <div id="editor"></div>

            <!-- Modal -->
            <div class="modal fade" id="myModaldetalleimagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:14px;"> <output id="nombreespecieimagen" style="display:inline; text-transform:uppercase; font-size:20px !important;"></output></h4>
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
                                            <td><p class="text-danger" style="display:inline;  text-transform:uppercase; font-weight:bold">Alarma Crítico</p></td>
                                            <td><p class="text-danger" style="display:inline;  text-transform:uppercase; font-weight:bold">:</p></td>
                                            <td><output id="especienivelrojo" style="display:inline;"></output></td>
                                        </tr>
                                        <tr>
                                            <td><p class=" text-warning" style="display:inline; color:#e5cc3a; text-transform:uppercase;">Alarma Precaución</p></td>
                                            <td><p class=" text-warning" style="display:inline; color:#e5cc3a;">:</p></td>
                                            <td><output id="especienivelamarillo" style="display:inline;"></output></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <p id="descripcionespecieimagen" style="text-align:justify;"></p>
                            	<!--<b><output id="nombreespecieimagen" style="display:inline; text-transform:uppercase;"></output></b><br />
                                <p class="text-danger" style="display:inline;">Alarma Rojo: </p><output id="especienivelrojo" style="display:inline; text-transform:uppercase;"></output> [cel/ml] <br />
                                <p class=" text-warning" style="display:inline; color:#e5cc3a;">Alarma Amarillo:</p> <output id="especienivelamarillo" style="display:inline; text-transform:uppercase;"></output> [cel/ml]
                                <p id="descripcionespecieimagen"></p>-->
                            </div>
                       	</div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

                    <div class="modal fade" id="modalloading" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog " role="document" >
                            <div class="modal-content" style="height:100px; width:400px; alignment-adjust:central">
                            	<div class="modal-body center-block text-center">
                                	 <img src="{{ asset('img/loader.gif') }}"/><h5> Loading... Please Wait </h5>
                                </div>
                             </div>
                        </div>
                    </div>


					<script language="javascript" src="{{ asset('js/jquery.js') }}"> </script>

    <!-- Bootstrap Core JavaScript -->
    {{-- ****<script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    ******<script src="js/metisMenu.min.js"></script>
    ******<script src="js/bootstrap-table.js"></script>


	<!-- DatetimePicker -->
   ******<script src="js/moment-with-locales.js"></script>
   ******<script src="js/bootstrap-datetimepicker.js"></script>

    <!-- Custom Theme JavaScript -->
       ***<script src="js/sb-admin-2.js"></script>


    <!-- Multiple Select -->
  	<script type="text/javascript" src="js/bootstrap-slider.js"></script>

    <!-- Autocomplete -->
    *****<script src="js/jquery-ui.js"></script>

    	 <!-- Alertas -->
    ******<script src="js/sweetalert.min.js"></script>

    <!-- Export table -->
    ****<script src="js/tableExport.js"></script>
    ****<script src="js/bootstrap-table-export.js"></script>

    <!-- Multiple Select -->
  	**<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

    <!-- Switch button -->
  	 --}}

	 

	   <!-- Bootstrap Core JavaScript -->
	   <script src="{{asset('js/bootstrap.min.js')}}"></script>

	   <!-- Metis Menu Plugin JavaScript -->
	   <script src="{{asset('js/metisMenu.min.js')}}"></script>
	   <script src="{{asset('js/bootstrap-table.js')}}"></script>
   
   
	   <!-- DatetimePicker -->
	  <script src="{{asset('js/moment-with-locales.js')}}"></script>
	  <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
   
	   <!-- Custom Theme JavaScript -->
	   <script src="{{asset('js/sb-admin-2.js')}}"></script>
   
   
	   <!-- Multiple Select -->
		 <script type="text/javascript" src="{{asset('js/bootstrap-slider.js')}}"></script>
   
	   <!-- Autocomplete -->
	   <script src="{{asset('js/jquery-ui.js')}}"></script>
   
	   <!-- Asigna menu para roles -->
	   {{-- <script src="js/menu_role.js?random=<?php echo uniqid(); ?>"></script> --}}
   
   
		<!-- Alertas -->
	   <script src="{{asset('js/sweetalert.min.js')}}"></script>
   
	   <!-- Export table -->
	   <script src="{{asset('js/tableExport.js')}}"></script>
	   <script src="{{asset('js/bootstrap-table-export.js')}}"></script>
   
	   <!-- Multiple Select -->
		 <script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>
   
	   <!-- Switch button -->
		 <script type="text/javascript" src="{{asset('js/lc_switch.js')}}"></script>

    <script>
		var user_id = {!!$currentUser->id!!} //<?php echo $currentUser->id; ?>;  
		var id_empresa = {!!$currentUser->IDempresa!!}//<?php echo $currentUser->IDempresa; ?>;
		var user_role_fan = {!!$currentUser->user_role_fan!!}
		var role = <?php echo '"'.$currentUser->role.'"';?>;
		// var user_id = <php echo $miuser->id; ?>;
		// var id_empresa = <?php echo $miuser->IDempresa; ?>;

		// roles(<?php echo '"'.$miuser->role.'"';?>);
		

	$('#nombreswitch').lc_switch('Auto', 'No');
	$('#acsswitch').lc_switch();
	$('#operandoswitch').lc_switch();
	$('#nooperandoswitch').lc_switch();
	$('#nombreswitch').lcs_on();
	$('#acsswitch').lcs_off();
	$('#operandoswitch').lcs_on();
	$('#nooperandoswitch').lcs_off();


	/*$('[name="multipleselectsearch"]').multiselect({
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			buttonWidth: '200px',
	});*/
	//////////////////
	////// MAPS //////
	//////////////////

	//var marker;
	var map;
	var center;
	var zoom = 9;
	var zoomnombre = 11;
	var mhlevel = {lat: -44.6, lng: -74.38};
	var xregion = {lat: -42.13, lng: -73.5};
	var xiregion = {lat: -44.98, lng: -74.0};
	var xiiregion = {lat: -52.6, lng: -72.3};
	var acsLayer = "";
	var infowindow = "";
	var colorlabelmarker = 'black';
	var sinmarker = "sin1.png";
	function initMap() {
		 map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 11,
		  center: mhlevel,
		  //mapTypeId: 'satellite'
		});

		google.maps.event.addListener( map, 'maptypeid_changed', function() {
			if(map.getMapTypeId() == 'satellite' || map.getMapTypeId() == 'hybrid'){
				colorlabelmarker = 'white';
				sinmarker = "sin-white.png";
				$("#sidebarweek").change();
			}else {
				colorlabelmarker = 'black';
				sinmarker = "sin1.png";
				$("#sidebarweek").change();
			}
		} );


		google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomLevel = map.getZoom();
			if (zoomLevel >= zoomnombre && !$('#nombreswitch').is(':checked')) {
				$('#nombreswitch').lcs_on();
			} else if (zoomLevel < zoomnombre && $('#nombreswitch').is(':checked')) {
				$('#nombreswitch').lcs_off();
			}
		});

		var srcacs = 'http://fan.gtrgestion.cl/acs3.kml';
		//var srccap = 'http://fan.gtrgestion.cl/cap.kmz';
		//var srcmacro = 'http://fan.gtrgestion.cl/macro2.kml';
		acsLayer = new google.maps.KmlLayer(srcacs, {
		  suppressInfoWindows: true,
		  preserveViewport: true,
		  clickable: false
		});

		contentString = '<div id="content" style="overflow:hidden;">'+
							'<div id="infonombrecentro" class="text-center text-uppercase" style = "font-size: 17px;font-weight: 400;padding: 10px;background-color: #48b5e9;color: white;border-radius: 2px 2px 0 0;"></div>'+

                           '<div id="bodyContent">'+

                 	    	//'<img src="GTRgestion.png" style="height:25px;" />' +

							'<div id="myCarousel" class="carousel slide" style = "margin-left: 50px; margin-right: 50px;    margin-top: -12px;" data-ride="carousel" data-interval="false">'+
							  //<!-- Indicators -->
							  /*'<ol class="carousel-indicators" style="bottom:-8px;">'+
								'<li data-target="#myCarousel" data-slide-to="0" class="active" style="border-color: gray;background-color: gray"></li>'+
								'<li data-target="#myCarousel" data-slide-to="1" style="border-color: gray;background-color: gray"></li>'+
								//<li data-target="#myCarousel" data-slide-to="2"></li>
							  '</ol>'+*/

							  //<!-- Wrapper for slides -->
							  '<div class="carousel-inner">'+
								'<div class="item active">'+
								  	'<table class="table table-condensed" style="width:340px;margin-top:20px; margin-bottom:5px; ">'+

									  '<tr>'+
										'<td valign="top" style="border-top: none;"><b> Especie</b></td>'+
										'<td valign="top" style="border-top: none;">&nbsp;</td>'+
										'<td valign="top" style="border-top: none;"><b> : </b></td>'+
										'<td valign="top" style="border-top: none;">&nbsp;</td>'+
										'<td style="border-top: none;"><output id="espinfo" style="display:inline;">123456</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Nociva </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="nocivainfo" style="display:inline">123456</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Encontradas</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="encontradasinfo" style="display:inline">123456</output> [cel/ml]</td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Nivel Nocivo</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="nivelnocivoinfo" style="display:inline">123456</output> [cel/ml]</td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Alarma Crítico</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="alarmarojoinfo" style="display:inline">123456</output> [cel/ml]</td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> Alarma Prec.</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="alarmaamarilloinfo" style="display:inline">123456</output> [cel/ml]</td>'+
									  '</tr>'+

								'</table>'+
								'</div>'+

								'<div class="item">'+
									'<table class="table table-condensed" style="width:340px;margin-top:20px; margin-bottom:5px;">'+

									  '<tr>'+
										'<td valign="top" style="border-top: none;"><b> SIEP</b></td>'+
										'<td valign="top" style="border-top: none;">&nbsp;</td>'+
										'<td valign="top" style="border-top: none;"><b> : </b></td>'+
										'<td valign="top" style="border-top: none;">&nbsp;</td>'+
										'<td style="border-top: none;"><output id="infosiep" style="display:inline;">123456</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> ACS </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td valign="top" ><b> : </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td ><output id="infoacs" style="display:inline">11b</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> Estado </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td valign="top" ><b> : </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td ><output id="infoestado" style="display:inline">En Producción</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> Especie </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td valign="top" ><b> : </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td ><output id="infoespecie" style="display:inline">Salar</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> Siembra </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td valign="top" ><b> : </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td ><output id="infosiembra" style="display:inline">01-01-2018</output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> Cosecha </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td valign="top" ><b> : </b></td>'+
										'<td valign="top" >&nbsp;</td>'+
										'<td ><output id="infocosecha" style="display:inline">01-01-2019</output></td>'+
									  '</tr>'+

								 '</table>'+

								'</div>'+

								//'<div class="item">'+
								  //'<img src="ny.jpg" alt="New York">'+
								//'</div>'+
							  '</div>'+

							  //<!-- Left and right controls -->
							  '<a class="left carousel-control" style="margin-left:-60px;background: none; " href="#myCarousel" data-slide="prev">'+
								'<span class="glyphicon glyphicon-chevron-left" style="color:gray;font-size:20px;"></span>'+
								'<span class="sr-only">Previous</span>'+
							  '</a>'+
							 ' <a class="right carousel-control" style="margin-right:-60px;background: none;"  href="#myCarousel" data-slide="next">'+
								'<span class="glyphicon glyphicon-chevron-right" style="color:gray;font-size:20px;"></span>'+
								'<span class="sr-only">Next</span>'+
							  '</a>'+
							'</div>'+








     		      			'</div>'+
                           '</div>'+
                      	'</div>';

		infowindow = new google.maps.InfoWindow({
													  content: contentString,
													  width:292,
													  height:100,
													  maxwidth:1000,
													  pixelOffset: new google.maps.Size(-3,0)
												   });


		map.setCenter(mhlevel);

      }

	$("#myModalcentro").on("shown.bs.modal", function () {

		google.maps.event.trigger(map, "resize");
		map.setCenter(center);

	});






	$('body').delegate('#operandoswitch, #nooperandoswitch', 'lcs-statuschange', function() {
		 //$("#sidebarweek").change();
		 //$('#especiesselectmap').val(0);
		 loadcentros();
	});

	$('body').delegate('#nombreswitch', 'lcs-statuschange', function() {
		nombreMarkers();
	});



	$('body').delegate('#acsswitch', 'lcs-statuschange', function() {
		 //$("#sidebarweek").change();
		 if( $('#acsswitch').is(':checked') ){acsLayer.setMap(map);
		 }else {acsLayer.setMap(null);}
	});

	function asdfa(position,nombrecentro,idcentro,classindicador,espinfo,nocivainfo,encontradasinfo,nivelnocivoinfo,alarmarojoinfo,alarmaamarilloinfo){
		//map.getZoom() <= 10

		if( !$('#nombreswitch').is(':checked') ){nombrecentro = ' ';}
		 var  mi_marker = new google.maps.Marker({
			  position: position,
			  map: map,
			  label: {
				color: colorlabelmarker,
				fontWeight: 'bold',
				text: nombrecentro
			  },
			  title: nombrecentro,
			  id:idcentro,
			  icon: {
				url: classindicador,
				size: new google.maps.Size(20, 20),
				anchor: new google.maps.Point(8,8),
				labelOrigin: new google.maps.Point(10,23)
			  }
		  })
         markers.push({name: mi_marker,  index:  idcentro});

         google.maps.event.addListener(mi_marker,"click",function(){opencentro(this.id);});

		 //remove magin infowindow
		 google.maps.event.addListener(infowindow, 'domready', function() {
		   var iwOuter = $('.gm-style-iw');
		   var iwBackground = iwOuter.prev();
		   iwBackground.children(':nth-child(2)').css({'display' : 'none'});
		   iwBackground.children(':nth-child(4)').css({'display' : 'none'});

		   /*iwOuter.parent().parent().css({left: '115px'});

		   // Moves the shadow of the arrow 76px to the left margin.
			iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

			// Moves the arrow 76px to the left margin.
			iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});*/

			iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

			var iwCloseBtn = iwOuter.next();
			iwCloseBtn.css({'display': 'none'});




		});


		 //Ver Info Windows
		/* google.maps.event.addListener(mi_marker, 'mouseover', function(){

			 mouseoverTimeoutId = setTimeout(function() {
				 infowindow.open(map,mi_marker);
				 $('#infonombrecentro').text(datos['Nombre'][datos['IDcentro'].indexOf(idcentro)]);
				 $('#infosiep').text(datos['Codigo'][datos['IDcentro'].indexOf(idcentro)]);
				 $('#infoacs').text(datos['Barrio'][datos['IDcentro'].indexOf(idcentro)]);
				 $('#infoestado').text( datos['Estado'][datos['IDcentro'].indexOf(idcentro)] == 1 ? "Operando" : "No Operando");
				 $('#infoespecie').text(datos['Especie'][datos['IDcentro'].indexOf(idcentro)]);
				 $('#infosiembra').text(datos['Siembra'][datos['IDcentro'].indexOf(idcentro)]);
				 $('#infocosecha').text(datos['Cosecha'][datos['IDcentro'].indexOf(idcentro)]);
				 $('#espinfo').text(espinfo);
				 $('#nocivainfo').text(nocivainfo);
				 $('#encontradasinfo').text(encontradasinfo);
				 $('#nivelnocivoinfo').text(nivelnocivoinfo);
				 $('#alarmarojoinfo').text(alarmarojoinfo);
				 $('#alarmaamarilloinfo').text(alarmaamarilloinfo);
				 infowindow.open(map,mi_marker);

			  }, 400);


		 });
		 google.maps.event.addListener(mi_marker,'mouseout', function(){
		 	if(mouseoverTimeoutId){
				clearTimeout(mouseoverTimeoutId);
				mouseoverTimeoutId = null;
			}

       	});*/
		google.maps.event.addListener(map, "click", function(event) {
			infowindow.close(map);
		});

	 }

	 function eliminarArreglo (mi_indice){
		 var posicionkey = 0;
        $.each(markers, function (i, value) {
            if (value.index == mi_indice){
                element = value.name;
                element.setMap(null);
				posicionkey = i;
				return false;
            }
        });
		markers.splice(posicionkey,1) ;

     }

	 function clearMarkers (){
        $.each(markers, function (i, value) {
                element = value.name;
			    element.setMap(null);
        });
     }


	 function emptyMarkers (day){
		var centromidio = [];
		for (var i = 0; i<tablacompleta.length; i++){
			if(parseInt(tablacompleta[i][day]) >= 0){
				centromidio.push(tablacompleta[i]['IDcentro']);
			}
		}
		var iconoaux = sinmarker;
        $.each(markers, function (i, value) {

            if (centromidio.indexOf(value.index) >=0){iconoaux = "green1.png";}else{iconoaux = sinmarker;}

                element = value.name;
                element.setIcon({
					url: iconoaux,
					size: new google.maps.Size(20, 20),
					anchor: new google.maps.Point(8,8),
					labelOrigin: new google.maps.Point(10,23)
					});

			   	var label = element.getLabel();
				label.color = colorlabelmarker;
				element.setLabel(label);

        });
     }


	 function nombreMarkers (){
		 var nombrecentro = " ";

         $.each(markers, function (i, value) {
			 	if( !$('#nombreswitch').is(':checked') ){ nombrecentro = " ";}else{nombrecentro = nombrecentroarray[value.index];}
                element = value.name;
			   	var label = element.getLabel();
				label.text = nombrecentro;
				element.setLabel(label);

        });

     }


//
//	 function clearMarkers() {
//			for (var i = 0; i < markers.length; i++) {
//			  markers[i].setMap(null);
//			}
//			markers = [];
//		 }


	var nombreregion = "Región de los Lagos";
	$('#tabregion10, #tabregion11, #tabregion12').click( function(){
		nombreregion = this.value;
		center = "";
		zoom = 9;
		if(nombreregion == 10){
			center = xregion;
			//$("#imgregion").attr("src","img/region_10.png");
			nombreregion = "Región de los Lagos"
		}else if(nombreregion == 11){
			center = xiregion;
			zoom = 8;
			//$("#imgregion").attr("src","img/region_11.png");
			nombreregion = "Región de Aysén"
		}else if(nombreregion == 12){
			center = xiiregion;
			zoom = 8;
			//$("#imgregion").attr("src","img/region_12.png");
			nombreregion = "Región de Magallanes"
		}
		map.setCenter(center);
		map.setZoom(zoom);
		//loadcentros();
		//loadresumen();

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


	var selectedverindicador = ["3","2"];
	$('[name="multipleselect"]').multiselect({
		buttonWidth: '100%',
		nonSelectedText: 'No',
		includeSelectAllOption: true,
        allSelectedText: 'Todos',
		nSelectedText: ' - Seleccionados',
		onChange: function(element, checked) {
			var brands = $('#verindicador option:selected');
			selectedverindicador = [];
			$(brands).each(function(index, brand){
				selectedverindicador.push($(this).val());
			});

			loadresumen();
		},
		onSelectAll: function () {
			var brands = $('#verindicador option:selected');
			selectedverindicador = [];
			$(brands).each(function(index, brand){
				selectedverindicador.push($(this).val());
			});

			loadresumen();
		},
		onDeselectAll: function () {
			selectedverindicador = [];
			loadresumen();
		}
	});

	var dateinicio = new Date();
	dateinicio.setDate(dateinicio.getDate()-6);
	$('#datetimepickerinicio').datetimepicker({
    format: 'DD-MM-YYYY',
	defaultDate: dateinicio,
	});

	var datetermino = new Date();
	datetermino.setDate(datetermino.getDate());
	$('#datetimepickertermino').datetimepicker({
    format: 'DD-MM-YYYY',
	defaultDate: datetermino,
	});

	$(function () {
		$('#datetimepickerinicio').datetimepicker();
		$('#datetimepickertermino').datetimepicker({
			useCurrent: false //Important! See issue #1075
		});
		$("#datetimepickerinicio").on("dp.change", function (e) {
			$('#datetimepickertermino').data("DateTimePicker").minDate(e.date);
			loaddatagrafico(0,0);
		});
		$("#datetimepickertermino").on("dp.change", function (e) {
			$('#datetimepickerinicio').data("DateTimePicker").maxDate(e.date);
			loaddatagrafico(0,0);
		});
	});

	function cambiardia(dia){
		var fechadesde = document.getElementById("fechadesde").value;
		var fecha = new Date(fechadesde);
		var dateaux = new Date();
		if(dia == "anterior"){ dateaux.setDate(fecha.getDate()-1);}else{ dateaux.setDate(fecha.getDate()+1); }
		$('#datetimepickerinicio').data("DateTimePicker").date(dateaux);
		loaddatagrafico(0,0);
	}



	$( document ).ajaxStop(function () {
		$('#modalloading').modal('hide');
	});


	$( document ).ready(function() {
		loadcentros();
		$(document).on('click', '#opciones', function (e) {
		  e.stopPropagation();
		});

    $('#datetimepicker_filtro4_1').on('dp.change', function(e){
      var rowCount = $('#resumenreporte th').length;
  		var remove = "nth-last-child(-n+"+(rowCount-8)+")";
  		$('#resumenreporte').bootstrapTable('destroy');

  		$('#resumenreporte tr').find('th:'+remove+', td:'+remove+'').remove();
      $('#sidebarweek').bootstrapSlider('destroy');
      replaceElement($('#sidebarweek'));
  		loadresumen();
  	});

	});

function replaceElement($elem) {
  var html = $elem[0].outerHTML;
  var parent = $elem.parent();
  $elem.remove();
  $(html).appendTo(parent);
}





	function verarchivo(){
			$.ajax({
						url: "load_archivo_registro.php",
						type: 'post',
						data: {_token: "{{ csrf_token() }}",IDmedicion: idmedicionarchivo},
						success: function(dato)
						{

							var obj = dato;// JSON.parse(dato);
							window.open(obj['Archivo'], "_blank");
						}
					});


		};

	$('#opcionescentros').change( function(){
		map.setCenter($('#opcionescentros option:selected').data());
		map.setZoom(11);
		$('#opcionescentros').val(1);
	});


	$("#showcentros").hide();
	var datos = [];
	var opt = [];
	var nombrecentroarray = [];
	var markers = new Array();
	var fistcentermap = 1;
	function loadcentros() {
		datos = [];
		opt = [];

		$.ajax({
				url: "{{Route('mapas.load.ubicacion.centro')}}", //"load_ubicacion_centros.php",
				type: 'post',
				data: {
					_token: "{{ csrf_token() }}",
					user_id:			user_id,
					Nombre_Region: 	  nombreregion,
					Colaborativo:	   0,
					Operando:		   $('#operandoswitch').is(':checked') ? 1 : 0,
					Historia:		   $('#nooperandoswitch').is(':checked') ? 1 : 0,
				},
				success: function(dato)
				{

					datos = dato; //JSON.parse(dato);

					$( '#showcentros' ).empty();
					$('#opcionescentros').empty();

					if(datos['Error'] == 0){
						clearMarkers();
						var tex = "Buscar Centro";
						$('#opcionescentros').append($('<option hidden value ="1">Buscar Centro</option>'));
						//$('#opcionescentros').append('<optgroup  hidden value ="1" label="Buscar Centro" ></optgroup>');
						for(var i = 0; i < datos['Nombre'].length; i++){
							var topleft = datos['TopLeft'][i].split(",");
							 var position = {lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])};

							 asdfa(position,datos['Nombre'][i],datos["IDcentro"][i],sinmarker,"Sin Registro","-","-","-","-","-");

							 //cargar select buscar centro
						    $('#opcionescentros').append($('<option>', {
								data: position,
								text : datos['Nombre'][i]
							}));
							//Guarda los nombres de los centros para que al ocultar los nombres se puedan recuperar despues
							nombrecentroarray[datos["IDcentro"][i]] = datos['Nombre'][i];
						}

						 //$('#opcionescentros').multiselect( 'rebuild' );



						$("#showcentros").show();

						//Vista del centro correspondiente al usuario logeado

						if(datos['TopLeft_Usuario'] != "" && fistcentermap == 1){
							fistcentermap = 0;
							var topleftusuario = datos['TopLeft_Usuario'].split(",");
							var positionusuario = {lat: parseFloat(topleftusuario[0]), lng: parseFloat(topleftusuario[1])};
							map.setCenter(positionusuario);

                            if(id_empresa == 4){
                                console.log("entro a empresa 4444444444444444444");
                                center = {lat: -44.98, lng: -74.0};
                                zoom = 8;
                                map.setCenter(center);
                                map.setZoom(zoom);
                                $('#tabregion11').addClass("active");
                            }else{
                                $('#tabregion10').removeClass("active");
                                $('#tabregion11').removeClass("active");
                                $('#tabregion12').removeClass("active");
                                switch (datos['Region_Usuario']){
                                    case 'Región de los Lagos':
                                        $('#tabregion10').addClass("active");
                                        break;
                                    case 'Región de Aysén':
                                        $('#tabregion11').addClass("active");
                                        break;
                                    default:
                                        $('#tabregion12').addClass("active");
                                }
                            }




						}




					}else if(datos['Error'] == "No existe"){
						swal("", "No existen centros para los filtros", "warning");
						clearMarkers ();
					}else{swal("Error", "Error al cargar ubicación de los Centros.", "error");}
				},error: function(msg){console.log(msg);}
			});



			//Load opciones 
			$.ajax({
					url: "{{Route('mapas.load.options.prof')}}",//load_options_prof.php",
					type: 'post',
					dataType: 'json',
					data: {
						_token: "{{ csrf_token() }}",
						user_id:		user_id
					},
					success: function(dato)
					{

						if(dato != ""){
							opt = dato.split(",");
							$( '#nromedicion, #nromedicionresumen' ).empty();
							$('#nromedicionresumen').append($('<option>', {
									value: 0,
									text : "Máx. Concentración"
							}));
							$.each(opt, function (i, item) {
								$('#nromedicion, #nromedicionresumen').append($('<option>', {
									value: (i+1),
									text : opt[i]
								}));
							});
							$('#nromedicion').append($('<option>', {
									value: 8,
									text : "Máx Concentración"
							}));

							$('#nromedicion').append($('<option>', {
									value: "todo",
									text : "Todo"
							}));

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

								//$('#'+tabla).bootstrapTable('destroy');
								for(var i = 0; i<opt.length; i++){

									//Modal Ver
									$('#'+tabla+'ver').bootstrapTable('showColumn', 'Medicion_'+(i+1));

									//Modal Print
									$('#'+tabla+'verprint').bootstrapTable('showColumn', 'Medicion_'+(i+1));
								}

								//$('#'+tabla).bootstrapTable();

								for(var i = 0; i<opt.length; i++){
									//Modal Ver
									$('#'+tabla+'ver thead [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);

									//Modal Print
									$('#'+tabla+'verprint [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
								}

								$('#'+tabla).bootstrapTable('refresh');
							}
						}
						loadresumen();

					}
			});


	}



	var idcentroactual = 0;
	function opencentro(idcentro){//idcentro = 1;

		$('#modalnombrecentro').text(datos["Nombre"][ datos["IDcentro"].indexOf(String(idcentro)) ]);
		idcentroactual = idcentro;
		$('#myModalgrafico').modal('show');

	}
	// Grafica despues de abrir el modal
	$("#myModalgrafico").on("shown.bs.modal", function () {
		$("#nromedicion").val(8);
		loaddatagrafico(0,0);
	});






	var dato = [];
	function loaddatagrafico(axesmax,axesmin){

		dato = [];
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: "{{Route('mapas.load.historial.centros')}}",//load_historial_centros.php",
			type: 'post',
			dataType: 'json',
			data: {
				_token: "{{ csrf_token() }}",
				IDcentro:		 idcentroactual,
				Fecha_Inicio: 	 document.getElementById("fechadesde").value,
				Fecha_Termino: 	document.getElementById("fechahasta").value,
				Axesmax:	      axesmax,
				Axesmin:		  axesmin,
				Especies: 	     parseInt(document.getElementById("especiesselect").value),
				Medicion: 	     parseInt(document.getElementById("medicion_interna").value)
			},
			success: function(datoshist)
			{

				dato = []
				if(datoshist['Error'] == 0){
					dato = datoshist;
					if(datoshist['Nombre'] || parseInt(document.getElementById("especiesselect").value) == 0 ){
						graficar();
					}else{
						$('#especiesselect').val(0);
						$('#especiesselect').change();
					}

				}else{swal("Error", "Error al traer los datos.", "error");}
			},
			error: function(result) {
				//console.log(result);
			}
		});
		//graficar();

	}


	$('#nromedicion, #nivel' ).change( function(){
		if($('#nivel').val() == 0 && dato['Critico'] == 0){
			alert("No se puede graficar en porcentaje porque existen especies sin nivel nocivo definido");
			$('#nivel').val(1);
		}else{
			graficar();
		}
	});

	$('#especiesselect' ).change( function(){
		if(document.getElementById("especiesselect").value == 2){
			document.getElementById("nivel").value = 0;
		}else{document.getElementById("nivel").value = 1;}
		loaddatagrafico(0,0);
	});

	$('#medicion_interna' ).change( function(){
		loaddatagrafico(0,0);
	});



	//Para esconder el tooltip cuando se hace click fuera de el
	$(document).mouseup(function(e)
	{
		var container = $("#tooltip");
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(e.target) && container.has(e.target).length === 0)
		{
			container.hide();
		}
	});

	var data_grafico = Array();
	var data_grafico2 = Array();
	var choiceContainer = $("#choices");
	var nromedicion = "";
	var fechamedicion = "";
	function graficar(){
		$('#modalloading').modal('hide');
		$('#choicesall').prop('checked', true);
		$('#choicesdiato').prop('checked', false);
		$('#choicesdino').prop('checked', false);
		data_grafico = [];
		data_grafico2 = [];
		$('#placeholder').empty();
		$('#legendholder').empty();
		var medicion = document.getElementById("nromedicion").value;
		var todo = 1;
		var prof = "";
		var nivel = "";
		var axislabel = "Concentración [cel/ml]";
		var maxy = null;
		var med = 0;
		opt[7] = "Máx.";
		if(medicion == "todo"){todo = (opt.length-1);}else{ med = parseInt(medicion); }
		if(document.getElementById("nivel").value == 0){
			nivel = "norm"; axislabel = "Nivel Nocivo [%]"; maxy = (dato['Max_norm'][med]*1.1); $('#nota').show();
		}else{
			$('#nota').hide(); maxy = dato['Max'][med]*1.3;
		}

		if(dato['Nombre']){
			for(var t = 1; t <= todo; t++){
				var medicionaux = medicion;
				if(medicion == "todo"){medicionaux = t;}

				for(var i= 0; i<dato['Nombre'].length; i++){
					if(dato.hasOwnProperty( dato['Nombre'][i].concat(medicionaux).concat(nivel)) ){

						data_grafico.push({label: opt[medicionaux-1].concat(" ").concat(dato['Nombre'][i]),data:dato[dato['Nombre'][i].concat(medicionaux).concat(nivel)],lines: {show: true}, points: {show: true}, name:dato['Grupo'][i], lab:0  });
					}

					//Agregar externo con marcador distinto
					if(dato.hasOwnProperty( dato['Nombre'][i].concat(medicionaux).concat(nivel).concat("_ext")) ){
						data_grafico2.push({label: false, data:dato[dato['Nombre'][i].concat(medicionaux).concat(nivel).concat("_ext")],lines: {show: false},points: {show: true, symbol: "circle", fillColor: "black", radius:2, lineWidth:0 }, name:dato['Grupo'][i], lab: 1, nombre: opt[medicionaux-1].concat(" ").concat(dato['Nombre'][i]).concat("_ext") });
					}
				}
			}
		}

		var i = 3;
		$.each(data_grafico, function(key, val) {
			val.color = i;
			++i;
		});

		//Color marcador medición externa
		/*$.each(data_grafico2, function(key, val) {
			val.color = 1;
		});*/




		data_grafico = data_grafico.concat(data_grafico2);


		if(nivel != ""){
			data_grafico.push({label:"Nivel Nocivo", data:[[dato['F_Min'],100,maxy],[dato['F_Max'],100,maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }}});

		}

		// insert checkboxes
		//var choiceContainer = $("#choices");



		choiceContainer.empty();
		$.each(data_grafico, function(key, val) {
			var hidden = "";
			var salto = "<br>";
			if(val.lab == 1){ hidden = "hidden"; salto = "";}
			choiceContainer.append(salto+"<input type='checkbox' class='"+hidden+"' value = '"+val.name+"' name='" + key +
				"' checked='checked' id='id" + key + "' onClick='clickext(\"" + val.label + "\","+key+")'>" +
				"<span class='"+hidden+"' style='margin-bottom: 10px;' for='id" + key + "'>"
				+ val.label + "</span>");
		});



		choiceContainer.find("input").click(plotAccordingToChoices);

		var data2 = [];
		function plotAccordingToChoices() {
			data2 = [[]];
			//data2.push([]);

			choiceContainer.find("input:checked").each(function () {

				var key = $(this).attr("name");
				if (key && data_grafico[key]) {
					data2.push(data_grafico[key]);
				}
			});

			if (data2.length > 0) {
				plot = $.plot("#placeholder", data2, {
					axisLabels: {
						show: true
					},
					xaxis:  {
						axisLabel: 'Fecha Muestra',
						mode: "time",
						timeformat : "%d-%m-%Y",  // %H:%M:%S
						timezone: "browser",
						zoomRange: [dato['F_Min'], dato['F_Max']],
						panRange: [dato['F_Min'], dato['F_Max']],
						distribution: 'linear'
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
			}


		}

		plotAccordingToChoices();

		window.onresize = function(event) {
			//plot.setData = ([data]);
			plot = $.plot("#placeholder", data2,
			{
				axisLabels: {
						show: true
					},
				xaxis:  { axisLabel: 'Fecha Muestra', mode: "time",timeformat : "%d-%m-%Y ", timezone: "browser",zoomRange: [dato['F_Min'], dato['F_Max']],panRange: [dato['F_Min'], dato['F_Max']], distribution: 'linear'},
				series: {
					lines: {
						show: true
					},
					points: {
						show: true
					}
				},
				legend: {position: "nw",placement: 'outsideGrid',container: $('#legendholder') },
				grid: {
					hoverable: true,
					clickable: true
				},
				axisLabels: { show: true},
				yaxis: {
					zoomRange: [0, maxy],
					panRange: [0, maxy],
					axisLabel: 'Nivel Nocivo [%]',
					min: 0,
					max: maxy
				},
				zoom:   {interactive: true},
				pan:    {interactive: false},
				selection: {mode: "xy"}

			});
		};


		$("<div id='tooltip'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			"z-index": 100000,
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body");

		$("#placeholder").bind("plothover", function (event, pos, item,a,b,c,d) {

				if (item && item.series.label != "Nivel Nocivo") {
					var x = item.series.data[item.dataIndex][2];
						y = item.series.data[item.dataIndex][3]; if(y == null){y = "-";}
						f = item.series.data[item.dataIndex][5];

					var label_especie = item.series.label;
					var intext = "Interna";
					if(item.series.lab == 1){
						label_especie = item.series.nombre;
						label_especie = label_especie.substring(0, label_especie.length-4);
						intext = "Externa";
					}

					$("#tooltip").html(label_especie + " <br> <b> Medicion: </b>" + intext + " <br><b> Fecha Muestra: </b>" + f + " <br><b>Encontradas: </b>" + x + " [cel/ml] <br> <b>Nivel Nocivo: </b>" + y + " [cel/ml] <br>(CLICK PARA VER REGISTRO)")
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);

					document.body.style.cursor = 'pointer';
				} else {
					$("#tooltip").hide();
					document.body.style.cursor = 'default';
				}

		});

		$("#placeholder").unbind('plotclick').bind("plotclick", function (event, pos, item) {
			if (item && item.series.label != "Nivel Nocivo") {

				tablasverreporte(item.series.data[item.dataIndex][4]);
				nromedicion = item.series.data[item.dataIndex][4];
				fechamedicion = item.series.data[item.dataIndex][4];

				//$("#descargarpdf").attr("href", "archivos/Registros_Alarma/descargar_registro.php?i="+user_id+"&m="+item.series.data[item.dataIndex][4]+"&a= &c="+$('#modalnombrecentro').text()+"&f="+item.series.data[item.dataIndex][4]);
				$('#myModalverreporte').modal('show');
			}
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





	}

	$("#descargarpdf").click( function(){
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
					url: "archivos/Registros_Alarma/generar_registro.php",
					type: 'post',
					dataType: 'json',
					data: {
						_token: "{{ csrf_token() }}",
						f:	fechamedicion,
						c:	$('#modalnombrecentro').text(),
						a:	"",
						m:  	parseInt(nromedicion),
						i:    user_id
					},
					success: function(dato)
					{
						//window.open("archivos/Registros_Alarma/descargar_registro.php?n="+dato, "_blank");
						window.location.href = "archivos/Registros_Alarma/descargar_registro.php?n="+dato;
						$('#modalloading').modal('hide');
					},
					error: function(msg)
					{
						console.log(msg);

					}
			});
	});

	$('#choicesall').click(function(){
			var check = false;
			if($('#choicesall').prop('checked')){
				check = true;
				$('#choicesdiato').prop('checked', false);
				$('#choicesdino').prop('checked', false);
			}
			choiceContainer.find("input").each(function (index) {

				if(index != 0){
					$(this).prop('checked', check);
				} else{ $(this).prop('checked', !check);}
			});

			$("#id0").click();
		});

	$('#choicesdiato').click(function(){
			var first = 0;
			var id = "";
			if($('#choicesdiato').prop('checked')){
				$('#choicesall').prop('checked', false);
				$('#choicesdino').prop('checked', false);

				choiceContainer.find("input").each(function (index) {
					if($(this).attr("value") == "Diatomeas"){
						if(first == 0){
							id = $(this).attr("id");
							$(this).prop('checked', false);
						}else{

							$(this).prop('checked', true);
						}
						first = 1;
					}else{ $(this).prop('checked', false);}
				});

				if(first == 1){
					$("#"+id).click();
				}else{
					$("#id0").prop('checked', true);
					$("#id0").click();
				}

			}


	});

	$('#choicesdino').click(function(){
			var first = 0;
			var id = "";
			if($('#choicesdino').prop('checked')){
				$('#choicesall').prop('checked', false);
				$('#choicesdiato').prop('checked', false);

				choiceContainer.find("input").each(function (index) {
					if($(this).attr("value") == "Dinoflagelados"){
						if(first == 0){
							id = $(this).attr("id");
							$(this).prop('checked', false);
						}else{
							$(this).prop('checked', true);
						}
						first = 1;
					}else{ $(this).prop('checked', false);}
				});

				if(first == 1){
					$("#"+id).click();
				}else{
					$("#id0").prop('checked', true);
					$("#id0").click();
				}

			}


	});

	function clickext(label,id) {
			var id_ext = "";
			$.each(data_grafico, function(key, val) {
				if(label.concat("_ext") == val.nombre){
					id_ext = key;
				}
			});

			if($('#id'+id).is(':checked')){
				$('#id'+id_ext).prop('checked', true);
			}else{
				$('#id'+id_ext).prop('checked', false);
			}

		}

	//$("#placeholder").bind("plotpan plotzoom",function (event, pos, item) {
//
//				var axes = plot.getAxes();
//				axesmax = axes.xaxis.max.toFixed(0);
//				axesmin = axes.xaxis.min.toFixed(0);
//
//			setTimeout(function() {
//				loaddatagrafico(axesmax,axesmin);
//				console.log(axesmin);
//			}, 200);
//
//
//		});


  var idmedicionarchivo = "";
	function tablasverreporte(IDmedicion){

			$('#tabladiatomeasver').bootstrapTable("removeAll");
			$('#tabladinoflageladosver').bootstrapTable("removeAll");
			$('#tablaoespeciesver').bootstrapTable("removeAll");
			$('[name="outputver"]').text("");
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: "{{Route('mapas.load.fan.reporte')}}",//load_fan_reporte.php",
					type: 'post',
					data: {
						_token: "{{ csrf_token() }}",
						IDmedicion: 	 IDmedicion,
						user_id:		user_id
					},
					success: function(msg)
					{
						$('#modalloading').modal('hide');
						if(msg != 0){
							var datos2 = msg;// JSON.parse(msg);
							$('#tabladiatomeasver').bootstrapTable("load", datos2['Diatomeas']);
							$('#tabladinoflageladosver').bootstrapTable("load", datos2['Dinoflagelados']);
							$('#tablaoespeciesver').bootstrapTable("load", datos2['OEsp']);
							$('#fechaverreporte').text(datos2['Fecha_Reporte']);
							$('#fechaanalisisverreporte').text(datos2['Fecha_Analisis']);
							$('#fechaenvioverreporte').text(datos2['Fecha_Envio']);
							$('#tecnicaverreporte').text(datos2['Tecnica']);
							$('#obsverreporte').text(datos2['Observaciones']);

              var texto = '';
              if (datos2['Modulo']) {
                texto = texto + 'Módulo '+ datos2['Modulo'];
              }
              if (datos2['Jaula']) {
                var coma = '';
                if (texto != '') {
                  coma = ', ';
                }
                texto = texto + coma +' Jaula '+ datos2['Jaula'];
              }
              if (datos2['latitud']['deg']) {
                var coma = '';
                if (texto != '') {
                  coma = ', ';
                }
                texto = texto + coma + ' Latitud: S '+ datos2['latitud']['deg']+'° '+datos2['latitud']['min'] +"' "+ datos2['latitud']['sec'] +'"';
                texto = texto + coma + ' Longitud: O '+datos2['longitud']['deg']+'° '+datos2['longitud']['min'] +"' "+ datos2['longitud']['sec'] +'"';
              }

              $('#ubicacionverreporte').text(texto);
              if (texto != '') {
                $('#hidden_ubicación').removeClass('hidden');
              }else{
                $('#hidden_ubicación').addClass('hidden');
              }

			  var nombrearchivo = "";
								if(datos['Archivo']){
								  html= '<a style="display:inline;"  class="like eliminar_doc_'+0+'" href=\"{{Route("registro.get.archivo")}}/'+datos['Archivo']['IDdocumento']+'\" target="_blank" > '
											  + datos['Archivo']['Titulo']+ 
												  ' </a> ';
								  $('#archivoverreporte').html(html);}
							//$('#archivoverreporte').text(nombrearchivo);
							$('#firmaverreporte').text(datos2['Firma']);
							$('#nombreverreporte').text(datos2['Nombre']);
							$('#acsverreporte').text(datos2['Barrio']);
							$('#especieverreporte').text(datos2['Especie']);
              $('#pecesverreporte').text(datos2['Mortalidad']);
							$('#siepverreporte').text(datos2['Codigo']);
							$('#siembraverreporte').text(datos2['Siembra']);
							$('#cosechaverreporte').text(datos2['Cosecha']);

							//Print
							$('#tabladiatomeasverprint').bootstrapTable("load", datos2['Diatomeas']);
							$('#tabladinoflageladosverprint').bootstrapTable("load", datos2['Dinoflagelados']);
							$('#tablaoespeciesverprint').bootstrapTable("load", datos2['OEsp']);
							$('#fechaverreporteprint').text(datos2['Fecha_Reporte']);
							$('#fechaenvioverreporteprint').text(datos2['Fecha_Envio']);
							$('#tecnicaverreporteprint').text(datos2['Tecnica']);
							$('#obsverreporteprint').text(datos2['Observaciones']);
							$('#archivoverreporteprint').text(nombrearchivo);
							$('#firmaverreporteprint').text(datos2['Firma']);
							$('#nombreverreporteprint').text(datos2['Nombre']);
							$('#especieverreporteprint').text(datos2['Especie']);
							$('#siembraverreporteprint').text(datos2['Siembra']);
							$('#cosechaverreporteprint').text(datos2['Cosecha']);

							idmedicionarchivo = IDmedicion;
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

			//Parámetros Ambientales
			$.ajax({
					url: "{{Route('mapas.load.pambientales.reporte')}}",//load_pambientales_reporte.php",
					type: 'post',
					data: {
						_token: "{{ csrf_token() }}",
						IDmedicion: 	 IDmedicion,
						user_id:		user_id
					},
					success: function(msg)
					{
						$('#tablapambientalesver').bootstrapTable("removeAll");
						$('#tablapambientalesotrosver').bootstrapTable("removeAll");
						if(msg != 0){
							var datos2 = datos2; //JSON.parse(msg);
							$('#tablapambientalesver').bootstrapTable("load", datos2['PAmbientales']);
							$('#tablapambientalesotrosver').bootstrapTable("load", datos2['PAmbientalesotros']);

							//Print
							$('#tablapambientalesverprint').bootstrapTable("load", datos2['PAmbientales']);
							$('#tablapambientalesotrosverprint').bootstrapTable("load", datos2['PAmbientalesotros']);
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

	}

	function runningFormatterreporte(value, row, index) {
		return (index + 1);
	}
	function runningFormatterfoto(value, row, index) {
		return '<img href="'+row['Imagen']+'" src="'+row['Imagen']+'" class="img-circle center-block" />';
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


	$('#tablapambientalesotrosver').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx2.length ; i++){
        	$('#tablapambientalesotrosver').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
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

	$('#tablapambientalesverprint, #tablapambientalesotrosverprint').bootstrapTable({
		formatLoadingMessage: function () {
			return '';
		}
	});




	 $('#print').click( function(){
		var prtContent = document.getElementById("myModalgrafico");

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

		WinPrint.document.write('</body></html>');


		WinPrint.document.close();
		WinPrint.focus();//WinPrint.print();
		setTimeout(function(){WinPrint.print();},700);


	});



	function sendreporte(WinPrint){
		$.ajax({
					url: "{{Route('mapas.send.reporte')}}",//send_reporte.php",
					type: 'post',
					data: {
						_token: "{{ csrf_token() }}",
						Page: WinPrint
					},
					success: function(msg)
					{

					}
		});
	}

	$('#especiesselectmap' ).change( function(){
		//if($('#especiesselectmap option:selected').val() == 0 || $('#especiesselectmap option:selected').val() == 1 || $('#especiesselectmap option:selected').val() == 2){
//
//			$('#resumenreporte').bootstrapTable('resetSearch','');
//			//loadresumen();
//		}else{

				var sel = $('#especiesselectmap option:selected').val();
				if(sel == 1){
					$('#resumenreporte').bootstrapTable('resetSearch','Fiscalizada');
					//$('#resumenreporte').bootstrapTable('onColumnSearch','Fiscaliza','Si');
				}else if(sel < 2){
					$('#resumenreporte').bootstrapTable('resetSearch','');
				}else if(sel == 2){
					$('#resumenreporte').bootstrapTable('resetSearch','Nociva');
				}else{
					$('#resumenreporte').bootstrapTable('resetSearch',$('#especiesselectmap option:selected').text());
				}

		//}
		$("#sidebarweek").change();
	});
	$('#nromedicionresumen' ).change( function(){
		loadresumen();
		$("#sidebarweek").change();
	});


	$('#dias' ).change( function(){
		if($('#dias' ).val()>14){
			$('#dias' ).val(14);
		}else if($('#dias' ).val()>=7){
		var rowCount = $('#resumenreporte th').length;
		var remove = "nth-last-child(-n+"+(rowCount-7)+")";
		$('#resumenreporte').bootstrapTable('destroy');

		$('#resumenreporte tr').find('th:'+remove+', td:'+remove+'').remove();
		loadresumen();
		}else{$('#dias' ).val(7);}
	});

  var date1 = new Date();
  date1.setDate(date1.getDate()-6);
  $('#datetimepicker_filtro4_1').datetimepicker({
  			locale: 'es',
  			defaultDate: date1,
  			format: 'DD-MM-YYYY',

  });

	var tablacompleta = [];
	var especiesselectmap_anterior = "";
	function loadresumen(){
		//Variables para mantener los filtros al cambiar opciones
		var dias = document.getElementById("dias").value;
		especiesselectmap_anterior = $('#especiesselectmap option:selected').text();
		//parseInt(document.getElementById("especiesselectmap").value)
		$('#loading1').removeClass("hidden");
		$.ajax({
				url: "{{Route('mapas.load.resumen.reporte')}}",//load_resumen_reporte.php",
				type: 'post',
				data: {
					_token: "{{ csrf_token() }}",
					user_id:			user_id,
					Nombre_Region: 	  nombreregion,
					Dias: 	 		   dias,
					Especies:		   document.getElementById("especiesselectmap").value,
					Medicion:		   parseInt(document.getElementById("nromedicionresumen").value),
					Colaborativo:	   0,
					Operando:		   $('#operandoswitch').is(':checked') ? 1 : 0,
					Historia:		   $('#nooperandoswitch').is(':checked') ? 1 : 0,
          fecha_filtro_1:	 $('#fecha_filtro_4_1').val()

				},
				success: function(dato)
				{

					var myobjaux = dato;//JSON.parse(dato);

					var myobj = myobjaux['Resultado'];
					tablacompleta = myobj;
					var cantcol = $('th', $('#resumenreporte').find('thead')).length;
					//if(cantcol != (parseInt(dias)+7)){
						$('#resumenreporte').bootstrapTable('destroy');

						// Agrega las nuevas columnas
						for(var i = myobj[myobj.length-1].length-1; 0<=i; i--){
							var th = '<th data-field="'+i+'" id="asd" data-sortable="false" data-switchable="false" class="" data-valign = "middle"  data-width = "90px" data-cell-style="cellStylenivelestabla"></th>';
							$('#resumenreporte tr').append($(th));
							$('#resumenreporte thead tr>th:last').html(myobj[myobj.length-1][i]+'<br> [cel/ml]');
						}



					//}

					var role = <?php echo '"'.$miuser->role.'"';?>;
					if(role != "admin_fan_empresa"){
						$('#resumenreporte').bootstrapTable();
					}else{
						$('#resumenreporte').bootstrapTable({
							showExport: true//exportTypes: ['json', 'xml', 'csv', 'txt', 'sql', 'excel', 'pdf'],
						}).trigger('change');
					}

					//Slider ticks-labels

					$('#sidebarweek').bootstrapSlider({
					  formatter: function(value) {
						return 'Current value: ' + value;
					  },
					  ticks_labels: [myobj[myobj.length-1][6], myobj[myobj.length-1][5], myobj[myobj.length-1][4], myobj[myobj.length-1][3], myobj[myobj.length-1][2], myobj[myobj.length-1][1], myobj[myobj.length-1][0]]
					  //ticks_labels: ['$0', '$100', '$200', '$300', '$400']
					});

					myobj.splice(myobj.length-1,1);

					$('#resumenreporte').bootstrapTable("removeAll");
					$('#resumenreporte').bootstrapTable("load", myobj);


					//Agregar lista especie en select
					var tabladata = tablacompleta;//$('#resumenreporte').bootstrapTable('getData');
					var listaespecies = [];
					for (var i = 0; i<tabladata.length; i++){
						if(listaespecies.indexOf(tabladata[i]['Especie']) === -1){listaespecies.push(tabladata[i]['Especie']);}
					}
					listaespecies.sort();
					$('#especiesselectmap').empty();
					$('#especiesselectmap').append($('<option>', {
						text : 'Todas las Especies',
						value: 0
					}));

					$('#especiesselectmap').append($('<option>', {
						text : 'Especies Nocivas',
						value: 2
					}));
					$('#especiesselectmap').append($('<option>', {
						text : 'Especies Fiscalizadas',
						value: 1
					}));
					$('#especiesselectmap').append($('<option>', {
						text : 'Diatomeas',
						value: 4
					}));
					$('#especiesselectmap').append($('<option>', {
						text : 'Dinoflagelados',
						value: 3
					}));
          $('#especiesselectmap').append($('<option>', {
						text : 'Crítico y Precaución',
						value: 5
					}));

					$('#especiesselectmap').append('<optgroup label="" disabled></optgroup>');
					$('#especiesselectmap').append('<optgroup label="Especies Encontradas" disabled></optgroup>');
					for(var i = 0; i<listaespecies.length; i++){
						$('#especiesselectmap').append($('<option>', {
							text : listaespecies[i]
						}));
					}
					//$('#especiesselectmap').multiselect( 'rebuild' );

					//Volver al filtro seleccionado antes de modificar alguna opción
					if(especiesselectmap_anterior != ""){
					//	$("#especiesselectmap option:contains("+especiesselectmap_anterior+")").attr('selected', true);
					}

					$('#resumenreporte').bootstrapTable('resetSearch','');
					$("#sidebarweek").change();
					//$('#especiesselectmap').val(2).trigger('change');

					$('#loading1').addClass("hidden");

				}
			});

	}


	//Slider

	$(document).on('change','#sidebarweek', function(){

		//console.log(6-$("#sidebarweek").val());
		var day = 6-$("#sidebarweek").val();
		var tabladata = $('#resumenreporte').bootstrapTable('getData');
		var esp = $('#especiesselectmap option:selected').text();
		var nociva = fisc = grupo = "asd";
		if(esp == "Especies Fiscalizadas"){esp = "Si"; fisc = "Fiscalizada";}else if(esp == "Especies Nocivas"){esp = "Si"; nociva = "Nociva";
		}else if(esp == "Diatomeas"){esp = "Si"; grupo = "Diatomeas";}else if(esp == "Dinoflagelados"){esp = "Si"; grupo = "Dinoflagelados";}
		var classindicador = "";
		var indicadorcentro = "";
		var idcentro = "";
		var idcentronuevo = "";
		var alarma = 0;
		var espinfo = "Sin Registro";
		var nocivainfo = "-";
		var encontradasinfo = "-";
		var nivelnocivoinfo = "-";
		var alarmarojoinfo = "-";
		var alarmaamarilloinfo = "-";
    var  topleft = '';

		emptyMarkers(day);
		for (var i = 0; i<tabladata.length; i++){


				idcentro = tabladata[i]['IDcentro'];
				if(i == 0){idcentronuevo = idcentro; }

				if(idcentro != idcentronuevo){

					switch (alarma){
						case 0:
							classindicador = sinmarker;
							break;
						case 1:
							classindicador = "green1.png";
							break;
						case 2:
							classindicador = "gray1.png";
							break;
						case 3:
							classindicador = "yellow1.png";
							break;
						case 4:
							classindicador = "red1.png";
							break;
					}


					eliminarArreglo(idcentronuevo);
          if (topleft == '') {
          	topleft = tabladata[i-1]['TopLeft'].split(",");
          }
					asdfa({lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])},tabladata[i-1]['Centro'],idcentronuevo,classindicador,espinfo,nocivainfo,encontradasinfo,nivelnocivoinfo,alarmarojoinfo,alarmaamarilloinfo);


					idcentronuevo = idcentro;
					//if( !(alarma >= 0)){
						alarma = 0
					//};
					espinfo = "Sin Registro";
					nocivainfo = "-";
					encontradasinfo = "-";
					nivelnocivoinfo = "-";
					alarmarojoinfo ="-";
					alarmaamarilloinfo ="-";
          topleft = '';
				}

				if( esp == "Todas las Especies" || ( tabladata[i]['Especie'] == esp || tabladata[i]['Fiscaliza'] == fisc || tabladata[i]['Nociva'] == nociva ) || tabladata[i]['Grupo'] == grupo ){
          var topleft_aux = '';
          if (tabladata[i][day+'_TopLeftM'] != null) {
            topleft_aux = tabladata[i][day+'_TopLeftM'].split(",");
          }
          if(parseInt(tabladata[i][day]) >= parseInt(tabladata[i]["Alarma_Rojo"]) && parseInt(tabladata[i]["Alarma_Rojo"])>0 ){
						if(alarma < 4){alarma = 4; topleft = topleft_aux;};
					}else if(parseInt(tabladata[i][day]) >= parseInt(tabladata[i]["Alarma_Amarillo"]) && parseInt(tabladata[i]["Alarma_Amarillo"])>0){
						if(alarma < 3){alarma = 3; topleft = topleft_aux;}
					}else if(parseInt(tabladata[i][day]) > 0){
						if(alarma < 2){alarma = 2; topleft = topleft_aux;}
					}else if(parseInt(tabladata[i][day]) == 0){
						if(alarma < 1){alarma = 1; topleft = topleft_aux;}
					}

					if(parseInt(tabladata[i][day])){
						espinfo = tabladata[i]["Especie"];
						nocivainfo = tabladata[i]["Nociva"] == "" ? "-" : tabladata[i]["Nociva"];
						encontradasinfo = parseInt(tabladata[i][day]);
						nivelnocivoinfo = tabladata[i]["Nivel_Critico"];
						alarmarojoinfo = tabladata[i]["Alarma_Rojo"];
						alarmaamarilloinfo = tabladata[i]["Alarma_Amarillo"];
					}
					//if(idcentro == "152")	{
					//console.log("IDcentro: "+idcentro+"  Alarma: "+alarma+" Value: "+tabladata[i][day]+ " Alarma_Rojo: "+tabladata[i]["Alarma_Rojo"]+ " Especie: "+tabladata[i]["Especie"]);
					//}
				}



				//Ultimo
				if(i == (tabladata.length - 1)){

					switch (alarma){
						case 0:
							classindicador = sinmarker;
							break;
						case 1:
							classindicador = "green1.png";
							break;
						case 2:
							classindicador = "gray1.png";
							break;
						case 3:
							classindicador = "yellow1.png";
							break;
						case 4:
							classindicador = "red1.png";
							break;
					}
					//if(idcentro == "152")	{
					//console.log("IDcentro: "+idcentro+"  Alarma: "+alarma+" Value: "+tabladata[i][day]+ " Alarma_Rojo: "+tabladata[i]["Alarma_Rojo"]+ " Especie: "+tabladata[i]["Especie"]);
					//}
					eliminarArreglo(idcentro);
          if (topleft == '') {
          	topleft = tabladata[tabladata.length - 1]['TopLeft'].split(",");
          }
					// topleft = tabladata[tabladata.length - 1]['TopLeft'].split(",");
					asdfa({lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])},tabladata[tabladata.length - 1]['Centro'],idcentro,classindicador,espinfo,nocivainfo,encontradasinfo,nivelnocivoinfo,alarmarojoinfo,alarmaamarilloinfo);


				}




		}




	});










	$('#resumenreporte').on('click-cell.bs.table',function(field, value, row, $element){
		opencentro($element['IDcentro']);
	});


	function runningFormatterfiscalizada(value, row, index) {

		if (row['Fiscaliza'] == "Si"){
			return "Fiscalizada";
		}else {return row['Fiscaliza'];}

	}


	var samegrupo3 = 0;
	var res3 = 0;
	var n3 = 0;
	var rowsp3 = [];
	var indx3 = [];
	var samegrupo4 = 0;
	var res4 = 0;
	var n4 = 0;
	var rowsp4 = [];
	var indx4 = [];
  var samegrupo5 = 0;
	var res5 = 0;
	var n5= 0;
	var rowsp5 = [];
	var indx5 = [];
	var lastindex = 0;
	function runningFormatterarea(value, row, index) {

		var grupo = row['Area'];


		if(samegrupo3 != grupo ){

			rowsp3[n3] = index-res3;
			indx3[n3] = index;
			n3++;
			res3 = index;
			samegrupo3 = grupo;

		}
		rowsp3[n3] = index-res3+1;

		var centro = row['Centro'];
		if(samegrupo4 != centro ){

			rowsp4[n4] = index-res4;
			indx4[n4] = index;
			n4++;
			res4 = index;
			samegrupo4 = centro;
			lastindex = index;

		}
		rowsp4[n4] = index-res4+1;

    var acs = row['ACS'];
		if(samegrupo5 != acs ){

			rowsp5[n5] = index-res5;
			indx5[n5] = index;
			n5++;
			res5 = index;
			samegrupo5 = acs;
			lastindex = index;

		}
		rowsp5[n5] = index-res5+1;

		return (index-lastindex)+1;
	}

  function runningFormattercritico_precaucion(value, row, index) {
    console.log(Math.max(row[0], row[0]));
    console.log('ada');

    if(value >= parseInt(row['Alarma_Amarillo']) && parseInt(row['Alarma_Amarillo']) > 0){
      return 'Crítico y Precaución';
    }
  }
	$('#resumenreporte').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx3.length ; i++){
        	$('#resumenreporte').bootstrapTable('mergeCells', {index: indx3[i], field: "Area", colspan: 1, rowspan: rowsp3[i+1]});
		}
    });
	$('#resumenreporte').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx4.length ; i++){
        	$('#resumenreporte').bootstrapTable('mergeCells', {index: indx4[i], field: "Centro", colspan: 1, rowspan: rowsp4[i+1]});
		}
    });
  $('#resumenreporte').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx5.length ; i++){
        	$('#resumenreporte').bootstrapTable('mergeCells', {index: indx5[i], field: "ACS", colspan: 1, rowspan: rowsp5[i+1]});
		}
    });

	function cellStylenivelestabla(value, row, index) {


		var classes = ['label-green','label-gray','label-yellow','label-red'];
		var aux = 0;
		var value = parseInt(value);
		if(value == 0){
			if(selectedverindicador.indexOf("0") >=0){
				aux=classes[0];
			}
		}else if(value > 0){
			if(selectedverindicador.indexOf("1") >=0){
				aux=classes[1];
			}
		}
		if(value >= parseInt(row['Alarma_Rojo']) && parseInt(row['Alarma_Rojo']) > 0){
			if(selectedverindicador.indexOf("3") >=0){
				aux=classes[3];
			}
		}else if(value >= parseInt(row['Alarma_Amarillo']) && parseInt(row['Alarma_Amarillo']) > 0){
				if(selectedverindicador.indexOf("2") >=0){
					aux=classes[2];
				}
		}

		return {
			classes: aux
		};
	}

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
		}else if(value >= parseInt(row['Alarma_Amarillo']) && parseInt(row['Alarma_Amarillo']) > 0){
					aux=classes[2];
		}

		return {
			classes: aux
		};
	}




	$('#mostrartabla').click(function(){
            if($('#collapseOne').hasClass('in')){
                $('#iconofiltro').removeClass('fa-minus');
                $('#iconofiltro').addClass('fa-plus');
				$('#iconofiltro').text(' Mostrar Tabla Resumen');
            }else{

                $('#iconofiltro').removeClass('fa-plus');
                $('#iconofiltro').addClass('fa-minus');
				$('#iconofiltro').text(' Ocultar Tabla Resumen');
            }

        });





</script>

<script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpUhp-rPo8Zev2M_lT0vPHRQZ9rftJGJI&callback=initMap">
    </script>












@endsection