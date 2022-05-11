<?php

namespace App\Shop\Front\Login\Services;

use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Front\Register\Customer;
use App\Shop\Core\Traits\UserLoginTrait;

class LoginService extends BaseService
{
    use UserLoginTrait;
    
    /**
     * LoginService constructor
     *
     * @param  Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
        $this->maxAttempts = get_setting('customer_max_attempts');
        $this->decayMinutes = get_setting('customer_decay_minutes');
    }
}