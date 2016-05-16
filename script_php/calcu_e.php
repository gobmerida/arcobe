<?php
function EdadEstimada($fecha,$anio_p){
			list($Y,$m,$d) = explode("-",$fecha);
			$ano=$anio_p;
			$mes=$m;
			$dia=$d;
			
			if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
			if ($m > $mes){ $ano=($ano-1);}
			$edad=($ano-$Y);
			return $edad;
		}
function EdadEstimadaN($fecha,$fechaL,$anio_p){
			list($Y,$m,$d) = explode("-",$fecha);
			list($Yl,$mes,$dia) = explode("-",$fechaL);
			$ano=$anio_p;
			
			if (($m == $mes) && ($d > $dia)){ $ano=($ano-1); }
			if ($m > $mes){ $ano=($ano-1);}
			$edad=($ano-$Y);
			return $edad;
		}
?>
