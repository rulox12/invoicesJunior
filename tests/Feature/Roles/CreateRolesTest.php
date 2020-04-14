<?php

namespace Tests\Feature\Sellers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRolesTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function an_registered_user_can_see_the_create_roles_view()
    {
        $this->actingAs($this->createSuperAdminUser())
            ->get(route('roles.create'))
            ->assertStatus(200);
    }

    /** @test * */
    public function an_user_without_logging_in_cannot_see_the_create_role_view()
    {
        $this->get(route('roles.create'))
            ->assertStatus(302);
    }
}
