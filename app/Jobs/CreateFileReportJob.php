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
use App\Repositories\Client\UserFileReportRepository;
use App\Services\FileSystem\IntangibleAsset\ReportFileSingleReportService;

class CreateFileReportJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /** @var string */
    protected $view;

    /** @var array */
    protected $data;

    /** @var array */
    protected $config;

    /**
     * Create a new job instance.
     * 
     * @param string $view
     *
     * @return void
     */
    public function __construct(string $view, array $data = [], array $config)
    {
        $this->view = $view;
        $this->data = $data;
        $this->config = $config;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        NotificationTypeRepository $notificationTypeRepository,
        NotificationRepository $notificationRepository,
        TenantRepository $tenantRepository,
        UserFileReportRepository $userFileReportRepository,

        ReportFileSingleReportService $reportFileSingleReportService
    ) {
        $client  = $tenantRepository->getByAttribute('name', $this->clientName);
        Config::set('database.connections.tenant', $tenantRepository->getArrayConfigurationDatabase($client));

        $view = $this->view;
        $data = $this->data;
        $config = $this->config;

        switch ($config['report_type']) {
            case 'intangible_report_single':
                $notificationType = $notificationTypeRepository->getByAttribute('name', 'Reporte');

                $pdf = Pdf::loadView($view, $data)->setPaper('a4', 'landscape')->output();

                $fileName = 'intangible_asset_report_single_' . time() . '.pdf';

                $reportFileSingleReportService->storeFile($fileName, $pdf);

                $notificationRepository->create([
                    'user_id' => $this->userId,
                    'message' => 'Se ha generado el reporte.',
                    'notification_type_id' => $notificationType->id
                ]);

                $userFileReportRepository->create([
                    'user_id' => $config['userId'],
                    'report_type' => $config['report_type'],
                    'file_name' => $fileName
                ]);

                break;

            case 'intangible_report_multiple':
                # code...
                break;
        }
    }
}
