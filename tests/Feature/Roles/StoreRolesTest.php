<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class StoreRolesTest extends TestCase
{
    use RefreshDatabase;

    private function newRole()
    {
        return [
            'name' => substr($this->faker->firstName, 0, 20),
            'description' => substr($this->faker->lastName, 0, 20),
            'permission' => [
                '0' => $role = factory(Permission::class)->create()->id
            ]
        ];
    }

    /** @test * */
    public function save_a_role_with_a_logged_in_user()
    {
        $response = $this->actingAs($this->createSuperAdminUser())
            ->post(
                route('roles.store'),
                $this->newRole()
            )
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test * */
    public function save_a_role_with_a_unregister_user()
    {
        $this
            ->post(
                route('roles.store'),
                $this->newRole()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test * */
    public function save_an_role_without_data()
    {
        $data = [];

        $this->actingAs($this->createSuperAdminUser())
            ->post(
                route('roles.store'),
                $data
            )
            ->assertSessionHasErrors()
            ->assertStatus(302);
    }
}
