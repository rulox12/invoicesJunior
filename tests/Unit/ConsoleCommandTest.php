<?php


namespace Tests\Unit;

use App\Entities\Invoice;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_console_command()
    {
        $this->artisan('command:updateInvoice')
            ->assertExitCode(0);
        $this->artisan('fixer:fix')
            ->assertExitCode(0);
    }

    /** @test */
    public function test_update_invoice_command()
    {
        $invoice = factory(Invoice::class)->create([
            'state' => 'Pending',
            'due_date' => Carbon::now('America/Bogota')->addHours('-2')
        ]);

        $this->artisan('command:updateInvoice')
            ->assertExitCode(0);

        $response = $this->actingAs($this->createSuperAdminUser())
            ->get(
                route('invoices.show', $invoice->id)
            )
            ->assertSuccessful();

        $getData =$response->original->getData()['invoice'];

        $this->assertEquals($getData->state, 'Expired');
    }
}
