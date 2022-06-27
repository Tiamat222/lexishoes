<?php

namespace App\Providers;

use App\Shop\Admin\Categories\Services\CategoryService;
use App\Shop\Admin\Pages\Services\PageService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;

class FrontTemplateServiceProvider extends ServiceProvider
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
    public function boot(PageService $pageService, CategoryService $categoryService)
    {
        // Outputting store pages in header
        if(Schema::hasTable('pages')) {
            $pagesList = new Collection();
            foreach($pageService->getAllRecords() as $page) {
                if($page->status !== 0) {
                    $pagesList->push($page);
                }
            }
            view()->share('pages', pluck_collection_to_array($pagesList, 'title', 'slug'));
        }

        // Outputting categories in sidebar
        if(Schema::hasTable('categories')) {
            view()->share('categories', $categoryService->getParentCategoriesWithChildrens());
        }
    }
}
