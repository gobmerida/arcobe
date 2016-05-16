<?php
include("../script_php/PHPExcel.php");
header("Content-Type:text/html;charset=utf-8");
$conexion=mysql_connect("127.0.0.1", "root","12345678956") or die ("No se puede conectar");
mysql_query("SET NAMES 'utf8'");
mysql_select_db("cj_pv");

$today=date("d/m/Y");

function tipo_n($tipo_c){
	list($tipo_de_nomina, $codigo_nomina) = explode("-",$tipo_c);
	if($tipo_de_nomina=='CO' or $tipo_de_nomina=='COC'){
		$nom_tip="CONTRATADO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='EM' or $tipo_de_nomina=='EC' or $tipo_de_nomina=='EF' or $tipo_de_nomina=='PO' or $tipo_de_nomina=='BO'){
		$nom_tip="FIJO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='BE'){
		$nom_tip="CONTRATADO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='OS' or $tipo_de_nomina=='OF' or $tipo_de_nomina=='OB' or $tipo_de_nomina=='OP' or $tipo_de_nomina=='OO'){
		$nom_tip="FIJO";
		return $nom_tip;
	}
}
function condi_n($tipo_c){
	list($tipo_de_nomina, $codigo_nomina) = explode("-",$tipo_c);
	if($tipo_de_nomina=='CO' or $tipo_de_nomina=='COC' or $tipo_de_nomina=='EM' or $tipo_de_nomina=='EC' or $tipo_de_nomina=='EF' or $tipo_de_nomina=='PO' or $tipo_de_nomina=='BO'){
		$nom_con="EMPLEADO";
		return $nom_con;
	}
	if($tipo_de_nomina=='BE' or $tipo_de_nomina=='OS' or $tipo_de_nomina=='OF' or $tipo_de_nomina=='OB' or $tipo_de_nomina=='OP' or $tipo_de_nomina=='OO'){
		$nom_con="OBRERO";
		return $nom_con;
	}
}


$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Sistema de CJPV");
$objPHPExcel->getProperties()->setTitle("Reporte de Cesta Juguete");

