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
     * @param array $params
     * @param array $with
     * @param array $withCount
     * 
     * @return \Illuminate\Database\Query\Builder
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $query = $this->model
            ->select();

        if (isset($params['name']) && $params['name']) {
            $query->where('name', 'like', '%' . $params['name'] . '%');
        }

        if (isset($params['email']) && $params['email']) {
            $query->where('email', 'like', '%' . $params['email'] . '%');
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->where('updated_at', '>=', $params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->where('updated_at', '<=', $params['date_to']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }

    /**
     * @param int $userId
     */
    public function getByUserId(int $userId)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $query */
        $query = $this->model
            ->select();

        $query->where('user_id', $userId);

        $query->whereNull('checked_at');

        $query->with(['notification_type']);

        return $query->get();
    }
}
