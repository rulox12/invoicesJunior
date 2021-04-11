<?php

namespace Tests\Feature\Customers;

use App\Entities\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexInvoiceApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_super_administrator_can_see_all_invoices()
    {
        $this->API();

        factory(Invoice::class)->create();

        $this->json('GET', 'api/invoices-api', [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "Invoice retrieved successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_list_permissions_can_not_see_the_create_invoices()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $this->artisan('passport:install');

        $this->json('GET', 'api/invoices-api', [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }
}
