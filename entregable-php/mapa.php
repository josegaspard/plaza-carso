<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("header.php"); ?>
    <style>
        :root{--ink:#080706;--warm:#F5F3EF;--smoke:#EDEBE6;--silver:#C0B9B0;--grey:#857E76;--mid:#3A3530;--serif:'Cormorant Garamond',serif;--sans:'Outfit',sans-serif;}
        html,body{height:100%;}
        body{font-family:var(--sans);background:var(--warm);color:var(--ink);-webkit-font-smoothing:antialiased;overflow:hidden;display:flex;flex-direction:column;}
        a{text-decoration:none;color:inherit;}img{display:block;max-width:100%;}

        /* NAV — relative for map layout */
        #nav{position:relative;width:100%;z-index:800;height:68px;padding:0 48px;display:flex;align-items:center;justify-content:space-between;background:var(--warm);border-bottom:1px solid var(--smoke);}
        .nav-logo{font-family:var(--serif);font-size:20px;font-weight:300;letter-spacing:.1em;color:var(--ink);}
        .nav-links{display:flex;align-items:center;gap:36px;}.nav-links a{font-family:var(--sans);font-size:10px;font-weight:400;letter-spacing:.2em;text-transform:uppercase;color:var(--mid);position:relative;padding-bottom:2px;transition:color .25s;}
        .nav-links a::after{content:'';position:absolute;bottom:0;left:0;width:0;height:1px;background:var(--ink);transition:width .3s;}.nav-links a:hover,.nav-links a.active{color:var(--ink);}.nav-links a:hover::after,.nav-links a.active::after{width:100%;}
        .nav-cta-link{border:1px solid var(--ink)!important;padding:10px 22px!important;}.nav-cta-link:hover{background:var(--ink)!important;color:var(--warm)!important;}.nav-cta-link::after{display:none!important;}
        .nav-ham{display:none;flex-direction:column;gap:5px;background:none;border:none;padding:4px;cursor:pointer;}.nav-ham span{display:block;width:22px;height:1px;background:var(--ink);}
        #mob-menu{position:fixed;inset:0;z-index:700;background:var(--ink);display:flex;flex-direction:column;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .4s;}#mob-menu.open{opacity:1;pointer-events:all;}
        #mob-menu a{font-family:var(--serif);font-style:italic;font-size:clamp(36px,8vw,68px);color:var(--warm);display:block;margin:8px 0;opacity:.75;text-align:center;}
        .mob-close{position:absolute;top:24px;right:32px;background:none;border:none;font-size:28px;color:var(--warm);cursor:pointer;}
        .skip-link{position:absolute;top:-100%;left:16px;z-index:9999;background:var(--ink);color:var(--warm);padding:12px 24px;font-size:13px;transition:top .2s;}.skip-link:focus{top:16px;}

        /* MAP LAYOUT */
        .map-wrapper{flex:1;display:flex;overflow:hidden;}
        .map-sidebar{width:280px;flex-shrink:0;background:var(--warm);border-right:1px solid var(--smoke);display:flex;flex-direction:column;overflow:hidden;}
        .sidebar-head{padding:32px 28px;background:var(--ink);color:var(--warm);}
        .sidebar-head h2{font-family:var(--serif);font-size:38px;font-style:italic;color:var(--warm);line-height:1;}
        .sidebar-head p{font-family:var(--sans);font-size:11px;font-weight:300;color:rgba(255,255,255,0.6);margin-top:8px;letter-spacing:.05em;}

        /* FLOOR TABS */
        .floor-tabs{display:flex;background:var(--mid);border-bottom:none;}
        .floor-tab{flex:1;font-family:var(--sans);font-size:8px;font-weight:400;letter-spacing:.25em;text-transform:uppercase;color:rgba(255,255,255,0.5);background:transparent;border:none;cursor:pointer;padding:16px 8px;transition:color .3s,background .3s;}
        .floor-tab:hover{color:var(--warm);}.floor-tab.active{color:var(--warm);background:rgba(255,255,255,0.05);}

        /* SIDEBAR FILTERS */
        .sidebar-filters{padding:16px;border-bottom:1px solid var(--smoke);}
        .sidebar-filters select{width:100%;font-family:var(--sans);font-size:10px;font-weight:500;letter-spacing:.15em;text-transform:uppercase;color:var(--mid);background:var(--smoke);border:none;padding:14px 20px;outline:none;cursor:pointer;appearance:none;}

        /* STORE LIST — generado por backend listadoLocatarios.php */
        .store-list{flex:1;overflow-y:auto;padding:8px 0;-webkit-overflow-scrolling:touch;}
        .store-list::-webkit-scrollbar{width:3px;}.store-list::-webkit-scrollbar-track{background:var(--smoke);}.store-list::-webkit-scrollbar-thumb{background:var(--silver);}

        /*
         * BACKEND COMPAT: locatariosMapa() genera items con class="local"
         * Los links tienen IDs como "Dlocal1PlantaBaja"
         */
        .store-list .local,.store-list-item{display:flex;align-items:center;gap:16px;padding:16px 24px;cursor:pointer;border-bottom:1px solid var(--smoke);background:var(--warm);transition:background .25s,padding-left .25s;text-decoration:none;position:relative;}
        .store-list .local::before,.store-list-item::before{content:'';position:absolute;left:0;top:0;bottom:0;width:0;background:var(--ink);transition:width .25s;}
        .store-list .local:hover,.store-list-item:hover,.store-list .local.highlighted{background:rgba(8,7,6,0.03);padding-left:30px;}
        .store-list .local:hover::before,.store-list-item.highlighted::before{width:4px;}

        /* MAP CANVAS */
        .map-canvas{flex:1;position:relative;background:var(--smoke);overflow:hidden;}
        .map-inner{width:100%;height:100%;position:relative;}

        /* SVG container: el backend inyecta el SVG del mapa aqui */
        #mapa,.tab-content{width:100%;height:100%;}
        .tab-content .tab-pane{height:100%;}
        #mapa svg{width:100%;height:100%;max-height:100%;}

        /* Map info panel */
        .map-info-panel{position:absolute;top:20px;right:20px;width:240px;background:var(--warm);border:1px solid var(--smoke);padding:20px;box-shadow:0 4px 24px rgba(0,0,0,.08);opacity:0;pointer-events:none;transform:translateX(20px);transition:opacity .3s,transform .3s;z-index:10;}
        .map-info-panel.visible{opacity:1;pointer-events:all;transform:translateX(0);}

        @media(max-width:768px){
            *,*::before,*::after{cursor:auto!important;}a,button,select{cursor:pointer!important;}
            #nav{padding:0 20px;height:60px;}.nav-links{display:none;}.nav-ham{display:flex;min-width:44px;min-height:44px;align-items:center;justify-content:center;}
            .map-wrapper{flex-direction:column;}body{overflow:auto;}
            .map-sidebar{width:100%;max-height:none;height:auto;border-right:none;border-bottom:1px solid var(--smoke);flex-shrink:0;}
            .sidebar-head{padding:20px 20px;}.sidebar-head h2{font-size:28px;}
            .floor-tab{padding:14px 12px;min-height:44px;font-size:9px;}
            .sidebar-filters select{font-size:16px;padding:12px 16px;min-height:44px;}
            .store-list{max-height:200px;}
            .map-canvas{min-height:50vh;flex:1;}
            .map-info-panel{top:auto;bottom:0;right:0;left:0;width:100%;transform:translateY(100%);border:none;border-top:1px solid var(--smoke);}.map-info-panel.visible{transform:translateY(0);}
            .mob-close{min-width:44px;min-height:44px;}#mob-menu a{padding:8px 0;min-height:48px;display:flex;align-items:center;justify-content:center;}
        }
        :focus-visible{outline:2px solid var(--ink);outline-offset:3px;}
    </style>
</head>
<body>

    <?php include("nav.php"); ?>

    <main id="main-content">
    <div class="map-wrapper">

        <!-- SIDEBAR -->
        <aside class="map-sidebar">
            <div class="sidebar-head">
                <h2>Mapa</h2>
                <p>Ubica tu tienda favorita</p>
            </div>

            <!-- PISOS: tabs Bootstrap 3 (compatibles con backend) -->
            <div class="floor-tabs">
                <ul class="nav nav-tabs" style="display:flex;border:none;margin:0;">
                    <li class="active" style="flex:1;"><a href="#tab_1" data-toggle="tab" class="floor-tab active" style="display:block;width:100%;text-align:center;">Planta Baja</a></li>
                    <li style="flex:1;"><a href="#tab_2" data-toggle="tab" class="floor-tab" style="display:block;width:100%;text-align:center;">Planta Alta</a></li>
                </ul>
            </div>

            <!-- FILTRO: giroComercial() del backend -->
            <div class="sidebar-filters">
                <?php echo giroComercial($CentroComercial); ?>
            </div>

            <!-- LISTA DE LOCATARIOS: generada por el backend -->
            <div class="store-list" id="PlantaBaja">
                <?php
                    // El backend inyecta la lista de locatarios por piso
                    // Esto se actualiza via AJAX cuando cambia el piso o el filtro
                ?>
            </div>
        </aside>

        <!-- MAPA: El SVG se inyecta aqui -->
        <div class="map-canvas">
            <div class="map-inner">
                <div class="tab-content" id="tabContent">
                    <div class="tab-pane active in" id="tab_1">
                        <div id="mapa" style="margin:0 auto;">
                            <!--
                                BACKEND: Aqui se inyecta el SVG del mapa de Plaza Universidad.
                                El archivo mapa.php original contiene ~106KB de SVG inline
                                con poligonos que tienen IDs como "local1PlantaBaja".
                                INCARSO debera generar el SVG para Plaza Universidad
                                y colocarlo aqui, o cargarlo via PHP include.
                            -->
                            <div style="display:flex;align-items:center;justify-content:center;height:100%;min-height:400px;">
                                <div style="text-align:center;padding:40px;">
                                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--silver)" stroke-width="1" style="margin:0 auto 24px;display:block;opacity:.4;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <h3 style="font-family:var(--serif);font-size:38px;font-style:italic;color:var(--ink);margin-bottom:12px;">Mapa Interactivo</h3>
                                    <p style="font-family:var(--sans);font-size:13px;color:var(--grey);line-height:1.7;">El SVG del mapa de <?php echo $nombrePlaza; ?> se integra aqui.<br>Se conecta con el backend para mostrar locatarios interactivos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab_2">
                        <div id="mapaPlantaAlta" style="margin:0 auto;">
                            <div style="display:flex;align-items:center;justify-content:center;height:100%;min-height:400px;">
                                <div style="text-align:center;padding:40px;">
                                    <h3 style="font-family:var(--serif);font-size:38px;font-style:italic;color:var(--ink);margin-bottom:12px;">Planta Alta</h3>
                                    <p style="font-family:var(--sans);font-size:13px;color:var(--grey);">SVG de Planta Alta se integra aqui.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </main>

    <?php include("modales.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script>
        function toggleMob(){var m=document.getElementById('mob-menu');m.classList.toggle('open');document.body.style.overflow=m.classList.contains('open')?'hidden':'';var b=document.querySelector('.nav-ham');if(b) b.setAttribute('aria-expanded',m.classList.contains('open'));}

        /* BACKEND: Handlers para interaccion con locatarios del mapa */
        $(document).ready(function(){

            /* Click en locatario de la lista → abre modal */
            $(document).on('click','.local',function(e){
                var _href=this.href;
                var _url=_href;
                e.preventDefault();
                $('#miModalContenidoLocatario').load(_url,function(){
                    $('#miModalLocatario').modal('show');
                });
                return false;
            });

            /* Hover sobre locatario lista → resalta SVG */
            $(document).on('mouseenter','.local',function(){
                var id=$(this).attr('id');
                if(id){
                    var idMapa=id.replace('D','');
                    var color=$('#'+idMapa).css('fill');
                    $('#'+idMapa).css('fill-opacity','.5');
                    $('#'+id).css({'background':color,'font-weight':'bold','color':'white'});
                }
            });
            $(document).on('mouseleave','.local',function(){
                var id=$(this).attr('id');
                if(id){
                    var idMapa=id.replace('D','');
                    $('#'+idMapa).css('fill-opacity','1');
                    $('#'+id).css({'background':'none','font-weight':'normal','color':'black'});
                }
            });

            /* Click en poligono SVG → abre modal de locatario */
            $(document).on('click','.localP',function(){
                var id=$(this).attr('id');
                id=id.replace('PlantaBaja','').replace('PlantaAlta','');
                var centroComercial=<?php echo $CentroComercial; ?>;
                $('#miModalContenidoLocatario').load('locatarioModal.php?CentroComercial='+centroComercial+'&idCatLocatario='+id+'&origen=mapa',function(){
                    $('#miModalLocatario').modal('show');
                });
                return false;
            });

            /* Hover sobre poligono SVG → resalta en lista */
            $(document).on('mouseenter','.localP',function(){
                var id=$(this).attr('id');
                var color=$('#local'+id).css('fill');
                $('#local'+id).css('fill-opacity','.5');
                $('#Dlocal'+id).css({'background':color,'font-weight':'bold','color':'white'});
            });
            $(document).on('mouseleave','.localP',function(){
                var id=$(this).attr('id');
                $('#local'+id).css('fill-opacity','1');
                $('#Dlocal'+id).css({'background':'none','font-weight':'normal','color':'black'});
            });

            /* Filtro por giro comercial → actualiza lista via AJAX */
            $(document).on('change','.giroComercial',function(){
                var giroComercial=$(this).val();
                var centroComercial=<?php echo $CentroComercial; ?>;
                $.ajax({
                    url:'listadoLocatarios.php',
                    type:'POST',
                    data:{centroComercial:centroComercial,giroComercial:giroComercial,piso:'Planta Baja'},
                    cache:false,
                    success:function(data){$('#PlantaBaja').html(data);}
                });
                $.ajax({
                    url:'listadoLocatarios.php',
                    type:'POST',
                    data:{centroComercial:centroComercial,giroComercial:giroComercial,piso:'Planta Alta'},
                    cache:false,
                    success:function(data){$('#PlantaAlta').html(data);}
                });
            });

            /* Al cambiar tab de piso → cargar locatarios via AJAX */
            $('a[data-toggle="tab"]').on('shown.bs.tab',function(e){
                var piso = $(e.target).text().trim(); // "Planta Baja" o "Planta Alta"
                var targetDiv = piso === 'Planta Baja' ? '#PlantaBaja' : '#PlantaAlta';
                var centroComercial = <?php echo $CentroComercial; ?>;
                var giroComercial = $('.giroComercial').val() || '';
                $.ajax({
                    url:'listadoLocatarios.php',
                    type:'POST',
                    data:{centroComercial:centroComercial,giroComercial:giroComercial,piso:piso},
                    cache:false,
                    success:function(data){$(targetDiv).html(data);}
                });
            });

            /* Cargar Planta Baja al inicio */
            $.ajax({
                url:'listadoLocatarios.php',
                type:'POST',
                data:{centroComercial:<?php echo $CentroComercial; ?>,giroComercial:'',piso:'Planta Baja'},
                cache:false,
                success:function(data){$('#PlantaBaja').html(data);}
            });

            /* Cerrar modal */
            $(document).on('click','#cerrar',function(){$(this).closest('.modal').modal('hide');});
        });

        /* Cursor */
        (function(){var cur=document.getElementById('cursor');if(cur&&window.matchMedia('(pointer:fine)').matches){document.addEventListener('mousemove',function(e){gsap.to(cur,{x:e.clientX,y:e.clientY,duration:.25,ease:'power2.out'});});}})();
    </script>
</body>
</html>
