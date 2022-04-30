<?php

namespace App\Shop\Admin\Orders\Services;

use App\Shop\Admin\Orders\Exceptions\UpdateOrderStatusErrorException;
use App\Shop\Admin\Orders\Order;
use App\Shop\Core\Admin\Base\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

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

    /**
     * Get all orders with pagination and customers
     *
     * @return LengthAwarePaginator
     */
    public function getAllOrdersPaginate(): LengthAwarePaginator
    {
        $orders = $this->getAllRecordsPaginate(get_setting('items_per_page'));
        foreach($orders as $order) {
            $order->load('customers');
        }
        return $orders;
    }

    public function getOrderById(int $id)
    {
        $order = $this->getRecordById($id);
        $order->load('customers');
        return $order;
    }

    /**
     * List of product status
     *
     * @return array
     */
    public function productStatus(): array
    {
        return [
            'Новый заказ',
            'В обработке',
            'Заказ обработан',
            'Заказ отменен',
            'Оплачен'
        ];
    }

    /**
     * Update order status
     *
     * @param  int $id
     * @param  int $status
     *
     * @return bool
     */
    public function updateStatus(int $id, int $status): bool
    {
        try {
            $order = $this->getRecordById($id);
            $order->status = $status;
            $order->update();
            return true;
        } catch(Exception $e) {
            throw new UpdateOrderStatusErrorException($e->getMessage());
        }
    }
}