<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * Load all routes
     *
     * @return void
     */
    public function map()
    {
        $this->mapBreadcrumbsWebRoutes();
        $this->mapFrontWebRoutes();
        $this->mapAdminWebRoutes();
        $this->mapApiWebRoutes();
    }

    /**
     * Admin routes
     *
     * @return void
     */
    protected function mapAdminWebRoutes()
    {
        Route::middleware('web')
            ->as('admin.')
            ->namespace('App\Http\Controllers\Admin')
            ->prefix('admin')
            ->group(base_path('routes/web/admin.php'));
    }

    /**
     * Front routes
     *
     * @return void
     */
    protected function mapFrontWebRoutes()
    {
        Route::middleware('web')
            ->as('front.')
            ->namespace('App\Http\Controllers\Front')
            ->group(base_path('routes/web/front.php'));
    }

    /**
     * Breadcrumbs routes
     *
     * @return void
     */
    protected function mapBreadcrumbsWebRoutes()
    {
        Route::namespace($this->namespace)
            ->group(base_path('routes/web/breadcrumbs.php'));
    }

    /**
     * Api routes
     *
     * @return void
     */
    protected function mapApiWebRoutes()
    {
        Route::middleware('api')
            ->namespace($this->namespace)
            ->prefix('api')
            ->group(base_path('routes/api/api.php'));
    }
}
