<?php  
	include("../../connect/conexion.php");
	if (array_key_exists("submit", $_POST)) {
		
		extract($_POST);

		echo $sql  = "INSERT INTO `pv_trabajadores_ce`(`cod_trab`, `ci_trab`, `nombre_trab`, `apellido_trab`, `cargo`, `dependeencia`) VALUES ('$cod','$ci','$ape','$nom','$carg','$depe')";
		$query = mysql_query($sql);
	}else{
		echo "no registraado";
	}


?>