<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('permission:reports.generate_report')->only('index');
    }

    public function index(Request $request)
    {
        $params = $request->all();

        try {
            return view('client.pages.reports.custom.index', compact('params'));
        } catch (\Exception $th) {
            return redirect()->back()->with('alert', ['title' => __('messages.error'), 'icon' => 'error', 'text' => __('messages.syntax_error')]);
        }
    }
}
