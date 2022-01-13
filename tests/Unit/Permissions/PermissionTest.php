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
     * Instantiate new admin and permission service
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function all_permissions_can_be_fetched_from_db()
    {
        $list = $this->permissionService->getAllPermissions();

        $this->assertNotEquals(0, count($list));
        $this->assertInstanceOf(Collection::class, $list);
    }

    /** @test **/
    public function permission_can_be_fetched_from_db_by_id()
    {
        $permission = $this->permissionService->getPermissionById(1);

        $this->assertInstanceOf(Permission::class, $permission);
        $this->assertEquals(1, $permission->id);
    }

    /** @test **/
    public function permission_can_be_attached_to_admin()
    {
        $permission = Permission::factory()->create(['slug' => 'testPermission']);
        $getPermission = $this->permissionService->getPermissionById($permission->id);
        $this->permissionService->attachAdminPermissions($this->admin, [$getPermission->id]);

        $this->assertTrue($this->admin->hasPermission('testPermission'));
    }
}
