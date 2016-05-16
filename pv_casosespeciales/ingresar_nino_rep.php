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
	<link rel="shortcut icon" href="../media/icono.png" type="image/ico" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/estilo_ingresar.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/ninho.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/ins_pv.css" type="text/css"/>
	<script src="../js/calendario/jquery-1.10.2.js"></script>
	<script src="../js/calendario/jquery-ui.js"></script>
	<script src="../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css">
	<link rel="stylesheet" href="../js/calendario/date.css">
	<script language="javascript" src="../js/mayuscula.js"></script>
	<script language="javascript" src="../js/delimitar.js"></script>
	<script>
	$(function(){
		$( "#h_fecha_naci" ).datepicker({
		changeMonth: true, // Mostrar el mes
		changeYear: true, // Poder cambiar el año
		showOtherMonths: true, //Mostrar cuadrilcula
		showButtonPanel: true // Mostrar botones
		});
		});
		function fca(){
			$('#ui-datepicker-div').fadeOut(250);
		}
	function tamanios(){
			for(m=0;m<document.forms[0].elements.length;m++){
				if(document.forms[0].elements[m].type=="text"){
					//~ Tamaño del imput - document.forms[0].elements[m].size=35
					//~ document.forms[0].elements[m].size=35
					//~ Máximo de caracteres en el input - document.forms[0].elements[m].maxLength=200
					document.forms[0].elements[m].maxLength=200
				}
				if(document.forms[0].elements[m].type=="textarea"){
					//~ Máximo de caracteres en el textarea
					document.forms[0].elements[m].maxLength=300
				}
			}
		}
	</script>
	<style>
	input{
		text-transform: uppercase;
	}
	</style>
</head>

