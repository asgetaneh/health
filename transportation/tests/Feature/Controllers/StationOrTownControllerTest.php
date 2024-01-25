<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\StationOrTown;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationOrTownControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_station_or_towns(): void
    {
        $stationOrTowns = StationOrTown::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('station-or-towns.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.station_or_towns.index')
            ->assertViewHas('stationOrTowns');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_station_or_town(): void
    {
        $response = $this->get(route('station-or-towns.create'));

        $response->assertOk()->assertViewIs('app.station_or_towns.create');
    }

    /**
     * @test
     */
    public function it_stores_the_station_or_town(): void
    {
        $data = StationOrTown::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('station-or-towns.store'), $data);

        $this->assertDatabaseHas('station_or_towns', $data);

        $stationOrTown = StationOrTown::latest('id')->first();

        $response->assertRedirect(
            route('station-or-towns.edit', $stationOrTown)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_station_or_town(): void
    {
        $stationOrTown = StationOrTown::factory()->create();

        $response = $this->get(route('station-or-towns.show', $stationOrTown));

        $response
            ->assertOk()
            ->assertViewIs('app.station_or_towns.show')
            ->assertViewHas('stationOrTown');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_station_or_town(): void
    {
        $stationOrTown = StationOrTown::factory()->create();

        $response = $this->get(route('station-or-towns.edit', $stationOrTown));

        $response
            ->assertOk()
            ->assertViewIs('app.station_or_towns.edit')
            ->assertViewHas('stationOrTown');
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

        $response = $this->put(
            route('station-or-towns.update', $stationOrTown),
            $data
        );

        $data['id'] = $stationOrTown->id;

        $this->assertDatabaseHas('station_or_towns', $data);

        $response->assertRedirect(
            route('station-or-towns.edit', $stationOrTown)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_station_or_town(): void
    {
        $stationOrTown = StationOrTown::factory()->create();

        $response = $this->delete(
            route('station-or-towns.destroy', $stationOrTown)
        );

        $response->assertRedirect(route('station-or-towns.index'));

        $this->assertModelMissing($stationOrTown);
    }
}
