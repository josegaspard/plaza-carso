# Plaza Universidad — Guia de Instalacion Frontend
## Preparado por Hack Digital para Inmuebles Carso

---

## Estructura de carpetas

```
cc_plazaUniversidad/          ← Carpeta raiz del sitio
├── index.php                 ← Pagina principal
├── directorio.php            ← Directorio de tiendas
├── mapa.php                  ← Mapa interactivo
├── eventosypromociones.php   ← Novedades y eventos
├── contacto.php              ← Formulario de contacto
├── header.php                ← ⚡ Config: $CentroComercial + includes
├── nav.php                   ← Navegacion principal (nueva)
├── footer-new.php            ← Footer (nuevo, con datos dinamicos)
├── modales.php               ← Contenedores de modales Bootstrap 3
├── menu.php                  ← Compatibilidad (oculto)
├── menuXS.php                ← Compatibilidad (oculto)
├── logos-top.php              ← Compatibilidad (vacio)
├── locatarioModal.php        ← Backend: modal de locatario
├── publicidadModal.php       ← Backend: modal de publicidad
├── enviarCorreo.php          ← Backend: envio de correo
├── filtroGiroComercial.php   ← Backend: filtro mapa
├── filtroGiroComercialLocal.php ← Backend: filtro directorio
├── listadoLocatarios.php     ← Backend: lista locatarios mapa
├── AvisodePrivacidad.php     ← Aviso de privacidad
├── buscar.php                ← Busqueda
├── mail.php                  ← Backend: envio emails
├── logo.php                  ← Logo
├── style.css                 ← CSS original (compatibilidad)
├── estilo-bid.css            ← CSS BID (compatibilidad)
├── web.config                ← Configuracion IIS
├── css/
│   ├── carso.css             ← Sistema de diseno nuevo
│   ├── backend-compat.css    ← Estilos para HTML generado por PHP
│   ├── bootstrap.css         ← ⚠ COPIAR del servidor existente
│   ├── Gridmvc.css           ← ⚠ COPIAR del servidor existente
│   ├── personalizados.css    ← ⚠ COPIAR del servidor existente
│   └── font-awesome.css      ← ⚠ COPIAR del servidor existente
├── Scripts/
│   ├── main.js               ← JS compartido (nuevo)
│   ├── jquery-3.2.1.js       ← ⚠ COPIAR del servidor existente
│   ├── bootstrap.js          ← ⚠ COPIAR del servidor existente
│   ├── modernizr-2.8.3.js    ← ⚠ COPIAR del servidor existente
│   ├── respond.js            ← ⚠ COPIAR del servidor existente
│   ├── Gridmvc.js            ← ⚠ COPIAR del servidor existente
│   ├── logoLocatario.js      ← ⚠ COPIAR del servidor existente
│   ├── carrusel.js           ← ⚠ COPIAR del servidor existente
│   └── jquery.validate.min.js← ⚠ COPIAR del servidor existente
├── images/                   ← Imagenes del sitio
│   ├── home/                 ← Fotos principales (nuevas)
│   ├── logos/                ← Logos del sitio
│   ├── stores/               ← Fotos de tiendas
│   └── map/                  ← Imagenes de mapas
└── logos/                    ← Logos footer (Carso, Fundacion, etc.)
```

---

## Pasos de instalacion

### 1. Configurar $CentroComercial
En `header.php`, linea 10, cambiar:
```php
$CentroComercial = '99'; // ← Reemplazar con el ID real de Plaza Universidad
```

### 2. Ubicar la carpeta
Colocar `cc_plazaUniversidad/` al mismo nivel que `00-gestorContenidos/`:
```
C:\inetpub\wwwroot\cc\
├── 00-gestorContenidos/     ← Gestor (ya existe)
├── cc_plazaInsurgentes/     ← Otra plaza (referencia)
└── cc_plazaUniversidad/     ← NUEVA PLAZA
```

### 3. Copiar archivos del servidor
Los archivos marcados con ⚠ deben copiarse de otra plaza existente (ej. cc_plazaInsurgentes):
- `css/bootstrap.css`, `css/Gridmvc.css`, `css/personalizados.css`, `css/font-awesome.css`
- `Scripts/jquery-3.2.1.js`, `Scripts/bootstrap.js`, `Scripts/modernizr-2.8.3.js`, etc.
- `logos/` (logos del footer: Fundacion Carlos Slim, Heroes por la Vida, etc.)
- `logos/icono.ico` (favicon)

### 4. Logo de Plaza Universidad
Reemplazar `images/logo.png` con el logotipo oficial de Plaza Universidad.

### 5. Imagenes propias
Reemplazar las imagenes placeholder en `images/home/` con las fotos reales de Plaza Universidad.

### 6. Mapa SVG
En `mapa.php`, el area del mapa actualmente tiene un placeholder.
Sistemas debera generar el SVG interactivo de Plaza Universidad con poligonos
que sigan la misma convencion de IDs:
- Poligonos del SVG: `id="local{N}PlantaBaja"` o `id="local{N}PlantaAlta"`
- Lista de locatarios: `id="Dlocal{N}PlantaBaja"` (prefijo "D")

### 7. Google Maps embed
En `contacto.php`, reemplazar el iframe de Google Maps con el embed correcto
de la ubicacion de Plaza Universidad:
- Av. Universidad 1000, Sta Cruz Atoyac, Benito Juarez, 03310 CDMX

### 8. Base de datos
Asegurar que en la tabla `catCentroComercial` exista el registro de Plaza Universidad con:
- nombre, direccion, telefono, email, descripcion, analytics, redes sociales

### 9. Horarios
En `footer-new.php` e `index.php`, los horarios estan hardcoded como "11:00-21:00".
Ajustar segun el horario real de Plaza Universidad.

---

## Compatibilidad tecnica

| Componente | Version | Notas |
|---|---|---|
| PHP | 7.x+ | Funciones sqlsrv |
| SQL Server | 2014+ | BD: gestorContenidos |
| jQuery | 3.2.1 | Requerido por modales |
| Bootstrap | 3.3.7 | Modales y grid |
| IIS | Azure | web.config incluido |
| GSAP | 3.12.5 | Animaciones (CDN) |
| Swiper | 11 | Slider tiendas (CDN) |

## Funciones PHP utilizadas

Todas estas funciones ya existen en `conexion.php` del gestor:
- `nombreCC()` — Nombre del centro comercial
- `descripcionCC()` / `descripcionCC_Completo()` — Descripcion
- `direccionCC()` — Direccion
- `telefonoCC()` — Telefono
- `emailCC()` — Email
- `analyticsCC()` — Google Analytics
- `redesSocialesCC()` — Redes sociales
- `giroComercial()` — Select de categorias
- `directorioCC2()` — Grid de locatarios
- `publicaciones()` — Eventos y promociones
- `facebook()` / `twitter()` — URLs redes sociales
- `facebookIni()` — SDK de Facebook
- `carruselInicio()` — Carousel del home
- `informacionLocatario()` — Modal de locatario
- `informacionPublicacion()` — Modal de publicacion

---

## Soporte
Hack Digital — fernanda.p@hackdigital.mx
