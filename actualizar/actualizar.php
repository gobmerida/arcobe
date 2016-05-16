<?php
include("../connect/conexion.php");
$archivo = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$destino = $archivo;
if (copy($_FILES['excel']['tmp_name'],$destino)) echo "Archivo Cargado Con Exito<br>";
else echo "Error Al Cargar el Archivo";

if($archivo!=""){ 
include('../Classes/PHPExcel.php');
include('../Classes/PHPExcel/Reader/Excel2007.php');

$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load($archivo);
$objFecha = new PHPExcel_Shared_Date();
$objPHPExcel->setActiveSheetIndex(0);

$i=2;
$co=1;
$cah=0;
$stop=$objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
while ($stop!=""){
	$trb_codigo = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
	$trb_cedula = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
	$trb_apellidos = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
	$trb_nombres = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
	$trb_cargo = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
	$trb_dependencia = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
	$buscarSQL = mysql_query("SELECT trb_cedula FROM cj_trabajadores WHERE trb_cedula='$trb_cedula'");
	$buscarROW = mysql_fetch_array($buscarSQL);
	if($trb_cedula==$buscarROW['trb_cedula']){
	$sql = "UPDATE cj_trabajadores
			SET trb_codigo='$trb_codigo',
			    trb_apellidos='$trb_apellidos',
			    trb_nombres='$trb_nombres',
			    trb_cargo='$trb_cargo',
			    trb_dependencia='$trb_dependencia',
			    activo='1'
			    WHERE trb_cedula='$trb_cedula'
			    ";
	mysql_query($sql,$con) or die (mysql_error());
	}
	if($trb_cedula!=$buscarROW['trb_cedula']){
		$insertSQL = "INSERT INTO cj_trabajadores(trb_codigo, trb_cedula, trb_apellidos, trb_nombres, trb_cargo, trb_dependencia, activo)
								  VALUES ('$trb_codigo','$trb_cedula','$trb_apellidos','$trb_nombres','$trb_cargo','$trb_dependencia','1')";
		$insertSQL = mysql_query($insertSQL) or die (mysql_error());
		$cah++;
	}
	$is=$i+1;
	$stop=$objPHPExcel->getActiveSheet()->getCell('A'.$is)->getCalculatedValue();
	$i=$i+1;
	$co=$co+1;
}
header("location:index.php?accion=1&&num=$cah");
}

?>

