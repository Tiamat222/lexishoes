<?php
namespace Database\Factories\Shop\Admin\AttributeValues;

use App\Shop\Admin\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AttributeValueFactory extends Factory
{    
    /**
     * Model, associated with current factory
     *
     * @var AttributeValue $model
     */
    protected $model = AttributeValue::class;

    public function definition()
    {
        return [
            'value' => Str::random(4), 
            'attribute_id' => 1
        ];
    }
}
