# Plaza Universidad — Guía Completa de Instalación
### Frontend desarrollado por Hack Digital para Inmuebles Carso
### Abril 2026

---

## 1. Resumen Ejecutivo

Se entrega el **frontend completo** de la página web de **Plaza Universidad**, listo para integrarse con el backend existente de Inmuebles Carso (PHP + SQL Server + Azure).

**El frontend incluye:**
- 5 páginas principales (index, directorio, mapa, eventos, contacto)
- Diseño responsive optimizado para móvil y escritorio
- Integración completa con todas las funciones PHP del Gestor de Contenidos
- Compatibilidad con Bootstrap 3.3.7, jQuery 3.2.1 y modales existentes
- Formulario de contacto conectado a `enviarCorreo.php`
- Mapa interactivo preparado para SVG con polígonos de locatarios
- Directorio con filtro por giro comercial vía AJAX

**Lo que se requiere del equipo de Sistemas para activar el sitio:**
- Asignar un ID de Centro Comercial en la base de datos
- Colocar la carpeta en el servidor Azure
- Copiar los archivos CSS/JS compartidos de otra plaza
- Generar el SVG del mapa interactivo
- Reemplazar imágenes placeholder con fotos reales

---

## 2. Contenido del Entregable

### Estructura de carpetas

```
cc_plazaUniversidad/
│
├── ─── PÁGINAS PRINCIPALES ───────────────────────────
├── index.php                    Página de inicio
├── directorio.php               Directorio de tiendas
├── mapa.php                     Mapa interactivo
├── eventosypromociones.php      Novedades, eventos y promociones
├── contacto.php                 Formulario de contacto
│
├── ─── COMPONENTES COMPARTIDOS ───────────────────────
├── header.php                   ⚡ Configuración principal ($CentroComercial)
├── nav.php                      Navegación superior (menú hamburguesa + desktop)
├── footer-new.php               Footer con datos dinámicos de la BD
├── modales.php                  6 modales Bootstrap 3 (locatario, publicidad, etc.)
│
├── ─── COMPATIBILIDAD CON BACKEND ────────────────────
├── menu.php                     Stub de compatibilidad (oculto)
├── menuXS.php                   Stub de compatibilidad (oculto)
├── logos-top.php                Stub de compatibilidad (vacío)
│
├── ─── ARCHIVOS DEL BACKEND (sin modificar) ──────────
├── locatarioModal.php           Modal de información de locatario
├── publicidadModal.php          Modal de publicidad/eventos
├── enviarCorreo.php             Envío de correo (formulario contacto)
├── filtroGiroComercial.php      Filtro del mapa por giro comercial
├── filtroGiroComercialLocal.php Filtro del directorio por giro comercial
├── listadoLocatarios.php        Lista de locatarios por piso (mapa)
├── AvisodePrivacidad.php        Aviso de privacidad (modal)
├── buscar.php                   Búsqueda de locatarios
├── mail.php                     Funciones de correo
├── logo.php                     Logo del centro comercial
│
├── ─── ESTILOS ───────────────────────────────────────
├── style.css                    CSS original del backend
├── estilo-bid.css               CSS BID del backend
├── css/
│   ├── carso.css                Sistema de diseño nuevo (tipografía, colores, layout)
│   ├── backend-compat.css       Estilos para HTML generado por PHP
│   ├── bootstrap.css            ⚠ COPIAR del servidor
│   ├── Gridmvc.css              ⚠ COPIAR del servidor
│   ├── personalizados.css       ⚠ COPIAR del servidor
│   └── font-awesome.css         ⚠ COPIAR del servidor
│
├── ─── SCRIPTS ───────────────────────────────────────
├── Scripts/
│   ├── main.js                  JS compartido (handlers AJAX, modales, formulario)
│   ├── jquery-3.2.1.js          ⚠ COPIAR del servidor
│   ├── bootstrap.js             ⚠ COPIAR del servidor
│   ├── modernizr-2.8.3.js       ⚠ COPIAR del servidor
│   ├── respond.js               ⚠ COPIAR del servidor
│   ├── Gridmvc.js               ⚠ COPIAR del servidor
│   ├── logoLocatario.js         ⚠ COPIAR del servidor
│   ├── carrusel.js              ⚠ COPIAR del servidor
│   └── jquery.validate.min.js   ⚠ COPIAR del servidor
│
├── ─── IMÁGENES ──────────────────────────────────────
├── images/
│   ├── logo.png                 ⚠ REEMPLAZAR con logo de Plaza Universidad
│   ├── home/                    Fotos del hero, paneles, eventos (placeholder)
│   ├── logos/                   Logos del sitio
│   ├── stores/                  Fotos de tiendas (placeholder)
│   └── map/                     Imágenes de mapas por piso
│
├── ─── LOGOS FOOTER ──────────────────────────────────
├── logos/                       ⚠ COPIAR del servidor
│   ├── icono.ico                Favicon
│   ├── logo_InmueblesCarso.png
│   ├── logo_fundacionCarlosslim.png
│   ├── logo_heroesPorLaVida.png
│   ├── logo_clikiSalud.png
│   └── btnMenu.png
│
├── ─── CONFIGURACIÓN ─────────────────────────────────
├── web.config                   Reglas IIS (redirect HTTP → HTTPS)
└── LEAME-INSTALACION.md         Esta guía en formato resumido
```

