
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/metisMenu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/timeline.css') }}" rel="stylesheet">
    <link href="{{ asset('css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-table.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-multiselect.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
   

    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css') }}" /> 
    <link href="{{ asset('css/bootstrap-editable.css') }}" rel="stylesheet">

</head>

<style type="text/css">
@media all {
.fixed-table-body {
		 overflow-x: unset !important;
		 overflow-y: unset !important;
		 height: unset !important;
	   }
	   .table-responsive {
		   overflow-x:unset !important;
	   }
  .infopdf2 tbody > tr > td {
    padding: 0px !important;
    padding-top: 5px !important;
  }
  .infopdf3 tbody > tr > td {
    padding: 0px !important;
    padding-top: 6px !important;
  }
  .infopdf4 tbody > tr > td {
    padding: 0px !important;
    padding-top: 7px !important;
  }
  body{
    background-color: white !important;
  }

}
</style>

<body style="padding:5px 10px 10px 7px;">

	


            <!--Modal Print-->
            <!--<div class="modal fade" id="myModalverreporteprint" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">-->
              <div class="modal-dialog modal-lg" style="width:1090px; border: 2px solid; min-height: 1540px;" role="document">
                <div class="">
                  <div class="modal-header">
                    <img src="{{ asset('img/GtrFan-MonitoreoAlgasNocivas2.png') }}" class="logo_gtr_modal pull-left"/>
                    <img id="logoempresa" src="{{ asset('') }}{{$empresa->nombre}}.png" class="pull-right" style="margin-top:0px;"/>
                    <h5 class="modal-title text-center" id="myModalLabel" style="margin-right:130px;margin-top:10px;" >DETALLE REGISTRO DIARIO</h5>
                    <h5 class="modal-title text-center" id="tituloalarma" style="margin-right:130px;"></h5>

                  </div>
                  <div class="modal-body">
                    <div class="panel-body" >
                   	 	<div class="row">
                        	<div class="col-lg-4 col-md-4 col-xs-4" style="margin-top:-13px; padding-right:0px;">
                                <table class="infopdf pull-right" style="width:67%; table-layout: fixed;" >
                                  <tr>
                                    <th style="font-size:10px !important;" width = "55px">Centro</th>
                                    <th style="font-size:10px !important;font-weight:normal;text-align: center;" width = "30px">:</th>
                                    <th style=" font-weight:normal;"><output style="font-size:9px !important; margin-top:-7px !important;" id="nombreverreporteprint"></output></th>
                                    <th width = "30px"></th>

                                 </tr>
                                  <tr>
                                    <td style="font-size:10px !important; padding:0px;" width = "55px"><b>SIEP</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td><output style="font-size:9px !important; margin-top:-7px !important;" id="siepverreporteprint"></output></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important; padding:0px;" width = "55px"><b>ACS</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td><output style="font-size:9px !important;  margin-top:-7px !important;" id="acsverreporteprint"></output></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important; padding:0px;" width = "55px"><b>Especie</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td><output style="font-size:9px !important; margin-top:-7px !important; " id="especieverreporteprint"></output></td>
                                  </tr>
                                   <tr>
                                    <td style="font-size:10px !important;" width = "55px"><b>Muestra</b></td>
                                    <td style="font-size:10px !important;font-weight:normal;text-align: center;" width = "30px">:</td>
                                    <td ><output style="font-size:8px !important;margin-top:-7px !important;" id="fechaverreporteprint"></output></td>
                                  </tr>
                                   <tr>
                                    <td style="font-size:10px !important;" width = "55px"><b>Análisis</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td> <output style="font-size:8px !important; margin-top:-7px !important;" id="fechaanalisisverreporteprint"></output></td>

                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important;" width = "55px"><b>Envío</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td> <output style="font-size:8px !important;   margin-top:-7px !important;" id="fechaenvioverreporteprint"></output></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important;" width = "55px"><b>Mortalidad</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td> <output style="font-size:9px !important; margin-top:-7px !important;" id="pecesverreporteprint"></output></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important; padding:0px;" width = "55px"><b>Archivo</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td><a id="archivolink" href="http://www.gtrgestion.cl"> - </a></td>
                                    <td width = "30px"></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important;" width = "55px"><b>Firma</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td> <output style="font-size:9px !important; margin-top:-7px !important;" id="firmaverreporteprint"></output></td>
                                  </tr>
                                  <tr>
                                    <td style="font-size:10px !important;" width = "55px"><b>Ubicación</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td> <output style="font-size:9px !important; margin-top:-7px !important;" id="ubicacionverreporte"></output></td>
                                  </tr>

                                </table>
                            </div>
                             <div class="col-lg-8 col-md-8 col-xs-8">
                                <div id="content">
                                	<div id="titulo_grafico" class="text-center" style="font-size:13px; margin-top:-16px; margin-right:50px;"><b>Tendencia Especies Nocivas en la Semana</b> (Máx. concentración)</div>
                                    <div id="titulo_grafico_ausencia" class="text-center hidden" style="font-size:13px; margin-top:-16px; margin-right:50px;"><b>Ausencia de Microalgas Nocivas en la Semana</b></div>
                                     <div class="demo-container">
                                        <div id="placeholder" class="demo-placeholder" style="display:inherit; float:left; width:582px; height:223px;"></div>
                                        <div style=" position:absolute;right:0px; width:18%; font-size:9px; margin-right:-17px;" id="legendholder"></div>
                                    </div>
                                </div>
                       	 	</div>

                        </div>
                       	<div class="row" style="margin-left:113px; margin-right:110px; margin-top:-5px;">
                       		 <table class="infopdf pull-right" style="width:100%; table-layout: fixed; margin-top:-6px;" >
                             	<tr>
                                    <td style="font-size:10px !important; padding:0px;" width = "55px"><b>Obs.</b></td>
                                    <td style="font-size:10px !important;text-align: center;" width = "30px">:</td>
                                    <td colspan="2"><output style="font-size:9px !important; margin-top:-7px !important; text-align:justify;" id="obsverreporteprint">-</output></td>
                             	</tr>
                        	</table>
                     	  </div>
                    	<div class="row" style=" margin-top:15px; margin-left:110px; margin-right:110px;">
                            <div class="dataTable_wrapper" id="hidediato">
                                <h6 class="text-center"> DIATOMEAS </h6>
                                <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica"   id="tabladiatomeasverprint" >
                                    <thead>
                                        <tr>
                                            <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                            <!--<th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>-->
                                            <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                            <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                            <th data-field="Nociva"  data-align= "center" data-valign = "middle" data-width = "40px">Nociva</th>
                                            <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "35px">Nivel Nocivo<br /> [cel/ml]</th>
                                            <th data-field="Alarma_Rojo"  data-align= "center" data-valign = "middle" data-width = "35px">Alarma Crítico<br /> [cel/ml]</th>
                                            <th data-field="Alarma_Amarillo"  data-align= "center" data-valign = "middle" data-width = "35px">Alarma Precaución<br /> [cel/ml]</th>
                                            <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>

                                        </tr>
                                    </thead>

                                </table>

                            </div>


                            <div class="dataTable_wrapper" id="hidedino" style="margin-top:15px;" >
                                <h6 class="text-center"> DINOFLAGELADOS </h6>
                                    <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica"   id="tabladinoflageladosverprint" >
                                        <thead>
                                            <tr>
                                                <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                                <!--<th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>-->
                                                <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                                <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                                <th data-field="Nociva"  data-align= "center" data-valign = "middle" data-width = "40px">Nociva</th>
                                                <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "35px">Nivel Nocivo<br /> [cel/ml]</th>
                                            <th data-field="Alarma_Rojo"  data-align= "center" data-valign = "middle" data-width = "35px">Alarma Crítico<br /> [cel/ml]</th>
                                            <th data-field="Alarma_Amarillo"  data-align= "center" data-valign = "middle" data-width = "35px">Alarma Precaución<br /> [cel/ml]</th>
                                                <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                                <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                           		<th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            	<th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>

                                            </tr>
                                        </thead>

                                    </table>

                                </div>

                            <div class="dataTable_wrapper" id="hideoesp" style="margin-top:15px;">
                                <h6 class="text-center"> OTRAS ESPECIES </h6>
                                <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica"   id="tablaoespeciesverprint" >
                                    <thead>
                                        <tr>
                                            <th data-formatter="runningFormatterreporte" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                           <!-- <th data-formatter="runningFormatterfoto" data-align= "center" data-valign = "middle" data-width = "60px">Imagen</th>-->
                                            <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle">Nombre</th>
                                            <th data-field="Fiscaliza"  data-align= "center" data-valign = "middle" data-width = "50px">Especie<br /> Fiscalizada</th>
                                            <th data-field="Nociva"  data-align= "center" data-valign = "middle" data-width = "40px">Nociva</th>
                                            <th data-field="Nivel_Critico"  data-align= "center" data-valign = "middle" data-width = "35px">Nivel Nocivo<br /> [cel/ml]</th>
                                            <th data-field="Alarma_Rojo"  data-align= "center" data-valign = "middle" data-width = "35px">Alarma Crítico<br /> [cel/ml]</th>
                                            <th data-field="Alarma_Amarillo"  data-align= "center" data-valign = "middle" data-width = "35px">Alarma Precaución<br /> [cel/ml]</th>
                                            <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>
                                            <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px" data-cell-style="cellStyleniveles"></th>

                                        </tr>
                                    </thead>

                                </table>

                            </div>
                            <div id="id_tabla_pamb" class="dataTable_wrapper" style="margin-top:15px;">
                                <h6 class="text-center"> PARÁMETROS AMBIENTALES </h6>
                                <table cellSpacing="0" data-toggle="table"  data-url=""  data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica"   id="tablapambientalesverprint" style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th data-field="Grupo" data-align= "center" data-valign = "middle" data-width = "110px"></th>
                                            <th data-formatter="runningFormatterambientales" data-align= "center" data-valign = "middle" data-width = "35px">#</th>
                                            <th data-field="Nombre" data-align= "left" data-halign="center" data-valign = "middle" data-width = "">Nombre</th>
                                            <th data-field="Medicion_1" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                            <th data-field="Medicion_2" data-visible="false" data-align= "center" data-valign = "middle" data-width = "65px"></th>
                                            <th data-field="Medicion_3" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px"></th>
                                            <th data-field="Medicion_4" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px"></th>
                                            <th data-field="Medicion_5" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px"></th>
                                            <th data-field="Medicion_6" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px"></th>
                                            <th data-field="Medicion_7" data-visible="false" data-align= "center" data-valign = "middle"data-width = "65px"></th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                            <div class="dataTable_wrapper" style="margin-top:10px;">
                                <table cellSpacing="0" data-toggle="table"  data-url="" data-pagination="false" data-side-pagination="client" data-cache="false" width="100%" class="table table-striped table-bordered table-hover letrachica"   id="tablapambientalesotrosverprint" style="table-layout: fixed;">
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
                        <div id="footerprint" class="modal-footer text-center" style="margin-top:15px;">
                            <div class="text-center" style="font-size:11px; margin-top:-1px; margin-bottom: -15px;">Atte.</div>
                            <br/>
                            <!--<img src="GTRgestion.png" class="center-block"/>-->
                            <img src="{{ asset('img/GtrFan-MonitoreoAlgasNocivas2.png') }}" class="center-block" width="10%"/>
                            <div class="text-center" style="font-size:10px; margin-bottom:7px; margin-left:5px;"><a href="https://fan.gtrgestion.cl">fan.gtrgestion.cl</a></div>
                      	</div>

                  	</div>
                  </div>
                </div>
              </div>
           <!-- </div>-->



   
	<script language="javascript" src="{{ asset('js/jquery.js') }}"> </script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-table.js')}}"></script>
    <!-- DatetimePicker -->
   <script src="{{ asset('js/moment-with-locales.js')}}"></script>
   <script src="{{ asset('js/bootstrap-datetimepicker.js')}}"></script>   
   <!-- Custom Theme JavaScript -->
   <script src="{{ asset('js/sb-admin-2.js')}}"></script>
   
