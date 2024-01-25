<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Diver;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DiverTest extends TestCase
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
    public function it_gets_divers_list(): void
    {
        $divers = Diver::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.divers.index'));

        $response->assertOk()->assertSee($divers[0]->full_name);
    }

    /**
     * @test
     */
    public function it_stores_the_diver(): void
    {
        $data = Diver::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.divers.store'), $data);

        $this->assertDatabaseHas('divers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.divers.update', $diver), $data);

        $data['id'] = $diver->id;

        $this->assertDatabaseHas('divers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_diver(): void
    {
        $diver = Diver::factory()->create();

        $response = $this->deleteJson(route('api.divers.destroy', $diver));

        $this->assertModelMissing($diver);

        $response->assertNoContent();
    }
}
