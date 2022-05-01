<?php

namespace Tests\Unit\Admin\AttributeValues;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\Services\AttributeValueService;
use App\Shop\Admin\AttributeValues\AttributeValue;
use App\Shop\Admin\AttributeValues\Requests\CreateAttributeValueRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttributeValueTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AttributeValueService instance
     *
     * @var AttributeValueService
     */
    private $attributeValuesService;
    
    /**
     * AttributeService
     *
     * @var AttributeService
     */
    private $attributeService;

    public function setUp(): void
    {
        parent::setUp();

        $this->attributeValuesService = new AttributeValueService(new AttributeValue());
        $this->attributeService = new AttributeService(new Attribute());

        $this->rules = (new CreateAttributeValueRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function attribute_values_can_be_counted()
    {
        Attribute::factory(1)->create();
        AttributeValue::factory(4)->create();

        $attribute = $this->attributeService->getRecordById(1);
        $countValues = $this->attributeValuesService->countValues($attribute->id);

        $this->assertEquals(4, $countValues);
    }

    /** @test */
    public function attribute_value_can_be_stored()
    {
        Attribute::factory(1)->create();

        $dataToStore = [
            'attribute' => 1,
            'name' => 'New value'
        ];

        $newValue = $this->attributeValuesService->store($dataToStore);
        $getValue = $this->attributeValuesService->getRecordById(1);

        $this->assertTrue($newValue);
        $this->assertEquals($dataToStore['name'], $getValue->value);
    }

    /** @test */
    public function attribute_value_can_be_updated()
    {
        Attribute::factory(1)->create();
        AttributeValue::factory(1)->create();

        $dataToStore = [
            'attribute-value-id' => 1,
            'parent-attribute-id' => 1,
            'value' => 'New name'
        ];

        $newValue = $this->attributeValuesService->update($dataToStore);
        $getValue = $this->attributeValuesService->getRecordById(1);

        $this->assertTrue($newValue);
        $this->assertEquals($dataToStore['value'], $getValue->value);
    }
}
