<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCustomersTest extends TestCase
{
    use RefreshDatabase;

    private function newCustomer()
    {
        return [
            'name' => substr($this->faker->firstName, 0, 20),
            'surname' => substr($this->faker->lastName, 0, 20),
            'type_document' => substr($this->faker->lastName, 0, 2),
            'document' => $this->faker->numberBetween($min = 100000, $max = 9000000),
            'state' => $this->faker->boolean,
        ];
    }

    /** @test * */
    public function unauthenticated_user_cannot_update_a_customer()
    {
        $customer = factory(Customer::class)->create();

        $response = $this
            ->patch(
                route('customers.update', $customer),
                [
                    'name' => 'New customer name',
                    'slug' => 'new_customer_name',
                ]
            );

        $response->assertStatus(302);
    }

    /** @test * */
    public function admin_users_can_update_a_customer()
    {
        $user = $this->defaultUser();
        $name = "new name";
        $surname = "surname";
        $type_document = "CC";
        $document = "11212121";

        $data = [
            'name' => $name,
            'surname' => $surname,
            'type_document' => $type_document,
            'document' => $document
        ];

        $customer = factory(Customer::class)->create();

        $response = $this->actingAs($user)
            ->patch(route('customers.update', $customer), $data)
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $customerUpdate = Customer::latest()->first();

        $this->assertEquals($customerUpdate->name, $name);
        $this->assertEquals($customerUpdate->surname, $surname);
        $this->assertEquals($customerUpdate->type_document, $type_document);
        $this->assertEquals($customerUpdate->document, $document);
    }

    /** @test * */
    public function admin_users_can_update_state_a_customer_active()
    {
        $user = $this->defaultUser();

        $customer = factory(Customer::class)->create(['state' => true]);

        $response = $this->actingAs($user)
            ->get(route('customers.toggle', $customer))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $customerUpdate = Customer::latest()->first();

        $this->assertEquals($customerUpdate->state, false);
    }

    /** @test * */
    public function admin_users_can_update_state_a_customer_inactive()
    {
        $user = $this->defaultUser();

        $customer = factory(Customer::class)->create(['state' => false]);

        $response = $this->actingAs($user)
            ->get(route('customers.toggle', $customer))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $customerUpdate = Customer::latest()->first();

        $this->assertEquals($customerUpdate->state, true);
    }
}
