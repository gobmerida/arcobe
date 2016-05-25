<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>.:Niño(a):.</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<link rel="stylesheet" href="../estilo/plan_vacacional.css" type="text/css"/>
	<script type="text/javascript" src="../js/jquery.js"></script>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body>
	<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
		
		<?php
		
		function CalculaEdad($fecha){
			$dia=date("d");
			$mes=date("m");
			$ano=date("Y");
			list($Y,$m,$d) = explode("-",$fecha);
			if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
			if ($m > $mes){ $ano=($ano-1);}
			$edad=($ano-$Y);
			return $edad;
		}
		
		//~ function CalculaEdad( $fecha ) { // Funcion para calcular la edad de los niños
			//~ list($Y,$m,$d) = explode("-",$fecha);
			//~ return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		//~ }
		$nino=$_GET['nino'];
			$c_nino=mysql_query("SELECT * FROM cj_hijos_institutos WHERE id_ninho='$nino'",$con) or die (mysql_error());
			$row_nino=mysql_fetch_array($c_nino);
			// - Conculta del periodo del Plan Vacacional
			$anio_actual = date("Y");
			$pv_co = "SELECT * FROM pv_periodo WHERE pv_añoperiodo='$anio_actual'";
			$pv_co = mysql_query($pv_co);
			$pv_periodo = mysql_fetch_array($pv_co);
			if($row_nino['id_ninho']==''){
				header("location:b_nino.php?error=1");
			}
			if($row_nino['h_sexo']=='F'){
				$sexo="Femenino";
				$ninho="de la Niña";
			}
			
			if($row_nino['h_sexo']=='M'){
				$sexo="Masculino";
				$ninho="del Niño";
			}
			setlocale(LC_ALL, 'es_VE.utf8 ');
			
			$fecha_naci=$row_nino['h_fecha_naci'];
			$fecha_naci=strftime("%d %B %Y",strtotime($fecha_naci));
			$gsan = $row_nino['h_gsanguineo'];
			$h_sanguineo_c = "SELECT * FROM cp_gsanguineos WHERE id_grupo_sanguineo='$gsan'";
			$h_sanguineo_c = mysql_query($h_sanguineo_c);
			$h_sanguineo = mysql_fetch_array($h_sanguineo_c);
			
			$edad=CalculaEdad($row_nino['h_fecha_naci']);
			echo "<br><span class='cll'>Datos $ninho";
			if($_SESSION['rol_editor']=="1"){
				echo "<img src='../media/edit.png' width='30px' onclick='location.href=\"edit_nino.php?nino=$nino\"' title='Editar' style='cursor:pointer'>";
			}
			echo "</span><br>";
			echo "<table class='nino'>";
			echo "<tr><td>Cédula: ".$row_nino['h_cedula']."</td><td>Registro: ".$row_nino['id_ninho']."</td></tr>";
			echo "<tr class='som'><td colspan='2'>Nombre(s): ".$row_nino['h_nombre1']." ".$row_nino['h_nombre2']."</td></tr>";
			echo "<tr><td colspan='2'>Apellido(s): ".$row_nino['h_apellido1']." ".$row_nino['h_apellido2']."</td></tr>";
			echo "<tr class='som'><td>Fecha de N.: ".$fecha_naci."</td><td>Sexo: $sexo</td></tr>";
			echo "<tr><td>Edad: $edad</td><td>";
			if($edad>12){
				echo "<b>Cesta Juguete:</b> <span style='color:red'><b>Superó el límite de edad</b></span>";
			}
			if($edad<=12){
				echo "<b>Cesta Juguete:</b> <span style='color:green'><b>Permitido</b></span>";
			}
			echo "</td></tr>
			<tr class='som'><td colspan='2'>Grupo Sanguíneo: ".$h_sanguineo['nombre']."</td></tr>
			<tr><td colspan=2>
			<center><hr></center>
			<ul>";
			$id_nino_c = $row_nino['id_ninho'];
			$periodos_inscrito_c = "SELECT * FROM pv_inscrip_institutos WHERE id_ninho_pv='$id_nino_c'";
			$periodos_inscrito_c = mysql_query($periodos_inscrito_c);
			while($periodos_inscrito = mysql_fetch_array($periodos_inscrito_c)){
				$id_Per = $periodos_inscrito['id_periodo'];
				$periodos_ni_consulta = "SELECT * FROM pv_periodo WHERE id_pvperiodo='$id_Per'";
				$periodos_ni_consulta = mysql_query($periodos_ni_consulta);
				$nino_per_consulta = mysql_fetch_array($periodos_ni_consulta);
				echo "<li onclick=\"location.href='pv_planilla.php?pn=$periodos_inscrito[pv_planillanumero]'\">$nino_per_consulta[pv_añoperiodo] - Ver planilla</li>";
			}
			if($pv_periodo['pv_añoperiodo']==$anio_actual and $pv_periodo['cierre']==0){
				$id_periodo = $pv_periodo['id_pvperiodo'];
				$pv_inscrip_institutos_co = "SELECT * FROM pv_inscrip_institutos WHERE id_periodo='$id_periodo' and id_ninho_pv='$id_nino_c'";
				$pv_inscrip_institutos_co = mysql_query($pv_inscrip_institutos_co);
				$pv_inscrip_institutos = mysql_fetch_array($pv_inscrip_institutos_co);
				if($pv_inscrip_institutos['id_ninho_pv']=="" and $_SESSION['rol_ingreso']=="1"){
					$pv_anioperiodo = date("Y");
					$periodos_sql = "SELECT * FROM pv_periodo WHERE pv_añoperiodo='$pv_anioperiodo'";
					$periodos_sql = mysql_query($periodos_sql);
					$periodos_act = mysql_fetch_array($periodos_sql);
					if($row_nino['h_fecha_naci']>$periodos_act['pv_fecha_reque']){
						echo "<li>$anio_actual - No cumple la Edad Requerida</li>";
					}
					if($row_nino['h_fecha_naci']<=$periodos_act['pv_fecha_reque']){
						if($row_nino['h_fecha_naci']>=$periodos_act['pv_fecha_limite']){
							echo "<li>$anio_actual - Supera el límite de Edad</li>";
						}
						if($row_nino['h_fecha_naci']>=$periodos_act['pv_fecha_limite']){
							echo "<li onclick=\"location.href='ingresar_pv/ins_pv.php?nino=$nino'\">$anio_actual - Inscribir</li>";
						}
					}
				}
			}
			if($pv_periodo['pv_añoperiodo']!=$anio_actual){
				echo "<li>Plan Vacacional $anio_actual aun sin cronograma</li>";
			}
			echo "
			</ul>
			</td></tr>
			";
			echo "</table>";
		echo "<br><span class='dll'><center><img src='../media/inicio.png' onclick=\"location.href='../'\" width='20px' style='cursor:pointer' title='Inicio'/>&nbsp;<img src='../media/buscar.png' onclick=\"location.href='b_nino.php'\" width='20px' style='cursor:pointer;border-radius:0' title='Buscar Niño'/></center></span>";
		if($row_nino['cedula_repr']!=''){
		echo "<h3 class='n'style='color:black'>Representante legal</h3><br>";
		
		if($row_nino['cedula_mp']!=""){
			$mp=$row_nino['cedula_repr'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='trabajador.php?cedula=$mp' >V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span>";
				if($_SESSION['rol_editor']=="1"){
					echo "<img src='../media/edit.png' width='20px' onclick='location.href=\"edit_persona.php?cedula=".$row2['mp_cedula']."&&nino=$nino\"' title='Editar' style='cursor:pointer'>";
				}
				echo "</td></tr></table>";
				
			}
		}
		}
		echo "<h3 class='n'style='color:black'>Padres</h3><br>";
		if($row_nino['cedula_mp']!=""){
			$mp=$row_nino['cedula_mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='trabajador.php?cedula=$mp' >V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span>";
				if($_SESSION['rol_editor']=="1"){
					echo "<img src='../media/edit.png' width='20px' onclick='location.href=\"edit_persona.php?cedula=".$row2['mp_cedula']."&&nino=$nino\"' title='Editar' style='cursor:pointer'>";
				}
				echo "</td></tr></table>";
			}
		}
		if($row_nino['cedula_pm']!=""){
			$pm=$row_nino['cedula_pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='trabajador.php?cedula=$pm' >V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$pm'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span>";
				if($_SESSION['rol_editor']=="1"){
					echo "<img src='../media/edit.png' width='20px' onclick='location.href=\"edit_persona.php?cedula=".$row2['mp_cedula']."&&nino=$nino\"' title='Editar' style='cursor:pointer'>";
				}
				echo "</td></tr></table>";
				
			}
		}
		
		
		?>
		
		<br>
		
	</div>
	<?php
	if(array_key_exists('msj',$_GET) and $_GET['msj']=="1"){
		echo "<script>
		alert('Niño(a) ingresado correctamente');
		</script>";
	}
	if(array_key_exists('msj',$_GET) and $_GET['msj']=="2"){
		echo "<script>
		alert('Niño(a) editado correctamente');
		</script>";
	}
	if(array_key_exists('msj',$_GET) and $_GET['msj']=="3"){
		echo "<script>
		alert('Padre editado correctamente');
		</script>";
	}
	if(array_key_exists('error',$_GET) and $_GET['error']=="1"){
		echo "<script>
		alert('¡No tienes permisos para editar!');
		</script>";
	}
	?>
</body>
</html>
