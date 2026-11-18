<?php

use Illuminate\Support\Facades\Route;
use App\Models\Track;
use App\Models\Playlist;

$obtenerPistas = function () {
    return Track::all()->map(function ($track) {
        return [
            'titulo'  => $track->titulo,
            'artista' => $track->artista,
            'dur'     => $track->duracion ?? $track->dur,
        ];
    })->toArray();
};

Route::get('/', function () use ($obtenerPistas) {
    $pistas = $obtenerPistas();
    $playlists = Playlist::all()->toArray();

    return view('inicio', compact('pistas', 'playlists'));
});

Route::get('/playlist/{id?}', function ($id = 0) use ($obtenerPistas) {
    $todasLasPlaylists = Playlist::all()->toArray();
    $playlist = $todasLasPlaylists[$id] ?? $todasLasPlaylists[0];
    $pistas = $obtenerPistas();

    return view('playlist', compact('playlist', 'pistas'));
});

Route::get('/reproductor/{indice?}', function ($indice = 0) use ($obtenerPistas) {
    $pistas = $obtenerPistas();
    if (!isset($pistas[$indice])) {
        $indice = 0;
    }

    return view('reproductor', compact('pistas', 'indice'));
});

Route::get('/buscar', function () use ($obtenerPistas) {
    $pistas = $obtenerPistas();

    return view('buscar', compact('pistas'));
});

Route::get('/biblioteca', function () use ($obtenerPistas) {
    $pistas = $obtenerPistas();
    $playlists = Playlist::all()->toArray();

    return view('biblioteca', compact('pistas', 'playlists'));
});