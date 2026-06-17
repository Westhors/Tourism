<?php

namespace App\Repositories;

use App\Interfaces\guideLineRepositoryInterface;
use App\Models\guideLine;
use Illuminate\Database\Eloquent\Model;

class guideLineRepository extends CrudRepository implements guideLineRepositoryInterface
{
    protected Model $model;

    public function __construct(guideLine $model)
    {
        $this->model = $model;
    }
}

