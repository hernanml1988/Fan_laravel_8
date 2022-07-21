@extends('layouts/master')
@section('title', '- Informe')
<style>
    @media (min-width: 992px){
        .tile_count .tile_stats_count {
            margin-bottom: 10px;
            border-bottom: 0;
            padding-bottom: 10px;
        }
        .tile_count .tile_stats_count span {
            font-size: 13px;
        }
        .tile_count .tile_stats_count .count {
            font-size: 40px;
        }
    }
    
    .map {
       width: 100%;
       height: 250px;
       background-color: grey;
       border: 1px solid !important;
     }
     .map_label{
         border: 1px solid;
        border-bottom: 0px;
     }
    
    
    .tile_count {
        color: #73879C;
        font-family: "Helvetica Neue",Roboto,Arial,"Droid Sans",sans-serif;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.471;
        background-color:#eee !important;
        border-bottom: 1px solid #D9DEE4;
        border-top: 1px solid #D9DEE4;
    }
    .tile_count .tile_stats_count {
        /*border-bottom: 1px solid #D9DEE4;*/
        padding: 10px 10px 10px 20px;
        position: relative;
    }
    .tile_count .tile_stats_count span {
        font-size: 12px;
    }
    .tile_count .tile_stats_count .count {
        font-size: 27px;
        line-height: 47px;
        font-weight: 600;
    }
    .tile_count .tile_stats_count:before {
        content: "";
        position: absolute;
        left: 0;
        height: 65px;
        border-left: 2px solid #ADB2B5;
        margin-top: 10px;
    }
    .tile_count .tile_stats_count, ul.quick-list li {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .green {
        color: #1ABB9C;
    }
    .red {
        color: #E74C3C;
    }
    
    .dashboard-top{
        margin-top: -4px;
        margin-left: -50px;
        margin-right: -50px;
    }
    
    @media all {
       div.saltopagina{
          display: none;
       }
    
        @page { size: Letter;  margin: 0mm;}
    
        #graficosseccion01 .fixed-table-container tbody td{
            border-left:none !important;
    
        }
    
        #graficosseccion01 .bootstrap-table .table > thead > tr:first-child {
              display: none !important;
           }
    
        #graficosseccion01 .bootstrap-table .table > thead > tr > th {
              border: none !important;
           }
    
         #graficosseccion01 .fixed-table-container thead th .th-inner, .fixed-table-container tbody td .th-inner{
               padding:4px !important;
               line-height: 15px !important;
           }
    
        #graficosseccion01  .fixed-table-body {
             overflow-x: unset !important;
             overflow-y: unset !important;
             height: unset !important;
           }
         #graficosseccion01  .table-responsive {
               overflow-x:unset !important;
           }
    .bg-green {
        background: #1ABB9C!important;
        border: 1px solid #1ABB9C!important;
        color: #fff;
    }
    
    .progress {
        height: 15px !important;
        margin-bottom: 15px !important;
    }
    
    
    #graficosseccion02 .fixed-table-body{
        max-height: 500px;
    }
    
    .table_blue thead {
        background: #035377 !important;
        color: #ECF0F1 !important;
        border-collapse: separate !important;
    }
    
    #resumenreporte > tbody >tr >td:first-child  {
        border-right: .25rem solid #eee !important;
        border-bottom: .01rem solid rgb(249, 249, 249) !important;
    }
    #resumenreporte > tbody >tr >td:nth-child(2)  {
        border-right: .25rem solid #eee !important;
        border-bottom: .01rem solid rgb(249, 249, 249) !important;
    }
    
    .label-red1{
        background: linear-gradient(45deg, rgba(184,0,0,0) 84%, rgba(184,0,0,0.8) 92%, rgba(184,0,0,0.85) 94%, rgba(184,0,0,1) 100%) !important;
        color: red !important;
        font-family: calibri;
        border-color: #ccc !important;
    }
    .label-yellow1{
        background: linear-gradient(45deg, rgba(228,199,32,0) 84%, rgba(228,199,32,0.8) 92%, rgba(228,199,32,0.85) 94%, rgba(228,199,32,1) 100%) !important;
        color: #e9cf3c !important;
        font-family: calibri;
        border-color: #ccc !important;
        font-weight: bold;
    }
    
    .print_helper_class {
      display: none;
    }
    
    }
    
    @media print{
    
    
        @page {
           margin: 10mm 0 10mm 0;
        }
    
       body { width:1200px;
            margin:0;
            padding:0;
        }
    
        .print_helper_class{
            display: block;
            overflow: visible;
            font-family: Menlo, "Deja Vu Sans Mono", "Bitstream Vera Sans Mono", Monaco, monospace;
            white-space: pre;
            white-space: pre-wrap;
        }
        .textojoobs {
          display: none;
        }
    
    
       .fixed-table-body {
               overflow-y: hidden !important;
             overflow-x: hidden !important;
             width: unset !important;
           }
           .table-responsive {
               overflow-x:unset !important;
           }
    
       .resize {
                width: 100% !important;
                height: auto !important;
        }
    
       .tile_stats_count{
           text-align: center !important;
       }
       .tile_count .tile_stats_count .count {
            font-size: 20px !important;
        }
    
       div.saltopagina{
          display:block;
          page-break-before:always;
          padding-top:3px;
          top:0;
    
       }
    
       .page-break{
          display:block;
          page-break-before:always;
          padding-top:5px;
          top:0;
    
       }
       .page-break7{
          display:block;
          page-break-before:always;
          padding-top:45px;
          top:0;
    
       }
       .dashboard-top{
            margin-top: 0px;
            margin-left: -15px;
            margin-right: -12px;
        }
    
        .progress {
            height: 5px !important;
            margin-bottom: 10px !important;
            background-color: #f5f5f5 !important;
        }
    
    
    
       /*No imprimir*/
       .oculto {display:none}
    
       .no-print, .no-print *
        {
            display: none !important;
        }
        .graficos1b{
            page-break-inside: avoid;
            top:0;
    
        }
    
        .si-print{
            display: block !important;
        }
    
    
        #div_ojoseccion1{
             padding: 0px 40px 0px 40px;
        }
    
        #seccion1{
            margin-left:10px; margin-right:10px; margin-top:0px;top:0; border:2px solid #666;padding: 15px 50px 15px 50px; min-height: 1435px;
        }
        #div_ojoseccion2{
             padding: 0px 40px 0px 40px;
        }
    
        #seccion2{
            margin-left:10px; margin-right:10px; margin-top:0px;top:0; border:2px solid #666;padding: 15px 50px 15px 50px; height: 1435px;
        }
        #div_ojoseccion3{
             padding: 0px 40px 0px 40px;
        }
    
        #seccion3{
            margin-left:10px; margin-right:10px; margin-top:0px;top:0; border:2px solid #666;padding: 15px 50px 15px 50px; min-height: 1435px; ;
        }
    
        #div_ojoseccion3{
             padding: 0px 40px 0px 40px;
        }
    
    
    
        /*table { page-break-inside:avoid !important; width:100% !important; }
           tr { page-break-inside: avoid !important; page-break-after:avoid !important }
        .element-that-contains-table {
            overflow: visible !important;
        }
    
        thead { display: table-row-group; }*/
        /*
        tr { page-break-inside: avoid !important; }*/
    
    
        [class*="col-sm-"] {
        float: left;
      }
    
      [class*="col-xs-"] {
        float: left;
      }
    
      .col-sm-12, .col-xs-12 {
        width:100% !important;
      }
    
      .col-sm-11, .col-xs-11 {
        width:91.66666667% !important;
      }
    
      .col-sm-10, .col-xs-10 {
        width:83.33333333% !important;
      }
    
      .col-sm-9, .col-xs-9 {
        width:75% !important;
      }
    
      .col-sm-8, .col-xs-8 {
        width:66.66666667% !important;
      }
    
      .col-sm-7, .col-xs-7 {
        width:58.33333333% !important;
      }
    
      .col-sm-6, .col-xs-6 {
        width:50% !important;
      }
    
      .col-sm-5, .col-xs-5 {
        width:41.66666667% !important;
      }
    
      .col-sm-4, .col-xs-4 {
        width:33.33333333% !important;
      }
    
      .col-sm-3, .col-xs-3 {
        width:25% !important;
      }
    
      .col-sm-2, .col-xs-2 {
        width:16.66666667% !important;
      }
    
      .col-sm-1, .col-xs-1 {
        width:8.33333333% !important;
      }
    
      .col-sm-1,
      .col-sm-2,
      .col-sm-3,
      .col-sm-4,
      .col-sm-5,
      .col-sm-6,
      .col-sm-7,
      .col-sm-8,
      .col-sm-9,
      .col-sm-10,
      .col-sm-11,
      .col-sm-12,
      .col-xs-1,
      .col-xs-2,
      .col-xs-3,
      .col-xs-4,
      .col-xs-5,
      .col-xs-6,
      .col-xs-7,
      .col-xs-8,
      .col-xs-9,
      .col-xs-10,
      .col-xs-11,
      .col-xs-12 {
      float: left !important;
      }
    
      body {
        margin: 0;
        padding: 0 !important;
        min-width: 768px;
        font-size: 10px;
        -webkit-print-color-adjust: exact;
      }
    
      .container {
        width: auto;
        min-width: 750px;
      }
    
    
    
      a[href]:after {
        content: none;
      }
    
      .noprint,
      div.alert,
      header,
      .group-media,
      .btn,
      .footer,
      form,
      #comments,
      .nav,
      ul.links.list-inline,
      ul.action-links {
        display:none !important;
      }
    }
    
    
    
    
    
    </style>
    
    
@section('content')
<script type="text/javascript">

</script>




