<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Creator\CreatorExternal;

class CreatorExternalRepository extends  AbstractRepository
{
    public function __construct(CreatorExternal $model)
    {
        $this->model = $model;
    }

}
