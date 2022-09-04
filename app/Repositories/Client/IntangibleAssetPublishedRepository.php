<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetPublished;

class IntangibleAssetPublishedRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetPublished $model)
    {
        $this->model = $model;
    }
}
