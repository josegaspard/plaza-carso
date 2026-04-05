<?php
/**
 * nav.php — Navegacion principal Plaza Universidad
 * Reemplaza logos-top.php del backend original.
 * Compatible con Bootstrap 3 (navbar-fixed-top) + diseno nuevo.
 */
$urlInmuebles = urlInmuebles($CentroComercial);
?>

<!-- SKIP TO CONTENT -->
<a href="#main-content" class="skip-link">Ir al contenido principal</a>

<!-- CURSOR (solo desktop) -->
<div id="cursor"></div>
<div id="cursor-dot"></div>

<!-- NAV PRINCIPAL -->
<nav id="nav" class="navbar-fixed-top">
    <a href="index.php" class="nav-logo">
        <img src="images/logo.png" alt="<?php echo $nombrePlaza; ?>" style="height:32px; width:auto; filter:brightness(0);">
    </a>
    <div class="nav-links">
        <a href="index.php" <?php if(basename($_SERVER['PHP_SELF'])=='index.php') echo 'class="active"'; ?>>Inicio</a>
        <a href="directorio.php" <?php if(basename($_SERVER['PHP_SELF'])=='directorio.php') echo 'class="active"'; ?>>Directorio</a>
        <a href="mapa.php" <?php if(basename($_SERVER['PHP_SELF'])=='mapa.php') echo 'class="active"'; ?>>Mapa</a>
        <a href="eventosypromociones.php" <?php if(basename($_SERVER['PHP_SELF'])=='eventosypromociones.php') echo 'class="active"'; ?>>Novedades</a>
        <a href="contacto.php" class="nav-cta-link <?php if(basename($_SERVER['PHP_SELF'])=='contacto.php') echo 'active'; ?>">Contacto</a>
    </div>
    <button class="nav-ham" onclick="toggleMob()" aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>
</nav>

<!-- MENU MOVIL FULLSCREEN -->
<div id="mob-menu" role="dialog" aria-modal="true" aria-label="Navegacion">
    <button class="mob-close" onclick="toggleMob()" aria-label="Cerrar menu">&times;</button>
    <a href="index.php" onclick="toggleMob()">Inicio</a>
    <a href="directorio.php" onclick="toggleMob()">Directorio</a>
    <a href="mapa.php" onclick="toggleMob()">Mapa</a>
    <a href="eventosypromociones.php" onclick="toggleMob()">Novedades</a>
    <a href="contacto.php" onclick="toggleMob()">Contacto</a>
</div>
