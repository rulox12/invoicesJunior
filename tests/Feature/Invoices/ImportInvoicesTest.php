<?php

namespace Tests\Feature\Invoices;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ImportInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function an_authenticated_user_can_see_the_views_to_import_invoice()
    {
        $user = $this->defaultUser();

        $response = $this->actingAs($user)
            ->get(route('invoices.import'))
            ->assertSuccessful()
            ->assertSessionHasNoErrors();
    }

    /** @test * */
    public function an_authenticated_user_can_upload_xlsx_files_of_invoices()
    {
        Excel::fake();

        $this->actingAs($this->defaultUser())
            ->patch(route('invoices.importSave'), [
                'select_file' => UploadedFile::fake()->create('ejemplo.xlsx')
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }
}
