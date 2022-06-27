<?php

namespace App\Providers;

use App\Shop\Admin\Orders\Order;
use App\Shop\Admin\Orders\Services\OrderService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;

class AppServiceProvider extends ServiceProvider
{    
    /**
     * OrderService instance
     *
     * @var OrderService
     */
    private $orderService;
    
    /**
     * AppServiceProvider constructor
     */
    public function __construct()
    {
        $this->orderService = new OrderService(new Order());
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if(Schema::hasTable('orders')) {
            view()->share('newOrders', $this->orderService->countRecordsByField('status', '=', 0));
        }
    }
}
