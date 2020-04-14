<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class IndexCustomersTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function user_login_can_list_customers()
    {
        $user = $this->createSuperAdminUser();

        $customerA = factory(Customer::class)->create();
        $customerB = factory(Customer::class)->create();
        $customerC = factory(Customer::class)->create();

        $response = $this->actingAs($user)
            ->get(route('customers.index'))
            ->assertSuccessful();

        $customers = $response->original->getData()['customers'];

        $this->assertTrue($customers->contains($customerA));
        $this->assertTrue($customers->contains($customerB));
        $this->assertTrue($customers->contains($customerC));
    }

    /** @test **/
    public function a_user_who_is_not_registered_cannot_customers()
    {
        factory(Customer::class, 3)->create();

        $response = $this
            ->get(route('customers.index'))
            ->assertStatus(302);
        $this->assertTrue(is_null($response->original));
    }

    /** @test * */
    public function a_user_register_can_filter_customer_for_name()
    {
        $user = $this->createSuperAdminUser();

        $name = "Unique_name";

        $customer = factory(Customer::class)->create(['name' => $name]);
        factory(Customer::class, 3)->create();


        $response = $this->actingAs($user)
            ->get('/customers?type=name&value='.$name);


        $customers = $response->original->getData()['customers'];
        $this->assertEquals($name, $customers[0]->name);
        $this->assertEquals(1, sizeof($customers));
    }

    /** @test * */
    public function a_user_register_can_filter_customer_for_state()
    {
        $user = $this->createSuperAdminUser();

        $state = true;

        factory(Customer::class)->create(['state' => $state]);


        $response = $this->actingAs($user)
            ->get('/customers?type=state&value='.'true');


        $customers = $response->original->getData()['customers'];
        $this->assertEquals($state, $customers[0]->state);
    }
}
