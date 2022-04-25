<?php

namespace Tests;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Admins\Services\AdminService;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
use App\Shop\Admin\Settings\Setting;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Validation\Validator;

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

    /**
     * Validation rules
     *
     * @var array
     */
    protected $rules;
    
    /**
     * Validator
     *
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;
        
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admins');

        $this->generateSettings();
        $this->attachPermissionsToAdmin();
    }

    /**
     * Validation of fields values
     *
     * @param  string $field
     * @param  string $value
     * 
     * @return Validator
     */
    protected function getFieldValidator(string $field, string $value): Validator
    {
        return $this->validator->make(
            [$field => $value],
            [$field => $this->rules[$field]]
        );
    }
    
    /**
     * Get fields for validation
     *
     * @param  string $field
     * @param  string $value
     * 
     * @return bool
     */
    protected function validateField(string $field, string $value): bool
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
    
    /**
     * Generate store settings
     *
     * @return void
     */
    private function generateSettings(): void
    {
        $generalSettings = [
            'admin_email' => 'admin@email.com',
            'site_language' => 'ru',
            'items_per_page' => 1,
            'store_logo' => '',
            'store_title' => '',
            'pwd_length' => 6
        ];

        foreach($generalSettings as $key => $value) {
            Setting::factory()->create(['setting' => $key, 'value' => $value]);
        }
    }
    
    /**
     * Generate and attach permissions to admin
     *
     * @return void
     */
    private function attachPermissionsToAdmin(): void
    {
        $this->permissionService = new PermissionService(new Permission(), new AdminService(new Admin()));

        $permissions = [
            1 => 'settings',
            2 => 'log',
            3 => 'information',
            4 => 'export',
            5 => 'import',
            6 => 'suppliers',
            7 => 'categories',
            8 => 'attributes',
            9 => 'products',
            10 => 'admin-profile',
            11 => 'customers',
            12 => 'admins',
        ];

        foreach($permissions as $key => $value) {
            Permission::factory()->create(['slug' => $value, 'id'=> $key]);
            $selectedPermission = $this->permissionService->getPermissionById($key);
            $this->admin->permissions()->attach($selectedPermission);
        }
    }

    protected function testAdmin()
    {
        return Admin::factory()->create([
            'id' => 2,
            'login' => 'Test login',
            'email' => 'TestEmail@gmail.com',
            'telephone' => '+39(999) 999-99-99',
            'avatar' => 'storage/images/2022/03/1647613994-image-1.jpg'
        ]);
    }
}
