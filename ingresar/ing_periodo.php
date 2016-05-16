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
	<script src="../js/val_form.js"></script>
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
			buttonText: "Select date"
		});
	});
	$(function() {
		$( "#fin_periodo" ).datepicker({
			showOtherMonths: true, //Mostrar cuadrilcula
			showOn: "button",
			buttonImage: "../media/fech.png",
			buttonImageOnly: true,
			buttonText: "Select date"
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
			buttonText: "Select date"
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
			$periodocj_c = "SELECT * FROM cj_cesta_juguete_periodo WHERE año_periodo='$anio_act'";
			$periodocj_c = mysql_query($periodocj_c) or die ($periodocj_c);
			$periodocj = mysql_fetch_array($periodocj_c);
			echo "<ul class='periodo_ins'>";
			if($periodocj['año_periodo']==$anio_act){
				echo "<li>Periodo $anio_act inscrito</li>";
			}
			echo "</ul>";
			if($periodocj['año_periodo']!=$anio_act){
				echo "
				<h3 align='center'>Inscribir periodo del Cesta Juguete $anio_act</h3>
				<center><a href='javascript:history.back(1)'>Cancelar</a></center>
				<form action='reg_periodocj.php' method='post' onsubmit='return validar_periodo(this);'>
				<table class='ins_periodo'>
					<tr>
						<td>Año del periodo</td><td>$anio_act <input type='hidden' name='anio_periodo' id='anio_periodo' autocomplete=off value='$anio_act'></td>
					</tr>
					<tr>
						<td>Fecha de inicio</td><td><input type='text' name='com_periodo' id='com_periodo' autocomplete='off' readonly='readonly' placeholder='Fecha de inicio' onchange='OcErrorFe()'><div id='error_fechain' class='error'>¡Ingrese el Periodo de Inicio!</div></td>
					</tr>
					<tr>
						<td>Fecha que finaliza</td><td><input type='text' name='fin_periodo' id='fin_periodo' autocomplete='off' readonly='readonly' placeholder='Fecha que finaliza' onchange='OcErrorFeI()'><div id='error_fechafin' class='error'>¡Ingrese el Periodo que Finaliza!</div><div id='error_fechafinsub' class='error'>¡Fecha inferior al inicio!</div></td>
					</tr>
					<tr>
						<td>Fecha limite</td><td><input type='text' name='fecha_limite' id='fecha_limite' autocomplete='off' readonly='readonly' placeholder='Fecha limite' onchange='OcErrorFeL()'><div id='error_fechaLi' class='error'>¡Ingrese la Fecha limite del periodo!</div><div id='error_fechaLimi' class='error'>¡Fecha superior al inicio!</div></td>
					</tr>
				</table>
				<center><input type='submit' id='f_sub' value='Enviar' onclick=\"\"></center>
				</form>
				<br>
				<fieldset class='edades_lim'>
				<b>Edad límite</b> <input type='text' id='edad_lm' size='5'/>
				</fieldset>
				";
			}
		?>
		<br>
	</div>
</body>
</html>
