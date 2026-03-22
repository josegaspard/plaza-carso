import os
repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'

html_files = ["directorio.html", "mapa.html", "eventosypromociones.html", "contacto.html"]

# Leer el FOOTER DE ORO desde index.html
with open(os.path.join(repo_dir, "index.html"), "r", encoding="utf-8") as f:
    index_c = f.read()

start = index_c.find("<footer>")
end = index_c.find("</footer>") + 9

if start == -1 or end == 8:
    print("CRITICAL ERROR: No footer found in index.html")
    exit(1)

golden_footer = index_c[start:end]

for h_file in html_files:
    file_path = os.path.join(repo_dir, h_file)
    with open(file_path, "r", encoding="utf-8") as f:
        c = f.read()
    
    fs = c.find("<footer>")
    fe = c.find("</footer>") + 9
    
    if fs != -1 and fe != 8:
        # Extraer y reemplazar exactamente el código del footer
        c = c[:fs] + golden_footer + c[fe:]
        print(f"✅ Footer master copy injected perfectly into {h_file}")
    else:
        print(f"⚠️ Warning: No <footer> found in {h_file}, injection skipped.")
        
    with open(file_path, "w", encoding="utf-8") as f:
        f.write(c)

# 2. Corregir CSS de .nav-cta para forzar centrado perfecto y balancear el baseline 
css_path = os.path.join(repo_dir, "css", "carso.css")
with open(css_path, "r", encoding="utf-8") as f:
    carso_c = f.read()

# Buscamos el bloque de .nav-cta en CSS (si está) o en los tags <style> index.html
css_fix = """.nav-cta {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    height: 38px !important;
    padding: 2px 24px 0px 24px !important; /* Desplaza el texto sutilmente para balancear las tipografías */
"""

# Ya lo habíamos inyectado directo al HTML en el script anterior en todos los archivos. 
# Repasamos todos los HTML para reemplazar el fix viejo por el fix nuevo de alto y padding duro.
for target_file in ["index.html"] + html_files:
    fp = os.path.join(repo_dir, target_file)
    with open(fp, "r", encoding="utf-8") as f:
        hc = f.read()
    
    # Old fix replacement safely
    if ".nav-cta {" in hc:
        old_idx = hc.find(".nav-cta {")
        end_brace = hc.find("}", old_idx)
        hc = hc[:old_idx] + css_fix + hc[end_brace:]
    
    with open(fp, "w", encoding="utf-8") as f:
        f.write(hc)

print("Master Unification Complete!")
