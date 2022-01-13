<?php

namespace Tests\Feature\Admin\Log;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
use Tests\TestCase;

class LogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Admin instance
     * 
     * @var Admin
     */
    private $admin;
        
    /**
     * PermissionService instance
     * 
     * @var PermissionService
     */
    private $permissionService;   

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        $this->permissionService = new PermissionService(new Permission());
        
        Permission::factory()->create(['id'=> 1, 'slug' => 'log']);
        $selectedPermission = $this->permissionService->getPermissionById(1);
        $this->admin->permissions()->attach($selectedPermission);

        file_put_contents(storage_path('logs/testFile.log'), 'Test message');
    }

    /** @test **/
    public function settings_log_page_can_be_shown()
    {
        $this
            ->actingAs($this->admin, 'admins')
            ->get(route('admin.settings.log.index'))
            ->assertStatus(200)
            ->assertSee('Test message');

        unlink(storage_path('logs/testFile.log'));
    }
}
