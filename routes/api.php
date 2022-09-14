<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\IntangibleAssetLevel1Controller;
use App\Http\Controllers\Api\Admin\IntangibleAssetLevel2Controller;
use App\Http\Controllers\Api\Client\AdministrativeUnitController;
use App\Http\Controllers\Api\Client\ResearchUnitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('intangible_asset_level_1')->group(function () {
    Route::get('/', [IntangibleAssetLevel1Controller::class,  'index']);
    Route::get('{intangible_asset_level_1}', [IntangibleAssetLevel1Controller::class, 'show']);
});

Route::prefix('intangible_asset_level_2')->group(function () {
    Route::get('/', [IntangibleAssetLevel2Controller::class,  'index']);
    Route::get('{intangible_asset_level_2}', [IntangibleAssetLevel2Controller::class, 'show']);
});


Route::middleware(['check-client'])
    ->prefix('{client}')
    ->group(function () {


        Route::prefix('administrative_units')->group(function () {
            Route::get('/', [AdministrativeUnitController::class, 'index']);
            Route::get('{administrative_unit_id}', [AdministrativeUnitController::class, 'show']);
        });

        Route::prefix('research_units')->group(function () {
            Route::get('/', [ResearchUnitController::class, 'index']);
            Route::get('{research_unit_id}', [ResearchUnitController::class, 'show']);
        });
    });
