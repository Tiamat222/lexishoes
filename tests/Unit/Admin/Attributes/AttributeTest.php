<?php
namespace Tests\Unit\Admin\Attributes;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Attributes\Requests\CreateAttributeRequest;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\AttributeValue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class AttributeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * AttributeService instance
     *
     * @var AttributeService
     */
    private $attributeService;

    public function setUp(): void
    {
        parent::setUp();

        $this->attributeService = new AttributeService(new Attribute());
        $this->rules = (new CreateAttributeRequest())->rules();
        $this->validator = $this->app['validator'];
    }

    /** @test */
    public function all_attributes_with_values_can_be_fetched_from_db_with_paginatation()
    {
        Attribute::factory(1)->create();
        AttributeValue::factory(4)->create();

        $allAttributes = $this->attributeService->getAllAttributes(3);

        $this->assertEquals(1, count($allAttributes));
        $this->assertInstanceOf(LengthAwarePaginator::class, $allAttributes);
    }

    /** @test */
    public function new_attribute_can_be_stored()
    {
        $attributeName = 'Test attribute';
        $storeAttribute = $this->attributeService->store($attributeName);
        
        $this->assertTrue($storeAttribute);

        $attribute = $this->attributeService->getEntityById(1);
        $this->assertEquals($attribute->name, 'Test attribute');
    }

    /** @test */
    public function attribute_can_be_updated()
    {
        Attribute::factory(1)->create(['name' => 'Attribute name']);

        $newData = [
            'id' => 1,
            'name' => 'Updated name'
        ];
        $updateAttribute = $this->attributeService->update($newData);
        $attribute = $this->attributeService->getEntityById(1);
        
        $this->assertTrue($updateAttribute);
        $this->assertEquals($attribute->name, 'Updated name');
    }

    /** @test */
    public function attribute_can_be_destoryed()
    {
        Attribute::factory(1)->create(['name' => 'Attribute name']);

        $destroyAttribute = $this->attributeService->destroy(1);
        
        $this->assertTrue($destroyAttribute);
    }

    /** @test */
    public function attribute_with_values_can_be_destoryed()
    {
        Attribute::factory(1)->create();
        AttributeValue::factory(4)->create();

        $destroyAttribute = $this->attributeService->destroy(1);
        
        $this->assertTrue($destroyAttribute);
    }

    /** @test **/
    public function valid_attribute_name()
    {
        $this->assertTrue($this->validateField('name', 'Test name'));
        $this->assertTrue($this->validateField('name', 'Test'));
        $this->assertTrue($this->validateField('name', 'Te'));
        $this->assertFalse($this->validateField('name', 'T'));
        $this->assertFalse($this->validateField('name', ''));
    }
}
