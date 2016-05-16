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
	<link rel="stylesheet" href="../estilo/edit_nino.css" type="text/css"/>
	<script src="../js/calendario/jquery-1.10.2.js"></script>
	<script src="../js/calendario/jquery-ui.js"></script>
	<script src="../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css">
	<link rel="stylesheet" href="../js/calendario/date.css">
	<script>
	$(function() {
	$( "#datepicker" ).datepicker({
	changeMonth: true, // Mostrar el mes
	changeYear: true, // Poder cambiar el año
	showOtherMonths: true, //Mostrar cuadrilcula
	showButtonPanel: true // Mostrar botones
	});
	});
	</script>
	<style>
	input{text-transform: uppercase;}
	</style>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
include("../script_php/a_fe.php");
?>
<body>
	<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
		
		<?php
		//~ function CalculaEdad( $fecha ) { // Funcion para calcular la edad de los niños
			//~ list($Y,$m,$d) = explode("-",$fecha);
			//~ return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		//~ }
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
		$nino=$_GET['nino'];
			$c_nino=mysql_query("SELECT *
								 FROM pv_planillace
								 JOIN pv_periodo_ce
								 ON pv_planillace.id_periodo=pv_periodo_ce.id_pvperiodo
								 WHERE id_nino='$nino'",$con) or die (mysql_error());
			$row_nino=mysql_fetch_array($c_nino);
			$id_nino = $row_nino['id_nino'];
			// - Conculta del periodo del Plan Vacacional
			$anio_actual = date("Y");
			$pv_co = "SELECT * FROM pv_periodo WHERE pv_añoperiodo='$anio_actual'";
			$pv_co = mysql_query($pv_co);
			$pv_periodo = mysql_fetch_array($pv_co);
			if($row_nino['id_nino']==''){
				header("location:b_nino.php?error=1");
			}
			if($row_nino['h_sexo']=='F'){
				$sexo="Femenino";
				$nino="de la Niña";
			}
			
			if($row_nino['h_sexo']=='M'){
				$sexo="Masculino";
				$nino="del Niño";
			}
			setlocale(LC_ALL, 'es_VE.utf8 ');
			
			$fecha_naci=$row_nino['h_fecha_naci'];
			$fecha_nacimi=a_fecha($row_nino['h_fecha_naci']);
			$fecha_naci=strftime("%d %B %Y",strtotime($fecha_naci));
			$gsan = $row_nino['h_gsanguineo'];
			$h_sanguineo_c = "SELECT * FROM cp_gsanguineos WHERE id_grupo_sanguineo='$gsan'";
			$h_sanguineo_c = mysql_query($h_sanguineo_c);
			$h_sanguineo = mysql_fetch_array($h_sanguineo_c);
			
			$edad=CalculaEdad($row_nino['h_fecha_naci']);
			echo "
			<form action='e_ninopv.php' method='post'>
			<input type='hidden' name='id_nino' value='$id_nino'>
			<br><span class='cll'>Datos $nino</span><br>";
			echo "<table class='nino'>";
			echo "<tr><td>Cédula: <input type='text' name='h_cedula' value='".$row_nino['h_cedula']."' class='nihnoe' autocomplete=off></td><td>Registro: ".$row_nino['id_nino']."</td></tr>";
			echo "<tr class='som'><td colspan='2'>Primer Nombre: <input text='text' name='h_nombre1' value='".$row_nino['h_nombre1']."' class='nihnoe' autocomplete=off> - Segundo Nombre: <input text='text' name='h_nombre2' value='".$row_nino['h_nombre2']."' class='nihnoe' autocomplete=off></td></tr>";
			echo "<tr><td colspan='2'>Primer Apellido: <input type='text' name='h_apellido1' value='".$row_nino['h_apellido1']."' class='nihnoe' autocomplete=off> Segundo Apellido: <input type='text' name='h_apellido2' value='".$row_nino['h_apellido2']."' class='nihnoe' autocomplete=off></td></tr>";
			echo "<tr class='som'><td>Fecha de N.: <input type='text' class='datepicker nihnoe' id='datepicker' name='h_fecha_naci' placeholder='dia/mes/año' value='$fecha_nacimi' autocomplete=off></td><td>Género:
			<select name='h_sexo'>";
			if($sexo=="Masculino"){
				echo "<option value='M' selected>Masculino</option>";
			}
			if($sexo!="Masculino"){
				echo "<option value='M'>Masculino</option>";
			}
			if($sexo=="Femenino"){
				echo "<option value='F' selected>Femenino</option>";
			}
			if($sexo!="Femenino"){
				echo "<option value='F'>Femenino</option>";
			}
			echo "</select>
			
			</td></tr>";
			echo "<tr><td>Edad: $edad</td><td>Grupo Sanguíneo:";
			
			$gsanguineo_c = "SELECT * FROM cp_gsanguineos";
			$gsanguineo_c = mysql_query($gsanguineo_c);
			echo "<select name='h_gsanguineo' id='h_gsanguineo'>
			";
			while($gsanguineo = mysql_fetch_array($gsanguineo_c)){
				if($h_sanguineo['nombre']==$gsanguineo['nombre']){
					echo "<option value='$gsanguineo[id_grupo_sanguineo]' onclick = 'validar(this.form)' selected>$gsanguineo[nombre]</option>";
				}
				if($h_sanguineo['nombre']!=$gsanguineo['nombre']){
					echo "<option value='$gsanguineo[id_grupo_sanguineo]' onclick = 'validar(this.form)'>$gsanguineo[nombre]</option>";
				}
			}
			echo "</select>";
			
			echo "</td></tr>";
			
			echo "</table>";
		echo "<br><span class='dll'><center><input type='image' value='Guardar' title='Guardar' src='../media/guardar.jpg' width='20px'><img src='../media/inicio.png' onclick='location.href=\"./\"' width='20px' style='cursor:pointer' title='Inicio'><img src='../media/cancelar.png' onclick='location.href=\"pv_nino_ce.php?nino=$id_nino\"' width='20px' style='cursor:pointer' title='Cancelar'></center></span></form>";
		/*if($row_nino['cedula_regis']!=''){
		echo "<h3 class='n'style='color:black'>Representante legal</h3><br>";
		
		if($row_nino['cedula_mp']!=""){
			$mp=$row_nino['cedula_repr'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='trabajador.php?cedula=$mp' target='blank_'>V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span></td></tr></table>";
				
			}
		}
		}
		echo "<h3 class='n'style='color:black'>Padres</h3><br>";
		if($row_nino['cedula_mp']!=""){
			$mp=$row_nino['cedula_mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='trabajador.php?cedula=$mp' target='blank_'>V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span></td></tr></table>";
			}
		}
		if($row_nino['cedula_pm']!=""){
			$pm=$row_nino['cedula_pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='trabajador.php?cedula=$pm' target='blank_'>V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$pm'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span></td></tr></table>";
				
			}
		}
		
		*/
		?>
		
		<br>
		
	</div>
	<?php
	if(array_key_exists('msj',$_GET) and $_GET['msj']=="1"){
		echo "<script>
		alert('Niño(a) ingresado correctamente');
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
