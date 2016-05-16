<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->

<?php
session_start();
$_SESSION = array();
session_destroy();
if (ini_get("session.use_cookies")) 
{	mysql_close($conexion);
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"],
	$params["secure"], $params["httponly"]);
}
header("location: ../index.php");
?>
