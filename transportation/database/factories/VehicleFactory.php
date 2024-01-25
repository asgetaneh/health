<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'plante_number' => $this->faker->randomNumber(),
            'level' => $this->faker->randomNumber(),
            'total_seats' => $this->faker->randomNumber(0),
            'description' => $this->faker->sentence(15),
            'diver_id' => \App\Models\Diver::factory(),
        ];
    }
}
