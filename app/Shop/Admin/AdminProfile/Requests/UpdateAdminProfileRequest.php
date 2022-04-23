<?php

namespace App\Shop\Admin\AdminProfile\Requests;

use App\Shop\Admin\AdminProfile\Services\DTO\AdminProfileUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminProfileRequest extends FormRequest
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
        $adminId = request()->get('id');
        return [
            'login' => [
                'required',
                'min:3',
                'max:20',
                Rule::unique('admins')->ignore($adminId),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($adminId),
            ],
            'telephone' => [
                'required',
                'regex:/^\+38\(\d{3}\) \d{3}-?\d{2}-?\d{2}$/',
                Rule::unique('admins')->ignore($adminId),
            ],
            'avatar' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
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
            'login.required'     => __('admin-profile.profile-login-required'),
            'login.unique'       => __('admin-profile.profile-login-unique'),
            'login.min'          => __('admin-profile.profile-login-min'),
            'login.max'          => __('admin-profile.profile-login-max'),
            'email.required'     => __('admin-profile.profile-email-required'),
            'email.email'        => __('admin-profile.profile-email-email'),
            'email.unique'       => __('admin-profile.profile-email-unique'),
            'telephone.required' => __('admin-profile.profile-telephone-required'),
            'telephone.unique'   => __('admin-profile.profile-telephone-unique'),
            'telephone.regex'    => __('admin-profile.profile-telephone-regex'),
            'avatar.image'       => __('admin-profile.profile-avatar-image'),
            'avatar.mimes'       => __('admin-profile.profile-avatar-mimes'),
        ]; 
    }
    
    /**
     * Admin profile update DTO
     *
     * @return AdminProfileUpdateDto
     */
    public function data(): AdminProfileUpdateDto
    {
        return new AdminProfileUpdateDto([
            'id' => request()->get('id'),
            'login' => $this->input('login'), 
            'email' => $this->input('email'), 
            'telephone' => $this->input('telephone'),
            'avatar' => $this->file('avatar')
        ]);
    }
}