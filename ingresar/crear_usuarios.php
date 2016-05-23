<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Crear Usuarios</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor">
	<center>
		<h3 class="n">Crear Usuarios</h3><br>
		<br>
		<form name="formulario" action="crear_usuarios.php" method="POST">
			Usuario:<br> <input type="text" name="usuario_user" id="" autocomplete=off required minlength="2"><br>
			Contraseña:<br> <input type="password" name="usuario_clave" id="clave" autocomplete=off required><br>
			Confirmar contraseña:<br> <input type="password" name="clave2" id="clave2" autocomplete=off required><br>
			Cedula:<br> <input type="text" name="usuario_cedula" id="" autocomplete=off required><br>
			Nombre:<br> <input type="text" name="usuario_nombre" id="" autocomplete=off placeholder="Solo letras" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,}"><br>
			Apellido:<br> <input type="text" name="usuario_apellido" id="" autocomplete=off placeholder="Solo letras" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ ]{2,}"><br>
			Tipo de usuario:<br> <select name="usuario_rol" id="">
				<option value="4">Suscriptor</option>
				<option value="3">Director</option>
				<option value="2">Consultor</option>
				<option value="1">Administrador</option>
			</select><br><br>
			<input type="reset" value="Limpiar">
			<input type="submit" value="Crear Usuario">
			<div id="suggestions"></div>
		</form><br>
		<center><span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href='../index2.php'>Inicio</a>
	</div>
	<script>
		(function(){
			var clave = formulario.usuario_clave;
			var clave2 = formulario.clave2;
			var validar= function validarContraseña(e) {
			var formulario = document.formulario;
			if (clave.value != clave2.value) {
				alert("las contraseñas no coinciden vuelva a introducirlas");
				e.preventDefault()
			}
			largopass = formulario.usuario_user.value.length;
        	 if(largopass < 5){
                  alert("El usuario debe ser al menos de 5 caracteres.");
                  formulario.usuario_user.focus();
                  e.preventDefault()
         	}
		}

		formulario.addEventListener("submit", validar);
		})();
	</script>
</body>
</html>
<?php
	/*function hora()
	{
		date_default_timezone_set("America/Caracas");
		$hora=date("h:i:s a" );
		return ($hora);
	}*/
	function fecha()
	{
		date_default_timezone_set("America/Caracas");
		$fecha=date("Y-m-d");
		return($fecha);
	}
	if (isset($_POST["usuario_user"])){
		$sql="SELECT usuario_user FROM cj_usuarios WHERE usuario_user='".$_POST["usuario_user"]."'";
		$rs2=mysql_query($sql)or die(mysql_error());
		$num=mysql_num_rows($rs2);
		if ($num === 1) echo "<script>alert('Usuario ya registrado');window.location='crear_usuarios.php';</script>";
		$sql="INSERT INTO cj_usuarios VALUES(NULL, '".$_POST["usuario_cedula"]."', '".$_POST["usuario_user"]."', '".$_POST["usuario_nombre"]."', '".$_POST["usuario_apellido"]."', '".md5($_POST["usuario_clave"])."','".fecha()."', '1', '".$_POST["usuario_rol"]."')";
		$rs=mysql_query($sql) or die (mysql_error());
		echo "<script>alert('usuario: ".$_POST["usuario_user"]." creado correctamente');window.location='crear_usuarios.php';</script>";
	}

?>