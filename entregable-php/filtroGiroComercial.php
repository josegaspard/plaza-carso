<?php
	include ("header.php");
	$GiroComercial = $_GET["GiroComercial"];
	$CentroComercial = $_GET["CentroComercial"];
	$locatariosMapa = locatariosMapaPRB($CentroComercial,$GiroComercial);
	$locatariosMapa = $locatariosMapa . "
		<script>
			$(document).ready(function () {
				$('.local').mouseenter(function () {
					id = $(this).attr('id');
					idMapa = id.replace('D', '');
					color = $('#' + idMapa).css('fill');
					$('#' + idMapa).css('fill-opacity', '.5');
					$('#' + id).css({'background': color, 'font-weight': 'bold', 'color': 'white'});
				});
				$('.local').mouseleave(function () {
					id = $(this).attr('id');
					idMapa = id.replace('D', '');
					$('#' + idMapa).css('fill-opacity', '1');
					$('#' + id).css({'background': 'none', 'font-weight': 'normal', 'color': 'black'});
				});
				$('.local').on('click', function (e) {
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
