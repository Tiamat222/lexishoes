<?php

namespace Tests;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Admin instance
     * 
     * @var Admin
     */
    protected $admin;
    
    /**
     * PermissionService instance
     *
     * @var PermissionService
     */
    protected $permissionService;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        $this->permissionService = new PermissionService(new Permission());

        $this->actingAs($this->admin, 'admins');

        $permissions = [
            1 => 'suppliers',
            2 => 'log',
            3 => 'suppliers',
            4 => 'settings',
        ];

        foreach($permissions as $key => $value) {
            Permission::factory()->create(['slug' => $value, 'id'=> $key]);
            $selectedPermission = $this->permissionService->getPermissionById($key);
            $this->admin->permissions()->attach($selectedPermission);
        }
    }
}
