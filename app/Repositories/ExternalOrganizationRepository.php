<?php

namespace App\Repositories;

use App\Models\ExternalOrganization;

class ExternalOrganizationRepository extends  AbstractRepository
{
    public function __construct(ExternalOrganization $model)
    {
        $this->model = $model;
    }
}
