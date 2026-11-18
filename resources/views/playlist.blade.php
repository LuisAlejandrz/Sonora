<!DOCTYPE html>
<html lang="es" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $playlist['titulo'] }} - Sonora</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-base text-ink font-sans h-screen flex flex-col">

    <main class="flex-1 overflow-y-auto p-8">
        <!-- Navegación de regreso -->
        <a href="/" class="inline-flex items-center gap-2 text-ink-muted hover:text-ink mb-8 transition">
            <x-icon name="home" class="w-5 h-5" />
            Volver al inicio
        </a>

        <!-- Cabecera -->
        <header class="mb-12">
            <h1 class="text-5xl font-extrabold mb-4">{{ $playlist['titulo'] }}</h1>
            <p class="text-ink-muted text-lg mb-8">{{ $playlist['descripcion'] }}</p>
            
           <a href="/reproductor" class="inline-block focus-visible:outline-none">
                <x-button variant="primary">
                    <x-icon name="play" class="w-5 h-5 inline-block mr-2" />
                    Reproducir
                </x-button>
            </a>

        <!-- Lista de canciones -->
       <!-- Lista de canciones -->
       <section class="flex flex-col gap-2 max-w-4xl">
            @foreach($pistas as $i => $pista)
                <a href="/reproductor/{{ $i }}" class="block focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-focus rounded-md">
                    <x-song-row :indice="$i" :pista="$pista" />
                </a>
            @endforeach
        </section>
    </main>

</body>
</html>