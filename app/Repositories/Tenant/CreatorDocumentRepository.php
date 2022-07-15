<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\Creator\CreatorDocument;

class CreatorDocumentRepository  extends AbstractRepository
{
    public function __construct(CreatorDocument $model)
    {
        $this->model = $model;
    }
}
