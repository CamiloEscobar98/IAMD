<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use Spatie\Permission\Models\Role;

class RoleRepository  extends AbstractRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
