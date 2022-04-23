<?php

namespace Tests\Feature\Admin\AdminProfile;

use App\Shop\Admin\Feeds\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class AdminProfileFeatureTest extends TestCase
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
    public function admin_profile_page_can_be_shown()
    {
        Feed::factory()->create([
            'admin_id' => 1,
            'admin_login' => $this->admin->login,
            'type'=> 'create_admin',
            'feedable_id' => 1,
            'feedable_type' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $this
            ->get(route('admin.settings.profile.edit'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertViewHas('admin')
            ->assertViewHas('feeds')
            ->assertSee($this->admin->login)
            ->assertSee($this->admin->email)
            ->assertSee($this->admin->telephone);
    }

    /** @test **/
    public function admin_profile_can_be_updated()
    {
        $this
            ->put(route('admin.settings.profile.update', $this->admin->id), [
                'id' => $this->admin->id,
                'login' => 'Updated login',
                'email' => 'updatedEmail@gmail.com',
                'telephone' => '+38(099) 000-00-00'
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.profile.edit'))
            ->assertSessionHas(['success_message' => __('admin-profile.profile-data-success')]);
    }

    /** @test **/
    public function admin_profile_cannot_be_updated_if_the_login_is_incorrect()
    {
        $this
            ->put(route('admin.settings.profile.update', $this->admin->id), [
                'id' => $this->admin->id,
                'login' => 'Lo',
                'email' => 'login@gmail.com',
                'telephone' => '+38(099) 000-00-00'
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['login' => __('admin-profile.profile-login-min')]);
    }

    /** @test **/
    public function admin_profile_cannot_be_updated_if_the_email_is_incorrect()
    {
        $this
            ->put(route('admin.settings.profile.update', $this->admin->id), [
                'id' => $this->admin->id,
                'login' => 'Login',
                'email' => 'login.gmail.com',
                'telephone' => '+38(099) 000-00-00'
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['email' => __('admin-profile.profile-email-email')]);
    }

    /** @test **/
    public function admin_profile_cannot_be_updated_if_the_phone_is_incorrect()
    {
        $this
            ->put(route('admin.settings.profile.update', $this->admin->id), [
                'id' => $this->admin->id,
                'login' => 'Login',
                'email' => 'login@gmail.com',
                'telephone' => '+38 099 000-00-00'
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['telephone' => __('admin-profile.profile-telephone-regex')]);
    }

    /** @test **/
    public function admin_password_can_be_updated()
    {
        $this
            ->put(route('admin.settings.profile.pwd'), [
                'id' => $this->admin->id,
                'newPwd' => '123456', 
                'confirmPwd' => '123456'
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.login'))
            ->assertSessionHas(['success_message' => __('admin-profile.profile-pwd-success')]);
    }

    /** @test **/
    public function admin_password_cannot_be_updated_if_passwords_do_not_match()
    {
        $this
            ->put(route('admin.settings.profile.pwd'), [
                'id' => $this->admin->id,
                'newPwd' => '654321', 
                'confirmPwd' => '123456'
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['newPwd' => __('admin-profile.profile-newPwd-same')]);
    }

    /** @test **/
    public function the_admin_password_cannot_be_saved_if_the_password_is_less_than_six_characters_long()
    {
        $this
            ->put(route('admin.settings.profile.pwd'), [
                'id' => $this->admin->id,
                'newPwd' => '12345', 
                'confirmPwd' => '12345'
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['newPwd' => __('admin-profile.profile-newPwd-min')]);
    }

    /** @test **/
    public function admin_password_cannot_be_saved_if_the_password_field_is_left_empty()
    {
        $this
            ->put(route('admin.settings.profile.pwd'), [
                'id' => $this->admin->id,
                'newPwd' => '', 
                'confirmPwd' => ''
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['newPwd' => __('admin-profile.profile-newPwd-required')]);
    }
}