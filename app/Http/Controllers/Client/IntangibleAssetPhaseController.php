<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Services\Client\IntangibleAssetPhaseService;

class IntangibleAssetPhaseController extends Controller
{
    /** @var IntangibleAssetPhaseService */
    protected $intangibleAssetPhaseService;

    public function __construct(IntangibleAssetPhaseService $intangibleAssetPhaseService)
    {
        $this->middleware('auth');

        $this->intangibleAssetPhaseService = $intangibleAssetPhaseService;
    }

    /**
     * Intangible Asset Phase One: Intangible Asset Classification
     */
    public function updatePhaseOne()
    {
        # code...
    }
}
