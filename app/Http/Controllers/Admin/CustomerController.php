<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Shop\Admin\Customers\Requests\CreateCustomerRequest;
use App\Shop\Admin\Customers\Requests\UpdateCustomerRequest;
use App\Shop\Admin\Customers\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerController extends Controller
{    
    /**
     * CustomerService instance
     *
     * @var CustomerService
     */
    private $customerService;
    
    /**
     * CustomerController constructor
     *
     * @param  CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
        
    /**
     * Display a listing of the customers.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.customers.customers-list', [
            'customers' => $this->customerService->getAllRecordsPaginate(get_setting('items_per_page')),
            'softDeletedCount' => $this->customerService->countRecordsInTrash()
        ]);
    }

    /**
     * Showing the form for adding a new customer
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin-templates.customers.create-customer', [
            'softDeletedCount' => $this->customerService->countRecordsInTrash()
        ]);
    }
    
    /**
     * Store new customer
     *
     * @param  CreateCustomerRequest $request
     */
    public function store(CreateCustomerRequest $request)
    {
        $this->customerService->store($request->data());
        return redirect()
                ->route('admin.customers.index')
                ->with('success_message', __('admin-customers.customer-store-success'));
    }

    /**
     * Show the form for editing the customer
     *
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin-templates.customers.edit-customer', [
            'customer' => $this->customerService->getRecordById($id)
        ]);
    }
    
    /**
     * Update customer
     *
     * @param  UpdateCustomerRequest $request
     * 
     * @return RedirectResponse
     */
    public function update(UpdateCustomerRequest $request): RedirectResponse
    {
        $this->customerService->update($request->data());
        return redirect()
                ->route('admin.customers.edit', $request->id)
                ->with('success_message', __('admin-customers.customer-update-success'));
    }
    
    /**
     * Customer soft delete
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function softDelete(int $id): RedirectResponse
    {
        $this->customerService->turnOffStatus($id);
        $this->customerService->recordSoftDelete($id);
        return redirect()
                ->route('admin.customers.index')
                ->with('success_message', __('admin-customers.customer-delete-success'));
    }
    
    /**
     * Customer force delete
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->customerService->recordForceDelete($id);
        return redirect()
                ->route('admin.customers.trash')
                ->with('success_message', __('admin-customers.customer-destroy-success'));
    }
    
    /**
     * Customer restore
     *
     * @param  int $id
     * 
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        $this->customerService->restoreRecord($id);
        $this->customerService->turnOnStatus($id);
        return redirect()
                ->route('admin.customers.trash')
                ->with('success_message', __('admin-customers.customer-restore-success'));
    }
    
    /**
     * Customers in trash
     *
     * @return View
     */
    public function trash(): View
    {
        return view('admin-templates.customers.trash', [
            'customers' => $this->customerService->getAllSoftDeletedRecords(get_setting('items_per_page'))
        ]);
    }
}