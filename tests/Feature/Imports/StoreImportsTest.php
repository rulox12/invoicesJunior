<?php


namespace Tests\Feature\Imports;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class StoreImportsTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function an_authenticated_user_can_upload_xlsx_files()
    {
        Excel::fake();

        $this->actingAs($this->createSuperAdminUser())
            ->post(route('imports.store'), [
                'file' => UploadedFile::fake()->create('ejemplo.xlsx'),
                'type' => 'App\Imports\InvoicesImport'
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }
}
