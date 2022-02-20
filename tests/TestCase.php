<?php

namespace Tests;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
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
            5 => 'categories',
            6 => 'export',
            7 => 'attributes'
        ];

        foreach($permissions as $key => $value) {
            Permission::factory()->create(['slug' => $value, 'id'=> $key]);
            $selectedPermission = $this->permissionService->getPermissionById($key);
            $this->admin->permissions()->attach($selectedPermission);
        }
    }

    /**
     * Fields validation
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
}
