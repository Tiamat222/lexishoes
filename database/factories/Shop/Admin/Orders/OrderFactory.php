<?php

namespace Database\Factories\Shop\Admin\Orders;

use App\Shop\Admin\Orders\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Table associated with the factory
     *
     * @var Order
     */
    protected $model = Order::class;

    public function definition()
    {
        return [
            'order_id' => 111, 
            'total_price' => 222, 
            'status' => 0, 
        ];
    }
}
