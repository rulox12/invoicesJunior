<?php

namespace Tests\Feature\Invoices;

use App\Entities\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class ShowInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function a_logged_in_user_can_see_a_invoice()
    {
        $user = $this->defaultUser();

        $invoice = factory(Invoice::class)->create();

        $response = $this->actingAs($user)
            ->get(
                route('invoices.show', $invoice)
            )
            ->assertSuccessful();

        $getData =$response->original->getData()['invoice'];

        $this->assertEquals($invoice->id, $getData->id);
        $this->assertEquals($invoice->due_date, $getData->due_date);
        $this->assertEquals($invoice->expiration_date, $getData->expiration_date);
    }

    /** @test **/
    public function a_unregister_user_can_not_see_a_invoice()
    {
        $invoice = factory(Invoice::class)->create();

        $response = $this
            ->get(
                route('invoices.show', $invoice)
            )
            ->assertStatus(302);

        $invoiceResponse = $response->original;

        $this->assertTrue(is_null($invoiceResponse));
    }
}
