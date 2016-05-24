<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" href="../estilo/g_estimado.css" type="text/css"/>
</head>

<body>
	<?php
	include("../connect/conexion.php");
	include("../script_php/condicion.php");
	include("../script_php/calcu_e.php");
	if(!array_key_exists('periodo',$_GET)){
		echo "Error no se cargo el periodo";
	}
	if(array_key_exists('periodo',$_GET)){
	$periodo = $_GET['periodo']; // Periodo a consultar
	
	//Consulta de periodo
	$cperido_sql = "SELECT * FROM pv_periodo_ce WHERE id_pvperiodo='$periodo'";
	$cperido_sql = mysql_query($cperido_sql) or die ("Error no se encontró periodo");
	$cperiodo = mysql_fetch_array($cperido_sql);
	
	//Consulta de los niños registrados
	$consulta_reg = "SELECT * FROM pv_planilla_ce
					WHERE id_periodo='$periodo'";
	$consulta_reg = mysql_query($consulta_reg) or die (mysql_error());
	// Consulta de los niños registrados (Otros)
	$consulta_regOtro = "SELECT * FROM pv_planillace
					WHERE id_periodo='$periodo' and token='1'";
	$consulta_regOtro = mysql_query($consulta_regOtro) or die (mysql_error());
	//Inicialización de contadores
	$contador=0;
	$recaudos=0;
	$empfijo=0;
	$empcont=0;
	$obrfijo=0;
	$obrcont=0;
	$casoes=0;
	$to_vg=0;
	$to_camp=0;
	$todalDOtros=0;
	// Calculos de las edades

	//Consulta contadores para totalizar tallas de chaquetas
	$c_tallasCha="SELECT * FROM pv_tachaqueta WHERE id_talla!='1'";
	$c_tallasCha=mysql_query($c_tallasCha) or die ("No se halló ninguna talla");
	$iterCha="";
	while($tallasCha = mysql_fetch_array($c_tallasCha)){
		$iterCha=$tallasCha['id_talla'];
		$a_tallaCha[$iterCha]=0;
	}
	//Consulta contadores para totalizar tallas de franelas
	$c_tallasFra="SELECT * FROM pv_tallafranela WHERE id_talla!='1'";
	$c_tallasFra=mysql_query($c_tallasFra) or die ("No se halló ninguna talla");
	$iterFra="";
	while($tallasFra = mysql_fetch_array($c_tallasFra)){
		$iterFra=$tallasFra['id_talla'];
		$a_tallaFra[$iterFra]=0;
	}
	//Consulta contadores para totalizar tallas de mono
	$c_tallasMon="SELECT * FROM pv_tmono WHERE id_talla!='1'";
	$c_tallasMon=mysql_query($c_tallasMon) or die ("No se halló ninguna talla");
	$iterMon="";
	while($tallasMon = mysql_fetch_array($c_tallasMon)){
		$iterMon=$tallasMon['id_talla'];
		$a_tallaMon[$iterMon]=0;
	}
	//Consulta contadores para totalizar tallas de gorra
	$c_tallasGorr="SELECT * FROM pv_tgorra WHERE id_talla!='1'";
	$c_tallasGorr=mysql_query($c_tallasGorr) or die ("No se halló ninguna talla");
	$iterGorr="";
	while($tallasGorr = mysql_fetch_array($c_tallasGorr)){
		$iterGorr=$tallasGorr['id_talla'];
		$a_tallaGorr[$iterGorr]=0;
	}
	
	// Niñas
	
	//Consulta contadores para totalizar tallas de chaquetas Niñas
	$c_tallasChaNina="SELECT * FROM pv_tachaqueta WHERE id_talla!='1'";
	$c_tallasChaNina=mysql_query($c_tallasChaNina) or die ("No se halló ninguna talla");
	$iterChaNina="";
	while($tallasChaNina = mysql_fetch_array($c_tallasChaNina)){
		$iterChaNina=$tallasChaNina['id_talla'];
		$a_tallaChaNina[$iterChaNina]=0;
	}
	//Consulta contadores para totalizar tallas de franelas Niñas
	$c_tallasFraNina="SELECT * FROM pv_tallafranela WHERE id_talla!='1'";
	$c_tallasFraNina=mysql_query($c_tallasFraNina) or die ("No se halló ninguna talla");
	$iterFraNina="";
	while($tallasFraNina = mysql_fetch_array($c_tallasFraNina)){
		$iterFraNina=$tallasFraNina['id_talla'];
		$a_tallaFraNina[$iterFraNina]=0;
	}
	//Consulta contadores para totalizar tallas de mono Niñas
	$c_tallasMonNina="SELECT * FROM pv_tmono WHERE id_talla!='1'";
	$c_tallasMonNina=mysql_query($c_tallasMonNina) or die ("No se halló ninguna talla");
	$iterMonNina="";
	while($tallasMonNina = mysql_fetch_array($c_tallasMonNina)){
		$iterMonNina=$tallasMonNina['id_talla'];
		$a_tallaMonNina[$iterMonNina]=0;
	}
	//Consulta contadores para totalizar tallas de gorra Niñas
	$c_tallasGorrNina="SELECT * FROM pv_tgorra WHERE id_talla!='1'";
	$c_tallasGorrNina=mysql_query($c_tallasGorrNina) or die ("No se halló ninguna talla");
	$iterGorrNina="";
	while($tallasGorrNina = mysql_fetch_array($c_tallasGorrNina)){
		$iterGorrNina=$tallasGorrNina['id_talla'];
		$a_tallaGorrNina[$iterGorrNina]=0;
	}
	
	// Niños
	
	//Consulta contadores para totalizar tallas de chaquetas Niños
	$c_tallasChaNino="SELECT * FROM pv_tachaqueta WHERE id_talla!='1'";
	$c_tallasChaNino=mysql_query($c_tallasChaNino) or die ("No se halló ninguna talla");
	$iterChaNino="";
	while($tallasChaNino = mysql_fetch_array($c_tallasChaNino)){
		$iterChaNino=$tallasChaNino['id_talla'];
		$a_tallaChaNino[$iterChaNino]=0;
	}
	//Consulta contadores para totalizar tallas de franelas Niños
	$c_tallasFraNino="SELECT * FROM pv_tallafranela WHERE id_talla!='1'";
	$c_tallasFraNino=mysql_query($c_tallasFraNino) or die ("No se halló ninguna talla");
	$iterFraNino="";
	while($tallasFraNino = mysql_fetch_array($c_tallasFraNino)){
		$iterFraNino=$tallasFraNino['id_talla'];
		$a_tallaFraNino[$iterFraNino]=0;
	}
	//Consulta contadores para totalizar tallas de mono Niños
	$c_tallasMonNino="SELECT * FROM pv_tmono WHERE id_talla!='1'";
	$c_tallasMonNino=mysql_query($c_tallasMonNino) or die ("No se halló ninguna talla");
	$iterMonNino="";
	while($tallasMonNino = mysql_fetch_array($c_tallasMonNino)){
		$iterMonNino=$tallasMonNino['id_talla'];
		$a_tallaMonNino[$iterMonNino]=0;
	}
	//Consulta contadores para totalizar tallas de gorra Niños
	$c_tallasGorrNino="SELECT * FROM pv_tgorra WHERE id_talla!='1'";
	$c_tallasGorrNino=mysql_query($c_tallasGorrNino) or die ("No se halló ninguna talla");
	$iterGorrNino="";
	while($tallasGorrNino = mysql_fetch_array($c_tallasGorrNino)){
		$iterGorrNino=$tallasGorrNino['id_talla'];
		$a_tallaGorrNino[$iterGorrNino]=0;
	}
	//Un repita para totalizar los estimados/reportes
	while($registrados = mysql_fetch_array($consulta_reg)){
		
		if($registrados['pv_fotos']!="" and $registrados['pv_certificado']!="" and $registrados['pv_habilidades']!="" and $registrados['pv_gustos']!="" and $registrados['pv_vacunas']!="" and $registrados['pv_alergias']!="" and $registrados['pv_tratamiento']!="" and $registrados['pv_alimentosp']!="" and $registrados['pv_medicamentosp']!="" and $registrados['pv_tchaqueta']!="1" and $registrados['pv_tfranela']!="1" and $registrados['pv_tmono']!="1" and $registrados['pv_tgorra']!="1" and $registrados['pv_contacto_cedula']!="" and $registrados['pv_contacto_nombre']!="" and $registrados['pv_contacto_apellido']!="" and $registrados['pv_contacto_telefono']!="" and $registrados['pv_contacto_parentesco']!="1"){
			$cond_t = tipo_c($registrados['codigo_trb']);
			if($cond_t=="EMPLEADO FIJO"){
				$empfijo=$empfijo+1;
			}
			if($cond_t=="EMPLEADO CONTRATADO"){
				$empcont=$empcont+1;
			}
			if($cond_t=="OBRERO FIJO"){
				$obrfijo=$obrfijo+1;
			}
			if($cond_t=="OBRERO CONTRATADO"){
				$obrcont=$obrcont+1;
			}
			if($cond_t=="CASO ESPECIAL"){
				$casoes=$casoes+1;
			}
			if($registrados['pv_destino']=="2"){
				$to_vg=$to_vg+1;
			}
			if($registrados['pv_destino']=="1"){
				$to_camp=$to_camp+1;
			}
			$t_chaq = $registrados['pv_tchaqueta'];
			$t_fra = $registrados['pv_tfranela'];
			$t_mon = $registrados['pv_tmono'];
			$t_gorr = $registrados['pv_tgorra'];
			$edad_dnino=EdadEstimadaN($registrados['h_fecha_naci'],$cperiodo['pv_fecha_limite'],$cperiodo['pv_añoperiodo']);
			if($registrados['h_sexo']=="F"){
				//Chaquetas
				$a_tallaChaNina[$t_chaq]=$a_tallaChaNina[$t_chaq]+1;
				
				//Franelas
				$a_tallaFraNina[$t_fra]=$a_tallaFraNina[$t_fra]+1;
				
				//Monos
				$a_tallaMonNina[$t_mon]=$a_tallaMonNina[$t_mon]+1;
				
				//Gorras
				$a_tallaGorrNina[$t_gorr]=$a_tallaGorrNina[$t_gorr]+1;
			}
			if($registrados['h_sexo']=="M"){
				//Chaquetas
				$a_tallaChaNino[$t_chaq]=$a_tallaChaNino[$t_chaq]+1;
				
				//Franelas
				$a_tallaFraNino[$t_fra]=$a_tallaFraNino[$t_fra]+1;
				
				//Monos
				$a_tallaMonNino[$t_mon]=$a_tallaMonNino[$t_mon]+1;
				
				//Gorras
				$a_tallaGorrNino[$t_gorr]=$a_tallaGorrNino[$t_gorr]+1;
			}
			//Chaquetas
			$a_tallaCha[$t_chaq]=$a_tallaCha[$t_chaq]+1;
			
			//Franelas
			$a_tallaFra[$t_fra]=$a_tallaFra[$t_fra]+1;
			
			//Monos
			$a_tallaMon[$t_mon]=$a_tallaMon[$t_mon]+1;
			
			//Gorras
			$a_tallaGorr[$t_gorr]=$a_tallaGorr[$t_gorr]+1;
			
			$contador=$contador+1;
		}
		else $recaudos=$recaudos+1;
	}
	while($registradosOtr = mysql_fetch_array($consulta_regOtro)){
		
		if($registradosOtr['pv_fotos']!="" and $registradosOtr['pv_certificado']!="" and $registradosOtr['pv_habilidades']!="" and $registradosOtr['pv_gustos']!="" and $registradosOtr['pv_vacunas']!="" and $registradosOtr['pv_alergias']!="" and $registradosOtr['pv_tratamiento']!="" and $registradosOtr['pv_alimentosp']!="" and $registradosOtr['pv_medicamentosp']!="" and $registradosOtr['pv_tchaqueta']!="1" and $registradosOtr['pv_tfranela']!="1" and $registradosOtr['pv_tmono']!="1" and $registradosOtr['pv_tgorra']!="1" and $registradosOtr['pv_contacto_cedula']!="" and $registradosOtr['pv_contacto_nombre']!="" and $registradosOtr['pv_contacto_apellido']!="" and $registradosOtr['pv_contacto_telefono']!="" and $registradosOtr['pv_contacto_parentesco']!="1"){
			if($registradosOtr['pv_destino']=="2"){
				$to_vg=$to_vg+1;
			}
			if($registradosOtr['pv_destino']=="1"){
				$to_camp=$to_camp+1;
			}
			
			$t_chaq = $registradosOtr['pv_tchaqueta'];
			$t_fra = $registradosOtr['pv_tfranela'];
			$t_mon = $registradosOtr['pv_tmono'];
			$t_gorr = $registradosOtr['pv_tgorra'];
			$edad_dnino=EdadEstimadaN($registradosOtr['h_fecha_naci'],$cperiodo['pv_fecha_limite'],$cperiodo['pv_añoperiodo']);
			if($registradosOtr['h_sexo']=="F"){
				//Chaquetas
				$a_tallaChaNina[$t_chaq]=$a_tallaChaNina[$t_chaq]+1;
				
				//Franelas
				$a_tallaFraNina[$t_fra]=$a_tallaFraNina[$t_fra]+1;
				
				//Monos
				$a_tallaMonNina[$t_mon]=$a_tallaMonNina[$t_mon]+1;
				
				//Gorras
				$a_tallaGorrNina[$t_gorr]=$a_tallaGorrNina[$t_gorr]+1;
			}
			if($registradosOtr['h_sexo']=="M"){
				//Chaquetas
				$a_tallaChaNino[$t_chaq]=$a_tallaChaNino[$t_chaq]+1;
				
				//Franelas
				$a_tallaFraNino[$t_fra]=$a_tallaFraNino[$t_fra]+1;
				
				//Monos
				$a_tallaMonNino[$t_mon]=$a_tallaMonNino[$t_mon]+1;
				
				//Gorras
				$a_tallaGorrNino[$t_gorr]=$a_tallaGorrNino[$t_gorr]+1;
			}
			//Chaquetas
			$a_tallaCha[$t_chaq]=$a_tallaCha[$t_chaq]+1;
			
			//Franelas
			$a_tallaFra[$t_fra]=$a_tallaFra[$t_fra]+1;
			
			//Monos
			$a_tallaMon[$t_mon]=$a_tallaMon[$t_mon]+1;
			
			//Gorras
			$a_tallaGorr[$t_gorr]=$a_tallaGorr[$t_gorr]+1;
			
			$todalDOtros=$todalDOtros+1;
			
			$contador=$contador+1;
		}
		else $recaudos=$recaudos+1;
	}
	?>
	<div id="resumen">
		<?php
		
		//Totales talla chaqueta
		$co_tallasCha="SELECT * FROM pv_tachaqueta WHERE id_talla!='1'";
		$co_tallasCha=mysql_query($co_tallasCha) or die ("No se halló ninguna talla");
		$iterChao="";
		$chaq_tot=0;
		$table_chaq="<p class='table_talla'>Talla de Chaquetas</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasChao = mysql_fetch_array($co_tallasCha)){
			$iterChao=$tallasChao['id_talla'];
			$table_chaq.= "<tr><td>$tallasChao[pv_tchaqueta]</td><td>".$a_tallaCha[$iterChao]."</td></tr>";
			$chaq_tot=$chaq_tot+$a_tallaCha[$iterChao];
		}
		$table_chaq.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$chaq_tot</td></tr>";
		$table_chaq.="</table>";
		
		//Totales talla franela
		$co_tallasFra="SELECT * FROM pv_tallafranela WHERE id_talla!='1'";
		$co_tallasFra=mysql_query($co_tallasFra) or die ("No se halló ninguna talla");
		$iterFrao="";
		$fran_tot=0;
		$table_Fran="<p class='table_talla'>Talla de Franelas</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasFrao = mysql_fetch_array($co_tallasFra)){
			$iterFrao=$tallasFrao['id_talla'];
			$table_Fran.= "<tr><td>$tallasFrao[pv_tfranela]</td><td>".$a_tallaFra[$iterFrao]."</td></tr>";
			$fran_tot=$fran_tot+$a_tallaFra[$iterFrao];
		}
		$table_Fran.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$fran_tot</td></tr>";
		$table_Fran.="</table>";
		
		//Totales talla mono
		$co_tallasMon="SELECT * FROM pv_tmono WHERE id_talla!='1'";
		$co_tallasMon=mysql_query($co_tallasMon) or die ("No se halló ninguna talla");
		$iterMono="";
		$mono_tot=0;
		$table_Mono="<p class='table_talla'>Talla de Monos</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasMono = mysql_fetch_array($co_tallasMon)){
			$iterMono=$tallasMono['id_talla'];
			$table_Mono.= "<tr><td>$tallasMono[pv_tmono]</td><td>".$a_tallaMon[$iterMono]."</td></tr>";
			$mono_tot=$mono_tot+$a_tallaMon[$iterMono];
		}
		$table_Mono.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$mono_tot</td></tr>";
		$table_Mono.="</table>";
		
		//Totales talla gorra
		$co_tallasGorr="SELECT * FROM pv_tgorra WHERE id_talla!='1'";
		$co_tallasGorr=mysql_query($co_tallasGorr) or die ("No se halló ninguna talla");
		$iterGorro="";
		$gorr_tot=0;
		$table_Gorra="<p class='table_talla'>Talla de Gorras</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasGorra = mysql_fetch_array($co_tallasGorr)){
			$iterGorro=$tallasGorra['id_talla'];
			$table_Gorra.= "<tr><td>$tallasGorra[pv_tgorra]</td><td>".$a_tallaGorr[$iterGorro]."</td></tr>";
			$gorr_tot=$gorr_tot+$a_tallaGorr[$iterGorro];
		}
		$table_Gorra.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$gorr_tot</td></tr>";
		$table_Gorra.="</table>";
		
		//Totales talla chaqueta Niña
		$co_tallasChaNina="SELECT * FROM pv_tachaqueta WHERE id_talla!='1'";
		$co_tallasChaNina=mysql_query($co_tallasChaNina) or die ("No se halló ninguna talla");
		$iterChaoNina="";
		$chaq_totNina=0;
		$table_chaqNina="<p class='table_talla'>Talla de Chaquetas</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasChaoNina = mysql_fetch_array($co_tallasChaNina)){
			$iterChaoNina=$tallasChaoNina['id_talla'];
			$table_chaqNina.= "<tr><td>$tallasChaoNina[pv_tchaqueta]</td><td>".$a_tallaChaNina[$iterChaoNina]."</td></tr>";
			$chaq_totNina=$chaq_totNina+$a_tallaChaNina[$iterChaoNina];
		}
		$table_chaqNina.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$chaq_totNina</td></tr>";
		$table_chaqNina.="</table>";
		
		//Totales talla franela Niña
		$co_tallasFraNina="SELECT * FROM pv_tallafranela WHERE id_talla!='1'";
		$co_tallasFraNina=mysql_query($co_tallasFraNina) or die ("No se halló ninguna talla");
		$iterFraoNina="";
		$fran_totNina=0;
		$table_FranNina="<p class='table_talla'>Talla de Franelas</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasFraoNina = mysql_fetch_array($co_tallasFraNina)){
			$iterFraoNina=$tallasFraoNina['id_talla'];
			$table_FranNina.= "<tr><td>$tallasFraoNina[pv_tfranela]</td><td>".$a_tallaFraNina[$iterFraoNina]."</td></tr>";
			$fran_totNina=$fran_totNina+$a_tallaFraNina[$iterFraoNina];
		}
		$table_FranNina.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$fran_totNina</td></tr>";
		$table_FranNina.="</table>";
		
		//Totales talla mono Niña
		$co_tallasMonNina="SELECT * FROM pv_tmono WHERE id_talla!='1'";
		$co_tallasMonNina=mysql_query($co_tallasMonNina) or die ("No se halló ninguna talla");
		$iterMonoNina="";
		$mono_totNina=0;
		$table_MonoNina="<p class='table_talla'>Talla de Monos</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasMonoNina = mysql_fetch_array($co_tallasMonNina)){
			$iterMonoNina=$tallasMonoNina['id_talla'];
			$table_MonoNina.= "<tr><td>$tallasMonoNina[pv_tmono]</td><td>".$a_tallaMonNina[$iterMonoNina]."</td></tr>";
			$mono_totNina=$mono_totNina+$a_tallaMonNina[$iterMonoNina];
		}
		$table_MonoNina.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$mono_totNina</td></tr>";
		$table_MonoNina.="</table>";
		
		//Totales talla gorra Niña
		$co_tallasGorrNina="SELECT * FROM pv_tgorra WHERE id_talla!='1'";
		$co_tallasGorrNina=mysql_query($co_tallasGorrNina) or die ("No se halló ninguna talla");
		$iterGorroNina="";
		$gorr_totNina=0;
		$table_GorraNina="<p class='table_talla'>Talla de Gorras</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasGorraNina = mysql_fetch_array($co_tallasGorrNina)){
			$iterGorroNina=$tallasGorraNina['id_talla'];
			$table_GorraNina.= "<tr><td>$tallasGorraNina[pv_tgorra]</td><td>".$a_tallaGorrNina[$iterGorroNina]."</td></tr>";
			$gorr_totNina=$gorr_totNina+$a_tallaGorrNina[$iterGorroNina];
		}
		$table_GorraNina.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$gorr_totNina</td></tr>";
		$table_GorraNina.="</table>";
		
		//Totales talla chaqueta Niño
		$co_tallasChaNino="SELECT * FROM pv_tachaqueta WHERE id_talla!='1'";
		$co_tallasChaNino=mysql_query($co_tallasChaNino) or die ("No se halló ninguna talla");
		$iterChaoNino="";
		$chaq_totNino=0;
		$table_chaqNino="<p class='table_talla'>Talla de Chaquetas</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasChaoNino = mysql_fetch_array($co_tallasChaNino)){
			$iterChaoNino=$tallasChaoNino['id_talla'];
			$table_chaqNino.= "<tr><td>$tallasChaoNino[pv_tchaqueta]</td><td>".$a_tallaChaNino[$iterChaoNino]."</td></tr>";
			$chaq_totNino=$chaq_totNino+$a_tallaChaNino[$iterChaoNino];
		}
		$table_chaqNino.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$chaq_totNino</td></tr>";
		$table_chaqNino.="</table>";
		
		//Totales talla franela Niño
		$co_tallasFraNino="SELECT * FROM pv_tallafranela WHERE id_talla!='1'";
		$co_tallasFraNino=mysql_query($co_tallasFraNino) or die ("No se halló ninguna talla");
		$iterFraoNino="";
		$fran_totNino=0;
		$table_FranNino="<p class='table_talla'>Talla de Franelas</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasFraoNino = mysql_fetch_array($co_tallasFraNino)){
			$iterFraoNino=$tallasFraoNino['id_talla'];
			$table_FranNino.= "<tr><td>$tallasFraoNino[pv_tfranela]</td><td>".$a_tallaFraNino[$iterFraoNino]."</td></tr>";
			$fran_totNino=$fran_totNino+$a_tallaFraNino[$iterFraoNino];
		}
		$table_FranNino.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$fran_totNino</td></tr>";
		$table_FranNino.="</table>";
		
		//Totales talla mono Niño
		$co_tallasMonNino="SELECT * FROM pv_tmono WHERE id_talla!='1'";
		$co_tallasMonNino=mysql_query($co_tallasMonNino) or die ("No se halló ninguna talla");
		$iterMonoNino="";
		$mono_totNino=0;
		$table_MonoNino="<p class='table_talla'>Talla de Monos</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasMonoNino = mysql_fetch_array($co_tallasMonNino)){
			$iterMonoNino=$tallasMonoNino['id_talla'];
			$table_MonoNino.= "<tr><td>$tallasMonoNino[pv_tmono]</td><td>".$a_tallaMonNino[$iterMonoNino]."</td></tr>";
			$mono_totNino=$mono_totNino+$a_tallaMonNino[$iterMonoNino];
		}
		$table_MonoNino.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$mono_totNino</td></tr>";
		$table_MonoNino.="</table>";
		
		//Totales talla gorra Niño
		$co_tallasGorrNino="SELECT * FROM pv_tgorra WHERE id_talla!='1'";
		$co_tallasGorrNino=mysql_query($co_tallasGorrNino) or die ("No se halló ninguna talla");
		$iterGorroNino="";
		$gorr_totNino=0;
		$table_GorraNino="<p class='table_talla'>Talla de Gorras</p><table class='estimados' style='text-align:center'><tr class='somb'><td>Talla</td><td>Total</td></tr>";
		while($tallasGorraNino = mysql_fetch_array($co_tallasGorrNino)){
			$iterGorroNino=$tallasGorraNino['id_talla'];
			$table_GorraNino.= "<tr><td>$tallasGorraNino[pv_tgorra]</td><td>".$a_tallaGorrNino[$iterGorroNino]."</td></tr>";
			$gorr_totNino=$gorr_totNino+$a_tallaGorrNino[$iterGorroNino];
		}
		$table_GorraNino.="<tr class='som'><td style='border:none;background-color:white'>Totales</td><td>$gorr_totNino</td></tr>";
		$table_GorraNino.="</table>";
		
		//Cierre de periodo (Estimados/Reportes)
		if($cperiodo['cierre']=="0"){
			echo "<h3>Estimados Casos Especiales</h3>";
		}
		if($cperiodo['cierre']=="1"){
			echo "<h3>Reporte Casos Especiales</h3>";
		}
		$total_emp=$empfijo+$empcont;
		$total_obr=$obrfijo+$obrcont;
		$todalDOtros=$todalDOtros+$casoes;
		$total=$empfijo+$empcont+$obrfijo+$obrcont+$todalDOtros;
			echo "
			<a href='ConsultaPVCE.php?peri=$periodo'>Exportar</a>
			<table class='estimados'>
			<tr><td>Total Beneficiados:</td><td class='totales'>$contador</td></tr>
			<tr><td>Total Beneficiados con recaudos pendientes:</td><td class='totales'>$recaudos</td></tr>
			</table>
			<br>
			<table class='estimados'>
			<tr><td>Visita Guiada:</td><td class='totales'>$to_vg</td></tr>
			<tr><td>Campamento:</td><td class='totales'>$to_camp</td></tr>
			</table>
			<br>
			<table class='estimados'>
			<tr><td>Total niños(as) de empleados fijos:</td><td class='totales'>$empfijo</td></tr>
			<tr><td>Total niños(as) de empleados contratados:</td><td class='totales'>$empcont</td></tr>
			<tr class='somb'><td>Total niños(as) de empleados</td><td class='totales'>$total_emp</td></tr>
			<tr><td>Total niños(as) de obreros fijos:</td><td class='totales'>$obrfijo</td></tr>
			<tr><td>Total niños(as) de obreros contratados:</td><td class='totales'>$obrcont</td></tr>
			<tr class='somb'><td>Total niños(as) de obreros:</td><td class='totales'>$total_obr</td></tr>
			<tr class='somb'><td>Total niños(as) (Otros casos):</td><td class='totales'>$todalDOtros</td></tr>
			<tr><td style='text-align:right'>Total:</td><td class='totales'>$total</td></tr>
			</table>
			<br>
			<h3 style='center'>Total tallas</h3>
			<div id='gt_chaqueta'>
			$table_chaq
			</div>
			<div id='gt_franela'>
			$table_Fran
			</div>
			<div id='gt_mono'>
			$table_Mono
			</div>
			<div id='gt_gorra'>
			$table_Gorra
			</div>
			<br>
			<h3 style='center'>Niñas</h3>
			<div id='gt_chaquetaNina'>
			$table_chaqNina
			</div>
			<div id='gt_franelaNina'>
			$table_FranNina
			</div>
			<div id='gt_monoNina'>
			$table_MonoNina
			</div>
			<div id='gt_gorraNina'>
			$table_GorraNina
			</div>
			<br>
			<h3 style='center'>Niños</h3>
			<div id='gt_chaquetaNino'>
			$table_chaqNino
			</div>
			<div id='gt_franelaNino'>
			$table_FranNino
			</div>
			<div id='gt_monoNino'>
			$table_MonoNino
			</div>
			<div id='gt_gorraNino'>
			$table_GorraNino
			</div>
			<br>
			<br>
			<div id='pie'></div>
			";
		?>
	</div>
	<?php } ?>
</body>

</html>
