<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndexRolesTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function users_can_list_roles()
    {
        $user = $this->createSuperAdminUser();

        $roleA = factory(Role::class)->create();
        $roleB = factory(Role::class)->create();
        $roleC = factory(Role::class)->create();

        $response = $this->actingAs($user)
            ->get(route('roles.index'))
            ->assertSuccessful();

        $sellers = $response->original->getData()['roles'];

        $this->assertTrue($sellers->contains($roleA));
        $this->assertTrue($sellers->contains($roleB));
        $this->assertTrue($sellers->contains($roleC));
    }

    /** @test **/
    public function a_user_who_is_not_registered_cannot_roles()
    {
        factory(Role::class, 3)->create();

        $response = $this
            ->get(route('roles.index'))
            ->assertStatus(302);
        $this->assertTrue(is_null($response->original));
    }
}
