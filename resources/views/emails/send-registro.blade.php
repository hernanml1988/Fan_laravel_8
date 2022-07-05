<html>
<head></head>
<body >
	Estimado(a), 
	<br><br>
    GTR Fan notifica que se ha emitido {{$aux}} de la instalación <b>{{$Nombre_Centro}}</b>, con fecha {{$Dia}}.
    <br><br>
    <table style="border: 3px double black;    padding: 2px;
    border-collapse: collapse; margin-left:20px;">
		<thead>
			<tr style="border: 1px solid black;">
				<th  colspan ="10" valign = "middle" height="40"> <img src="{{ $message->embed(public_path() . '/GTR_Fan.png') }}" class="logo_gtr_modal pull-left"/> </th>				
			</tr>
		</thead>
		<tbody style="   ">
        	<tr style="border: 1px solid black; background-color:#11637c">
				<td colspan ="10" height="5"></td>
			</tr>
			<tr style="border: 1px solid black; height:33px;">
				<td><b>&nbsp; {{$titulo}}</b></td>
				<td>:</td>
				<td colspan="8">{{$Alarma}}</td>
			</tr>
            <tr style="border: 1px solid black; height:33px; margin-left:55px;">
				<td><b>&nbsp; Centro</b></td>
				<td>:</td>
				<td colspan="8">{{$Nombre_Centro}}</td>
			</tr>
            <tr style="border: 1px solid black; height:33px; margin-left:55px;">
				<td><b>&nbsp; Mortalidad por FAN</b></td>
				<td>:</td>
				<td colspan="8">{{$Mortalidad}}</td>
			</tr>
            <tr style="border: 1px solid black; height:33px; margin-left:55px;">
				<td><b>&nbsp; Fecha Muestra</b></td>
				<td>:</td>
				<td colspan="8">{{$Dia}}</td>
			</tr>
            <tr style="border: 1px solid black; height:33px; margin-left:55px;">
				<td><b>&nbsp; Hora Muestra</b></td>
				<td>:</td>
				<td colspan="8">{{$Hora}}</td>
			</tr>
            {!! $tablaespecie !!}
		</tbody>
	</table>
    <br>
    Más información: <a href="https://fan.gtrgestion.cl">fan.gtrgestion.cl</a>
    <br><br>
	Atte.
	<br>
	GTR FAN
	<br>
	<a href="https://gtrgestion.cl">www.gtrgestion.cl</a>
    <br>
    

</body>
</html>