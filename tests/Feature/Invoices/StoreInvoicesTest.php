<?php

namespace Tests\Feature\Invoices;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class StoreInvoicesTest extends TestCase
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

    /** @test **/
    public function save_a_invoice_with_a_logged_in_user()
    {
        $this->actingAs($this->createSuperAdminUser())
            ->post(
                route('invoices.store'),
                $this->newInvoice()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_a_invoice_with_a_unregister_user()
    {
        $this
            ->post(
                route('invoices.store'),
                $this->newInvoice()
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function save_an_invoice_without_data()
    {
        $data = [];

        $this->actingAs($this->createSuperAdminUser())
            ->post(
                route('invoices.store'),
                $data
            )
            ->assertSessionHasErrors()
            ->assertStatus(302);
    }

    /** @test **/
    public function saves_user_who_was_created_that_invoice()
    {
        $user = $this->createSuperAdminUser();

        $response = $this
            ->actingAs($user)
            ->post(
                route('invoices.store'),
                $this->newInvoice()
            );

        $invoice = Invoice::latest()->first();
        $this->assertEquals($user->id, $invoice->created_by);
    }

    /** @test **/
    public function a_user_cannot_create_an_invoice_with_an_incorrect_due_date()
    {
        $user = $this->createSuperAdminUser();
        $invoice = $this->newInvoice();
        $invoice['due_date'] = Carbon::now('America/Bogota')->addHours('-2');

        $response = $this
            ->actingAs($user)
            ->post(
                route('invoices.store'),
                $invoice
            )
            ->assertSessionHasErrors();
    }
}
