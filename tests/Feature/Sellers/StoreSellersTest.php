<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreSellersTest extends TestCase
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

    /** @test **/
    public function save_a_seller_with_a_logged_in_user()
    {
        $this->actingAs($this->defaultUser())
            ->post(
                route('sellers.store'),
                $this->newSeller()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_a_seller_with_a_unregister_user()
    {
        $this
            ->post(
                route('sellers.store'),
                $this->newSeller()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_an_seller_without_data()
    {
        $data = [];

        $this->actingAs($this->defaultUser())
            ->post(
                route('sellers.store'),
                $data
            )
            ->assertSessionHasErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function saves_user_who_was_created_that_seller()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post(
                route('sellers.store'),
                $this->newSeller()
            );

        $seller = Seller::latest()->first();

        $this->assertEquals($user->id, $seller->created_by);
    }
}
