<?php

namespace App\Repositories;

use App\Interfaces\PageRepositoryInterface;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;

class PageRepository extends CrudRepository implements PageRepositoryInterface
{
    protected Model $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}
