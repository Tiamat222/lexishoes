<?php

namespace Tests\Unit\Admin\Settings;

use App\Shop\Admin\Settings\Services\SettingsService;
use App\Shop\Admin\Settings\Setting;
use App\Shop\Admin\Settings\Validators\AdminSettingsValidator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSettingsTest extends TestCase
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
        $this->rules = (new AdminSettingsValidator())->rules();
        $this->validator = $this->app['validator']; 
    }

    /** @test */
    public function admin_settings_can_be_updated()
    {
        $newData = [
            'target' => 'admin_settings',
            'items_per_page' => 6,
        ];

        $saveGeneralSettings = $this->settingsService->storeSettings($newData);

        $this->assertTrue($saveGeneralSettings);
    }

    /** @test **/
    public function valid_items_per_page()
    {
        $this->assertTrue($this->validateField('items_per_page', 6));
        $this->assertFalse($this->validateField('items_per_page', 0));
        $this->assertFalse($this->validateField('items_per_page', 'test'));
        $this->assertFalse($this->validateField('items_per_page', ''));
    }
}
