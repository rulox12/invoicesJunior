<?php

namespace Tests\Feature\Invoices;

use App\Entities\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class EditInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function users_can_edit_invoices()
    {
        $user = $this->createSuperAdminUser();

        $invoice = factory(Invoice::class)->create();

        $response = $this->actingAs($user)
            ->get(route('invoices.edit', $invoice))
            ->assertSuccessful();

        $getData =$response->original->getData()['invoice'];

        $this->assertEquals($invoice->id, $getData->id);
        $this->assertEquals($invoice->due_date, $getData->due_date);
        $this->assertEquals($invoice->expiration_date, $getData->expiration_date);
    }

    /** @test **/
    public function users_can_edit_status_invoices()
    {
        $user = $this->createSuperAdminUser();

        $invoice = factory(Invoice::class)->create();

        $response = $this->actingAs($user)
            ->get(route('invoices.edit.status', $invoice))
            ->assertSuccessful();

        $getData =$response->original->getData()['invoice'];

        $this->assertEquals($invoice->id, $getData->id);
        $this->assertEquals($invoice->due_date, $getData->due_date);
        $this->assertEquals($invoice->expiration_date, $getData->expiration_date);
    }

    /** @test **/
    public function users_unregister_can_not_edit_invoices()
    {
        $invoice = factory(Invoice::class)->create();

        $this
            ->get(route('invoices.edit', $invoice))
            ->assertStatus(302);
    }
}
