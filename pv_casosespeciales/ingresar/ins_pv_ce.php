<!--Autor s
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php date_default_timezone_set('UTC'); //acomodar sona horaria del sistema ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>.:Inscripción Plan Vacacional <?php echo date("Y");?>:.</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../../estilo/ins_pv.css" type="text/css"/>
	<script language="javascript" src="../../js/mayuscula.js"></script>
	<script language="javascript" src="../../js/jquery-1.10.2.js"></script>
	<script language="javascript" src="../../js/prevenir.js"></script>
</head>
<?php
include("../../connect/conexion.php");
include("../../sesion/sesion.php");
include("../../script_php/a_fe.php");
include("../../script_php/cal_edad.php");
?>
<body onload="tamanios()">
	<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
		<h3 align='center'>.:Inscripción Plan Vacacional <?php echo date("Y");?>:.</h3>
		<?php
		if(array_key_exists('nino',$_GET)){

			$nino=$_GET['nino'];
			$buscar_nino_c = "SELECT * FROM pv_hijos_ce WHERE id_nino='$nino'";
			$buscar_nino_c = mysql_query($buscar_nino_c);
			$buc_nino = mysql_fetch_array($buscar_nino_c);
			$cedulad_nino = "";

			if($buc_nino['ci_nino']!=""){
				$cedulad_nino ="$buc_nino[ci_nino] -";
			}
			if($buc_nino['sexo_nino']=='F'){
				$sexo="Femenino";
				$ninho="de la Niña";
				echo "<script>ninoa='de la niña';</script>";
			}
			
			if($buc_nino['sexo_nino']=='M'){
				$sexo="Masculino";
				$ninho="del Niño";
				echo "<script>ninoa='del niño';</script>";
			}
			//~ $edad_c=CalculaEdad($buc_nino['h_fecha_naci']);
			$edad_c=a_fecha($buc_nino['fecha_naci']);
			$fecha_control=date("d/m/Y");
			$edad_cal = CalculaEdadMeses($edad_c, $fecha_control);
			$edad = "$edad_cal[0] años con $edad_cal[1] meses";
			
			$gsan = $buc_nino['Gsangueneo'];
			$h_sanguineo_c = "SELECT * FROM cp_gsanguineos WHERE id_grupo_sanguineo='$gsan'";
			$h_sanguineo_c = mysql_query($h_sanguineo_c);
			$h_sanguineo = mysql_fetch_array($h_sanguineo_c);
			$gs = $h_sanguineo['nombre'];
			
			$ced_mp=$buc_nino['cedula_padre'];
			$mp_dninosql = "SELECT * FROM pv_trabajadores_ce WHERE ci_trab='$ced_mp'";
			$mp_dninosql = mysql_query($mp_dninosql);
			$mp_dnino = mysql_fetch_array($mp_dninosql);
			
			
			echo "
			<table>
			<tr><td><a href='javascript:history.back(1)'>Volver</a></td></tr>
			<tr><td>$buc_nino[id_nino]</td></tr>
			<tr><td>$cedulad_nino $buc_nino[nombre1_nino] $buc_nino[nombre2_nino] $buc_nino[apellido1_nino] $buc_nino[apellido2_nino]</td></tr>
			<tr><td>Fecha de nacimiento: ".a_fecha($buc_nino['fecha_naci'])."</td></tr>
			<tr><td>Género: $sexo</td></tr>
			<tr><td>Edad: $edad - Grupo Sanguíneo: $gs</td></tr>
			<tr><td><b>Padres:</b></td></tr>";
			if($mp_dnino['ci_trab']!=""){
			echo "<tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='../../consultas/trabajador.php?cedula=$mp_dnino[ci_trab]'\">C.I. $mp_dnino[ci_trab] - $mp_dnino[nombre_trab] $mp_dnino[apellido_trab]</td></tr>";
			}
			echo "</table>
			<br>
			";
		}
		if(!array_key_exists('nino',$_GET)){
			header("location:../consultas/b_nino.php?error=2");
		}
		?>
<!--
		<form action="reg_pv.php" method="post">
