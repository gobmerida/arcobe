<span style='color:red;font-weight:bold'>Buscar por fecha de nacimiento, apellido y nombre</span>
<?php
include("../connect/conexion.php");

$DataSQl00 = "select * from cj_hijos ORDER BY h_fecha_naci ASC";
$DataSQl00 = mysql_query($DataSQl00);
echo "<ul>";
$DataNR = "--";
while($DataROW00 = mysql_fetch_array($DataSQl00)){
	$DataNRaux = $DataROW00["h_fecha_naci"].$DataROW00["h_apellido1"];
	if($DataNRaux!=$DataNR){
		$DataSQl01 = "select * from cj_hijos where h_fecha_naci='$DataROW00[h_fecha_naci]' and id_ninho!='$DataROW00[id_ninho]' and h_apellido1='$DataROW00[h_apellido1]' and h_apellido1='$DataROW00[h_nombre1]'";
		$DataSQl01 = mysql_query($DataSQl01);
		$i=0;
		$nav="<ul>";
		while($DataROW01 = mysql_fetch_array($DataSQl01)){
			$nav.="<li>$DataROW01[id_ninho] $DataROW01[h_apellido1] $DataROW01[h_apellido2] $DataROW01[h_nombre1] $DataROW01[h_nombre2] ($DataROW01[h_fecha_naci])";
			$i++;
		}
		$nav.="</ul>";
		
		if($i>0){
			echo "<li>$DataROW00[id_ninho] $DataROW00[h_apellido1] $DataROW00[h_apellido2] $DataROW00[h_nombre1] $DataROW00[h_nombre2] ($DataROW00[h_fecha_naci]) $nav</li>";
			$DataNR = $DataNRaux;
			echo "<li><hr></li>";
		}
	}
}
echo "</ul>";
?>
