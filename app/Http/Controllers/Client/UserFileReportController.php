<?php

namespace App\Http\Controllers\Client;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use App\Http\Controllers\Controller;
use App\Repositories\Client\UserFileReportRepository;
use App\Services\FileSystem\IntangibleAssets\ReportFileSingleReportService;

class UserFileReportController extends  Controller
{
    /** @var UserFileReportRepository */
    protected $userFileReportRepository;

    /** @var ReportFileSingleReportService */
    protected $reportFileSingleReportService;

    public function __construct(
        UserFileReportRepository $userFileReportRepository,

        ReportFileSingleReportService $reportFileSingleReportService
    ) {
        $this->userFileReportRepository = $userFileReportRepository;
        $this->reportFileSingleReportService = $reportFileSingleReportService;
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
    public function downloadIntangibleAssetReportSingle($id, $reportId)
    {
        try {
            $report = $this->userFileReportRepository->getById($reportId);

            $reportPath = $this->reportFileSingleReportService->getFileReportPath($report->file_name);
            
            return response()->download($reportPath);
        } catch (\Exception $th) {
        }
    }
}
