<?php

namespace Tests\Feature\Customers;

use App\Entities\Seller;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowSellerApiTest extends TestCase
{
    use RefreshDatabase;


    /** @test * */
    public function a_super_administrator_can_see_a_seller()
    {
        $this->API();

        $seller = factory(Seller::class)->create();


        $this->json('GET', 'api/seller-api/' . $seller->id, [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    "id" => $seller->id,
                    "name" => $seller->name,
                    "surname" => $seller->surname,
                    "type_document" => $seller->type_document,
                    "document" => $seller->document,
                    "state" => $seller->state
                ],
                "message" => "Seller retrieved successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_list_permissions_can_not_see_the_see_to_seller()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $seller = factory(Seller::class)->create();

        $this->artisan('passport:install');


        $this->json('GET', 'api/seller-api/' . $seller->id, [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function customer_no_found()
    {
        $this->API();

        $seller = factory(Seller::class)->create();

        $this->artisan('passport:install');

        $this->json('GET', 'api/seller-api/' . 80000, [], $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Seller not found."
            ]);
    }
}
