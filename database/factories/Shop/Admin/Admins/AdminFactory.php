<?php

namespace Database\Factories\Shop\Admin\Admins;

use App\Shop\Admin\Admins\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{    
    /**
     * Associated model 
     *
     * @var Admin
     */
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'login' => $this->faker->name(), 
            'email' => $this->faker->unique()->safeEmail(), 
            'password' => Hash::make('tDutybq222520'), 
            'status' => 1,
            'telephone' => $this->faker->numerify('+38(###) ###-##-##'),
            'deleted_at' => NULL,
            'remember_token' => Str::random(10),
            'admin_id' => NULL,
            'avatar' => NULL,
        ];
    }
}
