 <?php
 	include("connect/conexion.php");
//selecciono los trabajadores de la tabla nueva que no estan en la tabla antigua
	$sql="SELECT * FROM cj_trabajadores_aux WHERE NOT EXISTS (SELECT * FROM cj_trabajadores WHERE cj_trabajadores_aux.trb_cedula= cj_trabajadores.trb_cedula)";
	$rs=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_array($rs)){
		//inserto el resultado anterior en la tabla nueva
		$sql2="INSERT INTO cj_trabajadores VALUES('".$row["trb_codigo"]."', '".$row["trb_cedula"]."', '".$row["trb_apellidos"]."', '".$row["trb_nombres"]."', '".$row["trb_cargo"]."', '".$row["trb_dependencia"]."', '".$row["trb_telefono"]."', '".$row["trb_direccionh"]."', '".$row["trb_correo"]."', '".$row["activo"]."')";
		$rs2=mysql_query($sql2) or die(mysql_error());
	}
	//selecciono los trabajadores de la tabla antigua que no estan en la tabla nueva
	$sql3="SELECT * FROM cj_trabajadores WHERE NOT EXISTS (SELECT * FROM cj_trabajadores_aux WHERE cj_trabajadores.trb_cedula= cj_trabajadores_aux.trb_cedula)";
	$rs3=mysql_query($sql3) or die(mysql_error());
	while($row3=mysql_fetch_array($rs3)) {
		//actualizo la condicion de activo a los trabajadores que no estan en la trabla nueva
		$sql4="UPDATE cj_trabajadores SET activo= '0' WHERE trb_cedula='".$row3["trb_cedula"]."'";
		$rs4= mysql_query($sql4) or die(mysql_error());
	}
?>