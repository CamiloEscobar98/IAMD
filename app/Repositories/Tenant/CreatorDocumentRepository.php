<?php

namespace App\Repositories\Tenant;

use App\Models\Tenant\CreatorDocument;
use App\Repositories\AbstractRepository;

class CreatorDocumentRepository  extends AbstractRepository
{
    public function __construct(CreatorDocument $model)
    {
        $this->model = $model;
    }
}
