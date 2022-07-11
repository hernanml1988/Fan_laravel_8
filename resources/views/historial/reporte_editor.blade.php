@extends('layouts/master')
@section('title', '- Reporte')
<style>
    .table_blue th{
      background: #34495ef0 !important;
      color: #ECF0F1 !important;
      text-align: center;
      vertical-align: middle;
      position: sticky; top:-1px;
    }
    </style>
@section('content')
<script type="text/javascript">

</script>




	<div id="wrapper">




       	<div id="page-wrapper" style="margin-left: -21px; margin-right: -40px">

            	<div class="row" >
                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-xs-12">
                        <div class="panel panel-black" style="margin-top:20px;">
                            <div class="panel-heading" style="height:90px;">
                                <div class="row text-center">
                                    <span class="text-center" style="display:inline; font-weight:bold">H I S T O R I A L&emsp; D E&emsp;  R E G I S T R O S</span>
                                </div>
                                <div class="row" style="padding-top:9px;">
                                    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                                        <select id="opcionescentros" class="form-control">
											@foreach ($centros as $c)
											@foreach ($permisos as $p)
												@if ($p->IDcentro == $c->IDcentro)
													<option value="{{$c->IDcentro}} ">{{$c->Nombre}} </option>
												@endif
											@endforeach	
									@endforeach
										</select>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">

                                    <div class="dataTable_wrapper" style="height:450px; overflow:auto; font-size:12px; padding-top:12px;">

                                        <table cellSpacing="0" data-toggle="table" data-search="true" data-show-columns="true" data-pagination="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="{{Route('historial.load.registro.centros')}}" data-query-params="queryParams" data-show-refresh="true" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer table_blue" style="text-align-last:center" data-click-to-select="true" data-single-select="true" id="dataTables" >
											{{-- data-url "load_registro_centros.php" --}}
                                            <thead>
                                                <tr >

                                                    <th data-formatter="runningFormatterhistorialreporte" data-switchable="false" data-width = "35px" >#</th>
                                            <th data-checkbox="true" ></th>
                                            <th data-field="Date_Reporte" data-sortable="false" data-switchable="false"  class="" data-valign = ""  data-width = "90px">Toma Muestra</th>
                                            <th data-field="Time_Reporte" data-sortable="false" data-switchable="false"  class="" data-valign = ""  data-width = "90px">Hora</th>
                                            <th data-field="Fecha_Analisis" data-sortable="false" data-visible="false"> Análisis Muestra </th>
                                            <th data-field="Fecha_Envio" data-sortable="false" data-visible="false"> Envío Registro </th>
                                            <th data-field="Mortalidad" data-sortable="false" data-switchable="false" data-cell-style="cellStylepeces">Mortalidad</th>

                                            <th data-field="Comentario" data-sortable="false" data-switchable="false">Comentario</th>
                                            <th data-field="Estado_Alarma" data-sortable="false" data-switchable="false" data-width = "90px" data-cell-style="cellStyleestadoalarma" data-width = "35px">Condición</th>
                                            <!--<th data-field="Estado" data-sortable="false" data-switchable="false" data-width = "35px">Estado</th>-->
                                            <th data-field="Firma" data-sortable="false" data-visible="true" data-width = "100px">Firma</th>

                                                </tr>
                                            </thead>

                                        </table>

                                    </div>
                                </div>

                            <a href="">
                                <div class="panel-footer">
                                    <span class="pull-left">Ver Detalles</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
            	</div>

            <!-- Modal -->
            <div class="modal fade" id="myModalverreporte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" style="width:1180px;" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('img/GTRgestion.png') }}" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;"> REGISTRO DIARIO </h4>
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
                             <div class="col-lg-6 col-md-6 col-xs-6">
                                <div id="content">
                                	<div id="titulo_grafico" class="text-center" style="font-size:14px; margin-top:-16px; margin-right:50px;"><b>Tendencia Especies Nocivas en la Semana</b> (Máx. concentración)</div>
                                    <div id="titulo_grafico_ausencia" class="text-center hidden" style="font-size:14px; margin-top:-16px; margin-right:50px;"><b>Ausencia de Microalgas Nocivas en la Semana</b></div>
                                     <div class="demo-container">
                                        <div id="placeholder" class="demo-placeholder" style="display:inherit; float:left; width:405px; height:175px;"></div>
                                        <div style="float:right; width:25%; font-size:13px; max-height:170px; overflow-y:auto;" id="legendholder"></div>
                                    </div>
                                </div>
                       	 	</div>
                        </div>

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

                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Diatomeas"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover table_blue" id="tabladiatomeasver" >
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

                                        <table cellSpacing="0" data-toggle="table"  data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Dinoflagelados"}' data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover table_blue"   id="tabladinoflageladosver" >
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

                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Otras Especies"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover table_blue"   id="tablaoespeciesver" >
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

                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Parámetros Ambientales"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tablapambientalesver" >
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
                                    <table cellSpacing="0" data-toggle="table" data-show-export="true" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Parámetros Ambientales"}' data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tablapambientalesotrosver" >
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
            <div class="modal fade" id="myModalverreporteprint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="{{ asset('img/GTRgestion.png') }}" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel"> REGISTRO DIARIO </h4>
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
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tabladiatomeasverprint" >
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
                                        <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tabladinoflageladosverprint" >
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
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tablaoespeciesverprint" >
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
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tablapambientalesverprint" >
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
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover table_blue"   id="tablapambientalesotrosverprint" >
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
                            <img src="{{ asset('img/GTRgestion.png') }}" class="center-block"/>
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
                    <img src="{{ asset('img/GTRgestion.png') }}" class="logo_gtr_modal pull-left"/>
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


            <!-- Modal Loading-->
                    <div class="modal fade" id="modalloading" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document" >
                            <div class="modal-content" style="height:100px; width:400px; alignment-adjust:central">
                            	<div class="modal-body center-block text-center">
                                	 <img src="{{ asset('img/loader.gif') }}" /><h5> Loading... Please Wait </h5>
                                </div>
                             </div>
                        </div>
                    </div>







    </div>

	<script language="javascript" src="{{ asset('js/jquery.js') }}"> </script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu.min.js"></script>
    <script src="js/bootstrap-table.js"></script>

    <!-- DatetimePicker -->
   <script src="js/moment-with-locales.js"></script>
   <script src="js/bootstrap-datetimepicker.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>


   	<!-- Autocomplete -->
