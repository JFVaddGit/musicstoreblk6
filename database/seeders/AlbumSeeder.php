<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Album;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $albums = [
            [
                'title' => 'Jörmies Magnum Opus',
                'artist_id' => 1,
                'genre_id' => 1,
                'user_id' => 1,
                'release_year' => '2026-11-19',
                'label' => 'Label A',
                'price' => 67.69,
                'stock' => 42,
            ],
            [
                'title' => 'God of KFC',
                'artist_id' => 2,
                'genre_id' => 2,
                'user_id' => 1,
                'release_year' => '2019-01-01',
                'label' => 'Label B',
                'price' => 12.99,
                'stock' => 50,
            ],
            // Voeg hier meer albums toe indien nodig
        ];

        Album::insert($albums);
    }
}
