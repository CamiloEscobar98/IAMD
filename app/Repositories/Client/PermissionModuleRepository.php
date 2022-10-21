<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\PermissionModule;

class PermissionModuleRepository  extends AbstractRepository
{
    public function __construct(PermissionModule $model)
    {
        $this->model = $model;
    }
}
