<!--
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");
$año_periodo  = $_POST['anio_periodo'];
$com_periodo = an_fecha($_POST['com_periodo']);
$fin_periodo = an_fecha($_POST['fin_periodo']);
$fecha_limite = an_fecha($_POST['fecha_limite']);

$reg_peri = "INSERT INTO cj_cesta_juguete_periodo(
año_periodo, 
com_periodo, 
fin_periodo, 
fecha_limite,
cierre
)
value(
'$año_periodo', 
'$com_periodo', 
'$fin_periodo', 
'$fecha_limite',
'0'
)
";
mysql_query($reg_peri);
header("location:../consultas/cj_cperiodo.php?msj=1");
?>