Los archivos marcados con ⚠ deben copiarse de una plaza existente (ej: `cc_plazaInsurgentes`).

---

## 3. Pasos de Instalación

### Paso 1: Crear el Centro Comercial en la Base de Datos

En la tabla `catCentroComercial` de la base de datos `gestorContenidos`, crear un nuevo registro para Plaza Universidad con los siguientes campos:

| Campo | Valor |
|---|---|
| `nombre` | Plaza Universidad |
| `direccion` | Av. Universidad 1000, Sta Cruz Atoyac, Benito Juárez, 03310 CDMX |
| `telefono` | (número de teléfono de la plaza) |
| `email` | (correo de contacto de la plaza) |
| `descripcion` | (descripción breve y completa del centro comercial) |
| `analytics` | (código de Google Analytics si aplica) |
| `url` | (URL del sitio web) |
| `urlInmuebles` | https://www.inmueblescarso.com/ |
| `rutaFisica` | (ruta física en el servidor) |

**Anotar el `idCatCentroComercial` generado** — se necesita para el siguiente paso.

Además, en la tabla `redSocialCC`, agregar las redes sociales:
- Facebook (idCatRedesSociales = 1)
- Twitter (idCatRedesSociales = 2)
- Instagram (idCatRedesSociales = 3, si aplica)

### Paso 2: Configurar el ID del Centro Comercial

Abrir el archivo `header.php`, línea 10, y cambiar:

```php
// ANTES (placeholder):
$CentroComercial = '99';

// DESPUÉS (ID real asignado en el Paso 1):
$CentroComercial = 'XX';  // ← Reemplazar XX con el ID de la tabla catCentroComercial
```

### Paso 3: Ubicar la Carpeta en el Servidor

Colocar la carpeta `cc_plazaUniversidad` en el servidor Azure, al **mismo nivel** que las otras plazas y el Gestor de Contenidos:

```
C:\inetpub\wwwroot\cc\
├── 00-gestorContenidos\          ← Gestor (ya existe en el servidor)
│   └── class\
│       └── conexion.php          ← Funciones PHP compartidas
├── cc_plazaInsurgentes\          ← Plaza Insurgentes (referencia)
├── cc_plazaCiudadJardin\         ← Ciudad Jardín (referencia)
└── cc_plazaUniversidad\          ← ★ NUEVA — colocar aquí
```

**Es fundamental** que la ruta relativa `../00-gestorContenidos/class/conexion.php` sea válida desde la carpeta de Plaza Universidad. Si el Gestor está en otra ubicación, ajustar la ruta en `header.php` línea 11.

### Paso 4: Copiar Archivos Compartidos del Servidor

