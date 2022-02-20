<?php
namespace Tests\Unit\Admin\Suppliers;

use App\Shop\Admin\Suppliers\Requests\CreateSupplierRequest;
use App\Shop\Admin\Suppliers\Services\DTO\SupplierCreateDto;
use App\Shop\Admin\Suppliers\Services\DTO\SupplierUpdateDto;
use App\Shop\Admin\Suppliers\Services\SupplierService;
use App\Shop\Admin\Suppliers\Supplier;
use App\Shop\Core\Admin\Base\Exceptions\EntityNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use Carbon\Carbon;


class SupplierTest extends TestCase
{
    use RefreshDatabase;

    /**
     * SupplierService instance
     *
     * @var SupplierService
     */
    private $supplierService;

    public function setUp(): void
    {
        parent::setUp();

        $this->supplierService = new SupplierService(new Supplier());
        $this->rules = (new CreateSupplierRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function all_suppliers_can_be_shown_with_paginatation()
    {
        Supplier::factory(6)->create();
        $allSuppliers = $this->supplierService->getAllEntitiesPaginate(10);

        $this->assertEquals(6, count($allSuppliers));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allSuppliers);
    }

    /** @test */
    public function suppliers_in_trash_can_be_counted()
    {
        Supplier::factory(6)->create(['deleted_at' => Carbon::now()]);
        $allSuppliers = $this->supplierService->countEntitiesInTrash();

        $this->assertEquals(6, $allSuppliers);
    }

    /** @test */
    public function supplier_can_be_fetched_from_bd_by_id()
    {
        Supplier::factory()->create(['name' => 'Test supplier']);
        $supplier = $this->supplierService->getEntityById(1);

        $this->assertInstanceOf(Supplier::class, $supplier);
    }

    /** @test */
    public function throw_an_exception_if_the_supplier_was_not_fetched_from_the_database()
    {
        $this->expectException(EntityNotFoundException::class);

        $this->supplierService->getEntityById(2);
    }

    /** @test */
    public function all_soft_deleted_suppliers_can_be_fetched_from_database_with_pagination()
    {
        Supplier::factory(6)->create(['deleted_at' => Carbon::now()]);
        $allSoftDeletedSuppliers = $this->supplierService->getAllSoftDeletedEntities(6);

        $this->assertEquals(6, count($allSoftDeletedSuppliers));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allSoftDeletedSuppliers);
    }

    /** @test */
    public function supplier_can_be_soft_deleted()
    {
        $supplier = Supplier::factory()->create();
        $this->supplierService->entitySoftDelete($supplier->id);
        
        $this->assertEquals(1, count($this->supplierService->getAllSoftDeletedEntities(6)));
    }

    /** @test */
    public function supplier_can_be_force_deleted()
    {
        $supplier = Supplier::factory()->create(['deleted_at' => Carbon::now()]);

        $this->assertNotEquals(NULL, $supplier->deleted_at);
        $this->assertEquals(1, count($this->supplierService->getAllSoftDeletedEntities(6)));

        $this->supplierService->entityForceDelete($supplier->id);

        $this->assertEquals(0, count($this->supplierService->getAllEntitiesPaginate(6)));
    }

    /** @test */
    public function soft_deleted_supplier_can_be_restored()
    {
        $supplier = Supplier::factory()->create(['deleted_at' => Carbon::now()]);

        $this->assertNotEquals(NULL, $supplier->deleted_at);
        $this->assertEquals(1, count($this->supplierService->getAllSoftDeletedEntities(6)));
        
        $this->supplierService->restoreEntity($supplier->id);
        $restoredSupplier = $this->supplierService->getEntityById($supplier->id);

        $this->assertInstanceOf(Supplier::class, $restoredSupplier);
        $this->assertEquals(NULL, $restoredSupplier->deleted_at);
        $this->assertEquals(NULL, $restoredSupplier->created_at);
        $this->assertNotEquals(NULL, $restoredSupplier->updated_at);
    }

