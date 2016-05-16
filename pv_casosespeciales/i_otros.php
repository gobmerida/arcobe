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

$h_nombre1=mb_strtoupper($h_nombre1,'utf-8');
$h_nombre2=mb_strtoupper($h_nombre2,'utf-8');
$h_apellido1=mb_strtoupper($h_apellido1,'utf-8');
$h_apellido2=mb_strtoupper($h_apellido2,'utf-8');

$codigo_pce="";
$date_or = date("Y");

$c_ctrbSQL = mysql_query("SELECT * FROM contador_ce WHERE con_i='0'",$con) or die (mysql_error());
$c_ctrbROW=mysql_fetch_array($c_ctrbSQL);

$con_ctrb = $c_ctrbROW['contador_pe'];
$cadena_conCtrb = strlen($con_ctrb);
if($cadena_conCtrb=="1"){
$con_ctrb = "000".$con_ctrb;
}
if($cadena_conCtrb=="2"){
$con_ctrb = "00".$con_ctrb;
}
if($cadena_conCtrb=="3"){
$con_ctrb = "0".$con_ctrb;
}
if($c_ctrbROW['contador_pe']<=9999){
$codigo_pce = "PCE-".$con_ctrb;
}
if($c_ctrbROW['contador_pe']>9999 and $c_ctrbROW['contador_pe']<=19999){
$con_ctrb=substr($con_ctrb,-4);
$codigo_pce = "CEP-".$con_ctrb;
}
if($c_ctrbROW['contador_pe']>19999 and $c_ctrbROW['contador_pe']<=29999){
$con_ctrb=substr($con_ctrb,-4);
$codigo_pce = "ECP-".$con_ctrb;
}
if($c_ctrbROW['contador_pe']>29999 and $c_ctrbROW['contador_pe']<=39999){
$con_ctrb=substr($con_ctrb,-4);
$codigo_pce = "ECP-".$con_ctrb;
}
if($c_ctrbROW['contador_pe']>39999 and $c_ctrbROW['contador_pe']<=49999){
$con_ctrb=substr($con_ctrb,-4);
$codigo_pce = "PEC-".$con_ctrb;
}
$act=0;
$cedula_madre="";
$cedula_padre="";
$cedula_representante="";
$cedula_rgis="";
if(array_key_exists('s_madre',$_POST) and $_POST['s_madre']=="s"){
	$codigo_madre="0";
	$cedula_madre=mb_strtoupper($_POST['cedula_madre'],'utf-8');
	if($_POST['concod']=="m"){
		$codigo_madre=$codigo_pce;
		$cedula_rgis=$cedula_madre;
	}
	$consulta_madreSQL = "SELECT * FROM pvce_mpr WHERE mpr_cedula='$cedula_madre'";
	$consulta_madreSQL = mysql_query($consulta_madreSQL) or die ("Error: ".mysql_error());
	$consulta_madreROW = mysql_fetch_array($consulta_madreSQL);
	if($consulta_madreROW['mpr_cedula']!=$cedula_madre){
		$n_madre=mb_strtoupper($_POST['n_madre'],'utf-8');
		$p_madre=mb_strtoupper($_POST['p_madre'],'utf-8');
		$d_madre=mb_strtoupper($_POST['d_madre'],'utf-8');
		$t_madre=mb_strtoupper($_POST['t_madre'],'utf-8');
		$ing_madre = "INSERT INTO pvce_mpr(mpr_cedula, mpr_nombres, mpr_apellidos, mpr_direccion, mpr_telefono, codigo_pce)
						               value('$cedula_madre','$n_madre','$p_madre','$d_madre','$t_madre','$codigo_madre')";
		mysql_query($ing_madre) or die ("Error: ".mysql_error());
	}
	if($consulta_madreROW['mpr_cedula']==$cedula_madre and $consulta_madreROW['codigo_pce']!="0"){
		if($_POST['concod']=="m"){
			$codigo_pce=$consulta_madreROW['codigo_pce'];
			$act=$act+1;
		}
	}
	if($consulta_madreROW['mpr_cedula']==$cedula_madre and $consulta_madreROW['codigo_pce']=="0"){
		$cedula_msq = $consulta_madreROW['mpr_cedula'];
		$update_madrepSQP = "UPDATE pvce_mpr SET codigo_pce='$codigo_madre' WHERE mpr_cedula='$cedula_msq'";
		mysql_query($update_madrepSQP) or die ("Error: ".mysql_error());
	}
}
if(array_key_exists('s_padre',$_POST) and $_POST['s_padre']=="s"){
	$codigo_padre="0";
	$cedula_padre=mb_strtoupper($_POST['cedula_padre'],'utf-8');
	if($_POST['concod']=="p"){
		$codigo_padre=$codigo_pce;
		$cedula_rgis=$cedula_padre;
	}
	$consulta_padreSQL = "SELECT * FROM pvce_mpr WHERE mpr_cedula='$cedula_padre'";
	$consulta_padreSQL = mysql_query($consulta_padreSQL) or die ("Error: ".mysql_error());
	$consulta_padreROW = mysql_fetch_array($consulta_padreSQL);
	if($consulta_padreROW['mpr_cedula']!=$cedula_padre){
		$n_padre=mb_strtoupper($_POST['n_padre'],'utf-8');
		$p_padre=mb_strtoupper($_POST['p_padre'],'utf-8');
		$d_padre=mb_strtoupper($_POST['d_padre'],'utf-8');
		$t_padre=mb_strtoupper($_POST['t_padre'],'utf-8');
		$ing_padre = "INSERT INTO pvce_mpr(mpr_cedula, mpr_nombres, mpr_apellidos, mpr_direccion, mpr_telefono, codigo_pce)
						               value('$cedula_padre','$n_padre','$p_padre','$d_padre','$t_padre','$codigo_padre')";
		mysql_query($ing_padre) or die ("Error: ".mysql_error());
	}
	if($consulta_padreROW['mpr_cedula']==$cedula_padre and $consulta_padreROW['codigo_pce']!="0"){
		if($_POST['concod']=="m"){
			$codigo_pce=$consulta_padreROW['codigo_pce'];
			$act=$act+1;
		}
	}
	if($consulta_padreROW['mpr_cedula']==$cedula_padre and $consulta_padreROW['codigo_pce']=="0"){
		$cedula_psq = $consulta_padreROW['mpr_cedula'];
		$update_padrepSQP = "UPDATE pvce_mpr SET codigo_pce='$codigo_padre' WHERE mpr_cedula='$cedula_psq'";
		mysql_query($update_padrepSQP) or die ("Error: ".mysql_error());
	}
}
if(array_key_exists('s_rep',$_POST) and $_POST['s_rep']=="s"){
	$codigo_representante="0";
	$cedula_representante=mb_strtoupper($_POST['cedula_representante'],'utf-8');
	if($_POST['concod']=="r"){
		$codigo_representante=$codigo_pce;
		$cedula_rgis=$cedula_representante;
	}
	$consulta_representanteSQL = "SELECT * FROM pvce_mpr WHERE mpr_cedula='$cedula_representante'";
	$consulta_representanteSQL = mysql_query($consulta_representanteSQL) or die ("Error: ".mysql_error());
	$consulta_representanteROW = mysql_fetch_array($consulta_representanteSQL);
	if($consulta_representanteROW['mpr_cedula']!=$cedula_representante){
		$n_representante=mb_strtoupper($_POST['n_representante'],'utf-8');
		$p_representante=mb_strtoupper($_POST['p_representante'],'utf-8');
		$d_representante=mb_strtoupper($_POST['d_representante'],'utf-8');
		$t_representante=mb_strtoupper($_POST['t_representante'],'utf-8');
		$ing_representante = "INSERT INTO pvce_mpr(mpr_cedula, mpr_nombres, mpr_apellidos, mpr_direccion, mpr_telefono, codigo_pce)
						               value('$cedula_representante','$n_representante','$p_representante','$d_representante','$t_representante','$codigo_representante')";
		mysql_query($ing_representante) or die ("Error: ".mysql_error());
	}
	if($consulta_representanteROW['mpr_cedula']==$cedula_representante and $consulta_representanteROW['codigo_pce']!="0"){
		if($_POST['concod']=="m"){
			$codigo_pce=$consulta_representanteROW['codigo_pce'];
			$act=$act+1;
		}
	}
	if($consulta_representanteROW['mpr_cedula']==$cedula_representante and $consulta_representanteROW['codigo_pce']=="0"){
		$cedula_rsq = $consulta_representanteROW['mpr_cedula'];
		$update_representantepSQP = "UPDATE pvce_mpr SET codigo_pce='$codigo_representante' WHERE mpr_cedula='$cedula_rsq'";
		mysql_query($update_representantepSQP) or die ("Error: ".mysql_error());
	}
}
$conta=mysql_query("SELECT * FROM pv_periodo_ce WHERE pv_añoperiodo='$date_or'",$con) or die (mysql_error());
$row_conta=mysql_fetch_array($conta);
$id_pvperiodo=$row_conta['id_pvperiodo'];
$contador=$row_conta['pv_contador']+1;
$id_nino=$codigo_pce."-".$contador."-PVCE";

