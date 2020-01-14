<?php

namespace Tests\Feature\Invoices;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class UpdateInvoicesTest extends TestCase
{
    use RefreshDatabase;

    private function newInvoice()
    {
        $total = $this->faker->numberBetween($min = 1000, $max = 9000000);
        $states = Config::get('invoices.state');

        return [
            'due_date' => Carbon::now('America/Bogota')->addHours('2'),
            'tax' => $total * 0.16,
            'description' => substr($this->faker->firstName, 0, 100),
            'total' => $total,
            'type' => substr($this->faker->firstName, 0, 10),
            'customer_id' => factory(Customer::class)->create()->id,
            'seller_id' => factory(Seller::class)->create()->id,
            'state' => $states[array_rand($states, 1)],
        ];
    }

    /** @test * */
    public function unauthenticated_user_cannot_update_a_invoice()
    {
        $invoice = factory(Invoice::class)->create();

        $response = $this
            ->patch(
                route('invoices.update', $invoice),
                [
                    'name' => 'New invoice name',
                    'slug' => 'new_invoice_name',
                ]
            );

        $response->assertStatus(302);
    }

    /** @test * */
    public function admin_users_can_update_a_invoice()
    {
        $user = $this->defaultUser();

        $newInvoice = $this->newInvoice();

        $invoice = factory(Invoice::class)->create();

        $response = $this->actingAs($user)
            ->patch(route('invoices.update', $invoice), $newInvoice)
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $invoiceUpdate = Invoice::latest()->first();

        $this->assertEquals($invoiceUpdate->tax, $newInvoice['tax']);
        $this->assertEquals($invoiceUpdate->total, $newInvoice['total']);
        $this->assertEquals($invoiceUpdate->description, $newInvoice['description']);
        $this->assertEquals($invoiceUpdate->customer_id, $newInvoice['customer_id']);
        $this->assertEquals($invoiceUpdate->seller_id, $newInvoice['seller_id']);
    }

    /** @test * */
    public function admin_users_can_update_status_a_invoice()
    {
        $user = $this->defaultUser();

        $data = ['state' => 'Failed'];

        $invoice = factory(Invoice::class)->create();

        $response = $this->actingAs($user)
            ->patch(route('invoices.update.status', $invoice), $data)
            ->assertSessionHasNoErrors();

        $invoiceUpdate = Invoice::latest()->first();

        $this->assertEquals($invoiceUpdate->state, $data['state']);
    }
}
