<?php

namespace App\Repositories\Admin;

use Illuminate\Database\Eloquent\Model;

use App\Repositories\AbstractRepository;

use App\Models\Admin\CreatorStudyLevel;

class CreatorStudyLevelRepository extends  AbstractRepository
{
    public function __construct(CreatorStudyLevel $model)
    {
        $this->model = $model;
    }
}
