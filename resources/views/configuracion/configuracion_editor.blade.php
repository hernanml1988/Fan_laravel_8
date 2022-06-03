@extends('layouts/master')
@section('title', '- Configuración')
<style>
    #map {
      width: 100%;
      height: 600px;
      background-color: grey;
    }
   
   
   
   #datetimepickerinicio2 {
       background-color: #fff ;
       color: #333 ;
       }
   
   #datetimepickertermino2 {
       background-color: #fff ;
       color: #333 ;
       }
   </style>
   

@section('content')

<script type="text/javascript">

</script>




	<div id="wrapper">




       	<div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header">CONFIGURACIÓN DE PARÁMETROS</h4>
                </div>
            </div>
            <div class="row" style="padding:20px;">

            	<div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="panel panel-primary">
                    	<a href="#" id="abrirmodalalarmas">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bell fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="mediano text-center"> Alarmas</div>
                                        <!--<div>New Comments!</div>-->
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <span class="pull-left">Editar Configuración</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="panel panel-primary">
                    	<a href="#" id="abrirmodalimagen">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="glyphicon glyphicon-tree-deciduous fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="mediano text-center"> Especies</div>
                                        <!--<div>New Comments!</div>-->
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <span class="pull-left">Editar Configuración</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="panel panel-primary">
                    	<a href="#" id="abrirmodalcentro">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-map-marker fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="mediano text-center"> Centros</div>
                                        <!--<div>New Comments!</div>-->
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <span class="pull-left">Editar Configuración</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="row" style="padding:20px;">
            	<div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="panel panel-primary">
                    	<div class="dropdown" id="dropdownid">
                        <a href="#" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <!--<a href="#" id="abrirmodalnotificaciones">-->
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-envelope fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="mediano  text-center"> Notificación</div>
                                        <!--<div>New Comments!</div>-->
                                    </div>
                                </div>
                            </div>
                        </a>
                        <button class="panel-footer dropdown-toggle dropdown-toggle2"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width: 100%;    border: none;   border-top: 1px solid #ddd;">
                           	<span class="pull-left">Editar Configuración</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>

                          </button>
                          <ul class="dropdown-menu  dropdown-menu2" aria-labelledby="dropdownMenu1" style="width: 100%;">
                            <li><a href="#" id="abrirmodalnotificaciones2"><i class="fa fa-user "></i> Ordenado por Usuario</a></li>
                            <li><a href="#" id="abrirmodalnotificaciones"><i class="fa fa-map-marker" style="margin-left: 2px; margin-right: 1px;"></i>  Ordenado por Centros</a></li>
                          </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-xs-12 hidden">
                    <div class="panel panel-primary">
                        <a href="#" id="abrirmodalpamb">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cloud fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="mediano text-center"> Ambiente</div>
                                        <!--<div>New Comments!</div>-->
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <span class="pull-left">Editar Configuración</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-xs-12">
                    <div class="panel panel-primary">
                    	<a href="#" id="abrirmodalusuarios">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="mediano text-center"> Usuarios</div>
                                        <!--<div>New Comments!</div>-->
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer">
                                <span class="pull-left">Editar Configuración</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

           	</div>

            <!--<div class="panel panel-black" >
                <div class="panel-heading text-center">
                    HISTORIAL DE CONFIGURACIONES
                </div>
                <div class="panel-body">

                    <div class="dataTable_wrapper" style="height:500px; overflow:auto; padding-top:12px;">

                        <table cellSpacing="0" data-toggle="table" data-search="true" data-show-columns="false" data-pagination="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="load_historial_configuracion.php" data-query-params="queryParams" data-show-refresh="true" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer" style="text-align-last:center" data-click-to-select="true" data-single-select="true" id="dataTables2" >
                            <thead>
                                <tr >

                                    <th data-field="Fecha" data-sortable="false" data-switchable="false"  class="" data-valign = ""  data-width = "90px">Fecha</th>
                                    <th data-field="Modificacion" data-sortable="false" data-switchable="false"  class="" data-valign = ""  data-width = "90px">Modificación</th>
                                    <th data-field="Observaciones" data-sortable="false" data-switchable="false">Observaciones</th>
                                    <th data-field="Firma" data-sortable="false" data-visible="true">Firma</th>

                                </tr>
                            </thead>

                        </table>

                    </div>
            	</div>
            </div>-->


            <!-- Modal -->
            <div class="modal fade" id="myModaldetalleimagen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 20001;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:14px;"> DETALLE ESPECIE</h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12">
                            	<img id="detalleimagen" src="" class="img-circle-wide center-block" style="max-width:88% !important;"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-xs-12">
                            	<b><output id="nombreespecieimagen" style="display:inline; text-transform:uppercase;"></output></b>
                                <p id="descripcionespecieimagen"></p>
                            </div>
                       	</div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModaladdespecie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 20001;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:14px;"> AGREGAR NUEVA ESPECIE</h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-12 center-block">
                            	<div  class="profile-container">
                                   <img id="profileImage" src="GtrFan-MonitoreoAlgasNocivas_symbol.png" />
                                </div>
                                <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo" required capture>
                            </div>
                            <div class="col-lg-8 col-md-8 col-xs-12">
                            	<div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> Grupo </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <select id="gruposelect" class="form-control">
                                            <option value="Diatomeas">Diatomeas</option>
                                            <option value="Dinoflagelados">Dinoflagelados</option>
                                            <option value="Otras Especies">Otras Especies</option>
                                        </select>
                                    </div>
                                </div>
                            	<div class="row">
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <p class="arealabel"> Nombre </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <input id="nombreespecie" class="form-control" placeholder="Nombre Especie">
                                    </div>
                                </div>
                            </div>
                       	</div>

                    </div>
                  </div>
                  <div class="modal-footer" >
                  		<button id="closeespecie" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id = "guardarespecie" type="button" class="btn btn-primary">Guardar Especie</button>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModalchangeimg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index: 20001;">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left"/>
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-top:14px;"> EDITAR IMAGEN</h4>
                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="row">
                        	<output id="nombreespecieeditimg" class="text-center" style="margin-top:-20px; margin-bottom:10px;"></output>
                            <div class="center-block profile-container">
                               <img id="profileImageeditimg" src="" />
                            </div>
                            <input id="imageUploadeditimg" type="file" name="profile_photo2" placeholder="Photo" required capture>
                       	</div>
                        <output id="idespecieeditimg" class="hidden"></output>
                    </div>
                  </div>
                  <div class="modal-footer" >
                  		<button id="closeeditimg" type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id = "guardaeditimg" type="button" class="btn btn-primary">Guardar Imagen</button>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModalalarmas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeupalarmas" type="button" class="close" data-dismiss="" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">CONFIGURACIÓN ALARMAS</h4>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active" id=""><a href="#Diatomeas" data-toggle="tab">1. Diatomeas</a>
                            </li>
                            <li id=""><a href="#Dinoflagelados" data-toggle="tab">2. Dinoflagelados</a>
                            </li>
                            <li id=""><a href="#OEspecies" data-toggle="tab">3. Otros</a>
                            </li>
                            <!--<li id="ultimo"><a href="#PAmbientales" data-toggle="tab">4. Ambiente</a>
                            </li>-->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Diatomeas">


                                <div class="dataTable_wrapper" style="margin-top:25px;" id="Diatomeas-form">

                                    <table cellSpacing="0" data-toggle="table"  data-url="load_diatomeas.php" data-filter-control="true" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tabladiatomeas" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-filter-control="input" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-formatter="runningFormatterdiatorojo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Crítico</th>
                                                <th data-formatter="runningFormatterdiatoamarillo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Precaución</th
                                            ></tr>
                                        </thead>

                                    </table>

                                </div>


                           	</div>

                            <div class="tab-pane fade" id="Dinoflagelados">
                                <div class="dataTable_wrapper" style="margin-top:25px;" id="Dinoflagelados-form">

                                        <table cellSpacing="0" data-toggle="table"  data-url="load_dinoflagelados.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tabladinoflagelados" >
                                            <thead>
                                                <tr>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                    <th data-formatter="runningFormatterdinorojo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Crítico</th>
                                                    <th data-formatter="runningFormatterdinoamarillo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Precaución</th>
                                                </tr>
                                            </thead>

                                        </table>

                                    </div>

                            </div>
                            <div class="tab-pane fade" id="OEspecies">
                            	<div class="dataTable_wrapper" style="margin-top:25px;" id="OEspecies-form">

                                    <table cellSpacing="0" data-toggle="table"  data-url="load_oespecies.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablaoespecies" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                <th data-formatter="runningFormatteroesprojo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Crítico</th>
                                                <th data-formatter="runningFormatteroespamarillo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Precaución</th>
                                            </tr>
                                        </thead>

                                    </table>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="PAmbientales">
                            	<div class="dataTable_wrapper" style="margin-top:25px;" id="PAmbientales-form">

                                    <table cellSpacing="0" data-toggle="table"  data-url="load_pambientales.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientales" >
                                        <thead>
                                            <tr>
                                            	<th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "240px">Nombre</th>
                                                <th data-formatter="runningFormattermicionambientalesrojo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Crítico</th>
                                                <th data-formatter="runningFormattermicionambientalesamarillo" data-align= "center" data-valign = "middle" data-width = "65px">Alarma <br />Alarma <br />Precaución</th>
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
                  		<button id="closealarmas" type="button" class="btn btn-default" data-dismiss="">Cerrar</button>
                        <button id = "enviaralarmas" type="button" class="btn btn-primary">Guardar Alarmas</button>
                  </div>
                </div>
              </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="myModaldetalleespecie" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" style="width:1100px;" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closedetalleup" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">CONFIGURACIÓN DETALLE ESPECIES</h4>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="pull-right">
                    		<button id="addespecie" type="button" class="btn btn-cerrada"><i class="fa fa-plus-circle"></i> Agregar Nueva Especie</button>
                            <button id="deleteespecie" type="button" class="btn btn-danger" title="Eliminar una especie de la lista"><i class="fa fa-trash"></i></button>
						</div>
                        <ul class="nav nav-tabs" id="myTabdetalle">
                            <li class="active" id="tab1"><a href="#Diatomeasdetalle" data-toggle="tab">1. Diatomeas</a>
                            </li>
                            <li id="tab2"><a href="#Dinoflageladosdetalle" data-toggle="tab">2. Dinoflagelados</a>
                            </li>
                            <li id="tab3"><a href="#OEspeciesdetalle" data-toggle="tab">3. Otros</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Diatomeasdetalle">


                                <div class="dataTable_wrapper" style="margin-top:25px;" id="Diatomeas-form">

                                    <table cellSpacing="0" data-toggle="table"  data-url="load_diatomeas.php" data-filter-control="true" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"  data-single-select="true"  id="tabladiatomeaseditdetalle" >
                                        <thead>
                                            <tr>
                                            	<th data-checkbox="true"  data-width = "35px"></th>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-filter-control="input" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th  data-field="Fiscaliza_edit" data-editable="true" data-editable-type="select" data-editable-source="{'0':'No', '1':'Si'}" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Especie <br />  Fiscalizada</th>
                                                <th title="Res. Ex. Nº 2198 del 17 de mayo del año 2017" data-field="Nivel_Fiscaliza" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. <br />[cel/ml]</th>

                                                 <th  title="Res. Ex. 6073 del 24 de Diciembre de 2018" data-field="Nivel_Fiscaliza_Pre" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. Pre-Alerta <br />[cel/ml]</th>
                                                 <th  title="" data-field="Nivel_Fiscaliza_Alerta" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. Alerta <br />[cel/ml]</th>

                                                <th  data-field="Nociva" data-editable="true" data-editable-type="select" data-editable-source="{'0':'No', '1':'Si'}" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Especie <br />  Nociva</th>
                                                <th  data-field="Nivel_Critico" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Nocivo <br />[cel/ml]</th>

                                                <th data-field="Detalle" data-editable="true" data-editable-type="textarea" data-align= "left" data-halign="center" data-valign = "middle">Detalles</th>
                                        </thead>

                                    </table>

                                </div>


                           	</div>

                            <div class="tab-pane fade" id="Dinoflageladosdetalle">
                                <div class="dataTable_wrapper" style="margin-top:25px;" id="Dinoflagelados-form">

                                        <table cellSpacing="0" data-toggle="table"  data-url="load_dinoflagelados.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"  data-single-select="true" id="tabladinoflageladoseditdetalle" >
                                            <thead>
                                                <tr>
                                                	<th data-checkbox="true"  data-width = "35px"></th>
                                                    <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                    <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                    <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                    <th  data-field="Fiscaliza_edit" data-editable="true" data-editable-type="select" data-editable-source="{'0':'No', '1':'Si'}" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Especie <br />  Fiscalizada</th>
                                                    <th  data-field="Nivel_Fiscaliza" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. <br />[cel/ml]</th>

                                                    <th  title="Res. Ex. 6073 del 24 de Diciembre de 2018" data-field="Nivel_Fiscaliza_Pre" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. Pre-Alerta <br />[cel/ml]</th>
                                                    <th  title="" data-field="Nivel_Fiscaliza_Alerta" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. Alerta <br />[cel/ml]</th>

                                                    <th  data-field="Nociva" data-editable="true" data-editable-type="select" data-editable-source="{'0':'No', '1':'Si'}" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Especie <br />  Nociva</th>
                                                <th  data-field="Nivel_Critico" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Nocivo <br />[cel/ml]</th>
                                                    <th data-field="Detalle" data-editable="true" data-editable-type="textarea"  data-align= "left" data-halign="center" data-valign = "middle">Detalles</th>
                                            </thead>

                                        </table>

                                    </div>

                            </div>
                            <div class="tab-pane fade" id="OEspeciesdetalle">
                            	<div class="dataTable_wrapper" style="margin-top:25px;" id="OEspecies-form">

                                    <table cellSpacing="0" data-toggle="table"  data-url="load_oespecies.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover" data-single-select="true"  id="tablaoespecieseditdetalle" >
                                        <thead>
                                            <tr>
                                            	<th data-checkbox="true"  data-width = "35px"></th>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th  data-field="Fiscaliza_edit" data-editable="true" data-editable-type="select" data-editable-source="{'0':'No', '1':'Si'}" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Especie <br />  Fiscalizada</th>
                                                <th  data-field="Nivel_Fiscaliza" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. <br />[cel/ml]</th>

                                                <th  title="Res. Ex. 6073 del 24 de Diciembre de 2018" data-field="Nivel_Fiscaliza_Pre" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. Pre-Alerta <br />[cel/ml]</th>
                                                <th  title="" data-field="Nivel_Fiscaliza_Alerta" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Fisc. Alerta <br />[cel/ml]</th>

                                                <th  data-field="Nociva" data-editable="true" data-editable-type="select" data-editable-source="{'0':'No', '1':'Si'}" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Especie <br />  Nociva</th>
                                                <th  data-field="Nivel_Critico" data-editable="true" data-editable-type="text" class="editable" data-align= "center" data-halign="center" data-valign = "middle" data-width = "60px">Nivel Nocivo <br />[cel/ml]</th>
                                                <th data-field="Detalle" data-editable="true" data-editable-type="textarea" data-align= "left" data-halign="center" data-valign = "middle">Detalles</th>
                                        </thead>

                                    </table>

                                </div>
                            </div>


                    	</div>
                        <div class="row" id="tabnext">
                          <div class="col-md-12">
                            <div class="btn-toolbar pull-right">
                              <div class="btn-group">
                                <button class="btn btn-default change-tab" data-direction="previous" data-target="#myTabdetalle"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Anterior </button>
                                <button class="btn btn-default change-tab" data-direction="next" data-target="#myTabdetalle"> Siguiente <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                  	</div>
                  </div>
                  <div class="modal-footer" >
                  		<button id="closedetalle" type="button" class="btn btn-default" >Cerrar</button>
                        <button id = "enviardetalle" type="button" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModalpamb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closepambup" type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style=" margin-right:180px;margin-top:9px;">CONFIGURACIÓN PARÁMETROS AMBIENTALES</h4>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<div class="pull-right">
                    		<button id="addpamb" type="button" class="btn btn-cerrada"><i class="fa fa-plus-circle"></i> Agregar Parámetro</button>
						</div>
                        <ul class="nav nav-tabs" id="myTabpamb">
                            <li class="active" id=""><a href="#agua" data-toggle="tab">1. Columna de Agua</a>
                            </li>
                            <li id=""><a href="#ambiente" data-toggle="tab">2. Ambiente</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="agua">
                            	<div class="dataTable_wrapper" style="margin-top:25px;" id="pambagua">

                                    <table cellSpacing="0" data-toggle="table"  data-url="load_pambientales.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientales" >
                                        <thead>
                                            <tr>
                                            	<th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                                <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "240px">Nombre</th>
                                            </tr>
                                        </thead>

                                    </table>
                              	</div>
                           	</div>

                            <div class="tab-pane fade" id="ambiente">
                               <div class="dataTable_wrapper" style="margin-top:25px;" id="PAmbientalesotros-form">
                                    <table cellSpacing="0" data-toggle="table"  data-url="load_pambientalesotros.php" data-query-params="queryParams" data-pagination="false" data-side-pagination="server" data-cache="false" width="100%" class="table table-striped table-bordered table-hover"   id="tablapambientalesotros" >
                                        <thead>
                                            <tr>
                                                <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "100px"></th>
                                                <th data-formatter="runningFormatterambientalesotros" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "220px">Nombre</th>
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
                                <button class="btn btn-default change-tab" data-direction="previous" data-target="#myTabpamb"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Anterior </button>
                                <button class="btn btn-default change-tab" data-direction="next" data-target="#myTabpamb"> Siguiente <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                  	</div>
                  </div>
                  <div class="modal-footer" >
                  		<button id="closepamb" type="button" class="btn btn-default">Cerrar</button>
                        <button id = "enviarpamb" type="button" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="myModalnotificaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeupnotif" type="button" class="close" data-dismiss="" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-right:100px; margin-top:9px;">CONFIGURACIÓN NOTIFICACIONES AUTOMÁTICAS</h4>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<!--<ul class="nav nav-tabs" id="myTab">
                            <li class="active" id=""><a href="#Alarmas" data-toggle="tab">1. Alarmas</a>
                            </li>
                            <li id=""><a href="#Reportes" data-toggle="tab">2. Reportes</a>
                            </li>
                        </ul>-->
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Alarmas" >
                                 <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading">
                                       Administración Notificación de Alarmas
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">

                                        <div class="row center-block" >
                                            <h2 style=" text-decoration:underline">Seleccionar Centros</h2>
                                            <div class="center-block" style=" max-width:370px;margin-bottom: 18px;margin-top: 27px;">
                                                <select id="filtercentros" class="form-control">
                                                    <option value="Region">Ordenar por Región</option>
                                                    <option value="Area">Ordenar por Área</option>
                                                    <option value="Barrio">Ordenar por ACS</option>
                                                </select>
                                            </div>
                                            <div id='hiddenregion'>
                                                <select id='region' multiple='multiple'>
                                                </select>
                                            </div>
                                            <div id='hiddenarea' class="hidden">
                                                <select id='area' multiple='multiple'>
                                                </select>
                                            </div>
                                            <div id='hiddenbarrio' class="hidden">
                                                <select id='barrio' multiple='multiple'>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top:40px; padding:20px;">
                                            <h2 class="center-block" style=" text-decoration:underline">Seleccionar Alarmas</h2>
                                            <div class="table-responsive" style="overflow-x: unset !important">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th  valign="middle">#</th>
                                                            <th  valign = "middle">Notificación de Alarmas</th>
                                                            <th  valign = "middle">Destinatarios </th>
                                                            <th data-checkbox="true"  valign = "middle">Al Propio <br />Centro Cultivo</th>
                                                            <th data-checkbox="true"  valign = "middle">A Toda la <br /> Propia ACS</th>
                                                            <!--<th  valign = "middle">Título Mensaje</th>-->

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que se envía un registro y existe al menos una especie que supera el límite Alarma Rojo" style="cursor:help; color:#333;">
                                                                   Alarma Rojo (Nivel Crítico)
                                                                </a>

                                                            </td>
                                                            <td>
                                                                <select id="rojo" name="multipleselect"  multiple="multiple">
                                                                </select>
                                                            </td>
                                                            <td><input id="notcentrorojo" class="center-block" type="checkbox" /></td>
                                                            <td><input id="notacsrojo" class="text-center" type="checkbox" /></td>
                                                           <!-- <td><input class="form-control" type="text" name="msg1" maxlength="40" placeholder="Alarma Nivel Nocivo" /></td>-->

                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que se envía un registro y existe al menos una especie que supera el límite Alarma Amarillo" style="cursor:help; color:#333;">
                                                                   Alarma Amarillo (Precaución)
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <select id="amarillo" name="multipleselect" multiple="multiple">
                                                                </select>
                                                            </td>
                                                            <td><input id="notcentroamarillo" type="checkbox"  /></td>
                                                            <td><input id="notacsamarillo" type="checkbox"/></td>
                                                           <!-- <td><input class="form-control" type="text" name="msg2" placeholder="Alarma Precaución" /></td>-->

                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que se envía un registro y existe presencia de microalgas bajo el límite de Alarma Precacución" style="cursor:help; color:#333;">
                                                                    Presencia Microalgas
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <select id="presencia" name="multipleselect" multiple="multiple">
                                                                </select>
                                                            </td>
                                                            <td><input id="notcentropresencia" type="checkbox"/></td>
                                                            <td><input id="notacspresencia" type="checkbox" /></td>
                                                           <!-- <td><input class="form-control" type="text" name="msg3" placeholder="Presencia Micro Algas" /></td>-->
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que el registro en ausencia de microalgas" style="cursor:help; color:#333;">
                                                                    Ausencia Microalgas
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <select id="sin" name="multipleselect" multiple="multiple">
                                                                </select>
                                                            </td>
                                                            <td><input id="notcentrosin" type="checkbox" name="notcentro" /></td>
                                                            <td><input id="notacssin" type="checkbox" name="notacs" /></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                     	</div>

                                    </div>
                                </div>
                         	</div>
                            <div class="tab-pane fade  in " id="Reportes">
                                <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading">
                                       Administración Envío Reportes
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">

                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th  valign = "middle">#</th>
                                                        <th  valign = "middle">Envío Reportes</th>
                                                        <th  valign = "middle">Destinatarios</th>
                                                        <th data-checkbox="true"  valign = "middle">Correo <br />Electrónico</th>
                                                        <th data-checkbox="true"  valign = "middle">Aplicación <br /> Móvil</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Emitir automáticamente un reporte semanal del centro" style="cursor:help; color:#333;">
                                                                Semanal por Centro
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select id="destinatario5" name="multipleselect" multiple="multiple">
                                                                <option value="cheese">Jefes de Centro</option>
                                                                <option value="tomatoes">Jefes de Área</option>
                                                                <option value="mozarella">Jefes de Agua Mar</option>
                                                                <option value="mushrooms">Gerente Medio Ambiente</option>
                                                                <option value="pepperoni">Gerente de Producción Agua Dulce</option>
                                                                <option value="onions">Gerente de Producción Agua Mar</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="checkbox" name="correo5" /></td>
                                                        <td><input type="checkbox" name="app5" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Emitir automáticamente un reporte semanal del área" style="cursor:help; color:#333;">
                                                                Semanal por Área
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select id="destinatario6" name="multipleselect" multiple="multiple">
                                                                <option value="cheese">Jefes de Centro</option>
                                                                <option value="tomatoes">Jefes de Área</option>
                                                                <option value="mozarella">Jefes de Agua Mar</option>
                                                                <option value="mushrooms">Gerente Medio Ambiente</option>
                                                                <option value="pepperoni">Gerente de Producción Agua Dulce</option>
                                                                <option value="onions">Gerente de Producción Agua Mar</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="checkbox" name="correo6" /></td>
                                                        <td><input type="checkbox" name="app6" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Emitir automáticamente un reporte semanal de la regíon" style="cursor:help; color:#333;">
                                                                Semanal por Región
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select id="destinatario7" name="multipleselect" multiple="multiple">
                                                                <option value="cheese">Jefes de Centro</option>
                                                                <option value="tomatoes">Jefes de Área</option>
                                                                <option value="mozarella">Jefes de Agua Mar</option>
                                                                <option value="mushrooms">Gerente Medio Ambiente</option>
                                                                <option value="pepperoni">Gerente de Producción Agua Dulce</option>
                                                                <option value="onions">Gerente de Producción Agua Mar</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="checkbox" name="correo7" /></td>
                                                        <td><input type="checkbox" name="app7" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Emitir automáticamente un reporte mensual del centro" style="cursor:help; color:#333;">
                                                                Mensual por Centro
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select id="destinatario8" name="multipleselect" multiple="multiple">
                                                                <option value="cheese">Jefes de Centro</option>
                                                                <option value="tomatoes">Jefes de Área</option>
                                                                <option value="mozarella">Jefes de Agua Mar</option>
                                                                <option value="mushrooms">Gerente Medio Ambiente</option>
                                                                <option value="pepperoni">Gerente de Producción Agua Dulce</option>
                                                                <option value="onions">Gerente de Producción Agua Mar</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="checkbox" name="correo8" /></td>
                                                        <td><input type="checkbox" name="app8" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>5</td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Emitir automáticamente un reporte mensual del área" style="cursor:help; color:#333;">
                                                                Mensual por Área
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select id="destinatario9" name="multipleselect" multiple="multiple">
                                                                <option value="cheese">Jefes de Centro</option>
                                                                <option value="tomatoes">Jefes de Área</option>
                                                                <option value="mozarella">Jefes de Agua Mar</option>
                                                                <option value="mushrooms">Gerente Medio Ambiente</option>
                                                                <option value="pepperoni">Gerente de Producción Agua Dulce</option>
                                                                <option value="onions">Gerente de Producción Agua Mar</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="checkbox" name="correo9" /></td>
                                                        <td><input type="checkbox" name="app9" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td>6</td>
                                                        <td>
                                                            <a data-toggle="tooltip" title="Emitir automáticamente un reporte mensual de la región" style="cursor:help; color:#333;">
                                                                Mensual por Región
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <select id="destinatario10" name="multipleselect" multiple="multiple">
                                                                <option value="cheese">Jefes de Centro</option>
                                                                <option value="tomatoes">Jefes de Área</option>
                                                                <option value="mozarella">Jefes de Agua Mar</option>
                                                                <option value="mushrooms">Gerente Medio Ambiente</option>
                                                                <option value="pepperoni">Gerente de Producción Agua Dulce</option>
                                                                <option value="onions">Gerente de Producción Agua Mar</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="checkbox" name="correo10" /></td>
                                                        <td><input type="checkbox" name="app10" /></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                    		</div>
                     	</div>
                    </div>
            		<div class="modal-footer" >
                  		<button id="closenotificaciones" type="button" class="btn btn-default" data-dismiss="">Cerrar</button>
                        <button id = "enviarnotificaciones" type="button" class="btn btn-primary">Guardar Configuración</button>
                   	</div>
                  </div>
                </div>
              </div>
            </div>




            <!-- Modal -->
            <div class="modal fade" id="myModalnotificaciones2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeupnotifusuario" type="button" class="close" data-dismiss="" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-right:100px; margin-top:9px;">CONFIGURACIÓN NOTIFICACIONES AUTOMÁTICAS</h4>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<!--<ul class="nav nav-tabs" id="myTab">
                            <li class="active" id=""><a href="#Alarmas" data-toggle="tab">1. Alarmas</a>
                            </li>
                            <li id=""><a href="#Reportes" data-toggle="tab">2. Reportes</a>
                            </li>
                        </ul>-->
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Alarmas" >
                                 <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading">
                                       Administración Notificación de Alarmas por Usuario
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                    	<div class="row center-block" >
                                            <h2 style=" text-decoration:underline">Seleccionar Usuario</h2>
                                            <select id='usuario2' multiple='multiple'>
                                            </select>
                                       	</div>
                                        <div class="row" style="margin-top:40px; padding:20px;">
                                            <h2 class="center-block" style=" text-decoration:underline">Seleccionar Centros</h2>
                                            <div class="table-responsive" style="overflow-x: unset !important">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th  valign="middle">#</th>
                                                            <th  valign = "middle">Notificación de Alarmas</th>
                                                            <th  valign = "middle">
                                                            	<div class="" style=" max-width:215px;">
                                                                    <select id="filtercentros2" class="form-control">
                                                                        <option value="Region">Ordenar Centros por Región</option>
                                                                        <option value="Area">Ordenar Centros por Área</option>
                                                                        <option value="Barrio">Ordenar Centros por ACS</option>
                                                                    </select>
                                                                </div>
                                            				</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que se envía un registro y existe al menos una especie que supera el límite Alarma Rojo" style="cursor:help; color:#333;">
                                                                   Alarma Rojo (Nivel Crítico)
                                                                </a>

                                                            </td>
                                                            <td>
                                                                <select id='alarma_usuario1' name="multipleselect_usuario" multiple='multiple'>
                                                                </select>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que se envía un registro y existe al menos una especie que supera el límite Alarma Amarillo" style="cursor:help; color:#333;">
                                                                   Alarma Amarillo (Precaución)
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <select id='alarma_usuario2' name="multipleselect_usuario" multiple='multiple'>
                                                                    </select>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que se envía un registro y existe presencia de microalgas bajo el límite de Alarma Precacución" style="cursor:help; color:#333;">
                                                                    Presencia Microalgas
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <select id='alarma_usuario3' name="multipleselect_usuario" multiple='multiple'>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>
                                                                <a data-toggle="tooltip" title="Emitir una notificación automática cada vez que el registro en ausencia de microalgas" style="cursor:help; color:#333;">
                                                                    Ausencia Microalgas
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <select id='alarma_usuario4' name="multipleselect_usuario" multiple='multiple'>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                     	</div>

                                    </div>
                                </div>
                         	</div>

                     	</div>
                    </div>
            		<div class="modal-footer" >
                  		<button id="closenotificacionesusuario" type="button" class="btn btn-default" data-dismiss="">Cerrar</button>
                        <button id = "enviarnotificacionesusuario" type="button" class="btn btn-primary">Guardar Configuración</button>
                   	</div>
                  </div>
                </div>
              </div>
            </div>






             <!-- Modal -->
            <div class="modal fade" id="myModalcentro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button id="closeupcentro" type="button" class="close" data-dismiss="" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <img src="GtrFan-MonitoreoAlgasNocivas.png" class="logo_gtr_modal pull-left">
                    <h4 class="modal-title text-center" id="myModalLabel" style="margin-right:100px; margin-top:9px;">CONFIGURACIÓN DE CENTROS</h4>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                    	<ul class="nav nav-tabs" id="myTab">
                            <li class="active" id=""><a id="a_general" href="#Centros" data-toggle="tab">General</a>
                            </li>

                            <?php
                                if($currentUser->IDempresa == 6){
                                    echo '<li id=""><a id="a_centro_productivo" href="#Barrios" data-toggle="tab">Ciclos Productivos</a></li>';
                                }

                            ?>



                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade  in active" id="Centros" >
                                 <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading" style="height:83px;">
                                    	<div class="row text-center">
                                            <span class="text-center" style="display:inline; font-weight:bold; ">A D M I N I S T R A C I Ó N&emsp; D E&emsp;  C E N T R O S </span>
                                        </div>
                                       	<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
                                            <select id="selectnombrecentro" class="form-control">
                                            </select>
                                   	  	</div>
                                        <div class="col-lg-3  col-md-2  col-xs-12 text-center">
                                        <button id="nuevocentro" type="button" class="btn btn-cerrada"><i class="fa fa-plus-circle"></i> Nuevo Centro</button>
                                        </div>

                                    </div>
                                    <div class="panel-body">
                                   		<div class="row">
                                        	<div class="col-lg-6 col-md-6 col-xs-12">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Nombre </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                    	<input class="form-control" id="nombrecentro">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Especie </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                        <select id="especiecultivadaselect" class="form-control">
                                                            <option value="Salar">Salar</option>
                                                            <option value="Coho">Coho</option>
                                                            <option value="Trucha">Trucha</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row" >
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Siembra </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                        <div class="form-group" style="margin-bottom:0px !important;">
                                                            <div class="input-group date " id="datetimepickerinicio">
                                                               <input id="fechadesde" value="" type="text" class="form-control" disabled />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" >
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Cosecha </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                        <div class="form-group" style="margin-bottom:0px !important;">
                                                            <div class="input-group date datetimepicker_modal" id="datetimepickertermino">
                                                                <input id="fechahasta" value="" type="text" class="form-control" disabled />	<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <a data-toggle="tooltip" title="Centro habilitado para cargar registros" style="cursor:help; color:#333;">
                                                        <p class="arealabel"> Habilitado </p></a>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                        <input class="form-control checkbox" type="checkbox" id="operando">
                                                    </div>
                                              	</div>
                                           	</div>
                                            <div class="col-lg-6 col-md-6 col-xs-12">

                                            	<div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Código </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                    	<input class="form-control" id="codigocentro">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> ACS </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                    	<select id="barriocentro" class="form-control">
                                            			</select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Área </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                    	<select id="areacentro" class="form-control">
                                            			</select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-2 col-xs-3">
                                                        <p class="arealabel"> Región </p>
                                                    </div>
                                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                                      <p class="arealabel">  : </p>
                                                    </div>
                                                    <div class="col-lg-8 col-md-9 col-xs-7">
                                                    	<select id="regioncentro" class="form-control">
                                            			</select>
                                                    </div>
                                                </div>
                                                <div class="row hidden">
                                                <div class="col-lg-3 col-md-2 col-xs-3">
                                                	<a data-toggle="tooltip" title="" style="cursor:help; color:#333;">
                                                    <p class="arealabel"> Colaborativo </p></a>
                                                </div>
                                                <div class="col-lg-1 col-md-1 col-xs-1">
                                                  <p class="arealabel">  : </p>
                                                </div>
                                                <div class="col-lg-8 col-md-9 col-xs-7">
                                                    <input class="form-control checkbox" type="checkbox" id="colaborativo">
                                                </div>
                                            </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="container" style="margin-top:15px; width:100%">
                                            	<div id="map"></div>

                                                <div class="ubicacion" style="border: 1px solid #fdd; padding:7px; border-radius:4%;background-color: #fee; opacity: 1; top: 5%; right:4%">
                                                    <span style="font-weight:bold; text-decoration:underline">Coordenada (DD)</span>
                                                    <br />
                                                    Latitud: <input class="form-control" id="topcentro" type="number" step="0.0001" min="-90" max="90">
                                                    Longitud: <input class="form-control" id="leftcentro" type="number" step="0.0001" min="-180" max="180">
                                                    Módulo (opcional): <input class="form-control" id="modulocentro" type="number" step="100" min="1" max="1000">
                                                    Jaula (opcional): <input class="form-control" id="jaulacentro" type="number" step="1" min="1" max="1000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                         	</div>
                            <div class="tab-pane fade  in " id="Barrios">
                                <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading">


                                       <div class="row text-center">
                                          <span class="text-center">Administración de Ciclos Productivos</span>
                                       </div>

                                       <div class="row">
                                           <div class="col-lg-3 col-md-3 col-xs-3 text-center">
                                                <span class="text-center">Centro</span>
                                                <select id="selectnombrecentro2" class="form-control">
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-xs-3 text-center">
                                                <div class="form-group" style="margin-bottom:0px !important;">
                                                    <span class="text-center">Siembra</span> <div class="input-group date " id="datetimepickerinicio2">
                                                       <input id="fechadesde2" value="" type="text" class="form-control"/>   <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-xs-3 text-center">
                                                <div class="form-group" style="margin-bottom:0px !important;">
                                                    <span class="text-center">Cosecha</span> <div class="input-group date " id="datetimepickertermino2">
                                                       <input id="fechahasta2" value="" type="text" class="form-control"/>   <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3  col-md-3  col-xs-3 text-center">
                                                <button id="nuevocentro_productivo" type="button" style="margin-top: 20px;" class="btn btn-cerrada"><i class="fa fa-plus-circle"></i> Agregar</button>
                                            </div>
                                       </div>

                                    </div>
                                    <div class="panel-body">


                                        <div class="dataTable_wrapper" style="margin-top:25px;" >

                                            <table cellSpacing="0" data-toggle="table"  data-url="load_centrosproductivos.php" data-query-params="queryParams" data-pagination="true" data-side-pagination="server" data-cache="false" data-toggle="table" data-search="true" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-show-refresh="true" width="100%" class="table table-striped table-bordered table-hover"   id="tablacentrosproductivos" >
                                                <thead>
                                                    <tr>
                                                        <th data-formatter="formatterindex" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                        <th data-field="nombre_centro" data-align= "center" data-valign = "middle" ></th>
                                                        <th data-formatter="formatterFecha" data-field="Siembra" data-align= "center" data-halign="center" data-valign = "middle" data-width = "220px">Fecha Siembra</th>
                                                        <th data-formatter="formatterFecha" data-field="Cosecha" data-align= "center" data-valign = "middle" >Fecha Cosecha</th>

                                                         <th data-formatter="formatterAcciones" data-field="Cosecha" data-align= "center" data-valign = "middle" >Acciones</th>
                                                    </tr>
                                                </thead>

                                            </table>

                                        </div>



                                    </div>
                                </div>
                    		</div>
                            <div class="tab-pane fade  in " id="Areas">
                                <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading">
                                       Administración de Áreas
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                    		</div>
                            <div class="tab-pane fade  in " id="Regiones">
                                <div class="panel panel-black" style="margin-top:15px;">
                                    <div class="panel-heading">
                                       Administración de Regiones
                                    </div>
                                    <div class="panel-body">

                                    </div>
                                </div>
                    		</div>
                     	</div>
                    </div>
            		<div class="modal-footer" >
                  		<button id="closecentro" type="button" class="btn btn-default" data-dismiss="">Cerrar</button>
                        <button id = "enviarcentro" type="button" class="btn btn-primary">Guardar Configuración</button>
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
                                	 <img src='loader.gif' /><h5> Loading... Please Wait </h5>
                                </div>
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

    <!-- Asigna menu para roles -->
    <script src="js/menu_role.js?random=<?php echo uniqid(); ?>"></script>

	<!-- Edit table -->
    <script src="js/bootstrap-editable.js"></script>
    <script src="js/bootstrap-table-editable.js"></script>

    <!-- Multiple Select -->
  	<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

    <!-- Multiple Select -->
  	<script src="js/jquery.multi-select.js" type="text/javascript"></script>

    <!-- Switch button -->
  	<script type="text/javascript" src="js/lc_switch.js"></script>



    <script>

	var user_id = <?php echo $currentUser->id; ?>;
	var id_empresa = <?php echo $currentUser->IDempresa; ?>;

	roles(<?php echo '"'.$currentUser->role.'"';?>);

	function queryParams(params) {
		params.user_id = user_id;
        return params;
    }



	//Mensaje Loding
	$( document ).ajaxStop(function () {
		$('#modalloading').modal('hide');
	});


