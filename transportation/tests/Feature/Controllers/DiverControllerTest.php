<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Diver;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiverControllerTest extends TestCase
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
    public function it_displays_index_view_with_divers(): void
    {
        $divers = Diver::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('divers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.divers.index')
            ->assertViewHas('divers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_diver(): void
    {
        $response = $this->get(route('divers.create'));

        $response->assertOk()->assertViewIs('app.divers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_diver(): void
    {
        $data = Diver::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('divers.store'), $data);

        $this->assertDatabaseHas('divers', $data);

        $diver = Diver::latest('id')->first();

        $response->assertRedirect(route('divers.edit', $diver));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_diver(): void
    {
        $diver = Diver::factory()->create();

        $response = $this->get(route('divers.show', $diver));

        $response
            ->assertOk()
            ->assertViewIs('app.divers.show')
            ->assertViewHas('diver');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_diver(): void
    {
        $diver = Diver::factory()->create();

        $response = $this->get(route('divers.edit', $diver));

        $response
            ->assertOk()
            ->assertViewIs('app.divers.edit')
            ->assertViewHas('diver');
    }

    /**
     * @test
     */
    public function it_updates_the_diver(): void
    {
        $diver = Diver::factory()->create();

        $data = [
            'full_name' => $this->faker->name(),
            'licence' => $this->faker->text(255),
        ];

        $response = $this->put(route('divers.update', $diver), $data);

        $data['id'] = $diver->id;

        $this->assertDatabaseHas('divers', $data);

        $response->assertRedirect(route('divers.edit', $diver));
    }

    /**
     * @test
     */
    public function it_deletes_the_diver(): void
    {
        $diver = Diver::factory()->create();

        $response = $this->delete(route('divers.destroy', $diver));

        $response->assertRedirect(route('divers.index'));

        $this->assertModelMissing($diver);
    }
}
