<?php  
	include("../../connect/conexion.php");
	if (array_key_exists("submit", $_POST)) {
		
		extract($_POST);

		$sql  = "INSERT INTO `pv_trabajadores_ce`(`trb_codigo`, `trb_cedula`, `trb_apellidos`, `trb_nombres`, `trb_cargo`, `trb_dependencia`) VALUES ('$cod','$ci','$ape','$nom','$carg','$depe')";
		$query = mysql_query($sql);
		echo "trabajador ingresado";
	}else{
		echo "no registraado";
	}


?>