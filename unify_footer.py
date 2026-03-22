import os

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'

# El footer con clases que SÍ están en carso.css (footer-top, footer-col, footer-bottom, etc.)
UNIFIED_FOOTER = '''    <footer>
        <div class="footer-bg-text" aria-hidden="true">CARSO</div>
        <div class="footer-top">
            <div>
                <div class="footer-brand-name">Plaza <span>Carso</span></div>
                <p class="footer-brand-desc">Boutiques exclusivas, alta cocina y el Roof Garden más icónico de Polanco. Lago Zúrich 219-245, Granada, CDMX.</p>
            </div>
            <div class="footer-col">
                <h4>Navegación</h4>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="directorio.html">Directorio</a></li>
                    <li><a href="mapa.html">Mapa</a></li>
                    <li><a href="eventosypromociones.html">Novedades</a></li>
                    <li><a href="contacto.html">Contacto</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Visítanos</h4>
                <address>Lago Zúrich 219-245<br>Granada, 11529<br>Ciudad de México<br><a href="tel:5549760346">55 4976 0346</a></address>
            </div>
            <div class="footer-col">
                <h4>Horario</h4>
                <ul>
                    <li><a href="#">Lun–Dom: 11:00–21:00</a></li>
                    <li><a href="#">Roof Garden: hasta 23:00</a></li>
                    <li><a href="contacto.html">Contáctanos</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="footer-copy">&copy; 2026 Plaza Carso. Todos los derechos reservados.</p>
            <div class="footer-socials">
                <a href="https://www.facebook.com/plazacarsomx" target="_blank" rel="noopener" aria-label="Facebook">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="https://twitter.com/carsoplaza" target="_blank" rel="noopener" aria-label="Twitter">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="#" aria-label="Instagram">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
            </div>
        </div>
    </footer>'''

# Páginas a corregir (index.html también para unificar ambos sistemas)
files_to_fix = ["index.html", "directorio.html", "eventosypromociones.html", "contacto.html"]

for fname in files_to_fix:
    fpath = os.path.join(repo_dir, fname)
    with open(fpath, 'r', encoding='utf-8') as f:
        content = f.read()

    # Encontrar inicio y fin del footer
    start = content.find('<footer>')
    end = content.find('</footer>') + len('</footer>')

    if start == -1:
        print(f"⚠️  No <footer> in {fname}, skipping.")
        continue

    content = content[:start] + UNIFIED_FOOTER + content[end:]
    with open(fpath, 'w', encoding='utf-8') as f:
        f.write(content)
    print(f"✅ {fname} — footer unificado con clases de carso.css")

print("\nListo. Todos los footers ahora usan footer-top / footer-col / footer-bottom.")
