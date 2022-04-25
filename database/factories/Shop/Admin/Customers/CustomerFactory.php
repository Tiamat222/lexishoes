<?php

namespace Database\Factories\Shop\Admin\Customers;

use App\Shop\Admin\Customers\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{    
    /**
     * Model, associated with current factory
     *
     * @var Customer
     */
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'first_name' => Str::random(10),
            'last_name'  => Str::random(10),
            'email'      => $this->faker->unique()->safeEmail(),
            'phone'      => $this->faker->numerify('+38(###) ###-##-##'),
            'status'     => 1,
            'password'   => make_password(Str::random(10)),
        ];
    }
}
