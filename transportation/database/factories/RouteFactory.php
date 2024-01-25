<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Route::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departure_time' => $this->faker->dateTime(),
            'expected_arrival_time' => $this->faker->dateTime(),
            'tariff' => $this->faker->randomNumber(2),
            'service_charge' => $this->faker->randomNumber(2),
            'vehicle_id' => \App\Models\Vehicle::factory(),
            'arrival_station' => \App\Models\StationOrTown::factory(),
            'departure_station' => \App\Models\StationOrTown::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
