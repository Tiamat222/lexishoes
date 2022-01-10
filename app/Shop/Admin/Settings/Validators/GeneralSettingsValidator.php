<?php
namespace App\Shop\Admin\Settings\Validators;

use Illuminate\Support\Facades\Validator;

class GeneralSettingsValidator
{    
    /**
     * Data validation
     *
     * @param array $data
     * 
     * @return array|bool
     */
    public function validate(array $data): array|bool
    {
        $validator = Validator::make($data, $this->rules(), $this->messages());
        if($validator->fails()) {
            $errors = $validator->messages();
            session()->flash('error_message', $errors->all());
            return false;
        }
        unset($data['target']);
        return $data;
    }
    
    /**
     * General settings validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'admin_page' => [
                'required',
                'regex:/^[a-z0-9-]*$/',
                'min:3',
            ],
            'admin_email' => [
                'required',
                'email',
            ],
            'store_logo' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
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
            'admin_page.required' => __('admin-settings.settings-adminPage-required'),
            'admin_page.regex' => __('admin-settings.settings-adminPage-regex'),
            'admin_page.min' => __('admin-settings.settings-adminPage-min'),
            'admin_email.required' => __('admin-settings.settings-adminEmail-required'),
            'admin_email.email' => __('admin-settings.settings-adminEmail-email'),
            'store_logo.image' => __('admin-settings.settings-storeLogo-image'),
            'store_logo.mimes' => __('admin-settings.settings-storeLogo-mimes'),
        ]; 
    }
}