<?php

namespace App\ReadModels;

use App\Exceptions\WriteOperationIsNotAllowedForReadModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class ReadModel extends Model
{
    protected function performInsert(Builder $query)
    {
        throw new WriteOperationIsNotAllowedForReadModel();
    }

    protected function performUpdate(Builder $query)
    {
        throw new WriteOperationIsNotAllowedForReadModel();
    }

    protected function performDeleteOnModel()
    {
        throw new WriteOperationIsNotAllowedForReadModel();
    }

    public function truncate()
    {
        throw new WriteOperationIsNotAllowedForReadModel();
    }
}