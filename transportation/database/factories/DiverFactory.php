<?php

namespace Database\Factories;

use App\Models\Diver;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diver::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'licence' => $this->faker->text(255),
        ];
    }
}