Desde cualquier plaza existente (ej: `cc_plazaInsurgentes`), copiar los siguientes archivos a `cc_plazaUniversidad`:

**CSS** (copiar a `css/`):
```
bootstrap.css
Gridmvc.css
personalizados.css
font-awesome.css
```

**Scripts** (copiar a `Scripts/`):
```
jquery-3.2.1.js
bootstrap.js
modernizr-2.8.3.js
respond.js
Gridmvc.js
logoLocatario.js
carrusel.js
jquery.validate.min.js
```

**Logos** (copiar carpeta completa a `logos/`):
```
icono.ico
btnMenu.png
logo_InmueblesCarso.png
logo_fundacionCarlosslim.png
logo_heroesPorLaVida.png
logo_clikiSalud.png
```

**Locatarios** (crear carpeta `locatarios/`):
```
Cuando se den de alta los locatarios en el Gestor de Contenidos,
las imágenes de logos de locatarios se guardan en:
    00-gestorContenidos/locatarios/{idCatLocatario}.jpg (o .png)

Las funciones PHP ya buscan automáticamente en esa ruta.
```

### Paso 5: Logo de Plaza Universidad

Reemplazar `images/logo.png` con el logotipo oficial de Plaza Universidad.

Este logo aparece en:
- La barra de navegación superior (todas las páginas)
- La pantalla de carga (index.php)

Formato recomendado: PNG con fondo transparente, mínimo 400px de ancho.

### Paso 6: Fotografías del Centro Comercial

Las imágenes en `images/home/` son placeholders. Reemplazarlas con fotos reales:

| Archivo | Dónde aparece | Recomendación |
|---|---|---|
| `back-slide-home.jpg` | Hero principal (index) | Foto panorámica exterior/interior, 1920x1080+ |
| `back-directorio.jpg` | Fondo body desktop | Textura arquitectónica, 1920x1080 |
| `directorio-bg.jpg` | Hero del directorio | Foto pasillos/tiendas, 1920x800+ |
| `hero-eventos.jpg` | Hero de novedades | Foto de evento o espacio, 1920x800+ |
| `hero-contacto.jpg` | Hero de contacto | Foto fachada/recepción, 1920x800+ |
| `hero-new-2.jpg` | Sección Roof/CTA | Foto terraza/vista, 1920x1080 |
| `hero-new-3.jpg` | Panel gastronomía | Foto restaurante/cocina, 800x1000+ |
| `evento-42.jpg` | Grid novedades | Foto evento 1, 800x600+ |
| `evento-43.jpg` | Grid novedades | Foto evento 2, 800x600+ |
| `pandora.jpg` | Grid novedades | Foto promoción, 800x600+ |
| `pasillo.jpg` | Swiper tiendas | Foto interiores, 600x900+ |
| `patio-comidas.jpg` | Swiper tiendas | Foto food court, 600x900+ |
| `sanborns.jpg` | Swiper tiendas | Foto tienda ancla, 600x900+ |

Las imágenes de `images/stores/` también son placeholder y pueden reemplazarse con fotos de tiendas reales.

### Paso 7: Mapa Interactivo (SVG)

El mapa interactivo requiere un **SVG con polígonos** que representen cada local. Actualmente `mapa.php` muestra un placeholder.

**Convención de IDs para los polígonos del SVG:**

```html
<!-- Cada local del SVG debe tener: -->
<polygon id="local{N}PlantaBaja" class="localP" fill="#COLOR" points="..." />
<polygon id="local{N}PlantaAlta" class="localP" fill="#COLOR" points="..." />
```

Donde `{N}` es el número del local que coincide con `idCatLocatario` en la base de datos.

**Convención de IDs para la lista lateral:**

La función `locatariosMapa()` genera links con:
```html
<a id="Dlocal{N}PlantaBaja" class="local" href="locatarioModal.php?CentroComercial=XX&idCatLocatario={N}&origen=mapa">
    Nombre del Locatario
</a>
```

El prefijo "D" es obligatorio — conecta la lista con los polígonos del SVG.

