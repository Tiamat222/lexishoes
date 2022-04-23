<?php

namespace App\Shop\Admin\AdminProfile\Requests;

use App\Shop\Admin\AdminProfile\Services\DTO\ChangePasswordDto;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'newPwd' => [
                'required',
                'min:6',
                'same:confirmPwd'
            ],
            'confirmPwd' => [
                'required'
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
            'newPwd.required'     => __('admin-profile.profile-newPwd-required'),
            'newPwd.min'          => __('admin-profile.profile-newPwd-min'),
            'newPwd.same'         => __('admin-profile.profile-newPwd-same'),
            'confirmPwd.required' => __('admin-profile.profile-confirmPwd-required')
        ]; 
    }
    
    /**
     * Change password DTO
     *
     * @return ChangePasswordDto
     */
    public function data(): ChangePasswordDto
    {
        return new ChangePasswordDto([
            'id' => request()->get('id'),
            'newPwd' => $this->input('newPwd'),
            'confirmPwd' => $this->input('confirmPwd'),
        ]);
    }
}