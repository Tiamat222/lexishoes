<?php

namespace App\Http\Controllers\Admin;

use App\Shop\Admin\Pages\Requests\CreatePageRequest;
use App\Shop\Admin\Pages\Requests\UpdatePageRequest;
use Illuminate\View\View;
use App\Shop\Admin\Pages\Services\PageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    /**
     * Showing the form for adding a new category
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin-templates.catalog.pages.create');
    }
    
    /**
     * Store new page
     *
     * @param  CreatePageRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(CreatePageRequest $request): RedirectResponse
    {
        $this->pageService->store($request->data());
        return redirect()
                ->route('admin.catalog.pages.index')
                ->with('success_message', __('admin-pages.pages-store-success'));
    }
    
    /**
     * Create page slug (AJAX)
     *
     * @return JsonResponse
     */
    public function createSlug(Request $request): JsonResponse
    {
        return response()->json(['slug' => Str::slug($request['pageTitle'], '-')]);
    }
    
    /**
     * Showing form for editing page
     *
     * @param  int $id
     * 
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin-templates.catalog.pages.edit', [
            'page' => $this->pageService->getRecordById($id)
        ]);
    }

    public function update(UpdatePageRequest $request)
    {
        $this->pageService->update($request->data());
        return redirect()
                ->back()
                ->with('success_message', __('admin-pages.pages-update-success'));
    }
}