<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Cuaderno</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
	<link rel="stylesheet" href="../js/calendario/jquery-ui.css" type="text/css"/>
	<script type="text/javascript" src="../js/calendario/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="../js/calendario/jquery-ui.js"></script>
	<style>
	body{
		font-family:"Courier 10 Pitch";
	}
  #selectable2 .ui-selecting { background: #FECA40; }
  #selectable2 .ui-selected { background: #c00; color: white; }
  #selectable2 .ui-selected:hover { background: #c00; color: white; }
  #selectable2 { list-style-type: none; margin: 0; padding: 0; font-size:10px}
  #selectable2 li { margin: 3px; padding: 0.4em; height: 18px; cursor:pointer; font-weight:bold}
  #selectable2 li:hover { color:#c00; background:gainsboro}
  .ui-confirmado{background-color:#73B37C}
  .ui-cont-mod{border: 1px solid #EEE;color: #333;}
  .exportar{text-decoration:none;border:2px solid silver;border-radius:5px;padding:3.5px;background:linear-gradient(gainsboro,silver);box-shadow:4px 4px 4px}
  .exportar:active{background:linear-gradient(silver,gainsboro)}
  .exportar:hover{box-shadow:4px 4px 4px grey}
	</style>
	  <script>
  $(function() {
    $( "#selectable2" ).selectable();
  });
  </script>
</head>

<body>
<a href="../consultas/exportar_pv.php?periodo=<?php echo $_GET["periodo"];?>" class="exportar">Exportar Cuaderno</a>
<?php
include("../connect/conexion.php");
$data01 = $_GET["periodo"];
$DataSQL00 = "select *
			  from pv_cuaderno
			  join cj_trabajadores
			  on pv_cuaderno.ced_tbr=cj_trabajadores.trb_cedula
			  where activo='1' and Periodo='$data01'";
$DataSQL00 = mysql_query($DataSQL00);

$i=0;
echo '<h2 style="color:#c00">Listado de trabajadores</h2><ol id="selectable2">';
$KidsNumberTotal=0;
while( $DataROW00 = mysql_fetch_array($DataSQL00) ){
	$DataSQL01 = "select cj_hijos.*
				  from cj_hijos
				  join pv_inscrip
				  on cj_hijos.id_ninho = pv_inscrip.id_ninho_pv
				  where id_periodo='$data01' and cedula_mp='$DataROW00[trb_cedula]' or cedula_repr='$DataROW00[trb_cedula]'";
	$DataSQL01 = mysql_query($DataSQL01);
	$KidsNumber=0;
	
	while($DataROW01 = mysql_fetch_array($DataSQL01)){
		$KidsNumber++;
		$KidsNumberTotal++;
	}
	echo "<li class='ui-cont-mod ui-corner-all'>[Página: $DataROW00[Npagina] / Línea: $DataROW00[Nlinea]] [$DataROW00[trb_codigo]] C.I. $DataROW00[trb_cedula] - $DataROW00[trb_nombres] $DataROW00[trb_apellidos] - Número de beneficiario: ($KidsNumber)</li>";
	$i++;
}
echo "<li><hr></li><li>Total de trabajadores $i</li><li>Total de beneficiario $KidsNumberTotal</li></ol>";
?>
	
</body>

</html>
