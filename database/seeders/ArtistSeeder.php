<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artists = [
            ['name' => 'Micheal Jackson'],
            ['name' => 'Bruno Mars'],
            ['name' => 'Adele'],
            ['name' => 'Taylor Swift'],
            ['name' => 'Ed Sheeran'],
            // Voeg hier meer artiesten toe indien nodig
        ];

        Artist::insert($artists);
    }
}
