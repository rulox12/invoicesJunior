<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditRolesTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test * */
    public function users_can_edit_roles()
    {
        $user = $this->createSuperAdminUser();

        $role = factory(Role::class)->create();

        $response = $this->actingAs($user)
            ->get(route('roles.edit', $role))
            ->assertSuccessful();

        $getDataSeller = $response->original->getData()['role'];

        $this->assertEquals($role->id, $getDataSeller->id);
        $this->assertEquals($role->name, $getDataSeller->name);
        $this->assertEquals($role->description, $getDataSeller->description);
    }

    /** @test * */
    public function users_unregister_can_not_edit_sellers()
    {
        $role = factory(Role::class)->create();

        $this
            ->get(route('roles.edit', $role))
            ->assertStatus(302);
    }
}
