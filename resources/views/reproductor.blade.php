<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductor - Sonora</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-base text-ink font-sans h-screen flex flex-col items-center justify-center p-6">

    <main class="w-full max-w-md flex flex-col gap-10">
        <!-- Cabecera para regresar -->
        <header class="flex justify-between items-center w-full">
            <a href="/playlist" class="inline-flex items-center gap-2 text-ink-muted hover:text-ink transition focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus rounded-sm">
                <x-icon name="prev" class="w-5 h-5" />
                Volver
            </a>
            <span class="text-xs font-bold tracking-widest uppercase text-ink-muted">Reproduciendo ahora</span>
            <div class="w-16"></div>
        </header>

        <!-- Portada gigante -->
        <div class="w-full aspect-square bg-surface-raised rounded-lg shadow-raise flex items-center justify-center p-8">
            <div class="w-full h-full bg-surface-high rounded-md flex items-center justify-center">
                <div class="w-24 h-24 bg-accent rounded-pill flex items-center justify-center">
                    <x-icon name="play" class="w-12 h-12 text-on-accent" />
                </div>
            </div>
        </div>

        <!-- Textos dinámicos cargados desde Blade para la pista inicial -->
        <div class="text-center">
            <h1 id="titulo-texto" class="text-4xl font-extrabold mb-2 text-ink">{{ $pistas[$indice ?? 0]['titulo'] }}</h1>
            <p id="artista-texto" class="text-lg font-medium text-ink-muted">{{ $pistas[$indice ?? 0]['artista'] }}</p>
        </div>

        <!-- Barra de progreso interactiva -->
        <div class="flex flex-col gap-3">
            <div class="h-1 w-full rounded-pill bg-surface-high flex" role="slider" aria-label="Progreso">
                <div id="relleno" class="h-1 rounded-pill bg-accent" style="width: 0%"></div>
            </div>
            <div class="flex justify-between font-mono text-xs text-ink-muted">
                <span id="tiempo">00:00</span>
                <span id="duracion-texto">{{ floor($pistas[$indice ?? 0]['dur'] / 60) }}:{{ str_pad($pistas[$indice ?? 0]['dur'] % 60, 2, '0', STR_PAD_LEFT) }}</span>
            </div>
        </div>

        <!-- Controles -->
        <div class="flex items-center justify-center gap-8">
            <button id="btn-prev" type="button" aria-label="Anterior" class="text-ink-muted hover:text-ink transition focus-visible:outline-[3px] focus-visible:outline-focus rounded-pill p-2">
                <x-icon name="prev" class="w-8 h-8" />
            </button>
            
            <button id="btn-play" type="button" aria-label="Reproducir" class="flex items-center justify-center w-20 h-20 rounded-pill bg-accent text-on-accent hover:bg-accent-hover transition shadow-raise focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                <x-icon name="play" id="icono-play" class="w-10 h-10" />
                <x-icon name="pause" id="icono-pausa" class="w-10 h-10 hidden" />
            </button>
            
            <button id="btn-next" type="button" aria-label="Siguiente" class="text-ink-muted hover:text-ink transition focus-visible:outline-[3px] focus-visible:outline-focus rounded-pill p-2">
                <x-icon name="next" class="w-8 h-8" />
            </button>
        </div>
    </main>

    <!-- Lógica de reproducción simulada con cambio de pista -->
    <script>
        // Traemos todas las pistas desde Laravel hacia JavaScript
        const pistas = @json($pistas);
        
        // Tomamos el índice de la ruta o usamos 0 por defecto
        let indiceActual = {{ $indice ?? 0 }};
        let duracionTotal = pistas[indiceActual].dur;
        
        let t = 0;
        let timer = null;
        let reproduciendo = false;

        const btnPlay = document.getElementById('btn-play');
        const iconoPlay = document.getElementById('icono-play');
        const iconoPausa = document.getElementById('icono-pausa');
        const relleno = document.getElementById('relleno');
        const tiempoTexto = document.getElementById('tiempo');
        const duracionTexto = document.getElementById('duracion-texto');
        const tituloTexto = document.getElementById('titulo-texto');
        const artistaTexto = document.getElementById('artista-texto');
        
        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');

        const fmt = s => `${String(Math.floor(s / 60)).padStart(2, "0")}:${String(s % 60).padStart(2, "0")}`;

        function cargarCancion(indice) {
            indiceActual = indice;
            duracionTotal = pistas[indiceActual].dur;
            
            // Actualizar textos en pantalla
            tituloTexto.textContent = pistas[indiceActual].titulo;
            artistaTexto.textContent = pistas[indiceActual].artista;
            duracionTexto.textContent = fmt(duracionTotal);
            
            // Reiniciar tiempos y barra
            t = 0;
            relleno.style.width = '0%';
            tiempoTexto.textContent = '00:00';
        }

        function cambiarCancion(direccion) {
            let nuevoIndice = indiceActual + direccion;
            
            // Ciclar la lista si llegamos al final o al principio
            if (nuevoIndice < 0) nuevoIndice = pistas.length - 1;
            if (nuevoIndice >= pistas.length) nuevoIndice = 0;
            
            cargarCancion(nuevoIndice);
            
            // Si la canción ya estaba sonando, seguimos reproduciendo la nueva
            if (reproduciendo) {
                clearInterval(timer);
                iniciarTemporizador();
            }
        }

        function iniciarTemporizador() {
            timer = setInterval(() => {
                t++;
                if (t >= duracionTotal) { 
                    cambiarCancion(1); // Auto-siguiente al terminar
                } else {
                    relleno.style.width = `${(t / duracionTotal) * 100}%`;
                    tiempoTexto.textContent = fmt(t);
                }
            }, 1000);
        }

        // Eventos para cambiar de canción manualmente
        btnPrev.addEventListener('click', () => cambiarCancion(-1));
        btnNext.addEventListener('click', () => cambiarCancion(1));

        btnPlay.addEventListener('click', () => {
            reproduciendo = !reproduciendo;
            
            if (reproduciendo) {
                iconoPlay.classList.add('hidden');
                iconoPausa.classList.remove('hidden');
                btnPlay.setAttribute('aria-label', 'Pausar');
                iniciarTemporizador();
            } else {
                iconoPausa.classList.add('hidden');
                iconoPlay.classList.remove('hidden');
                btnPlay.setAttribute('aria-label', 'Reproducir');
                clearInterval(timer);
            }
        });
    </script>
</body>
</html>