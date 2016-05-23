<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");
$fecha = date("Y");

echo $sql = "SELECT id_pvperiodo FROM pv_periodo_ce WHERE pv_añoperiodo = '$fecha' ";
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
return( date_default_timezone_set("md") < $m.$d ? date_default_timezone_set("Y")-$Y-1 : date_default_timezone_set("Y")-$Y );
}
$edad=CalculaEdad($fecha_n);

$mp=$_POST['mp'];
$conta=mysql_query("SELECT contador FROM contador WHERE con_i='0'",$con) or die (mysql_error());
$row_conta=mysql_fetch_array($conta);
$contador=$row_conta['contador'];
$id_ninho=$contador;

$sql1="INSERT INTO `pv_hijos_ce`(`id_nino`, `cedula_nino`, `nombre1_nino`, `nombre2_nino`, `apellido1_nino`, `apellido2_nino`, `fecha_naci`, `sexo_nino`, `cedula_padre`, `id_periodo`, `Gsangueneo`)
			value('$id_ninho','$cedula_n','$nombre1_n','$nombre2_n','$apellido1_n','$apellido2_n','$fecha_n','$sexo_n','$mp','$periodo','$gsanguineo_in')";
$query2 = mysql_query($sql1);

$contador=$contador+1;
mysql_query("UPDATE contador SET contador='$contador' WHERE con_i='0'",$con) or die (mysql_error());


header("location:nino_pv_ce.php?nino=$id_ninho&&msj=1");

?>
