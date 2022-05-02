<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Shop\Admin\Pages\Services\PageService;

class PageController
{    
    /**
     * PageService instance
     *
     * @var PageService
     */
    private $pageService;

    /**
     * PageController constructor
     *
     * @param  PageService $pageService
     */
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * Display a listing of the pages
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.catalog.pages.list', [
            'pages' => $this->pageService->getAllRecordsPaginate(get_setting('items_per_page'))
        ]);
    }
}