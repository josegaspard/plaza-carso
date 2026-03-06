# Plaza Carso — Frontend Redesign

Rediseño completo del frontend de **Plaza Carso** (Polanco, CDMX).

🌐 **Live Preview:** https://josegaspard.github.io/plaza-carso/

---

## Páginas

| Página | Archivo | Descripción |
|---|---|---|
| Inicio | `index.html` | Hero fullscreen + Swiper de tiendas + Roof Garden CTA |
| Directorio | `directorio.html` | Grid filtrable + modal de tienda + backend AJAX |
| Mapa | `mapa.html` | Interfaz de mapa interactivo + sidebar + integration point SVG |
| Novedades | `eventosypromociones.html` | Grid de eventos y promociones con tabs |
| Contacto | `contacto.html` | Formulario completo backend-compatible |

## Stack

- HTML5 semántico + CSS Vanilla + Vanilla JS
- [AOS](https://michalsnik.github.io/aos/) — Animaciones on scroll
- [Swiper.js](https://swiperjs.com/) — Carousel de tiendas
- Google Fonts: **Bebas Neue** + **Space Grotesk** + **DM Sans**
- jQuery + Bootstrap 3 (requeridos por el sistema Incarso)
- Font Awesome 6

## Paleta de color

| Token | Hex | Uso |
|---|---|---|
| `--white` | `#FFFFFF` | Fondo base |
| `--off-white` | `#F8F8F8` | Fondos alternos |
| `--silver-light` | `#EBEBEB` | Bordes y divisores |
| `--silver` | `#C8C8C8` | Labels, accents |
| `--grey` | `#8A8A8A` | Texto secundario |
| `--charcoal` | `#2C2C2C` | Texto principal |
| `--black` | `#111111` | Fondos hero, CTAs |

## Integración Backend (Incarso)

El frontend está diseñado para conectarse con el backend PHP/SQL Server existente. Ver comentarios `<!-- INTEGRATION POINT -->` en cada archivo HTML.

Campos del formulario de contacto alineados con `enviarCorreo.php`:
- `NombreContacto`, `EmailContacto`, `TelefonoContacto`, `Mensaje`
- `tipoMensaje` (1 = Quejas y Sugerencias, 2 = Espacios Disponibles)
- `EmailPlaza`, `NombrePlaza` (ocultos)
- `AvisoPrivacidad` (checkbox requerido)

Modales preparados:
- `#miModalLocatario` / `#miModalContenidoLocatario` — para `locatarioModal.php`
- `#miModalPublicidad` / `#miModalContenidoPublicidad` — para `publicidadModal.php`
