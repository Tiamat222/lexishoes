<?php

namespace Tests\Unit\Admin\AdminsSettings;

use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Admins\Services\AdminService;
use App\Shop\Admin\AdminsSettings\Requests\UpdateAdminRequest;
use App\Shop\Admin\AdminsSettings\Services\AdminsSettingsService;
use App\Shop\Admin\AdminsSettings\Services\DTO\AdminCreateDto;
use App\Shop\Admin\AdminsSettings\Services\DTO\AdminUpdateDto;
use App\Shop\Admin\Permissions\Services\PermissionService;
use App\Shop\Admin\Permissions\Permission;
use App\Shop\Admin\Settings\Validators\GeneralSettingsValidator;
use App\Shop\Core\Admin\Base\Exceptions\EntityNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AdminsSettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AdminsSettingsService instance
     *
     * @var AdminsSettingsService
     */
    private $adminsSettingsService;
    
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->adminsSettingsService = new AdminsSettingsService(new Admin(), new AdminService(new Admin()), new PermissionService(new Permission(), new AdminService(new Admin())));
        $this->rules = (new GeneralSettingsValidator())->rules();
        $this->validator = $this->app['validator']; 
    }

    /** @test */
    public function all_admins_can_be_shown_with_paginatation()
    {
        Admin::factory(6)->create();
        $allAdmins = $this->adminsSettingsService->getAllEntitiesPaginate(10);

        $this->assertEquals(7, count($allAdmins));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allAdmins);
    }
    
    /** @test */
    public function new_admin_can_be_created()
    {
        $createDto = new AdminCreateDto([
            'login' => 'New login', 
            'email' => 'newEmail@gmail.com', 
            'telephone' => '+38(888) 888-88-88', 
            'permissions' => '1,2,3',
            'newPwd' => 'testPassword',
            'confirmPwd' => 'testPassword'
        ]);

        $createdProfile = $this->adminsSettingsService->store($createDto);

        $this->assertTrue($createdProfile);

        $getCreatedAdmin = $this->adminsSettingsService->getEntityById(2);

        $this->assertEquals(2, $getCreatedAdmin->id);
        $this->assertEquals('New login', $getCreatedAdmin->login);
        $this->assertEquals('newEmail@gmail.com', $getCreatedAdmin->email);
        $this->assertEquals('+38(888) 888-88-88', $getCreatedAdmin->telephone);
        $this->assertEquals(null, $getCreatedAdmin->avatar);
    }

    /** @test */
    public function admin_data_can_be_updated()
    {
        Admin::factory(1)->create([
            'id' => 999,
            'login' => 'Test login', 
            'email' => 'TestEmail@gmail.com', 
            'telephone' => '+39(999) 999-99-99', 
            'avatar' => 'storage/images/2022/03/1647613994-image-1.jpg'
        ]);

        $updateDto = new AdminUpdateDto([
            'id' => 999,
            'login' => 'Updated login', 
            'email' => 'UpdatedEmail@gmail.com', 
            'telephone' => '+38(888) 888-88-88', 
            'avatar' => 'storage/images/2022/03/1647613994-image-1.jpg',
            'permissions' => '1,2,3'
        ]);

        $updatedProfile = $this->adminsSettingsService->update($updateDto);

        $this->assertTrue($updatedProfile);

        $getUpdatedAdmin = $this->adminsSettingsService->getEntityById($updateDto->id);

        $this->assertEquals(999, $getUpdatedAdmin->id);
        $this->assertEquals('Updated login', $getUpdatedAdmin->login);
        $this->assertEquals('UpdatedEmail@gmail.com', $getUpdatedAdmin->email);
        $this->assertEquals('+38(888) 888-88-88', $getUpdatedAdmin->telephone);
        $this->assertEquals('storage/images/2022/03/1647613994-image-1.jpg', $getUpdatedAdmin->avatar);
    }

    /** @test */
    public function admins_in_trash_can_be_counted()
    {
        Admin::factory(6)->create(['deleted_at' => Carbon::now()]);
        $allAdmins = $this->adminsSettingsService->countEntitiesInTrash();

        $this->assertEquals(6, $allAdmins);
    }

    /** @test */
    public function throw_an_exception_if_the_admin_was_not_fetched_from_the_database()
    {
        $this->expectException(EntityNotFoundException::class);

        $this->adminsSettingsService->getEntityById(2);
    }

    /** @test */
    public function admin_can_be_fetched_from_bd_by_id()
    {
        Admin::factory()->create(['login' => 'Test admin']);
        $admin = $this->adminsSettingsService->getEntityById(1);

        $this->assertInstanceOf(Admin::class, $admin);
    }

    /** @test */
    public function all_soft_deleted_suppliers_can_be_fetched_from_database_with_pagination()
    {
        Admin::factory(6)->create(['deleted_at' => Carbon::now()]);
        $allSoftDeletedAdmins = $this->adminsSettingsService->getAllSoftDeletedEntities(6);

        $this->assertEquals(6, count($allSoftDeletedAdmins));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allSoftDeletedAdmins);
    }

    /** @test */
    public function admin_can_be_soft_deleted()
    {
        $admin = Admin::factory()->create();
        $this->adminsSettingsService->entitySoftDelete($admin->id);
        
        $this->assertEquals(1, count($this->adminsSettingsService->getAllSoftDeletedEntities(6)));
    }

    /** @test */
    public function admin_can_be_force_deleted()
    {
        $admin = Admin::factory()->create(['deleted_at' => Carbon::now()]);

        $this->assertNotEquals(NULL, $admin->deleted_at);
        $this->assertEquals(1, count($this->adminsSettingsService->getAllSoftDeletedEntities(6)));

        $this->adminsSettingsService->entityForceDelete($admin->id);

        $this->assertEquals(1, count($this->adminsSettingsService->getAllEntitiesPaginate(6)));
    }

    /** @test */
    public function admin_status_can_be_turned_off()
    {
        $turnedOffStatus = $this->adminsSettingsService->turnOffStatus($this->admin->id);
        $this->assertTrue($turnedOffStatus);
    }

    /** @test */
    public function admin_status_can_be_turned_on()
    {
        $turnedOnStatus = $this->adminsSettingsService->turnOffStatus($this->admin->id);
        $this->assertTrue($turnedOnStatus);
    }

    /** @test */
    public function soft_deleted_admin_can_be_restored()
    {
        $admin = Admin::factory()->create(['deleted_at' => Carbon::now()]);

        $this->assertNotEquals(NULL, $admin->deleted_at);
        $this->assertEquals(1, count($this->adminsSettingsService->getAllSoftDeletedEntities(6)));
        
        $this->adminsSettingsService->restoreEntity($admin->id);
        $restoredAdmin = $this->adminsSettingsService->getEntityById($admin->id);

        $this->assertInstanceOf(Admin::class, $restoredAdmin);
        $this->assertEquals(NULL, $restoredAdmin->deleted_at);
        $this->assertNotEquals(NULL, $restoredAdmin->created_at);
        $this->assertNotEquals(NULL, $restoredAdmin->updated_at);
    }

    /** @test **/
    public function valid_admin_login()
    {
        $this->rules = (new UpdateAdminRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('login', 'Test name'));
        $this->assertTrue($this->validateField('login', 'Test-name'));
        $this->assertTrue($this->validateField('login', 'Test'));
        $this->assertTrue($this->validateField('login', 'Te*'));
        $this->assertFalse($this->validateField('login', 'Te'));
        $this->assertFalse($this->validateField('login', 'T'));
        $this->assertFalse($this->validateField('login', ''));
    }

    /** @test **/
    public function valid_admin_email()
    {
        $this->rules = (new UpdateAdminRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('email', 'test@gmail.com'));
        $this->assertTrue($this->validateField('email', '1234test@gmail.name.com'));
        $this->assertTrue($this->validateField('email', 'логин-1@i.ru'));
        $this->assertTrue($this->validateField('email', '123456-@gmail.com'));
        $this->assertTrue($this->validateField('email', '123456@ru.name.ru.ua'));
        $this->assertFalse($this->validateField('email', ''));
        $this->assertFalse($this->validateField('email', '123456@.com'));
        $this->assertFalse($this->validateField('email', '.123456@i.ru'));
        $this->assertFalse($this->validateField('email', '123.gmail.com'));
        $this->assertFalse($this->validateField('email', '123'));
        $this->assertFalse($this->validateField('email', '@gmail.com'));
    }

    /** @test **/
    public function valid_admin_phone()
    {
        $this->rules = (new UpdateAdminRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('telephone', '+38(012) 345-67-89'));
        $this->assertFalse($this->validateField('telephone', ''));
        $this->assertFalse($this->validateField('telephone', '+38(012)345-67-89'));
        $this->assertFalse($this->validateField('telephone', '+38(012) 34-567-89'));
        $this->assertFalse($this->validateField('telephone', '+38(012) 34-56-789'));
        $this->assertFalse($this->validateField('telephone', '+38 (012) 345-67-89'));
        $this->assertFalse($this->validateField('telephone', '+380123456789'));
        $this->assertFalse($this->validateField('telephone', '380123456789'));
        $this->assertFalse($this->validateField('telephone', '0123456789'));
        $this->assertFalse($this->validateField('telephone', '3456789'));
        $this->assertFalse($this->validateField('telephone', '3456789'));
    }
}
