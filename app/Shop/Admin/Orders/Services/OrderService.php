<?php

namespace App\Shop\Admin\Orders\Services;

use App\Shop\Admin\Orders\Order;
use App\Shop\Core\Admin\Base\Services\BaseService;

class OrderService extends BaseService
{    
    /**
     * OrderService constructor
     *
     * @param  Order $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }
}