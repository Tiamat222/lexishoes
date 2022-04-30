<?php

namespace App\Shop\Admin\Feeds\Services;

use App\Shop\Admin\Feeds\Feed;
use App\Shop\Core\Admin\Base\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class AdminFeedsService extends BaseService
{    
    /**
     * AdminFeedsService constructor
     *
     * @param  Feed $model
     */
    public function __construct(Feed $model)
    {
        $this->model = $model;
    }
    
    /**
     * Get latest admins feeds
     *
     * @param  string $column
     * @param  null|string $param
     * 
     * @return LengthAwarePaginator
     */
    public function getLatestFeeds(string $column, ?string $param): LengthAwarePaginator
    {
        if($column !== null && $param !== null) {
            return $this
                    ->model
                    ->where('created_at','>', Carbon::now()->addDays(-14))
                    ->where($column, $param)
                    ->orderBy('id', 'asc')
                    ->paginate(get_setting('items_per_page'));
        }
        return $this
                ->model
                ->where('created_at','>', Carbon::now()->addDays(-14))
                ->orderBy('id', 'asc')
                ->paginate(get_setting('items_per_page'));
    }
}