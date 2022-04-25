<?php

namespace Tests\Unit\Admin\Settings;

use App\Shop\Admin\Settings\Services\SettingsService;
use App\Shop\Admin\Settings\Setting;
use App\Shop\Admin\Settings\Validators\GeneralSettingsValidator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneralSettingsTest extends TestCase
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
        $this->rules = (new GeneralSettingsValidator())->rules();
        $this->validator = $this->app['validator']; 
    }

    /** @test */
    public function all_settings_can_be_fetched_from_db()
    {
        $getAllSettings = $this->settingsService->getAllSettingsToArray();
        $this->assertIsArray($getAllSettings);
        $this->assertEquals(6, count($getAllSettings));
    }

    /** @test */
    public function general_settings_can_be_updated()
    {
        $newData = [
            'target' => 'general_settings',
            'store_title' => 'New title',
            'admin_email' => 'newemail@gmail.com',
            'site_language' => 'ua'
        ];

        $saveGeneralSettings = $this->settingsService->storeSettings($newData);

        $this->assertTrue($saveGeneralSettings);
    }

    /** @test **/
    public function valid_admin_email()
    {
        $this->assertTrue($this->validateField('admin_email', 'test@gmail.com'));
        $this->assertTrue($this->validateField('admin_email', '1234test@gmail.name.com'));
        $this->assertTrue($this->validateField('admin_email', 'логин-1@i.ru'));
        $this->assertTrue($this->validateField('admin_email', '123456-@gmail.com'));
        $this->assertTrue($this->validateField('admin_email', '123456@ru.name.ru.ua'));
        $this->assertFalse($this->validateField('admin_email', ''));
        $this->assertFalse($this->validateField('admin_email', '123456@.com'));
        $this->assertFalse($this->validateField('admin_email', '.123456@i.ru'));
        $this->assertFalse($this->validateField('admin_email', '123.gmail.com'));
        $this->assertFalse($this->validateField('admin_email', '123'));
        $this->assertFalse($this->validateField('admin_email', '@gmail.com'));
    }
}
