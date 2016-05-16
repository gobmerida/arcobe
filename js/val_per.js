function validar_periodo(formulario){
	if(formulario.com_periodo.value.length==0){
		document.getElementById("com_periodo").style.border = "2px inset red";
		formulario.com_periodo.focus();
		$('#error_fechain').toggle('drop');
		document.getElementById("f_sub").disabled=false;
		document.getElementById("f_sub").value='Enviar';
		return false;
	}
	if(formulario.fin_periodo.value.length==0){
		document.getElementById("fin_periodo").style.border = "2px inset red";
		formulario.fin_periodo.focus();
		$('#error_fechafin').toggle('drop');
		document.getElementById("f_sub").disabled=false;
		document.getElementById("f_sub").value='Enviar';
		return false;
	}
	if(formulario.fecha_requerida.value.length==0){
		document.getElementById("fecha_requerida").style.border = "2px inset red";
		formulario.fecha_requerida.focus();
		$('#error_fechaLire').toggle('drop');
		document.getElementById("f_sub").disabled=false;
		document.getElementById("f_sub").value='Enviar';
		return false;
	}
	if(formulario.pv_decampovigui.value.length==0){
		document.getElementById("pv_decampovigui").style.border = "2px inset red";
		formulario.pv_decampovigui.focus();
		$('#error_fechaITop').toggle('drop');
		document.getElementById("f_sub").disabled=false;
		document.getElementById("f_sub").value='Enviar';
		return false;
	}
	if(formulario.fecha_limite.value.length==0){
		document.getElementById("fecha_limite").style.border = "2px inset red";
		formulario.fecha_limite.focus();
		$('#error_fechaLi').toggle('drop');
		document.getElementById("f_sub").disabled=false;
		document.getElementById("f_sub").value='Enviar';
		return false;
	}
	if(formulario.com_periodo.value.length!=0 && formulario.fin_periodo.value.length!=0 && formulario.fecha_requerida.value.length!=0 && formulario.pv_decampovigui.value.length!=0 && formulario.fecha_limite.value.length!=0){
		document.getElementById("f_sub").disabled=true;
		document.getElementById("f_sub").value='Enviando...';
		document.getElementById("f_sub").form.submit()
	}
	return true;
}
function oc_error(){
	$('#error_fechain').fadeOut(0);
	$('#error_fechafin').fadeOut(0);
	$('#error_fechaLi').fadeOut(0);
	$('#error_fechafinsub').fadeOut(0);
	$('#error_fechaLimi').fadeOut(0);
	$('#error_fechaReque').fadeOut(0);
	$('#error_fechaLire').fadeOut(0);
	$('#error_fechaITop').fadeOut(0);
	$('#error_fechaTop').fadeOut(0);
}
function OcErrorFe(){
	$('#error_fechain').fadeOut(0);
	document.getElementById("com_periodo").style.border = "2px inset silver";
}
function OcErrorFeI(){
	$('#error_fechafin').fadeOut(0);
	$('#error_fechafinsub').fadeOut(0);
	document.getElementById("fin_periodo").style.border = "2px inset silver";
	var fecha_inicio=document.getElementById('com_periodo').value;
	if(fecha_inicio.length==0){
		document.getElementById("com_periodo").style.border = "2px inset red";
		document.getElementById("com_periodo").focus();
		document.getElementById("fin_periodo").value="";
		$('#error_fechain').toggle('drop');
	}
	var elem = fecha_inicio.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_inicio = anio+"-"+mes+"-"+dia;
	var fecha_fin=document.getElementById('fin_periodo').value;
	var elem = fecha_fin.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_fin = anio+"-"+mes+"-"+dia;
	
	var i = Date.parse(fecha_inicio);
	var f = Date.parse(fecha_fin);
	
	if(i > f){
		$('#error_fechafinsub').toggle('drop');
		document.getElementById("f_sub").disabled=true;
	}
	if(i < f){
		document.getElementById("f_sub").disabled=false;
	}
}

