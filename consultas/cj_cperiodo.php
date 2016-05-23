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
	<link rel="stylesheet" href="../estilo/cj_cperiodo.css" type="text/css"/>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body>
	<div id='cabecera_ini'>
	</div>
	<div id="contenedor">
		<div id="consul_periodo">
			<h3 align="center">Periodos Inscritos</h3>
			<ul class="periodo_insc">
			<?php
				$periodocj_c = "SELECT * FROM cj_cesta_juguete_periodo";
				$periodocj_c = mysql_query($periodocj_c) or die ($periodocj_c);
				while($periodocj = mysql_fetch_array($periodocj_c)){
					echo "<li onclick=\"location.href='cj_estadop.php?periodo=$periodocj[id]'\">Periodo: $periodocj[año_periodo]</li>";
				}
			?>
			</ul>
		</div>
		<center><img src='../media/inicio.png' onclick="location.href='../'" width='20px' style='cursor:pointer' title='Inicio'/></center>
		<br>
	</div>
</body>
<?php
if(array_key_exists('msj',$_GET) and $_GET['msj']=="1"){
	echo "
	<script>
	alert('¡Periodo registrado correctamente!');
	</script>
	";
}
?>
</html>
