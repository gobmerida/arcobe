<?php
include("../connect/conexion.php");

$mpr_cedula = $_POST['mpr_cedula'];
$mpr_nombres = mb_strtoupper($_POST['mpr_nombres'],'utf-8');
$mpr_apellidos = mb_strtoupper($_POST['mpr_apellidos'],'utf-8');
$mpr_telefono = $_POST['mpr_telefono'];
$mpr_direccion = mb_strtoupper($_POST['mpr_direccion'],'utf-8');

mysql_query("
UPDATE pvce_mpr SET
mpr_nombres='$mpr_nombres',
mpr_apellidos='$mpr_apellidos',
mpr_telefono='$mpr_telefono',
mpr_direccion='$mpr_direccion'
WHERE mpr_cedula='$mpr_cedula'
") or die (mysql_error());
header("location:persona.php?cedula=$mpr_cedula&&msj=2");

?>
