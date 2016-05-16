<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com -------------------------------------------------------- Falta de Código de trabajador
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<head>
	<title>Cesta Juguete</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/estilo_ingresar.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/ninho.css" type="text/css"/>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){	
		$('#suggestions_nombre1').fadeOut(0);
		//Al escribr dentro del input con id="service"
		$('#nombre1').keypress(function(){
			//Obtenemos el value del input
			var nombre1 = $(this).val();		
			var dataString = 'nombre1='+nombre1;
			//Le pasamos el valor del input al ajax
			$.ajax({
				type: "POST",
				url: "nombre.php",
				data: dataString,
				success: function(data) {
					//Escribimos las sugerencias que nos manda la consulta
					$('#suggestions_nombre1').fadeIn(250).html(data);
					//Al hacer click en algua de las sugerencias
					$('.suggest-element a').live('click', function h(){
						//Obtenemos la id unica de la sugerencia pulsada
						var id = $(this).attr('id');
						//Editamos el valor del input con data de la sugerencia pulsada
						$('#nombre1').val($('#'+id).attr('data'));
						//Hacemos desaparecer el resto de sugerencias
						$('#suggestions_nombre1').fadeOut(250);
						return false;
					});              
				}
			});
		});              
	});    
	
	$(document).ready(function() {	
		$('#suggestions_nombre2').fadeOut(0);
		$('#nombre2').keypress(function(){
			var nombre2 = $(this).val();		
			var dataString = 'nombre2='+nombre2;
			$.ajax({
				type: "POST",
				url: "nombre2.php",
				data: dataString,
				success: function(data) {
					$('#suggestions_nombre2').fadeIn(250).html(data);
					$('.suggest-element2 a').live('click', function f(){
						var id = $(this).attr('id');
						$('#nombre2').val($('#'+id).attr('data'));
						$('#suggestions_nombre2').fadeOut(250);
						return false;
					});              
				}
			});
		});              
	});    
	$(document).ready(function() {	
		$('#suggestions_apellido1').fadeOut(0);
		$('#apellido1').keypress(function(){
			var apellido1 = $(this).val();		
			var dataString = 'apellido1='+apellido1;
			$.ajax({
				type: "POST",
				url: "apellido1.php",
				data: dataString,
				success: function(data) {
					$('#suggestions_apellido1').fadeIn(250).html(data);
					$('.suggest-element3 a').live('click', function f(){
						var id = $(this).attr('id');
						$('#apellido1').val($('#'+id).attr('data'));
						$('#suggestions_apellido1').fadeOut(250);
						return false;
					});              
				}
			});
		});              
	});
	
	$(document).ready(function() {	
		$('#suggestions_apellido2').fadeOut(0);
		$('#apellido2').keypress(function(){
			var apellido2 = $(this).val();		
			var dataString = 'apellido2='+apellido2;
			$.ajax({
				type: "POST",
				url: "apellido2.php",
				data: dataString,
				success: function(data) {
					$('#suggestions_apellido2').fadeIn(250).html(data);
					$('.suggest-element4 a').live('click', function f(){
						var id = $(this).attr('id');
						$('#apellido2').val($('#'+id).attr('data'));
						$('#suggestions_apellido2').fadeOut(250);
						return false;
					});              
				}
			});
		});              
	});
	</script>
	<script>
	function g(){
		$('#suggestions_nombre1').fadeOut(250);
		$('#suggestions_nombre2').fadeOut(250);
		$('#suggestions_apellido1').fadeOut(250);
		$('#suggestions_apellido2').fadeOut(250);
	}
	function ing(){
		$('#suggestions_nombre1').fadeOut(250);
	}
	function ing2(){
		$('#suggestions_nombre2').fadeOut(250);
	}
	function ing3(){
		$('#suggestions_apellido1').fadeOut(250);
	}
	function ing4(){
		$('#suggestions_apellido2').fadeOut(250);
	}
	</script>
	<script>
	function validar(frm) {
	  frm.sub.disabled = true;
	  for (i=0; i<4; i++)
		if (frm['ninho'+i].value =='') return
	  frm.sub.disabled = false;
	}
	
	</script>
	
</head>
</head>

