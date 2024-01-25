<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Ticket;

use App\Models\Route;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketControllerTest extends TestCase
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
    public function it_displays_index_view_with_tickets(): void
    {
        $tickets = Ticket::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tickets.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tickets.index')
            ->assertViewHas('tickets');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_ticket(): void
    {
        $response = $this->get(route('tickets.create'));

        $response->assertOk()->assertViewIs('app.tickets.create');
    }

    /**
     * @test
     */
    public function it_stores_the_ticket(): void
    {
        $data = Ticket::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tickets.store'), $data);

        $this->assertDatabaseHas('tickets', $data);

        $ticket = Ticket::latest('id')->first();

        $response->assertRedirect(route('tickets.edit', $ticket));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_ticket(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get(route('tickets.show', $ticket));

        $response
            ->assertOk()
            ->assertViewIs('app.tickets.show')
            ->assertViewHas('ticket');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_ticket(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->get(route('tickets.edit', $ticket));

        $response
            ->assertOk()
            ->assertViewIs('app.tickets.edit')
            ->assertViewHas('ticket');
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

        $response = $this->put(route('tickets.update', $ticket), $data);

        $data['id'] = $ticket->id;

        $this->assertDatabaseHas('tickets', $data);

        $response->assertRedirect(route('tickets.edit', $ticket));
    }

    /**
     * @test
     */
    public function it_deletes_the_ticket(): void
    {
        $ticket = Ticket::factory()->create();

        $response = $this->delete(route('tickets.destroy', $ticket));

        $response->assertRedirect(route('tickets.index'));

        $this->assertModelMissing($ticket);
    }
}
