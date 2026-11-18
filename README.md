# Sonora — Aplicación Web de Música

Sonora es una aplicación web de streaming de música desarrollada con **Laravel**, **Blade**, **Tailwind CSS** y **SQLite**. El sistema permite navegar por colecciones musicales, filtrar canciones en tiempo real y simular la reproducción de pistas mediante una interfaz moderna con soporte para tema oscuro y claro.

## Requisitos e Instalación

Para ejecutar el proyecto en un entorno local, descomprime la carpeta del proyecto, abre una terminal dentro de ella (`cd sonora`) e instala las dependencias necesarias de PHP y Node ejecutando `composer install` seguido de `npm install`. A continuación, crea tu archivo de configuración copiando el ejemplo (`cp .env.example .env`), genera la llave de seguridad con `php artisan key:generate` y crea la base de datos SQLite junto con sus tablas y registros iniciales (8 canciones y 4 playlists) ejecutando `php artisan migrate:fresh --seed`. Finalmente, compila los estilos con `npm run build` y levanta el servidor local mediante `php artisan serve` para abrir la aplicación en tu navegador.

## Vistas Implementadas

La plataforma cuenta con cinco pantallas principales conectadas dinámicamente a la base de datos: **Inicio** (`/`), que presenta el menú lateral, chips de categoría, tarjetas de playlists destacadas y la cola de reproducción; **Buscar** (`/buscar`), equipada con un buscador en forma de píldora que filtra las canciones al instante por título o artista; **Tu Biblioteca** (`/biblioteca`), que muestra el resumen de colecciones guardadas y el catálogo completo; **Playlist** (`/playlist/{id}`), encargada de cargar dinámicamente la descripción y pistas de cada colección; y **Reproductor** (`/reproductor/{indice}`), una vista enfocada con barra de progreso interactiva y controles funcionales para avanzar o retroceder entre pistas.
