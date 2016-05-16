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
		.suggest-element{
		margin-left:5px;
		margin-top:5px;
		width:400px;
		cursor:pointer;
		}
		#suggestions {
		position:fixed;
		margin: 0 35px;
		width:400px;
		height:150px;
		border:ridge 2px;
		border-radius: 3px;
		overflow: auto;
		background: white;
		}
		table{
			border: ridge 2px;
			border-radius: 7px;
			margin: 0 35px;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {	
		$('#suggestions').fadeOut(0);
		$('#mp').keypress(function(){
			var mp = $(this).val();		
			var dataString = 'cedula='+mp;
			$.ajax({
				type: "POST",
				url: "empleados_ce.php",
				data: dataString,
				success: function(data) {
					$('#suggestions').fadeIn(1000).html(data);
					$('.suggest-element a').live('click', function(){
						var id = $(this).attr('id');
						$('#mp').val($('#'+id).attr('data'));
						$('#suggestions').fadeOut(1000);
						$('#ing_mp').submit();
						return false;
					});              
				}
			});
		});              
	});    
	function g(){
		$('#suggestions').fadeOut(250);
	}
	</script>
</head>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
?>
<body onclick='g();'>
	<div id="cabecera_ini"></div>
	<div id="contenedor">
		<h3 class="n">Ingreso del Niño <span style="color:red">(Caso Especial)</span><br>2DO LLAMADO DE DATOS DEL PADRE O MADRE</h3><br>
		<?php
		if(array_key_exists("mp",$_GET)){
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE activo='1' and trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad["trb_cedula"]!=""){
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
			else{
				$madpad213=mysql_query("SELECT * FROM cj_trabajadores_ce WHERE trb_cedula='$mp'",$con) or die (mysql_error());
				$row_madpad213=mysql_fetch_array($madpad213);
					if($row_madpad213["trb_cedula"]!=""){
						echo "<table><tr><td>V.- ".$row_madpad213['trb_cedula']."</td><td> - ".$row_madpad213['trb_nombres']."</td><td>".$row_madpad213['trb_apellidos']."</td></tr></table>";
					}
					if($row_madpad213["trb_cedula"]==""){
						echo "<table style='color:red;font-weigth:bold'><tr><td>Cédula no registrada o inactiva</td></tr></table>";
						header("location:ing_mp_ce.php?error=1");
						}
				}
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
						echo "<span class='cen'><a href='nino_ce.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				while($row2_hijos=mysql_fetch_array($c2_hijos)){
					if($row2_hijos['id_ninho']!=""){
						$cod_nino=$row2_hijos['id_ninho'];
						$nombre2=" ".$row2_hijos['h_nombre2'];
						$apellido2=" ".$row2_hijos['h_apellido2'];
						$e_nino=$row2_hijos['h_nombre1'].$nombre2." ".$row2_hijos['h_apellido1'].$apellido2;
						echo "<span class='cen'><a href='nino_ce.php?nino=$cod_nino' class='nino' target='_blank' style='color:SteelBlue'>$e_nino</a></span><br>";
						$i=$i+1;
					}
				}
				if($i==0){
					echo "<span class='cen' style='color:black' >No hay Niños(as) registrados</span><br>";
				}
		
		}
		?>
		<br>
		<form action="ing_ni_ce.php" method="get" id="ing_mp">
		<?php
			echo "<input type='hidden' name='mp' value='".$mp."'>";
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula <input type="text" name="pm" id="mp" autocomplete=off><input type="submit" value="Enviar">
		<div id="suggestions"></div>
		</form><br>
		<center><span style='font-weight:bold'><a href="ingresar_nino_ce.php?mp=<?php echo $mp;?>" >Omitir</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo "<a href='ing_mp_ce.php'>Atras</a>";
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./" >Cancelar</a></span></center><br>
	</div>
	
</body>
</html>
