<?php

namespace App\Repositories;

use App\Interfaces\PageContactUsRepositoryInterface;
use App\Models\PageContactUs;
use Illuminate\Database\Eloquent\Model;

class PageContactUsRepository extends CrudRepository implements PageContactUsRepositoryInterface
{
    protected Model $model;

    public function __construct(PageContactUs $model)
    {
        $this->model = $model;
    }
}

