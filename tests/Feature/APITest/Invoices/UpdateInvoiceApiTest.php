<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class UpdateInvoiceApiTest extends TestCase
{
    use RefreshDatabase;

    private function newInvoice()
    {
        $total = $this->faker->numberBetween($min = 1000, $max = 9000000);
        $states = Config::get('invoices.state');

        return array(
            'due_date' => Carbon::now()->addDays('2')->format('Y-m-d H:i:s'),
            'tax' => $total * 0.16,
            'description' => substr($this->faker->firstName, 0, 100),
            'total' => $total,
            'type' => substr($this->faker->firstName, 0, 10),
            'customer_id' => factory(Customer::class)->create()->id,
            'seller_id' => factory(Seller::class)->create()->id,
            'state' => $states[array_rand($states, 1)],
        );
    }

    /** @test * */
    public function an_super_admin_can_update_a_invoice()
    {
        $this->API();

        $invoice = factory(Invoice::class)->create();


        $data = [
            'tax' => '1500',
            'total' => '40000',
        ];

        $this->json('PUT', 'api/invoices-api/' . $invoice->id, $data, $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "Invoice update successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_update_permissions_can_not_see_the_update_invoice()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $invoice = factory(Invoice::class)->create();

        $this->artisan('passport:install');


        $this->json('PUT', 'api/invoices-api/' . $invoice->id, $this->newInvoice(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function a_super_administrator_cannot_update_a_invoice_without_a_total_valid()
    {
        $this->API();

        $invoice = factory(Invoice::class)->create();

        $data = [

            'total' => '****',
        ];

        $this->json('PUT', 'api/invoices-api/' . $invoice->id, $data, $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Validation Error.",
            ]);
    }
}
