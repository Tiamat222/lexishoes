<?php

namespace App\Shop\Front\Callback\Services;

use App\Shop\Front\Callback\Callback;
use App\Shop\Front\Callback\Exceptions\CreateCallbackException;
use Illuminate\Database\QueryException;

class CallbackService
{
    /**
     * CallbackService constructor
     *
     * @param  Callback $model
     */
    public function __construct(Callback $model)
    {
        $this->model = $model;
    }

    /**
     * Store new callback request
     *
     * @param  array $callbackData
     * 
     * @throws CreateCallbackException
     * @return bool
     */
    public function store(array $data): bool
    {
        try {
            $callback = new Callback();
            $callback->name = $data['name'];
            $callback->phone = $data['phone'];
            $callback->save();
            return true;
        } catch(QueryException $e) {
            throw new CreateCallbackException($e->getMessage());
        }
    }
}