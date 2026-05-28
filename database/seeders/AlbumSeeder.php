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
                'title' => 'Album 1',
                'artist_id' => 1,
                'genre_id' => 1,
                'release_year' => '2020-01-01',
                'label' => 'Label A',
                'price' => 9.99,
                'stock' => 100,
            ],
            [
                'title' => 'Album 2',
                'artist_id' => 2,
                'genre_id' => 2,
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
