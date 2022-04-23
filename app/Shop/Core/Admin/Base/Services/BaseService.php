<?php
namespace App\Shop\Core\Admin\Base\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Shop\Core\Admin\Base\Exceptions\EntityNotFoundException;
use Illuminate\Database\Eloquent\Collection;
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
    public function getAllRecordsPaginate(int $paginate, string $column = null, string $param = null, string $orderBy = 'id', string $sortBy = 'asc'): LengthAwarePaginator
    {
        if($column !== null && $param !== null) {
            return $this->model->where($column, $param)->orderBy($orderBy, $sortBy)->paginate($paginate);
        }
        return $this->model->orderBy($orderBy, $sortBy)->paginate($paginate);
    } 

    /**
     * Get all entities
     *
     * @return Collection
     */
    public function getAllRecords(array $data = null, string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        if($data) {
            return $this->model->select($data)->orderBy($orderBy, $sortBy)->get();
        }
        return $this->model->orderBy($orderBy, $sortBy)->get();
    } 

    /**
     * Count entities in trash
     *
     * @return int
     */
    public function countRecordsInTrash(): int
    {
        return $this->model->onlyTrashed()->count();
    }

    /**
     * Get entity by id
     * 
     * @param int $id
     * @throws EntityNotFoundException
     */
    public function getRecordById(int $id)
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
    public function getSoftDeletedRecordById(int $id)
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
    public function getAllSoftDeletedRecords(int $paginate): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->paginate($paginate);
    }

    /**
     * Entity soft delete
     *
     * @return void
     */
    public function recordSoftDelete(int $id): void
    {
        if(!(bool) $this->model->where('id', $id)->delete()) {
            abort(404);
        }
    }
    
    /**
     * Destroy record
     *
     * @param  int $id
     * 
     * @return void
     */
    public function destroyRecord($id)
    {
        return $this->recordSoftDelete($id);
    }

    /**
     * Entity force delete
     *
     * @return bool
     */
    public function recordForceDelete(int $id): bool
    {
        return (bool) $this->getSoftDeletedRecordById($id)->forceDelete();
    }

    /**
     * Restore soft deleted entity
     *
     * @return void
     */
    public function restoreRecord(int $id): void
    {
        if(!(bool) $this->getSoftDeletedRecordById($id)->restore()) {
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
    public function restoreAllRecords(array $data): bool
    {
        foreach($data['ids'] as $id) {
            $this->getSoftDeletedRecordById($id)->restore();
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
    public function forceDeleteAllRecords(array $data): bool
    {
        foreach($data['ids'] as $id) {
            $this->getSoftDeletedRecordById($id)->forceDelete();
        }
        return true;
    }
    
    /**
     * Get all records (with soft deleted)
     *
     * @param  array $columns
     * 
     * @return array
     */
    public function getAllRecordsWithTrashed(array $columns): array
    {
        return $this
                ->model
                ->withTrashed()
                ->select($columns)
                ->get()
                ->toArray();
    }
    
    /**
     * Turn on admin status
     *
     * @param  int $id
     * 
     * @return bool
     */
    public function turnOnStatus(int $id): bool
    {
        $entity = $this->getRecordById($id);
        $entity->update(['status' => 1]);
        return true;
    }
    
    /**
     * Turn off admin status
     *
     * @param  int $id
     * 
     * @return bool
     */
    public function turnOffStatus(int $id): bool
    {
        $entity = $this->getRecordById($id);
        $entity->update(['status' => 0]);
        return true;
    }
}
