<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\User;

class UserRepository extends  AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
