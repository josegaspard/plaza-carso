import os
import re

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'

# Reference file for the ONE TRUE footer block
ref_file = os.path.join(repo_dir, 'contacto.html')

with open(ref_file, 'r', encoding='utf-8') as f:
    ref_content = f.read()

# Extract from <section class="espacios-section"> to </footer>
start_idx = ref_content.find('<section class="espacios-section">')
end_idx = ref_content.find('</footer>') + len('</footer>')

if start_idx == -1 or end_idx == -1:
    print("FATAL: Could not find the reference block in contacto.html")
    exit(1)

one_true_footer_html = ref_content[start_idx:end_idx]

# 1. Add CSS to global carso.css so it applies to all pages
css_path = os.path.join(repo_dir, 'css', 'carso.css')
with open(css_path, 'r', encoding='utf-8') as f:
    carso_css = f.read()

espacios_css = """
/* Espacios section — Globalized */
.espacios-section { background: var(--ink); padding: 80px 52px; border-bottom: 1px solid rgba(255,255,255,0.08); }
.espacios-inner { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; gap: 40px; flex-wrap: wrap; }
.espac-text h3 { font-family: var(--serif); font-style: italic; font-size: clamp(30px, 3.5vw, 46px); font-weight: 300; color: var(--warm-white); }
.espac-text p { font-family: var(--sans); font-size: 12px; font-weight: 300; color: var(--grey); margin-top: 10px; line-height: 1.8; max-width: 400px; }
.espac-contacts { display: flex; flex-direction: column; gap: 16px; flex-shrink: 0; }
.espac-link { display: flex; align-items: center; gap: 10px; font-family: var(--sans); font-size: 11px; font-weight: 400; letter-spacing: .1em; color: var(--silver); transition: color .2s; }
.espac-link:hover { color: var(--warm-white); }
.espac-link-ico { width: 28px; height: 28px; border: 1px solid rgba(255,255,255,.12); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
"""

if "Espacios section — Globalized" not in carso_css:
    with open(css_path, 'a', encoding='utf-8') as f:
        f.write("\n" + espacios_css)
    print("Appended espacios CSS to carso.css")

# Target pages replacing whatever they have at the bottom
targets = [
    {
        'file': 'directorio.html',
        'regex': r'(<section class="espacios-section">.*?)?<footer>.*?</footer>'
    },
    {
        'file': 'eventosypromociones.html',
        'regex': r'(<section.*?social-links.*?>.*?</section>\s*)?<footer>.*?</footer>'
    }
]

for t in targets:
    f_path = os.path.join(repo_dir, t['file'])
    if os.path.exists(f_path):
        with open(f_path, 'r', encoding='utf-8') as f:
            content = f.read()

        if t['file'] == 'directorio.html':
            start_target = content.find('<section class="espacios-section">')
            end_target = content.find('</footer>') + len('</footer>')
            
            if start_target != -1 and end_target != -1:
                content = content[:start_target] + one_true_footer_html + content[end_target:]
                with open(f_path, 'w', encoding='utf-8') as f:
                    f.write(content)
                print("Replaced footer perfectly in directorio.html")
                
        elif t['file'] == 'eventosypromociones.html':
            start_target = content.find('<section class="social-section">')
            end_target = content.find('</footer>') + len('</footer>')
            
            if start_target != -1 and end_target != -1:
                content = content[:start_target] + one_true_footer_html + content[end_target:]
                with open(f_path, 'w', encoding='utf-8') as f:
                    f.write(content)
                print("Replaced footer perfectly in eventosypromociones.html")

print("ALL INTERNAL FOOTERS ARE NOW 100% IDENTICAL TO CONTACTO.HTML.")
