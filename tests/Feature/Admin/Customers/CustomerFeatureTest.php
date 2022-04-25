<?php

namespace Tests\Feature\Admin\Customers;

use App\Shop\Admin\Customers\Services\CustomerService;
use App\Shop\Admin\Customers\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class CustomerFeatureTest extends TestCase
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

    /** @test **/
    public function customer_list_page_can_be_shown()
    {
        $customer = Customer::factory()->create();

        $this
            ->get(route('admin.customers.index'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertSee($customer->first_name)
            ->assertSee($customer->last_name)
            ->assertSee($customer->email)
            ->assertSee($customer->phone)
            ->assertViewHas('customers')
            ->assertViewHas('softDeletedCount');
    }

    /** @test **/
    public function customer_create_page_can_be_shown()
    {
        $this
            ->get(route('admin.customers.create'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertViewHas('softDeletedCount');
    }

    /** @test **/
    public function customer_can_be_created()
    {
        $this
            ->post(route('admin.customers.store'), [
                'first_name' => 'First name',
                'last_name' => 'Last name',
                'phone' => '+38(999) 888-88-88',
                'email' => 'new@email.com',
                'password' => 'newPassword'
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.customers.index'))
            ->assertSessionHas(['success_message' => __('admin-customers.customer-store-success')]);
    }

    /** @test **/
    public function customer_edit_page_can_be_shown()
    {
        $customer = Customer::factory()->create();

        $this
            ->get(route('admin.customers.edit', $customer->id))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertSee($customer->first_name)
            ->assertSee($customer->last_name)
            ->assertSee($customer->email)
            ->assertSee($customer->phone)
            ->assertViewHas('customer');
    }

    /** @test **/
    public function customer_can_be_updated()
    {
        $customer = Customer::factory()->create();

        $this
            ->put(route('admin.customers.update', $customer->id), [
                'id' => $customer->id,
                'first_name' => 'Updated name',
                'last_name' => 'Updated last name',
                'phone' => '+38(999) 777-88-88',
                'email' => 'updated@email.com',
            ])
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHas(['success_message' => __('admin-customers.customer-update-success')]);
    }

    /** @test **/
    public function customer_cannot_be_updated_if_the_email_is_incorrect()
    {
        $customer = Customer::factory()->create();

        $this
            ->put(route('admin.customers.update', $customer->id), [
                'id' => $customer->id,
                'first_name' => 'Updated name',
                'last_name' => 'Updated last name',
                'phone' => '+38(999) 777-88-88',
                'email' => 'updated.email.com',
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['email' => __('admin-customers.email-email')]);
    }

    /** @test **/
    public function customer_cannot_be_updated_if_the_phone_is_incorrect()
    {
        $customer = Customer::factory()->create();

        $this
            ->put(route('admin.customers.update', $customer->id), [
                'id' => $customer->id,
                'first_name' => 'Updated name',
                'last_name' => 'Updated last name',
                'phone' => '+38(999)777-88-88',
                'email' => 'updated@email.com',
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['phone' => __('admin-customers.phone-regex')]);
    }

    /** @test **/
    public function customer_cannot_be_updated_if_the_first_name_is_empty()
    {
        $customer = Customer::factory()->create();

        $this
            ->put(route('admin.customers.update', $customer->id), [
                'id' => $customer->id,
                'first_name' => '',
                'last_name' => 'Updated last name',
                'phone' => '+38(999) 777-88-88',
                'email' => 'updated@email.com',
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['first_name' => __('admin-customers.first_name-required')]);
    }

    /** @test **/
    public function customer_cannot_be_updated_if_the_last_name_is_empty()
    {
        $customer = Customer::factory()->create();

        $this
            ->put(route('admin.customers.update', $customer->id), [
                'id' => $customer->id,
                'first_name' => 'Updated first name',
                'last_name' => '',
                'phone' => '+38(999) 777-88-88',
                'email' => 'updated@email.com',
            ])
            ->assertStatus(302)
            ->assertRedirect(session()->previousUrl())
            ->assertSessionHasErrors(['last_name' => __('admin-customers.last_name-required')]);
    }

    /** @test **/
    public function customers_trash_page_can_be_shown()
    {
        $customer = Customer::factory()->create(['deleted_at' => Carbon::now()]);

        $this
            ->get(route('admin.customers.trash'))
            ->assertStatus(200)
            ->assertSessionHasNoErrors()
            ->assertSee($customer->first_name)
            ->assertSee($customer->last_name)
            ->assertSee($customer->email)
            ->assertSee($customer->phone)
            ->assertViewHas('customers');
    }

    /** @test **/
    public function customer_can_be_soft_deleted()
    {
        $customer = Customer::factory()->create();

        $this
            ->delete(route('admin.customers.delete', $customer->id))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.customers.index'))
            ->assertSessionHas(['success_message' => __('admin-customers.customer-delete-success')]);
    }

    /** @test **/
    public function customer_can_be_force_deleted()
    {
        $customer = Customer::factory()->create(['deleted_at' => Carbon::now()]);

        $this
            ->delete(route('admin.customers.destroy', $customer->id))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.customers.trash'))
            ->assertSessionHas(['success_message' => __('admin-customers.customer-destroy-success')]);
    }

    /** @test **/
    public function soft_deleted_customer_can_be_restored()
    {
        $customer = Customer::factory()->create(['deleted_at' => Carbon::now()]);

        $this
            ->get(route('admin.customers.restore', $customer->id))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.customers.trash'))
            ->assertSessionHas(['success_message' => __('admin-customers.customer-restore-success')]);
    }
}
