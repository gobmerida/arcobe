<!--Autor 
Edgar Carrizalez
C.I. V-19.3522.988
Correo: edg.sistemas@gmail.com
-->

<?php
	include("../connect/conexion.php");
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	
	mysql_select_db("cj_pv",$con);
	
	$sql=mysql_query("SELECT *
					  FROM cj_usuarios
					  JOIN cj_roles
					  ON cj_usuarios.usuario_rol=cj_roles.rol_id
					  WHERE usuario_user='$user'", $con) or die (mysql_error());

	$row = mysql_fetch_array($sql);
	
		
	if($user==$row['usuario_user'] and md5($pass)==$row['usuario_clave'] and $row['usuario_activo']=='1'){
			session_start();
			$_SESSION['usuario_user']=$_REQUEST['user'];
			$_SESSION['clave']=$_REQUEST['pass'];
			$_SESSION['usuario_nombre']=$row['usuario_nombre'];
			$_SESSION['usuario_apellido']=$row['usuario_apellido'];
			$_SESSION['usuario_cedula']=$row['usuario_cedula'];
			$_SESSION['usuario_rol']=$row['usuario_rol'];
			$_SESSION['rol_nombre']=$row['rol_nombre'];
			$_SESSION['rol_ingreso']=$row['rol_ingreso'];
			$_SESSION['rol_consulta']=$row['rol_consulta'];
			$_SESSION['rol_reporte']=$row['rol_reporte'];
			$_SESSION['rol_editor']=$row['rol_editor'];
			$_SESSION['rol_periodo']=$row['rol_periodo'];
			$_SESSION['rol_cperiodo']=$row['rol_cperiodo'];
			$_SESSION['rol_ce']=$row['rol_ce'];
			$_SESSION['rol_representante']=$row['rol_representante'];
			header("location: ../index2.php");
		}
	
	if($row['usuario_activo']=='0'){
		header("location: ../index.php?error=2");
	}
	if($user!=$row['usuario_user'] or md5($pass)!=$row['usuario_clave']){
		header("location: ../index.php?error=1");
	}
	if($user=="" or $pass==""){
		header("location: ../index.php?error=4");
	}	

?>

