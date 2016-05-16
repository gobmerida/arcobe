<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!--
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
-->
	<link rel="stylesheet" href="../estilo/pv_planilla.css" type="text/css"/>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
include("../script_php/a_fe.php");
		include("../script_php/condicion.php");
			if(array_key_exists('pn',$_GET)){
				$n_planilla = $_GET['pn'];
				$pv_planillaConsulta = "SELECT * FROM pv_planilla_institutos WHERE pv_planillanumero='$n_planilla'";
				$pv_planillaConsulta = mysql_query($pv_planillaConsulta);
				$pv_planilla = mysql_fetch_array($pv_planillaConsulta);
				
				if($pv_planilla['h_sexo']=='F'){
					$genero="Femenino";
					$ninho="DE LA NIÑA";
					$confornin="de la niña";
				}
				if($pv_planilla['id_ninho_pv']==""){
					header("location: BuscarPlanilla.php?error=1");
				}
				if($pv_planilla['h_sexo']=='M'){
					$genero="Masculino";
					$ninho="DEL NIÑO";
					$confornin="del niño";
				}
				$ctrb_sql = "SELECT codigo_trb FROM pv_inscrip_institutos WHERE pv_planillanumero='$n_planilla'";
				$ctrb_sql = mysql_query($ctrb_sql) or die ("No se halló el código");
				$ctrb = mysql_fetch_array($ctrb_sql);
				$c_trb = $ctrb['codigo_trb'];
				$condicion = tipo_c($c_trb);
			}
