import os
import re
import shutil
import glob

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'
drive_dir = '/Users/josegaspard/Desktop/CARSO FOTOS FINALES/drive-download-20260312T001156Z-1-001'

drive_images = glob.glob(os.path.join(drive_dir, '*.jpg'))
drive_images.sort()

# Empiezo desde la 40 para no repetir las 16 del Home/Directorio ya asignadas
img_idx = 40

def get_next_img():
    global img_idx
    img_idx += 1
    return drive_images[img_idx % len(drive_images)]

# 1. Update eventosypromociones.html
events_html = os.path.join(repo_dir, 'eventosypromociones.html')
with open(events_html, 'r', encoding='utf-8') as f:
    events_content = f.read()

# Hero
hero_img = get_next_img()
shutil.copy(hero_img, os.path.join(repo_dir, 'images/home/hero-eventos.jpg'))
events_content = events_content.replace("images/home/eventos-bg.jpg", "images/home/hero-eventos.jpg", 1)

# Event Cards
# Busco todos los src en the block for event cards that are the old placeholders
old_placeholders = ["images/home/eventos-bg.jpg", "images/home/hero.jpg", "images/home/directorio-bg.jpg"]

# The HTML blocks have onclick="openPub(..., 'images/...', event)" and <img src="images/...">
matches = re.finditer(r"(onclick=\"openPub\([^)]+?,\s*')([^']+?)('\)|',event\))", events_content)
for m in matches:
    old_full_path = m.group(2)
    if any(p in old_full_path for p in old_placeholders):
        new_name = f"images/home/evento-{img_idx}.jpg"
        fresh_img = get_next_img()
        shutil.copy(fresh_img, os.path.join(repo_dir, new_name))
        
        # Replace occurrences in the entire file sequentially to avoid breaking regex
        events_content = events_content.replace(old_full_path, new_name, 2)

with open(events_html, 'w', encoding='utf-8') as f:
    f.write(events_content)

# 2. Update contacto.html
contacto_html = os.path.join(repo_dir, 'contacto.html')
with open(contacto_html, 'r', encoding='utf-8') as f:
    contacto_content = f.read()

fresh_img = get_next_img()
shutil.copy(fresh_img, os.path.join(repo_dir, 'images/home/hero-contacto.jpg'))
contacto_content = contacto_content.replace("images/home/directorio-bg.jpg", "images/home/hero-contacto.jpg")

with open(contacto_html, 'w', encoding='utf-8') as f:
    f.write(contacto_content)

# 3. Update mapa.html
mapa_html = os.path.join(repo_dir, 'mapa.html')
with open(mapa_html, 'r', encoding='utf-8') as f:
    mapa_content = f.read()

fresh_img = get_next_img()
shutil.copy(fresh_img, os.path.join(repo_dir, 'images/home/hero-mapa.jpg'))
for old in old_placeholders:
    mapa_content = mapa_content.replace(old, "images/home/hero-mapa.jpg")

with open(mapa_html, 'w', encoding='utf-8') as f:
    f.write(mapa_content)

print("Internals updated successfully with distinct fresh images!")