/////////////////////////////////////////////////////////////////////////
////////////////////////  Configuración NOTIFICACIONES //////////////////
/////////////////////////////////////////////////////////////////////////

	$('#region').multiSelect({ selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Centros</div>",selectionHeader: "<div class='custom-header-select'>Centros Seleccionados</div>"});
	$('#area').multiSelect({ selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Centros</div>",selectionHeader: "<div class='custom-header-select'>Centros Seleccionados</div>" });
	$('#barrio').multiSelect({ selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Centros</div>",selectionHeader: "<div class='custom-header-select'>Centros Seleccionados</div>" });
	//Centrar multiselects
	$('#ms-region').addClass("center-block");
	$('#ms-area').addClass("center-block");
	$('#ms-barrio').addClass("center-block");

	$('#filtercentros').change( function(){
		$('#region').multiSelect('deselect_all');
		$('#area').multiSelect('deselect_all');
		$('#barrio').multiSelect('deselect_all');
		switch(document.getElementById("filtercentros").value) {
			case 'Region':
				$('#hiddenregion').removeClass("hidden");
				$('#hiddenarea').addClass("hidden");
				$('#hiddenbarrio').addClass("hidden");

				break;
			case 'Barrio':
				$('#hiddenbarrio').removeClass("hidden");
				$('#hiddenarea').addClass("hidden");
				$('#hiddenregion').addClass("hidden");
				break;
			case 'Area':
				$('#hiddenarea').removeClass("hidden");
				$('#hiddenbarrio').addClass("hidden");
				$('#hiddenregion').addClass("hidden");
		}

	});

	function loadselectcentros(){
		//Options Region
		if(distribucion['Region']){
			$.each(distribucion['Region'], function (i, item) {
				$('#region').append('<optgroup label="'+item+'"></optgroup>');
			});

			$.each(distribucion['Region_Centro'], function (i, item) {
				$('#region').multiSelect('addOption', {
					value: item[0], text: item[1], nested: item[2]
				});

			});
		}

		//Options Area

		if(distribucion['Area_Centro']){
			$.each(distribucion['Area'], function (i, item) {
				$('#area').append('<optgroup label="'+item+'"></optgroup>');
			});

			$.each(distribucion['Area_Centro'], function (i, item) {
				$('#area').multiSelect('addOption', {
					value: item[0], text: item[1], nested: item[2]
				});
			});
		}

		//Options Barrio

		if(distribucion['Barrio_Centro']){
			$.each(distribucion['Barrio'], function (i, item) {
				$('#barrio').append('<optgroup label="'+item+'"></optgroup>');
			});

			$.each(distribucion['Barrio_Centro'], function (i, item) {
				$('#barrio').multiSelect('addOption', {
					value: item[0], text: item[1], nested: item[2]
				});
			});
		}



	}

	var filtronotif = "";
	$('#region').change( function(){
		filtronotif = "region";
		searchselectcentros();
	});
	$('#area').change( function(){
		filtronotif = "area";
		searchselectcentros();
	});
	$('#barrio').change( function(){
		filtronotif = "barrio";
		searchselectcentros();
	});

	var selectedfiltername = [];
	var selectedfilter = [];
	function searchselectcentros() {
		var select1 = document.getElementById(filtronotif);
		selectedfilter = [];
		selectedfiltername = [];
		for (var i = 0; i < select1.length; i++) {
			if (select1.options[i].selected) {selectedfilter.push(select1.options[i].value); selectedfiltername.push(select1.options[i].text); 		};

		}
		loaddestinatarios(selectedfilter);
		//dataTables.bootstrapTable('refresh');

	}


	//Ordenar por Usuario
	/////////////////////

	$('#usuario2').multiSelect({selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Usuarios</div>",selectionHeader: "<div class='custom-header-select'>Usuarios Seleccionados</div>"});
	$('#ms-usuario2').addClass("center-block");


	function cargar_usuarios(){
		$.ajax({
					url: "load_notif_lista_usuarios.php",
					type: 'post',
					dataType: 'json',
					data: {
						user_id:	user_id
					},
					success: function(dato)
					{

						if(dato != ""){
							//Lista usuarios

							$('#usuario2').append('<optgroup label="Select All"></optgroup>');

							$.each(dato['Lista_Usuarios'], function (i, item) {
								$('#usuario2').multiSelect('addOption', {
									value: item[0], text: item[1], nested: "Select All"
								});

							});
							loadselectcentros2("Region_Centro");

						}
					}
		});


	}


	$('[name="multipleselect_usuario"]').multiselect({
		nonSelectedText: 'Ninguno',
		includeSelectAllOption: true,
        allSelectedText: 'Todos',
		nSelectedText: ' - Seleccionados',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		enableClickableOptGroups: true,
		maxHeight: 400
	});

	$('#filtercentros2').change( function(){
			switch(document.getElementById("filtercentros2").value) {
				case 'Region':
					loadselectcentros2("Region_Centro");
					break;
				case 'Barrio':
					loadselectcentros2("Barrio_Centro");
					break;
				case 'Area':
					loadselectcentros2("Area_Centro")
			}


	});

	function loadselectcentros2(dist){

		for(var y=1;y<=4;y++){
			//Options Region
			if(distribucion['Region']){
				$('#alarma_usuario'+y).empty();
				var optgroup = "";
				$.each(distribucion[dist], function (i, item) {

					if(optgroup !=item[2] ){
						$('#alarma_usuario'+y).append('<optgroup label="'+item[2]+'"></optgroup>');
						optgroup = item[2];
					}
					$('#alarma_usuario'+y).append('<option value="'+item[0]+'">'+item[1]+'</option>');


				});
				$('#alarma_usuario'+y).multiselect( 'rebuild' );
			}
		}

		loadcentrosuser();


	}
	var selectedfilternameusuarios = [];
	var selectedfilteruser = [];
	function loadcentrosuser(){
		$('#alarma_usuario1').multiselect("deselectAll", false);
		$('#alarma_usuario2').multiselect("deselectAll", false);
		$('#alarma_usuario3').multiselect("deselectAll", false);
		$('#alarma_usuario4').multiselect("deselectAll", false);

		//Busca configuración
		var select1 = document.getElementById("usuario2");
		selectedfilteruser = [];
		selectedfilternameusuarios = [];
		for (var i = 0; i < select1.length; i++) {
			if (select1.options[i].selected) {selectedfilteruser.push(select1.options[i].value);selectedfilternameusuarios.push(select1.options[i].text); };

		}

		if( selectedfilteruser.length == 1 ){
			$.ajax({
					url: "destinatarios_configuracion_notif_usuario.php",
					type: 'post',
					dataType: 'json',
					data: {
						IDuser:   parseInt(selectedfilteruser),
						user_id:	user_id
					},
					success: function(dato)
					{

						if(dato != ""){
							$('#alarma_usuario1').multiselect('select',dato['Rojo']);
							$('#alarma_usuario2').multiselect('select',dato['Amarillo']);
							$('#alarma_usuario3').multiselect('select',dato['Presencia']);
							$('#alarma_usuario4').multiselect('select',dato['Sin']);
						}
					},error: function(err){
						console.log(err);
					}
			});
		}
		$('#alarma_usuario1').multiselect("refresh");
		$('#alarma_usuario2').multiselect("refresh");
		$('#alarma_usuario3').multiselect("refresh");
		$('#alarma_usuario4').multiselect("refresh");

	}


	$('#usuario2').change( function(){
		loadcentrosuser();
	});


    function eliminar_centrosproductivos(id){
        $.ajax({
            type: "Post",
            url: "eliminar_centros_productivos.php",
            data: {
                    id: id,
                    id_empresa:id_empresa,
            },

            success: function( msg ) {
                 if(msg){
                    $('#tablacentrosproductivos').bootstrapTable('refresh');
                 }
            },
            error: function(err)
            {
                console.log(err);
            }
        });
    }


    $('#nuevocentro_productivo').click(function(e){


         $.ajax({
            type: "Post",
            url: "guardar_centros_productivos.php",
            data: {
                    id_centro: $("#selectnombrecentro2").val(),
                    siembra:         $('#fechadesde2').val(),
                    cosecha:       $('#fechahasta2').val(),
            },

            success: function( msg ) {
                 if(msg){
                    if(msg==-1){
                        alert("Ya tiene un ciclo con esta fecha");
                    }
                    $('#tablacentrosproductivos').bootstrapTable('refresh');
                 }
            },
            error: function(err)
            {
                console.log(err);
            }
        });
    });




	//Load opciones profundidad y distribución
	var distribucion = "";
	$( document ).ready(function() {

        if(id_empresa !=6){
            $("#fechadesde").attr("disabled", false);
            $("#fechadesde").prop("disabled", false);

            $("#fechahasta").attr("disabled", false);
            $("#fechahasta").prop("disabled", false);


        }



		$.ajax({
				url: "load_distribucion.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:	user_id
				},
				success: function(dato)
				{

					if(dato != ""){
						distribucion = dato;
						loadselectcentros();

					}
				},error: function(err){
					console.log(err);
				}
		});

	});



	function loaddestinatarios(selectedfilter){

		$.ajax({
				url: "destinatarios_configuracion.php",
				type: 'post',
				dataType: 'json',
				data: {
					IDcentro:   parseInt(selectedfilter),
					user_id:	user_id
				},
				success: function(dato)
				{

					if(dato != ""){
						$('#rojo').empty();
						$('#amarillo').empty();
						$('#presencia').empty();
						$('#sin').empty();
						$.each(dato['Nombres_Destinatarios'], function (i, item) {
							$('#rojo').append($('<option>', {
								value: dato['IDdestinatarios'][i],
								text : item
							}));
							$('#amarillo').append($('<option>', {
								value: dato['IDdestinatarios'][i],
								text : item
							}));
							$('#presencia').append($('<option>', {
								value: dato['IDdestinatarios'][i],
								text : item
							}));
							$('#sin').append($('<option>', {
								value: dato['IDdestinatarios'][i],
								text : item
							}));
						});

						$('#rojo').multiselect( 'rebuild' );
						$('#amarillo').multiselect( 'rebuild' );
						$('#presencia').multiselect( 'rebuild' );
						$('#sin').multiselect( 'rebuild' );


						if( selectedfilter.length == 1 ){
							$('#presencia').multiselect('select',dato['Presencia']);
							$('#amarillo').multiselect('select',dato['Amarillo']);
							$('#rojo').multiselect('select',dato['Rojo']);
							$('#sin').multiselect('select',dato['Sin']);
						}
					}
				},error: function(err){
					console.log(err);
				}
		});

	}

	$('#enviarnotificaciones').click(function(e)
	{


		if(selectedfiltername.length > 0){
			swal({
					  title: "Está Seguro?",
					  text: "Está seguro que desea guardar las modificaciones para el(los) centro(s): "+selectedfiltername,
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "Si, Guardar!",
					  cancelButtonText: "No, Cancelar!",
					  closeOnConfirm: true,
					  closeOnCancel: true
					},
					function(isConfirm){
					  if (isConfirm) {
						var rojoselect = [];
						$('#rojo option:selected').each(function() {
								rojoselect.push($(this).val());
						});
						var amarilloselect = [];
						$('#amarillo option:selected').each(function() {
								amarilloselect.push($(this).val());
						});
						var presenciaselect = [];
						$('#presencia option:selected').each(function() {
								presenciaselect.push($(this).val());
						});
						var sinselect = [];
						$('#sin option:selected').each(function() {
								sinselect.push($(this).val());
						});

						$('#modalloading').modal({backdrop: 'static', keyboard: false});
						$.ajax({
						url: "save_notificaciones_alarma.php",
						type: 'post',
						data: {
							IDrojo: 	   rojoselect,
							IDamarillo:   amarilloselect,
							IDpresencia:  presenciaselect,
							IDsin: 		sinselect,
							Crojo:		$('#notcentrorojo').is(':checked') ? 1 : 0,
							Camarillo:	$('#notcentroamarillo').is(':checked') ? 1 : 0,
							Cpresencia:   $('#notcentropresencia').is(':checked') ? 1 : 0,
							Csin:		 $('#notcentrosin').is(':checked') ? 1 : 0,
							Acsrojo:	  $('#notacsrojo').is(':checked') ? 1 : 0,
							Acsamarillo:  $('#notacsamarillo').is(':checked') ? 1 : 0,
							Acspresencia: $('#notacspresencia').is(':checked') ? 1 : 0,
							Acssin:	   $('#notacssin').is(':checked') ? 1 : 0,
							IDcentro: 	 selectedfilter,
							user_id:	  user_id
						},
						success: function(msg)
						{


							if(msg == 0){

								var obs = "";//prompt("Indique el motivo de la modificación", "");
								if (obs != null) {

									savehistorial("Notificación Alarmas",obs);

									//$('#myModalnotificaciones').modal('hide');
								}else{
									//swal("Modificado", "Configuración guardada con éxito!", "success");
									savehistorial("Notificación Alarmas","");
									//$('#myModalnotificaciones').modal('hide');
								}
							}else{
								swal("Error", "Error al guardar la configuración"+msg, "error");
							}
							searchselectcentros();

						}
					});
				  } else {
					swal("Cancelado", "", "error");
				  }
			});
		}else{
			swal("", "Debe seleccionar un centro", "warning");
		}

	});


	//Guardar ordenado por usuario
	$('#enviarnotificacionesusuario').click(function(e){

		if(selectedfilternameusuarios.length > 0){
			swal({
					  title: "Está Seguro?",
					  text: "Está seguro que desea guardar las modificaciones para el(los) usuarios(s): "+selectedfilternameusuarios,
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonColor: "#DD6B55",
					  confirmButtonText: "Si, Guardar!",
					  cancelButtonText: "No, Cancelar!",
					  closeOnConfirm: true,
					  closeOnCancel: true
					},
					function(isConfirm){
					  if (isConfirm) {
						var rojoselect = [];
						$('#alarma_usuario1 option:selected').each(function() {
								rojoselect.push($(this).val());
						});
						var amarilloselect = [];
						$('#alarma_usuario2 option:selected').each(function() {
								amarilloselect.push($(this).val());
						});
						var presenciaselect = [];
						$('#alarma_usuario3 option:selected').each(function() {
								presenciaselect.push($(this).val());
						});
						var sinselect = [];
						$('#alarma_usuario4 option:selected').each(function() {
								sinselect.push($(this).val());
						});

						$('#modalloading').modal({backdrop: 'static', keyboard: false});
						$.ajax({
						url: "save_notificaciones_alarma_usuarios.php",
						type: 'post',
						data: {
							IDrojo: 	   rojoselect,
							IDamarillo:   amarilloselect,
							IDpresencia:  presenciaselect,
							IDsin: 		sinselect,
							IDuser: 	   selectedfilteruser,
							user_id:	  user_id
						},
						success: function(msg)
						{


							if(msg == 0){

								var obs = "";//prompt("Indique el motivo de la modificación", "");
								if (obs != null) {
									//swal("Modificado", "Configuración guardada con éxito!", "success");
									savehistorial("Notificación Alarmas",obs);
									//$('#myModalnotificaciones').modal('hide');
								}else{
									//swal("Modificado", "Configuración guardada con éxito!", "success");
									savehistorial("Notificación Alarmas","");
									//$('#myModalnotificaciones').modal('hide');
								}
							}else{
								swal("Error", "Error al guardar la configuración"+msg, "error");
							}
							loadcentrosuser();

						}
					});
				  } else {
					swal("Cancelado", "", "error");
				  }
			});
		}else{
			swal("", "Debe seleccionar un usuario", "warning");
		}

	});




/////////////////////////////////////////////////////////////////////////
////////////////////////  Configuración Centros  ////////////////////////
/////////////////////////////////////////////////////////////////////////

	var dateinicio = new Date();
	dateinicio.setDate(dateinicio.getDate()-6);
	$('#datetimepickerinicio').datetimepicker({
    format: 'YYYY-MM-DD',
	defaultDate: dateinicio,
	});

	var datetermino = new Date();
	datetermino.setDate(datetermino.getDate());
	$('#datetimepickertermino').datetimepicker({
    format: 'YYYY-MM-DD',
	defaultDate: datetermino,
	});

	$(function () {
		$('#datetimepickerinicio').datetimepicker();
		$('#datetimepickertermino').datetimepicker({
			useCurrent: false //Important! See issue #1075
		});
		$("#datetimepickerinicio").on("dp.change", function (e) {
			$('#datetimepickertermino').data("DateTimePicker").minDate(e.date);
		});
		$("#datetimepickertermino").on("dp.change", function (e) {
			$('#datetimepickerinicio').data("DateTimePicker").maxDate(e.date);
		});
	});


    var dateinicio2 = new Date();
    dateinicio2.setDate(dateinicio2.getDate()-6);
    $('#datetimepickerinicio2').datetimepicker({
    format: 'YYYY-MM-DD',
    defaultDate: dateinicio2,
    });

    var datetermino2 = new Date();
    datetermino2.setDate(datetermino2.getDate());
    $('#datetimepickertermino2').datetimepicker({
    format: 'YYYY-MM-DD',
    defaultDate: datetermino2,
    });

    $(function () {
        $('#datetimepickerinicio2').datetimepicker();
        $('#datetimepickertermino2').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepickerinicio2").on("dp.change", function (e) {
            $('#datetimepickertermino2').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepickertermino2").on("dp.change", function (e) {
            $('#datetimepickerinicio2').data("DateTimePicker").maxDate(e.date);
        });
    });


	var nombreregion = "Region_10";
	$('#selectregion').click( function(){
		$("#imgregion").attr("src","img/region_"+this.value+".png");
	});



	//var top1 = 0;
//	var left1 = 0;
//	$('#imgregion').click(function(e)
//	{
//
//
//		var offset_t = $(this).offset().top - $(window).scrollTop();
//		var offset_l = $(this).offset().left - $(window).scrollLeft();
//
//		left1 =  (e.clientX - offset_l) ;
//		top1 =  (e.clientY - offset_t) ;
//
//		var left =  (left1/document.getElementById('imgregion').clientWidth)*100 ;
//		var top = (top1/document.getElementById('imgregion').clientHeight)*100 ;
//
//		$("#marker").css( 'top', top+"%");
//		$("#marker").css( 'left', left+"%");
//
//		$('#topcentro').val(100-Math.round(top));
//		$('#leftcentro').val(Math.round(left));
//
//	});

	$('#topcentro, #leftcentro').change(function(){
		//$("#marker").css( 'top', 100-$('#topcentro').val()+"%");
//		$("#marker").css( 'left', $('#leftcentro').val()+"%");

		changemarker($('#topcentro').val(),$('#leftcentro').val());
	});


	var datosbarrio = [];
	function loadcentros(){
		$.ajax({
					url: "load_configuracion_centros.php",
					type: 'POST',
					data: {
						user_id: user_id
					},
					success: function(dato)
					{

                            $('#tablacentrosproductivos').bootstrapTable();

							dato = JSON.parse(dato);
							if(dato['Error'] == 0){
								$( '#selectnombrecentro' ).empty();
                                $( '#selectnombrecentro2' ).empty();
								if(dato['Region_Centro'] != ""){
									$.each(dato['Region_Centro'], function (i, item) {
										$('#selectnombrecentro').append($('<option>', {
											value: dato['Region_Centro'][i][0],
											text : dato['Region_Centro'][i][1]
										}));

                                        $('#selectnombrecentro2').append($('<option>', {
                                            value: dato['Region_Centro'][i][0],
                                            text : dato['Region_Centro'][i][1]
                                        }));
									});
								}
								$('#selectnombrecentro').append($('<option>', {
										value: "nuevo",
										text : "+ Agregar Nuevo Centro"
								}));

								$( '#barriocentro' ).empty();
								$.each(dato['Barrio'], function (i, item) {
									$('#barriocentro').append($('<option>', {
										value: dato['Barrio'][i]['IDbarrio'],
										text : dato['Barrio'][i]['Nombre']
									}));
								});

								$( '#areacentro' ).empty();
								$.each(dato['Area'], function (i, item) {
									$('#areacentro').append($('<option>', {
										value: dato['Area'][i],
										text : dato['Area'][i]
									}));
								});

								$( '#regioncentro' ).empty();
								$.each(dato['Region'], function (i, item) {
									$('#regioncentro').append($('<option>', {
										value: dato['Region'][i],
										text : dato['Region'][i]
									}));
								});



								//Buscar los poligonos de los barrios
								$.ajax({
									url: "load_ubicacion_barrios_colab.php",
									type: 'post',
									data: {
										user_id:			user_id
									},
									success: function(dato)
									{

										datosbarrio = JSON.parse(dato);

										if(datosbarrio['Error'] == 0){

											if($('#selectnombrecentro').val() == "nuevo"){
												$('#nombrecentro').val("");
												$('#codigocentro').val("");
												$('#especiecultivadaselect').val("");
												$('#fechadesde').val("");
												$('#fechahasta').val("");
												$('#barriocentro').val("");
												$('#areacentro').val("");
												$('#regioncentro').val("Región de los Lagos");
												$('#topcentro').val(-42.5);
												$('#leftcentro').val(-73.5);
                        $('#modulocentro').val('');
                        $('#jaulacentro').val('');
												$('#colaborativo').lcs_off();
												$('#operando').lcs_on();
												$('#topcentro').change();
												$("#codigocentro").prop('disabled', false);
												clearMarkersbarrio ();
											}else{
												loadinfocentros();
											}


										}else if(datos['Error'] == "No existe"){
											//swal("", "No existen centros para los filtros", "warning");

										}else{swal("Error", "Error al cargar ubicación de los Barrios.", "error");}
									},error: function(msg){console.log(msg);}
								});


							}
					}

		});


	}



	var existecodigo = 0
	$('#codigocentro').blur( function(){
		// Check if existe Codigo Centro
		$.ajax({
					url: "check_codigo.php",
					type: 'post',
					dataType: 'json',
					data: {
						Codigo:	$("#codigocentro").val(),
						user_id: user_id
					},
					success: function(dato)
					{
						if(dato != ""){
							swal("", "El centro con código SIEP ya existe", "warning");
							existecodigo = 1;
						}else{
							existecodigo = 0;
						}
					}
		});

	});

	$('#nuevocentro').click(function(){

		//swal({
//				  title: "Guardar",
//				  text: "¿Desea guardar modificaciones antes de cambiar de centro?",
//				  type: "warning",
//				  showCancelButton: true,
//				  confirmButtonColor: "#DD6B55",
//				  confirmButtonText: "Si, Guardar!",
//				  cancelButtonText: "No, Cambiar",
//				  closeOnConfirm: true,
//				  closeOnCancel: true
//				},
//				function(isConfirm){
//				  if (isConfirm) {
//					     guardarcentros("");
//			  	  } else {
					  	$('#selectnombrecentro').val("nuevo");
						$('#nombrecentro').val("");
						$('#codigocentro').val("");
						$('#especiecultivadaselect').val("");
						$('#fechadesde').val("");
						$('#fechahasta').val("");
						$('#barriocentro').val("");
						$('#areacentro').val("");
						$('#regioncentro').val("Región de los Lagos");
						$('#topcentro').val(-42.5);
						$('#leftcentro').val(-73.5);
            $('#modulocentro').val('');
            $('#jaulacentro').val('');
						$('#colaborativo').lcs_off();
						$('#operando').lcs_on();
						$('#topcentro').change();
						$("#codigocentro").prop('disabled', false);
						clearMarkersbarrio ();
						changeregion($('#regioncentro option:selected').text());
			//	}
//			});

	});


	var idprevio;
	$('#selectnombrecentro').on('focus', function () {
        idprevio = document.getElementById("selectnombrecentro").value;
    }).change(function(no){
		//swal({
//				  title: "Guardar",
//				  text: "¿Desea guardar modificaciones antes de cambiar de centro?",
//				  type: "warning",
//				  showCancelButton: true,
//				  confirmButtonColor: "#DD6B55",
//				  confirmButtonText: "Si, Guardar!",
//				  cancelButtonText: "No, Cambiar",
//				  closeOnConfirm: true,
//				  closeOnCancel: true
//				},
//				function(isConfirm){
//				  if (isConfirm) {
//					     guardarcentros(idprevio);
//			  	  } else {
					  	if($('#selectnombrecentro').val() == "nuevo"){
							$('#nombrecentro').val("");
							$('#codigocentro').val("");
							$('#especiecultivadaselect').val("");
							$('#fechadesde').val("");
							$('#fechahasta').val("");
							$('#barriocentro').val("");
							$('#areacentro').val("");
							$('#regioncentro').val("Región de los Lagos");
							$('#topcentro').val(-42.5);
							$('#leftcentro').val(-73.5);
              $('#modulocentro').val('');
              $('#jaulacentro').val('');
							$('#colaborativo').lcs_off();
							$('#operando').lcs_on();
							$('#topcentro').change();
							$("#codigocentro").prop('disabled', false);
							clearMarkersbarrio();
						}else{
							loadinfocentros();
						}
				//}
//			});

	});

	$('#regioncentro').change(function(){
		changeregion($('#regioncentro option:selected').text());
	});
	$('#barriocentro').change(function(){
		clearMarkersbarrio ();
		var key = $('#barriocentro option:selected').val();
		asdfabarrio(datosbarrio['TopLeft'][key],"#ab5400",key);
	});

	var markers_barrio = new Array();
	function asdfabarrio(barrio_coord,color,idbarrio){

		var fill = color;
		if(color == "#ab5400"){fill = "#ffffff00";}



		var mi_barrio = new google.maps.Polygon({
          paths: barrio_coord,
          strokeColor: color,
          strokeOpacity: 0.8,
          strokeWeight: 1.7,
          fillColor: fill,
          fillOpacity: 0.35,
		  visible: true,
		  clickable: false,
        });

		mi_barrio.setMap(map);
		markers_barrio.push({name: mi_barrio,  index:  idbarrio});
	 }
	 function clearMarkersbarrio (){
        $.each(markers_barrio, function (index, value) {
                element = value.name;
			    element.setMap(null);
        });
		markers_barrio = [];
     }


	function loadinfocentros(){
		$("#codigocentro").prop('disabled', true);
		$.ajax({
					url: "load_info_centro.php",
					type: 'post',
					data: {
						IDcentro:	document.getElementById("selectnombrecentro").value
					},
					success: function(dato)
					{

							dato = JSON.parse(dato);
							if(dato['Error'] == 0){
								$('#nombrecentro').val(dato['Info_Centro'][0].Centro);
								$('#codigocentro').val(dato['Info_Centro'][0].Codigo);
								$('#especiecultivadaselect').val(dato['Info_Centro'][0].Especie);


                                if(dato['Info_Centro'][0].siembra_cp){
                                    $('#fechadesde').val(dato['Info_Centro'][0].siembra_cp);
                                }else{
                                    $('#fechadesde').val(dato['Info_Centro'][0].Siembra);

                                }

                                if(dato['Info_Centro'][0].cosecha_cp){
                                    $('#fechahasta').val(dato['Info_Centro'][0].cosecha_cp);
                                }else{
                                   $('#fechahasta').val(dato['Info_Centro'][0].Cosecha);
                                }




								$('#barriocentro').val(dato['Info_Centro'][0].IDbarrio);
								$('#areacentro').val(dato['Info_Centro'][0].Area);
								$('#regioncentro').val(dato['Info_Centro'][0].Region);
								var topleft = dato['Info_Centro'][0].TopLeft.split(",");
								$('#leftcentro').val(topleft[1].replace('%',''));
								$('#topcentro').val(topleft[0].replace('%','') );

                $('#modulocentro').val(dato['Info_Centro'][0].Modulo);
                $('#jaulacentro').val(dato['Info_Centro'][0].Jaula);

								if(dato['Info_Centro'][0].Colaborativo == 1){$('#colaborativo').lcs_on();}else{$('#colaborativo').lcs_off();};

								if(dato['Info_Centro'][0].Estado == 1){$('#operando').lcs_on();}else{$('#operando').lcs_off();};

								$('#topcentro').change();
								//var centermarker = {lat: parseInt($('#topcentro').val()), lng: parseInt($('#leftcentro').val())};
								//console.log(centermarker);
								//map.setCenter(centermarker);
								//changeregion(dato['Info_Centro'][0].Region);

								clearMarkersbarrio ();
								var key = dato['Info_Centro'][0].IDbarrio;
								asdfabarrio(datosbarrio['TopLeft'][key],"#ab5400",key);
							}

					},
					error: function(err)
					{
						console.log(err);
					}

		});

	}

	$( "#enviarcentro" ).click( function(){

		//alert("En estos momentos se está realizando una actualización de los centros del sistema. Por favor inténtelo más tarde o pongase en contacto con el administrador.");
        console.log($('#nombrecentro').val() );
        console.log($('#codigocentro').val() );
        console.log($('#especiecultivadaselect option:selected').text() );
        console.log($('#barriocentro option:selected').text() );
        console.log($('#areacentro option:selected').text() );
        console.log($('#regioncentro option:selected').text() );
        console.log($('#fechadesde').val() );
        console.log($('#fechahasta').val() );

        if(id_empresa == 6){

            if( $('#nombrecentro').val() == "" || $('#codigocentro').val() == "" || $('#especiecultivadaselect option:selected').text() == "" || $('#barriocentro option:selected').text() == "" ||  $('#areacentro option:selected').text() == "" || $('#regioncentro option:selected').text() == ""  ){
                swal("", "Existen campos vacíos", "warning");
            } else{
                guardarcentros("");
            }

        }else{
            if( $('#nombrecentro').val() == "" || $('#codigocentro').val() == "" || $('#especiecultivadaselect option:selected').text() == "" || $('#barriocentro option:selected').text() == "" ||  $('#areacentro option:selected').text() == "" || $('#regioncentro option:selected').text() == "" || $('#fechadesde').val() == "" || $('#fechahasta').val() == "" ){
                swal("", "Existen campos vacíos", "warning");
            } else{
                guardarcentros("");
            }
        }



	});




    $( "#a_centro_productivo" ).click( function(){

        $("#enviarcentro").hide();
    });

    $( "#a_general" ).click( function(){
        $("#enviarcentro").show();
    });



	function guardarcentros(idprevio){
		if(existecodigo == 0){
			if( check_inside_barrio() ){

				var idcentro = "";
				if(idprevio !=""){idcentro = idprevio;
				}else{
					if(document.getElementById("selectnombrecentro").value){
						idcentro = document.getElementById("selectnombrecentro").value;
					}
				}
				$('#modalloading').modal({backdrop: 'static', keyboard: false});
				$.ajax({
							url: "save_info_centro.php",
							type: 'post',
							data: {
								IDcentro:      idcentro,
								Nombre:	 	$('#nombrecentro').val(),
								Codigo:	 	$('#codigocentro').val(),
								Especie:  	   $('#especiecultivadaselect').val(),
								Siembra:	   $('#fechadesde').val(),
								Cosecha:	   $('#fechahasta').val(),
								Barrio:	 	$('#barriocentro option:selected').text(),
								Area:	   	  $('#areacentro').val(),
								Region:	 	$('#regioncentro').val(),
								Top:		   $('#topcentro').val(),
								Left:	   	  $('#leftcentro').val(),
                Modulo:	   	  $('#modulocentro').val(),
                Jaula:	   	  $('#jaulacentro').val(),
								Colaborativo:  $('#colaborativo').is(':checked') ? 1 : 0,
								Estado:  		$('#operando').is(':checked') ? 1 : 0,
								user_id:	   user_id

							},
							success: function(msg)
							{


									if(msg == 0){
										text = "Modificación"
										if($('#selectnombrecentro').val() == "nuevo"){text = "Ingreso"}

										var obs ="";// prompt("Indique el motivo de la modificación", text+" Centro: "+$('#nombrecentro').val());
										if (obs != null) {
											//swal("Modificado", "Configuración guardada con éxito!", "success");
											savehistorial("Centros",obs);

										}else{
											//swal("Modificado", "Configuración guardada con éxito!", "success");
											savehistorial("Centros","");

										}
										//alert("Configuración guardada con éxito");

											//$('#myModalcentro').modal('hide');
									}else{
										//$('#myModalcentro').modal('hide');

										swal("", msg, "error");
									}
							},
							error: function(err)
							{
								console.log(err);
							},

				});

			}else{
				alert("La coordenada del centro no pertenece al barrio seleccionado");
			}

		}else{
			alert("El centro con código SIEP ya existe");
		}

	}


	$('[name="multipleselect"]').multiselect({
		nonSelectedText: 'Ninguno',
		includeSelectAllOption: true,
        allSelectedText: 'Todos',
		nSelectedText: ' - Seleccionados',
		enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		maxHeight: 400
	});


	$('#verreporte').click( function(){
		tablasverreporte();
		$('#myModalverreporte').modal('show');
	});


	function tablasverreporte(){


			$.ajax({
					url: "load_fan_reporte.php",
					type: 'post',
					data: {
						IDmedicion: 	 dataTables.bootstrapTable('getSelections')[0].IDmedicion,
						user_id:		user_id
					},
					success: function(dato)
					{
						$('#tabladiatomeasver').bootstrapTable("removeAll");
						$('#tabladinoflageladosver').bootstrapTable("removeAll");
						$('#tablaoespeciesver').bootstrapTable("removeAll");
						if(dato != 0){
							var datos = JSON.parse(dato);
							$('#tabladiatomeasver').bootstrapTable("load", datos['Diatomeas']);
							$('#tabladinoflageladosver').bootstrapTable("load", datos['Dinoflagelados']);
							$('#tablaoespeciesver').bootstrapTable("load", datos['OEsp']);
							document.getElementById("fechaverreporte").value = datos['Fecha_Reporte'];
							document.getElementById("fechaenvioverreporte").value = datos['Fecha_Envio'];
							document.getElementById("tecnicaverreporte").value = datos['Tecnica'];
							document.getElementById("obsverreporte").value = datos['Observaciones'];
							document.getElementById("firmaverreporte").value = datos['Firma'];

						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});
			//Parámetros Ambientales
			$.ajax({
					url: "load_pambientales_reporte.php",
					type: 'post',
					data: {
						IDmedicion: 	 dataTables.bootstrapTable('getSelections')[0].IDmedicion,
						user_id:		user_id
					},
					success: function(dato)
					{
						$('#tablapambientalesver').bootstrapTable("removeAll");
						if(dato != 0){
							var datos = JSON.parse(dato);
							$('#tablapambientalesver').bootstrapTable("load", datos['PAmbientales']);
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

	}


	$( "#abrirmodalalarmas" ).click( function(){
		$('#tabladiatomeas').bootstrapTable('refresh');
		$('#tabladinoflagelados').bootstrapTable('refresh');
		$('#tablaoespecies').bootstrapTable('refresh');
		$('#myModalalarmas').modal({backdrop: 'static', keyboard: false});
		$('#myModalalarmas').modal('show');
	});
	$( "#abrirmodalimagen" ).click( function(){
		$('#tabladiatomeaseditdetalle').bootstrapTable('refresh');
		$('#tabladinoflageladoseditdetalle').bootstrapTable('refresh');
		$('#tablaoespecieseditdetalle').bootstrapTable('refresh');
		$('#myModaldetalleespecie').modal({backdrop: 'static', keyboard: false});
		$('#myModaldetalleespecie').modal('show');
	});
	$( "#abrirmodalpamb" ).click( function(){
		alert("Favor contactar al administrador.")
		//$('#myModalpamb').modal({backdrop: 'static', keyboard: false});
		//$('#myModalpamb').modal('show');
	});
	$( "#abrirmodalnotificaciones" ).click( function(){
		$('#myModalnotificaciones').modal({backdrop: 'static', keyboard: false});
		$('#myModalnotificaciones').modal('show');
	});
	$( "#abrirmodalnotificaciones2" ).click( function(){
		$('#myModalnotificaciones2').modal({backdrop: 'static', keyboard: false});
		cargar_usuarios();
		$('#myModalnotificaciones2').modal('show');
	});
	$( "#abrirmodalusuarios" ).click( function(){
		//alert("En éste momento se está realizando una actualización en la administración de Usuarios. Por favor, intente más tarde.");
		window.location.replace("http://fan.gtrgestion.cl/auth/users.php");
	});


    $( "#abrirmodalcentro" ).click( function(){
		$('#myModalcentro').modal({backdrop: 'static', keyboard: false});
		loadcentros();
		$('#myModalcentro').modal('show');
	});


	$( "#addespecie" ).click( function(){
		$('#myModaladdespecie').modal('show');
	});

	//Add especie Image

//	$("#profileImage").click(function(e) {
//		$("#imageUpload").click();
//	});

	function fasterPreview( uploader ) {
		if ( uploader.files && uploader.files[0] ){
			  $('#profileImage').attr('src',
				 window.URL.createObjectURL(uploader.files[0]) );
		}
	}

	$("#imageUpload").change(function(){
		fasterPreview( this );
	});

	//Edit Image
	$("#profileImageeditimg").click(function(e) {
		$("#imageUploadeditimg").click();
	});

	function fasterPrevieweditimg( uploader ) {
		if ( uploader.files && uploader.files[0] ){
			  $('#profileImageeditimg').attr('src',
				 window.URL.createObjectURL(uploader.files[0]) );
		}
	}

	$("#imageUploadeditimg").change(function(){
		fasterPrevieweditimg( this );
	});



	$( "#enviaralarmas").click(function(){

		//var empty = "";
//		var diato = 0;
//		var dino = 0;
//		var oesp = 0;
//		var pamb = 0;
//		$('#Diatomeas-form input:empty').each(function(i){console.log("si");
//			if( !this.value && diato == 0) {
//				empty = empty.concat("Diatomeas").concat(", ");
//				diato = 1;
//			}
//		});
//		$('#Dinoflagelados-form input:empty' ).each(function(){
//			if( !this.value && dino == 0 ) {
//				empty = empty.concat("Dinoflagelados").concat(", ");
//				dino = 1;
//			}
//		});
//		$('#OEspecies-form input:empty' ).each(function(){
//			if( !this.value && oesp == 0) {
//				empty = empty.concat("Otras Especies").concat(", ");
//				oesp = 1;
//			}
//		});
//		$('#PAmbientales-form input:empty' ).each(function(){
//			if( !this.value && pamb == 0) {
//				empty = empty.concat("Parámetros Ambientales").concat(", ");
//				pamb = 1;
//			}
//		});
//
//		if(empty != ""){
			var iddiato = [""];
			var diato0 = [""];
			var diato1 = [""];
			var iddino = [""];
			var dino0 = [""];
			var dino1 = [""];
			var idoesp = [""];
			var oesp0 = [""];
			var oesp1 = [""];
			var idpamb = [""];
			var pamb0 = [""];
			var pamb1 = [""];
			var k = 0;
			for(var i = 0; i < $('#tabladiatomeas').bootstrapTable('getData').length; i++){
				var entro = 0;

				if(document.getElementById("diato0".concat(i)).value){
					diato0[k] = document.getElementById("diato0".concat(i)).value;
					entro = 1;
				}

				if(document.getElementById("diato1".concat(i)).value){
					diato1[k] = document.getElementById("diato1".concat(i)).value;
					entro = 1;
				}


				if(entro == 1){
					iddiato[k] = $('#tabladiatomeas').bootstrapTable('getData')[i].IDespecie;
					if(!diato0[k]){
						diato0[k] = "";
					}
					if(!diato1[k]){
						diato1[k] = "";
					}


					k++;
					entro = 0;
				}
			}
			//Dinoflagelados
			k = 0;
			for(var i = 0; i < $('#tabladinoflagelados').bootstrapTable('getData').length; i++){
				var entro = 0;

				if(document.getElementById("dino0".concat(i)).value){
					dino0[k] = document.getElementById("dino0".concat(i)).value;
					entro = 1;
				}
				if(document.getElementById("dino1".concat(i)).value){
					dino1[k] = document.getElementById("dino1".concat(i)).value;
					entro = 1;
				}

				if(entro == 1){
					iddino[k] = $('#tabladinoflagelados').bootstrapTable('getData')[i].IDespecie;

					if(!dino0[k]){
						dino0[k] = "";
					}
					if(!dino1[k]){
						dino1[k] = "";
					}
					k++;
					entro = 0;
				}
			}

			//Otras Especies
			k = 0;
			for(var i = 0; i < $('#tablaoespecies').bootstrapTable('getData').length; i++){
				var entro = 0;
				if(document.getElementById("oesp0".concat(i)).value){
					oesp0[k] = document.getElementById("oesp0".concat(i)).value;
					entro = 1;
				}
				if(document.getElementById("oesp1".concat(i)).value){
					oesp1[k] = document.getElementById("oesp1".concat(i)).value;
					entro = 1;
				}


				if(entro == 1){
						idoesp[k] = $('#tablaoespecies').bootstrapTable('getData')[i].IDespecie;
						if(!oesp0[k]){
							oesp0[k] = "";
						}
						if(!oesp1[k]){
							oesp1[k] = "";
						}
						k++;
						entro = 0;
					}
			}

			//Parámetros ambientales
			k = 0;
			for(var i = 0; i < $('#tablapambientales').bootstrapTable('getData').length; i++){
				var entro = 0;

				if(document.getElementById("pamb0".concat(i)).value){
					pamb0[k] = document.getElementById("pamb0".concat(i)).value;
					entro = 1;
				}
				if(document.getElementById("pamb1".concat(i)).value){
					pamb1[k] = document.getElementById("pamb1".concat(i)).value;
					entro = 1;
				}

				if(entro == 1){
					idpamb[k] = $('#tablapambientales').bootstrapTable('getData')[i].IDpambientales;
					if(!pamb0[k]){
						pamb0[k] = "";
					}
					if(!pamb1[k]){
						pamb1[k] = "";
					}
					k++;
					entro = 0;
				}
			}

			guardarreporte(iddiato,diato0,diato1,iddino,dino0,dino1,idoesp,oesp0,oesp1,idpamb,pamb0,pamb1);

//		}else{empty = empty.replace(/, $/, ''); swal("", "Existen campos vacios en pestaña: "+empty, "warning");};
	});


	function guardarreporte(iddiato,diato0,diato1,iddino,dino0,dino1,idoesp,oesp0,oesp1,idpamb,pamb0,pamb1){
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
				url: "save_alarmas.php",
				type: 'post',
				data: {
				 IDdiatomeas: 				  		iddiato,
				 Medicion0_Diatomeas: 			 	diato0,
				 Medicion1_Diatomeas: 				diato1,
				 IDdinoflagelados: 				   iddino,
				 Medicion0_Dinoflagelados: 		   dino0,
				 Medicion1_Dinoflagelados: 		   dino1,
				 IDoespecies: 				  		idoesp,
				 Medicion0_oespecies: 			 	oesp0,
				 Medicion1_oespecies: 				oesp1,
				 IDpambientales: 				  	 idpamb,
				 Medicion0_pambientales: 			 pamb0,
				 Medicion1_pambientales: 			 pamb1,
				 Firma:							  $('#nombreusuario').val(),
				 user_id:			  				user_id
				},
				success: function(msg)
				{
					if(msg == 0){
						var obs = "";// prompt("Indique el motivo de la modificación", "");

						if (obs != null) {
							//swal("", "Configuración enviada con éxito!", "success");
							savehistorial("Alarmas",obs);
							$('#myModalalarmas').modal('hide');
						}else{
							//swal("", "Configuración enviada con éxito!", "success");
							savehistorial("Alarmas","");
							$('#myModalalarmas').modal('hide');
						}


					}else{swal("Error", "Error al enviar el reporte!", "error");}
				}
			});
	}

	function savehistorial(tipo,obs){
		$.ajax({
				url: "save_historial_configuracion.php",
				type: 'post',
				data: {
				 Modificacion:	 tipo,
				 Firma:			$('#nombreusuario').val(),
				 Observaciones: 	obs,
				 user_id:		  user_id
				},
				success: function(msg)
				{
					if(msg == 0){
						$('#dataTables2').bootstrapTable('refresh');
						alert("Configuración guardada con éxito!");
					}else{swal("Error", "Error al guardar historial!", "error");}
				}
			});


	}



	//Edit
	var editvaluedetalle = Array();
	var editvaluenivel = Array();
	var editvaluenivelfis = Array();
	var editvaluenivelfispre = Array();
	var editvaluenivelfisalerta = Array();
	var editvaluefisc = Array();
	var editvaluenociva = Array();
	$('#tabladiatomeaseditdetalle, #tabladinoflageladoseditdetalle, #tablaoespecieseditdetalle').on('editable-save.bs.table', foodetalle);
	function foodetalle(field, row, Value, $el) {
		if(row == "Nivel_Critico"){
			//Check if integer
			if(Math.floor(Value[row]) == Value[row] && $.isNumeric(Value[row])){
				editvaluenivel.push({"Nivel_Critico": Value[row], "IDespecie": Value['IDespecie'] });
			}else{
				swal("", "Debe Ingresar un número entero", "error");
			}
  		}
		if(row == "Nivel_Fiscaliza"){
			//Check if integer
			if(Math.floor(Value[row]) == Value[row] && $.isNumeric(Value[row])){
				editvaluenivelfis.push({"Nivel_Fiscaliza": Value[row], "IDespecie": Value['IDespecie'] });
			}else{
				swal("", "Debe Ingresar un número entero", "error");

			}
  		}
		if(row == "Nivel_Fiscaliza_Pre"){
			//Check if integer
			if(Math.floor(Value[row]) == Value[row] && $.isNumeric(Value[row])){
				editvaluenivelfispre.push({"Nivel_Fiscaliza_Pre": Value[row], "IDespecie": Value['IDespecie'] });
			}else{
				swal("", "Debe Ingresar un número entero", "error");
			}
  		}
		if(row == "Nivel_Fiscaliza_Alerta"){
			//Check if integer
			if(Math.floor(Value[row]) == Value[row] && $.isNumeric(Value[row])){
				editvaluenivelfisalerta.push({"Nivel_Fiscaliza_Alerta": Value[row], "IDespecie": Value['IDespecie'] });
			}else{
				swal("", "Debe Ingresar un número entero", "error");
			}
  		}
		if(row == "Detalle"){
			editvaluedetalle.push({"Detalle": Value[row], "IDespecie": Value['IDespecie'] });
		}
		if(row == "Fiscaliza_edit"){
			editvaluefisc.push({"Fiscaliza": Value[row], "IDespecie": Value['IDespecie'] });
		}
		if(row == "Nociva"){
			editvaluenociva.push({"Nociva": Value[row], "IDespecie": Value['IDespecie'] });
		}
	}

	//If close modal until save data
	$('#closedetalleup, #closedetalle,#closepambup, #closepamb, #closeupalarmas,  #closealarmas, #closeupnotif,#closeupnotifusuario, #closenotificaciones,#closenotificacionesusuario,#closeupcentro, #closecentro').click(function(){
			//swal({
//				  title: "Salir sin guardar?",
//				  text: "¿Esta seguro que desea salir sin guardar las modificaciones?",
//				  type: "warning",
//				  showCancelButton: true,
//				  confirmButtonColor: "#DD6B55",
//				  confirmButtonText: "Salir sin guardar",
//				  cancelButtonText: "No",
//				  closeOnConfirm: true,
//				  closeOnCancel: true
//				},
//				function(isConfirm){
//				  if (isConfirm) {
					      $('#myModaldetalleespecie').modal('hide');
						  $('#myModalalarmas').modal('hide');
						  $('#myModalnotificaciones').modal('hide');
						  $('#myModalnotificaciones2').modal('hide');
						  $('#myModalcentro').modal('hide');
						  $('#myModalpamb').modal('hide');

			//  	  } else {}
//			});
	});

	$('#enviardetalle').click(function()
	{
		swal({
				  title: "Estas Seguro?",
				  text: "¿Esta seguro que desea guardar las modificaciones?",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Si, Modificar!",
				  cancelButtonText: "No, Cancelar!",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {
					$('#modalloading').modal({backdrop: 'static', keyboard: false});
					$.ajax({
					url: "save_edit_especie.php",
					type: 'post',
					data: {
						Edit_Detalle: 	  				editvaluedetalle,
						Edit_Nivel: 			  	  	  editvaluenivel,
						Edit_Nivel_Fiscaliza: 			editvaluenivelfis,
						Edit_Nivel_Fiscaliza_Pre: 		editvaluenivelfispre,
						Edit_Nivel_Fiscaliza_Alerta: 	 editvaluenivelfisalerta,
						Edit_Fiscaliza: 		  	  	  editvaluefisc,
						Edit_Nociva: 	   		 	 	 editvaluenociva
					},
					success: function(msg)
					{
						if(msg == 0){
							var obs = "";//prompt("Indique el motivo de la modificación", "");
							if (obs != null) {
								//swal("Modificado", "Configuración guardada con éxito!", "success");
								savehistorial("Detalle Especie",obs);
								//$('#myModaldetalleespecie').modal('hide');
							}else{
								//swal("Modificado", "Configuración guardada con éxito!", "success");
								savehistorial("Detalle Especie","");
								//$('#myModaldetalleespecie').modal('hide');
							}
							alert("Configuración guardada con éxito.")
						}else{
							swal("Error", "Error al guardar la configuración", "error");
						}

					}
				});
			  } else {
				swal("Cancelado", "", "error");
			  }
			});

	});




	$("table").on('click-cell.bs.table', function (field, value, row, $element) {
		if($element['Imagen'] != "" && value == 2){
			if($('#myModaldetalleespecie').hasClass('in')){
				$("#profileImageeditimg").attr("src",$element['Imagen']);
				document.getElementById("nombreespecieeditimg").value = $element['Nombre'];
				document.getElementById("idespecieeditimg").value = $element['IDespecie'];
				$('#myModalchangeimg').modal('show');
			}else{
				$("#detalleimagen").attr("src",$element['Imagen']);
				document.getElementById("nombreespecieimagen").value = $element['Nombre'];
				$('#descripcionespecieimagen').text($element['Detalle']);
				$('#myModaldetalleimagen').modal('show');
			}
		}
	});


	//Eliminar especie
	$('#deleteespecie').click(function(){
		var table = ""
		if(  $('#tabladiatomeaseditdetalle').bootstrapTable('getSelections')[0] && $('#tab1').hasClass("active") ){
			table = $('#tabladiatomeaseditdetalle');
		}else if(  $('#tabladinoflageladoseditdetalle').bootstrapTable('getSelections')[0] && $('#tab2').hasClass("active") ){
			table = $('#tabladinoflageladoseditdetalle');
		}else if(  $('#tablaoespecieseditdetalle').bootstrapTable('getSelections')[0] && $('#tab3').hasClass("active") ){
			table = $('#tablaoespecieseditdetalle');
		}

		if(table != ""){

      swal({
				  title: "Eliminar?",
				  text: "¿Esta seguro que desea eliminar la especie?",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Si, Eliminar",
				  cancelButtonText: "No, Cancelar",
				  closeOnConfirm: true,
				  closeOnCancel: true
				},
				function(isConfirm){
				  if (isConfirm) {

        			$.ajax({
        					url: "delete_especie.php",
        					type: 'post',
        					data: {
        						IDespecie: table.bootstrapTable('getSelections')[0].IDespecie,
        						user_id:   user_id
        					},
        					success: function(msg){
        						if(msg == 0){
        							//swal("", "Especie eliminada con éxito!", "success");
        							$('#tabladiatomeaseditdetalle').bootstrapTable('refresh');
        							$('#tabladinoflageladoseditdetalle').bootstrapTable('refresh');
        							$('#tablaoespecieseditdetalle').bootstrapTable('refresh');
        						}else{swal("Error", "Error al eliminar la especie", "error");}
        					}
        			});
          }
        });
		}else{
			swal("", "Debe seleccionar una especie", "warning");
		}
	});

	$('#imageUpload').change(function() {
		if($('#imageUpload').prop('files').length > 0 ){

			var name = $('#imageUpload')[0].files[0].name;
			var extension = name.split('.').pop();
			//if(extension == "jpg"){
				if($(this).get(0).files[0].size > 100000){
					swal("", "El archivo excede el tamaño máximo 100[kb]", "warning");
					$('#profileImage').attr('src', "GtrFan-MonitoreoAlgasNocivas_symbol.png" );
					document.getElementById("imageUpload").value = "";
				}else{

				};
			//}else{
			//	swal("", "La extensión de la imagen debe ser JPG", "warning");
			//	$('#myModalchangeimg').modal('hide');
			//}
		}
	});
	$('#imageUploadeditimg').change(function() {console.log();
		if($('#imageUploadeditimg').prop('files').length > 0 ){
			var name = $('#imageUploadeditimg')[0].files[0].name;
			var extension = name.split('.').pop();
			if(extension == "jpg"){
				if($(this).get(0).files[0].size > 500000){
					swal("", "El archivo excede el tamaño máximo 0.5[mb]", "warning");
					$('#myModalchangeimg').modal('hide');
				}else{

				};
			}else{
				swal("", "La extensión de la imagen debe ser JPG", "warning");
				$('#myModalchangeimg').modal('hide');
			}
		}
	});

	function saveimg(form_data){
		$.ajax({
				url: "save_imagen_especie.php",
				dataType: 'text',
				cache: false,
				contentType: false,
				processData: false,
				type: 'post',
				data: form_data,
				success: function(msg)
				{

					if(msg == 0){
						//swal("", "Modificación guardada con éxito!", "success");
					}else{swal("Error", "Error al guardar la imágen", "error");}

					$('#tabladiatomeaseditdetalle').bootstrapTable('refresh');
					$('#tabladinoflageladoseditdetalle').bootstrapTable('refresh');
					$('#tablaoespecieseditdetalle').bootstrapTable('refresh');

				}
			});
	}

	$('#guardaeditimg').click(function()
	{
		var form_data = new FormData();
		var file_name = $('#imageUploadeditimg').prop('files')[0];
		if(file_name){
			form_data.append('file', file_name);
			form_data.append('IDespecie', document.getElementById("idespecieeditimg").value);
			form_data.append('Imagen', document.getElementById("imageUploadeditimg").value);
			form_data.append('user_id', user_id);

			saveimg(form_data);
		}
		$('#myModalchangeimg').modal('hide');
	});

	$(function() {
		$( "#nombreespecie" ).autocomplete({
			source: function (request, response) {
						$.ajax({
							  type: "GET",
							  url:"search_especie.php",
							  data: {term:request.term,user_id: user_id, Grupo: $('#gruposelect option:selected').text() },
							  success: function(data) {
									response(data['response']);
								},
							  dataType: 'json'
						})
					},
			appendTo : '#myModaladdespecie',
			minLength: 0,
			change: function (event, ui) {
        	if (ui.item == null){
				$(this).val((ui.item ? ui.item.id : ""));

			}else{
				$.ajax({
					  type: 'post',
					  url:"imagen_especie.php",
					  dataType: 'json',
					  data: {Especie: ui.item.label },
					  success: function(data) {
							$('#profileImage').attr("src",data);

  					 },
					 error: function(msg){
						console.log(msg);
					 }

				})

			}
		}
		}).focus(function(){
			if (this.value == ""){
				$(this).autocomplete("search");
			}
		});
	});

	$('#gruposelect').change(function(){
		$('#nombreespecie').val("");
	});

	//$('#profileImage').attr("src","second.jpg");


	$('#guardarespecie').click(function()
	{
		if(document.getElementById("nombreespecie").value){
			//swal({
//					  title: "Agregar Especie?",
//					  text: "¿Esta seguro que desea agregar la especie "+document.getElementById("nombreespecie").value+"?",
//					  type: "warning",
//					  showCancelButton: true,
//					  confirmButtonColor: "#DD6B55",
//					  confirmButtonText: "Si, Agregar",
//					  cancelButtonText: "No, Cancelar",
//					  closeOnConfirm: true,
//					  closeOnCancel: true
//					},
//					function(isConfirm){
//					  if (isConfirm) {
						$('#modalloading').modal({backdrop: 'static', keyboard: false});
						$.ajax({
							url: "save_new_especie.php",
							type: 'post',
							data: {
								Nombre:	document.getElementById("nombreespecie").value,
								Grupo:	 document.getElementById("gruposelect").value,
								user_id:   user_id
							},
							success: function(msg)
							{
								msg = JSON.parse(msg);

								if(msg['Existe'] == 1){
									alert("La especie ya existe");
								} else if(msg['Error'] == 0){
									$('#tabladiatomeaseditdetalle').bootstrapTable('refresh');
									$('#tabladinoflageladoseditdetalle').bootstrapTable('refresh');
									$('#tablaoespecieseditdetalle').bootstrapTable('refresh');
									$('#myModaladdespecie').modal('hide');

								}else{
									swal("Error", "Error al agregar la nueva especie", "error");
								}

							}
						});
				  //} else {
//					swal("Cancelado", "", "error");
//				  }
//				});
		}else{swal("", "Debe ingresar el nombre de la especie", "warning");}

	});


	function formatterindex(value, row, index) {
        return (index + 1);
    }

    function formatterAcciones(value, row, index){
         return [
            '<a class="danger remove" id="trash_docu" onClick="eliminar_centrosproductivos('+row.id+')" href="javascript:void(0)" title="Remove">'+
            '<i class="glyphicon glyphicon-trash"></i>'+
            '</a>'
        ].join('');
    }

    function formatterFecha(value, row, index){
         return [value.slice(0,-9)].join('');
    }



	//Dinoflagrlados
	function runningFormatterreporte(value, row, index) {
		return (index + 1);
	}
	function runningFormatterfoto(value, row, index) {
		return '<img href="'+row['Imagen']+'" src="'+row['Imagen']+'" class="img-circle center-block" />';
	}
	function runningFormatterdiatorojo(value, row, index) {
		return '	<input id="diato0'+index+'" class="form-control"  type="number" min="0" placeholder="'+row['Alarma_Rojo']+'" name = "profundidad">';
	}
	function runningFormatterdiatoamarillo(value, row, index) {
		return '	<input id="diato1'+index+'" class="form-control" type="number" min="0" placeholder="'+row['Alarma_Amarillo']+'" name = "profundidad">';
	}

	//Dinoflagrlados
	function runningFormatterdinorojo(value, row, index) {
		return '	<input id="dino0'+index+'" class="form-control"  type="number" min="0" placeholder="'+row['Alarma_Rojo']+'" name = "profundidad">';
	}
	function runningFormatterdinoamarillo(value, row, index) {
		return '	<input id="dino1'+index+'" class="form-control" type="number" min="0" placeholder="'+row['Alarma_Amarillo']+'" name = "profundidad">';
	}

	//Otras especies
	function runningFormatteroesprojo(value, row, index) {
		return '	<input id="oesp0'+index+'" class="form-control"  type="number" min="0" placeholder="'+row['Alarma_Rojo']+'" name = "profundidad">';
	}
	function runningFormatteroespamarillo(value, row, index) {
		return '	<input id="oesp1'+index+'" class="form-control" type="number" min="0" placeholder="'+row['Alarma_Amarillo']+'" name = "profundidad">';
	}

	//Parámetros Ambientales
	function runningFormattermicionambientalesrojo(value, row, index) {
		return '	<input id="pamb0'+index+'" class="form-control"  type="number" step=".1" min="0" name = "pambientales" placeholder="'+row['Alarma_Rojo']+'">';
	}
	function runningFormattermicionambientalesamarillo(value, row, index) {
		return '	<input id="pamb1'+index+'" class="form-control"  type="number" step=".1" min="0"   name = "pambientales" placeholder="'+row['Alarma_Amarillo']+'">';
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


	$('#colaborativo').lc_switch();
	$('#operando').lc_switch();




	var marker;
	var map;
	var center;
	var zoom = 8;
	var xregion = {lat: -42.5, lng: -73.5};
	var xiregion = {lat: -45.5, lng: -74.0};
	var xiiregion = {lat: -52.6, lng: -72.3};
	var xivregion = {lat: -39.8, lng: -73.23};
	function initMap() {
		 map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 8,
		  center: xregion,
		  mapTypeId: 'terrain'
		});
		marker = new google.maps.Marker({
		  position: xregion,
		  draggable: true,
		  map: map
		});
		google.maps.event.addListener(marker, 'dragend', function(ev){
			$('#topcentro').val(marker.getPosition().lat().toFixed(4));
			$('#leftcentro').val(marker.getPosition().lng().toFixed(4));
		});
		map.setCenter(xregion);
      }

	function changemarker(top,left){
		var lat = parseFloat(top);
		var lng = parseFloat(left);
		var newLatLng = new google.maps.LatLng(lat, lng);
		marker.setPosition(newLatLng);
		map.setCenter(newLatLng);
		//map.setZoom(9);
	};

	function check_inside_barrio(){
		return google.maps.geometry.poly.containsLocation(marker.getPosition(), markers_barrio[0]['name']);
	}

	function changeregion(region){
		center = "";
		zoom = 8;
		if(region == "Región de los Lagos"){
			center = xregion;
		}else if(region == "Región de Aysén"){
			center = xiregion;
			zoom = 7;
		}else if(region == "Región de Magallanes"){
			center = xiiregion;
			zoom = 8;
		}else if(region == "Región de Los Ríos"){
			center = xivregion;
			zoom = 8;
		}
		map.setCenter(center);
		map.setZoom(zoom);

	}
	$("#myModalcentro").on("shown.bs.modal", function () {
		//map.setCenter(center);
		google.maps.event.trigger(map, "resize");
		changeregion("Región de los Lagos");
		//map.setCenter(center);

	});






</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpUhp-rPo8Zev2M_lT0vPHRQZ9rftJGJI&callback=initMap">
    </script>


@endsection