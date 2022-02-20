<?php
namespace Tests\Feature\Admin\Attribute;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Attributes\Services\AttributeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AttributeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test **/
    public function attributes_list_page_can_be_shown()
    {
        $attribute = Attribute::create([
            'name' => 'Test attribute',
        ]);
        $getAttributes = (new AttributeService(new Attribute()))->getAllAttributes(1);

        $this
            ->get(route('admin.catalog.attributes.index', compact('getAttributes')))
            ->assertStatus(200)
            ->assertSee($attribute->name);
    }

    /** @test **/
    public function attribute_create_page_can_be_shown()
    {
        $this
            ->get(route('admin.catalog.attributes.create'))
            ->assertStatus(200);
    }

    /** @test **/
    public function attribute_edit_page_can_be_shown()
    {
        $attribute = Attribute::create([
            'name' => 'Test attribute'
        ]);

        $this
            ->get(route('admin.catalog.attributes.edit', $attribute->id))
            ->assertStatus(200)
            ->assertSee($attribute->name);
    }

    /** @test **/
    public function attribute_can_be_created()
    {
        $this
            ->post(route('admin.catalog.attributes.store'), ['name' => 'Test attribute'])
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.attributes.index'))
            ->assertSessionHas(['success_message' => __('admin-attributes.attribute-create-success')]);
    }

    /** @test **/
    public function attribute_can_be_updated()
    {
        $attribute = Attribute::create([
            'name' => 'Test attribute'
        ]);

        $this
            ->put(route('admin.catalog.attributes.update', $attribute->id), [
                'id' => $attribute->id, 
                'name' => 'Updated name'
            ])
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.attributes.edit', $attribute->id))
            ->assertSessionHas(['success_message' => __('admin-attributes.attribute-update-success')]);
    }

    /** @test **/
    public function attribute_can_be_deleted()
    {
        $attribute = Attribute::create([
            'name' => 'Test attribute'
        ]);

        $this
            ->delete(route('admin.catalog.attributes.destroy', $attribute->id))
            ->assertStatus(302)
            ->assertRedirect(route('admin.catalog.attributes.index'))
            ->assertSessionHas(['success_message' => __('admin-attributes.attribute-destroy-success')]);
    }
}
