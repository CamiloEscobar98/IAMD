<?php

namespace App\Repositories;

use App\Models\LinkageType;

class LinkageTypeRepository  extends AbstractRepository
{
    public function __construct(LinkageType $model)
    {
        $this->model = $model;
    }
}
