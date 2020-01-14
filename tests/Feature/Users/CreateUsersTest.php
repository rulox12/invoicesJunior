<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function an_registered_user_can_see_the_create_user_view()
    {
        $this->actingAs($this->defaultUser())
            ->get(route('users.create'))
            ->assertStatus(200);
    }

    /** @test * */
    public function an_user_without_logging_in_cannot_see_the_create_user_view()
    {
        $this->get(route('users.create'))
            ->assertStatus(302);
    }
}
