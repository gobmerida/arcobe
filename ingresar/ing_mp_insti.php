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
	<script language="javascript" src="../js/delimitar.js"></script>
	<script type="text/javascript">
	function busc_ms(){
		$('#suggestions').fadeIn(0);
	}
	function bus_h(){
		var mp = document.getElementById('mp').value;		
			var dataString = 'mp='+mp;
			$.ajax({
				type: "POST",
				url: "empleados.php",
				data: dataString,
				success: function(data) {
					$('#suggestions').fadeIn(0).html(data);
					$('.suggest-element a').live('click', function(){
						var id = $(this).attr('id');
						$('#mp').val($('#'+id).attr('data'));
						$('#suggestions').fadeOut(1000);
						$('#ing_mp').submit();
						return false;
					});              
				}
			});
	}
	</script>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor">

		<center><h3 class="n">Registrar Beneficiario<br><br /></h3></center>
		<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula de la madre o el padre<br><br /></h3>
		<form action="ing_pm_insti.php" method="get" id="ing_mp">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula <input type="text" name="mp" id="mp" autocomplete=off onkeyup="busc_ms();bus_h()" onkeypress="return permite(event, 'num')"><input type="submit" value="Enviar">
		<div id="suggestions"></div>
		</form><br>
		<center><span><a href="../" >Cancelar</a></span></center><br>
	</div>
	<script>
	$('#suggestions').fadeOut(0);
	</script>
	<?php
		if(array_key_exists('error',$_GET) and $_GET['error']=="1"){
			echo "
				<script>
				alert('¡No es trabajador o introdujo mal la cédula!');
				</script>
			";
		}
	?>
</body>
</html>
