<?php
	/*
	 * ============================================================
	 * PLAZA UNIVERSIDAD — header.php
	 * ============================================================
	 * IMPORTANTE: Cambiar $CentroComercial al ID que INCARSO asigne
	 * en la tabla catCentroComercial para Plaza Universidad.
	 * ============================================================
	 */
	$CentroComercial = '99'; // ← INCARSO: reemplazar con el ID real de Plaza Universidad
	require("../00-gestorContenidos/class/conexion.php");

	$nombrePlaza = nombreCC($CentroComercial);
	$descripcionPlaza = descripcionCC($CentroComercial);

	echo '
		<meta charset="UTF-8" />
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>'.$nombrePlaza.'</title>
		<meta name="description" content="'.$descripcionPlaza.'" />
		<link rel="shortcut icon" type="image/x-icon" href="logos/icono.ico" />

		<!-- Google Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=Outfit:wght@200;300;400;500;600&display=swap" rel="stylesheet">

		<!-- Bootstrap 3 (requerido por backend INCARSO) -->
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/Gridmvc.css" rel="stylesheet" />
		<link href="css/personalizados.css" rel="stylesheet" />
		<link href="css/font-awesome.css" rel="stylesheet" />
		<link href="style.css" rel="stylesheet" />
		<link href="estilo-bid.css" rel="stylesheet" />

		<!-- Nuevo diseno Plaza Universidad -->
		<link rel="stylesheet" href="css/carso.css" />
		<link rel="stylesheet" href="css/backend-compat.css" />

		<!-- Swiper (slider de tiendas) -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

		<!-- Scripts base (requeridos por backend INCARSO) -->
		<script src="Scripts/modernizr-2.8.3.js"></script>
		<script src="Scripts/jquery-3.2.1.js"></script>
		<script src="Scripts/bootstrap.js"></script>
		<script src="Scripts/respond.js"></script>
		<script src="Scripts/Gridmvc.js"></script>
		<script src="Scripts/logoLocatario.js"></script>

		'.analyticsCC($CentroComercial).'
	';
?>
