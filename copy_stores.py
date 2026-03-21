import os
import shutil
import glob

source_dir = '/Users/josegaspard/Desktop/CARSO FOTOS FINALES/drive-download-20260312T001156Z-1-001'
dest_repo = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'

stores_dir = os.path.join(dest_repo, 'images', 'stores')
home_dir = os.path.join(dest_repo, 'images', 'home')

os.makedirs(stores_dir, exist_ok=True)
os.makedirs(home_dir, exist_ok=True)

all_files = sorted(glob.glob(os.path.join(source_dir, '*.jpg')))

if len(all_files) < 25:
    print("Files missing!")
    exit(1)

# Grab the first 20 for stores and home
stores = ["armani-exchange", "tommy-hilfiger", "swarovski", "telcel", "roof-garden", "cinepolis", "calvin-klein", "sanborns", "gnc", "liverpool", "zara", "food-court"]

for i, store in enumerate(stores):
    src = all_files[i+5] # offset to get fresh ones
    dst = os.path.join(stores_dir, f"{store}.jpg")
    shutil.copy(src, dst)
    print(f"Copied {src} to {dst}")

# A really elegant one for Contacto Hero (let's pick index 25, high chance it's a great shot)
elegant = all_files[25]
dst_elegant = os.path.join(home_dir, "hero-contacto.jpg")
shutil.copy(elegant, dst_elegant)

# Save
print("Done copying the files correctly this time!")

# Add hero-new-1 to 4
for i in range(1, 5):
    src = all_files[i+30]
    dst = os.path.join(home_dir, f"hero-new-{i}.jpg")
    shutil.copy(src, dst)
    print(f"Copied {src} to {dst}")