<div id="wrapper">

	

	<div id="page-wrapper" >


        <div id ="imprimible">


                <div id="div_ojoseccion1">
                    <div  id= "seccion1" class="row" style="margin-left:10px; margin-right:0px;top:0; padding: 0px 15px 15px 15px;">
                            <div class="encabezado">
                            </div>





                        <!--<table class="si-print" style="display:none; margin: 0px auto ; width:100%;">
                            <thead>
                                <tr>
                                    <th  valign = "middle" align="left"></th>
                                    <th  valign = "middle" align="center"></th>
                                    <th  valign = "middle" align="right"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: left; width: 25%;">
                                        <img src="GtrFan-MonitoreoAlgasNocivas.png" />
                                    </td>
                                    <td style="text-align: center; width: 50%;">
                                       <h3 style="font-size:18px !important;">
                                            INFORME FLORACIÓN ALGAS NOCIVAS
                                            <a title="Ocultar toda la sección al imprimir" href="javascript:void(0);" id="ojoseccion1" onclick="ocultarseccion1()" class ="no-print"><i class="fa fa-eye" style=" display:none;font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>
                                       </h3>
                                       <p style="font-size:18px;">Gerencia de Licencias & Medioambiente</p>
                                       <output id="" class="Datelistatareas" style="display: flex !important;align-items: center;justify-content: center;    margin-top: -10px;"></output>

                                    </td>
                                    <td style="text-align: right; width: 25%;">
                                        <img class="logoempresa" src=""  />

                                     </td>

                                </tr>


                            </tbody>
                        </table> -->
                        <!--<hr style="margin-bottom:40px !important;">  -->

                        <div id="div_ojo0" class="row dashboard-top tile_count" >
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <div id="indicador_rojo" class=" indicador indicadoractivorojo ubicacion" style="animation:none !important; width: 15px !important; height: 15px !important;"></div>
                              <span class="count_top" style="margin-left:20px;"> Centros con Alarma </span>
                              <div id="cant_rojo" class="count" style="cursor:pointer;">0 Crítico</div>
                              <span id="cant_rojo_sem" class="count_bottom" style="cursor:pointer;"></span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <div id="indicador_amarillo" class=" indicador indicadoractivoamarillo ubicacion" style="animation:none !important; width: 15px !important; height: 15px !important;"></div>
                              <span class="count_top" style="margin-left:20px;"> Centros con Alarma</span>
                              <div id="cant_amarillo" class="count" style="cursor:pointer;">0 Precaución</div>
                              <span id="cant_amarillo_sem" class="count_bottom" style="cursor:pointer;"></span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top"><i class="fa fa-warning"></i> Centros con Mortalidad</span>
                              <div id="cant_mortalidad" class="count green" style="cursor:pointer;">0 Mortalidad</div>
                              <span id="cant_mortalidad_sem" class="count_bottom" style="cursor:pointer;"></span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" id="especie"><i class="glyphicon glyphicon-tree-deciduous"> </i> Especies</span><output class="hidden" id="idespecie"></output>
                              <div class="count" id="nivel_especie">-</div>
                              <span class="count_bottom" id="texto_especie" style="cursor:pointer;"></span><output class="hidden" id="idcentroespecie"></output>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top" id="especie2"><i class="fa fa-signal"></i> Semana Ingreso Registros</span>
                              <div class="count" id="nivel_especie2" style="margin-bottom:5px;"></div>
                              <div id="titleingresosemana" title="">
                              	<span class="inlinesparkline"></span>
                                <br />
                              </div>
                              <div style="margin-top:4px;">
                              	<span class="count_bottom" id="texto_especie2"></span>
                              </div>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                            	<a title="Ocultar panel al imprimir" href="javascript:void(0);" id="ojo0" onclick="ocultar0()" class ="no-print"><i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float:right; margin-right:10px; margin-top:-10px"></i></a>
                                <span class="count_top"><i class="fa fa-check"></i> Ingreso de Hoy </span>
                                <div id="cant_ingreso" class="sidebar-widget" style="padding-left:12px; cursor:pointer;">
                                    <canvas id="chart_gauge_01" style="width: 115px; height: 50px; margin-top:-5px" ></canvas>
                                    <div class="goal-wrapper">
                                     <b> <span id="gauge-text" class="gauge-value green" style="margin-left:17px;"></span></b>
                                      <span class="gauge-value" style="margin-left:3px;"> Centros </span>
                                     <b> <span id="goal-text" class="goal-value" style="margin-left:3px;"></span></b>
                                    </div>
                                </div>

                              <!--<span class="count_top"><i class="fa fa-check"></i> Ingreso de Registros</span>
                              <div class="count" id="cant_ingreso" style="cursor:pointer;"></div>
                              <span class="count_bottom">Actualizado a las <i id="cant_ingreso_hora" class="green"> </i> </span>-->
                            </div>

                        </div>
                        <div class="row no-print">
                            <div id="refreshdashboard" style="right: 3px;border: solid 1px #c9e4df;border-top: none; position: absolute;margin-top: -3px; background-color: #bcdfd94d;width: 98px;height: 24px;z-index: 1;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;">
                                <span title="Actulizar Dashboard" id="cant_ingreso_hora" class="fa fa-clock-o" style=" margin-left:10px;  cursor:pointer;color: #035377; border-radius: 50%;padding: 4px; "> </span>

                            </div>
                        </div>


                        <div id="sticky-anchor" style="height: 0px;"></div>
                        <div id="sticky" class="" style="margin-left:-40px">
                            <button title="Imprimir" type="button" id="" style="float: left;" onclick="imprimir();" class="btn btn-danger btn-sm no-print center-block">  <i class="fa fa-print"></i> </button>
                        </div>


                        <!-- Registro Medicion  -->
                        <div class="row" id="div_ojo01">
                            <div id="graficosseccion01" style="margin-top:5px;">

                                <div class="row " style="margin-left:10px; margin-right:10px;">
                                	<a title="Ocultar al imprimir" id="ojo01" onclick="ocultar01()" class ="no-print"><i class="fa fa-eye" style=" font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>
                                    <div class="text-center">
                                        <h3 style="font-size: 18px !important;"> INGRESO REGISTROS </h3>
                                    </div>
                                    <hr style="margin-top:25px; ">
                                    <div class="no-print" style="width: 80%; float: left; margin-top: 15px; margin-left:50px; margin-bottom: 15px;">
                                        <select  class="form-control" style="float: left; max-width:140px; margin-right:10px;cursor:pointer;"  id="region_filtro01" name="region_filtro01" onChange="myFunction01()" data-actions-box="true" >

                                            <option value ="1">Última Semana </option>
                                            <option value ="2">Último Mes </option>
                                            <option value ="0">Desde - Hasta </option>

                                        </select>
                                        <div class="input-group date"   id="datetimepicker_filtro1_01" style="width:135px; display: none;float: left;margin-right: 10px;margin-left: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_1_01" name ="fecha_filtro_1_01" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <div class="input-group date"   id="datetimepicker_filtro2_01" style="width:135px; display: none;float: left;margin-right:10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_2_01" name ="fecha_filtro_2_01" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <!-- -->
                                        <!--<select id="centro_filtro_operando01" class="form-control" style=" display:inline; width: 135px !important;">
                                            <option value="1">Habilitados</option>
                                            <option value="0">Deshabilitados</option>
                                            <option value="2">Todos</option>
                                        </select>
                                        <select id="filtercentros01" class="form-control" style=" display:inline; width: 150px !important;">
                                            <option value="Region">Ordenar por Región</option>
                                            <option value="Barrio">Ordenar por ACS</option>
                                            <option value="Area">Ordenar por Área</option>
                                        </select>-->
                                        <span class="input-group-addon no-print" style="background-color: #659fa9; color: white; display:inline; position:relative; border-radius:4px 0px 0px 4px;line-height:2.3; margin-left:0px;" data-toggle="collapse" data-parent="#accordion" href="#collapseregion">
                                        <a title="Ordenar Centro Por" class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFF !important;">
                                        	<b>Orden &nbsp;</b>
                                            <i class="fa fa-caret-down" style="display:inline"></i>
                                        </a>
                                        <ul id="dropdown01" class="dropdown-menu dropdown-user" style="padding:15px;">
                                            <div class="text-center">
                                                <select id="centro_filtro_operando01" class="form-control" style=" display:inline; width: 170px !important;">
                                                    <option value="1">Centro Habilitados</option>
                                                    <option value="0">Centro Deshabilitados</option>
                                                    <option value="2">Todos los Centros</option>
                                                </select>
                                            </div>
                                            <div class="center-block" style=" max-width:370px;margin-bottom: 18px;margin-top: 16px;">
                                                <select id="filtercentros01" class="form-control">
                                                    <option value="Region">Ordenar por Región</option>
                                                    <option value="Barrio">Ordenar por ACS</option>
                                                    <option value="Area">Ordenar por Área</option>

                                                </select>
                                            </div>
                                        </ul>
                                    </span>
                                        <select class="selectpicker centro_filtro2 oculto"  data-live-search="true" id="centro_filtro01" multiple="multiple" name=""  data-actions-box="true" style="cursor:pointer;" >
                                        </select>
                                        <select id="ingreso_tipo_medicion" class="selectpicker tipo_medicion no-print" data-live-search="true"  multiple="multiple" data-actions-box="true" style="margin-left:10px; cursor:pointer; display:inline;width: 160px;">
                                            <option value = "0" >Medición Interna</option>
                                            <option value = "1" >Medición Externa</option>
                                        </select>
                                        <div id="loading01" class="" style="display:inline;"><img src='loader.gif' /></div>
                                        <button  type="button" id="boton01" style=" margin-left: 20px;"  onclick="boton01();"  class="btn btn-primary btn-sm no-print">Filtrar</button>

                                    </div>


                                </div>
                                <a id="download1" download="Ingreso Registros.jpg"  href="" class="btn btn-default pull-right bg-flat-color-1" title="Descargar Gráfico Como Imágen" style="margin-top:-41px; margin-right:230px;">
                                    <i class="fa fa-download"></i>
                                </a>
                                <select id="change_vista_ingreso" class="form-control pull-right no-print" onchange="change_vista_ingreso();"  size="1" style=" margin-right:60px; cursor:pointer; display:inline;width: 160px;margin-top: -41px;">
                                    <option value = "Grafico" >Vista Gráfico</option>
                                    <option value = "Grafico Atrasos" title="Mostrar los registros que se cargaron de forma atrasada mayor a 48hrs" >Vista Gráfico Atrasos</option>
                                    <option value = "Tabla" >Vista Tabla</option>
                                </select>

                                <div id="ingreso_registros_tabla" class="row hidden" style="padding:5px 75px;">
                                    <h4 class="" align="center" id="" style="display: -webkit-inline-box;width:  100%; margin-bottom: 15px; margin-top:0px; text-align: -webkit-center;  font-size:14px; font-weight:normal;"><b>TABLA 1. </b> Cantidad de Ingresos Registrados por Centro <br /><br /><div style="display:inline;" class="tabla1_fecha"></div> </h4>
                                        <table cellSpacing="0" data-toggle="table" data-search="false" data-show-columns="false" data-pagination="false" data-page-size="200"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="" data-query-params="" data-show-refresh="false" data-cache="false" width="100%" height="100%" class="table "
                                        style="text-align-last:center" data-click-to-select="false" data-single-select="false"   id="dataTables_lista_centro01" >
                                        <thead style="border: inherit !important">
                                            <tr >
                                               <!-- <th data-formatter="runningFormatternumero" data-switchable="false" data-width = "35px" >#</th>-->
                                                <th data-field="1"  data-sortable="false" data-width = "35px">  </th>
                                                <th data-formatter="runningFormatter1"  data-sortable="false" data-width = "43px">  </th>
                                                <th data-field="2"  data-sortable="false" data-width = "35px">  </th>
                                                <th data-formatter="runningFormatter2"  data-sortable="false" data-width = "43px">  </th>
                                                <th data-field="3"  data-sortable="false" data-width = "35px">  </th>
                                                <th data-formatter="runningFormatter3"  data-sortable="false" data-width = "43px">  </th>
                                                <th  data-formatter="runningFormatter4" data-sortable="false" data-width = "10px">  </th>
                                            </tr>
                                        </thead>

                                    </table>
                              	</div>

                                <div id="ingreso_registros_grafico" class="" style="padding:5px 75px;">
                                	<div class="row">
                                    	<canvas id="chart-bar01" height="120"></canvas>
                                   	</div>
                                </div>


                        	</div>
                            <!-- Obs    -->
                            <div id="saltoojoobs1"></div>
                            <div id="ojo1saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>
                            <div id="div_ojoobs1" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 0px 70px 15px 70px; width:100%">
                                <a title="Ocultar al imprimir" id="ojoobs1" onclick="ocultarobs1()" class ="no-print">
                                	<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>
                                </a>
                                <a title="Insertar salto página al imprimir" id="ojoobs1salto" onclick="ocultarobs1salto()" class ="no-print hidden">
                                    <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                                </a>

                                <textarea id="textojoobs1" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>
                                <div id="print_helper_textojoobs1" class="print_helper_class" style="text-align: justify;"></div>
                            </div>

                     	</div>

                        <div class="row" id="div_ojo02">
                            <div id="graficosseccion02" style="margin-top:20px;padding: 0px 30px;">
                            	<a title="Ocultar al imprimir" id="ojo02" onclick="ocultar02()" class ="no-print"><i class="fa fa-eye" style=" font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>
                            	<div class="text-center">
                                        <h3 style="font-size: 18px !important;"> RESUMEN CONCENTRACIONES </h3>
                                    </div>
                                    <hr style="margin-top:25px; ">
                            	<div class="no-print" style="  margin-top: 15px; margin-left:50px; margin-bottom: 25px;">
                                    <select  class="form-control" style="float: left; max-width:135px; margin-right:10px;cursor:pointer;"  id="region_filtro02" name="region_filtro02" onChange="myFunction02()" data-actions-box="true" >

                                        <option value ="1">Última Semana </option>
                                        <option value ="2">Último Mes </option>
                                        <option value ="0">Desde - Hasta </option>

                                    </select>

                                    <span class="input-group-addon no-print" style="background-color: #659fa9; color: white; display:inline; position:relative; border-radius:4px 0px 0px 4px;line-height:2.3; margin-left:0px;" data-toggle="collapse" data-parent="#accordion" href="#collapseregion">
                                        <a title="Ordenar Centro Por" class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:#FFF !important;">
                                        	<b>Orden &nbsp;</b>
                                            <i class="fa fa-caret-down" style="display:inline"></i>
                                        </a>
                                        <ul id="dropdown02" class="dropdown-menu dropdown-user" style=" padding:15px;">
                                            <div class="text-center">
                                                <select id="centro_filtro_operando02" class="form-control" style=" display:inline; width: 170px !important;">
                                                    <option value="1">Centro Habilitados</option>
                                                    <option value="0">Centro Deshabilitados</option>
                                                    <option value="2">Todos los Centros</option>
                                                </select>
                                            </div>
                                            <div class="center-block" style=" max-width:370px;margin-bottom: 18px;margin-top: 16px;">
                                                <select id="filtercentros02" class="form-control">
                                                    <option value="Region">Ordenar por Región</option>
                                                    <option value="Barrio">Ordenar por ACS</option>
                                                    <option value="Area">Ordenar por Área</option>

                                                </select>
                                            </div>
                                        </ul>
                                    </span>
                                    <select class="selectpicker centro_filtro2 oculto"  data-live-search="true" id="centro_filtro02" multiple="multiple" name=""  data-actions-box="true" style="cursor:pointer; display:inline;" >
                                    </select>
                                    <!--<div class="dropdown" style=" float:left; margin-right:10px;">
                                     	<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Centros <i class="fa fa-caret-down" style="display:inline"></i></button>
                                        <ul id="dropdown" class="dropdown-menu" style="padding:15px; margin-top: 8px;">
                                            <div class="text-center">
                                                <h2  style=" display:inline;">Seleccionar Centros: </h2>
                                                <select id="filtercentrosoperando" class="form-control" style=" display:inline; width: 135px !important;">
                                                    <option value="1">Habilitados</option>
                                                    <option value="0">Deshabilitados</option>
                                                    <option value="2">Todos</option>
                                                </select>
                                            </div>
                                            <div class="center-block" style=" max-width:370px;margin-bottom: 18px;margin-top: 16px;">
                                                <select id="filtercentros" class="form-control">
                                                    <option value="Region">Ordenar por Región</option>
                                                    <option value="Barrio">Ordenar por ACS</option>
                                                    <option value="Area">Ordenar por Área</option>

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
                                        </ul>
                                    </div>-->
                                    <select  class="form-control" style="float: left; max-width:160px; margin-right:10px;cursor:pointer;"  id="especie_02" name="" data-actions-box="true" >

                                       <!-- <option value ="2">Especies Nocivas </option>
                                        <option value ="1">Especies Fiscalizadas</option>
                                        <option value ="0">Todas la Especies </option>-->
                                        <option value="2" nameTitle="Especies con nivel nocivo definido">Nivel Nocivo Definido</option>
                                        <!-- <option value="9">Nivel Nocivo [cel/ml]</option> -->
                                        <option value="3" nameTitle="Especies Nocivas">Especies Nocivas</option>
                                        <option value="1" nameTitle="Especies Fiscalizadas">Especies Fiscalizadas</option>
                                        <option value="4" nameTitle="Diatomeas">Diatomeas</option>
                                        <option value="5" nameTitle="Dinoflagelados">Dinoflagelados</option>
                                        <option value="6" nameTitle="Otras Especies">Otras Especies</option>
                                        <option class="label-danger" value="7" nameTitle="Especies con Alarma Crítico">Especies con Alarma Crítico</option>
                                        <option class="label-warning" value="8" nameTitle="Especies con Alarma Precaución">Especies con Alarma Precaución</option>
                                        <option class=" label-default" style="color: #fff !important;font-weight: bold;font-family: calibri" value="0" nameTitle="Todas las Especies">Todas las Especies</option>


                                    </select>
                                    <select id='prof_filtro2' class="form-control prof_filtro" style="float: left; max-width:95px; margin-right:10px;cursor:pointer;" name="" >
                                        	<!--<option value="1">Máxima</option>
                                            <option value="2">0.5 [m]</option>
                                            <option value="3">5 [m]</option>
                                            <option value="4">10 [m]</option>
                                            <option value="5">15 [m]</option>
                                            -->
                                        </select>
                                    <div class=" position-relative" style="position: relative!important; width:85px; float:left; margin-right:10px;">
                                          <input id="valor_condicion_02" type="number" value="5" min="0" step="1" class="form-control" style="padding-left:23px; padding-right:3px">
                                         <div class="unitinput" style="position: absolute;width: auto;bottom: 5px;left: 13px; margin-top: 0;">
                                             >
                                         </div>
                                    </div>
                                    <select  class="form-control" style="float: left; max-width:165px; margin-right:10px;cursor:pointer;"  id="condicion_02" >

                                        <option value ="1">% de su Nivel Nocivo</option>
                                        <option value ="2">[cel/ml]</option>


                                    </select>
                                    <!--<select class="selectpicker centro_filtro2 oculto"  data-live-search="true" id="centro_filtro02" multiple="multiple" name=""  data-actions-box="true" style="cursor:pointer;" >
                                    </select> -->

                                  	<div id="loading02" class="" style="display:inline;"><img src='loader.gif' /></div>
                                  	<button  type="button" id="boton02" style=" margin-left: 20px;"  onclick="boton02();"  class="btn btn-primary btn-sm no-print">Filtrar</button>
                              		<div class="row" style="display:inherit; margin-left:-10px;">
                                        <div class="input-group date"   id="datetimepicker_filtro1_02" style="width:135px; display: none;float: left;margin-right: 10px;margin-left: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_1_02" name ="fecha_filtro_1_02" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <div class="input-group date"   id="datetimepicker_filtro2_02" style="width:135px; display: none;float: left;margin-right:10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_2_02" name ="fecha_filtro_2_02" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div  style="padding: 0px 40px;">
                                    <div >

                                    	<div class="row" style="margin-bottom:-20px;">
                                            <div class="col-lg-10 col-md-7 col-xs-12">

                                                <h4 class="" align="center" id="" style="display: -webkit-inline-box;width:  100%; margin-bottom: 15px; margin-top:0px; text-align: -webkit-center;  font-size:14px; font-weight:normal;"><b>TABLA 1. </b> <div style="display:inline;" id="tabla2_condicion"></div></h4>
                                            </div>
                                            <div class="no-print " style="position: absolute;right: 158px;">
                                                <select id="verindicador" name="multipleselect_indicador_02" multiple="multiple">
                                                    <option value="3" selected="selected">Alarma Crítico</option>
                                                    <option value="2" selected="selected">Alarma Precaución</option>
                                                    <option value="1" selected="selected">Condición Filtro</option>
                                                </select>
                                           </div>

                                        </div>

                                        <table cellSpacing="0" data-toggle="table" data-show-columns="false"  data-search="false" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer sticky-header table_blue" data-sort-name="Barrio" data-sort-order="asc" id="resumenreporte" style="table-layout: fixed;">
                                            <thead>
                                                <tr>

                                                    <th data-field="Barrio" data-sortable="false" data-formatter="formatearBarrio" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false" >ACS</th>
                                                    <th data-field="Centro" data-sortable="false" data-formatter="formatearCentro" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false" >Centro</th>

                                                    <th data-formatter="runningFormatterarea" data-align= "center" data-valign = "middle" data-switchable="false" data-width = "30px">#</th>
                                                    <th data-field="Especie" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false" data-width = "105px">Especie</th>
                                                    <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" style="background-color:#035377 !important" data-width = "80px">Nivel Nocivo</th>

                                                    <!--<th data-field="Alarma_Rojo"  data-align= "center" data-valign = "middle" data-width = "105px" data-visible="false">Alarma Crítico<br /> [cel/ml]</th>
                                                    <th data-field="Alarma_Amarillo"  data-align= "center" data-valign = "middle" data-width = "105px" data-visible="false">Alarma Precaución<br /> [cel/ml]</th>-->

                                                </tr>
                                            </thead>

                                        </table>

                                    </div>
								</div>
                         	</div>
                             <!-- Obs    -->
                            <div id="saltoojoobs2"></div>
                            <div id="ojo2saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>
                            <div id="div_ojoobs2" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 15px 70px 15px 70px; width:100%">
                                <a title="Ocultar al imprimir" id="ojoobs2" onclick="ocultarobs2()" class ="no-print">
                                	<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>
                                </a>
                                <a title="Insertar salto página al imprimir" id="ojoobs2salto" onclick="ocultarobs2salto()" class ="no-print hidden">
                                    <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                                </a>

                                <textarea id="textojoobs2" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>
                                <div id="print_helper_textojoobs2" class="print_helper_class" style="text-align: justify;"></div>
                            </div>
                      	</div>
                	</div> <!-- seccion1 -->


            	</div>  <!-- div_ojoseccion1 -->




                <!-- Sección 2   -  Gráfico 1 y 2 -->

             	<div id="div_ojoseccion2">
                	<div id="saltoseccion2"  class="saltopagina"></div>
                	<div  id= "seccion2" class="row" style="margin-left:10px; margin-right:0px;top:0; padding: 0px 15px 15px 15px;">
                        <div id="encabezadoseccion2" class="encabezado">
                        </div>



                        <!-- Mapa 1 -->
                        <div class="row" id="div_ojo4">
                            <div id="graficosseccion4" style="margin-top:20px;">


                                <div class="row" style="margin-left:10px; margin-right:10px;">
                                	<a title="Ocultar al imprimir" id="ojo4" onclick="ocultar4()" class ="no-print"><i class="fa fa-eye" style=" font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>
                                    <div class="text-center">
                                        <h3 style="font-size: 18px !important;"> MAPAS</h3>
                                    </div>
                                    <hr style="margin-top:40px; ">
                                    <div class="" style="width: 100%; float: left; margin-top: 15px; margin-left:50px;">
                                        <select id="tipomapa" class="form-control" style="float: left; max-width:125px;margin-right: 10px;margin-left: 15px;">
                                        	<option value ="0" title="Mapa colaborativo última semana">Colaborativo </option>
                                            <option value ="1">Mapa Interno </option>
                                        </select>
                                        <div class="input-group date classinterno hidden no-print"   id="datetimepicker_filtro4_1" style="width:135px;float: left;margin-right: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_4_1" name ="fecha_filtro_4_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <select id="nromedicionresumen" class="form-control no-print" style="float: left; max-width:160px; margin-right:10px;">
                                        </select>
                                        <select id="especiesselectmap" name="multipleselectsearch no-print" class="form-control" style="float: left; max-width:160px; margin-right:10px;">
                                        </select>
                                        <select id="nombreswitch" class="form-control classinterno hidden no-print" style="float: left; max-width:160px; margin-right:10px;">
                                        	<option value ="1">Mostrar Nombres </option>
                                            <option value ="0">Ocultar Nombres </option>
                                        </select>
                                        <select id="acsselectmap" name="multipleselectsearch" class="form-control no-print" style="float: left; max-width:100px; margin-right:10px;">
                                        </select>
                                        <select id="zoomselectmap" name="multipleselectsearch" class="form-control no-print" style="float: left; max-width:100px; margin-right:10px;">
                                        	<option value ="5">Zoom 1 </option>
                                            <option value ="6"  selected="selected">Zoom 2 </option>
                                            <option value ="7">Zoom 3 </option>
                                            <option value ="8">Zoom 4 </option>
                                            <option value ="9">Zoom 5 </option>
                                            <option value ="10">Zoom 6 </option>
                                            <option value ="11">Zoom 7 </option>
                                        </select>
                                        <!--<div class="input-group date"   id="datetimepicker_filtro2_1" style="width:135px; display: none;float: left;margin-right:10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_2_1" name ="fecha_filtro_2_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>-->

                                        <div id="loading3" class="no-print" style="display:inline;"><img src='loader.gif' /></div>
                                        <button  type="button" id="boton4" style=" margin-left: 20px;"  onclick="boton4();"  class="btn btn-primary btn-sm no-print">Filtrar</button>


                                    </div>

                                </div>
                        		<div class="hidden">
                                    <table cellSpacing="0" data-toggle="table" data-show-columns="false"  data-search="true" data-show-export="false" data-export-types="['excel']" data-export-options='{"fileName": "GTR fan"}' data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer" data-sort-name="Centro" id="resumenreporte2" >
                                        <thead>
                                            <tr>


                                                <th data-field="Centro" data-align= "left" data-halign="center" data-valign = "middle" data-switchable="false" data-width = "35px">Centro</th>
                                                <th data-field="Area" data-align= "left" data-halign="center" data-valign = "middle" data-width = "35px">Área</th>
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

                                <div  class="graficos1e" style="padding: 0px 85px; margin-top: 15px;">
                                    <div class="row">
                                    	<div class="col-lg-3 col-md-3 col-xs-3" style="padding: 10px 5px 0px 5px; padding-top:0px;">
                                        	<div class="text-center map_label" id="map1_label"></div>
                                            <div id="map1" class="map"></div>
                                      	</div>
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding: 10px 5px 0px 5px; padding-top:0px;">
                                        	<div class="text-center map_label" id="map2_label"></div>
                                            <div id="map2" class="map"></div>
                                      	</div>
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding: 10px 5px 0px 5px; padding-top:0px;">
                                        	<div class="text-center map_label" id="map3_label"></div>
                                            <div id="map3" class="map"></div>
                                      	</div>
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding: 10px 5px 0px 5px; padding-top:0px;">
                                        	<div class="text-center map_label" id="map4_label"></div>
                                            <div id="map4" class="map"></div>
                                      	</div>
                                    </div>
                                    <div class="row" style="margin-top:20px;">
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding: 10px 5px 0px 5px; padding-top:0px;">
                                        	<div class="text-center map_label" id="map5_label"></div>
                                            <div id="map5" class="map"></div>
                                      	</div>
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding: 10px 5px 0px 5px; padding-top:0px;">
                                        	<div class="text-center map_label" id="map6_label"></div>
                                            <div id="map6" class="map"></div>
                                      	</div>
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding:  10px 5px 0px 5px;  padding-top:0px;">
                                        	<div class="text-center map_label" id="map7_label"></div>
                                            <div id="map7" class="map"></div>
                                      	</div>
                                        <div class="col-lg-3 col-md-3 col-xs-3" style="padding:  10px 5px 0px 5px;  padding-top:0px;">
                                        	<div class="ubicacion" style=" padding:65px 50px;"><!--border: 1px solid #999; border-radius:5%;background-color: #ddd !important; opacity: 0.90;-->
                                                <div class=" indicador indicadoractivorojo ubicacion" style="animation:none !important; margin-right:20px; background:red !important;"></div>
                                                <b style="margin-left:30px; margin-bottom:0px; display: block;"> Nivel Crítico </b><br>
                                                <div class=" indicador indicadoractivoamarillo ubicacion" style="animation:none !important; background:#FF0 !important;"></div><b style="margin-left:30px; margin-bottom:0px; display: block;"> Precaución </b><br>
                                                <div class=" indicador indicadoractivogris ubicacion" style="background:#C0C0C0 !important;"></div> <b style="margin-left:30px; margin-bottom:0px; display: block;"> Presencia Microalga </b><br>
                                                <div class=" indicador indicadoractivoverde ubicacion" style="background:green !important;"></div> <b style="margin-left:30px;"> Ausencia Microalga </b><br>
                                            </div>
                                     	</div>
                                    </div>

                                </div>
                            </div>
                             <!-- Obs    -->
                            <div id="saltoojoobs6"></div>
                            <div id="ojo1saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>
                            <div id="div_ojoobs6" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 5px 72px 15px 70px; width:100%">
                                <a title="Ocultar al imprimir" id="ojoobs6" onclick="ocultarobs6()" class ="no-print">
                                	<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>
                                </a>
                                <a title="Insertar salto página al imprimir" id="ojoobs6salto" onclick="ocultarobs6salto()" class ="no-print hidden">
                                    <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                                </a>

                                <textarea id="textojoobs6" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>
                                <div id="print_helper_textojoobs6" class="print_helper_class" style="text-align: justify;"></div>
                            </div>
                        </div>







                     	<!-- Gráfico 1 -->
                        <div class="row" id="div_ojo1">
                            <div id="graficosseccion1" style="margin-top:20px;">


                                <div class="row" style="margin-left:10px; margin-right:10px;">
                                	<a title="Ocultar al imprimir" id="ojo1" onclick="ocultar1()" class ="no-print"><i class="fa fa-eye" style=" font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>
                                    <div class="text-center">
                                        <h3 style="font-size: 18px !important;"> TENDENCIA</h3>
                                    </div>
                                    <hr style="margin-top:40px; ">
                                    <div style="width: 80%; float: left; margin-top: 15px; margin-left:50px;">
                                        <select  class="form-control" style="float: left; max-width:140px; margin-right:10px;cursor:pointer;"  id="region_filtro1" name="region_filtro1" onChange="myFunction()" data-actions-box="true" >

                                            <option value ="1">Última Semana </option>
                                            <option value ="2">Último Mes </option>
                                            <option value ="0">Desde - Hasta </option>

                                        </select>
                                        <div class="input-group date"   id="datetimepicker_filtro1_1" style="width:135px; display: none;float: left;margin-right: 10px;margin-left: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_1_1" name ="fecha_filtro_1_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <div class="input-group date"   id="datetimepicker_filtro2_1" style="width:135px; display: none;float: left;margin-right:10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_2_1" name ="fecha_filtro_2_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <select id='especie_filtro1' class="especie_filtro" name="multipleselect_tendencia" multiple  style=" margin-left:10px;cursor:pointer;" >
                                        </select>
                                        <div id="loading1" class="" style="display:inline;"><img src='loader.gif' /></div>
                                        <!--<select class="selectpicker  oculto"  data-live-search="true" id="centro_filtro1" name="autoridad_filtro[]" multiple data-actions-box="true">
                                        </select>-->

                                        <button  type="button" id="boton1" style=" margin-left: 20px;"  onclick="boton1();"  class="btn btn-primary btn-sm no-print">Filtrar</button>

                                    </div>

                                </div>




                                <div  class="graficos1e" style="margin-left: 1%;margin-right:  1%;     margin-bottom: 290px;">
                                    <div class="col-lg-11 col-md-11 col-xs-11" style="padding: 20px 20px 0px 20px; padding-top:0px; width:100%">
                                        <div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 col-xs-3 col-xs-offset-9" style="padding-left:40px;">
                                        	<a id="download2" download="Tendencia.jpg"  href="" class="btn btn-default bg-flat-color-1" title="Descargar Gráfico como Imágen" style="margin-right:5px;">
                                                <i class="fa fa-download"></i>
                                            </a>
                                            <select id="centro_select_filtro1" class="pull-right form-control no-print" style="margin-right:75px; display:"  data-live-search="true"  name="" multiple="multiple" data-actions-box="true" style="cursor:pointer;" >
                                            </select>

                                        </div>

                                        	<!--<button id="toggle1" type="button" class="pull-right btn btn-default btn-sm no-print" style="margin-right:75px; " onclick="selectall1(0)" >Select all</button>-->

                                        <canvas class="resize" id="chart-line1" height="120"></canvas>

                                    </div>

                                </div>
                            </div>
                             <!-- Obs    -->
                            <div id="saltoojoobs3"></div>
                            <div id="ojo1saltoheader" class="si-print" style="display:none; padding-top:20px; "></div>
                            <div id="div_ojoobs3" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 0px 70px 15px 70px; width:100%">
                                <a title="Ocultar al imprimir" id="ojoobs3" onclick="ocultarobs3()" class ="no-print">
                                	<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>
                                </a>
                                <a title="Insertar salto página al imprimir" id="ojoobs3salto" onclick="ocultarobs3salto()" class ="no-print hidden">
                                    <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                                </a>

                                <textarea id="textojoobs3" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>
                                <div id="print_helper_textojoobs3" class="print_helper_class" style="text-align: justify;"></div>
                            </div>
                        </div>

                	</div> <!-- seccion2 -->

            	</div>  <!-- div_ojoseccion2 -->




                <!-- Sección 3   -  Gráfico 3 -->
                <div id="saltoseccion3"  class="saltopagina"></div>
             	<div id="div_ojoseccion3">
                	<div  id="seccion3" class="row" style="margin-left:10px; margin-right:0px;top:0; padding: 0px 15px 15px 15px;">
                        <div id="encabezadoseccion3" class="encabezado">
                        </div>

                        <!-- Gráfico 2 -->
                        <div class="row" id="div_ojo2">
                            <div id="graficosseccion2" style="margin-top:40px;">


                                <div class="row" style="margin-left:10px; margin-right:10px;">
                                	<a title="Ocultar al imprimir" id="ojo2" onclick="ocultar2()" class ="no-print"><i class="fa fa-eye" style=" font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>
                                    <div class="text-center">
                                        <h3 style="font-size: 18px !important;"> RESUMEN POR PROFUNDIDAD</h3>
                                    </div>
                                    <hr style="margin-top:40px; ">
                                    <div style="width: 60%; float: left; margin-top: 15px;margin-left:50px;">
                                        <div class="input-group date"   id="datetimepicker_filtro1_2" style="width:135px;float: left;margin-right: 10px;margin-left: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_1_2" name ="fecha_filtro_1_2" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>

                                        <select id='especie_filtro2' class="especie_filtro si-print" name="multipleselect_usuario"  style=" margin-left:10px;cursor:pointer;" >
                                        </select>
                                        <div id="loading2" class="" style="display:inline;"><img src='loader.gif' /></div>
                                        <!--<select class="selectpicker  oculto"  data-live-search="true" id="centro_filtro1" name="autoridad_filtro[]" multiple data-actions-box="true">
                                        </select>-->

                                        <button  type="button" id="boton2" style=" margin-left: 20px;"  onclick="boton2();"  class="btn btn-primary btn-sm no-print">Filtrar</button>

                                    </div>

                                </div>




                                <div  class="graficos1e" style="margin-left: 1%;margin-right:  1%;     margin-bottom: 290px;">
                                    <div class="col-lg-11 col-md-11 col-xs-11" style="padding: 20px; padding-top:0px; width:100%">
                                        <div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 col-xs-3 col-xs-offset-9" style="padding-left:40px;">
                                        	<a id="download4" download="Resumen por Profundidad.jpg"  href="" class="btn btn-default bg-flat-color-1" title="Descargar Gráfico como Imágen" style="margin-right:5px;">
                                                <i class="fa fa-download"></i>
                                            </a>
                                            <select id="centro_select_filtro2" class="pull-right form-control no-print" style="margin-right:75px; display:"  data-live-search="true"  name="" multiple="multiple" data-actions-box="true" style="cursor:pointer;" >
                                            </select>
                                      	</div>

                                        <canvas class="resize" id="chart-line2" height="120"></canvas>
                                    </div>

                                </div>
                            </div>
                            <!-- Obs    -->
                            <div id="saltoojoobs4"></div>
                            <div id="ojo1saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>
                            <div id="div_ojoobs4" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 0px 70px 15px 70px; width:100%">
                                <a title="Ocultar al imprimir" id="ojoobs4" onclick="ocultarobs4()" class ="no-print">
                                	<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>
                                </a>
                                <a title="Insertar salto página al imprimir" id="ojoobs4salto" onclick="ocultarobs4salto()" class ="no-print hidden">
                                    <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                                </a>

                                <textarea id="textojoobs4" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>
                                <div id="print_helper_textojoobs4" class="print_helper_class" style="text-align: justify;"></div>
                            </div>
                		</div>


                        <div class="row" id="div_ojo3">
                            <div id="graficosseccion3" style="margin-top:20px;">


                                <div class="row" style="margin-left:10px; margin-right:10px;">
                                    <a title="Ocultar al imprimir" id="ojo3" onclick="ocultar3()" class ="no-print"><i class="fa fa-eye" style=" font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>

                                    <div class="text-center">
                                        <h3 style="font-size: 18px !important;"> DETALLE POR CENTRO</h3>
                                    </div>
                                    <hr style="margin-top:40px; ">
                                    <div style="width: 99%; float: left; margin-top: 15px;margin-left:40px;">
                                        <select  class="form-control" style="float: left; max-width:140px; margin-right:10px;cursor:pointer;"  id="region_filtro3" name="region_filtro3" onChange="myFunction3()" data-actions-box="true" >

                                            <option value ="1">Última Semana </option>
                                            <option value ="2">Último Mes </option>
                                            <option value ="0">Desde - Hasta </option>

                                        </select>
                                        <div class="input-group date"   id="datetimepicker_filtro1_3" style="width:135px; display: none;float: left;margin-right: 10px;margin-left: 10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_1_3" name ="fecha_filtro_1_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <div class="input-group date"   id="datetimepicker_filtro2_3" style="width:135px; display: none;float: left;margin-right:10px;">
                                            <input class="form-control" type="text" id="fecha_filtro_2_3" name ="fecha_filtro_2_1" value="" >
                                            <div class="input-group-addon">
                                                <span class="glyphicon-calendar glyphicon"></span>
                                            </div>
                                        </div>
                                        <select id='especie_filtro3' class="form-control no-print" style="float: left; max-width:180px; margin-right:10px;cursor:pointer;" name=""  >
                                            <option value="2">Nivel Nocivo [%]</option>
                                            <option value="9">Nivel Nocivo [cel/ml]</option>
                                            <option value="3">Nocivas [cel/ml]</option>
                                            <option value="1">Fiscalizadas [cel/ml]</option>
                                            <option value="4">Diatomeas</option>
                                            <option value="5">Dinoflagelados</option>
                                            <option value="6">Otras Especies</option>
                                            <option class="label-danger" value="7">Con Alarma Crítico</option>
                                            <option class="label-warning" value="8">Con Alarma Precaución</option>
                                            <option class="label-info" value="10">Crítico y Precaución</option>
                                            <option class=" label-default" style="color: #fff !important;font-weight: bold;font-family: calibri" value="0">Todas [cel/ml]</option>
                                        </select>

                                        <select id='pamb_filtro3' class="form-control" style="float: left; max-width:170px; margin-right:10px;cursor:pointer;" multiple="multiple" name="select_pamb" >
                                            <option value="Temperatura [ºC]">Temperatura [ºC]</option>
                                            <option value="Salinidad">Salinidad</option>
                                            <option value="Oxigeno Disuelto [%]">Oxigeno Disuelto [%]</option>
                                            <option value="Oxigeno Disuelto [mg/l]">Oxigeno Disuelto [mg/l]</option>
                                            <option value="Disco Secchi [m]">Disco Secchi [m]</option>

                                            <!--<option value="todo">Todo</option></select>-->
                                        </select>
                                        <select id='prof_filtro3' class="form-control prof_filtro" style="float: left; max-width:95px; margin-right:10px;cursor:pointer;" name="" >
                                        	<!--<option value="1">Máxima</option>
                                            <option value="2">0.5 [m]</option>
                                            <option value="3">5 [m]</option>
                                            <option value="4">10 [m]</option>
                                            <option value="5">15 [m]</option>
                                            -->
                                        </select>
                                        <select class="selectpicker centro_filtro oculto"  data-live-search="true" id="centro_filtro3" name=""  data-actions-box="true" style="cursor:pointer;" >
                                        </select>

                                        <button  type="button" id="boton3" style=" margin-left: 20px;"  onclick="boton3();"  class="btn btn-primary btn-sm no-print">Filtrar</button>

                                    </div>

                                </div>




                                <div  class="graficos1e" style="margin-left: 1%;margin-right:  1%;     margin-bottom: 290px;">
                                    <div  class="col-lg-11 col-md-11 col-xs-11" style="padding: 20px; padding-top:0px; width:100%">
                                        <!--a title="Ocultar al imprimir" href="javascript:void(0);" id="ojo3" onclick="ocultar3()" class ="no-print"><i class="fa fa-eye" style="display:none; font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a-->
                                        	<div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 col-xs-3 col-xs-offset-9" style="padding-left:40px;">
                                                <a id="download3" download="Detalle Centro.jpg"  href="" class="btn btn-default bg-flat-color-1" title="Descargar Gráfico como Imágen" style="margin-right:5px;">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <select id="especie_select_filtro3" class="pull-right form-control no-print" style="margin-right:75px; display:"  data-live-search="true"  name="" multiple="multiple" data-actions-box="true" style="cursor:pointer;" >
                                                </select>
                                            </div>
                                            <!--<button id="toggle3" type="button" class="pull-right btn btn-default btn-sm no-print" style="margin-right:75px;" onclick="selectall(0)" >Select all</button>-->

                                        <canvas class="resize" id="chart-line3" height="100"></canvas>
                                    </div>

                                </div>
                            </div>
                            <!-- Obs    -->
                            <div id="saltoojoobs5"></div>
                            <div id="ojo1saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>
                            <div id="div_ojoobs5" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 0px 70px 15px 70px; width:100%">
                                <a title="Ocultar al imprimir" id="ojoobs5" onclick="ocultarobs5()" class ="no-print">
                                	<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>
                                </a>
                                <a title="Insertar salto página al imprimir" id="ojoobs5salto" onclick="ocultarobs5salto()" class ="no-print hidden">
                                    <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                                </a>

                                <textarea id="textojoobs5" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>
                                <div id="print_helper_textojoobs5" class="print_helper_class" style="text-align: justify;"></div>
                            </div>
                		</div>

                        <div id="nuevos_gradicos3">
                        </div>

                        <button id="btn-nuevo-grafico3" type="submit" class="btn btn-cerrada"><i class="fa fa-plus-circle"> </i>  Agregar Nuevo Gráfico</button>

                        <!-- Seccion comentarios    -->
                        <div id="saltoojo5"></div>
                        <div id="ojo5saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>
                        <div id="div_ojo5" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 20px; width:100%">

                            <!--<hr id="saltoojo5hr"/>-->
                            <div class="text-center" style="margin-top:40px; ">
                                <h3 style="font-size: 18px !important;"> COMENTARIOS</h3>
                            </div>
                            <hr style="margin-top:40px; ">
                            <a title="Ocultar al imprimir" href="javascript:void(0);" id="ojo5" onclick="ocultar5()" class ="no-print"><i class="fa fa-eye-slash" style="font-size:30px;color:indianred;float: right;margin-bottom: 15px;"></i></a>
                            <a title="Insertar salto página al imprimir" href="javascript:void(0);" id="ojo5salto" onclick="ocultar5salto()" class ="no-print">
                                <!--<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>-->
                                <img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />
                            </a>

                            <textarea id="textojo5" style="resize:none" class="form-control textojoobs " rows="2" cols="150" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>

                        </div>

                        <div id="footerprint" class="modal-footer text-center" style="margin-top: 20px;" >
                            <div class="text-center" style="font-size:12px; margin-top:5px; margin-bottom: -15px;margin-left:110px;margin-right:75px;">
                                Atentamente<br/><br/>
                                <img src="" class="text-center logoempresa" style="" /> <br/><br/>
                                <div class="nombreusuario" style="display: inline;"><b><?php echo $nombre; ?></b></div> <br/>
                            </div>

                        </div>




            	</div> <!-- seccion3 -->

            </div>  <!-- div_ojoseccion3 -->



   		</div> <!-- Termina el Imprimible -->




    </div>
