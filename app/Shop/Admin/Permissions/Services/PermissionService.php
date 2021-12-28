<?php
namespace App\Shop\Admin\Permissions\Services;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Permissions\Permission;
use Illuminate\Support\Collection;

class PermissionService
{    
    /**
     * @var Permission
     */
    private $model;
    
    /**
     * PermissionService constructor
     *
     * @param  Permission $model
     */
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    /**
     * Get all permissions
     *
     * @return Collection
     */
    public function getAllPermissions(): Collection
    {
        return $this->model->get();
    }
    
    /**
     * Get permission by id
     *
     * @param  int $id
     * 
     * @return Permission
     */
    public function getPermissionById(int $id): Permission
    {
        return $this->model->where('id', $id)->first();
    }
    
    /**
     * Detach all admin permissions
     *
     * @param  Admin $admin
     * 
     * @return bool
     */
    public function detachAdminPermissions(Admin $admin): bool
    {
        $listOfAdminPermissions = $admin->permissions;
        foreach ($listOfAdminPermissions as $permission) {
            $admin->permissions()->detach($permission);
        }
        return true;
    }
    
    /**
     * Attach admin permissions
     *
     * @param  Admin $admin
     * @param  array $permissionsArray
     * 
     * @return bool
     */
    public function attachAdminPermissions(Admin $admin, array $permissionsArray): bool
    {
        foreach ($permissionsArray as $permission) {
            $admin->permissions()->attach($permission);
        }
        return true;
    }
}