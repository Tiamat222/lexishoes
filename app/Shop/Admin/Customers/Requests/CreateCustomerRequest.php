<?php

namespace App\Shop\Admin\Customers\Requests;

use App\Shop\Admin\Customers\Services\DTO\CustomerCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
            ],
            'last_name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                'unique:customers',
            ],
            'phone' => [
                'required',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
                'unique:customers',
                'different:dop_phone'
            ],
            'dop_phone' => [
                'nullable',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
                'unique:customers',
            ],
            'password' => [
                'required',
                'min:' . get_setting('pwd_length')
            ]
        ];
    }

    /**
     * Validation messages.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'first_name.required' => __('admin-customers.customer-firstName-required'),
            'last_name.required' => __('admin-customers.customer-lastName-required'),
            'email.required' => __('admin-customers.customer-email-required'),
            'email.email' => __('admin-customers.customer-email-email'),
            'email.unique' => __('admin-customers.customer-email-unique'),
            'phone.required' => __('admin-customers.customer-phone-required'),
            'phone.regex' => __('admin-customers.customer-phone-regex'),
            'phone.unique' => __('admin-customers.customer-phone-unique'),
            'phone.different' => __('admin-customers.customer-phone-different'),
            'dop_phone.regex' => __('admin-customers.customer-dopPhone-regex'),
            'dop_phone.unique' => __('admin-customers.customer-dopPhone-unique'),
            'password.required' => __('admin-customers.customer-password-required'),
            'password.min' => __('admin-customers.customer-password-min'),
        ]; 
    }
    
    /**
     * Category create DTO
     *
     * @return CustomerCreateDto
     */
    public function data(): CustomerCreateDto
    {
        return new CustomerCreateDto([
            'first_name' => $this->input('first_name'),
            'last_name' => $this->input('last_name'),
            'phone' => $this->input('phone'),
            'dop_phone' => $this->input('dop_phone'),
            'email' => $this->input('email'),
            'address' => $this->input('address'),
            'comment' => $this->input('comment'),
            'password' => $this->input('password'),
        ]);
    }
}