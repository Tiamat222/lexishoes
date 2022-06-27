<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Pages\Services\PageService;
use Illuminate\View\View;

class PageController extends Controller
{    
    /**
     * Show page content
     *
     * @param  string $slug
     * 
     * @return View
     */
    public function showPage(string $slug, PageService $pageService): View
    {
        return view('front-templates.page', [
            'page' => $pageService->getRecordByField('slug', $slug)
        ]);
    }
}