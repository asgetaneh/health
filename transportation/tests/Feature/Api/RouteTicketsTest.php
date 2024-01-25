<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Route;
use App\Models\Ticket;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTicketsTest extends TestCase
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
    public function it_gets_route_tickets(): void
    {
        $route = Route::factory()->create();
        $tickets = Ticket::factory()
            ->count(2)
            ->create([
                'route_id' => $route->id,
            ]);

        $response = $this->getJson(route('api.routes.tickets.index', $route));

        $response->assertOk()->assertSee($tickets[0]->ticket_number);
    }

    /**
     * @test
     */
    public function it_stores_the_route_tickets(): void
    {
        $route = Route::factory()->create();
        $data = Ticket::factory()
            ->make([
                'route_id' => $route->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.routes.tickets.store', $route),
            $data
        );

        $this->assertDatabaseHas('tickets', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $ticket = Ticket::latest('id')->first();

        $this->assertEquals($route->id, $ticket->route_id);
    }
}
