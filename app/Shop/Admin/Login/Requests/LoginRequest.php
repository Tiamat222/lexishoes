<?php

namespace App\Shop\Admin\Login\Requests;

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
            'login' => [
                'required',
                'exists:admins',
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
            'login.required' => __('admin-login.admin-login-required'),
            'login.exists' => __('admin-login.admin-login-exists'),
            'password.required' => __('admin-login.admin-password-required'),
        ]; 
    }
}