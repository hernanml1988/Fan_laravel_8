@extends('layouts/master')
@section('title', '- Descarga')

@section('content')

<script type="text/javascript">

</script>




    <div id="wrapper">

     


        <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-xs-12">
                        <div class="panel panel-black" style="margin-top:20px;">
                            <div class="panel-heading" style="height:auto">
                                <div class="row text-center">
                                    <span class="text-center" style="display:inline; font-weight:bold">P A N E L &emsp; D E&emsp;  D E S C A R G A S</span>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="panel panel-default" style="margin-left:13px;margin-right:13px;">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><i class="fa fa-filter fa-fw"></i> Ver Filtros</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="row center-block" style="padding:9px;">

                                                <div class="row">



                                                    <div class="col-lg-6 col-md-12 col-xs-12" >
                                                        <h2>Seleccionar Período</h2>

                                                        <?/*php
                                                                if($currentUser->IDempresa ==6){
                                                                    echo '<div class="row"  style="margin-top:25px;" >';
                                                                }else{
                                                                    echo '<div class="row"  style="margin-top:25px; display:none" >';
                                                                }
                                                        */?>;


                                                          <div class="col-lg-4 col-md-4 col-xs-4">
                                                              <p class="arealabel"> Año Periodo</p>
                                                          </div>
                                                          <div class="col-lg-1 col-md-1 col-xs-1">
                                                              <p class="arealabel">:</p>
                                                          </div>
                                                          <div class="col-lg-7 col-md-7 col-xs-7" >


                                                                  <select id="anio_periodo" onchange="cambiar_filtro()" class="form-control">

                                                                </select>

                                                          </div>
                                                        </div>

                                                      <div class="row"  style="margin-top:25px;" >
                                                          <div class="col-lg-4 col-md-4 col-xs-4">
                                                              <p class="arealabel"> Inicio</p>
                                                          </div>
                                                          <div class="col-lg-1 col-md-1 col-xs-1">
                                                              <p class="arealabel">:</p>
                                                          </div>
                                                          <div class="col-lg-7 col-md-7 col-xs-7" >
                                                              <div class="form-group" >
                                                                  <div class="input-group date  " id="datetimepickerinicio">
                                                                     <input id="fechadesde" value="" type="text" class="form-control enable_btn_exportar"/> <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel">Término</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-xs-7" >
                                                                <div class="form-group">
                                                                    <div class="input-group date datetimepicker_modal" id="datetimepickertermino">
                                                                        <input id="fechahasta" value="" type="text" class="form-control enable_btn_exportar" /> <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>

                                                                    </div>
                                                                </div>
                                                           </div>
                                                        </div>
                                                        <h2>Seleccionar Condición Registro</h2>
                                                        <div class="row" >
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel" title="Alarma Rojo (Nivel Crítico)">Nivel Crítico</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-xs-7" >
                                                                <input id="check_rojo" class="center-block enable_btn_exportar_check" type="checkbox" checked style="margin-top: 10px;">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel" title="Alarma Amarillo (Precaución)"> Precaución</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-xs-7" >
                                                                <input id="check_amarillo" class="center-block enable_btn_exportar_check" type="checkbox" checked style="margin-top: 10px;">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel" title="Presencia Microalgas"> Presencia</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-xs-7" >
                                                                <input id="check_presencia" class="center-block enable_btn_exportar_check" type="checkbox" checked style="margin-top: 10px;">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4 col-md-4 col-xs-4">
                                                                <p class="arealabel" title="Ausencia Microalgas"> Ausencia</p>
                                                            </div>
                                                            <div class="col-lg-1 col-md-1 col-xs-1">
                                                                <p class="arealabel">:</p>
                                                            </div>
                                                            <div class="col-lg-7 col-md-7 col-xs-7" >
                                                                <input id="check_ausencia" class="center-block enable_btn_exportar_check" type="checkbox" checked style="margin-top: 10px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-xs-12" >
                                                        <div class="text-center">
                                                            <h2  style=" display:inline;">Seleccionar Centros: </h2>
                                                            <select id="filtercentrosoperando" class="form-control enable_btn_exportar" style=" display:inline; width: 135px !important;">
                                                                <option value="1">Habilitados</option>
                                                                <option value="0">Deshabilitados</option>
                                                                <option value="2">Todos</option>
                                                            </select>
                                                        </div>
                                                        <div class="center-block" style=" max-width:370px;margin-bottom: 18px;margin-top: 16px;">
                                                            <select id="filtercentros" class="form-control enable_btn_exportar">
                                                                <option value="Region">Ordenar por Región</option>
                                                                <option value="Barrio">Ordenar por ACS</option>
                                                                <option value="Area">Ordenar por Área</option>

                                                            </select>
                                                        </div>
                                                        <div id='hiddenregion'>
                                                            <select id='region' multiple='multiple' class="enable_btn_exportar">
                                                            </select>
                                                        </div>
                                                        <div id='hiddenarea' class="hidden">
                                                            <select id='area' multiple='multiple' class="enable_btn_exportar">
                                                            </select>
                                                        </div>
                                                        <div id='hiddenbarrio' class="hidden">
                                                            <select id='barrio' multiple='multiple' class="enable_btn_exportar">
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center" style="margin-bottom:15px;">
                                    <button id="" type="button" onclick="dataTables.bootstrapTable('refresh');" class="btn label-primary enable_btn_exportar" >
                                       Ver en Tabla
                                    </button>
                                    <button id="btndescargar2" type="button" class="btn label-info " style="margin-left:10px;">
                                        <span class="fa fa-file-excel-o hidden-xs" style="padding: 2px;"> Exportar Excel   <img src='loader.gif' id='btndescargar2_spin' class="hidden" style="width: 12px;" /></span>
                                    </button>
                                    </div>
                                </div>

                                <div id="modal_toolbar_new" class="btn-group " style="height: 20px; margin-bottom:-20px; margin-left:15px">
                                    <button id="btndescargar" type="button" class="btn label-enviada hidden" >
                                        <span class="fa fa-file-excel-o hidden-xs"> Exportar </span>
                                        <!-- <div id="progress" style="display:inline;"> Exportar </div>
                                        <div id="loading1" class="loader hidden" style="display:inline-block; margin-left:7px;margin-bottom:-2px;"></div> -->
                                    </button>


                                </div>
                                    <div class="dataTable_wrapper" style="height:600px; overflow:auto; font-size:12px; padding-top:12px;">
                                         <!--data-show-export="true"  data-export-types="['excel']" data-export-options='{"fileName": "GTR fan - Historial"}'-->
                                        <table cellSpacing="0" data-toggle="table" data-pagination="true" data-search="false" data-page-size="50"  data-page-list="[50, 100, 200, 300, 500]" data-side-pagination="server" data-url="load_tabla_descargas.php" data-query-params="queryParams" data-show-columns="true" data-show-refresh="true" data-cache="false" width="100%" class="table table-striped table-bordered table-hover pointer" style="text-align-last:center" id="dataTables" >
                                            <thead id="table-sticky-header">
                                                <tr >
                                                    <th data-field="Region" data-sortable="false" data-switchable="false" data-valign = "middle"   data-width = "90px">Región</th>
                                                    <th data-field="Area" data-sortable="false" data-switchable="false"   data-valign = "middle" data-width = "90px">Área</th>
                                                    <th data-field="Barrio" data-sortable="false" data-switchable="false"  data-valign = "middle"  data-width = "90px">ACS</th>
                                                    <th data-field="Centro" data-sortable="false" data-switchable="false" data-valign = "middle"   data-width = "90px">Centro</th>
                                                    <th data-field="Date_Reporte" data-sortable="false" data-switchable="false"  data-valign = "middle"  data-width = "90px">Fecha  <br /> Muestra</th>
                                                    <th data-field="Time_Reporte" data-sortable="false" data-switchable="false"  data-valign = "middle"  data-width = "90px">Hora  <br /> Muestra</th>
                                                    <th data-field="Date_Analisis" data-sortable="false" data-visible="false" data-valign = "middle"> Fecha <br /> Análisis </th>
                                                    <th data-field="Time_Analisis" data-sortable="false" data-visible="false" data-valign = "middle"> Hora <br /> Análisis </th>
                                                    <th data-field="Date_Envio" data-sortable="false" data-visible="false" data-valign = "middle"> Fecha <br /> Envío </th>
                                                    <th data-field="Time_Envio" data-sortable="false" data-visible="false" data-valign = "middle"> Hora <br /> Envío </th>

                                                     <th data-field="Siembra" data-sortable="false" data-visible="false" data-valign = "middle"> Fecha <br /> Siembra </th>
                                                      <th data-field="Cosecha" data-sortable="false" data-visible="false" data-valign = "middle"> Fecha <br /> Cosecha </th>

                                                    <th data-field="Grupo" data-sortable="false" data-switchable="false"  data-valign = "middle"  data-width = "90px">Grupo</th>
                                                    <th data-field="Nombre_Especie" data-sortable="false" data-switchable="false"  data-valign = "middle"  data-width = "90px">Nombre <br /> Especie</th>
                                                    <th data-field="Fiscaliza" data-switchable="false" data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                    <th data-field="Nociva" data-visible="false" data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Nociva</th>
                                                    <th data-field="Nivel_Critico"  data-switchable="false" data-align= "center" data-valign = "middle" data-width = "105px">Nivel Nocivo<br /> [cel/ml]</th>
                                                    <th data-field="Alarma_Rojo" data-sortable="false" data-switchable="true" data-valign = "middle" data-visible="false"  data-width = "90px">Alarma Crítico <br /> [cel/ml]</th>
                                                    <th data-field="Alarma_Amarillo" data-sortable="false" data-switchable="true"  data-valign = "middle" data-visible="false"  data-width = "90px">Alarma Precaución <br /> [cel/ml]</th>



                                                </tr>
                                            </thead>

                                        </table>

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

     <!-- Alertas -->
    <script src="js/sweetalert.min.js"></script>

    <!-- Asigna menu para roles -->
    <script src="js/menu_role.js?random=<?php echo uniqid(); ?>"></script>


    <!-- Export table -->
    <script src="js/tableExport.js"></script>
    <script src="js/bootstrap-table-export.js"></script>

    <!-- Multiple Select -->
    <script src="js/jquery.multi-select.js" type="text/javascript"></script>





    <script>
    var user_id = <?//php echo $currentUser->id; ?>;
    var id_empresa = <?//php echo $currentUser->IDempresa; ?>;

    roles(<?/*php echo '"'.$currentUser->role.'"';?>*/);

    var selectedfilter = [];
    var selectedfiltertext = "";

    var dataTables = $('#dataTables');

    function queryParams(params) {
      console.log(selectedfilter);
        params.user_id = user_id;
        params.Centros = '"'+selectedfilter+'"';
        params.Inicio = document.getElementById("fechadesde").value;
        params.Termino = document.getElementById("fechahasta").value;
        params.Critico =  $('#check_rojo').is(':checked') ? 1 : 0;
        params.Precaucion = $('#check_amarillo').is(':checked') ? 1 : 0;
        params.Presencia =  $('#check_presencia').is(':checked') ? 1 : 0;
        params.Ausencia = $('#check_ausencia').is(':checked') ? 1 : 0;
         params.anio_periodo = $('#anio_periodo').val();

        return params;
    }


    //Mensaje Loding, despues de 1 seg.
    $( document ).ajaxStop(function () {
        $('#modalloading').modal('hide');
    });


    $('#region').multiSelect({ selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Centros</div>",selectionHeader: "<div class='custom-header-select'>Centros Seleccionados</div>"});
    $('#area').multiSelect({ selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Centros</div>",selectionHeader: "<div class='custom-header-select'>Centros Seleccionados</div>" });
    $('#barrio').multiSelect({ selectableOptgroup: true,selectableHeader: "<div class='custom-header'>Centros</div>",selectionHeader: "<div class='custom-header-select'>Centros Seleccionados</div>" });
    //Centrar multiselects
    $('#ms-region').addClass("center-block");
    $('#ms-area').addClass("center-block");
    $('#ms-barrio').addClass("center-block");

    var dateinicio = new Date();
    dateinicio.setDate(dateinicio.getDate()-30);
    var dateweek = new Date();
    dateweek.setDate(dateweek.getDate()-7);
    $('#datetimepickerinicio').datetimepicker({
    format: 'YYYY-MM-DD',
    defaultDate: dateweek,
    //minDate :dateinicio
    });

    var datetermino = new Date();
    datetermino.setDate(datetermino.getDate());
    $('#datetimepickertermino').datetimepicker({
    format: 'YYYY-MM-DD',
    defaultDate: datetermino,
    maxDate :datetermino
    });

    $(function () {
        $('#datetimepickerinicio').datetimepicker();
        $('#datetimepickertermino').datetimepicker({
            useCurrent: false //Important! See issue #1075
        });
        $("#datetimepickerinicio").on("dp.change", function (e) {
            $('#datetimepickertermino').data("DateTimePicker").minDate(e.date);
            //loadtabla();
            // dataTables.bootstrapTable('refresh');
        });
        $("#datetimepickertermino").on("dp.change", function (e) {
            $('#datetimepickerinicio').data("DateTimePicker").maxDate(e.date);
            //loadtabla();
            // dataTables.bootstrapTable('refresh');
        });
    });

    function savehistorial(){
        var obs = "Descarga datos desde "+document.getElementById("fechadesde").value+" hasta "+document.getElementById("fechahasta").value+" | Centros descargados:"+selectedfiltertext.substr(1);
        $.ajax({
                url: "save_historial_descargas.php",
                type: 'post',
                data: {
                 Modificacion:   "Descarga datos excel",
                 Observaciones:     obs,
                 user_id:         user_id
                },
                success: function(msg)
                {

                }
            });

        }


    function cambiar_filtro(){


        if($('#anio_periodo').val() == 0){
            $('#fechadesde').attr("disabled",false);
            $('#fechahasta').attr("disabled",false);
            $('#fechadesde').prop("disabled",false);
            $('#fechahasta').prop("disabled",false);

        }else{


            $('#fechadesde').attr("disabled",true);
            $('#fechahasta').attr("disabled",true);
            $('#fechadesde').prop("disabled",true);
            $('#fechahasta').prop("disabled",true);
        }

        // $('#dataTables').bootstrapTable('refresh');
    }




    //Load opciones profundidad y distribución
    var distribucion = "";
    $( document ).ready(function() {


        // $('#modalloading').modal({backdrop: 'static', keyboard: false});
        $.ajax({
                url: "load_options_prof.php",
                type: 'post',
                dataType: 'json',
                data: {
                    user_id:        user_id
                },
                success: function(dato)
                {
                    if(dato != ""){
                        var opt = dato.split(",");
                            dataTables.bootstrapTable('destroy');
                            for(var i = 0; i<opt.length; i++){
                                var th = '<th data-field="Medicion_'+(i+1)+'" data-align= "center" data-switchable="false" data-valign = "middle" data-width = "65px"></th>';
                                $('#dataTables tr').append($(th));
                                $('#dataTables thead tr>th:last').html(opt[i].concat("<br/> [cel/ml]") );
                            }
                            $('#dataTables tr').append('<th data-field="Estado_Alarma" data-sortable="false" data-switchable="true" data-valign = "middle" data-visible="false" data-width = "90px" data-cell-style="cellStyleestadoalarma">Estado</th>');

                            $('#dataTables tr').append('<th data-field="Tecnica" data-sortable="false" data-switchable="true" data-valign = "middle" data-visible="false">Técnica</th>');

                            $('#dataTables tr').append('<th data-field="Observaciones" data-sortable="false" data-switchable="true" data-valign = "middle" data-visible="false">Observaciones</th>');

                            $('#dataTables tr').append(' <th data-field="Firma" data-sortable="false" data-switchable="true" data-valign = "middle" data-visible="false">Firma</th>');
                            dataTables.bootstrapTable({
                                formatNoMatches: function () {
                                    return 'Seleccionar Filtros';
                                },
                                exportDataType: 'all'
                            });
                            //loadtabla();
                            dataTables.bootstrapTable('refresh');
                    }
                }
            });
        // $('#modalloading').modal({backdrop: 'static', keyboard: false});
        $.ajax({
                url: "load_distribucion_descargas.php",
                type: 'post',
                dataType: 'json',
                data: {
                    user_id:    user_id
                },
                success: function(dato)
                {

                    if(dato != ""){
                        distribucion = dato;
                        loadselectcentros();


                        $.ajax({
                                url: "load_anio_periodo.php",
                                type: 'get',
                                dataType: 'json',
                                data: {
                                    id_empresa: id_empresa
                                },
                                success: function(dato)
                                {
                                    d = dato.rows;
                                    console.log("lalalal",d.length);
                                    select_option = '<option value="0"> No filtrar</option>';
                                    for(var i=0; i<d.length;i++){

                                        select_option += '<option value="'+d[i].anio +'">'+d[i].anio +'</option>';

                                    }

                                    $('#anio_periodo').html(select_option);

                                    //Muetra errores al descargar y ser redirgido denuevo a esta url
                                    const queryString = window.location.search;
                                    const urlParams = new URLSearchParams(queryString);
                                    const error = urlParams.get('error')
                                    if (error) {
                                      alert(error);
                                    }

                                    if(urlParams.get('p1')){
                                      console.log(urlParams.get('p1'));
                                      var centro_aux = urlParams.get('p1');
                                      $('#region').multiSelect('select',centro_aux.split(','));
                                      $('#region').multiSelect('refresh');
                                      $('#area').multiSelect('select',centro_aux.split(','));
                                      $('#area').multiSelect('refresh');
                                      $('#barrio').multiSelect('select',centro_aux.split(','));
                                      $('#barrio').multiSelect('refresh');
                                    }
                                    if(urlParams.get('p2')){
                                      document.getElementById("fechadesde").value = urlParams.get('p2');
                                    }
                                    if(urlParams.get('p3')){
                                      document.getElementById("fechahasta").value = urlParams.get('p3');
                                    }
                                    if(urlParams.get('p4') == 1){
                                      document.getElementById("check_rojo").checked = true;
                                    }else if(urlParams.get('p4') === 0){
                                      document.getElementById("check_rojo").checked = false;
                                    }

                                    if(urlParams.get('p5') == 1){
                                      document.getElementById("check_amarillo").checked = true;
                                    }else if(urlParams.get('p5') === 0){
                                      document.getElementById("check_amarillo").checked = false;
                                    }
                                    if(urlParams.get('p6') == 1){
                                      document.getElementById("check_presencia").checked = true;
                                    }else if(urlParams.get('p6') === 0){
                                      document.getElementById("check_presencia").checked = false;
                                    }
                                    if(urlParams.get('p7') == 1){
                                      document.getElementById("check_ausencia").checked = true;
                                    }else if(urlParams.get('p7') === 0){
                                      document.getElementById("check_ausencia").checked = false;
                                    }
                                    if(urlParams.get('p8')){
                                      document.getElementById("anio_periodo").value = urlParams.get('p8');
                                    }





                                },error: function(err){
                                    console.log(err);
                                }
                        });



                    }
                },error: function(err){
                    console.log(err);
                }
        });






    });

    /*function loadtabla(){
        var sel = '"'+selectedfilter+'"';
        $.ajax({
                url: "load_tabla_descargas.php",
                type: 'post',
                dataType: 'json',
                data: {
                    Centros: '"'+selectedfilter+'"',
                    Inicio:      document.getElementById("fechadesde").value,
                    Termino:    document.getElementById("fechahasta").value,
                    user_id:        user_id
                },
                success: function(dato)
                {

                    dataTables.bootstrapTable("removeAll");
                    if(dato != ""){
                        dataTables.bootstrapTable('load',dato);
                    }
                },error: function(err){
                    console.log(err);
                }
        });



    }*/

    $('#btndescargar2').click( function(){
      
        if (selectedfilter.length == 0) {
          alert('Debe seleccionar una instalación');
          return;
        }

        $('#btndescargar2').prop('disabled', true);
        $('#btndescargar2_spin').removeClass('hidden');

        var  check_rojo =  $('#check_rojo').is(':checked') ? 1 : 0;
        var  check_amarillo =  $('#check_amarillo').is(':checked') ? 1 : 0;
        var  check_presencia =  $('#check_presencia').is(':checked') ? 1 : 0;
        var  check_ausencia =  $('#check_ausencia').is(':checked') ? 1 : 0;

        savehistorial();

        window.location.href = "https://api.fan.gtrgestion.cl/descargar_excel/"+selectedfilter+'/'+document.getElementById("fechadesde").value+'/'+document.getElementById("fechahasta").value+'/'+
        check_rojo+'/'+
        check_amarillo+'/'+
        check_presencia+'/'+
        check_ausencia+'/'+
        $('#anio_periodo').val();

        setTimeout(function () {
            $('#btndescargar2').prop('disabled', false);
            $('#btndescargar2_spin').addClass('hidden');
        }, 30000);

    });



    $('#btndescargar').click( function(){
        $('#modalloading').modal({backdrop: 'static', keyboard: false});

        $('#btndescargar').prop('disabled', true);
        var sel = '"'+selectedfilter+'"';
        // $('#progress').html('Procesando...  0%');
        // var refreshIntervalId = setInterval(function(){
        //               $.ajax({
        //                 type: "get",
        //                 url: 'archivos/Registros_Alarma/progress.php',
        //                 data: {_token: '{{ csrf_token() }}'
        //                       },
        //                 success: function( data ) {
        //                   console.log(data);
        //                   if (data == 100) {
        //                     $('#progress').html('Exportar ');
        //                   }else{
        //                     $('#progress').html('Procesando... '+data+'%');
        //                   }
        //                 }
        //               });
        //           }, 1000);

        if (selectedfilter.length == 0) {
          alert('Debe seleccionar una instalación');
          return;
        }

        savehistorial();
        $.ajax({
                url: "archivos/Registros_Alarma/generar_excel.php",
                type: 'post',
                dataType: 'json',
                data: {
                    Centros: '"'+selectedfilter+'"',
                    Inicio:      document.getElementById("fechadesde").value,
                    Termino:    document.getElementById("fechahasta").value,
                    Critico:  $('#check_rojo').is(':checked') ? 1 : 0,
                    Precaucion: $('#check_amarillo').is(':checked') ? 1 : 0,
                    Presencia:  $('#check_presencia').is(':checked') ? 1 : 0,
                    Ausencia: $('#check_ausencia').is(':checked') ? 1 : 0,
                    user_id:        user_id,
                    anio_periodo: $('#anio_periodo').val()
                },
                success: function(dato)
                {
                    // clearInterval(refreshIntervalId);
                    // $('#progress').html('Exportar ');
                    // $('#loading1').addClass("hidden");
                    //window.location("archivos/Registros_Alarma/descargar_registro.php?n="+dato);
                    window.location.href = "archivos/Registros_Alarma/descargar_excel.php?n="+dato;
                    $('#btndescargar').prop('disabled', false);



                },error: function(err){
                    console.log(err);
                    $('#btndescargar').prop('disabled', false);
                    // $('#loading1').addClass("hidden");
                    // clearInterval(refreshIntervalId);
                    // $('#progress').html('Exportar ');
                }
        });
    });

    $('#filtercentrosoperando').change( function(){
        $('#region').empty().multiSelect('refresh');
        $('#area').empty().multiSelect('refresh');
        $('#barrio').empty().multiSelect('refresh');
        $('#ms-region').addClass("center-block");
    $('#ms-area').addClass("center-block");
    $('#ms-barrio').addClass("center-block");
        loadselectcentros();
    });

    $('#filtercentros').change( function(){
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

    })
    function loadselectcentros(){

        var centroshabilitados = $('#filtercentrosoperando').val();
        //Options Region
        if(distribucion['Region']){
            $.each(distribucion['Region'], function (i, item) {
                $('#region').append('<optgroup label="'+item+'"></optgroup>');
            });

            $.each(distribucion['Region_Centro'], function (i, item) {
                if(centroshabilitados == item[3] || centroshabilitados == 2){
                    $('#region').multiSelect('addOption', {
                        value: item[0], text: item[1], nested: item[2]
                    });
                }

            });
        }

        //Options Area
        if(distribucion['Area_Centro']){
            $.each(distribucion['Area'], function (i, item) {
                $('#area').append('<optgroup label="'+item+'"></optgroup>');
            });

            $.each(distribucion['Area_Centro'], function (i, item) {
                if(centroshabilitados == item[3] || centroshabilitados == 2){
                    $('#area').multiSelect('addOption', {
                        value: item[0], text: item[1], nested: item[2]
                    });
                }
            });
        }

        //Options Barrio
        if(distribucion['Barrio_Centro']){
            $.each(distribucion['Barrio'], function (i, item) {
                $('#barrio').append('<optgroup label="'+item+'"></optgroup>');
            });

            $.each(distribucion['Barrio_Centro'], function (i, item) {
                if(centroshabilitados == item[3] || centroshabilitados == 2){
                    $('#barrio').multiSelect('addOption', {
                        value: item[0], text: item[1], nested: item[2]
                    });
                }
            });
        }



    }

    $('#region').change( function(){
        searchselectcentros("region");
    });
    $('#area').change( function(){
        searchselectcentros("area");
    });
    $('#barrio').change( function(){
        searchselectcentros("barrio");
    });


    function searchselectcentros(filtro) {
        var select1 = document.getElementById(filtro);
        selectedfilter = [];
        selectedfiltertext = "";
        for (var i = 0; i < select1.length; i++) {
            if (select1.options[i].selected) {
                selectedfilter.push(select1.options[i].value);
                selectedfiltertext = selectedfiltertext+", "+select1.options[i].text;

            };

        }
        // console.log(selectedfilter);
        //loadtabla();
        // dataTables.bootstrapTable('refresh');

    }

    // $('.enable_btn_exportar_check').on('change',function(){
    //   console.log("change");
    //   $('#btndescargar2').prop('disabled', false);
    // })
    // $('.enable_btn_exportar').on('click',function(){
    //   console.log("change");
    //   $('#btndescargar2').prop('disabled', false);
    // })








</script>





@endsection