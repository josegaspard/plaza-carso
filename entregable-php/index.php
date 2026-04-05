<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("header.php"); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        :root {
            --ink: #080706; --warm: #F5F3EF; --smoke: #EDEBE6;
            --silver: #C0B9B0; --grey: #857E76; --mid: #3A3530;
            --serif: 'Cormorant Garamond', serif; --sans: 'Outfit', sans-serif;
            --ease-out: cubic-bezier(.16, 1, .3, 1);
        }
        body { font-family:var(--sans); background:var(--warm); color:var(--ink); overflow-x:hidden; }
        @media(min-width:769px){body{background:url('images/home/back-directorio.jpg') center/cover fixed, var(--warm);}}
        a { text-decoration:none; color:inherit; } img { display:block; width:100%; object-fit:cover; }

        /* LOADER */
        #loader{position:fixed;inset:0;z-index:2000;background:var(--warm);display:flex;align-items:center;justify-content:center;pointer-events:all;}
        #loader.gone{display:none;}
        .loader-logo-wrap{width:clamp(140px,35vw,240px);opacity:0;transform:translateY(30px) scale(0.95);display:flex;justify-content:center;}
        .loader-img{width:100%;height:auto;filter:brightness(0);display:block;}
        .loader-bar{position:absolute;bottom:0;left:0;height:2px;width:0;background:var(--ink);}

        /* CURSOR */
        #cur{position:fixed;width:36px;height:36px;border:1px solid rgba(8,7,6,.5);border-radius:50%;pointer-events:none;z-index:9000;transform:translate(-50%,-50%) scale(1);will-change:transform;transition:width .3s var(--ease-out),height .3s var(--ease-out),border-color .3s,background .3s;}
        #cur.h{width:56px;height:56px;background:rgba(8,7,6,.07);border-color:var(--ink);}
        @media(pointer:coarse){#cur{display:none;}}

        /* NAV — ya definido en carso.css, override inline */
        #nav{position:fixed;top:0;left:0;width:100%;z-index:800;height:68px;padding:0 48px;display:flex;align-items:center;justify-content:space-between;transition:background .5s,box-shadow .5s,height .4s;}
        #nav.s{background:rgba(245,243,239,.96);backdrop-filter:blur(18px);-webkit-backdrop-filter:blur(18px);box-shadow:0 1px 0 var(--smoke);height:58px;}
        .nav-logo{font-family:var(--serif);font-size:20px;font-weight:300;letter-spacing:.1em;color:var(--ink);opacity:0;}
        .nav-logo em{font-style:italic;}
        .nav-links{display:flex;align-items:center;gap:36px;opacity:0;}
        .nav-links a{font-family:var(--sans);font-size:10px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:var(--mid);position:relative;padding-bottom:2px;transition:color .25s;}
        .nav-links a::after{content:'';position:absolute;bottom:0;left:0;width:0;height:1px;background:var(--ink);transition:width .3s;}
        .nav-links a:hover,.nav-links a.active{color:var(--ink);}
        .nav-links a:hover::after,.nav-links a.active::after{width:100%;}
        .nav-cta-link{border:1px solid var(--ink)!important;padding:10px 22px!important;transition:background .25s,color .25s!important;}
        .nav-cta-link:hover{background:var(--ink)!important;color:var(--warm)!important;}
        .nav-cta-link::after{display:none!important;}
        .nav-ham{display:none;flex-direction:column;gap:5px;background:none;border:none;padding:4px;cursor:pointer;}
        .nav-ham span{display:block;width:22px;height:1px;background:var(--ink);transition:all .35s;}
        #mob-menu{position:fixed;inset:0;z-index:700;background:var(--ink);display:flex;flex-direction:column;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .45s var(--ease-out);}
        #mob-menu.open{opacity:1;pointer-events:all;}
        #mob-menu a{font-family:var(--serif);font-style:italic;font-size:clamp(36px,8vw,68px);color:var(--warm);display:block;margin:8px 0;opacity:.75;transition:opacity .2s;text-align:center;}
        .mob-close{position:absolute;top:24px;right:32px;background:none;border:none;font-size:28px;color:var(--warm);cursor:pointer;}

        /* HERO */
        #hero{position:relative;width:100%;display:flex;align-items:center;justify-content:center;height:100svh;min-height:600px;overflow:hidden;}
        .h-img{position:absolute;inset:0;background:url('images/home/back-slide-home.jpg') center/cover no-repeat;transform:scale(1.08);will-change:transform;}
        .h-ov{position:absolute;inset:0;background:radial-gradient(circle at center,rgba(245,243,239,0.9) 0%,rgba(245,243,239,0.75) 45%,rgba(245,243,239,0.4) 100%);}
        .h-grain{position:absolute;inset:0;opacity:.035;pointer-events:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");background-size:200px;}
        .h-content{position:relative;z-index:4;padding:0 48px;max-width:900px;width:100%;display:flex;flex-direction:column;align-items:center;text-align:center;}
        .h-kicker{display:flex;align-items:center;justify-content:center;gap:14px;margin-bottom:24px;overflow:hidden;}
        .h-kicker-bar{width:0;height:1px;background:var(--grey);flex-shrink:0;transition:width .8s var(--ease-out);}
        .h-kicker-bar.in{width:32px;}
        .h-kicker-text{font-family:var(--sans);font-size:11px;font-weight:500;letter-spacing:.35em;text-transform:uppercase;color:var(--grey);transform:translateY(10px);opacity:0;transition:transform .7s var(--ease-out),opacity .7s;transition-delay:.2s;}
        .h-kicker-text.in{transform:translateX(0);opacity:1;}
        .h-headline{margin-bottom:28px;}
        .h-line{display:block;overflow:hidden;line-height:1;padding-top:.5em;padding-bottom:.2em;margin-top:-.5em;margin-bottom:-.2em;}
        .h-line-inner{display:block;font-family:var(--serif);font-style:italic;font-size:clamp(40px,6.5vw,92px);font-weight:300;color:var(--ink);transform:translateY(115%);opacity:0;line-height:1;}
        .h-line-inner.strong{font-style:normal;font-weight:400;}
        .h-divider{width:0;height:1px;background:rgba(8,7,6,.15);margin:0 auto 32px auto;transition:width 1s var(--ease-out);}
        .h-divider.in{width:100%;max-width:240px;}
        .h-sub{font-family:var(--sans);font-size:14px;font-weight:300;color:var(--mid);line-height:1.7;max-width:500px;margin:0 auto 40px auto;transform:translateY(16px);opacity:0;}
        .h-btns{display:flex;justify-content:center;gap:16px;flex-wrap:wrap;transform:translateY(18px);opacity:0;}
        .btn-p{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.22em;text-transform:uppercase;background:var(--ink);color:var(--warm);padding:14px 32px;border:none;cursor:pointer;display:inline-block;transition:background .25s,transform .2s;}
        .btn-p:hover{background:var(--mid);} .btn-p:active{transform:scale(.97);}
        .btn-g{font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.22em;text-transform:uppercase;border:1px solid rgba(8,7,6,.3);color:var(--ink);padding:14px 32px;display:inline-block;cursor:pointer;transition:border-color .25s,background .25s,transform .2s;}
        .btn-g:hover{border-color:var(--ink);background:rgba(8,7,6,.06);} .btn-g:active{transform:scale(.97);}
        .h-strip{position:absolute;bottom:0;left:0;right:0;z-index:4;background:rgba(8,7,6,.88);backdrop-filter:blur(10px);display:grid;grid-template-columns:repeat(4,1fr);border-top:1px solid rgba(255,255,255,.06);transform:translateY(100%);opacity:0;}
        .h-strip-item{padding:18px 28px;border-right:1px solid rgba(255,255,255,.07);display:flex;flex-direction:column;gap:5px;}
        .h-strip-item:last-child{border-right:none;}
        .h-strip-label{font-family:var(--sans);font-size:8px;font-weight:400;letter-spacing:.3em;text-transform:uppercase;color:rgba(255,255,255,.3);}
        .h-strip-val{font-family:var(--serif);font-size:15px;font-weight:300;color:rgba(245,243,239,.85);}
        .h-scroll{position:absolute;right:32px;top:50%;transform:translateY(-50%);z-index:4;display:flex;flex-direction:column;align-items:center;gap:10px;opacity:0;}
        .h-scroll span{font-family:var(--sans);font-size:8px;letter-spacing:.4em;text-transform:uppercase;color:rgba(8,7,6,.4);writing-mode:vertical-rl;}
        .h-scroll-line{width:1px;height:52px;background:linear-gradient(to bottom,rgba(8,7,6,.35),transparent);animation:pulse 2.4s ease infinite;}
        @keyframes pulse{0%{transform:scaleY(0);transform-origin:top;}50%{transform:scaleY(1);transform-origin:top;}51%{transform:scaleY(1);transform-origin:bottom;}100%{transform:scaleY(0);transform-origin:bottom;}}

        /* MARQUEE */
        .marquee{background:var(--ink);padding:16px 0;overflow:hidden;}
        .marquee-track{display:flex;white-space:nowrap;animation:mq 30s linear infinite;}
        .mi{font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.45em;text-transform:uppercase;color:rgba(255,255,255,.35);padding:0 32px;flex-shrink:0;}
        .md{color:rgba(255,255,255,.12);}
        @keyframes mq{to{transform:translateX(-50%);}}

        /* STATEMENT */
        .stmt{padding:120px 48px;background:var(--warm);text-align:center;}
        .stmt-tag{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.4em;text-transform:uppercase;color:var(--grey);display:block;margin-bottom:36px;}
        .stmt-q{font-family:var(--serif);font-style:italic;font-size:clamp(28px,4vw,58px);font-weight:300;line-height:1.28;color:var(--ink);max-width:860px;margin:0 auto 64px;}
        .stmt-q em{font-style:normal;color:var(--grey);}
        .stats{display:grid;grid-template-columns:repeat(4,1fr);border:1px solid var(--smoke);}
        .sc{padding:36px 20px;border-right:1px solid var(--smoke);text-align:center;}
        .sc:last-child{border-right:none;}
        .sn{font-family:var(--serif);font-size:clamp(36px,4vw,52px);font-weight:300;color:var(--ink);line-height:1;}
        .sl{font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:var(--grey);margin-top:8px;}

        /* PANELS */
        .panels{background:var(--smoke);}
        .panel{display:grid;grid-template-columns:1fr 1fr;min-height:78vh;}
        .panel.rev{direction:rtl;} .panel.rev>*{direction:ltr;}
        .p-img{overflow:hidden;position:relative;}
        .p-img img{height:100%;min-height:500px;object-fit:cover;filter:grayscale(18%);transform:scale(1.05);transition:transform 7s ease,filter .6s;}
        .panel:hover .p-img img{transform:scale(1);filter:grayscale(0%);}
        .p-body{background:var(--warm);display:flex;flex-direction:column;justify-content:center;padding:72px 64px;}
        .p-num{font-family:var(--serif);font-size:100px;font-weight:300;color:var(--smoke);line-height:1;margin-bottom:-10px;}
        .p-tag{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.38em;text-transform:uppercase;color:var(--grey);margin-bottom:18px;display:flex;align-items:center;gap:10px;}
        .p-tag::before{content:'';display:block;width:16px;height:1px;background:var(--silver);}
        .p-h2{font-family:var(--serif);font-style:italic;font-size:clamp(32px,3.2vw,50px);font-weight:300;color:var(--ink);line-height:1.15;margin-bottom:22px;}
        .p-desc{font-family:var(--sans);font-size:13px;font-weight:300;color:var(--grey);line-height:1.88;max-width:340px;margin-bottom:36px;}
        .arr{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.2em;text-transform:uppercase;color:var(--ink);display:inline-flex;align-items:center;gap:10px;border-bottom:1px solid var(--ink);padding-bottom:2px;transition:gap .35s,opacity .2s;}
        .arr:hover{gap:20px;opacity:.55;}

        /* STORE SWIPER */
        .sl-sec{background:var(--ink);padding:96px 0;}
        .sl-head{padding:0 48px;margin-bottom:52px;display:flex;justify-content:space-between;align-items:flex-end;}
        .sl-h2{font-family:var(--serif);font-size:clamp(36px,5vw,68px);font-weight:300;color:var(--warm);line-height:1;}
        .sl-h2 em{font-style:italic;}
        .sl-link{font-family:var(--sans);font-size:9px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:rgba(245,243,239,.35);border-bottom:1px solid rgba(245,243,239,.18);padding-bottom:2px;transition:color .2s,border-color .2s;}
        .sl-link:hover{color:var(--warm);border-color:var(--warm);}
        .swiper-sl{padding:0 48px 48px!important;}
        .ss{position:relative;overflow:hidden;background:var(--mid);}
        .ss img{aspect-ratio:9/13;object-fit:cover;filter:grayscale(25%);transition:filter .6s,transform .7s;}
        .ss:hover img{filter:grayscale(0%);transform:scale(1.06);}
        .ss-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,7,6,.82) 0%,transparent 52%);pointer-events:none;}
        .ss-info{position:absolute;bottom:0;left:0;right:0;padding:20px 18px;}
        .ss-cat{font-family:var(--sans);font-size:8px;font-weight:500;letter-spacing:.3em;text-transform:uppercase;color:var(--silver);display:block;margin-bottom:5px;}
        .ss-name{font-family:var(--serif);font-size:22px;font-weight:300;color:var(--warm);}
        .swiper-pagination-sl .swiper-pagination-bullet{background:rgba(245,243,239,.2);width:5px;height:5px;transition:width .3s,background .3s;}
        .swiper-pagination-sl .swiper-pagination-bullet-active{background:var(--warm);width:18px;border-radius:3px;}

        /* ROOF CTA */
        .roof{position:relative;min-height:72vh;display:flex;align-items:center;overflow:hidden;}
        .roof-bg{position:absolute;inset:0;background:url('images/home/hero-new-2.jpg') center/cover no-repeat;transform:scale(1.04);will-change:transform;}
        .roof-ov{position:absolute;inset:0;background:linear-gradient(to right,rgba(8,7,6,.82) 0%,rgba(8,7,6,.45) 55%,transparent 100%);}
        .roof-c{position:relative;z-index:2;padding:0 48px;max-width:620px;}
        .roof-tag{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.4em;text-transform:uppercase;color:rgba(192,185,176,.65);display:flex;align-items:center;gap:12px;margin-bottom:24px;}
        .roof-tag::before{content:'';display:block;width:16px;height:1px;background:rgba(192,185,176,.4);}
        .roof-h2{font-family:var(--serif);font-style:italic;font-size:clamp(38px,6vw,82px);font-weight:300;color:var(--warm);line-height:.95;margin-bottom:26px;}
        .roof-desc{font-family:var(--sans);font-size:13px;font-weight:300;color:rgba(245,243,239,.6);line-height:1.85;margin-bottom:38px;}

        /* NOVEDADES */
        .nov{padding:112px 48px;background:var(--warm);}
        .nov-top{display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;}
        .nov-h2{font-family:var(--serif);font-size:clamp(36px,5vw,62px);font-weight:300;color:var(--ink);line-height:1;}
        .nov-h2 em{font-style:italic;}
        .nov-grid{display:grid;grid-template-columns:1.3fr 1fr 1fr;gap:3px;}
        .nc{position:relative;overflow:hidden;display:block;background:var(--silver);}
        .nc:first-child{grid-row:span 2;}
        .nc img{width:100%;height:100%;min-height:260px;object-fit:cover;filter:grayscale(20%);transition:transform .7s,filter .5s;}
        .nc:first-child img{min-height:520px;}
        .nc:hover img{transform:scale(1.06);filter:grayscale(0%);}
        .nc-ov{position:absolute;inset:0;background:linear-gradient(to top,rgba(8,7,6,.75) 0%,transparent 55%);pointer-events:none;}
        .nc-info{position:absolute;bottom:0;left:0;right:0;padding:22px 20px;}
        .nc-tag{font-family:var(--sans);font-size:8px;font-weight:500;letter-spacing:.32em;text-transform:uppercase;color:var(--silver);display:block;margin-bottom:7px;}
        .nc-title{font-family:var(--serif);font-weight:300;color:var(--warm);line-height:1.25;}
        .nc:first-child .nc-title{font-size:clamp(18px,2.2vw,28px);}
        .nc:not(:first-child) .nc-title{font-size:17px;}

        /* NEWSLETTER */
        .nl{background:var(--smoke);padding:96px 48px;text-align:center;}
        .nl-tag{font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.4em;text-transform:uppercase;color:var(--grey);display:block;margin-bottom:18px;}
        .nl-h2{font-family:var(--serif);font-style:italic;font-size:clamp(30px,4vw,50px);font-weight:300;color:var(--ink);margin-bottom:12px;}
        .nl-sub{font-family:var(--sans);font-size:13px;font-weight:300;color:var(--grey);margin-bottom:40px;}
        .nl-form{display:flex;max-width:460px;margin:0 auto;border-bottom:1px solid var(--mid);}
        .nl-form input{flex:1;background:none;border:none;outline:none;font-family:var(--sans);font-size:14px;font-weight:300;color:var(--ink);padding:12px 0;}
        .nl-form input::placeholder{color:var(--silver);}
        .nl-form button{background:none;border:none;cursor:pointer;font-family:var(--sans);font-size:9px;font-weight:500;letter-spacing:.18em;text-transform:uppercase;color:var(--ink);padding:12px 0 12px 18px;transition:color .2s;}

        /* SCROLL REVEAL */
        .rv{opacity:0;transform:translateY(44px);transition:opacity .9s var(--ease-out),transform .9s var(--ease-out);}
        .rv.in{opacity:1;transform:none;}
        .rv-d1{transition-delay:.1s;} .rv-d2{transition-delay:.2s;} .rv-d3{transition-delay:.3s;}

        /* RESPONSIVE */
        @media(max-width:1100px){.panel{grid-template-columns:1fr;}.panel.rev{direction:ltr;}.p-img img{min-height:55vw;}.p-body{padding:56px 36px;}.stats{grid-template-columns:1fr 1fr;}.sc:nth-child(2){border-right:none;}.sc:nth-child(3),.sc:nth-child(4){border-top:1px solid var(--smoke);}.sc:nth-child(4){border-right:none;}}
        @media(max-width:768px){
            *,*::before,*::after{cursor:auto!important;}a,button,input,select,textarea{cursor:pointer!important;-webkit-tap-highlight-color:rgba(0,0,0,0.05);}
            #nav{padding:0 20px;height:60px;}#nav.s{height:54px;}.nav-links{display:none;}.nav-ham{display:flex;min-width:44px;min-height:44px;align-items:center;justify-content:center;}
            .h-content{padding:0 20px;}.h-scroll{display:none;}.h-line-inner{font-size:clamp(32px,8vw,52px);}.h-sub{margin-bottom:28px;max-width:100%;font-size:13px;}
            .h-btns{flex-direction:column;width:100%;gap:10px;}.btn-p,.btn-g{width:100%;text-align:center;padding:16px 24px;min-height:48px;display:flex;align-items:center;justify-content:center;}
            .h-strip{grid-template-columns:1fr 1fr;}.h-strip-item{padding:14px 16px;}.h-strip-item:nth-child(2){border-right:none;}.h-strip-item:nth-child(3),.h-strip-item:nth-child(4){border-top:1px solid rgba(255,255,255,.06);}.h-strip-item:nth-child(4){border-right:none;}
            .stmt,.nov,.nl{padding:64px 20px;}.stmt-q{font-size:clamp(22px,5.5vw,32px);margin-bottom:40px;}.stats{grid-template-columns:1fr 1fr;}
            .sl-head{padding-left:20px;padding-right:20px;flex-direction:column;align-items:flex-start;gap:16px;}.swiper-sl{padding-left:20px!important;padding-right:20px!important;}.sl-sec{padding:64px 0;}
            .roof{min-height:60vh;padding:60px 0;}.roof-c{padding:0 20px;}.roof-h2{font-size:clamp(32px,8vw,52px);}
            .nov-top{flex-direction:column;align-items:flex-start;gap:16px;margin-bottom:32px;}.nov-grid{grid-template-columns:1fr;gap:3px;}.nc:first-child{grid-row:auto;}.nc img,.nc:first-child img{min-height:220px;max-height:300px;}
            .nl-form{max-width:100%;}.nl-form input{font-size:16px;}
            #mob-menu a{padding:8px 0;min-height:48px;display:flex;align-items:center;justify-content:center;}
        }
        @media(max-width:374px){.h-line-inner{font-size:clamp(28px,9vw,36px);}.h-strip{grid-template-columns:1fr;}.h-strip-item{border-right:none!important;}.h-strip-item:nth-child(n+2){border-top:1px solid rgba(255,255,255,.06);}.stats{grid-template-columns:1fr;}.sc{border-right:none!important;}.sc:nth-child(n+2){border-top:1px solid var(--smoke);}}
        :focus-visible{outline:2px solid var(--ink);outline-offset:3px;}footer :focus-visible{outline-color:var(--warm);}
        .skip-link{position:absolute;top:-100%;left:16px;z-index:9999;background:var(--ink);color:var(--warm);padding:12px 24px;font-family:var(--sans);font-size:13px;font-weight:500;letter-spacing:.1em;text-transform:uppercase;transition:top .2s;}.skip-link:focus{top:16px;}
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;animation-iteration-count:1!important;transition-duration:.01ms!important;scroll-behavior:auto!important;}}
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <!-- LOADER -->
    <div id="loader" aria-hidden="true">
        <div class="loader-logo-wrap" id="lw">
            <img src="images/logo.png" alt="<?php echo $nombrePlaza; ?>" class="loader-img">
        </div>
        <div class="loader-bar" id="lb"></div>
    </div>

    <!-- CURSOR (solo desktop) -->
    <div id="cur" aria-hidden="true"></div>

    <main id="main-content">

    <!-- HERO -->
    <section id="hero">
        <div class="h-img" id="hImg"></div>
        <div class="h-ov"></div>
        <div class="h-grain" aria-hidden="true"></div>
        <div class="h-content">
            <h1 class="h-headline">
                <span class="h-line"><span class="h-line-inner" id="hl1">El destino</span></span>
                <span class="h-line"><span class="h-line-inner" id="hl2">mas sofisticado</span></span>
                <span class="h-line"><span class="h-line-inner strong" id="hl3">de la Ciudad.</span></span>
            </h1>
            <div class="h-divider" id="hDiv"></div>
            <p class="h-sub" id="hSub"><?php echo strip_tags(descripcionCC_Completo($CentroComercial)); ?></p>
            <div class="h-btns" id="hBtns">
                <a href="directorio.php" class="btn-p">Explorar Directorio</a>
                <a href="mapa.php" class="btn-g">Ver Mapa</a>
            </div>
        </div>
        <div class="h-strip" id="hStrip">
            <div class="h-strip-item">
                <span class="h-strip-label">Ubicacion</span>
                <span class="h-strip-val"><?php echo str_replace('<br>',', ',direccionCC($CentroComercial)); ?></span>
            </div>
            <div class="h-strip-item">
                <span class="h-strip-label">Horario</span>
                <span class="h-strip-val">11:00 - 21:00</span>
            </div>
            <div class="h-strip-item">
                <span class="h-strip-label">Telefono</span>
                <span class="h-strip-val"><?php echo telefonoCC($CentroComercial); ?></span>
            </div>
            <div class="h-strip-item">
                <span class="h-strip-label">Estacionamiento</span>
                <span class="h-strip-val">Disponible</span>
            </div>
        </div>
        <div class="h-scroll" id="hScroll" aria-hidden="true"><span>Scroll</span><div class="h-scroll-line"></div></div>
    </section>

    <!-- MARQUEE -->
    <div class="marquee" aria-hidden="true">
        <div class="marquee-track">
            <span class="mi">Moda</span><span class="md mi">&middot;</span>
            <span class="mi">Gastronomia</span><span class="md mi">&middot;</span>
            <span class="mi">Entretenimiento</span><span class="md mi">&middot;</span>
            <span class="mi">Joyeria</span><span class="md mi">&middot;</span>
            <span class="mi">Tecnologia</span><span class="md mi">&middot;</span>
            <span class="mi"><?php echo $nombrePlaza; ?></span><span class="md mi">&middot;</span>
            <span class="mi">Moda</span><span class="md mi">&middot;</span>
            <span class="mi">Gastronomia</span><span class="md mi">&middot;</span>
            <span class="mi">Entretenimiento</span><span class="md mi">&middot;</span>
            <span class="mi">Joyeria</span><span class="md mi">&middot;</span>
            <span class="mi">Tecnologia</span><span class="md mi">&middot;</span>
            <span class="mi"><?php echo $nombrePlaza; ?></span><span class="md mi">&middot;</span>
        </div>
    </div>

    <!-- STATEMENT -->
    <section class="stmt">
        <span class="stmt-tag rv">Nuestra Esencia</span>
        <p class="stmt-q rv rv-d1">"Un espacio donde la arquitectura, la moda y la gastronomia <em>se convierten en experiencia.</em>"</p>
        <div class="stats rv rv-d2">
            <div class="sc"><div class="sn" data-count="120">0</div><div class="sl">Tiendas</div></div>
            <div class="sc"><div class="sn">2</div><div class="sl">Niveles</div></div>
            <div class="sc"><div class="sn">+50</div><div class="sl">Gastronomia</div></div>
            <div class="sc"><div class="sn">&infin;</div><div class="sl">Experiencia</div></div>
        </div>
    </section>

    <!-- PANELS -->
    <section class="panels">
        <div class="panel rv">
            <div class="p-img"><img src="images/stores/armani-exchange.jpg" alt="Boutiques" loading="lazy"></div>
            <div class="p-body">
                <span class="p-num">01</span>
                <span class="p-tag">Moda & Boutiques</span>
                <h2 class="p-h2">Las marcas mas deseadas del mundo, aqui.</h2>
                <p class="p-desc">Desde las grandes casas internacionales hasta las firmas de nueva generacion. <?php echo $nombrePlaza; ?> reune lo mas selecto de la moda.</p>
                <a href="directorio.php" class="arr">Explorar Directorio <span>&rarr;</span></a>
            </div>
        </div>
        <div class="panel rev rv">
            <div class="p-img"><img src="images/home/hero-new-3.jpg" alt="Gastronomia" loading="lazy"></div>
            <div class="p-body">
                <span class="p-num">02</span>
                <span class="p-tag">Gastronomia</span>
                <h2 class="p-h2">Sabores que definen la ciudad.</h2>
                <p class="p-desc">Una oferta gastronomica unica. Desde cocina de autor hasta los favoritos de siempre. El lugar para disfrutar cada momento.</p>
                <a href="eventosypromociones.php" class="arr">Ver Novedades <span>&rarr;</span></a>
            </div>
        </div>
    </section>

    <!-- TIENDAS DESTACADAS (datos dinamicos del backend) -->
    <section class="sl-sec">
        <div class="sl-head rv">
            <h2 class="sl-h2">Tiendas<br><em>Destacadas.</em></h2>
            <a href="directorio.php" class="sl-link">Ver directorio completo &rarr;</a>
        </div>
        <div class="swiper swiper-sl">
            <div class="swiper-wrapper">
                <!-- Las imagenes de tiendas se cargan desde el servidor -->
                <div class="swiper-slide ss"><img src="images/home/hero-new-4.jpg" alt="Boutique" loading="lazy"><div class="ss-ov"></div><div class="ss-info"><span class="ss-cat">Moda Internacional</span><div class="ss-name">Boutiques Premium</div></div></div>
                <div class="swiper-slide ss"><img src="images/home/pasillo.jpg" alt="Interior" loading="lazy"><div class="ss-ov"></div><div class="ss-info"><span class="ss-cat">Alta Moda</span><div class="ss-name">Disenadores Selectos</div></div></div>
                <div class="swiper-slide ss"><img src="images/home/patio-comidas.jpg" alt="Gastronomia" loading="lazy"><div class="ss-ov"></div><div class="ss-info"><span class="ss-cat">Gastronomia</span><div class="ss-name">Alta Cocina</div></div></div>
                <div class="swiper-slide ss"><img src="images/home/evento-41.jpg" alt="Joyeria" loading="lazy"><div class="ss-ov"></div><div class="ss-info"><span class="ss-cat">Joyeria & Accesorios</span><div class="ss-name">Lujo sin limites</div></div></div>
                <div class="swiper-slide ss"><img src="images/home/sanborns.jpg" alt="Tecnologia" loading="lazy"><div class="ss-ov"></div><div class="ss-info"><span class="ss-cat">Tecnologia</span><div class="ss-name">Innovacion</div></div></div>
            </div>
            <div class="swiper-pagination swiper-pagination-sl"></div>
        </div>
    </section>

    <!-- ROOF CTA -->
    <section class="roof">
        <div class="roof-bg" id="roofBg"></div>
        <div class="roof-ov"></div>
        <div class="roof-c rv">
            <div class="roof-tag">Vista exclusiva</div>
            <h2 class="roof-h2">Descubre<br>la experiencia<br>completa.</h2>
            <p class="roof-desc">Gastronomia, cultura y entretenimiento en el corazon de la Ciudad de Mexico.</p>
            <a href="eventosypromociones.php" class="btn-g" style="border-color:rgba(245,243,239,.35);color:var(--warm);">Ver Novedades</a>
        </div>
    </section>

    <!-- NOVEDADES (contenido dinamico del backend) -->
    <section class="nov">
        <div class="nov-top rv">
            <h2 class="nov-h2">Novedades<br><em>& Eventos.</em></h2>
            <a href="eventosypromociones.php" class="arr rv-d1">Ver todo &rarr;</a>
        </div>
        <div class="nov-grid rv rv-d2">
            <?php
                // Las publicaciones se generan desde el backend
                // $pubHTML = publicaciones($CentroComercial);
                // Si hay publicaciones en BD, se muestran; si no, se usan las imagenes placeholder
            ?>
            <a class="nc" href="eventosypromociones.php"><img src="images/home/evento-42.jpg" alt="Evento" loading="lazy"><div class="nc-ov"></div><div class="nc-info"><span class="nc-tag">Evento Especial</span><div class="nc-title">Proximos eventos del centro</div></div></a>
            <a class="nc" href="eventosypromociones.php"><img src="images/home/evento-43.jpg" alt="Aperturas" loading="lazy"><div class="nc-ov"></div><div class="nc-info"><span class="nc-tag">Nuevas Aperturas</span><div class="nc-title">Las ultimas llegadas al directorio</div></div></a>
            <a class="nc" href="eventosypromociones.php"><img src="images/home/pandora.jpg" alt="Promociones" loading="lazy"><div class="nc-ov"></div><div class="nc-info"><span class="nc-tag">Promocion</span><div class="nc-title">Ofertas exclusivas de temporada</div></div></a>
        </div>
    </section>

    <!-- NEWSLETTER -->
    <section class="nl">
        <span class="nl-tag rv">Insider</span>
        <h2 class="nl-h2 rv rv-d1">Mantente al dia.</h2>
        <p class="nl-sub rv rv-d2">Novedades, eventos y aperturas, siempre primero.</p>
        <form class="nl-form rv rv-d3" onsubmit="return false;">
            <input type="email" placeholder="Tu correo electronico" aria-label="Correo electronico">
            <button type="submit">Suscribirse</button>
        </form>
    </section>

    </main>

    <?php include("footer-new.php"); ?>
    <?php include("modales.php"); ?>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        /* LOADER */
        (function(){
            const lw=document.getElementById('lw'),lb=document.getElementById('lb'),loader=document.getElementById('loader');
            gsap.to(lw,{opacity:1,y:0,scale:1,duration:1.4,ease:'power4.out',delay:.2});
            gsap.to(lb,{width:'100%',duration:1.6,ease:'power2.inOut',delay:.5,onComplete:startHero});
            function startHero(){
                gsap.to(lw,{opacity:0,y:-20,duration:0.8,ease:'power3.in'});
                gsap.to(loader,{opacity:0,duration:0.8,delay:0.4,ease:'power2.inOut',onComplete:()=>{loader.classList.add('gone');}});
                setTimeout(runHeroAnim,600);
            }
        })();

        function runHeroAnim(){
            if(prefersReduced){document.querySelectorAll('.h-line-inner,.h-sub,.h-btns,.h-scroll,.nav-logo,.nav-links').forEach(el=>{el.style.opacity=1;el.style.transform='none';});return;}
            const tl=gsap.timeline({defaults:{ease:'power4.out'}});
            tl.to('.nav-logo,.nav-links',{opacity:1,duration:1,stagger:.1},.1)
              .to(['#hl1','#hl2','#hl3'],{y:'0%',opacity:1,duration:1.6,stagger:.2},.3)
              .set('.h-line',{overflow:'visible'},'>')
              .to('#hDiv',{width:'100%',maxWidth:'240px',duration:1.2,ease:'power2.inOut'},.8)
              .to('#hSub',{y:0,opacity:1,duration:1},1)
              .to('#hBtns',{y:0,opacity:1,duration:.8},1.2)
              .to('#hStrip',{y:0,opacity:1,duration:.8},1.3)
              .to('#hScroll',{opacity:1,duration:.8},1.4);
            if(!prefersReduced) gsap.to('#hImg',{scale:1,duration:10,ease:'power1.out',delay:.2});
        }

        /* CURSOR */
        const cur=document.getElementById('cur');
        if(cur&&window.matchMedia('(pointer:fine)').matches){
            let mx=window.innerWidth/2,my=window.innerHeight/2;
            document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;});
            (function loop(){gsap.set(cur,{x:mx,y:my});requestAnimationFrame(loop);})();
            document.querySelectorAll('a,button,.nc,.ss,.panel').forEach(el=>{el.addEventListener('mouseenter',()=>cur.classList.add('h'));el.addEventListener('mouseleave',()=>cur.classList.remove('h'));});
        }

        /* NAV SCROLL */
        window.addEventListener('scroll',()=>document.getElementById('nav').classList.toggle('s',window.scrollY>50),{passive:true});

        /* MOBILE MENU */
        function toggleMob(){var m=document.getElementById('mob-menu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':'';var b=document.querySelector('.nav-ham');if(b) b.setAttribute('aria-expanded',m.classList.contains('open'));}

        /* SCROLL REVEALS */
        const observer=new IntersectionObserver(entries=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');observer.unobserve(e.target);}});},{threshold:.12,rootMargin:'0px 0px -40px 0px'});
        document.querySelectorAll('.rv').forEach(el=>observer.observe(el));

        /* PARALLAX */
        if(!prefersReduced){
            gsap.to('#hImg',{yPercent:20,ease:'none',scrollTrigger:{trigger:'#hero',start:'top top',end:'bottom top',scrub:1}});
            gsap.to('#roofBg',{yPercent:16,ease:'none',scrollTrigger:{trigger:'.roof',start:'top bottom',end:'bottom top',scrub:1}});
        }

        /* COUNTER */
        document.querySelectorAll('[data-count]').forEach(el=>{const target=+el.dataset.count;ScrollTrigger.create({trigger:el,start:'top 85%',once:true,onEnter:()=>{gsap.fromTo({v:0},{v:target,duration:1.6,ease:'power2.out',onUpdate:function(){el.textContent='+'+Math.round(this.targets()[0].v);}});}});});

        /* SWIPER */
        new Swiper('.swiper-sl',{slidesPerView:1.2,spaceBetween:12,loop:false,pagination:{el:'.swiper-pagination-sl',clickable:true},breakpoints:{540:{slidesPerView:1.8,spaceBetween:16},768:{slidesPerView:2.4,spaceBetween:18},1024:{slidesPerView:3.2,spaceBetween:20},1400:{slidesPerView:4,spaceBetween:22}}});
    </script>
</body>
</html>
