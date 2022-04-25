<?php
namespace App\Shop\Admin\Settings\Validators;

class AdminSettingsValidator extends ValidatorRouter
{    
    /**
     * Admin panel settings validation rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'items_per_page' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }
    
    /**
     * Admin panel settings validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'items_per_page.required' => __('admin-settings.settings-countPerPage-required'),
            'items_per_page.integer' => __('admin-settings.settings-countPerPage-integer'),
            'items_per_page.min' => __('admin-settings.settings-countPerPage-min'),
        ]; 
    }
}