<?php

namespace App\Shop\Admin\Pages\Services;

use App\Shop\Admin\Pages\Page;
use App\Shop\Core\Admin\Base\Services\BaseService;

class PageService extends BaseService
{    
    /**
     * PageService constructor
     *
     * @param  Page $model
     */
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}