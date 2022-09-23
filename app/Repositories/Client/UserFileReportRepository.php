<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\UserFileReport;

class UserFileReportRepository extends  AbstractRepository
{
    public function __construct(UserFileReport $model)
    {
        $this->model = $model;
    }
}