-->
		<form name="formulario" action="reg_pv_ce.php" method="post"  onsubmit='return validar_pv(this);'>
		<table id="ins_pv">
			<?php
			$id_nino = $buc_nino['id_nino'];
				echo "
				<input type='hidden' name='id_ninho_pv' id='id_ninho_pv' value='$id_nino'>
				<input type='hidden' name='pv_edadmeses' id='pv_edadmeses' value='$edad'>
					<tr>
						<td class='ins_pv'>Trabajador que inscribe</td>
						<td><select name='id_mp' id='id_mp'>";
							if($mp_dnino['ci_trab']!=""){
							echo "<option value='$mp_dnino[ci_trab]'>$mp_dnino[nombre_trab] $mp_dnino[apellido_trab]</option>";
							}
						echo "</select></td>
					</tr>
					";
			?>
		<tr>
			<td class="ins_pv">Destino</td>
			<td><select name="pv_destino" id="pv_destino">
					<?php

					$desti_c = "SELECT * FROM pv_destinos";
					$desti_c = mysql_query($desti_c);
					$pv_anioperiodo = date("Y");
					$periodos_sql = "SELECT * FROM pv_periodo_ce WHERE pv_añoperiodo='$pv_anioperiodo'";
					$periodos_sql = mysql_query($periodos_sql);
					$periodos_act = mysql_fetch_array($periodos_sql);
					while($destinos = mysql_fetch_array($desti_c)){
						if($edad_cal[0]<11 and $destinos['id_destino']=='2'){
							echo "<option value='$destinos[id_destino]' selected>$destinos[pv_destino] (Recomendado)</option>";
						}
						if($edad_cal[0]<11 and $destinos['id_destino']=='1'){
							echo "<option value='$destinos[id_destino]'>$destinos[pv_destino]</option>";
						}
						if($edad_cal[0]>=11 and $destinos['id_destino']=='1'){
							echo "<option value='$destinos[id_destino]' selected>$destinos[pv_destino] (Recomendado)</option>";
						}
						if($edad_cal[0]>=11 and $destinos['id_destino']=='2'){
							echo "<option value='$destinos[id_destino]'>$destinos[pv_destino]</option>";
						}
					}
					?>
				</select></td>
		</tr>
		<?php
		if($gs=='Actualizar'){
		?>
		<tr>
			<td class="ins_pv">Grupo Sanguíneo</td>
			<td><select name="h_gsanguineo" id="h_gsanguineo" onchange="resetEst(this)">
					<?php
					$desti_c = "SELECT * FROM cp_gsanguineos";
					$desti_c = mysql_query($desti_c);
					while($destinos = mysql_fetch_array($desti_c)){
						echo "
						<option value='$destinos[id_grupo_sanguineo]'>$destinos[nombre]</option>
						";
					}
					?>
				</select></td>
		</tr>
		<?php
		}
		
		?>
		<tr>
			<td class="ins_pv">Habilidades</td>
<!--
			<td><textarea placeholder="Ingrese las habilidades <?php echo $ninho?> o adolescente" onmouseover='style.border = "1px ridge cyan"' onmouseout='style.border = "1px ridge black"'></textarea></td>
