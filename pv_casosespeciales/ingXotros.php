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
	<link rel="stylesheet" href="../estilo/mp.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/o_ing.css" type="text/css"/>
	<script src="../js/calendario/jquery-1.10.2.js"></script>
	<script src="../js/calendario/jquery-ui.js"></script>
	<script src="../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css">
	<link rel="stylesheet" href="../js/calendario/date.css">
	<script language="javascript" src="../js/mayuscula.js"></script>
	<script language="javascript" src="../js/delimitar.js"></script>
	<script language="javascript" src="../js/funciones.js"></script>
</head>

<body onload="tamanios();errores_oall()">
	<div id="cabecera_ini"></div>
	<div id="contenedor">
		<h2 class="enca">Caso Especial</h2>
		<form action="i_otros.php" method="post" id="formu" onsubmit="return validarForm(this);">
		<h3 class="n">Datos de los padres</h3>
		<div class="madre">
		<h3 class="n">Madre</h3>
		<table id="tab_mad"><tr><td>Si <input type="radio" name="s_madre" id="s_madres" value="s" onclick="m_sele(this)">No <input type="radio" name="s_madre" id="s_madren" value="n" onclick="m_sele(this)"><div id='error_madre' class='error'>¿Tiene madre?</div></td><td class="responsable"><input type="radio" name="concod" id="concod1" value="m" onclick="cheks()">¿Responsable?</td></tr></table>
		
		<table id="table_madre">
		<tr><td>Cédula:</td><td><input type="text" name="cedula_madre" id="cedula_madre" autocomplete=off onkeypress="return permite(event, 'num')" onkeydown="restaurar(this,error_madre_cedula)"><div id='error_madre_cedula' class='error'>¿Cédula?</div></td></tr>
		<tr><td>Nombres:</td><td><input type="text" name="n_madre" id="n_madre" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_madre_nombre)"><div id='error_madre_nombre' class='error'>¿Nombres?</div></td></tr>
		<tr><td>Apellidos:</td><td><input type="text" name="p_madre" id="p_madre" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_madre_apellido)"><div id='error_madre_apellido' class='error'>¿Apellido?</div></td></tr>
		<tr><td>Dirección:</td><td><input type="text" name="d_madre" id="d_madre" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_madre_direccion)"><div id='error_madre_direccion' class='error'>Dirección?</div></td></tr>
		<tr><td>Teléfono:</td><td><input type="text" name="t_madre" id="t_madre" autocomplete=off  onblur="formato(this)" onkeypress="return permite(event, 'num')" onkeydown="restaurar(this,error_madre_telefono)"><div id='error_madre_telefono' class='error'>¿Teléfono?</div></td></tr>
		</table>
		</div>
		
		<div class="padre">
		<h3 class="n">Padre</h3>
		<table id="tab_pad"><tr><td>Si <input type="radio" name="s_padre" id="s_padres" value="s" onclick="p_sele(this)">No <input type="radio" name="s_padre" id="s_padren" value="n" onclick="p_sele(this)"><div id='error_padre' class='error'>¿Tiene padre?</div></td><td class="responsable"><input type="radio" name="concod" id="concod2" value="p" onclick="cheks()">¿Responsable?</td></tr></table>
		<table id="table_padre">
		<tr><td>Cédula:</td><td><input type="text" name="cedula_padre" id="cedula_padre" autocomplete=off onkeypress="return permite(event, 'num')" onkeydown="restaurar(this,error_padre_cedula)"><div id='error_padre_cedula' class='error'>¿Cédula?</div></td></tr>
		<tr><td>Nombres:</td><td><input type="text" name="n_padre" id="n_padre" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_padre_nombre)"><div id='error_padre_nombre' class='error'>¿Nombres?</div></td></tr>
		<tr><td>Apellidos:</td><td><input type="text" name="p_padre" id="p_padre" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_padre_apellido)"><div id='error_padre_apellido' class='error'>¿Apellido?</div></td></tr>
		<tr><td>Dirección:</td><td><input type="text" name="d_padre" id="d_padre" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_padre_direccion)"><div id='error_padre_direccion' class='error'>Dirección?</div></td></tr>
		<tr><td>Teléfono:</td><td><input type="text" name="t_padre" id="t_padre" autocomplete=off  onblur="formato(this)" onkeypress="return permite(event, 'num')" onkeydown="restaurar(this,error_padre_telefono)"><div id='error_padre_telefono' class='error'>¿Teléfono?</div></td></tr>
		</table>
		<br>
		</div>
		
		<h3 class="n">Representante</h3>
		<table id="tab_rep"><tr><td>Si <input type="radio" name="s_rep" id="s_reps" value="s" onclick="rep_sele(this)">No <input type="radio" name="s_rep" id="s_repn" value="n" onclick="rep_sele(this)"><div id='error_rep' class='error'>¿Tiene representante?</div></td><td class="responsable"><input type="radio" name="concod" id="concod3" value="r" onclick="cheks()">¿Responsable?</td></tr></table>
		
		<table id="table_representante">
		<tr><td>Cédula:</td><td><input type="text" name="cedula_representante" id="cedula_representante" autocomplete=off onkeypress="return permite(event, 'num')" onkeydown="restaurar(this,error_representante_cedula)"><div id='error_representante_cedula' class='error'>¿Cédula?</div></td></tr>
		<tr><td>Nombres:</td><td><input type="text" name="n_representante" id="n_representante" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_representante_nombres)"><div id='error_representante_nombres' class='error'>¿Nombres?</div></td></tr>
		<tr><td>Apellidos:</td><td><input type="text" name="p_representante" id="p_representante" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_representante_apellido)"><div id='error_representante_apellido' class='error'>¿Apellido?</div></td></tr>
		<tr><td>Dirección:</td><td><input type="text" name="d_representante" id="d_representante" autocomplete=off  onkeyup='upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_representante_direccion)"><div id='error_representante_direccion' class='error'>Dirección?</div></td></tr>
		<tr><td>Teléfono:</td><td><input type="text" name="t_representante" id="t_representante" autocomplete=off  onblur="formato(this)" onkeypress="return permite(event, 'num')" onkeydown="restaurar(this,error_representante_telefono)"><div id='error_representante_telefono' class='error'>¿Teléfono?</div></td></tr>
		</table>
		<br>
		<h3 class="n">Ingresar datos del Niño(a)</h3>
		<a href="./" class="n">Cancelar</a>
		<br>
		
			<table class="lol" >
			<tr><td>Cédula:</td> <td><input type="text" name="h_cedula" id="h_cedula" autocomplete=off onkeypress="return permite(event, 'num')"></td></tr>
			
			<tr><td>Primer Nombre:</td> <td><input type="text" name="h_nombre1" id="h_nombre1" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_primer_nombre)"><div id='error_primer_nombre' class='error'>¿Primer Nombre?</div>
				</td>
			</tr>
			<tr><td>Segundo Nombre:</td> <td><input type="text" name="h_nombre2" id="h_nombre2" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Primer Apellido:</td> <td><input type="text" name="h_apellido1" id="h_apellido1" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')" onkeydown="restaurar(this,error_primer_apellido)"><div id='error_primer_apellido' class='error'>¿Primer Apellido?</div>
				</td>
			</tr>
			
			<tr><td>Segundo Apellido:</td> <td><input type="text" name="h_apellido2" id="h_apellido2" autocomplete=off onkeyup = 'upperCase(this)' onkeypress="return permite(event, 'car')">
				</td>
			</tr>
			
			<tr><td>Fecha:</td><td><input type="text" class='datepicker' id='h_fecha_naci' name="h_fecha_naci" readonly='readonly' placeholder='dia/mes/año' autocomplete=off onchange="restaurar(this,error_primer_fnacimiento)"><div id='error_primer_fnacimiento' class='error'>¿Fecha de Nacimiento?</div>
			</td></tr>
			
			
			<tr><td>Grupo Sanguíneo:</td><td>
			<?php
			$gsanguineo_c = "SELECT * FROM cp_gsanguineos";
			$gsanguineo_c = mysql_query($gsanguineo_c);
			echo "<select name='h_gsanguineo' id='h_gsanguineo' onchange='restaurar(this,error_primer_gsanguineo)'>
			<option value=''>Ingresar</option>
			";
			while($gsanguineo = mysql_fetch_array($gsanguineo_c)){
				echo "
				<option value='$gsanguineo[id_grupo_sanguineo]' >$gsanguineo[nombre]</option>";
			}
			echo "</select>";
			?>
			<div id='error_primer_gsanguineo' class='error'>¿Grupo Sanguíneo?</div>
			</td></tr>
			<tr><td>Género:</td><td>
				<select name="h_sexo" id="h_sexo"  onchange='restaurar(this,error_primer_genero)'>
					<option value="">Seleccionar</option>
					<option value="F">Femenino</option>
					<option value="M">Másculino</option>
				</select>
				<div id='error_primer_genero' class='error'>¿Género?</div>
				</td></tr>
			</table>
			<br>
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
			<center><input type="submit" value="Registrar" name='sub' id='sub' class="subm" ></center>
			<br>
		</form>
	</div>
</body>
</html>
