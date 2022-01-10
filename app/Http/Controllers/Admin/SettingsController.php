<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Settings\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * SettingsService instance
     *
     * @var SettingsService
     */
    private $settingsService;
 
    /**
     * SettingsController constructor
     *
     * @var SettingsService
     */
    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Display a listing of the settings
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin-templates.settings.settings', [
            'settingsList' => $this->settingsService->getAllSettingsToArray(),
        ]);
    }

    /**
     * Store settings
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->settingsService->storeSettings($request->except(['_token', '_url']));
        return redirect()->route('admin.settings.generalSettings.index');
    }
}

