@extends('layouts.app')

@section('titulo', 'Tu biblioteca · Sonora')

@section('contenido')
<script>window.pistas = @json($pistas);</script>

<div class="grid h-screen grid-cols-[200px_1fr] grid-rows-[1fr_80px]">

    {{-- Navegación lateral --}}
    <nav class="flex flex-col gap-2 bg-surface-raised px-4 py-6" aria-label="Principal">
        <div class="mb-6 flex items-center gap-2 text-xl font-extrabold">
            <svg class="size-7 text-accent" viewBox="0 0 64 64" aria-hidden="true"><g fill="currentColor"><rect x="4" y="32" width="8" height="28" rx="4"/><rect x="16" y="12" width="8" height="48" rx="4"/><rect x="28" y="24" width="8" height="36" rx="4"/><rect x="40" y="4" width="8" height="56" rx="4"/><rect x="52" y="36" width="8" height="24" rx="4"/></g></svg>
            Sonora
        </div>
        <a href="/" class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high"><x-icon name="home" /> Inicio</a>
        <a href="/buscar" class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high"><x-icon name="search" /> Buscar</a>
        <a href="/biblioteca" aria-current="page" class="flex items-center gap-3 rounded-md bg-surface-high p-3 text-sm font-bold"><x-icon name="library" /> Tu biblioteca</a>
        <x-button variant="ghost" id="tema" class="mt-auto">Cambiar tema</x-button>
    </nav>

    {{-- Contenido de Tu Biblioteca --}}
    <main class="overflow-y-auto px-8 py-6">
        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-3xl font-extrabold tracking-tight">Tu biblioteca</h1>
            <span class="rounded-pill bg-surface-raised px-4 py-1.5 text-xs font-bold text-ink-muted">
                {{ count($playlists) }} playlists · {{ count($pistas) }} canciones
            </span>
        </div>

        <h2 class="mb-4 text-xl font-bold">Tus playlists guardadas</h2>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($playlists as $i => $p)
                <a href="/playlist/{{ $i }}" class="block rounded-md focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                    <x-media-card :titulo="$p['titulo']" :artista="$p['artista']" :duracion="$p['duracion']" :barras="$p['barras']" />
                </a>
            @endforeach
        </div>

        <h2 class="mb-4 mt-8 text-xl font-bold">Canciones que te gustan</h2>
        <div class="max-w-2xl rounded-md bg-surface-raised p-2">
            @foreach ($pistas as $i => $pista)
                <a href="/reproductor/{{ $i }}" class="block rounded-md focus-visible:outline-none focus-visible:ring-[3px] focus-visible:ring-focus">
                    <x-song-row :indice="$i" :pista="$pista" />
                </a>
            @endforeach
        </div>
    </main>

    {{-- Barra del reproductor inferior --}}
    <div class="col-span-2 grid grid-cols-[1fr_2fr_1fr] items-center border-t border-line bg-surface-raised px-4">
        <div>
            <p id="titulo" class="text-sm font-bold"></p>
            <p id="artista" class="text-xs font-medium text-ink-muted"></p>
        </div>
        <div class="flex flex-col items-center gap-2">
            <div class="flex items-center gap-6">
                <button type="button" data-accion="anterior" aria-label="Anterior" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-focus"><x-icon name="prev" /></button>
                <button type="button" data-accion="alternar" aria-label="Reproducir"
                    class="flex size-10 items-center justify-center rounded-pill bg-accent text-on-accent hover:bg-accent-hover focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                    <x-icon name="play" id="icono-play" />
                    <x-icon name="pause" id="icono-pausa" class="hidden" />
                </button>
                <button type="button" data-accion="siguiente" aria-label="Siguiente" class="rounded-pill focus-visible:outline-[3px] focus-visible:outline-focus"><x-icon name="next" /></button>
            </div>
            <div class="flex w-full items-center gap-2 font-mono text-xs text-ink-muted">
                <span id="tiempo">00:00</span>
                <div class="h-1 flex-1 rounded-pill bg-surface-high" role="slider" aria-label="Progreso" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" id="barra">
                    <div id="relleno" class="h-1 rounded-pill bg-accent" style="width: 0%"></div>
                </div>
                <span id="duracion">00:00</span>
            </div>
        </div>
        <div></div>
    </div>
</div>
@endsection