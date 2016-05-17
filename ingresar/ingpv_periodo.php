<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/ing_periodo.css" type="text/css"/>
	<script src="../js/calendario/jquery-1.10.2.js"></script>
	<script src="../js/val_per.js"></script>
	<script src="../js/calendario/jquery-ui.js"></script>
	<script src="../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css">
	<link rel="stylesheet" href="../js/calendario/date.css">
	<script>
	$(function() {
		$( "#com_periodo" ).datepicker({
			showOtherMonths: true, //Mostrar cuadrilcula
			showOn: "button",
			buttonImage: "../media/fech.png",
			buttonImageOnly: true,
			buttonText: "Seleccionar Fecha"
		});
	});
	$(function() {
		$( "#fin_periodo" ).datepicker({
			showOtherMonths: true, //Mostrar cuadrilcula
			showOn: "button",
			buttonImage: "../media/fech.png",
			buttonImageOnly: true,
			buttonText: "Seleccionar Fecha"
		});
	});
	$(function() {
		$( "#fecha_requerida" ).datepicker({
			changeMonth: true, // Mostrar el mes
			changeYear: true,
			showOtherMonths: true, //Mostrar cuadrilcula
			showOn: "button",
			buttonImage: "../media/fech.png",
			buttonImageOnly: true,
			buttonText: "Seleccionar Fecha"
		});
	});
	$(function() {
		$( "#pv_decampovigui" ).datepicker({
			changeMonth: true, // Mostrar el mes
			changeYear: true,
			showOtherMonths: true, //Mostrar cuadrilcula
			showOn: "button",
			buttonImage: "../media/fech.png",
			buttonImageOnly: true,
			buttonText: "Seleccionar Fecha"
		});
	});
	$(function() {
		$( "#fecha_limite" ).datepicker({
			changeMonth: true, // Mostrar el mes
			changeYear: true,
			showOtherMonths: true, //Mostrar cuadrilcula
			showOn: "button",
			buttonImage: "../media/fech.png",
			buttonImageOnly: true,
			buttonText: "Seleccionar Fecha"
		});
	});
		function fca(){
			$('#ui-datepicker-div').fadeOut(250);
		}
	</script>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body onload="oc_error()">
	<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
		<?php
			$anio_act = date("Y");
			$periodocj_c = "SELECT * FROM pv_periodo WHERE pv_añoperiodo='$anio_act'";
			$periodocj_c = mysql_query($periodocj_c) or die ($periodocj_c);
			$periodocj = mysql_fetch_array($periodocj_c);
			
			if($periodocj['pv_añoperiodo']==$anio_act){
				echo "<h3 align='center'>Inscribir periodo Plan Vacacional $anio_act</h3><ul class='periodo_ins'>";
				echo "<li onclick=\"location.href='../consultas/pv_estadoper.php?periodo=$periodocj[id_pvperiodo]'\">Periodo $anio_act inscrito</li>";
				echo "</ul>
				<center><img src='../media/inicio.png' onclick=\"location.href='../'\" width='20px' style='cursor:pointer' title='Inicio'/></center>
				";
			}
			
			if($periodocj['pv_añoperiodo']!=$anio_act){
				echo "
				<h3 align='center'>Inscribir periodo Plan Vacacional $anio_act</h3>
				<center><a href='javascript:history.back(1)'>Cancelar</a></center>
				<form action='reg_pvperiodo.php' method='post' onsubmit='return validar_periodo(this);'>
				<table class='ins_periodo'>
					<tr>
						<td>Año del periodo</td><td>$anio_act <input type='hidden' name='anio_periodo' id='anio_periodo' autocomplete=off value='$anio_act'></td>
					</tr>
					<tr>
						<td>Fecha de inicio de inscripción</td><td><input type='text' name='com_periodo' id='com_periodo' autocomplete='off' readonly='readonly' placeholder='Fecha de inicio' onchange='OcErrorFe()'><div id='error_fechain' class='error'>¡Ingrese el Periodo de Inicio!</div></td>
					</tr>
					<tr>
						<td>Fecha de culminación de inscripción</td><td><input type='text' name='fin_periodo' id='fin_periodo' autocomplete='off' readonly='readonly' placeholder='Fecha de culminación' onchange='OcErrorFeI()'><div id='error_fechafin' class='error'>¡Ingrese el Periodo que Finaliza!</div><div id='error_fechafinsub' class='error'>¡Fecha inferior al inicio!</div></td>
					</tr>
					<tr>
						<td>Fecha de nacimiento mínima</td><td><input type='text' name='fecha_requerida' id='fecha_requerida' autocomplete='off' readonly='readonly' placeholder='Fecha mínima' onchange='OcErrorFeRe()'><div id='error_fechaLire' class='error'>¡Ingrese la Fecha requerida del periodo!</div><div id='error_fechaReque' class='error'>¡Fecha superior a la fecha de inicio!</div></td>
					</tr>
					<tr>
						<td>Fecha de nacimiento tope de visita guiada</td><td><input type='text' name='pv_decampovigui' id='pv_decampovigui' autocomplete='off' readonly='readonly' placeholder='Fecha tope visita guiada' onchange='OcErrorFeErrCVG();'><div id='error_fechaITop' class='error'>¡Ingrese la Fecha tope de la visita guiada!</div><div id='error_fechaTop' class='error'>¡Fecha superior a la fecha de inicio!</div></td>
					</tr>
					<tr>
						<td>Fecha de nacimiento limite</td><td><input type='text' name='fecha_limite' id='fecha_limite' autocomplete='off' readonly='readonly' placeholder='Fecha limite' onchange='OcErrorFeL()'><div id='error_fechaLi' class='error'>¡Ingrese la Fecha limite del periodo!</div><div id='error_fechaLimi' class='error'>¡Fecha superior al inicio!</div></td>
					</tr>
				</table>
				<center><input type='submit' id='f_sub' value='Enviar' onclick=\"\"></center>
				</form>
				";
			echo "<br>
		<table class='ins_periodo'>
		<tr><td>Edad Minima mayor o igual a: </td><td> >= <input type='text' name='edad_min' id='edad_min' readonly='readonly' size='5' class='eda_rml'/></td></tr>
		<tr><td>Edad tope visita guiada menor o igual a: </td><td> <= <input type='text' name='edad_vg' id='edad_vg' readonly='readonly' size='5' class='eda_rml'/></td></tr>
		<tr><td>Edad Limite menor a: </td><td> < <input type='text' name='edad_min' id='edad_lim' readonly='readonly' size='5' class='eda_rml'/></td></tr>
		</table><br>
		<fieldset class='nota'>*Nota: Los campos Fecha de nacimiento mínima, Fecha de nacimiento tope de visita guiada y Fecha de nacimiento limite
		 se usan para el cálculo de las edades necesarias reflejadas en el cuadro que se encuentra arriba de esta nota para el registro del periodo del plan vacacional.</fieldset>
		<br>";
			}
		?>
	</div>
</body>
</html>
