<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Cesta Juguete</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/estilo.css" type="text/css"/>
	<style>
		table{
			border: ridge 2px;
			border-radius: 7px;
			margin: 0 35px;
		}
	</style>
	
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body onclick='g();'>
	<div id="cabecera"><h2 align='center'>Cesta Juguete</h2></div>
	<div id="contenedor">
		<h3 class="n">Ingreso del Niño <span style="color:red">(Caso Especial)</span><br>Cédula de la madre o el padre</h3><br>
		<?php
		if(array_key_exists("mp",$_GET)){
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			$c_hijos=mysql_query("SELECT * FROM cj_hijos_ce WHERE cedula_mp='$mp'",$con) or die (mysql_error());
					$c2_hijos=mysql_query("SELECT * FROM cj_hijos_ce WHERE cedula_pm='$mp'",$con) or die (mysql_error());
					$i=0;
					while($row_hijos=mysql_fetch_array($c_hijos)){
					if($i==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hijos(as):<br>";
					}
					if($row_hijos['id_ninho']!=""){
						$cod_nino=$row_hijos['id_ninho'];
						$nombre2=" ".$row_hijos['h_nombre2'];
						$apellido2=" ".$row_hijos['h_apellido2'];
						$e_nino=$row_hijos['h_nombre1'].$nombre2." ".$row_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino_ce.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row2_hijos=mysql_fetch_array($c2_hijos)){
					if($row2_hijos['id_ninho']!=""){
						$cod_nino=$row2_hijos['id_ninho'];
						$nombre2=" ".$row2_hijos['h_nombre2'];
						$apellido2=" ".$row2_hijos['h_apellido2'];
						$e_nino=$row2_hijos['h_nombre1'].$nombre2." ".$row2_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino_ce.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				if($i==0){
					echo "<span class='cen' style='color:black'>No hay Niños(as) registrados</span><br>";
				}
		}
		if(array_key_exists("mp",$_GET)){
			$pm=$_GET['pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
			$c_hijos=mysql_query("SELECT * FROM cj_hijos_ce WHERE cedula_mp='$pm'",$con) or die (mysql_error());
					$c2_hijos=mysql_query("SELECT * FROM cj_hijos_ce WHERE cedula_pm='$pm'",$con) or die (mysql_error());
					$i=0;
					while($row_hijos=mysql_fetch_array($c_hijos)){
					if($i==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hijos(as):<br>";
					}
					if($row_hijos['id_ninho']!=""){
						$cod_nino=$row_hijos['id_ninho'];
						$nombre2=" ".$row_hijos['h_nombre2'];
						$apellido2=" ".$row_hijos['h_apellido2'];
						$e_nino=$row_hijos['h_nombre1'].$nombre2." ".$row_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino_ce.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row2_hijos=mysql_fetch_array($c2_hijos)){
					if($i==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hijos(as) por cedula: V.- $pm<br>";
					}
					if($row2_hijos['id_ninho']!=""){
						$cod_nino=$row2_hijos['id_ninho'];
						$nombre2=" ".$row2_hijos['h_nombre2'];
						$apellido2=" ".$row2_hijos['h_apellido2'];
						$e_nino=$row2_hijos['h_nombre1'].$nombre2." ".$row2_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino_ce.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				if($i==0){
					echo "<span class='cen' style='color:black'>No hay Niños(as) registrados</span><br>";
				}
		}
		?>
		<form action="ingresar_nino_ce.php" method="get">
			<input type="hidden" name="mp" value="<?php echo $mp;?>">
			<input type="hidden" name="pm" value="<?php echo $pm;?>"><br>
			<?php
			if($row_madpad['trb_cedula']==""){
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:red'>Cédula no se encuentra registrada, ingrese los datos del padre o madre:</span><br>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V.- $pm - Nombre <input type='text' name='pm0' autocomplete=off> Apellido <input type='text' name='pm1' autocomplete=off>";
			}
			?>
			<center><input type="submit" value="Siguiente"></center>
		</form>
		<span style='font-weight:bold'>
		<?php echo "<center><a href='ing_pm_ce.php?mp=$mp'>Atras</a>";
		?>
		<a href="../" >Cancelar</a></span></center><br>
	</div>
	
</body>
</html>
