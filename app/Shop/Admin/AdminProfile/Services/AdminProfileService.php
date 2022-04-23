<?php
namespace App\Shop\Admin\AdminProfile\Services;

use App\Shop\Admin\AdminProfile\Exceptions\UpdateAdminPasswordException;
use App\Shop\Admin\AdminProfile\Exceptions\UpdateAdminProfileException;
use App\Shop\Admin\AdminProfile\Services\DTO\AdminProfileUpdateDto;
use App\Shop\Admin\AdminProfile\Services\DTO\ChangePasswordDto;
use App\Shop\Core\Admin\Traits\ImageUploaderTrait;
use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Admin\Admins\Services\AdminService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use App\Shop\Admin\Admins\Admin;

class AdminProfileService extends BaseService
{
    use ImageUploaderTrait;
    
    /**
     * AdminService instance
     *
     * @var AdminService
     */
    private $adminService;
    
    /**
     * AdminProfile constructor
     *
     * @param  Admin $admin
     * @param  AdminService $adminService
     */
    public function __construct(Admin $admin, AdminService $adminService)
    {
        $this->model = $admin;
        $this->adminService = $adminService;
    }
    
    /**
     * Update admin profile
     *
     * @param  AdminProfileUpdateDto $data
     * 
     * @return bool
     */
    public function update(AdminProfileUpdateDto $data): bool
    {
        try {
            $admin = $this->getRecordById($data->id);

            if ($data->avatar !== NULL && $data->avatar instanceof UploadedFile) {
                $data->avatar = $this->uploadImages([45, 150], $data->avatar);
            } else {
                $data->avatar = $admin->avatar;
            }
    
            $admin->update([
                'login' => $data->login,
                'email' => $data->email,
                'telephone' => $data->telephone,
                'avatar' => $data->avatar
            ]);
    
            return true;
        } catch(QueryException $e) {
            throw new UpdateAdminProfileException($e->getMessage());
        }

    }
    
    /**
     * Update admin password
     *
     * @param  ChangePasswordDto $data
     * 
     * @return bool
     */
    public function changePwd(ChangePasswordDto $data): bool
    {
        try {
            if(!$this->checkPwd($data->newPwd, $this->getRecordById($data->id)->password)) {
                $admin = $this->getRecordById($data->id);
                $admin->update(['password' => Hash::make($data->newPwd)]);
                $this->adminService->logout();
                return true;
            }
            session()->flash('error_message', __('admin-profile.profile-pwd-compare'));
            return false;
        } catch(QueryException $e) {
            throw new UpdateAdminPasswordException($e->getMessage());
        }
    }
    
    /**
     * Compare passwords
     *
     * @param  string $newPwd
     * @param  string $currentPwd
     * 
     * @return bool
     */
    private function checkPwd(string $newPwd, string $currentPwd): bool
    {
        return Hash::check($newPwd, $currentPwd);
    }
}