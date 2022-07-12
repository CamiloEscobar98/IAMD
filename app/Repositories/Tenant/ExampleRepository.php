<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use Illuminate\Database\Eloquent\Model;

class ExampleRepository extends  AbstractRepository
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
