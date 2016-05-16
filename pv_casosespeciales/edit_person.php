<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
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
		input{text-transform: uppercase;}
		.suggest-element{
		margin-left:5px;
		margin-top:5px;
		width:450px;
		cursor:pointer;
		}
		#suggestions {
		text-align:left;
		margin: 0 auto;
		position:fixed;
		min-width:200px;
		height:150px;
		border:ridge 2px;
		border-radius: 3px;
		overflow: auto;
		background: white;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
	function validar(formulario){
		if(formulario.mpr_nombres.value.length==0){
			document.getElementById("mpr_nombres").style.border = "2px inset red";
			formulario.mpr_nombres.focus();
			alert("¡Introduzca el ó los Nombres!");
			return false;
		}
		if(formulario.mpr_apellidos.value.length==0){
			document.getElementById("mpr_apellidos").style.border = "2px inset red";
			formulario.mpr_apellidos.focus();
			alert("¡Introduzca el ó los Apellidos!");
			return false;
		}
		if(formulario.mpr_telefono.value.length==0){
			document.getElementById("mpr_telefono").style.border = "2px inset red";
			formulario.mpr_telefono.focus();
			alert("¡Introduzca el teléfono!");
			return false;
		}
		if(formulario.mpr_direccion.value.length==0){
			document.getElementById("mpr_direccion").style.border = "2px inset red";
			formulario.mpr_direccion.focus();
			alert("¡Introduzca la dirección de habitación!");
			return false;
		}
	return true;
	}
	function formato(telefono){
		var num_sf=telefono.value;
		var num = telefono.value.length;
		if(num==11){
			var num_cf='';
			num_cf=num_sf.substring(0,4)+"-";
			num_cf+=num_sf.substring(4,7)+".";
			num_cf+=num_sf.substring(7,9)+".";
			num_cf+=num_sf.substring(9,11);
			telefono.value=num_cf;
		}
		else{
		  telefono.focus();
		  alert("El número de teléfono debe ser de 11 números");
		  return false;
		}
	}
	function changes(change){
		$(change).css("border","2px inset silver");
	}
	</script>
</head>

<body>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");

