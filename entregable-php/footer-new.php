<?php
/**
 * footer-new.php — Footer con diseno nuevo + datos dinamicos del backend
 * Los datos (direccion, telefono, email, redes) se cargan de la BD via conexion.php
 */
$direccion = direccionCC($CentroComercial);
$nombre = nombreCC($CentroComercial);
$telefono = telefonoCC($CentroComercial);
$email = emailCC($CentroComercial);
?>

<!-- ESPACIOS COMERCIALES -->
<section class="espacios-section">
    <div class="espacios-inner">
        <div class="espac-text">
            <h3>Espacios<br>Comerciales.</h3>
            <p>Encuentra el espacio ideal para tu marca en <?php echo $nombre; ?>. Ubicacion privilegiada en la Ciudad de Mexico.</p>
        </div>
        <div class="espac-contacts">
            <a href="tel:<?php echo str_replace(' ','',$telefono); ?>" class="espac-link">
                <span class="espac-link-ico">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                </span>
                <?php echo $telefono; ?>
            </a>
            <a href="mailto:<?php echo $email; ?>" class="espac-link">
                <span class="espac-link-ico">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </span>
                <?php echo $email; ?>
            </a>
            <a href="contacto.php" class="espac-link">
                <span class="espac-link-ico">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </span>
                Solicitar informacion
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <div class="footer-bg-text" aria-hidden="true"><?php echo strtoupper(str_replace('Plaza ','',$nombre)); ?></div>
    <div class="footer-top">
        <div>
            <div class="footer-brand-name"><?php echo $nombre; ?></div>
            <p class="footer-brand-desc"><?php echo str_replace('<br>',' ',$direccion); ?></p>
        </div>
        <div class="footer-col">
            <h4>Navegacion</h4>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="directorio.php">Directorio</a></li>
                <li><a href="mapa.php">Mapa</a></li>
                <li><a href="eventosypromociones.php">Novedades</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Visitanos</h4>
            <address><?php echo $direccion; ?><br><a href="tel:<?php echo str_replace(' ','',$telefono); ?>"><?php echo $telefono; ?></a></address>
        </div>
        <div class="footer-col">
            <h4>Horario</h4>
            <ul>
                <li><a href="#">Lun-Dom: 11:00-21:00</a></li>
                <li><a href="contacto.php">Contactanos</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php echo $nombre; ?>. Todos los derechos reservados.</p>
        <div class="footer-socials">
            <?php
                // Redes sociales desde BD
                $redesHTML = redesSocialesCC($CentroComercial,'N');
                if(!empty($redesHTML)){
                    echo $redesHTML;
                } else {
                    // Fallback si no hay redes en BD
                    echo '<a href="#" aria-label="Facebook"><svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>';
                    echo '<a href="#" aria-label="Instagram"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/></svg></a>';
                }
            ?>
        </div>
    </div>
</footer>
