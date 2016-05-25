<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->
<?php include("../../connect/conexion.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
	<title>ARCOBE</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../../estilo/estilo.css" type="text/css"/>
	<script src="../../js/calendario/jquery-1.10.2.js"></script>
	<script src="../../js/calendario/jquery-ui.js"></script>
	<script src="../../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../../js/calendario/jquery-ui.css">
	<script language="javascript" src="../../js/mayuscula.js"></script>
	<style>
		textarea{width:400px}
		.upp{text-transform: uppercase}
		.trb{
			margin:0 auto;
		}
		.trb td{
			padding:4px;
			border:1px solid silver;
		}.trb input{
			float: right;
		}
		.error{
		border:1px solid red;
		border-radius:5px;
		}
	</style>
</head>					

<body>
	<div id='cabecera_ini'>
	</div>
	<?php 
	if (array_key_exists("cedula",$_GET)) {
		extract($_GET); 

		$sql   = "SELECT * FROM cj_trabajadores WHERE trb_cedula=$cedula";
		$query = mysql_query($sql);
		$res   = mysql_fetch_array($query);

		if ($res[0]=="") {
			$sql   = "SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula=$cedula";
			$query = mysql_query($sql);
			$res   = mysql_fetch_array($query);
			}

	?>

	<div id='contenedor'>
		<br><span class='cll'> <center>Ingresar datos del trabajador</center> </span><br><br>
		
		<form action="reg_trabajador.php" method="post" onsubmit='return trb_data(this);'>
			<table class='trb'>
				<tr>
					<td>
						<label for="cod">Codigo trabajador</label><input type="text" name="cod"  value="<?php echo $res[0]; ?>" readonly/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="ci">Cedula</label><input type="text" name="ci" value="<?php echo $cedula;  ?>" readonly/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="ape">Apellido</label><input type="text" name="ape" value="<?php echo $res[2]; ?>" readonly/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="nom">Nombre</label><input type="text" name="nom" value="<?php echo $res[3]; ?>" readonly/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="carg">Cargo</label><input type="text" name="carg" value="<?php echo $res[4]; ?>" readonlyrequired/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="depe">Dependencia</label><input type="text" name="depe" value="<?php echo $res[5]; ?>" readonlyrequired/>
					</td>
				</tr>
				<input type="hidden" name="submit" value="1" />		
			</table>
			<br><br /><br />
			<span class='dll'>
				<center>
					<input type='image' value='Guardar' title='Guardar' src='../../media/guardar.jpg' width='20px'>
					<img src='../../media/inicio.png' onclick='location.href="../"' width='20px' style='cursor:pointer' title='Inicio'>
					<img src='../../media/cancelar.png' onclick='location.href="trabajador.php?cedula=<?php echo $cedula;?>"' width='20px' style='cursor:pointer' title='Cancelar'>
				</center>
			</span>
		</form>
		<br>
	</div>	


<?php 

	}else{
?>	
	<div id='contenedor'>
		<br><span class='cll'> <center>Ingresar datos del trabajador</center> </span><br><br>
		
		<form action="reg_trabajador.php" method="post" onsubmit='return trb_data(this);'>
			<table class='trb'>
				<tr>
					<td>
						<label for="cod">Codigo trabajador</label><input type="text" name="cod" required />
					</td>
				</tr>
				<tr>
					<td>
						<label for="ci">Cedula</label><input type="text" name="ci" required />
					</td>
				</tr>
				<tr>
					<td>
						<label for="ape">Apellido</label><input type="text" name="ape" required/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="nom">Nombre</label><input type="text" name="nom" required/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="carg">Cargo</label><input type="text" name="carg" required/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="depe">Dependencia</label><input type="text" name="depe" required/>
					</td>
				</tr>
				<input type="hidden" name="submit" value="1" />		
			</table>
			<br><br /><br />
			<span class='dll'>
				<center>
					<input type='image' value='Guardar' title='Guardar' src='../../media/guardar.jpg' width='20px'>
					<img src='../../media/inicio.png' onclick='location.href="../"' width='20px' style='cursor:pointer' title='Inicio'>
					<img src='../../media/cancelar.png' onclick='location.href="trabajador.php?cedula=<?php echo $cedula;?>"' width='20px' style='cursor:pointer' title='Cancelar'>
				</center>
			</span>
		</form>
		<br>
	</div>

	<?php  
	}
?>

</body>
</html>
