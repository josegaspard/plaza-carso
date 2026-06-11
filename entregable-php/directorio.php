<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("header.php"); ?>
    <?php
    echo '<meta property="og:type" content="website" />';
    echo '<meta property="og:title" content="Directorio | ' . $nombrePlaza . '" />';
    echo '<meta property="og:description" content="Directorio completo de tiendas en ' . $nombrePlaza . '. Filtra por categoria." />';
    echo '<meta name="twitter:card" content="summary_large_image" />';
    echo '<meta name="twitter:title" content="Directorio | ' . $nombrePlaza . '" />';
    echo '<meta name="twitter:description" content="Directorio completo de tiendas en ' . $nombrePlaza . '." />';
    echo '<link rel="canonical" href="directorio.php" />';
    ?>
    <style>
        :root{--ink:#080706;--warm:#F5F3EF;--smoke:#EDEBE6;--silver:#C0B9B0;--grey:#857E76;--mid:#3A3530;--serif:'Cormorant Garamond',serif;--sans:'Outfit',sans-serif;}
        body{font-family:var(--sans);background:var(--warm);color:var(--ink);overflow-x:hidden;}
        a{text-decoration:none;color:inherit;}img{display:block;max-width:100%;}

        /* NAV */
        #nav{position:fixed;top:0;left:0;width:100%;z-index:800;height:68px;padding:0 48px;display:flex;align-items:center;justify-content:space-between;transition:background .5s,box-shadow .5s,height .4s;}
        #nav.scrolled{background:rgba(245,243,239,.96);backdrop-filter:blur(18px);box-shadow:0 1px 0 var(--smoke);height:58px;}
        .nav-logo{font-family:var(--serif);font-size:20px;font-weight:300;letter-spacing:.1em;color:var(--ink);}
        .nav-links{display:flex;align-items:center;gap:36px;}
        .nav-links a{font-family:var(--sans);font-size:10px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:var(--mid);position:relative;padding-bottom:2px;transition:color .25s;}
        .nav-links a::after{content:'';position:absolute;bottom:0;left:0;width:0;height:1px;background:var(--ink);transition:width .3s;}
        .nav-links a:hover,.nav-links a.active{color:var(--ink);}.nav-links a:hover::after,.nav-links a.active::after{width:100%;}
        .nav-cta-link{border:1px solid var(--ink)!important;padding:10px 22px!important;transition:background .25s,color .25s!important;}.nav-cta-link:hover{background:var(--ink)!important;color:var(--warm)!important;}.nav-cta-link::after{display:none!important;}
        .nav-ham{display:none;flex-direction:column;gap:5px;background:none;border:none;padding:4px;cursor:pointer;}.nav-ham span{display:block;width:22px;height:1px;background:var(--ink);}
        #mob-menu{position:fixed;inset:0;z-index:700;background:var(--ink);display:flex;flex-direction:column;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .4s;}
        #mob-menu.open{opacity:1;pointer-events:all;}
        #mob-menu a{font-family:var(--serif);font-style:italic;font-size:clamp(36px,8vw,68px);color:var(--warm);display:block;margin:8px 0;opacity:.75;transition:opacity .2s;text-align:center;}
        .mob-close{position:absolute;top:24px;right:32px;background:none;border:none;font-size:28px;color:var(--warm);cursor:pointer;}
        .skip-link{position:absolute;top:-100%;left:16px;z-index:9999;background:var(--ink);color:var(--warm);padding:12px 24px;font-family:var(--sans);font-size:13px;transition:top .2s;}.skip-link:focus{top:16px;}

        /* PAGE HERO */
        .page-hero{margin-top:68px;position:relative;min-height:360px;display:flex;align-items:flex-end;overflow:hidden;}
        .page-hero-img{position:absolute;inset:0;background-size:cover;background-position:center;transform:scale(1.04);}
        .page-hero::after{content:'';position:absolute;inset:0;background:linear-gradient(to top,rgba(10,9,9,.7) 0%,rgba(10,9,9,.15) 60%,transparent 100%);}
        .page-hero-content{position:relative;z-index:2;padding:48px 52px;width:100%;}
        .page-kicker{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.42em;text-transform:uppercase;color:rgba(194,187,178,.8);margin-bottom:12px;display:block;}
        .page-h1{font-family:var(--serif);font-style:italic;font-size:clamp(52px,8vw,96px);font-weight:300;color:var(--warm);line-height:.92;}

        /* FILTER BAR */
        .filter-bar{position:sticky;top:68px;z-index:50;background:rgba(246,244,240,.97);backdrop-filter:blur(12px);border-bottom:1px solid var(--smoke);padding:0 52px;}
        .filter-inner{display:flex;align-items:center;gap:0;overflow-x:auto;scrollbar-width:none;max-width:100%;}.filter-inner::-webkit-scrollbar{display:none;}
        .f-btn{flex-shrink:0;font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.22em;text-transform:uppercase;color:var(--grey);background:none;border:none;cursor:pointer;padding:18px 18px;border-bottom:1.5px solid transparent;transition:color .2s,border-color .2s;white-space:nowrap;}
        .f-btn:hover{color:var(--mid);}.f-btn.active{color:var(--ink);border-bottom-color:var(--ink);font-weight:500;}
        .search-wrap{margin-left:auto;flex-shrink:0;border-left:1px solid var(--smoke);padding-left:20px;display:flex;align-items:center;gap:8px;}
        .search-wrap input{font-family:var(--sans);font-size:12px;font-weight:300;background:none;border:none;outline:none;color:var(--ink);width:160px;padding:8px 0;}.search-wrap input::placeholder{color:var(--silver);}

        /* STORE GRID */
        .dir-section{padding:72px 0 100px;background:var(--smoke);}
        .dir-inner{max-width:1600px;margin:0 auto;padding:0 52px;}
        .dir-count{font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:var(--grey);margin-bottom:40px;}

        /*
         * BACKEND COMPAT: directorioCC2() genera divs con .contenedorImgLocatario
         * Los restyled aqui para que encajen con el nuevo diseno
         */
        #iconLocal{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:3px;}
        .contenedorImgLocatario{position:relative;overflow:hidden;background:var(--silver);padding:0!important;margin:0!important;width:auto!important;float:none!important;}
        .contenedorImgLocatario a{display:block;width:100%;height:100%;min-height:200px;display:flex;align-items:center;justify-content:center;background:var(--warm);padding:20px;transition:background .3s;}
        .contenedorImgLocatario a:hover{background:var(--smoke);}
        .contenedorImgLocatario a img{width:100%!important;max-width:160px;height:auto;filter:grayscale(30%);transition:filter .5s;object-fit:contain;}
        .contenedorImgLocatario a:hover img{filter:grayscale(0%);}
        /* Si el locatario no tiene imagen, mostrar nombre como texto */
        .contenedorImgLocatario a.abrirModalLocatario{font-family:var(--serif);font-size:18px;font-weight:300;color:var(--ink);text-align:center;}

        /* Backend select override: styled to look like a filter tab */
        select.giroComercial{font-family:var(--sans)!important;font-size:9px!important;font-weight:400!important;letter-spacing:.15em!important;text-transform:uppercase!important;color:var(--grey)!important;background:none!important;border:none!important;border-bottom:1.5px solid transparent!important;padding:18px 16px!important;cursor:pointer!important;appearance:auto!important;min-width:200px;transition:color .2s,border-color .2s;}
        select.giroComercial:focus{color:var(--ink)!important;border-bottom-color:var(--ink)!important;}

        /* STORE MODAL (Bootstrap 3 override) */
        #miModalLocatario .modal-dialog{width:90%;max-width:960px;margin:2% auto;}
        #miModalLocatario .modal-content{border-radius:0;border:none;min-height:400px;}

        @media(max-width:768px){
            *,*::before,*::after{cursor:auto!important;}a,button,input,select,textarea{cursor:pointer!important;}
            #nav{padding:0 20px;height:60px;}#nav.scrolled{height:54px;}.nav-links{display:none;}.nav-ham{display:flex;min-width:44px;min-height:44px;align-items:center;justify-content:center;}
            .page-hero{margin-top:60px;min-height:280px;}.page-hero-content{padding:32px 20px;}
            .filter-bar{padding:0 0 0 12px;top:60px;}.f-btn{padding:14px 14px;min-height:44px;}
            .dir-inner{padding:0 16px;}
            #iconLocal{grid-template-columns:1fr 1fr;}
            .mob-close{min-width:44px;min-height:44px;}#mob-menu a{padding:8px 0;min-height:48px;display:flex;align-items:center;justify-content:center;}
        }
        @media(max-width:374px){#iconLocal{grid-template-columns:1fr;}}
        :focus-visible{outline:2px solid var(--ink);outline-offset:3px;}footer :focus-visible{outline-color:var(--warm);}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important;}}
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <main id="main-content">

    <!-- PAGE HERO -->
    <section class="page-hero">
        <div class="page-hero-img" style="background-image:url('images/home/directorio-bg.jpg');"></div>
        <div class="page-hero-content">
            <span class="page-kicker"><?php echo $nombrePlaza; ?></span>
            <h1 class="page-h1">Directorio.</h1>
        </div>
    </section>

    <!-- FILTER BAR: Select de categorias generado por el backend -->
    <div class="filter-bar">
        <div class="filter-inner" id="fi">
            <?php echo giroComercial($CentroComercial); ?>
        </div>
    </div>

    <!-- DIRECTORIO DE TIENDAS -->
    <section class="dir-section">
        <div class="dir-inner">
            <div class="dir-count" id="dir-count">Directorio de tiendas</div>

            <!-- BACKEND: directorioCC2() genera el grid de locatarios con IDs y links -->
            <?php
                $directorioCC = directorioCC2($CentroComercial,'');
                echo $directorioCC;
            ?>
        </div>
    </section>

    </main>

    <?php include("footer-new.php"); ?>
    <?php include("modales.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script>
        /* NAV scroll */
        window.addEventListener('scroll',()=>document.getElementById('nav').classList.toggle('scrolled',window.scrollY>50),{passive:true});

        /* Mobile menu */
        function toggleMob(){var m=document.getElementById('mob-menu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':'';var b=document.querySelector('.nav-ham');if(b) b.setAttribute('aria-expanded',m.classList.contains('open'));}

        /* CURSOR */
        (function(){
            var cur=document.getElementById('cursor');
            if(cur&&window.matchMedia('(pointer:fine)').matches){
                document.addEventListener('mousemove',function(e){gsap.to(cur,{x:e.clientX,y:e.clientY,duration:.25,ease:'power2.out'});});
                document.querySelectorAll('a,button,.contenedorImgLocatario').forEach(function(el){el.addEventListener('mouseenter',function(){cur.classList.add('hover');});el.addEventListener('mouseleave',function(){cur.classList.remove('hover');});});
            }
        })();

        /* BACKEND: Handler para abrir modal de locatario via AJAX */
        $(document).ready(function(){
            /* Click en locatario → abre modal Bootstrap 3 */
            $(document).on('click','.local, .abrirModalLocatario',function(e){
                var _href=this.href;
                e.preventDefault();
                $('#miModalContenidoLocatario').load(_href,function(){
                    $('#miModalLocatario').modal('show');
                });
                return false;
            });

            /* Filtro por giro comercial (AJAX POST a filtroGiroComercialLocal.php) */
            $(document).on('change','select.giroComercial',function(){
                var giroComercial=this.value;
                var centroComercial=<?php echo $CentroComercial; ?>;
                $.ajax({
                    url:'filtroGiroComercialLocal.php',
                    type:'POST',
                    data:{"giroComercial":giroComercial,"centroComercial":centroComercial},
                    beforeSend:function(){$("#iconLocal").html('<p style="text-align:center;padding:40px;color:var(--grey);">Cargando...</p>');},
                    success:function(response){$("#iconLocal").html(response);}
                });
            });

            /* Cerrar modal */
            $(document).on('click','#cerrar',function(){$(this).closest('.modal').modal('hide');});
        });

        /* El filtro se maneja via el select.giroComercial del backend */
    </script>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {"@type": "ListItem", "position": 1, "name": "<?php echo $nombrePlaza; ?>", "item": "index.php"},
            {"@type": "ListItem", "position": 2, "name": "Directorio", "item": "directorio.php"}
        ]
    }
    </script>
</body>
</html>
