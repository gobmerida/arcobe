<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/estilo_ingresar.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/ninho.css" type="text/css"/>
	<script src="../js/calendario/jquery-1.10.2.js"></script>
	<script src="../js/calendario/jquery-ui.js"></script>
	<script src="../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css">
	<link rel="stylesheet" href="../js/calendario/date.css">
	<script language="javascript" src="../js/mayuscula.js"></script>
	<script language="javascript" src="../js/delimitar.js"></script>
	<script>
	function validar(frm) {
	  frm.sub.disabled = true;
	  for (i=0; i<5; i++)
		if (frm['ninho'+i].value =='') return
	  frm.sub.disabled = false;
	}
	$(function() {
		$( "#datepicker" ).datepicker({
		changeMonth: true, // Mostrar el mes
		changeYear: true, // Poder cambiar el año
		showOtherMonths: true, //Mostrar cuadrilcula
		showButtonPanel: true // Mostrar botones
		});
		});
		function fca(){
			$('#ui-datepicker-div').fadeOut(250);
		}
	</script>
	<style>
	input{
		text-transform: uppercase;
	}
	</style>
</head>
</head>

<body>
	<div id="cabecera_ini"></div>
	<div id="contenedor" onclick='g();'>
		
		<h3 class="n">Datos de los padres</h3><br>
		<?php
		if(array_key_exists("mp",$_GET)){
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM pv_trabajadores_ce WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			$trb_c=$row_madpad['trb_codigo'];
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
		}
		?>
		<br>
		<h3 class="n">Ingresar datos del Niño(a)</h3>
		<a href="../" class="n">Cancelar</a><a href='ing_mp.php' class="n">Volver a iniciar</a>
		<br>
		<form action="ingr_nin_ce.php" method="post" id="formu">
			<table class="ing_ninho" >
			<tr><td>Cédula:</td> <td><input type="text" name="ninho" autocomplete=off onkeypress="return permite(event, 'num')"></td></tr>
			
			<tr><td>Primer Nombre:</td> <td><input type="text" name="ninho0" id="nombre1" autocomplete=off onkeyup = 'validar(this.form);upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			<tr><td>Segundo Nombre:</td> <td><input type="text" name="nombre2" id="nombre2" autocomplete=off onkeyup = 'validar(this.form);upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Primer Apellido:</td> <td><input type="text" name="ninho1" id="apellido1" autocomplete=off onkeyup = 'validar(this.form);upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Segundo Apellido:</td> <td><input type="text" name="apellido2" id="apellido2" autocomplete=off onkeyup = 'validar(this.form);upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Fecha:</td><td><input type="text" class='datepicker' id='datepicker' name="ninho2" onChange='fca()' onkeyup = 'validar(this.form)' onfocus='ing4()' placeholder='dia/mes/año' autocomplete=off></td></tr>
			
			
			<tr><td>Grupo Sanguíneo:</td><td>
			<?php
			$gsanguineo_c = "SELECT * FROM cp_gsanguineos";
			$gsanguineo_c = mysql_query($gsanguineo_c);
			echo "<select name='ninho4' id='ninho4'>
			<option value=''>Ingresar</option>
			";
			while($gsanguineo = mysql_fetch_array($gsanguineo_c)){
				echo "
				<option value='$gsanguineo[id_grupo_sanguineo]' onclick = 'validar(this.form)'>$gsanguineo[nombre]</option>";
			}
			echo "</select>";
			?>
			</td></tr>
			<tr><td>Género:</td><td>F <input type="radio" name="ninho3" value="F" onclick = 'validar(this.form)'> M <input type="radio" name="ninho3" value="M" onclick = 'validar(this.form)'></td></tr>
			</table>
			<br>
			<input type='hidden' name='mp' value="<?php echo $mp; ?>">
			<center><input type="submit" value="Registrar" name='sub' disabled='disabled' onclick="this.disabled=true;this.value='Registrando...';this.form.submit()"></center>
			<br>
		</form>
	</div>
</body>
</html>
