<?php

namespace Tests\Unit\Admin\Settings;

use App\Shop\Admin\Settings\Services\SettingsService;
use App\Shop\Admin\Settings\Setting;
use App\Shop\Admin\Settings\Validators\UserSettingsValidator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * SettingsService instance
     *
     * @var SettingsService
     */
    private $settingsService;
    
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->settingsService = new SettingsService(new Setting());
        $this->rules = (new UserSettingsValidator())->rules();
        $this->validator = $this->app['validator']; 
    }

    /** @test */
    public function user_settings_can_be_updated()
    {
        $newData = [
            'target' => 'user_settings',
            'pwd_length' => 7,
        ];

        $saveGeneralSettings = $this->settingsService->storeSettings($newData);

        $this->assertTrue($saveGeneralSettings);
    }

    /** @test **/
    public function valid_pwd_length()
    {
        $this->assertTrue($this->validateField('pwd_length', 6));
        $this->assertFalse($this->validateField('pwd_length', 5));
        $this->assertFalse($this->validateField('pwd_length', 'test'));
        $this->assertFalse($this->validateField('pwd_length', ''));
    }
}
