<?php

namespace App\Shop\Front\Register\Services;

use App\Shop\Front\Register\Customer;
use App\Shop\Admin\Customers\Exceptions\CreateCustomerErrorException;
use App\Shop\Admin\Customers\Services\CustomerService;
use App\Shop\Front\Register\Services\DTO\CustomerCreateDto;
use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Front\Register\Email\CustomerRegisterEmail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;

class RegisterService extends BaseService
{    
    /**
     * CustomerService instance
     *
     * @var CustomerService
     */
    private $customerService;
    
    /**
     * RegisterService constructor
     *
     * @param  Customer $model
     */
    public function __construct(Customer $model, CustomerService $customerService)
    {
        $this->model = $model;
        $this->customerService = $customerService;
    }
    
    /**
     * Store new customer
     *
     * @param  CustomerCreateDto $dataToStore
     * 
     * @return bool
     */
    public function store(CustomerCreateDto $dataToStore): bool
    {
        try {
            $customer = $this->customerService->getRecordById(1);
            $customer = new Customer();
            $customer->first_name = $dataToStore->first_name;
            $customer->last_name = $dataToStore->last_name;
            $customer->phone = $dataToStore->phone;
            $customer->email = $dataToStore->email;
            $customer->status = 0;
            $customer->password = make_password($dataToStore->password);
            $customer->token = make_token();
            $customer->save();
            Mail::to($customer->email)->send(new CustomerRegisterEmail([
                'customer_token' => $customer->token,
                'customer_id'    => $customer->id
            ]));
            return true;
        } catch(QueryException $e) {
            throw new CreateCustomerErrorException($e->getMessage());
        }
    }
    
    /**
     * Check token
     *
     * @param  string $customerToken
     * @param  int $customerId
     * 
     * @return bool
     */
    public function checkToken(string $customerToken, int $customerId): bool
    {
        $customer = $this->getRecordById($customerId);
        $dateDiff = diff_date(Carbon::now(), $customer->updated_at);
        if($customer->token === $customerToken && $dateDiff < 1) {
            $customer->status = 1;
            $customer->token = NULL;
            $customer->update();
            return true;
        }
        return false;
    }
    
    /**
     * Resending email if token was expired
     *
     * @param  string $customerEmail
     * 
     * @return bool
     */
    public function resendEmail(string $customerEmail): bool
    {
        $customer = $this->getRecordByField('email', $customerEmail);
        $customer->token = make_token();
        $customer->update();
        Mail::to($customer->email)->send(new CustomerRegisterEmail([
            'customer_token' => $customer->token,
            'customer_id'    => $customer->id
        ]));
        return true;
    }
}