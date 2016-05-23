<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");
date_default_timezone_set('UTC');
$fecha = date("Y");

$sql = "SELECT id_pvperiodo FROM pv_periodo_ce WHERE pv_añoperiodo = '$fecha' ";
$query  = mysql_query($sql);
$res     = mysql_fetch_array($query);
$periodo = $res[0];

$cedula_n="";
if(array_key_exists('ninho',$_POST)){
$cedula_n=$_POST['ninho'];
}
$nombre1_n=$_POST['ninho0'];
$nombre2_n=$_POST['nombre2'];
$apellido1_n=$_POST['ninho1'];
$apellido2_n=$_POST['apellido2'];
$fecha_n=an_fecha($_POST['ninho2']);
$sexo_n=$_POST['ninho3'];
$gsanguineo_in=$_POST['ninho4'];

function CalculaEdad( $fecha ){
list($Y,$m,$d) = explode("-",$fecha);
return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
$edad=CalculaEdad($fecha_n);

$mp=$_POST['mp'];
$conta=mysql_query("SELECT contador FROM contador_ce WHERE con_i='0'",$con) or die (mysql_error());
$row_conta=mysql_fetch_array($conta);
$contador=$row_conta['contador'];
$id_ninho=$contador;

echo $sql1="INSERT INTO `pv_hijos_ce`(`id_ninho`, `h_cedula`, `h_nombre1`, `h_nombre2`, `h_apellido1`, `h_apellido2`, `h_fecha_naci`, h_sexo, `id_periodo`, `h_gsanguineo`, `cedula_padre`) values('$id_ninho','$cedula_n','$nombre1_n','$nombre2_n','$apellido1_n','$apellido2_n','$fecha_n','$sexo_n','$periodo','$gsanguineo_in','$mp')";
$query2 = mysql_query($sql1);

$contador=$contador+1;
mysql_query("UPDATE contador_ce SET contador='$contador' WHERE con_i='0'",$con) or die (mysql_error());


header("location:nino_pv_ce.php?nino=$id_ninho&&msj=1");

?>
