/* Plaza Carso — Main JS
   Scripts compartidos entre todas las páginas.
   En producción, los forms van a enviarCorreo.php directamente.
   Los modales de locatario/publicidad usan jQuery AJAX hacia locatarioModal.php / publicidadModal.php
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

  /* ── INTEGRATION: Locatario modal via AJAX ──
     Cuando el SVG del mapa tiene polígonos con IDs como "local1PlantaBaja",
     y la lista de locatarios tiene IDs "Dlocal1PlantaBaja",
     el backend usa:
       $(document).on('click', '.abrirModalLocatario', function() {
         var idCatLocatario = $(this).attr('id').replace('D','');
         $('#miModalContenidoLocatario').load(
           'locatarioModal.php?CentroComercial=' + centroComercial +
           '&idCatLocatario=' + idCatLocatario + '&origen=mapa',
           function() { $('#miModalLocatario').modal('show'); }
         );
       });
  */

  /* ── INTEGRATION: Publicidad modal via AJAX ──
     $(document).on('click', '.publicidad', function(e) {
       e.preventDefault();
       var href = $(this).attr('href');
       $('#miModalContenidoPublicidad').load(href, function() {
         $('#miModalPublicidad').modal('show');
       });
     });
  */

  /* ── Bootstrap modal close button handler ── */
  $(document).on('click', '#cerrar', function() {
    $(this).closest('.modal').modal('hide');
  });

});