**Para integrar el SVG:**
Abrir `mapa.php`, buscar el comentario `<!-- BACKEND: Aquí se inyecta el SVG -->` y reemplazar el placeholder con el SVG real. Se puede hacer via PHP include o inline.

### Paso 8: Google Maps (Contacto)

En `contacto.php`, buscar el `<iframe>` de Google Maps y reemplazar el `src` con el embed correcto de Plaza Universidad:

**Dirección:** Av. Universidad 1000, Sta Cruz Atoyac, Benito Juárez, 03310 CDMX

Para obtener el embed:
1. Ir a Google Maps
2. Buscar "Plaza Universidad CDMX"
3. Click en "Compartir" → "Incorporar un mapa"
4. Copiar el `src` del iframe generado

### Paso 9: Configurar IIS / Dominio

El archivo `web.config` incluye:
- Redirect HTTP → HTTPS

Si se necesita configurar un dominio específico, agregar la regla de redirect correspondiente en `web.config`:

```xml
<rule name="Redirecciona a URL del certificado" stopProcessing="true">
    <match url="(.*)" />
    <conditions>
        <add input="{HTTP_HOST}" pattern="^plazauniversidad\.com\.mx$" negate="true" />
    </conditions>
    <action type="Redirect" url="https://plazauniversidad.com.mx/{R:1}" />
</rule>
```

### Paso 10: Dar de Alta Locatarios

Usar el **Gestor de Contenidos** (`00-gestorContenidos`) para:

1. Dar de alta cada locatario en `catLocatario`:
   - Nombre, descripción, página web, redes sociales
   - Asignar giro comercial (`catGiroComercial`)
   - Subir logo/imagen del locatario

2. Asignar locatarios al centro comercial en `directorioLocatario`:
   - Vincular con el `idCatCentroComercial` de Plaza Universidad
   - Asignar piso (`Planta Baja` / `Planta Alta`)
   - Asignar número de local

3. Dar de alta los giros comerciales que apliquen en `catGiroComercial` si no existen:
   - Moda, Gastronomía, Tecnología, Joyería, Entretenimiento, etc.

### Paso 11: Publicaciones (Eventos y Promociones)

Usar el Gestor de Contenidos para crear publicaciones:
- Cada publicación aparece en `eventosypromociones.php`
- Incluir imagen, título, categoría y descripción
- Al hacer click se abre el modal de publicidad vía `publicidadModal.php`

### Paso 12: Verificación Final

Antes de liberar el sitio, verificar:

- [ ] El sitio carga correctamente en `https://dominio/index.php`
- [ ] La navegación funciona entre las 5 páginas
- [ ] El directorio muestra los locatarios de la base de datos
- [ ] El filtro por giro comercial funciona (select cambia las tiendas)
- [ ] Al hacer click en un locatario se abre el modal con su información
- [ ] El mapa muestra el SVG con los polígonos interactivos
- [ ] Al hacer click en un polígono del SVG se abre el modal del locatario
- [ ] La lista lateral del mapa se sincroniza con los polígonos (hover)
- [ ] El cambio de piso (Planta Baja / Planta Alta) actualiza la lista
- [ ] Los eventos y promociones se muestran correctamente
- [ ] Al hacer click en una publicación se abre el modal de publicidad
- [ ] El formulario de contacto envía correctamente el correo
- [ ] El aviso de privacidad se abre en modal
- [ ] El sitio se ve correctamente en celular (menú hamburguesa funciona)
- [ ] Los links de redes sociales del footer son correctos
- [ ] El favicon aparece en la pestaña del navegador

---

## 4. Especificaciones Técnicas

### Tecnologías utilizadas

| Componente | Versión | Carga |
|---|---|---|
| PHP | 7.x+ | Servidor (funciones sqlsrv) |
| SQL Server | 2014+ | Base de datos `gestorContenidos` |
| jQuery | 3.2.1 | Local (`Scripts/jquery-3.2.1.js`) |
| Bootstrap | 3.3.7 | Local (`css/bootstrap.css` + `Scripts/bootstrap.js`) |
| GSAP | 3.12.5 | CDN (animaciones de scroll y entrada) |
| Swiper | 11 | CDN (slider de tiendas en index) |
| Google Fonts | — | CDN (Cormorant Garamond + Outfit) |

