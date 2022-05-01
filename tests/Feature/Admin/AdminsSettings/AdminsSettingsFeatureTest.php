<?php
namespace Tests\Feature\Admin\AdminsSettings;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Admins\Services\AdminService;
use App\Shop\Admin\AdminsSettings\Services\AdminsSettingsService;
use App\Shop\Admin\Feeds\Feed;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Permissions\Services\PermissionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class AdminsSettingsFeatureTest extends TestCase
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

        $this->adminsSettingsService = (new AdminsSettingsService(
            new Admin(), 
            new AdminService(new Admin()), 
            new PermissionService(new Permission(), 
            new AdminService(new Admin())))
        );
    }

    /** @test **/
    public function admins_list_page_can_be_shown()
    {
        $this
            ->get(route('admin.settings.admins.index'))
            ->assertStatus(200)
            ->assertSee($this->admin->login)
            ->assertSee($this->admin->email)
            ->assertSee($this->admin->telephone)
            ->assertViewHas('admins')
            ->assertViewHas('adminsInTrash');
    }

    /** @test **/
    public function admin_create_page_can_be_shown()
    {
        $this
            ->get(route('admin.settings.admins.create'))
            ->assertStatus(200)
            ->assertViewHas('adminsInTrash')
            ->assertViewHas('permissions');
    }

    /** @test **/
    public function admin_can_be_created()
    {
        $this
            ->post(route('admin.settings.admins.store'), [
                'login' => 'New admin',
                'email' => 'newEmail@gmail.com',
                'telephone' => '+38(999) 888-88-88',
                'newPwd' => 'newPassword',
                'confirmPwd' => 'newPassword',
                'permissions' => '1,2'
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.admins.index'))
            ->assertSessionHas(['success_message' => __('admins-settings.admins-create-new-admin')]);
    }

    /** @test **/
    public function admin_edit_page_can_be_shown()
    {
        $this
            ->get(route('admin.settings.admins.edit', $this->admin->id))
            ->assertStatus(200)
            ->assertSee($this->admin->login)
            ->assertSee($this->admin->email)
            ->assertSee($this->admin->telephone)
            ->assertViewHas('adminsInTrash')
            ->assertViewHas('permissions');
    }

    /** @test **/
    public function admin_can_be_updated()
    {
        $this
            ->put(route('admin.settings.admins.update', $this->admin->id), [
                'id' => $this->admin->id,
                'login' => 'Test admin',
                'email' => 'testEmail@gmail.com',
                'telephone' => '+38(999) 999-99-99',
                'permissions' => '1,2,3',
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHas(['success_message' => __('admins-settings.admins-update-success')]);
    }

    /** @test **/
    public function admins_trash_page_can_be_shown()
    {
        $this->admin->deleted_at = Carbon::now();
        $this->admin->save();

        $this
            ->get(route('admin.settings.admins.trash'))
            ->assertStatus(200)
            ->assertSee($this->admin->login)
            ->assertSee($this->admin->email)
            ->assertSee($this->admin->telephone)
            ->assertViewHas('adminsInTrash');
    }

    /** @test **/
    public function admin_can_be_soft_deleted()
    {
        $this->admin->deleted_at = null;
        $this->admin->save();

        $this
            ->delete(route('admin.settings.admins.delete', $this->admin->id))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.admins.index'))
            ->assertSessionHas(['success_message' => __('admins-settings.admins-soft-delete-success')]);
    }

    /** @test **/
    public function admin_can_be_force_deleted()
    {
        $this->admin->deleted_at = Carbon::now();
        $this->admin->save();

        $this
            ->delete(route('admin.settings.admins.destroy', $this->admin->id))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.admins.trash'))
            ->assertSessionHas(['success_message' => __('admins-settings.admins-destroy-success')]);
    }

    /** @test **/
    public function soft_deleted_admin_can_be_restored()
    {
        $this->admin->deleted_at = Carbon::now();
        $this->admin->save();

        $this
            ->get(route('admin.settings.admins.restore', $this->admin->id))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.settings.admins.trash'))
            ->assertSessionHas(['success_message' => __('admins-settings.admins-restore-success')]);
    }

    /** @test **/
    public function admins_all_feeds_page_can_be_shown()
    {
        Feed::factory()->create();

        $this
            ->get(route('admin.settings.admins.activity', null))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertViewHas('feeds')
            ->assertViewHas('adminsInTrash')
            ->assertViewHas('adminsLogins')
            ->assertViewHas('adminId')
            ->assertSee($this->admin->id)
            ->assertSee($this->admin->login);
    }

    /** @test **/
    public function admin_feeds_page_can_be_shown()
    {
        Feed::factory()->create();

        $this
            ->get(route('admin.settings.admins.activity', 2))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertViewHas('feeds')
            ->assertViewHas('adminsInTrash')
            ->assertViewHas('adminsLogins')
            ->assertViewHas('adminId')
            ->assertSee($this->admin->id)
            ->assertSee($this->admin->login);
    }
}
