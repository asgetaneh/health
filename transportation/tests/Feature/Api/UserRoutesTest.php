<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Route;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoutesTest extends TestCase
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
    public function it_gets_user_routes(): void
    {
        $user = User::factory()->create();
        $routes = Route::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.routes.index', $user));

        $response->assertOk()->assertSee($routes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_user_routes(): void
    {
        $user = User::factory()->create();
        $data = Route::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.routes.store', $user),
            $data
        );

        $this->assertDatabaseHas('routes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $route = Route::latest('id')->first();

        $this->assertEquals($user->id, $route->user_id);
    }
}
