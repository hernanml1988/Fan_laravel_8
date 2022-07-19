@extends('layouts/master')
@section('title', '- Mapa Colaborativo')
<style>
    body { padding-right: 0 !important }
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
            top: 11%;
            right: 3%;
        }
    
    
    #legendholder_infowindow tbody > tr > td{
        padding:1px 1px 2px 1px !important;
        }
        #placeholder_infowindow div.xAxis div.tickLabel {
        transform: rotate(30deg) !important;
        margin-top:10px;
    }
    
    .gm-style .gm-style-iw-c {
            padding: 0px !important;
    }
    .gm-style-iw {
        top:0px !important;
    }
    
    #SearchParameters.in,
    #SearchParameters.collapsing {
        display: block!important;
    }
    #indicadores-btn.in,
    #indicadores-btn.collapsing {
        display: block!important;
    }
    
    .gm-style-iw {
        width: 610px !important;
    }
    @media (max-width: 992px) {
        .indicador{
            width:13px !important;
            height:13px !important;
        }
    
        #slidershow{
            margin-top: -8px !important;
        }
    }
    @media(max-width:767px){
        #menuplay{
            margin-top:11px !important;
            width: 105px !important;
            height: 25px !important;
            padding-top: 2px !important;
        }
        #g1play-pause, #g1speed, #g1repeat{
            padding: 4px !important;
            padding-left: 4px !important;
            width: 17px !important;
            height: 17px !important;
        }
    
    }
    
    @media print{
     .no-print, .no-print *
      {
          display: none !important;
      }
    
      #map {
       width: 100%;
       height: 1100px;
       background-color: grey;
     }
    }
</style>   

    


@section('content')

<script type="text/javascript">

</script>


	<div id="wrapper">

      

       	<div id="page-wrapper" style="margin-left:-24px; margin-right: 1px">



            		<!--<div class="row">
            			<div class="col-lg-12">
                            <h4 class="page-header">REGIÓN DE LOS LAGOS</h4>
                        </div>
                    </div>-->

            		<div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12" style="margin-left:10px; margin-right:10px;">
                          <button title="Imprimir" type="button" id="" style="float: right;margin-top: 15px;" onclick="window.print();" class="btn btn-danger btn-sm no-print center-block">  <i class="fa fa-print"></i> </button>
                        	<ul class="nav nav-pills " id="myTabmap" style="margin-top:10px;">
                                <li id="tabregion10" value="10"><a href="" data-toggle="tab" style="padding-bottom:3px; padding-top:3px;">X REGIÓN <div class="hidden-xs" style="display:inline">DE LOS LAGOS</div></a>
                                </li>
                                <li  class="" id="tabregion11" value="11"><a href="" data-toggle="tab" style="padding-bottom:3px; padding-top:3px;">XI REGIÓN <div class="hidden-xs" style="display:inline">DE AISÉN</div></a>
                                </li>
                                <li id="tabregion12" value="12"><a href="" data-toggle="tab" style="padding-bottom:3px; padding-top:3px;" >XII REGIÓN <div class="hidden-xs" style="display:inline">DE MAGALLANES</div></a>
                                </li>
                            </ul>
                            <div class="panel panel-black " style="margin-top:5px;">
                                <div class="panel-heading " style="background: rgba(0,55,79,1);
