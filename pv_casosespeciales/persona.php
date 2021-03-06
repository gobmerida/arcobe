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
		width:450px;
		cursor:pointer;
		}
		#suggestions {
		text-align:left;
		margin: 0 auto;
		position:fixed;
		min-width:200px;
		height:150px;
		border:ridge 2px;
		border-radius: 3px;
		overflow: auto;
		background: white;
		}
	</style>	
	<script type="text/javascript" src="jquery.js"></script>
	<script>
		function validar(formulario){
			if(formulario.cedula.value.length==0){
				document.getElementById("cedula").style.border = "2px inset red";
				formulario.cedula.focus();
				alert("¡Introduzca la cédula!");
				return false;
			}
	      	 return true;
		}

		function busc_ms(){
		$('#suggestions').fadeIn(0);
		}
		function bus_h(){
			var mp = document.getElementById('pn').value;		
				var dataString = 'pn='+mp;
				$.ajax({
					type: "POST",
					url: "empleados.php",
					data: dataString,
					success: function(data) {
						$('#suggestions').fadeIn(0).html(data);
						$('.suggest-element a').live('click', function(){
							var id = $(this).attr('id');
							$('#pn').val($('#'+id).attr('data'));
							$('#suggestions').fadeOut(1000);
							$('#ing_beneficiario').submit();
							return false;
						});              
					}
				});
		}

	</script>
</head>

<body>
<?php
include("../connect/conexion.php");
include("../sesion/sesion.php");
if(!array_key_exists('pn',$_GET)){
?>
<div id='cabecera_ini'>
	</div>
	<div id='contenedor'>
	<h3 style="text-align:center">Consultar Trabajador(ra) <span style='color:red'>(CE)</span></h3>
	<form action="#" method="get" id="trb_cedula" onsubmit="return validar(this)">
		<table style="margin:0 auto;text-align:center">
			<thead>
				<tr><td>Cédula</td></tr>
			</thead>
			<tr><td><span class="ls">V-</span><input type="text" id="pn" name="pn" autocomplete="off" onkeyup="bus_h();busc_ms();"><div id="suggestions"></div></td></tr>
			<tr><td><input type="submit" value="Enviar">
			</td></tr>
			<script>
    	   $('#suggestions').fadeOut(0);
    	</script>
		</table>

	</form><br>
	<center><a href="./" style='color:red;text-decoration:none'>Regresar</a></center>

	<span class="cen">Cédula</span><br>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



	</div>

<?php
}

if(array_key_exists('pn',$_GET)){
	echo "<div id='cabecera_ini'>
	</div>";
	echo "<div id='contenedor'>";
	echo "<br><span class='cll'>Datos del trabajador <span style='color:red'>(Caso Especial)</span></span><br>";
	$cedula=$_GET['pn'];
	//mysql_select_db("cj_pv",$con) or die (mysql_error());
	$c_trabajador=mysql_query("SELECT * FROM pv_trabajadores_ce WHERE trb_cedula='$cedula'",$con) or die (mysql_error());
	$row_trabajador=mysql_fetch_array($c_trabajador);

	if($row_trabajador['trb_cedula']!=''){

		echo "<table class='ta_trabajador'>";
		echo "<tr class='som'><td>Cedula: V-".$row_trabajador['trb_cedula']."</td><td>Código trabajador: ".$row_trabajador['trb_codigo']."</td></tr>";
		$noms=$row_trabajador['trb_nombres'];
		$aps=$row_trabajador['trb_apellidos'];

		echo "<tr><td colspan='2'>Nombres: ".$noms."</td></tr>";
		echo "<tr class='som'><td colspan='3'>Apellidos: ".$aps."</td><br></tr>";
		echo "<tr><td colspan='2'>Cargo: ".$row_trabajador['trb_cargo']."</td></tr>";
		echo "<tr class='som'><td colspan='2'>Dependencia: ".$row_trabajador['trb_dependencia']."</td></tr>";

		echo "</table>";
	}

	if($row_trabajador['trb_cedula']==''){
		$c_trabajador=mysql_query("SELECT * FROM cj_trabajadores WHERE trb_cedula='$cedula'",$con) or die (mysql_error());
		$row_trabajador=mysql_fetch_array($c_trabajador);
		echo "<h3 style='color:red'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cédula no registrada en casos especiales</h3>";

		if($row_trabajador["trb_cedula"]!=""){
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Registrar trabajador:
			      <a style='text-decoration:none;color:red' href='ingresar/registrar_trabajador.php?cedula=$cedula'/>$row_trabajador[trb_cedula] - $row_trabajador[trb_nombres] $row_trabajador[trb_apellidos] </a> <br>";
		}

	}

	if($row_trabajador['trb_cedula']==''){
		$c_trabajador=mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$cedula'",$con) or die (mysql_error());
		$row_trabajador=mysql_fetch_array($c_trabajador);

		if($row_trabajador["trb_cedula"]!=""){
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Registrar trabajador:
			      <a style='text-decoration:none;color:red' href='ingresar/registrar_trabajador.php?cedula=$cedula'/>$row_trabajador[trb_cedula] - $row_trabajador[trb_nombres] $row_trabajador[trb_apellidos] </a> <br>";
		}

	}

	echo "<br><span class='dll'><center><a href='../'>Inicio</a> ";
	echo "<a href='persona.php'>Regresar</a></center></span>";
	echo "<br>";
	echo "</div>";
	echo "<div id='hijos'>";

	$c_hijos=mysql_query("SELECT * FROM pv_hijos_ce JOIN pv_periodo_ce ON pv_hijos_ce.id_periodo=pv_periodo_ce.id_pvperiodo WHERE cedula_padre='$cedula'",$con) or die (mysql_error());
	$i=0;
	while($row_hijos=mysql_fetch_array($c_hijos)){
		if($row_hijos['id_ninho']!=""){
			$cod_nino=$row_hijos['id_ninho'];
			$nombre2=" ".$row_hijos['h_nombre2'];
			$apellido2=" ".$row_hijos['h_apellido2'];
			$e_nino=$row_hijos['h_nombre1'].$nombre2." ".$row_hijos['h_apellido1'].$apellido2;
			echo "<span class='cen'><a href='nino_pv_ce.php?nino=$cod_nino' class='nino'><span style='color:darkgrey'>(CE/CJ/$row_hijos[pv_añoperiodo])</span> $e_nino</a></span><br>";
			$i=$i+1;
		}
	}

	if($i==0){
		echo "<span class='cen'>No hay Niños(as) registrados</span><br>";
	}
	echo "</div>";

}
?>
</body>
</html>
