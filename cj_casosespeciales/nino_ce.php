<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
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
		function CalculaEdad( $fecha ) { // Funcion para calcular la edad de los niños
			list($Y,$m,$d) = explode("-",$fecha);
			return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		}
		$nino=$_GET['nino'];
			$c_nino=mysql_query("SELECT * FROM cj_hijos_ce JOIN cp_gsanguineos ON cj_hijos_ce.h_gsanguineo=cp_gsanguineos.id_grupo_sanguineo WHERE id_ninho='$nino'",$con) or die (mysql_error());
			$row_nino=mysql_fetch_array($c_nino);
			
			if($row_nino['h_sexo']=='F'){
				$sexo="Femenino";
				$ninho="de la Beneficiaria";
			}
			
			if($row_nino['h_sexo']=='M'){
				$sexo="Masculino";
				$ninho="del Beneficiario";
			}
			setlocale(LC_ALL, 'es_VE.utf8 ');
			
			$fecha_naci=$row_nino['h_fecha_naci'];
			$fecha_naci=strftime("%d %B %Y",strtotime($fecha_naci));
			
			$edad=CalculaEdad($row_nino['h_fecha_naci']);
			echo "<br><span class='cll'>Datos $ninho <span style='color:red'>(Caso Especial)</span></span><br>";
			echo "<table class='nino'>";
			echo "<tr><td>Cédula: ".$row_nino['h_cedula']."</td><td>Registro: ".$row_nino['id_ninho']."</td></tr>";
			echo "<tr class='som'><td colspan='2'>Nombre(s): ".$row_nino['h_nombre1']." ".$row_nino['h_nombre2']."</td></tr>";
			echo "<tr><td colspan='2'>Apellido(s): ".$row_nino['h_apellido1']." ".$row_nino['h_apellido2']."</td></tr>";
			echo "<tr class='som'><td>Fecha de N.: ".$fecha_naci."</td><td>Sexo: $sexo</td></tr>";
			echo "<tr><td>Edad: $edad</td><td>Grupo Sanguíneo: ".$row_nino['nombre']."</td></tr>";
			echo "</table>";
		echo "<br><span class='dll'><center><img src='../media/inicio.png' onclick=\"location.href='./'\" width='20px' style='cursor:pointer' title='Inicio'/>&nbsp;<img src='../media/buscar.png' onclick=\"location.href='b_nino_ce.php'\" width='20px' style='cursor:pointer;border-radius:0' title='Buscar Niño'/></center></span>";
		if($row_nino['cedula_repr']!=''){
		echo "<h3 class='n'style='color:black'>Representante</h3><br>";
		
		if($row_nino['cedula_mp']!=""){
			$mp=$row_nino['cedula_repr'];
			$madpad1=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad1=mysql_fetch_array($madpad1);
			if($row_madpad1['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='../consultas/trabajador.php?cedula=$mp'>V.- ".$row_madpad1['trb_cedula']." - ".$row_madpad1['trb_nombres']." ".$row_madpad1['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad1['trb_cedula']==""){
				$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$mp'",$con) or die (mysql_error());
				$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='./trabajador_ce.php?cedula=$mp'>V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span></td></tr></table>";
			}
			}
		}
		}
		echo "<h3 class='n'style='color:black'>Padres</h3><br>";
		if($row_nino['cedula_mp']!=""){
			$mp=$row_nino['cedula_mp'];
			$madpad1=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad1=mysql_fetch_array($madpad1);
			if($row_madpad1['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='../consultas/trabajador.php?cedula=$mp'>V.- ".$row_madpad1['trb_cedula']." - ".$row_madpad1['trb_nombres']." ".$row_madpad1['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad1['trb_cedula']==""){
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='./trabajador_ce.php?cedula=$mp'>V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$mp'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span></td></tr></table>";
				
			}
			}
			
		}
		if($row_nino['cedula_pm']!=""){
			$pm=$row_nino['cedula_pm'];
			$madpad1=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad1=mysql_fetch_array($madpad1);
			if($row_madpad1['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='../consultas/trabajador.php?cedula=$pm'>V.- ".$row_madpad1['trb_cedula']." - ".$row_madpad1['trb_nombres']." ".$row_madpad1['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad1['trb_cedula']==""){
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
				echo "<table><tr><td><span><a href='./trabajador_ce.php?cedula=$pm'>V.- ".$row_madpad['trb_cedula']." - ".$row_madpad['trb_nombres']." ".$row_madpad['trb_apellidos']."</a></span></td></tr></table>";
			}
			if($row_madpad['trb_cedula']==""){
				$madpad2=mysql_query("SELECT * FROM cj_mp WHERE mp_cedula='$pm'",$con) or die (mysql_error());
				$row2=mysql_fetch_array($madpad2);
				echo "<table><tr><td><span style='font-weight:bold'>V.- ".$row2['mp_cedula']." - ".$row2['mp_nombre']." ".$row2['mp_apellido']."</span></td></tr></table>";
			}
			}
		}
		
		
		?>
		
		<br>
		
	</div>
	
</body>
</html>
