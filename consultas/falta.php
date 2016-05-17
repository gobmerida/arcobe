<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<style>
		input{
			text-transform: uppercase;
		}
		.suggest-element{
		margin-left:5px;
		margin-top:5px;
		width:450px;
		cursor:pointer;
		}
		#suggestions{
			min-width:200px;
		text-align:left;
		position:fixed;
		margin: 0 auto;
		height:150px;
		border:ridge 2px;
		border-radius: 3px;
		overflow: auto;
		background: white;
		}
		td,th{
			border:1px solid silver;
			padding:4px;
		}
		th{
			color:maroon;
			background-color:white;
		}
		tr:hover{
			color:white;
			background-color:maroon;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
</head>

<body>
	<div id="cabecera_ini"></div>
	<div id="principal">
		<?php
		include("../connect/conexion.php");
		$periodo=1;
		$consulta_reg = "SELECT * FROM pv_inscrip
							JOIN cj_beneficiados
							ON pv_inscrip.id_ninho_pv=cj_beneficiados.id_ninho
							WHERE id_periodo='$periodo'";
		$consulta_reg = mysql_query($consulta_reg) or die (mysql_error());
		echo "
		<h3 style='text-align:center'>Falta de documentos:</h3>
		<table style='margin:0 auto;text-align:center'>
		<thead>
			<tr><th>Número planilla</th><th>Nombre y apellido (Beneficiario)</th><th>Documento</th></tr>
		</thead>
		";
		while($registrados = mysql_fetch_array($consulta_reg)){
		if($registrados['pv_fotos']=="" or $registrados['pv_certificado']=="" or $registrados['pv_habilidades']=="" or $registrados['pv_gustos']=="" or $registrados['pv_vacunas']=="" or $registrados['pv_alergias']=="" or $registrados['pv_tratamiento']=="" or $registrados['pv_alimentosp']=="" or $registrados['pv_medicamentosp']=="" or $registrados['pv_tchaqueta']=="1" or $registrados['pv_tfranela']=="1" or $registrados['pv_tmono']=="1" or $registrados['pv_tgorra']=="1" or $registrados['pv_contacto_cedula']=="" or $registrados['pv_contacto_nombre']=="" or $registrados['pv_contacto_apellido']=="" or $registrados['pv_contacto_telefono']=="" or $registrados['pv_contacto_parentesco']=="1"){
		$error="Falta:";
		if($registrados['pv_fotos']==""){
			$error.=" foto -";
		}
		if($registrados['pv_certificado']==""){
			$error.=" certificado de niño sano -";
		}
		if($registrados['pv_habilidades']==""){
			$error.=" habilidades -";
		}
		if($registrados['pv_gustos']==""){
			$error.=" gustos -";
		}
		if($registrados['pv_vacunas']==""){
			$error.=" vacunas -";
		}
		if($registrados['pv_alergias']==""){
			$error.=" alergias -";
		}
		if($registrados['pv_tratamiento']==""){
			$error.=" tratamientos -";
		}
		if($registrados['pv_alimentosp']==""){
			$error.=" alimentos prohibidos -";
		}
		if($registrados['pv_tchaqueta']=="1"){
			$error.=" talla de la chaqueta -";
		}
		if($registrados['pv_tfranela']=="1"){
			$error.=" talla de la franela -";
		}
		if($registrados['pv_tmono']=="1"){
			$error.=" talla del mono -";
		}
		if($registrados['pv_tgorra']=="1"){
			$error.=" talla del gorra -";
		}
		if($registrados['pv_medicamentosp']==""){
			$error.=" medicamentos prohibidos -";
		}
		if($registrados['pv_contacto_cedula']==""){
			$error.=" cédula del contacto -";
		}
		if($registrados['pv_contacto_nombre']==""){
			$error.=" nombre del contacto -";
		}
		if($registrados['pv_contacto_apellido']==""){
			$error.=" apellido del contacto -";
		}
		if($registrados['pv_contacto_telefono']==""){
			$error.=" teléfono del contacto -";
		}
		if($registrados['pv_contacto_parentesco']=="1"){
			$error.=" parentesco del contacto -";
		}
		echo "<tr onclick='location.href=\"pv_planilla.php?pn=$registrados[pv_planillanumero]\"'><td>$registrados[pv_planillanumero]</td><td>$registrados[h_nombre1] $registrados[h_nombre2] $registrados[h_apellido1] $registrados[h_apellido2]</td><td>$error</td></tr>";
		}
		}
		echo "
		</table>
		<br>
		<center><a href='../' style='color:red;text-decoration:none'>Regresar</a></center>
		<br>
		";
		?>
	</div>
</body>

</html>

