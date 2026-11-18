@extends('layouts.app')

@section('titulo', 'Inicio · Sonora')

@section('contenido')
<script>window.pistas = @json($pistas);</script>

<div class="grid h-screen grid-cols-[200px_1fr] grid-rows-[1fr_80px]">

    {{-- Navegación lateral --}}
    <nav class="flex flex-col gap-2 bg-surface-raised px-4 py-6" aria-label="Principal">
        <div class="mb-6 flex items-center gap-2 text-xl font-extrabold">
            <svg class="size-7 text-accent" viewBox="0 0 64 64" aria-hidden="true"><g fill="currentColor"><rect x="4" y="32" width="8" height="28" rx="4"/><rect x="16" y="12" width="8" height="48" rx="4"/><rect x="28" y="24" width="8" height="36" rx="4"/><rect x="40" y="4" width="8" height="56" rx="4"/><rect x="52" y="36" width="8" height="24" rx="4"/></g></svg>
            Sonora
        </div>
        <a href="/" aria-current="page" class="flex items-center gap-3 rounded-md bg-surface-high p-3 text-sm font-bold"><x-icon name="home" /> Inicio</a>
        <a href="/buscar" class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high"><x-icon name="search" /> Buscar</a>
        <a href="/biblioteca" class="flex items-center gap-3 rounded-md p-3 text-sm font-bold text-ink-muted hover:bg-surface-high"><x-icon name="library" /> Tu biblioteca</a>
        <x-button variant="ghost" id="tema" class="mt-auto">Cambiar tema</x-button>
    </nav>

    {{-- Contenido --}}
    <main class="overflow-y-auto px-8 py-6">
        <div class="mb-6 flex gap-2">
            <x-chip :activo="true">Todo</x-chip>
            <x-chip>Música</x-chip>
            <x-chip>Podcasts</x-chip>
        </div>

        <h1 class="mb-4 text-3xl font-extrabold tracking-tight">Buenas tardes</h1>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($playlists as $i => $p)
                <a href="/playlist/{{ $i }}" class="block rounded-md focus-visible:outline-[3px] focus-visible:outline-offset-2 focus-visible:outline-focus">
                    <x-media-card :titulo="$p['titulo']" :artista="$p['artista']" :duracion="$p['duracion']" :barras="$p['barras']" />
                </a>
            @endforeach
        </div>

        <h2 class="mb-4 mt-8 text-xl font-bold">En cola</h2>
        <div class="max-w-md rounded-md bg-surface-raised p-2">
            @foreach ($pistas as $i => $pista)
                <x-song-row :indice="$i" :pista="$pista" :actual="$i === 0" />
            @endforeach
        </div>
    </main>

    {{-- Barra del reproductor (simulado) --}}
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