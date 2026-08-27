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
        <p class="footer-copy">&copy; <?php echo $nombre; ?>. Todos los derechos reservados.</p>
        <div class="footer-socials">
            <?php
                // Redes sociales desde BD
                $redesHTML = redesSocialesCC($CentroComercial,'N');
                if(!empty($redesHTML)){
                    echo $redesHTML;
                } else {
                    // Fallback si no hay redes en BD
                    echo '<a href="https://www.facebook.com/plazacarsomx/" target="_blank" rel="noopener" aria-label="Facebook"><svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg></a>';
                    echo '<a href="https://www.instagram.com/plazacarsomx/" target="_blank" rel="noopener" aria-label="Instagram"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/></svg></a>';
                }
            ?>
        </div>
    </div>
</footer>
