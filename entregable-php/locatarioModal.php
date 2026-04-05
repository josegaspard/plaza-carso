<style>
	#content-wrapper {
		z-index: 1 !important;
		width: 100%;
		/*height: 50%;*/
		opacity: 0.8;
		border: 10px solid transparent;
		color: #000;
		position: absolute; /*El div será ubicado con relación a la pantalla*/
		left: 0px; /*A la derecha deje un espacio de 0px*/
		right: 0px; /*A la izquierda deje un espacio de 0px*/
		bottom: 0px; /*Abajo deje un espacio de 0px*/
		z-index: 0;
	}
	#content-wrapperXS {
		z-index: 1 !important;
		width: 100%;
		/*height: 10%;*/
		opacity: 0.8;
		border: 5px solid Transparent;
		color: black;
		/*bottom: -470px;*/ /*Abajo deje un espacio de 0px*/
		z-index: 0;
		bottom: 80%;
	}
	.modal-dialog {
		width: 90%;
		height: 90%;
		padding: 0;
		margin: 0 auto;
		top: 1em;
	}
	.modal-content {
		height: 100%;		
		background-repeat: no-repeat;
		background-size: cover;
		background-position-x: center;
		background-position-y: center;
	}
	.imgRedesSocialesLocatario {
		border: 0px solid blue;
		height: 3%;
		width: 3%;
		/*-------------------------------------------------------------------*/
		filter: url('#grayscale'); /* Versión SVG para IE10, Chrome 17, FF3.5, Safari 5.2 and Opera 11.6 */
		-webkit-filter: grayscale(100%);
		-moz-filter: grayscale(100%);
		-ms-filter: grayscale(100%);
		-o-filter: grayscale(100%);
		filter: grayscale(100%); /* Para cuando es estándar funcione en todos */
		filter: Gray(); /* IE4-8 and 9 */
		-webkit-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
		-ms-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		transition: all 0.5s ease;
	}
	.imgRedesSocialesLocatario:hover {
		/*-------------------------------------------------------------------*/
		filter: url('#grayscale'); /* Versión SVG para IE10, Chrome 17, FF3.5, Safari 5.2 and Opera 11.6 */
		-webkit-filter: grayscale(0%);
		-moz-filter: grayscale(0%);
		-ms-filter: grayscale(0%);
		-o-filter: grayscale(0%);
		filter: grayscale(0%); /* Para cuando es estándar funcione en todos */
		filter: Gray(); /* IE4-8 and 9 */
		-webkit-transition: all 0.0s ease;
		-moz-transition: all 0.0s ease;
		-ms-transition: all 0.0s ease;
		-o-transition: all 0.0s ease;
		transition: all 0.0s ease;
		/*filter:invert(100%);*/
	}.imgRedesSocialesLocatarioXS {
		border: 0px solid blue;
		height: 10%;
		width: 10%;
		/*-------------------------------------------------------------------*/
		filter: url('#grayscale'); /* Versión SVG para IE10, Chrome 17, FF3.5, Safari 5.2 and Opera 11.6 */
		-webkit-filter: grayscale(100%);
		-moz-filter: grayscale(100%);
		-ms-filter: grayscale(100%);
		-o-filter: grayscale(100%);
		filter: grayscale(100%); /* Para cuando es estándar funcione en todos */
		filter: Gray(); /* IE4-8 and 9 */
		-webkit-transition: all 0.5s ease;
		-moz-transition: all 0.5s ease;
		-ms-transition: all 0.5s ease;
		-o-transition: all 0.5s ease;
		transition: all 0.5s ease;
	}.imgRedesSocialesLocatarioXS:hover {
		/*-------------------------------------------------------------------*/
		filter: url('#grayscale'); /* Versión SVG para IE10, Chrome 17, FF3.5, Safari 5.2 and Opera 11.6 */
		-webkit-filter: grayscale(0%);
		-moz-filter: grayscale(0%);
		-ms-filter: grayscale(0%);
		-o-filter: grayscale(0%);
		filter: grayscale(0%); /* Para cuando es estándar funcione en todos */
		filter: Gray(); /* IE4-8 and 9 */
		-webkit-transition: all 0.0s ease;
		-moz-transition: all 0.0s ease;
		-ms-transition: all 0.0s ease;
		-o-transition: all 0.0s ease;
		transition: all 0.0s ease;
		/*filter:invert(100%);*/
	}
</style>
<?php
	require("../00-gestorContenidos/class/conexion.php");
	$CentroComercial=$_GET['CentroComercial'];
	$idLocatario=$_GET['idCatLocatario'];
	$origen=$_GET['origen'];
	$informacionLocatario = informacionLocatario($CentroComercial,$idLocatario,$origen,'web');
	echo $informacionLocatario;
?>