<?php
namespace App\Shop\Admin\Export\Services;

class ExportService
{    
    /**
     * Get path to unit
     *
     * @param  string $table
     * 
     * @return string
     */
    public function getUnit(string $table): string
    {
        $namespace = 'App\Shop\Admin\Export\Units\\';
        $className = $namespace . ucfirst($table) . 'Export';
        return $className;
    }
}