<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\IntellectualPropertyRightCategoryController;
use App\Http\Controllers\Api\Admin\IntellectualPropertyRightSubcategoryController;

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

Route::prefix('intellectual_property_right')->group(function () {

    Route::prefix('categories')->group(function () {
        Route::get('/', [IntellectualPropertyRightCategoryController::class,  'index']);
        Route::get('{category}', [IntellectualPropertyRightCategoryController::class, 'show']);
    });

    Route::prefix('subcategories')->group(function () {
        Route::get('/', [IntellectualPropertyRightSubcategoryController::class,  'index']);
        Route::get('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'show']);
    });
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
