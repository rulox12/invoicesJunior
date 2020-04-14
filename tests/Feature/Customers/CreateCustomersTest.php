<?php

namespace Tests\Feature\Customers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCustomersTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function an_registered_user_can_see_the_create_customer_view()
    {
        $this->actingAs($this->createSuperAdminUser())
            ->get(route('customers.create'))
            ->assertStatus(200);
    }

    /** @test **/
    public function an_user_without_logging_in_cannot_see_the_create_customer_view()
    {
        $this->get(route('customers.create'))
            ->assertStatus(302);
    }
}
