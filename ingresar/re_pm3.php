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
	function validared(formulario){
		if(formulario.re.value.length==0){
			document.getElementById("mp").style.border = "2px inset red";
			formulario.re.focus();
			alert("¡Introduzca la cédula!");
			return false;
		}
	return true;
	}
	function validar(formulario){
		if(formulario.mp0.value.length==0){
			document.getElementById("mp0").style.border = "2px inset red";
			formulario.mp0.focus();
			alert("¡Introduzca los Nombres!");
			return false;
		}
		if(formulario.mp1.value.length==0){
			document.getElementById("mp1").style.border = "2px inset red";
			formulario.mp1.focus();
			alert("¡Introduzca los Apellidos!");
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
		<h3 class="n">Ingreso del Beneficiario<br>Datos del Representante y los Padres</h3><br>
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
			$row_madpad2=mysql_fetch_array($madpad);
			
			$mp_nr_sql = "SELECT * FROM cj_mp WHERE mp_cedula='$mp'";
			$mp_nr_query = mysql_query($mp_nr_sql);
			$mp_nr_row = mysql_fetch_array($mp_nr_query);
			if($mp_nr_row['mp_cedula']!=""){
				echo "<table><tr><td>V.- ".$mp_nr_row['mp_cedula']."</td><td> - ".$mp_nr_row['mp_nombre']."</td><td>".$mp_nr_row['mp_apellido']."</td><td><b style='color:maroon'>(NT)</b></td></tr></table>";
			}
			if($row_madpad2['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad2['trb_cedula']."</td><td> - ".$row_madpad2['trb_nombres']."</td><td>".$row_madpad2['trb_apellidos']."</td></tr></table>";
			}
			if($row_madpad2['trb_cedula']!="" or $mp_nr_row['mp_cedula']!=""){
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
					echo "<span class='cen' style='color:black' >No hay Beneficiarios(as) registrados</span><br>";
				}
			}
		}
		if(array_key_exists("mp0",$_GET)){
			if($_GET['mp0']!="" and $_GET['mp1']!=""){
			$cedula_mp=$_GET['mp'];
			$nombre_mp=$_GET['mp0'];
			$apellido_mp=$_GET['mp1'];
			$nombre_mp=mb_strtoupper($nombre_mp,'utf-8');
			$apellido_mp=mb_strtoupper($apellido_mp,'utf-8');
			echo "<table><tr><td>V.- $cedula_mp</td><td> - $nombre_mp</td><td>$apellido_mp <b style='color:red'>(NT)</b></td></tr></table><br>";
			}
			
		}
		if(array_key_exists("mp",$_GET)){
			$pm=$_GET['pm'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$pm'",$con) or die (mysql_error());
			$row_madpad3=mysql_fetch_array($madpad);
			
			$mp_nr_sql = "SELECT * FROM cj_mp WHERE mp_cedula='$pm'";
			$mp_nr_query = mysql_query($mp_nr_sql);
			$mp_nr_row2 = mysql_fetch_array($mp_nr_query);
			if($mp_nr_row2['mp_cedula']!=""){
				echo "<table><tr><td>V.- ".$mp_nr_row2['mp_cedula']."</td><td> - ".$mp_nr_row2['mp_nombre']."</td><td>".$mp_nr_row2['mp_apellido']."</td><td><b style='color:maroon'>(NT)</b></td></tr></table>";
			}
			if($row_madpad3['trb_cedula']!=""){
			echo "<table><tr><td>V.- ".$row_madpad3['trb_cedula']."</td><td> - ".$row_madpad3['trb_nombres']."</td><td>".$row_madpad3['trb_apellidos']."</td></tr></table>";
			}
			if($row_madpad3['trb_cedula']!="" or $mp_nr_row2['mp_cedula']!=""){
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
		}
		
		?>

		<br>
		
		<?php
			echo "
				<form action='ingresar_nino_rep.php' method='get' id='ing_mp' onsubmit='return validar(this)'>
				<input type='hidden' name='re' value='$re'>
				<input type='hidden' name='mp' value='$mp'>
				<input type='hidden' name='pm' value='$pm'>";
			if(array_key_exists("mp0",$_GET)){
				if($_GET['mp0']!="" and $_GET['mp1']!=""){
				echo "
					  <input type='hidden' name='pm0' value='$nombre_mp'>
					  <input type='hidden' name='pm1' value='$apellido_mp'>
				";
			}}
			if($row_madpad3['trb_cedula']=="" and $mp_nr_row2['mp_cedula']==""){
				
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='color:red'>Cédula no se encuentra registrada, ingrese los datos del padre o madre:</span><br>";
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;V.- $mp - Nombre <input class='tamanio_le' type='text' name='mp0' id='mp0' autocomplete=off> Apellido <input class='tamanio_le' type='text' name='mp1' id='mp1' autocomplete=off>";
			
			}
			echo "<center><input type='submit' value='Siguiente'></center></form><br>
			";
		?>
		
		<center><span style='font-weight:bold'><!-- <a href="ing2.php?re=<?php echo $re;?>&&mp=<?php echo $mp."&&mp0=".$nombre_mp."&&mp1=".$apellido_mp;?>" >Omitir</a> --> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php if($row_madpad2['trb_cedula']!=""){
			echo "<a href='re_pm.php?re=$re&&mp=$mp'>Atras</a>";}
		
		if(array_key_exists("mp0",$_GET)){
				if($_GET['mp0']!="" and $_GET['mp1']!=""){
				echo "<a href='re_pm2.php?re=$re&&mp=$mp&&mp0=$nombre_mp&&mp1=$apellido_mp'>Atras</a>
				";
			}}
		if($row_madpad3['trb_cedula']!="" and $mp_nr_row['mp_cedula']!=""){
			echo "<a href='re_pm.php?re=$re&&mp=$mp'>Atras</a>";
		}
		if(!array_key_exists("mp0",$_GET) and $mp_nr_row2['mp_cedula']!="" and $row_madpad2['trb_cedula']==""){
			echo "<a href='re_pm.php?re=$re&&mp=$mp'>Atras</a>";
		}?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../" >Cancelar</a></span></center><br>
	</div>
	
</body>
</html>
