<!--
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php
date_default_timezone_set('UTC');
include("../../connect/conexion.php");
// Consulta del periodo actual
$anio_actual = date("Y");
$periodo_c 	= "SELECT * FROM pv_periodo_ce WHERE pv_añoperiodo='$anio_actual'";
$periodo_c 	= mysql_query($periodo_c);
$periodo   	= mysql_fetch_array($periodo_c);
$idpv      	= $periodo['id_pvperiodo'];
// Fin de la consulta

// Función para generar número de planilla
$pv_contador = $periodo['pv_contador'];
$pv_contador = $pv_contador+1;
$pv_añoperiodo = $periodo['pv_añoperiodo'];
$pv_planillanumero = $pv_añoperiodo."-".$pv_contador;

$update_contador = "UPDATE pv_periodo_ce SET pv_contador='$pv_contador' WHERE pv_añoperiodo='$anio_actual'";
mysql_query($update_contador);
//

// Carga de datos para el ingreso al plan vacacional
$id_periodo = $periodo['id_pvperiodo'];
$id_ninho_pv = $_POST['id_ninho_pv'];

if(array_key_exists('h_gsanguineo',$_POST)){
$id_ninho = $_POST['id_ninho_pv'];
$h_gsanguineo = $_POST['h_gsanguineo'];
mysql_query("UPDATE pv_hijos_ce SET Gsanguineo='$h_gsanguineo' WHERE id_nino='$id_ninho'");
}

$id_mp = $_POST['id_mp'];
$ctrb_sql = "SELECT trb_codigo FROM pv_trabajadores_ce WHERE trb_cedula='$id_mp'";
$ctrb_sql = mysql_query($ctrb_sql) or die ("No se halló el código");
$ctrb = mysql_fetch_array($ctrb_sql);
$c_trb = $ctrb['trb_codigo'];
$pv_destino = $_POST['pv_destino'];
$pv_fotos="";
if(array_key_exists('pv_fotos',$_POST)){
$pv_fotos = $_POST['pv_fotos'];
}
$pv_certificado="";
if(array_key_exists('pv_certificado',$_POST)){
$pv_certificado = $_POST['pv_certificado'];
}
$pv_habilidades = $_POST['pv_habilidades'];
$pv_gustos = $_POST['pv_gustos'];
$pv_vacunas = $_POST['pv_vacunas'];
$pv_alergias = $_POST['pv_alergias'];
$pv_tratamiento = $_POST['pv_tratamiento'];
$pv_alimentosp = $_POST['pv_alimentosp'];
$pv_medicamentosp = $_POST['pv_medicamentosp'];
$pv_tchaqueta = $_POST['pv_tchaqueta'];
$pv_tfranela = $_POST['pv_tfranela'];
$pv_tmono = $_POST['pv_tmono'];
$pv_tgorra = $_POST['pv_tgorra'];
$pv_contacto_cedula = $_POST['pv_contacto_cedula'];
$pv_contacto_nombre = $_POST['pv_contacto_nombre'];
$pv_contacto_apellido = $_POST['pv_contacto_apellido'];
$pv_contacto_telefono = $_POST['pv_contacto_telefono'];
$pv_contacto_parentesco = $_POST['pv_contacto_parentesco'];
$pv_observaciones = $_POST['pv_observaciones'];
$pv_edadmeses = $_POST['pv_edadmeses'];

if(array_key_exists('h_gsanguineo',$_POST)){
	$h_gsanguineo = $_POST['h_gsanguineo'];
}
mysql_query("INSERT INTO pv_inscrip_ce(
id_periodo,
pv_planillanumero,
id_ninho_pv,
id_mp,
pv_destino,
pv_fotos,
pv_certificado,
pv_habilidades,
pv_gustos,
pv_vacunas,
pv_alergias,
pv_tratamiento,
pv_alimentosp,
pv_medicamentosp,
pv_tchaqueta,
pv_tfranela,
pv_tmono,
pv_tgorra,
pv_contacto_cedula,
pv_contacto_nombre,
pv_contacto_apellido,
pv_contacto_telefono,
pv_contacto_parentesco,
pv_observaciones,
pv_edadmeses,
codigo_trb
)

value(
'$id_periodo',
'$pv_planillanumero',
'$id_ninho_pv',
'$id_mp',
'$pv_destino',
'$pv_fotos',
'$pv_certificado',
'$pv_habilidades',
'$pv_gustos',
'$pv_vacunas',
'$pv_alergias',
'$pv_tratamiento',
'$pv_alimentosp',
'$pv_medicamentosp',
'$pv_tchaqueta',
'$pv_tfranela',
'$pv_tmono',
'$pv_tgorra',
'$pv_contacto_cedula',
'$pv_contacto_nombre',
'$pv_contacto_apellido',
'$pv_contacto_telefono',
'$pv_contacto_parentesco',
'$pv_observaciones',
'$pv_edadmeses',
'$c_trb'
)"
) or die ("Error: ".mysql_error());

$DataQuery01 = "select * from pv_cuaderno_ce where ced_tbr='$id_mp'";
$DataQuery01 = mysql_query($DataQuery01);
$DataROW01 = mysql_fetch_array($DataQuery01);

if($DataROW01["ced_tbr"]==""){
	$DataQuery02 = "select * from pv_periodo_ce where id='$id_periodo'";
	$DataQuery02 = mysql_query($DataQuery02);
	$DataROW02 = mysql_fetch_array($DataQuery02);
	$aux01 = $DataROW02["contador_per"];
	$aux02 = $DataROW02["Aux"];
	$aux03 = $DataROW02["ContadorAux"];
	if($aux01>=10){
		$aux01=0;
		$aux02++;
	}
	$aux01++;
	$aux03++;
	$DataQuery03 = "insert into pv_cuaderno_ce(ced_tbr,Npagina,Nlinea,Periodo) values('$id_mp','$aux02','$aux03','$idpv')";
	mysql_query($DataQuery03) or die (mysql_error());
	$DataSQL02 = "update pv_periodo_ce set contador_per='$aux03',ContadorAux='$aux02',Aux='$aux01' where id_pvperiodo='$id_periodo'";
	$DataSQL02 = mysql_query($DataSQL02);
}
header("location:../pv_planilla_ce.php?pn=$pv_planillanumero&&msj=1");
?>
