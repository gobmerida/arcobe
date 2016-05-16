<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>.:Editar Planilla del Plan Vacacional <?php echo date("Y");?>:.</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/ins_pv.css" type="text/css"/>
	<script language="javascript" src="../js/mayuscula.js"></script>
	<script language="JavaScript"> 
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
	
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
include("../script_php/a_fe.php");
include("../script_php/cal_edad.php");
?>
<body onload="tamanios()">
	<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
		<?php
		include("../script_php/condicion.php");
		if(array_key_exists('pn',$_GET)){
			$n_planilla = $_GET['pn'];
				$pv_planillaConsulta = "SELECT * FROM pv_planilla WHERE pv_planillanumero='$n_planilla'";
				$pv_planillaConsulta = mysql_query($pv_planillaConsulta);
				$pv_planilla = mysql_fetch_array($pv_planillaConsulta);
				$condicion = tipo_c($pv_planilla['trb_codigo']);
				if($pv_planilla['h_sexo']=='F'){
					$genero="Femenino";
					$ninhos="DE LA NIÑA";
				}
				
				if($pv_planilla['h_sexo']=='M'){
					$genero="Masculino";
					$ninhos="DEL NIÑO";
				}
			$nino=$pv_planilla['id_ninho_pv'];
			if($_SESSION['rol_ingreso']!="1"){
				header("location:nino.php?nino=$nino&&error=1");
			}
			$buscar_nino_c = "SELECT * FROM cj_hijos WHERE id_ninho='$nino'";
			$buscar_nino_c = mysql_query($buscar_nino_c);
			$buc_nino = mysql_fetch_array($buscar_nino_c);
			$cedulad_nino = "";
			if($buc_nino['h_cedula']!=""){
				$cedulad_nino ="$buc_nino[h_cedula] -";
			}
			if($buc_nino['h_sexo']=='F'){
				$sexo="Femenino";
				$ninho="de la Niña";
			}
			
			if($buc_nino['h_sexo']=='M'){
				$sexo="Masculino";
				$ninho="del Niño";
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
			$mp_dninosql = "SELECT * FROM cj_trabajadores WHERE trb_cedula='$ced_mp'";
			$mp_dninosql = mysql_query($mp_dninosql);
			$mp_dnino = mysql_fetch_array($mp_dninosql);
			
			$ced_pm=$buc_nino['cedula_pm'];
			$pm_dninosql = "SELECT * FROM cj_trabajadores WHERE trb_cedula='$ced_pm'";
			$pm_dninosql = mysql_query($pm_dninosql);
			$pm_dnino = mysql_fetch_array($pm_dninosql);
			
			$ced_repr=$buc_nino['cedula_repr'];
			$repr_dninosql = "SELECT * FROM cj_trabajadores WHERE trb_cedula='$ced_repr'";
			$repr_dninosql = mysql_query($repr_dninosql);
			$repr_dnino = mysql_fetch_array($repr_dninosql);
			
			echo "
			<table>
			<tr><td><a href='javascript:history.back(1)'>Cancelar</a></td></tr>
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
		if(!array_key_exists('pn',$_GET)){
			header("location:../consultas/b_nino.php?error=2");
		}
		?>
		<form action="ed_pl.php" method="post">
		<table id="ins_pv">
			<?php
			$id_ninho = $buc_nino['id_ninho'];
			$id_ins = $pv_planilla['id_ins'];
			$pv_planillanumero = $pv_planilla['pv_planillanumero'];
				echo "
				<input type='hidden' name='edad_ni' id='edad_ni' value='$edad'>
				<input type='hidden' name='id_ninho' id='id_ninho' value='$id_ninho'>
				<input type='hidden' name='id_ins' id='id_ins' value='$id_ins'>
				<input type='hidden' name='pv_planillanumero' id='pv_planillanumero' value='$pv_planillanumero'>
					<tr>
						<td class='ins_pv'>Trabajador que inscribe</td>
						<td><select name='id_mp' id='id_mp'>";
							if($mp_dnino['trb_cedula']!=""){
								if($pv_planilla['trb_cedula']==$mp_dnino['trb_cedula']){
									echo "<option value='$mp_dnino[trb_cedula]' selected>$mp_dnino[trb_nombres] $mp_dnino[trb_apellidos]</option>";
								}
								if($pv_planilla['trb_cedula']!=$mp_dnino['trb_cedula']){
									echo "<option value='$mp_dnino[trb_cedula]'>$mp_dnino[trb_nombres] $mp_dnino[trb_apellidos]</option>";
								}
							}
							if($pm_dnino['trb_cedula']!=""){
								if($pv_planilla['trb_cedula']==$pm_dnino['trb_cedula']){
									echo "<option value='$pm_dnino[trb_cedula]' selected>$pm_dnino[trb_nombres] $pm_dnino[trb_apellidos]</option>";
								}
								if($pv_planilla['trb_cedula']!=$pm_dnino['trb_cedula']){
									echo "<option value='$pm_dnino[trb_cedula]'>$pm_dnino[trb_nombres] $pm_dnino[trb_apellidos]</option>";
								}
							}
							if($repr_dnino['trb_cedula']!=""){
								if($pv_planilla['trb_cedula']==$repr_dnino['trb_cedula']){
									echo "<option value='$repr_dnino[trb_cedula]'>$repr_dnino[trb_nombres] $repr_dnino[trb_apellidos]</option>";
								}
								if($pv_planilla['trb_cedula']!=$repr_dnino['trb_cedula']){
									echo "<option value='$repr_dnino[trb_cedula]' selected>$repr_dnino[trb_nombres] $repr_dnino[trb_apellidos]</option>";
								}
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
					while($destinos = mysql_fetch_array($desti_c)){
						if($pv_planilla['pv_destino']==$destinos['pv_destino']){
							echo "<option value='$destinos[id_destino]' selected>$destinos[pv_destino]</option>";
						}
						if($pv_planilla['pv_destino']!=$destinos['pv_destino']){
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
			<td><select name="h_gsanguineo" id="h_gsanguineo">
					<?php
					$gs_sang = "SELECT * FROM cp_gsanguineos";
					$gs_sang = mysql_query($gs_sang);
					while($gs_sangc = mysql_fetch_array($gs_sang)){
						if($pv_planilla['nombre']==$gs_sangc['nombre']){
							echo "<option value='$gs_sangc[id_grupo_sanguineo]' selected>$gs_sangc[nombre]</option>";
						}
						if($pv_planilla['nombre']!=$gs_sangc['nombre']){
							echo "<option value='$gs_sangc[id_grupo_sanguineo]'>$gs_sangc[nombre]</option>";
						}
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
			<td><textarea name="pv_habilidades" id="pv_habilidades" placeholder="Ingrese las habilidades <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_habilidades'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Fotos</td>
			<?php
			if($pv_planilla['pv_fotos']==""){
			?>
			<td><input type="checkbox" name="pv_fotos" id="pv_fotos" value="Si" > Si</td>
			<?php
			}
			if($pv_planilla['pv_fotos']=="Si"){
				echo "<td><input type='checkbox' name='pv_fotos' id='pv_fotos' value='Si' checked> Si</td>";
			}
			?>
		</tr>
		<tr>
			<td class="ins_pv">Certificado de Niño Sano</td>
			<?php
			if($pv_planilla['pv_certificado']==""){
			?>
			<td><input type="checkbox" name="pv_certificado" id="pv_certificado" value="Si"> Si</td>
			<?php
			}
			if($pv_planilla['pv_certificado']=="Si"){
				echo "<td><input type='checkbox' name='pv_certificado' id='pv_certificado' value='Si' checked> Si</td>";
			}
			?>
		</tr>
		<tr>
			<td class="ins_pv">Gustos</td>
			<td><textarea name="pv_gustos" id="pv_gustos" placeholder="Ingrese los gustos <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_gustos'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Vacunas</td>
			<td><textarea name="pv_vacunas" id="pv_vacunas" placeholder="Ingrese las vacunas <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_vacunas'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Alergias</td>
			<td><textarea name="pv_alergias" id="pv_alergias" placeholder="Ingrese las alergias <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_alergias'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Tratamiento Actual</td>
			<td><textarea name="pv_tratamiento" id="pv_tratamiento" placeholder="Ingrese el tratamiento actual <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_tratamiento'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Alimentos Prohibidos</td>
			<td><textarea name="pv_alimentosp" id="pv_alimentosp" placeholder="Ingrese los alimentos prohibidos <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_alimentosp'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Medicamentos Prohibidos</td>
			<td><textarea name="pv_medicamentosp" id="pv_medicamentosp" placeholder="Ingrese los medicamentos prohibidos <?php echo $ninho?> o adolescente" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_medicamentosp'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv">Talla de chaqueta</td>
			<td>
				<select name="pv_tchaqueta" id="pv_tchaqueta">
					<?php
					$t_chaqueta_c = "SELECT * FROM pv_tachaqueta";
					$t_chaqueta_c = mysql_query($t_chaqueta_c);
					while($t_chaqueta = mysql_fetch_array($t_chaqueta_c)){
						if($pv_planilla['pv_tchaqueta']==$t_chaqueta['pv_tchaqueta']){
							echo "<option value='$t_chaqueta[id_talla]' selected>$t_chaqueta[pv_tchaqueta]</option>";
						}
						if($pv_planilla['pv_tchaqueta']!=$t_chaqueta['pv_tchaqueta']){
							echo "<option value='$t_chaqueta[id_talla]'>$t_chaqueta[pv_tchaqueta]</option>";
						}
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
						if($pv_planilla['pv_tfranela']==$t_franela['pv_tfranela']){
							echo "<option value='$t_franela[id_talla]' selected>$t_franela[pv_tfranela]</option>";
						}
						if($pv_planilla['pv_tfranela']!=$t_franela['pv_tfranela']){
							echo "<option value='$t_franela[id_talla]'>$t_franela[pv_tfranela]</option>";
						}
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
						if($pv_planilla['pv_tmono']==$t_mono['pv_tmono']){
							echo "<option value='$t_mono[id_talla]' selected>$t_mono[pv_tmono]</option>";
						}
						if($pv_planilla['pv_tmono']!=$t_mono['pv_tmono']){
							echo "<option value='$t_mono[id_talla]'>$t_mono[pv_tmono]</option>";
						}
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
						if($pv_planilla['pv_tgorra']==$t_gorra['pv_tgorra']){
							echo "<option value='$t_gorra[id_talla]' selected>$t_gorra[pv_tgorra]</option>";
						}
						if($pv_planilla['pv_tgorra']!=$t_gorra['pv_tgorra']){
							echo "<option value='$t_gorra[id_talla]'>$t_gorra[pv_tgorra]</option>";
						}
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
			<td><input type="text" name="pv_contacto_cedula" id="pv_contacto_cedula" class="tam" autocomplete=off value="<?php echo $pv_planilla['pv_contacto_cedula'];?>" onKeyUp="upperCase(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Nombres</td>
			<td><input type="text" name="pv_contacto_nombre" id="pv_contacto_nombre" class="tam" autocomplete=off value="<?php echo $pv_planilla['pv_contacto_nombre'];?>" onKeyUp="upperCase(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Apellidos</td>
			<td><input type="text" name="pv_contacto_apellido" id="pv_contacto_apellido" class="tam" autocomplete=off value="<?php echo $pv_planilla['pv_contacto_apellido'];?>" onKeyUp="upperCase(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Teléfonos</td>
			<td><input type="text" name="pv_contacto_telefono" id="pv_contacto_telefono" class="tam" autocomplete=off value="<?php echo $pv_planilla['pv_contacto_telefono'];?>" onKeyUp="upperCase(this)"></td>
		</tr>
		<tr>
			<td class="ins_pv">Parentesco</td>
			<td>
				<select name="pv_contacto_parentesco" id="pv_contacto_parentesco">
					<?php
					$parentesco_c = "SELECT * FROM pv_parentesco";
					$parentesco_c = mysql_query($parentesco_c);
					while($parentesco = mysql_fetch_array($parentesco_c)){
						if($pv_planilla['pv_parentesco']==$parentesco['pv_parentesco']){
							echo "<option value='$parentesco[id_parentesco]' selected>$parentesco[pv_parentesco]</option>";
						}
						if($pv_planilla['pv_parentesco']!=$parentesco['pv_parentesco']){
							echo "<option value='$parentesco[id_parentesco]'>$parentesco[pv_parentesco]</option>";
						}
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="ins_pv">Observaciones</td>
			<td><textarea placeholder="Observaciones" name="pv_observaciones" id="pv_observaciones" maxlength="300" onKeyUp="upperCase(this)"><?php echo $pv_planilla['pv_observaciones'];?></textarea></td>
		</tr>
		<tr>
			<td class="ins_pv" colspan=2><input type="submit" value="Guardar"></td>
		</tr>
		</table>
		</form>
		<br>
	</div>
</body>
</html>
