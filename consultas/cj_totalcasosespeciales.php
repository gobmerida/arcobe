<?php
include("../connect/conexion.php");
include("../script_php/condicion.php");

$data01 = $_GET["periodo"];
$DataSQL00 = "select *
			  from cj_cuaderno_ce
			  join cj_trabajadores
			  on cj_cuaderno_ce.ced_tbr=cj_trabajadores.trb_cedula
			  where activo='1' and Periodo='$data01'";
$DataSQL00 = mysql_query($DataSQL00);

$i=0;
echo '<h2 style="color:#c00">Reporte Global Cesta Juguete</h2>';
$KidsNumberTotal=0;
$ec=0;
$ef=0;
$of=0;
$oc=0;
while( $DataROW00 = mysql_fetch_array($DataSQL00) ){
	$code = tipo_c($DataROW00["trb_codigo"]);
	if($code=="EMPLEADO FIJO"){
		$ef++;
	}
	if($code=="EMPLEADO CONTRATADO"){
		$ec++;
	}
	if($code=="OBRERO FIJO"){
		$of++;
	}
	if($code=="OBRERO CONTRATADO"){
		$oc++;
	}
	$DataSQL01 = "select cj_hijos_ce.*
				  from cj_hijos_ce
				  where id_periodo='$data01' and cedula_mp='$DataROW00[trb_cedula]' or cedula_repr='$DataROW00[trb_cedula]'";
	$DataSQL01 = mysql_query($DataSQL01);
	$KidsNumber=0;
	
	while($DataROW01 = mysql_fetch_array($DataSQL01)){
		$KidsNumber++;
		$KidsNumberTotal++;
	}
	$i++;
}
$te=$ec+$ef;
$to=$oc+$of;
echo "
<b>Total de trabajadores:</b> $i<br>
<b>Total de beneficiarios:</b> $KidsNumberTotal<br>
<hr>
<b>Total de Empleados Fijos: </b> $ef<br>
<b>Total de Empleados Contratados: </b> $ec<br>
<b>Total de Empleados: </b> $te<br><br>
<b>Total de Obreros Fijos: </b> $of<br>
<b>Total de Obreros Contratados: </b> $oc<br>
<b>Total de Obreros: </b> $to <br>
";
?>

