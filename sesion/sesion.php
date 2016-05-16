<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->

<?php
	session_start();
	if (!isset($_SESSION['usuario_user'])){ 
	header("location: ../index.php");
	}
?>
