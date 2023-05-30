<?php

namespace App\Http\ViewComposers\Client;

use Illuminate\View\View;

use App\Repositories\Client\NotificationRepository;
use App\Repositories\Client\RoleRepository;

class NavbarComposer
{
    public function __construct(
        protected NotificationRepository $notificationRepository,
    ) {
    }

    public function compose(View $view)
    {
        $notifications = $this->notificationRepository->getByUserId(current_user()->id);

        $view->with(compact('notifications'));
    }
}
