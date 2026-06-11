/* Plaza Universidad — Main JS
   Scripts compartidos entre todas las paginas.
   Compatible con backend INCARSO (enviarCorreo.php, locatarioModal.php, publicidadModal.php)
*/

$(document).ready(function() {

    /* ── Smooth scroll for anchor links ── */
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: target.offset().top - 80 }, 500);
        }
    });

    /* ── Locatario modal via AJAX ──
       Cuando el SVG del mapa tiene poligonos con IDs como "local1PlantaBaja",
       y la lista de locatarios tiene IDs "Dlocal1PlantaBaja",
       el click abre el modal con datos del backend.
    */
    $(document).on('click', '.abrirModalLocatario, .local', function(e) {
        var _href = this.href;
        if (!_href) return;
        e.preventDefault();
        $('#miModalContenidoLocatario').load(_href, function() {
            $('#miModalLocatario').modal('show');
        });
        return false;
    });

    /* ── Publicidad modal via AJAX ── */
    $(document).on('click', '.publicidad', function(e) {
        var _href = this.href;
        if (!_href) return;
        e.preventDefault();
        $('#miModalContenidoPublicidad').load(_href, function() {
            $('#miModalPublicidad').modal('show');
        });
        return false;
    });

    /* ── Bootstrap modal close button handler ── */
    $(document).on('click', '#cerrar, #btnAceptarAviso', function() {
        $(this).closest('.modal').modal('hide');
    });

    /* ── Contact form: AJAX submit to enviarCorreo.php ── */
    $('#formulario').on('submit', function(e) {
        e.preventDefault();
        var btn = $('#btnSub, #form-submit');

        $.ajax({
            url: 'enviarCorreo.php',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function() {
                btn.prop('disabled', true).text('Enviando...');
            },
            success: function() {
                btn.prop('disabled', false).text('Enviado');
                $('#sBox').show();
                $('#formulario')[0].reset();
                setTimeout(function() { btn.text('Enviar mensaje'); }, 3000);
            },
            error: function() {
                btn.prop('disabled', false).text('Error, intenta de nuevo');
                setTimeout(function() { btn.text('Enviar mensaje'); }, 3000);
            }
        });
    });

});
