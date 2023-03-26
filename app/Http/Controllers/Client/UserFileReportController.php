<?php

namespace App\Http\Controllers\Client;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use App\Repositories\Client\UserFileReportRepository;
use App\Services\FileSystem\IntangibleAssets\ReportFileCustomReportService;
use App\Services\FileSystem\IntangibleAssets\ReportFileSingleReportService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class UserFileReportController extends  Controller
{
    /** @var UserFileReportRepository */
    protected $userFileReportRepository;

    /** @var ReportFileSingleReportService */
    protected $reportFileSingleReportService;

    /** @var ReportFileCustomReportService */
    protected $reportFileCustomReportService;

    public function __construct(
        UserFileReportRepository $userFileReportRepository,

        ReportFileSingleReportService $reportFileSingleReportService,
        ReportFileCustomReportService $reportFileCustomReportService
    ) {
        $this->userFileReportRepository = $userFileReportRepository;
        $this->reportFileSingleReportService = $reportFileSingleReportService;
        $this->reportFileCustomReportService = $reportFileCustomReportService;
    }

    /**
     * @param Request $request
     * 
     * @return View|RedirectResponse
     */
    public function index() #: View|RedirectResponse
    {
        try {
            $reports = $this->userFileReportRepository->getByUserId(current_user()->id);

            return view('client.pages.users.reports.index', compact('reports'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('pages.client.users.reports.messages.download_error')]);
        }
    }

    /**
     * @param int $id
     * @param int $reportId
     */
    public function downloadIntangibleAssetReport($id, $reportId)
    {
        try {
            $report = $this->userFileReportRepository->getById($reportId);

            switch ($report->report_type) {
                case 'intangible_assets.reports.custom':
                    $reportPath = $this->reportFileCustomReportService->getFileReportPath($report->file_name);
                    break;
                case 'intangible_assets.reports.single':
                    $reportPath = $this->reportFileSingleReportService->getFileReportPath($report->file_name);
                    break;
            }
            return response()->download($reportPath);
        } catch (ModelNotFoundException $me) {
            Log::error("@Web/Controllers/UserFileReportController@DownloadIntangibleAssetReportSingle/ModelNotFoundException: {$me->getMessage()}");
        }
        return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'error', 'text' => __('pages.client.users.reports.messages.download_error')]);
    }
}
