<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Information\Services\InformationService;
use Illuminate\View\View;

class InformationController extends Controller
{    
    /**
     * InformationService instance
     *
     * @var InformationService
     */
    private $informationService;
    
    /**
     * InformationService constructor
     *
     * @param  InformationService $informationService
     */
    public function __construct(InformationService $informationService)
    {
        $this->informationService = $informationService;
    }
    
    /**
     * Show system info
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.settings.information',[
            'dataArray' => $this->informationService->getData()
        ]);
    }
}