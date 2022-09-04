<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Creator\CreatorDocument;

class CreatorDocumentRepository  extends AbstractRepository
{
    public function __construct(CreatorDocument $model)
    {
        $this->model = $model;
    }
}
