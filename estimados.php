<?php
/*
 * sin título.php
 * 
 * Copyright 2015 Edgar Carrizalez <edg.sistemas@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Estimado Plan Vacacional <?php echo date("Y");?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
	<link rel="stylesheet" href="./estilo/estilo.css" type="text/css"/>
	<style>
		table.estimado{
			border: ridge 1px;
			border-radius: 0;
			margin: 0 35px;
			cursor:default;
		}
		td{
			border:ridge 1px;
			text-align:center;
		}
	</style>
</head>

<body>
	<div id='cabecera'>
		<h2 align='center'>.:Estimado Plan Vacacional <?php echo date("Y");?>:.</h2>
	</div>
	<div id="contenedor">
		<?php
		function CalculaEdad( $fecha ) { // Funcion para calcular la edad de los niños
			list($Y,$m,$d) = explode("-",$fecha);
			return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
		}
			include("./connect/conexion.php");
			//~ include("./script_php/condicion.php");
			$trabajadores_query = "SELECT * FROM cj_hijos";
			$total_vgef=0;
			$total_cef=0;
			$total_vgec=0;
			$total_cec=0;
			$total_vgof=0;
			$total_cof=0;
			$total_vgoc=0;
			$total_coc=0;
			$total_vg=0;
			$total_camp=0;
			$total_global=0;
			$total_ef=0;
			$total_ec=0;
			$total_of=0;
			$total_oc=0;
			$total_le=0;
			$total_er=0;
			$total_reg=0;
			$trabajadores_query = mysql_query($trabajadores_query);
			while($trabajadores = mysql_fetch_array($trabajadores_query)){
				$total_reg=$total_reg+1;
				$condicion_nom = $trabajadores['id_ninho'];
				if($trabajadores['h_fecha_naci']<="2000-10-01"){
					$total_le=$total_le+1;
				}
				if($trabajadores['h_fecha_naci']>="2010-10-01"){
					$total_er=$total_er+1;
				}
				if($trabajadores['h_fecha_naci']>"2000-10-01" and $trabajadores['h_fecha_naci']<"2010-10-01"){
					list($tipo_de_nomina, $codigo_nomina) = explode("-",$condicion_nom);
					if($tipo_de_nomina=='CO' or $tipo_de_nomina=='COC'){
						//~ Empleados contratados
						if($trabajadores['h_fecha_naci']>"2003-10-01"){
							$total_vgec = $total_vgec+1;
						}
						if($trabajadores['h_fecha_naci']<="2003-10-01"){
							$total_cec = $total_cec+1;
						}
						$total_ec = $total_ec +1;
					}
					if($tipo_de_nomina=='EM' or $tipo_de_nomina=='EC' or $tipo_de_nomina=='EF' or $tipo_de_nomina=='PO' or $tipo_de_nomina=='BO'){
						//~ Empleados fijos
						if($trabajadores['h_fecha_naci']>"2003-10-01"){
							$total_vgef = $total_vgef+1;
						}
						if($trabajadores['h_fecha_naci']<="2003-10-01"){
							$total_cef = $total_cef+1;
							//~ echo $trabajadores['h_fecha_naci']."<br>";
							//~ echo $trabajadores['id_ninho']." - ".CalculaEdad($trabajadores['h_fecha_naci'])."<br>";
						}
						$total_ef = $total_ef +1;
					}
					if($tipo_de_nomina=='BE'){
						//~ Obreros contratados
						if($trabajadores['h_fecha_naci']>"2003-10-01"){
							$total_vgoc = $total_vgoc+1;
						}
						if($trabajadores['h_fecha_naci']<="2003-10-01"){
							$total_coc = $total_coc+1;
						}
						$total_oc = $total_oc +1;
					}
					if($tipo_de_nomina=='OS' or $tipo_de_nomina=='OF' or $tipo_de_nomina=='OB' or $tipo_de_nomina=='OP' or $tipo_de_nomina=='OO'){
						//~ Obreros fijos
						if($trabajadores['h_fecha_naci']>"2003-10-01"){
							$total_vgof = $total_vgof+1;
						}
						if($trabajadores['h_fecha_naci']<="2003-10-01"){
							$total_cof = $total_cof+1;
						}
						$total_of = $total_of +1;
					}
				}
			}
			$total_global=$total_ec+$total_ef+$total_oc+$total_of;
			$total_vg = $total_vgec+$total_vgef+$total_vgoc+$total_vgof;
			$total_camp = $total_cec+$total_cef+$total_coc+$total_cof;
			echo "
				<center>
				<table class='estimado'>
				<tr style='background-color:gainsboro'><td>Condición</td><td>Visita Guiada</td><td>Campamento</td><td>Total</td></tr>
				<tr><td>Empleado Fijo</td><td>$total_vgef</td><td>$total_cef</td><td>$total_ef</td></tr>
				<tr><td>Empleado Contratado</td><td>$total_vgec</td><td>$total_cec</td><td>$total_ec</td></tr>
				<tr><td>Obrero Fijo</td><td>$total_vgof</td><td>$total_cof</td><td>$total_of</td></tr>
				<tr><td>Obrero Contratado</td><td>$total_vgoc</td><td>$total_coc</td><td>$total_oc</td></tr>
				<tr><td style='background-color:gainsboro'>Total</td><td>$total_vg</td><td>$total_camp</td><td>$total_global</td></tr>
				</table>
				<br>
				<b><u>No se contabilizan</u></b><br>
				Superan el limite de edad: $total_le<br>
				No llega a la edad requerida: $total_er<br>
				Total registrados: $total_reg<br><br>
				</center>
			";
		?>
	</div>
</body>

</html>
