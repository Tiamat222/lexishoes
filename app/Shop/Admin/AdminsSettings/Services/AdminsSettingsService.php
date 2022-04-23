<?php

namespace App\Shop\Admin\AdminsSettings\Services;

use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Admins\Services\AdminService;
use App\Shop\Admin\AdminsSettings\Exceptions\CreateAdminException;
use App\Shop\Admin\AdminsSettings\Exceptions\UpdateAdminException;
use App\Shop\Admin\AdminsSettings\Services\DTO\AdminCreateDto;
use App\Shop\Admin\AdminsSettings\Services\DTO\AdminUpdateDto;
use App\Shop\Admin\Permissions\Services\PermissionService;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use App\Shop\Core\Admin\Traits\ImageUploaderTrait;

class AdminsSettingsService extends BaseService
{
    use ImageUploaderTrait;
    
    /**
     * AdminService instance
     *
     * @var AdminService
     */
    private $adminService;
    
    /**
     * PermissionService instance
     *
     * @var PermissionService
     */
    private $permissionService;

    /**
     * AdminsSettingsService constructor
     *
     * @param  Admin $model
     * @param  AdminService $adminService
     * @param  PermissionService $permissionService
     */
    public function __construct(
        Admin $model, 
        AdminService $adminService, 
        PermissionService $permissionService
    )
    {
        $this->model = $model;
        $this->adminService = $adminService;
        $this->permissionService = $permissionService;
    }
    
    /**
     * Save new admin
     *
     * @param  AdminCreateDto $data
     * @throws CreateAdminException
     * 
     * @return bool
     */
    public function store(AdminCreateDto $data): bool
    {
        try {
            $admin = new Admin();
            $admin->login = $data->login;
            $admin->email = $data->email;
            $admin->telephone = $data->telephone;
            $admin->password = make_password($data->newPwd);

            if ($data->avatar !== NULL && $data->avatar instanceof UploadedFile) {
                $admin->avatar = $this->uploadImages([45, 150], $data->avatar);
            } else {
                $admin->avatar = $admin->avatar;
            }
            $admin->save();
            $this->permissionService->attachPermission($data->permissions, $admin->id);
            return true;
        } catch(QueryException $e) {
            throw new CreateAdminException($e->getMessage());
        }
    }
    
    /**
     * Update admin data
     *
     * @param  AdminUpdateDto $data
     * @throws UpdateAdminException
     * 
     * @return void
     */
    public function update(AdminUpdateDto $data)
    {
        try {
            $admin = $this->adminService->getRecordById($data->id);

            $admin->login = $data->login;

            if($data->status === 'on') {
                $admin->status = 1;
            } else {
                $admin->status = 0;
            }
            
            $admin->email = $data->email;
            $admin->telephone = $data->telephone;
            
            if($data->newPwd) {
                if($data->newPwd == $data->confirmPwd) {
                    $admin->password = make_password($data->newPwd);
                }
            }

            if ($data->avatar !== NULL && $data->avatar instanceof UploadedFile) {
                $admin->avatar = $this->uploadImages([45, 150], $data->avatar);
            } else {
                $admin->avatar = $admin->avatar;
            }

            $admin->update();

            $this->permissionService->detachPermission($data->id);
            $this->permissionService->attachPermission($data->permissions, $data->id);
            return true;
        } catch(QueryException $e) {
            throw new UpdateAdminException($e->getMessage());
        }
    }
}