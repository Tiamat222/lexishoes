<?php

namespace Database\Factories\Shop\Admin\Permissions;

use App\Shop\Admin\Permissions\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
        return [
            'name' => Str::random(4),
            'slug' => Str::random(4)
        ];
    }
}
