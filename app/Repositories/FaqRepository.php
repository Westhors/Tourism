<?php

namespace App\Repositories;

use App\Interfaces\FaqRepositoryInterface;
use App\Models\FAQ;
use Illuminate\Database\Eloquent\Model;

class FaqRepository extends CrudRepository implements FaqRepositoryInterface
{
    protected Model $model;

    public function __construct(FAQ $model)
    {
        $this->model = $model;
    }
}
