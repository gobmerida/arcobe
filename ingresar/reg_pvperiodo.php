<!--
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");
$pv_añoperiodo  = $_POST['anio_periodo'];
$pv_iniperiodo = an_fecha($_POST['com_periodo']);
$pv_finperiodo = an_fecha($_POST['fin_periodo']);
$pv_fecha_reque = an_fecha($_POST['fecha_requerida']);
$pv_fecha_limite = an_fecha($_POST['fecha_limite']);
$pv_decampovigui = an_fecha($_POST['pv_decampovigui']);

$reg_peri = "INSERT INTO pv_periodo(
pv_añoperiodo, 
pv_iniperiodo, 
pv_finperiodo, 
pv_fecha_reque, 
pv_fecha_limite,
pv_decampovigui,
cierre
)
value(
'$pv_añoperiodo', 
'$pv_iniperiodo', 
'$pv_finperiodo', 
'$pv_fecha_reque',
'$pv_fecha_limite',
'$pv_decampovigui',
'0'
)
";
mysql_query($reg_peri);

$reg_peri_ce = "INSERT INTO pv_periodo_ve(
pv_añoperiodo, 
pv_iniperiodo, 
pv_finperiodo, 
pv_fecha_reque, 
pv_fecha_limite,
pv_decampovigui,
cierre
)
value(
'$pv_añoperiodo', 
'$pv_iniperiodo', 
'$pv_finperiodo', 
'$pv_fecha_reque',
'$pv_fecha_limite',
'$pv_decampovigui',
'0'
)
";
mysql_query($reg_peri_ce);
$reg_peri_ins = "INSERT INTO pv_periodo_ce(
pv_añoperiodo, 
pv_iniperiodo, 
pv_finperiodo, 
pv_fecha_reque, 
pv_fecha_limite,
pv_decampovigui,
cierre
)
value(
'$pv_añoperiodo', 
'$pv_iniperiodo', 
'$pv_finperiodo', 
'$pv_fecha_reque',
'$pv_fecha_limite',
'$pv_decampovigui',
'0'
)
";
mysql_query($reg_peri_ins);
header("location:../consultas/pv_periodocst.php?msj=1");
?>
