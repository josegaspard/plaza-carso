<style>
	.divPublicidad{
		text-align: right;
		background: black;
		padding: 15px;
	}
</style>
<?php
	require("../00-gestorContenidos/class/conexion.php");
	$CentroComercial=$_GET['CentroComercial'];
	$idPublicacion=$_GET['idPublicacion'];
	$informacionPublicidad="";
	$informacionPublicidad = informacionPublicacion($CentroComercial,$idPublicacion);
	echo $informacionPublicidad;
?>