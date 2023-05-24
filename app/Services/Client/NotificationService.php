<?php

namespace App\Services\Client;

use App\Services\AbstractServiceModel;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Client\NotificationRepository;

class NotificationService extends AbstractServiceModel
{
    /** @var NotificationRepository */
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->repository = $this->notificationRepository = $notificationRepository;
    }

    /**
     * @param array $params
     * 
     * @return array<string,string>
     */
    public function transformParams($params)
    {
        if (empty($params)) {
            // $params = set_sub_month_date_filter($params, 'date_from', 1);
        }

        # Clean empty keys
        $params = array_filter($params);

        return $params;
    }

    /**
     * @param \Illuminate\Database\Query\Builder $query
     * @param array $params
     * @param int $pageNumber
     * @param int $total
     * 
     * @return LengthAwarePaginator $items
     */
    public function customPagination($query, $params, $pageNumber, $total)
    {
        try {

            $perPage = $this->notificationRepository->getPerPage();
            $pageName = 'page';
            $offset = ($pageNumber -  1) * $perPage;

            $page = Paginator::resolveCurrentPage($pageName);

            $query->skip($offset)
                ->take($perPage);

            $query->orderBy('created_at', 'ASC');

            $items = $query->get();

            $items = new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName
            ]);

            $items->appends($params);

            return $items;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * @param int $userId
     */
    public function seeAllNotifications($userId)
    {
        $notifications = $this->notificationRepository->search(['user_id' => $userId])->get();
        $notifications->each(function ($notification) {
            /** @var \App\Models\Client\Notification $notification */
            $this->notificationRepository->update($notification, ['checked_at' => now()]);
        });
    }
}
