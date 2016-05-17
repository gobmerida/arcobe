<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");
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

if(array_key_exists('nombre_mp',$_POST)){
$nombre_mp=$_POST['nombre_mp'];
$apellido_mp=$_POST['apellido_mp'];
$nombre_mp=mb_strtoupper($nombre_mp,'utf-8');
$apellido_mp=mb_strtoupper($apellido_mp,'utf-8');
}
$nombre1_n=mb_strtoupper($nombre1_n,'utf-8');
$nombre2_n=mb_strtoupper($nombre2_n,'utf-8');
$apellido1_n=mb_strtoupper($apellido1_n,'utf-8');
$apellido2_n=mb_strtoupper($apellido2_n,'utf-8');

$mp=$_POST['mp'];
$trb_c=$_POST['trb_c'];
$pm="";
if(array_key_exists("pm",$_POST)){
	$pm=$_POST['pm'];
}
$conta=mysql_query("SELECT contador FROM contador WHERE con_i='0'",$con) or die (mysql_error());
$row_conta=mysql_fetch_array($conta);
$contador=$row_conta['contador'];
$id_ninho=$trb_c."-".$contador;
mysql_query("INSERT INTO cj_beneficiados(id_ninho,h_cedula,h_nombre1,h_nombre2,h_apellido1,h_apellido2,h_fecha_naci,h_sexo,h_gsanguineo)
			value('$id_ninho','$cedula_n','$nombre1_n','$nombre2_n','$apellido1_n','$apellido2_n','$fecha_n','$sexo_n','$gsanguineo_in')",$con) or die ("Error al ingresar niño: ".mysql_error());
mysql_query("INSERT INTO cj_cp(id_ninho,cedula_mp,cedula_pm) value('$id_ninho','$mp','$pm')") or die (mysql_error());
$contador=$contador+1;
mysql_query("UPDATE contador SET contador='$contador' WHERE con_i='0'",$con) or die (mysql_error());

if(array_key_exists('nombre_mp',$_POST) and array_key_exists("pm",$_POST)){
	$nombre_mp=$_POST['nombre_mp'];
	$apellido_mp=$_POST['apellido_mp'];
	mysql_query("INSERT INTO cj_mp(mp_cedula,mp_nombre,mp_apellido) value('$pm','$nombre_mp','$apellido_mp')",$con) or die (mysql_error());
}
header("location: ../consultas/nino.php?nino=$id_ninho&&msj=1");

?>
