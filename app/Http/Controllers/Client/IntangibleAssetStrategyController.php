<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Client\StrategyCategoryRepository;
use Illuminate\Http\Request;


class IntangibleAssetStrategyController extends Controller
{
    /** @var StrategyCategoryRepository */
    protected $strategyCategoryRepository;

    public function __construct(
        StrategyCategoryRepository $strategyCategoryRepository
    ) {
        $this->strategyCategoryRepository = $strategyCategoryRepository;
    }
}
