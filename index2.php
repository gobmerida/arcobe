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
	<link rel="stylesheet" href="./estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="./estilo/menu.css" type="text/css"/>
</head>
<?php
	session_start();
	if(!isset($_SESSION['usuario_user'])){ 
	header("location: ./index.php");
	}
?>
<body>
	<div id="rol"><?php echo $_SESSION['rol_nombre']; //$_SERVER['HTTP_REFERER'] saber página anterior
	//~ if(array_key_exists('HTTP_REFERER',$_SERVER)){
	//~ echo "Si hay";
	//~ }
	//~ else echo "No hay";
	?>
	</div>
	<div id="cabecera_ini"></div>
	<div id='principal'>
	<ul id="nav">
		<li onclick="location.href='./sesion/cerrar_sesion.php'" class="principal">Cerrar Sesión</li>
		<li class='principal' >Consultar
			<ul class="secundario">
				<li onclick="location.href='./consultas/trabajador.php'">Trabajador</li>
				<li onclick="location.href='./consultas/b_nino.php'">Beneficiario</li>
				<?php
				if($_SESSION['usuario_rol']==1){
				?>
<!--
				<li onclick="location.href='./reporte/reporte.php'">Reporte</li>
-->
				<?php
				}
				?>
			</ul>
		<?php
			if($_SESSION['rol_ingreso']==1){
		?>
		<li class='principal'>Registrar Beneficiario
			<ul class="secundario">
				<li onclick="location.href='./ingresar/ing_mp.php'">Por madre o padre</li>
				<?php
				if($_SESSION['rol_representante']==1){
				?>
				<li onclick="location.href='./ingresar/ing_rep.php'">Por representante</li>
				<?php
				}
				?>
			</ul>
		</li>
		<?php
		}
		?>
		</li>
		<?php
		if($_SESSION['rol_periodo']==1 || $_SESSION['rol_cperiodo']==1 || $_SESSION['rol_ce']==1){
		?>
		<li class='principal'>Cesta Juguete
			<ul class="secundario">
				<?php
				if($_SESSION['rol_periodo']==1){
				?>
				<li onclick="location.href='./ingresar/ing_periodo.php'">Ingresar Periodo</li>
				<?php
				}
				if($_SESSION['rol_cperiodo']==1){
				?>
				<li onclick="location.href='./consultas/cj_cperiodo.php'">Consultar Periodo</li>
				<?php
				}
				if($_SESSION['rol_ce']==1){
				?>
				<li onclick="location.href='./cj_casosespeciales'">Casos Especiales</li>
				
			</ul>
			<?php
				}
			}
				?>
		</li>

		<?php
		if($_SESSION['rol_periodo']==1 || $_SESSION['rol_cperiodo']==1 || $_SESSION['rol_ce']==1){
		?>
		<li class='principal'>Plan Vacacional
			<ul class="secundario">
				<?php
				if($_SESSION['rol_periodo']==1){
				?>
				<li onclick="location.href='./ingresar/ingpv_periodo.php'">Ingresar Periodo</li>
				<?php
				}
				if($_SESSION['rol_cperiodo']==1){
				?>
				<li onclick="location.href='./consultas/pv_periodocst.php'">Consultar Periodo</li>
				<?php
				}
				if($_SESSION['rol_ce']==1){
				?>
				<li onclick="location.href='./pv_casosespeciales'">Casos Especiales</li>
				<li onclick="location.href='./institutos'">Institutos</li>
				<li onclick="location.href='consultas/BuscarPlanilla.php'">Buscar Planilla</li>
				<li onclick="location.href='consultas/falta.php'">Falta por documento</li>
				<?php
				}
			}
				?>
			</ul>
		</li>
		<?php
		if($_SESSION['rol_periodo']==1){
		?>
		<li class='principal'>Usuarios
			<ul class="secundario">
				
				<li onclick="location.href='./ingresar/crear_usuarios.php'">Crear Usuarios</li>
				
				
				
				
				<?php
				}
				
			
				?>
			</ul>
		</li>
	</ul>
	</div>
</body>
</html>
