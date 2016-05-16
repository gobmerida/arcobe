<?php
function tipo_n($tipo_c){
	list($tipo_de_nomina, $codigo_nomina) = explode("-",$tipo_c);
	if($tipo_de_nomina=='CO' or $tipo_de_nomina=='COC'){
		$nom_tip="CONTRATADO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='EM' or $tipo_de_nomina=='EC' or $tipo_de_nomina=='EF' or $tipo_de_nomina=='PO' or $tipo_de_nomina=='BO'){
		$nom_tip="FIJO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='BE'){
		$nom_tip="CONTRATADO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='OS' or $tipo_de_nomina=='OF' or $tipo_de_nomina=='OB' or $tipo_de_nomina=='OP' or $tipo_de_nomina=='OO'){
		$nom_tip="FIJO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='SE'){
		$nom_tip="CASO ESPECIAL";
		return $nom_tip;
	}
	if($tipo_de_nomina=='FN' OR $tipo_de_nomina=='PL' OR $tipo_de_nomina=='IN' OR $tipo_de_nomina=='MU' OR $tipo_de_nomina=='FO' OR $tipo_de_nomina=='IM' OR $tipo_de_nomina=='PY' OR $tipo_de_nomina=='CM'){
		$nom_tip="INSTITUTO";
		return $nom_tip;
	}
	//OR $tipo_de_nomina=='INS'
}
function tipo_c($tipo_c){
	list($tipo_de_nomina, $codigo_nomina) = explode("-",$tipo_c);
	if($tipo_de_nomina=='CO' or $tipo_de_nomina=='COC'){
		$nom_tip="EMPLEADO CONTRATADO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='EM' or $tipo_de_nomina=='EC' or $tipo_de_nomina=='EF' or $tipo_de_nomina=='PO' or $tipo_de_nomina=='BO'){
		$nom_tip="EMPLEADO FIJO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='BE'){
		$nom_tip="OBRERO CONTRATADO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='OS' or $tipo_de_nomina=='OF' or $tipo_de_nomina=='OB' or $tipo_de_nomina=='OP' or $tipo_de_nomina=='OO'){
		$nom_tip="OBRERO FIJO";
		return $nom_tip;
	}
	if($tipo_de_nomina=='SE'){
		$nom_tip="CASO ESPECIAL";
		return $nom_tip;
	}
	if($tipo_de_nomina=='FN' OR $tipo_de_nomina=='PL' OR $tipo_de_nomina=='IN' OR $tipo_de_nomina=='MU' OR $tipo_de_nomina=='FO' OR $tipo_de_nomina=='IM' OR $tipo_de_nomina=='PY' OR $tipo_de_nomina=='CM'){
		$nom_tip="INSTITUTO";
		return $nom_tip;
	}
}
function tipo_ns($tipo_c){
	list($tipo_de_nomina, $codigo_nomina) = explode("-",$tipo_c);
	if($tipo_de_nomina=='CO' or $tipo_de_nomina=='COC'){
		$nom_tip="Empleado";
		return $nom_tip;
	}
	if($tipo_de_nomina=='EM' or $tipo_de_nomina=='EC' or $tipo_de_nomina=='EF' or $tipo_de_nomina=='PO' or $tipo_de_nomina=='BO'){
		$nom_tip="Empleado";
		return $nom_tip;
	}
	if($tipo_de_nomina=='BE'){
		$nom_tip="Obrero";
		return $nom_tip;
	}
	if($tipo_de_nomina=='OS' or $tipo_de_nomina=='OF' or $tipo_de_nomina=='OB' or $tipo_de_nomina=='OP' or $tipo_de_nomina=='OO'){
		$nom_tip="Obrero";
		return $nom_tip;
	}
	if($tipo_de_nomina=='SE'){
		$nom_tip="Caso Especial";
		return $nom_tip;
	}
	if($tipo_de_nomina=='FN' OR $tipo_de_nomina=='PL' OR $tipo_de_nomina=='IN' OR $tipo_de_nomina=='MU' OR $tipo_de_nomina=='FO' OR $tipo_de_nomina=='IM' OR $tipo_de_nomina=='PY' OR $tipo_de_nomina=='CM'){
		$nom_tip="INSTITUTO";
		return $nom_tip;
	}
}
function tipo_insti($tipo_c){
	list($tipo_de_nomina, $codigo_nomina) = explode("-",$tipo_c);
	if($tipo_de_nomina=='FN'){
		$nom_tip="fundacion";
		return $nom_tip;
	}
	if($tipo_de_nomina=='PL'){
		$nom_tip="policia";
		return $nom_tip;
	}
	if ($tipo_de_nomina=='IN'){
		$nom_tip="INMIVI";
		return $nom_tip;
	}
	if ($tipo_de_nomina=='MU'){
		$nom_tip="MUSCYT";
		return $nom_tip;
	}
	if ($tipo_de_nomina=='FO'){
		$nom_tip="FONHVIM";
		return $nom_tip;
	}
	if ($tipo_de_nomina=='CM'){//Cambiar esta condicion CO es EMPLEADO CONTRATADO
		$nom_tip="CONSTRUMERIDA";
		return $nom_tip;
	}
	if ($tipo_de_nomina=='IM'){
		$nom_tip="IMMFA";
		return $nom_tip;
	}
	if ($tipo_de_nomina=='PY'){//Cambiar esta condicion PE es PENSIONADO
		$nom_tip="PROYECTOS_ESPECIALES";
		return $nom_tip;
	}
}
?>
