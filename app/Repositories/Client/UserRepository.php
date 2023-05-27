<?php

namespace App\Repositories\Client;

use App\Repositories\AbstractRepository;

use Illuminate\Support\Str;

use App\Models\Client\User;

class UserRepository extends  AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * 
     * @return $query
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $query = $this->model
            ->select();

        if (isset($params['name']) && $params['name']) {
            $query->byName($params['name']);
        }

        if (isset($params['email']) && $params['email']) {
            $query->byEmail($params['email']);
        }

        if (isset($params['date_from']) && $params['date_from']) {
            $query->sinceDate($params['date_from']);
        }

        if (isset($params['date_to']) && $params['date_to']) {
            $query->toDate($params['date_to']);
        }

        if (isset($params['except_auth_user']) && $params['except_auth_user']) {
            $query->where('id', '!=', current_user()->id);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }

    public function resetPassword(User $user)
    {
        $randomPassword = Str::random(10);

        $this->update($user, ['password' => $randomPassword]);

        return $randomPassword;
    }
}
