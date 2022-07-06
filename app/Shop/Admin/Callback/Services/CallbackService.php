<?php

namespace App\Shop\Admin\Callback\Services;

use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Front\Callback\Callback;
use App\Shop\Admin\Callback\Exceptions\UpdateCallbackException;
use Illuminate\Database\QueryException;

class CallbackService extends BaseService
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
     * Update callback
     *
     * @param  array $data
     * 
     * @throws UpdateCallbackException
     * @return bool
     */
    public function update(array $data): bool
    {
        try {
            $callback = $this->getRecordById($data['id']);
            $callback->status = $data['status'];
            $callback->comment = $data['comment'];
            $callback->update();
            return true;
        } catch(QueryException $e) {
            throw new UpdateCallbackException($e->getMessage());
        }
    }
}