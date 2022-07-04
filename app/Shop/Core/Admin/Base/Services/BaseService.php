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
     * Get all records with pagination
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
     * Get all records
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
     * Count records in trash
     *
     * @return int
     */
    public function countRecordsInTrash(): int
    {
        return $this->model->onlyTrashed()->count();
    }

    /**
     * Count records by field
     *
     * @param  string $field
     * @param  string|int $value
     *
     * @return int
     */
    public function countRecordsByField(string $field, string $condition, $value): int
    {
        return $this->model->where($field, $condition, $value)->count();
    }

    /**
     * Count records
     *
     * @return int
     */
    public function countRecords(): int
    {
        return $this->model->count();
    }

    /**
     * Get record by id
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
     * Get record by field
     *
     * @param string $field
     * @param string string $value
     *
     * @throws EntityNotFoundException
     */
    public function getRecordByField(string $field, string $value)
    {
        try {
            return $this->model->where($field, $value)->first();
        } catch(ModelNotFoundException $e) {
            throw new EntityNotFoundException($e->getMessage());
        }
    }

    /**
     * Get soft deleted record by id
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
     * Get all soft deleted records with pagination
     *
     * @param  int $paginate
     * @return LengthAwarePaginator
     */
    public function getAllSoftDeletedRecords(int $paginate): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()->paginate($paginate);
    }

    /**
     * Record soft delete
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
     * Record force delete
     *
     * @return bool
     */
    public function recordForceDelete(int $id): bool
    {
        return (bool) $this->getSoftDeletedRecordById($id)->forceDelete();
    }

    /**
     * Restore soft deleted record
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
     * Mass restore records from trash (AJAX)
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
     * Mass force delete records (AJAX)
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
     * Turn on status
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
     * Turn off status
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
