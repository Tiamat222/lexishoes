<?php

namespace App\Shop\Admin\Login\Services;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Core\Traits\UserLoginTrait;

class LoginService extends BaseService
{
    use UserLoginTrait;
    
    /**
     * LoginService constructor
     *
     * @param  Admin $model
     */
    public function __construct(Admin $model)
    {
        $this->model = $model;
        $this->maxAttempts = get_setting('admin_max_attempts');
        $this->decayMinutes = get_setting('admin_decay_minutes');
    }
}