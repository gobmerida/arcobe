<?php
header( 'Content-type: text/html; charset=iso-8859-1' );
$conexion=mysql_connect("localhost","root","infor123456su") or die (mysql_error());
mysql_select_db("cj_pv",$conexion) or die (mysql_error());

$search = $_POST['nombre2'];
$query_services = mysql_query("SELECT nombre FROM cj_nombres WHERE nombre like '" . $search . "%' ORDER BY nombre ASC", $conexion);
while($row_services=mysql_fetch_array($query_services)){
	$nombre2=$row_services['nombre'];
	echo "<div class='suggest-element2'><a data='$nombre2' id='$nombre2'>$nombre2</a></div>";
}
?>