    /** @test */
    public function force_deleted_suppliers_can_be_restored()
    {
        $suppliers = Supplier::factory(6)->create(['deleted_at' => Carbon::now()]);
        $suppliersIds = [
            'ids' => [1, 2, 3, 4, 5, 6]
        ];
        $this->supplierService->restoreAllEntities($suppliersIds);
        $restoredSuppliers = $this->supplierService->getAllEntitiesPaginate(6);

        $this->assertEquals(6, count($restoredSuppliers));
    }

    /** @test */
    public function soft_deleted_suppliers_can_be_force_deleted()
    {
        $suppliers = Supplier::factory(6)->create(['deleted_at' => Carbon::now()]);
        $suppliersIds = [
            'ids' => [1, 2, 3, 4, 5, 6]
        ];
        
        $this->supplierService->forceDeleteAllEntities($suppliersIds);
        $softDeletedSuppliers = $this->supplierService->getAllSoftDeletedEntities(6);

        $this->assertInstanceOf(LengthAwarePaginator::class, $softDeletedSuppliers);
        $this->assertEquals(0, count($softDeletedSuppliers->items()));
        $this->assertEquals(0, $softDeletedSuppliers->total());
    }

    /** @test */
    public function supplier_can_be_stored()
    {
        $createDto = new SupplierCreateDto([
            'name' => 'Test name',
            'description' => 'Test description',
        ]);
        $storedSupplier = $this->supplierService->store($createDto);

        $this->assertTrue($storedSupplier);
        
        $getStoredSupplier = $this->supplierService->getEntityById(1);

        $this->assertEquals(1, $getStoredSupplier->id);
        $this->assertEquals('Test name', $getStoredSupplier->name);
        $this->assertEquals('Test description', $getStoredSupplier->description);
        $this->assertEquals(NULL, $getStoredSupplier->deleted_at);
        $this->assertNotEquals(NULL, $getStoredSupplier->created_at);
        $this->assertNotEquals(NULL, $getStoredSupplier->updated_at);
    }
    
    /** @test */
    public function supplier_can_be_updated()
    {
        $supplier = Supplier::factory()->create();
        $updateDto = new SupplierUpdateDto([
            'id' => 1,
            'name' => 'Updated name',
            'description' => 'Updated description',
        ]);
        $updatedSupplier = $this->supplierService->update($updateDto);

        $this->assertTrue($updatedSupplier);

        $getUpdatedSupplier = $this->supplierService->getEntityById(1);

        $this->assertEquals(1, $getUpdatedSupplier->id);
        $this->assertEquals('Updated name', $getUpdatedSupplier->name);
        $this->assertEquals('Updated description', $getUpdatedSupplier->description);
        $this->assertEquals(NULL, $getUpdatedSupplier->deleted_at);
        $this->assertEquals(NULL, $getUpdatedSupplier->created_at);
        $this->assertNotEquals(NULL, $getUpdatedSupplier->updated_at);
    }

    /** @test **/
    public function valid_supplier_name()
    {
        $supplier = Supplier::factory()->create(['name' => 'Test supplier']);
        
        $this->assertTrue($this->validateField('name', 'Test name'));
        $this->assertTrue($this->validateField('name', 'Test'));
        $this->assertTrue($this->validateField('name', 'Te'));
        $this->assertFalse($this->validateField('name', $supplier->name));
        $this->assertFalse($this->validateField('name', 'T'));
        $this->assertFalse($this->validateField('name', ' '));
        $this->assertFalse($this->validateField('name', ''));
    }

    /** @test **/
    public function valid_supplier_description()
    {
        $this->assertTrue($this->validateField('description', 'Test name'));
        $this->assertTrue($this->validateField('description', ''));
        $this->assertFalse($this->validateField('description', '
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
        '));
    }
}
