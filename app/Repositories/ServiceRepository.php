<?php

namespace App\Repositories;

use App\Interfaces\ServiceRepositoryInterface;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class ServiceRepository extends CrudRepository implements ServiceRepositoryInterface
{
    protected Model $model;

    public function __construct(Service $model)
    {
        $this->model = $model;
    }
}
