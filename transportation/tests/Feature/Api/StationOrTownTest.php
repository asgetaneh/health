<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StationOrTown;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationOrTownTest extends TestCase
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
    public function it_gets_station_or_towns_list(): void
    {
        $stationOrTowns = StationOrTown::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.station-or-towns.index'));

        $response->assertOk()->assertSee($stationOrTowns[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_station_or_town(): void
    {
        $data = StationOrTown::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.station-or-towns.store'), $data);

        $this->assertDatabaseHas('station_or_towns', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_station_or_town(): void
    {
        $stationOrTown = StationOrTown::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(15),
        ];

        $response = $this->putJson(
            route('api.station-or-towns.update', $stationOrTown),
            $data
        );

        $data['id'] = $stationOrTown->id;

        $this->assertDatabaseHas('station_or_towns', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_station_or_town(): void
    {
        $stationOrTown = StationOrTown::factory()->create();

        $response = $this->deleteJson(
            route('api.station-or-towns.destroy', $stationOrTown)
        );

        $this->assertModelMissing($stationOrTown);

        $response->assertNoContent();
    }
}
