<?php

namespace Tests\Feature\Sellers;

use App\Entities\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class EditSellersTest extends TestCase
{
    use RefreshDatabase;
    use WithoutEvents;

    /** @test * */
    public function users_can_edit_sellers()
    {
        $user = $this->createSuperAdminUser();

        $seller = factory(Seller::class)->create();

        $response = $this->actingAs($user)
            ->get(route('sellers.edit', $seller))
            ->assertSuccessful();

        $getDataSeller = $response->original->getData()['seller'];

        $this->assertEquals($seller->id, $getDataSeller->id);
        $this->assertEquals($seller->name, $getDataSeller->name);
        $this->assertEquals($seller->surname, $getDataSeller->surname);
    }

    /** @test * */
    public function users_unregister_can_not_edit_sellers()
    {
        $seller = factory(Seller::class)->create();

        $this
            ->get(route('sellers.edit', $seller))
            ->assertStatus(302);
    }
}
