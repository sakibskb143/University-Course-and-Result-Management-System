<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Seed rooms 601 to 610
        for ($i = 601; $i <= 610; $i++) {
            Room::firstOrCreate(['room_no' => (string)$i]);
        }
    }
}
