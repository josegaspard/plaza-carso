<?php
$urlInmuebles = urlInmuebles($CentroComercial);
echo "
	<nav id=\"header\" class=\"navbar navbar-default navbar-fixed-top  visible-lg visible-md visible-sm\">
		<div class=\"container visible-lg visible-md visible-sm\">
			<ul class=\"nav navbar-nav navbar-right\">
				<li>
					<a class=\"navbar-brand img-responsive\" href=\"".$urlInmuebles."\" target=\"_blanck\"><img class=\"logoMenu img-responsive\" src=\"logos/logo_InmueblesCarso.png\" style=\"padding-right: 50vh;\"/></a>
				</li>
				<li>
					<a class=\"navbar-brand img-responsive\" href=\"/\"><img class=\"logoMenu img-responsive\" src=\"images/logo.png\" /></a>
				</li>
			</ul>
		</div>
	</nav>
	<nav id=\"header\" class=\"navbar navbar-default navbar-fixed-top visible-xs\">
		<div class=\"container-fluid\">
			<div class=\"navbar-header\">
				<div>
					<button id=\"btnMenuXS\" type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
						<img class=\"btnMenuXS\" src=\"logos/btnMenu.png\" />  <span class=\"caret\"></span>
					</button>
				</div>
				<div>
				</div>
				<div class=\"col-xs-8\">
					<a class=\"navbar-brand \" href=\"/\">
						<img class=\"logoMenuXS img-responsive\" src=\"images/logo.png\" />
					</a>
				</div>
			</div>
			<div class=\"collapse navbar-collapse menu2\" id=\"myNavbar\">
			";
				include("menuXS.php");
				echo "
			</div>
		</div>
	</nav>
";
?>