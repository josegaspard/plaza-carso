<?php
/**
 * modales.php — Contenedores de modales Bootstrap 3
 * Estos modales son REQUERIDOS por el backend de INCARSO.
 * locatarioModal.php y publicidadModal.php cargan contenido aqui via AJAX.
 */
echo '
    <!-- Modal: Informacion de Locatario (directorio + mapa) -->
    <div id="miModalLocatario" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width:90%; max-width:960px; margin:2% auto; padding:0;">
            <div class="modal-content" id="miModalContenidoLocatario" style="min-height:400px; border-radius:0; border:none;">
            </div>
        </div>
    </div>

    <!-- Modal: Publicidad / Eventos -->
    <div id="miModalPublicidad" class="modal fade in" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" style="width:90%; max-width:960px; margin:2% auto; padding:0;">
            <div class="modal-content" id="miModalContenidoPublicidad" style="min-height:400px; border-radius:0; border:none;">
            </div>
        </div>
    </div>

    <!-- Modal: General -->
    <div id="miModal" class="modal fade in" style="overflow-y:scroll; width:100%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="miModalContenido"></div>
            </div>
        </div>
    </div>

    <!-- Modal: Float -->
    <div id="miModalFloat" class="modal fade in" style="overflow-y:scroll; width:100%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="miModalFloatContenido"></div>
            </div>
        </div>
    </div>

    <!-- Modal: Float LG -->
    <div id="miModalFloatLG" class="modal fade in" style="overflow-y:scroll; width:100%;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="miModalFloatContenidoLG" class="modal-body"></div>
            </div>
        </div>
    </div>

    <!-- Modal: LG -->
    <div id="miModalLG" class="modal fade in">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="miModalContenidoLG"></div>
            </div>
        </div>
    </div>

    <script src="Scripts/carrusel.js"></script>
';
?>
