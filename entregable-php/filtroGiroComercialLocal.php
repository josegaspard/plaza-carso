<?php
	include ("header.php");
	$giroComercial = $_POST["giroComercial"];
	$centroComercial = $_POST["centroComercial"];
	$locatariosMapa = directorioCC2($CentroComercial,$giroComercial);
	$locatariosMapa = $locatariosMapa . "
		<script>
			$(document).ready(function () {
				$('.local').on(\"click\", function (e) {
					var _href = this.href;
					var _url = _href;
					e.preventDefault();
					$('#miModalContenidoLocatario').load(_url, function () {
						$('#miModalLocatario').modal({
						}, 'show');
					});
					return false;
				});
			});
		</script>
	";
	echo $locatariosMapa;
?>