$pv_planillanumero = $date_or."-".$contador."-PVCE";
$id_periodo = $date_or;
$pv_destino=$_POST['pv_destino'];

if($act==0){
	$con_ctrb=$con_ctrb+1;
	$update_contador_pe = "UPDATE contador_ce SET contador_pe='$con_ctrb' WHERE con_i='0'";
	mysql_query($update_contador_pe);
}

$update_contador = "UPDATE pv_periodo_ce SET pv_contador='$contador' WHERE pv_añoperiodo='$date_or'";
mysql_query($update_contador);

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

$insertar_ni = "INSERT INTO pv_planillace(id_nino,h_cedula,h_nombre1,h_nombre2,h_apellido1,h_apellido2,h_fecha_naci,h_sexo,cedula_mp,cedula_pm,cedula_regis,cedula_trb,h_gsanguineo,pv_planillanumero,id_periodo,pv_destino,pv_fotos,pv_certificado,pv_habilidades,pv_gustos,pv_vacunas,pv_alergias,pv_tratamiento,pv_alimentosp,pv_medicamentosp,pv_tchaqueta,pv_tfranela,pv_tmono,pv_tgorra,pv_contacto_cedula,pv_contacto_nombre,pv_contacto_apellido,pv_contacto_telefono,pv_contacto_parentesco,pv_observaciones,pv_edadmeses,codigo_trb,token)
				value('$id_nino','$h_cedula','$h_nombre1','$h_nombre2','$h_apellido1','$h_apellido2','$h_fecha_naci','$h_sexo','$cedula_madre','$cedula_padre','$cedula_representante','$cedula_rgis','$h_gsanguineo','$pv_planillanumero','$id_pvperiodo','$pv_destino','$pv_fotos','$pv_certificado','$pv_habilidades','$pv_gustos','$pv_vacunas','$pv_alergias','$pv_tratamiento','$pv_alimentosp','$pv_medicamentosp','$pv_tchaqueta','$pv_tfranela','$pv_tmono','$pv_tgorra','$pv_contacto_cedula','$pv_contacto_nombre','$pv_contacto_apellido','$pv_contacto_telefono','$pv_contacto_parentesco','$pv_observaciones','$pv_edadmeses','$codigo_pce','1')";

mysql_query($insertar_ni) or die ("Error al insertar: ".mysql_error());

//~ header("location: ./pv_nino_ce.php?nino=$id_nino&&msj=1");

?>
