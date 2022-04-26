<?php
namespace Tests\Feature\Admin\Export;

use App\Shop\Admin\Suppliers\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function export_page_can_be_shown()
    {
        $this
            ->get(route('admin.settings.export.index'))
            ->assertStatus(200);
    }

    /** @test **/
    public function suppliers_can_be_exported_from_the_database_to_xls()
    {
        Supplier::create([
            'name' => 'Test_name', 
            'description' => 'Test description', 
        ]);

        $this
            ->post(route('admin.settings.export.unload'), ['table' => 'suppliers', 'extension' => 'xls'])
            ->assertStatus(200)
            ->assertDownload('suppliers.xls');
    }
}
