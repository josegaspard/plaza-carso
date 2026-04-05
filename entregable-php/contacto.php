<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("header.php"); ?>
    <style>
        :root{--ink:#080706;--warm:#F5F3EF;--smoke:#EDEBE6;--silver:#C0B9B0;--grey:#857E76;--mid:#3A3530;--serif:'Cormorant Garamond',serif;--sans:'Outfit',sans-serif;}
        body{font-family:var(--sans);background:var(--warm);color:var(--ink);overflow-x:hidden;}
        a{text-decoration:none;color:inherit;}img{display:block;max-width:100%;}

        /* NAV */
        #nav{position:fixed;top:0;left:0;width:100%;z-index:800;height:68px;padding:0 48px;display:flex;align-items:center;justify-content:space-between;transition:background .5s,box-shadow .5s,height .4s;}
        #nav.scrolled{background:rgba(245,243,239,.96);backdrop-filter:blur(18px);box-shadow:0 1px 0 var(--smoke);height:58px;}
        .nav-logo{font-family:var(--serif);font-size:20px;font-weight:300;letter-spacing:.1em;color:var(--ink);}
        .nav-links{display:flex;align-items:center;gap:36px;}.nav-links a{font-family:var(--sans);font-size:10px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:var(--mid);position:relative;padding-bottom:2px;transition:color .25s;}
        .nav-links a::after{content:'';position:absolute;bottom:0;left:0;width:0;height:1px;background:var(--ink);transition:width .3s;}.nav-links a:hover,.nav-links a.active{color:var(--ink);}.nav-links a:hover::after,.nav-links a.active::after{width:100%;}
        .nav-cta-link{border:1px solid var(--ink)!important;padding:10px 22px!important;}.nav-cta-link:hover{background:var(--ink)!important;color:var(--warm)!important;}.nav-cta-link::after{display:none!important;}
        .nav-ham{display:none;flex-direction:column;gap:5px;background:none;border:none;padding:4px;cursor:pointer;}.nav-ham span{display:block;width:22px;height:1px;background:var(--ink);}
        #mob-menu{position:fixed;inset:0;z-index:700;background:var(--ink);display:flex;flex-direction:column;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .4s;}#mob-menu.open{opacity:1;pointer-events:all;}
        #mob-menu a{font-family:var(--serif);font-style:italic;font-size:clamp(36px,8vw,68px);color:var(--warm);display:block;margin:8px 0;opacity:.75;text-align:center;}
        .mob-close{position:absolute;top:24px;right:32px;background:none;border:none;font-size:28px;color:var(--warm);cursor:pointer;}
        .skip-link{position:absolute;top:-100%;left:16px;z-index:9999;background:var(--ink);color:var(--warm);padding:12px 24px;font-size:13px;transition:top .2s;}.skip-link:focus{top:16px;}

        /* PAGE HERO */
        .page-hero{margin-top:68px;position:relative;min-height:360px;display:flex;align-items:flex-end;overflow:hidden;}
        .page-hero-img{position:absolute;inset:0;background-size:cover;background-position:center 30%;transform:scale(1.04);}
        .page-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(10,9,9,.7) 0%,rgba(10,9,9,.15) 60%,transparent 100%);}
        .page-hero-content{position:relative;z-index:2;padding:48px 52px;width:100%;}
        .page-kicker{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.42em;text-transform:uppercase;color:rgba(194,187,178,.8);margin-bottom:12px;display:block;}
        .page-h1{font-family:var(--serif);font-style:italic;font-size:clamp(52px,8vw,96px);font-weight:300;color:var(--warm);line-height:.92;}

        /* CONTACT SECTION */
        .contact-section{padding:100px 52px;background:var(--smoke);}
        .contact-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1.3fr;gap:100px;align-items:start;}
        .section-label{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.42em;text-transform:uppercase;color:var(--grey);display:flex;align-items:center;gap:12px;margin-bottom:24px;}
        .section-label::before{content:'';display:block;width:20px;height:1px;background:var(--grey);}
        .contact-h2{font-family:var(--serif);font-style:italic;font-size:clamp(40px,5vw,64px);font-weight:300;color:var(--ink);line-height:.95;margin-bottom:28px;}
        .contact-desc{font-family:var(--sans);font-size:13px;font-weight:300;color:var(--grey);line-height:1.85;margin-bottom:52px;}
        .detail-list{display:flex;flex-direction:column;gap:28px;}
        .detail-item{display:flex;align-items:flex-start;gap:18px;}
        .detail-ico{width:42px;height:42px;border:1px solid var(--silver);display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .detail-ico svg{width:14px;height:14px;color:var(--mid);}
        .detail-label{font-family:var(--sans);font-size:8px;font-weight:500;letter-spacing:.3em;text-transform:uppercase;color:var(--grey);display:block;margin-bottom:5px;}
        .detail-val{font-family:var(--serif);font-size:18px;font-weight:300;color:var(--ink);line-height:1.3;}
        .detail-val a{color:var(--ink);transition:color .2s;}.detail-val a:hover{color:var(--grey);}
        .map-box{margin-top:48px;border:1px solid var(--silver);overflow:hidden;}
        .map-box iframe{display:block;width:100%;height:220px;border:none;filter:grayscale(25%);}

        /* FORM */
        .form-card{background:var(--warm);padding:56px 52px;}
        .form-card-head{margin-bottom:44px;}
        .form-card-head h2{font-family:var(--serif);font-style:italic;font-size:clamp(32px,3.5vw,46px);font-weight:300;color:var(--ink);line-height:1;margin-bottom:10px;}
        .form-card-head p{font-family:var(--sans);font-size:12px;font-weight:300;color:var(--grey);}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:24px;}
        .fg{margin-bottom:28px;}
        .fg label{font-family:var(--sans);font-size:8px;font-weight:500;letter-spacing:.3em;text-transform:uppercase;color:var(--grey);display:block;margin-bottom:10px;}
        .fg input,.fg select,.fg textarea{width:100%;background:transparent;border:none;border-bottom:1px solid var(--silver);font-family:var(--sans);font-size:14px;font-weight:300;color:var(--ink);padding:10px 0;outline:none;transition:border-color .3s;}
        .fg input:focus,.fg select:focus,.fg textarea:focus{border-bottom-color:var(--ink);}
        .fg input::placeholder,.fg textarea::placeholder{color:var(--silver);}
        .fg select{appearance:none;cursor:pointer;color:var(--mid);}
        .fg textarea{resize:none;min-height:90px;}
        .privacy-row{display:flex;align-items:flex-start;gap:12px;margin-bottom:32px;}
        .privacy-row input{margin-top:3px;accent-color:var(--ink);flex-shrink:0;}
        .privacy-row label{font-family:var(--sans);font-size:11px;font-weight:300;color:var(--grey);line-height:1.6;}
        .privacy-row a{color:var(--mid);text-decoration:underline;}
        .btn-submit{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.22em;text-transform:uppercase;background:var(--ink);color:var(--warm);border:none;padding:15px 36px;cursor:pointer;display:flex;align-items:center;gap:12px;transition:background .25s;}
        .btn-submit:hover{background:var(--mid);}
        .success-box{display:none;margin-top:20px;background:var(--smoke);border-left:2px solid var(--grey);padding:16px 20px;font-family:var(--sans);font-size:12px;color:var(--mid);}

        @media(max-width:1024px){.contact-inner{grid-template-columns:1fr;gap:60px;}}
        @media(max-width:768px){
            *,*::before,*::after{cursor:auto!important;}a,button,input,select,textarea{cursor:pointer!important;}
            #nav{padding:0 20px;height:60px;}.nav-links{display:none;}.nav-ham{display:flex;min-width:44px;min-height:44px;align-items:center;justify-content:center;}
            .page-hero{margin-top:60px;min-height:280px;}.page-hero-content{padding:32px 20px;}
            .contact-section{padding:60px 20px;}.contact-inner{gap:40px;}.form-card{padding:28px 20px;}.form-row{grid-template-columns:1fr;}
            .fg input,.fg select,.fg textarea{font-size:16px;}.btn-submit{width:100%;justify-content:center;min-height:48px;}
            .mob-close{min-width:44px;min-height:44px;}#mob-menu a{padding:8px 0;min-height:48px;display:flex;align-items:center;justify-content:center;}
        }
        :focus-visible{outline:2px solid var(--ink);outline-offset:3px;}footer :focus-visible{outline-color:var(--warm);}
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <main id="main-content">

    <!-- PAGE HERO -->
    <section class="page-hero">
        <div class="page-hero-img" style="background-image:url('images/home/hero-contacto.jpg');"></div>
        <div class="page-hero-content">
            <span class="page-kicker">Estamos para ti</span>
            <h1 class="page-h1">Contacto.</h1>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section class="contact-section">
        <div class="contact-inner">

            <!-- INFO -->
            <div class="contact-info">
                <div class="section-label">Informacion</div>
                <h2 class="contact-h2">Hablemos.</h2>
                <p class="contact-desc">Estamos atentos a tus comentarios y sugerencias. Encuentranos en <?php echo $nombrePlaza; ?>.</p>
                <div class="detail-list">
                    <div class="detail-item">
                        <div class="detail-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg></div>
                        <div><span class="detail-label">Direccion</span><span class="detail-val"><?php echo direccionCC($CentroComercial); ?></span></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>
                        <div><span class="detail-label">Telefono</span><span class="detail-val"><a href="tel:<?php echo str_replace(' ','',telefonoCC($CentroComercial)); ?>"><?php echo telefonoCC($CentroComercial); ?></a></span></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div>
                        <div><span class="detail-label">Email</span><span class="detail-val"><a href="mailto:<?php echo emailCC($CentroComercial); ?>"><?php echo emailCC($CentroComercial); ?></a></span></div>
                    </div>
                </div>
                <div class="map-box">
                    <!-- INCARSO: Reemplazar con el embed de Google Maps de Plaza Universidad -->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.4!2d-99.178!3d19.376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDIyJzMzLjYiTiA5OcKwMTAnNDAuOCJX!5e0!3m2!1ses!2smx!4v1" allowfullscreen loading="lazy"></iframe>
                </div>
            </div>

            <!-- FORMULARIO: Campos con names/IDs que espera enviarCorreo.php -->
            <div class="form-card">
                <div class="form-card-head">
                    <h2>Escribenos.</h2>
                    <p>Nos encantara recibir tu mensaje.</p>
                </div>
                <form id="formulario" method="POST" action="enviarCorreo.php">
                    <div class="fg">
                        <label for="tipoMensaje">Motivo</label>
                        <select id="tipoMensaje" name="tipoMensaje" required>
                            <option value="">Elige una opcion</option>
                            <option value="1">Quejas y Sugerencias</option>
                            <option value="2">Espacios Disponibles</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="fg">
                            <label for="NombreContacto">Nombre</label>
                            <input type="text" id="NombreContacto" name="NombreContacto" placeholder="Tu nombre completo" required>
                        </div>
                        <div class="fg">
                            <label for="EmailContacto">Email</label>
                            <input type="email" id="EmailContacto" name="EmailContacto" placeholder="correo@ejemplo.com" required>
                        </div>
                    </div>
                    <div class="fg">
                        <label for="TelefonoContacto">Telefono</label>
                        <input type="tel" id="TelefonoContacto" name="TelefonoContacto" placeholder="55 1234 5678" maxlength="10" onKeypress="if(event.keyCode<45||event.keyCode>57) event.returnValue=false;">
                    </div>
                    <div class="fg">
                        <label for="Mensaje">Mensaje</label>
                        <textarea id="Mensaje" name="Mensaje" placeholder="Escribe tu mensaje..." rows="4" required></textarea>
                    </div>

                    <!-- Hidden fields requeridos por enviarCorreo.php -->
                    <input type="hidden" id="EmailPlaza" name="EmailPlaza" value="<?php echo emailCC($CentroComercial); ?>">
                    <input type="hidden" id="NombrePlaza" name="NombrePlaza" value="<?php echo $nombrePlaza; ?>">

                    <div class="privacy-row">
                        <input type="checkbox" id="privacy" required>
                        <label for="privacy">Acepto el <a href="#" onclick="$('#miModal').modal('show');$('#miModalContenido').load('AvisodePrivacidad.php');return false;">Aviso de Privacidad</a></label>
                    </div>
                    <button type="submit" id="btnSub" class="btn-submit">
                        Enviar mensaje
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                    <div class="success-box" id="sBox">Mensaje enviado correctamente. Nos pondremos en contacto pronto.</div>
                </form>
            </div>

        </div>
    </section>

    </main>

    <?php include("footer-new.php"); ?>
    <?php include("modales.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="Scripts/jquery.validate.min.js"></script>
    <script>
        window.addEventListener('scroll',()=>document.getElementById('nav').classList.toggle('scrolled',window.scrollY>50),{passive:true});
        function toggleMob(){var m=document.getElementById('mob-menu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':'';var b=document.querySelector('.nav-ham');if(b) b.setAttribute('aria-expanded',m.classList.contains('open'));}

        /* BACKEND: Envio de formulario via AJAX (como el original main.js) */
        $(document).ready(function(){
            $('#formulario').on('submit',function(e){
                e.preventDefault();
                var btn=$('#btnSub');
                btn.html('Enviando... <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>');
                btn.prop('disabled',true);

                $.ajax({
                    url:'enviarCorreo.php',
                    type:'POST',
                    data:$(this).serialize(),
                    success:function(){
                        btn.html('Enviar mensaje <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>');
                        btn.prop('disabled',false);
                        $('#sBox').fadeIn();
                        $('#formulario')[0].reset();
                    },
                    error:function(){
                        btn.html('Error, intenta de nuevo');
                        btn.prop('disabled',false);
                        setTimeout(function(){btn.html('Enviar mensaje');},3000);
                    }
                });
            });

            /* Cerrar modal */
            $(document).on('click','#cerrar, #btnAceptarAviso',function(){$(this).closest('.modal').modal('hide');});
        });

        /* Cursor */
        (function(){var cur=document.getElementById('cursor');if(cur&&window.matchMedia('(pointer:fine)').matches){document.addEventListener('mousemove',function(e){gsap.to(cur,{x:e.clientX,y:e.clientY,duration:.25,ease:'power2.out'});});}})();
    </script>
</body>
</html>
