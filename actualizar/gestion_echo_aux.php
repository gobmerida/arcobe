<?php
include("../connect/conexion.php");
function CalculaEdad($fecha){
	$dia=date("d");
	$mes=date("m");
	$ano=date("Y");
	list($Y,$m,$d) = explode("-",$fecha);
	if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
	if ($m > $mes){ $ano=($ano-1);}
	$edad=($ano-$Y);
	return $edad;
}
$DataSQL00 = "SELECT cj_inscritos_periodo_aux.id_periodo,cj_beneficiados.*
			  FROM cj_inscritos_periodo_aux
			  JOIN cj_beneficiados
			  ON cj_inscritos_periodo_aux.id_ninho=cj_beneficiados.id_ninho
			  WHERE id_periodo='2'";
$DataSQL00 = mysql_query($DataSQL00);
$i=0;
while($DataROW00 = mysql_fetch_array($DataSQL00)){
	$edad = CalculaEdad($DataROW00["h_fecha_naci"]);
	echo "<span>$DataROW00[id_ninho] - $DataROW00[h_nombre1] $DataROW00[h_nombre2] $DataROW00[h_apellido1] $DataROW00[h_apellido2] $edad</span><br>";
	$i++;
}
echo "<br>$i<br>";
?>
