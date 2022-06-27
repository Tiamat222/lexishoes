<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Categories\Services\CategoryService;
use Illuminate\View\View;

class CategoryController extends Controller
{    
    /**
     * Show category page content
     *
     * @param  string $slug
     * 
     * @return View
     */
    public function showCategory(string $slug, CategoryService $categoryService): View
    {
        return view('front-templates.category', [
            'products' => $categoryService->getAllRecordsPaginate(10)
        ]);
    }
}