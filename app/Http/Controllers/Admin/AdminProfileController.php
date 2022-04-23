<?php

namespace App\Http\Controllers\Admin;

use App\Shop\Admin\AdminProfile\Requests\ChangePasswordRequest;
use App\Shop\Admin\AdminProfile\Requests\UpdateAdminProfileRequest;
use App\Shop\Admin\AdminProfile\Services\AdminProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminProfileController
{    
    /**
     * AdminProfileService instance
     *
     * @var AdminProfileService
     */
    private $adminProfileService;
    
    /**
     * AdminProfileController constructor
     *
     * @param  AdminProfileService $adminProfileService
     */
    public function __construct(AdminProfileService $adminProfileService)
    {
        $this->adminProfileService = $adminProfileService;
    }
    
    /**
     * Show admin profile edit page
     *
     * @return View
     */
    public function edit(): View
    {
        $admin = auth()->guard('admins')->user();
        return view('admin-templates.settings.admin-profile.edit-profile', [
            'admin' => $admin,
            'feeds' => $admin->latestFeeds
        ]);
    }
    
    /**
     * Update admin profile
     *
     * @param  UpdateAdminProfileRequest $request
     * 
     * @return RedirectResponse
     */
    public function update(UpdateAdminProfileRequest $request): RedirectResponse
    {
        $this->adminProfileService->update($request->data());
        return redirect()
            ->route('admin.settings.profile.edit')
            ->with('success_message', __('admin-profile.profile-data-success'));
    }
    
    /**
     * Update admin password
     *
     * @param  ChangePasswordRequest $request
     * 
     * @return RedirectResponse
     */
    public function changePwd(ChangePasswordRequest $request): RedirectResponse
    {
        if($this->adminProfileService->changePwd($request->data())) {
            return redirect()
                ->route('admin.login')
                ->with('success_message', __('admin-profile.profile-pwd-success'));
        }
        return redirect()->route('admin.settings.profile.edit');
    }
}