<?php

namespace Database\Seeders\Admin;

use App\Repositories\Admin\NotificationTypeRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class NotificationTypeSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var NotificationTypeRepository */
    protected $notificationTypeRepository;

    public function __construct(NotificationTypeRepository $notificationTypeRepository)
    {
        $this->notificationTypeRepository = $notificationTypeRepository;
        $this->output = new ConsoleOutput();
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

        $this->command->getOutput()->progressStart(count($notificationTypes));

        foreach ($notificationTypes as $notificationType) {
            $this->info("\n-Creando Tipo de Notificación: '{$notificationType['name']}'\n");
            sleep(1);
            $this->notificationTypeRepository->create($notificationType);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
