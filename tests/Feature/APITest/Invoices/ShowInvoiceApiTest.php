<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowInvoiceApiTest extends TestCase
{
    use RefreshDatabase;


    /** @test * */
    public function a_super_administrator_can_see_a_invoice()
    {
        $this->API();

        $invoice = factory(Invoice::class)->create();


        $this->json('GET', 'api/invoices-api/' . $invoice->id, [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "Invoice retrieved successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_list_permissions_can_not_see_the_see_to_invoice()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $invoice = factory(Invoice::class)->create();

        $this->artisan('passport:install');


        $this->json('GET', 'api/invoices-api/' . $invoice->id, [], $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function invoice_no_found()
    {
        $this->API();

        $invoice = factory(Customer::class)->create();

        $this->artisan('passport:install');

        $this->json('GET', 'api/invoices-api/' . 1000000, [], $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Invoice not found."
            ]);
    }
}
