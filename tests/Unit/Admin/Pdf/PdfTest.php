<?php

namespace Tests\Unit\Admin\Pdf;

use App\Shop\Admin\Customers\Customer;
use App\Shop\Admin\Customers\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Shop\Core\Admin\Traits\PdfTrait;
use Tests\TestCase;

class PdfTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * CustomerService instance
     *
     * @var mixed
     */
    private $customerService;
    
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->customerService = new CustomerService(new Customer());
    }

    /** @test */
    public function pdf_file_can_be_created_and_stored()
    {
        $customer = Customer::factory()->create();
        $customer = $this->customerService->getRecordById($customer->id);

        $class = new class {
            use PdfTrait;
        };

        $linkToPdf = $class->storePdf('admin-templates.customers.pdf', $customer);

        $this->assertEquals(storage_path('app/public/files/pdf/document.pdf'), $linkToPdf);

        $destroyPdf = $class->destroyPdf($linkToPdf);

        $this->assertTrue($destroyPdf);
    }
}
