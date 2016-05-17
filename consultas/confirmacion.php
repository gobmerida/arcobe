<?php
include("../connect/conexion.php");
function CalculaEdad($fecha){
	/*$dia=date("d");
	$mes=date("m");
	$ano=date("Y");*/
	$dia=30;
	$mes=11;
	$ano=2015;
	list($Y,$m,$d) = explode("-",$fecha);
	if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
	if ($m > $mes){ $ano=($ano-1);}
	$edad=($ano-$Y);
	return $edad;
}
$Data01 = $_POST["data01"];
$ActivoSQL00 = "select * from cj_trabajadores where trb_cedula='$Data01'";
$ActivoSQL00 = mysql_query($ActivoSQL00);
$ActivoROW00 = mysql_fetch_array($ActivoSQL00);

if($ActivoROW00["activo"]==1){
$DataSQL00 = "select * from cj_hijos where cedula_mp='$Data01' or cedula_repr='$Data01'";
$DataSQL00 = mysql_query($DataSQL00);
$inino=0;
while($DataROW00 = mysql_fetch_array($DataSQL00)){
	$inino++;
}
if($inino>0){
	$DataSQL01 = "select * from cj_hijos where cedula_mp='$Data01' or cedula_repr='$Data01'";
	$DataSQL01 = mysql_query($DataSQL01);
	$hola="";
	while($DataROW01 = mysql_fetch_array($DataSQL01)){
		$edad = CalculaEdad("$DataROW01[h_fecha_naci]");
		if($edad<=12){
		$DataSQL02 = "select * from cj_inscritos_periodo_aux where id_ninho='$DataROW01[id_ninho]'";
		$DataSQL02 = mysql_query($DataSQL02);
		$DataROW02 = mysql_fetch_array($DataSQL02);
		if(strlen($DataROW02["id_ninho"])!=0){
			$DataSQL03 = "update cj_cuaderno set Confirmacion='1' where ced_tbr='$Data01'";
			$DataSQL03 = mysql_query($DataSQL03);
			header("location:./trabajador.php?cedula=$Data01&&msj=3");
		}
		else{
			$DataSQL04 = "insert into cj_inscritos_periodo_aux(id_ninho,id_periodo) values('$DataROW01[id_ninho]','2')";
			$DataSQL04 = mysql_query($DataSQL04);
			$DataSQL08 = "select * from cj_cuaderno where ced_tbr='$Data01'";
			$DataSQL08 = mysql_query($DataSQL08);
			$DataROW08 = mysql_fetch_array($DataSQL08);
			
			if($Data01!=$DataROW08["ced_tbr"]){
				$DataSQL05 = "select * from cj_cesta_juguete_periodo where id='2'";
				$DataSQL05 = mysql_query($DataSQL05);
				$DataROW05 = mysql_fetch_array($DataSQL05);
				
				$aux01 = $DataROW05["Aux"];
				$aux02 = $DataROW05["ContadorAux"];
				$contador = $DataROW05["contador_per"];
				if($aux01>=10){
					$aux01=0;
					$aux02++;
				}
				$aux01++;
				$contador++;
				$DataSQL06 = "insert into cj_cuaderno(ced_tbr,Npagina,Nlinea,Confirmacion,Periodo) values('$Data01','$aux02','$contador','1','2')";
				$DataSQL06 = mysql_query($DataSQL06);
				$DataSQL07 = "update cj_cesta_juguete_periodo set contador_per='$contador',ContadorAux='$aux02',Aux='$aux01' where id='2'";
				$DataSQL07 = mysql_query($DataSQL07);
			}
			header("location:./trabajador.php?cedula=$Data01&&msj=3");
		}
	}
	else{echo "<td colspan='2' style='text-align:center;font-weight:bold;color:red'>Uno de los beneficiarios superó el límite de edad</td>";}
	}
}
else {echo "<td colspan='2' style='text-align:center;font-weight:bold;color:red'>Sin niños registrados para cesta juguete</td>";}
}else {echo "<td colspan='2' style='text-align:center;font-weight:bold;color:red'>Trabajador inactivo</td>";}
?>
