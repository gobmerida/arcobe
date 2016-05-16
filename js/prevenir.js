var ninoa;
function validar_pv(formulario){
	document.getElementById("inscri").disabled=true;
	document.getElementById("inscri").value="Inscriendo...";
	validacion=true;
	if(formulario.h_gsanguineo.value==0){
		$("#h_gsanguineo").addClass("error");
		$("#h_gsanguineo").focus();
		alert("¡Error falta grupo sanguíneo!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_habilidades.value.length==0){
		$("#pv_habilidades").addClass("error");
		$("#pv_habilidades").focus();
		alert("¡Error falta habilidades "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_fotos.checked==false){
		$("#fotos_ch").css("border","1px solid red");
		$("#pv_fotos").focus();
		alert("¡Error faltan las fotos "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_certificado.checked==false){
		$("#certificado_ch").css("border","1px solid red");
		$("#pv_fotos").focus();
		alert("¡Error falta el certificado de niño sano!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_gustos.value.length==0){
		$("#pv_gustos").addClass("error");
		$("#pv_gustos").focus();
		alert("¡Error falta los gustos "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_vacunas.value.length==0){
		$("#pv_vacunas").addClass("error");
		$("#pv_vacunas").focus();
		alert("¡Error falta las vacunas "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_alergias.value.length==0){
		$("#pv_alergias").addClass("error");
		$("#pv_alergias").focus();
		alert("¡Error falta las alergias "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_tratamiento.value.length==0){
		$("#pv_tratamiento").addClass("error");
		$("#pv_tratamiento").focus();
		alert("¡Error falta tratamientos actuales "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_alimentosp.value.length==0){
		$("#pv_alimentosp").addClass("error");
		$("#pv_alimentosp").focus();
		alert("¡Error falta los alimentos prohibidos "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_medicamentosp.value.length==0){
		$("#pv_medicamentosp").addClass("error");
		$("#pv_medicamentosp").focus();
		alert("¡Error falta los medicamentos prohibidos "+ninoa+"!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_tchaqueta.value==1){
		$("#pv_tchaqueta").addClass("error");
		$("#pv_tchaqueta").focus();
		alert("¡Error falta talla de la chaqueta!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_tfranela.value==1){
		$("#pv_tfranela").addClass("error");
		$("#pv_tfranela").focus();
		alert("¡Error falta talla de la franela!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_tmono.value==1){
		$("#pv_tmono").addClass("error");
		$("#pv_tmono").focus();
		alert("¡Error falta talla del mono!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_tgorra.value==1){
		$("#pv_tgorra").addClass("error");
		$("#pv_tgorra").focus();
		alert("¡Error falta talla de la gorra!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_contacto_cedula.value.length==0){
		$("#pv_contacto_cedula").addClass("ErrorTam");
		$("#pv_contacto_cedula").removeClass("tam");
		$("#pv_contacto_cedula").focus();
		alert("¡Error falta cédula del contacto!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_contacto_nombre.value.length==0){
		$("#pv_contacto_nombre").addClass("ErrorTam");
		$("#pv_contacto_nombre").removeClass("tam");
		$("#pv_contacto_nombre").focus();
		alert("¡Error falta nombre(s) del contacto!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_contacto_apellido.value.length==0){
		$("#pv_contacto_apellido").addClass("ErrorTam");
		$("#pv_contacto_apellido").removeClass("tam");
		$("#pv_contacto_apellido").focus();
		alert("¡Error falta apellido(s) del contacto!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_contacto_telefono.value.length==0){
		$("#pv_contacto_telefono").addClass("ErrorTam");
		$("#pv_contacto_telefono").removeClass("tam");
		$("#pv_contacto_telefono").focus();
		alert("¡Error falta teléfono del contacto!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(formulario.pv_contacto_parentesco.value==1){
		$("#pv_contacto_parentesco").addClass("error");
		$("#pv_contacto_parentesco").focus();
		alert("¡Error falta parentesco del contacto!");
		document.getElementById("inscri").value='inscribir';
		validacion=false;
		return validacion;
	}
	if(validacion=true){
		document.getElementById("inscri").form.submit()
		return validacion;
	}
}
function resetEst(elemento){
	$(elemento).removeClass("error");
	document.getElementById("inscri").disabled=false;
}
function resetEstch(elemento){
	$(elemento).css("border","1px solid black");
	document.getElementById("inscri").disabled=false;
}
function resetEstc(elemento){
	$(elemento).removeClass("ErrorTam");
	$(elemento).addClass("tam");
	document.getElementById("inscri").disabled=false;
}
function tamanios(){
	for(m=0;m<document.forms[0].elements.length;m++){
		if(document.forms[0].elements[m].type=="text"){
			//~ Tamaño del imput - document.forms[0].elements[m].size=35
			//~ document.forms[0].elements[m].size=35
			//~ Máximo de caracteres en el input - document.forms[0].elements[m].maxLength=200
			document.forms[0].elements[m].maxLength=200
		}
		if(document.forms[0].elements[m].type=="textarea"){
			//~ Máximo de caracteres en el textarea
			document.forms[0].elements[m].maxLength=300
		}
	}
}
