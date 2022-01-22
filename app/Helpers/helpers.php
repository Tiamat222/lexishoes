<?php
use Illuminate\Database\Eloquent\Collection;

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
