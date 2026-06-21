<?php

namespace App\Repositories;

use App\Interfaces\KnewsLettersRepositoryInterface;
use App\Models\KnewsLetters;
use Illuminate\Database\Eloquent\Model;

class KnewsLettersRepository extends CrudRepository implements KnewsLettersRepositoryInterface
{
    protected Model $model;

    public function __construct(KnewsLetters $model)
    {
        $this->model = $model;
    }
}
