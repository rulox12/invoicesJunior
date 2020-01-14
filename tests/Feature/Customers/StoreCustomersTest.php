<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreCustomersTest extends TestCase
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

    /** @test **/
    public function save_a_customer_with_a_logged_in_user()
    {
        $this->actingAs($this->defaultUser())
            ->post(
                route('customers.store'),
                $this->newCustomer()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_a_customer_with_a_unregister_user()
    {
        $this
            ->post(
                route('customers.store'),
                $this->newCustomer()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_an_customer_without_data()
    {
        $data = [];

        $this->actingAs($this->defaultUser())
            ->post(
                route('customers.store'),
                $data
            )
            ->assertSessionHasErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function saves_user_who_was_created_that_customer()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post(
                route('customers.store'),
                $this->newCustomer()
            );

        $customer = Customer::latest()->first();

        $this->assertEquals($user->id, $customer->created_by);
    }
}
