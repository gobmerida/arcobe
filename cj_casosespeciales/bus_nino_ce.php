<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
$conexion=mysql_connect("localhost","root","infor123456su") or die (mysql_error());
mysql_select_db("cj_pv",$conexion) or die (mysql_error());

$search = $_POST['codigo'];
$query_services = mysql_query("SELECT * FROM cj_hijos_ce WHERE id_ninho like '" . $search . "%' ORDER BY id_ninho DESC", $conexion);
while($row_services=mysql_fetch_array($query_services)){
	$id_ninho=$row_services['id_ninho'];
	$persona="Codigo: ".$row_services['id_ninho']." ".$row_services['h_nombre1']." ".$row_services['h_apellido1'];
	echo "<div class='suggest-element'><a href='nino_ce.php?nino=$id_ninho' style='text-decoration:none'>$persona</a></div>";
}
?>
