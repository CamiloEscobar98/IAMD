<?php

namespace App\Repositories;

use App\Models\Localization\State;

class StateRepository extends AbstractRepository
{
    public function __construct(State $model)
    {
        $this->model = $model;
    }
}
