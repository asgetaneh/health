<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\StationOrTown;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StationOrTownUsersTest extends TestCase
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
    public function it_gets_station_or_town_users(): void
    {
        $stationOrTown = StationOrTown::factory()->create();
        $users = User::factory()
            ->count(2)
            ->create([
                'stationOrTown_id' => $stationOrTown->id,
            ]);

        $response = $this->getJson(
            route('api.station-or-towns.users.index', $stationOrTown)
        );

        $response->assertOk()->assertSee($users[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_station_or_town_users(): void
    {
        $stationOrTown = StationOrTown::factory()->create();
        $data = User::factory()
            ->make([
                'stationOrTown_id' => $stationOrTown->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.station-or-towns.users.store', $stationOrTown),
            $data
        );

        unset($data['password']);
        unset($data['email_verified_at']);
        unset($data['profile_photo_path']);

        $this->assertDatabaseHas('users', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $user = User::latest('id')->first();

        $this->assertEquals($stationOrTown->id, $user->stationOrTown_id);
    }
}
