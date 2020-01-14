<?php

namespace Tests\Feature\Invoices;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function an_registered_user_can_see_the_create_invoice_view()
    {
        $this->actingAs($this->defaultUser())
            ->get(route('invoices.create'))
            ->assertStatus(200);
    }

    /** @test **/
    public function an_user_without_logging_in_cannot_see_the_create_invoice_view()
    {
        $this->get(route('invoices.create'))
            ->assertStatus(302);
    }
}
