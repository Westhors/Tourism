<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends CrudRepository implements PermissionRepositoryInterface
{
    protected Model $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
