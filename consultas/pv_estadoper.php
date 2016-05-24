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
	<link rel="stylesheet" href="../estilo/pv_periodoc.css" type="text/css"/>
	<link rel="stylesheet" href="../js/jquery-ui.css" type="text/css"/>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/jquery-ui.js"></script>
	<script>
	$(function() {
	$( "#tabs" ).tabs({
	beforeLoad: function( event, ui ) {
	ui.jqXHR.fail(function() {
	ui.panel.html(
	"No se ha podido cargar su petición. " +
	"Notifique sobre el problema para solucionarlo los más pronto posible." );
	});
	}
	});
	});
	</script>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
include("../script_php/a_fe.php");
$c = 0;
if(array_key_exists('periodo',$_GET)){
$periodo = $_GET['periodo'];

$c_periodo = "SELECT * FROM pv_inscrip WHERE id_periodo='$periodo'";
$c_periodo = mysql_query($c_periodo) or die (mysql_error());
while($r_periodo = mysql_fetch_array($c_periodo)){
	$c = $c + 1;
}

$periodo_sql = "SELECT * FROM pv_periodo WHERE id_pvperiodo='$periodo'";
$periodo_sql = mysql_query($periodo_sql) or die ("Error: ".mysql_error());
$periodo_row = mysql_fetch_array($periodo_sql);

?>
<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor">
		<?php
		function CalculaEdad($fecha,$periodo_anio){
			list($anio, $mesact, $diaact) = explode("-",$fecha);
			$dia=$diaact;
			$mes=$mesact;
			$ano=$periodo_anio;
			list($Y,$m,$d) = explode("-",$fecha);
			if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
			if ($m > $mes){ $ano=($ano-1);}
			$edad=($ano-$Y)." años";
			return $edad;
		}
			echo "<h3 align='center'>Plan Vacacional $periodo_row[pv_añoperiodo]</h3>
			<table class='ver_periodo'>
				<tr><td>Inicio del periodo de inscripción: </td><td>".a_fecha($periodo_row['pv_iniperiodo'])."</td></tr>
				<tr><td>Culminación del periodo de inscripción: </td><td>".a_fecha($periodo_row['pv_finperiodo'])."</td></tr>
				<tr><td>Fecha de nacimiento mínima: </td><td>".a_fecha($periodo_row['pv_fecha_reque'])."</td></tr>
				<tr><td>Fecha de nacimiento tope de visita guiada: </td><td>".a_fecha($periodo_row['pv_decampovigui'])."</td></tr>
				<tr><td>Fecha de nacimiento limite: </td><td>".a_fecha($periodo_row['pv_fecha_limite'])."</td></tr>
			</table>
			<br>
			<table class='ver_periodo'>
				<tr><td>Edad mínima mayor o igual a: </td><td>".CalculaEdad($periodo_row['pv_fecha_reque'],$periodo_row['pv_añoperiodo'])."</td></tr>
				<tr><td>Edad tope de visita guiada menor o igual a: </td><td>".CalculaEdad($periodo_row['pv_decampovigui'],$periodo_row['pv_añoperiodo'])."</td></tr>
				<tr><td>Edad limite menor a: </td><td>".CalculaEdad($periodo_row['pv_fecha_limite'],$periodo_row['pv_añoperiodo'])."</td></tr>
			</table>";
		?><br>
		<center><img src='../media/inicio.png' onclick="location.href='../'" width='20px' style='cursor:pointer' title='Inicio'/></center><br>
		<div id="tabs">
			<ul>
			<li><a href="globales_estimado.php?periodo=<?php echo $periodo ?>">Totales</a></li>
			<li><a href="visita_estimado.php?periodo=<?php echo $periodo ?>">Visita Guiada</a></li>
			<li><a href="camp_estimado.php?periodo=<?php echo $periodo ?>">Campamento</a></li>
			<li><a href="inst_estimado.php?periodo=<?php echo $periodo ?>">Institutos</a></li>
			<li><a href="ce_estimado.php?periodo=<?php echo $periodo ?>">Casos Especiales</a></li>
			<li><a href="pv_cuaderno.php?periodo=<?php echo $periodo ?>">Cuaderno</a></li>
			<li><a href="pv_cuaderno_institutos.php?periodo=<?php echo $periodo ?>">Cuaderno Institutos</a></li>
			<li><a href="pv_cuaderno_ce.php?periodo=<?php echo $periodo ?>">Cuaderno (c/e)</a></li>
			</ul>
		</div>
		<br>
	</div>
</body>
<?php
}
?>
</html>
