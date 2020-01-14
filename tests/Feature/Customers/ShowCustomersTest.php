<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class ShowCustomersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function a_logged_in_user_can_see_a_customer()
    {
        $user = $this->defaultUser();

        $customer = factory(Customer::class)->create();

        $response = $this->actingAs($user)
            ->get(
                route('customers.show', $customer)
            )
            ->assertSuccessful();

        $customerResponse = $response->original->getData()['customer'];
        $this->assertEquals($customerResponse->name, $customer->name);
        $this->assertEquals($customerResponse->slug, $customer->slug);
        $this->assertEquals($customerResponse->locale, $customer->locale);
        $this->assertEquals($customerResponse->country, $customer->country);
    }

    /** @test **/
    public function a_unregister_user_can_not_see_a_customer()
    {
        $customer = factory(Customer::class)->create();

        $response = $this
            ->get(
                route('customers.show', $customer)
            )
            ->assertStatus(302);

        $customerResponse = $response->original;

        $this->assertTrue(is_null($customerResponse));
    }
}
