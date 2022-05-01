<?php
namespace App\Shop\Admin\AttributeValues\Services;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Attributes\Services\AttributeService;
use App\Shop\Admin\AttributeValues\AttributeValue;
use App\Shop\Admin\AttributeValues\Exceptions\CreateAttributeValueException;
use App\Shop\Admin\AttributeValues\Exceptions\UpdateAttributeValueException;
use App\Shop\Core\Admin\Base\Services\BaseService;
use Illuminate\Database\QueryException;

class AttributeValueService extends BaseService
{    
    /**
     * AttributeValueService constructor
     *
     * @param  AttributeValue $attributeValue
     */
    public function __construct(AttributeValue $attributeValue)
    {
        $this->model = $attributeValue;
    }
    
    /**
     * Count attribute values
     *
     * @param  int $id
     * 
     * @return int
     */
    public function countValues(int $id): int
    {
        $attributeService = new AttributeService(new Attribute());
        $attribute = $attributeService->getRecordById($id);
        return $attribute->values->count();
    }
    
    /**
     * Store new attribute value
     *
     * @param  array $data
     * 
     * @return bool
     */
    public function store(array $data): bool
    {
        $attributeService = new AttributeService(new Attribute());
        $attribute = $attributeService->getRecordById($data['attribute']);

        try {
            $attributeValue = new AttributeValue();
            $attributeValue->value = $data['name'];
            $attributeValue->attribute_id = $data['attribute'];
            $attributeValue->save();
            return true;
        } catch(QueryException $e) {
            throw new CreateAttributeValueException($e->getMessage());
        }
    }
    
    /**
     * Update attribute value
     *
     * @param  array $data
     * @param  int $id
     * 
     * @return bool
     */
    public function update(array $data): bool
    {
        try {
            $attributeValue = $this->getRecordById($data['attribute-value-id']);
            $attributeValue->attribute_id = $data['parent-attribute-id'];
            $attributeValue->value = $data['value'];
            $attributeValue->update();
            return true;
        } catch(QueryException $e) {
            throw new UpdateAttributeValueException($e->getMessage());
        }
    }
}