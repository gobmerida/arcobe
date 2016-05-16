<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//ES"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="./estilo/estilo.css" type="text/css"/>
<!--
	<script language="javascript" src="./js/jquery.js.js"></script>
-->
	<script language="javascript" src="./js/delimitar.js"></script>
	<style>
		table{
			margin:0 auto;
			border-color:gainsboro;
		}
		p.title{
			color:red;
			text-align:center;
		}
		p.msj{
			margin:auto;
			width:400px;
			text-align:justify;
		}
	</style>
</head>
<?php
	session_start();
	if(isset($_SESSION['usuario_user'])){ 
	header("location: ./index2.php");
	}
?>
<body>
	
	<?php
	include("connect/conexion.php");
	?>
	<div id="cabecera_ini"></div>
	<div id="contenedor">
	<h3 style="text-align:center">ARCOBE</h2>
	<form action="./sesion/sesiones.php" method="post">
		<table>
			<tr><td>Usuario</td><td><input  type="text" name="user" autocomplete="off" onkeypress="return permite(event, 'esp')"></td></tr>
			<tr><td>Contraseña</td><td><input  type="password" name="pass"></td></tr>
			<tr><td colspan=2 style="text-align:center"><input  type="submit" value="Enviar" id="ingresar" disabled='disabled'></td></tr>
		</table>
	</form>
	<script>
	document.getElementById("ingresar").disabled=false;
	</script>
	<noscript>
  <p class="title">Bienvenido a ARCOBE</p>
  <p class="msj">La aplicación que estás intentando acceder requiere para su funcionamiento el uso de JavaScript. 
Si lo has deshabilitado intencionadamente, por favor vuelve a activarlo o informa el error para corregirlo de lo contrario no podrás ingresar.</p>
</noscript>
	<br>
</body>
<?php
if(array_key_exists('error',$_GET) and $_GET['error']=='1'){
echo "
<script>
alert('¡Usuario o Contraseña inválido!');
</script>
";
}
if(array_key_exists('error',$_GET) and $_GET['error']=='2'){
echo "
<script>
alert('¡Usuario suspendido!');
</script>
";
}
if(array_key_exists('error',$_GET) and $_GET['error']=='4'){
echo "
<script>
alert('¡No dejes valores en blanco!');
</script>
";
}
?>
</html>
