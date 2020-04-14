<?php

namespace Tests\Feature\Customers;

use App\Entities\Seller;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateSellerApiTest extends TestCase
{
    use RefreshDatabase;

    private function newSeller()
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
    public function an_super_admin_can_update_a_seller()
    {
        $this->API();

        $seller = factory(Seller::class)->create();

        $name = 'new name';
        $surname = 'new surname';

        $data = [
            'name' => $name,
            'surname' => $surname,
        ];

        $this->json('PUT', 'api/seller-api/' . $seller->id, $data, $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "data" => [
                    "id" => $seller->id,
                    "name" => $name,
                    "surname" => $surname,
                    "type_document" => $seller->type_document,
                    "document" => $seller->document,
                    "state" => $seller->state
                ],
                "message" => "Seller update successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_update_permissions_can_not_see_the_update_seller()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $seller = factory(Seller::class)->create();

        $this->artisan('passport:install');


        $this->json('PUT', 'api/seller-api/' . $seller->id, $this->newSeller(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function a_super_administrator_cannot_update_a_seller_without_a_name_valid()
    {
        $this->API();

        $seller = factory(Seller::class)->create();

        $data = [
            'name' => '***',
            'type_document' => substr($this->faker->lastName, 0, 2),
            'document' => $this->faker->numberBetween($min = 100000, $max = 9000000),
            'state' => $this->faker->boolean,
        ];

        $this->json('PUT', 'api/seller-api/' . $seller->id, $data, $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Validation Error.",
            ]);
    }
}
