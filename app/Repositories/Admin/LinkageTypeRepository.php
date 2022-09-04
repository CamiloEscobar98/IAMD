<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\LinkageType;

class LinkageTypeRepository  extends AbstractRepository
{
    public function __construct(LinkageType $model)
    {
        $this->model = $model;
    }
}
