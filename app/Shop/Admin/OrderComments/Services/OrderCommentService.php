<?php

namespace App\Shop\Admin\OrderComments\Services;

use App\Shop\Admin\OrderComments\Exceptions\CreateOrderCommentErrorException;
use App\Shop\Admin\OrderComments\OrderComment;
use Illuminate\Database\QueryException;

class OrderCommentService
{    
    /**
     * OrderCommentService constructor
     *
     * @param  OrderComment $model
     */
    public function __construct(OrderComment $model)
    {
        $this->model = $model;
    }

    /**
     * Store new order comment (inner)
     *
     * @param  string $innerComment
     * @param  int $orderId
     *
     * @throws CreateOrderCommentErrorException
     * @return bool
     */
    public function store(string $innerComment, int $orderId): bool
    {
        try {
            $comment = new OrderComment();
            $comment->order_id = $orderId;
            $comment->admin_login = auth()->guard('admins')->user()->login;
            $comment->comment = $innerComment;
            $comment->save();
            return true;
        } catch(QueryException $e) {
            throw new CreateOrderCommentErrorException($e->getMessage());
        }
    }
}