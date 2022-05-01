<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Attributes\Requests\CreateAttributeRequest;
use App\Shop\Admin\Attributes\Requests\UpdateAttributeRequest;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\Services\AttributeValueService;
use Illuminate\Http\RedirectResponse;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class AttributeController extends Controller
{    
    /**
     * AttributeService instance
     *
     * @var AttributeService
     */
    private $attributeService;

    /**
     * AttributeValueService instance
     *
     * @var AttributeValueService
     */
    private $attributeValueService;

    /**
     * AttributeController constructor
     *
     * @param AttributeService $attributeService
     * @param AttributeValueService $attributeValueService
     */
    public function __construct(AttributeService $attributeService, AttributeValueService $attributeValueService)
    {
        $this->attributeService = $attributeService;
        $this->attributeValueService = $attributeValueService;
    }
 
    /**
     * Display a listing of the attributes
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.catalog.attributes.list', [
            'allAttributes' => $this->attributeService->getAllAttributes()
        ]);
    }

    /**
     * Showing the form for adding a new attribute
     *
     * @return View
     */ 
    public function create(): View
    {
        return view('admin-templates.catalog.attributes.create');
    }

    /**
     * Store new attribute
     *
     * @param CreateAttributeRequest $request
     * 
     * @return RedirectResponse
     */
    public function store(CreateAttributeRequest $request): RedirectResponse
    {
        $this->attributeService->store($request->name);
        return redirect()
                ->route('admin.catalog.attributes.index')
                ->with('success_message', __('admin-attributes.attribute-create-success'));
    }

    /**
     * Showing the form for editing a attribute
     *
     * @param  int $id
     * 
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin-templates.catalog.attributes.edit', [
            'attribute' => $this->attributeService->getRecordById($id)
        ]);
    }
    
    /**
     * Update attribute
     *
     * @param  UpdateAttributeRequest $request
     * 
     * @return RedirectResponse
     */
    public function update(UpdateAttributeRequest $request): RedirectResponse
    {
        $this->attributeService->update($request->only(['id', 'name']));
        return redirect()
                ->route('admin.catalog.attributes.edit', $request['id'])
                ->with('success_message', __('admin-attributes.attribute-update-success'));
    }
    
    /**
     * Destroy attribute
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->attributeService->destroy($id);
        return redirect()
            ->route('admin.catalog.attributes.index')
            ->with('success_message', __('admin-attributes.attribute-destroy-success'));
    }

    /**
     * Get all product attributes
     *
     * @return Collection
     */
    public function getAllAttributes(): Collection
    {
        return $this->attributeService->getAllRecords(['id', 'name']);
    }
}