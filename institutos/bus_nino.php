<?php
include("../connect/conexion.php");

$search = $_POST['codigo'];
if($search!=""){
$query_services = mysql_query("SELECT * FROM cj_hijos_institutos WHERE id_ninho like '" . $search . "%' ORDER BY id_ninho DESC", $con);
$co=0;
while($row_services=mysql_fetch_array($query_services)){
	$id_ninho=$row_services['id_ninho'];
	$persona="Codigo: ".$row_services['id_ninho']." ".$row_services['h_nombre1']." ".$row_services['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$co=$co+1;
}
if($co==0){
$b_nombre = mysql_query("SELECT * FROM cj_hijos_institutos WHERE h_nombre1 like '" . $search . "%' ORDER BY id_ninho DESC", $con);
$nu=0;
while($row_b_nombre=mysql_fetch_array($b_nombre)){
	$id_ninho=$row_b_nombre['id_ninho'];
	$persona="Codigo: ".$row_b_nombre['id_ninho']." ".$row_b_nombre['h_nombre1']." ".$row_b_nombre['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$nu=$nu+1;
}
if($nu==0){
$b_apellido = mysql_query("SELECT * FROM cj_hijos_institutos WHERE h_apellido1 like '" . $search . "%' ORDER BY id_ninho DESC", $con);
$ni=0;
while($row_b_apellido=mysql_fetch_array($b_apellido)){
	$id_ninho=$row_b_apellido['id_ninho'];
	$persona="Codigo: ".$row_b_apellido['id_ninho']." ".$row_b_apellido['h_nombre1']." ".$row_b_apellido['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$ni=$ni+1;
}
if($ni==0){
$b_apellido_nombre = mysql_query("SELECT * FROM b_nino_na_institutos WHERE nombre_com like '" . $search . "%' ORDER BY id_ninho DESC", $con);
$ne=0;
while($row_b_apellido_nombre=mysql_fetch_array($b_apellido_nombre)){
	$id_ninho=$row_b_apellido_nombre['id_ninho'];
	$persona="Codigo: ".$row_b_apellido_nombre['id_ninho']." ".$row_b_apellido_nombre['h_nombre1']." ".$row_b_apellido_nombre['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$ne=$ne+1;
}
}
}
}
}
?>
