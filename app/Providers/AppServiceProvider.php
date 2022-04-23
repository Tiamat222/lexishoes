<?php

namespace App\Providers;

use App\Shop\Admin\Settings\Services\SettingsService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Shop\Admin\Settings\Setting;

class AppServiceProvider extends ServiceProvider
{
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
    public function boot(SettingsService $settingsService)
    {
        Schema::defaultStringLength(191);
    }
}
