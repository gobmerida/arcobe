<?php
include("../connect/conexion.php");
$cedula_n="";
if(array_key_exists('ninho',$_POST)){
$cedula_n=$_POST['ninho'];
}
$nombre1_n=$_POST['ninho0'];
$nombre2_n=$_POST['nombre2'];
$apellido1_n=$_POST['ninho1'];
$apellido2_n=$_POST['apellido2'];
$fecha_n=$_POST['ninho2'];
$sexo_n=$_POST['ninho3'];

function CalculaEdad( $fecha ) { // Funcion para calcular la edad de los niños
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
$conta=mysql_query("SELECT contador FROM contador_ce WHERE con_i='0'",$con) or die (mysql_error());
$row_conta=mysql_fetch_array($conta);
$contador=$row_conta['contador'];
$id_ninho=$trb_c."-".$contador."-CE";
mysql_query("INSERT INTO cj_hijos_ce(id_ninho,h_cedula,h_nombre1,h_nombre2,h_apellido1,h_apellido2,h_fecha_naci,h_sexo,cedula_mp,cedula_pm,id_periodo)
			value('$id_ninho','$cedula_n','$nombre1_n','$nombre2_n','$apellido1_n','$apellido2_n','$fecha_n','$sexo_n','$mp','$pm','2')",$con) or die (mysql_error());
$contador=$contador+1;
mysql_query("UPDATE contador_ce SET contador='$contador' WHERE con_i='0'",$con) or die (mysql_error());

if(array_key_exists('nombre_mp',$_POST) and array_key_exists("pm",$_POST)){
	$nombre_mp=$_POST['nombre_mp'];
	$apellido_mp=$_POST['apellido_mp'];
	mysql_query("INSERT INTO cj_mp(mp_cedula,mp_nombre,mp_apellido) value('$pm','$nombre_mp','$apellido_mp')",$con) or die (mysql_error());
}

$DataQuery01 = "select * from cj_cuaderno_ce where ced_tbr='$mp'";
$DataQuery01 = mysql_query($DataQuery01);
$DataROW01 = mysql_fetch_array($DataQuery01);

if($DataROW01["ced_tbr"]==""){
	$DataQuery02 = "select * from cj_cesta_juguete_periodo where id='2'";
	$DataQuery02 = mysql_query($DataQuery02);
	$DataROW02 = mysql_fetch_array($DataQuery02);
	$aux01 = $DataROW02["contador_perCE"];
	$aux02 = $DataROW02["AuxCE"];
	$aux03 = $DataROW02["ContadorAuxCE"];
	if($aux02>=10){
		$aux02 = 0;
		$aux03++;
	}
	$aux01++;
	$aux02++;
	$DataQuery03 = "insert into cj_cuaderno_ce(ced_tbr,Npagina,Nlinea,Periodo) values('$mp','$aux03','$aux01','2')";
	mysql_query($DataQuery03) or die (mysql_error());
	$DataSQL02 = "update cj_cesta_juguete_periodo set contador_perCE='$aux01',ContadorAuxCE='$aux03',AuxCE='$aux02' where id='2'";
	$DataSQL02 = mysql_query($DataSQL02);
}

header("location: ingreso_check_ce.php?nino=$id_ninho");


?>
