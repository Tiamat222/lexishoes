<?php

namespace Tests\Unit\Permissions;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Permissions\Services\PermissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Shop\Admin\Permissions\Permission;
use Illuminate\Support\Collection;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * PermissionService instance
     *
     * @var PermissionService
     */
    private $permissionService;
    
    /**
     * Admin
     *
     * @var Admin
     */
    private $admin;
    
    /**
     * Instantiate new admin and permission service
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->permissionService = new PermissionService(new Permission());
        $this->admin = Admin::factory()->create();
    }

    /** @test **/
    public function all_permissions_can_be_fetched_from_db()
    {
        Permission::factory(6)->create();
        $list = $this->permissionService->getAllPermissions();

        $this->assertEquals(6, count($list));
        $this->assertInstanceOf(Collection::class, $list);
    }

    /** @test **/
    public function permission_can_be_fetched_from_db_by_id()
    {
        Permission::factory(2)->create();
        $permission = $this->permissionService->getPermissionById(1);

        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals(1, $permission->id);
    }

    /** @test **/
    public function permission_can_be_attached_to_admin()
    {
        $permission = Permission::factory()->create(['slug' => 'test']);
        $getPermission = $this->permissionService->getPermissionById(1);
        $attachPermission = $this->permissionService->attachAdminPermissions($this->admin, [0 => $getPermission->id]);

        $this->assertTrue($this->admin->hasPermission('test'));
    }
}
