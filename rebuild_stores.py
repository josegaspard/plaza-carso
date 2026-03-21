import os
import shutil
import glob

source_dir = '/Users/josegaspard/Desktop/CARSO FOTOS FINALES/drive-download-20260312T001156Z-1-001'
dest_repo = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'
stores_dir = os.path.join(dest_repo, 'images', 'stores')
home_dir = os.path.join(dest_repo, 'images', 'home')

all_files = sorted(glob.glob(os.path.join(source_dir, '*.jpg')))

stores = ["armani-exchange", "tommy-hilfiger", "swarovski", "telcel", "roof-garden", "cinepolis", "calvin-klein", "sanborns", "gnc", "liverpool", "zara", "food-court"]

# Instead of sequential, let's step by 12 to avoid camera bursts!
for i, store in enumerate(stores):
    src = all_files[(i*12) + 2] # Spreading out selection massively
    dst = os.path.join(stores_dir, f"{store}.jpg")
    shutil.copy(src, dst)
    print(f"Brought distinct photo {src} for {store}")

# Hero new 1 to 4 spreads further down the list
for i in range(1, 5):
    src = all_files[(i*15) + 100]
    dst = os.path.join(home_dir, f"hero-new-{i}.jpg")
    shutil.copy(src, dst)

# Elegant contact photo (pick index 145 or something distinct and beautiful)
elegant_src = all_files[145]
elegant_dst = os.path.join(home_dir, "hero-contacto.jpg")
shutil.copy(elegant_src, elegant_dst)

print("All distinct images distributed successfully!")
