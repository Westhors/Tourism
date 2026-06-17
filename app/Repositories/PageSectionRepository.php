<?php

namespace App\Repositories;

use App\Interfaces\PageSectionRepositoryInterface;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Eloquent\Model;

class PageSectionRepository extends CrudRepository implements PageSectionRepositoryInterface
{
    protected Model $model;

    public function __construct(PageSection $model)
    {
        $this->model = $model;
    }
}
