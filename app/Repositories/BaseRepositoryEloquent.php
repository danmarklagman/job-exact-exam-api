<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class BaseRepositoryEloquent implements BaseRepositoryInterface, CriteriaInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * 
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Get all trashed models.
     * 
     * @return Collection
     */
    public function allTrashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Find model by columns.
     * 
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function findByColumns(
        array $where = [],
        array $columns = ['*'],
        array $relations = []
    ): Collection
    {
        return $this->model->select($columns)->with($relations)->where($where)->get();
    }

    /**
     * Find model in array.
     * 
     * @param string $identifier
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function findIn(
        string $identifier,
        array $where = [],
        array $columns = ['*'],
        array $relations = []
    ): Collection
    {
        return $this->model->select($columns)->with($relations)->whereIn($identifier, $where)->get();
    }

    /**
     * Find model by first.
     * 
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function findByFirst(
        array $where = [],
        array $columns = ['*'],
        array $relations = []
    ): ?Model
    {
        return $this->model->select($columns)->with($relations)->where($where)->first();
    }

    /**
     * Find model by id.
     * 
     * @param string $modelId
     * @param array $columns
     * @param array $relations
     * @param array appends
     * @return Model
     */
    public function findById(
        string $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId)->append($appends);
    }

    /**
     * Find trashed model by id.
     * 
     * @param string $modelId
     * @return Model
     */
    public function findTrashedById(string $modelId): ?Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    /**
     * Find only trashed model by id.
     * 
     * @param string $modelId
     * @return Model
     */
    public function findOnlyTrashedById(string $modelId): ?Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * Create a model.
     * 
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    /**
     * Update existing model.
     * 
     * @param string $modelId
     * @param array $payload
     * @return bool
     */
    public function update(string $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);

        return $model->update($payload);
    }

    /**
     * Update or create existing model.
     * 
     * @param array $where
     * @param array $payload
     * @return Model
     */
    public function updateOrCreate(array $where, array $payload): Model
    {
        $model = $this->model->updateOrCreate($where, $payload);

        return $model->fresh();
    }

    /**
     * Update existing model by multiple where columns.
     * 
     * @param array $where
     * @param array $payload
     * @return bool
     */
    public function updateWhere(array $where, array $payload): bool
    {
        $model = $this->findByFirst($where);

        return $model->update($payload);
    }

    /**
     * Delete model by id.
     * 
     * @param string $modelId
     * @return bool
     */
    public function deleteById(string $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    /**
     * Restore model by id.
     * 
     * @param string $modelId
     * @return bool
     */
    public function restoreById(string $modelId): bool
    {
        $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * Permanently delete model by id.
     * 
     * @param string $modelId
     * @return bool
     */
    public function permanentlyDeleteById(string $modelId): bool
    {
        return $this->findTrashedById($modelId)->forceDelete();
    }

    /**
     * @param  ...$criteria
     * @return $this
     */
    public function withCriteria(...$criteria): self
    {
        $criteria = Arr::flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->model = $criterion->apply($this->model);
        }

        return $this;
    }

    /**
     * Get new query
     *
     * @return Builder
     */
    public function query()
    {
        return $this->model->newQuery();
    }
}
