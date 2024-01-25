<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Ticket;

use App\Models\Route;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketTest extends TestCase
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
    public function it_gets_tickets_list(): void
    {
        $tickets = Ticket::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tickets.index'));

        $response->assertOk()->assertSee($tickets[0]->ticket_number);
    }

    /**
     * @test
     */
    public function it_stores_the_ticket(): void
    {
        $data = Ticket::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tickets.store'), $data);

        $this->assertDatabaseHas('tickets', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_ticket(): void
    {
        $ticket = Ticket::factory()->create();

        $route = Route::factory()->create();
        $user = User::factory()->create();

        $data = [
            'ticket_number' => $this->faker->text(255),
            'customer_name' => $this->faker->text(255),
            'route_id' => $route->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(route('api.tickets.update', $ticket), $data);

        $data['id'] = $ticket->id;

        $this->assertDatabaseHas('tickets', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_ticket(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->deleteJson(route('api.tickets.destroy', $ticket));

        $this->assertModelMissing($ticket);

        $response->assertNoContent();
    }
}
