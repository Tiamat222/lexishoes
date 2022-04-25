<?php

namespace App\Shop\Admin\Customers\Services;

use App\Shop\Admin\Customers\Customer;
use App\Shop\Admin\Customers\Exceptions\CreateCustomerErrorException;
use App\Shop\Admin\Customers\Exceptions\UpdateCustomerErrorException;
use App\Shop\Admin\Customers\Services\DTO\CustomerCreateDto;
use App\Shop\Admin\Customers\Services\DTO\CustomerUpdateDto;
use App\Shop\Core\Admin\Base\Services\BaseService;
use Illuminate\Database\QueryException;

class CustomerService extends BaseService
{    
    /**
     * CustomerService constructor
     *
     * @param  Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }
    
    /**
     * Store new customer
     *
     * @param  CustomerCreateDto $data
     * 
     * @throws CreateCustomerErrorException
     * @return bool
     */
    public function store(CustomerCreateDto $data): bool
    {
        try {
            $customer = new Customer();
            $customer->first_name = $data->first_name;
            $customer->last_name = $data->last_name;
            $customer->phone = $data->phone;
            $customer->dop_phone = $data->dop_phone;
            $customer->email = $data->email;
            $customer->address = $data->address;
            $customer->comment = $data->comment;
            $customer->status = 1;
            $customer->password = make_password($data->password);
            $customer->save();
            return true;
        } catch(QueryException $e) {
            throw new CreateCustomerErrorException($e->getMessage());
        }
    }
    
    /**
     * Update customer
     *
     * @param  CustomerUpdateDto $data
     * 
     * @throws UpdateCustomerErrorException
     * @return bool
     */
    public function update(CustomerUpdateDto $data): bool
    {
        try {
            $customer = $this->getRecordById($data->id);
            $customer->first_name = $data->first_name;
            $customer->last_name = $data->last_name;
            $customer->email = $data->email;
            $customer->phone = $data->phone;
            $customer->address = $data->address;
            $customer->comment = $data->comment;
            if($data->password !== null) {
                $customer->password = make_password($data->password);
            }
            $customer->update();
            return true;
        } catch(QueryException $e) {
            throw new UpdateCustomerErrorException($e->getMessage());
        }
    }
}