<?php

namespace Tests\Feature\Admin\Attribute;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\AttributeValue;
use App\Shop\Admin\AttributeValues\Services\AttributeValueService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttributeValueFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function attribute_values_list_page_can_be_shown()
    {
        $attribute = Attribute::factory(1)->create();
        $attributeService = new AttributeService(new Attribute());
        $attribute = $attributeService->getRecordById(1);

        $this
            ->get(route('admin.catalog.attribute-values.valuesList', [
                'id' => $attribute->id, 
                'attributeName' => $attribute->name, 
                'attributeValues' => $attributeService->getValues(1)
                ]))
            ->assertStatus(200)
            ->assertSee($attribute->name);
    }

    /** @test **/
    public function attribute_value_create_page_can_be_shown()
    {
        $this
            ->get(route('admin.catalog.attribute-values.create'))
            ->assertStatus(200);
    }

    /** @test **/
    public function attribute_value_edit_page_can_be_shown()
    {
        $attributeValue = AttributeValue::factory()->create([
            'value' => 'Test value',
            'attribute_id' => 1
        ]);

        $this
            ->get(route('admin.catalog.attribute-values.edit', $attributeValue->id))
            ->assertStatus(200)
            ->assertSee($attributeValue->name);
    }

    /** @test **/
    public function attribute_value_can_be_created()
    {
        Attribute::factory(1)->create();
        $dataToStore = [
            'attribute' => 1, 
            'name' => 'New value'
        ];

        $this
            ->post(route('admin.catalog.attribute-values.store'), $dataToStore)
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.attribute-values.valuesList', $dataToStore['attribute']))
            ->assertSessionHas(['success_message' => __('admin-attribute-values.attribute-value-create-success')]);
    }

    /** @test **/
    public function attribute_value_can_be_updated()
    {
        $attribute = Attribute::create(['name' => 'Test attribute']);
        $attributeValue = AttributeValue::create(['value' => 'Test value', 'attribute_id' => 1]);

        $dataToUpdate = [
            'parent-attribute-id' => $attribute['id'], 
            'attribute-value-id' => $attributeValue['id'], 
            'value' => 'Updated value'
        ];

        $this
            ->get(route('admin.catalog.attribute-values.edit', $dataToUpdate['parent-attribute-id']));

        $this
            ->put(route('admin.catalog.attribute-values.update', $attributeValue->id), $dataToUpdate)
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.attribute-values.edit', $dataToUpdate['parent-attribute-id']))
            ->assertSessionHas(['success_message' => __('admin-attribute-values.attribute-value-update-success')]);
    }

    /** @test **/
    public function attribute_value_can_be_deleted()
    {
        $attribute = Attribute::create(['name' => 'Test attribute']);
        $attributeValue = AttributeValue::create(['value' => 'Test value', 'attribute_id' => 1]);

        $this
            ->get(route('admin.catalog.attribute-values.valuesList', $attribute->id));

        $this
            ->delete(route('admin.catalog.attribute-values.destroy', $attributeValue->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.attribute-values.valuesList', $attribute->id))
            ->assertSessionHas(['success_message' => __('admin-attribute-values.attribute-value-destroy-success')]);
    }
}
