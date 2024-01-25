<?php

namespace Database\Seeders;

use App\Models\Diver;
use Illuminate\Database\Seeder;

class DiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diver::factory()
            ->count(5)
            ->create();
    }
}