</div>
@endsection

@section('javascript')



    <script>

	var user_id = <?php echo $currentUser->id; ?>;
	var id_empresa = <?php echo $currentUser->IDempresa; ?>;
	//roles(<?php echo '"'.$currentUser->role.'"';?>);


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

    $(function() {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });







var opt = [];
var distribucion = "";
var distribucion_desc = "";
$( document ).ready(function() {


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
					$( '.prof_filtro').empty();
					$('.prof_filtro').append($('<option>', {
							value: 1,
							text : "Máxima"
					}));
					$.each(opt, function (i, item) {
						$('.prof_filtro').append($('<option>', {
							value: (i+2),
							text : opt[i]
						}));
					});

				}
				dashboard(1);
				loadcentros();

			}
	});

	$.ajax({
				url: "load_distribucion_informe.php",
				type: 'post',
				dataType: 'json',
				data: {
					user_id:	user_id
				},
				success: function(dato)
				{

					if(dato != ""){
						distribucion = dato;
						loadselectcentros01();
						loadselectcentros02();


					}
				},error: function(err){
					console.log(err);
				}
		});




});

/*---------------------------------------------------------------------------------------------------------------------------------*/
/*-----------------------------------dashboard--------------------------------------------------------------------------------------*/

	function dashboard(init){
		$.ajax({
			url: "load_dashboard.php",
			type: 'post',
			dataType: 'json',
			data: {
				user_id: user_id,
			},
			success: function(datos)
			{
				var centros_rojo = " Críticos";
				var centros_ama = " Precaución";
				if(datos['Critico'].length == 1){
					centros_rojo = " Crítico";
				}/*
				if(datos['Precaucion'].length == 1){
					centros_ama = " Precaución";
				}*/

				var title_rojo = "";
				 $(datos['Critico']).each(function(index, element) {
                    title_rojo = title_rojo + ", " + element['Nombre'] + " (" + element['Dia'] + ")";
                });
				if(title_rojo==""){
					title_rojo = "HHoy no hay centros con alarma crítico";
				}else{$('#indicador_rojo').css("animation", "");}

				var title_rojo_sem = "";
				 $(datos['Critico_semana']).each(function(index, element) {
                    title_rojo_sem = title_rojo_sem + ", " + element['Nombre'] + " (" + element['Dia'] + ")";
                });
				var title_amarillo = "";
				 $(datos['Precaucion']).each(function(index, element) {
                    title_amarillo = title_amarillo + ", " + element['Nombre'] + " (" + element['Dia'] + ")";
                });
				if(title_amarillo==""){
					title_amarillo = "HHoy no hay centros con alarma precaución";
				}else{$('#indicador_amarillo').css("animation", "");}
				var title_ama_sem = "";
				 $(datos['Precaucion_semana']).each(function(index, element) {
                    title_ama_sem = title_ama_sem + ", " + element['Nombre'] + " (" + element['Dia'] + ")";
                });
				$('#cant_rojo').text(datos['Critico'].length + centros_rojo);
				$('#cant_rojo').attr("title",title_rojo.substring(1));
				$('#cant_rojo_sem').html('<i  class="green">'+datos['Critico_semana'].length+' </i>  en la semana');
				$('#cant_rojo_sem').attr("title",title_rojo_sem.substring(1));
				$('#cant_amarillo').text(datos['Precaucion'].length + centros_ama);
				$('#cant_amarillo').attr("title",title_amarillo.substring(1));
				$('#cant_amarillo_sem').html('<i class="green"> '+datos['Precaucion_semana'].length+' </i> en la semana' );
				$('#cant_amarillo_sem').attr("title",title_ama_sem.substring(1));

				//Mortalidad
				var centros_mort = " Mortalidad";
				/*if(datos['Mortalidad'].length == 1){
					centros_mort = " Mortalidad";
				}*/
				var title_mort = "";
				 $(datos['Mortalidad']).each(function(index, element) {
                    title_mort = title_mort + ", " + element['Nombre'] + " (" + element['Dia'] + ")";
                });
				if(title_mort==""){title_mort = "HHoy no hay centros con mortalidad";}
				var title_mort_sem = "";
				 $(datos['Mortalidad_semana']).each(function(index, element) {
                    title_mort_sem = title_mort_sem + ", " + element['Nombre'] + " (" + element['Dia'] + ")";
                });

				$('#cant_mortalidad').text(datos['Mortalidad'].length + centros_mort);
				$('#cant_mortalidad').attr("title",title_mort.substring(1));
				$('#cant_mortalidad_sem').html('<i  class="green" >'+datos['Mortalidad_semana'].length+'</i> en la semana');
				$('#cant_mortalidad_sem').attr("title",title_mort_sem.substring(1));

				//Especie 1
				$('#especie').html('<i class="glyphicon glyphicon-tree-deciduous"></i> '+datos['Especie'][0]['Especie']);
				$('#idespecie').val(datos['Especie'][0]['IDespecie']);
				$('#nivel_especie').text(datos['Especie'][0]['Nivel']);

				var auxclass = "red";
				var nonivel = Math.abs(datos['Especie'][0]['Nivel_Nocivo_Porcentaje'])+"% </i> en centro";
				//var auxclass_sort = "fa-sort-asc";
				//var bajo = "sobre ";
				if(datos['Especie'][0]['Nivel_Nocivo_Porcentaje'] == "" ){
					var nonivel = "</i> Centro ";
				}else if(datos['Especie'][0]['Nivel_Nocivo_Porcentaje']<100){
					auxclass = "green";
					//auxclass_sort = "fa-sort-desc";
					//bajo = "bajo ";

				}

				$('#texto_especie').html('<i class="'+auxclass+'">'+nonivel+' <b>'+datos['Especie'][0]['Centro']+'</b>');
				$('#idcentroespecie').val(datos['Especie'][0]['IDcentro']);
				if(datos['Especie'][0]['Nivel_Nocivo_Porcentaje'] != ""){
					$('#texto_especie').attr("title",Math.abs(datos['Especie'][0]['Nivel_Nocivo_Porcentaje'])+"% del nivel nocivo de "+datos['Especie'][0]['Nivel_Nocivo'] + " [cel/ml]" );
				}


				//Especie 2
				/*$('#especie2').html('<i class="glyphicon glyphicon-tree-deciduous"></i> '+datos['Especie'][1]['Especie']);
				$('#nivel_especie2').text(datos['Especie'][1]['Nivel']);

				var auxclass = "red";
				var nonivel = Math.abs(datos['Especie'][1]['Nivel_Nocivo_Porcentaje'])+"% </i> en centro";
				//var auxclass_sort = "fa-sort-asc";
				//var bajo = "sobre ";
				if(datos['Especie'][1]['Nivel_Nocivo_Porcentaje'] == ""){
					var nonivel = " </i> Centro ";
				}else if(datos['Especie'][1]['Nivel_Nocivo_Porcentaje']<100){
					auxclass = "green";
					//auxclass_sort = "fa-sort-desc";
					//bajo = "bajo ";

				}
				$('#texto_especie2').html('<i class="'+auxclass+'">'+nonivel+' <b>'+datos['Especie'][1]['Centro']+'</b>');
				if(datos['Especie'][1]['Nivel_Nocivo_Porcentaje'] != ""){
					$('#texto_especie2').attr("title",Math.abs(datos['Especie'][1]['Nivel_Nocivo_Porcentaje'])+"% del nivel nocivo de "+datos['Especie'][1]['Nivel_Nocivo'] + " [cel/ml]" );
				}*/

				//Ingreso Registro semana
				var cantsemana = [];
				var cantsemanacentros = [];
				var nomidieron = "";
				var simidieron = [];
				var promedioingreso = 0;
				for(var d=0;d<datos['Fecha_Semana'].length; d++){
					var n = 0;
					simidieron = [];
					for(var c=0;c<datos['Ingreso_Semana'].length; c++){

						if(datos['Fecha_Semana'][d] == datos['Ingreso_Semana'][c]['Fecha']){
							n++;
							//quitar el promedio del día actual
							if(datos['Fecha_Semana'][d] != datos['Fecha_Semana'][datos['Fecha_Semana'].length-1]){
								promedioingreso++;
							}
							simidieron.push(datos['Ingreso_Semana'][c]['Nombre']);
						}

					}

					//Busca los centros que no ingresaron registros
					nomidieron = "";
					nomidieron = $(datos['Nombre_Centros']).not(simidieron).get();
					cantsemana.push(n);
					cantsemanacentros.push(nomidieron.join(", "));  //.slice(0, -1)
				}


				var cant_ing = datos['Ingreso'].split("/");
				$('.inlinesparkline').sparkline(cantsemana, {
					tooltipSuffix: ' Centros',
					normalRangeMin: parseInt(cant_ing[1])*0.97,
					normalRangeMax: parseInt(cant_ing[1]),
					chartRangeMin: 0,
					//normalRangeColor: '#73879C',
					type: 'line',
					width: '150px',
					height: '38px',
					lineColor: '#1abb9c',
    				fillColor: '#e0e0e0',
					lineWidth: 2});

				$('.inlinesparkline').bind('sparklineRegionChange', function(ev) {
					var sparkline = ev.sparklines[0],
						region = sparkline.getCurrentRegionFields(),
						value = region.y;
					var textnoingreso = '';
					if(cantsemanacentros[region.x] != ""){
						textnoingreso =" | No ingresó registros: "+cantsemanacentros[region.x];
					}
					$('#titleingresosemana').prop('title', datos['Fecha_Semana'][region.x]+textnoingreso);//.text("x="+region.x+" y="+region.y);
				}).bind('mouseleave', function() {
					$('#titleingresosemana').prop('title', "");
				});

				promedioingreso = promedioingreso/(datos['Fecha_Semana'].length-1);

				$('#texto_especie2').html('<i class="green">'+promedioingreso.toFixed(0)+'</i> centros promedio de '+cant_ing[1]);


				//Ingreso Registros
				var textnoingresohoy = '';
					if(datos['No_ingreso'] != ""){
						textnoingresohoy ="No han ingresado registros: "+datos['No_ingreso'];
					}
				$('#cant_ingreso').attr("title",textnoingresohoy);

				//$('#gauge-text').text(parseInt(cant_ing[0]));
				$('#goal-text').text(cant_ing[1]);

				var opts = {
				  angle: 0, // The span of the gauge arc
				  lineWidth: 0.35, // The line thickness
				  radiusScale: 1, // Relative radius
				  pointer: {
					length: 0.6, // // Relative to gauge radius
					strokeWidth: 0.035, // The thickness
					color: '#000000' // Fill color
				  },
				  limitMax: false,     // If false, max value increases automatically if value > maxValue
				  limitMin: false,     // If true, the min value of the gauge will be fixed
				  colorStart: '#6FADCF',   // Colors
				  colorStop: '#1abc9c',    // just experiment with them
				  strokeColor: '#E0E0E0',  // to see which ones work best for you
				  generateGradient: true,
				  highDpiSupport: true,     // High resolution support

				};
				var target = document.getElementById('chart_gauge_01'); // your canvas element
				var gauge = new Gauge(target).setOptions(opts); // create sexy gauge!
				gauge.maxValue = parseInt(cant_ing[1]); // set max gauge value
				gauge.setMinValue(0);  // Prefer setter over gauge.minValue = 0
				gauge.animationSpeed = 32; // set animation speed (32 is default value)
				if(parseInt(cant_ing[0]) == 0){
					gauge.set(0.1);
				}else{gauge.set(parseInt(cant_ing[0]));}
				gauge.setTextField(document.getElementById("gauge-text"));

				var d = new Date();
				function addZero(i) {
					if (i < 10) {
						i = "0" + i;
					}
					return i;
				}

				 $('#cant_ingreso_hora').text("  " + addZero(d.getHours())+ ":" + addZero(d.getMinutes()) + " hrs.");

				 if(init == 1){
				 	loadespecies();
				 }

			},
			error: function(result) {
				//console.log(result);



			}
		});


	}

$('#refreshdashboard').click( function(){
	dashboard(0);
});



/*---------------------------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------INGRESO REGISTRO--------------------------------------------------------------------------*/
	var date1 = new Date();
	date1.setDate(date1.getDate()-6);
	$('#datetimepicker_filtro1_01').datetimepicker({
				locale: 'es',
				defaultDate: date1,
				format: 'DD-MM-YYYY',

	});

	var date2 = new Date();
	date2.setDate(date2.getDate());
	$('#datetimepicker_filtro2_01').datetimepicker({
				locale: 'es',
				defaultDate: date2,
				format: 'DD-MM-YYYY',
			useCurrent: false //Important! See issu
	});

	function myFunction01() {
		var x = document.getElementById("region_filtro01").value;

		if(x == 0){
			$("#datetimepicker_filtro1_01").show();
			$("#datetimepicker_filtro2_01").show();

		}else{
			$("#datetimepicker_filtro1_01").hide();
			$("#datetimepicker_filtro2_01").hide();
			if(x==1){
				//desde
				var date1 = new Date();
				date1.setDate(date1.getDate()-6);
				$('#datetimepicker_filtro1_01').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_01').data("DateTimePicker").date(date2);
			}else{
				var date1 = new Date();
				date1.setDate(date1.getDate()-29);
				$('#datetimepicker_filtro1_01').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_01').data("DateTimePicker").date(date2);

			}
		}

	}

	///////////////////
/////Tabla 4/////
//////////////////


function runningFormatter1(value, row, index) {
	if(row["ID_1"] != "-"){
		var Ingresos = graficar01_msg['Ingresos'];
		var tareas_total = graficar01_msg['Cantidad_Dias'];
		var tareas_resueltas = 0;
		$.each(Ingresos, function( i, val ) {
			if(row["ID_1"] == val['IDcentro']){
				tareas_resueltas = val['Cantidad'];
				return false;
			}
		});
		//var tareas_total = 20;//row["total_tareas"];
		//var tareas_resueltas = 12;//row["tareas_resueltas"];
		var porcentaje = 0;

		tiene_tareas = false;
		if(tareas_total != 0){
			porcentaje = Math.round( (tareas_resueltas/tareas_total)*100);
			tiene_tareas = true;
		}else{
			porcentaje = 0;
		}

		var texto_barra="";

		if(!tiene_tareas){
			texto_barra="";
			return [
			'<span class="text-muted small"><em id="">'+texto_barra+'</em></span>',
			].join('');
		}else{
			texto_barra=porcentaje+"%"; //"Ingresos";
			return [
			'<div style=" margin-top:0px;"><span class="pull-left text-muted">'+texto_barra+'</span><span class="pull-right text-muted small"><em id="">'+tareas_resueltas+' de '+tareas_total+' días</em></span><br>',
				'<div class="progress progress_sm ">',
					'<div class="progress-bar bg-green " role="progressbar"  data-transitiongoal="'+porcentaje+'" >',
					'</div>',
				'</div>',
			'</div>'].join('');
		}
	}else{ return "";}
}


function runningFormatter2(value, row, index) {
	if(row["ID_2"] != "-"){
		var Ingresos = graficar01_msg['Ingresos'];
		var tareas_total = graficar01_msg['Cantidad_Dias'];
		var tareas_resueltas = 0;
		$.each(Ingresos, function( i, val ) {
			if(row["ID_2"] == val['IDcentro']){
				tareas_resueltas = val['Cantidad'];
				return false;
			}
		});
		//var tareas_total = 20;//row["total_tareas"];
		//var tareas_resueltas = 12;//row["tareas_resueltas"];
		var porcentaje = 0;

		tiene_tareas = false;
		if(tareas_total != 0){
			porcentaje = Math.round( (tareas_resueltas/tareas_total)*100);
			tiene_tareas = true;
		}else{
			porcentaje = 0;
		}

		var texto_barra="";

		if(!tiene_tareas){
			texto_barra="";
			return [
			'<span class="text-muted small"><em id="">'+texto_barra+'</em></span>',
			].join('');
		}else{
			texto_barra=porcentaje+"%"; //"Ingresos";
			return [
			'<div style=" margin-top:5px;"><span class="pull-left text-muted">'+texto_barra+'</span><span class="pull-right text-muted small"><em id="">'+tareas_resueltas+' de '+tareas_total+' días</em></span><br>',
				'<div class="progress progress_sm ">',
					'<div class="progress-bar bg-green " role="progressbar"  data-transitiongoal="'+porcentaje+'" >',
					'</div>',
				'</div>',
			'</div>'].join('');
		}
	}else{ return "";}
}