$estilo1 = new PHPExcel_Style();
$estilo1->applyFromArray(
  array('fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => '800000')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));

$estilo2 = new PHPExcel_Style();
$estilo2->applyFromArray(
  array('fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'DCDCDC')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));
$estilo3 = new PHPExcel_Style();
$estilo3->applyFromArray(
  array('fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'F5F5DC')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));
$estilo4 = new PHPExcel_Style();
$estilo4->applyFromArray(
  array('fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'EEE8AA')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));
$estilo5 = new PHPExcel_Style();
$estilo5->applyFromArray(
  array('fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'FFDAB9')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    )
));


$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Cesta Jueguete");
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//~ Ingreo de datos en la hojda de excel

$objPHPExcel->getActiveSheet()->SetCellValue("A1", "Reporte Cesta Juguete");
$objPHPExcel->getActiveSheet()->mergeCells("A1:AA1");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo1, "A1");
$objPHPExcel->getActiveSheet()->SetCellValue("A2", "Niños");
$objPHPExcel->getActiveSheet()->mergeCells("A2:C2");
$objPHPExcel->getActiveSheet()->SetCellValue("D2", "Trabajador que registra (Padre o Madre)");
$objPHPExcel->getActiveSheet()->mergeCells("D2:K2");
$objPHPExcel->getActiveSheet()->SetCellValue("L2", "Padre o Madre (Trabajador)");
$objPHPExcel->getActiveSheet()->mergeCells("L2:S2");
$objPHPExcel->getActiveSheet()->SetCellValue("T2", "Representante legal (trabajador)");
$objPHPExcel->getActiveSheet()->mergeCells("T2:AA2");

$objPHPExcel->getActiveSheet()->setSharedStyle($estilo2, "A2");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo3, "D2");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo4, "L2");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo5, "T2");

$objPHPExcel->getActiveSheet()->SetCellValue("A3", "C.I.");
$objPHPExcel->getActiveSheet()->SetCellValue("B3", "Nombres");
$objPHPExcel->getActiveSheet()->SetCellValue("C3", "Apellidos");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo2, "A3:C3");

$objPHPExcel->getActiveSheet()->SetCellValue("D3", "Código del trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("E3", "Cédula Trabajador");
$objPHPExcel->getActiveSheet()->SetCellValue("F3", "Nombres");
$objPHPExcel->getActiveSheet()->SetCellValue("G3", "Apellidos");
$objPHPExcel->getActiveSheet()->SetCellValue("H3", "Cargo");
$objPHPExcel->getActiveSheet()->SetCellValue("I3", "Dependencia");
$objPHPExcel->getActiveSheet()->SetCellValue("J3", "Tipo de Nomina");
$objPHPExcel->getActiveSheet()->SetCellValue("k3", "Condición");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo3, "D3:K3");

$objPHPExcel->getActiveSheet()->SetCellValue("L3", "Código del trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("M3", "Cédula Trabajador");
$objPHPExcel->getActiveSheet()->SetCellValue("N3", "Nombres");
$objPHPExcel->getActiveSheet()->SetCellValue("O3", "Apellidos");
$objPHPExcel->getActiveSheet()->SetCellValue("P3", "Cargo");
$objPHPExcel->getActiveSheet()->SetCellValue("Q3", "Dependencia");
$objPHPExcel->getActiveSheet()->SetCellValue("R3", "Tipo de Nomina");
$objPHPExcel->getActiveSheet()->SetCellValue("S3", "Condición");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo4, "L3:S3");

$objPHPExcel->getActiveSheet()->SetCellValue("T3", "Código del trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("U3", "Cédula Trabajador");
$objPHPExcel->getActiveSheet()->SetCellValue("V3", "Nombres");
$objPHPExcel->getActiveSheet()->SetCellValue("W3", "Apellidos");
$objPHPExcel->getActiveSheet()->SetCellValue("X3", "Cargo");
$objPHPExcel->getActiveSheet()->SetCellValue("Y3", "Dependencia");
$objPHPExcel->getActiveSheet()->SetCellValue("Z3", "Tipo de Nomina");
$objPHPExcel->getActiveSheet()->SetCellValue("AA3", "Condición");
$objPHPExcel->getActiveSheet()->setSharedStyle($estilo5, "T3:AA3");

$cj_hijosq = "SELECT * FROM cj_hijos";
$cj_hijosq = mysql_query($cj_hijosq) or die (mysql_error());

$child=4;
while($cj_hijos = mysql_fetch_array($cj_hijosq)){
	$ced_hijo = $cj_hijos['h_cedula'];
	$nom_hijo = $cj_hijos['h_nombre1'];
	$nom_hijo2 = $cj_hijos['h_nombre2'];
	$apellido1 = $cj_hijos['h_apellido1'];
	$apellido2 = $cj_hijos['h_apellido2'];
	$cedula_mp = $cj_hijos['cedula_mp'];
	$cedula_pm = $cj_hijos['cedula_pm'];
	$cedula_repr = $cj_hijos['cedula_repr'];
	$objPHPExcel->getActiveSheet()->SetCellValue("A$child", "$ced_hijo");
	$objPHPExcel->getActiveSheet()->SetCellValue("B$child", "$nom_hijo $nom_hijo2");
	$objPHPExcel->getActiveSheet()->SetCellValue("C$child", "$apellido1 $apellido2");
	$objPHPExcel->getActiveSheet()->setSharedStyle($estilo2, "A$child:C$child");
	
	//~ Comprobar al padre o madre que registra
	$t_mpq = "SELECT * FROM cj_trabajadores WHERE trb_cedula='$cedula_mp'";
	$t_mpq = mysql_query($t_mpq) or die (mysql_error());
	$t_mp = mysql_fetch_array($t_mpq);
	$trb_codigo = $t_mp['trb_codigo'];
	$cedula_tmp = $t_mp['trb_cedula'];
	$trb_nombres = $t_mp['trb_nombres'];
	$trb_apellidos = $t_mp['trb_apellidos'];
	$trb_cargo = $t_mp['trb_cargo'];
	$trb_dependencia = $t_mp['trb_dependencia'];
	
	if($t_mp['trb_codigo']!=""){
		$t_no = tipo_n($trb_codigo);
		$c_no = condi_n($trb_codigo);
	}
	$objPHPExcel->getActiveSheet()->SetCellValue("D$child", "$trb_codigo");
	if($cedula_tmp!=""){
	$objPHPExcel->getActiveSheet()->SetCellValue("E$child", "C.I. $cedula_tmp");
	}
	$objPHPExcel->getActiveSheet()->SetCellValue("F$child", "$trb_nombres");
	$objPHPExcel->getActiveSheet()->SetCellValue("G$child", "$trb_apellidos");
	$objPHPExcel->getActiveSheet()->SetCellValue("H$child", "$trb_cargo");
	$objPHPExcel->getActiveSheet()->SetCellValue("I$child", "$trb_dependencia");
	if($t_mp['trb_codigo']!=""){
	$objPHPExcel->getActiveSheet()->SetCellValue("J$child", "$c_no");
	$objPHPExcel->getActiveSheet()->SetCellValue("K$child", "$t_no");
	}
	$objPHPExcel->getActiveSheet()->setSharedStyle($estilo3, "D$child:K$child");
	
	//~ Comprobar padre o madre si es trabajador
	$t_pmq = "SELECT * FROM cj_trabajadores WHERE trb_cedula='$cedula_pm'";
	$t_pmq = mysql_query($t_pmq) or die (mysql_error());
	$t_pm = mysql_fetch_array($t_pmq);
	$trb_codigom = $t_pm['trb_codigo'];
	$cedula_tpm = $t_pm['trb_cedula'];
	$trb_nombresm = $t_pm['trb_nombres'];
	$trb_apellidosm = $t_pm['trb_apellidos'];
	$trb_cargopm = $t_pm['trb_cargo'];
	$trb_dependenciapm = $t_pm['trb_dependencia'];
	
	if($t_pm['trb_codigo']!=""){
		$t_nopm = tipo_n($trb_codigom);
		$c_nopm = condi_n($trb_codigom);
	}
	
	$objPHPExcel->getActiveSheet()->SetCellValue("L$child", "$trb_codigom");
	if($cedula_tpm!=""){
	$objPHPExcel->getActiveSheet()->SetCellValue("M$child", "C.I. $cedula_tpm");
	}
	$objPHPExcel->getActiveSheet()->SetCellValue("N$child", "$trb_nombresm");
	$objPHPExcel->getActiveSheet()->SetCellValue("O$child", "$trb_apellidosm");
	$objPHPExcel->getActiveSheet()->SetCellValue("P$child", "$trb_cargopm");
	$objPHPExcel->getActiveSheet()->SetCellValue("Q$child", "$trb_dependenciapm");
	if($t_pm['trb_codigo']!=""){
	$objPHPExcel->getActiveSheet()->SetCellValue("R$child", "$c_nopm");
	$objPHPExcel->getActiveSheet()->SetCellValue("S$child", "$t_nopm");
	}
	$objPHPExcel->getActiveSheet()->setSharedStyle($estilo4, "L$child:S$child");
	
	//~ Comprobar representante legal
	$t_repq = "SELECT * FROM cj_trabajadores WHERE trb_cedula='$cedula_repr'";
	$t_repq = mysql_query($t_repq) or die (mysql_error());
	$t_rep = mysql_fetch_array($t_repq);
	$trb_codigorep = $t_rep['trb_codigo'];
	$cedula_trep = $t_rep['trb_cedula'];
	$trb_nombresrep = $t_rep['trb_nombres'];
	$trb_apellidosrep = $t_rep['trb_apellidos'];
	$trb_cargorpr = $t_rep['trb_cargo'];
	$trb_dependenciarpr = $t_rep['trb_dependencia'];
	
	if($t_rep['trb_codigo']!=""){
		$t_norep = tipo_n($trb_codigorep);
		$c_norep = condi_n($trb_codigorep);
	}
	
	$objPHPExcel->getActiveSheet()->SetCellValue("T$child", "$trb_codigorep");
	if($cedula_trep!=""){
	$objPHPExcel->getActiveSheet()->SetCellValue("U$child", "C.I. $cedula_trep");
	}
	$objPHPExcel->getActiveSheet()->SetCellValue("V$child", "$trb_nombresrep");
	$objPHPExcel->getActiveSheet()->SetCellValue("W$child", "$trb_apellidosrep");
	$objPHPExcel->getActiveSheet()->SetCellValue("X$child", "$trb_cargorpr");
	$objPHPExcel->getActiveSheet()->SetCellValue("Y$child", "$trb_dependenciarpr");
	if($t_rep['trb_codigo']!=""){
	$objPHPExcel->getActiveSheet()->SetCellValue("Z$child", "$c_norep");
	$objPHPExcel->getActiveSheet()->SetCellValue("AA$child", "$t_norep");
	}
	$objPHPExcel->getActiveSheet()->setSharedStyle($estilo5, "T$child:AA$child");
	
	$child=$child+1;
}

$objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->getColor()->applyFromArray(
	array(
	'rgb' => 'FFFFFF'
	)
);

foreach (range('A', 'Z') as $columnID) {
$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}
foreach (range('AA', 'ZZ') as $columnID) {
$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Reporte_de_Cesta_Juguete.xlsx"');
$objWriter->save('php://output');
?>
