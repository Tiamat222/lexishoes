<?php
namespace App\Shop\Admin\Attributes\Services;

use App\Shop\Admin\Attributes\Attribute;
use App\Shop\Admin\Attributes\Exceptions\CreateAttributeErrorException;
use App\Shop\Admin\Attributes\Exceptions\DestroyAttributeErrorException;
use App\Shop\Admin\Attributes\Exceptions\UpdateAttributeErrorException;
use App\Shop\Admin\AttributeValues\AttributeValue;
use App\Shop\Admin\AttributeValues\Services\AttributeValueService;
use App\Shop\Core\Admin\Base\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;

class AttributeService extends BaseService
{        
    /**
     * AttributeService constructor
     *
     * @param  Attribute $attribute
     */
    public function __construct(Attribute $attribute)
    {
        $this->model = $attribute;
    }

    public function getAllAttributes(int $pagination)
    {
        $attributeValueService = new AttributeValueService(new AttributeValue());
        $allAttributes = $this->getAllEntitiesPaginate(3);
        foreach($allAttributes as $attribute) {
            $attribute->count = $attributeValueService->countValues($attribute->id);
        }
        return $allAttributes;
    }
    
    /**
     * Store new attribute
     *
     * @param  string $name
     * @throws CreateAttributeErrorException
     * 
     * @return bool
     */
    public function store(string $name): bool
    {
        try {
            $attribute = new Attribute();
            $attribute->name = $name;
            $attribute->save();
            return true;
        } catch(QueryException $e) {
            throw new CreateAttributeErrorException($e->getMessage());
        }
    }
    
    /**
     * Update attribute
     *
     * @param  array $data
     * @throws UpdateAttributeErrorException
     * 
     * @return bool
     */
    public function update(array $data): bool
    {
        try {
            $attribute = $this->getEntityById($data['id']);
            $attribute->update(['name' => $data['name']]);
            return true;
        } catch(QueryException $e) {
            throw new UpdateAttributeErrorException($e->getMessage());
        }
    }
    
    /**
     * Get attribute values
     *
     * @param  int $id
     * 
     * @return LengthAwarePaginator
     */
    public function getValues(int $id): LengthAwarePaginator
    {
        $attribute = $this->getEntityById($id);
        return $attribute->values()->paginate(3);
    }
    
    /**
     * Destroy attribute
     *
     * @param  int $id
     * 
     * @return bool
     */
    
    public function destroy(int $id): bool
    {
        try {
            $attribute = $this->model->where('id', $id)->first();
            $this->destroyValues($attribute);
            $attribute->delete();
            return true;
        } catch(QueryException $e) {
            throw new DestroyAttributeErrorException($e->getMessage());
        }
    }
    
    /**
     * Destroy values
     *
     * @param  Attribute $attribute
     * 
     * @return void
     */
    private function destroyValues(Attribute $attribute): void
    {
        foreach($attribute->values as $value) {
            $value->delete();
        }
    }
}