<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Track;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tracks = [
            [
                'title' => 'Track 1',
                'duration' => 210,
                'album_id' => 1,
            ],
            [
                'title' => 'Track 2',
                'duration' => 185,
                'album_id' => 1,
            ],
            [
                'title' => 'Track 3',
                'duration' => 240,
                'album_id' => 2,
            ],
            // Voeg hier meer tracks toe indien nodig
        ];

        Track::insert($tracks);
    }
}
