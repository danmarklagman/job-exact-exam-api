<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface BaseRepositoryInterface
 *
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * Get all models.
     * 
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Get all trashed models.
     * 
     * @return Collection
     */
    public function allTrashed(): Collection;

    /**
     * Find model by columns.
     * 
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function findByColumns(
        array $where,
        array $columns = ['*'],
        array $relations = []
    ): Collection;

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
    ): Collection;

    /**
     * Find model by first.
     * 
     * @param array $where
     * @param array $columns
     * @param array $relations
     * @return Model
     */
    public function findByFirst(
        array $where,
        array $columns = ['*'],
        array $relations = []
    ): ?Model;

    /**
     * Find model by id.
     * 
     * @param string $modelId
     * @param array $columns
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
        string $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = []
    ): ?Model;

    /**
     * Find trashed model by id.
     * 
     * @param string $modelId
     * @return Model
     */
    public function findTrashedById(string $modelId): ?Model;

    /**
     * Find only trashed model by id.
     * 
     * @param string $modelId
     * @return Model
     */
    public function findOnlyTrashedById(string $modelId): ?Model;

    /**
     * Create a model.
     * 
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): ?Model;

    /**
     * Update existing model.
     * 
     * @param string $modelId
     * @param array $payload
     * @return bool
     */
    public function update(string $modelId, array $payload): bool;

    /**
     * Update or create existing model.
     * 
     * @param array $where
     * @param array $payload
     * @return Model
     */
    public function updateOrCreate(array $where, array $payload): Model;

    /**
     * Update existing model by multiple where columns.
     * 
     * @param array $where
     * @param array $payload
     * @return bool
     */
    public function updateWhere(array $where, array $payload): bool;

    /**
     * Delete model by id.
     * 
     * @param string $modelId
     * @return bool
     */
    public function deleteById(string $modelId): bool;

    /**
     * Restore model by id.
     * 
     * @param string $modelId
     * @return bool
     */
    public function restoreById(string $modelId): bool;

    /**
     * Permanently delete model by id.
     * 
     * @param string $modelId
     * @return bool
     */
    public function permanentlyDeleteById(string $modelId): bool;

    /**
     * Get new query
     *
     * @return Builder
     */
    public function query();
}
