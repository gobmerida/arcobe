<!--
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");

// Carga de datos
$id_ninho = $_POST['id_ninho'];
$h_cedula = $_POST['h_cedula'];
$h_nombre1 = mb_strtoupper($_POST['h_nombre1'],'utf-8');
$h_nombre2 = mb_strtoupper($_POST['h_nombre2'],'utf-8');
$h_apellido1 = mb_strtoupper($_POST['h_apellido1'],'utf-8');
$h_apellido2 = mb_strtoupper($_POST['h_apellido2'],'utf-8');
$h_fecha_naci = an_fecha($_POST['h_fecha_naci']);
$h_sexo = $_POST['h_sexo'];
$h_gsanguineo = $_POST['h_gsanguineo'];

//Actualizar datos
mysql_query("
UPDATE cj_beneficiados SET
h_cedula='$h_cedula',
h_nombre1='$h_nombre1',
h_nombre2='$h_nombre2',
h_apellido1='$h_apellido1',
h_apellido2='$h_apellido2',
h_fecha_naci='$h_fecha_naci',
h_sexo='$h_sexo',
h_gsanguineo='$h_gsanguineo'
WHERE id_ninho='$id_ninho'
") or die (mysql_error());
header("location:nino.php?nino=$id_ninho&&msj=2");
?>


