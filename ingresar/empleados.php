<?php
include("../connect/conexion.php");

$search = $_POST['mp'];
$query_services = mysql_query("SELECT * FROM cj_trabajadores WHERE activo='1' and trb_cedula like '" . $search . "%' ORDER BY trb_cedula DESC");
while($row_services=mysql_fetch_array($query_services)){
	$cedula=$row_services['trb_cedula'];
	$persona=$row_services['trb_cedula']." ".$row_services['trb_nombres']." ".$row_services['trb_apellidos'];
	echo "<div class='suggest-element'><a data='$cedula' id='$cedula'>$persona</a></div>";
}
?>
