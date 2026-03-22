import os
import re

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'
mapa_path = os.path.join(repo_dir, "mapa.html")
index_path = os.path.join(repo_dir, "index.html")

with open(mapa_path, 'r', encoding='utf-8') as f:
    map_c = f.read()
with open(index_path, 'r', encoding='utf-8') as f:
    index_c = f.read()

# 1. Unificar Footer
footer_match = re.search(r'<footer>.*?</footer>', index_c, flags=re.DOTALL)
if footer_match:
    good_footer = footer_match.group(0)
    map_c = re.sub(r'<footer>.*?</footer>', good_footer, map_c, flags=re.DOTALL)

# 2. JS Pointer Fix
js_fix = """
        document.querySelectorAll('footer').forEach(f => {
            f.addEventListener('mouseenter', () => { if(cur) { cur.style.borderColor = '#fff'; document.getElementById('cursor-dot').style.background = '#fff'; } });
            f.addEventListener('mouseleave', () => { if(cur) { cur.style.borderColor = ''; document.getElementById('cursor-dot').style.background = ''; } });
        });
"""
if 'document.addEventListener(' in map_c and "f.addEventListener('mouseenter'" not in map_c:
    map_c = map_c.replace("window.addEventListener('scroll'", js_fix + "\n        window.addEventListener('scroll'")

# 3. Inject new stores inside the store-list div
extra_html = """
                <a class="store-list-item abrirModalLocatario" data-floor="PB" id="Dlocal9PlantaBaja" onclick="highlightStore('9','Hugo Boss','Moda','Planta Baja',this)"><span class="store-list-num">9</span><div class="store-list-info"><div class="store-list-name">Hugo Boss</div><div class="store-list-cat">Moda</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PB" id="Dlocal10PlantaBaja" onclick="highlightStore('10','Sephora','Salud & Bienestar','Planta Baja',this)"><span class="store-list-num">10</span><div class="store-list-info"><div class="store-list-name">Sephora</div><div class="store-list-cat">Salud & Bienestar</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PB" id="Dlocal11PlantaBaja" onclick="highlightStore('11','MacStore','Tecnología','Planta Baja',this)"><span class="store-list-num">11</span><div class="store-list-info"><div class="store-list-name">MacStore</div><div class="store-list-cat">Tecnología</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PB" id="Dlocal12PlantaBaja" onclick="highlightStore('12','Starbucks','Gastronomía','Planta Baja',this)"><span class="store-list-num">12</span><div class="store-list-info"><div class="store-list-name">Starbucks</div><div class="store-list-cat">Gastronomía</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PA" id="Dlocal13PlantaAlta" onclick="highlightStore('13','Adolfo Dominguez','Moda','Planta Alta',this)" style="display:none;"><span class="store-list-num">13</span><div class="store-list-info"><div class="store-list-name">Adolfo Dominguez</div><div class="store-list-cat">Moda</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PA" id="Dlocal14PlantaAlta" onclick="highlightStore('14','Guess','Moda','Planta Alta',this)" style="display:none;"><span class="store-list-num">14</span><div class="store-list-info"><div class="store-list-name">Guess</div><div class="store-list-cat">Moda</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PA" id="Dlocal15PlantaAlta" onclick="highlightStore('15','Samsung','Tecnología','Planta Alta',this)" style="display:none;"><span class="store-list-num">15</span><div class="store-list-info"><div class="store-list-name">Samsung</div><div class="store-list-cat">Tecnología</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PA" id="Dlocal16PlantaAlta" onclick="highlightStore('16','Bose','Tecnología','Planta Alta',this)" style="display:none;"><span class="store-list-num">16</span><div class="store-list-info"><div class="store-list-name">Bose</div><div class="store-list-cat">Tecnología</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="PA" id="Dlocal17PlantaAlta" onclick="highlightStore('17','Sunglass Hut','Moda','Planta Alta',this)" style="display:none;"><span class="store-list-num">17</span><div class="store-list-info"><div class="store-list-name">Sunglass Hut</div><div class="store-list-cat">Moda</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="RG" id="Dlocal18RoofGarden" onclick="highlightStore('18','Carajillo','Gastronomía','Roof Garden',this)" style="display:none;"><span class="store-list-num">18</span><div class="store-list-info"><div class="store-list-name">Carajillo</div><div class="store-list-cat">Gastronomía</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="RG" id="Dlocal19RoofGarden" onclick="highlightStore('19','Cuerno','Gastronomía','Roof Garden',this)" style="display:none;"><span class="store-list-num">19</span><div class="store-list-info"><div class="store-list-name">Cuerno</div><div class="store-list-cat">Gastronomía</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="RG" id="Dlocal20RoofGarden" onclick="highlightStore('20','Salvajada','Gastronomía','Roof Garden',this)" style="display:none;"><span class="store-list-num">20</span><div class="store-list-info"><div class="store-list-name">Salvajada</div><div class="store-list-cat">Gastronomía</div></div></a>
                <a class="store-list-item abrirModalLocatario" data-floor="RG" id="Dlocal21RoofGarden" onclick="highlightStore('21','Loma Linda','Gastronomía','Roof Garden',this)" style="display:none;"><span class="store-list-num">21</span><div class="store-list-info"><div class="store-list-name">Loma Linda</div><div class="store-list-cat">Gastronomía</div></div></a>
"""

target_closure = "            </div>\n        </aside>"
map_c = map_c.replace(target_closure, extra_html + "\n" + target_closure)

extra_js_pins = """
            '9': {top: '55%', left: '30%'},
            '10': {top: '65%', left: '40%'},
            '11': {top: '35%', left: '60%'},
            '12': {top: '75%', left: '25%'},
            '13': {top: '40%', left: '45%'},
            '14': {top: '60%', left: '60%'},
            '15': {top: '30%', left: '70%'},
            '16': {top: '45%', left: '20%'},
            '17': {top: '70%', left: '50%'},
            '18': {top: '40%', left: '40%'},
            '19': {top: '60%', left: '60%'},
            '20': {top: '35%', left: '30%'},
            '21': {top: '30%', left: '55%'}
"""

if "'8': {top: '50%', left: '50%'}" in map_c:
    map_c = map_c.replace("'8': {top: '50%', left: '50%'}  // RG Restaurantes", "'8': {top: '50%', left: '50%'}," + extra_js_pins)
elif "'8': {top: '50%', left: '50%'}," not in map_c:
    map_c = map_c.replace("'8': {top: '50%', left: '50%'}", "'8': {top: '50%', left: '50%'}," + extra_js_pins)

with open(mapa_path, 'w', encoding='utf-8') as f:
    f.write(map_c)

print("Mapa.html fixed elegantly without DOM duplication!")
