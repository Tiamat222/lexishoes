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
     * Get all soft deleted entities with pagination
     *
     * @param  int $paginate
     * 
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
     * @return void
     */
    public function entityForceDelete(int $id): void
    {
        if(!(bool) $this->model->where('id', $id)->forceDelete()) {
            abort(404);
        }
    }

    /**
     * Restore soft deleted entity
     *
     * @return void
     */
    public function restoreEntity(int $id): void
    {
        if(!(bool) $this->model->where('id', $id)->restore()) {
            abort(404);
        }
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
            $this->model->where('id', $id)->restore();
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
            $this->model->where('id', $id)->forceDelete();
        }
        return true;
    }
}
