import os
import re
import shutil

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'
mapa_html = os.path.join(repo_dir, 'mapa.html')

with open(mapa_html, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the static boring placeholder SVG with our interactive floor map layout
map_dom = """
            <div id="map-svg-container" style="position:relative; width:100%; height:100%; overflow:auto; background:#f4f4f4;">
                <img id="map-plan-img" src="images/map/mapa_pb.jpg" style="min-width:1000px; width:100%; height:auto; transition: opacity 0.4s ease; display:block; filter:grayscale(20%) saturate(120%); mix-blend-mode: multiply;">
                
                <!-- Pines dinámicos -->
                <div id="map-pins-layer" style="position:absolute; top:0; left:0; width:100%; height:100%;">
                    <!-- Se inyectarán via JS -->
                </div>
                
                <div style="position:absolute; bottom:30px; left:30px; background:rgba(0,0,0,0.8); color:#fff; padding:10px 20px; font-size:12px; border-radius:4px; font-family:var(--sans); letter-spacing:1px; z-index:15;">
                    <i class="fa fa-search-plus" style="margin-right:8px;"></i> Desliza o usa el cursor para ver los planos a detalle
                </div>
            </div>
"""

content = re.sub(r'<div id="map-svg-container">.*?</div>\s*</div>\s*<!-- Store info panel', 
                 map_dom + '\n\n            <!-- Store info panel', 
                 content, flags=re.DOTALL)

# Add the JS interactivity to actually move maps and render cool pins
js_injection = """
        // Floor logic extension
        const floorMapImgs = {
            'PB': 'images/map/mapa_pb.jpg',
            'PA': 'images/map/mapa_pa.jpg',
            'RG': 'images/map/mapa_rg.jpg'
        };
        const storePins = {
            '1': {top: '40%', left: '35%'}, // Armani
            '2': {top: '60%', left: '70%'}, // Sanborns
            '3': {top: '30%', left: '45%'}, // Swarovski
            '4': {top: '50%', left: '20%'}, // Liverpool
            '5': {top: '45%', left: '40%'}, // Tommy
            '6': {top: '25%', left: '80%'}, // Cinepolis
            '7': {top: '55%', left: '50%'}, // Calvin
            '8': {top: '50%', left: '50%'}  // RG Restaurantes
        };

        const originalSwitch = switchFloor;
        switchFloor = function(floor, btn) {
            originalSwitch(floor, btn);
            const img = document.getElementById('map-plan-img');
            img.style.opacity = 0;
            setTimeout(() => {
                img.src = floorMapImgs[floor];
                img.onload = () => { img.style.opacity = 1; };
                document.getElementById('map-pins-layer').innerHTML = ''; // reset pins
            }, 300);
        };

        const originalHighlight = highlightStore;
        highlightStore = function(num, name, cat, floor, el) {
            originalHighlight(num, name, cat, floor, el);
            const layer = document.getElementById('map-pins-layer');
            const coords = storePins[num] || {top:'50%', left:'50%'};
            layer.innerHTML = `
                <div class="map-pin active" style="position:absolute; top:${coords.top}; left:${coords.left}; transform:translate(-50%, -100%); text-align:center; z-index:10; animation: bounceIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;">
                    <div style="background:var(--ink); color:#fff; padding:6px 12px; font-size:10px; font-family:var(--sans); font-weight:600; white-space:nowrap; border-radius:4px; box-shadow:0 10px 25px rgba(0,0,0,0.3); margin-bottom:8px;">${name}</div>
                    <div style="width:16px; height:16px; background:var(--ink); border:3px solid #fff; border-radius:50%; margin:0 auto; box-shadow:0 4px 10px rgba(0,0,0,0.2);"></div>
                </div>
                <style>@keyframes bounceIn { from {opacity:0; transform:translate(-50%, -50%) scale(0.5);} to {opacity:1; transform:translate(-50%, -100%) scale(1);} }</style>
            `;
        };
"""
content = re.sub(r'let currentFloor = \'PB\';', js_injection + '\n        let currentFloor = \'PB\';', content)

with open(mapa_html, 'w', encoding='utf-8') as f:
    f.write(content)

# 3. Mejora elegante de la imagen de PORTADA para CONTACTO HTML
# We can use the hero-new-2.jpg or a stunning mall interior image we renamed to hero-new-1.jpg or even the original hero.
# I will copy hero.jpg (the museum one) or an interior to hero-contacto to make it extremely elegant.
elegant_source = os.path.join(repo_dir, "images/home/julio.jpg") 
if not os.path.exists(elegant_source):
    elegant_source = os.path.join(repo_dir, "images/home/sanborns.jpg") # nice aesthetic
    
shutil.copy(elegant_source, os.path.join(repo_dir, "images/home/hero-contacto.jpg"))
print("Mapa interactivo 100% construido y contacto elegante mejorado.")
