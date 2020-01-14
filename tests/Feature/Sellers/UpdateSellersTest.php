<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateSellersTest extends TestCase
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
    public function unauthenticated_user_cannot_update_a_seller()
    {
        $seller = factory(Seller::class)->create();

        $response = $this
            ->patch(
                route('sellers.update', $seller),
                [
                    'name' => 'New seller name',
                    'slug' => 'new_seller_name',
                ]
            );

        $response->assertStatus(302);
    }

    /** @test * */
    public function admin_users_can_update_a_seller()
    {
        $user = $this->defaultUser();
        $name = "new name";
        $surname = "surname";
        $type_document = "CC";
        $document = "11212121";

        $data =[
            'name' => $name,
            'surname' => $surname,
            'type_document' => $type_document,
            'document' => $document
        ];

        $seller = factory(Seller::class)->create();

        $response = $this->actingAs($user)
            ->patch(route('sellers.update', $seller), $data)
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $sellerUpdate = Seller::latest()->first();

        $this->assertEquals($sellerUpdate->name, $name);
        $this->assertEquals($sellerUpdate->surname, $surname);
        $this->assertEquals($sellerUpdate->type_document, $type_document);
        $this->assertEquals($sellerUpdate->document, $document);
    }
    /** @test * */
    public function admin_users_can_update_state_a_seller_active()
    {
        $user = $this->defaultUser();

        $seller = factory(Seller::class)->create(['state' => true]);

        $response = $this->actingAs($user)
            ->get(route('sellers.toggle', $seller))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $sellerUpdate = Seller::latest()->first();

        $this->assertEquals($sellerUpdate->state, false);
    }

    /** @test * */
    public function admin_users_can_update_state_a_seller_inactive()
    {
        $user = $this->defaultUser();

        $seller = factory(Seller::class)->create(['state' => false]);

        $response = $this->actingAs($user)
            ->get(route('sellers.toggle', $seller))
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $sellerUpdate = Seller::latest()->first();

        $this->assertEquals($sellerUpdate->state, true);
    }
}
