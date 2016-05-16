<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Cesta Juguete</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<style>
		.suggest-element{
		margin-left:5px;
		margin-top:5px;
		width:400px;
		cursor:pointer;
		}
		#suggestions {
		position:fixed;
		margin: 0 35px;
		width:400px;
		height:150px;
		border:ridge 2px;
		border-radius: 3px;
		overflow: auto;
		background: white;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {	
		$('#suggestions').fadeOut(0);
		$('#mp').keypress(function(){
			var mp = $(this).val();		
			var dataString = 'cedula='+mp;
			$.ajax({
				type: "POST",
				url: "empleados_ce.php",
				data: dataString,
				success: function(data) {
					$('#suggestions').fadeIn(1000).html(data);
					$('.suggest-element a').live('click', function(){
						var id = $(this).attr('id');
						$('#mp').val($('#'+id).attr('data'));
						$('#suggestions').fadeOut(1000);
						$('#ing_mp').submit();
						return false;
					});              
				}
			});
		});              
	});    
	</script>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor">
		<h3 class="n">Ingreso del Niño <span style="color:red">(Caso Especial)</span><br>1er llamado de datos padere o madre</h3><br>
		<form action="ing_pm_ce.php" method="get" id="ing_mp">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula <input type="text" name="mp" id="mp" autocomplete=off><input type="submit" value="Enviar">
		<div id="suggestions"></div>
		</form><br>
		<center><span><a href="./" >Cancelar</a></span></center><br>
	</div>
	<?php
	if(array_key_exists('error',$_GET) and $_GET["error"]=="1"){
		echo "
		<script>
		alert('¡Cédula no registrada o inactiva!');
		</script>
		";
	}
	?>
</body>
</html>
