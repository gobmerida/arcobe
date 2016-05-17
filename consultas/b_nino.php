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
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
	function validar(formulario){
		if(formulario.codigo.value.length==0){
			document.getElementById("codigo").style.border = "2px inset red";
			formulario.codigo.focus();
			alert("¡Introduzca el Código!");
			return false;
		}
	return true;
	}
	function busc_ms(){
		$('#suggestions').fadeIn(0);
	}
	function busc_ms(){
		$('#suggestions').fadeIn(0);
	}
	function bus_h(){
		var codigo = document.getElementById('codigo').value;		
			var dataString = 'codigo='+codigo;
			$.ajax({
				type: "POST",
				url: "bus_nino.php",
				data: dataString,
				success: function(data) {
					$('#suggestions').fadeIn(0).html(data);
					$('.suggest-element a').live('click', function(){
						var id = $(this).attr('id');
						$('#codigo').val($('#'+id).attr('data'));
						$('#suggestions').fadeOut(1000);
						$('#id_ninho').submit();
						return false;
					});              
				}
			});
	}
	</script>
</head>

<body onclick="$('#suggestions').fadeOut(0);">
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
if(!array_key_exists('cedula',$_GET)){
?>
	<div id="cabecera_ini"></div>
	<div id="principal">
		<h3 style="text-align:center">Consultar Niño(a)</h2>
	<form action="nino.php" method="get" id="id_ninho" onsubmit="return validar(this)">
		<table style="margin:0 auto;text-align:center;padding:5px;">
		<tr><td>Buscar por (Código/Nombre/Apellido)</td></tr>
		<tr><td><input type="text" id="codigo" name="nino" autocomplete="off" onkeyup="busc_ms();bus_h()" ><div id="suggestions"></div></td></tr>
		<tr><td><input type="submit" value="Enviar"></td></tr>
		</table><br>
		<center><a href="../" style='color:red;text-decoration:none'>Regresar</a></center>
		
	<script>
	$('#suggestions').fadeOut(0);
	</script>
	</form><br>
	</div>
<?php } ?>
</body>
<?php
if(array_key_exists('error',$_GET) and $_GET['error']=='1'){
	echo "
	<script>
	alert('No se encontró al Niño(a). Niño(a) no registrado o Código erróneo.');
	</script>
	";
}
?>
</html>
