<?php
// menuXS.php — Compatibilidad con backend original
// El menu movil ahora esta en nav.php (#mob-menu)
// Este archivo se mantiene para no romper includes existentes
$redesSocialesCCXS = redesSocialesCCXS($CentroComercial);
echo '
    <ul class="nav navbar-nav" style="display:none;">
        <li><a href="index.php" title="INICIO">INICIO</a></li>
        <li><a href="directorio.php" title="DIRECTORIO">DIRECTORIO</a></li>
        <li><a href="mapa.php" title="MAPA">MAPA</a></li>
        <li><a href="eventosypromociones.php" title="NOVEDADES">NOVEDADES</a></li>
        <li><a href="contacto.php" title="CONTACTO">CONTACTO</a></li>
    </ul>
';
?>
