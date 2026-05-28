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
                'user_id' => 1,
                'artist_id' => 2,
                'total_amount' => 29.98,
                'status' => 'completed',
            ],
            [
                'user_id' => 2,
                'artist_id' => 1,
                'total_amount' => 15.99,
                'status' => 'pending',
            ],
            // Voeg hier meer orders toe indien nodig
        ];

        Order::insert($orders);
    }
}