function runningFormatter3(value, row, index) {
	if(row["ID_3"] != "-"){
		var Ingresos = graficar01_msg['Ingresos'];
		var tareas_total = graficar01_msg['Cantidad_Dias'];
		var tareas_resueltas = 0;
		$.each(Ingresos, function( i, val ) {
			if(row["ID_3"] == val['IDcentro']){
				tareas_resueltas = val['Cantidad'];
				return false;
			}
		});
		//var tareas_total = 20;//row["total_tareas"];
		//var tareas_resueltas = 12;//row["tareas_resueltas"];
		var porcentaje = 0;

		tiene_tareas = false;
		if(tareas_total != 0){
			porcentaje = Math.round( (tareas_resueltas/tareas_total)*100);
			tiene_tareas = true;
		}else{
			porcentaje = 0;
		}

		var texto_barra="";

		if(!tiene_tareas){
			texto_barra="";
			return [
			'<span class="text-muted small"><em id="">'+texto_barra+'</em></span>',
			].join('');
		}else{
			texto_barra=porcentaje+"%"; //"Ingresos";
			return [
			'<div style=" margin-top:5px;"><span class="pull-left text-muted">'+texto_barra+'</span><span class="pull-right text-muted small"><em id="">'+tareas_resueltas+' de '+tareas_total+' días</em></span><br>',
				'<div class="progress progress_sm ">',
					'<div class="progress-bar bg-green " role="progressbar"  data-transitiongoal="'+porcentaje+'" >',
					'</div>',
				'</div>',
			'</div>'].join('');
		}
	}else{ return "";}
}

function runningFormatter4(value, row, index) {
	return " ";
}


function boton01(){
	graficar01(true);
}

 var $table = $('#dataTables_lista_centro01').bootstrapTable({
		onLoadSuccess: function() {
			$('.progress .progress-bar').progressbar();
		}
	 });



var graficar01_msg = [];
function graficar01(btn){
	$('#loading01').removeClass("hidden");
	var fecha_filtro_1 = $('#fecha_filtro_1_01').val();
    var fecha_filtro_2 = $('#fecha_filtro_2_01').val();
	var centros = $('#centro_filtro01').val();
  var tipo = $('#ingreso_tipo_medicion').val();
	if(btn){
		$.ajax({
				type: "post",
				url: 'load_informe_ingreso_registros.php',
				data: { user_id: user_id, fecha_filtro_1: fecha_filtro_1, fecha_filtro_2:fecha_filtro_2, centros_filtro: centros, tipo: tipo },
				success: function( msg ) {
					graficar01_msg = JSON.parse(msg);
					load_ingreso_registro(JSON.parse(msg));
				}

			});
	}else{
		load_ingreso_registro(graficar01_msg);
	}


}

function load_ingreso_registro(msg){
	$('.tabla1_fecha').html($('#fecha_filtro_1_01').val()+ " al " + $('#fecha_filtro_2_01').val());
	$('#dataTables_lista_centro01').bootstrapTable("removeAll", msg);
	$('#dataTables_lista_centro01').bootstrapTable("load", msg);
	$('.progress .progress-bar').progressbar();

	load_ingreso_registro_grafico(msg);


}




///////////// Grafico Ingreso Registro ///////////
function change_vista_ingreso(){

	if( $('#change_vista_ingreso').val() == 'Tabla'){
		$('#ingreso_registros_grafico').addClass("hidden");
		$('#ingreso_registros_tabla').removeClass("hidden");

	}else if( $('#change_vista_ingreso').val() == 'Grafico'){
		$('#ingreso_registros_grafico').removeClass("hidden");
		$('#ingreso_registros_tabla').addClass("hidden");
    load_ingreso_registro_grafico(graficar01_msg);
	}else{
    $('#ingreso_registros_grafico').removeClass("hidden");
		$('#ingreso_registros_tabla').addClass("hidden");
    load_ingreso_registro_grafico(graficar01_msg);
  }

}

var color = Chart.helpers.color;
        var horizontalBarChartData = {
            labels: ['Centro 1', 'Centro 2', 'Centro 3', 'Centro 4', ],
            datasets: [{
                label: 'Autoridades',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: "#808080",
                borderWidth: 1,
                data: [
                    0,
                    0,
                    0,
                    0
                ]
            }]

        };



var ctx4 = document.getElementById('chart-bar01').getContext('2d');
            window.myHorizontalBar4 = new Chart(ctx4, {
                type: 'bar',
                data: horizontalBarChartData,
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
                        text: 'Ingreso Registros por Centro'
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

function load_ingreso_registro_grafico(msg){


	myHorizontalBar4.destroy();


	var centros = msg['Centros'];
  var Ingresos = msg['Ingresos'];
	var mi_datasets =[];
	var mi_labels = [];
  var labelaux = [];
	var coloresautoridades = [];
  var tipo = ['Atrasados > 48hrs','A Tiempo'];
  var tipo_color = ['#ac2925','#1ABB9C'];
  var stacked = false;
  if ($('#change_vista_ingreso').val() == 'Grafico Atrasos') {

    stacked = true;
    for (var x= 0; x < 2; x++) {
      var cantidad = [];
      cantidad.push(null);
      for(i=0;i<centros.length;i++){
        entro = false;
        $.each(Ingresos, function( n, val ) {
          if(centros[i]['id'] == val['IDcentro']){
            if (x == 0) {
                 cantidad.push(val['Atrasados']);
            }else{
                 cantidad.push(val['Cantidad']-val['Atrasados']);
            }
            entro = true;
            return false;
          }
        });
        if(!entro){
          cantidad.push(0);
        }

        if(x == 0){
          label = centros[i]["nombre_centro"];
      		mi_labels.push(label);
        }
      }
      cantidad.push(null);
      dataset = {
        label: tipo[x],
        backgroundColor: tipo_color[x],
        borderColor: "#808080",
  			borderWidth: 1,
        //borderColor: "#808080",
        //borderWidth: 1,
        data: cantidad
      }

      mi_datasets.push(dataset);
    }
    labelaux.push("");
    labelaux = labelaux.concat(mi_labels);
    labelaux.push("");
  }else{
    mi_datasets.push(null);
  	for(i=0;i<centros.length;i++){

  		var cantidad = 0;
  		$.each(Ingresos, function( n, val ) {
  			if(centros[i]['id'] == val['IDcentro']){
          cantidad = val['Cantidad'];
  				return false;
  			}
  		});


  		mi_datasets.push(cantidad);

  		label = centros[i]["nombre_centro"];

  		mi_labels.push(label);
  	}
  	mi_datasets.push(null);

    labelaux.push("");
    labelaux = labelaux.concat(mi_labels);
    labelaux.push("");
  }
  console.log(labelaux);
console.log(mi_datasets);
	//Agrega la linea Total
	var mi_datasets_line = [];
	var datos2 = Array();
	if(msg['Cantidad_Dias'] > 0){

		datos2[0] = parseInt(msg['Cantidad_Dias']);
		datos2[centros.length+1] = datos2[0];
		mi_datasets_line = {
			type: 'line',
			label: "Cantidad de Días",
			fill: false,
			backgroundColor: "#b00000",
			borderColor: "#b00000",
			borderWidth: 2,
			pointRadius: 0,
			pointHoverRadius: 4,
			data: datos2,
			spanGaps: true,
			hidden: false,
		}
		 mi_datasets.push(mi_datasets_line);
	}

	var color = Chart.helpers.color;
  if ($('#change_vista_ingreso').val() == 'Grafico Atrasos') {

  	var horizontalBarChartData = {
  		labels: labelaux, //[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
  		datasets: mi_datasets
  	};
  }else{
    var horizontalBarChartData = {
  		labels: labelaux, //[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
  		datasets: [{
  			type: 'bar',
  			label: 'Centros',
  			backgroundColor: '#1ABB9C',
  			borderColor: "#808080",
  			borderWidth: 1,
  			data: mi_datasets
  		},{
  			type: 'line',
  			label: "Cantidad de Días",
  			fill: false,
  			backgroundColor: "#1ABB9C",
  			borderColor: "#1ABB9C",
  			borderWidth: 2,
  			pointRadius: 0,
  			pointHoverRadius: 4,
  			data: datos2,
  			spanGaps: true,
  			hidden: false,
  		}]
  	};
  }

	 myHorizontalBar4.destroy();


	 var ctx4 = document.getElementById('chart-bar01').getContext('2d');
window.myHorizontalBar4 = new Chart(ctx4, {
	type: 'bar',
	data: horizontalBarChartData,
	options: {
		plugins: {
		datalabels: {
			display: function (context) {
				return context.chart.isDatasetVisible(context.datasetIndex)
&& context.dataset.data[context.dataIndex] > 0;
			},
			font: {
				weight: 'bold',
				size: '13'
			},
			formatter: Math.round
		}
	},
		// Elements options apply to all of the options unless overridden in a dataset
		// In this case, we are setting the border of each horizontal bar to be 2px wide
		elements: {
			rectangle: {
				borderWidth: 1,
			}
		},
		responsive: true,
		legend: {
			position: 'right',
			display: false,
		},
		title: {
			display: true,
			text: ' Cantidad de Días Registrados por Centro '+ $('#fecha_filtro_1_01').val()+ " al " + $('#fecha_filtro_2_01').val()
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
					  min: mi_labels[0],
				 	  max: mi_labels[mi_labels.length-1],
					  autoSkip: false,
					  fontSize: 11,
					  padding: 12
				  },
				  maxBarThickness : 70,
          stacked: stacked

			  }],
			yAxes: [{
				ticks: {
					min: 0,
					max: msg['Cantidad_Dias']
				},
				 scaleLabel: {
					display: true,
					labelString: 'Cantidad de Días Registrados'
				},
        stacked: stacked
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


	$('#loading01').addClass("hidden");

}



/*---------------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------------- Tabla Niveles--------------------------------------------------------------------------*/
var date1 = new Date();
	date1.setDate(date1.getDate()-6);
	$('#datetimepicker_filtro1_02').datetimepicker({
				locale: 'es',
				defaultDate: date1,
				format: 'DD-MM-YYYY',

	});

	var date2 = new Date();
	date2.setDate(date2.getDate());
	$('#datetimepicker_filtro2_02').datetimepicker({
				locale: 'es',
				defaultDate: date2,
				format: 'DD-MM-YYYY',
			useCurrent: false //Important! See issu
	});

	function myFunction02() {
		var x = document.getElementById("region_filtro02").value;

		if(x == 0){
			$("#datetimepicker_filtro1_02").show();
			$("#datetimepicker_filtro2_02").show();

		}else{
			$("#datetimepicker_filtro1_02").hide();
			$("#datetimepicker_filtro2_02").hide();
			if(x==1){
				//desde
				var date1 = new Date();
				date1.setDate(date1.getDate()-6);
				$('#datetimepicker_filtro1_02').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_02').data("DateTimePicker").date(date2);
			}else{
				var date1 = new Date();
				date1.setDate(date1.getDate()-29);
				$('#datetimepicker_filtro1_02').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_02').data("DateTimePicker").date(date2);

			}
		}

	}



function runningFormatterfiscalizada(value, row, index) {

		if (row['Fiscaliza'] == "Si"){
			return "Fiscalizada";
		}else {return row['Fiscaliza'];}

	}


var lastindex = 0;
var samegrupo1 = 0;
function runningFormatterarea(value, row, index) {
	var centro = row['Centro'];
	if(samegrupo1 != centro ){
		samegrupo1 = centro;
		lastindex = index;
	}
	return (index-lastindex)+1;
}

$('#resumenreporte').on('post-body.bs.table', function () {
	samegrupo0 = 0;
	samegrupo1 = 0;
	samegrupo2 = 0
	lastindex = 0;

});
var samegrupo2 = 0;
function formatearBarrio(value, row, index){

	var html = "";
	var barrio = row['Barrio'];
	if(samegrupo2 != barrio ){
		samegrupo2 = barrio;
		 html =row["Barrio"];
	}

	return html;
}

var samegrupo0 = 0;
function formatearCentro(value, row, index){

	var html = "";
	var centro = row['Centro'];
	if(samegrupo0 != centro ){
		samegrupo0 = centro;
		 html =row["Centro"];
	}

	return html;
}

$('[name="multipleselect_tendencia"]').multiselect({
	buttonWidth: '250px',
	nonSelectedText: 'No',
	includeSelectAllOption: true,
	allSelectedText: 'Todos',
	nSelectedText: ' - Seleccionados',
  enableFiltering: true,
	enableCaseInsensitiveFiltering: true,
	enableClickableOptGroups: true,
  maxHeight: 400
});

var selectedverindicador = ["3","2","1"];
$('[name="multipleselect_indicador_02"]').multiselect({
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
		loadresumen(1);
	},
	onSelectAll: function () {
		var brands = $('#verindicador option:selected');
		selectedverindicador = [];
		$(brands).each(function(index, brand){
			selectedverindicador.push($(this).val());
		});
		loadresumen(1);
	},
	onDeselectAll: function () {
		selectedverindicador = [];
		loadresumen(1);
	}
});


function cellStylenivelestabla(value, row, index) {

	var classes = ['label-green','label-gray','label-yellow1','label-red1'];
	var aux = 0;
	var value = parseInt(value);
	if(value >= parseInt(row['Alarma_Rojo']) && parseInt(row['Alarma_Rojo']) > 0){
		if(selectedverindicador.indexOf("3") >=0){
			aux=classes[3];
		}
	}else if(value >= parseInt(row['Alarma_Amarillo']) && parseInt(row['Alarma_Amarillo']) > 0){
			if(selectedverindicador.indexOf("2") >=0){
				aux=classes[2];
			}
	} else{
		if(selectedverindicador.indexOf("1") >=0){
			if($('#condicion_02').val() == 1){
				if(  value >=  row['Nivel_Critico'] * ($('#valor_condicion_02').val()/100)  ){
					aux=classes[1];
				}
			}else if($('#condicion_02').val() == 2){
				if(value >= parseInt($('#valor_condicion_02').val())){
					aux=classes[1];
				}
			}
		}
	}

	return {
		classes: aux,
	};
}


function boton02(){
	loadresumen(1);
}


var graficar02_msg = [];
function loadresumen(btn){
	var fecha_filtro_1 = $('#fecha_filtro_1_02').val();
    var fecha_filtro_2 = $('#fecha_filtro_2_02').val();
	var centros = $('#centro_filtro02').val();
	$('#loading02').removeClass("hidden");
	if(btn){
		$.ajax({
				url: "load_informe_resumen_reporte.php",
				type: 'post',
				data: {
					user_id:			user_id,
					fecha_filtro_1: 	 fecha_filtro_1,
					fecha_filtro_2:	 fecha_filtro_2,
					Especies:		   $('#especie_02').val(), //document.getElementById("especiesselectmap").value,
					Medicion:		   parseInt($('#prof_filtro2').val() - 1), //0, // parseInt(document.getElementById("nromedicionresumen").value),
					Valor_Condicion:    $('#valor_condicion_02').val(),
					Condicion:    	  $('#condicion_02').val(),
					centros_filtro: 	 centros,

				},
				success: function(dato)
				{
					var myobjaux = JSON.parse(dato);
					graficar02_msg = myobjaux['Resultado'];
					load_resumen_tabla(myobjaux['Resultado']);
				}

			});
	}else{
		load_resumen_tabla(graficar02_msg);
	}


}


var coldefecto = 5;
var posicioncol = 5;
function load_resumen_tabla(myobj){
		var rowCount = $('#resumenreporte th').length;
			$('#resumenreporte').bootstrapTable('destroy');

			for(var c = posicioncol; c<(rowCount-coldefecto+posicioncol); c++){
				$('#resumenreporte tr').find('th:eq('+posicioncol+'), td:eq('+posicioncol+')').remove();
			}

			// Agrega las nuevas columnas
			for(var i = myobj[myobj.length-1].length-1; 0<=i; i--){
				var th = '<th data-field="'+i+'"  id="asd" data-sortable="false" data-switchable="false" class="" data-valign = "middle" style="background:#035377 !important; color: #ECF0F1 !important;position: sticky; top:-1px;text-align: center; " data-cell-style="cellStylenivelestabla"></th>';
				//var th = '<th data-field="'+i+'" id="asd" data-sortable="false" data-switchable="false" class="" data-valign = "middle"  data-width = "90px" data-cell-style="cellStylenivelestabla"></th>';
				$('#resumenreporte tr').append($(th));
				$('#resumenreporte thead tr>th:last').html(myobj[myobj.length-1][i]);
			}

			//Agrega el titulo de la tabla
			var unidad_aux = '';
			if($('#condicion_02').val() == 1){ unidad_aux = ' en [cel/ml]';}
			var html = $('#especie_02 option:selected' ).attr("nameTitle") + " que Superan " + $('#valor_condicion_02').val() + " " + $('#condicion_02 option:selected' ).text() + unidad_aux;
			$('#tabla2_condicion').html(html);

			myobj.splice(myobj.length-1,1);

		//$('#resumenreporte').bootstrapTable();
		$('#resumenreporte').bootstrapTable({
					//onSort: function (name, order) {},
					showExport: true,
					exportOptions:{fileName: "GTR Fan - "+html,
									excelstyles: ['background-color', 'color', 'border-bottom-color',
													'border-bottom-style', 'border-bottom-width', 'border-top-color',
													'border-top-style', 'border-top-width',
													'border-left-color', 'border-left-style', 'border-left-width',
													'border-right-color', 'border-right-style', 'border-right-width',
													'font-family', 'font-size', 'font-weight']
									},

		}).trigger('change');
		$('#resumenreporte').bootstrapTable("removeAll");
		$('#resumenreporte').bootstrapTable("load", myobj);


		//Sticky primera fila

		//Definir ancho fijo para que al impirmir no se vean corridas las columnas, (al  fijar el left position)
		if(rowCount > 7+posicioncol){
			$('#resumenreporte th ').attr('style', "background: #035377 !important; color: #ECF0F1 !important;  text-align: center; vertical-align: middle;position: sticky; top:-1px;width: 80px");
		}else{
			$('#resumenreporte th ').attr('style', "background: #035377 !important; color: #ECF0F1 !important; text-align: center; vertical-align: middle;position: sticky; top:-1px;width: 92px");
		}
		$('#resumenreporte th:nth-child(-n+'+posicioncol+') ').attr('style', "background: #035377 !important; color: #ECF0F1 !important; text-align: center; vertical-align: middle;position: sticky; top:-1px;z-index: 1;");

		$('#resumenreporte th:nth-child(1) ').css("width","40px");
		$('#resumenreporte th:nth-child(2) ').css("width","87px");
		$('#resumenreporte th:nth-child(3) ').css("width","30px");
		$('#resumenreporte th:nth-child(4) ').css("width","110px");
		$('#resumenreporte th:nth-child(5) ').css("width","83px");




		//Sticky primeras 4 columnas
		$('#resumenreporte tr td:nth-child(-n+'+posicioncol+')').attr('style', "background: #f9f9f9 !important;  position: sticky; ");

		$('#resumenreporte tbody  tr').each(function( index ) {
			var elemento = $('#resumenreporte tbody  tr:nth-child('+(index+1)+')  > td:first-child').html();
			if(elemento != ""){
				$('#resumenreporte tbody > tr:nth-child('+(index+1)+') > td:first-child').attr('style', " border-top: .2em solid #dddddd  !important; background: #f9f9f9 !important;  position: sticky; ");
			}

			var elemento = $('#resumenreporte tbody  tr:nth-child('+(index+1)+')  > td:nth-child(2)').html();
			if(elemento != ""){
				$('#resumenreporte tbody > tr:nth-child('+(index+1)+') > td:nth-child(2)').attr('style', " border-top: .2em solid #dddddd  !important; background: #f9f9f9 !important;  position: sticky; ");
			}
		});


		//$('#resumenreporte tr td:nth-child(-n+'+posicioncol+')').css("border-left","solid 1px #eee");
		for(var i=1; i<=posicioncol;i++){
			var left_p2 = $('#resumenreporte th:nth-child('+i+') ').position();
			$('#resumenreporte th:nth-child('+i+') ').css("left",left_p2.left-i-2);
		}

		for(var i=1; i<=posicioncol;i++){
			var left_p = $('#resumenreporte tr td:nth-child('+i+')').position();
			if(left_p !== undefined){
				$('#resumenreporte tr td:nth-child('+i+')').css("left",left_p.left-i-2);
			}

		}

		//Agregar color a la letra de los titulos de la tabla, usando la class th-inner
		$('.th-inner ').attr('style', 'color: #ECF0F1 !important');

		$('#loading02').addClass("hidden");


}






/*---------------------------------------------------------------------------------------------------------------------------------*/
/*---------------------------------------------CHART LINE--------------------------------------------------------------------------*/


        var config1 = {
            type: 'line',
            data: {
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Tendencia de especie por centro'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Fecha'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Máxima concentración [cel/ml]'
                        }
                    }]
                }
            }
        };

        var ctx1 = document.getElementById('chart-line1').getContext('2d');
        window.myLine1 = new Chart(ctx1, config1);


function random_rgba() {
    var o = Math.round, r = Math.random, s = 255;
    return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',' + r().toFixed(1) + ')';
}
function color_graifco( i){

    num = parseInt(i);
    switch(num){
        case 1: return 'rgba(255, 99, 132, 0.5)';
            break;
        case 2: return 'rgba(169,68,66,0.7)';//'rgba(255, 159, 64, 0.5)';
            break;
        case 3: return 'rgba(190,169,112,0.8)';//'rgba(255, 255, 0, 0.5)';
            break;
        case 4: return 'rgba(0, 255, 4, 0.6)';
            break;
        case 5: return 'rgba(4, 148, 4, 0.5)';
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
        default: return random_rgba();
            break;

    }


}

$('.especie_filtro').multiselect({
            enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
            //filterBehavior: 'value'
        });

$('.centro_filtro').multiselect({
            enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
            //filterBehavior: 'value'
        });
$('.centro_filtro2').multiselect({
    enableFiltering: true,
		enableCaseInsensitiveFiltering: true,
		includeSelectAllOption: true,
		allSelectedText: 'Todos los centros',
		nSelectedText: ' - Centros',
		enableFiltering: true,
    enableClickableOptGroups: true,
          //filterBehavior: 'value'
  });

  $('.tipo_medicion').multiselect({
      enableFiltering: true,
  		enableCaseInsensitiveFiltering: true,
  		includeSelectAllOption: true,
  		allSelectedText: 'Todas las Mediciones',
  		// nSelectedText: ' - Centros',
  		enableFiltering: true,
      enableClickableOptGroups: true,
            //filterBehavior: 'value'
    });

    $('.tipo_medicion').multiselect( 'rebuild' );
    $('.tipo_medicion').multiselect('selectAll', false);
    $('.tipo_medicion').multiselect('updateButtonText');

$('#centro_select_filtro1').multiselect({
			nonSelectedText: 'Seleccionar Centros',
			includeSelectAllOption: true,
			allSelectedText: 'Todos los centros',
			nSelectedText: ' - Centros',
			numberDisplayed: 1,
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			enableClickableOptGroups: true,
			onDropdownHidden: function(option, checked, select) {cambiar_grafico_my_function1(false);}
        });
$('#centro_select_filtro2').multiselect({
			nonSelectedText: 'Seleccionar Centros',
			includeSelectAllOption: true,
			allSelectedText: 'Todos los centros',
			nSelectedText: ' - Centros',
			numberDisplayed: 1,
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			enableClickableOptGroups: true,
			onDropdownHidden: function(option, checked, select) {cambiar_grafico_my_function2(false);}
        });

