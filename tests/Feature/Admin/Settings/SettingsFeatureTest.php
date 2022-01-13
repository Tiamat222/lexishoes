<?php

namespace Tests\Feature\Admin\Suppliers;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Settings\Services\SettingsService;
use App\Shop\Admin\Settings\Setting;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GeneralSettingsFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function settings_page_can_be_shown()
    {
        $setting = [
            'store_title',
            'store_logo',
            'admin_page',
            'admin_email',
            'site_language'
        ];

        $values = [
            'Store title',
            '',
            'admin-alias',
            'test@gmail.com',
            'rus'
        ];

        for($i=0; $i <= count($setting)-1; $i++){
            Setting::create([
                'setting' => $setting[$i],
                'value' => $values[$i],
            ]);
        }

        $this
            ->actingAs($this->admin, 'admins')
            ->get(route('admin.settings.index'))
            ->assertStatus(200)
            ->assertSee($values[0])
            ->assertSee($values[2])
            ->assertSee($values[3])
            ->assertSee($values[4]);
    }

    /** @test **/
    public function general_settings_can_be_updated()
    {
        $setting = [
            'store_title',
            'store_logo',
            'admin_page',
            'admin_email',
            'site_language'
        ];

        $values = [
            'Store title',
            '',
            'admin-alias',
            'test@gmail.com',
            'rus'
        ];

        for($i=0; $i <= count($setting)-1; $i++){
            Setting::create([
                'setting' => $setting[$i],
                'value' => $values[$i],
            ]);
        }

        $this
            ->actingAs($this->admin, 'admins')
            ->post(route('admin.settings.store'), [
                'target' => 'general_settings',
                'store_title' => 'New title',
                'admin_page' => 'newalias',
                'admin_email' => 'new@mail.com',
                'site_language' => 'ua'])
            ->assertStatus(302)
            ->assertRedirect(route('admin.settings.index'))
            ->assertSessionHas(['success_message' => __('admin-settings.settings-success')]);            
    }
}
