<?php
namespace App\Shop\Core\Admin\Base\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Shop\Core\Admin\Base\Exceptions\EntityNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseService
{
    /**
     * Model instance
     */
    protected $model;

    /**
     * Get all entities with pagination
     *
     * @param  int $paginate
     * 
     * @return LengthAwarePaginator
     */
    public function getAllEntitiesPaginate(int $paginate): LengthAwarePaginator
    {
        return $this->model->paginate($paginate);
    } 

    /**
     * Count entities in trash
     *
     * @return int
     */
    public function countEntitiesInTrash(): int
    {
        return $this->model->onlyTrashed()->count();
    }

    /**
     * Get entity by id
     * 
     * @param int $id
     * @throws EntityNotFoundException
     */
    public function getEntityById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch(ModelNotFoundException $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }

    /**
     * Get soft deleted entity by id
     * 
     * @param int $id
     * @throws EntityNotFoundException
     */
    public function getSoftDeletedEntityById(int $id)
    {
        try {
            return $this->model->onlyTrashed()->findOrFail($id);
        } catch(ModelNotFoundException $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }

    /**
     * Get all soft deleted entities with pagination
     *
     * @param  int $paginate
     * @return LengthAwarePaginator
     */
    public function getAllSoftDeletedEntities(int $paginate): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->paginate($paginate);
    }

    /**
     * Entity soft delete
     *
     * @return void
     */
    public function entitySoftDelete(int $id): void
    {
        if(!(bool) $this->model->where('id', $id)->delete()) {
            abort(404);
        }
    }

    /**
     * Entity force delete
     *
     * @return bool
     */
    public function entityForceDelete(int $id): bool
    {
        return (bool) $this->getSoftDeletedEntityById($id)->forceDelete();
    }

    /**
     * Restore soft deleted entity
     *
     * @return bool
     */
    public function restoreEntity(int $id): bool
    {
        return (bool) $this->getSoftDeletedEntityById($id)->restore();
    }
    
    /**
     * Mass restore suppliers from trash (AJAX)
     *
     * @param  array $data
     * 
     * @return bool
     */
    public function restoreAllEntities(array $data): bool
    {
        foreach($data['ids'] as $id) {
            $this->getSoftDeletedEntityById($id)->restore();
        }
        return true;
    }
    
    /**
     * Mass force delete suppliers (AJAX)
     *
     * @param  array $data
     * 
     * @return bool
     */
    public function forceDeleteAllEntities(array $data): bool
    {
        foreach($data['ids'] as $id) {
            $this->getSoftDeletedEntityById($id)->forceDelete();
        }
        return true;
    }
}
