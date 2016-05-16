$(document).ready(function(){
	var data=$("#trb_ced").val();
	funcion01(data);
});
function funcion01(cedula){
	var dataString = 'cedula='+cedula;
	$.ajax({
		type: 'POST',
		url: 'asistencia.php',
		data: dataString,
		beforeSend: function () {
			$("#Asistencia").html("<td colspan='2' style='text-align:center'>Procesando, espere por favor...</td>");
		},
		success: function(data) {
			$('#Asistencia').html(data);
		}
	});
}
function funcion02(data){
	var Data01 = "data01="+data;
	$.ajax({
		type: 'POST',
		url: 'confirmacion.php',
		data: Data01,
		beforeSend: function () {
			$("#Asistencia").html("<td colspan='2' style='text-align:center'>Procesando, espere por favor...</td>");
		},
		success: function(data) {
			$('#Asistencia').html(data);
		}
	});
}
