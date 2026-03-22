import os
import re

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'

# 1. Unificar Footer
index_html_path = os.path.join(repo_dir, "index.html")
with open(index_html_path, 'r', encoding='utf-8') as f:
    index_content = f.read()

footer_match = re.search(r'<footer>.*?</footer>', index_content, flags=re.DOTALL)
if footer_match:
    good_footer = footer_match.group(0)

# JS Pointer Fix in the footer
js_fix = """
        document.querySelectorAll('footer').forEach(f => {
            f.addEventListener('mouseenter', () => { if(cur) { cur.style.borderColor = '#fff'; document.getElementById('cursor-dot').style.background = '#fff'; } });
            f.addEventListener('mouseleave', () => { if(cur) { cur.style.borderColor = ''; document.getElementById('cursor-dot').style.background = ''; } });
        });
"""

# Nav CTA Fix
css_fix = """.nav-cta {
            display: inline-flex; align-items: center; justify-content: center;
            line-height: 1; padding: 12px 24px 10px;"""

def apply_global_fixes(content):
    if footer_match:
        content = re.sub(r'<footer>.*?</footer>', good_footer, content, flags=re.DOTALL)
    if 'document.addEventListener(' in content and 'footer' not in content:
        content = content.replace("window.addEventListener('scroll'", js_fix + "\n        window.addEventListener('scroll'")
    content = content.replace('.nav-cta {', css_fix)
    # Also fixes .btn-wh from espacios section in case of centering issues
    content = content.replace('.btn-wh {', '.btn-wh { display:inline-flex; align-items:center; justify-content:center; line-height:1; padding:15px 30px 13px;')
    return content

html_files = sorted([f for f in os.listdir(repo_dir) if f.endswith('.html')])
for file in html_files:
    path = os.path.join(repo_dir, file)
    with open(path, 'r', encoding='utf-8') as f:
        c = f.read()
    
    c = apply_global_fixes(c)
    
    if file == 'index.html':
        # "Usa una imagen de lujo de una tienda de lujo de las que hay"
        c = c.replace('images/home/hero-new-1.jpg', 'images/stores/armani-exchange.jpg')
    
    with open(path, 'w', encoding='utf-8') as f:
        f.write(c)

# 3. Add 20-30 stores to mapa.html
mapa_path = os.path.join(repo_dir, 'mapa.html')
with open(mapa_path, 'r', encoding='utf-8') as f:
    map_c = f.read()

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
# Find inject point: `</div></aside>`
map_c = map_c.replace('</div>\n        </aside>', extra_html + '            </div>\n        </aside>')
map_c = map_c.replace('<!-- Map canvas -->', extra_html + '\n        <!-- Map canvas -->') # fallback if first replace fails

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
# Make sure we don't accidentally replace incorrectly
if "'8': {top: '50%', left: '50%'}" in map_c:
    map_c = map_c.replace("'8': {top: '50%', left: '50%'}  // RG Restaurantes", "'8': {top: '50%', left: '50%'}," + extra_js_pins)
elif "'8': {top: '50%', left: '50%'}," in map_c:
    pass # already fixed if run twice

with open(mapa_path, 'w', encoding='utf-8') as f:
    f.write(map_c)

print("Global unifications and extensions correctly applied.")
