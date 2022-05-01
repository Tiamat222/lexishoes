<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\Requests\CreateAttributeValueRequest;
use App\Shop\Admin\AttributeValues\Requests\UpdateAttributeValueRequest;
use App\Shop\Admin\AttributeValues\Services\AttributeValueService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
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
     * Attribute values list
     *
     * @param  int $id
     *
     * @return View
     */
    public function valuesList($id): View
    {
        return view('admin-templates.catalog.attribute-values.list', [
            'attributeName' => $this->attributeService->getRecordById($id)->name,
            'attributeValues' => $this->attributeService->getValues($id)
        ]);
    }

    /**
     * Showing the form for adding a new attribute value
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin-templates.catalog.attribute-values.create', [
            'allAttributes' => $this->attributeService->getAllRecords()
        ]);
    }

    /**
     * Store attribute value
     *
     * @param  CreateAttributeValueRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CreateAttributeValueRequest $request): RedirectResponse
    {
        $this->attributeValueService->store($request->only(['attribute', 'name']));
        return redirect()
            ->route('admin.catalog.attribute-values.valuesList', $request['attribute'])
            ->with('success_message', __('admin-attribute-values.attribute-value-create-success'));
    }

    /**
     * Showing the form for editing a attribute value
     *
     * @param  int $id
     *
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin-templates.catalog.attribute-values.edit', [
            'allAttributes' => $this->attributeService->getAllRecords(),
            'attributeValue' => $this->attributeValueService->getRecordById($id),
            'parentAttribute' => ($this->attributeValueService->getRecordById($id))->attribute
        ]);
    }

    /**
     * Update attribute value
     *
     * @param  UpdateAttributeValueRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateAttributeValueRequest $request): RedirectResponse
    {
        $this->attributeValueService->update($request->only(['parent-attribute-id', 'attribute-value-id', 'value']));
        return redirect()
                ->back()
                ->with('success_message', __('admin-attribute-values.attribute-value-update-success'));
    }

    /**
     * Destroy attribute value
     *
     * @param  int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->attributeValueService->destroyRecord($id);
        return redirect()
            ->back()
            ->with('success_message', __('admin-attribute-values.attribute-value-destroy-success'));
    }

    /**
     * Get attribute values
     *
     * @param  Request $request
     *
     * @return array
     */
    public function getAttributeValues(Request $request): array
    {
        $attrId = $request->attributeId;
        $attribute = $this->attributeService->getRecordById($attrId);
        $values = $attribute->values->pluck('value', 'id')->toArray();
        return $values;
    }
}

