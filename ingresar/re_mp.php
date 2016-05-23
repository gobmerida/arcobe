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
			border: ridge 1px silver;
			border-radius: 7px;
			margin: 0 35px;
		}
	</style>
	<script type="text/javascript" src="jquery.js"></script>
	<script language="javascript" src="../js/delimitar.js"></script>
	<script type="text/javascript">
		function validar(formulario){
		if(formulario.mp.value.length==0){
			document.getElementById("mp").style.border = "2px inset red";
			formulario.mp.focus();
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
		$('#suggestions').fadeOut(300);
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
		<h3 class="n">Ingreso del Beneficiario<br>Cédula de la madre o el padre</h3><br>
		<?php
		if(array_key_exists("re",$_GET)){
			$re=$_GET['re'];
			$madpad=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$re'",$con) or die (mysql_error());
			$row_madpad=mysql_fetch_array($madpad);
			if($row_madpad['trb_cedula']==""){
				header("location:ing_rep.php?error=1");
			}
			echo "<table><tr><td>V.- ".$row_madpad['trb_cedula']."</td><td> - ".$row_madpad['trb_nombres']."</td><td>".$row_madpad['trb_apellidos']."</td></tr></table>";
			$c_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_mp='$re'",$con) or die (mysql_error());
					$c2_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_pm='$re'",$con) or die (mysql_error());
					$c3_hijos=mysql_query("SELECT * FROM cj_hijos WHERE cedula_repr='$re'",$con) or die (mysql_error());
					$i=0;
					$ih=0;
					while($row_hijos=mysql_fetch_array($c_hijos)){
					if($ih==0){
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hijos(as):<br>";
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
						echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hijos(as):<br>";
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
		?>
		<br>
		<form action="re_pm.php" method="get" id="ing_mp"  onsubmit='return validar(this)'>
		<?php
			echo "<input type='hidden' name='re' value='".$re."'>";
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula <input type="text" name="mp" id="mp" autocomplete=off onkeyup="busc_ms();bus_h()" onkeypress="return permite(event, 'num_car')"><input type="submit" value="Enviar">
		<div id="suggestions"></div>
		</form><br>
		<script>
		$('#suggestions').fadeOut(0);
		</script>
		<center><span style='font-weight:bold'><a href="ingresar_nino_rep.php?re=<?php echo $re;?>" >Omitir</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo "<a href='ing_rep.php'>Atras</a>";
		?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../" >Cancelar</a></span></center><br>
	</div>
	
</body>
</html>
