<?php

namespace App\Http\ViewComposers\Client;

use Illuminate\View\View;

use App\Repositories\Admin\TenantRepository;
use App\Repositories\Client\NotificationRepository;
use Illuminate\Http\Request;

class NotificationComposer
{
    /** @var NotificationRepository */
    protected $notificationRepository;

    public function __construct(
        NotificationRepository $notificationRepository,
    ) {
        $this->notificationRepository = $notificationRepository;
    }

    public function compose(View $view)
    {
        $notifications = $this->notificationRepository->getByUserId(auth()->user()->id);
        

        $view->with(compact('notifications'));
    }
}
