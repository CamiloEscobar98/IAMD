<?php

namespace App\Repositories;

use App\Models\Localization\City;

class CityRepository extends AbstractRepository
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }
}
