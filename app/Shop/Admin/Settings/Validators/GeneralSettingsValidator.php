<?php
namespace App\Shop\Admin\Settings\Validators;

class GeneralSettingsValidator extends ValidatorRouter
{    
    /**
     * General settings validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'store_logo' => [
                'image',
                'mimes:jpeg,png,jpg',
            ],
            'admin_email' => [
                'required',
                'email',
            ],
        ];
    }
    
    /**
     * General settings validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'admin_email.required' => __('admin-settings.settings-adminEmail-required'),
            'admin_email.email' => __('admin-settings.settings-adminEmail-email'),
            'store_logo.image' => __('admin-settings.settings-storeLogo-image'),
            'store_logo.mimes' => __('admin-settings.settings-storeLogo-mimes'),
        ]; 
    }
}