function OcErrorFeRe(){
	$('#error_fechaLire').fadeOut(0);
	$('#error_fechaReque').fadeOut(0);
	document.getElementById("fecha_requerida").style.border = "2px inset silver";
	var fecha_requerida=document.getElementById('fecha_requerida').value;
	var elem = fecha_requerida.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_requerida = anio+"-"+mes+"-"+dia;
	var fecha_inicio=document.getElementById('com_periodo').value;
	if(fecha_inicio.length==0){
		document.getElementById("com_periodo").style.border = "2px inset red";
		document.getElementById("com_periodo").focus();
		document.getElementById("fecha_requerida").value="";
		$('#error_fechain').toggle('drop');
	}
	var elem = fecha_inicio.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_inicio = anio+"-"+mes+"-"+dia;
	var i = Date.parse(fecha_inicio);
	var l = Date.parse(fecha_requerida);
	
	if(i < l){
		$('#error_fechaReque').toggle('drop');
		document.getElementById("f_sub").disabled=true;
	}
	if(i > l){
		var fecha_inicio=document.getElementById('com_periodo').value;
		var elemw = fecha_inicio.split('/');
		fecha_hoy = new Date(elemw[2]+"/"+elemw[1]+"/"+elemw[0]);
		
		var fecha_lim=document.getElementById('fecha_requerida').value;
		var elemq = fecha_lim.split('/');
		var dial = elemq[0];
		var mesl = elemq[1];
		var aniol = elemq[2];
		
		ahora_ano = fecha_hoy.getYear();
		ahora_mes = elemq[1];
		ahora_dia = elemq[0];
		
		edad = (ahora_ano + 1900) - aniol;
		
		if ( ahora_mes < (mesl - 1)){
		  edad--;
		}
		if (((mesl - 1) == ahora_mes) && (ahora_dia < dial)){
		  edad--;
		}
		if (edad > 1900){
			edad -= 1900;
		}
		edad = edad+" años";
		document.getElementById("edad_min").value=edad;
		document.getElementById("f_sub").disabled=false;
	}
}
function OcErrorFeErrCVG(){
	$('#error_fechaITop').fadeOut(0);
	$('#error_fechaTop').fadeOut(0);
	document.getElementById("pv_decampovigui").style.border = "2px inset silver";
	var pv_decampovigui=document.getElementById('pv_decampovigui').value;
	var elem = pv_decampovigui.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	pv_decampovigui = anio+"-"+mes+"-"+dia;
	var fecha_inicio=document.getElementById('com_periodo').value;
	if(fecha_inicio.length==0){
		document.getElementById("com_periodo").style.border = "2px inset red";
		document.getElementById("com_periodo").focus();
		document.getElementById("pv_decampovigui").value="";
		$('#error_fechain').toggle('drop');
	}
	var elem = fecha_inicio.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_inicio = anio+"-"+mes+"-"+dia;
	var i = Date.parse(fecha_inicio);
	var l = Date.parse(pv_decampovigui);
	
	if(i < l){
		$('#error_fechaTop').toggle('drop');
		document.getElementById("f_sub").disabled=true;
	}
	if(i > l){
		var fecha_inicio=document.getElementById('com_periodo').value;
		var elemw = fecha_inicio.split('/');
		fecha_hoy = new Date(elemw[2]+"/"+elemw[1]+"/"+elemw[0]);
		
		var fecha_lim=document.getElementById('pv_decampovigui').value;
		var elemq = fecha_lim.split('/');
		var dial = elemq[0];
		var mesl = elemq[1];
		var aniol = elemq[2];
		
		ahora_ano = fecha_hoy.getYear();
		ahora_mes = elemq[1];
		ahora_dia = elemq[0];
		
		edad = (ahora_ano + 1900) - aniol;
		
		if ( ahora_mes < (mesl - 1)){
		  edad--;
		}
		if (((mesl - 1) == ahora_mes) && (ahora_dia < dial)){
		  edad--;
		}
		if (edad > 1900){
			edad -= 1900;
		}
		edad = edad+" años";
		document.getElementById("edad_vg").value=edad;
		document.getElementById("f_sub").disabled=false;
	}
}
function OcErrorFeL(){
	$('#error_fechaLi').fadeOut(0);
	$('#error_fechaLimi').fadeOut(0);
	document.getElementById("fecha_limite").style.border = "2px inset silver";
	var fecha_inicio=document.getElementById('com_periodo').value;
	if(fecha_inicio.length==0){
		document.getElementById("com_periodo").style.border = "2px inset red";
		document.getElementById("com_periodo").focus();
		document.getElementById("fecha_limite").value="";
		$('#error_fechain').toggle('drop');
	}
	var elem = fecha_inicio.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_inicio = anio+"-"+mes+"-"+dia;
	var fecha_lim=document.getElementById('fecha_limite').value;
	var elem = fecha_lim.split('/');
	var dia = elem[0];
	var mes = elem[1];
	var anio = elem[2];
	fecha_lim = anio+"-"+mes+"-"+dia;
	
	var i = Date.parse(fecha_inicio);
	var l = Date.parse(fecha_lim);
	
	if(i < l){
		$('#error_fechaLimi').toggle('drop');
		document.getElementById("f_sub").disabled=true;
	}
	if(i > l){
		var fecha_inicio=document.getElementById('com_periodo').value;
		var elemw = fecha_inicio.split('/');
		fecha_hoy = new Date(elemw[2]+"/"+elemw[1]+"/"+elemw[0]);
		
		var fecha_lim=document.getElementById('fecha_limite').value;
		var elemq = fecha_lim.split('/');
		var dial = elemq[0];
		var mesl = elemq[1];
		var aniol = elemq[2];

		ahora_ano = fecha_hoy.getYear();
		ahora_mes = elemq[1];
		ahora_dia = elemq[0];
		
		edad = (ahora_ano + 1900) - aniol;
		
		if ( ahora_mes < (mesl - 1)){
		  edad--;
		}
		if (((mesl - 1) == ahora_mes) && (ahora_dia < dial)){
		  edad--;
		}
		if (edad > 1900){
			edad -= 1900;
		}
		edad = edad+" años";
		document.getElementById("edad_lim").value=edad;
		document.getElementById("f_sub").disabled=false;
	}
}