background: -moz-linear-gradient(top, rgba(0,55,79,1) 0%, rgba(3,83,119,1) 8%, rgba(3,83,119,1) 51%, rgba(3,83,119,1) 92%, rgba(0,48,69,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0,55,79,1)), color-stop(8%, rgba(3,83,119,1)), color-stop(51%, rgba(3,83,119,1)), color-stop(92%, rgba(3,83,119,1)), color-stop(100%, rgba(0,48,69,1)));
background: -webkit-linear-gradient(top, rgba(0,55,79,1) 0%, rgba(3,83,119,1) 8%, rgba(3,83,119,1) 51%, rgba(3,83,119,1) 92%, rgba(0,48,69,1) 100%);
background: -o-linear-gradient(top, rgba(0,55,79,1) 0%, rgba(3,83,119,1) 8%, rgba(3,83,119,1) 51%, rgba(3,83,119,1) 92%, rgba(0,48,69,1) 100%);
background: -ms-linear-gradient(top, rgba(0,55,79,1) 0%, rgba(3,83,119,1) 8%, rgba(3,83,119,1) 51%, rgba(3,83,119,1) 92%, rgba(0,48,69,1) 100%);
background: linear-gradient(to bottom, rgba(0,55,79,1) 0%, rgba(3,83,119,1) 8%, rgba(3,83,119,1) 51%, rgba(3,83,119,1) 92%, rgba(0,48,69,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00374f', endColorstr='#003045', GradientType=0 );">


                                    <div class="row" style="margin:10px 10px 0 10px;">
                                        <a class="btn btn-info visible-xs visible-sm" data-toggle="collapse" data-target="#SearchParameters" style="padding:1px 3px 1px 3px; right:21px; margin-top:-15px; position:absolute;"> <span class="caret"></span>  </a>

                                        <div id="slidershow" class="col-lg-9 col-md-9 col-xs-12 text-center" >

                                            <span class="" style=" font-weight:bold;">C U R S O R &emsp; F E C H A </span>
                                            <input style="width:100%" id="sidebarweek" type="text" data-slider-ticks="[6, 5, 4, 3, 2, 1, 0]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='[]' data-slider-step="1" data-slider-value="7" data-slider-tooltip="hide"/>
                                     	</div>
                                       <div class="col-lg-3 col-md-3 col-xs-12 center-block  SearchParameters" id="SearchParameters">
                                            <div class="visible-xs visible-sm" style="margin-top:12px"></div>
                                            <select id="opcionescentros" class="form-control center-block" style="max-width:200px; margin-top:-10px; height:27px; padding-bottom:3px; padding-top:3px; cursor:pointer"></select>
                                            <select id="nromedicionresumen" class="form-control center-block" style="max-width:200px; margin-top:5px; height:27px; padding-bottom:3px; padding-top:3px;cursor:pointer">
                                            </select>
                                            <select id="especiesselectmap" class="form-control center-block" style="max-width:200px; margin-top:5px; height:27px; padding-bottom:3px; padding-top:3px;cursor:pointer">
                                            </select>
                                            <div id="loading1" class="" style="display:inline; position:absolute; margin-top:-26px; width:75%"><img class="pull-right" style="width: 25px;" src='loader.gif' /></div>

                                        </div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-lg-9 col-md-9 col-xs-12 text-center" style="">
                                            <div id="menuplay" style="margin-left: auto;margin-right: auto;left: 0;right: 0;border: solid 1px #012636;border-top: none; position: absolute;padding-top: 3px; margin-top:14px;background-color: #003851;width: 130px;height: 33px;z-index: 1;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">

                                                <span title="Play | Pause" id="g1play-pause" class="fa fa-play" style=" cursor:pointer;color: #035377;background-color: #ffffff; border-radius: 50%;padding: 4px;padding-left:7px; width: 22px; height: 22px;"> </span>
                                                <span title="Velocidad Reproducción" id="g1speed" class="fa fa-forward" style=" margin-left:10px; cursor:pointer;color: #035377; background-color: #ffffff;border-radius: 50%; padding: 4px; padding-left:7px; width: 22px; height: 22px;"> </span>
                                                <span title="Sentido Repetición" id="g1repeat" class="fa fa-refresh" style=" margin-left:10px;  cursor:pointer;color: #035377; background-color: #ffffff;border-radius: 50%;padding: 4px; width: 22px; height: 22px;"> </span>
                                            </div>
                                        </div>
                                 	</div>

                                </div>
                                <div class="panel-body" style="padding:0px !important;">

                                    <div style="width:100%; position: relative;">
                                    	<div id="map"></div>
                                        <!--<img id="imgregion" src="img/region_10.png" style="cursor: default !important;">-->
                                        <div class="counter">
                                            <div id="showcentros" class="" >


                                            <!--Insertar Centros-->
                                            </div>
                                            <div id="showbarrio" class="" >


                                            <!--Insertar Centros-->
                                            </div>
                                        </div>
                                        <div class="ubicacion no-print" style="top:6%; right:2%">
                                            <div class="btn-group btn- ">
                                                <button type="button" class="btn btnbtn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                   <div class="visible-md-inline visible-lg-inline" style="display: inline">Seleccionar</div> Capas
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu" id="opciones" style="color:#000; padding-left:15px; padding-right:12px; width:255px">
                                                    <li class="divider" style="margin-top:0px;margin-bottom:5px;"></li>
                                                    <li class="text-center text-info ">
                                                        Mostrar | Ocultar
                                                    </li>
                                                    <li class="divider" style="margin-top:5px;"></li>
                                                    </li>
                                                    <li>
                                                    	<div class="btn-group btn-group-toggle " style="border: solid 1px;border-color:#adadad; border-radius: 8px; margin-top: 5px;" data-toggle="buttons">
                                                            <label title="Ver sólo mediciones Internas" class="btn" role="button" data-twbs-toggle-buttons-class-active="btn-info">
                                                              <input id="btn_int" type="radio" name="options_medicion" value="-1" required>Int
                                                            </label>
                                                            <label class="btn active" role="button" data-twbs-toggle-buttons-class-active="btn-retirada" data-twbs-toggle-buttons-class-inactive="btn-error">
                                                              <input id="btn_todo" type="radio" name="options_medicion" value="0"  checked="checked">Todo
                                                            </label>
                                                            <label title="Ver sólo mediciones Externas" class="btn " role="button">
                                                              <input id="btn_ext" type="radio" name="options_medicion" value="1">Ext
                                                            </label>
                                                          </div>
                                                          <!--<input class="form-control checkbox center-block" type="checkbox" id="internaswitch">--><label style="margin-left:10px; font-weight:normal !important">Medición </label>
                                                    </li>
                                                    <!--<li><input class=" form-control checkbox center-block" type="checkbox" id="externaswitch"><label style="margin-left:10px; font-weight:normal !important" >Mediciones Externas</label>
                                                    </li>-->
                                                    <li>
                                                        <div class="btn-group btn-group-toggle " style="border: solid 1px;border-color:#adadad;border-radius: 8px; margin-top: 5px;" data-toggle="buttons">
                                                            <label class="btn" role="button" data-twbs-toggle-buttons-class-active="btn-danger">
                                                              <input id="btn_acs_no" type="radio" name="options_acs" value="-1" >No
                                                            </label>
                                                            <label class="btn active" role="button" data-twbs-toggle-buttons-class-active="btn-retirada" data-twbs-toggle-buttons-class-inactive="btn-error">
                                                              <input id="btn_acs_auto" type="radio" name="options_acs" value="0"  checked="checked">Auto
                                                            </label>
                                                            <label class="btn " role="button">
                                                              <input id="btn_acs_si" type="radio" name="options_acs" value="1">Si&nbsp&nbsp
                                                            </label>
                                                          </div>
                                                    <!--<input class="form-control checkbox center-block" type="checkbox" id="acsswitch">--><label style="margin-left:10px; font-weight:normal !important"><div class="hidden-xs" style="display:inline">Mostrar</div> ACS</label>
                                                    </li>
                                                    <li>
                                                    	<div class="btn-group btn-group-toggle " style="border: solid 1px;border-color:#adadad; border-radius: 8px; margin-top: 5px;" data-toggle="buttons">
                                                            <label class="btn" role="button" data-twbs-toggle-buttons-class-active="btn-danger">
                                                              <input id="btn_centros_no" type="radio" name="options_centros" value="-1" required>No
                                                            </label>
                                                            <label class="btn active" role="button" data-twbs-toggle-buttons-class-active="btn-retirada" data-twbs-toggle-buttons-class-inactive="btn-error">
                                                              <input id="btn_centros_auto" type="radio" name="options_centros" value="0"  checked="checked">Auto
                                                            </label>
                                                            <label class="btn " role="button">
                                                              <input id="btn_centros_si" type="radio" name="options_centros" value="1">Si&nbsp&nbsp
                                                            </label>
                                                          </div>
                                                    <!--<input class="form-control checkbox center-block" type="checkbox" id="centrosswitch">--><label style="margin-left:10px; font-weight:normal !important"><div class="hidden-xs" style="display:inline">Mostrar</div> Centros</label>
                                                    </li>

                                                     <li>
                                                     	<div class="btn-group btn-group-toggle " style="border: solid 1px;border-color:#adadad; border-radius: 8px; margin-top: 5px;" data-toggle="buttons">
                                                            <label class="btn" role="button" data-twbs-toggle-buttons-class-active="btn-danger">
                                                              <input id="btn_nombre_no" type="radio" name="options_nombre" value="-1" required>No
                                                            </label>
                                                            <label class="btn active" role="button" data-twbs-toggle-buttons-class-active="btn-retirada" data-twbs-toggle-buttons-class-inactive="btn-error">
                                                              <input id="btn_nombre_auto" type="radio" name="options_nombre" value="0"  checked="checked">Auto
                                                            </label>
                                                            <label class="btn " role="button">
                                                              <input id="btn_nombre_si" type="radio" name="options_nombre" value="1">Si&nbsp&nbsp
                                                            </label>
                                                          </div>
                                                          <!--<input class="form-control checkbox center-block"  type="checkbox" id="nombreswitch">--><label style="margin-left:10px; font-weight:normal !important"><div class="hidden-xs" style="display:inline">Nombre</div> Centros</label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                            <div class="ubicacion ubicacion2" >
                                            	<a class="" data-toggle="collapse" data-target="#indicadores-btn" style="cursor:pointer">
                                                <div class="col-lg-3 col-md-3 col-xs-3 center-block" style="padding-left:3px" id="">
                                                    <div title="Nivel Crítico" class=" indicador indicadoractivorojo ubicacion" style="animation:none !important; margin-right:20px;"></div>
                                                    <br/>
                                                    <div class=" indicador indicadoractivoamarillo ubicacion" style="animation:none !important;"></div>
                                                    <br/>
                                                    <div class=" indicador indicadoractivogris ubicacion"></div>
                                                    <br/>
                                                    <div class=" indicador indicadoractivoverde ubicacion"></div>
                                                    <br/>
                                                </div>
                                                </a>
                                                <div class="col-lg-9 col-md-9 col-xs-9 center-block  indicadores-btn" style="padding-left:2px; padding-right:5px;" id="indicadores-btn">
                                                    <b style="margin-right: 5px;"> Crítico </b>
                                                    <br/>

                                                    <b style=""> Precaución </b>
                                                    <br/>

                                                    <b style=""> Presencia </b>
                                                    <br/>

                                                    <b style=""> Ausencia </b>
                                                    <br/>

                                                </div>
                                            </div>


                                    </div>
                                    <div class="panel panel-default hidden " style="margin-left:13px;margin-right:13px; margin-top:15px;">
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
                                            <div class="panel-body hidden">

                                                    <div class="col-lg-6 col-md-12 col-xs-12 ">
                                                        <!--<div class="row">
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel">Últimos Días</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-4 col-md-7 col-xs-7" >
                                                                <input id="dias" class="form-control" type="number" value="7" min="7" max="7" width="130px"/>
                                                           </div>
                                                        </div>-->
                                                        <div class="row hidden">
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
                                                <div id="resumenreporteload" class="dataTable_wrapper hidden" style="padding:15px; max-height:500px; overflow:auto;" >

                                                    <table cellSpacing="0" data-toggle="table" data-show-columns="false"  data-search="true" data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer hidden" data-sort-name="Centro" id="resumenreporte" >
                                                        <thead>
                                                            <tr>

                                                                <th data-field="Centro" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false" data-width = "35px">Centro</th>
                                                                <th data-formatter="runningFormatterarea" data-align= "center" data-valign = "middle" data-switchable="false" data-width = "35px">#</th>
                                                                <th data-field="Especie" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false">Especie</th>
                                                                <th data-field="Grupo"  data-align= "center" data-valign = "middle" data-width = "40px" data-visible="false">Grupo</th>
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
                                                            <p class="arealabel">Medición</p>
                                                        </div>
                                                        <div class="col-lg-1 col-md-1 col-xs-1">
                                                            <p class="arealabel">:</p>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-xs-7" >
                                                            <select id="medicionintext" class="form-control">
                                                                <option value="2">Interna y Externa</option>
                                                                <option value="0">Interna </option>
                                                                <option value="1">Externa </option>
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
                                <div class="row" style="">
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
                                        <p class="arealabel"> Medición </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1">
                                      <p class="arealabel">  : </p>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-xs-8">
                                        <output id="medicionverreporte" name="outputver"></output>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                	 <img src='loader.gif'/><h5> Loading... Please Wait </h5>
                                </div>
                             </div>
                        </div>
                    </div>




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

    

	 <!-- Alertas -->
    <script src="{{asset('js/sweetalert.min.js')}}"></script>

    <!-- Export table -->
    <script src="{{asset('js/tableExport.js')}}"></script>
    <script src="{{asset('js/bootstrap-table-export.js')}}"></script>

    <!-- Multiple Select -->
  	<script type="text/javascript" src="{{asset('js/bootstrap-multiselect.js')}}"></script>

    <!-- Switch button -->
  	<!--<script type="text/javascript" src="js/lc_switch.js"></script>-->

    <script src="{{asset('js/jquery.twbs-toggle-buttons.min.js')}}"></script>


    <script>

		var user_id = {!!$currentUser->id!!} //<?php echo $currentUser->id; ?>;  
		var id_empresa = {!!$currentUser->IDempresa!!}//<?php echo $currentUser->IDempresa; ?>;
		var user_role_fan = {!!$currentUser->user_role_fan!!}
		var role = <?php echo '"'.$currentUser->role.'"';?>;
	


	$(".btn-group-toggle").twbsToggleButtons();

	//Grafico infowindows

	var dato_infowindow = [];
	function loaddatagrafico_infowindow(idcentro_info,idmed_info,fecha_info){
		//$('#modalloading').modal({backdrop: 'static', keyboard: false});
		var int = $("#btn_int").is(':checked') ? 1:0;
		var ext = $("#btn_ext").is(':checked') ? 1:0;
		if(int == 0 && ext == 0){
			int = 1;
			ext = 1;
		}
		$.ajax({
			url: "load_historial_centros_pdf_colab.php",
			type: 'post',
			dataType: 'json',
			data: {
				IDcentro:		 parseInt(idcentro_info),
				Interna:		  int,	 //$('#internaswitch').is(':checked') ? 1 : 0,
				Externa:		  ext,	//$('#externaswitch').is(':checked') ? 1 : 0,
				IDmed: 	   		idmed_info,
				Fecha: 	   		fecha_info,
				Especies: 		 document.getElementById("especiesselectmap").value,
				Medicion:      	 parseInt(document.getElementById("nromedicionresumen").value),
				user_id: 		  user_id,
			},
			success: function(datoshist)
			{
				$('#modalloading').modal('hide');
				dato_infowindow = [];
				document.getElementById("loader_infowindow").style.display = "none";
				var nroprof = parseInt(document.getElementById("nromedicionresumen").value);
				var varprof = "(Máx. concentración)";
				if(nroprof == 1){
					varprof = "(Profundidad 0.5 [m])";
				}else if(nroprof == 2){
					varprof = "(Profundidad 5 [m])";
				}else if(nroprof == 3){
					varprof = "(Profundidad 10 [m])";
				}else if(nroprof == 4){
					varprof = "(Profundidad 15 [m])";
				}else if(nroprof == 5){
					varprof = "(Profundidad 20 [m])";
				}else if(nroprof == 6){
					varprof = "(Profundidad 25 [m])";
				}else if(nroprof == 7){
					varprof = "(Profundidad 30 [m])";
				}
				document.getElementById("varprof").value = varprof;
				if(datoshist['Error'] == 0){
					dato_infowindow = datoshist;
					graficar_infowindow();
				}else if(datoshist['Error'] == 1){
					$('#ausencia_info').removeClass('hidden');
				}else if(datoshist['Error'] == 11){
					$('#ausencia_prof_info').removeClass('hidden');
				}else {swal("Error", "Error al traer los datos.", "error");}
			},
			error: function(result) {
				//console.log(result);
			}
		});

	}

	var data_grafico_infowindow = Array();
	function graficar_infowindow(){
		data_grafico_infowindow = [];
		$('#placeholder_infowindow').empty();
		$('#legendholder_infowindow').empty();
		var medicion = "todo";
		var todo = 1;
		var prof = "";
		var nivel = "";
		var axislabel = "[cel/ml]";
		var maxy = null;
		var norm = "";
		if(dato_infowindow['Nombre']){
				if(dato_infowindow['Nombre'].length != 1 && dato_infowindow['Critico'] == 1){norm = "norm"; axislabel = "Nivel Nocivo [%]"}
				for(var i= 0; i<dato_infowindow['Nombre'].length; i++){
					var dato_aux = [];
					for(var s = 0; s<dato_infowindow['Semana'].length; s++){
						entro = -1;
						for(var d= 0; d<dato_infowindow[dato_infowindow['Nombre'][i].concat(norm)].length; d++){
							if(dato_infowindow[dato_infowindow['Nombre'][i].concat(norm)][d][8] == dato_infowindow['Semana'][s]){
								entro = d;
								break;
							}
						}
						if(entro == -1){
							dato_aux.push(null);
						}else{
							dato_aux.push( dato_infowindow[dato_infowindow['Nombre'][i].concat(norm)][entro] );
						}


					}

					data_grafico_infowindow.push({label: dato_infowindow['Nombre'][i], data: dato_aux,lines: {show: true},points: {show: true} });
				}
		}

		//var i = 3;
		$.each(data_grafico_infowindow, function(key, val) {
			var indexcolor = listaespecies.indexOf(val.label)+3;
			if(indexcolor>=12){indexcolor = indexcolor+1;}
			val.color = indexcolor;// i;
			//++i;
		});
		if(dato_infowindow['Nombre']){
			if(dato_infowindow['Nombre'].length == 1 && dato_infowindow['Critico'] != 0){
				maxy = parseInt(dato_infowindow['Max'])*1.1;
				if(dato_infowindow['Max'] < parseInt(dato_infowindow['Rojo'])){ maxy = parseInt(dato_infowindow['Rojo'])*1.1;}
				data_grafico_infowindow.push({label:"Alarma Crítico", data:[[dato_infowindow['F_Min'],dato_infowindow['Rojo'],maxy],[dato_infowindow['F_Max'],dato_infowindow['Rojo'],maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });

				//Nivel Alarma Amarillo
				//data_grafico.push({label:"Alarma Precaución", data:[[dato_infowindow['F_Min'],dato_infowindow['Amarillo'],dato_infowindow['Rojo']],[dato_infowindow['F_Max'],dato_infowindow['Amarillo'],dato_infowindow['Rojo']]],color: "yellow", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });



			}else if(dato_infowindow['Critico'] == 1){

				maxy = parseInt(dato_infowindow['Max_norm'])*1.1;
				if(parseInt(dato_infowindow['Max_norm']) < 100){ maxy = 100*1.1;}

				data_grafico_infowindow.push({label:"Nivel Nocivo", data:[[dato_infowindow['F_Min'],100,maxy],[dato_infowindow['F_Max'],100,maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }} });


			}
		}

		function plotAccordingToChoices_infowindow() {
			if (data_grafico_infowindow.length > 0) {
				plot = $.plot("#placeholder_infowindow", data_grafico_infowindow, {
					axisLabels: {
						show: true
					},
					xaxis:  {
						//axisLabel: 'Fecha Registro',
						mode: "time",
						timeformat : "%d-%m",  // %H:%M:%S
						timezone: "browser",
						zoomRange: [dato_infowindow['F_Min'], dato_infowindow['F_Max']],
						panRange: [dato_infowindow['F_Min'], dato_infowindow['F_Max']],
						min: dato_infowindow['F_Min'],
						max: dato_infowindow['F_Max'],

						},

					grid: {
						hoverable: true,
						clickable: true
					},
					legend: {position: "nw", container: $('#legendholder_infowindow') },
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

				$("#placeholder_infowindow").bind("plotselected", function (event, ranges) {
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


		}

		plotAccordingToChoices_infowindow();

		$("<div id='tooltip_infowindow'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			"z-index": 100000,
			padding: "2px",
			"background-color": "#fee",
			opacity: 0.80
		}).appendTo("body");

		$("#placeholder_infowindow").unbind('plothover').bind("plothover", function (event, pos, item,a,b,c,d) {

				if (item && item.series.label != "Nivel Nocivo") {
					var x = item.series.data[item.dataIndex][4];
						y = item.series.data[item.dataIndex][5]; if(y == null){y = "-";}
						f = item.series.data[item.dataIndex][6];

					$("#tooltip_infowindow").html(item.series.label + " <br> <b> Fecha Muestra: </b>" + f + " <br><b>Encontradas: </b>" + x + " [cel/ml] <br> <b>Nivel Nocivo: </b>" + y + " [cel/ml] ")
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);

					document.body.style.cursor = 'pointer';
				} else {
					$("#tooltip_infowindow").hide();
					document.body.style.cursor = 'default';
				}

		});

		/*$("#placeholder_infowindow").unbind('plotclick').bind("plotclick", function (event, pos, item) {

			if (item && item.series.label != "Nivel Nocivo") {

				tablasverreporte(item.series.data[item.dataIndex][7]);
				nromedicion = item.series.data[item.dataIndex][7];
				fechamedicion = item.series.data[item.dataIndex][7];

				$('#myModalverreporte').modal('show');
			}
		});*/

	}




	//////////////////
	////// MAPS //////
	//////////////////

	//var marker;
	var map;
	var center;
	var zoom = 7;
	var zoomnombre = 11;
	var zoomcentros = 10;
	var zoombarrio = 10;
	var mhlevel = {lat: -44.6, lng: -74.38};
	var xregion = {lat: -42.13, lng: -73.5};
	var xiregion = {lat: -44.98, lng: -74.0};
	var xiiregion = {lat: -52.5, lng: -71.0};
	//var acsLayer = "";
	var infowindow = "";
	var polygoninfoWindow = "";
	var colorlabelmarker = 'white';
	var sinmarker = "sin-white.png";
	var idcentro_openinfo = "";
	var muestrainfo_openinfo = "";
	function initMap() {
		 map = new google.maps.Map(document.getElementById('map'), {
		  zoom: 7,
		  center: mhlevel,
		  mapTypeId: 'satellite'
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

			if (zoomLevel >= zoomnombre && $("#btn_nombre_auto").is(':checked') ) {
				nombreMarkers("Mostrar");
			} else if (zoomLevel < zoomnombre && $("#btn_nombre_no").is(':checked') ) {
				nombreMarkers("Ocultar");
			}

			if($("#btn_centros_auto").is(':checked')){
				if(zoomLevel >= zoomcentros){
					showMarkers();
					//$('#centrosswitch').lcs_on();
				} else if (zoomLevel < zoombarrio) {
					hideMarkers();
					//$('#centrosswitch').lcs_off();
				}
			}

			if( $("#btn_acs_auto").is(':checked')){
				if(zoomLevel >= zoombarrio){
					hideMarkersbarrio();
					//$('#acsswitch').lcs_off();
				} else if (zoomLevel < zoombarrio) {
					showMarkersbarrio();
					//$('#acsswitch').lcs_on();
				}
			}


		});

		//var srcacs = 'http://fan.gtrgestion.cl/acs3.kml';
		//var srccap = 'http://fan.gtrgestion.cl/cap.kmz';
		//var srcmacro = 'http://fan.gtrgestion.cl/macro2.kml';
		/*acsLayer = new google.maps.KmlLayer(srcacs, {
		  suppressInfoWindows: true,
		  preserveViewport: true,
		  clickable: false
		});*/


		contentString = '<div id="content" style="overflow:hidden;">'+
							'<div id="infonombrecentro" class="text-center text-uppercase" style = "font-size: 15px;font-weight: 500;padding: 7px;background-color: #48b5e9;color: white;border-radius: 2px 2px 0 0;"></div>'+

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
							  '<output id="infoidcentro-hidden" style="display:none !important"></output></td>'+
							  '<output id="infoidmed-hidden" style="display:none !important"></output></td>'+
							  '<div class="carousel-inner" style="width:103%">'+
								'<div id="carusel-info" class="item ">'+
								  	'<table class="table table-condensed" style="width:400px;height:235px;margin-top:20px; margin-bottom:5px;font-size:13px;margin-left:65px;margin-right: 35px; ">'+

									  '<tr>'+
										'<td valign="top" style="border-top: none; width:90px"><b> Muestra</b></td>'+
										'<td valign="top" style="border-top: none;">&nbsp;</td>'+
										'<td valign="top" style="border-top: none;"><b> : </b></td>'+
										'<td valign="top" style="border-top: none;">&nbsp;</td>'+
										'<td style="border-top: none;"><output id="muestrainfo" style="display:inline;font-size:13px;"></output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Especie</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="espinfo" style="display:inline;font-size:13px;"></output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Nociva </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="nocivainfo" style="display:inline;font-size:13px;"></output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Encontradas</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="encontradasinfo" style="display:inline;font-size:13px;"></output> </td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top"><b> Nivel Nocivo</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="nivelnocivoinfo" style="display:inline;font-size:13px;"></output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" style="padding-right: 0px !important;";><b> Alarma Crítico</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="alarmarojoinfo" style="display:inline;font-size:13px;"></output></td>'+
									  '</tr>'+
									  '<tr>'+
										'<td valign="top" ><b> Alarma Prec.</b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td valign="top"><b> : </b></td>'+
										'<td valign="top">&nbsp;</td>'+
										'<td><output id="alarmaamarilloinfo" style="display:inline;font-size:13px;"></output></td>'+
									  '</tr>'+

								'</table>'+
								'</div>'+

								'<div id="carusel-grafico" class="item active">'+
									'<div id="content ">'+

										 '<div class="demo-container" style="width:500px; height:240px; padding-right:35px;">'+
										 	'<div class="text-center" style="font-size:12px; margin-top:20px; margin-bottom:10px; margin-right:5px;"><b>Tendencia Especies </b> <output id="varprof" style="display:inline" >(Máx. concentración)</output></div>'+
											'<img id="loader_infowindow" class="" src="loader.gif" style="margin-left:233px;margin-right: auto;display: block;margin-bottom: -81px;margin-top: 60px;"/>'+
											'<div id="ausencia_info" class="text-center" class="hidden" style="font-size:12px; margin-top:83px; margin-bottom:-68px; margin-right:-34px;">Ausencia de Microalgas</div>'+
											'<div id="ausencia_prof_info" class="text-center" class="hidden" style="font-size:12px; margin-top:83px; margin-bottom:-68px; margin-right:-34px;">Sin Medición a esa Profundidad</div>'+
											'<div id="sinregistro_info" class="text-center" class="hidden" style="font-size:12px; margin-top:83px; margin-bottom:-68px; margin-right:-34px;">Sin Registro Diario</div>'+
											'<div id="placeholder_infowindow" class="demo-placeholder" style="display:inherit; float:left; width:80%; height:190px;"></div>'+
											'<div style="float:right; width:28%; font-size:13px;max-height:190px; overflow-y:auto; margin-right:-38px;" id="legendholder_infowindow"></div>'+

										'</div>'+

									'</div>'+

								'</div>'+

								//'<div class="item">'+
								  //'<img src="ny.jpg" alt="New York">'+
								//'</div>'+
							  '</div>'+

							  //<!-- Left and right controls -->
							  '<a class="left carousel-control" style="width:12% !important; margin:30px 0 30px -60px;background: none; " href="#myCarousel" data-slide="prev">'+
								'<span class="glyphicon glyphicon-chevron-left" style="color:gray;font-size:20px;"></span>'+
								'<span class="sr-only">Previous</span>'+
							  '</a>'+
							 ' <a id="rightcarousel" class="right carousel-control" style=" width:12% !important; margin:30px -60px 30px 0;background: none; "  href="#myCarousel" data-slide="next">'+
								'<span class="glyphicon glyphicon-chevron-right" style="color:gray;font-size:20px;"></span>'+
								'<span class="sr-only">Next</span>'+
							  '</a>'+
							'</div>'+








     		      			'</div>'+
                           '</div>'+
                      	'</div>';

		infowindow = new google.maps.InfoWindow({
													  content: contentString,
													  width:679,
													  height:130,
													  maxwidth:1300,
													  pixelOffset: new google.maps.Size(-3,0)
												   });




		map.setCenter(mhlevel);

		google.maps.event.addDomListener(window, 'resize', function() {
          infowindow.open(map);
        });


		google.maps.event.addListener(infowindow, 'domready', function() {
		   var iwOuter = $('.gm-style-iw');
		   var iwBackground = iwOuter.prev();
		   iwBackground.children(':nth-child(2)').css({'display' : 'none'});
		   iwBackground.children(':nth-child(4)').css({'display' : 'none'});

		  // iwOuter.parent().parent().css({left: '115px'});
//
//		   // Moves the shadow of the arrow 76px to the left margin.
//			iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});
//
//			// Moves the arrow 76px to the left margin.
//			iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

		//	iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

			var iwCloseBtn = iwOuter.next();
			iwCloseBtn.css({'display': 'none'});



			$('#placeholder_infowindow').empty();
			$('#legendholder_infowindow').empty();


            if(id_empresa == 4){


                if($('#encontradasinfo').text() != "-"){
                        $("#carusel-info").removeClass("active");
                        $("#carusel-grafico").removeClass("active");
                        $("#carusel-info").addClass("active");
                        $('#ausencia_info').addClass('hidden');
                        $('#ausencia_prof_info').addClass('hidden');
                        $('#sinregistro_info').addClass('hidden');
                        document.getElementById("loader_infowindow").style.display = "block";
                        loaddatagrafico_infowindow($('#infoidcentro-hidden').text(),$('#infoidmed-hidden').text(),$('#muestrainfo').text());
                }else{
                    $("#carusel-info").removeClass("active");
                    $("#carusel-grafico").removeClass("active");
                    $("#carusel-info").addClass("active");
                    $('#ausencia_info').addClass('hidden');
                    $('#ausencia_prof_info').addClass('hidden');
                    $('#sinregistro_info').removeClass('hidden');
                    document.getElementById("loader_infowindow").style.display = "none";

                    }

            }else{
                if($('#encontradasinfo').text() != "-"){
                        $("#carusel-info").removeClass("active");
                        $("#carusel-grafico").addClass("active");
                        $('#ausencia_info').addClass('hidden');
                        $('#ausencia_prof_info').addClass('hidden');
                        $('#sinregistro_info').addClass('hidden');
                        document.getElementById("loader_infowindow").style.display = "block";
                        loaddatagrafico_infowindow($('#infoidcentro-hidden').text(),$('#infoidmed-hidden').text(),$('#muestrainfo').text());
                }else{

                    $("#carusel-grafico").removeClass("active");
                    $("#carusel-info").addClass("active");
                    $('#ausencia_info').addClass('hidden');
                    $('#ausencia_prof_info').addClass('hidden');
                    $('#sinregistro_info').removeClass('hidden');
                    document.getElementById("loader_infowindow").style.display = "none";

                    }
            }






		});

      }



	$("#myModalcentro").on("shown.bs.modal", function () {

		google.maps.event.trigger(map, "resize");
		map.setCenter(center);

	});



	$( 'input[name=options_medicion]' ).change(function(){
		loadcentros();
	});
	$( 'input[name=options_nombre]' ).change(function(){
		nombreMarkers("");
	});
	$( 'input[name=options_acs]' ).change(function(){
		if(  $("#btn_acs_si").is(':checked') ){
			showMarkersbarrio();
		 }else if($("#btn_acs_no").is(':checked')) {
			 hideMarkersbarrio();
		 }
	});
	$( 'input[name=options_centros]' ).change(function(){
		if( $("#btn_centros_si").is(':checked') ){
			showMarkers();
		 }else if($("#btn_centros_no").is(':checked')) {
			 hideMarkers();
		 }
	});

	var listenerHandle = [];
	function asdfa(position,nombrecentro,idcentro,classindicador,muestrainfo,idmedinfo,espinfo,nocivainfo,encontradasinfo,nivelnocivoinfo,alarmarojoinfo,alarmaamarilloinfo){

		// ver si se modifico, entonces ahi si cambia
		//console.log("idcentro: "+idcentro+" | indicadorupdate[idcentro]: "+indicadorupdate[idcentro]+ " | classindicador: "+classindicador);
		if(indicadorupdate[idcentro] != classindicador){
				if(indicadorupdate[idcentro] != -1){eliminarArreglo(idcentro);}

				indicadorupdate[idcentro] = classindicador;

				//map.getZoom() <= 10
				var nombrecentrotitle = nombrecentro;
				var visible = true;
				var zoomL = map.getZoom();
				if( $("#btn_nombre_no").is(':checked') || ( $("#btn_nombre_auto").is(':checked') && zoomL < zoomnombre ) ){
          nombrecentro = ' ';
        }else{
          if($.isNumeric(nombrecentro) && id_empresa == 6){
            nombrecentro = ' ';
          }
        }
				if( $("#btn_centros_no").is(':checked') || ( $("#btn_centros_auto").is(':checked') && zoomL < zoomcentros )){visible = false;}

				 var  mi_marker = new google.maps.Marker({
					  position: position,
					  map: map,
					  label: {
						color: colorlabelmarker,
						fontWeight: 'bold',
						text: nombrecentro
					  },
					  title: nombrecentrotitle,
					  id:idcentro,
					  icon: {
						url: classindicador,
						size: new google.maps.Size(20, 20),
						anchor: new google.maps.Point(8,8),
						labelOrigin: new google.maps.Point(10,23),
					  },
					  visible: visible,
				  })

				 /*mi_marker.metadata = {name: mi_marker,  index:  idcentro};
				 markers[idcentro] = mi_marker;*/

				// markers[idcentro]={name: mi_marker,  index:  idcentro};

				 markers.push({name: mi_marker,  index:  idcentro});


				 //google.maps.event.addListener(mi_marker,"click",function(){opencentro(this.id);});

				 //remove magin infowindow



				 //Ver Info Windows
				  listenerHandle[parseInt(idcentro)] = google.maps.event.addListener(mi_marker, "click", function(){
				  /*google.maps.event.addListener(mi_marker, 'mouseover', function(){

					 mouseoverTimeoutId = setTimeout(function() {*/

						var medint = "";
						var medext = "";
						$("#btn_int").is(':checked') ? medint = "Interna" : "";
						$("#btn_ext").is(':checked') ? medext = "Externa" : "";

						var medintext = "";
						if(medint == "" && medext != ""){
							medintext = medext;
						}else if(medint != "" && medext == ""){
							medintext = medint;
						}

						infowindow.open(map,mi_marker);
						$('#infonombrecentro').html(
						'<div class="pull-left" title="Medición '+medintext+'" style="margin-left: 10px;margin-top: 2px;text-transform: capitalize;font-size: 12px;color: #8b0000;">'+medintext+'</div> ACS: '+
						datos['Barrio'][datos['IDcentro'].indexOf(idcentro)]+' &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; '+
						datos['Nombre'][datos['IDcentro'].indexOf(idcentro)]+
						'<button id="abrirmodalreporte" title="Ver detalles" onclick="opencentro('+this.id+')" type="submit" class="btn btn-retirada pull-right hidden" style="padding: 2px 7px 2px 7px;margin-right: 5px;margin-top: -2px;"><i class="fa fa-bar-chart-o"> </i></button>');
						$('#infoidcentro-hidden').text(idcentro);
						$('#infoidmed-hidden').text(idmedinfo);
						 if(muestrainfo == "Sin Registro"){
							 $('#muestrainfo').text(muestrainfo);
						 }else{$('#muestrainfo').text(muestrainfo.slice(0, muestrainfo.length -3));}
						 $('#espinfo').text(espinfo);
						 $('#nocivainfo').text(nocivainfo);
						 $('#encontradasinfo').text(encontradasinfo);
						 $('#nivelnocivoinfo').text(nivelnocivoinfo);
						 $('#alarmarojoinfo').text(alarmarojoinfo);
						 $('#alarmaamarilloinfo').text(alarmaamarilloinfo);
						 infowindow.open(map,mi_marker);


				//	  }, 400);


				 });
				/* google.maps.event.addListener(mi_marker,'mouseout', function(){
					if(mouseoverTimeoutId){
						clearTimeout(mouseoverTimeoutId);
						mouseoverTimeoutId = null;
					}

				});*/

				google.maps.event.addListener(map, "click", function(event) {
					infowindow.close(map);

				});
		}else{
			//Update
			//google.maps.event.removeListener(listenerHandle[parseInt(idcentro)]);
			var marker_aux = "";
			 $.each(markers, function (i, value) {
				if (value.index == idcentro){
					marker_aux = value.name;
					return false;
				}
			});
			//Ver Info Windows
				 listenerHandle[parseInt(idcentro)] = google.maps.event.addListener(marker_aux, "click", function(){
				  /*google.maps.event.addListener(mi_marker, 'mouseover', function(){

					 mouseoverTimeoutId = setTimeout(function() {*/

						var medint = "";
						var medext = "";
						$("#btn_int").is(':checked') ? medint = "Interna" : "";
						$("#btn_ext").is(':checked') ? medext = "Externa" : "";

						var medintext = "";
						if(medint == "" && medext != ""){
							medintext = medext;
						}else if(medint != "" && medext == ""){
							medintext = medint;
						}

						infowindow.open(map,mi_marker);
						$('#infonombrecentro').html(
						'<div class="pull-left" title="Medición '+medintext+'" style="margin-left: 10px;margin-top: 2px;text-transform: capitalize;font-size: 12px;color: #8b0000;">'+medintext+'</div> '+
						datos['Barrio'][datos['IDcentro'].indexOf(idcentro)]+' &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; '+
						datos['Nombre'][datos['IDcentro'].indexOf(idcentro)]+
						'<button id="abrirmodalreporte" title="Ver detalles" onclick="opencentro('+this.id+')" type="submit" class="btn btn-retirada pull-right hidden" style="padding: 2px 7px 2px 7px;margin-right: 5px;margin-top: -2px;"><i class="fa fa-bar-chart-o"> </i></button>');
						$('#infoidcentro-hidden').text(idcentro);
						$('#infoidmed-hidden').text(idmedinfo);
						 if(muestrainfo == "Sin Registro"){
							 $('#muestrainfo').text(muestrainfo);
						 }else{$('#muestrainfo').text(muestrainfo.slice(0, muestrainfo.length -3));}
						 $('#espinfo').text(espinfo);
						 $('#nocivainfo').text(nocivainfo);
						 $('#encontradasinfo').text(encontradasinfo);
						 $('#nivelnocivoinfo').text(nivelnocivoinfo);
						 $('#alarmarojoinfo').text(alarmarojoinfo);
						 $('#alarmaamarilloinfo').text(alarmaamarilloinfo);
						 infowindow.open(map,mi_marker);


				//	  }, 400);


				 });

			}

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
		markers = [];
     }
	 function hideMarkers (){
        $.each(markers, function (i, value) {
                element = value.name;
			    element.setVisible(false);
        });


     }
	 function showMarkers (){
        $.each(markers, function (i, value) {
                element = value.name;
			    element.setVisible(true);
        });

     }

	 function emptyMarkers (day,tabladata){
  		var centrosfiltro = [];
  		var centromidioynoactualiza = [];
  		var nomidio = [];
  		for (var i = 0; i<tabladata.length; i++){
  			if(parseInt(tabladata[i][day]) >= 0){
  				centrosfiltro.push(tabladata[i]['IDcentro']);
  			}
  		}
  		for (var i = 0; i<tablacompleta.length; i++){
  			if(parseInt(tablacompleta[i][day]) >= 0){
  				if(centrosfiltro.indexOf(tablacompleta[i]['IDcentro']) >=0){

  				}else{centromidioynoactualiza.push(tablacompleta[i]['IDcentro']);}
  			}else{
  				nomidio.push(tablacompleta[i]['IDcentro']);
  			}
  		}

      /* var zoomLevel = map.getZoom();
      var auto = '';
      if (zoomLevel >= zoomnombre && $("#btn_nombre_auto").is(':checked') ) {
         auto = "Mostrar";
      } else if (zoomLevel < zoomnombre && $("#btn_nombre_no").is(':checked') ) {
         auto = "Ocultar";
      }
      var opt = "";
      if( $("#btn_nombre_no").is(':checked') ){
        opt = -1;
      } else if( $("#btn_nombre_auto").is(':checked') ){
        opt = 0;

      } else if ( $("#btn_nombre_si").is(':checked') ){
        opt = 1;
      }   */
      var iconoaux = sinmarker;
      $.each(markers, function (i,value) {
          if (centromidioynoactualiza.indexOf(value.index) >=0){
            iconoaux = "green1.png";
    				if(indicadorupdate[value.index] != "green1.png"){
    					element = value.name;
    					element.setIcon({
    						url: iconoaux,
    						size: new google.maps.Size(20, 20),
    						anchor: new google.maps.Point(8,8),
    						labelOrigin: new google.maps.Point(10,23)
    						});

    					var label = element.getLabel();
    					if(label.color != colorlabelmarker){
    						label.color = colorlabelmarker;
    						element.setLabel(label);
    					}
    					indicadorupdate[value.index] = iconoaux;
    				}
    			}else if(nomidio.indexOf(value.index) >=0) {
    				iconoaux = sinmarker;
    				if(indicadorupdate[value.index] != sinmarker){
    					element = value.name;
    					element.setIcon({
    						url: iconoaux,
    						size: new google.maps.Size(20, 20),
    						anchor: new google.maps.Point(8,8),
    						labelOrigin: new google.maps.Point(10,23)
    						});

    					var label = element.getLabel();
    					if(label.color != colorlabelmarker){
    						label.color = colorlabelmarker;
    						element.setLabel(label);
    					}
    					indicadorupdate[value.index] = iconoaux;
    				}
    			}

      });
   }

	 function nombreMarkers (auto){
		 var opt = "";
		 if( $("#btn_nombre_no").is(':checked') ){
			 opt = -1;
		 } else if( $("#btn_nombre_auto").is(':checked') ){
			 opt = 0;

		 } else if ( $("#btn_nombre_si").is(':checked') ){
			 opt = 1;

		 }

     $.each(markers, function (i, value) {
        var nombrecentro = " ";
			 	if( (opt == 1 || ( opt == 0 && auto == "Mostrar" ) )) {
          if(id_empresa != 6){
            nombrecentro = nombrecentroarray[value.index];
          }else if(id_empresa == 6){
            if(!$.isNumeric(nombrecentroarray[value.index])){
              nombrecentro = nombrecentroarray[value.index];
            }
          }
				}
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



	function asdfabarrio(barrio_coord,color,idbarrio){

		var fill = color;
		var opacity = 0.35;
		if(color == "#ab5400"){opacity = 0.0;}
		var visible = true;
		var zoomL = map.getZoom();

		//if( !$('#nombreswitch').is(':checked') ){nombrecentro = ' ';}
		if( $("#btn_acs_no").is(':checked') || ( $("#btn_acs_auto").is(':checked') && zoomL > zoombarrio )){visible =false;}

		var mi_barrio = new google.maps.Polygon({
          paths: barrio_coord,
          strokeColor: color,
          strokeOpacity: 0.8,
          strokeWeight: 1.7,
          fillColor: fill,
          fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		 // content: "contentttt",
        });

		mi_barrio.setMap(map);
        markers_barrio.push({name: mi_barrio,  index:  idbarrio});

		//myPolygon.setOptions({strokeWeight: 2.0, fillColor: 'green'});
		// boundary3.addListener('click', showArrays);
		//google.maps.event.addListener(mi_barrio, 'mouseover', showArrays);
		//google.maps.event.addListener(mi_barrio, 'mouseout', function() {
			/*this.setOptions({fillOpacity:0.35});
			polygoninfoWindow.close();*/
		//});

		//Define position of label

		  /*var mapLabel = new google.maps.MapLabel({
			text: '1111',
			position: barrio_coord[0],
			map: map,
			fontSize: 20,
			align: 'left'
		  });
		  mapLabel.set('position', barrio_coord[0]);*/

	 }
	 function clearMarkersbarrio (){
        $.each(markers_barrio, function (index, value) {
                element = value.name;
			    element.setMap(null);
        });
		markers_barrio = [];
     }
	 function emptyMarkersbarrio (day){
		var barriomidio = [];
		for (var i = 0; i<tablacompleta.length; i++){
			if(parseInt(tablacompleta[i][day]) >= 0){
				barriomidio[tablacompleta[i]['IDbarrio']] = 1;
			}else{
				if(typeof barriomidio[tablacompleta[i]['IDbarrio']] == 'undefined'){
					barriomidio[tablacompleta[i]['IDbarrio']] = 0;
				}
			}
		}
		//console.log(barriomidio);
		var borde = "";
		var fill = "";
		var opacity = 0.0;
        $.each(markers_barrio, function (i, value) {

			borde = "#ab5400";
			fill = "#ffffff00";
			opacity = 0.0;


            if (barriomidio[value.index] == 1 ){borde = "#00c901"; fill = borde; opacity = 0.35;}
			element = value.name;
			element.setOptions({strokeColor: borde, fillColor: fill,fillOpacity: opacity });

        });
     }
	 function eliminarArreglobarrio (mi_indice){
		 var posicionkey = 0;
        $.each(markers_barrio, function (i, value) {
            if (value.index == mi_indice){
                element = value.name;
                element.setMap(null);
				posicionkey = i;
				return false;
            }
        });
		markers_barrio.splice(posicionkey,1) ;
     }

	function actualizabarrio(colorbarrio){
		 var classindicador = "";
		$.each(colorbarrio, function (key, value) {
			if(value >= 0 ){
				if(datosbarrio['TopLeft'][key]){
					switch (value){
						case 0:
							classindicador = "#ab5400";
							break;
						case 1:
							classindicador = "#00c901";
							break;
						case 2:
							classindicador = "#aeb1af";
							break;
						case 3:
							classindicador = "#e5e700";
							break;
						case 4:
							classindicador = "#FF0000";
							break;
					}

					eliminarArreglobarrio(key);
					asdfabarrio(datosbarrio['TopLeft'][key],classindicador,key);
				}
			}
		});
	 }
	 function hideMarkersbarrio (){
        $.each(markers_barrio, function (i, value) {
                element = value.name;
			    element.setVisible(false);
        });

     }
	 function showMarkersbarrio (){
        $.each(markers_barrio, function (i, value) {
                element = value.name;
			    element.setVisible(true);
        });

     }



	var nombreregion = "Región de los Lagos";
	$('#tabregion10, #tabregion11, #tabregion12').click( function(){
		nombreregion = this.value;
		center = "";
		zoom = 8;
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
			zoom = 7;
			center = xiiregion;
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

	$('#datetimepickerinicio').data("DateTimePicker").disable();

	var datetermino = new Date();
	datetermino.setDate(datetermino.getDate());
	$('#datetimepickertermino').datetimepicker({
    format: 'DD-MM-YYYY',
	defaultDate: datetermino,
	});

	$('#datetimepickertermino').data("DateTimePicker").disable();

	/*$(function () {
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
	}*/



	$( document ).ajaxStop(function () {
		$('#modalloading').modal('hide');
	});


	$( document ).ready(function() {
		loadcentros();
		$(document).on('click', '#opciones', function (e) {
		  e.stopPropagation();
		});
	});



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
	var markers_barrio = new Array();
	var fistcentermap = 1;
	var datosbarrio = [];
	var indicadorupdate = [];
	function loadcentros() {
		datos = [];
		opt = [];

		$.ajax({
				url: "load_ubicacion_centros_colab.php",
				type: 'post',
				data: {
					user_id:			user_id
				},
				success: function(dato)
				{

					datos = JSON.parse(dato);

					$( '#showcentros' ).empty();
					$('#opcionescentros').empty();

					if(datos['Error'] == 0){
						clearMarkers();
						var tex = "Buscar Centro";
						$('#opcionescentros').append($('<option hidden value ="1">Buscar Centro</option>'));
						for(var i = 0; i < datos['Nombre'].length; i++){
							var topleft = datos['TopLeft'][i].split(",");
							 var position = {lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])};
							 indicadorupdate[datos["IDcentro"][i]] = -1;
							 asdfa(position,datos['Nombre'][i],datos["IDcentro"][i],sinmarker,"Sin Registro","-","-","-","-","-");

							 //cargar select buscar centro
						    $('#opcionescentros').append($('<option>', {
								data: position,
								text : datos['Nombre'][i]
							}));
							//Guarda los nombres de los centros para que al ocultar los nombres se puedan recuperar despues
							nombrecentroarray[datos["IDcentro"][i]] = datos['Nombre'][i];
						}


						$("#showcentros").show();

						//Vista del centro correspondiente al usuario logeado

						if(datos['TopLeft_Usuario'] != "" && fistcentermap == 1){
							fistcentermap = 0;
							var topleftusuario = datos['TopLeft_Usuario'].split(",");
							var positionusuario = {lat: parseFloat(topleftusuario[0]), lng: parseFloat(topleftusuario[1])};
							map.setCenter(positionusuario);
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


					}else if(datos['Error'] == "No existe"){
						swal("", "No existen centros para los filtros", "warning");
						clearMarkers ();
					}else{swal("Error", "Error al cargar ubicación de los Centros.", "error");}
				},error: function(msg){console.log(msg);}
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

					$( '#showbarrio' ).empty();

					if(datosbarrio['Error'] == 0){
						clearMarkersbarrio();
						var tex = "Buscar Centro";
						$.each( datosbarrio['TopLeft'], function( key, value ) {

								asdfabarrio(value,"#ab5400",key);
							// asdfabarrio(position,datosbarrio['Nombre'][i],datosbarrio["IDcentro"][i],sinmarker,"Sin Registro","-","-","-","-","-");
						});


						$("#showbarrio").show();

						//Vista del centro correspondiente al usuario logeado

						/*if(datos['TopLeft_Usuario'] != "" && fistcentermap == 1){
							fistcentermap = 0;
							var topleftusuario = datos['TopLeft_Usuario'].split(",");
							var positionusuario = {lat: parseFloat(topleftusuario[0]), lng: parseFloat(topleftusuario[1])};
							map.setCenter(positionusuario);
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
						}*/


					}else if(datos['Error'] == "No existe"){
						//swal("", "No existen centros para los filtros", "warning");
						clearMarkersbarrio();
					}else{swal("Error", "Error al cargar ubicación de los Barrios.", "error");}
				},error: function(msg){console.log(msg);}
			});


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

								}

								//$('#'+tabla).bootstrapTable();

								for(var i = 0; i<opt.length; i++){
									//Modal Ver
									$('#'+tabla+'ver thead [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);

								}

								$('#'+tabla).bootstrapTable('refresh');
							}
						}
						loadresumen();

					}
			});


	}



	var idcentroactual = 0;
	function opencentro(idcentro){
		/*$('#modalnombrecentro').text(datos["Nombre"][ datos["IDcentro"].indexOf(String(idcentro)) ]);
		idcentroactual = idcentro;
		$('#myModalgrafico').modal('show');*/

	}
	// Grafica despues de abrir el modal
	$("#myModalgrafico").on("shown.bs.modal", function () {
	/*	$("#nromedicion").val(8);
		//$("#especiesselect").val(0);
		$("#medicionintext").val(2);
		loaddatagrafico(0,0);*/
	});






	var dato = [];
	function loaddatagrafico(axesmax,axesmin){
		/*dato = [];
		$('#modalloading').modal({backdrop: 'static', keyboard: false});
		$.ajax({
			url: // "load_historial",
			type: 'post',
			dataType: 'json',
			data: {
				IDcentro:		 idcentroactual,
				Fecha_Inicio: 	 document.getElementById("fechadesde").value,
				Fecha_Termino: 	document.getElementById("fechahasta").value,
				Axesmax:	      axesmax,
				Axesmin:		  axesmin,
				Especies: 	     parseInt(document.getElementById("especiesselect").value),
				Medicion: 	     parseInt(document.getElementById("medicionintext").value),
				user_id:			user_id
			},
			success: function(datoshist)
			{
				dato = []
				if(datoshist['Error'] == 0){
					dato = datoshist;
					if(datoshist['Nombre'] || parseInt(document.getElementById("especiesselect").value) == 0){
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
		//graficar();	*/

	}


	$('#nromedicion, #medicionintext, #nivel' ).change( function(){
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

	var data_grafico = Array();
	var choiceContainer = $("#choices");
	var nromedicion = "";
	var fechamedicion = "";
	function graficar(){
		$('#modalloading').modal('hide');
		$('#choicesall').prop('checked', true);
		$('#choicesdiato').prop('checked', false);
		$('#choicesdino').prop('checked', false);
		data_grafico = [];
		$('#placeholder').empty();
		$('#legendholder').empty();
		var medicion = document.getElementById("nromedicion").value;
		var medintext = parseInt(document.getElementById("medicionintext").value);
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
			var espauxmed = Array();
			for(var t = 1; t <= todo; t++){
				var medicionaux = medicion;
				if(medicion == "todo"){medicionaux = t;}

				for(var i= 0; i<dato['Nombre'].length; i++){
					if(dato.hasOwnProperty( dato['Nombre'][i].concat(medicionaux).concat(nivel)) ){
						//chequear si la muetra es interna/externa o ambas
						if(medintext == 2 ){
							data_grafico.push({label: opt[medicionaux-1].concat(" ").concat(dato['Nombre'][i]), data:dato[dato['Nombre'][i].concat(medicionaux).concat(nivel)],lines: {show: true},points: {show: true}, name:dato['Grupo'][i]  });

						}else{
							espauxmed = [];
							$.each( dato[dato['Nombre'][i].concat(medicionaux).concat(nivel)], function(key,value){
								if(value[6] == medintext){
									espauxmed.push(value);
								}
							});
							if(espauxmed.length >0){
								data_grafico.push({label: opt[medicionaux-1].concat(" ").concat(dato['Nombre'][i]), data:espauxmed,lines: {show: true},points: {show: true}, name: dato['Grupo'][i] });
							}

						}
					}
				}
			}
		}

		var i = 3;
		$.each(data_grafico, function(key, val) {
			val.color = i;
			++i;
		});

		if(nivel != ""){
			data_grafico.push({label:"Nivel Nocivo", data:[[dato['F_Min'],100,maxy],[dato['F_Max'],100,maxy]],color: "red", lines:  { steps: true, show: true, fill: true, lineWidth: 0.1, fillColor: {colors: [{ opacity: 0.1 }, { opacity: 0.2}] }}});

		}

		// insert checkboxes
		//var choiceContainer = $("#choices");
		choiceContainer.empty();
		$.each(data_grafico, function(key, val) {
			choiceContainer.append("<br/><input type='checkbox' value = '"+val.name+"' name='" + key +
				"' checked='checked' id='id" + key + "'>" +
				"<span style='margin-bottom: 10px;' for='id" + key + "'>"
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

					$("#tooltip").html(item.series.label + " <br> <b> Fecha Muestra: </b>" + f + " <br><b>Encontradas: </b>" + x + " [cel/ml] <br> <b>Nivel Nocivo: </b>" + y + " [cel/ml] ")
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);

					document.body.style.cursor = 'pointer';
				} else {
					$("#tooltip").hide();
					document.body.style.cursor = 'default';
				}

		});

		/*$("#placeholder").unbind('plotclick').bind("plotclick", function (event, pos, item) {
			if (item && item.series.label != "Nivel Nocivo") {

				tablasverreporte(item.series.data[item.dataIndex][4]);
				nromedicion = item.series.data[item.dataIndex][4];
				fechamedicion = item.series.data[item.dataIndex][4];

				$('#myModalverreporte').modal('show');
			}
		});*/


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

			/*$('#tabladiatomeasver').bootstrapTable("removeAll");
			$('#tabladinoflageladosver').bootstrapTable("removeAll");
			$('#tablaoespeciesver').bootstrapTable("removeAll");
			$('[name="outputver"]').text("");
			$('#modalloading').modal({backdrop: 'static', keyboard: false});
			$.ajax({
					url: // "load_fan",
					type: 'post',
					data: {
						IDmedicion: 	 IDmedicion,
						user_id:		user_id
					},
					success: function(msg)
					{

						if(msg != 0){
							var datos2 = JSON.parse(msg);
							$('#tabladiatomeasver').bootstrapTable("load", datos2['Diatomeas']);
							$('#tabladinoflageladosver').bootstrapTable("load", datos2['Dinoflagelados']);
							$('#tablaoespeciesver').bootstrapTable("load", datos2['OEsp']);
							$('#fechaverreporte').text(datos2['Fecha_Reporte']);
							var nombrecentro = $('#infonombrecentro').text();
							nombrecentro = nombrecentro.split('|');
							$('#nombreverreporte').text(nombrecentro[1]);
							$('#medicionverreporte').text(datos2['Medicion']);
							$('#acsverreporte').text(datos2['Barrio']);

							idmedicionarchivo = IDmedicion;
						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});

			//Parámetros Ambientales
			$.ajax({
					url: "load_pambientales_reporte_colab.php",
					type: 'post',
					data: {
						IDmedicion: 	 IDmedicion,
						user_id:		user_id
					},
					success: function(msg)
					{
						$('#tablapambientalesver').bootstrapTable("removeAll");
						$('#tablapambientalesotrosver').bootstrapTable("removeAll");
						if(msg != 0){
							var datos2 = JSON.parse(msg);
							$('#tablapambientalesver').bootstrapTable("load", datos2['PAmbientales']);
							$('#tablapambientalesotrosver').bootstrapTable("load", datos2['PAmbientalesotros']);

						}else{swal("Error", "Error al cargar el reporte.", "error");}
					}
				});*/

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



	$('#tabladiatomeasver, #tabladinoflageladosver, #tablaoespeciesver').bootstrapTable({
		formatNoMatches: function () {
        	return 'Ausencia de Microalgas';
   	 	},
		formatLoadingMessage: function (a,b,c,d,e) {
			return '';
		}
	});






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
		//"revisar si agregar lo comentado"
		//$("#sidebarweek").change();
	});

	/*$('#dias' ).change( function(){
		if($('#dias' ).val()>=7){
		var rowCount = $('#resumenreporte th').length;
		var remove = "nth-last-child(-n+"+(rowCount-7)+")";
		$('#resumenreporte').bootstrapTable('destroy');

		$('#resumenreporte tr').find('th:'+remove+', td:'+remove+'').remove();
		loadresumen();
		}else{$('#dias' ).val(7);}
	});*/

	var tablacompleta = [];
	var mySlider ="";
	var listaespecies = [];
	function loadresumen(){
		var dias = 7;//document.getElementById("dias").value;
		//parseInt(document.getElementById("especiesselectmap").value)
		var int = $("#btn_int").is(':checked') ? 1:0;
		var ext = $("#btn_ext").is(':checked') ? 1:0;
		if(int == 0 && ext == 0){
			int = 1;
			ext = 1;
		}
		var especies_aux = document.getElementById("especiesselectmap").value;
		if(especies_aux == ""){especies_aux = "vacio";}
		$('#loading1').removeClass("hidden");
		$.ajax({
				url: "load_resumen_reporte_colab.php",
				type: 'post',
				data: {
					user_id:			user_id,
					Nombre_Region: 	  nombreregion,
					//Dias: 	 		   dias,
					Especies:		   especies_aux,
					Medicion:		   parseInt(document.getElementById("nromedicionresumen").value),
					Interna:			int, //$('#internaswitch').is(':checked') ? 1 : 0,
					Externa:			ext, //$('#externaswitch').is(':checked') ? 1 : 0,

				},
				success: function(dato)
				{

					var myobjaux = JSON.parse(dato);

					var myobj = myobjaux['Resultado'];
					tablacompleta = myobj;
					var cantcol = $('th', $('#resumenreporte').find('thead')).length;
					if(cantcol != (parseInt(dias)+7)){

						$('#resumenreporte').bootstrapTable('destroy');

						// Agrega las nuevas columnas
						for(var i = myobj[myobj.length-1].length-1; 0<=i; i--){
							var th = '<th data-field="'+i+'" id="asd" data-sortable="false" data-switchable="false" class="" data-valign = "middle"  data-width = "90px" data-cell-style="cellStylenivelestabla"></th>';
							$('#resumenreporte tr').append($(th));
							$('#resumenreporte thead tr>th:last').html(myobj[myobj.length-1][i]+'<br> [cel/ml]');
						}



					}

					$('#resumenreporte').bootstrapTable();


					//Slider ticks-labels

					mySlider = $('#sidebarweek').bootstrapSlider({
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
					var tabladata = tablacompleta; //$('#resumenreporte').bootstrapTable('getData');
					listaespecies = [];
					for (var i = 0; i<tabladata.length; i++){
						if(tabladata[i]["Nociva"] == "Nociva"){ //Obliga a que solo muestre en la lista las especies nocivas
							if(listaespecies.indexOf(tabladata[i]['Especie']) === -1){listaespecies.push(tabladata[i]['Especie']);}
						}
					}
					listaespecies.sort();
					$('#especiesselectmap').empty();
					/*$('#especiesselectmap').append($('<option>', {
						text : 'Todas las Especies',
						value: 0
					}));
					$('#especiesselectmap').append('<option disabled>──────────────────</option>');*/

					$('#especiesselectmap').append($('<option>', {
						text : 'Especies Nocivas',
						value: 2
					}));

					/*$('#especiesselectmap').append($('<option>', {
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
					}));*/
					$('#especiesselectmap').append('<option disabled>──────────────────</option>');
					for(var i = 0; i<listaespecies.length; i++){
						$('#especiesselectmap').append($('<option>', {
							text : listaespecies[i]
						}));
					}
					$('#resumenreporte').bootstrapTable('resetSearch','');


					$("#sidebarweek").change();
					$('#loading1').addClass("hidden");


				}
			});

	}




	//Slider

	$("#sidebarweek").change( function(){

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
		var muestrainfo = "Sin Registro";
		var idmedinfo = "";
		var espinfo = "-";
		var nocivainfo = "-";
		var encontradasinfo = "-";
		var nivelnocivoinfo = "-";
		var alarmarojoinfo = "-";
		var alarmaamarilloinfo = "-";
		var colorbarrio = Array();
		infowindow.close(map);
		function infodata(i,day){
			if(parseInt(tabladata[i][day])>=0){

				muestrainfo = tabladata[i]["F"+day];
				idmedinfo = tabladata[i]["M"+day];
				espinfo = tabladata[i]["Especie"];
				nocivainfo = tabladata[i]["Nociva"] == "" ? "-" : tabladata[i]["Nociva"];
				encontradasinfo = parseInt(tabladata[i][day])+" [cel/ml]";
				nivelnocivoinfo = tabladata[i]["Nivel_Critico"] > 0 ? tabladata[i]["Nivel_Critico"]+" [cel/ml]" : "-";
				alarmarojoinfo = tabladata[i]["Alarma_Rojo"]  > 0 ? tabladata[i]["Alarma_Rojo"]+" [cel/ml]" : "-";
				alarmaamarilloinfo = tabladata[i]["Alarma_Amarillo"]  > 0 ? tabladata[i]["Alarma_Amarillo"]+" [cel/ml]" : "-";

			}
		}

		emptyMarkers(day,tabladata);
		emptyMarkersbarrio(day);
		for (var i = 0; i<tabladata.length; i++){


				idcentro = tabladata[i]['IDcentro'];
				if(i == 0){idcentronuevo = idcentro;colorbarrio[tabladata[i]['IDbarrio']] = 0;}

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


					//eliminarArreglo(idcentronuevo);
					topleft = tabladata[i-1]['TopLeft'].split(",");
					asdfa({lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])},tabladata[i-1]['Centro'],idcentronuevo,classindicador,muestrainfo,idmedinfo,espinfo,nocivainfo,encontradasinfo,nivelnocivoinfo,alarmarojoinfo,alarmaamarilloinfo);



					//Actualizar color barrios
					if(parseInt(colorbarrio[tabladata[i-1]['IDbarrio']])<alarma){
						colorbarrio[tabladata[i-1]['IDbarrio']] = alarma;
						//console.log("IDbarrio: "+tabladata[i-1]['IDbarrio']+ " Alarma: "+alarma+ "ID centro: "+idcentronuevo+ "Nombre centro: "+tabladata[i-1]['Centro']);
					}

					if(!colorbarrio[tabladata[i]['IDbarrio']]){
						colorbarrio[tabladata[i]['IDbarrio']] = 0;
					}


					idcentronuevo = idcentro;
					alarma = 0;
					muestrainfo = "Sin Registro";
					idmedinfo = "";
					espinfo = "-";
					nocivainfo = "-";
					encontradasinfo = "-";
					nivelnocivoinfo = "-";
					alarmarojoinfo ="-";
					alarmaamarilloinfo ="-";


				}

				if( esp == "Todas las Especies" || ( tabladata[i]['Especie'] == esp || tabladata[i]['Fiscaliza'] == fisc || tabladata[i]['Nociva'] == nociva ) || tabladata[i]['Grupo'] == grupo ){

					if(parseInt(tabladata[i][day]) >= parseInt(tabladata[i]["Alarma_Rojo"]) && parseInt(tabladata[i]["Alarma_Rojo"])>0 ){
						if(alarma < 4){alarma = 4; infodata(i,day);};
					}else if(parseInt(tabladata[i][day]) >= parseInt(tabladata[i]["Alarma_Amarillo"]) && parseInt(tabladata[i]["Alarma_Amarillo"])>0){
						if(alarma < 3){alarma = 3; infodata(i,day);}
					}else if(parseInt(tabladata[i][day]) > 0){
						if(alarma <= 2){
							if(alarma < 2){
								infodata(i,day);
							}else{
								if(tabladata[i]['Nociva'] == "Nociva"){
									infodata(i,day);
								}
							};
							alarma = 2;
						}
					}else if(parseInt(tabladata[i][day]) == 0){
						if(alarma < 1){alarma = 1; infodata(i,day);}
					}
					//console.log(tabladata[i][day]);
					/*if(parseInt(tabladata[i][day])){
						espinfo = tabladata[i]["Especie"];
						nocivainfo = tabladata[i]["Nociva"] == "" ? "-" : tabladata[i]["Nociva"];
						encontradasinfo = parseInt(tabladata[i][day]);
						nivelnocivoinfo = tabladata[i]["Nivel_Critico"];
						alarmarojoinfo = tabladata[i]["Alarma_Rojo"];
						alarmaamarilloinfo = tabladata[i]["Alarma_Amarillo"];

					}*/
					//console.log("IDcentro: "+idcentro+"  Alarma: "+alarma+" Value: "+tabladata[i][day]+ " Alarma_Rojo: "+tabladata[i]["Alarma_Rojo"] );
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


					//eliminarArreglo(idcentro);
					topleft = tabladata[tabladata.length - 1]['TopLeft'].split(",");
					asdfa({lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])},tabladata[tabladata.length - 1]['Centro'],idcentro,classindicador,muestrainfo,idmedinfo,espinfo,nocivainfo,encontradasinfo,nivelnocivoinfo,alarmarojoinfo,alarmaamarilloinfo);

					//Actualizar color barrios
					if(parseInt(colorbarrio[tabladata[tabladata.length - 1]['IDbarrio']])<alarma){
						colorbarrio[tabladata[tabladata.length - 1]['IDbarrio']] = alarma;
						//console.log("IDbarrio: "+tabladata[tabladata.length - 1]['IDbarrio']+ " Alarma: "+alarma + "ID centro: "+idcentro+ "Nombre centro: "+tabladata[tabladata.length - 1]['Centro']);
					}

				}




		}
		actualizabarrio(colorbarrio);


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

		return (index-lastindex)+1;
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


	var repeatadd = 0;
	var repearaux = 1;
	function playcode() {
		var next = ""
		if(repeatadd == 0){
			next = mySlider.bootstrapSlider('getValue')+repearaux;
			if(next > 6){next = 5;repearaux = -1;
			}else if(next < 0){next = 1;repearaux = 1;}
		}else{
			next = mySlider.bootstrapSlider('getValue')+repeatadd;
			if(next > 6){next = 0;
			}else if(next < 0){next = 6;}
		}
		mySlider.bootstrapSlider('setValue',next);
		mySlider.change();
	}
	function abortTimer() { // to be called when you want to stop the timer
	  clearInterval(tid);
	  tid = 0;
	}


	var g1play = true;
	var image = document.getElementById("g1play-pause");
	var tid = "";
	var speedplay = 1500;
	image.onclick = function() {
		g1play = !g1play;
		$('#g1play-pause').removeClass("fa-play");
		$('#g1play-pause').removeClass("fa-pause");
		if (g1play == true){
			$('#g1play-pause').removeClass("fa-pause");
			$('#g1play-pause').addClass("fa-play");
			$('#g1play-pause').css("padding-left","7px");
			abortTimer();
		} else {
			$('#g1play-pause').removeClass("fa-play");
			$('#g1play-pause').addClass("fa-pause");
			$('#g1play-pause').css("padding-left","4px");
			tid = setInterval(playcode, speedplay); }
	};

	var g1repeat = 0;
	var imagerepeat = document.getElementById("g1repeat");
	imagerepeat.onclick = function() {
		g1repeat++;
		if(g1repeat>1){g1repeat=-1;}
		$('#g1repeat').removeClass("fa-refresh");
		$('#g1repeat').removeClass("fa-repeat");
		$('#g1repeat').removeClass("fa-undo");
		if (g1repeat == -1){
			$('#g1repeat').addClass("fa-undo");
			//imagerepeat.style.bottom = "-27px";
			repeatadd = -1;
		} else if (g1repeat == 0){
			$('#g1repeat').addClass("fa-refresh");
			//imagerepeat.style.bottom = "-26px";
			repeatadd = 0;
		} else if (g1repeat == 1){
			$('#g1repeat').addClass("fa-repeat");
			//imagerepeat.style.bottom = "-11px";
			repeatadd = 1;
		}
	};

	var g1speed = 1;
	$('#g1speed').click( function() {
		g1speed++;
		if(g1speed>2){g1speed=0;}
		$('#g1speed').removeClass("fa-step-forward");
		$('#g1speed').removeClass("fa-forward");
		$('#g1speed').removeClass("fa-fast-forward");
		if (g1speed == 0){
			$('#g1speed').addClass("fa-step-forward");
			$('#g1speed').css("padding-left","5px");
			speedplay = 2500;
			if(g1play == false){
				abortTimer();
				tid = setInterval(playcode, speedplay);
			}
		} else if (g1speed == 1){
			$('#g1speed').addClass("fa-forward");
			$('#g1speed').css("padding-left","7px");
			speedplay = 1500;
			if(g1play == false){
				abortTimer();
				tid = setInterval(playcode, speedplay);
			}
		} else if (g1speed == 2){
			$('#g1speed').addClass("fa-fast-forward");
			$('#g1speed').css("padding-left","5px");
			speedplay = 1000;
			if(g1play == false){
				abortTimer();
				tid = setInterval(playcode, speedplay);
			}
		}
	});





</script>

<script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpUhp-rPo8Zev2M_lT0vPHRQZ9rftJGJI&callback=initMap">
    </script>




@endsection