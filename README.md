# Plaza Universidad — Frontend Web
## Inmuebles Carso · Desarrollo por Hack Digital

---

### Demo estática (GitHub Pages)
https://josegaspard.github.io/plaza-carso/

### Entregable PHP (listo para servidor Azure)
La carpeta `entregable-php/` contiene el paquete completo `cc_plazaUniversidad` listo para instalar en el servidor de INCARSO junto al Gestor de Contenidos existente.

### Guía de instalación
Ver **[GUIA-INSTALACION-PLAZA-UNIVERSIDAD.md](GUIA-INSTALACION-PLAZA-UNIVERSIDAD.md)** para instrucciones paso a paso.

---

## Estructura del repositorio

```
├── index.html                  Demo estática (GitHub Pages)
├── directorio.html             Demo estática
├── mapa.html                   Demo estática
├── eventosypromociones.html    Demo estática
├── contacto.html               Demo estática
├── css/carso.css               Sistema de diseño compartido
├── Scripts/main.js             JS compartido
├── images/                     Assets visuales
│
├── entregable-php/             ★ PAQUETE PHP PARA SERVIDOR AZURE
│   ├── index.php               Integrado con backend INCARSO
│   ├── directorio.php          Integrado con backend INCARSO
│   ├── mapa.php                Integrado con backend INCARSO
│   ├── eventosypromociones.php Integrado con backend INCARSO
│   ├── contacto.php            Integrado con backend INCARSO
│   ├── header.php              Config $CentroComercial
│   ├── nav.php                 Navegación nueva
│   ├── footer-new.php          Footer con datos de BD
│   ├── modales.php             Modales Bootstrap 3
│   ├── css/backend-compat.css  Estilos para HTML del backend
│   └── ...                     Archivos PHP del backend
│
└── GUIA-INSTALACION-PLAZA-UNIVERSIDAD.md  ★ GUÍA COMPLETA
```

## Tecnologías
- PHP 7+ (sqlsrv) · SQL Server 2014+ · Bootstrap 3.3.7 · jQuery 3.2.1
- GSAP 3.12 · Swiper 11 · Google Fonts (Cormorant Garamond + Outfit)
- Servidor: IIS / Azure

## Desarrollado por
**Hack Digital** — fernanda.p@hackdigital.mx
**Desarrollo técnico:** José Gaspard — josegaspard.dev
