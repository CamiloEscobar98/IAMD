<?php

namespace App\Repositories\Admin;

use App\Repositories\AbstractRepository;

use App\Models\Admin\NotificationType;

class NotificationTypeRepository extends  AbstractRepository
{
    public function __construct(NotificationType $model)
    {
        $this->model = $model;
    }
}
