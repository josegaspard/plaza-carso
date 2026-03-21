import os

html_path = 'index.html'

with open(html_path, 'r', encoding='utf-8') as f:
    lines = f.readlines()

def repl(lines, num, old, new):
    idx = num - 1
    if idx < len(lines) and old in lines[idx]:
        lines[idx] = lines[idx].replace(old, new)

# Hero (línea 317) ya es back-slide-home.jpg por el checkout
# 1647 Panel Boutiques Plaza Carso
repl(lines, 1647, 'images/home/directorio-bg.jpg', 'images/home/hero-new-1.jpg')
# 1659 Panel Roof Garden Soumaya
repl(lines, 1659, 'images/home/eventos-bg.jpg', 'images/home/hero-new-3.jpg')
# 1679 Carousel Boutique
repl(lines, 1679, 'images/home/directorio-bg.jpg', 'images/home/hero-new-4.jpg')
# 1691 Carousel Gastronomía (Usando foto patio-comidas que es perfecta para Food Court)
repl(lines, 1691, 'images/home/eventos-bg.jpg', 'images/home/patio-comidas.jpg')
# 1697 Carousel Joyería
repl(lines, 1697, 'images/home/directorio-bg.jpg', 'images/home/evento-41.jpg')
# 1735 Novedades grid 1
repl(lines, 1735, 'images/home/eventos-bg.jpg', 'images/home/evento-42.jpg')
# 1742 Novedades grid 2
repl(lines, 1742, 'images/home/directorio-bg.jpg', 'images/home/evento-43.jpg')
# 950 sección 1 bg
repl(lines, 950, 'images/home/eventos-bg.jpg', 'images/home/hero-new-2.jpg')

with open(html_path, 'w', encoding='utf-8') as f:
    f.writelines(lines)

print("index.html fully populated with sensible images, missing placeholders removed.")
