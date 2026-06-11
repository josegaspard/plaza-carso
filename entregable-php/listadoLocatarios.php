<link rel="shortcut icon" type="image/x-icon" href="logos/icono.ico" />
<link href="logos/icono.ico" rel="shortcut icon" type="image/x-icon">
<link href="css/bootstrap.css" rel="stylesheet"/>
<link href="css/Gridmvc.css" rel="stylesheet"/>
<link href="css/personalizados.css" rel="stylesheet"/>
<link href="css/font-awesome.css" rel="stylesheet"/>
<link href="style.css" rel="stylesheet"/>
<script src="Scripts/modernizr-2.8.3.js"></script>
<script src="Scripts/jquery-3.2.1.js"></script>
<script src="Scripts/bootstrap.js"></script>
<script src="Scripts/respond.js"></script>
<script src="Scripts/Gridmvc.js"></script>
<script src="Scripts/logoLocatario.js"></script>
<?php
	require("../00-gestorContenidos/class/conexion.php");
	$CentroComercial = $_POST['centroComercial'];
	$giroComercial = $_POST['giroComercial'];
	$piso = $_POST['piso'];
	$locatariosMapa = locatariosMapa2PRB($CentroComercial,$giroComercial,$piso);
	echo $locatariosMapa;
?>
<script>
	$(document).ready(function () {
		$('.local').mouseenter(function () {
			$id = $(this).attr("id");
			$idMapa = $id.replace("D", "");
			$color = $("#" + $idMapa).css("fill");
			$("#" + $idMapa).css("fill-opacity", ".5");
			//$("#" + $idMapa).css("stroke", $color);
			$("#" + $id).css({'background': $color, 'font-weight': 'bold', 'color': 'white'});
		});
		
		$('.local').mouseleave(function () {
			$id = $(this).attr("id");
			$idMapa = $id.replace("D", "");
			$("#" + $idMapa).css("fill-opacity", "1");
			//$("#" + $idMapa).css("stroke", "none");
			$("#" + $id).css({'background': 'none', 'font-weight': 'normal', 'color': 'black'});
		});

		$('.local').on("click", function (e) {
			var _href = this.href;
			var _url = _href;
			e.preventDefault();
			$('#miModalContenidoLocatario').load(_url, function () {
				$('#miModalLocatario').modal({
				}, 'show');
			});
			return false;
		});

		$(".localP").mouseenter(function () {
			$id = $(this).attr("id");
			$color = $("#local" + $id).css("fill")
			$("#local" + $id).css("fill-opacity", ".5");
			//$("#local" + $id).css("stroke", $color);
			$("#Dlocal" + $id).css({'background': $color, 'font-weight': 'bold', 'color': 'white'});
		});

		$(".localP").mouseleave(function () {
			$id = $(this).attr("id");
			$("#local" + $id).css("fill-opacity", "1");
			//$("#local" + $id).css("stroke", "none");
			$("#Dlocal" + $id).css({'background': 'none', 'font-weight': 'normal', 'color': 'black'});
		});

		$(".localP").click(function () {
			$id = $(this).attr("id");
			$id = $id.replace("PlantaBaja", "");
			$centroComercial = <?php echo $CentroComercial; ?>;
			$('#miModalContenidoLocatario').load("locatarioModal.php?CentroComercial=" + $centroComercial + "&idCatLocatario=" + $id + "&origen=mapa", function () {
				$('#miModalLocatario').modal({
				}, 'show');
			});
			return false;
		});

		$('.giroComercial').change(function(){
			giroComercial = $(this).val();
			//alert(giroComercial);
			$.ajax({
				url: 'listadoLocatarios.php',  
				type: 'POST',
				data: {centroComercial : <?php echo $CentroComercial; ?>, giroComercial : giroComercial, piso : 'Planta Baja'},
				cache: false,
				success: function(data){
					if(data=='error'){
						$("#PlantaBaja").html("error");
					}else{
						$("#PlantaBaja").html(data);
					}
				}
			});
			$.ajax({
				url: 'listadoLocatarios.php',  
				type: 'POST',
				data: {centroComercial : <?php echo $CentroComercial; ?>, giroComercial : giroComercial, piso : 'Planta Alta'},
				cache: false,
				success: function(data){
					if(data=='error'){
						$("#PlantaAlta").html("error");
					}else{
						$("#PlantaAlta").html(data);
					}
				}
			});
		});
	});
</script>
<script src="Scripts/carrusel.js"></script>