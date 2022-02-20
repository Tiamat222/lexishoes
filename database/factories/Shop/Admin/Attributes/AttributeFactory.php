<?php
namespace Database\Factories\Shop\Admin\Attributes;

use App\Shop\Admin\Attributes\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeFactory extends Factory
{    
    /**
     * Model, associated with current factory
     *
     * @var Attribute $model
     */
    protected $model = Attribute::class;

    public function definition()
    {
        return [
            'name' => Str::random(4), 
        ];
    }
}
