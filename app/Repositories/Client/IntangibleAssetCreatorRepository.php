<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetCreator;

class IntangibleAssetCreatorRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetCreator $model)
    {
        $this->model = $model;
    }
}
