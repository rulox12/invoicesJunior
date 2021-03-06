<?php

namespace Tests\Feature\Sellers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateSellersTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function an_registered_user_can_see_the_create_seller_view()
    {
        $this->actingAs($this->createSuperAdminUser())
            ->get(route('sellers.create'))
            ->assertStatus(200);
    }

    /** @test * */
    public function an_user_without_logging_in_cannot_see_the_create_seller_view()
    {
        $this->get(route('sellers.create'))
            ->assertStatus(302);
    }
}
