<!--Autor 
Edgar Carrizalez
C.I. V-19.352.988
Correo: edg.sistemas@gmail.com
-->

<?php
	header("Content-Type:text/html;charset=utf-8");
	$h="localhost";
	$u="root";
	$p="infor1234";
	$con=mysql_connect($h,$u,$p) or die (mysql_error());
	mysql_select_db("cj_pv",$con) or die (mysql_error());
	mysql_query("SET NAMES 'utf8'");
?>
