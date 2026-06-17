<?php

namespace App\Repositories;

use App\Interfaces\PartnerRepositoryInterface;
use App\Models\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerRepository extends CrudRepository implements PartnerRepositoryInterface
{
    protected Model $model;

    public function __construct(Partner $model)
    {
        $this->model = $model;
    }
}
