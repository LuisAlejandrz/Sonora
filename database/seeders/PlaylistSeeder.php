<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
{
    \Illuminate\Support\Facades\DB::table('playlists')->insert([
        ['titulo' => 'Mezcla diaria 1',  'artista' => 'Para ti',     'descripcion' => 'Tu música favorita, actualizada todos los días.', 'duracion' => '1:12:40', 'barras' => json_encode([40, 70, 55, 90, 35])],
        ['titulo' => 'Noches de lluvia', 'artista' => 'Playlist',    'descripcion' => 'Para escuchar mientras ves llover por la ventana.', 'duracion' => '48:05',   'barras' => json_encode([80, 45, 65, 30, 75])],
        ['titulo' => 'Sin prisa',        'artista' => 'Mar Abierto', 'descripcion' => 'Ritmos lentos y relajantes para desconectar.',     'duracion' => '36:21',   'barras' => json_encode([50, 85, 40, 70, 60])],
        ['titulo' => 'Caminos',          'artista' => 'Playlist',    'descripcion' => 'La mejor compañía para un largo viaje.',          'duracion' => '1:03:12', 'barras' => json_encode([30, 60, 90, 50, 80])],
    ]);
}
}
