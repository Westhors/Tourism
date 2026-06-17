<?php

namespace App\Repositories;

use App\Interfaces\TermsConditionInterface;
use App\Models\TermsCondition;
use Illuminate\Database\Eloquent\Model;

class TermsConditionRepository extends CrudRepository implements TermsConditionInterface
{
    protected Model $model;

    public function __construct(TermsCondition $model)
    {
        $this->model = $model;
    }
}
