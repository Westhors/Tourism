<?php

namespace App\Repositories;

use App\Interfaces\JobRepositoryInterface;
use App\Models\Country;
use App\Models\Job;
use Illuminate\Database\Eloquent\Model;

class JobRepository extends CrudRepository implements JobRepositoryInterface
{
    protected Model $model;

    public function __construct(Job $model)
    {
        $this->model = $model;
    }
}
