<?php

namespace App\Repositories;

use App\Models\IntangibleAssetState;

class IntangibleAssetStateRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetState $model)
    {
        $this->model = $model;
    }
}