$('#especie_select_filtro3').multiselect({
			nonSelectedText: 'Seleccionar Especies',
			includeSelectAllOption: true,
			allSelectedText: 'Todas las especies',
			nSelectedText: ' - Especies',
			numberDisplayed: 1,
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			enableClickableOptGroups: true,
			onDropdownHidden: function(option, checked, select) {cambiar_grafico_my_function3(-1,false);}
        });




/*---------------------------------------------------------------------------------------------------------------------------------*/
/*-----------------------------------select 1--------------------------------------------------------------------------------------*/
	var date1 = new Date();
	date1.setDate(date1.getDate()-6);
	$('#datetimepicker_filtro1_1').datetimepicker({
				locale: 'es',
				defaultDate: date1,
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
		var x = document.getElementById("region_filtro1").value;

		if(x == 0){
			$("#datetimepicker_filtro1_1").show();
			$("#datetimepicker_filtro2_1").show();

		}else{
			$("#datetimepicker_filtro1_1").hide();
			$("#datetimepicker_filtro2_1").hide();
			if(x==1){
				//desde
				var date1 = new Date();
				date1.setDate(date1.getDate()-6);
				$('#datetimepicker_filtro1_1').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_1').data("DateTimePicker").date(date2);
			}else{
				var date1 = new Date();
				date1.setDate(date1.getDate()-29);
				$('#datetimepicker_filtro1_1').data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_1').data("DateTimePicker").date(date2);

			}
		}

	}



var  myLine1 = "";
var msg_graf1 = [];
function cambiar_grafico_my_function1(btn){



    var especie = $('#especie_filtro1').val();
	var fecha_filtro_1 = $('#fecha_filtro_1_1').val();
    var fecha_filtro_2 = $('#fecha_filtro_2_1').val();

    if(btn){
		$.ajax({
				url: "load_informe_grafico1.php",
				type: 'post',
				data: {Fecha_Inicio: fecha_filtro_1, Fecha_Termino: fecha_filtro_2, IDespecie: especie, user_id: user_id},
				success: function(msg)
				{


					 msg_graf1 = JSON.parse(msg);


					if(btn){
						$('#centro_select_filtro1').empty();
						$.each(msg_graf1['IDcentro'], function (i, item) {
								$('#centro_select_filtro1').append('<option value="'+item+'">'+msg_graf1['Nombre'][i]+'</option>');
						});
						$('#centro_select_filtro1').append('<option value="Nivel Nocivo">'+'Nivel Nocivo'+'</option>');
						$('#centro_select_filtro1').multiselect( 'rebuild' );
						$('#centro_select_filtro1').multiselect('selectAll', false);
						$('#centro_select_filtro1').multiselect('updateButtonText');
					}

					 graficar_update1(msg_graf1,especie);
				}
		});

	}else{
		graficar_update1(msg_graf1,especie);
	}

}

function graficar_update1(uno,especie){



	var mi_datasets = [];
	if( myLine1){
		myLine1.destroy();
	}

	mi_datasets = [];
	var datos =[];
	var centros_filtradas = $('#centro_select_filtro1 option:selected').text();
	for (j=0; j<uno['Nombre'].length; j++){


		datos =[];
		var nombre_centro = uno['Nombre'][j];

	   	//solo centros seleccionadas en filtro

		if(centros_filtradas.indexOf(nombre_centro) >= 0){


			for(k=0; k<uno['Label'].length; k++){

				var entro = 0;
				for (i=0; i<uno[nombre_centro].length; i++){
					if(uno[nombre_centro][i][0] == uno['Label'][k]){
						datos.push(parseInt(uno[nombre_centro][i][1]));
						entro = 1;
					}
				}

				//if(entro == 0){datos.push(null);}

				if(entro == 0){
					//Ver si se midio (Estado Ausencia)
					if ( typeof uno[nombre_centro+'-Fecha_Ausencia'] !== 'undefined'){

						if(uno[nombre_centro+'-Fecha_Ausencia'].indexOf(uno['Label'][k]) !== -1){
							datos.push(0);
						}else{
							datos.push(null);
						}

					}else{
						datos.push(null);
					}
				}



			}


			var color = color_graifco(j+1);
			dataset = {
				label: nombre_centro,
				fill: false,
				backgroundColor: color,
				borderColor: color,

				borderWidth: 2,
				pointRadius: 4,
				pointHoverRadius: 4,
				data: datos,
				spanGaps: false
			}




			mi_datasets.push(dataset);

		}

	}


	//console.log(mi_datasets);



	var linerChartData = {
		labels: uno['Label'],
		datasets: mi_datasets,


	};


	//Agrega la linea Nivel Nocivo
	if(uno['Nivel_Critico'] != "" && mi_datasets && centros_filtradas.indexOf('Nivel Nocivo') >= 0){
		var datos2 = Array();
		datos2[0] = parseInt(uno['Nivel_Critico']);
		datos2[uno['Label'].length-1] = datos2[0];

		dataset = {
			label: "Nivel Nocivo",
			fill: false,
			backgroundColor: "#b00000",
			borderColor: "#b00000",
			borderWidth: 2,
			pointRadius: 0,
			pointHoverRadius: 4,
			data: datos2,
			spanGaps: true,
			hidden: false,
		}
		 mi_datasets.push(dataset);
	}

	var config1 = {
	type: 'line',
	data: linerChartData,


	options: {
		plugins: {
			datalabels: {
				display: function (context) {
					return context.chart.isDatasetVisible(context.datasetIndex)
&& context.dataset.data[context.dataIndex] > 0;
				},
				font: {
					weight: 'bold',
					size: '14'
				},
				formatter: Math.round,
				display: false
			}
		},

		responsive: true,
		title: {
			display: true,
			text: 'Tendencia especie '+$('#especie_filtro1 option:selected').map(function () {
                                                                              return $(this).text();
                                                                          }).get().join(', ')+' por centro',
			lineHeight: 1,
		},
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		legend: {
			display: true,
			position: 'right',
		},
		// Container for pan options
		pan: {
			enabled: true,
			mode: 'xy',
			rangeMin: {
				x: uno['Label'][0],
				y: null
			},
			rangeMax: {
				x: uno['Label'][uno['Label'].length-1],
				y: null
			},
		},
		// Container for zoom options
		zoom: {
			enabled: false,
			drag: false,
			mode: 'xy',
			/*rangeMin: {
				x: null,
				y: null,
			},
			rangeMax: {
				x: null,
				y: null
			},*/
		},
		scales: {
			xAxes: [{
				type: 'time',
				time: {
					unit: 'day',
					//unitStepSize: 1,
					displayFormats: {
					   'day': 'DD-MM-YYYY'
					}
				},
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Fecha'
				}
			}],
			yAxes: [{
				ticks: {
					min: 0,
				},
				 scaleLabel: {
					display: true,
					labelString: 'Máxima concentración [cel/ml]'
				}
			}]
		}
	}
	}

	var ctx1 = document.getElementById('chart-line1').getContext('2d');
	window.myLine1 = new Chart(ctx1, config1);





}


function boton1(){
    cambiar_grafico_my_function1(true);
}

function selectall1() {
	window.myLine1.data.datasets.forEach(function(ds) {
		ds.hidden = !ds.hidden;
	});
	window.myLine1.update();
};




/*---------------------------------------------------------------------------------------------------------------------------------*/
/*-----------------------------------GRAFICO 2--------------------------------------------------------------------------------------*/
	var config2 = {
            type: 'bar',
            data: {
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: ''
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: ''
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: ''
                        }
                    }]
                }
            }
        };

        var ctx2 = document.getElementById('chart-line2').getContext('2d');
        window.myLine2 = new Chart(ctx2, config2);

	var date1 = new Date();
	$('#datetimepicker_filtro1_2').datetimepicker({
				locale: 'es',
				defaultDate: date1,
				format: 'DD-MM-YYYY',

	});

var msg_graf2 = [];
function cambiar_grafico_my_function2(btn){



    var especie = $('#especie_filtro2').val();
	var fecha_filtro_1 = $('#fecha_filtro_1_2').val();

	if(btn){
    $.ajax({
            url: "load_informe_grafico2.php",
            type: 'post',
            data: {Fecha_Inicio: fecha_filtro_1, IDespecie: especie, user_id: user_id},
            success: function(msg)
            {
                msg_graf2 = JSON.parse(msg);

				if(btn){
					$('#centro_select_filtro2').empty();
					$.each(msg_graf2['IDcentro'], function (i, item) {
							$('#centro_select_filtro2').append('<option value="'+item+'">'+msg_graf2['Nombre'][i]+'</option>');
					});
					$('#centro_select_filtro2').append('<option value="Nivel Nocivo">'+'Nivel Nocivo'+'</option>');
					$('#centro_select_filtro2').multiselect( 'rebuild' );
					$('#centro_select_filtro2').multiselect('selectAll', false);
					$('#centro_select_filtro2').multiselect('updateButtonText');
				}
                graficar_update2(msg_graf2,btn);

            }

	});
	}else{
		graficar_update2(msg_graf2,btn);
	}

}


function graficar_update2(uno,btn){

	myLine2.destroy();

	var mi_datasets = [];

	var label_filter = [];
	var centros_filtradas = $('#centro_select_filtro2 option:selected').text();
	for (j=0; j<opt.length; j++){

		var datos =[];

		//Agregar al comienzo una barra falsa, para que la linea Nivel Nocivo parta del comienzo del gráfico

		datos.push(null);

		for (i=0; i<uno['Nombre'].length; i++){
			var nombre_centro = uno['Nombre'][i];
				//solo centros seleccionadas en filtro

			if(centros_filtradas.indexOf(nombre_centro) >= 0){


				var value = parseInt(uno[nombre_centro][0][j]);

				if(value > 0){
					datos.push(value);
				}else{
					datos.push('-');
				}

				if(label_filter.indexOf(nombre_centro) == -1){
					label_filter.push(nombre_centro);
				}
			}
		}

		//Agregar al final una barra falsa, para que la linea Nivel Nocivo llegue al final del gráfico
		datos.push(null);

		var color = color_graifco(j+1);
		dataset = {
			type: 'bar',
			label: j*5+" [m]",
			fill: false,
			backgroundColor: color,
			borderColor: color,
			borderWidth: 2,
			pointRadius: 4,
			pointHoverRadius: 4,
			data: datos,
			spanGaps: false
		}
		mi_datasets.push(dataset);

	}


   //Agrega la linea Nivel Nocivo
	var mi_datasets_line = [];
	if(uno['Nivel_Critico'] != "" && centros_filtradas.indexOf('Nivel Nocivo') >= 0){
		var datos2 = Array();
		datos2[0] = parseInt(uno['Nivel_Critico']);
		datos2[label_filter.length+1] = datos2[0];
		//datos2[4] = datos2[0];

		mi_datasets_line = {
			type: 'line',
			label: "Nivel Nocivo",
			fill: false,
			backgroundColor: "#b00000",
			borderColor: "#b00000",
			borderWidth: 2,
			pointRadius: 0,
			pointHoverRadius: 4,
			data: datos2,
			spanGaps: true,
			hidden: true,
		}
		 mi_datasets.push(mi_datasets_line);
	}


	var labelaux = [];
	labelaux.push("");
	labelaux = labelaux.concat(label_filter);
	labelaux.push("");
	var linerChartData = {
		datasets: mi_datasets,
		 labels: labelaux,
	};

	var config2 = {
	type: 'bar',
	data: linerChartData,
	responsive: true,

	options: {
		plugins: {
			datalabels: {
				display: function (context) {
					return context.chart.isDatasetVisible(context.datasetIndex)
&& context.dataset.data[context.dataIndex] > 0;
				},
				font: {
					weight: 'bold',
					size: '11'
				},
				formatter: Math.round,
				display: true
			}
		},

		title: {
			display: true,
			text: 'Especie '+$('#especie_filtro2 option:selected').text()+' por Centro y Profundidad',
			lineHeight: 1,
		},
		tooltips: {
			mode: 'index',
			intersect: false,
			callbacks: {
                       label: function (tti, data) {
							if(tti.yLabel >=0){
								return data.datasets[tti.datasetIndex].label+": "+ tti.yLabel;
							}
						}
                    }

		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		scales: {
			xAxes: [{
				/*type: 'time',
				time: {
					unit: 'day',
					//unitStepSize: 1,
					displayFormats: {
					   'day': 'DD-MM-YYYY'
					}
				},*/
				display: true,
				scaleLabel: {
					display: true,
					labelString: ''
				},
				ticks: {
				  min: label_filter[0],
				  max: label_filter[label_filter.length-1],
				}
			}],
			yAxes: [{
				ticks: {
					min: 0
				},
				 scaleLabel: {
					display: true,
					labelString: 'Máx. Concentración Día [cel/ml]'
				}
			}]
		}
	}
};


var ctx2 = document.getElementById('chart-line2').getContext('2d');
window.myLine2 = new Chart(ctx2, config2);

}


function boton2(){
    cambiar_grafico_my_function2(true);
}



/*---------------------------------------------------------------------------------------------------------------------------------*/
/*-----------------------------------select 3--------------------------------------------------------------------------------------*/
	 var myLine3 = Array();
	 var config3 = {
            type: 'line',
            data: {
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Resumen Centro'
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Fecha'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Concentración [cel/ml]'
                        }
                    }]
                }
            }
        };

        var ctx3 = document.getElementById('chart-line3').getContext('2d');
        myLine3[0] = new Chart(ctx3, config3);


	var date1 = new Date();
	date1.setDate(date1.getDate()-6);
	$('#datetimepicker_filtro1_3').datetimepicker({
				locale: 'es',
				defaultDate: date1,
				format: 'DD-MM-YYYY',

	});

	var date2 = new Date();
	date2.setDate(date2.getDate());
	$('#datetimepicker_filtro2_3').datetimepicker({
				locale: 'es',
				defaultDate: date2,
				format: 'DD-MM-YYYY',
			useCurrent: false //Important! See issu
	});

	function myFunction3(a) {
		if(a>=0){a = "_"+a;}else{a="";}
		var x = document.getElementById("region_filtro3"+a).value;

		if(x == 0){
			$("#datetimepicker_filtro1_3"+a).show();
			$("#datetimepicker_filtro2_3"+a).show();

		}else{
			$("#datetimepicker_filtro1_3"+a).hide();
			$("#datetimepicker_filtro2_3"+a).hide();
			if(x==1){
				//desde
				var date1 = new Date();
				date1.setDate(date1.getDate()-6);
				$('#datetimepicker_filtro1_3'+a).data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_3'+a).data("DateTimePicker").date(date2);
			}else{
				var date1 = new Date();
				date1.setDate(date1.getDate()-29);
				$('#datetimepicker_filtro1_3'+a).data("DateTimePicker").date(date1);

				//hasta
				var date2 = new Date();
				date2.setDate(date2.getDate());
				$('#datetimepicker_filtro2_3'+a).data("DateTimePicker").date(date2);

			}
		}

	}

	$('#pamb_filtro3').multiselect({
		nonSelectedText: 'Parámetros Ambientales',
		includeSelectAllOption: true,
        allSelectedText: 'P. Ambientales',
		nSelectedText: ' - P. Ambientales',
		numberDisplayed: 1,
		enableFiltering: false,
		enableCaseInsensitiveFiltering: true,
		enableClickableOptGroups: true,
		maxWidth: 170,
		minWidth: 170,
	});


var msg_graf3 = [];
function cambiar_grafico_my_function3(a,btn){


  if(a>= 0){b = parseInt(a)+1; a = "_"+a;}else{a="";b = 0;}

  var especie = $('#especie_filtro3'+a).val();
	var idesp = $('#especie_select_filtro3'+a).val();
	if(btn){idesp = "no";}
	var profundidad = parseInt($('#prof_filtro3'+a).val());
	var centro = $('#centro_filtro3'+a).val();
	var fecha_filtro_1 = $('#fecha_filtro_1_3'+a).val();
  var fecha_filtro_2 = $('#fecha_filtro_2_3'+a).val();
	var pamb = $('#pamb_filtro3'+a).val();

	if(btn || a==-1){
		$.ajax({
				url: "load_informe_grafico3.php",
				type: 'post',
				data: {Fecha_Inicio: fecha_filtro_1, Fecha_Termino: fecha_filtro_2,P_Amb: pamb, IDcentro: centro, Especie: especie, IDespecies: idesp,user_id: user_id},
				success: function(msg)
				{
					msg_graf3 = JSON.parse(msg);

					if(btn){
						$('#especie_select_filtro3'+a).empty();
						$.each(msg_graf3['Especies'], function (i, item) {
								$('#especie_select_filtro3'+a).append('<option value="'+item['IDespecie']+'">'+item['Nombre']+'</option>');
						});
						$('#especie_select_filtro3'+a).append('<option value="Nivel Nocivo">'+'Nivel Nocivo'+'</option>');
						$('#especie_select_filtro3'+a).multiselect( 'rebuild' );
						$('#especie_select_filtro3'+a).multiselect('selectAll', false);
						$('#especie_select_filtro3'+a).multiselect('updateButtonText');
					}
					graficar_update3(msg_graf3,a,b,btn,pamb,profundidad,especie);



				}

		});
	}else{

		graficar_update3(msg_graf3,a,b,btn,pamb,profundidad,especie);
	}

}

function graficar_update3(uno,a,b,btn,pamb,profundidad,especie){




		 if(myLine3[b]){
			myLine3[b].destroy();
		 //myLine3.splice(b,1) ;
		 }


		var mi_datasets = [];
    var pointbordercolor = [];
    var pointcolor = [];
    var pointstyle = [];
		var datos =[];
		var especies_filtradas = $('#especie_select_filtro3'+a+' option:selected').text();
		for (j=0; j<uno['Nombre'].length; j++){

			datos =[];
      pointbordercolor = [];
      pointcolor = [];
      pointstyle = [];
			var nombre_esp = uno['Nombre'][j];
      var color = color_graifco(j+1);
		   	//solo especies seleccionadas en filtro

			if(especies_filtradas.indexOf(nombre_esp) >= 0){

				for(k=0; k<uno['Label'].length; k++){

					var entro = 0;
					for (i=0; i<uno[nombre_esp].length; i++){
						if(uno[nombre_esp][i][0] == uno['Label'][k]){
							datos.push(parseInt(uno[nombre_esp][i][profundidad]));

              //Cambia de color el marcador si supera alguna Alarma
              if (parseInt(uno[nombre_esp][i][profundidad]) >= parseInt(uno[nombre_esp][i][9]) && parseInt(uno[nombre_esp][i][9])>0 && especie != 2) { //Alarma_Rojo
                pointbordercolor.push('#9a0101');
                pointcolor.push('#ff0700');
                pointstyle.push('rect');

              }else if (parseInt(uno[nombre_esp][i][profundidad]) >= parseInt(uno[nombre_esp][i][10]) && parseInt(uno[nombre_esp][i][10])>0 && especie != 2) { //Alarma_Amarillo
                pointbordercolor.push('#b3ae00');
                pointcolor.push('#eae300');
                pointstyle.push('rect');
              }else{
                pointbordercolor.push(color);
                pointcolor.push(color);
                pointstyle.push('circle');
              }

							entro = 1;
						}
					}


					if(entro == 0){
						//Ver si se midio (Estado Ausencia)
						if(uno['Fecha_Ausencia'].indexOf(uno['Label'][k]) !== -1){
							datos.push(0);
						}else{datos.push(null);}
            pointbordercolor.push(color);
            pointcolor.push(color);
            pointstyle.push('circle');

					}


				}

        console.log(pointcolor);
				dataset = {
					label: nombre_esp,
					yAxisID: 'A',
					fill: false,
					backgroundColor: color,
					borderColor: color,
					borderWidth: 2,

					pointRadius: 4,
					pointHoverRadius: 4,
          pointBorderColor: pointbordercolor,
          pointBackgroundColor: pointcolor,
          pointStyle: pointstyle,
					data: datos,
					spanGaps: false
				}




				mi_datasets.push(dataset);

			}

		}

		//Agregar linea Nivel Nocivo
		var percent = "cel/ml";
		var percent2 = "";
		if(especie == 2 && datos && especies_filtradas.indexOf('Nivel Nocivo') >= 0){
			percent = "%";percent2 = percent;
			var datos2 = Array();
			datos2[0] = 100;
			datos2[datos.length-1] = 100;

			dataset = {
				label: "Nivel Nocivo",
				fill: false,
				backgroundColor: "#b00000",
				borderColor: "#b00000",
				borderWidth: 2,
				pointRadius: 0,
				pointHoverRadius: 4,
				data: datos2,
				spanGaps: true
			}
			 mi_datasets.push(dataset);
		}

		//Agregarlos P. Ambientales
		var ejepamb = false;
		if( pamb ){
			ejepamb = true;
			for (j=0; j<pamb.length; j++){


				var datos =[];
				var nombre_esp = pamb[j];
			   if( !(uno[nombre_esp] === undefined) ){
					for(k=0; k<uno['Label'].length; k++){

						var entro = 0;
						for (i=0; i<uno[nombre_esp].length; i++){
							if(uno[nombre_esp][i][0] == uno['Label'][k]){
                if(nombre_esp == "Disco Secchi [m]"){
  								datos.push(parseFloat(uno[nombre_esp][i][1]));
  								entro = 1;
                }else{
                  datos.push(parseFloat(uno[nombre_esp][i][profundidad]));
  								entro = 1;
                }
							}
						}


						if(entro == 0){
							//Ver si se midio (Estado Ausencia)
							/*if(uno['Fecha_Ausencia'].indexOf(uno['Label'][k]) !== -1){
								datos.push(0);
							}else{*/
								datos.push(null);
							//	}
						}


					}


					if(nombre_esp == 'Oxigeno Disuelto [%]'){
						color = 'rgba(51,80, 183, 1)';
					}else if (nombre_esp == "Oxigeno Disuelto [mg/l]"){
						color = 'rgba(51,147, 183, 1)';
					}else if(nombre_esp == "Salinidad"){
						color = 'rgba(204,204, 204, 1)';
          }else if(nombre_esp == "Disco Secchi [m]"){
						color = 'rgba(60,118,61,1)';
					}else{
						color = 'rgba(51,51, 51, 1)';
					}

					dataset = {
						label: nombre_esp,
						yAxisID: 'B',
						fill: false,
						backgroundColor: color,
						borderColor: color,
						pointStyle: 'crossRot',
						borderWidth: 2,
						borderDash: [5,5],
						radius: 3,
						pointHoverRadius: 4,
						data: datos,
						spanGaps: false
					}
					mi_datasets.push(dataset);
			   }
			}
		}




		var linerChartData = {
			labels: uno['Label'],
			datasets: mi_datasets
		};



		var config3 = {
		type: 'line',
		data: linerChartData,


		options: {
			plugins: {
				datalabels: {
					display: function (context) {
						return context.chart.isDatasetVisible(context.datasetIndex)
	&& context.dataset.data[context.dataIndex] > 0;
					},
					font: {
						weight: 'bold',
						size: '14'
					},
					formatter: Math.round,
					display: false
				}
			},

			responsive: true,
			title: {
				display: true,
				text: 'Resumen Centro '+$('#centro_filtro3'+a+' option:selected').text(),
				lineHeight: 1,
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			legend: {
				display: true,
				position: 'right',
			},
			// Container for pan options
			pan: {
				enabled: true,
				mode: 'xy',
				rangeMin: {
					x: uno['Label'][0],
					y: null
				},
				rangeMax: {
					x: uno['Label'][uno['Label'].length-1],
					y: null
				},
			},
			// Container for zoom options
			zoom: {
				enabled: false,
				drag: false,
				mode: 'xy',
				/*rangeMin: {
					x: null,
					y: null,
				},
				rangeMax: {
					x: null,
					y: null
				},*/
			},
			scales: {
				xAxes: [{
					type: 'time',
					time: {
						unit: 'day',
						//unitStepSize: 1,
						displayFormats: {
						   'day': 'DD-MM-YYYY'
						}
					},
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Fecha'
					}
				}],
				yAxes: [
					{
						id: 'A',
						type: 'linear',
						position: 'left',
						ticks: {
							min: 0,
							callback: function (value) {
							  return value.toFixed(1) + percent2; // convert it to percentage
							},
						},
						 scaleLabel: {
							display: true,
							labelString: 'Concentración microalgas ['+percent+']'
						},

					},
					{
						id: 'B',
						type: 'linear',
						position: 'right',
						display: ejepamb,
						ticks: {
							min: 0,
							/*callback: function (value) {
							  return value.toFixed(1); // convert it to percentage
							},*/
						},
						 scaleLabel: {
							display: true,
							labelString: 'Parámetros Ambientales'
						},

					}
				]
			}
		}
	};

	var ctx3 = "";
	ctx3 = document.getElementById('chart-line3'+a).getContext('2d');
	myLine3[b] = new Chart(ctx3, config3);




}


