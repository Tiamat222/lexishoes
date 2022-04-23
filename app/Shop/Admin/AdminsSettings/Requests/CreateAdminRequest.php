<?php

namespace App\Shop\Admin\AdminsSettings\Requests;

use App\Shop\Admin\AdminsSettings\Services\DTO\AdminCreateDto;
use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
                'min:3',
                'max:20',
                'unique:admins',
            ],
            'email' => [
                'required',
                'email',
                'unique:admins',
            ],
            'telephone' => [
                'required',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
                'unique:admins',
            ],
            'newPwd' => [
                'required',
                'min:6',
                'same:confirmPwd'
            ],
            'confirmPwd' => [
                'required'
            ],
            'avatar' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
            ],
            'permissions' => [
                'required',
                'regex:/^[0-9,]*$/'
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
            'login.required' => __('admins-settings.admins-login-required'),
            'login.min' => __('admins-settings.admins-login-min'),
            'login.max' => __('admins-settings.admins-login-max'),
            'login.unique' => __('admins-settings.admins-login-unique'),
            'email.required' => __('admins-settings.admins-email-required'),
            'email.email' => __('admins-settings.admins-email-email'),
            'email.unique' => __('admins-settings.admins-email-unique'),
            'telephone.required' => __('admins-settings.admins-telephone-required'),
            'telephone.regex' => __('admins-settings.admins-telephone-regex'),
            'newPwd.required' => __('admins-settings.admins-newPwd-required'),
            'newPwd.min' => __('admins-settings.admins-newPwd-min'),
            'newPwd.same' => __('admins-settings.admins-newPwd-same'),
            'confirmPwd.required' => __('admins-settings.admins-confirmPwd-required'),
            'category_image.image' => __('admins-settings.admins-image-image'),
            'category_image.mimes' => __('admins-settings.admins-image-mimes'),
            'permissions.required' => __('admins-settings.admins-permissions-required'),
            'permissions.regex' => __('admins-settings.admins-permissions-regex')
        ]; 
    }
    
    /**
     * Admin create DTO
     *
     * @return AdminCreateDto
     */
    public function data(): AdminCreateDto
    {
        return new AdminCreateDto([
            'login' => $this->input('login'),
            'email' => $this->input('email'), 
            'telephone' => $this->input('telephone'),
            'newPwd' => $this->input('newPwd'),
            'confirmPwd' => $this->input('confirmPwd'),
            'permissions' => $this->input('permissions'),
            'avatar' => $this->file('avatar'), 
        ]);
    }
}