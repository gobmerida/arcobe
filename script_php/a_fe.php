<?php
function a_fecha($fecha){
	list($anio, $mes, $dia) = explode("-",$fecha);
	return $fecha = $dia."/".$mes."/".$anio;
}
function an_fecha($fecha){
	list($dia, $mes, $anio) = explode("/",$fecha);
	return $fecha = $anio."-".$mes."-".$dia;
}
function anio_fecha($fecha){
	$fecha = substr($fecha, 0, -9);
	list($anio, $mes, $dia) = explode("-",$fecha);
	return $fecha = $dia."/".$mes."/".$anio;
}
function hora($hora){
	$hora = substr($hora, -8, -3);
	list($hour, $minuto) = explode(":",$hora);
	if($hour<=11){
		$am_pm="am";
	}
	if($hour>11){
		$am_pm="pm";
	}
	if($hour==13){
		$hour="1";
	}
	if($hour==14){
		$hour="2";
	}
	if($hour==15){
		$hour="3";
	}
	if($hour==16){
		$hour="4";
	}
	if($hour==17){
		$hour="5";
	}
	if($hour==18){
		$hour="6";
	}
	if($hour==19){
		$hour="7";
	}
	if($hour==20){
		$hour="8";
	}
	if($hour==21){
		$hour="9";
	}
	if($hour==22){
		$hour="10";
	}
	if($hour==23){
		$hour="11";
	}
	if($hour==0){
		$hour="12";
	}
	$hora = $hour.":".$minuto." ".$am_pm.".";
	return $hora;
}
?>
