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
		if(formulario.cedula.value.length==0){
			document.getElementById("cedula").style.border = "2px inset red";
			formulario.cedula.focus();
			alert("¡Introduzca la cédula!");
			return false;
		}
	return true;
	}
	function busc_ms(){
		$('#suggestions').fadeIn(0);
	}
	function bus_h(){
		var cedula = document.getElementById('cedula').value;		
			var dataString = 'cedula='+cedula;
			if(cedula.length!=0){
			$.ajax({
				type: "POST",
				url: "tbr.php",
				data: dataString,
				success: function(data) {
					$('#suggestions').fadeIn(1000).html(data);
					$('.suggest-element a').live('click', function(){
						var id = $(this).attr('id');
						$('#cedula').val($('#'+id).attr('data'));
						$('#suggestions').fadeOut(1000);
						$('#trb_cedula').submit();
						return false;
					});              
				}
			});
			}
	}  
	function pc(){
		$("#suggestions").fadeOut(0);
	}
	</script>
</head>

<body onclick="pc()">
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
if(!array_key_exists('cedula',$_GET)){
?>
	<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
	<h3 style="text-align:center">Consultar Trabajador(ra)</h3>
	<form action="#" method="get" id="trb_cedula" onsubmit="return validar(this)">
		<table style="margin:0 auto;text-align:center">
			<thead>
				<tr><td>Cédula</td></tr>
			</thead>
			<tr><td><span class="ls">V-</span><input type="text" id="cedula" name="cedula" autocomplete="off" onkeyup="busc_ms();bus_h()"><div id="suggestions"></div></td></tr>
			<tr><td><input type="submit" value="Enviar">
			</td></tr>
			<script>
	$('#suggestions').fadeOut(0);
	</script>
		</table>
		
	</form><br>
	<center><a href="./" style='color:red;text-decoration:none'>Regresar</a></center>
	
	<span class="cen">Cédula</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
	
	
	</div>
<?php
}

if(array_key_exists('cedula',$_GET)){
	echo "<div id='cabecera_ini'>
	
	</div>";
	echo "<div id='contenedor' style='border-radius:0'>";
	$cedula=$_GET['cedula'];
	echo "<br><span class='cll'>Datos del trabajador";
	if($_SESSION['rol_editor']=="1"){
		echo "<img src='../media/edit.png' width='30px' onclick='location.href=\"edit_trb.php?cedula=$cedula\"' title='Editar' style='cursor:pointer'>";
	}
	echo "</span><br>";
	mysql_select_db("cj_pv",$con) or die (mysql_error());
	$c_trabajador=mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$cedula'",$con) or die (mysql_error());
	$row_trabajador=mysql_fetch_array($c_trabajador);
	if($row_trabajador['trb_cedula']!=''){
	if($row_trabajador['activo']=="1"){
		$activo="<b style='color:green'>Activo</b>";
	}
	if($row_trabajador['activo']=="0"){
		$activo="<b style='color:red'>Inactivo</b>";
	}
	
	echo "<table class='ta_trabajador'>";
	echo "<tr class='som'><td><b>Cédula:</b> V-".$row_trabajador['trb_cedula']."</td><td><b>Código trabajador:</b> ".$row_trabajador['trb_codigo']."</td></tr>";
	$noms=$row_trabajador['trb_nombres'];
	$aps=$row_trabajador['trb_apellidos'];
	
	echo "<tr><td colspan='2'><b>Apellidos y Nombres:</b> ".$noms."</td></tr>";
	echo "<tr class='som'><td colspan='2'><b>Cargo:</b> ".$row_trabajador['trb_cargo']."</td></tr>";
	echo "<tr><td colspan='2'><b>Dependencia:</b> ".$row_trabajador['trb_dependencia']."</td></tr>";
	echo "<tr class='som'><td colspan='2'><b>Teléfonos:</b> ".$row_trabajador['trb_telefono']."</td></tr>";
	echo "<tr><td colspan='2'><b>Dirección de habitación:</b> ".mb_strtoupper($row_trabajador['trb_direccionh'],'utf-8')."</td></tr>";
	echo "<tr class='som'><td colspan='2'><b>Correo:</b> ".$row_trabajador['trb_correo']."</td></tr>";
	echo "<tr><td colspan='2' style='text-align:center'>$activo</td></tr>";
	echo "</table>";
	}
	if($row_trabajador['trb_cedula']==''){
		echo "<h3 style='color:red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula no registrada</h3>";
	}
	echo "<br><span class='dll'><center>";
	if(array_key_exists('HTTP_REFERER',$_SERVER)){
	echo "<img src='../media/volver.png' onclick=\"location.href='./'\" width='20px' style='cursor:pointer' title='Regresar'/>&nbsp;";
	}
	echo "<img src='../media/inicio.png' onclick=\"location.href='../'\" width='20px' style='cursor:pointer' title='Inicio'/>&nbsp;<img src='../media/buscar.png' onclick=\"location.href='trabajador.php'\" width='20px' style='cursor:pointer;border-radius:0' title='Buscar Trabajador'/>
	</center></span>";
	echo "<br>";
	echo "</div>";
	echo "<div id='hijos'>";
	$c_hijos=mysql_query("SELECT * FROM cj_hijos_institutos WHERE cedula_mp='$cedula'",$con) or die (mysql_error());
	$c2_hijos=mysql_query("SELECT * FROM cj_hijos_institutos WHERE cedula_pm='$cedula'",$con) or die (mysql_error());
	$c3_hijos=mysql_query("SELECT * FROM cj_hijos_institutos WHERE cedula_repr='$cedula'",$con) or die (mysql_error());
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
	
	if($i==0){
		echo "<span class='cen'>No hay Beneficiarios(as) registrados</span><br>";
	}
	echo "</div>";
	if(array_key_exists('msj',$_GET) and $_GET["msj"]=="1"){
		echo "
			<script>
				alert('Actualizado');
			</script>
		";
	}
}
?>
</body>
</html>
