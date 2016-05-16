function trb_data(formulario){
	validacion=true;
	if(formulario.trb_telefono.value==0){
		$("#trb_telefono").addClass("error");
		$("#trb_telefono").focus();
		alert("¡Error falta número telefonico!");
		validacion=false;
		return validacion;
	}
	if(formulario.trb_direccionh.value==0){
		$("#trb_direccionh").addClass("error");
		$("#trb_direccionh").focus();
		alert("¡Error falta dirección de habitación!");
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
}
