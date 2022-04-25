<?php

namespace Database\Factories\Shop\Admin\Settings;

use App\Shop\Admin\Settings\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SettingFactory extends Factory
{
    /**
     * Table associated with the factory
     *
     * @var Setting
     */
    protected $model = Setting::class;

    public function definition()
    {
        return [
            'setting' => Str::random(5), 
            'value' => Str::random(5), 
        ]; 
    }
}