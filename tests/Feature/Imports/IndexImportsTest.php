<?php

namespace Tests\Feature\Customers;

use App\Entities\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutEvents;
use Tests\TestCase;

class IndexImportsTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_user_who_is_not_registered_cannot_imports_index()
    {
        $response = $this
            ->get(route('imports.index'))
            ->assertStatus(302);
        $this->assertTrue(is_null($response->original));
    }

    /** @test * */
    public function a_user_who_is_not_registered_can_imports_index()
    {
        $user = $this->createSuperAdminUser();

        $response = $this->actingAs($user)
            ->get(route('imports.index'))
            ->assertSessionHasNoErrors();


        $response->assertViewHasAll($this->arrayTypes());
    }

    private function arrayTypes()
    {
        return [
            'types' => [
                0 => [
                    'name' => "Customer",
                    'import' => 'App\Imports\CustomersImport',
                    'route' => 'customers.index',
                ],
                1 => [
                    'name' => "Seller",
                    'import' => 'App\Imports\SellersImport',
                    'route' => 'sellers.index',
                ],
                2 => [
                    'name' => "Invoice",
                    'import' => 'App\Imports\InvoicesImport',
                    'route' => 'invoices.index',
                ],
            ]
        ];
    }
}
