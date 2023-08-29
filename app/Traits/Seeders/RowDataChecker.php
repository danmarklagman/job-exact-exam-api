<?php

namespace App\Traits\Seeders;

use Illuminate\Database\Eloquent\Model;

trait RowDataChecker
{
    private Model $model;
    private $columnToCheck;

    /**
     * get_existing_data
     *
     * @param  mixed $columnValue
     * @return Model|null|mix
     */
    private function hasRowData($columnValue)
    {
        return $this->model::query()
            ->where($this->columnToCheck, $columnValue)
            ->get()
            ->first();
    }
}
