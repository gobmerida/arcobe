<!--
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php
include("../connect/conexion.php");

// Carga de datos
$trb_cedula = $_POST['trb_cedula'];
$trb_telefono = mb_strtoupper($_POST['trb_telefono'],'utf-8');
$trb_direccionh = mb_strtoupper($_POST['trb_direccionh'],'utf-8');
$trb_correo = $_POST['trb_correo'];

//Actualizar datos
mysql_query("
UPDATE cj_trabajadores_institutos SET
trb_telefono='$trb_telefono',
trb_direccionh='$trb_direccionh',
trb_correo='$trb_correo'
WHERE trb_cedula='$trb_cedula'
") or die (mysql_error());
header("location:trabajador.php?cedula=$trb_cedula&&msj=1");
?>



