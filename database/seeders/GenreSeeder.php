<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Rock'],
            ['name' => 'Pop'],
            ['name' => 'Jazz'],
            ['name' => 'Classical'],
            ['name' => 'Hip Hop'],
            // Voeg hier meer genres toe indien nodig
        ];

        Genre::insert($genres);
    }
}
