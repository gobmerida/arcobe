<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
include("../connect/conexion.php");
mysql_select_db("cj_pv") or die (mysql_error());

$search = $_POST['cedula'];
$query_services = mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula like '" . $search . "%' ORDER BY trb_cedula DESC");
while($row_services=mysql_fetch_array($query_services)){
	$cedula=$row_services['trb_cedula'];
	$persona="V.- ".$row_services['trb_cedula']." ".$row_services['trb_nombres']." ".$row_services['trb_apellidos'];
	echo "<div class='suggest-element'><a data='$cedula' id='$cedula'>$persona</a></div>";
}
?>
