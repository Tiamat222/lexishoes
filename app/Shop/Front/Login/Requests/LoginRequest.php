<?php

namespace App\Shop\Front\Login\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => [
                'required',
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
            'email.required'      => __('front-login-customer.customer-email-required'),
            'email.email'         => __('front-login-customer.customer-email-email'),
            'email.exists'        => __('front-login-customer.customer-email-exists'),
            'password.required'   => __('front-login-customer.customer-password-required')
        ]; 
    }
}