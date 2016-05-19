<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
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
			$buscar_nino_c = "SELECT * FROM cj_hijos_institutos WHERE id_ninho='$nino'";
			$buscar_nino_c = mysql_query($buscar_nino_c);
			$buc_nino = mysql_fetch_array($buscar_nino_c);
			$cedulad_nino = "";
			if($buc_nino['h_cedula']!=""){
				$cedulad_nino ="$buc_nino[h_cedula] -";
			}
			if($buc_nino['h_sexo']=='F'){
				$sexo="Femenino";
				$ninho="de la Niña";
				echo "<script>ninoa='de la niña';</script>";
			}
			
			if($buc_nino['h_sexo']=='M'){
				$sexo="Masculino";
				$ninho="del Niño";
				echo "<script>ninoa='del niño';</script>";
			}
			//~ $edad_c=CalculaEdad($buc_nino['h_fecha_naci']);
			$edad_c=a_fecha($buc_nino['h_fecha_naci']);
			$fecha_control=date("d/m/Y");
			$edad_cal = CalculaEdadMeses($edad_c, $fecha_control);
			$edad = "$edad_cal[0] años con $edad_cal[1] meses";
			
			$gsan = $buc_nino['h_gsanguineo'];
			$h_sanguineo_c = "SELECT * FROM cp_gsanguineos WHERE id_grupo_sanguineo='$gsan'";
			$h_sanguineo_c = mysql_query($h_sanguineo_c);
			$h_sanguineo = mysql_fetch_array($h_sanguineo_c);
			$gs = $h_sanguineo['nombre'];
			
			$ced_mp=$buc_nino['cedula_mp'];
			$mp_dninosql = "SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$ced_mp'";
			$mp_dninosql = mysql_query($mp_dninosql);
			$mp_dnino = mysql_fetch_array($mp_dninosql);
			
			$ced_pm=$buc_nino['cedula_pm'];
			$pm_dninosql = "SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$ced_pm'";
			$pm_dninosql = mysql_query($pm_dninosql);
			$pm_dnino = mysql_fetch_array($pm_dninosql);
			
			$ced_repr=$buc_nino['cedula_repr'];
			$repr_dninosql = "SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$ced_repr'";
			$repr_dninosql = mysql_query($repr_dninosql);
			$repr_dnino = mysql_fetch_array($repr_dninosql);
			
			echo "
			<table>
			<tr><td><a href='javascript:history.back(1)'>Volver</a></td></tr>
			<tr><td>$buc_nino[id_ninho]</td></tr>
			<tr><td>$cedulad_nino $buc_nino[h_nombre1] $buc_nino[h_nombre2] $buc_nino[h_apellido1] $buc_nino[h_apellido2]</td></tr>
			<tr><td>Fecha de nacimiento: ".a_fecha($buc_nino['h_fecha_naci'])."</td></tr>
			<tr><td>Género: $sexo</td></tr>
			<tr><td>Edad: $edad - Grupo Sanguíneo: $gs</td></tr>
			<tr><td><b>Padres:</b></td></tr>";
			if($mp_dnino['trb_cedula']!=""){
			echo "<tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='../consultas/trabajador.php?cedula=$mp_dnino[trb_cedula]'\">C.I. $mp_dnino[trb_cedula] - $mp_dnino[trb_nombres] $mp_dnino[trb_apellidos]</td></tr>";
			}
			if($mp_dnino['trb_cedula']==""){
				$ced_mp=$buc_nino['cedula_mp'];
				$mpc_dninosql = "SELECT * FROM cj_mp WHERE mp_cedula='$ced_mp'";
				$mpc_dninosql = mysql_query($mpc_dninosql);
				$mpc_dnino = mysql_fetch_array($mpc_dninosql);
				if($mpc_dnino['mp_cedula']!=""){
				echo "<tr><td>C.I. $mpc_dnino[mp_cedula] - $mpc_dnino[mp_nombre] $mpc_dnino[mp_apellido]</td></tr>";
				}
			}
			if($pm_dnino['trb_cedula']!=""){
			echo "<tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='../consultas/trabajador.php?cedula=$pm_dnino[trb_cedula]'\">C.I. $pm_dnino[trb_cedula] - $pm_dnino[trb_nombres] $pm_dnino[trb_apellidos]</td></tr>";
			}
			if($pm_dnino['trb_cedula']==""){
				$ced_pm=$buc_nino['cedula_pm'];
				$pmc_dninosql = "SELECT * FROM cj_mp WHERE mp_cedula='$ced_pm'";
				$pmc_dninosql = mysql_query($pmc_dninosql);
				$pmc_dnino = mysql_fetch_array($pmc_dninosql);
				if($pmc_dnino['mp_cedula']!=""){
				echo "<tr><td>C.I. $pmc_dnino[mp_cedula] - $pmc_dnino[mp_nombre] $pmc_dnino[mp_apellido]</td></tr>";
				}
			}
			if($repr_dnino['trb_cedula']!=""){
			echo "<tr><td><b>Representante Legal:</b></td></tr><tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='../consultas/trabajador.php?cedula=$repr_dnino[trb_cedula]'\">C.I. $repr_dnino[trb_cedula] - $repr_dnino[trb_nombres] $repr_dnino[trb_apellidos]</td></tr>";
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
		<form name="formulario" action="reg_pv_institutos.php" method="post"  onsubmit='return validar_pv(this);'>
		<table id="ins_pv">
			<?php
			$id_nino = $buc_nino['id_ninho'];
				echo "
				<input type='hidden' name='id_ninho_pv' id='id_ninho_pv' value='$id_nino'>
				<input type='hidden' name='pv_edadmeses' id='pv_edadmeses' value='$edad'>
					<tr>
						<td class='ins_pv'>Trabajador que inscribe</td>
						<td><select name='id_mp' id='id_mp'>";
							if($mp_dnino['trb_cedula']!=""){
							echo "<option value='$mp_dnino[trb_cedula]'>$mp_dnino[trb_nombres] $mp_dnino[trb_apellidos]</option>";
							}
							if($pm_dnino['trb_cedula']!=""){
								echo "<option value='$pm_dnino[trb_cedula]'>$pm_dnino[trb_nombres] $pm_dnino[trb_apellidos]</option>";
							}
							if($repr_dnino['trb_cedula']!=""){
								echo "<option value='$repr_dnino[trb_cedula]'>$repr_dnino[trb_nombres] $repr_dnino[trb_apellidos]</option>";
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
					$periodos_sql = "SELECT * FROM pv_periodo WHERE pv_añoperiodo='$pv_anioperiodo'";
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
	$sql_llenar_datos = "SELECT pv.*, h.id_ninho, b.h_gsanguineo  FROM pv_inscrip_institutos pv JOIN cj_hijos_institutos h ON pv.id_ninho_pv=h.id_ninho JOIN cj_beneficiados_institutos b ON pv.id_ninho_pv=b.id_ninho WHERE pv.id_ninho_pv='$nino' ORDER BY id_periodo DESC LIMIT 1";
			$rs_llenar_datos = mysql_query($sql_llenar_datos);
			$row= mysql_fetch_array($rs_llenar_datos);
			$num=mysql_num_rows($rs_llenar_datos);
			if ($num === 1) {
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