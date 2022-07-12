<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class ExampleRepository extends  AbstractRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
