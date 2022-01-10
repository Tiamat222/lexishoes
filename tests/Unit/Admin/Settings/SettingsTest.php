<?php

namespace Tests\Unit\Admin\Settings;

use App\Shop\Admin\Settings\Services\SettingsService;
use App\Shop\Admin\Settings\Setting;
use App\Shop\Admin\Settings\Validators\GeneralSettingsValidator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class SettingsTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * SettingsService instance
     *
     * @var SettingsService
     */
    private $settingsService;

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
        Setting::factory(5)->create();
        $getAllSettings = $this->settingsService->getAllSettingsToArray();
        $this->assertIsArray($getAllSettings);
        $this->assertEquals(5, count($getAllSettings));
    }

    /** @test */
    public function general_settings_can_be_updated()
    {
        $setting = [
            'store_title',
            'admin_page',
            'admin_email',
            'site_language'
        ];

        $values = [
            Str::random(5),
            Str::random(5),
            Str::random(5) . '@gmail.com',
            'rus'
        ];

        for($i=0; $i <= count($setting)-1; $i++){
            $supplier = Setting::create([
                'setting' => $setting[$i],
                'value' => $values[$i],
            ]);
        }

        $newData = [
            'target' => 'general_settings',
            'store_title' => 'New title',
            'admin_page' => 'new-alias',
            'admin_email' => 'newemail@gmail.com',
            'site_language' => 'ua'

        ];
        $saveGeneralSettings = $this->settingsService->storeSettings($newData);

        $this->assertTrue($saveGeneralSettings);
    }

    /** @test **/
    public function valid_admin_alias()
    {
        $this->assertTrue($this->validateField('admin_page', 'adm'));
        $this->assertTrue($this->validateField('admin_page', 'admin-page'));
        $this->assertTrue($this->validateField('admin_page', 'admin-page09'));
        $this->assertFalse($this->validateField('admin_page', ''));
        $this->assertFalse($this->validateField('admin_page', ' '));
        $this->assertFalse($this->validateField('admin_page', 'ad'));
        $this->assertFalse($this->validateField('admin_page', 'Admin'));
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

    protected function getFieldValidator($field, $value)
    {
        return $this->validator->make(
            [$field => $value], 
            [$field => $this->rules[$field]]
        );
    }

    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}
