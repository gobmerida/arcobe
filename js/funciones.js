
// Fución para el datepicker
$(function(){
	$( "#h_fecha_naci" ).datepicker({
	changeMonth: true, // Mostrar el mes
	changeYear: true, // Poder cambiar el año
	showOtherMonths: true, //Mostrar cuadrilcula
	showButtonPanel: true // Mostrar botones
	});
	});
function fca(){
	$('#ui-datepicker-div').fadeOut(250);
}



// Función para el tamaño de las letras
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



// Función para validar el formulario
function validarForm(formulario){
	
	var madre = document.getElementsByName("s_madre");
	var com_madre=formulario.s_madre.value;
	var k=0;
	var e=0;
	for(var i=0; i<madre.length; i++) {
		if(madre[i].checked==true){
		k++;
		e++;
		}
	}
	var madrechk = document.getElementById("concod1");
	var padrechk = document.getElementById("concod2");
	var reprchk = document.getElementById("concod3");
	if(madrechk.checked==false && padrechk.checked==false && reprchk.checked==false){
		document.getElementById("tab_mad").style.border = "2px solid red";
		document.getElementById("tab_pad").style.border = "2px solid red";
		document.getElementById("tab_rep").style.border = "2px solid red";
		document.getElementById("s_madres").focus();
		document.getElementById("sub").disabled=true;
		document.getElementById("sub").value='Registrar';
		e++;
		alert('¿Quién es el responsable?');
		return false;
	}
	if(k==0){
		document.getElementById("s_madres").focus();
		document.getElementById("tab_mad").style.border = "2px solid red";
		$('#error_madre').toggle('drop');
		document.getElementById("sub").disabled=true;
		document.getElementById("sub").value='Registrar';
		return false;
	}
	
	if(com_madre=="s"){
		if(formulario.cedula_madre.value.length==0){
			document.getElementById("cedula_madre").style.border = "2px inset red";
			document.getElementById("cedula_madre").focus();
			$('#error_madre_cedula').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.n_madre.value.length==0){
			document.getElementById("n_madre").style.border = "2px inset red";
			document.getElementById("n_madre").focus();
			$('#error_madre_nombre').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.p_madre.value.length==0){
			document.getElementById("p_madre").style.border = "2px inset red";
			document.getElementById("p_madre").focus();
			$('#error_madre_apellido').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.d_madre.value.length==0){
			document.getElementById("d_madre").style.border = "2px inset red";
			document.getElementById("d_madre").focus();
			$('#error_madre_direccion').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.t_madre.value.length==0){
			document.getElementById("t_madre").style.border = "2px inset red";
			document.getElementById("t_madre").focus();
			$('#error_madre_telefono').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
	}
	if(madrechk.checked==true){
		if(com_madre!="s"){
			document.getElementById("tab_mad").style.border = "2px solid red";
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			alert("¡Faltan los datos del responsable (Madre)!");
			return false;
		}
	}
	var padre = document.getElementsByName("s_padre");
	var com_padre=formulario.s_padre.value;
	var cp=0;
	for(var i=0; i<padre.length; i++) {
		if(padre[i].checked==true){
		cp++;
		e++;
		}
	}
	if(cp==0){
		document.getElementById("s_padres").focus();
		document.getElementById("tab_pad").style.border = "2px solid red";
		$('#error_padre').toggle('drop');
		document.getElementById("sub").disabled=true;
		document.getElementById("sub").value='Registrar';
		return false;
	}
	if(com_padre=="s"){
		if(formulario.cedula_padre.value.length==0){
			document.getElementById("cedula_padre").style.border = "2px inset red";
			document.getElementById("cedula_padre").focus();
			$('#error_padre_cedula').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.n_padre.value.length==0){
			document.getElementById("n_padre").style.border = "2px inset red";
			document.getElementById("n_padre").focus();
			$('#error_padre_nombre').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.p_padre.value.length==0){
			document.getElementById("p_padre").style.border = "2px inset red";
			document.getElementById("p_padre").focus();
			$('#error_padre_apellido').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.d_padre.value.length==0){
			document.getElementById("d_padre").style.border = "2px inset red";
			document.getElementById("d_padre").focus();
			$('#error_padre_direccion').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.t_padre.value.length==0){
			document.getElementById("t_padre").style.border = "2px inset red";
			document.getElementById("t_padre").focus();
			$('#error_padre_telefono').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
	}
	if(padrechk.checked==true){
		if(com_padre!="s"){
			document.getElementById("tab_pad").style.border = "2px solid red";
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			alert("¡Faltan los datos del responsable (Padre)!");
			return false;
		}
	}
	var representante = document.getElementsByName("s_rep");
	var com_representante=formulario.s_rep.value;
	var rep=0;
	for(var i=0; i<representante.length; i++) {
		if(representante[i].checked==true){
		rep++;
		e++;
		}
	}
	if(rep==0){
		document.getElementById("s_reps").focus();
		document.getElementById("tab_rep").style.border = "2px solid red";
		$('#error_rep').toggle('drop');
		document.getElementById("sub").disabled=true;
		document.getElementById("sub").value='Registrar';
		return false;
	}
	if(com_representante=="s"){
		if(formulario.cedula_representante.value.length==0){
			document.getElementById("cedula_representante").style.border = "2px inset red";
			document.getElementById("cedula_representante").focus();
			$('#error_representante_cedula').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.n_representante.value.length==0){
			document.getElementById("n_representante").style.border = "2px inset red";
			document.getElementById("n_representante").focus();
			$('#error_representante_nombres').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.p_representante.value.length==0){
			document.getElementById("p_representante").style.border = "2px inset red";
			document.getElementById("p_representante").focus();
			$('#error_representante_apellido').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.d_representante.value.length==0){
			document.getElementById("d_representante").style.border = "2px inset red";
			document.getElementById("d_representante").focus();
			$('#error_representante_direccion').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
		if(formulario.t_representante.value.length==0){
			document.getElementById("t_representante").style.border = "2px inset red";
			document.getElementById("t_representante").focus();
			$('#error_representante_telefono').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
		}
	}
	if(reprchk.checked==true){
		if(com_representante!="s"){
			document.getElementById("tab_rep").style.border = "2px solid red";
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			alert("¡Faltan los datos del responsable (Representante)!");
			return false;
		}
	}
	if(com_madre=="n" && com_padre=="n" && com_representante=="n"){
		alert("Error el beneficiario debe ser registrado al menos con un(a) 'Madre', 'Padre' o 'Representante'");
		e++;
		return false;
	}
	if(formulario.h_nombre1.value.length==0){
			document.getElementById("h_nombre1").style.border = "2px inset red";
			document.getElementById("h_nombre1").focus();
			$('#error_primer_nombre').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
	}
	if(formulario.h_apellido1.value.length==0){
			document.getElementById("h_apellido1").style.border = "2px inset red";
			document.getElementById("h_apellido1").focus();
			$('#error_primer_apellido').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
	}
	if(formulario.h_fecha_naci.value.length==0){
			document.getElementById("h_fecha_naci").style.border = "2px inset red";
			document.getElementById("h_fecha_naci").focus();
			$('#error_primer_fnacimiento').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
	}
	if(formulario.h_gsanguineo.value.length==0){
			document.getElementById("h_gsanguineo").style.border = "1px solid red";
			document.getElementById("h_gsanguineo").style.borderRadius = "5px";
			document.getElementById("h_gsanguineo").focus();
			$('#error_primer_gsanguineo').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
	}
	if(formulario.h_sexo.value.length==0){
			document.getElementById("h_sexo").style.border = "1px solid red";
			document.getElementById("h_sexo").style.borderRadius = "5px";
			document.getElementById("h_sexo").focus();
			$('#error_primer_genero').toggle('drop');
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrar';
			e++;
			return false;
	}
	if(e!=0){
			document.getElementById("sub").form.submit();
			document.getElementById("sub").disabled=true;
			document.getElementById("sub").value='Registrando...';
	}
	return true;
}

// Función de selección de la madre
function m_sele(apare){
	$('#error_madre').fadeOut(0);
	document.getElementById("tab_mad").style.border = "1px solid silver";
	if(apare.value=="s"){
		$('#table_madre').toggle('drop');
	}
	if(apare.value=="n"){
		$('#table_madre').fadeOut(0);
	}
	document.getElementById("sub").disabled=false;
	document.getElementById("sub").value='Registrar';
}
function p_sele(apare){
	$('#error_padre').fadeOut(0);
	document.getElementById("tab_pad").style.border = "1px solid silver";
	if(apare.value=="s"){
		$('#table_padre').toggle('drop');
	}
	if(apare.value=="n"){
		$('#table_padre').fadeOut(0);
	}
	document.getElementById("sub").disabled=false;
	document.getElementById("sub").value='Registrar';
}
function rep_sele(apare){
	$('#error_rep').fadeOut(0);
	document.getElementById("tab_rep").style.border = "1px solid silver";
	if(apare.value=="s"){
		$('#table_representante').toggle('drop');
	}
	if(apare.value=="n"){
		$('#table_representante').fadeOut(0);
	}
	document.getElementById("sub").disabled=false;
	document.getElementById("sub").value='Registrar';
}
function errores_oall(){
	$('#error_madre').fadeOut(0);
	$('#table_madre').fadeOut(0);
	$('#error_madre_cedula').fadeOut(0);
	$('#error_madre_nombre').fadeOut(0);
	$('#error_madre_apellido').fadeOut(0);
	$('#error_padre').fadeOut(0);
	$('#table_padre').fadeOut(0);
	$('#error_padre_cedula').fadeOut(0);
	$('#error_padre_nombre').fadeOut(0);
	$('#error_padre_apellido').fadeOut(0);
	$('#error_rep').fadeOut(0);
	$('#table_representante').fadeOut(0);
	$('#error_representante_cedula').fadeOut(0);
	$('#error_representante_nombres').fadeOut(0);
	$('#error_representante_apellido').fadeOut(0);
	$('#error_primer_nombre').fadeOut(0);
	$('#error_primer_apellido').fadeOut(0);
	$('#error_primer_fnacimiento').fadeOut(0);
	$('#error_primer_gsanguineo').fadeOut(0);
	$('#error_primer_genero').fadeOut(0);
	$('#error_madre_direccion').fadeOut(0);
	$('#error_madre_telefono').fadeOut(0);
	$('#error_padre_direccion').fadeOut(0);
	$('#error_padre_telefono').fadeOut(0);
	$('#error_representante_direccion').fadeOut(0);
	$('#error_representante_telefono').fadeOut(0);
}
function restaurar(valor,error){
	valor.style.border = "2px inset silver";
	document.getElementById("sub").disabled=false;
	document.getElementById("sub").value='Registrar';
	$(error).fadeOut(0);
}
//~ if(formulario.hij.value.length==0){
	//~ document.getElementById("hij").style.border = "2px solid red";
	//~ formulario.hij.focus();   
	//~ alert('¡Menor o titular!');
	//~ return false;
//~ }
function formato(telefono){
	var num_sf=telefono.value;
	var num = telefono.value.length;
    if(num==11){
		var num_cf='';
		num_cf=num_sf.substring(0,4)+"-";
		num_cf+=num_sf.substring(4,7)+".";
		num_cf+=num_sf.substring(7,9)+".";
		num_cf+=num_sf.substring(9,11);
		telefono.value=num_cf;
	}
	else{
      telefono.focus();
      alert("El número de teléfono debe ser de 11 números");
      return false;
    }
}
function cheks(){
	document.getElementById("tab_mad").style.border = "1px solid silver";
	document.getElementById("tab_pad").style.border = "1px solid silver";
	document.getElementById("tab_rep").style.border = "1px solid silver";
	document.getElementById("sub").disabled=true;
}
