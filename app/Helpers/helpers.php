<?php

use Illuminate\Database\Eloquent\Collection;
use App\Shop\Admin\Settings\Services\SettingsService;
use App\Shop\Admin\Settings\Setting;
use Illuminate\Support\Facades\Hash;

if(!function_exists("get_setting")) {    
    /**
     * Get single setting (admin panel)
     *
     * @param  string $setting
     * 
     * @return null|string
     */
    function get_setting(string $setting): ?string
    {
        $settingsService = new SettingsService(new Setting());
        $alias = $settingsService->getSettingValue($setting);
        return $alias[$setting];
    }
}

if(!function_exists("pluck_collection_to_array")) {    
    /**
     * Pluck collection to array
     *
     * @param  Collection $collection
     * @param  string $firstKey
     * @param  null|string $secondKey
     * 
     * @return array
     */
    function pluck_collection_to_array(Collection $collection, string $firstKey, ?string $secondKey = null): array
    {
        if($secondKey) {
            return $collection->pluck($firstKey, $secondKey)->toArray();
        }
        return $collection->pluck($firstKey)->toArray();
    }
}

if(!function_exists("collections_to_array")) {        
    /**
     * Collecting data from specific column to array.
     * By default $table='name' (name of category)
     *
     * @param  Collection $collection
     * @param  string $table
     * 
     * @return array
     */
    function collections_to_array(Collection $collection, string $table = 'name'): array
    {
        $arrayWithCategories = array();
        $categoryArray = $collection->toArray();
        array_walk_recursive($categoryArray, function($item, $key) use(&$arrayWithCategories, $table) {
            if($key == $table){
                array_push($arrayWithCategories, $item);
            }
        });
        return array_reverse($arrayWithCategories);
    }
}

if(!function_exists("make_password")) {        
    /**
     * Make new password
     *
     * @param  string $collection
     * 
     * @return string
     */
    function make_password(string $password): string
    {
        return Hash::make($password);
    }
}

if(!function_exists("show_thumb")) {        
    /**
     * Output thumbnail
     *
     * @param  string $imagesLinks
     * 
     * @return string
     */
    function show_thumb(string $imagesLinks): string
    {
        $imgArray = explode(',', $imagesLinks);
        return $imgArray[0];
    }
}

if(!function_exists("show_avatar")) {        
    /**
     * Output avatar
     *
     * @param  string $imagesLinks
     * 
     * @return string
     */
    function show_avatar(string $imagesLinks): string
    {
        $imgArray = explode(',', $imagesLinks);
        if(count($imgArray) > 1) {
            return $imgArray[1];
        }
        return $imagesLinks;
    }
}
