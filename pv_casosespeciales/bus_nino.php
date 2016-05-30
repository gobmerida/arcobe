<?php
include("../connect/conexion.php");

$search = $_POST['codigo'];
$query_services = mysql_query("SELECT * FROM pv_inscrip_ce I inner join pv_hijos_ce H on I.id_ninho_pv=H.id_ninho WHERE I.id_ninho_pv like '" . $search . "%' ORDER BY id_ninho_pv DESC", $con);
$co=0;
while($row_services=mysql_fetch_array($query_services)){
	$id_ninho=$row_services['id_ninho_pv'];
	$persona="Codigo: ".$row_services['id_ninho_pv']." ".$row_services['h_nombre1']." ".$row_services['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$co=$co+1;
}
if($co==0){
$b_nombre = mysql_query("SELECT * FROM pv_inscrip_ce I inner join pv_hijos_ce H on I.id_ninho_pv=H.id_ninho WHERE H.h_nombre1 like '" . $search . "%' ORDER BY id_ninho_pv DESC", $con);
$nu=0;
while($row_b_nombre=mysql_fetch_array($b_nombre)){
	$id_ninho=$row_b_nombre['id_ninho_pv'];
	$persona="Codigo: ".$row_b_nombre['id_ninho']." ".$row_b_nombre['h_nombre1']." ".$row_b_nombre['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$nu=$nu+1;
}
if($nu==0){
$b_apellido = mysql_query("SELECT * FROM pv_inscrip_ce I inner join pv_hijos_ce H on I.id_ninho_pv=H.id_ninho WHERE H.h_apellido1 like '" . $search . "%' ORDER BY id_ninho_pv DESC", $con);
$ni=0;
while($row_b_apellido=mysql_fetch_array($b_apellido)){
	$id_ninho=$row_b_apellido['id_ninho_pv'];
	$persona="Codigo: ".$row_b_apellido['id_ninho']." ".$row_b_apellido['h_nombre1']." ".$row_b_apellido['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$ni=$ni+1;
}
if($ni==0){
$b_apellido_nombre = mysql_query("SELECT * FROM pv_inscrip_ce WHERE CONCAT(h_nombre1,' ',h_apellido1) like '" . $search . "%' ORDER BY id_nino DESC", $con) or die('');
$ne=0;
while($row_b_apellido_nombre=mysql_fetch_array($b_apellido_nombre)){
	$id_ninho=$row_b_apellido_nombre['id_nino'];
	$persona="Codigo: ".$row_b_apellido_nombre['id_nino']." ".$row_b_apellido_nombre['h_nombre1']." ".$row_b_apellido_nombre['h_apellido1'];
	echo "<div class='suggest-element'><a data='$id_ninho' id='$id_ninho'>$persona</a></div>";
	$ne=$ne+1;
}
}
}
}
?>
