<?php

namespace Tests\Feature\Customers;

use App\Entities\Invoice;
use App\Entities\Seller;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexInvoicesTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    public function users_can_list_invoices()
    {
        $user = $this->defaultUser();

        $invoiceA = factory(Invoice::class)->create();
        $invoiceB = factory(Invoice::class)->create();
        $invoiceC = factory(Invoice::class)->create();

        $response = $this->actingAs($user)
            ->get(route('invoices.index'))
            ->assertSuccessful();

        $invoices = $response->original->getData()['invoices'];

        $this->assertTrue($invoices->contains($invoiceA));
        $this->assertTrue($invoices->contains($invoiceB));
        $this->assertTrue($invoices->contains($invoiceC));
    }

    /** @test **/
    public function a_user_who_is_not_registered_cannot_invoices()
    {
        factory(Invoice::class, 3)->create();

        $response = $this
            ->get(route('invoices.index'))
            ->assertStatus(302);
        $this->assertTrue(is_null($response->original));
    }

    /** @test **/
    public function a_user_register_can_filter_invoice_for_total()
    {
        $user = $this->defaultUser();

        $total = 20000;

        $invoice = factory(Invoice::class)->create(['total' => $total]);
        factory(Invoice::class, 3)->create();


        $response = $this->actingAs($user)
            ->get('/invoices?type=total&value=' . $total);


        $invoices = $response->original->getData()['invoices'];
        $this->assertEquals($total, $invoices[0]->total);
        $this->assertEquals(1, sizeof($invoices));
    }

    /** @test * */
    public function a_user_register_can_filter_invoice_for_state()
    {
        $user = $this->defaultUser();

        $state = "New_State";

        factory(Invoice::class)->create(['state' => $state]);


        $response = $this->actingAs($user)
            ->get('/invoices?type=state&value=' . $state);


        $invoices = $response->original->getData()['invoices'];
        $this->assertEquals($state, $invoices[0]->state);
    }

    /** @test * */
    public function a_user_register_can_filter_invoice_for_date()
    {
        $user = $this->defaultUser();

        $date = Carbon::now('America/Bogota');
        $from = $date;
        $to = $date->addDays('2');

        factory(Invoice::class)->create(['due_date' => $date]);


        $response = $this->actingAs($user)
            ->get('/invoices/filter/date?type=due_date&from=' . $from . '&to=' . $to);


        $invoices = $response->original->getData()['invoices'];
        $this->assertEquals($date, $invoices[0]->due_date);
    }

    /** @test * */
    public function not_filter_invoice_for_date()
    {
        $user = $this->defaultUser();

        $date = Carbon::now('America/Bogota');
        $from = $date;

        $invoice = factory(Invoice::class)->create(['due_date' => $date]);


        $response = $this->actingAs($user)
            ->get('/invoices/filter/date?type=due_date&from=' . $from)
            ->assertSessionHasNoErrors();
    }
}
