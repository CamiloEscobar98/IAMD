<?php

namespace App\Repositories;

use App\Models\Admin;

class AdminRepository extends  AbstractRepository
{
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
