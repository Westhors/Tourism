<?php

namespace App\Repositories;

use App\Interfaces\MenuItemRepositoryInterface;
use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Model;

class MenuItemRepository extends CrudRepository implements MenuItemRepositoryInterface
{
    protected Model $model;

    public function __construct(MenuItem $model)
    {
        $this->model = $model;
    }
}
