<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Jobs\CreateFileReportJob;

class IntangibleAssetReportController extends Controller
{

    public function downloadDefaultReport(Request $request)
    {
        CreateFileReportJob::dispatch('reports.example', [], [
            'userId' => auth('web')->user()->id,
            'client' => $request->client,
            'report_type' => 'intangible_assets.reports.single'
        ])->delay(now()->addSeconds(30));

        return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.generate_report')]);
    }
}
