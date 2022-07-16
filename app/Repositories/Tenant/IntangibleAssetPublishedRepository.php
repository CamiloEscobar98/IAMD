<?php

namespace App\Repositories\Tenant;

use App\Repositories\AbstractRepository;

use App\Models\Tenant\IntangibleAsset\IntangibleAssetPublished;

class IntangibleAssetPublishedRepository extends  AbstractRepository
{
    public function __construct(IntangibleAssetPublished $model)
    {
        $this->model = $model;
    }
}