function boton3(a){
    cambiar_grafico_my_function3(a,true);
}



function selectall(b) {


	 myLine3[b].data.datasets.forEach(function(ds) {
		ds.hidden = !ds.hidden;
	});
	 myLine3[b].update();
};


////////////////////////////////////////////////



$( "#btn-nuevo-grafico3").click(function(){
		var nrografico = $('.nuevo-grafico3').length;

		var htmlgrafico3 = '<div class="row nuevografico3">'+
                            '<div id="" class="nuevo-grafico3" style="margin-top:40px;"> '+
                            	'<button title="Eliminar Gráfico" type="button" class="close cerrar_nuevos_gradicos3 no-print" aria-label="Close" style="color: blue;float: right;margin-top: -10px;  margin-right:40px; font-size:30px;"><span aria-hidden="true">&times;</span></button>'+

                               ' <div class="row" style="margin-left:10px; margin-right:10px;">'+
                                  // ' <div class="text-center">'+
                                  //     ' <h3 style="font-size: 18px !important;"> DETALLE POR CENTRO</h3>'+
                                  // ' </div> '+
                                  // ' <hr style="margin-top:40px; ">'+
                                   ' <div style="width: 80%; float: left; margin-top: 15px;margin-left:50px;">'+
                                      '  <select  class="form-control" style="float: left; max-width:140px; margin-right:10px;cursor:pointer;"  id="region_filtro3_'+nrografico+'" name="region_filtro3" onChange="myFunction3('+nrografico+')" data-actions-box="true" >'+

                                            '<option value ="1">Última Semana </option>'+
                                           ' <option value ="2">Último Mes </option>'+
                                            '<option value ="0">Desde - Hasta </option>'+

                                       ' </select>'+
                                       ' <div class="input-group date"   id="datetimepicker_filtro1_3_'+nrografico+'" style="width:135px; display: none;float: left;margin-right: 10px;margin-left: 10px;">'+
                                           ' <input class="form-control" type="text" id="fecha_filtro_1_3_'+nrografico+'" name ="fecha_filtro_1_1" value="" >'+
                                           ' <div class="input-group-addon">'+
                                              '  <span class="glyphicon-calendar glyphicon"></span>'+
                                           ' </div>'+
                                       ' </div> '+
                                       ' <div class="input-group date"   id="datetimepicker_filtro2_3_'+nrografico+'" style="width:135px; display: none;float: left;margin-right:10px;">'+
                                           ' <input class="form-control" type="text" id="fecha_filtro_2_3_'+nrografico+'" name ="fecha_filtro_2_1" value="" >'+
                                           ' <div class="input-group-addon">'+
                                             '   <span class="glyphicon-calendar glyphicon"></span>'+
                                            '</div>'+
                                        '</div> '+
                                       ' <select id="especie_filtro3_'+nrografico+'" class="form-control" style="float: left; max-width:180px; margin-right:10px;cursor:pointer;" name="" >'+
                                           '<option value="2">Nivel Nocivo [%]</option>'+
										   '<option value="9">Nivel Nocivo [cel/ml]</option>'+
                                           '<option value="3">Nocivas [cel/ml]</option>'+
                                           '<option value="1">Fiscalizadas [cel/ml]</option>'+
                                           ' <option value="4">Diatomeas</option>'+
                                           ' <option value="5">Dinoflagelados</option>'+
                                           ' <option value="6">Otras Especies</option>'+
                                           ' <option class="label-danger" value="7">Con Alarma Crítico</option>'+
                                           ' <option class="label-warning" value="8">Con Alarma Precaución</option>'+
                                           ' <option class="label-info" value="10">Crítico y Precaución</option>'+
                                           ' <option class=" label-default" style="color: #fff !important;font-weight: bold;font-family: calibri" value="0">Todas [cel/ml]</option>      '+
                                       ' </select>'+
									   '<select id="pamb_filtro3_'+nrografico+'" class="form-control" style="float: left; max-width:170px; margin-right:10px;cursor:pointer;" multiple="multiple" name="select_pamb" >'+
                                          ' <option value="Temperatura [ºC]">Temperatura [ºC]</option>'+
                                          ' <option value="Salinidad">Salinidad</option>'+
                                          ' <option value="Oxigeno Disuelto [%]">Oxigeno Disuelto [%]</option>'+
                                          ' <option value="Oxigeno Disuelto [mg/l]">Oxigeno Disuelto [mg/l]</option>'+
                                          ' <option value="Disco Secchi [m]">Disco Secchi [m]</option>'+
                                       '</select>'+
									   '<select id="prof_filtro3_'+nrografico+'" class="form-control prof_filtro" style="float: left; max-width:95px; margin-right:10px;cursor:pointer;" name=""   >'+
									   		'<option value="1">Máxima</option>';
											$.each(opt, function (i, item) {
												htmlgrafico3 =  htmlgrafico3 + '<option value="'+(i+2)+'">'+opt[i]+'</option>';
												/*$('#prof_filtro3').append($('<option>', {
													value: (i+1),
													text : opt[i]
												}));*/
											});
                                        	/*'<option value="1">Máxima</option>'+
                                            '<option value="2">0.5 [m]</option>'+
                                            '<option value="3">5 [m]</option>'+
                                            '<option value="4">10 [m]</option>'+
                                            '<option value="5">15 [m]</option>'+*/
        htmlgrafico3 =  htmlgrafico3 + '</select>'+
                                       ' <select class="selectpicker centro_filtro oculto"  data-live-search="true" id="centro_filtro3_'+nrografico+'" name=""  data-actions-box="true" style="cursor:pointer;">'+
                                       ' </select>'+

                                       ' <button  type="button" id="boton3" style=" margin-left: 20px;"  onclick="boton3('+nrografico+');"  class="btn btn-primary btn-sm no-print">Filtrar</button>'+

                                   ' </div>'+

                                '</div>'+




                                '<div  class="graficos1e" style="margin-left: 1%;margin-right:  1%;     margin-bottom: 290px;">'+
                                   ' <div id="div_ojo10" class="col-lg-11 col-md-11 col-xs-11" style="padding: 20px; padding-top:0px; width:100%">'+
                                        '<a title="Ocultar al imprimir" href="javascript:void(0);" id="ojo10" onclick="ocultar10()" class ="no-print"><i class="fa fa-eye" style="display:none; font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>'+
                                        	'<div class="col-lg-3 col-lg-offset-9 col-md-3 col-md-offset-9 col-xs-3 col-xs-offset-9" style="padding-left:40px;">'+
                                            	'<a id="download3_'+nrografico+'" download="Detalle Centro.jpg"  href="" class="btn btn-default bg-flat-color-1" title="Descargar Gráfico como Imágen" style="margin-right:5px;">'+
                                                    '<i class="fa fa-download"></i>'+
                                                '</a>'+
												'<select id="especie_select_filtro3_'+nrografico+'" class="pull-right form-control no-print" style="margin-right:75px; display:"  data-live-search="true"  name="" multiple="multiple" data-actions-box="true" style="cursor:pointer;" ></select>'+
											/*'<button id="toggle3_'+nrografico+'" type="button" onClick="selectall('+(nrografico+1)+')" class="pull-right btn btn-default btn-sm no-print" style="margin-right:75px;" >Select all</button>'+*/
                                        	'</div>'+
                                        '<canvas class="resize" id="chart-line3_'+nrografico+'" height="100"></canvas> '+
                                    '</div>'+

                                '</div>'+
							'</div>'+
                            '<div id="saltoojoobs5_'+nrografico+'"></div>'+
                           ' <div id="ojo1saltoheader" class="si-print" style="display:none; padding-top:20px;"></div>'+
                            '<div id="div_ojoobs5_'+nrografico+'" class="col-lg-12 col-md-12 col-xs-12 no-print" style="padding: 0px 70px 15px 70px; width:100%">'+
                                '<a title="Ocultar al imprimir" id="ojoobs5_'+nrografico+'" onclick="ocultarobs5_('+nrografico+')" class ="no-print">'+
                                	'<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>'+
                                '</a>'+
                                '<a title="Insertar salto página al imprimir" id="ojoobs5_'+nrografico+'salto" onclick="ocultarobs5_salto('+nrografico+')" class ="no-print hidden">'+
                                    '<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />'+
                                '</a>'+

                                '<textarea id="textojoobs5_'+nrografico+'" style="resize:none" class="form-control textojoobs hidden" rows="2" cols="150" wrap="wrap" placeholder="Espacio para escribir comentarios al imprimir..."></textarea>'+
								'<div id="print_helper_textojoobs5_'+nrografico+'" class="print_helper_class" style="text-align: justify;"></div>'+
                            '</div>'+
				        ' </div>';


		/*if( (nrografico+1) % 3 == 0 && nrografico != 0){
			var cantencabezados3 = $( ".encabezado3").length;
			//Agregar Encabezado
			var saltoencabezado = 	'<div class="encabezado3"> <div id=""  class="saltopagina"></div>';
			//$( "#nuevos_gradicos3").html('</div> </div></div>');
			$( "#nuevos_gradicos3").append( saltoencabezado +encabezadohtml);
			//$( "#nuevos_gradicos3").append( encabezadohtml );
			$( "#nuevos_gradicos3").append( '</div>' );
			$( "#nuevos_gradicos3").append( htmlgrafico3 );
			//$( "#nuevos_gradicos3").append( '</div> </div>');
			var srclogo = $('#logoempresa').attr('src');
			if(srclogo.indexOf("Marine Harvest") !== -1){srclogo = "Marine Harvest Chile-wide.png";}
			$(".logoempresa").attr("src", srclogo);
		}else{*/
			$( "#nuevos_gradicos3").append( htmlgrafico3 );
			//$( "#nuevos_gradicos3").append( '</div>');
		//}


		$( ".cerrar_nuevos_gradicos3" ).one('click',function () {

            $(this).parent().parent().remove();

			//Remueve todos los encabezados y luego los crea ordenados
			/*$( ".encabezado3" ).remove();

			$( ".nuevografico3" ).each(function(index, element) {
                if( (index+1) % 3 == 0 && index != 0){
					var saltoencabezado = 	'<div class="encabezado3"> <div id=""  class="saltopagina"></div>';
					$(this).before( 	saltoencabezado+	encabezadohtml + 	'</div>' 	);
				}
            });
			var srclogo = $('#logoempresa').attr('src');
			if(srclogo.indexOf("Marine Harvest") !== -1){srclogo = "Marine Harvest Chile-wide.png";}
			$(".logoempresa").attr("src", srclogo);*/


        });

		//Crear, clonar los select
		var date1 = new Date();
		date1.setDate(date1.getDate()-6);
		$('#datetimepicker_filtro1_3_'+nrografico).datetimepicker({
					locale: 'es',
					defaultDate: date1,
					format: 'DD-MM-YYYY',

		});

		var date2 = new Date();
		date2.setDate(date2.getDate());
		$('#datetimepicker_filtro2_3_'+nrografico).datetimepicker({
					locale: 'es',
					defaultDate: date2,
					format: 'DD-MM-YYYY',
				useCurrent: false //Important! See issu
		});
		var $options = $("#especie_filtro3").last().clone({withDataAndEvents: true});
		$('#especie_filtro3_'+nrografico).append($options);

		var $options = $("#prof_filtro3").last().clone({withDataAndEvents: true});
		$('#prof_filtro3_'+nrografico).append($options);

		$('#centro_filtro3_'+nrografico).multiselect({
            enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
            //filterBehavior: 'value'
        });
		$('#especie_select_filtro3_'+nrografico).multiselect({
            nonSelectedText: 'Seleccionar Especies',
			includeSelectAllOption: true,
			allSelectedText: 'Todas las especies',
			nSelectedText: ' - Especies',
			numberDisplayed: 1,
			enableFiltering: true,
			enableCaseInsensitiveFiltering: true,
			enableClickableOptGroups: true,
			onDropdownHidden: function(option, checked, select) {cambiar_grafico_my_function3(nrografico,false);}
        });

		$('#pamb_filtro3_'+nrografico).multiselect({
			nonSelectedText: 'Parámetros Ambientales',
			includeSelectAllOption: true,
			allSelectedText: 'P. Ambientales',
			nSelectedText: ' - P. Ambientales',
			numberDisplayed: 1,
			enableFiltering: false,
			enableCaseInsensitiveFiltering: true,
			enableClickableOptGroups: true,
			maxWidth: 170,
			minWidth: 170,
		});


		$.each(especies_centros_select['Centros'], function (i, item) {

			if($('#idcentroespecie').val() != "" && $('#idcentroespecie').val() == item['IDcentro']){
				$('#centro_filtro3_'+nrografico).append('<option value="'+item['IDcentro']+'" selected>'+item['Nombre']+'</option>');
			}else{
				$('#centro_filtro3_'+nrografico).append('<option value="'+item['IDcentro']+'">'+item['Nombre']+'</option>');
			}

		});
		$('.centro_filtro').multiselect( 'rebuild' );


		//Agrga Comentarios
		// Observacion 5_
		ocultar_bool_obs5_[nrografico] = true;
		ocultarsalto_bool_obs5_[nrografico] = true;

		$('.textojoobs').each(function () {
		  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px; min-height:70px;overflow-y:hidden;resize:none; text-align: justify; padding: 25px;');
		}).on('input', function () {
		  this.style.height = 'auto';
		  this.style.height = (this.scrollHeight) + 'px';
		});

		$('.textojoobs').bind('keydown keyup keypress cut copy past blur change', function(){
			copy_to_print_helper(this.id); // consider debouncing this to avoid slowdowns!
		});



		//Actualizar gráfico
		var ctx3 = document.getElementById('chart-line3_'+nrografico).getContext('2d');
        myLine3[nrografico+1] = new Chart(ctx3, config3);
		cambiar_grafico_my_function3(nrografico,true);

		//Download Chart Image
		document.getElementById("download3_"+nrografico).addEventListener('click', function(){
		  /*Get image of canvas element*/
		  var url_base64jp = document.getElementById('chart-line3_'+nrografico).toDataURL("image/jpg");
		  /*get download button (tag: <a></a>) */
		  var a =  document.getElementById("download3_"+nrografico);
		  /*insert chart image url to download button (tag: <a></a>) */
		  a.href = url_base64jp;
		});



    });


//Agrega Observaciones dinmaicas para los ultmos graficos
var ocultar_bool_obs5_ = [];

function ocultarobs5_(nrografico){
	if(ocultar_bool_obs5_[nrografico] == false){
		$('#ojoobs5_'+nrografico).html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs5_'+nrografico).addClass("hidden");
		$('#ojoobs5_'+nrografico+'salto').addClass("hidden");
		$('#div_ojoobs5_'+nrografico).addClass("no-print");
		ocultar_bool_obs5_[nrografico]=true;
	}else{
		//$('#ojoobs5').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs5_'+nrografico).html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs5_'+nrografico).removeClass("hidden");
		$('#ojoobs5_'+nrografico+'salto').removeClass("hidden");
		$('#div_ojoobs5_'+nrografico).removeClass("no-print");
		ocultar_bool_obs5_[nrografico]=false;
	}
}
var ocultarsalto_bool_obs5_ = [];

function ocultarobs5_salto(nrografico){
	if(ocultarsalto_bool_obs5_[nrografico] == false){
		$('#ojoobs5_'+nrografico+'salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs5_'+nrografico).removeClass("page-break");
		$('#saltoojoobs5_'+nrografico).css("margin-top","0px");
		$('#ojoobs5_'+nrografico+'saltoheader').removeClass("si-print");
		ocultarsalto_bool_obs5_[nrografico]=true;
	}else{
		$('#ojoobs5_'+nrografico+'salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs5_'+nrografico).addClass("page-break");
		$('#saltoojoobs5_'+nrografico).css("margin-top","20px");
		$('#ojoobs5_'+nrografico+'saltoheader').html(encabezadohtml);

		ocultarsalto_bool_obs5_[nrografico]=false;
	}
}

function copy_to_print_helper(id){
	$('#print_helper_'+id).text($('#'+id).val());
}
$('.textojoobs').bind('keydown keyup keypress cut copy past blur change', function(){
	copy_to_print_helper(this.id); // consider debouncing this to avoid slowdowns!
});


////////////////////////////////////////////////
var especies_centros_select = [];
function loadespecies(){
	var fecha_filtro_1 = $('#fecha_filtro_1_1').val();
    var fecha_filtro_2 = $('#fecha_filtro_2_1').val();
	$.ajax({
            url: "load_informe_especies_centros_select.php",
            type: 'post',
			dataType: 'json',
            data: {Fecha_Inicio: fecha_filtro_1, Fecha_Termino: fecha_filtro_2,user_id: user_id},
            success: function(msg)
            {

				if(msg){
					especies_centros_select = msg;
					$('#especie_filtro1').empty();
					var n = 0;
          var selected = 0;
					$.each(msg['Especies'], function (i, item) {
						if(item['Fiscaliza'] == 1 ){
							if(n==0){
								$('#especie_filtro1').append('<optgroup label="Especies Fiscalizadas" disabled></optgroup>');
								n=1;
							}
						}else if(item['Nociva'] == 1 ){
							if(n==1){
								$('#especie_filtro1').append('<optgroup label="Especies Nocivas" disabled></optgroup>');
								n=2;
							}
						}else{
							if(n==2){
								$('#especie_filtro1').append('<optgroup label="Otras" disabled></optgroup>');
								n=3;
							}
						}

						if($('#idespecie').val() != "" && $('#idespecie').val() == item['IDespecie']){
							$('#especie_filtro1').append('<option value="'+item['IDespecie']+'" selected="selected">'+item['Nombre']+'</option>');
              selected = item['IDespecie'];
						}else{
							$('#especie_filtro1').append('<option value="'+item['IDespecie']+'">'+item['Nombre']+'</option>');
						}

            if (selected==0) {
              selected = item['IDespecie'];
            }

					});
					$('#especie_filtro1').multiselect( 'rebuild' );
          $('#especie_filtro1').multiselect('select',selected);
          $('#especie_filtro1').multiselect('refresh');

					$('#loading1').addClass("hidden");

					//filtro2
					$('#especie_filtro2').empty();
					var n = 0;
					$.each(msg['Especies2'], function (i, item) {
						if(item['Fiscaliza'] == 1 ){
							if(n==0){
								$('#especie_filtro2').append('<optgroup label="Especies Fiscalizadas" disabled></optgroup>');
								n=1;
							}
						}else if(item['Nociva'] == 1 ){
							if(n==1){
								$('#especie_filtro2').append('<optgroup label="Especies Nocivas" disabled></optgroup>');
								n=2;
							}
						}else{
							if(n==2){
								$('#especie_filtro2').append('<optgroup label="Otras" disabled></optgroup>');
								n=3;
							}
						}

						if($('#idespecie').val() != "" && $('#idespecie').val() == item['IDespecie']){
							$('#especie_filtro2').append('<option value="'+item['IDespecie']+'" selected>'+item['Nombre']+'</option>');
						}else{
							$('#especie_filtro2').append('<option value="'+item['IDespecie']+'">'+item['Nombre']+'</option>');
						}


					});
					$('#especie_filtro2').multiselect( 'rebuild' );
					$('#loading2').addClass("hidden");

					$('.centro_filtro').empty();
					var estado = '';
					$.each(msg['Centros'], function (i, item) {
						if(item['Estado'] == "0"){estado = ' (No Op.)';}else{estado = ''}
						if(msg['IDcentro_user'] == 0){ // Si es que el usuario no es un centro entonces que seleccione el centro mas relevante del día
							if($('#idcentroespecie').val() != "" && $('#idcentroespecie').val() == item['IDcentro']){
								$('.centro_filtro').append('<option value="'+item['IDcentro']+'" selected>'+item['Nombre']+estado+'</option>');
							}else{
								$('.centro_filtro').append('<option value="'+item['IDcentro']+'">'+item['Nombre']+estado+'</option>');
							}
						}else{ //Sino, que seleccione el centro correspondiente al usuario "Enviar Registro"
							if(item['IDcentro'] == msg['IDcentro_user']){
								$('.centro_filtro').append('<option value="'+item['IDcentro']+'" selected>'+item['Nombre']+estado+'</option>');
							}else{
								$('.centro_filtro').append('<option value="'+item['IDcentro']+'">'+item['Nombre']+estado+'</option>');
							}
						}

					});
					$('.centro_filtro').multiselect( 'rebuild' );

					//Centros para 2 primeros gráficos
					/*$('.centro_filtro2').empty();
					var estado1 = '';
					$.each(msg['Centros'], function (i, item) {
						if(item['Estado'] == "1"){
							$('.centro_filtro2').append('<option value="'+item['IDcentro']+'" selected>'+item['Nombre']+estado1+'</option>');
						}
					});
					$('.centro_filtro2').multiselect( 'rebuild' );
					$(".centro_filtro2").multiselect('selectAll', false);
					$(".centro_filtro2").multiselect('updateButtonText');*/

					graficar01(true);
					loadresumen(true);
					cambiar_grafico_my_function1(true);
					cambiar_grafico_my_function2(true);
					cambiar_grafico_my_function3(-1,true);



					var srclogo = $('#logoempresa').attr('src');
					if(srclogo.indexOf("Marine Harvest") !== -1){srclogo = "Marine Harvest Chile-wide.png";}
					$(".logoempresa").attr("src", srclogo);
				}
			},
			error: function(result) {
			}
		});

}
$('#datetimepicker_filtro1_1, #datetimepicker_filtro2_1').on('dp.change', function(e){
	loadespeciespresentes(1);
})
$('#datetimepicker_filtro1_2').on('dp.change', function(e){
	loadespeciespresentes(2);
})


function loadespeciespresentes(a){
	var fecha_filtro_1 = $('#fecha_filtro_1_'+a).val();
    var fecha_filtro_2 = $('#fecha_filtro_2_'+a).val();
	$('#loading'+a).removeClass("hidden");

	$.ajax({
            url: "load_informe_especies_presentes.php",
            type: 'post',
			dataType: 'json',
            data: {Fecha_Inicio: fecha_filtro_1, Fecha_Termino: fecha_filtro_2, user_id: user_id},
            success: function(msg)
            {

				if(msg){
					$('#especie_filtro'+a).empty();
					var n = 0;
					$.each(msg, function (i, item) {
						if(item['Fiscaliza'] == 1 ){
							if(n==0){
								$('#especie_filtro'+a).append('<optgroup label="Especies Fiscalizadas" disabled></optgroup>');
								n=1;
							}
						}else if(item['Nociva'] == 1 ){
							if(n==1){
								$('#especie_filtro'+a).append('<optgroup label="Especies Nocivas" disabled></optgroup>');
								n=2;
							}
						}else{
							if(n==2){
								$('#especie_filtro'+a).append('<optgroup label="Otras" disabled></optgroup>');
								n=3;
							}
						}

						if($('#idespecie').val() != "" && $('#idespecie').val() == item['IDespecie']){
							$('#especie_filtro'+a).append('<option value="'+item['IDespecie']+'" selected>'+item['Nombre']+'</option>');
						}else{
							$('#especie_filtro'+a).append('<option value="'+item['IDespecie']+'">'+item['Nombre']+'</option>');
						}


					});
					$('#especie_filtro'+a).multiselect( 'rebuild' );

				}
				$('#loading'+a).addClass("hidden");
			},
			error: function(result) {
			}
		});

}

