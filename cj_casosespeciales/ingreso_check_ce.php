<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Cesta Juguete</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<style>
	#edad{
	width:340px;
	height:200px;
	border: ridge 2px white;
	margin:0 auto;
	border-radius: 7px;
	background-color: white;
	}
	</style>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
$nino=$_GET['nino'];
?>
<body>
	<div id="edad">
		<br>
		<br>
		<br>
		<h2 style='color:red;text-align:center'>Niño(a) ingresado correctamente</h2>
		<center><a href="nino_ce.php?nino=<?php echo $nino; ?>" class="n">Comprobar Niño(a)</a></center>
	</div>
	
</body>
</html>
