<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Suppliers\Requests\CreateSupplierRequest;
use App\Shop\Admin\Suppliers\Requests\UpdateSupplierRequest;
use App\Shop\Admin\Suppliers\Services\SupplierService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SupplierController extends Controller
{    
    /**
     * SupplierService instance
     *
     * @var SupplierService
     */
    private $supplierService;
    
    /**
     * SupplierController constructor
     *
     * @param  SupplierService $supplierService
     */
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the suppliers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin-templates.catalog.suppliers.suppliers-list', [
            'suppliers' => $this->supplierService->getAllEntitiesPaginate(3), 
            'suppliersInTrash' => $this->supplierService->countEntitiesInTrash()
        ]);
    }

    /**
     * Show the form for creating a new supplier.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin-templates.catalog.suppliers.create-supplier', [
            'suppliersInTrash' => $this->supplierService->countEntitiesInTrash()
        ]);
    }

    /**
     * Store a newly created supplier in storage.
     *
     * @param CreateSupplierRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSupplierRequest $request)
    {
        $this->supplierService->store($request->data());
        return redirect()
                ->route('admin.catalog.suppliers.index')
                ->with('success_message', __('admin-suppliers.supplier-store-success'));
    }

    /**
     * Display the specified supplier.
     *
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('admin-templates.catalog.suppliers.show', [
            'supplier' => $this->supplierService->getEntityById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin-templates.catalog.suppliers.edit-supplier', [
            'supplier' => $this->supplierService->getEntityById($id),
            'suppliersInTrash' => $this->supplierService->countEntitiesInTrash()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSupplierRequest  $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSupplierRequest $request, $id)
    {
        $this->supplierService->update($request->data());
        return redirect()
                ->route('admin.catalog.suppliers.index')
                ->with('success_message', __('admin-suppliers.supplier-update-success'));
    }
    
    /**
     * Listing of suppliers in trash
     *
     * @return \Illuminate\View\View
     */
    public function trash()
    {
        return view('admin-templates.catalog.suppliers.trash', [
            'softDeletedSuppliers' => $this->supplierService->getAllSoftDeletedEntities(10)
        ]);
    }
    
    /**
     * Move supplier to trash
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function softDelete($id)
    {
        $this->supplierService->entitySoftDelete($id);
        return redirect()
                ->route('admin.catalog.suppliers.index')
                ->with('success_message', __('admin-suppliers.supplier-trash-move'));
    }
    
    /**
     * Restore soft deleted supplier
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $this->supplierService->restoreEntity($id);
        return redirect()
                ->route('admin.catalog.suppliers.trash')
                ->with('success_message', __('admin-suppliers.supplier-trash-restore'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->supplierService->entityForceDelete($id);
        return redirect()
                ->route('admin.catalog.suppliers.index')
                ->with('success_message', __('admin-suppliers.supplier-force-delete'));
    }
    
    /**
     * AJAX mass restore suppliers from trash
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function restoreAll(Request $request)
    {
        $this->supplierService->restoreAllEntities($request->except('_url'));
        Session::flash('success_message', __('admin-suppliers.suppliers-was-restored'));
        return response()->json(['success' => true]);
    }
    
    /**
     * AJAX mass force delete suppliers
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function forceDeleteAll(Request $request)
    {
        $this->supplierService->forceDeleteAllEntities($request->except('_url'));
        Session::flash('success_message', __('admin-suppliers.suppliers-was-deleted'));
        return response()->json(['success' => true]);
    }
}
