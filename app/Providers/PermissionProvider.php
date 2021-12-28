<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class PermissionProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('permission', function ($permission) {
            return "<?php if(auth()->guard('admins')->user() && auth()->guard('admins')->user()->hasPermission({$permission})): ?>";
        });
        Blade::directive('endpermission', function ($permission) {
            return "<?php endif; ?>";
        });
    }
}
