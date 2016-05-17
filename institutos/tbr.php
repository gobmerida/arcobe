<?php
include("../connect/conexion.php");

$search = $_POST['cedula'];
$query_services = mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula like '" . $search . "%' and trb_cedula!='' ORDER BY trb_cedula DESC");
while($row_services=mysql_fetch_array($query_services)){
	$cedula=$row_services['trb_cedula'];
	$persona="V.- ".$row_services['trb_cedula']." ".$row_services['trb_nombres']." ".$row_services['trb_apellidos'];
	echo "<div class='suggest-element'><a data='$cedula' id='$cedula'>$persona</a></div>";
}
?>
