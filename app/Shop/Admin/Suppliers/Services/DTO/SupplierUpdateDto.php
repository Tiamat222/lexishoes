<?php
namespace App\Shop\Admin\Suppliers\Services\DTO;

use Spatie\DataTransferObject\DataTransferObject;

final class SupplierUpdateDto extends DataTransferObject
{       
    /**
    * Supplier id
    *
    * @var int 
    */
    public int $id;

    /**
     * Supplier name
     * 
     * @var string
     */
    public string $name;
    
    /**
     * Supplier short comment
     * 
     * @var string|null
     */
    public string|null $description;
}
