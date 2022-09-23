<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Repositories\Admin\NotificationTypeRepository;
use App\Repositories\Admin\TenantRepository;
use App\Repositories\Client\NotificationRepository;


class CreateReport implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /** @var string */
    protected $view;

    /** @var array */
    protected $data;

    /** @var int */
    protected $userId;

    /** @var string */
    protected $clientName;

    /**
     * Create a new job instance.
     * 
     * @param string $view
     *
     * @return void
     */
    public function __construct(string $view, array $data = [], $userId, $client)
    {
        $this->view = $view;
        $this->data = $data;
        $this->userId = $userId;
        $this->clientName = $client;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NotificationTypeRepository $notificationTypeRepository, NotificationRepository $notificationRepository, TenantRepository $tenantRepository)
    {
        $client  = $tenantRepository->getByAttribute('name', $this->clientName);

        Config::set('database.connections.tenant', $tenantRepository->getArrayConfigurationDatabase($client));

        $notificationType = $notificationTypeRepository->getByAttribute('name', 'Reporte');

        $pdf = Pdf::loadView($this->view, $this->data)->setPaper('a4', 'landscape')->output();

        Storage::disk('public')->put(time() . ".pdf", $pdf);

        $random = $notificationRepository->all();

        $notificationRepository->create([
            'user_id' => $this->userId,
            'message' => 'Se ha generado el reporte.',
            'notification_type_id' => $notificationType->id
        ]);
    }
}
