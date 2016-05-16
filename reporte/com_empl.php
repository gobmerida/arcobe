<?php
include("../connect/conexion.php");
$sql=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_codigo like 'EM-%' XOR trb_codigo like 'EC-%' XOR trb_codigo like 'PO-%' XOR trb_codigo like 'BO-%' XOR trb_codigo like 'EF-%' XOR trb_codigo like 'CO-%' XOR trb_codigo like 'COC-%' ORDER BY trb_apellidos ASC",$con) or die (mysql_error());
$emple=0;
while($reg = mysql_fetch_array($sql)){
$cedula_padre=$reg['trb_cedula'];
$ninos_sql=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$cedula_padre' || cedula_repr='$cedula_padre'",$con) or die (mysql_error());
$nino_conta=0;
while($ninos_row=mysql_fetch_array($ninos_sql)){
if($cedula_padre==$ninos_row['cedula_mp'] || $cedula_padre==$ninos_row['cedula_repr']){
$nino_conta=$nino_conta+1;
}
}
if($nino_conta!='0'){
	$emple=$emple+1;
}
}
echo "Empleados ".$emple."<br>";

$sql=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_codigo like 'OS-%' XOR trb_codigo like 'OF-%' XOR trb_codigo like 'OP-%' XOR trb_codigo like 'OB-%' XOR trb_codigo like 'OO-%' XOR trb_codigo like 'BE-%' ORDER BY trb_apellidos ASC",$con) or die (mysql_error());
$emple=0;
while($reg = mysql_fetch_array($sql)){
$cedula_padre=$reg['trb_cedula'];
$ninos_sql=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$cedula_padre' || cedula_repr='$cedula_padre'",$con) or die (mysql_error());
$nino_conta=0;
while($ninos_row=mysql_fetch_array($ninos_sql)){
if($cedula_padre==$ninos_row['cedula_mp'] || $cedula_padre==$ninos_row['cedula_repr']){
$nino_conta=$nino_conta+1;
}
}
if($nino_conta!='0'){
	$emple=$emple+1;
}
}
echo "Obreros ".$emple."<br>";
?>
