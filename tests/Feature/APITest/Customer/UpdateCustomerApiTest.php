<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateCustomerApiTest extends TestCase
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
    public function an_super_admin_can_update_a_customer()
    {
        $this->API();

        $customer = factory(Customer::class)->create();

        $name = 'new name';
        $surname = 'new surname';

        $data = [
            'name' => $name,
            'surname' => $surname,
        ];

        $this->json('PUT', 'api/customer-api/' . $customer->id, $data, $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    "id" => $customer->id,
                    "name" => $name,
                    "surname" => $surname,
                    "type_document" => $customer->type_document,
                    "document" => $customer->document,
                    "state" => $customer->state
                ],
                "message" => "Customer update successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_update_permissions_can_not_see_the_update_customer()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $customer = factory(Customer::class)->create();

        $this->artisan('passport:install');


        $this->json('PUT', 'api/customer-api/' . $customer->id, $this->newCustomer(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function a_super_administrator_cannot_update_a_customer_without_a_name_valid()
    {
        $this->API();

        $customer = factory(Customer::class)->create();

        $data = [
            'name' => '***',
            'type_document' => substr($this->faker->lastName, 0, 2),
            'document' => $this->faker->numberBetween($min = 100000, $max = 9000000),
            'state' => $this->faker->boolean,
        ];


        $this->json('PUT', 'api/customer-api/' . $customer->id, $data, $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Validation Error.",
            ]);
    }
}
