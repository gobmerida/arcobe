<?php
include("../connect/conexion.php");
include("../script_php/a_fe.php");
include("../script_php/cal_edad.php");
$h_cedula="";
if(array_key_exists('h_cedula',$_POST)){
$h_cedula=$_POST['h_cedula'];
}
$h_nombre1=$_POST['h_nombre1'];
$h_nombre2=$_POST['h_nombre2'];
$h_apellido1=$_POST['h_apellido1'];
$h_apellido2=$_POST['h_apellido2'];
$h_fecha_naci=an_fecha($_POST['h_fecha_naci']);
$h_sexo=$_POST['h_sexo'];
$h_gsanguineo=$_POST['h_gsanguineo'];

if(array_key_exists('nombre_mp',$_POST)){
$nombre_mp=$_POST['nombre_mp'];
$apellido_mp=$_POST['apellido_mp'];
$nombre_mp=mb_strtoupper($nombre_mp,'utf-8');
$apellido_mp=mb_strtoupper($apellido_mp,'utf-8');
}
$h_nombre1=mb_strtoupper($h_nombre1,'utf-8');
$h_nombre2=mb_strtoupper($h_nombre2,'utf-8');
$h_apellido1=mb_strtoupper($h_apellido1,'utf-8');
$h_apellido2=mb_strtoupper($h_apellido2,'utf-8');

$cedula_mp=$_POST['mp'];
$trb_c=$_POST['trb_c'];
$cedula_pm="";
if(array_key_exists("pm",$_POST)){
	$cedula_pm=$_POST['pm'];
}

$date_or = date("Y");
$conta=mysql_query("SELECT * FROM pv_periodo_ce WHERE pv_añoperiodo='$date_or'",$con) or die (mysql_error());
$row_conta=mysql_fetch_array($conta);
$id_pvperiodo=$row_conta['id_pvperiodo'];
$contador=$row_conta['pv_contador']+1;
$id_nino=$trb_c."-".$contador."-PVCE";

$update_contador = "UPDATE pv_periodo_ce SET pv_contador='$contador' WHERE pv_añoperiodo='$date_or'";
mysql_query($update_contador);

$pv_planillanumero = $date_or."-".$contador."-PVCE";
$id_periodo = $date_or;
$pv_destino=$_POST['pv_destino'];

$pv_fotos="";
if(array_key_exists('pv_fotos',$_POST)){
$pv_fotos=$_POST['pv_fotos'];
}

$pv_certificado="";
if(array_key_exists('pv_certificado',$_POST)){
$pv_certificado=$_POST['pv_certificado'];
}

$pv_habilidades=$_POST['pv_habilidades'];
$pv_gustos=$_POST['pv_gustos'];
$pv_vacunas=$_POST['pv_vacunas'];
$pv_alergias=$_POST['pv_alergias'];
$pv_tratamiento=$_POST['pv_tratamiento'];
$pv_alimentosp=$_POST['pv_alimentosp'];
$pv_medicamentosp=$_POST['pv_medicamentosp'];
$pv_tchaqueta=$_POST['pv_tchaqueta'];
$pv_tfranela=$_POST['pv_tfranela'];
$pv_tmono=$_POST['pv_tmono'];
$pv_tgorra=$_POST['pv_tgorra'];
$pv_contacto_cedula=$_POST['pv_contacto_cedula'];
$pv_contacto_nombre=$_POST['pv_contacto_nombre'];
$pv_contacto_apellido=$_POST['pv_contacto_apellido'];
$pv_contacto_telefono=$_POST['pv_contacto_telefono'];
$pv_contacto_parentesco=$_POST['pv_contacto_parentesco'];
$pv_observaciones=$_POST['pv_observaciones'];

$edad_c=a_fecha($h_fecha_naci);

$fecha_control=date("d/m/Y");
$edad_cal = CalculaEdadMeses($edad_c, $fecha_control);
$pv_edadmeses = "$edad_cal[0] años con $edad_cal[1] meses";

$insertar_ni = "INSERT INTO pv_planillace(id_nino,h_cedula,h_nombre1,h_nombre2,h_apellido1,h_apellido2,h_fecha_naci,h_sexo,cedula_mp,cedula_pm,cedula_trb,h_gsanguineo,pv_planillanumero,id_periodo,pv_destino,pv_fotos,pv_certificado,pv_habilidades,pv_gustos,pv_vacunas,pv_alergias,pv_tratamiento,pv_alimentosp,pv_medicamentosp,pv_tchaqueta,pv_tfranela,pv_tmono,pv_tgorra,pv_contacto_cedula,pv_contacto_nombre,pv_contacto_apellido,pv_contacto_telefono,pv_contacto_parentesco,pv_observaciones,pv_edadmeses,codigo_trb)
				value('$id_nino','$h_cedula','$h_nombre1','$h_nombre2','$h_apellido1','$h_apellido2','$h_fecha_naci','$h_sexo','$cedula_mp','$cedula_pm','$cedula_mp','$h_gsanguineo','$pv_planillanumero','$id_pvperiodo','$pv_destino','$pv_fotos','$pv_certificado','$pv_habilidades','$pv_gustos','$pv_vacunas','$pv_alergias','$pv_tratamiento','$pv_alimentosp','$pv_medicamentosp','$pv_tchaqueta','$pv_tfranela','$pv_tmono','$pv_tgorra','$pv_contacto_cedula','$pv_contacto_nombre','$pv_contacto_apellido','$pv_contacto_telefono','$pv_contacto_parentesco','$pv_observaciones','$pv_edadmeses','$trb_c')";

mysql_query($insertar_ni) or die ("Error al insertar: ".mysql_error());

if(array_key_exists('nombre_mp',$_POST) and array_key_exists("pm",$_POST)){
	$nombre_mp=$_POST['nombre_mp'];
	$apellido_mp=$_POST['apellido_mp'];
	mysql_query("INSERT INTO cj_mp(mp_cedula,mp_nombre,mp_apellido) value('$cedula_pm','$nombre_mp','$apellido_mp')",$con) or die (mysql_error());
}
header("location: ./pv_nino_ce.php?nino=$id_nino&&msj=1");

?>
