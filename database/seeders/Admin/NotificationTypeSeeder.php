<?php

namespace Database\Seeders\Admin;

use App\Repositories\Admin\NotificationTypeRepository;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /** @var NotificationTypeRepository */
    protected $notificationTypeRepository;

    public function __construct(NotificationTypeRepository $notificationTypeRepository)
    {
        $this->notificationTypeRepository = $notificationTypeRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notificationTypes = [
            [
                'name' => 'Reporte',
                'icon' => 'fas fa-file-alt',
            ]
        ];

        foreach ($notificationTypes as $notificationType) {
            $this->notificationTypeRepository->create($notificationType);
        }
    }
}
