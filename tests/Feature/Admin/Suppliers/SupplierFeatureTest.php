<?php

namespace Tests\Feature\Admin\Suppliers;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
use App\Shop\Admin\Suppliers\Services\SupplierService;
use App\Shop\Admin\Suppliers\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class SupplierFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function suppliers_list_page_can_be_shown()
    {
        $supplier = Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description'
        ]);
        $getSupplier = (new SupplierService(new Supplier()))->getAllEntitiesPaginate(1);

        $this
            ->get(route('admin.catalog.suppliers.index', compact('getSupplier')))
            ->assertStatus(200)
            ->assertSee($supplier->name)
            ->assertSee($supplier->description);
    }

    /** @test **/
    public function supplier_create_page_can_be_shown()
    {
        $this
            ->get(route('admin.catalog.suppliers.create'))
            ->assertStatus(200);
    }

    /** @test **/
    public function supplier_edit_page_can_be_shown()
    {
        $supplier = Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description'
        ]);
        $getSupplier = (new SupplierService(new Supplier()))->getEntityById(1);

        $this
            ->get(route('admin.catalog.suppliers.edit', $supplier->id))
            ->assertStatus(200)
            ->assertSee($supplier->name)
            ->assertSee($supplier->description);
    }

    /** @test **/
    public function suppliers_trash_page_can_be_shown()
    {
        $supplier = Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description',
            'deleted_at' => Carbon::now(),
        ]);
        $softDeletedSuppliers = (new SupplierService(new Supplier()))->getAllSoftDeletedEntities(1);

        $this
            ->get(route('admin.catalog.suppliers.trash', compact('softDeletedSuppliers')))
            ->assertStatus(200)
            ->assertSee($supplier->name)
            ->assertSee($supplier->description);
    }

    /** @test **/
    public function supplier_can_be_created()
    {
        $this
            ->post(route('admin.catalog.suppliers.store'), ['name' => 'Test name', 'description' => 'Test description'])
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.suppliers.index'))
            ->assertSessionHas(['success_message' => __('admin-suppliers.supplier-store-success')]);
    }

    /** @test **/
    public function supplier_can_be_soft_deleted()
    {
        $supplier = Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description',
            'deleted_at' => NULL,
        ]);

        $this
            ->delete(route('admin.catalog.suppliers.delete', $supplier->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.suppliers.index'))
            ->assertSessionHas(['success_message' => __('admin-suppliers.supplier-trash-move')]);
    }

    /** @test **/
    public function supplier_can_be_force_deleted()
    {
        $supplier = Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description',
            'deleted_at' => Carbon::now(),
        ]);

        $this
            ->delete(route('admin.catalog.suppliers.destroy', $supplier->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.suppliers.index'))
            ->assertSessionHas(['success_message' => __('admin-suppliers.supplier-force-delete')]);
    }

    /** @test **/
    public function soft_deleted_supplier_can_be_restored()
    {
        $supplier = Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description',
            'deleted_at' => Carbon::now(),
        ]);

        $this
            ->get(route('admin.catalog.suppliers.restore', $supplier->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.suppliers.trash'))
            ->assertSessionHas(['success_message' => __('admin-suppliers.supplier-trash-restore')]);
    }

    /** @test **/
    public function supplier_can_be_updated()
    {
        $supplier = Supplier::create([
            'id' => 1,
            'name' => 'Test supplier',
            'description' => 'Test description',
        ]);

        $this
            ->put(route('admin.catalog.suppliers.update', $supplier->id), [
                'id' => $supplier->id, 
                'name' => 'Updated name', 
                'description' => 'Updated description'
            ])
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.suppliers.index'))
            ->assertSessionHas(['success_message' => __('admin-suppliers.supplier-update-success')]);
    }

    /** @test **/
    public function soft_deleted_suppliers_can_be_restored()
    {
        Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description',
            'deleted_at' => Carbon::now(),
        ]);
        $params = [
            '_url' => 'Test url',
            'ids' => [1]
        ];

        $this
            ->post(route('admin.catalog.suppliers.massRestore', $params))
            ->assertSessionHas(['success_message' => __('admin-suppliers.suppliers-was-restored')])
            ->assertJson(['success' => true]);
    }

    /** @test **/
    public function soft_deleted_suppliers_can_be_force_deleted()
    {
        Supplier::create([
            'name' => 'Test supplier',
            'description' => 'Test description',
            'deleted_at' => Carbon::now(),
        ]);
        $params = [
            '_url' => 'Test url',
            'ids' => [1]
        ];
        
        $this
            ->post(route('admin.catalog.suppliers.massDelete', $params))
            ->assertSessionHas(['success_message' => __('admin-suppliers.suppliers-was-deleted')])
            ->assertJson(['success' => true]);
    }
}
