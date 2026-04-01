# Plaza Carso — Rediseno Frontend

Rediseno completo del sitio web de **Plaza Carso**, el centro comercial de lujo ubicado en Polanco, Ciudad de Mexico. Proyecto desarrollado para **HGroup** por [Jose Gaspard](https://josegaspard.dev).

**Live:** https://josegaspard.github.io/plaza-carso/

---

## Sobre el proyecto

Plaza Carso necesitaba un frontend moderno que reflejara el posicionamiento premium del centro comercial. Se diseno desde cero una experiencia visual sofisticada con animaciones fluidas, tipografia editorial y una arquitectura responsive que funciona en cualquier dispositivo.

El sitio esta preparado para integrarse con el backend PHP/SQL Server existente del sistema Incarso que maneja el directorio de tiendas, modales de locatarios y formularios de contacto.

## Paginas

| Pagina | Archivo | Que hace |
|---|---|---|
| Inicio | `index.html` | Hero fullscreen con animacion GSAP, marquee, estadisticas, panels alternados, carrusel Swiper de tiendas, seccion Roof Garden, grid de novedades y newsletter |
| Directorio | `directorio.html` | Grid filtrable por categoria con barra sticky, tarjetas con hover grayscale, modal AJAX para detalle de tienda |
| Mapa | `mapa.html` | Mapa interactivo con selector de niveles (Planta Baja, Primer Piso, Roof Garden), sidebar de busqueda |
| Novedades | `eventosypromociones.html` | Grid de eventos y promociones con sistema de tabs (Todos, Eventos, Promociones) |
| Contacto | `contacto.html` | Formulario de contacto con validacion, mapa embebido, informacion de contacto directo |

## Stack tecnico

- **HTML5 semantico** con landmarks (`main`, `nav`, `footer`, `section`)
- **CSS vanilla** con custom properties y media queries (breakpoints: 1100px, 768px, 540px)
- **JavaScript vanilla** + GSAP 3 con ScrollTrigger para animaciones
- **Swiper.js** para el carrusel de tiendas destacadas
- **jQuery + Bootstrap 3** requeridos por el sistema backend Incarso
- **Google Fonts:** Cormorant Garamond (serif, titulares) + Outfit (sans, cuerpo)

## Diseno

### Paleta de color

| Token | Hex | Uso |
|---|---|---|
| `--ink` | `#080706` | Fondos oscuros, texto principal, CTAs |
| `--warm` | `#F5F3EF` | Fondo base, textos sobre oscuro |
| `--smoke` | `#EDEBE6` | Fondos alternos, bordes |
| `--silver` | `#C0B9B0` | Labels, acentos |
| `--grey` | `#857E76` | Texto secundario |
| `--mid` | `#3A3530` | Texto medio, hover states |

### Tipografia

- **Cormorant Garamond** (300, 400, 600, italic) — Titulares y elementos editoriales
- **Outfit** (200-600) — Cuerpo de texto, navegacion, labels

### Animaciones

- Loader con transicion de logo que vuela al navbar (desktop)
- Parallax suave en hero y seccion Roof Garden via GSAP ScrollTrigger
- Scroll reveals con IntersectionObserver
- Ken Burns sutil en imagenes hero
- Hover grayscale-to-color en tarjetas de tiendas
- Cursor custom en desktop (pointer:fine)
- Marquee infinito en seccion de categorias

## SEO

- Meta tags completos: title, description, canonical en cada pagina
- Open Graph y Twitter Cards con imagenes especificas por pagina
- Schema.org JSON-LD: `ShoppingCenter` (inicio), `ItemList` (directorio), `ContactPage` (contacto)
- Favicon, theme-color, robots meta
- HTML semantico con h1-h4 jerarquico

## Accesibilidad

- Skip-to-content link para navegacion por teclado
- Landmarks semanticos (`main`, `nav`, `footer`)
- `aria-label`, `aria-expanded`, `aria-hidden` donde corresponde
- `:focus-visible` con contraste apropiado (oscuro sobre claro, claro sobre oscuro)
- `prefers-reduced-motion` respetado (desactiva todas las animaciones)
- Cursor custom oculto en dispositivos tactiles (`pointer:coarse`)

## Integracion backend (Incarso)

El frontend conecta con el backend PHP/SQL Server existente. Los puntos de integracion estan marcados con comentarios en el HTML.

**Formulario de contacto** — campos alineados con `enviarCorreo.php`:
- `NombreContacto`, `EmailContacto`, `TelefonoContacto`, `Mensaje`
- `tipoMensaje` (1 = Quejas y Sugerencias, 2 = Espacios Disponibles)
- `EmailPlaza`, `NombrePlaza` (campos ocultos)
- `AvisoPrivacidad` (checkbox obligatorio)

**Modales AJAX:**
- `#miModalLocatario` → `locatarioModal.php` (detalle de tienda desde mapa/directorio)
- `#miModalPublicidad` → `publicidadModal.php` (publicidad)

## Estructura del proyecto

```
plaza-carso/
  index.html              # Pagina principal
  directorio.html         # Directorio de tiendas
  mapa.html               # Mapa interactivo
  eventosypromociones.html # Eventos y promociones
  contacto.html           # Pagina de contacto
  css/
    carso.css              # Estilos compartidos (nav, footer, botones, accesibilidad)
  Scripts/
    main.js                # JS compartido (smooth scroll, modales)
  images/
    home/                  # Imagenes del sitio (hero, eventos, tiendas)
    logos/                 # Logo Plaza Carso (PNG, WebP)
    stores/                # Fotos de tiendas destacadas
    map/                   # Imagenes del mapa por nivel
```

## Autor

Desarrollado por **Jose Gaspard** para **HGroup**.

- Web: [josegaspard.dev](https://josegaspard.dev)
- GitHub: [@josegaspard](https://github.com/josegaspard)
