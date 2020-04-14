<?php

namespace Tests\Feature\Customers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCustomerApiTest extends TestCase
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
    public function an_super_admin_can_create_a_customer()
    {
        $this->API();

        $this->json('POST', 'api/customer-api', $this->newCustomer(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "Customer created successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_create_permissions_can_not_see_the_create_customer()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $this->artisan('passport:install');

        $this->json('POST', 'api/customer-api', $this->newCustomer(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function a_super_administrator_cannot_create_a_customer_without_a_surname()
    {
        $this->API();

        $data = [
            'name' => substr($this->faker->firstName, 0, 20),
            'type_document' => substr($this->faker->lastName, 0, 2),
            'document' => $this->faker->numberBetween($min = 100000, $max = 9000000),
            'state' => $this->faker->boolean,
        ];

        $this->json('POST', 'api/customer-api', $data, $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Validation Error.",
            ]);
    }
}
