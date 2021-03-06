<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexCustomerApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_super_administrator_can_see_all_clients()
    {
        $this->API();

        $customer = factory(Customer::class)->create();

        $this->json('GET', 'api/customer-api', [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    [
                        "id" => $customer->id,
                        "name" => $customer->name,
                        "surname" => $customer->surname,
                        "type_document" => $customer->type_document,
                        "document" => $customer->document,
                        "state" => $customer->state
                    ]
                ],
                "message" => "Customer retrieved successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_list_permissions_can_not_see_the_create_customer()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $this->artisan('passport:install');

        $this->json('GET', 'api/customer-api', [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }
}
