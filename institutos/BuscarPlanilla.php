<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<style>
		input{
			text-transform: uppercase;
		}
		.suggest-element{
		margin-left:5px;
		margin-top:5px;
		width:450px;
		cursor:pointer;
		}
		#suggestions{
			min-width:200px;
		text-align:left;
		position:fixed;
		margin: 0 auto;
		height:150px;
		border:ridge 2px;
		border-radius: 3px;
		overflow: auto;
		background: white;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
</head>

<body >
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
if(!array_key_exists('cedula',$_GET)){
?>
	<div id="cabecera_ini"></div>
	<div id="principal">
		<h3 style="text-align:center">Consultar Planilla</h2>
	<form action="pv_planilla.php" method="get">
		<table style="margin:0 auto;text-align:center;padding:5px;">
		<tr><td>Número Planilla</td></tr>
		<tr><td><input type="text" id="pn" name="pn" autocomplete="off" /></td></tr>
		<tr><td><input type="submit" value="Enviar"></td></tr>
		</table><br>
		<center><a href="../" style='color:red;text-decoration:none'>Regresar</a></center>
	</form><br>
	</div>
<?php } ?>
</body>
<?php
if(array_key_exists('error',$_GET) and $_GET['error']=='1'){
	echo "
	<script>
	alert('No se encontró planilla, planilla no generada o número erróneo.');
	</script>
	";
}
?>
</html>

