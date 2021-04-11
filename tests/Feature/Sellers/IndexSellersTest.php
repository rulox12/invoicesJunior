<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class IndexSellersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test **/
    public function users_can_list_sellers()
    {
        $user = $this->createSuperAdminUser();

        $sellerA = factory(Seller::class)->create();
        $sellerB = factory(Seller::class)->create();
        $sellerC = factory(Seller::class)->create();

        $response = $this->actingAs($user)
            ->get(route('sellers.index'))
            ->assertSuccessful();

        $sellers = $response->original->getData()['sellers'];

        $this->assertTrue($sellers->contains($sellerA));
        $this->assertTrue($sellers->contains($sellerB));
        $this->assertTrue($sellers->contains($sellerC));
    }

    /** @test **/
    public function a_user_who_is_not_registered_cannot_sellers()
    {
        factory(Seller::class, 3)->create();

        $response = $this
            ->get(route('sellers.index'))
            ->assertStatus(302);
        $this->assertTrue(is_null($response->original));
    }

    /** @test * */
    public function a_user_register_can_filter_seller_for_name()
    {
        $user = $this->createSuperAdminUser();

        $name = "Unique_name";

        $seller = factory(Seller::class)->create(['name' => $name]);
        factory(Seller::class, 3)->create();


        $response = $this->actingAs($user)
            ->get('/sellers?type=name&value='.$name);


        $sellers = $response->original->getData()['sellers'];
        $this->assertEquals($name, $sellers[0]->name);
        $this->assertEquals(1, sizeof($sellers));
    }

    /** @test * */
    public function a_user_register_can_filter_seller_for_state()
    {
        $user = $this->createSuperAdminUser();

        $state = true;

        factory(Seller::class)->create(['state' => $state]);


        $response = $this->actingAs($user)
            ->get('/sellers?type=state&value='.'true');


        $sellers = $response->original->getData()['sellers'];
        $this->assertEquals($state, $sellers[0]->state);
    }
}
