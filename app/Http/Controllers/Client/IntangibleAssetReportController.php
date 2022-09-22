<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Jobs\CreateReport;

class IntangibleAssetReportController extends Controller
{

    public function downloadDefaultReport()
    {
        CreateReport::dispatch('reports.example');
    }
}
