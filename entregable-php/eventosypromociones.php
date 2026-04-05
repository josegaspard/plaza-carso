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
        .page-hero{margin-top:68px;position:relative;min-height:440px;display:flex;align-items:flex-end;overflow:hidden;}
        .page-hero-img{position:absolute;inset:0;background-size:cover;background-position:center;transform:scale(1.04);}
        .page-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(10,9,9,.7) 0%,rgba(10,9,9,.15) 60%,transparent 100%);}
        .page-hero-content{position:relative;z-index:2;padding:48px 52px;width:100%;}
        .page-kicker{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.42em;text-transform:uppercase;color:rgba(194,187,178,.8);margin-bottom:12px;display:block;}
        .page-h1{font-family:var(--serif);font-style:italic;font-size:clamp(52px,8vw,96px);font-weight:300;color:var(--warm);line-height:.92;}
        .page-sub{font-family:var(--sans);font-size:13px;font-weight:300;color:rgba(246,244,240,.6);margin-top:16px;max-width:480px;line-height:1.8;}

        /* TAB BAR */
        .tab-bar{position:sticky;top:68px;z-index:50;background:rgba(246,244,240,.97);backdrop-filter:blur(12px);border-bottom:1px solid var(--smoke);}
        .tab-inner{max-width:1400px;margin:0 auto;padding:0 52px;display:flex;gap:0;}
        .t-btn{font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.22em;text-transform:uppercase;color:var(--grey);background:none;border:none;cursor:pointer;padding:18px 20px;border-bottom:1.5px solid transparent;transition:color .2s,border-color .2s;white-space:nowrap;}
        .t-btn:hover{color:var(--mid);}.t-btn.active{color:var(--ink);border-bottom-color:var(--ink);font-weight:500;}

        /* PUBLICACIONES SECTION */
        .nov-section{padding:80px 52px 100px;background:var(--smoke);}
        .nov-section-inner{max-width:1400px;margin:0 auto;}

        /*
         * BACKEND COMPAT: publicaciones() genera HTML con links class="publicidad"
         * Restyle para que encajen con el nuevo diseno
         */
        #publicaciones{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:3px;}
        #publicaciones a.publicidad,#publicaciones .publicidad{position:relative;overflow:hidden;display:block;background:var(--silver);min-height:300px;}
        #publicaciones img{width:100%;height:100%;object-fit:cover;min-height:300px;filter:grayscale(20%);transition:transform .7s,filter .5s;}
        #publicaciones a:hover img{transform:scale(1.06);filter:grayscale(0%);}

        /* SOCIAL SECTION */
        .social-section{background:var(--ink);padding:80px 52px;}
        .social-inner{max-width:1400px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;gap:40px;flex-wrap:wrap;}
        .social-text h2{font-family:var(--serif);font-style:italic;font-size:clamp(32px,4vw,52px);font-weight:300;color:var(--warm);}
        .social-text p{font-family:var(--sans);font-size:12px;font-weight:300;color:var(--grey);margin-top:10px;line-height:1.8;}
        .social-btns{display:flex;gap:12px;flex-wrap:wrap;}
        .btn-social{display:flex;align-items:center;gap:9px;font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.18em;text-transform:uppercase;padding:12px 22px;cursor:pointer;transition:all .2s;}
        .btn-fb{background:#1877F2;color:#fff;}.btn-fb:hover{background:#1460c8;}
        .btn-tw{background:var(--warm);color:var(--ink);}.btn-tw:hover{background:var(--smoke);}

        @media(max-width:768px){
            *,*::before,*::after{cursor:auto!important;}a,button{cursor:pointer!important;}
            #nav{padding:0 20px;height:60px;}.nav-links{display:none;}.nav-ham{display:flex;min-width:44px;min-height:44px;align-items:center;justify-content:center;}
            .page-hero{margin-top:60px;min-height:280px;}.page-hero-content{padding:32px 20px;}
            .tab-bar{top:60px;}.tab-inner{padding:0 12px;overflow-x:auto;}.t-btn{min-height:44px;padding:14px 14px;}
            .nov-section,.social-section{padding-left:20px;padding-right:20px;}
            #publicaciones{grid-template-columns:1fr;}
            .social-inner{flex-direction:column;align-items:flex-start;}
            .mob-close{min-width:44px;min-height:44px;}#mob-menu a{padding:8px 0;min-height:48px;display:flex;align-items:center;justify-content:center;}
        }
        :focus-visible{outline:2px solid var(--ink);outline-offset:3px;}footer :focus-visible{outline-color:var(--warm);}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;}}
    </style>
