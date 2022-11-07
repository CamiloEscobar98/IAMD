<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
        
use Barryvdh\DomPDF\Facade\Pdf;

use App\Repositories\Admin\NotificationTypeRepository;
use App\Repositories\Admin\TenantRepository;
use App\Repositories\Client\NotificationRepository;
use App\Repositories\Client\UserFileReportRepository;
use App\Services\FileSystem\IntangibleAsset\ReportFileCustomReportService;
use App\Services\FileSystem\IntangibleAsset\ReportFileSingleReportService;
use Illuminate\Support\Facades\Log;

class CreateFileReportJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     */
    public $timeout = 0;

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
    public function __construct(array $data, array $config)
    {
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

        ReportFileSingleReportService $reportFileSingleReportService,
        ReportFileCustomReportService $reportFileCustomReportService,
    ) {
        $data = $this->data;
        $config = $this->config;

        try {
            $client  = $tenantRepository->getByAttribute('name', $config['client']);
            Config::set('database.connections.tenant', $tenantRepository->getArrayConfigurationDatabase($client));

            Log::alert('CREATING CUSTOM REPORT');

            Log::notice("COUNT: {$data['count']}");

            switch ($config['report_type']) {
                case 'intangible_assets.reports.single':
                    Log::info("Intangible Asset Single Report Selected");

                    $notificationType = $notificationTypeRepository->getByAttribute('name', 'Reporte');

                    $pdf = Pdf::loadView('reports.intangible_assets.single', $data)->output();

                    $fileName = 'intangible_asset_report_single_' . time() . '.pdf';

                    $reportFileSingleReportService->storeFileReport($fileName, $pdf, []);

                    $notificationRepository->create([
                        'user_id' => $config['userId'],
                        'message' => 'Se ha generado el reporte.',
                        'notification_type_id' => $notificationType->id
                    ]);

                    $userFileReportRepository->create([
                        'user_id' => $config['userId'],
                        'report_type' => $config['report_type'],
                        'file_name' => $fileName
                    ]);

                    Log::info('Report created!');

                    break;

                case 'intangible_assets.reports.custom':
                    Log::info("Intangible Asset Multiple Report Selected");

                    $notificationType = $notificationTypeRepository->getByAttribute('name', 'Reporte');

                    $pdf = Pdf::loadView('reports.intangible_assets.custom', $data)->output();

                    $fileName = 'intangible_asset_report_custom_multiple_' . time() . '.pdf';

                    $reportFileCustomReportService->storeFileReport($fileName, $pdf, []);

                    $notificationRepository->create([
                        'user_id' => $config['userId'],
                        'message' => 'Se ha generado el reporte personalizado.',
                        'notification_type_id' => $notificationType->id
                    ]);

                    $userFileReportRepository->create([
                        'user_id' => $config['userId'],
                        'report_type' => $config['report_type'],
                        'file_name' => $fileName
                    ]);

                    Log::info('Report created!');
                    break;
            }

            Log::alert('---- CREATING NEW REPORT FINISHED ----');
        } catch (\Exception $th) {
            Log::error($th->getMessage());
        }
    }
}
