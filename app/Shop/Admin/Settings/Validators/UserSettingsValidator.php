<?php

namespace App\Shop\Admin\Settings\Validators;

class UserSettingsValidator extends ValidatorRouter
{    
    /**
     * User settings validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'pwd_length' => [
                'required',
                'integer',
                'min:6',
            ],
        ];
    }
    
    /**
     * User settings validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'pwd_length.required' => __('admin-settings.settings-pwdLength-required'),
            'pwd_length.min' => __('admin-settings.settings-pwdLength-min'),
        ]; 
    }
}