if(array_key_exists('cedula',$_GET)){
	$cedula=$_GET['cedula'];
	echo "<div id='cabecera_ini'>
	
	</div>";
	echo "<div id='contenedor' style='border-radius:0'>";
	echo "<br><span class='cll'>Datos de la Persona";
	echo "</span><br>";
	
	mysql_select_db("cj_pv",$con) or die (mysql_error());
	$personaSQL=mysql_query("SELECT * FROM pvce_mpr WHERE mpr_cedula='$cedula'",$con) or die (mysql_error());
	$personaROW=mysql_fetch_array($personaSQL);
	if($personaROW['mpr_cedula']!=''){
	
	echo "<form method='post' action='edit_p.php' onsubmit='return validar(this)'>";
	echo "<table class='ta_trabajador'>";
	echo "<tr class='som'><td>Cedula: V-".$personaROW['mpr_cedula']."</td><td>Código trabajador: ".$personaROW['codigo_pce']."</td></tr>";
	$noms=$personaROW['mpr_nombres'];
	$aps=$personaROW['mpr_apellidos'];
	
	echo "<input type='hidden' value='".$personaROW['mpr_cedula']."' name='mpr_cedula' id='mpr_cedula'>
		  <tr><td colspan='2'>Nombres: <input type='text' value='".$noms."' name='mpr_nombres' id='mpr_nombres' onkeyup='changes(this);' autocomplete='off'></td></tr>";
	echo "<tr class='som'><td colspan='2'>Apellidos: <input type='text' value='".$aps."' name='mpr_apellidos' id='mpr_apellidos' onkeyup='changes(this);' autocomplete='off'></td><br></tr>";
	echo "<tr><td colspan='2'>Teléfono: <input type='text' value='".$personaROW['mpr_telefono']."' name='mpr_telefono' id='mpr_telefono' onblur='formato(this)' onkeyup='changes(this);' autocomplete='off'></td></tr>";
	echo "<tr class='som'><td colspan='2'>Dirección de habitación: <input type='text' value='".$personaROW['mpr_direccion']."' name='mpr_direccion' id='mpr_direccion' onkeyup='changes(this);' autocomplete='off'></td></tr>";

	echo "</table>";
	}
	if($personaROW['mpr_cedula']==''){
		echo "<h3 style='color:red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula no registrada</h3>";
	}
	echo "<br><span class='dll'><center><input type='image' value='Guardar' title='Guardar' src='../media/guardar.jpg' width='20px'>";
	echo "&nbsp;<img src='../media/inicio.png' onclick=\"location.href='./'\" width='20px' style='cursor:pointer' title='Inicio'/>&nbsp;<img src='../media/cancelar.png' onclick='location.href=\"persona.php?cedula=$cedula\"' width='20px' style='cursor:pointer' title='Cancelar'>
	</center></span>";
	echo "<br></form>";
	echo "</div>";
	/*echo "<div id='hijos'>";
	$c_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$cedula'",$con) or die (mysql_error());
	$c2_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_pm='$cedula'",$con) or die (mysql_error());
	$c3_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_repr='$cedula'",$con) or die (mysql_error());
	$i=0;
	while($row_hijos=mysql_fetch_array($c_hijos)){
		if($row_hijos['id_ninho']!=""){
			$cod_nino=$row_hijos['id_ninho'];
			$nombre2=" ".$row_hijos['h_nombre2'];
			$apellido2=" ".$row_hijos['h_apellido2'];
			$e_nino=$row_hijos['h_nombre1'].$nombre2." ".$row_hijos['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='nino.php?nino=$cod_nino' class='nino' >$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	while($row2_hijos=mysql_fetch_array($c2_hijos)){
		if($row2_hijos['id_ninho']!=""){
			$cod_nino=$row2_hijos['id_ninho'];
			$nombre2=" ".$row2_hijos['h_nombre2'];
			$apellido2=" ".$row2_hijos['h_apellido2'];
			$e_nino=$row2_hijos['h_nombre1'].$nombre2." ".$row2_hijos['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='nino.php?nino=$cod_nino' class='nino' >$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	while($row3_hijos=mysql_fetch_array($c3_hijos)){
		if($row3_hijos['id_ninho']!=""){
			$cod_nino=$row3_hijos['id_ninho'];
			$nombre2=" ".$row3_hijos['h_nombre2'];
			$apellido2=" ".$row3_hijos['h_apellido2'];
			$e_nino=$row3_hijos['h_nombre1'].$nombre2." ".$row3_hijos['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='nino.php?nino=$cod_nino' class='nino' >$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	$c_hijos_ce=mysql_query("SELECT * FROM cj_hijos_ce JOIN cj_cesta_juguete_periodo ON cj_hijos_ce.id_periodo=cj_cesta_juguete_periodo.id WHERE cedula_mp='$cedula'",$con) or die (mysql_error());
	$c2_hijos_ce=mysql_query("SELECT * FROM cj_hijos_ce JOIN cj_cesta_juguete_periodo ON cj_hijos_ce.id_periodo=cj_cesta_juguete_periodo.id  WHERE cedula_pm='$cedula'",$con) or die (mysql_error());
	$c3_hijos_ce=mysql_query("SELECT * FROM cj_hijos_ce JOIN cj_cesta_juguete_periodo ON cj_hijos_ce.id_periodo=cj_cesta_juguete_periodo.id  WHERE cedula_repr='$cedula'",$con) or die (mysql_error());
	while($row_hijos_ce=mysql_fetch_array($c_hijos_ce)){
		if($row_hijos_ce['id_ninho']!=""){
			$cod_nino=$row_hijos_ce['id_ninho'];
			$nombre2=" ".$row_hijos_ce['h_nombre2'];
			$apellido2=" ".$row_hijos_ce['h_apellido2'];
			$e_nino=$row_hijos_ce['h_nombre1'].$nombre2." ".$row_hijos_ce['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='../cj_casosespeciales/nino_ce.php?nino=$cod_nino' class='nino' ><span style='color:darkgrey'>(CE/CJ/$row_hijos_ce[año_periodo]) </span>$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	while($row2_hijos_ce=mysql_fetch_array($c2_hijos_ce)){
		if($row2_hijos_ce['id_ninho']!=""){
			$cod_nino=$row2_hijos_ce['id_ninho'];
			$nombre2=" ".$row2_hijos_ce['h_nombre2'];
			$apellido2=" ".$row2_hijos_ce['h_apellido2'];
			$e_nino=$row2_hijos_ce['h_nombre1'].$nombre2." ".$row2_hijos_ce['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='../cj_casosespeciales/nino_ce.php?nino=$cod_nino' class='nino' ><span style='color:darkgrey'>(CE/CJ/$row2_hijos_ce[año_periodo]) </span>$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	while($row3_hijos_ce=mysql_fetch_array($c3_hijos_ce)){
		if($row3_hijos_ce['id_ninho']!=""){
			$cod_nino=$row3_hijos_ce['id_ninho'];
			$nombre2=" ".$row3_hijos_ce['h_nombre2'];
			$apellido2=" ".$row3_hijos_ce['h_apellido2'];
			$e_nino=$row3_hijos_ce['h_nombre1'].$nombre2." ".$row3_hijos_ce['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='../cj_casosespeciales/nino_ce.php?nino=$cod_nino' class='nino' ><span style='color:darkgrey'>(CE/CJ/$row3_hijos_ce[año_periodo]) </span>$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	
	$PV_beneficiario_slq1=mysql_query("SELECT * FROM pv_planillace JOIN pv_periodo_ce ON pv_planillace.id_periodo=pv_periodo_ce.id_pvperiodo WHERE cedula_mp='$cedula'",$con) or die (mysql_error());
	$PV_beneficiario_slq2=mysql_query("SELECT * FROM pv_planillace JOIN pv_periodo_ce ON pv_planillace.id_periodo=pv_periodo_ce.id_pvperiodo WHERE cedula_pm='$cedula'",$con) or die (mysql_error());
	$PV_beneficiario_slq3=mysql_query("SELECT * FROM pv_planillace JOIN pv_periodo_ce ON pv_planillace.id_periodo=pv_periodo_ce.id_pvperiodo WHERE cedula_regis='$cedula'",$con) or die (mysql_error());
	
	while($PV_beneficiario_row1=mysql_fetch_array($PV_beneficiario_slq1)){
		if($PV_beneficiario_row1['id_nino']!=""){
			$cod_nino=$PV_beneficiario_row1['id_nino'];
			$nombre2=" ".$PV_beneficiario_row1['h_nombre2'];
			$apellido2=" ".$PV_beneficiario_row1['h_apellido2'];
			$e_nino=$PV_beneficiario_row1['h_nombre1'].$nombre2." ".$PV_beneficiario_row1['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='../pv_casosespeciales/pv_nino_ce.php?nino=$cod_nino' class='nino' ><span style='color:darkgrey'>(CE/PV/$PV_beneficiario_row1[pv_añoperiodo]) </span>$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	while($PV_beneficiario_row2=mysql_fetch_array($PV_beneficiario_slq2)){
		if($PV_beneficiario_row2['id_nino']!=""){
			$cod_nino=$PV_beneficiario_row2['id_nino'];
			$nombre2=" ".$PV_beneficiario_row2['h_nombre2'];
			$apellido2=" ".$PV_beneficiario_row2['h_apellido2'];
			$e_nino=$PV_beneficiario_row2['h_nombre1'].$nombre2." ".$PV_beneficiario_row2['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='../pv_casosespeciales/pv_nino_ce.php?nino=$cod_nino' class='nino' ><span style='color:darkgrey'>(CE/PV/$PV_beneficiario_row2[pv_añoperiodo]) </span>$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	while($PV_beneficiario_row3=mysql_fetch_array($PV_beneficiario_slq3)){
		if($PV_beneficiario_row3['id_nino']!=""){
			$cod_nino=$PV_beneficiario_row3['id_nino'];
			$nombre2=" ".$PV_beneficiario_row3['h_nombre2'];
			$apellido2=" ".$PV_beneficiario_row3['h_apellido2'];
			$e_nino=$PV_beneficiario_row3['h_nombre1'].$nombre2." ".$PV_beneficiario_row3['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='../pv_casosespeciales/pv_nino_ce.php?nino=$cod_nino' class='nino' ><span style='color:darkgrey'>(CE/PV/$PV_beneficiario_row3[pv_añoperiodo]) </span>$e_nino</a></span><br>";
			$i=$i+1;
		}
	}
	if($i==0){
		echo "<span class='cen'>No hay Beneficiarios(as) registrados</span><br>";
	}
	echo "</div>";*/
	
}
?>
</body>
</html>
