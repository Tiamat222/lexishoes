<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Attributes\Requests\CreateAttributeRequest;
use App\Shop\Admin\Attributes\Requests\UpdateAttributeRequest;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\Services\AttributeValueService;

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
     * @return \Illuminate\View\View
     */    
    public function index()
    {
        return view('admin-templates.catalog.attributes.attributes-list', [
            'allAttributes' => $this->attributeService->getAllAttributes(3)
        ]);
    }

    /**
     * Showing the form for adding a new attribute
     *
     * @return \Illuminate\View\View
     */ 
    public function create()
    {
        return view('admin-templates.catalog.attributes.create-attribute');
    }

    /**
     * Store new attribute
     *
     * @param CreateAttributeRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAttributeRequest $request)
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
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin-templates.catalog.attributes.edit-attribute', [
            'attribute' => $this->attributeService->getEntityById($id)
        ]);
    }
    
    /**
     * Update attribute
     *
     * @param  UpdateAttributeRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAttributeRequest $request)
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->attributeService->destroy($id);

        return redirect()
            ->route('admin.catalog.attributes.index')
            ->with('success_message', __('admin-attributes.attribute-destroy-success'));
    }
}