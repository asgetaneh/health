<?php

namespace Database\Seeders;

use App\Models\StationOrTown;
use Illuminate\Database\Seeder;

class StationOrTownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StationOrTown::factory()
            ->count(5)
            ->create();
    }
}
