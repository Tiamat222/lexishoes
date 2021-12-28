<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Information\Services\InformationService;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dataArray = $this->informationService->getData();
        return view('admin-templates.settings.information', compact('dataArray'));
    }
}