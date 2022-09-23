<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Jobs\CreateReport;

class IntangibleAssetReportController extends Controller
{

    public function downloadDefaultReport(Request $request)
    {
        CreateReport::dispatch('reports.example', [], auth('web')->user()->id, $request->client)->delay(now()->addSeconds(30));

        return redirect()->back()->with('alert', ['title' => __('messages.success'), 'icon' => 'success', 'text' => __('messages.generate_report')]);
    }
}
