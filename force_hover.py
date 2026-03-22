import os

repo_dir = '/Users/josegaspard/Desktop/JoseGaspard-Portfolio/tmp-carso'

html_files = [f for f in os.listdir(repo_dir) if f.endswith('.html')]

footer_hover_script = """
    <script>
        // Footer Cursor Auto-Inversion
        document.querySelectorAll('footer').forEach(f => {
            f.addEventListener('mouseenter', () => { 
                const cur = document.getElementById('cursor') || document.getElementById('cur');
                const dot = document.getElementById('cursor-dot');
                if(cur) cur.style.borderColor = '#fff'; 
                if(dot) dot.style.background = '#fff'; 
            });
            f.addEventListener('mouseleave', () => { 
                const cur = document.getElementById('cursor') || document.getElementById('cur');
                const dot = document.getElementById('cursor-dot');
                if(cur) cur.style.borderColor = ''; 
                if(dot) dot.style.background = ''; 
            });
        });
    </script>
"""

for f_name in html_files:
    f_path = os.path.join(repo_dir, f_name)
    with open(f_path, 'r', encoding='utf-8') as f:
        content = f.read()
        
    # Remove old copies if they exist to prevent duplicates
    if "Footer Cursor Auto-Inversion" in content:
        continue
        
    # Also clean up the incomplete one in mapa.html if it's there
    if "cur.style.borderColor = '#fff'; document.getElementById('cursor-dot').style.background = '#fff';" in content:
        content = content.replace("f.addEventListener('mouseenter', () => { if(cur) { cur.style.borderColor = '#fff'; document.getElementById('cursor-dot').style.background = '#fff'; } });", "")
        content = content.replace("f.addEventListener('mouseleave', () => { if(cur) { cur.style.borderColor = ''; document.getElementById('cursor-dot').style.background = ''; } });", "")

    # Inject securely right before </body>
    idx = content.rfind('</body>')
    if idx != -1:
        content = content[:idx] + footer_hover_script + content[idx:]
        with open(f_path, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Injecting footer hover script in {f_name}")

print("Done")
