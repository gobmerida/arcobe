<?php
include("../script_php/PHPExcel.php");
header("Content-Type:text/html;charset=utf-8");
$h="localhost";
$u="root";
$p="infor123456su";
$con=mysql_connect($h,$u,$p) or die (mysql_error());
mysql_select_db("cj_pv",$con) or die (mysql_error());
mysql_query("SET NAMES 'utf8'");


$today=date("d/m/Y");

function a_fecha($fecha){
	list($anio, $mes, $dia) = explode("-",$fecha);
	return $fecha = $dia."/".$mes."/".$anio;
}
function funcion04($fecha){
	$fecha = substr($fecha, 0, -9);
	list($anio, $mes, $dia) = explode("-",$fecha);
	return $fecha = $dia."/".$mes."/".$anio;
}
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Sistema de CJPV");
$objPHPExcel->getProperties()->setTitle("Sistema de CJPV");

$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle("Plan Vacacional");
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

//~ Ingreo de datos en la hojda de excel
$objPHPExcel->getActiveSheet()->SetCellValue("A1", "Numero de planilla");
$objPHPExcel->getActiveSheet()->SetCellValue("B1", "Código Niño(a)");
$objPHPExcel->getActiveSheet()->SetCellValue("C1", "Cédula Niño(a)");
$objPHPExcel->getActiveSheet()->SetCellValue("D1", "Primer Nombre Niño(a)");
$objPHPExcel->getActiveSheet()->SetCellValue("E1", "Segundo Nombre Niño(a)");
$objPHPExcel->getActiveSheet()->SetCellValue("F1", "Primer Apellido Niño(a)");
$objPHPExcel->getActiveSheet()->SetCellValue("G1", "Segundo Apellido Niño(a)");
$objPHPExcel->getActiveSheet()->SetCellValue("H1", "Fecha de Nacimiento");
$objPHPExcel->getActiveSheet()->SetCellValue("I1", "Género");
$objPHPExcel->getActiveSheet()->SetCellValue("J1", "Grupo Sanguíneo");
$objPHPExcel->getActiveSheet()->SetCellValue("K1", "Fecha de Ingreso");
$objPHPExcel->getActiveSheet()->SetCellValue("L1", "Fotos");
$objPHPExcel->getActiveSheet()->SetCellValue("M1", "Certificado");
$objPHPExcel->getActiveSheet()->SetCellValue("N1", "Habilidades");
$objPHPExcel->getActiveSheet()->SetCellValue("O1", "Gustos");
$objPHPExcel->getActiveSheet()->SetCellValue("P1", "Vacunes");
$objPHPExcel->getActiveSheet()->SetCellValue("Q1", "Alergias");
$objPHPExcel->getActiveSheet()->SetCellValue("R1", "Tratamientos");
$objPHPExcel->getActiveSheet()->SetCellValue("S1", "Alimentos Prohibidos");
$objPHPExcel->getActiveSheet()->SetCellValue("T1", "Medicamentos Prohibidos");
$objPHPExcel->getActiveSheet()->SetCellValue("U1", "Cédula (Contacto)");
$objPHPExcel->getActiveSheet()->SetCellValue("V1", "Nombre (Contacto)");
$objPHPExcel->getActiveSheet()->SetCellValue("W1", "Apellido (Contacto)");
$objPHPExcel->getActiveSheet()->SetCellValue("X1", "Teléfono (Contacto)");
$objPHPExcel->getActiveSheet()->SetCellValue("Y1", "Parentesco (Contacto)");
$objPHPExcel->getActiveSheet()->SetCellValue("Z1", "Observaciones");
$objPHPExcel->getActiveSheet()->SetCellValue("AA1", "Fecha de inscripción");
$objPHPExcel->getActiveSheet()->SetCellValue("AB1", "Edad");
$objPHPExcel->getActiveSheet()->SetCellValue("AC1", "Código (Trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("AD1", "Cédula  (Trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("AE1", "Apellidos (Trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("AF1", "Nombres (Trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("AG1", "Cargo (Trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("AH1", "Dependencia (Trabajador)");
$objPHPExcel->getActiveSheet()->SetCellValue("AI1", "Destino (Niño)");
$objPHPExcel->getActiveSheet()->SetCellValue("AJ1", "Talla de la chaqueta (Niño(a))");
$objPHPExcel->getActiveSheet()->SetCellValue("AK1", "Talla de la franela (Niño(a))");
$objPHPExcel->getActiveSheet()->SetCellValue("AL1", "Talla de la gorra (Niño(a))");
$objPHPExcel->getActiveSheet()->SetCellValue("AM1", "Talla del mono (Niño(a))");

$objPHPExcel->getActiveSheet()->setSharedStyle($estilo1, "A1:AM1");
$objPHPExcel->getActiveSheet()->getStyle("A1:AM1")->getFont()->getColor()->applyFromArray(
	array(
	'rgb' => 'FFFFFF'
	)
);
$cj_hijosSQL = "SELECT * FROM pv_planilla_ce ORDER BY pv_fechainscri";
$cj_hijosSQL = mysql_query($cj_hijosSQL);
$conta=2;
while($cj_hijos = mysql_fetch_array($cj_hijosSQL)){
$pv_planillanumero = $cj_hijos['pv_planillanumero'];
$id_ninho_pv = $cj_hijos['id_ninho_pv'];
$h_cedula = $cj_hijos['h_cedula'];
$h_nombre1 = $cj_hijos['h_nombre1'];
$h_nombre2 = $cj_hijos['h_nombre2'];
$h_apellido1 = $cj_hijos['h_apellido1'];
$h_apellido2 = $cj_hijos['h_apellido2'];
$h_fecha_naci = a_fecha($cj_hijos['h_fecha_naci']);
$h_sexo = $cj_hijos['h_sexo'];
$nombre = $cj_hijos['nombre'];
$fecha_ingreso = funcion04($cj_hijos['fecha_ingreso']);
$pv_fotos = $cj_hijos['pv_fotos'];
$pv_certificado = $cj_hijos['pv_certificado'];
$pv_habilidades = $cj_hijos['pv_habilidades'];
$pv_gustos = $cj_hijos['pv_gustos'];
$pv_vacunas = $cj_hijos['pv_vacunas'];
$pv_alergias = $cj_hijos['pv_alergias'];
$pv_tratamiento = $cj_hijos['pv_tratamiento'];
$pv_alimentosp = $cj_hijos['pv_alimentosp'];
$pv_medicamentosp = $cj_hijos['pv_medicamentosp'];
$pv_contacto_cedula = $cj_hijos['pv_contacto_cedula'];
$pv_contacto_nombre = $cj_hijos['pv_contacto_nombre'];
$pv_contacto_apellido = $cj_hijos['pv_contacto_apellido'];
$pv_contacto_telefono = $cj_hijos['pv_contacto_telefono'];
$pv_parentesco = $cj_hijos['pv_parentesco'];
$pv_observaciones = $cj_hijos['pv_observaciones'];
$pv_fechainscri = $cj_hijos['pv_fechainscri'];
$pv_edadmeses = $cj_hijos['pv_edadmeses'];
$trb_codigo = $cj_hijos['trb_codigo'];
$trb_cedula = $cj_hijos['trb_cedula'];
$trb_apellidos = $cj_hijos['trb_apellidos'];
$trb_nombres = $cj_hijos['trb_nombres'];
$trb_cargo = $cj_hijos['trb_cargo'];
$trb_dependencia = $cj_hijos['trb_dependencia'];
$pv_destino = $cj_hijos['pv_destino'];
$pv_tchaqueta = $cj_hijos['pv_tchaqueta'];
$pv_tfranela = $cj_hijos['pv_tfranela'];
$pv_tgorra = $cj_hijos['pv_tgorra'];
$pv_tmono = $cj_hijos['pv_tmono'];

$objPHPExcel->getActiveSheet()->SetCellValue("A$conta", "$pv_planillanumero");
$objPHPExcel->getActiveSheet()->SetCellValue("B$conta", "$id_ninho_pv");
$objPHPExcel->getActiveSheet()->SetCellValue("C$conta", "$h_cedula");
$objPHPExcel->getActiveSheet()->SetCellValue("D$conta", "$h_nombre1");
$objPHPExcel->getActiveSheet()->SetCellValue("E$conta", "$h_nombre2");
$objPHPExcel->getActiveSheet()->SetCellValue("F$conta", "$h_apellido1");
$objPHPExcel->getActiveSheet()->SetCellValue("G$conta", "$h_apellido2");
$objPHPExcel->getActiveSheet()->SetCellValue("H$conta", "$h_fecha_naci");
$objPHPExcel->getActiveSheet()->SetCellValue("I$conta", "$h_sexo");
$objPHPExcel->getActiveSheet()->SetCellValue("J$conta", "$nombre");
$objPHPExcel->getActiveSheet()->SetCellValue("K$conta", "$fecha_ingreso");
$objPHPExcel->getActiveSheet()->SetCellValue("L$conta", "$pv_fotos");
$objPHPExcel->getActiveSheet()->SetCellValue("M$conta", "$pv_certificado");
$objPHPExcel->getActiveSheet()->SetCellValue("N$conta", "$pv_habilidades");
$objPHPExcel->getActiveSheet()->SetCellValue("O$conta", "$pv_gustos");
$objPHPExcel->getActiveSheet()->SetCellValue("P$conta", "$pv_vacunas");
$objPHPExcel->getActiveSheet()->SetCellValue("Q$conta", "$pv_alergias");
$objPHPExcel->getActiveSheet()->SetCellValue("R$conta", "$pv_tratamiento");
$objPHPExcel->getActiveSheet()->SetCellValue("S$conta", "$pv_alimentosp");
$objPHPExcel->getActiveSheet()->SetCellValue("T$conta", "$pv_medicamentosp");
$objPHPExcel->getActiveSheet()->SetCellValue("U$conta", "$pv_contacto_cedula");
$objPHPExcel->getActiveSheet()->SetCellValue("V$conta", "$pv_contacto_nombre");
$objPHPExcel->getActiveSheet()->SetCellValue("W$conta", "$pv_contacto_apellido");
$objPHPExcel->getActiveSheet()->SetCellValue("X$conta", "$pv_contacto_telefono");
$objPHPExcel->getActiveSheet()->SetCellValue("Y$conta", "$pv_parentesco");
$objPHPExcel->getActiveSheet()->SetCellValue("Z$conta", "$pv_observaciones");
$objPHPExcel->getActiveSheet()->SetCellValue("AA$conta", "$pv_fechainscri");
$objPHPExcel->getActiveSheet()->SetCellValue("AB$conta", "$pv_edadmeses");
$objPHPExcel->getActiveSheet()->SetCellValue("AC$conta", "$trb_codigo");
$objPHPExcel->getActiveSheet()->SetCellValue("AD$conta", "$trb_cedula");
$objPHPExcel->getActiveSheet()->SetCellValue("AE$conta", "$trb_apellidos");
$objPHPExcel->getActiveSheet()->SetCellValue("AF$conta", "$trb_nombres");
$objPHPExcel->getActiveSheet()->SetCellValue("AG$conta", "$trb_cargo");
$objPHPExcel->getActiveSheet()->SetCellValue("AH$conta", "$trb_dependencia");
$objPHPExcel->getActiveSheet()->SetCellValue("AI$conta", "$pv_destino");
$objPHPExcel->getActiveSheet()->SetCellValue("AJ$conta", "$pv_tchaqueta");
$objPHPExcel->getActiveSheet()->SetCellValue("AK$conta", "$pv_tfranela");
$objPHPExcel->getActiveSheet()->SetCellValue("AL$conta", "$pv_tgorra");
$objPHPExcel->getActiveSheet()->SetCellValue("AM$conta", "$pv_tmono");


$conta++;
}

foreach (range('A', 'Z') as $columnID) {
$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}
foreach (range('AA', 'ZZ') as $columnID) {
$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="PlanVacacional (Globales).xlsx"');
$objWriter->save('php://output');
?>
