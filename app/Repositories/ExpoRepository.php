<?php

namespace App\Repositories;

use App\Interfaces\ExpoRepositoryInterface;
use App\Models\Expo;
use Illuminate\Database\Eloquent\Model;

class ExpoRepository extends CrudRepository implements ExpoRepositoryInterface
{
    protected Model $model;

    public function __construct(Expo $model)
    {
        $this->model = $model;
    }
}

