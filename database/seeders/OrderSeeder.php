<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'album_id' => 1,
                'track_id' => 1,
                'artist_id' => 2,
                'total_price' => 29.98,
                'status' => 'completed',
                'order_date' => now()->toDateString(),
            ],
            [
                'album_id' => 2,
                'track_id' => 3,
                'artist_id' => 1,
                'total_price' => 15.99,
                'status' => 'pending',
                'order_date' => now()->toDateString(),
            ],
            // Voeg hier meer orders toe indien nodig
        ];

        Order::insert($orders);
    }
}
