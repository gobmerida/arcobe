<?php
include("../connect/conexion.php");

$mp_cedula = $_POST['mp_cedula'];
$nino = $_POST['nino'];
$mp_nombres = mb_strtoupper($_POST['mp_nombres'],'utf-8');
$mp_apellidos = mb_strtoupper($_POST['mp_apellidos'],'utf-8');

mysql_query("
UPDATE cj_mp SET
mp_nombre='$mp_nombres',
mp_apellido='$mp_apellidos'
WHERE mp_cedula='$mp_cedula'
") or die (mysql_error());
header("location:nino.php?cedula=$mp_cedula&&msj=3&&nino=$nino");

?>

