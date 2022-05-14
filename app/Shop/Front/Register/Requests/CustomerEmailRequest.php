<?php

namespace App\Shop\Front\Register\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerEmailRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'exists:customers',
            ],
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
            'email.required' => __('front-reg-customer.customer-email-required'),
            'email.email'    => __('front-reg-customer.customer-email-email'),
            'email.exists'   => __('front-reg-customer.customer-email-exists')
        ]; 
    }
}