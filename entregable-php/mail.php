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
				<h1 class="txtTitulo">Contacto</h1>
				<p class="txtSubTitulo">Envianos tus preguntas y/o comentarios. ¡Nos interesa!</p>
				<div class="row"> 
					<div id="bodyID" style="padding-top: 1px;">
						<form action="#" method="post">
							<div class="form-horizontal">
								<div class="row">
									<div class="col-md-3 col-xs-1">
									</div>
									<div class="col-md-6 col-xs-10">
										<div class="form-group">
											<div class="col-md-12">
												<select class="form-control inputForm text-center" id="tipoMensaje" name="tipoMensaje">
													<option value="1">Quejas y Sugerencias</option>
													<option value="2">Espacios Disponibles</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<span class="input-group-addon glyphicon glyphicon-user inputForm"></span>
													<input class="form-control inputForm " id="NombreContacto" name="NombreContacto" placeholder="Nombre:" type="text" value="" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<span class="input-group-addon glyphicon glyphicon-envelope inputForm"></span>
													<input class="form-control inputForm " id="EmailContacto" name="EmailContacto" placeholder="Email:" type="email" value="" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<span class="input-group-addon glyphicon glyphicon-phone inputForm"></span>
													<input class="form-control inputForm " id="TelefonoContacto" name="TelefonoContacto" onkeypress="return soloNumeros(event)" placeholder="Telefono:" type="tel" value="" maxlength="10" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="input-group">
													<span class="input-group-addon glyphicon glyphicon-pencil inputForm"></span>
													<textarea class="form-control inputForm" id="Mensaje" name="Mensaje" placeholder="Mensaje..." rows="4" style="resize:none" required></textarea>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3 col-xs-1">
									</div>
								</div>
								<div class="col-md-12 avisoPriv">
									<input data-val="true" data-val-required="The AvisoPrivacidad field is required." id="chkAvisoPrivacidad" name="AvisoPrivacidad" type="checkbox" value="true" required/>
									<span class="avisoPriv">He leido  y aceptado el <a href="AvisodePrivacidad.php" class="local abrirModalLocatario">Aviso de Privacidad</a></span>
								</div>
								<br><br>
								<div class="row">
									<div class="col-md-3 col-xs-1"></div>
									<div class="col-md-6 col-xs-10">
										<div class="col-md-12">
											<button type="submit" id="form-submit" class="btn btn-block btn-default">Enviar</button>
										</div>
									</div>
									<div class="col-md-3 col-xs-1"></div>
								</div>
							</div>
						</form>
						<br>
					</div>
				</div>
				<script>
					function soloNumeros(e) {
						var key = window.Event ? e.which : e.keyCode;
							return (key >= 48 && key <= 57 || key == 0 || key == 8 || key == 45)
						}
					$(document).ready(function () {
						$('.local').on("click", function (e) {
							var _href = this.href;
							var _url = _href;
							e.preventDefault();
							$('#miModalContenidoLocatario').load(_url, function () {
								$('#miModalLocatario').modal({
									//backdrop: 'static',
									//keyboard: true
								}, 'show');
							});
							return false;
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