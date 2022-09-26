<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\UserFileReport;
use Illuminate\Database\Eloquent\Collection;

class UserFileReportRepository extends  AbstractRepository
{
    public function __construct(UserFileReport $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $userId
     * 
     * @return Collection
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->all()->where('user_id', $userId);
    }
}