<body onload="tamanios()">
	<div id="cabecera_ini"></div>
	<div id="contenedor" onclick='g();'>
		<h2 class="enca">Caso Especial</h2>
		<h3 class="n">Datos de los padres</h3><br>
		<?php
		if(array_key_exists("re",$_GET)){
			$re=$_GET['re'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$re' and activo='1'",$con) or die (mysql_error());
			$row_madpad_re=mysql_fetch_array($madpad);
			$trb_c=$row_madpad_re['trb_codigo'];
			echo "<table><tr><td>V.- ".$row_madpad_re['trb_cedula']."</td><td> - ".$row_madpad_re['trb_nombres']."</td><td>".$row_madpad_re['trb_apellidos']."</td></tr></table>";
		}
		if(array_key_exists("mp",$_GET)){
			echo "<h3 class=\"n\">Datos de los padres</h3><br>";
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp' and activo='1'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
			$madpad=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad1=mysql_fetch_array($madpad);
			if($row_madpad1['mp_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad1['mp_cedula']."</td><td> - ".$row_madpad1['mp_nombre']."</td><td>".$row_madpad1['mp_apellido']."</td></tr></table>";
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
		if(array_key_exists("mp0",$_GET)){
			if($_GET['mp0']!="" and $_GET['mp1']!=""){
			$cedula_pm=$_GET['mp'];
			$nombre_pm=$_GET['mp0'];
			$apellido_pm=$_GET['mp1'];
			$nombre_pm=mb_strtoupper($nombre_pm,'utf-8');
			$apellido_pm=mb_strtoupper($apellido_pm,'utf-8');
			echo "<table><tr><td>V.- $cedula_pm</td><td> - $nombre_pm</td><td>$apellido_pm</td></tr></table>";
			}
			if(array_key_exists("pm0",$_GET)){
			if($_GET['pm0']=="" or $_GET['pm1']==""){
			echo "<center><h2 style='color:red' >Error faltan datos</h2></center>";
			echo "<center><a href='ing_ni.php?mp=$mp&&pm=$pm' style='color:SteelBlue;text-decoration:none;font-weight:bold'>Atras</a></center>";
			echo "<script>
					$(document).ready (function ocultarVentana()
					{
					$('#formu').fadeOut(1); 
					});
				</script>";
			}}
		}
		if(array_key_exists("pm",$_GET)){
			$pm=$_GET['pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$pm' and activo='1'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
			$madpad=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['mp_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad['mp_cedula']."</td><td> - ".$row_madpad['mp_nombre']."</td><td>".$row_madpad['mp_apellido']."</td></tr></table>";
			}
		}
		
		?>
		<br>
		<h3 class="n">Ingresar datos del Beneficiario(a)</h3>
		<a href="./" class="n">Cancelar</a><a href='ing_mp.php' class="n">Volver a iniciar</a>
		<br>
		<form action="ingr_ni_re.php" method="post" id="formu">
			<table class="lol" >
			<tr><td>Cédula:</td> <td><input type="text" name="h_cedula" id="h_cedula" autocomplete=off onkeypress="return permite(event, 'num')"></td></tr>
			
			<tr><td>Primer Nombre:</td> <td><input type="text" name="h_nombre1" id="h_nombre1" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			<tr><td>Segundo Nombre:</td> <td><input type="text" name="h_nombre2" id="h_nombre2" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Primer Apellido:</td> <td><input type="text" name="h_apellido1" id="h_apellido1" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Segundo Apellido:</td> <td><input type="text" name="h_apellido2" id="h_apellido2" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Fecha:</td><td><input type="text" class='datepicker' id='h_fecha_naci' name="h_fecha_naci" onChange='fca()' readonly='readonly' onfocus='ing4()' placeholder='dia/mes/año' autocomplete=off></td></tr>
			
			
			<tr><td>Grupo Sanguíneo:</td><td>
			<?php
			$gsanguineo_c = "SELECT * FROM cp_gsanguineos";
			$gsanguineo_c = mysql_query($gsanguineo_c);
			echo "<select name='h_gsanguineo' id='h_gsanguineo'>
			<option value=''>Ingresar</option>
			";
			while($gsanguineo = mysql_fetch_array($gsanguineo_c)){
				echo "
				<option value='$gsanguineo[id_grupo_sanguineo]' >$gsanguineo[nombre]</option>";
			}
			echo "</select>";
			?>
			</td></tr>
			<tr><td>Género:</td><td>
				<select name="h_sexo" id="h_sexo">
					<option value="">Seleccionar</option>
					<option value="F">Femenino</option>
					<option value="M">Másculino</option>
				</select>
				</td></tr>
			</table>
			<br>
			<?php
				if(array_key_exists("pm0",$_GET) and $_GET['pm0']!="" and $_GET['pm1']!=""){
					echo "<input type='hidden' name='nombre_mp' value='$nombre_mp'>";
					echo "<input type='hidden' name='apellido_mp' value='$apellido_mp'>";
				}
				if(array_key_exists("mp0",$_GET) and $_GET['mp0']!="" and $_GET['mp1']!=""){
					echo "<input type='hidden' name='nombre_pm' value='$nombre_pm'>";
					echo "<input type='hidden' name='apellido_pm' value='$apellido_pm'>";
				}
				if(array_key_exists("re",$_GET)){
					echo "<input type='hidden' name='re' value='$re'>";
					echo "<input type='hidden' name='trb_c' value='$trb_c'>";
				}
				if(array_key_exists("mp",$_GET)){
					echo "<input type='hidden' name='mp' value='$mp'>";
				}
				if(array_key_exists("pm",$_GET)){
					echo "<input type='hidden' name='pm' value='$pm'>";
				}
			?>
			<h3 align='center'>.:Inscripción Plan Vacacional <?php echo date("Y");?>:.</h3>
			<table id="ins_pv">
		<tr>
			<td class="ins_pv">Destino</td>
			<td><select name="pv_destino" id="pv_destino">
					<?php
					$desti_c = "SELECT * FROM pv_destinos";
					$desti_c = mysql_query($desti_c);
					$pv_anioperiodo = date("Y");
					$periodos_sql = "SELECT * FROM pv_periodo WHERE pv_añoperiodo='$pv_anioperiodo'";
					$periodos_sql = mysql_query($periodos_sql);
					$periodos_act = mysql_fetch_array($periodos_sql);
					while($destinos = mysql_fetch_array($desti_c)){
							echo "<option value='$destinos[id_destino]'>$destinos[pv_destino] </option>";
					}
					?>
				</select></td>
		</tr>
		
		<tr>
			<td class="ins_pv">Habilidades</td>
			<td><textarea name="pv_habilidades" id="pv_habilidades" placeholder="Ingrese las habilidades Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Fotos</td>
			<td><input type="checkbox" name="pv_fotos" id="pv_fotos" value="Si"> Si</td>
		</tr>
		<tr>
			<td class="ins_pv">Certificado de Niño Sano</td>
			<td><input type="checkbox" name="pv_certificado" id="pv_certificado" value="Si"> Si</td>
		</tr>
		<tr>
			<td class="ins_pv">Gustos</td>
			<td><textarea name="pv_gustos" id="pv_gustos" placeholder="Ingrese los gustos Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Vacunas</td>
			<td><textarea name="pv_vacunas" id="pv_vacunas" placeholder="Ingrese las vacunas Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Alergias</td>
			<td><textarea name="pv_alergias" id="pv_alergias" placeholder="Ingrese las alergias Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Tratamiento Actual</td>
			<td><textarea name="pv_tratamiento" id="pv_tratamiento" placeholder="Ingrese el tratamiento actual Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Alimentos Prohibidos</td>
			<td><textarea name="pv_alimentosp" id="pv_alimentosp" placeholder="Ingrese los alimentos prohibidos Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Medicamentos Prohibidos</td>
			<td><textarea name="pv_medicamentosp" id="pv_medicamentosp" placeholder="Ingrese los medicamentos prohibidos Beneficiario o adolescente" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Talla de chaqueta</td>
			<td>
				<select name="pv_tchaqueta" id="pv_tchaqueta">
					<?php
					$t_chaqueta_c = "SELECT * FROM pv_tachaqueta";
					$t_chaqueta_c = mysql_query($t_chaqueta_c);
					while($t_chaqueta = mysql_fetch_array($t_chaqueta_c)){
						echo "<option value='$t_chaqueta[id_talla]'>$t_chaqueta[pv_tchaqueta]</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="ins_pv">Talla de Franela</td>
			<td>
				<select name="pv_tfranela" id="pv_tfranela">
					<?php
					$t_franela_c = "SELECT * FROM pv_tallafranela";
					$t_franela_c = mysql_query($t_franela_c);
					while($t_franela = mysql_fetch_array($t_franela_c)){
						echo "<option value='$t_franela[id_talla]'>$t_franela[pv_tfranela]</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="ins_pv">Talla de Mono</td>
			<td>
				<select name="pv_tmono" id="pv_tmono">
					<?php
					$t_mono_c = "SELECT * FROM pv_tmono";
					$t_mono_c = mysql_query($t_mono_c);
					while($t_mono = mysql_fetch_array($t_mono_c)){
						echo "<option value='$t_mono[id_talla]'>$t_mono[pv_tmono]</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="ins_pv">Talla de Gorra</td>
			<td>
				<select name="pv_tgorra" id="pv_tgorra">
					<?php
					$t_gorra_c = "SELECT * FROM pv_tgorra";
					$t_gorra_c = mysql_query($t_gorra_c);
					while($t_gorra = mysql_fetch_array($t_gorra_c)){
						echo "<option value='$t_gorra[id_talla]'>$t_gorra[pv_tgorra]</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan=2><b>Datos del contacto</b></td>
		</tr>
		<tr>
			<td class="ins_pv">Cédula</td>
			<td><input type="text" name="pv_contacto_cedula" id="pv_contacto_cedula" class="tam" autocomplete=off onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num')"></td>
		</tr>
		<tr>
			<td class="ins_pv">Nombres</td>
			<td><input type="text" name="pv_contacto_nombre" id="pv_contacto_nombre" class="tam" autocomplete=off onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></td>
		</tr>
		<tr>
			<td class="ins_pv">Apellidos</td>
			<td><input type="text" name="pv_contacto_apellido" id="pv_contacto_apellido" class="tam" autocomplete=off onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></td>
		</tr>
		<tr>
			<td class="ins_pv">Teléfonos</td>
			<td><input type="text" name="pv_contacto_telefono" id="pv_contacto_telefono" class="tam" autocomplete=off onKeyUp="upperCase(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Parentesco</td>
			<td>
				<select name="pv_contacto_parentesco" id="pv_contacto_parentesco">
					<?php
					$parentesco_c = "SELECT * FROM pv_parentesco";
					$parentesco_c = mysql_query($parentesco_c);
					while($parentesco = mysql_fetch_array($parentesco_c)){
						echo "<option value='$parentesco[id_parentesco]'>$parentesco[pv_parentesco]</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="ins_pv">Observaciones</td>
			<td><textarea placeholder="Observaciones" name="pv_observaciones" id="pv_observaciones" maxlength="300" onKeyUp="upperCase(this)" onkeypress="return permite(event, 'num_car')"></textarea></td>
		</tr>
		</table><br>
			<center><input type="submit" value="Registrar" name='sub' onclick="this.disabled=true;this.value='Registrando...';this.form.submit()"></center>
			<br>
		</form>
	</div>
</body>
</html>
