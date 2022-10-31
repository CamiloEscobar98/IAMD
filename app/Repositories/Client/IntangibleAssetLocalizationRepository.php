<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\IntangibleAsset\IntangibleAssetLocalization;

class IntangibleAssetLocalizationRepository extends AbstractRepository
{
    public function __construct(IntangibleAssetLocalization $model)
    {
        $this->model = $model;
    }
}
