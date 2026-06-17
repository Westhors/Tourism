<?php

namespace App\Repositories;

use App\Interfaces\NewsletterRepositoryInterface;
use App\Models\Newsletter;
use Illuminate\Database\Eloquent\Model;

class NewsletterRepository extends CrudRepository implements NewsletterRepositoryInterface
{
    protected Model $model;

    public function __construct(Newsletter $model)
    {
        $this->model = $model;
    }
}

