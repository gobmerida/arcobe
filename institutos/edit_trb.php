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
	<script src="../js/calendario/jquery-1.10.2.js"></script>
	<script src="../js/calendario/jquery-ui.js"></script>
	<script src="../js/calendario/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css">
	<script language="javascript" src="../js/mayuscula.js"></script>
	<script language="javascript" src="../js/prev_trb.js"></script>
<style>
	textarea{width:400px}
	.upp{text-transform: uppercase}
	.trb{
		margin:0 auto;
	}
	.trb td{
		padding:4px;
		border:1px solid silver;
	}
	.error{
border:1px solid red;
border-radius:5px;
}
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
		<br><span class='cll'>Editar datos del trabajador</span><br><br>
		<?php
			if(array_key_exists('cedula',$_GET)){
				$cedula=$_GET['cedula'];
				$c_trabajador=mysql_query("SELECT * FROM cj_trabajadores_institutos WHERE trb_cedula='$cedula'",$con) or die (mysql_error());
				$row_trabajador=mysql_fetch_array($c_trabajador);
			}
		?>
		<form action="editar_trb.php" method="post" onsubmit='return trb_data(this);'>
			<table class='trb'>
				<input type="hidden" name="trb_cedula" id="trb_cedula" value="<?php echo $cedula;?>"/>
				<tr><td><b>Teléfonos:</b><br><br><br></td><td><textarea class='upp' name="trb_telefono" id="trb_telefono" placeholder="Teléfonos del trabajador, separar los números con \" onKeyUp="upperCase(this);resetEst(this)"><?php echo $row_trabajador['trb_telefono'];?></textarea></td></tr>
				<tr><td><b>Dirección:</b><br><br><br></td><td><textarea class='upp' name="trb_direccionh" id="trb_direccionh" placeholder="Dirección del trabajador" onKeyUp="upperCase(this);resetEst(this)"><?php echo $row_trabajador['trb_direccionh'];?></textarea></td></tr>
				<tr><td><b>Correo:</b><br><br><br></td><td><textarea name="trb_correo" id="trb_correo" placeholder="Correo del trabajador" onKeyUp="resetEst(this)"><?php echo $row_trabajador['trb_correo'];?></textarea></td></tr>
			</table>
			<br>
			<span class='dll'>
				<center>
					<input type='image' value='Guardar' title='Guardar' src='../media/guardar.jpg' width='20px'>
					<img src='../media/inicio.png' onclick='location.href="../"' width='20px' style='cursor:pointer' title='Inicio'>
					<img src='../media/cancelar.png' onclick='location.href="trabajador.php?cedula=<?php echo $cedula;?>"' width='20px' style='cursor:pointer' title='Cancelar'>
				</center>
			</span>
		</form>
		<br>
	</div>
</body>
</html>
