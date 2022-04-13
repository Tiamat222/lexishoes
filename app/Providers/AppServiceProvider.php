<?php

namespace App\Providers;

use App\Shop\Admin\Settings\Services\SettingsService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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

        if(Schema::hasTable('general_settings')){
            $storeLogo = $settingsService->getAllSettingsToArray()['store_logo'];
            if(isset($storeLogo) && $storeLogo === '') {
                $storeLogo = 'storage/images/default-images/default-store.jpg';
            }
            
            $storeTitle = $settingsService->getAllSettingsToArray()['store_title'];
            if(isset($storeTitle) && $storeTitle === '') {
                $storeTitle = 'Нет названия';
            }

            view()->composer('layouts.admin-layouts.sidebar', function($view) use ($storeLogo, $storeTitle) {
                $view->with([
                    'storeLogo' => $storeLogo,
                    'storeTitle' => $storeTitle,
                ]);
            });
        }
    }
}
