<?php
namespace App\Shop\Admin\Settings\Validators;

use App\Shop\Admin\Settings\Validators\GeneralSettingsValidator;

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
                return (new GeneralSettingsValidator)->validate($data);
        }
    }
}