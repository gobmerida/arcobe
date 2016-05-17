<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
$conexion=mysql_connect("localhost","root","infor123456su") or die (mysql_error());
mysql_select_db("cj_pv",$conexion) or die (mysql_error());

$search = $_POST['nombre1'];
$query_services = mysql_query("SELECT nombre FROM cj_nombres WHERE nombre like '" . $search . "%' ORDER BY nombre ASC", $conexion);
while($row_services=mysql_fetch_array($query_services)){
	$nombre=$row_services['nombre'];
	echo "<div class='suggest-element'><a data='$nombre' id='$nombre'>$nombre</a></div>";
}
?>
