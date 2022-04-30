<?php

namespace App\Http\Controllers\Admin;

use App\Shop\Admin\Orders\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController
{    
    /**
     * OrderService instance
     *
     * @var OrderService
     */
    private $orderService;
    
    /**
     * OrderController construct
     *
     * @param  OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    
    /**
     * Display a listing of the orders.
     *
     * @return View
     */
    public function index(): View
    {
        return view('admin-templates.orders.list', [
            'orders' => $this->orderService->getAllOrdersPaginate()
        ]);
    }

    /**
     * Show order details
     *
     * @param int $id
     *
     * @return View
     */
    public function edit(int $id): View
    {
        return view('admin-templates.orders.edit', [
            'order' => $this->orderService->getOrderById($id),
            'status' => $this->orderService->productStatus()
        ]);
    }

    /**
     * Update order status
     *
     * @param  Request $request
     *
     * @return RedirectResponse
     */
    public function updateStatus(Request $request): RedirectResponse
    {
        $this->orderService->updateStatus($request->id, $request->status);
        return redirect()
                ->back()
                ->with('success_message', __('admin-orders.order-status-change-success'));
    }
}