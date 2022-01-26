<?php
namespace Database\Factories\Shop\Admin\Suppliers;

use App\Shop\Admin\Suppliers\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{    
    /**
     * Table associated with the factory
     *
     * @var undefined
     */
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(), 
            'description' => $this->faker->sentence($nbWords = 6, $variableNbWords = true), 
            'deleted_at' => NULL,
            'created_at' => NULL,
            'updated_at' => NULL,
        ];
    }
}