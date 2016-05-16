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
	<link rel="stylesheet" href="./estilo/estilo.css" type="text/css"/>
</head>
<?php
include("./connect/conexion.php");
//~ include("./sesion/sesion.php");
?>
<body>
	<div id="iniciar">
		<form action="ed.php" method="get">
		Fecha <input type="date" name="fecha">
		<input type="submit" value="Consultar">
		</form>
		<?php
		if(array_key_exists("fecha",$_GET)){
			$fecha=$_GET['fecha'];
			function CalculaEdad( $fecha ) { // Funcion para calcular la edad de los niños
			list($Y,$m,$d) = explode("-",$fecha);
			return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
			}
			$edad=CalculaEdad($fecha);
			echo $edad;
			if($fecha<='2001-12-15'){
				echo " No merece";
			}
			if($fecha>'2001-12-15'){
				echo " merece";
			}
			
		}
		?>
		<center><a href="../">Regresar</a></center>
	</div>
</body>
</html>
