<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\User;

class UserRepository extends  AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
