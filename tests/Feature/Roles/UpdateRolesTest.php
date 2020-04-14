<?php

namespace Tests\Feature\Sellers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateRolesTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function unauthenticated_user_cannot_update_a_role()
    {
        $role = factory(Role::class)->create();

        $response = $this
            ->patch(
                route('roles.update', $role),
                [
                    'name' => 'New role name',
                ]
            );

        $response->assertStatus(302);
    }

    /** @test * */
    public function admin_users_can_update_a_invoice()
    {
        $user = $this->createSuperAdminUser();
        $name = "new name";
        $description = "new description";


        $data =[
            'name' => $name,
            'description' => $description,
            'permission' => [
                '0' => factory(Permission::class)->create()->id
            ]
        ];

        $role = factory(Role::class)->create();

        $this->actingAs($user)
            ->patch(route('roles.update', $role), $data)
            ->assertRedirect()
            ->assertSessionHasNoErrors();
    }
}
