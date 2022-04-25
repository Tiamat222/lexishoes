<?php
namespace App\Shop\Admin\Settings\Validators;

use App\Shop\Admin\Settings\Validators\GeneralSettingsValidator;
use App\Shop\Admin\Settings\Validators\AdminSettingsValidator;
use Illuminate\Support\Facades\Validator;

class ValidatorRouter
{    
    /**
     * Entry point for settings validation
     *
     * @param  array $data
     * 
     * @return array|bool
     */
    public function validate(array $data): array|bool
    {
        switch($data['target']) {
            case 'general_settings':
                return (new GeneralSettingsValidator)->validateData($data);
            case 'admin_settings':
                return (new AdminSettingsValidator)->validateData($data);
            case 'user_settings':
                return (new UserSettingsValidator)->validateData($data);
        }
    }

    /**
     * Data validation
     *
     * @param array $data
     *
     * @return array|bool
     */
    public function validateData(array $data): array|bool
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
}