<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\ContactUsRepositoryInterface;
use App\Interfaces\EmailTemplateRepositoryInterface;
use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Model;

class EmailTemplateRepository extends CrudRepository implements EmailTemplateRepositoryInterface
{
    protected Model $model;

    public function __construct(EmailTemplate $model)
    {
        $this->model = $model;
    }
}
