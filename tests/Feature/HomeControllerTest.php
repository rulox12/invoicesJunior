<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_can_list_customers()
    {
        $user = $this->defaultUser();

        $response = $this->actingAs($user)
            ->get(route('home.index'))
            ->assertSuccessful();

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }
}