</head>
<body>
    <?php echo facebookIni(); ?>

    <?php include("nav.php"); ?>

    <main id="main-content">

    <!-- PAGE HERO -->
    <section class="page-hero">
        <div class="page-hero-img" style="background-image:url('images/home/hero-eventos.jpg');background-position:center 35%;"></div>
        <div class="page-hero-content">
            <span class="page-kicker">Agenda & Actividades</span>
            <h1 class="page-h1">Novedades.</h1>
            <p class="page-sub">Eventos, promociones y todo lo nuevo en <?php echo $nombrePlaza; ?>.</p>
        </div>
    </section>

    <!-- TAB BAR -->
    <div class="tab-bar">
        <div class="tab-inner">
            <button class="t-btn active" onclick="switchTab('todos',this)">Todos</button>
            <button class="t-btn" onclick="switchTab('eventos',this)">Eventos</button>
            <button class="t-btn" onclick="switchTab('promociones',this)">Promociones</button>
            <button class="t-btn" onclick="switchTab('aperturas',this)">Aperturas</button>
        </div>
    </div>

    <!-- PUBLICACIONES: Contenido generado por el backend -->
    <section class="nov-section">
        <div class="nov-section-inner">
            <div id="publicaciones">
                <?php
                    $publicaciones = publicaciones($CentroComercial);
                    echo $publicaciones;
                ?>
            </div>
        </div>
    </section>

    <!-- REDES SOCIALES -->
    <section class="social-section">
        <div class="social-inner">
            <div class="social-text">
                <h2>Siguenos en<br>redes sociales.</h2>
                <p>Mantente al dia con las novedades, eventos y promociones de <?php echo $nombrePlaza; ?>.</p>
            </div>
            <div class="social-btns">
                <?php
                    $fb = facebook($CentroComercial);
                    $tw = twitter($CentroComercial);
                    if(!empty($fb)){
                        echo '<a href="'.$fb.'" target="_blank" class="btn-social btn-fb"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>Facebook</a>';
                    }
                    if(!empty($tw)){
                        echo '<a href="'.$tw.'" target="_blank" class="btn-social btn-tw"><svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>X / Twitter</a>';
                    }
                ?>
            </div>
        </div>
    </section>

    </main>

    <?php include("footer-new.php"); ?>
    <?php include("modales.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script>
        window.addEventListener('scroll',()=>document.getElementById('nav').classList.toggle('scrolled',window.scrollY>50),{passive:true});
        function toggleMob(){var m=document.getElementById('mob-menu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':'';var b=document.querySelector('.nav-ham');if(b) b.setAttribute('aria-expanded',m.classList.contains('open'));}

        function switchTab(tab,btn){
            document.querySelectorAll('.t-btn').forEach(function(b){b.classList.remove('active');});
            btn.classList.add('active');
            // Filtro visual — el backend ya genera todo el contenido
        }

        /* BACKEND: Handler para abrir modal de publicidad via AJAX */
        $(document).ready(function(){
            $(document).on('click','.publicidad',function(e){
                var _href=this.href;
                e.preventDefault();
                $('#miModalContenidoPublicidad').load(_href,function(){
                    $('#miModalPublicidad').modal('show');
                });
                return false;
            });
            $(document).on('click','#cerrar',function(){$(this).closest('.modal').modal('hide');});
        });

        /* Cursor */
        (function(){var cur=document.getElementById('cursor');if(cur&&window.matchMedia('(pointer:fine)').matches){document.addEventListener('mousemove',function(e){gsap.to(cur,{x:e.clientX,y:e.clientY,duration:.25,ease:'power2.out'});});}})();
    </script>
</body>
</html>
