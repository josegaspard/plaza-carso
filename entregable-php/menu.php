<?php
// menu.php — Compatibilidad con backend original
// El menu principal ahora esta en nav.php (navegacion superior fija)
// Este archivo se mantiene para no romper includes existentes
echo '
    <div id="menuHorizontal" class="container text-center" style="display:none;">
        <ul class="list-inline"><li class="list-inline"><a href="index.php" title="INICIO">INICIO</a></li></ul>
        <ul class="list-inline"><li class="list-inline"><a href="directorio.php" title="DIRECTORIO">DIRECTORIO</a></li></ul>
        <ul class="list-inline"><li class="list-inline"><a href="mapa.php" title="MAPA">MAPA</a></li></ul>
        <ul class="list-inline"><li class="list-inline"><a href="eventosypromociones.php" title="NOVEDADES">NOVEDADES</a></li></ul>
        <ul class="list-inline"><li class="list-inline"><a href="contacto.php" title="CONTACTO">CONTACTO</a></li></ul>
    </div>
';
?>
