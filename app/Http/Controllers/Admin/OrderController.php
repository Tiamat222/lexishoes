<?php

namespace App\Http\Controllers\Admin;

use App\Shop\Admin\Orders\Services\OrderService;
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
            'orders' => $this->orderService->getAllRecordsPaginate(get_setting('items_per_page'))
        ]);
    }
}