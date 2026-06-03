<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Jordan Admin',
            'firstname' => 'Jordan',
            'lastname' => 'Admin',
            'email' => 'jordan@admin.nl',
            'password' => 'password',
            'role' => 'admin',
        ]);

        // Call all other seeders
        $this->call([
            GenreSeeder::class,
            ArtistSeeder::class,
            AlbumSeeder::class,
            TrackSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
