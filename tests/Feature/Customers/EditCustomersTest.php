<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class EditCustomersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function user_login_can_edit_customers()
    {
        $user = $this->createSuperAdminUser();

        $customer = factory(Customer::class)->create();

        $response = $this->actingAs($user)
            ->get(route('customers.edit', $customer))
            ->assertSuccessful();

        $getData =$response->original->getData();

        $this->assertEquals($customer->id, $getData['customer']->id);
        $this->assertEquals($customer->name, $getData['customer']->name);
        $this->assertEquals($customer->surname, $getData['customer']->surname);
    }

    /** @test **/
    public function users_unregister_can_not_edit_customers()
    {
        $customer = factory(Customer::class)->create();

        $this
            ->get(route('customers.edit', $customer))
            ->assertStatus(302);
    }
}
