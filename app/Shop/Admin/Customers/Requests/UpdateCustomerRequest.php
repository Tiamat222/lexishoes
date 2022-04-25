<?php
namespace App\Shop\Admin\Customers\Requests;

use App\Shop\Admin\Customers\Services\DTO\CustomerUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        $customerId = request()->get('id');
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
                Rule::unique('customers')->ignore($customerId),
            ],
            'phone' => [
                'required',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
                'different:dop_phone',
                Rule::unique('customers')->ignore($customerId),
            ],
            'dop_phone' => [
                'nullable',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
                Rule::unique('customers')->ignore($customerId),
            ],
            'password' => [
                'nullable',
                'min:6'
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
            'dop_phone.regex' => __('admin-customers.customer-password-required'),
            'dop_phone.unique' => __('admin-customers.customer-password-min'),
            'password.min' => __('admin-customers.customer-password-min'),
        ]; 
    }
    
    /**
     * Category update DTO
     *
     * @return CustomerUpdateDto
     */
    public function data(): CustomerUpdateDto
    {
        return new CustomerUpdateDto([
            'id' => request()->get('id'),
            'first_name' => $this->input('first_name'), 
            'last_name' => $this->input('last_name'), 
            'phone' => $this->input('phone'), 
            'email' => $this->input('email'), 
            'address' => $this->input('address'), 
            'comment' => $this->input('comment'), 
            'password' => $this->input('password'), 
        ]);
    }
}