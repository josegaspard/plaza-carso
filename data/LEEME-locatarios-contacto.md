# Cómo se rellena la ficha automáticamente desde su base de datos

La web ya tiene construidos los cuatro campos que faltaban — **teléfono, WhatsApp,
horario por día y sitio web / redes** — y los muestra apagados mientras no hay dato.

Para que se rellenen solos basta con dejar aquí un fichero:

    data/locatarios-contacto.json

La página lo lee al cargar y completa **solo los huecos**: si el dato ya viene del
gestor de contenidos, el del gestor gana. Si el fichero no existe, la web se
comporta exactamente igual que hoy.

## Forma del fichero

```json
{
  "Cinépolis": {
    "tel": "5512345678",
    "wa": "5512345678",
    "web": "https://www.cinepolis.com",
    "ig": "https://www.instagram.com/cinepolis/",
    "fb": "https://www.facebook.com/cinepolis/",
    "zona": "Zona A",
    "hor": { "lunvie": "11:00–23:00", "sabado": "10:00–23:30", "domingo": "10:00–22:00" }
  },
  "Starbucks": {
    "tel": "5587654321",
    "hor": { "todos": "07:00–22:00" }
  }
}
```

- La **clave** es el nombre del locatario tal y como aparece en el directorio.
  Se compara sin acentos y sin distinguir mayúsculas, así que «Cinepolis» también casa.
- Todos los campos son **opcionales**: lo que no venga se queda apagado, como ahora.
- `hor` admite `lunvie`, `sabado` y `domingo` (el horario por día que pidieron) o
  un `todos` suelto si la tienda abre igual toda la semana.
- `tel` y `wa` pueden ir con o sin espacios y paréntesis; la web los limpia sola.

## Cómo generarlo

Cualquier consulta a su base de datos que devuelva esas columnas sirve. El fichero
puede regenerarse cada noche y subirse sin tocar nada más: no hay que volver a
desplegar la web.
