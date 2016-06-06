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
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css" />
	<link rel="stylesheet" href="../js/jquery-ui.css" type="text/css" />
	<link rel="stylesheet" href="../estilo/cj_esper.css" type="text/css" />
	<link rel="stylesheet" href="../estilo/cj_cperiodo.css" type="text/css" />
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
	<style>
	#tabs{margin: auto;width: 85%;}
	</style>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
$c = 0;
$caux = 0;
if(array_key_exists('periodo',$_GET)){
$periodo = $_GET['periodo'];
$c_periodo = "SELECT * FROM cj_inscritos_periodo WHERE id_periodo='$periodo'";
$c_periodo = mysql_query($c_periodo) or die (mysql_error());
while($r_periodo = mysql_fetch_array($c_periodo)){
	$c = $c + 1;
}
$DataSQ01 = "SELECT * FROM cj_inscritos_periodo_aux WHERE id_periodo='$periodo'";
$DataSQ01 = mysql_query($DataSQ01) or die (mysql_error());
while($DataR01 = mysql_fetch_array($DataSQ01)){
	$caux = $caux + 1;
}
?>
<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor">
		<h3 align="center">Totales de Cesta Juguete</h3>
		<ul id="nincj" class="periodo_insc">
		<?php
			//echo "<li>Hay un total de ".$c." niños registrados</li>";
			echo "<li>Total de ".$caux." niños registrados(ta)</li>";
		?>
		</ul>
		<br>
		<br>
		<center><img src='../media/inicio.png' onclick="location.href='../'" width='20px' style='cursor:pointer' title='Inicio'/></center><br>
		<div id="tabs">
			<ul>
			<li><a href="cj_totalcnc.php?periodo=<?php echo $periodo ?>">Totales</a></li>
			<li><a href="cj_totalconfirmado.php?periodo=<?php echo $periodo ?>">Confirmados</a></li>
			<li><a href="cj_totalcasosespeciales.php?periodo=<?php echo $periodo ?>">Casos Especiales</a></li>
			<li><a href="../actualizar/gestion_cuaderno_echo.php?periodo=<?php echo $periodo ?>">Cuaderno</a></li>
			<li><a href="../cj_casosespeciales/gestion_cuaderno_echoCE.php?periodo=<?php echo $periodo ?>">Cuaderno <b style="color=#c00">(CE)</b></a></li>
			</ul>
		</div>
		<br>
	</div>
</body>
<?php
}
?>
</html>
