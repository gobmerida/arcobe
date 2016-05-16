<?php
// Script para mostrar fecha en español
function fecha($fecha){
	list($anio, $mes, $dia) = explode("-",$fecha);
	if($mes=='1'){
		$mes_l = "Enero";
	}
	if($mes=='2'){
		$mes_l = "Febrero";
	}
	if($mes=='3'){
		$mes_l = "Marzo";
	}
	if($mes=='4'){
		$mes_l = "Abril";
	}
	if($mes=='5'){
		$mes_l = "Mayo";
	}
	if($mes=='6'){
		$mes_l = "Junio";
	}
	if($mes=='7'){
		$mes_l = "Julio";
	}
	if($mes=='8'){
		$mes_l = "Agosto";
	}
	if($mes=='9'){
		$mes_l = "Septiembre";
	}
	if($mes=='10'){
		$mes_l = "Octubre";
	}
	if($mes=='11'){
		$mes_l = "Noviembre";
	}
	if($mes=='12'){
		$mes_l = "Diciembre";
	}
	
	return $fecha = "$dia de $mes_l del $anio";
}
function mes($mes){
	if($mes=='1'){
		$mes_l = "Enero";
	}
	if($mes=='2'){
		$mes_l = "Febrero";
	}
	if($mes=='3'){
		$mes_l = "Marzo";
	}
	if($mes=='4'){
		$mes_l = "Abril";
	}
	if($mes=='5'){
		$mes_l = "Mayo";
	}
	if($mes=='6'){
		$mes_l = "Junio";
	}
	if($mes=='7'){
		$mes_l = "Julio";
	}
	if($mes=='8'){
		$mes_l = "Agosto";
	}
	if($mes=='9'){
		$mes_l = "Septiembre";
	}
	if($mes=='10'){
		$mes_l = "Octubre";
	}
	if($mes=='11'){
		$mes_l = "Noviembre";
	}
	if($mes=='12'){
		$mes_l = "Diciembre";
	}
	return $mes_l;
}
?>
