<?php

namespace App\Http\Controllers\Admin;

class OrderController
{
    public function index()
    {
        return view('admin-templates.orders.list');
    }
}