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
$DataSQl00 = "SELECT * FROM cj_trabajadores";
$DataSQl00 = mysql_query($DataSQl00);
$i=0;
$aux1=0;
$aux2=1;
while($DataROW00 = mysql_fetch_array($DataSQl00)){
	if($aux1>=10){
		$aux1=0;
		$aux2++;
	}
	//~ echo "$DataROW00[trb_cedula](<br>";
	if($DataROW00["activo"]==1){
		$DataSQl01 = "SELECT * FROM cj_hijos WHERE cedula_mp='$DataROW00[trb_cedula]'";
		$DataSQl01 = mysql_query($DataSQl01);
		while($DataROW01 = mysql_fetch_array($DataSQl01)){
			$edad = CalculaEdad("$DataROW01[h_fecha_naci]");
			if($edad<=12){
				//~ echo "$DataROW01[id_ninho] $DataROW01[h_nombre1] $DataROW01[h_nombre2] $DataROW01[h_apellido1] $DataROW01[h_apellido2] - $edad \"Permitido\"<br>";
				$DataSQL03 = "SELECT * FROM cj_inscritos_periodo_aux WHERE id_ninho='$DataROW01[id_ninho]' and id_periodo='2'";
				$DataSQL03 = mysql_query($DataSQL03);
				$DataROW03 = mysql_fetch_array($DataSQL03);
				if($DataROW01["id_ninho"]==$DataROW03["id_ninho"]){
					//~ echo "Ya registrado<br>";
				}
				else{
					$i++;
					$aux1++;
					$DataSQL04 = "INSERT INTO cj_inscritos_periodo_aux(id_ninho, id_periodo) VALUES('$DataROW01[id_ninho]','2') ";
					$DataSQL04 = mysql_query($DataSQL04);
				}
			}
		}
		$DataSQl07 = "SELECT * FROM cj_hijos WHERE cedula_repr='$DataROW00[trb_cedula]'";
		$DataSQl07 = mysql_query($DataSQl07);
		while($DataROW08 = mysql_fetch_array($DataSQl07)){
			$edad = CalculaEdad("$DataROW08[h_fecha_naci]");
			if($edad<=12){
				//~ echo "$DataROW08[id_ninho] $DataROW08[h_nombre1] $DataROW08[h_nombre2] $DataROW08[h_apellido1] $DataROW08[h_apellido2] - $edad \"Permitido\"<br>";
				$DataSQL09 = "SELECT * FROM cj_inscritos_periodo_aux WHERE id_ninho='$DataROW08[id_ninho]' and id_periodo='2'";
				$DataSQL09 = mysql_query($DataSQL09);
				$DataROW09 = mysql_fetch_array($DataSQL09);
				if($DataROW08["id_ninho"]==$DataROW09["id_ninho"]){
					//~ echo "Ya registrado<br>";
				}
				else{
					$i++;
					$aux1++;
					$DataSQL04 = "INSERT INTO cj_inscritos_periodo_aux(id_ninho, id_periodo) VALUES('$DataROW08[id_ninho]','2') ";
					$DataSQL04 = mysql_query($DataSQL04);
				}
			}
		}
	}
	//~ echo ")<br><br>";
}
echo "Registrados: ".$i;
?>
