<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\LogoCompanyRepositoryInterface;
use App\Models\Admin;
use App\Models\LogoCompany;
use Illuminate\Database\Eloquent\Model;

class LogoCompanyRepository extends CrudRepository implements LogoCompanyRepositoryInterface
{
    protected Model $model;

    public function __construct(LogoCompany $model)
    {
        $this->model = $model;
    }
}

