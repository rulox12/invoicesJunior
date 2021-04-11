<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class ShowSellersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function a_logged_in_user_can_see_a_seller()
    {
        $user = $this->createSuperAdminUser();

        $seller = factory(Seller::class)->create();

        $response = $this->actingAs($user)
            ->get(
                route('sellers.show', $seller)
            )
            ->assertSuccessful();

        $sellerResponse = $response->original->getData()['seller'];
        $this->assertEquals($sellerResponse->name, $seller->name);
        $this->assertEquals($sellerResponse->slug, $seller->slug);
        $this->assertEquals($sellerResponse->locale, $seller->locale);
        $this->assertEquals($sellerResponse->country, $seller->country);
    }

    /** @test **/
    public function a_unregister_user_can_not_see_a_seller()
    {
        $seller = factory(Seller::class)->create();

        $response = $this
            ->get(
                route('sellers.show', $seller)
            )
            ->assertStatus(302);

        $sellerResponse = $response->original;

        $this->assertTrue(is_null($sellerResponse));
    }
}
