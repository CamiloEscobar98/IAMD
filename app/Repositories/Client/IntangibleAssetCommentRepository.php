<?php

namespace App\Repositories\Client;

use App\Models\Client\IntangibleAsset\IntangibleAssetComment;
use App\Repositories\AbstractRepository;

class IntangibleAssetCommentRepository extends AbstractRepository
{
    public function __construct(IntangibleAssetComment $model)
    {
        $this->model = $model;
    }
}
