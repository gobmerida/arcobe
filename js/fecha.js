function noval(formulario){
		var fecha=document.getElementById('f_rangeStart2').value;
		var fecha_ante=document.getElementById('fecha_ante').value;
		var elem = fecha.split('/');
		var dia = elem[2];
		var mes = elem[1];
		var anio = elem[0];
		
		fecha = anio+"-"+mes+"-"+dia;
		
		var d = Date.parse(<?php echo "'".date("Y-m-d")."'"?>);
		var e = Date.parse(fecha);
		
		if(d < e){
			alert('¡Fecha superior a la actual!');
			return false;
		}
		
		var fall= Date.parse(fecha_ante);
		
		if(e<fall){
			alert('¡Fecha inferior a la fecha de llegada!');
			return false;
		}
		
		if(formulario.f_rangeStart2.value.length==0){
			document.getElementById("f_rangeStart2").style.border = "2px solid red";
			formulario.f_rangeStart2.focus();   
			alert('¡Ingresar la fecha!');
			return false;
		}
	return true;
	}
