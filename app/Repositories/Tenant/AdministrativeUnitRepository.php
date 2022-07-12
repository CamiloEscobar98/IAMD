<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\AdministrativeUnit;

class AdministrativeUnitRepository extends AbstractRepository
{

    public function __construct(AdministrativeUnit $model)
    {
        $this->model = $model;
    }
}