<script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.js')}}"> </script>
<script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.time.js')}}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.axislabels.js')}}"></script>
<script language="javascript" type="text/javascript" src="{{ asset('js/jquery.flot.threshold.js')}}"></script>

    
    
    
    
    


<script>

	//var user_id = <?php //echo $currentUser->id; ?>;
	
	var user_id = {!!$user_id!!} 
	var idmedicion ={!!$idmedicion!!} 
	var alarma = '{!!$alarma!!}';
	if(alarma == "Precaucin"){alarma = "Alarma Activada: Precaución";
	}else if(alarma == "Nivel Crtico"){alarma = "Alarma Activada: Nivel Crítico";
	}else if(alarma == "Ausencia Microalgas"){alarma = "Ausencia Microalgas";
	}else if(alarma == "Presencia Microalgas"){alarma = "Presencia Microalgas";
	}else{alarma = "";}

	$('#tituloalarma').text(alarma);

	function queryParams(params) {
		params.user_id = user_id;
        return params;
    }


	$('#tabladiatomeasverprint, #tabladinoflageladosverprint, #tablaoespeciesverprint').bootstrapTable({

			formatNoMatches: function () {

				return 'Ausencia de Microalgas';
				},
			formatLoadingMessage: function (a,b,c,d,e) {
				return '';
			}
			});

	$('#tablapambientalesverprint, #tablapambientalesotrosverprint').bootstrapTable({
			formatNoMatches: function () {
				return 'Sin Registro';
				},
			formatLoadingMessage: function () {
				return '';
			}
			});
	//function verarchivo(){



	//};


	var dataTables = $('#dataTables');


	//Load opciones profundidad

	$( document ).ready(function() {
	

			var dato = '{!!$opciones!!}'

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
							}

							$('#'+tabla).bootstrapTable();



							$('#'+tabla).bootstrapTable('refresh');
							for(var i = 0; i<opt.length; i++){

								//Modal Print
								$('#'+tabla+'verprint [data-field=Medicion_'+(i+1)+'] ').html(opt[i]);
							}
						}
					}
					tablasverreporte();
				
				
			
		});


	var idccentro = "";
	var especie_rojo = [];
	var especie_amarillo = [];
	var especie_otro = [];
	var especie_nocivo = [];
	var especie_nocivo_no = [];
	function tablasverreporte(){
				
				var dato = {!! json_encode($fanReporte) !!};                                               
                                             
				
				
						if(dato != 0){
							var datos = dato;
							
							especie_rojo = [];
							especie_amarillo = [];
							especie_otro = [];
							especie_nocivo = [];
							especie_nocivo_no = [];

							var nombrearchivo = "-";
							if(datos['Archivo']){
								nombrearchivo = datos['Archivo'].split("/");
								nombrearchivo = nombrearchivo[nombrearchivo.length-1];
							}

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

									if (texto != '') {
										$('#ubicacionverreporte').text(texto);
										if ($('#ubicacionverreporte').val().length > 55) {
										$('.infopdf').addClass('infopdf2');
										}else{
										$('.infopdf').addClass('infopdf3');
										}
									}else{
										$('.infopdf').addClass('infopdf4');
										$('#ubicacionverreporte').text('-');
									}

									var ausencia = '';
													if(datos['Diatomeas'] != ""){
														$('#tabladiatomeasverprint').bootstrapTable("load", datos['Diatomeas']);
										ausencia = 'no';
													}else{$('#hidediato').addClass('hidden')}
													if(datos['Dinoflagelados'] != ""){
														$('#tabladinoflageladosverprint').bootstrapTable("load", datos['Dinoflagelados']);
										ausencia = 'no';
													}else{$('#hidedino').addClass('hidden');}
													if(datos['OEsp'] != ""){
														$('#tablaoespeciesverprint').bootstrapTable("load", datos['OEsp']);
										ausencia = 'no';
													}else{$('#hideoesp').addClass('hidden');}

									if (ausencia == '') {
										$('#id_tabla_pamb').css('margin-top','50px');
									}

													document.getElementById("fechaverreporteprint").value = datos['Fecha_Reporte'];
													document.getElementById("fechaanalisisverreporteprint").value = datos['Fecha_Analisis'];
													document.getElementById("fechaenvioverreporteprint").value = datos['Fecha_Envio'];
													//document.getElementById("tecnicaverreporteprint").value = datos['Tecnica'];
													var obs1 = datos['Observaciones'];
													//if(datos['Observaciones']){obs1 == datos['Observaciones'];}
									if (obs1 != '') {
										document.getElementById("obsverreporteprint").value = obs1;
									}else{
										document.getElementById("obsverreporteprint").value = '-';
									}

            				//   id_tabla_pamb

							$("#archivolink").text(nombrearchivo);
							document.getElementById("firmaverreporteprint").value = datos['Firma'];
							document.getElementById("pecesverreporteprint").value = datos['Mortalidad'];
							document.getElementById("nombreverreporteprint").value = datos['Nombre'];
							document.getElementById("siepverreporteprint").value = datos['Codigo'];
							document.getElementById("acsverreporteprint").value = datos['Barrio'];
							document.getElementById("especieverreporteprint").value = datos['Especie'];
							//document.getElementById("siembraverreporteprint").value = datos['Siembra'];
							//document.getElementById("cosechaverreporteprint").value = datos['Cosecha'];
							//$("#myModalLabel").text(datos['Nombre']);
							idcentro = datos['IDcentro'];
							loaddatagrafico();

						}else{swal("Error", "Error al cargar el reporte.", "error");}
								
						
						var dato = {!! json_encode($pambientales) !!};  

						if(dato != 0)
						{
							var datos = dato;//JSON.parse(dato);

							//Print
							if(datos['PAmbientales'] != "")
							{
								$('#tablapambientalesverprint').bootstrapTable("load", datos['PAmbientales']);
							}else
							{
								$('#tablapambientalesverprint').addClass('hidden');
							}
							$('#tablapambientalesotrosverprint').bootstrapTable("load", datos['PAmbientalesotros']);
						}else
							{
								swal("Error", "Error al cargar el reporte.", "error");
							}
					
				

			}



	//Dinoflagelados
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





	




	function cellStyleniveles(value, row, index) {
		var classes = ['label-green','label-gray','label-warning','label-danger']; //yellow red
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
			
					var datoshist = {!! json_encode($Resultado) !!};  

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

			if (data_grafico.length > 0) {
				plot = $.plot("#placeholder", data_grafico, {
					axisLabels: {
						show: true
					},
					xaxis:  {
						//axisLabel: 'Fecha Registro',
						mode: "time",
						timeformat : "%d-%m",  // %H:%M:%S
						timezone: "browser",
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
						axisLabel: axislabel,
						min: 0,
						max: maxy
					}
				});
			}


		}

		plotAccordingToChoices();

	}





</script>

	


</body>
</html>