<!--    <script src="js/jquery-1.10.2.js"></script>-->
    <script src="js/jquery-ui.js"></script>


     <!-- Alertas -->
    <script src="js/sweetalert.min.js"></script>

	<!-- Incluye los colores para los estados -->
    <script src="js/color-estados.js"></script>

    <!-- Asigna menu para roles -->
    <script src="js/menu_role.js?random=<?php echo uniqid(); ?>"></script>

    <!-- Edit table -->
    <script src="js/bootstrap-editable.js"></script>
    <script src="js/bootstrap-table-editable.js"></script>

    <!-- Export table -->
    <script src="js/tableExport.js"></script>
    <script src="js/bootstrap-table-export.js"></script> 





<script>
	var user_id =  {!!$currentUser->id!!}//php echo $currentUser->id; ?>;
	var id_empresa = {!!$currentUser->IDempresa!!}//php echo $currentUser->IDempresa; ?>;
	var user_role_fan = {!!$currentUser->user_role_fan!!}
  var role = <?php echo '"'.$currentUser->role.'"';?>;
	//roles(<?/*php echo '"'.$currentUser->role.'"';?>*/);

	var dataTables = $('#dataTables');

	function queryParams(params) {
		params.user_id = user_id;
		params.IDcentro = document.getElementById("opcionescentros").value;
        return params;
    }
	$('#opcionescentros').change( function(){
		dataTables.bootstrapTable("refresh");
	});



	


	//Mensaje Loding
	$( document ).ajaxStop(function () {
		$('#modalloading').modal('hide');
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



	//Load opciones profundidad
	$( document ).ready(function() {
		$.ajax({
				url: "{{Route('historial.load.options.prof')}}",//load_options_prof.php",
				type: 'post',
				dataType: 'json',
				data: {
					_token: "{{ csrf_token() }}",
					user_id:		user_id
				},
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
								var th = '<th data-formatter="runningFormatter'+esp+'prof'+i+'" data-align= "center" data-valign = "middle" data-width = "65px"></th>';

								//Modal Ver
								$('#'+tabla+'ver').bootstrapTable('showColumn', 'Medicion_'+(i+1));

								//Modal Print
								$('#'+tabla+'verprint').bootstrapTable('showColumn', 'Medicion_'+(i+1));
							}

							$('#'+tabla).bootstrapTable();



							$('#'+tabla).bootstrapTable('refresh');
							for(var i = 0; i<opt.length; i++){
								//Modal Ver
								$('#'+tabla+'ver thead [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);

								//Modal Print
								$('#'+tabla+'verprint [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
							}
						}
					}
				}
			});



			//Load opciones centros
			// $.ajax({
			// 		url: "load_options_centros.php",
			// 		type: 'post',
			// 		dataType: 'json',
			// 		data: {
			// 			_token: "{{ csrf_token() }}",
			// 			user_id:		user_id
			// 		},
			// 		success: function(dato)
			// 		{
			// 			if(dato != ""){
			// 				$.each(dato['Nombre'], function (i, item) {
			// 					$('#opcionescentros').append($('<option>', {
			// 						value: dato['IDcentro'][i],
			// 						text : dato['Nombre'][i]
			// 					}));
			// 				});
			// 				dataTables.bootstrapTable("refresh");
			// 			}
			// 		}
			// });

	});

	dataTables.on('check.bs.table',function () {
		if(dataTables.bootstrapTable('getSelections')[0]){
      idmedicion = dataTables.bootstrapTable('getSelections')[0].IDmedicion;
			tablasverreporte(idmedicion);
			$('#myModalverreporte').modal('show');
		}
	});

	$("#descargarpdf").click( function(){
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
					url: "archivos/Registros_Alarma/generar_registro.php",
					type: 'post',
					dataType: 'json',
					data: { 	_token: "{{ csrf_token() }}",
						f:	dataTables.bootstrapTable('getSelections')[0].Date_Reporte,
						c:	$('#opcionescentros option:selected').text(),
						a:	dataTables.bootstrapTable('getSelections')[0].Estado_Alarma,
						m:  	parseInt(dataTables.bootstrapTable('getSelections')[0].IDmedicion),
						i:    user_id
					},
					success: function(dato)
					{
						//window.location("archivos/Registros_Alarma/descargar_registro.php?n="+dato);
						window.location.href = "archivos/Registros_Alarma/descargar_registro.php?n="+dato;

					},
					error: function(msg)
					{
						console.log(msg);

					}
			});
	});

	function verarchivo(){
			$.ajax({
						url: "{{Route('historial.load.archivo.registro')}}",//load_archivo_registro.php",
						type: 'post',
						data: {	_token: "{{ csrf_token() }}", IDmedicion: dataTables.bootstrapTable('getSelections')[0].IDmedicion},
						success: function(dato)
						{
							console.log(dato);
							var obj = dato;//JSON.parse(dato);
							window.open(obj['Archivo'], "_blank");
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
			$.ajax({
					url: "{{Route('historial.load.fan.reporte')}}",//load_fan_reporte.php",
					type: 'post',
					data: { 	_token: "{{ csrf_token() }}",
						IDmedicion: 	 dataTables.bootstrapTable('getSelections')[0].IDmedicion,
						user_id:		user_id
					},
					success: function(dato)
					{

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

              var texto = '';
              if (datos['Modulo']) {
                texto = texto + 'Módulo '+ datos['Modulo'];
              }
              if (datos['Jaula']) {
                var coma = '';
                if (texto != '') {
                  coma = ', ';
                }
                texto = texto + coma +' Jaula '+ datos['Jaula'];
              }
              if (datos['latitud']['deg']) {
                var coma = '';
                if (texto != '') {
                  coma = ', ';
                }
                texto = texto + coma + ' Latitud: S '+ datos['latitud']['deg']+'° '+datos['latitud']['min'] +"' "+ datos['latitud']['sec'] +'"';
                texto = texto + coma + ' Longitud: O '+datos['longitud']['deg']+'° '+datos['longitud']['min'] +"' "+ datos['longitud']['sec'] +'"';
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
							$('#archivoverreporte').html(html);
						  }
							// if(datos['Archivo']){
							// 	nombrearchivo = datos['Archivo'].split("/");
							// 	nombrearchivo = nombrearchivo[nombrearchivo.length-1];
							// }
							//$('#archivoverreporte').text(nombrearchivo);
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
			//Parámetros Ambientales
			$.ajax({
					url: "{{Route('historial.load.pambientales.reporte')}}",//load_pambientales_reporte.php",
					type: 'post',
					data: { 	_token: "{{ csrf_token() }}",
						IDmedicion: 	 dataTables.bootstrapTable('getSelections')[0].IDmedicion,
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
							$('#tablapambientalesverprint').bootstrapTable("load", datos['PAmbientales']);
							$('#tablapambientalesotrosverprint').bootstrapTable("load", datos['PAmbientalesotros']);
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

	}


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
				url: "{{Route('historial.load.historial.centros.pdf')}}",//load_historial_centros_pdf.php",
				type: 'post',
				dataType: 'json',
				data: { 	_token: "{{ csrf_token() }}",
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
				//data_grafico.push({label:"Alarma Precaución", data:[[dato['F_Min'],dato['Amarillo'],dato['Rojo']],[dato['F_Max'],dato['Amarillo'],dato['Rojo']]],color: "yellow", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });



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


	dataTables.on('post-body.bs.table', function () {
		for(var i = 0; i<= indx0.length ; i++){
        	dataTables.bootstrapTable('mergeCells', {index: indx0[i], field: "Date_Reporte", colspan: 1, rowspan: rowsp0[i+1]});
		}
    });






	//Dinoflagrlados
	function runningFormatterreporte(value, row, index) {
		return (index + 1);
	}
	function runningFormatterfoto(value, row, index) {
		return '<img src="{{Route("registro.get.imagen.especie")}}/'+ row['IDespecie']+'/1'+' " class="img-circle center-block" />';
	}



	function runningFormatterdiatoprof0(value, row, index) {
		return '	<input id="diato0'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
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

	//Otras especies
	function runningFormatteroespprof0(value, row, index) {
		return '	<input id="oesp0'+index+'" class="form-control"  type="number" min="0" placeholder="" name = "profundidad">';
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



	function runningFormattermicionambientalesotros(value, row, index) {

		var opt = row['Opciones'];
		if(opt){
			opt = opt.split(",");
			if(opt[0] == "Formato-Numero"){
				return '	<input id="pambo'+index+'" class="form-control"   type="number" step="1" min="0"" >';
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


			WinPrint.document.write('</head><body >');

			WinPrint.document.write(prtContent.innerHTML);


			WinPrint.document.write('</body></html>');


			WinPrint.document.close();
			WinPrint.focus();
			setTimeout(function(){WinPrint.print();},700);

	});






</script>



@endsection