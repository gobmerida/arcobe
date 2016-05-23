<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>Ingresar Niño(a)</title>
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
	<div id="cabecera_ini"></div>
	<div id="contenedor">
		<h3 class="n">Ingresar Niño(a)<br>Cédula de la madre o el padre</h3><br>
		<?php
		if(array_key_exists("mp",$_GET)){
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			$c_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$mp'",$con) or die (mysql_error());
					$c2_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_pm='$mp'",$con) or die (mysql_error());
					$c3_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_repr='$mp'",$con) or die (mysql_error());
					$i=0;
					$ih=0;
					while($row_hijos=mysql_fetch_array($c_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beneficiarios(as):<br>";
						$ih=$ih+1;
					}
					if($row_hijos['id_ninho']!=""){
						$cod_nino=$row_hijos['id_ninho'];
						$nombre2=" ".$row_hijos['h_nombre2'];
						$apellido2=" ".$row_hijos['h_apellido2'];
						$e_nino=$row_hijos['h_nombre1'].$nombre2." ".$row_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row2_hijos=mysql_fetch_array($c2_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beneficiarios(as):<br>";
						$ih=$ih+1;
					}
					if($row2_hijos['id_ninho']!=""){
						$cod_nino=$row2_hijos['id_ninho'];
						$nombre2=" ".$row2_hijos['h_nombre2'];
						$apellido2=" ".$row2_hijos['h_apellido2'];
						$e_nino=$row2_hijos['h_nombre1'].$nombre2." ".$row2_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row3_hijos=mysql_fetch_array($c3_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beneficiarios(as):<br>";
						$ih=$ih+1;
					}
					if($row3_hijos['id_ninho']!=""){
						$cod_nino=$row3_hijos['id_ninho'];
						$nombre2=" ".$row3_hijos['h_nombre2'];
						$apellido2=" ".$row3_hijos['h_apellido2'];
						$e_nino=$row3_hijos['h_nombre1'].$nombre2." ".$row3_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				if($i==0){
					echo "<span class='cen' style='color:black'>No hay Niños(as) registrados</span><br>";
				}
		}
		if(array_key_exists("mp",$_GET)){
			$pm=$_GET['pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$pm' and activo='1'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
			
				$mp_nr_sql = "SELECT * FROM cj_mp WHERE mp_cedula='$pm'";
				$mp_nr_query = mysql_query($mp_nr_sql);
				$mp_nr_row = mysql_fetch_array($mp_nr_query);
				if($mp_nr_row['mp_cedula']!=""){
					echo "<table><tr><td>V.- ".$mp_nr_row['mp_cedula']."</td><td> - ".$mp_nr_row['mp_nombre']."</td><td>".$mp_nr_row['mp_apellido']."</td><td><b style='color:maroon'>(NT)</b></td></tr></table>";
				}
				$c_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$pm'",$con) or die (mysql_error());
					$c2_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_pm='$pm'",$con) or die (mysql_error());
					$c3_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_repr='$pm'",$con) or die (mysql_error());
					$i=0;
					$ih=0;
					while($row_hijos=mysql_fetch_array($c_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beneficiarios(as):<br>";
						$ih=$ih+1;
					}
					if($row_hijos['id_ninho']!=""){
						$cod_nino=$row_hijos['id_ninho'];
						$nombre2=" ".$row_hijos['h_nombre2'];
						$apellido2=" ".$row_hijos['h_apellido2'];
						$e_nino=$row_hijos['h_nombre1'].$nombre2." ".$row_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row3_hijos=mysql_fetch_array($c3_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beneficiarios(as):<br>";
						$ih=$ih+1;
					}
					if($row3_hijos['id_ninho']!=""){
						$cod_nino=$row3_hijos['id_ninho'];
						$nombre2=" ".$row3_hijos['h_nombre2'];
						$apellido2=" ".$row3_hijos['h_apellido2'];
						$e_nino=$row3_hijos['h_nombre1'].$nombre2." ".$row3_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row2_hijos=mysql_fetch_array($c2_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beneficiarios(as) por cedula: V.- $pm<br>";
						$ih=$ih+1;
					}
					if($row2_hijos['id_ninho']!=""){
						$cod_nino=$row2_hijos['id_ninho'];
						$nombre2=" ".$row2_hijos['h_nombre2'];
						$apellido2=" ".$row2_hijos['h_apellido2'];
						$e_nino=$row2_hijos['h_nombre1'].$nombre2." ".$row2_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='../consultas/nino.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				if($i==0){
					echo "<span class='cen' style='color:black'>No hay Niños(as) registrados</span><br>";
				}
		}
		?>
		<form action="ingresar_nino.php" method="get">
			<input type="hidden" name="mp" value="<?php echo $mp;?>">
			<input type="hidden" name="pm" value="<?php echo $pm;?>"><br>
			<?php
			if($row_madpad['trb_cedula']=="" and $mp_nr_row['mp_cedula']==""){
				
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:red'>Cédula no se encuentra registrada, ingrese los datos del padre o madre:</span><br>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V.- $pm - Nombre <input type='text' name='pm0' autocomplete=off> Apellido <input type='text' name='pm1' autocomplete=off>";
			}
			?>
			<center><input type="submit" value="Siguiente"></center>
		</form>
		<span style='font-weight:bold'>
		<?php echo "<center><a href='ing_pm.php?mp=$mp'>Atras</a>";
		?>
		<a href="../" >Cancelar</a></span></center><br>
	</div>
	
</body>
</html>
