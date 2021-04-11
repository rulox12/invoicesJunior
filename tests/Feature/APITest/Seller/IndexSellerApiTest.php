<?php

namespace Tests\Feature\Customers;

use App\Entities\Seller;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexSellerApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_super_administrator_can_see_all_seller()
    {
        $this->API();

        $seller = factory(Seller::class)->create();

        $this->json('GET', 'api/seller-api', [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    [
                        "id" => $seller->id,
                        "name" => $seller->name,
                        "surname" => $seller->surname,
                        "type_document" => $seller->type_document,
                        "document" => $seller->document,
                        "state" => $seller->state
                    ]
                ],
                "message" => "Seller retrieved successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_list_permissions_can_not_see_the_create_seller()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $this->artisan('passport:install');

        $this->json('GET', 'api/seller-api', [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }
}