?>
<body>
	<div id='panel'>
	<a href="../"><img src='../media/inicio.png' width='50px'></a><br>
	<a href='./nino.php?nino=<?php echo $pv_planilla['id_ninho_pv'];?>'><img src="../media/nino.png" width="50px"></a><br>
	<a href='javascript:window.print(); void 0;'><img src="../media/Printer.png" width="50px"></a><br>
	<?php
	if($_SESSION['rol_editor']=="1"){
	?>
	<a href='e_pv.php?pn=<?php echo $_GET['pn']; ?>'><img src="../media/editar.png" width="50px"></a><br>
	<?php
	}
	?>
	<a href='BuscarPlanilla.php'><img src="../media/buscar.png" width="50px"></a><br>
	</div>
	<div id="pv_planilla">
		<table>
			<?php
				echo "
				<tr><td colspan=2 class='planilla'>Número de planilla: $pv_planilla[pv_planillanumero]</td><td colspan=2 class='planilla'>Código del trabajador: $c_trb</td></tr>
				<tr><td class='acomodar'></td><td class='acomodar'></td><td class='acomodar'></td><td class='acomodar'></td></tr>
				<tr><td colspan=4 class='planilla'>
				<img src='../media/foto.png' width='130px' height='150px'>
				<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
				<img src='../media/logo.png' width='75%' class='top_i'><img src='../media/consumo.png' width='50px'></td></tr>
				<tr><td colspan=4 class='planilla titulo' align=center><b>Plan Vacacional $pv_planilla[pv_añoperiodo]</b></td></tr>
				<tr><td colspan=4 class='planilla sub_titulo'><b><u>DATOS DEL TRABAJADOR</u></b></td></tr>
				<tr><td colspan=4 class='planilla'><b>Cédula: </b>$pv_planilla[trb_cedula]</td></tr>
				<tr><td colspan=4 class='planilla'><b>Apellidos y Nombres: </b>$pv_planilla[trb_nombres]</td></tr>
				<tr><td colspan=3 class='planilla'><b>Dependencia: </b>$pv_planilla[trb_dependencia]</td><td class='planilla'><b>Estatus/Condición:</b><br>$condicion</td></tr>
				<tr><td colspan=4 class='planilla sub_titulo'><b><u>DATOS $ninho</u></b></td></tr>
				<tr><td colspan=4 class='planilla'><b>Nombres: </b>$pv_planilla[h_nombre1] $pv_planilla[h_nombre2]</td></tr>
				<tr><td colspan=4 class='planilla'><b>Apellidos: </b>$pv_planilla[h_apellido1] $pv_planilla[h_apellido2]</td></tr>
				<tr><td class='planilla'><b>Cédula: </b>$pv_planilla[h_cedula]</td><td class='planilla'><b>Edad: </b>$pv_planilla[pv_edadmeses]</td><td class='planilla'><b>Grupo Sanguíneo: </b>$pv_planilla[nombre]</td><td class='planilla'><b>Género: </b>$genero</td></tr>
				<tr><td colspan=2 class='planilla'><b>Fecha de nacimiento: </b>".a_fecha($pv_planilla['h_fecha_naci'])."</td><td colspan=2 class='planilla'><b>Plan Correspondiente: </b>$pv_planilla[pv_destino]</td></tr>
				
				<tr><td colspan=4 class='planilla sub_titulo'><b><u>CUIDADOS ESPECIALES</u></b></td></tr>
				<tr><td colspan=2 class='planilla'><b>Alérgias: </b>$pv_planilla[pv_alergias]</td><td colspan=2 class='planilla'><b>Tratamiento en sumnistro: </b>$pv_planilla[pv_tratamiento]</td></tr>
				<tr><td colspan=2 class='planilla'><b>Alimentos Prohibidos: </b>$pv_planilla[pv_alimentosp]</td><td colspan=2 class='planilla'><b>Medicamentos Prohibidos: </b>$pv_planilla[pv_medicamentosp]</td></tr>
				<tr><td colspan=4 class='planilla'><b>Observación importante acerca del niño o niña: </b>$pv_planilla[pv_observaciones]</td></tr>
				<tr><td colspan=4 class='planilla'><b>Vacunas: </b>$pv_planilla[pv_vacunas]</td></tr>
				<tr><td colspan=4 class='planilla sub_titulo'><b><u>PERSONA DE CONTACTO</u></b></td></tr>
				<tr><td colspan=4 class='planilla'>
				Nombre y Apellidos: $pv_planilla[pv_contacto_nombre] $pv_planilla[pv_contacto_apellido]<br>
				Cédula de Identidad: $pv_planilla[pv_contacto_cedula]<br>
				Teléfono: $pv_planilla[pv_contacto_telefono]<br>
				Parentesco:  $pv_planilla[pv_parentesco]
				
				</td></tr>
				<tr><td colspan=4 class='planilla sub_titulo'><b><u>OBSERVACIONES GENERALES: </u></b></td></tr>
				<tr><td colspan=2 class='planilla'><b>Habilidades: </b>$pv_planilla[pv_habilidades]</td><td colspan=2 class='planilla'><b>Actividades favoritas: </b>$pv_planilla[pv_gustos]</td></tr>
				<tr><td colspan=4 class='planilla sub_titulo'><b><u>TALLAS PARA EL UNIFORME: </u></b></td></tr>
				<tr><td colspan=4 class='planilla'><b>Franela: </b>$pv_planilla[pv_tfranela] - <b>Chaqueta: </b>$pv_planilla[pv_tchaqueta] - <b>Mono: </b>$pv_planilla[pv_tmono] - <b>Gorra: </b>$pv_planilla[pv_tgorra]</td></tr>
				<tr><td colspan=4 class='planilla sub_titulo'><b><center><u>DOCUMENTOS CONSIGNADOS</u></center></b></td></tr>
				<tr><td colspan=2 class='planilla'><b>1.- Fotos $ninho: </b></td><td colspan=2 class='planilla'>$pv_planilla[pv_fotos]</td></tr>
				<tr><td colspan=2 class='planilla'><b>2.- Certificado de Niño sano: </b></td><td colspan=2 class='planilla'>$pv_planilla[pv_certificado]</td></tr>
				
				";
			?>
		</table>
		<br>
		<table style="border:1px solid white">
			<tr>
				<td class='info-planilla'>
					<h4 align="center"><u>TRABAJADOR/REPRESENTANTE DEL EJECUTIVO REGIONAL</u></h4>
					<p style="text-align:justify; margin:20px">&nbsp;&nbsp;&nbsp;&nbsp; Yo, <b><?php echo "$pv_planilla[trb_nombres] $pv_planilla[trb_apellidos]";?></b>, 
					portador de la Cédula de Identidad número: <b><?php echo "$pv_planilla[trb_cedula]";?></b>, funcionario adscrito a: <?php echo "$pv_planilla[trb_dependencia]";?>
					y en calidad de representante de el (la) menor: <b><?php echo "$pv_planilla[h_nombre1] $pv_planilla[h_nombre2] $pv_planilla[h_apellido1] $pv_planilla[h_apellido2]";?></b>, declaro
					que los datos suministrados por mi son fehacientes.<br>
						<center><b>Así mismo, acepto la normativa que se menciona a continuación:</b></center>
						<ol style="text-align:justify; margin:20px">
							<li>En los casos que no se cumpla alguna disposición establecida en los lineamientos, la DEPP
							    Recursos Humanos negar o suspender al beneficiario del plan vacacional, debido esta Dirección
							    difundir ampliamente estos lineamientos al momento de la inscripción respectiva.</li>
							<li>
								Entendiéndose por infracciones y/o causales de incumplimiento a estos lineamientos, las consideraciones siguientes:
								<ol type="a">
									<li>Violaciones a las disposiciones relativas a las normas establecidas por los guías y técnicos.</li>
									<li>Por razones de salud, previo dictamen de autoridad médica</li>
									<li>Alterar, de manera notoria y ostensible, el orden y/o desarrollo normal de las actividades.</li>
									<li>Cometer actos que perjudiquen a los demás beneficiarios.</li>
								</ol>
							</li>
							<li>
								La DEPP Recursos Humanos vigilará permanentemente el cumplimiento estricto de estos  Lineamientos y demás
								normatividad aplicable por parte de los beneficiarios del plan vacacional, y en caso de detectar alguna
								irregularidad en su funcionamiento, lo hará del conocimiento de las autoridades competentes.
							</li>
						</ol><br>
						<center><b style="text-decoration:overline">Firma del Trabajador/Representante</b></center>
					</p>
				</td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
			<td><hr></td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					<table style="width:100%;border" class="conforme-rep">
						<tr>
							<td colspan="2"><b>Código del trabajador: </b><?php echo "$c_trb";?></td><td colspan="2"><b>Número de Planilla: </b><?php echo "$pv_planilla[pv_planillanumero]";?></td>
						</tr>
						<tr>
							<td colspan="4"><img src='../media/logo.png' style="width:820px;height:100px" class='top_i'></td>
						</tr>
						<tr>
							<td colspan="4" class='titulo'><center><b><?php echo "Plan Vacacional $pv_planilla[pv_añoperiodo]";?></b></center></td>
						</tr>
						<tr>
							<td colspan="4" style="padding:15px">
							<b>Datos del trabajador:</b><br>
							<b>C.I. </b><?php echo "$pv_planilla[trb_cedula]";?><br>
							<b>Nombres: </b><?php echo "$pv_planilla[trb_nombres] $pv_planilla[trb_apellidos]";?><br>
							<b>Dependencia: </b><?php echo "$pv_planilla[trb_dependencia]";?>
							</td>
						</tr>
						<tr>
							<td colspan="4"  style="padding:5px 5px 5px 15px">
							<b>Datos <?php echo "$confornin";?>: </b><?php echo "$pv_planilla[h_nombre1] $pv_planilla[h_nombre2] $pv_planilla[h_apellido1] $pv_planilla[h_apellido2]";?>
							</td>
						</tr>
						<tr>
							<td>Talla Chaqueta: <?php echo "$pv_planilla[pv_tchaqueta]";?></td><td>Talla Mono: <?php echo "$pv_planilla[pv_tmono]";?></td><td>Talla Franela: <?php echo "$pv_planilla[pv_tfranela]";?></td><td>Talla Gorra: <?php echo "$pv_planilla[pv_tgorra]";?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
	</div>
</body>
<?php
if(array_key_exists('msj',$_GET) and $_GET['msj']=="1"){
 echo "
 <script>
 alert('¡Registrado en el plan vacacional ".date("Y")." con éxito!');
 </script>
 ";
}
if(array_key_exists('msj',$_GET) and $_GET['msj']=="2"){
 echo "
 <script>
 alert('¡Cambios guardados con éxito!');
 </script>
 ";
}
?>
</html>
