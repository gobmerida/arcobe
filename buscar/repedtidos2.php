<span style='color:red;font-weight:bold'>Buscar por ambos apellidos</span>
<?php
include("../connect/conexion.php");

$DataSQl00 = "select * from cj_hijos ORDER BY h_apellido1 ASC";
$DataSQl00 = mysql_query($DataSQl00);
echo "<ul>";
$DataNR = "--";
while($DataROW00 = mysql_fetch_array($DataSQl00)){
	$DataNRaux = "$DataROW00[h_apellido1] $DataROW00[h_apellido2]";
	if($DataNRaux!=$DataNR){
		$DataSQl01 = "select * from cj_hijos where concat(h_apellido1,' ',h_apellido2) like '$DataROW00[h_apellido1] $DataROW00[h_apellido2]%' and id_ninho!='$DataROW00[id_ninho]'";
		$DataSQl01 = mysql_query($DataSQl01);
		$i=0;
		$nav="<ul>";
		while($DataROW01 = mysql_fetch_array($DataSQl01)){
			$nav.="<li>$DataROW01[id_ninho] $DataROW01[h_apellido1] $DataROW01[h_apellido2] $DataROW01[h_nombre1] $DataROW01[h_nombre2]";
			$i++;
		}
		$nav.="</ul>";
		
		if($i>0){
			echo "<li>$DataROW00[id_ninho] $DataROW00[h_apellido1] $DataROW00[h_apellido2] $DataROW00[h_nombre1] $DataROW00[h_nombre2] $nav</li>";
			$DataNR = "$DataROW00[h_apellido1] $DataROW00[h_apellido2]";
			echo "<li><hr></li>";
		}
	}
}
echo "</ul>";
?>
