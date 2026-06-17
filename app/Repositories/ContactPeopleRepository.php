<?php

namespace App\Repositories;

use App\Interfaces\ContactPeopleRepositoryInterface;
use App\Models\ContactPeople;
use Illuminate\Database\Eloquent\Model;

class ContactPeopleRepository extends CrudRepository implements ContactPeopleRepositoryInterface
{
    protected Model $model;

    public function __construct(ContactPeople $model)
    {
        $this->model = $model;
    }
}

