<?php
namespace App\Shop\Admin\Suppliers\Services;

use App\Shop\Admin\Suppliers\Exceptions\CreateSupplierErrorException;
use App\Shop\Admin\Suppliers\Exceptions\UpdateSupplierErrorException;
use App\Shop\Admin\Suppliers\Services\DTO\SupplierCreateDto;
use App\Shop\Admin\Suppliers\Services\DTO\SupplierUpdateDto;
use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Admin\Suppliers\Supplier;
use Illuminate\Database\QueryException;

class SupplierService extends BaseService
{    
    /**
     * SupplierService constructor
     *
     * @param  Supplier $supplier
     */
    public function __construct(Supplier $supplier)
    {
        $this->model = $supplier;
    }
    
    /**
     * Store new supplier
     *
     * @param  SupplierCreateDto $supplier
     * @throws CreateSupplierErrorException
     * 
     * @return bool
     */
    public function store(SupplierCreateDto $data): bool
    {
        try {
            $supplier = new Supplier();
            $supplier->name = $data->name;
            $supplier->description = $data->description;
            $supplier->save();
            return true;
        } catch(QueryException $e) {
            throw new CreateSupplierErrorException($e->getMessage());
        }
    }

    /**
     * Update supplier
     *
     * @param  SupplierUpdateDto $supplier
     * @throws UpdateSupplierErrorException
     * 
     * @return bool
     */
    public function update(SupplierUpdateDto $data): bool
    {
        try {
            $supplier = $this->getEntityById($data->id);
            $supplier->update([
                'name' => $data->name, 
                'description' => $data->description, 
            ]);
            return true;
        } catch(QueryException $e) {
            throw new UpdateSupplierErrorException($e->getMessage());
        }
    }
}
