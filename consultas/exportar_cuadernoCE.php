<?php
include("../script_php/PHPExcel.php");
date_default_timezone_set('UTC');
header("Content-Type:text/html;charset=utf-8");
$h="localhost";
$u="root";
$p="infor1234";
$con=mysql_connect($h,$u,$p) or die (mysql_error());
mysql_select_db("cj_pv",$con) or die (mysql_error());
mysql_query("SET NAMES 'utf8'");

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Cuaderno Cesta Juguete");
$objPHPExcel->getProperties()->setTitle("Cuaderno Cesta Juguete");

$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Cuaderno Cesta Juguete");
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LETTER);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

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
    )
));

$objPHPExcel->getActiveSheet()->SetCellValue("A1", "Posición Página");
$objPHPExcel->getActiveSheet()->SetCellValue("B1", "Posición Línea");
$objPHPExcel->getActiveSheet()->SetCellValue("C1", "Código de Trabajador");
$objPHPExcel->getActiveSheet()->SetCellValue("D1", "Cédula");
$objPHPExcel->getActiveSheet()->SetCellValue("E1", "Nombre y Apellido");
$objPHPExcel->getActiveSheet()->SetCellValue("F1", "Beneficiarios");

$objPHPExcel->getActiveSheet()->setSharedStyle($estilo1, "A1:AM1");
$objPHPExcel->getActiveSheet()->getStyle("A1:AM1")->getFont()->getColor()->applyFromArray(
	array(
	'rgb' => 'FFFFFF'
	)
);

$data01 = $_GET["periodo"];
$DataSQL00 = "select *
			  from pv_cuaderno_ce
			  join pv_trabajadores_ce
			  on pv_cuaderno_ce.ced_tbr=pv_trabajadores_ce.trb_cedula
			  where  Periodo='$data01' order by pv_cuaderno_ce.Nlinea";
$DataSQL00 = mysql_query($DataSQL00);

$i=0;
$conta=2;
$KidsNumberTotal=0;
while( $DataROW00 = mysql_fetch_array($DataSQL00) ){
	$DataSQL01 = "select pv_hijos_ce.*
				  from pv_hijos_ce
				  join pv_inscrip_ce
				  on pv_hijos_ce.id_ninho = pv_inscrip_ce.id_ninho_pv
				  where pv_inscrip_ce.id_periodo='$data01' and pv_inscrip_ce.id_mp='$DataROW00[trb_cedula]' ";
	$DataSQL01 = mysql_query($DataSQL01);
	$KidsNumber=0;
	
	while($DataROW01 = mysql_fetch_array($DataSQL01)){
		$KidsNumber++;
		$KidsNumberTotal++;
	}
	$objPHPExcel->getActiveSheet()->SetCellValue("A$conta", "$DataROW00[Npagina]");
	$objPHPExcel->getActiveSheet()->SetCellValue("B$conta", "$DataROW00[Nlinea]");
	$objPHPExcel->getActiveSheet()->SetCellValue("C$conta", "$DataROW00[trb_codigo]");
	$objPHPExcel->getActiveSheet()->SetCellValue("D$conta", "$DataROW00[trb_cedula]");
	$objPHPExcel->getActiveSheet()->SetCellValue("E$conta", "$DataROW00[trb_apellidos] $DataROW00[trb_nombres]");
	$objPHPExcel->getActiveSheet()->SetCellValue("F$conta", "$KidsNumber");
	$conta++;
	$i++;
}
foreach (range('A', 'F') as $columnID) {
$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="CuadernoPlanVacacional(c/e).xls"');
$objWriter->save('php://output');
?>