### Funciones PHP del Gestor que se utilizan

Todas estas funciones **ya existen** en `conexion.php` del Gestor de Contenidos:

| Función | Página | Qué hace |
|---|---|---|
| `nombreCC($CC)` | Todas | Nombre del centro comercial |
| `descripcionCC($CC)` | header.php | Descripción (meta description) |
| `descripcionCC_Completo($CC)` | index.php | Descripción completa (hero) |
| `direccionCC($CC)` | footer, contacto, index | Dirección física |
| `telefonoCC($CC)` | footer, contacto, index | Teléfono |
| `emailCC($CC)` | footer, contacto | Email de contacto |
| `analyticsCC($CC)` | header.php | Código Google Analytics |
| `urlInmuebles($CC)` | nav.php | URL de Inmuebles Carso |
| `redesSocialesCC($CC, $color)` | footer-new.php | Redes sociales (HTML) |
| `redesSocialesCCXS($CC)` | menuXS.php | Redes sociales móvil |
| `giroComercial($CC)` | directorio, mapa | Select de categorías |
| `directorioCC2($CC, $giro)` | directorio.php | Grid de locatarios |
| `publicaciones($CC)` | eventosypromociones.php | Lista de publicaciones |
| `facebook($CC)` | eventosypromociones.php | URL Facebook |
| `twitter($CC)` | eventosypromociones.php | URL Twitter |
| `facebookIni()` | eventosypromociones.php | SDK Facebook |
| `carruselInicio($CC)` | (disponible si se activa) | Carrusel del home |

### Endpoints AJAX

| URL | Método | Parámetros | Quién lo llama |
|---|---|---|---|
| `locatarioModal.php` | GET | `CentroComercial`, `idCatLocatario`, `origen` | directorio, mapa (click en locatario) |
| `publicidadModal.php` | GET | `CentroComercial`, `idPublicacion` | eventosypromociones (click en publicación) |
| `filtroGiroComercialLocal.php` | POST | `giroComercial`, `centroComercial` | directorio (select de filtro) |
| `listadoLocatarios.php` | POST | `centroComercial`, `giroComercial`, `piso` | mapa (cambio piso/filtro) |
| `filtroGiroComercial.php` | GET | `GiroComercial`, `CentroComercial` | mapa (filtro por categoría) |
| `enviarCorreo.php` | POST | `tipoMensaje`, `NombreContacto`, `EmailContacto`, `EmailPlaza`, `NombrePlaza`, `TelefonoContacto`, `Mensaje` | contacto (formulario) |
| `AvisodePrivacidad.php` | GET | — | contacto (modal aviso) |

---

## 5. Diseño Visual

### Paleta de colores
- **Ink** (negro): `#080706` — textos, fondos oscuros, botones
- **Warm** (crema): `#F5F3EF` — fondo principal
- **Smoke** (gris claro): `#EDEBE6` — fondos secundarios, bordes
- **Silver** (plata): `#C0B9B0` — textos secundarios, líneas
- **Grey** (gris): `#857E76` — labels, kickers
- **Mid** (carbón): `#3A3530` — textos hover, fondos intermedios

### Tipografías
- **Cormorant Garamond** (serif) — títulos principales, números grandes, textos elegantes
- **Outfit** (sans-serif) — labels, botones, navegación, textos de cuerpo

### Referencia de diseño
El estilo visual sigue la línea de [Bal Harbour Shops](https://balharbourshops.com/), como fue solicitado por Irais López Rojas en el hilo de correos del proyecto.

---

## 6. Contacto y Soporte

**Hack Digital**
- Fernanda Portilla — fernanda.p@hackdigital.mx
- Directora de Hack Digital

Para cualquier duda técnica sobre la integración del frontend con el backend, estamos disponibles para coordinar con el equipo de Sistemas de Inmuebles Carso.

---

*Documento generado el 5 de abril de 2026*
*Versión 1.0*
