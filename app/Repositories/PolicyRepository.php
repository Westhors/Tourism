<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\PolicyRepositoryInterface;
use App\Models\Admin;
use App\Models\Policy;
use Illuminate\Database\Eloquent\Model;

class PolicyRepository extends CrudRepository implements PolicyRepositoryInterface
{
    protected Model $model;

    public function __construct(Policy $model)
    {
        $this->model = $model;
    }
}
