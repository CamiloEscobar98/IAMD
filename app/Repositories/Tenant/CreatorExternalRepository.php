<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\CreatorExternal;

class CreatorExternalRepository extends  AbstractRepository
{
    public function __construct(CreatorExternal $model)
    {
        $this->model = $model;
    }

}
