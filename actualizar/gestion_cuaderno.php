<?php
include("../connect/conexion.php");
function CalculaEdad($fecha){
	/*$dia=date("d");
	$mes=date("m");
	$ano=date("Y");*/
	$dia = 30;
	$mes = 11;
	$ano = 2015;
	list($Y,$m,$d) = explode("-",$fecha);
	if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
	if ($m > $mes){ $ano=($ano-1);}
	$edad=($ano-$Y);
	return $edad;
}
$DataSQL00 = "SELECT * FROM cj_trabajadores WHERE activo='1'";
$DataSQL00 = mysql_query($DataSQL00);
$i=0;
$KidsNumberTotal=0;
$aux01 = 0;
$aux02 = 1;
while($DataROW00 = mysql_fetch_array($DataSQL00)){
	if($aux01>=10){
		$aux01 = 0;
		$aux02++;
	}
	$DataSQL01 = "select cj_hijos.*
				  from cj_hijos
				  join cj_inscritos_periodo_aux
				  on cj_hijos.id_ninho = cj_inscritos_periodo_aux.id_ninho
				  where cedula_mp='$DataROW00[trb_cedula]' or cedula_repr='$DataROW00[trb_cedula]'";
	$DataSQL01 = mysql_query($DataSQL01);
	$KidsNumber=0;
	while($DataROW01 = mysql_fetch_array($DataSQL01)){
		$KidsNumber++;
		$KidsNumberTotal++;
	}
	if($KidsNumber!=0){
		$i++;
		$aux01++;
		echo "[Página: $aux02 / Fila: $i] ($DataROW00[trb_codigo]) C.I. $DataROW00[trb_cedula] - $DataROW00[trb_nombres] $DataROW00[trb_apellidos] [Niños(as): $KidsNumber]<br>";
		$DataSQL03 = "insert into cj_cuaderno(ced_tbr, Npagina, Nlinea, Confirmacion, Periodo) value('$DataROW00[trb_cedula]','$aux02','$i','0','2')";
		$DataSQL03 = mysql_query($DataSQL03);
	}
}

$DataSQL02 = "update cj_cesta_juguete_periodo set contador_per='$i',ContadorAux='$aux02',Aux='$aux01'";
$DataSQL02 = mysql_query($DataSQL02);

echo "<br>Número de empleados beneficiario: ".$i;
echo "<br>Total de beneficiarios: ".$KidsNumberTotal;
?>