-->
			<td><textarea name="pv_habilidades" id="pv_habilidades" placeholder="Ingrese las habilidades <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Fotos</td>
			<td id="fotos_ch"><input type="checkbox" name="pv_fotos" id="pv_fotos" value="Si" onclick="resetEstch('#fotos_ch')"> Si</td>
		</tr>
		<tr>
			<td class="ins_pv">Certificado de Niño Sano</td>
			<td id="certificado_ch"><input type="checkbox" name="pv_certificado" id="pv_certificado" value="Si" onclick="resetEstch('#certificado_ch')"> Si</td>
		</tr>
		<tr>
			<td class="ins_pv">Gustos</td>
			<td><textarea name="pv_gustos" id="pv_gustos" placeholder="Ingrese los gustos <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Vacunas</td>
			<td><textarea name="pv_vacunas" id="pv_vacunas" placeholder="Ingrese las vacunas <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Alergias</td>
			<td><textarea name="pv_alergias" id="pv_alergias" placeholder="Ingrese las alergias <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Tratamiento Actual</td>
			<td><textarea name="pv_tratamiento" id="pv_tratamiento" placeholder="Ingrese el tratamiento actual <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Alimentos Prohibidos</td>
			<td><textarea name="pv_alimentosp" id="pv_alimentosp" placeholder="Ingrese los alimentos prohibidos <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Medicamentos Prohibidos</td>
			<td><textarea name="pv_medicamentosp" id="pv_medicamentosp" placeholder="Ingrese los medicamentos prohibidos <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this);resetEst(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Talla de chaqueta</td>
			<td>
				<select name="pv_tchaqueta" id="pv_tchaqueta" onchange="resetEst(this)">
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
				<select name="pv_tfranela" id="pv_tfranela" onchange="resetEst(this)">
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
				<select name="pv_tmono" id="pv_tmono" onchange="resetEst(this)">
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
				<select name="pv_tgorra" id="pv_tgorra" onchange="resetEst(this)">
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
			<td><input type="text" name="pv_contacto_cedula" id="pv_contacto_cedula" class="tam" autocomplete=off onKeyUp="upperCase(this);resetEstc(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Nombres</td>
			<td><input type="text" name="pv_contacto_nombre" id="pv_contacto_nombre" class="tam" autocomplete=off onKeyUp="upperCase(this);resetEstc(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Apellidos</td>
			<td><input type="text" name="pv_contacto_apellido" id="pv_contacto_apellido" class="tam" autocomplete=off onKeyUp="upperCase(this);resetEstc(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Teléfonos</td>
			<td><input type="text" name="pv_contacto_telefono" id="pv_contacto_telefono" class="tam" autocomplete=off onKeyUp="upperCase(this);resetEstc(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Parentesco</td>
			<td>
				<select name="pv_contacto_parentesco" id="pv_contacto_parentesco" onchange="resetEst(this)">
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
			<td><textarea placeholder="Observaciones" name="pv_observaciones" id="pv_observaciones" maxlength="300" onKeyUp="upperCase(this)"></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv"><input type="reset" name="limpiar" value="Resetear"/></td><td class="ins_pv"><input type="submit" value="Inscribir" id="inscri"></td>
		</tr>
		</table>
		</form>
		<br>
	</div>
</body>
</html>
<?php
	//Traerse los datos si ya estaba inscrito en años anteriores
	$sql_llenar_datos = "SELECT pv.*, h.id_ninho, b.h_gsanguineo  FROM pv_inscrip pv JOIN cj_hijos h ON pv.id_ninho_pv=h.id_ninho JOIN cj_beneficiados b ON pv.id_ninho_pv=b.id_ninho WHERE pv.id_ninho_pv='$nino' ORDER BY id_periodo DESC LIMIT 1";
			$rs_llenar_datos = mysql_query($sql_llenar_datos);
			$num=mysql_num_rows($rs_llenar_datos);
			if ($num === 1) {
				$row= mysql_fetch_array($rs_llenar_datos);
				echo"<script>
						(function(){
							formulario.pv_habilidades.value='".$row["pv_habilidades"]."';
							formulario.pv_gustos.value='".$row["pv_gustos"]."';
							formulario.pv_vacunas.value='".$row["pv_vacunas"]."';
							formulario.pv_alergias.value='".$row["pv_alergias"]."';
							formulario.pv_tratamiento.value='".$row["pv_tratamiento"]."';
							formulario.pv_alimentosp.value='".$row["pv_alimentosp"]."';
							formulario.pv_medicamentosp.value='".$row["pv_medicamentosp"]."';
							formulario.pv_contacto_cedula.value='".$row["pv_contacto_cedula"]."';
							formulario.pv_contacto_nombre.value='".$row["pv_contacto_nombre"]."';
							formulario.pv_contacto_apellido.value='".$row["pv_contacto_apellido"]."';
							formulario.pv_contacto_telefono.value='".$row["pv_contacto_telefono"]."';
							formulario.pv_contacto_parentesco.selectedIndex=".$row["pv_contacto_parentesco"]." -1;
							formulario.pv_observaciones.value='".$row["pv_observaciones"]."';
							

				
						})();
					</script>";
			}
?>
