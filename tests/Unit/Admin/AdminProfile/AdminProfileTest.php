<?php

namespace Tests\Unit\Admin\AdminProfile;

use App\Shop\Admin\AdminProfile\Requests\UpdateAdminProfileRequest;
use App\Shop\Admin\AdminProfile\Services\AdminProfileService;
use App\Shop\Admin\AdminProfile\Services\DTO\AdminProfileUpdateDto;
use App\Shop\Admin\AdminProfile\Services\DTO\ChangePasswordDto;
use App\Shop\Admin\Admins\Admin;
use App\Shop\Admin\Admins\Services\AdminService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AdminProfileService instance
     *
     * @var AdminProfileService
     */
    private $adminProfileService;
    
    /**
     * setUp
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->adminProfileService = new AdminProfileService(
            new Admin(), 
            new AdminService(new Admin())
        );
    }

    /** @test */
    public function admin_data_can_be_updated()
    {
        $updateDto = new AdminProfileUpdateDto([
            'id' => $this->testAdmin()->id,
            'login' => 'Updated login', 
            'email' => 'UpdatedEmail@gmail.com', 
            'telephone' => '+38(888) 888-88-88', 
            'avatar' => 'storage/images/2022/03/1647613994-image-1.jpg'
        ]);

        $updatedProfile = $this->adminProfileService->update($updateDto);

        $this->assertTrue($updatedProfile);

        $getUpdatedAdmin = $this->adminProfileService->getRecordById($updateDto->id);

        $this->assertEquals('Updated login', $getUpdatedAdmin->login);
        $this->assertEquals('UpdatedEmail@gmail.com', $getUpdatedAdmin->email);
        $this->assertEquals('+38(888) 888-88-88', $getUpdatedAdmin->telephone);
        $this->assertEquals('storage/images/2022/03/1647613994-image-1.jpg', $getUpdatedAdmin->avatar);
    }

    /** @test */
    public function admin_password_can_be_updated()
    {
        $updatePwdDto = new ChangePasswordDto([
            'id' => $this->testAdmin()->id,
            'newPwd' => '123456',
            'confirmPwd' => '123456'
        ]);

        $updatedPwd = $this->adminProfileService->changePwd($updatePwdDto);

        $this->assertTrue($updatedPwd);

        $getUpdatedAdmin = $this->adminProfileService->getRecordById($updatePwdDto->id);

        $comparedPwd = Hash::check('123456', $getUpdatedAdmin->password);

        $this->assertTrue($updatedPwd);
        $this->assertTrue($comparedPwd);
    }

    /** @test **/
    public function valid_admin_login()
    {
        $this->rules = (new UpdateAdminProfileRequest())->rules();
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
        $this->rules = (new UpdateAdminProfileRequest())->rules();
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
        $this->rules = (new UpdateAdminProfileRequest())->rules();
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