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
			border: ridge 2px silver;
			border-radius: 7px;
			margin: 0 35px;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		function validar(formulario){
		if(formulario.pm.value.length==0){
			document.getElementById("mp").style.border = "2px inset red";
			formulario.pm.focus();
			alert("¡Introduzca la cédula!");
			return false;
		}
	return true;
	}
	function busc_ms(){
		$('#suggestions').fadeIn(0);
	}
	function bus_h(){
		var mp = document.getElementById('mp').value;		
			var dataString = 'mp='+mp;
			$.ajax({
				type: "POST",
				url: "empleados.php",
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
	}
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
		<h3 class="n">Ingreso del Niño<br>Cédula de la madre o el padre</h3><br>
		<?php
		if(array_key_exists("re",$_GET)){
			$re=$_GET['re'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$re'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			$c_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$re'",$con) or die (mysql_error());
					$c2_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_pm='$re'",$con) or die (mysql_error());
					$c3_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_repr='$re'",$con) or die (mysql_error());
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
					echo "<span class='cen' style='color:black' >No hay Beneficiarios(as) registrados</span><br>";
				}
		}
		if(array_key_exists("mp",$_GET)){
			$mp=$_GET['mp'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$mp'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			}
		}
		if(array_key_exists("mp0",$_GET)){
			if($_GET['mp0']!="" and $_GET['mp1']!=""){
			$cedula_mp=$_GET['mp'];
			$nombre_mp=$_GET['mp0'];
			$apellido_mp=$_GET['mp1'];
			$nombre_mp=mb_strtoupper($nombre_mp,'utf-8');
			$apellido_mp=mb_strtoupper($apellido_mp,'utf-8');
			echo "<table><tr><td>V.- $cedula_mp</td><td> - $nombre_mp</td><td>$apellido_mp <b style='color:red'>(NT)</b></td></tr></table>";
			}
			if($_GET['mp0']=="" or $_GET['mp1']==""){
			echo "<center><h2 style='color:red' >Error faltan datos</h2></center>";
			echo "<center><a href='re_pm.php?re=$re&&mp=$mp' style='color:SteelBlue;text-decoration:none;font-weight:bold'>Atras</a></center>";
			echo "<script>
					$(document).ready (function ocultarVentana()
					{
					$('#ing_mp').fadeOut(1); 
					});
				</script>";
			}
		}
		?>
		<br>
		<form action="re_pm3.php" method="get" id="ing_mp" onkeyup='busc_ms();bus_h()' onsubmit='return validar(this)'>
		<?php
			echo "<input type='hidden' name='re' value='".$re."'>";
			echo "<input type='hidden' name='mp' value='".$mp."'>";
			if($_GET['mp0']!="" or $_GET['mp1']!=""){
				echo "<input type='hidden' name='mp0' value='".$nombre_mp."'>";
				echo "<input type='hidden' name='mp1' value='".$apellido_mp."'>";
			}
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula <input type="text" name="pm" id="mp" autocomplete=off><input type="submit" value="Enviar">
		<div id="suggestions"></div>
		</form><br>
		<center><span style='font-weight:bold'><a href="ingresar_nino_rep.php?re=<?php echo $re;?>&&mp=<?php echo $mp."&&mp0=".$nombre_mp."&&mp1=".$apellido_mp;?>" >Omitir</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo "<a href='re_pm.php?re=$re&&mp=$mp'>Atras</a>";
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../" >Cancelar</a></span></center><br>
		<script>
			$('#suggestions').fadeOut(0);
			</script>
	</div>
	
</body>
</html>