//////////// Ingresos ////////

document.getElementById("dropdown01").addEventListener('click', function (event) {
	event.stopPropagation();
});

$('#centro_filtro_operando01').change( function(){
	loadselectcentros01();
});

$('#filtercentros01').change( function(){
	loadselectcentros01();
})
function loadselectcentros01(){

	var distribucion_aux = [];
	var dist = $('#filtercentros01').val();
	switch(dist) {
			case 'Region':
				distribucion_aux = distribucion['Region_Centro'];
				break;
			case 'Barrio':
				distribucion_aux = distribucion['Barrio_Centro'];
				break;
			case 'Area':
				distribucion_aux = distribucion['Area_Centro'];
		}

	if(distribucion_aux){
		var centroshabilitados_aux = $('#centro_filtro_operando01').val();

		$('#centro_filtro01').empty();
		var optgroup = "";
		$.each(distribucion_aux, function (i, item) {
			if(optgroup !=item[2] ){
				$('#centro_filtro01').append('<optgroup label="'+item[2]+'"></optgroup>');
				optgroup = item[2];
			}
			if(centroshabilitados_aux == item[3] || centroshabilitados_aux == 2){
				$('#centro_filtro01').append('<option value="'+item[0]+'">'+item[1]+'</option>');
			}

		});
		$('#centro_filtro01').multiselect( 'rebuild' );
		$("#centro_filtro01").multiselect('selectAll', false);
		$("#centro_filtro01").multiselect('updateButtonText');
	}

}


//////////// Resumen Concentraciones ////////

// Prevents menu from closing when clicked inside
document.getElementById("dropdown02").addEventListener('click', function (event) {
	event.stopPropagation();
});

$('#centro_filtro_operando02').change( function(){
	loadselectcentros02();
});

$('#filtercentros02').change( function(){
	loadselectcentros02();
})
function loadselectcentros02(){

	var distribucion_aux = [];
	var dist = $('#filtercentros02').val();
	switch(dist) {
			case 'Region':
				distribucion_aux = distribucion['Region_Centro'];
				break;
			case 'Barrio':
				distribucion_aux = distribucion['Barrio_Centro'];
				break;
			case 'Area':
				distribucion_aux = distribucion['Area_Centro'];
		}

	if(distribucion_aux){
		var centroshabilitados_aux = $('#centro_filtro_operando02').val();

		$('#centro_filtro02').empty();
		var optgroup = "";
		$.each(distribucion_aux, function (i, item) {
			if(optgroup !=item[2] ){
				$('#centro_filtro02').append('<optgroup label="'+item[2]+'"></optgroup>');
				optgroup = item[2];
			}
			if(centroshabilitados_aux == item[3] || centroshabilitados_aux == 2){
				$('#centro_filtro02').append('<option value="'+item[0]+'">'+item[1]+'</option>');
			}

		});
		$('#centro_filtro02').multiselect( 'rebuild' );
		$("#centro_filtro02").multiselect('selectAll', false);
		$("#centro_filtro02").multiselect('updateButtonText');
	}

}


//Agregar encabezado
var today = new Date();
	var monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
	  "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
	];
	var fechaactual = today.getDate() + " de "+ monthNames[today.getMonth()]+ " de " +today.getFullYear();
	/*$('.Datelistatareas').each(function(){
		$(this).text(fechaactual);
	});*/

	gerencia = "Departamento Gestión Ambiental";
	if(id_empresa == 4){
		gerencia = "Gerencia de Licencias & Medioambiente";
	}else if(id_empresa == 10){
		gerencia = "Medio Ambiente";
	}
	var encabezadohtml = '<div class="row si-print"  style=" display:none; margin-top:0px; margin-bottom:15px; width:100%;">'+
                        	'<div class="col-md-3 col-sm-3 col-xs-3 text-center">'+
                             	'<img src="GtrFan-MonitoreoAlgasNocivas.png" style="width:60%; margin-top:10px; margin-left:15px;"/> '+
                            '</div>'+
                            '<div class="col-md-6 col-sm-6 col-xs-6 ">'+
                               ' <h3 style="font-size:18px !important;">'+
                                    'INFORME FLORACIÓN ALGAS NOCIVAS'+
                                    '<a title="Ocultar toda la sección al imprimir" href="javascript:void(0);" id="ojoseccion1" onclick="ocultarseccion1()" class ="no-print"><i class="fa fa-eye" style=" display:none;font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i></a>'+
                               '</h3>'+
                               '<p style="font-size:18px; text-align:center">'+gerencia+'</p>'+
							   //Departamento Gestión Ambiental
                              ' <output id="" class="Datelistatareas" style="display: flex !important;align-items: center;justify-content: center;    margin-top: -10px;">'+fechaactual+'</output>'+
                            '</div>'+
                            '<div class="col-md-3 col-sm-3 col-xs-3  text-center">'+
                            	 '<img class="logoempresa" src="" style=" margin-top:7px; margin-rigtht:15px; max-height: 85px !important; padding:10px !important;" />'+
                           ' </div>'+

                       ' </div>'+
					   '<hr class="si-print" style="display:none;margin-top:20px; ">';

$('.encabezado').html(encabezadohtml);


var ocultar_bool_0 = false;

function ocultar0(){
	if(ocultar_bool_0 == false){
		$('#ojo0').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;float:right; margin-right:10px; margin-top:-10px"></i>');
		$('#div_ojo0').addClass("no-print");
		ocultar_bool_0=true;
	}else{
		$('#ojo0').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor; float:right; margin-right:10px; margin-top:-10px"></i>');
		$('#div_ojo0').removeClass("no-print");
		ocultar_bool_0=false;
	}
	ocultarseccion();

}

var ocultar_bool_01 = false;

function ocultar01(){
	if(ocultar_bool_01 == false){
		$('#ojo01').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo01').addClass("no-print");
		ocultar_bool_01=true;
	}else{
		$('#ojo01').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo01').removeClass("no-print");
		ocultar_bool_01=false;
	}
	ocultarseccion();

}

var ocultar_bool_02 = false;

function ocultar02(){
	if(ocultar_bool_02 == false){
		$('#ojo02').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo02').addClass("no-print");
		ocultar_bool_02=true;
	}else{
		$('#ojo02').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo02').removeClass("no-print");
		ocultar_bool_02=false;
	}
	ocultarseccion();

}


var ocultar_bool_1 = false;

function ocultar1(){
	if(ocultar_bool_1 == false){
		$('#ojo1').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo1').addClass("no-print");
		ocultar_bool_1=true;
	}else{
		$('#ojo1').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo1').removeClass("no-print");
		ocultar_bool_1=false;
	}
	ocultarseccion();

}

var ocultar_bool_2 = false;

function ocultar2(){
	if(ocultar_bool_2 == false){
		$('#ojo2').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo2').addClass("no-print");
		ocultar_bool_2=true;
	}else{
		$('#ojo2').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo2').removeClass("no-print");
		ocultar_bool_2=false;
	}
	ocultarseccion();

}

var ocultar_bool_3 = false;

function ocultar3(){
	if(ocultar_bool_3 == false){
		$('#ojo3').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo3').addClass("no-print");
		ocultar_bool_3=true;
	}else{
		$('#ojo3').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo3').removeClass("no-print");
		ocultar_bool_3=false;
	}
	ocultarseccion();

}

var ocultar_bool_4 = false;

function ocultar4(){
	if(ocultar_bool_4 == false){
		$('#ojo4').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo4').addClass("no-print");
		ocultar_bool_4=true;
	}else{
		$('#ojo4').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;position: absolute; right: 300px;"></i>');
		$('#div_ojo4').removeClass("no-print");
		ocultar_bool_4=false;
	}
	ocultarseccion();

}

function ocultarseccion(){
	if($('#div_ojo0').hasClass("no-print") && $('#div_ojo01').hasClass("no-print") && $('#div_ojo02').hasClass("no-print")){
		$('#div_ojoseccion1').addClass("no-print");
	}else{
		$('#div_ojoseccion1').removeClass("no-print");
	}

	if($('#div_ojo4').hasClass("no-print") && $('#div_ojo1').hasClass("no-print")){
		$('#div_ojoseccion2').addClass("no-print");
	}else{
		$('#div_ojoseccion2').removeClass("no-print");
	}

	/*if(ocultar_bool_1 || ocultar_bool_2){
		$('#saltoseccion3').removeClass("saltopagina");
		$('#encabezadoseccion3').addClass("no-print");
	}else{
		$('#saltoseccion3').addClass("saltopagina");
		$('#encabezadoseccion3').removeClass("no-print");
	}*/

}

// Observacion 1
var ocultar_bool_obs1 = true;

function ocultarobs1(){
	if(ocultar_bool_obs1 == false){
		$('#ojoobs1').html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs1').addClass("hidden");
		$('#ojoobs1salto').addClass("hidden");
		$('#div_ojoobs1').addClass("no-print");
		ocultar_bool_obs1=true;
	}else{
		//$('#ojoobs1').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs1').html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs1').removeClass("hidden");
		$('#ojoobs1salto').removeClass("hidden");
		$('#div_ojoobs1').removeClass("no-print");
		ocultar_bool_obs1=false;
	}

}
$("#textojoobs1").bind('keyup', function (e) {
	if($("#textojoobs1").val() != ""){
		ocultar_bool_obs1 = true;
		ocultarobs1();
	}else{
		ocultar_bool_obs1 = false;
		ocultarobs1();
	}
});
var ocultarsalto_bool_obs1 = true;

function ocultarobs1salto(){
	if(ocultarsalto_bool_obs1 == false){
		$('#ojoobs1salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs1').removeClass("page-break");
		$('#saltoojoobs4').css("margin-top","0px");
		$('#ojoobs1saltoheader').removeClass("si-print");
		$('#saltoojoobs1hr').removeClass("no-print");
		ocultarsalto_bool_obs1=true;
	}else{
		$('#ojoobs1salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs1').addClass("page-break");
		$('#saltoojoobs4').css("margin-top","20px");
		$('#ojoobs1saltoheader').html(encabezadohtml);
		//headerbreak("ojoobs1saltoheader");
		$('#saltoojoobs1hr').addClass("no-print");

		ocultarsalto_bool_obs1=false;
	}
}

//  Observacion 2
var ocultar_bool_obs2 = true;

function ocultarobs2(){
	if(ocultar_bool_obs2 == false){
		$('#ojoobs2').html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs2').addClass("hidden");
		$('#ojoobs2salto').addClass("hidden");
		$('#div_ojoobs2').addClass("no-print");
		ocultar_bool_obs2=true;
	}else{
		//$('#ojoobs2').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs2').html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs2').removeClass("hidden");
		$('#ojoobs2salto').removeClass("hidden");
		$('#div_ojoobs2').removeClass("no-print");
		ocultar_bool_obs2=false;
	}

}
$("#textojoobs2").bind('keyup', function (e) {
	if($("#textojoobs2").val() != ""){
		ocultar_bool_obs2 = true;
		ocultarobs2();
	}else{
		ocultar_bool_obs2 = false;
		ocultarobs2();
	}
});
var ocultarsalto_bool_obs2 = true;

function ocultarobs2salto(){
	if(ocultarsalto_bool_obs2 == false){
		$('#ojoobs2salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs2').removeClass("page-break");
		$('#saltoojoobs4').css("margin-top","0px");
		$('#ojoobs2saltoheader').removeClass("si-print");
		$('#saltoojoobs2hr').removeClass("no-print");
		ocultarsalto_bool_obs2=true;
	}else{
		$('#ojoobs2salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs2').addClass("page-break");
		$('#saltoojoobs4').css("margin-top","20px");
		$('#ojoobs2saltoheader').html(encabezadohtml);
		//headerbreak("ojoobs2saltoheader");
		$('#saltoojoobs2hr').addClass("no-print");

		ocultarsalto_bool_obs2=false;
	}
}

// Observacion 3
var ocultar_bool_obs3 = true;

function ocultarobs3(){
	if(ocultar_bool_obs3 == false){
		$('#ojoobs3').html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs3').addClass("hidden");
		$('#ojoobs3salto').addClass("hidden");
		$('#div_ojoobs3').addClass("no-print");
		ocultar_bool_obs3=true;
	}else{
		//$('#ojoobs3').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs3').html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs3').removeClass("hidden");
		$('#ojoobs3salto').removeClass("hidden");
		$('#div_ojoobs3').removeClass("no-print");
		ocultar_bool_obs3=false;
	}

}
$("#textojoobs3").bind('keyup', function (e) {
	if($("#textojoobs3").val() != ""){
		ocultar_bool_obs3 = true;
		ocultarobs3();
	}else{
		ocultar_bool_obs3 = false;
		ocultarobs3();
	}
});
var ocultarsalto_bool_obs3 = true;

function ocultarobs3salto(){
	if(ocultarsalto_bool_obs3 == false){
		$('#ojoobs3salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs3').removeClass("page-break");
		$('#saltoojoobs4').css("margin-top","0px");
		$('#ojoobs3saltoheader').removeClass("si-print");
		$('#saltoojoobs3hr').removeClass("no-print");
		ocultarsalto_bool_obs3=true;
	}else{
		$('#ojoobs3salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs3').addClass("page-break");
		$('#saltoojoobs4').css("margin-top","20px");
		$('#ojoobs3saltoheader').html(encabezadohtml);
		//headerbreak("ojoobs3saltoheader");
		$('#saltoojoobs3hr').addClass("no-print");

		ocultarsalto_bool_obs3=false;
	}
}


// Observacion 4
var ocultar_bool_obs4 = true;

function ocultarobs4(){
	if(ocultar_bool_obs4 == false){
		$('#ojoobs4').html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs4').addClass("hidden");
		$('#ojoobs4salto').addClass("hidden");
		$('#div_ojoobs4').addClass("no-print");
		ocultar_bool_obs4=true;
	}else{
		//$('#ojoobs4').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs4').html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs4').removeClass("hidden");
		$('#ojoobs4salto').removeClass("hidden");
		$('#div_ojoobs4').removeClass("no-print");
		ocultar_bool_obs4=false;
	}

}
$("#textojoobs4").bind('keyup', function (e) {
	if($("#textojoobs4").val() != ""){
		ocultar_bool_obs4 = true;
		ocultarobs4();
	}else{
		ocultar_bool_obs4 = false;
		ocultarobs4();
	}
});
var ocultarsalto_bool_obs4 = true;

function ocultarobs4salto(){
	if(ocultarsalto_bool_obs4 == false){
		$('#ojoobs4salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs4').removeClass("page-break");
		$('#saltoojoobs4').css("margin-top","0px");
		$('#ojoobs4saltoheader').removeClass("si-print");
		$('#saltoojoobs4hr').removeClass("no-print");
		ocultarsalto_bool_obs4=true;
	}else{
		$('#ojoobs4salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs4').addClass("page-break");
		$('#saltoojoobs4').css("margin-top","20px");
		$('#ojoobs4saltoheader').html(encabezadohtml);
		//headerbreak("ojoobs4saltoheader");
		$('#saltoojoobs4hr').addClass("no-print");

		ocultarsalto_bool_obs4=false;
	}
}

// Observacion 5
var ocultar_bool_obs5 = true;

function ocultarobs5(){
	if(ocultar_bool_obs5 == false){
		$('#ojoobs5').html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs5').addClass("hidden");
		$('#ojoobs5salto').addClass("hidden");
		$('#div_ojoobs5').addClass("no-print");
		ocultar_bool_obs5=true;
	}else{
		//$('#ojoobs5').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs5').html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs5').removeClass("hidden");
		$('#ojoobs5salto').removeClass("hidden");
		$('#div_ojoobs5').removeClass("no-print");
		ocultar_bool_obs5=false;
	}

}
$("#textojoobs5").bind('keyup', function (e) {
	if($("#textojoobs5").val() != ""){
		ocultar_bool_obs5 = true;
		ocultarobs5();
	}else{
		ocultar_bool_obs5 = false;
		ocultarobs5();
	}
});
var ocultarsalto_bool_obs5 = true;

function ocultarobs5salto(){
	if(ocultarsalto_bool_obs5 == false){
		$('#ojoobs5salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs5').removeClass("page-break");
		$('#saltoojoobs5').css("margin-top","0px");
		$('#ojoobs5saltoheader').removeClass("si-print");
		$('#saltoojoobs5hr').removeClass("no-print");
		ocultarsalto_bool_obs5=true;
	}else{
		$('#ojoobs5salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs5').addClass("page-break");
		$('#saltoojoobs5').css("margin-top","20px");
		$('#ojoobs5saltoheader').html(encabezadohtml);
		//headerbreak("ojoobs5saltoheader");
		$('#saltoojoobs5hr').addClass("no-print");

		ocultarsalto_bool_obs5=false;
	}
}

var ocultar_bool_5 = true;

function ocultar5(){
	if(ocultar_bool_5 == false){
		$('#ojo5').html('<i class="fa fa-eye-slash" style="font-size:30px;color:indianred;float: right;"></i>');
		$('#div_ojo5').addClass("no-print");
		ocultar_bool_5=true;
	}else{
		$('#ojo5').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer;float: right;"></i>');
		$('#div_ojo5').removeClass("no-print");
		ocultar_bool_5=false;
	}

}
$("#textojo5").bind('keyup', function (e) {
	if($("#textojo5").val() != ""){
		ocultar_bool_5 = true;
		ocultar5();
	}else{
		ocultar_bool_5 = false;
		ocultar5();
	}
});
var ocultarsalto_bool_5 = true;

function ocultar5salto(){
	if(ocultarsalto_bool_5 == false){
		$('#ojo5salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojo5').removeClass("page-break");
		$('#ojo5saltoheader').removeClass("si-print");
		//$('#saltoojo5hr').removeClass("no-print");
		ocultarsalto_bool_5=true;
	}else{
		$('#ojo5salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojo5').addClass("page-break");
		$('#ojo5saltoheader').html(encabezadohtml);
		//headerbreak("ojo5saltoheader");
		//$('#saltoojo5hr').addClass("no-print");

		ocultarsalto_bool_5=false;
	}
}


// Observacion 6
var ocultar_bool_obs6 = true;

function ocultarobs6(){
	if(ocultar_bool_obs6 == false){
		$('#ojoobs6').html('<button title="Agregar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-plus-circle"> </i> Agregar Comentario </button>');
		$('#textojoobs6').addClass("hidden");
		$('#ojoobs6salto').addClass("hidden");
		$('#div_ojoobs6').addClass("no-print");
		ocultar_bool_obs6=true;
	}else{
		//$('#ojoobs6').html('<i class="fa fa-eye" style="font-size:30px;color:currentColor;cursor:pointer; float: right;"></i>');
		$('#ojoobs6').html('<button title="Quitar Comentario" type="button" id="" style="float: right; margin-bottom:5px;" class="btn btn-default btn-sm no-print center-block"> <i class="fa fa-trash"> </i> Quitar Comentario </button>');

		$('#textojoobs6').removeClass("hidden");
		$('#ojoobs6salto').removeClass("hidden");
		$('#div_ojoobs6').removeClass("no-print");
		ocultar_bool_obs6=false;
	}

}
$("#textojoobs6").bind('keyup', function (e) {
	if($("#textojoobs6").val() != ""){
		ocultar_bool_obs6 = true;
		ocultarobs6();
	}else{
		ocultar_bool_obs6 = false;
		ocultarobs6();
	}
});
var ocultarsalto_bool_obs6 = true;

function ocultarobs6salto(){
	if(ocultarsalto_bool_obs6 == false){
		$('#ojoobs6salto').html('<img src="page-break-slash.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs6').removeClass("page-break");
		$('#saltoojoobs6').css("margin-top","0px");
		$('#ojoobs6saltoheader').removeClass("si-print");
		$('#saltoojoobs6hr').removeClass("no-print");
		ocultarsalto_bool_obs6=true;
	}else{
		$('#ojoobs6salto').html('<img src="page-break.png" class="fa" style=" float:right;width: 20px; margin-right:10px; margin-top:6px" />');
		$('#saltoojoobs6').addClass("page-break");
		$('#saltoojoobs6').css("margin-top","20px");
		$('#ojoobs6saltoheader').html(encabezadohtml);
		//headerbreak("ojoobs6saltoheader");
		$('#saltoojoobs6hr').addClass("no-print");

		ocultarsalto_bool_obs6=false;
	}

}



function beforePrint () {
  for (const id in Chart.instances) {
	Chart.instances[id].resize()
  }

	$('#graficosseccion02 .fixed-table-body').css("max-height","none");

}

function afterPrint () {
	$('#graficosseccion02 .fixed-table-body').css("max-height","500px");
}



if (window.matchMedia) {
  let mediaQueryList = window.matchMedia('print')
  mediaQueryList.addListener((mql) => {
    if (mql.matches) {
      beforePrint()
    }
  })
}

window.onbeforeprint = beforePrint
window.onafterprint = afterPrint

$('.textojoobs').each(function () {
  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px; min-height:70px;overflow-y:hidden;resize:none; text-align: justify; padding: 25px;');
}).on('input', function () {
  this.style.height = 'auto';
  this.style.height = (this.scrollHeight) + 'px';
});




////////////////////
////// MAPAS ///////
////////////////////

var date1 = new Date();
date1.setDate(date1.getDate()-6);
$('#datetimepicker_filtro4_1').datetimepicker({
			locale: 'es',
			defaultDate: date1,
			format: 'DD-MM-YYYY',

});


//var marker;
var map1;
var map2;
var map3;
var map4;
var map5;
var map6;
var map7;
var center;
var zoom = 9;
var zoomnombre = 11;
var mhlevel = {lat: -44.6, lng: -74.38};
var xregion = {lat: -42.13, lng: -73.5};
var xiregion = {lat: -44.98, lng: -74.0};
var xiiregion = {lat: -52.6, lng: -72.3};
var colorlabelmarker = 'white';
var sinmarker = "sin1.png";
function initMap() {

	 map1 = new google.maps.Map(document.getElementById('map1'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});
	map2 = new google.maps.Map(document.getElementById('map2'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});
	map3 = new google.maps.Map(document.getElementById('map3'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});
	map4 = new google.maps.Map(document.getElementById('map4'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});
	map5 = new google.maps.Map(document.getElementById('map5'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});
	map6 = new google.maps.Map(document.getElementById('map6'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});
	map7 = new google.maps.Map(document.getElementById('map7'), {
	  zoom: zoom,
	  center: mhlevel,
	  disableDefaultUI: true,
	  mapTypeId: 'satellite'
	});

	map1.setCenter(xregion);
	map2.setCenter(xregion);
	map3.setCenter(xregion);
	map4.setCenter(xregion);
	map5.setCenter(xregion);
	map6.setCenter(xregion);
	map7.setCenter(xregion);

}


