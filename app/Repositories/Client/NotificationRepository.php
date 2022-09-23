<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use App\Models\Client\Notification;

class NotificationRepository extends  AbstractRepository
{
    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $userId
     */
    public function getByUserId(int $userId)
    {
        $query = $this->model
            ->select();

        $query->where('user_id', $userId);

        $query->with(['notification_type']);

        return $query->get();
    }
}
