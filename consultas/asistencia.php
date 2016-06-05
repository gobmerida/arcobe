<?php
include("../connect/conexion.php");
$sql="SELECT id FROM cj_cesta_juguete_periodo ORDER BY id DESC LIMIT 1";
$rs= mysql_query($sql) or die(mysql_error());
$row= mysql_fetch_array($rs);
$Data01 = $_POST['cedula'];
$DataSQL01 = "select cj_hijos.*
				  from cj_hijos
				  join cj_inscritos_periodo_aux
				  on cj_hijos.id_ninho = cj_inscritos_periodo_aux.id_ninho
				  where id_periodo='".$row["id"]."' and cedula_mp='$Data01' or cedula_repr='$Data01'";
$DataSQL01 = mysql_query($DataSQL01);
$KidsNumber=0;
while($DataROW01 = mysql_fetch_array($DataSQL01)){
	$KidsNumber++;
}
if($KidsNumber>0){
	$DataSQL02 = "select * from cj_cuaderno where ced_tbr='$Data01' and Periodo='".$row["id"]."'";
	$DataSQL02 = mysql_query($DataSQL02);
	$DataROW02 = mysql_fetch_array($DataSQL02);
	if($DataROW02['Confirmacion']==1){
	echo "<td colspan='2' id='yaconfirmado' style='text-align:center;font-weight:bold;color:green;cursor:pointer'>Cesta jueguete datos confirmados</td>
	<script>$('#ConData').remove();
				$('#yaconfirmado').click(function(){
					$('#vcarga').dialog({modal:true});
				});
	</script>
	";
	}
	if($DataROW02['Confirmacion']==0){
?>
<td colspan='2' style='text-align:center' id='AsistenciaConfirmar'>Confirmar datos para Cesta Juguete</td>
<script>
var ced_conf="<?php echo $Data01;?>";
$("#AsistenciaConfirmar").click(function(){
		$("#ConData").dialog({
			modal:true,
			buttons: {
				Confirmar: function() {
					$(this).dialog("close");
					funcion02(ced_conf);
				},
				Cancelar: function() {
					$(this).dialog("close");
				}
			}
		});
	});
</script>
<?php
}
}
if($KidsNumber==0){
	$DataSQL03 = "select *
				  from cj_trabajadores
				  where trb_cedula='$Data01'";
	$DataSQL03 = mysql_query($DataSQL03);
	$DataROW03 = mysql_fetch_array($DataSQL03);
	if($DataROW03["activo"]==0){
		echo "<td colspan='2' style='text-align:center;font-weight:bold;color:red'>Cesta juguete inactivo</td>";
	}
	if($DataROW03["activo"]==1){
		$DataSQL04 = "select *
				  from cj_hijos
				  where cedula_mp='$Data01'";
		$DataSQL04 = mysql_query($DataSQL04);
		$ini=0;
		while($DataROW04 = mysql_fetch_array($DataSQL04)){$ini++;}
		if($ini==0){
			echo "<td colspan='2' style='text-align:center;font-weight:bold;color:red'>Sin niños registrados para cesta juguete</td>";
		}
		if($ini>0){
			?>
			<td colspan='2' style='text-align:center' id='AsistenciaConfirmar'>Confirmar datos para Cesta Juguete</td>
			<script>
				var ced_conf="<?php echo $Data01;?>";
			$("#AsistenciaConfirmar").click(function(){
					$("#ConData").dialog({
						modal:true,
						buttons: {
							Confirmar: function() {
								$(this).dialog("close");
								funcion02(ced_conf);
							},
							Cancelar: function() {
								$(this).dialog("close");
							}
						}
					});
				});
		</script>
		<?php
		}
	}
}
?>
