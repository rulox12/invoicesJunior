<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use App\Entities\Seller;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class CreateInvoicesApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return array
     */
    private function newInvoice()
    {
        $total = $this->faker->numberBetween($min = 1000, $max = 9000000);
        $states = Config::get('invoices.state');

        return [
            'due_date' => Carbon::now()->addDays('2')->format('Y-m-d H:i:s'),
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
    public function an_super_admin_can_create_a_invoices()
    {
        $this->API();

        $response = $this->json('POST', 'api/invoices-api', $this->newInvoice(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                "success" => true,
                "message" => "Invoice created successfully."
            ]);
    }

    /** @test * */
    public function an_user_no_create_permissions_can_not_see_the_create_invoice()
    {
        factory(User::class)->create([
            'email' => 'user@gmail.com',
            'password' => bcrypt('user123')
        ]);

        $this->artisan('passport:install');

        $this->json('POST', 'api/invoices-api', $this->newInvoice(), $this->headerApi())
            ->assertStatus(200)
            ->assertJson([
                'User have not permission for this page access.'
            ]);
    }

    /** @test * */
    public function a_super_administrator_cannot_create_a_invoice_without_a_tax()
    {
        $this->API();

        $total = $this->faker->numberBetween($min = 1000, $max = 9000000);
        $states = Config::get('invoices.state');

        $data = [
            'due_date' => Carbon::now()->addDays('2')->format('Y-m-d H:i:s'),
            'description' => substr($this->faker->firstName, 0, 100),
            'type' => substr($this->faker->firstName, 0, 10),
            'customer_id' => factory(Customer::class)->create()->id,
            'seller_id' => factory(Seller::class)->create()->id,
            'state' => $states[array_rand($states, 1)],
        ];


        $this->json('POST', 'api/invoices-api', $data, $this->headerApi())
            ->assertStatus(404)
            ->assertJson([
                "success" => false,
                "message" => "Validation Error.",
            ]);
    }
}
