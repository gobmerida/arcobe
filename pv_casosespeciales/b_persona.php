<?php
include("../connect/conexion.php");

$search = $_POST['cedula'];
if($search!=""){
$query_services = mysql_query("SELECT * FROM pv_trabajadores_ce WHERE trb_cedula like '" . $search . "%' ORDER BY mpr_cedula DESC", $con);
while($row_services=mysql_fetch_array($query_services)){
	$cedula=$row_services['mpr_cedula'];
	$persona="V.- ".$row_services['mpr_cedula']." ".$row_services['mpr_nombres']." ".$row_services['mpr_apellidos'];
	echo "<div class='suggest-element'><a data='$cedula' id='$cedula'>$persona</a></div>";
}
}
if($search==""){
	echo "<br><br><center><span style='color:red'><i><b>¡Introduzca la Cédula!</b></i></span></center>";
}
?>
