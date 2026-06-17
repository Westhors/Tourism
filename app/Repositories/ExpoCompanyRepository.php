<?php

namespace App\Repositories;

use App\Interfaces\ExpoCompanyRepositoryInterface;
use App\Models\ExpoCompany;
use Illuminate\Database\Eloquent\Model;

class ExpoCompanyRepository extends CrudRepository implements ExpoCompanyRepositoryInterface
{
    protected Model $model;

    public function __construct(ExpoCompany $model)
    {
        $this->model = $model;
    }
}

