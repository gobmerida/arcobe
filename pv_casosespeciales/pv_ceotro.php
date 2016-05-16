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
				$pv_planillaConsulta = "SELECT pv_planillace.*,pvce_mpr.*,cp_gsanguineos.*,pv_destinos.pv_destino as destino,
											   pv_tallafranela.pv_tfranela as tfranela,pv_tachaqueta.pv_tchaqueta as tchaqueta,
											   pv_tgorra.pv_tgorra as tgorra,pv_tmono.pv_tmono as tmono,pv_periodo_ce.pv_añoperiodo,
											   pv_planillace.id as id_planilla
										   FROM pv_planillace
										   JOIN pvce_mpr
										   ON pv_planillace.cedula_trb=pvce_mpr.mpr_cedula
										   JOIN cp_gsanguineos
										   ON pv_planillace.h_gsanguineo=cp_gsanguineos.id_grupo_sanguineo
										   JOIN pv_destinos
										   ON pv_planillace.pv_destino=pv_destinos.id_destino
										   JOIN pv_tallafranela
										   ON pv_planillace.pv_tfranela=pv_tallafranela.id_talla
										   JOIN pv_tachaqueta
										   ON pv_planillace.pv_tchaqueta=pv_tachaqueta.id_talla
										   JOIN pv_tgorra
										   ON pv_planillace.pv_tgorra=pv_tgorra.id_talla
										   JOIN pv_tmono
										   ON pv_planillace.pv_tmono=pv_tmono.id_talla
										   JOIN pv_periodo_ce
										   ON pv_planillace.id_periodo=pv_periodo_ce.id_pvperiodo
										   WHERE pv_planillanumero='$n_planilla'";
				$pv_planillaConsulta = mysql_query($pv_planillaConsulta);
				$pv_planilla = mysql_fetch_array($pv_planillaConsulta);
				$condicion = tipo_c($pv_planilla['codigo_trb']);
				if($pv_planilla['h_sexo']=='F'){
					$genero="Femenino";
					$ninhos="DE LA NIÑA";
				}
				
				if($pv_planilla['h_sexo']=='M'){
					$genero="Masculino";
					$ninhos="DEL NIÑO";
				}
			$nino=$pv_planilla['id_nino'];
			if($_SESSION['rol_ingreso']!="1"){
				header("location:nino.php?nino=$nino&&error=1");
			}
			
			$cedulad_nino = "";
			if($pv_planilla['h_cedula']!=""){
				$cedulad_nino ="$pv_planilla[h_cedula] -";
			}
			if($pv_planilla['h_sexo']=='F'){
				$sexo="Femenino";
				$ninho="de la Niña";
			}
			
			if($pv_planilla['h_sexo']=='M'){
				$sexo="Masculino";
				$ninho="del Niño";
			}
			//~ $edad_c=CalculaEdad($pv_planilla['h_fecha_naci']);
			$edad_c=a_fecha($pv_planilla['h_fecha_naci']);
			$fecha_control=date("d/m/Y");
			$edad_cal = CalculaEdadMeses($edad_c, $fecha_control);
			$edad = "$edad_cal[0] años con $edad_cal[1] meses";
			
			$gsan = $pv_planilla['h_gsanguineo'];
			$h_sanguineo_c = "SELECT * FROM cp_gsanguineos WHERE id_grupo_sanguineo='$gsan'";
			$h_sanguineo_c = mysql_query($h_sanguineo_c);
			$h_sanguineo = mysql_fetch_array($h_sanguineo_c);
			$gs = $h_sanguineo['nombre'];
			
			$ced_mp=$pv_planilla['cedula_mp'];
			$mp_dninosql = "SELECT * FROM pvce_mpr WHERE mpr_cedula='$ced_mp'";
			$mp_dninosql = mysql_query($mp_dninosql);
			$mp_dnino = mysql_fetch_array($mp_dninosql);
			
			$ced_pm=$pv_planilla['cedula_pm'];
			$pm_dninosql = "SELECT * FROM pvce_mpr WHERE mpr_cedula='$ced_pm'";
			$pm_dninosql = mysql_query($pm_dninosql);
			$pm_dnino = mysql_fetch_array($pm_dninosql);
			
			$ced_repr=$pv_planilla['cedula_regis'];
			$repr_dninosql = "SELECT * FROM pvce_mpr WHERE mpr_cedula='$ced_repr'";
			$repr_dninosql = mysql_query($repr_dninosql);
			$repr_dnino = mysql_fetch_array($repr_dninosql);
			
			echo "
			<table>
			<tr><td><a href='javascript:history.back(1)'>Cancelar</a></td></tr>
			<tr><td>$pv_planilla[id_nino]</td></tr>
			<tr><td>$cedulad_nino $pv_planilla[h_nombre1] $pv_planilla[h_nombre2] $pv_planilla[h_apellido1] $pv_planilla[h_apellido2]</td></tr>
			<tr><td>Fecha de nacimiento: ".a_fecha($pv_planilla['h_fecha_naci'])."</td></tr>
			<tr><td>Género: $sexo</td></tr>
			<tr><td>Edad: $edad - Grupo Sanguíneo: $gs</td></tr>
			<tr><td><b>Padres:</b></td></tr>";
			if($mp_dnino['mpr_cedula']!=""){
			echo "<tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='persona.php?cedula=$mp_dnino[mpr_cedula]'\">C.I. $mp_dnino[mpr_cedula] - $mp_dnino[mpr_nombres] $mp_dnino[mpr_apellidos]</td></tr>";
			}
			if($pm_dnino['mpr_cedula']!=""){
			echo "<tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='persona.php?cedula=$pm_dnino[mpr_cedula]'\">C.I. $pm_dnino[mpr_cedula] - $pm_dnino[mpr_nombres] $pm_dnino[mpr_apellidos]</td></tr>";
			}
			if($repr_dnino['mpr_cedula']!=""){
			echo "<tr><td><b>Representante Legal:</b></td></tr><tr style='cursor:pointer' onmouseover='style.backgroundColor = \"gainsboro\"' onmouseout='style.backgroundColor = \"white\"'><td onclick=\"location.href='persona.php?cedula=$repr_dnino[mpr_cedula]'\">C.I. $repr_dnino[mpr_cedula] - $repr_dnino[mpr_nombres] $repr_dnino[mpr_apellidos]</td></tr>";
			}
			echo "</table>
			<br>
			";
		}
		if(!array_key_exists('pn',$_GET)){
			header("location:../consultas/b_nino.php?error=2");
		}
		?>
		<form action="ed_pv_ceotr.php" method="post">
		<table id="ins_pv">
			<?php
			$id_ninho = $pv_planilla['id_nino'];
			$id = $pv_planilla['id_planilla'];
			$pv_planillanumero = $pv_planilla['pv_planillanumero'];
				echo "
				<input type='hidden' name='id_ninho' id='id_ninho' value='$id_ninho'>
				<input type='hidden' name='id' id='id' value='$id'>
				<input type='hidden' name='pv_planillanumero' id='pv_planillanumero' value='$pv_planillanumero'>
					";
			?>
		<tr>
			<td class="ins_pv">Destino</td>
			<td><select name="pv_destino" id="pv_destino">
					<?php
					$desti_c = "SELECT * FROM pv_destinos";
					$desti_c = mysql_query($desti_c);
					while($destinos = mysql_fetch_array($desti_c)){
						if($pv_planilla['pv_destino']==$destinos['id_destino']){
							echo "<option value='$destinos[id_destino]' selected>$destinos[pv_destino]</option>";
						}
						if($pv_planilla['pv_destino']!=$destinos['id_destino']){
							echo "<option value='$destinos[id_destino]'>$destinos[pv_destino]</option>";
						}
					}
					?>
				</select></td>
		</tr>
		
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
						if($pv_planilla['pv_tchaqueta']==$t_chaqueta['id_talla']){
							echo "<option value='$t_chaqueta[id_talla]' selected>$t_chaqueta[pv_tchaqueta]</option>";
						}
						if($pv_planilla['pv_tchaqueta']!=$t_chaqueta['id_talla']){
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
						if($pv_planilla['pv_tfranela']==$t_franela['id_talla']){
							echo "<option value='$t_franela[id_talla]' selected>$t_franela[pv_tfranela]</option>";
						}
						if($pv_planilla['pv_tfranela']!=$t_franela['id_talla']){
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
						if($pv_planilla['pv_tmono']==$t_mono['id_talla']){
							echo "<option value='$t_mono[id_talla]' selected>$t_mono[pv_tmono]</option>";
						}
						if($pv_planilla['pv_tmono']!=$t_mono['id_talla']){
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
						if($pv_planilla['pv_tgorra']==$t_gorra['id_talla']){
							echo "<option value='$t_gorra[id_talla]' selected>$t_gorra[pv_tgorra]</option>";
						}
						if($pv_planilla['pv_tgorra']!=$t_gorra['id_talla']){
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
						if($pv_planilla['pv_contacto_parentesco']==$parentesco['id_parentesco']){
							echo "<option value='$parentesco[id_parentesco]' selected>$parentesco[pv_parentesco]</option>";
						}
						if($pv_planilla['pv_contacto_parentesco']!=$parentesco['id_parentesco']){
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
