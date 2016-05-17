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
	<link rel="stylesheet" href="../estilo/menu.css" type="text/css"/>
</head>
<?php
	session_start();
	if(!isset($_SESSION['usuario_user'])){ 
	header("location: ../index.php");
	}
?>
<body>
	<div id="rol"><?php echo $_SESSION['rol_nombre'];
	?>
	</div>
	<div id="cabecera_ini"></div>
	<div id='principal'>
		
	<ul id="nav">
		<li onclick="location.href='../'" class="principal">Volver</li>
		<li class='principal' >Consultar
			<ul class="secundario">
				<li onclick="location.href='b_nino.php'">Beneficiario</li>
				<li onclick="location.href='trabajador.php'">Trabajador</li>
				<li onclick="location.href='BuscarPlanilla.php'">Buscar Planilla</li>
			</ul>
		<?php
		?>
		</li>
			<li class='principal' >Registrar Beneficiarios
			<ul class="secundario">
				<li onclick="location.href='../ingresar/ing_mp_insti.php'">Por padres</li>
				<li onclick="location.href='../ingresar/ing_rep_insti.php'">Por representante</li>
			</ul>
		</li>
	</ul>
	<h2 align="center" style="color:red">Plan Vacacional - Institutos</h2>
	</div>
</body>
</html>
