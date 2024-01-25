<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Route;
use App\Models\StationOrTown;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationOrTownRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_station_or_town_routes(): void
    {
        $stationOrTown = StationOrTown::factory()->create();
        $routes = Route::factory()
            ->count(2)
            ->create([
                'arrival_station' => $stationOrTown->id,
            ]);

        $response = $this->getJson(
            route('api.station-or-towns.routes.index', $stationOrTown)
        );

        $response->assertOk()->assertSee($routes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_station_or_town_routes(): void
    {
        $stationOrTown = StationOrTown::factory()->create();
        $data = Route::factory()
            ->make([
                'arrival_station' => $stationOrTown->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.station-or-towns.routes.store', $stationOrTown),
            $data
        );

        $this->assertDatabaseHas('routes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $route = Route::latest('id')->first();

        $this->assertEquals($stationOrTown->id, $route->arrival_station);
    }
}