function asdfa(position,nombrecentro,idcentro,classindicador,map_id){

	if( $('#nombreswitch').val() == 0 ){nombrecentro = ' ';}
	var visible = false;
	if($('#tipomapa').val() == 1){
		visible = true;
	}
	switch(map_id) {
	  case 1:
	    var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map1,
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
				  },
				  visible: visible,
			  });
		markers1.push({name: mi_marker,  index:  idcentro});
		break;
	  case 2:
	     var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map2,
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
			  });
		markers2.push({name: mi_marker,  index:  idcentro});
		break;
	  case 3:
	     var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map3,
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
			  });
		markers3.push({name: mi_marker,  index:  idcentro});
		break;
	  case 4:
	     var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map4,
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
			  });
		markers4.push({name: mi_marker,  index:  idcentro});
		break;
	  case 5:
	     var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map5,
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
			  });
		markers5.push({name: mi_marker,  index:  idcentro});
		break;
	  case 6:
	     var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map6,
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
			  });
		markers6.push({name: mi_marker,  index:  idcentro});
		break;
	  case 7:
	     var  mi_marker = new google.maps.Marker({
				  position: position,
				  map: map7,
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
			  });
		markers7.push({name: mi_marker,  index:  idcentro});
		break;
	}
	//markers.push({name: mi_marker,  index:  idcentro});

 }

 function eliminarArreglo (mi_indice,map_id){
	 var posicionkey = 0;
	 var markers_aux;
	 switch(map_id) {
	  case 1:
		$.each(markers1, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers1.splice(posicionkey,1);
		break;
	  case 2:
		$.each(markers2, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers2.splice(posicionkey,1);
		break;
	  case 3:
		$.each(markers3, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers3.splice(posicionkey,1);
		break;
	  case 4:
		$.each(markers4, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers4.splice(posicionkey,1);
		break;
	  case 5:
		$.each(markers5, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers5.splice(posicionkey,1);
		break;
	  case 6:
		$.each(markers6, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers6.splice(posicionkey,1);
		break;
	  case 7:
		$.each(markers7, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers7.splice(posicionkey,1);
		break;
	}


 }

 function clearMarkers (map_id){
	 switch(map_id) {
	  case 1:
		$.each(markers1, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	  case 2:
		$.each(markers2, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	  case 3:
		$.each(markers3, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	  case 4:
		$.each(markers4, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	  case 5:
		$.each(markers5, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	  case 6:
		$.each(markers6, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	  case 7:
		$.each(markers7, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		break;
	}

 }


 function emptyMarkers (day,map_id){
	var centromidio = [];
	for (var i = 0; i<tablacompleta.length; i++){
		if(parseInt(tablacompleta[i][day]) >= 0){
			centromidio.push(tablacompleta[i]['IDcentro']);
		}
	}
	var iconoaux = sinmarker;
	var markers_aux;
	switch(map_id) {
	  case 1:
		markers_aux = markers1;
		break;
	  case 2:
		markers_aux = markers2;
		break;
	  case 3:
		markers_aux = markers3;
		break;
	  case 4:
		markers_aux = markers4;
		break;
	  case 5:
		markers_aux = markers5;
		break;
	  case 6:
		markers_aux = markers6;
		break;
	  case 7:
		markers_aux = markers7;
		break;
	}
	$.each(markers_aux, function (i, value) {

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

			if($('#tipomapa').val() == 1){
				element.setVisible(true);
			}else{
				element.setVisible(false);
			}

	});
 }


 function nombreMarkers (map_id){
	 var nombrecentro = " ";
	 var markers_aux;
	switch(map_id) {
	  case 1:
		markers_aux = markers1;
		break;
	  case 2:
		markers_aux = markers2;
		break;
	  case 3:
		markers_aux = markers3;
		break;
	  case 4:
		markers_aux = markers4;
		break;
	  case 5:
		markers_aux = markers5;
		break;
	  case 6:
		markers_aux = markers6;
		break;
	  case 7:
		markers_aux = markers7;
		break;
	}
	 $.each(markers_aux, function (i, value) {
			if( $('#nombreswitch').val() == 0 ){ nombrecentro = " ";}else{nombrecentro = nombrecentroarray[value.index];}
			element = value.name;
			var label = element.getLabel();
			label.text = nombrecentro;
			element.setLabel(label);
	});

 }


$("#showcentros").hide();
var datos = [];
var opt = [];
var nombrecentroarray = [];
var markers1 = new Array();
var markers2 = new Array();
var markers3 = new Array();
var markers4 = new Array();
var markers5 = new Array();
var markers6 = new Array();
var markers7 = new Array();
var markers_barrio1 = new Array();
var markers_barrio2 = new Array();
var markers_barrio3 = new Array();
var markers_barrio4 = new Array();
var markers_barrio5 = new Array();
var markers_barrio6 = new Array();
var markers_barrio7 = new Array();
var fistcentermap = 1;
var datosbarrio = [];
var nombreregion = "Región de los Lagos";
function loadcentros() {
	datos = [];
	opt = [];
	//if($('#tipomapa').val() == 1){
		$.ajax({
			url: "load_ubicacion_centros_barrios_informe.php",
			type: 'post',
			data: {
				user_id:			user_id,
				Nombre_Region: 	  nombreregion,
				Colaborativo:	   0,
				Operando:		   1,
				Historia:		   0,
			},
			success: function(dato)
			{

				datos = JSON.parse(dato);

				$( '#showcentros' ).empty();
				$('#opcionescentros').empty();

				if(datos['Error'] == 0){
					for(var x=1; x<=7;x++){
						clearMarkers(x);

						for(var i = 0; i < datos['Nombre'].length; i++){
							var topleft = datos['TopLeft'][i].split(",");
							var position = {lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])};

							asdfa(position,datos['Nombre'][i],datos["IDcentro"][i],sinmarker,x);

							//Guarda los nombres de los centros para que al ocultar los nombres se puedan recuperar despues
							nombrecentroarray[datos["IDcentro"][i]] = datos['Nombre'][i];
						}
					}


					$("#showcentros").show();


					//Agregar ACS
					$('#acsselectmap').empty();
					$('#acsselectmap').append($('<option>', {
							text :'Centrar',
							value: 0
						}));
					$.each(datos['TopLeft_Barrio'], function(index, item){
						$('#acsselectmap').append($('<option>', {
							text : item['Nombre'],
							value: item['IDbarrio']
						}));
					});


					//Vista del centro correspondiente al usuario logeado

					if(datos['TopLeft_Usuario'] != "" && fistcentermap == 1){
						fistcentermap = 0;
						var topleftusuario = datos['TopLeft_Usuario'].split(",");
						var positionusuario = {lat: parseFloat(topleftusuario[0]), lng: parseFloat(topleftusuario[1])};
						map1.setCenter(positionusuario);
						map2.setCenter(positionusuario);
						map3.setCenter(positionusuario);
						map4.setCenter(positionusuario);
						map5.setCenter(positionusuario);
						map6.setCenter(positionusuario);
						map7.setCenter(positionusuario);
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
					for(var x=1; x<=7;x++){
						clearMarkers(x);
					}
				}else{swal("Error", "Error al cargar ubicación de los Centros.", "error");}
			},error: function(msg){console.log(msg);}
		});
	//}else{
		//Buscar los poligonos de los barrios
		$.ajax({
			url: "load_ubicacion_barrios_colab_informe.php",
			type: 'post',
			data: {
				user_id:			user_id
			},
			success: function(dato)
			{

				datosbarrio = JSON.parse(dato);

				if(datosbarrio['Error'] == 0){
					for(var x=1; x<=7;x++){
						clearMarkersbarrio(x);
						var tex = "Buscar Centro";
						$.each( datosbarrio['TopLeft'], function( key, value ) {
								asdfabarrio(value,"#ab5400",key,x);
						});
					}
				}else if(datos['Error'] == "No existe"){
					for(var x=1; x<=7;x++){
						clearMarkersbarrio(x);
					}
				}else{swal("Error", "Error al cargar ubicación de los Barrios.", "error");}
			},error: function(msg){console.log(msg);}
		});
	//}
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

				}
				loadresumen2();

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
				$('#resumenreporte2').bootstrapTable('resetSearch','Fiscalizada');
				//$('#resumenreporte').bootstrapTable('onColumnSearch','Fiscaliza','Si');
			}else if(sel < 2){
				$('#resumenreporte2').bootstrapTable('resetSearch','');
			}else if(sel == 2){
				$('#resumenreporte2').bootstrapTable('resetSearch','Nociva');
			}else{
				$('#resumenreporte2').bootstrapTable('resetSearch',$('#especiesselectmap option:selected').text());
			}

	//}
	//graficar_mapa();
});
/*$('#nromedicionresumen' ).change( function(){
	loadresumen2();
	graficar_mapa();
});*/

/*$('#dias' ).change( function(){
	if($('#dias' ).val()>14){
		$('#dias' ).val(14);
	}else if($('#dias' ).val()>=7){
	var rowCount = $('#resumenreporte th').length;
	var remove = "nth-last-child(-n+"+(rowCount-7)+")";
	$('#resumenreporte').bootstrapTable('destroy');

	$('#resumenreporte tr').find('th:'+remove+', td:'+remove+'').remove();
	loadresumen();
	}else{$('#dias' ).val(7);}
});*/

function boton4(){
	$('#loading3').removeClass("hidden");
	loadresumen2();
}

var tablacompleta = [];
var especiesselectmap_anterior = "";
var inicial = true;
function loadresumen2(){
	//Variables para mantener los filtros al cambiar opciones
	var dias = 7; //document.getElementById("dias").value;
	especiesselectmap_anterior = $('#especiesselectmap option:selected').text();
	//parseInt(document.getElementById("especiesselectmap").value)
	//$('#loading1').removeClass("hidden");
	var url = '';
	if($('#tipomapa').val() == 1){
		url = "load_resumen_reporte_informe.php";
	}else{
		url = "load_resumen_reporte_colab_informe.php";
	}

	$.ajax({
			url: url,
			type: 'post',
			data: {
				user_id:			user_id,
				Nombre_Region: 	  nombreregion,
				Dias: 	 		   dias,
				Especies:		   document.getElementById("especiesselectmap").value,
				Medicion:		   parseInt(document.getElementById("nromedicionresumen").value),
				Colaborativo:	   0,
				Operando:		   1,
				Historia:		   0,
				fecha_filtro_1:	 $('#fecha_filtro_4_1').val()

			},
			success: function(dato)
			{

				var myobjaux = JSON.parse(dato);

				var myobj = myobjaux['Resultado'];
				tablacompleta = myobj;
				var cantcol = $('th', $('#resumenreporte2').find('thead')).length;

				//if(cantcol != (parseInt(dias)+7)){

					$('#resumenreporte2').bootstrapTable('destroy');
					//if(!inicial){
						for(var x=0; x<(cantcol-7); x++){
							 $('#resumenreporte2 tr').find('th:last-child, td:last-child').remove();
						}
					//}
					//inicial = false
					// Agrega las nuevas columnas
					for(var i = myobj[myobj.length-1].length-1; 0<=i; i--){
						var th = '<th data-field="'+i+'" data-sortable="false" data-switchable="false" class="" data-valign = "middle"  data-width = "90px" data-cell-style="cellStylenivelestabla"></th>';
						$('#resumenreporte2 tr').append($(th));
						$('#resumenreporte2 thead tr>th:last').html(myobj[myobj.length-1][i]+'<br> [cel/ml]');
						$('#map'+(7-i)+'_label').html(myobj[myobj.length-1][i]);
					}



				myobj.splice(myobj.length-1,1);

				$('#resumenreporte2').bootstrapTable();
				$('#resumenreporte2').bootstrapTable("removeAll");
				$('#resumenreporte2').bootstrapTable("load", myobj);

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
					$("#especiesselectmap option:contains("+especiesselectmap_anterior+")").attr('selected', true);
				}




				$('#resumenreporte2').bootstrapTable('resetSearch','');
				graficar_mapa();
				//$('#especiesselectmap').val(2).trigger('change');

			}
		});

}



function graficar_mapa(){

	for(var x=1; x<=7;x++){
		var day = 7-x; //6-$("#sidebarweek").val();
		var tabladata = $('#resumenreporte2').bootstrapTable('getData');
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
		var colorbarrio = Array();

		emptyMarkers(day,x);
		emptyMarkersbarrio(day,x);
		for (var i = 0; i<tabladata.length; i++){


				idcentro = tabladata[i]['IDcentro'];
				if(i == 0){idcentronuevo = idcentro; colorbarrio[tabladata[i]['IDbarrio']] = 0; }

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


					eliminarArreglo(idcentronuevo,x);
					topleft = tabladata[i-1]['TopLeft'].split(",");
					if($('#tipomapa').val() == 1){
						asdfa({lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])},tabladata[i-1]['Centro'],idcentronuevo,classindicador,x);
					}else{
						//Actualizar color barrios
						if(parseInt(colorbarrio[tabladata[i-1]['IDbarrio']])<alarma){
							colorbarrio[tabladata[i-1]['IDbarrio']] = alarma;
							//console.log("IDbarrio: "+tabladata[i-1]['IDbarrio']+ " Alarma: "+alarma+ "ID centro: "+idcentronuevo+ "Nombre centro: "+tabladata[i-1]['Centro']);
						}

						if(!colorbarrio[tabladata[i]['IDbarrio']]){
							colorbarrio[tabladata[i]['IDbarrio']] = 0;
						}
					}

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
				}

				if( esp == "Todas las Especies" || ( tabladata[i]['Especie'] == esp || tabladata[i]['Fiscaliza'] == fisc || tabladata[i]['Nociva'] == nociva ) || tabladata[i]['Grupo'] == grupo ){
					if(parseInt(tabladata[i][day]) >= parseInt(tabladata[i]["Alarma_Rojo"]) && parseInt(tabladata[i]["Alarma_Rojo"])>0 ){
						if(alarma < 4){alarma = 4; };
					}else if(parseInt(tabladata[i][day]) >= parseInt(tabladata[i]["Alarma_Amarillo"]) && parseInt(tabladata[i]["Alarma_Amarillo"])>0){
						if(alarma < 3){alarma = 3;}
					}else if(parseInt(tabladata[i][day]) > 0){
						if(alarma < 2){alarma = 2;}
					}else if(parseInt(tabladata[i][day]) == 0){
						if(alarma < 1){alarma = 1;}
					}
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
					eliminarArreglo(idcentro,x);
					topleft = tabladata[tabladata.length - 1]['TopLeft'].split(",");
					if($('#tipomapa').val() == 1){
						asdfa({lat: parseFloat(topleft[0]), lng: parseFloat(topleft[1])},tabladata[tabladata.length - 1]['Centro'],idcentro,classindicador,x);
					}else{
						//Actualizar color barrios
						if(parseInt(colorbarrio[tabladata[tabladata.length - 1]['IDbarrio']])<alarma){
							colorbarrio[tabladata[tabladata.length - 1]['IDbarrio']] = alarma;
							//console.log("IDbarrio: "+tabladata[tabladata.length - 1]['IDbarrio']+ " Alarma: "+alarma + "ID centro: "+idcentro+ "Nombre centro: "+tabladata[tabladata.length - 1]['Centro']);
						}
					}
				}

		}
		actualizabarrio(colorbarrio,x);
	}

	//Centrar Mapa por ACS
	if($('#acsselectmap').val() != 0){
		var triangleCoords = Array();
		var bounds = new google.maps.LatLngBounds();
		$.each(datos['TopLeft_Barrio'], function( key, barrio ) {
			if(barrio['IDbarrio'] == $('#acsselectmap').val()){

				$.each(barrio, function( key, value ) {

					if(key.includes("TopLeft_") && value != ''){

						 var $toleft = value.split(',');
						 //console.log($toleft[0]);
						//console.log($toleft[1]);
						var position = {lat: parseFloat($toleft[0]), lng: parseFloat($toleft[1])};
						 //triangleCoords.push(position);
						 bounds.extend(position);
					}
				});

				/*var myPolygon1 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });
				  var myPolygon2 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });
				  var myPolygon3 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });
				  var myPolygon4 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });
				  var myPolygon5 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });
				  var myPolygon6 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });
				  var myPolygon7 = new google.maps.Polygon({
					paths: triangleCoords,
					draggable: false, // turn off if it gets annoying
					editable: false,
					strokeColor: '#ffffff',
					strokeOpacity: 0.8,
					strokeWeight: 1.7,
					fillColor: '#ffffff',
					fillOpacity: 0.4
				  });

				myPolygon1.setMap(map1);
				myPolygon2.setMap(map2);
				myPolygon3.setMap(map3);
				myPolygon4.setMap(map4);
				myPolygon5.setMap(map5);
				myPolygon6.setMap(map6);
				myPolygon7.setMap(map7);*/

				return false;
			}
		});
		map1.setCenter(bounds.getCenter());
		//map1.fitBounds(bounds);  //Set zoom
		map2.setCenter(bounds.getCenter());
		//map2.fitBounds(bounds);  //Set zoom
		map3.setCenter(bounds.getCenter());
		//map3.fitBounds(bounds);  //Set zoom
		map4.setCenter(bounds.getCenter());
		//map4.fitBounds(bounds);  //Set zoom
		map5.setCenter(bounds.getCenter());
		//map5.fitBounds(bounds);  //Set zoom
		map6.setCenter(bounds.getCenter());
		//map6.fitBounds(bounds);  //Set zoom
		map7.setCenter(bounds.getCenter());
		//map7.fitBounds(bounds);  //Set zoom
	}
	var zoomselectmap = parseInt($('#zoomselectmap').val());
	map1.setZoom(zoomselectmap);
	map2.setZoom(zoomselectmap);
	map3.setZoom(zoomselectmap);
	map4.setZoom(zoomselectmap);
	map5.setZoom(zoomselectmap);
	map6.setZoom(zoomselectmap);
	map7.setZoom(zoomselectmap);

	$('#loading3').addClass("hidden");
};

$('#zoomselectmap').change(function(){
	var zoomselectmap = parseInt($('#zoomselectmap').val());
	map1.setZoom(zoomselectmap);
	map2.setZoom(zoomselectmap);
	map3.setZoom(zoomselectmap);
	map4.setZoom(zoomselectmap);
	map5.setZoom(zoomselectmap);
	map6.setZoom(zoomselectmap);
	map7.setZoom(zoomselectmap);
});


///////////////////////////////
/////// MAPA COLABORATIVO /////
///////////////////////////////
$('#tipomapa').change(function(){
	if($('#tipomapa').val() == 1){
		$('.classinterno').removeClass("hidden");
	}else{
		$('.classinterno').addClass("hidden");
	}
});

function asdfabarrio(barrio_coord,color,idbarrio,map_id){

	var fill = color;
	var opacity = 0.35;
	if(color == "#ab5400"){opacity = 0.0;}
	var visible = true;
	if($('#tipomapa').val() == 1){
		visible = false;
	}

	switch(map_id) {
	  case 1:
		var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map1);
		markers_barrio1.push({name: mi_barrio,  index:  idbarrio});
		break;
	  case 2:
	    var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map2);
		markers_barrio2.push({name: mi_barrio,  index:  idbarrio});
		break;
	  case 3:
	     var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map3);
		markers_barrio3.push({name: mi_barrio,  index:  idbarrio});
		break;
	  case 4:
	     var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map4);
		markers_barrio4.push({name: mi_barrio,  index:  idbarrio});
		break;
	  case 5:
	     var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map5);
		markers_barrio5.push({name: mi_barrio,  index:  idbarrio});
		break;
	  case 6:
	    var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map6);
		markers_barrio6.push({name: mi_barrio,  index:  idbarrio});
		break;
	  case 7:
	     var mi_barrio = new google.maps.Polygon({
		  paths: barrio_coord,
		  strokeColor: color,
		  strokeOpacity: 0.8,
		  strokeWeight: 1.7,
		  fillColor: fill,
		  fillOpacity: opacity,
		  visible: visible,
		  clickable: false,
		});

		mi_barrio.setMap(map7);
		markers_barrio7.push({name: mi_barrio,  index:  idbarrio});
		break;
	}


 }
 function clearMarkersbarrio(map_id){

	 switch(map_id) {
	  case 1:
		$.each(markers_barrio1, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio1 = [];
		break;
	  case 2:
		$.each(markers_barrio2, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio2 = [];
		break;
	  case 3:
		$.each(markers_barrio3, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio3 = [];
		break;
	  case 4:
		$.each(markers_barrio4, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio4 = [];
		break;
	  case 5:
		$.each(markers_barrio5, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio5 = [];
		break;
	  case 6:
		$.each(markers_barrio6, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio6 = [];
		break;
	  case 7:
		$.each(markers_barrio7, function (i, value) {
				element = value.name;
				element.setMap(null);
		});
		markers_barrio7 = [];
		break;
	}


 }

function emptyMarkersbarrio(day,map_id){
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
	var markers_aux;
	switch(map_id) {
	  case 1:
		markers_aux = markers_barrio1;
		break;
	  case 2:
		markers_aux = markers_barrio2;
		break;
	  case 3:
		markers_aux = markers_barrio3;
		break;
	  case 4:
		markers_aux = markers_barrio4;
		break;
	  case 5:
		markers_aux = markers_barrio5;
		break;
	  case 6:
		markers_aux = markers_barrio6;
		break;
	  case 7:
		markers_aux = markers_barrio7;
		break;
	}
	$.each(markers_aux, function (i, value) {

		borde = "#ab5400";
		fill = "#ffffff00";
		opacity = 0.0;

		if (barriomidio[value.index] == 1 ){borde = "#00c901"; fill = borde; opacity = 0.35;}
		element = value.name;
		element.setOptions({strokeColor: borde, fillColor: fill,fillOpacity: opacity });

		if($('#tipomapa').val() == 1){
			element.setVisible(false);
		}else{
			element.setVisible(true);
		}

	});
}

function eliminarArreglobarrio(mi_indice,map_id){
	var posicionkey = 0;
	switch(map_id) {
	  case 1:
		$.each(markers_barrio1, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio1.splice(posicionkey,1) ;
		break;
	  case 2:
		$.each(markers_barrio2, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio2.splice(posicionkey,1) ;
		break;
	  case 3:
		$.each(markers_barrio3, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio3.splice(posicionkey,1) ;
		break;
	  case 4:
		$.each(markers_barrio4, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio4.splice(posicionkey,1) ;
		break;
	  case 5:
		$.each(markers_barrio5, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio5.splice(posicionkey,1) ;
		break;
	  case 6:
		$.each(markers_barrio6, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio6.splice(posicionkey,1) ;
		break;
	  case 7:
		$.each(markers_barrio7, function (i, value) {
			if (value.index == mi_indice){
				element = value.name;
				element.setMap(null);
				posicionkey = i;
				return false;
			}
		});
		markers_barrio7.splice(posicionkey,1) ;
		break;
	};
}

function actualizabarrio(colorbarrio,map_id){

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

				eliminarArreglobarrio(key,map_id);
				asdfabarrio(datosbarrio['TopLeft'][key],classindicador,key,map_id);
			}
		}
	});
 }


//Download Chart Image
document.getElementById("download1").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart-bar01").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download1");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});

//Download Chart Image
document.getElementById("download2").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart-line1").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download2");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});


	//Download Chart Image
document.getElementById("download4").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart-line2").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download4");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});

//Download Chart Image
document.getElementById("download3").addEventListener('click', function(){
  /*Get image of canvas element*/
  var url_base64jp = document.getElementById("chart-line3").toDataURL("image/jpg");
  /*get download button (tag: <a></a>) */
  var a =  document.getElementById("download3");
  /*insert chart image url to download button (tag: <a></a>) */
  a.href = url_base64jp;
});

function imprimir(){
	setTimeout(function() { // even checking map.loaded() sometimes tiles are still grey so add an arbitary delay to hope they are rendered in time
      window.print(); // invoke the print
      // restore the map style width and height to before
    }, 1000);
}

</script>

<script async defer
    	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpUhp-rPo8Zev2M_lT0vPHRQZ9rftJGJI&callback=initMap">
    </script>


@endsection