<?php

namespace Tests\Unit\Admin\Customers;

use App\Shop\Admin\Customers\Customer;
use App\Shop\Admin\Customers\Requests\CreateCustomerRequest;
use App\Shop\Admin\Customers\Services\CustomerService;
use App\Shop\Admin\Customers\Services\DTO\CustomerCreateDto;
use App\Shop\Admin\Customers\Services\DTO\CustomerUpdateDto;
use App\Shop\Core\Admin\Base\Exceptions\EntityNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CustomerTest extends TestCase
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

        $this->customerService = new CustomerService(new Customer());
    }

    /** @test */
    public function all_customers_can_be_shown_with_paginatation()
    {
        $customers = Customer::factory(6)->create();
        $allCustomers = $this->customerService->getAllRecordsPaginate(get_setting('items_per_page'));

        $this->assertEquals(6, count($customers));
        $this->assertEquals(1, count($allCustomers));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allCustomers);
    }

    /** @test */
    public function new_customer_can_be_created()
    {
        $createDto = new CustomerCreateDto([
            'first_name' => 'First name',
            'last_name'  => 'Last name',
            'email'      => 'new@email.com',
            'phone'      => '+38(111) 111-11-11',
            'password'   => make_password('newPassword'),
        ]);

        $createdCustomer = $this->customerService->store($createDto);

        $this->assertTrue($createdCustomer);

        $getCreatedCustomer = $this->customerService->getRecordById(1);

        $this->assertEquals(1, $getCreatedCustomer->id);
        $this->assertEquals($createDto->first_name, $getCreatedCustomer->first_name);
        $this->assertEquals($createDto->last_name, $getCreatedCustomer->last_name);
        $this->assertEquals($createDto->email, $getCreatedCustomer->email);
        $this->assertEquals($createDto->phone, $getCreatedCustomer->phone);
    }

    /** @test */
    public function customer_data_can_be_updated()
    {
        Customer::factory()->create([
            'first_name' => 'First name',
            'last_name'  => 'Last name',
            'email'      => 'new@email.com',
            'phone'      => '+38(111) 111-11-11',
            'password'   => make_password('newPassword'),
        ]);

        $updateDto = new CustomerUpdateDto([
            'id'         => 1,
            'first_name' => 'Updated name',
            'last_name'  => 'Updated name',
            'email'      => 'updated@email.com',
            'phone'      => '+38(222) 222-22-22',
        ]);

        $updatedCustomer = $this->customerService->update($updateDto);

        $this->assertTrue($updatedCustomer);

        $getUpdatedCustomer = $this->customerService->getRecordById($updateDto->id);

        $this->assertEquals($updateDto->id, $getUpdatedCustomer->id);
        $this->assertEquals($updateDto->first_name, $getUpdatedCustomer->first_name);
        $this->assertEquals($updateDto->last_name, $getUpdatedCustomer->last_name);
        $this->assertEquals($updateDto->email, $getUpdatedCustomer->email);
        $this->assertEquals($updateDto->phone, $getUpdatedCustomer->phone);
    }

    /** @test */
    public function customers_in_trash_can_be_counted()
    {
        Customer::factory(6)->create(['deleted_at' => Carbon::now()]);
        $allCustomers = $this->customerService->countRecordsInTrash();

        $this->assertEquals(6, $allCustomers);
    }

    /** @test */
    public function throw_an_exception_if_the_customer_was_not_fetched_from_the_database()
    {
        $this->expectException(EntityNotFoundException::class);

        $this->customerService->getRecordById(2);
    }

    /** @test */
    public function customer_can_be_fetched_from_bd_by_id()
    {
        Customer::factory()->create();
        $customer = $this->customerService->getRecordById(1);

        $this->assertInstanceOf(Customer::class, $customer);
    }

    /** @test */
    public function all_soft_deleted_customers_can_be_fetched_from_database_with_pagination()
    {
        Customer::factory(6)->create(['deleted_at' => Carbon::now()]);
        $allSoftDeletedCustomers = $this->customerService->getAllSoftDeletedRecords(get_setting('items_per_page'));

        $this->assertEquals(1, count($allSoftDeletedCustomers));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allSoftDeletedCustomers);
    }

    /** @test */
    public function customer_can_be_soft_deleted()
    {
        $customer = Customer::factory()->create();
        $this->customerService->recordSoftDelete($customer->id);
        
        $this->assertEquals(1, count($this->customerService->getAllSoftDeletedRecords(get_setting('items_per_page'))));
    }

    /** @test */
    public function customer_can_be_force_deleted()
    {
        $customer = Customer::factory()->create(['deleted_at' => Carbon::now()]);

        $this->assertNotEquals(NULL, $customer->deleted_at);
        $this->assertEquals(1, count($this->customerService->getAllSoftDeletedRecords(get_setting('items_per_page'))));

        $this->assertTrue($this->customerService->recordForceDelete($customer->id));
    }

    /** @test */
    public function customer_status_can_be_turned_off()
    {
        $customer = Customer::factory()->create();
        $turnedOffStatus = $this->customerService->turnOffStatus($customer->id);
        $this->assertTrue($turnedOffStatus);
    }

    /** @test */
    public function customer_status_can_be_turned_on()
    {
        $customer = Customer::factory()->create();
        $turnedOnStatus = $this->customerService->turnOffStatus($customer->id);
        $this->assertTrue($turnedOnStatus);
    }

    /** @test */
    public function soft_deleted_customer_can_be_restored()
    {
        $customer = Customer::factory()->create(['deleted_at' => Carbon::now()]);

        $this->assertNotEquals(NULL, $customer->deleted_at);
        $this->assertEquals(1, count($this->customerService->getAllSoftDeletedRecords(get_setting('items_per_page'))));
        
        $this->customerService->restoreRecord($customer->id);
        $restoredCustomer = $this->customerService->getRecordById($customer->id);

        $this->assertInstanceOf(Customer::class, $restoredCustomer);
        $this->assertEquals(NULL, $restoredCustomer->deleted_at);
        $this->assertNotEquals(NULL, $restoredCustomer->created_at);
        $this->assertNotEquals(NULL, $restoredCustomer->updated_at);
    }

    /** @test **/
    public function valid_customer_first_name()
    {
        $this->rules = (new CreateCustomerRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('first_name', 'Test name'));
        $this->assertTrue($this->validateField('first_name', 'Test-name'));
        $this->assertTrue($this->validateField('first_name', 'Test'));
        $this->assertTrue($this->validateField('first_name', 'Te*'));
        $this->assertTrue($this->validateField('first_name', 'Te'));
        $this->assertTrue($this->validateField('first_name', 'T'));
        $this->assertFalse($this->validateField('first_name', ''));
    }

    /** @test **/
    public function valid_customer_last_name()
    {
        $this->rules = (new CreateCustomerRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('last_name', 'Test name'));
        $this->assertTrue($this->validateField('last_name', 'Test-name'));
        $this->assertTrue($this->validateField('last_name', 'Test'));
        $this->assertTrue($this->validateField('last_name', 'Te*'));
        $this->assertTrue($this->validateField('last_name', 'Te'));
        $this->assertTrue($this->validateField('last_name', 'T'));
        $this->assertFalse($this->validateField('last_name', ''));
    }

    /** @test **/
    public function valid_customer_email()
    {
        $this->rules = (new CreateCustomerRequest())->rules();
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
    public function valid_customer_phone()
    {
        $this->rules = (new CreateCustomerRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('phone', '+38(012) 345-67-89'));
        $this->assertFalse($this->validateField('phone', ''));
        $this->assertFalse($this->validateField('phone', '+38(012)345-67-89'));
        $this->assertFalse($this->validateField('phone', '+38(012) 34-567-89'));
        $this->assertFalse($this->validateField('phone', '+38(012) 34-56-789'));
        $this->assertFalse($this->validateField('phone', '+38 (012) 345-67-89'));
        $this->assertFalse($this->validateField('phone', '+380123456789'));
        $this->assertFalse($this->validateField('phone', '380123456789'));
        $this->assertFalse($this->validateField('phone', '0123456789'));
        $this->assertFalse($this->validateField('phone', '3456789'));
        $this->assertFalse($this->validateField('phone', '3456789'));
    }

    /** @test **/
    public function valid_customer_password()
    {
        $this->rules = (new CreateCustomerRequest())->rules();
        $this->validator = $this->app['validator'];

        $this->assertTrue($this->validateField('password', 'testPassword'));
        $this->assertFalse($this->validateField('password', '12345'));
        $this->assertFalse($this->validateField('password', ''));
    }
}
