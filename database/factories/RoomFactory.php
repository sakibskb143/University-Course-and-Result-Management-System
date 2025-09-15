<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition()
    {
        return [
            'room_no' => 'Room ' . $this->faker->unique()->numberBetween(101, 150),
        ];
    }
}
