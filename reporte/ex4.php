<?php
include("../connect/conexion.php");
$f = fopen("casos_especiales.csv","w");
$sep = ";"; //separador
$linea = "Código".$sep."Cédula".$sep."Nombre y Apellido".$sep."Dependencia".$sep."Cantidad de chequeras".$sep."Niños(as)\n";
$linea= mb_convert_encoding($linea,"ISO-8859-1","UTF-8");
fwrite($f,$linea);
$sql=mysql_query("SELECT * FROM cj_trabajadores_ce ORDER BY trb_apellidos ASC",$con) or die (mysql_error());

while($reg = mysql_fetch_array($sql)){
$cedula_padre=$reg['trb_cedula'];
$ninos_sql=mysql_query("SELECT * FROM cj_hijos_ce WHERE cedula_mp='$cedula_padre' || cedula_repr='$cedula_padre'",$con) or die (mysql_error());
$nino_conta=0;
while($ninos_row=mysql_fetch_array($ninos_sql)){
if($cedula_padre==$ninos_row['cedula_mp'] || $cedula_padre==$ninos_row['cedula_repr']){
$nino_conta=$nino_conta+1;
}
}
if($nino_conta!=0){
$linea = $reg['trb_codigo'].$sep.$reg['trb_cedula'].$sep."\"".$reg['trb_apellidos']." ".$reg['trb_nombres']."\"".$sep."\"".$reg['trb_dependencia']."\"".$sep."$nino_conta"."\n";
$linea= mb_strtoupper($linea,"UTF-8");
$linea= mb_convert_encoding($linea,"ISO-8859-1","UTF-8");
fwrite($f,$linea);
$lin_nino=mysql_query("SELECT * FROM cj_hijos_ce WHERE cedula_mp='$cedula_padre' || cedula_repr='$cedula_padre'",$con) or die (mysql_error());
while($lin_ninos_row=mysql_fetch_array($lin_nino)){
if($cedula_padre==$lin_ninos_row['cedula_mp'] || $cedula_padre==$lin_ninos_row['cedula_repr']){
$nino_linea=$sep.$sep.$sep.$sep.$sep."\"".$lin_ninos_row['h_nombre1']." ".$lin_ninos_row['h_nombre2']." ".$lin_ninos_row['h_apellido1']." ".$lin_ninos_row['h_apellido2']."\""."\n";
$nino_linea= mb_convert_encoding($nino_linea,"ISO-8859-1","UTF-8");
fwrite($f,$nino_linea);
}
}
}
}
fclose($f);
?>

