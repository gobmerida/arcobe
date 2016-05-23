<?php
include("../connect/conexion.php");

$search = $_POST['mp'];
$query_services = mysql_query("SELECT * FROM pv_trabajadores_ce WHERE ci_trab like '" . $search . "%' ORDER BY ci_trab DESC");
while($row_services=mysql_fetch_array($query_services)){
	$cedula=$row_services['ci_trab'];
	$persona=$row_services['ci_trab']." ".$row_services['nomre_trab']." ".$row_services['apellido_trab'];
	echo "<div class='suggest-element'><a data='$cedula' id='$cedula'>$persona</a></div>";
}
?>
