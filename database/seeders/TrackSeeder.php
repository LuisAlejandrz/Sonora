<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \Illuminate\Support\Facades\DB::table('tracks')->insert([
        ['titulo' => 'Noches de lluvia', 'artista' => 'Mar Abierto', 'duracion' => 258],
        ['titulo' => 'Hora azul', 'artista' => 'Luz de Norte', 'duracion' => 232],
        ['titulo' => 'Caminos', 'artista' => 'Valle Sereno', 'duracion' => 195],
        ['titulo' => 'Amanecer', 'artista' => 'Luz de Norte', 'duracion' => 210],
        ['titulo' => 'Ecos', 'artista' => 'Mar Abierto', 'duracion' => 180],
        ['titulo' => 'Vientos', 'artista' => 'Valle Sereno', 'duracion' => 220],
        ['titulo' => 'Estrellas', 'artista' => 'Luz de Norte', 'duracion' => 240],
        ['titulo' => 'Mareas', 'artista' => 'Mar Abierto', 'duracion' => 205],
    ]);
}
}
