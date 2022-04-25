<?php

namespace App\Shop\Admin\Settings\Services;

use App\Shop\Admin\Settings\Setting;
use App\Shop\Admin\Settings\Validators\ValidatorRouter;
use App\Shop\Core\Admin\Base\Services\BaseService;
use App\Shop\Core\Admin\Traits\ImageUploaderTrait;

class SettingsService extends BaseService
{   
    use ImageUploaderTrait;

    /**
     * SettingsService constructor
     *
     * @param  Setting $setting
     */
    public function __construct(Setting $setting)
    {
        $this->model = $setting;
    }

    /**
     * Get all settings
     *
     * @return array
     */
    public function getAllSettingsToArray(): array
    {
        return $this
                ->model
                ->get()
                ->pluck('value', 'setting')
                ->toArray();
    }

    /**
     * Get single setting
     *
     * @param  string $value
     *
     * @return array
     */
    public function getSettingValue(string $value): array
    {
        return $this
                ->model
                ->where('setting', $value)
                ->pluck('value', 'setting')
                ->toArray();
    }

    /**
     * Save settings
     *
     * @param  array $data
     * 
     * @return bool
     */
    public function storeSettings(array $data): bool
    {
        $validatedData = (new ValidatorRouter)->validate($data);
        if($validatedData) {
            if(isset($data['store_logo']) && $data['store_logo'] !== '') {
                $validatedData['store_logo'] = $this->uploadImages([100], $data['store_logo']);
            }
            foreach($validatedData as $key => $value) {
                $row = $this->model->where('setting', $key)->first();
                $row->update(['value' => $value]);
            }
            session()->flash('success_message', __('admin-settings.settings-success'));
            return true;
        }
        return false;
    }
}