<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor" onclick='g();'>
		
		<h3 class="n">Datos de los padres</h3><br>
		<?php
		if(array_key_exists("mp",$_GET)){
			$active=0;
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			$trb_c=$row_madpad['trb_codigo'];
			if($trb_c!=""){
				echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
				$active=1;
			}
			else{
				$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE activo='1' and trb_cedula='$mp'",$con) or die (mysql_error());
				$row_madpad=mysql_fetch_array($madpad);
				$trb_c=$row_madpad['trb_codigo'];
				if($trb_c!=""){
					$trb_c=$row_madpad['trb_codigo'];
					echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
					$active=1;
				}
			}
		}
		if(array_key_exists("pm",$_GET)){
			$pm=$_GET['pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
			else{
				$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$pm'",$con) or die (mysql_error());
				$row_madpad=mysql_fetch_array($madpad);
				$trb_c=$row_madpad['trb_codigo'];
				if($trb_c!=""){
					echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
				}
			}
		}
		if(array_key_exists("pm0",$_GET)){
			if($_GET['pm0']!="" and $_GET['pm1']!=""){
			$cedula_mp=$_GET['pm'];
			$nombre_mp=$_GET['pm0'];
			$apellido_mp=$_GET['pm1'];
			$nombre_mp=mb_strtoupper($nombre_mp,'utf-8');
			$apellido_mp=mb_strtoupper($apellido_mp,'utf-8');
			echo "<table><tr><td>V.- $cedula_mp</td><td> - $nombre_mp</td><td>$apellido_mp</td></tr></table>";
			}
			if($_GET['pm0']=="" or $_GET['pm1']==""){
			echo "<center><h2 style='color:red' >Error faltan datos</h2></center>";
			echo "<center><a href='ing_ni.php?mp=$mp&&pm=$pm' style='color:SteelBlue;text-decoration:none;font-weight:bold'>Atras</a></center>";
			echo "<script>
					$(document).ready (function ocultarVentana()
					{
					$('#formu').fadeOut(1); 
					});
				</script>";
			}
		}
		if($active==1){
		?>
		<br>
		<h3 class="n">Ingresar datos del Niño(a) <span style="color:red">(Caso Especial)</span></h3>
		<a href="./" class="n">Cancelar</a><a href='ing_mp_ce.php' class="n">Volver a iniciar</a>
		<br>
		<form action="ingr_nin_ce.php" method="post" id="formu">
			<table class="ing_ninho" >
			<tr><td>Cédula:</td> <td><input type="text" name="ninho" autocomplete=off></td></tr>
			
			<tr><td>Primer Nombre:</td> <td><input type="text" name="ninho0" id="nombre1" autocomplete=off onkeyup = 'validar(this.form)'>
					<div id="suggestions_nombre1"></div>
				</td>
			</tr>
			<tr><td>Segundo Nombre:</td> <td><input type="text" name="nombre2" id="nombre2" autocomplete=off onkeyup = 'validar(this.form)'  onfocus='ing()'>
					<div id="suggestions_nombre2"></div>
				</td>
			</tr>
			
			<tr><td>Primer Apellido:</td> <td><input type="text" name="ninho1" id="apellido1" autocomplete=off onkeyup = 'validar(this.form)' onfocus='ing2()'>
				<div id="suggestions_apellido1"></div>
				</td>
			</tr>
			
			<tr><td>Segundo Apellido:</td> <td><input type="text" name="apellido2" id="apellido2" autocomplete=off onkeyup = 'validar(this.form)' onfocus='ing3()'>
				<div id="suggestions_apellido2"></div>
				</td>
			</tr>
			
			<tr><td>Fecha:</td><td><input type="date" name="ninho2" onkeyup = 'validar(this.form)' onfocus='ing4()'></td></tr>
			
			<tr><td>Sexo:</td><td>F <input type="radio" name="ninho3" value="F" onclick = 'validar(this.form)'> M <input type="radio" name="ninho3" value="M" onclick = 'validar(this.form)'></td></tr>
			
			
			</table>
			<br>
			<?php
				if(array_key_exists("pm0",$_GET) and $_GET['pm0']!="" and $_GET['pm1']!=""){
					echo "<input type='hidden' name='nombre_mp' value='$nombre_mp'>";
					echo "<input type='hidden' name='apellido_mp' value='$apellido_mp'>";
				}
				if(array_key_exists("mp",$_GET)){
					
					echo "<input type='hidden' name='mp' value='$mp'>";
					echo "<input type='hidden' name='trb_c' value='$trb_c'>";
				}
				if(array_key_exists("pm",$_GET)){
					echo "<input type='hidden' name='pm' value='$pm'>";
				}
			?>
			<center><input type="submit" value="Registrar" name='sub' disabled='disabled'></center>
			<?php
			}
			else {
				echo "<span style='color:red; font-weight:bold'>&nbsp;&nbsp;&nbsp;&nbsp;Cédula no registrada o inactiva</span><br>";
				echo "<center><a href='ing_mp_ce.php' style='color:#c00;text-decoration:none;font-weight:bold'>Volver</a></center>";
			}
			?>
			<br>
		</form>
	</div>
</body>
</html>
