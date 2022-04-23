<?php

namespace App\Http\Controllers\Admin;

use App\Shop\Admin\Admins\Services\AdminService;
use App\Shop\Admin\AdminsSettings\Requests\CreateAdminRequest;
use App\Shop\Admin\AdminsSettings\Services\AdminsSettingsService;
use App\Shop\Admin\Feeds\Services\AdminFeedsService;
use App\Shop\Admin\Permissions\Services\PermissionService;
use App\Shop\Admin\AdminsSettings\Requests\UpdateAdminRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminsSettingsController
{    
    /**
     * AdminsSettingsService instance
     *
     * @var AdminsSettingsService
     */
    private $adminsSettingsService;
    
    /**
     * Admins in trash
     *
     * @var int
     */
    private $adminsInTrash;
    
    /**
     * AdminService instance
     *
     * @var AdminService
     */
    private $adminService;
    
    /**
     * AdminFeedsService instance
     *
     * @var AdminFeedsService
     */
    private $adminFeedsService;
    
    /**
     * PermissionService instance
     *
     * @var PermissionService
     */
    private $permissionService;
    
    /**
     * AdminsSettingsController constructor
     *
     * @param  AdminsSettingsController $adminsSettingsService
     * @param  AdminFeedsService $adminFeedsService
     * @param  AdminService $adminService,
     * @param  PermissionService $permissionService
     */
    public function __construct(
        AdminsSettingsService $adminsSettingsService, 
        AdminFeedsService $adminFeedsService,
        AdminService $adminService,
        PermissionService $permissionService
    )
    {
        $this->adminsSettingsService = $adminsSettingsService;
        $this->adminFeedsService = $adminFeedsService;
        $this->adminService = $adminService;
        $this->permissionService = $permissionService;
        $this->adminsInTrash = $this->adminsSettingsService->countRecordsInTrash();
    }
    /**
     * Display a listing of the admins
     *
     * @return View
     */    
    public function index(): View
    {
        return view('admin-templates.settings.admins.admins-list', [
            'admins' => $this->adminsSettingsService->getAllRecordsPaginate(get_setting('items_per_page')),
            'adminsInTrash' => $this->adminsInTrash
        ]);
    }
    
    /**
     * Display a listing of the admins activity
     *
     * @param  string|null $adminId
     * 
     * @return View
     */
    public function activity(?int $adminId = null): View
    {
        return view('admin-templates.settings.admins.admins-activity', [
            'feeds' => $this->adminFeedsService->getLatestFeeds('admin_id', $adminId),
            'adminsInTrash' => $this->adminsInTrash,
            'adminsLogins' => pluck_collection_to_array($this->adminService->getAllRecords(['login', 'id']), 'login', 'id'),
            'adminId' => $adminId
        ]);
    }
    
    /**
     * Get admin feeds
     *
     * @param  Request $request
     * 
     * @return RedirectResponse
     */
    public function getFeeds(Request $request): RedirectResponse
    {
        return redirect()->route('admin.settings.admins.activity', $request->id);
    }
    
    /**
     * Admin soft delete
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $this->adminsSettingsService->turnOffStatus($id);
        $this->adminsSettingsService->recordSoftDelete($id);
        return redirect()
                ->route('admin.settings.admins.index')
                ->with('success_message', __('admins-settings.admins-soft-delete-success'));
    }
    
    /**
     * Show the form for creating a new admin
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin-templates.settings.admins.create-admin', [
            'adminsInTrash' => $this->adminsInTrash,
            'permissions' => pluck_collection_to_array($this->permissionService->getAllRecords(null, 'name'), 'name', 'id'),
        ]);
    }
    
    /**
     * Save new admin
     *
     * @param  CreateAdminRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(CreateAdminRequest $request): RedirectResponse
    {
        $this->adminsSettingsService->store($request->data());
        return redirect()
                ->route('admin.settings.admins.index')
                ->with('success_message', __('admins-settings.admins-create-new-admin'));
    }

    /**
     * Show the form for admin editing
     *
     * @param int $id
     * 
     * @return View
     */
    public function edit(int $id): View
    {
        $admin = $this->adminService->getRecordById($id);

        $allPermissions = pluck_collection_to_array($this->permissionService->getAllRecords(null, 'name'), 'name', 'id');
        $adminPermissions = pluck_collection_to_array($admin->permissions, 'name', 'id');

        return view('admin-templates.settings.admins.edit-admin', [
            'adminsInTrash' => $this->adminsInTrash,
            'admin' => $admin,
            'permissions' => array_diff_key($allPermissions, $adminPermissions),
            'adminPermissions' => $adminPermissions
        ]);
    }

    public function update(UpdateAdminRequest $request)
    {
        $this->adminsSettingsService->update($request->data());
        return redirect()
                ->back()
                ->with('success_message', __('admins-settings.admins-update-success'));
    }
    
    /**
     * Admins in trash
     *
     * @return View
     */
    public function trash(): View
    {
        return view('admin-templates.settings.admins.trash', [
            'adminsInTrash' => $this->adminsSettingsService->getAllSoftDeletedRecords(get_setting('items_per_page')),
        ]);
    }
    
    /**
     * Admin restore
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $this->adminsSettingsService->restoreRecord($id);
        $this->adminsSettingsService->turnOnStatus($id);
        return redirect()
                ->route('admin.settings.admins.trash')
                ->with('success_message', __('admins-settings.admins-restore-success'));
    }
    
    /**
     * Admin force delete
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->adminsSettingsService->recordForceDelete($id);
        return redirect()
                ->route('admin.settings.admins.trash')
                ->with('success_message', __('admins-settings.admins-destroy-success'));
    }
}