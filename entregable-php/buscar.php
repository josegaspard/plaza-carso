<!DOCTYPE html>
<html>
	<head>
		<?php
			include ("header.php");
		?>
	</head>
	<body>
		<div id="bodyID">
			<div id="">
				<?php
					include ("logo.php");
				?>
			</div>
			<div class="container" id="containerbody2">
				<input type="hidden" class="count" value="0"/>
					<h1 class="txtTitulo">Directorio</h1>
					<div class="row"> 
						<?php
							echo giroComercial($CentroComercial);
							$directorioCC = directorioCC2($CentroComercial,'');
							echo $directorioCC;
						?>
					</div>
				<script>
				$(document).ready(function () {
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
					$('select').on('change', function() {
						$giroComercial = this.value;
						$centroComercial = <?php echo $CentroComercial; ?>;
						$.ajax({
							url: 'filtroGiroComercialLocal.php',  
							type: 'POST',
							data: {"giroComercial" : $giroComercial, "centroComercial" : $centroComercial},							
							beforeSend: function(){
								$("#iconLocal").html("...loading");
							},
							success: function(response){
								$("#iconLocal").html(response);
							}
						});
					});
				});
				</script>
				<div id="menuHorizontal" class="clearfix">
					<?php
						include ("menu.php");
					?>
				</div>
			</div>
		</div>
		<br>
		<footer id="footerID">
			<div class="container">
				<?php
					include ("footer.php");
				?>
			</div>
		</footer>
		<?php
			include ("modales.php");
		?>
	</body>
</html>