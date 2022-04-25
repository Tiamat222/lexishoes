<?php

namespace Tests\Feature\Admin\Suppliers;

use App\Shop\Admin\Settings\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneralSettingsFeatureTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function settings_page_can_be_shown()
    {
        $this
            ->get(route('admin.settings.index'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertSee(get_setting('admin_email'))
            ->assertSee(get_setting('site_language'))
            ->assertSee(get_setting('items_per_page'))
            ->assertSee(get_setting('store_logo'))
            ->assertSee(get_setting('store_title'))
            ->assertSee(get_setting('pwd_length'))
            ->assertViewHas('settingsList');
    }

    /** @test **/
    public function general_settings_can_be_updated()
    {
        $this
            ->post(route('admin.settings.store'), [
                'target' => 'general_settings',
                'store_title' => 'New title',
                'admin_email' => 'new@mail.com',
                'site_language' => 'ua'
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.index'))
            ->assertSessionHas(['success_message' => __('admin-settings.settings-success')]);
    }

    /** @test **/
    public function admin_settings_can_be_updated()
    {
        $this
            ->post(route('admin.settings.store'), [
                'target' => 'admin_settings',
                'items_per_page' => 5
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.index'))
            ->assertSessionHas(['success_message' => __('admin-settings.settings-success')]);
    }

    /** @test **/
    public function user_settings_can_be_updated()
    {
        $this
            ->post(route('admin.settings.store'), [
                'target' => 'user_settings',
                'pwd_length' => 6
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.index'))
            ->assertSessionHas(['success_message' => __('admin-settings.settings-success')]);            
    }
}
