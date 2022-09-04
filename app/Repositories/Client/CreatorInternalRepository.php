<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Creator\CreatorInternal;

class CreatorInternalRepository extends  AbstractRepository
{
    public function __construct(CreatorInternal $model)
    {
        $this->model = $model;
    }
}
