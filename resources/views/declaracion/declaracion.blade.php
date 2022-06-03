@extends('layouts/master')
<style>
	body{
	padding-right:0px !important;

	}

  .chart-legend li span{
      display: inline-block;
      width: 12px;
      height: 12px;
      margin-right: 5px;
  }
  .chart-legend{
    height:340px;
    overflow:auto;
  }
  .chart-legend li{
    cursor:pointer;
  }
  .chart-legend ul{
    padding-left: 20px !important;
  }
  .strike{
     text-decoration: line-through !important;
   }

	 .badge {
  padding: 1px 9px 2px;
  font-size: 12.025px;
  font-weight: bold;
  white-space: nowrap;
  color: #ffffff;
  background-color: #999999;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}
.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.badge-error {
  background-color: #b94a48;
}
.badge-error:hover {
  background-color: #953b39;
}
.badge-warning {
  background-color: #f89406;
}
.badge-warning:hover {
  background-color: #c67605;
}
.badge-success {
  background-color: #468847;
}
.badge-success:hover {
  background-color: #356635;
}
.badge-info {
  background-color: #3a87ad;
}
.badge-info:hover {
  background-color: #2d6987;
}
.badge-inverse {
  background-color: #333333;
}
.badge-inverse:hover {
  background-color: #1a1a1a;
}



.date2 {
 background: #999;
 width: 52px;
 margin-right: 10px;
 border-radius: 10px;
 padding: 5px;
 border: SOLID 1PX #777;
}

.date2 .month {
 margin: 0;
 text-align: center;
 color: #fff;
 font-weight: 700;
 text-transform:uppercase;
}

.date2 .day {
 font-size: 27px;
 line-height: 27px;
 font-weight: 700;
 margin-bottom:5px !important;
}

.fixed-table-container  tbody td{
		border-left:none !important;

	}

	 .bootstrap-table .table2 > thead > tr > th {
      	border: none !important;
       }

	   .fixed-table-container  thead th .th-inner, .fixed-table-container tbody td .th-inner{
		   padding:4px !important;
		   line-height: 15px !important;
	   }

	   .fixed-table-body {
		 overflow-x: unset !important;
		 overflow-y: unset !important;
		 height: unset !important;
	   }
	   .table-responsive2 {
		   overflow-x:unset !important;
	   }

	</style>


@section('content')
<script type="text/javascript">

</script>




	<div id="wrapper">

      


       	<div id="page-wrapper">


                <div class="row">
                    <div class="row pull-right" style="margin-right:20px;position: absolute;right: 0px;">
                        <div class="btn-group btn-group-toggle pull-right" style="border: solid 1px;border-color:#adadad; border-radius: 8px; margin-top: 25px;" data-toggle="buttons">
                          <label title="Cambiar a estado Normal Res. Nº2198" class="btn btn-secondary" role="button" data-twbs-toggle-buttons-class-active="btn-info" aria-pressed="false">
                            <input id="btn_normal" type="radio" name="options_medicion"  required="">Normal
                          </label>
                          <label title="Cambiar a estado Pre-Alerta Res. Ex. 6073" class="btn btn-secondary" role="button" data-twbs-toggle-buttons-class-active="btn-warning" data-twbs-toggle-buttons-class-inactive="btn-error" aria-pressed="false">
                            <input id="btn_prealerta" type="radio" name="options_medicion"  >Pre-Alerta
                          </label>
                          <label title="Cambiar a estado Alerta" class="btn btn-secondary" role="button" data-twbs-toggle-buttons-class-active="btn-danger"  aria-pressed="false">
                            <input id="btn_alerta" type="radio" name="options_medicion" >Alerta
                          </label>
                        </div>
                        </br>

                        <?php if($currentUser->IDempresa != 5 && $currentUser->IDempresa != 4){ echo '<button id="btn_descarga" type="button"   onclick="exportar_sernapesca();" class="btn btn-default pull-right hidden" title="Generar Reportes Excel" style="margin-top:10px;"><span class="fa fa-file-excel-o hidden-xs"> Sernapesca </span></button>';

                        }else{
                          echo '<div class="dropdown" style="display:contents;">
                            <button id="btn_descarga" type="button"  data-toggle="dropdown" class="btn btn-default pull-right hidden" title="Generar Reportes Excel" style="margin-top:10px;"><span class="fa fa-file-excel-o hidden-xs"> Sernapesca </span></button>
                            <ul id="ul_planilla" class="dropdown-menu" style="">
                              <li style="cursor:pointer;" >
                                  <a role="menuitem" tabindex="-1" onclick="exportar_sernapesca();" title="Exportar planilla Semanal Sernapesca Res. Ex. N° 1497/2020">Reporte Semanal</a>
                              </li>
          	                  <li class="divider" style="margin: 5px 0;"></li>
                              <li style="cursor:pointer;" >
                                  <a role="menuitem" tabindex="-1" onclick="exportar_sernapesca_diario();" title="Exportar planilla  Sernapesca Res. Ex. N° 2198">Reporte Diario</a>
                              </li>
                            </ul>
                          </div>';

                        }

                        ?>
                        <!-- <div class="dropdown" style="display:inline">
                          <button id="btn_descarga" type="button"  data-toggle="dropdown" class="btn btn-default pull-right hidden" title="Generar Reportes Excel" style="margin-top:10px;"><span class="fa fa-file-excel-o hidden-xs"> Sernapesca </span></button>
                          <ul id="ul_planilla" class="dropdown-menu" style="margin-top: 9px;">
                            <li style="cursor:pointer;" >
                                <a role="menuitem" tabindex="-1" onclick="exportar_sernapesca();" title="Exportar planilla Semanal Sernapesca Res. Ex. N° 1497/2020">Semanal</a>
                            </li>
        	                  <li class="divider" style="margin: 5px 0;"></li>
                            <li style="cursor:pointer;" >
                                <a role="menuitem" tabindex="-1" onclick="exportar_sernapesca_diario();" title="Exportar planilla  Sernapesca Res. Ex. N° 2198">Semanal</a>
                            </li>
                          </ul>
                        </div> -->

                    </div>
                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-1 col-md-10 col-xs-12" style="margin-top:30px;">
                        <div class="container" style=" width: 100%;">

                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1" title="Listado de registros por declarar">Nuevos <span class="badge" id="badge2" style="background-color: firebrick;color: white;position: absolute;right: -9px;top: -6px;padding: 2px 6px;background-color: #1ABB9C!important;">0 </span></a></li>
                            <li><a data-toggle="tab" href="#menu2" title="Listado de registros declarados">Declarados <span class="badge hidden" id="badge2" style="background-color: firebrick;color: white;position: absolute;right: -9px;top: -6px;padding: 2px 6px;background-color: #1ABB9C!important;"> </span></a></li>
                            <li><a data-toggle="tab" href="#menu3" title="Listado de registros eliminados">Eliminados</a></li>
                          </ul>

                          <div class="tab-content" style="margin-top: 25px;">

                         		<div class="form-group input-group" style="margin-left:0px; margin-right:0px; width:100%">
                                	<span class="text-center pull-left" style="background-color: #659fa9; color: white; display:inline; border-radius:4px 0px 0px 4px;line-height:2.7;margin-right:-3px; width:53px; height:32px; margin-top:2px; margin-right:-3px; padding-left:5px;"> <b>Fecha &nbsp;</b></span>
                                     <select  class="form-control" style="margin-left: 3px; margin-top: 2px; max-width:130px; margin-right:10px;cursor:pointer;"  id="fecha_filtro" name="fecha_filtro" onChange="myFunction()"  >
                                        <option value ="2" id="mes_actual1"> Todo </option>
                                        <option value ="1" id="mes_actual0"> Mes Actual</option>
                                        <option value ="3" id="mes_actual3"> Mes </option>
                                        <option value ="4" id="mes_actual4"> Mes </option>
                                        <option value ="0">Desde - Hasta </option>

                                    </select>

                                    <!--<span class="input-group-addon" style="background-color: #659fa9; color: white; display:inline; border-radius:4px 0px 0px 4px;line-height:2.7;"> <b>Centros &nbsp;</b></span> -->
                                    <span class="input-group-addon" style="background-color: #659fa9; color: white; display:inline; border-radius:4px 0px 0px 4px;line-height:2.7;" data-toggle="collapse" data-parent="#accordion" href="#collapseregion">

                                        <b>
                                        <a title="Ordenar Por" class="dropdown-toggle" title="Ordenar Por" data-toggle="dropdown" href="#" style="color:#FFF !important;">
                                        Centros &nbsp;

                                            <i class="fa fa-caret-down" style="display:inline"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user" style="left: 193px;">
                                            <li> <div  style=" cursor:pointer; padding-left: 15px; color: #000;font-weight: normal;" onclick="changecentros('region')">Ordenar por Región </div></li>
                                            <li class="divider" style="margin:0;"></li>
                                            <li> <div  style="cursor:pointer; padding-left: 15px; color: #000;font-weight: normal;" onclick="changecentros('barrio')">Ordenar por ACS </div></li>
                                            <li class="divider" style="margin:0;"></li>
                                            <li> <div  style="cursor:pointer; padding-left: 15px; color: #000;font-weight: normal;" onclick="changecentros('area')">Ordenar por Área </div></li>
                                        </ul>


                                        </b>

                                    </span>
                                     <select id="opcionescentros" name="multipleselect"  multiple="multiple" style="display:inline">
                                     	<option value ="todo" selected> Todo </option>
                                     </select>



                                    <div class="row" style="display:inherit;">
                                        <div class="input-group date"   id="datetimepicker_filtro2_1" style="width:135px; display: none;float: right;margin-right:10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_2" name ="fecha_filtro_2" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <div class="input-group date"   id="datetimepicker_filtro1_1" style="width:135px; display: none;float: right;margin-right: 10px;margin-left: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_1" name ="fecha_filtro_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                    </div>



                                </div>

                            <div id="menu1" class="tab-pane fade in active">
                                <div class="list-group" id="tareas_lista" style="margin-top:10px;">

                                	<div class="table-responsive2" style="padding-top:15px;overflow-y:none;">

                                        <table cellSpacing="0" data-toggle="table" data-search="false" data-show-columns="false" data-pagination="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="load_declarar.php" data-query-params="queryParams1" data-show-refresh="false" data-cache="false" width="100%" class="table table-hover table2" style="" data-click-to-select="false" data-single-select="false"  data-row-style="rowStyle" id="dataTables1" >
                                            <thead>
                                                <tr>

                                                    <!--<th data-checkbox="true" ></th>-->
                                                    <th data-formatter="runningFormatternumero" data-switchable="false" data-width = "35px" ></th>
                                                    <th data-formatter="runningFormatterfecha" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>
                                                    <th data-formatter="runningFormattercentro" data-switchable="false" data-sortable="false" data-visible="true">  </th>
                                                    <th data-formatter="runningFormatterestado" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>
                                                    <th data-formatter="runningFormatteropciones" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>


                                                </tr>
                                            </thead>

                                        </table>


                                    </div>


                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">

                              	<div class="list-group" id="tareas_lista2" style="margin-top:10px;">
									                  <div class="graficos1e" style="margin-left: -80px;margin-right:  -190px;     ">
                                        <div class="col-lg-10 col-md-10 col-xs-10" style="padding: 20px; padding-top:0px;margin-bottom:25px; margin-top:25px;">
                                            <a title="Ocultar al imprimir" href="javascript:void(0);" id="ojo2" onclick="ocultar2()" class ="no-print"><i class="fa fa-eye" style=" display:none; font-size:30px;color:currentColor;float: right;margin-bottom: 15px;"></i></a>
                                            <canvas class="" id="chart-bar2" height="250" width="550"></canvas>
                                        </div>
                                        <div id="js-legend" class="chart-legend">
                                        </div>

                                    </div>
                                    <div class="table-responsive2" style="padding-top:15px;overflow-y:none;">

                                        <table cellSpacing="0" data-toggle="table" data-search="false" data-show-columns="false" data-pagination="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="load_declarar_enviadas.php" data-query-params="queryParams1" data-show-refresh="false" data-cache="false" width="100%" class="table table-hover table2 " style="" data-click-to-select="false" data-single-select="false"  data-row-style="rowStyle" id="dataTables2" >
                                            <thead>
                                                <tr>

                                                    <!--<th data-checkbox="true" ></th>-->
                                                    <th data-formatter="runningFormatternumero" data-switchable="false" data-width = "35px" ></th>
                                                    <th data-formatter="runningFormatterfecha" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>
                                                    <th data-formatter="runningFormattercentro" data-switchable="false" data-sortable="false" data-visible="true">  </th>
                                                    <th data-formatter="runningFormatterestado" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>
                                                    <th data-formatter="runningFormatteropciones2" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>


                                                </tr>
                                            </thead>

                                        </table>


                                    </div>


                                </div>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                              	<div class="list-group" id="tareas_lista3" style="margin-top:10px;">

                                  	<div class="table-responsive2" style="padding-top:15px;overflow-y:none;">

                                        <table cellSpacing="0" data-toggle="table" data-search="false" data-show-columns="false" data-pagination="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="load_declarar_eliminadas.php" data-query-params="queryParams1" data-show-refresh="false" data-cache="false" width="100%" class="table table-hover table2" style="" data-click-to-select="false" data-single-select="false"  data-row-style="rowStyle" id="dataTables3" >
                                            <thead>
                                                <tr>

                                                    <!--<th data-checkbox="true" ></th>-->
                                                    <th data-formatter="runningFormatternumero" data-switchable="false" data-width = "35px" ></th>
                                                    <th data-formatter="runningFormatterfecha" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>
                                                    <th data-formatter="runningFormattercentro" data-switchable="false" data-sortable="false" data-visible="true">  </th>
                                                    <th data-formatter="runningFormatterestado" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>
                                                    <th data-formatter="runningFormatteropciones3" data-switchable="false" data-sortable="false" data-visible="true" data-width = "35px">  </th>


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



             <!-- Modal Loading-->
             <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
            	<div class="modal-dialog modal-lg" style="width:1100px;" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
                        <img id="" src="GTRgestion.png" class="pull-right logoempresa_modal" style="margin-top:0px;"/>
                        <h5 class="modal-title text-center" id="myModalLabel" style="margin-right:130px;margin-top:10px;" >DECLARACIÓN MONITOREO FITOPLANCTON ALGAS NOCIVAS</h5>
                        <h5 class="modal-title text-center" id="myModalLabel_nivel" style="margin-right:130px;margin-top:10px;font-weight: 500;"></h5>
                        <div id="iddec" class="hidden"></div>
                        <div id="idmed" class="hidden"></div>
                        <h5 class="modal-title text-center" id="tituloalarma" style="margin-right:130px;"></h5>

                      </div>
                      <div class="modal-body">
                        <div class="panel-body" >
                            <div class="row">
                            	<div class="row" style="margin-left:130px;margin-right:130px; margin-bottom:40px; font-size:12px;">
                                   	<b> Sr(a) Director(a)  </br>
                                    Servicio Nacional de Pesca y Acuicultura</br>
                                    Valparaíso</br>
                                    </br></br>
                                    </b>
                                    Con fecha <div id="day" style="display: inline;"></div> de <div id="month" style="display: inline;"></div> del año <div id="year" style="display: inline;"></div>, <div class="nombreusuariodeclarar" style="display: inline;"></div> en representación de la empresa <b><div class = "nombreempresa" style="display: inline;"></div></b> Rut <div class="rutempresa" style="display: inline;"></div>, dando cumplimiento a Resolución  Exenta Nº 2198 del 17 de mayo del año 2017 y sus modificaciones, informo a usted lo siguiente:
								</div>
                                <div class="col-lg-6 col-md-6 col-xs-6">
                                    <table class="infopdf pull-right" style="width:77%; table-layout: fixed;" >
                                      <tr>
                                        <th style="font-size:10px !important;" width = "55px">Centro</th>
                                        <th style="font-size:10px !important;font-weight:normal;" width = "30px">:</th>
                                        <th style=" font-weight:normal;"><output style="font-size:9px !important; margin-top:-7px !important;" id="nombreverreporteprint"></output></th>
                                        <th width = "30px"></th>
                                        <th style="font-size:10px !important;" width = "55px">Muestra</th>
                                        <th style="font-size:10px !important;font-weight:normal;" width = "30px">:</th>
                                        <th style="font-weight:normal;"><output style="font-size:8px !important;margin-top:-7px !important;" id="fechaverreporteprint"></output></th>
                                      </tr>
                                      <tr>
                                        <td style="font-size:10px !important; padding:0px;" width = "55px"><b>SIEP</b></td>
                                        <td style="font-size:10px !important;" width = "30px">:</td>
                                        <td><output style="font-size:9px !important; margin-top:-7px !important;" id="siepverreporteprint"></output></td>
                                        <td width = "30px"></td>
                                        <td style="font-size:10px !important;" width = "55px"><b>Análisis</b></td>
                                        <td style="font-size:10px !important;" width = "30px">:</td>
                                        <td> <output style="font-size:8px !important; margin-top:-7px !important;" id="fechaanalisisverreporteprint"></output></td>

                                      </tr>
                                      <tr>
                                        <td style="font-size:10px !important; padding:0px;" width = "55px"><b>ACS</b></td>
                                        <td style="font-size:10px !important;" width = "30px">:</td>
                                        <td><output style="font-size:9px !important;  margin-top:-7px !important;" id="acsverreporteprint"></output></td>
                                        <td width = "30px"></td>
                                        <td style="font-size:10px !important; padding:0px;" width = "55px"><b>Especie</b></td>
                                        <td style="font-size:10px !important;" width = "30px">:</td>
                                        <td><output style="font-size:9px !important; margin-top:-7px !important; " id="especieverreporteprint"></output></td>

                                      </tr>
                                      <tr>
                                        <td style="font-size:10px !important; padding:0px;" width = "55px"><b>Firma</b></td>
                                        <td style="font-size:10px !important;" width = "30px">:</td>
                                        <td><output style="font-size:9px !important;  margin-top:-7px !important;" id="firmaverreporteprint"></output></td>

                                      </tr>
                                    </table>
                                </div>
                                <div id="div_ojo1"  >
                                 	<div class="col-lg-6 col-md-6 col-xs-6">

                                        <div id="content">
                                            <a title="Ocultar al imprimir" id="ojo1" onclick="ocultar1()" class="no-print" style="cursor:pointer"><i class="fa fa-eye-slash" style="font-size:25px;color:indianred;float:right; margin-right:10px; margin-top:-10px"></i></a>
                                            <div class="text-center" style="font-size:11px; margin-top:-16px; margin-right:50px;"><b>Tendencia Última Semana Declarada</b> (Máx. concentración)</div>

                                             <div class="demo-container">
                                                <div id="placeholder" class="demo-placeholder" style="display:inherit; float:left; width:400px; height:135px;"></div>
                                                <div style="float:right; width:20%; font-size:9px;" id="legendholder"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style=" margin-top:10px; margin-left:110px; margin-right:110px;">
                                <div class="dataTable_wrapper" id="hidediato">
                                    <h6 class="text-center"> DIATOMEAS </h6>
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica "   id="tabladiatomeasverprint" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <!--<th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>-->
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Nivel_Alerta"  data-align= "center" data-valign = "middle" data-width = "35px"><output class="nivel_alerta" style="font-size:9px;margin-bottom: -15px;"></output> <br /> [cel/ml]</th>

                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>

                                            </tr>
                                        </thead>

                                    </table>

                                </div>


                                <div class="dataTable_wrapper" id="hidedino" style="margin-top:15px;" >
                                    <h6 class="text-center"> DINOFLAGELADOS </h6>
                                        <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica "   id="tabladinoflageladosverprint" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <!--<th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>-->
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                     <th data-field="Nivel_Alerta"  data-align= "center" data-valign = "middle" data-width = "35px"><output class="nivel_alerta" style="font-size:9px;margin-bottom: -15px;"></output> <br /> [cel/ml]</th>

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

                                <div class="dataTable_wrapper" id="hideoesp" style="margin-top:15px;">
                                    <h6 class="text-center"> OTRAS ESPECIES </h6>
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica "   id="tablaoespeciesverprint" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                               <!-- <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>-->
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Nivel_Alerta"  data-align= "center" data-valign = "middle" data-width = "35px"><output class="nivel_alerta" style="font-size:9px;margin-bottom: -15px;"></output> <br /> [cel/ml]</th>

                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>

                                            </tr>
                                        </thead>

                                    </table>

                                </div>
                                <div class="dataTable_wrapper " style="margin-top:15px;">
                                    <h6 class="text-center"> PARÁMETROS AMBIENTALES </h6>
                                    <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica "   id="tablapambientalesverprint" style="table-layout: fixed;">
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
                                <div class="dataTable_wrapper hidden" style="margin-top:10px;">
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica "   id="tablapambientalesotrosverprint" style="table-layout: fixed;">
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "68px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "22px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "149px">Nombre</th>
                                                <th data-field="Medicion_1" data-align= "center" data-valign = "middle" >Estados</th>
                                            </tr>
                                        </thead>

                                    </table>

                                </div>


                            </div>
                            <div id="footerprint" class="modal-footer text-center" style="margin-top: 20px;" >
                                <div class="text-center" style="font-size:12px; margin-top:5px; margin-bottom: -15px;margin-left:110px;margin-right:75px;">
                                	<textarea id="obsarea" class="form-control" rows="4" cols="120" placeholder="Espacio para escribir comentarios..." style="height:0px;overflow-y:hidden;resize:none; text-align: justify; padding: 25px;margin-bottom:30px;min-height:130px;" ></textarea>
                                	Sin otro particular se despide atentamente<br/><br/>
                                    <img src="" class="text-center logoempresa_modal" style="" /> <br/><br/>
                                    <div id="nombreusuariodeclarar_id"> <div class="nombreusuariodeclarar" style="display: inline;"></div> <br/><br/></div>
                                    <b><div class = "nombreempresa" style="display: inline;"></div></b> <br/>
                                   	<b><div class="rutempresa" style="display: inline;"></div><br/>
								</div>

                            </div>
                            <div id="footerprint" class="modal-footer" style="margin-top: 25px;">
                                <button id="" type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button id="guardarreporte" type="button" class="btn btn-default" onclick="guardarborrador(false);"><i class="fa fa-save"> </i> Borrador</button>
                                <button id="descargarpdf" type="button" class="btn btn-default" onClick="guardarborrador(true);"><i class="fa fa-print fa-fw"></i> Descargar</button>
                                <button id="descargarpdf_directo" type="button" class="btn btn-default hidden" onClick="descargarpdf();"><i class="fa fa-print fa-fw"></i> Descargar</button>
                                <button id="declarado" title="Cambiar estado a declarado" type="button" class="btn btn-primary" onClick="declarado($('#iddec').val(),$('#idmed').val(),false)"><i class="fa fa-check fa-fw"></i> Cambiar a Declarado</button>
                          </div>

                        </div>
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
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:15px;"> REGISTRO DIARIO</h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" style="font-weight:normal !important">
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
                                        <div id="placeholder_enviado" class="demo-placeholder" style="display:inherit; float:left; width:405px; height:175px;"></div>
                                        <div style="float:right; width:25%; font-size:13px; max-height:170px; overflow-y:auto;" id="legendholder_enviado"></div>
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

                                    <table cellSpacing="0" data-toggle="table" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Diatomeas"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover" id="tabladiatomeasver" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>


                                            </tr>
                                        </thead>

                                    </table>

                                </div>


                            </div>

                            <div class="tab-pane fade" id="Dinoflageladosver">
                                <div class="dataTable_wrapper" style="margin-top:25px;" >

                                        <table cellSpacing="0" data-toggle="table" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Dinoflagelados"}'   data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tabladinoflageladosver" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                    <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                    <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                    <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                    <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                    <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                               	 	<th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                	<th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>

                                                </tr>
                                            </thead>

                                        </table>

                                    </div>

                            </div>
                            <div class="tab-pane fade" id="OEspeciesver">
                                <div class="dataTable_wrapper" style="margin-top:25px;">

                                    <table cellSpacing="0" data-toggle="table" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Otras Especies"}'  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table tabledetalle table-striped table-bordered table-hover"   id="tablaoespeciesver" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>

                                            </tr>
                                        </thead>

                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="PAmbientalesver">
                                <div class="dataTable_wrapper" style="margin-top:25px;">

                                    <table cellSpacing="0" data-toggle="table" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Parámetros Ambientales"}'  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesver" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "240px">Nombre</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center"  data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>
                                                <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStylenivelesenviado"></th>

                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                                <div class="dataTable_wrapper" style="margin-top:25px;">
                                    <table cellSpacing="0" data-toggle="table" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Parámetros Ambientales"}'  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotrosver" >
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
                        <button id = "descargarpdf_enviado" type="button" class="btn btn-danger"><i class="fa fa-file-pdf-o fa-fw" ></i> PDF </button>

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
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
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
                            </div>
                       	</div>

                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div id="modalExcelSernapesca" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left" style="height:35px;">
                        <h4 class="modal-title text-center" id="" style=" margin-right:137px;margin-top:0px;">REPORTE SEMANAL SERNAPESCA</h4>
                  </div>
                  <div class="modal-body">
                    <table style="margin: 0px auto;">
                          <thead>
                              <tr>
                                  <th  valign = "middle"></th>
                                  <th  valign = "middle"></th>
                                  <th  valign = "middle"></th>
                              </tr>
                          </thead>
                          <tbody>
                          	<tr>
                              </tr>

                              <tr>
                                   <td><span class="input-group-addon" style="background-color: #659fa9; color: white; display:inline; border-radius:4px 0px 0px 4px;line-height:2.7; padding-right: 36px;"><b>Desde</b></span></td>
                                  <td>
                                      <div class="input-group date"  id="datetimepicker_filtro_excel1" style="width:100%; margin-left:-11px;">
                                          <input type="text" id="fecha_filtro_excel1" name ="fecha_filtro_excel1"  class="form-control">
                                          <div class="input-group-addon">
                                              <span class="glyphicon-calendar glyphicon"></span>
                                          </div>
                                      </div> </td>
                              </tr>
                              <tr>

                                  <td><span class="input-group-addon" style="background-color: #659fa9; color: white; display:inline; border-radius:4px 0px 0px 4px;line-height:2.7; padding-right: 36px;"><b>Hasta&nbsp;</b></span>
                                   </td>
                                  <td>
                                      <div class="input-group date"  id="datetimepicker_filtro_excel2" style="width:100%; margin-left:-11px;">
                                          <input type="text" id="fecha_filtro_excel2" name ="fecha_filtro_excel2"  class="form-control">
                                          <div class="input-group-addon">
                                              <span class="glyphicon-calendar glyphicon"></span>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                      <br>
                      <span style="font-weight: normal; text-align:center" class="center-block">
                        <b>Importante:</b>
                        <br>
                        Esta planilla se genera a partir de los siguientes criterios:
                        <br>
                        <img src="lista_especies_reporte_semanal_sernapesca.png" class="logo_gtr_modal" style="height:380px;">
                      </span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="descargar_consolidado();" class="btn btn-primary btn-sm">Descargar</button>
                  </div>
                </div>
              </div>
            </div>


            <div id="modalExcelSernapescaDiario" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left" style="height:35px;">
                        <h4 class="modal-title text-center" id="" style=" margin-right:137px;margin-top:0px;">REPORTE DIARIO SERNAPESCA</h4>
                  </div>
                  <div class="modal-body">
                    <table style="margin: 0px auto;">
                          <thead>
                              <tr>
                                  <th  valign = "middle"></th>
                                  <th  valign = "middle"></th>
                                  <th  valign = "middle"></th>
                              </tr>
                          </thead>
                          <tbody>
                          	<tr>
                              </tr>

                              <tr>
                                   <td><span class="input-group-addon" style="background-color: #659fa9; color: white; display:inline; border-radius:4px 0px 0px 4px;line-height:2.7; padding-right: 36px;"><b>Fecha</b></span></td>
                                  <td>
                                      <div class="input-group date"  id="datetimepicker_filtro_excel_diario1" style="width:100%; margin-left:-11px;">
                                          <input type="text" id="fecha_filtro_excel_diario1" name ="fecha_filtro_excel_diario1"  class="form-control">
                                          <div class="input-group-addon">
                                              <span class="glyphicon-calendar glyphicon"></span>
                                          </div>
                                      </div> </td>
                              </tr>
                          </tbody>
                      </table>
                      <br>
                      <span style="font-weight: normal; text-align:center" class="center-block">
                        <b>Importante:</b>
                        <br>
                        Este reporte se completa según los niveles fiscalizados indicados en la misma sección:
                        <br>
                        CONFIGURACIÓN -> ESPECIES -> Nivel Fisc. / Pre-Alerta. Según corresponda.
                      </span>
                    </div>
                  <div class="modal-footer">
                    <button type="button" onclick="descargar_consolidado_diario();" class="btn btn-primary btn-sm">Descargar</button>
                  </div>
                </div>
              </div>
            </div>



            <!-- Modal Loading-->
                    <div class="modal fade" id="modalloading" tabindex="-1" role="dialog">
                        <div class="modal-dialog " role="document" >
                            <div class="modal-content" style="height:100px; width:400px; alignment-adjust:central">
                            	<div class="modal-body center-block text-center">
                                	 <img src='loader.gif' /><h5> Loading... Please Wait </h5>
                                </div>
                             </div>
                        </div>
                    </div>







    </div>


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

     <!-- Multiple Select -->
  	<script type="text/javascript" src="js/bootstrap-multiselect.js?1"></script>

    <script src="js/jquery.twbs-toggle-buttons.min.js"></script>


    <script>
	var user_id = <?php echo $currentUser->id; ?>;
	var id_empresa = <?php echo $currentUser->IDempresa; ?>;

	roles(<?php echo '"'.$currentUser->role.'"';?>);

	//Mensaje Loding
	$( document ).ajaxStop(function () {
		$('#modalloading').modal('hide');
	});

	$(".btn-group-toggle").twbsToggleButtons();

	$('[name="multipleselect"]').multiselect({
		nonSelectedText: 'Ninguno',
		includeSelectAllOption: true,
        allSelectedText: 'Todos',
		nSelectedText: ' - Seleccionados',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		enableClickableOptGroups: true
	});

	var ocultar_bool_1 = true;
	function ocultar1(){
		if(ocultar_bool_1 == false){
			$('#ojo1').html('<i class="fa fa-eye-slash" style="font-size:25px;color:indianred;float:right; margin-right:10px; margin-top:-10px"></i>');
			$('#div_ojo1').addClass("no-print");
			ocultar_bool_1=true;
		}else{
			$('#ojo1').html('<i class="fa fa-eye" style="font-size:25px;color:currentColor;float:right; margin-right:10px; margin-top:-10px"></i>');
			$('#div_ojo1').removeClass("no-print");
			ocultar_bool_1=false;
		}
	}

	var distribucion = "";
	$( document ).ready(function() {

    //Prueba Descarga Reporte semanal sernapesca solo para 5
    // if(id_empresa == 5 || id_empresa == 2){
      $('#btn_descarga').removeClass("hidden");
    // }

		//Load opciones centros
		/*$.ajax({
				url: "load_options_centros.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:		user_id
				},
				success: function(dato)
				{
					if(dato != ""){
						$('#opcionescentros').empty();
						$.each(dato['Nombre'], function (i, item) {
							$('#opcionescentros').append($('<option>', {
								value: dato['IDcentro'][i],
								text : dato['Nombre'][i]
							}));
						});
						$('#opcionescentros').multiselect( 'rebuild' );
						$("#opcionescentros").multiselect('selectAll', false);
    					$("#opcionescentros").multiselect('updateButtonText');

					}
					buscarDatos();
					//$('#modal-edit').modal('show');
				}
		});*/

		//Load opciones profundidad
		$.ajax({
				url: "load_options_prof.php",
				type: 'post',
				dataType: 'json',
				data: {
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
								$('#'+tabla+' tr').append($(th));
								$('#'+tabla+' thead tr>th:last').html(opt[i]);


								//Modal Print
								$('#'+tabla+'verprint').bootstrapTable('showColumn', 'Medicion_'+(i+1));

								//Modal Ver
								$('#'+tabla+'ver').bootstrapTable('showColumn', 'Medicion_'+(i+1));
							}

							$('#'+tabla).bootstrapTable();



							$('#'+tabla).bootstrapTable('refresh');
							for(var i = 0; i<opt.length; i++){

								//Modal Print
								$('#'+tabla+'verprint [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);

								//Modal Ver
								$('#'+tabla+'ver [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
							}
						}
					}
					//tablasverreporte();
				}
			});


			$.ajax({
				url: "load_distribucion_declarar.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:	user_id
				},
				success: function(dato)
				{
					if(dato != ""){
						distribucion = dato;
						changecentros('region');
					}
				},error: function(err){
					console.log(err);
				}
		});


		// Estado declaración
		$.ajax({
				url: "load_emergencia_declarar.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:	user_id
				},
				success: function(dato)
				{
					if(dato != ""){
						if(dato == 'Normal'){
							$('#btn_normal').click();
						}else if(dato == 'Alerta'){
							$('#btn_alerta').click();
						}else{
							$('#btn_prealerta').click();
						}
						$( 'input[name=options_medicion]' ).change(function(){
							savehistorial('alerta');
						});;
					}
				},error: function(err){
					console.log(err);
				}
		});


	});




	var today = new Date();
	var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
	  "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];



	var date1 = new Date();
	var numeromes0= date1.getMonth();
	if(numeromes0<0){numeromes0 = numeromes0 +12;}
	$('#mes_actual0').text(monthNames[numeromes0]);
	var numeromes3= numeromes0-1;
	if(numeromes3<0){numeromes3 = numeromes3 +12;}
	$('#mes_actual3').text(monthNames[numeromes3]);
	var numeromes4= numeromes0-2;
	if(numeromes4<0){numeromes4 = numeromes4 +12;}
	$('#mes_actual4').text(monthNames[numeromes4]);

	$('#datetimepicker_filtro1_1').datetimepicker({
				locale: 'es',
				defaultDate: '',
				format: 'DD-MM-YYYY',

	});

	var date2 = new Date();
	date2.setDate(date2.getDate());
	$('#datetimepicker_filtro2_1').datetimepicker({
				locale: 'es',
				defaultDate: date2,
				format: 'DD-MM-YYYY',
			useCurrent: false //Important! See issu
	});

	function myFunction() {
		var x = document.getElementById("fecha_filtro").value;

		if(x == 0){
			$("#datetimepicker_filtro1_1").show();
			$("#datetimepicker_filtro2_1").show();


		}else{
			$("#datetimepicker_filtro1_1").hide();
			$("#datetimepicker_filtro2_1").hide();
			if(x==1){
				//desde
				var date1 = new Date();
				date1.setDate(date1.getDate()-date1.getDate()+1);
				$('#datetimepicker_filtro1_1').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_1').data("DateTimePicker").date(date2);

			}else if (x == 3){
				//desde
				var date1 = new Date();
				date1.setMonth(date1.getMonth()-1);
				date1.setDate(date1.getDate()-date1.getDate()+1);
				$('#datetimepicker_filtro1_1').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate()-date2.getDate());
				$('#datetimepicker_filtro2_1').data("DateTimePicker").date(date2);

			}else if (x == 4){
				//desde
				var date1 = new Date();
				date1.setMonth(date1.getMonth()-2);
				date1.setDate(date1.getDate()-date1.getDate()+1);
				$('#datetimepicker_filtro1_1').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setMonth(date2.getMonth()-1);
				date2.setDate(date2.getDate()-date2.getDate());
				$('#datetimepicker_filtro2_1').data("DateTimePicker").date(date2);

			}else{
				var date1 = new Date();
				date1.setDate(date1.getMonth()-1);
				$('#fecha_filtro_1').val('');

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_1').data("DateTimePicker").date(date2);

			}
		}

	}

	function changecentros(dist){
		var distribucion_aux = [];

		switch(dist) {
				case 'region':
					distribucion_aux = distribucion['Region_Centro'];
					break;
				case 'barrio':
					distribucion_aux = distribucion['Barrio_Centro'];
					break;
				case 'area':
					distribucion_aux = distribucion['Area_Centro'];
			}
		if(distribucion){
			$('#opcionescentros').empty();
			var optgroup = "";
			$.each(distribucion_aux, function (i, item) {
				if(optgroup !=item['nombre_orden'] ){
					$('#opcionescentros').append('<optgroup label="'+item['nombre_orden']+'"></optgroup>');
					optgroup = item['nombre_orden'];
				}
				$('#opcionescentros').append('<option value="'+item['id']+'">'+item['nombre']+'</option>');


			});
			$('#opcionescentros').multiselect( 'rebuild' );
			$("#opcionescentros").multiselect('selectAll', false);
			$("#opcionescentros").multiselect('updateButtonText');

			buscarDatos();

		}



	}

	var dataTables = $('#dataTables1');
	var dataTables2 = $('#dataTables2');
	var dataTables3 = $('#dataTables3');
	function queryParams1(params) {
        params.user_id = user_id;
        params.centro_filtro = $('#opcionescentros').val();
		params.Inicio = $('#fecha_filtro_1').val();
		params.Termino = $('#fecha_filtro_2').val();
        return params;
    }



	function runningFormatternumero(value, row, index) {
		return (index + 1);
	}

	function runningFormatterfecha(value, row, index) {
		var html = '<div title="Fecha Muestreo: ' +row["Fecha_Registro"]+'" style="width: 52px; height: 65px; display:  inline-block; color:white; cursor: pointer;">'+
														  '<div class="text-center date2">'+
															'<p class="month">'+fecha_mes(row["Mes_Registro"])+'</p>'+
															'<p class="day">'+row["Dia_Registro"]+'</p>'+
														  '</div>'+

														'</div>';
		return html;
	}

	function runningFormattercentro(value, row, index) {
		var html = '<div class="row " style="text-align: left;margin-left:0px;">'+
						'<b>'+row["Nombre"]+'</b>'+
					'</div>'+
					'<div class="row" style="margin-left:0px;">'+
							'<span class="pull-left text-muted" style="font-size: 13px; text-align:left;">';
								var pre_alarma = "";
								var color =  '#ad0000';
								if(row["Estado_Nocivo"] == 0){pre_alarma = " pre-alerta "; color = '#d68306';
								}else if(row["Estado_Nocivo"] == 2){pre_alarma = " alerta "; color = '#d68306';}

								var esp = row["Especie"].split("&");
								for(e=1;e<esp.length; e++){
									if (e % 2 == 1 && esp[e] != "") {
										html= html + '<i title="Superó en un '+esp[e]+'% el nivel fiscalizado'+pre_alarma+'" style="color:'+color+'; cursor:pointer;"><i class="fa fa-sort-asc"></i> '+esp[e]+'% </i>'+pre_alarma;
									}else{html= html + esp[e];}
								}
								html= html +
							'</span>'+
					'</div>';
		return html;
	}

	function runningFormatterestado(value, row, index) {
		var estado = "";
		var color = ' ';
		if(row["Estado_Nocivo"] == 0){estado = "Pre-Alerta"; color = 'color:#ec971f;';
		}else if(row["Estado_Nocivo"] == 2){estado = "Alerta"; color = 'color:#c9302c;';}

		var html = '<div class="row" style="text-align: center;'+color+'">'+
								estado +
					'</div>';
		return html;
	}

	function runningFormatteropciones(value, row, index) {

		var html = '<div class="row" style="padding-right:25px;">'+
							'<span title="Eliminar" class="fa fa-trash pull-right" onclick="deletedeclarar('+row["IDdeclaracion"]+','+row["IDmedicion"]+',0)" style="cursor:pointer; margin-right: 3px;"></span>'+
							/*'<span title="Cambiar estado a declarado" class="fa fa-check fa-fw pull-right" onclick="declarado('+row["IDdeclaracion"]+','+row["IDmedicion"]+',true)" style="cursor:pointer; margin-right: 1px;"></span>'+ */
							'<span title="Abrir Declaración" class="fa fa-check fa-fw pull-right" onclick="opendeclarar('+row["IDmedicion"]+','+row["IDdeclaracion"]+',\''+row["Observaciones"]+'\',false,'+row["Estado_Nocivo"]+','+row["Grafico"]+','+row['Dia_Envio']+','+row['Mes_Envio']+','+row['Year_Envio']+')" style="cursor:pointer; margin-right: 1px;"></span>'+
							'<span title="Ver Registro" class="fa fa-eye pull-right"onclick="verregistroenviado('+row["IDmedicion"]+')" style="cursor:pointer; margin-right: 3px;"></span>'+
					'</div>'+
					'<div class="row" style="margin-top:10px;padding-right:25px;">'+
							'<span class="pull-right btn btn-danger" style="text-align:right;padding:1px 7px !important;cursor: context-menu !important;">No Declarado</span>'+
					'</div>';
		return html;
	}

	function runningFormatteropciones2(value, row, index) {
		var html = '<div class="row" style="padding-right:25px;">'+
							'<span title="Volver a no declarado" class="fa fa-undo pull-right" onclick="deletedeclarar('+row["IDdeclaracion"]+','+row["IDmedicion"]+',1)" style="cursor:pointer; margin-right: 3px;"></span>'+
							'<span title="Abrir Declaración" class="fa fa-check fa-fw pull-right" onclick="opendeclarar('+row["IDmedicion"]+','+row["IDdeclaracion"]+',\''+row["Observaciones"]+'\',true,'+row["Estado_Nocivo"]+','+row["Grafico"]+','+row['Dia_Envio']+','+row['Mes_Envio']+','+row['Year_Envio']+')" style="cursor:pointer; margin-right: 1px;"></span>'+
							'<span title="Ver Registro" class="fa fa-eye pull-right"onclick="verregistroenviado('+row["IDmedicion"]+')" style="cursor:pointer; margin-right: 3px;"></span>'+

					'</div>'+
					'<div class="row" style="margin-top:10px;padding-right:25px;">'+
							'<span onclick="opendeclarar('+row["IDmedicion"]+','+row["IDdeclaracion"]+',\''+row["Observaciones"]+'\',true,'+row["Estado_Nocivo"]+','+row["Grafico"]+','+row['Dia_Envio']+','+row['Mes_Envio']+','+row['Year_Envio']+')" title="Ver declaración" class="pull-right btn btn-success" style="text-align:right;padding:1px 16px !important;cursor: pointer;">Declarado</span>'+
					'</div>'+
					'<div class="row" style="margin-top:10px;padding-right:25px;">'+
						'<span onclick="opendeclarar('+row["IDmedicion"]+','+row["IDdeclaracion"]+',\''+row["Observaciones"]+'\',true,'+row["Estado_Nocivo"]+','+row["Grafico"]+','+row['Dia_Envio']+','+row['Mes_Envio']+','+row['Year_Envio']+')" title="Registro declarado el '+row["Fecha_Envio"]+'" class="pull-right text-muted small" style="text-align:right; margin-left:5px; cursor:pointer;"><em>'+row["Fecha_Envio"]+'</em></span>'+
					'</div>';
		return html;
	}

	function runningFormatteropciones3(value, row, index) {

		var html = '<div class="row" style="padding-right:25px;">'+
								'<span title="Restaurar" class="fa fa-undo pull-right" onclick="deletedeclarar('+row["IDdeclaracion"]+','+row["IDmedicion"]+',1)" style="cursor:pointer; margin-right: 3px;"></span>'+
								/*'<span title="Ver Declaración" class="fa fa-check pull-right"onclick="opendeclarar('+row["IDmedicion"]+','+row["IDdeclaracion"]+',\''+row["Observaciones"]+'\',false,'+row["Estado_Nocivo"]+','+row["Grafico"]+','+row['Dia_Envio']+','+row['Mes_Envio']+','+row['Year_Envio']+')" style="cursor:pointer; margin-right: 3px;"></span>'+*/
								'<span title="Ver Registro" class="fa fa-eye pull-right"onclick="verregistroenviado('+row["IDmedicion"]+')" style="cursor:pointer; margin-right: 3px;"></span>'+

						'</div>'+
						'<div class="row" style="margin-top:10px;padding-right:25px;">'+
								'<span class="pull-right btn btn-warning" style="text-align:right;padding:1px 7px !important;cursor: context-menu !important;">Eliminado</span>'+
						'</div>'+
					'</div> ';
		return html;
	}


	dataTables.on('load-success.bs.table', function() {
		var total = dataTables.bootstrapTable('getOptions').totalRows;
		if(total > 0){
		$('#badge2').html(total);
		}else{
		   $('#badge2').html(0);
		}
	});


	function buscarDatos(){
		dataTables.bootstrapTable("removeAll");
		dataTables.bootstrapTable("refresh");
		dataTables2.bootstrapTable("removeAll");
		dataTables2.bootstrapTable("refresh");
		dataTables3.bootstrapTable("removeAll");
		dataTables3.bootstrapTable("refresh");

		graficar2(true);
	}

	$('#opcionescentros').change( function(){
		console.log("asd");
		buscarDatos();
	});
	$('#fecha_filtro_1, #fecha_filtro_2').change( function(){
		buscarDatos();
	});
	$('#datetimepicker_filtro1_1, #datetimepicker_filtro2_1').on('dp.change',  function(){

		buscarDatos();
	});


	function opendeclarar(idmed,iddec,obs,ver,nivel_alerta_aux,grafico,day,month,year){
		if(ver){
			$("#guardarreporte").addClass("hidden");
			$("#declarado").addClass("hidden");
			$("#descargarpdf").addClass("hidden");
			$("#descargarpdf_directo").removeClass("hidden");
		}else{
			$("#guardarreporte").removeClass("hidden");
			$("#declarado").removeClass("hidden");
			$("#descargarpdf").removeClass("hidden")
			$("#descargarpdf_directo").addClass("hidden");
		}
		ocultar_bool_1 = grafico; 	ocultar1();


		if(day ==00){day=today.getDate();month=today.getMonth()+1;year=today.getFullYear();}
		$("#day").text(day);
		$("#month").text(monthNames[month-1]);
		$("#year").text(year);

		$("#iddec").val(iddec);
		$("#idmed").val(idmed);
		$('#obsarea').val(obs);
		if(obs != "" || !ver){
			$("#obsarea").removeClass("hidden");
		}else{
			$("#obsarea").addClass("hidden");
		}

		$(".nombreusuariodeclarar").each(function() {
			$(this).text($("#nombreusuario").text());
      if(id_empresa == 5){
        $("#nombreusuariodeclarar_id").addClass("hidden");
      }
		});

		var nombreempresa = $("#logoempresa").attr("src");
		$(".logoempresa_modal").each(function() {
			$(this).attr("src", nombreempresa);
		});
		//$("#logoempresa_modal").attr("src", nombreempresa);
		nombreempresa = nombreempresa.split(".png");
		$(".nombreempresa").each(function() {
			$(this).text(nombreempresa[0]);
		});

		var nivel_alerta = 'Res. Ex. Nº 2198';
		if(nivel_alerta_aux == 0){nivel_alerta = 'Res. Ex. 6073 | Nivel de Pre-Alerta';
		}else if(nivel_alerta_aux == 2){nivel_alerta = 'Nivel de Alerta';}
		$('#myModalLabel_nivel').text(nivel_alerta);

		tablasverreporte(idmed,nivel_alerta_aux);
		$("#modal-edit").modal('show');
	}


	function diferenciaDia(fechaUno, fechaActual){
      var date1 = new Date(fechaUno);
      var date2 = new Date(fechaActual);
      var timeDiff = Math.abs(date2.getTime() - date1.getTime());
      var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) -1;
      //alert(diffDays);
      if(date1>date2){
        diffDays;
      }else{
        diffDays = diffDays *-1;
      }
      return diffDays;
    }

	function fecha_mes(mes){
        switch(parseInt(mes)){
            case 1: return "Ene";
                    break;
            case 2: return "Feb";
                    break;
            case 3: return "Mar";
                    break;
            case 4: return "Abr";
                    break;
            case 5: return "May";
                    break;
            case 6: return "Jun";
                    break;
            case 7: return "Jul";
                    break;
            case 8: return "Ago";
                    break;
            case 9: return "Sep";
                    break;
            case 10: return "Oct";
                    break;
            case 11: return "Nov";
                    break;
            case 12: return "Dic";
                    break;
        }

    }



	var especie_grafico = [];
	function tablasverreporte(idmedicion,alerta){
		 	$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: "load_fan_reporte_declarar.php",
					type: 'post',
					data: {
						IDmedicion: 	 idmedicion,
						Alerta:		 alerta,
						user_id:		user_id
					},
					success: function(dato)
					{

						if(dato != 0){
							var datos = JSON.parse(dato);



							especie_grafico = [];

							if(datos['Diatomeas'] != ""){
								$('#hidediato').removeClass('hidden');
								$('#tabladiatomeasverprint').bootstrapTable("load", datos['Diatomeas']);
							}else{$('#hidediato').addClass('hidden')}
							if(datos['Dinoflagelados'] != ""){
								$('#hidedino').removeClass('hidden');
								$('#tabladinoflageladosverprint').bootstrapTable("load", datos['Dinoflagelados']);
							}else{$('#hidedino').addClass('hidden');}
							if(datos['OEsp'] != ""){
								$('#hideoesp').removeClass('hidden');
								$('#tablaoespeciesverprint').bootstrapTable("load", datos['OEsp']);
							}else{$('#hideoesp').addClass('hidden');}

							if(alerta == 0){
								$(".nivel_alerta").val('Nivel Pre-Alerta ');
							}else if(alerta == 1){
								$(".nivel_alerta").val('Nivel Fisc. ');
							}else if(alerta == 2){
								$(".nivel_alerta").val('Nivel Alerta ');
							}
							document.getElementById("fechaverreporteprint").value = datos['Fecha_Reporte'];
							document.getElementById("fechaanalisisverreporteprint").value = datos['Fecha_Analisis'];

							document.getElementById("nombreverreporteprint").value = datos['Nombre'];
							document.getElementById("siepverreporteprint").value = datos['Codigo'];
							document.getElementById("acsverreporteprint").value = datos['Barrio'];
							document.getElementById("especieverreporteprint").value = datos['Especie'];
              document.getElementById("firmaverreporteprint").value = datos['Firma'];


							//document.getElementById("").value = datos['Empresa_Nombre'];
							$(".rutempresa").each(function() {
								$(this).text(datos['Empresa_Rut']);
							});
							idcentro = datos['IDcentro'];
							loaddatagrafico(idmedicion,idcentro);

						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});
			//Parámetros Ambientales
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: "load_pambientales_reporte_declarar.php",
					type: 'post',
					data: {
						IDmedicion: 	 idmedicion,
						user_id:		user_id
					},
					success: function(dato)
					{
						if(dato != 0){
							var datos = JSON.parse(dato);

							//Print
							if(datos['PAmbientales'] != ""){
								$('#tablapambientalesverprint').bootstrapTable("load", datos['PAmbientales']);
                $('#tablapambientalesverprint').removeClass('hidden');
							}else{$('#tablapambientalesverprint').addClass('hidden');}
							$('#tablapambientalesotrosverprint').bootstrapTable("load", datos['PAmbientalesotros']);
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

	}



	//Dinoflagrlados
	function runningFormatterreporte(value, row, index) {
		return (index + 1);
	}
	function runningFormatterfoto(value, row, index) {
		return '<img src="'+row['Imagen']+'" class="img-circle center-block"/>';
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

	$('#tablapambientalesverprint').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx1.length ; i++){
        	$('#tablapambientalesverprint').bootstrapTable('mergeCells', {index: indx1[i], field: "Grupo", colspan: 1, rowspan: rowsp1[i+1]});
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


	$('#tablapambientalesotrosverprint').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx2.length ; i++){
        	$('#tablapambientalesotrosverprint').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
		}
    });
	$('#tablapambientalesotrosver').on('post-body.bs.table', function () {
		for(var i = 0; i<= indx2.length ; i++){
			$('#tablapambientalesotrosver').bootstrapTable('mergeCells', {index: indx2[i], field: "Grupo", colspan: 1, rowspan: rowsp2[i+1]});
		}
	});





	$('#tabladiatomeasverprint, #tabladinoflageladosverprint, #tablaoespeciesverprint, #tabladiatomeasver, #tabladinoflageladosver, #tablaoespeciesver').bootstrapTable({

		formatNoMatches: function () {

        	return 'Ausencia de Microalgas';
   	 	},
		formatLoadingMessage: function (a,b,c,d,e) {
			return '';
		}
	});

	$('#tablapambientalesverprint, #tablapambientalesotrosverprint,#tablapambientalesver, #tablapambientalesotrosver').bootstrapTable({
		formatNoMatches: function () {
        	return 'Sin Registro';
   	 	},
		formatLoadingMessage: function () {
			return '';
		}
	});




	function cellStyleniveles(value, row, index) {
		var classes = ['label-green','label-gray','label-warning','label-danger']; //yellow red
		var aux = 0;
		var value = parseInt(value);
		if(value == 0){
				//aux=classes[0];
		}else if( value >= parseInt(row['Nivel_Alerta']) ){
				aux=classes[2];
				especie_grafico.push(row['IDespecie']);
		}
		/*if(value >= parseInt(row['Nivel_Fiscaliza']) && parseInt(row['Nivel_Fiscaliza']) > 0){
			aux=classes[3];
			especie_grafico.push(row['IDespecie']);
		}else if(value >= parseInt(row['Nivel_Fiscaliza_Pre']) && parseInt(row['Nivel_Fiscaliza_Pre']) > 0){
			aux=classes[2];
			especie_grafico.push(row['IDespecie']);
		}*/

		return {
			classes: aux
		};
	}



	var dato = [];
	function loaddatagrafico(idmedicion,idcentro){

		dato = [];

		console.log(especie_grafico);
		if(especie_grafico != ""){

			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
				url: "load_historial_centros_pdf_declarar.php",
				type: 'post',
				dataType: 'json',
				data: {
					IDcentro:		 idcentro,
					IDmedicion: 	   idmedicion,
	//				Fecha_Inicio: 	 moment().subtract(7, 'days').calendar(),
	//				Fecha_Termino: 	moment().format(),
					Especies: 	     especie_grafico
				},
				success: function(datoshist)
				{
					dato = []
					if(datoshist['Error'] == 0){
						dato = datoshist;

						graficar();
					}else{swal("Error", "Error al traer los datos.", "error");}
				},
				error: function(result) {
					//console.log(result);
				}
			});
		}else{dato = []; graficar();}
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
				/*if(dato['Nombre'].length != 1 && dato['Critico'] == 1){norm = "norm"; axislabel = "Nivel Fiscalizado [%]"}
				for(var i= 0; i<dato['Nombre'].length; i++){
					data_grafico.push({label: dato['Nombre'][i], data:dato[dato['Nombre'][i].concat(norm)],lines: {show: true},points: {show: true} });
				}*/
				if(dato['Nombre'].length != 1 && dato['Critico'] == 1){norm = "norm"; axislabel = "Nivel Nocivo [%]"}
				for(var i= 0; i<dato['Nombre'].length; i++){
					var dato_aux = [];

					for(var s = 0; s<dato['Semana'].length; s++){
						entro = -1;
						for(var d= 0; d<dato[dato['Nombre'][i].concat(norm)].length; d++){
							if(dato[dato['Nombre'][i].concat(norm)][d][4] == dato['Semana'][s]){
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

		var i = 3;
		$.each(data_grafico, function(key, val) {
			val.color = i;
			++i;
		});

		if(dato['Nombre']){
			if(dato['Nombre'].length == 1 && dato['Critico'] != 0){
				maxy = parseInt(dato['Max'])*1.1;
				if(dato['Max'] < parseInt(dato['Nivel_Fiscaliza'])){ maxy = parseInt(dato['Nivel_Fiscaliza'])*1.1;}
				data_grafico.push({label:"Nivel Fiscalizado", data:[[dato['F_Min'],dato['Nivel_Fiscaliza'],maxy],[dato['F_Max'],dato['Nivel_Fiscaliza'],maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });

				//Nivel Alarma Amarillo
				//data_grafico.push({label:"Alarma Precaución", data:[[dato['F_Min'],dato['Amarillo'],dato['Rojo']],[dato['F_Max'],dato['Amarillo'],dato['Rojo']]],color: "yellow", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });



			}else if(dato['Critico'] == 1){

				maxy = parseInt(dato['Max_norm'])*1.1;
				if(parseInt(dato['Max_norm']) < 100){ maxy = 100*1.1;}

				data_grafico.push({label:"Nivel Fiscalizado", data:[[dato['F_Min'],100,maxy],[dato['F_Max'],100,maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });


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
						max: dato['F_Max']
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

	}


	function guardarborrador(descargarpdf_aux){
		if($('#div_ojo1').hasClass("no-print")){grafico = 0;}else{grafico = 1;}

		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: "save_borrador_declarar.php",
			type: 'post',
			dataType: 'json',
			data: {
				IDdeclaracion: 	$("#iddec").val(),
				Observaciones: 	$('#obsarea').val(),
				Grafico: 		  grafico,
				Firma: 			$("#nombreusuario").text(),
				user_id: 		  user_id
			},
			success: function(msg)
			{
				if(msg == 0){
					if(descargarpdf_aux){
						descargarpdf();
					}else{
						buscarDatos();
						$('#modal-edit').modal("hide");

						//location.reload();
					}

				}else{swal("Error", "Error al guardar borrador", "error");}
			},
			error: function(result) {
				//console.log(result);
			}
		});

	}


	function deletedeclarar(iddec,idmed,restaurar){

		var mensaje = " volver a Nuevos?";
		if(restaurar == 0){
			mensaje = " eliminar?";
		}
			swal({
				  title: "",
				  text: "¿Está seguro que desea "+mensaje,
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Si",
				  cancelButtonText: "Cancelar",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
					  	$('#modalloading').modal({backdrop: 'static', keyboard: false});
						$.ajax({
							url: "delete_declarar.php",
							type: 'post',
							dataType: 'json',
							data: {
								IDdeclaracion: iddec,
								IDmedicion:    idmed,
								Restaurar: 	 restaurar,
								user_id: 	   user_id
							},
							success: function(msg)
							{
								if(msg == 0){
									//$('#modal-edit').modal("hide");
									buscarDatos();//location.reload();
								}else{swal("Error", "Error al restaurar", "error");}
							},
							error: function(result) {
								//console.log(result);
							}
						});
				}

			});


	}

	function descargarpdf(){
		//window.location.href = "pdf_declaracion.php?i=78&m=26490&d=6";
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
					url: "archivos/Registros_Alarma/generar_declaracion.php",
					type: 'post',
					dataType: 'json',
					data: {
						d:	$("#iddec").val(),
						m:  	$("#idmed").val(),
						i:    user_id
					},
					success: function(dato)
					{
						//window.location("archivos/Registros_Alarma/descargar_registro.php?n="+dato);
						window.location.href = "archivos/Registros_Alarma/descargar_declaracion.php?n="+dato;

					},
					error: function(msg)
					{
						console.log(msg);

					}
			});
	};



	function declarado(iddec,idmed,directo){
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		var obs = "accesodirecto";
		if(!directo){
			obs = $('#obsarea').val();
		}
		if($('#div_ojo1').hasClass("no-print")){grafico = 0;}else{grafico = 1;}
		$.ajax({
					url: "save_estado_declarar.php",
					type: 'post',
					dataType: 'json',
					data: {
						IDdeclaracion:	iddec,
						IDmedicion:	   idmed,
						Firma:			$("#nombreusuario").text(),
						Obs: 			  obs,
						Grafico: 		  grafico,
						user_id:    	  user_id
					},
					success: function(dato)
					{
						buscarDatos();//location.reload();
						$('#modal-edit').modal('hide');
					},
					error: function(msg)
					{
						console.log(msg);

					}
			});
	}

$('#obsarea').each(function () {
	  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;resize:none; text-align: justify; padding: 25px;margin-bottom:30px;min-height:130px;');
	}).on('input', function () {
	  this.style.height = 'auto';
	  this.style.height = (this.scrollHeight) + 'px';


});



	function savehistorial(tipo){
		var estado = "";
    var modif = "";
    if (tipo == 'descarga_semanal') {
      estado = "PLanilla Semanal Sernapesca datos desde "+document.getElementById("datetimepicker_filtro_excel1").value+" hasta "+document.getElementById("datetimepicker_filtro_excel2").value;
      modif = "Descarga Reporte Semanal Sernapesca";
    }else if (tipo == 'descarga_diario') {
        estado = "PLanilla Diaria Sernapesca datos de "+document.getElementById("datetimepicker_filtro_excel_diario1").value;
        modif = "Descarga Reporte Diario Sernapesca";
    }else if (tipo == 'alerta') {
      $("#btn_normal").is(':checked') ? estado="Normal":"";
  		$("#btn_alerta").is(':checked') ? estado="Alerta":"";
  		$("#btn_prealerta").is(':checked') ? estado="Pre-Alerta":"";
      modif = "Estado Declaración";
    }

		$.ajax({
				url: "save_historial_descargas.php",
				type: 'post',
				data: {
				 Modificacion:	 modif,
				 Observaciones: 	estado,
				 user_id:		  user_id
				},
				success: function(msg)
				{
					// alert("Estado de "+estado+" guardado.");

				}
			});

	}


	//////////////////////////////////////////
	/////// Ver Registro Muestro /////////////
	//////////////////////////////////////////


	function cellStylenivelesenviado(value, row, index) {
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

	$("#descargarpdf_enviado").click( function(){
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
					url: "archivos/Registros_Alarma/generar_registro.php",
					type: 'post',
					dataType: 'json',
					data: {
						f:	fechareportepdf,
						c:	$('#nombreverreporte').text(),
						a:	estadoalarmapdf,
						m:  	idmedicion_enviado,
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

	function verarchivo(){
			$.ajax({
						url: "load_archivo_registro.php",
						type: 'post',
						data: {IDmedicion: idmedicionarchivo},
						success: function(dato)
						{

							var obj = JSON.parse(dato);
							window.open(obj['Archivo'], "_blank");
						}
					});


		};

	var idmedicion_enviado = "";
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
			idmedicion_enviado = aux;
			tablasverreporteenviado(idmedicion_enviado);
			$('#myModalverreporte').modal('show');
		}
	}



	var especie_rojo = [];
	var especie_amarillo = [];
	var especie_otro = [];
	var especie_nocivo = [];
	var especie_nocivo_no = [];
	var idmedicionarchivo = "";
	var fechareportepdf = "";
	var estadoalarmapdf = "";
	function tablasverreporteenviado(idmedicion_enviado){

			$('#tabladiatomeasver').bootstrapTable("removeAll");
			$('#tabladinoflageladosver').bootstrapTable("removeAll");
			$('#tablaoespeciesver').bootstrapTable("removeAll");
			$('[name="outputver"]').text("");
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: "load_fan_reporte.php",
					type: 'post',
					data: {
						IDmedicion: 	 idmedicion_enviado,
					},
					success: function(dato)
					{
						$('#tabladiatomeasver').bootstrapTable("removeAll");
						$('#tabladinoflageladosver').bootstrapTable("removeAll");
						$('#tablaoespeciesver').bootstrapTable("removeAll");
						if(dato != 0){
							var datos = JSON.parse(dato);
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
								nombrearchivo = datos['Archivo'].split("/");
								nombrearchivo = nombrearchivo[nombrearchivo.length-1];
							}
							$('#archivoverreporte').text(nombrearchivo);
							$('#firmaverreporte').text(datos['Firma']);
							$('#nombreverreporte').text(datos['Nombre']);
							$('#acsverreporte').text(datos['Barrio']);
							$('#especieverreporte').text(datos['Especie']);
							$('#pecesverreporte').text(datos['Mortalidad']);
							$('#siepverreporte').text(datos['Codigo']);
							$('#siembraverreporte').text(datos['Siembra']);
							$('#cosechaverreporte').text(datos['Cosecha']);

							//idcentro = datos['IDcentro'];
							loaddatagraficoenviado( datos['IDcentro']);
							idmedicionarchivo = idmedicion_enviado;
							fechareportepdf = datos['Fecha_Reporte'];
							estadoalarmapdf = datos['Estado_Alarma'];
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});
			//Parámetros Ambientales
			$.ajax({
					url: "load_pambientales_reporte.php",
					type: 'post',
					data: {
						IDmedicion: 	 idmedicion_enviado,
						user_id:		user_id
					},
					success: function(dato)
					{
						$('#tablapambientalesver').bootstrapTable("removeAll");
						$('#tablapambientalesotrosver').bootstrapTable("removeAll");
						if(dato != 0){
							var datos = JSON.parse(dato);
							$('#tablapambientalesver').bootstrapTable("load", datos['PAmbientales']);
							$('#tablapambientalesotrosver').bootstrapTable("load", datos['PAmbientalesotros']);

							//Print
							//$('#tablapambientalesverprint').bootstrapTable("load", datos['PAmbientales']);
							//$('#tablapambientalesotrosverprint').bootstrapTable("load", datos['PAmbientalesotros']);
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

	}



	var datoenviado = [];
	function loaddatagraficoenviado(idcentroenviado){
		datoenviado = [];
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
				url: "load_historial_centros_pdf.php",
				type: 'post',
				dataType: 'json',
				data: {
					IDcentro:		 idcentroenviado,
					IDmedicion: 	   idmedicion_enviado,
					Especies_1: 	    especie_grafico_1,// especie_grafico.slice(0, 4)
					Especies_2: 	    especie_grafico_2,
					Especies_21: 	   especie_grafico_21,
					Especies_3:		especie_grafico_3
				},
				success: function(datoshist)
				{
					$('#modalloading').modal('hide');
					datoenviado = [];
					if(datoshist['Error'] == 0){
						$('#titulo_grafico').removeClass('hidden');
						$('#titulo_grafico_ausencia').addClass('hidden');
						datoenviado = datoshist;
						graficar_enviado();
					}else if(datoshist['Error'] == 1){
						$('#placeholder_enviado').empty();
						$('#legendholder_enviado').empty();
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


	var data_grafico_enviado = Array();
	function graficar_enviado(){
		data_grafico_enviado = [];
		$('#placeholder_enviado').empty();
		$('#legendholder_enviado').empty();
		var medicion = "todo";
		var todo = 1;
		var prof = "";
		var nivel = "";
		var axislabel = "[cel/ml]";
		var maxy = null;
		var norm = "";
		if(datoenviado['Nombre']){
				/*if(dato['Nombre'].length != 1 && dato['Critico'] == 1){norm = "norm"; axislabel = "Nivel Nocivo [%]"}
				for(var i= 0; i<dato['Nombre'].length; i++){
					data_grafico.push({label: dato['Nombre'][i], data:dato[dato['Nombre'][i].concat(norm)],lines: {show: true},points: {show: true} });
				}*/

				if(datoenviado['Nombre'].length != 1 && datoenviado['Critico'] == 1){norm = "norm"; axislabel = "Nivel Nocivo [%]"}
				for(var i= 0; i<datoenviado['Nombre'].length; i++){
					var dato_aux = [];
					for(var s = 0; s<datoenviado['Semana'].length; s++){
						entro = -1;
						for(var d= 0; d<datoenviado[datoenviado['Nombre'][i].concat(norm)].length; d++){
							if(datoenviado[datoenviado['Nombre'][i].concat(norm)][d][8] == datoenviado['Semana'][s]){
								entro = d;
								dato_aux.push( datoenviado[datoenviado['Nombre'][i].concat(norm)][entro] );
							}
						}
						if(entro == -1){
							dato_aux.push(null);
						}


					}

					data_grafico_enviado.push({label: datoenviado['Nombre'][i], data: dato_aux,lines: {show: true},points: {show: true} });
				}
		}

		/*var i = 3;
		$.each(data_grafico, function(key, val) {
			val.color = i;
			++i;
		});*/

		//var i = 3;
		$.each(data_grafico_enviado, function(key, val) {
			var indexcolor = datoenviado['Nombre'].indexOf(val.label)+3;
			if(indexcolor>=12){indexcolor = indexcolor+1;}
			val.color = indexcolor;// i;
			//++i;
		});

		if(datoenviado['Nombre']){
			if(datoenviado['Nombre'].length == 1 && datoenviado['Critico'] != 0){
				maxy = parseInt(datoenviado['Max'])*1.1;
				if(datoenviado['Max'] < parseInt(datoenviado['Rojo'])){ maxy = parseInt(datoenviado['Rojo'])*1.1;}
				data_grafico_enviado.push({label:"Nivel Nocivo", data:[[datoenviado['F_Min'],datoenviado['Rojo'],maxy],[datoenviado['F_Max'],datoenviado['Rojo'],maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });

				//Nivel Alarma Amarillo
				//data_grafico_enviado.push({label:"Alarma Precaución", data:[[dato['F_Min'],dato['Amarillo'],dato['Rojo']],[dato['F_Max'],dato['Amarillo'],dato['Rojo']]],color: "yellow", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });



			}else if(datoenviado['Critico'] == 1){

				maxy = parseInt(datoenviado['Max_norm'])*1.1;
				if(parseInt(datoenviado['Max_norm']) < 100){ maxy = 100*1.1;}

				data_grafico_enviado.push({label:"Nivel Nocivo", data:[[datoenviado['F_Min'],100,maxy],[datoenviado['F_Max'],100,maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });


			}else{
				maxy = parseInt(datoenviado['Max'])*1.1;
			}
		}
		function plotAccordingToChoices_enviado() {
			//if (data_grafico.length > 0) {
				plot = $.plot("#placeholder_enviado", data_grafico_enviado, {
					axisLabels: {
						show: true
					},
					xaxis:  {
						//axisLabel: 'Fecha Registro',
						mode: "time",
						timeformat : "%d-%m",  // %H:%M:%S
						timezone: "browser",
						zoomRange: [datoenviado['F_Min'], datoenviado['F_Max']],
						panRange: [datoenviado['F_Min'], datoenviado['F_Max']],
						min: datoenviado['F_Min'],
						max: datoenviado['F_Max'],
						},
					grid: {
						hoverable: true,
						clickable: true
					},
					legend: {position: "nw", container: $('#legendholder_enviado') },
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

				$("#placeholder_enviado").bind("plotselected", function (event, ranges) {
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

		plotAccordingToChoices_enviado();

		$("<div id='tooltip_infowindow'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			"z-index": 100000,
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body");

		$("#placeholder_enviado").unbind('plothover').bind("plothover", function (event, pos, item,a,b,c,d) {

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



	//////////////////////////////////////////
	//////////////// Gráfico  ////////////////
	//////////////////////////////////////////

var BarChartData = {
		labels: ['Mes'],
		datasets: [{
			backgroundColor: '#009599',
			borderColor: "#004d50",
			borderWidth: 1,
			data: [0
			]
		}]

	};
var bar2_ctx2 = document.getElementById('chart-bar2');//.getContext('2d');
window.bar2_myBarChart = new Chart(bar2_ctx2, {
	type: 'bar',
	data: BarChartData,
	options: {
		// Elements options apply to all of the options unless overridden in a dataset
		// In this case, we are setting the border of each horizontal bar to be 2px wide
		elements: {
			rectangle: {
				borderWidth: 2,
			}
		},
		responsive: true,
		legend: {
			position: 'right',
			display: false,
		},
		title: {
			display: true,
			text: 'Declaraciones por Instalación Último Año'
		},
		scales: {

			yAxes: [{
				ticks: {
					min: 0
				}
			}]
		}


	}
});



var graficar2_msg = [];
function graficar2(btn){
	if(btn){
		$.ajax({
				url: "load_grafico_declarar.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:		   user_id,
       				centro_filtro:	 $('#opcionescentros').val(),
					//Inicio:			$('#fecha_filtro_1').val(),
					//Termino:		   $('#fecha_filtro_2').val(),
				},
				success: function(msg)
				{
					graficar2_msg = msg;
					graficar2_update(msg);
				}

			});
	}else{
		graficar2_update(graficar2_msg);
	}


}
function color_graifco( i){

    num = parseInt(i);
    switch(num){
        case 1: return '#3498DB';
            break;
        case 2: return '#ffce56';//'rgba(255, 159, 64, 0.5)';
            break;
        case 3: return '#9B59B6';//'rgba(255, 255, 0, 0.5)';
            break;
        case 4: return '#9CC2CB';
            break;
        case 5: return '#E74C3C';
            break;
        case 6: return 'rgba(243,112,34,0.8)';//'rgba(0, 128, 0, 0.5)';
            break;
        case 7: return 'rgba(0, 255, 255, 0.5)';
            break;
        case 8: return 'rgba(255,255,0,0.5)';
            break;
        case 9: return 'rgba(0, 0, 255, 0.5)';
            break;
        case 10: return 'rgba(0, 128, 128, 0.5)';
            break;
        case 11: return 'rgba(255, 0, 255, 0.5)';
            break;
        case 12: return 'rgba(55, 5, 204, 0.3)';
            break;
        case 13: return 'rgba(192, 192, 192, 0.5)';
            break;
        case 14: return 'rgba(243, 156, 18, 0.5)';
            break;
        case 15: return 'rgba(173, 204, 0, 0.5)';
            break;
        default: 'rgba(52,73,94,0.5)';
            break;

    }


}
var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
         };

function graficar2_update(msg){
	 var tendencia = msg['tendencia'];
	 var nombre_centro = msg['nombre'];
	 var costo = msg.costo;
	 var meses = msg['All_date'];
	 var years = msg['All_year'];

	 var meses_valor = [];
	 var datos_label = [];
	 var mi_datasets = [];


	for(j=0;j<nombre_centro.length; j++){
		 var meshasta = meses[1];
		 var mesdesde = meses[0];
		 var cantyears = years[1]-years[0];
		 meses_valor = [];
		 datos_label = [];
		 if(cantyears>0){
			 meshasta = 12;
		 }else{ meshasta = meses[1];}

		 for(year = years[0]; year<=years[1];year++){

			if(year == years[1]){meshasta = meses[1];}

			 for(mes = mesdesde; mes<=meshasta; mes++){
				 entro = false;
				 for(i=0;i<tendencia.length; i++){
					if(mes == parseInt(tendencia[i]["month"]) && year == parseInt(tendencia[i]["year"])
						&& nombre_centro[j] == tendencia[i]['Nombre']){
						var total_aux = parseFloat(tendencia[i]['Cantidad']);
						meses_valor.push(total_aux);
						entro =true;
					}
				 }
				 if(!entro){
					meses_valor.push(0);
				 }

				 var year2 = year-2000;
				 datos_label.push(fecha_mes(mes)+"'"+year2);



			 }
			 mesdesde = 1;

		}

		var color_aux = '';
		if(j>=15){
			color_aux = dynamicColors(j+1);
		}else{
			color_aux = color_graifco(j+1);
		}
		dataset = {
			label: nombre_centro[j],
			backgroundColor: color_aux,
			borderColor: "#808080",
			borderWidth: 1,
			data: meses_valor
		}
		mi_datasets.push(dataset);
	}







	var BarChartData = {
		labels: datos_label,
		datasets: mi_datasets

	};


	 bar2_myBarChart.destroy();


	var bar2_ctx2= document.getElementById('chart-bar2').getContext('2d');
	window.bar2_myBarChart = new Chart(bar2_ctx2, {
		type: 'bar',
		data: BarChartData,
		options: {
			plugins: {
			datalabels: {
				display: function (context) {
					return context.chart.isDatasetVisible(context.datasetIndex) && context.dataset.data[context.dataIndex] > 0;
				},
				font: {
					weight: 'bold',
					size: '14'
				},
				color: '#ffffff',
				formatter: function(value, context) {
							return value;
				}
			}
		},
			// Elements options apply to all of the options unless overridden in a dataset
			// In this case, we are setting the border of each horizontal bar to be 2px wide
			elements: {
				rectangle: {
					borderWidth: 2,
				}
			},
			responsive: true,
			legend: {
				position: 'right',
				display: false,
        align: 'start'
			},
			title: {
				display: true,
				text: 'Declaraciones por Instalación Último Año'
			},
			scales: {
				 xAxes : [{
					  gridLines : {
						  display : false,
						  lineWidth: 1,
						  zeroLineWidth: 1,
						  zeroLineColor: '#666666',
						  drawTicks: false
					  },
					  ticks: {
						  display:true,
						  stepSize: 0,
						  min: 0,
						  autoSkip: false,
						  fontSize: 11,
						  padding: 12
					  },
					  stacked: true
				  }],
				yAxes: [{
					ticks: {
						min: 0,
						callback:function(value){ if (value % 1 != 0){return "";}else{return value;}},
					},
					scaleLabel: {
						display: true,
						labelString: 'Cantidad'
					},
					stacked: true
				}]
			}
		},
		plugins: [{
			beforeInit: function (chart) {
			  chart.data.labels.forEach(function (e, i, a) {
				if (/\n/.test(e)) {
				  a[i] = e.split(/\n/)
				}
			  })
			}
		  }]
	});

  document.getElementById('js-legend').innerHTML = bar2_myBarChart.generateLegend();



}




///////////////
/// Exportar PLanilla Semanal Sernapesca
///////////////

var date_min = new Date();
date_min.setDate(date_min.getDate() - 14);
var date_desde = new Date();
date_desde.setDate(date_desde.getDate() - 6);
$('#datetimepicker_filtro_excel1').datetimepicker({
	locale: 'es',
	maxDate: 'now',
  minDate: date_min,
	defaultDate: date_desde,
	format: 'DD-MM-YYYY',
  calendarWeeks:true
});

$('#datetimepicker_filtro_excel2').datetimepicker({
	locale: 'es',
	maxDate: 'now',
	defaultDate: new Date(),
	format: 'DD-MM-YYYY',
  calendarWeeks:true

});

function exportar_sernapesca(){
  $('#modalExcelSernapesca').modal('show');
}

function descargar_consolidado(){
  $('#modalloading').modal({backdrop: 'static', keyboard: false});

  $.ajax({
      url: "archivos/Registros_Alarma/generar_excel_sernapesca_semanal.php",
      type: 'post',
      dataType: 'json',
      data: {
        Inicio: 	$('#fecha_filtro_excel1').val(),
        Termino: 	$('#fecha_filtro_excel2').val(),
        user_id:	user_id
      },
      success: function(dato)
      {
          //window.location("archivos/Registros_Alarma/descargar_registro.php?n="+dato);
          window.location.href = "archivos/Registros_Alarma/descargar_excel_sernapesca_semanal.php?n="+dato;
          savehistorial('descarga_semanal');


      },error: function(err){
        console.log(err);
      }
  });
}

/////////////////
//// Sernapesca DIARIO
////////////////
$('#datetimepicker_filtro_excel_diario1').datetimepicker({
	locale: 'es',
	maxDate: 'now',
	defaultDate: new Date(),
	format: 'DD-MM-YYYY',
  calendarWeeks:true

});
function exportar_sernapesca_diario(){
  $('#modalExcelSernapescaDiario').modal('show');
}

function descargar_consolidado_diario(){
  $('#modalloading').modal({backdrop: 'static', keyboard: false});

  $.ajax({
      url: "archivos/Registros_Alarma/generar_excel_sernapesca_diario.php",
      type: 'post',
      dataType: 'json',
      data: {
        Fecha: 	$('#fecha_filtro_excel_diario1').val(),
        user_id:	user_id
      },
      success: function(dato)
      {
          //window.location("archivos/Registros_Alarma/descargar_registro.php?n="+dato);
          if (dato == 'No hay datos') {
            alert("No se encontraron especies a declarar para le fecha indicada");
          }else{
            window.location.href = "archivos/Registros_Alarma/descargar_excel_sernapesca_diario.php?n="+dato;
            savehistorial('descarga_diario');
          }


      },error: function(err){
        console.log(err);
      }
  });
}




</script>


@endsection