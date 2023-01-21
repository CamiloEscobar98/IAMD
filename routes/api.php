<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Admin\Localization\CountryController;
use App\Http\Controllers\Api\Admin\Localization\StateController;

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


/** Intellectual Property Rights */
Route::prefix('intellectual_property_rights')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::get('/', [IntellectualPropertyRightCategoryController::class,  'index']);
        Route::get('{category}/subcategories', [IntellectualPropertyRightCategoryController::class, 'subcategories']);
    });

    Route::prefix('subcategories')->group(function () {
        Route::get('/', [IntellectualPropertyRightSubcategoryController::class,  'index']);
        Route::get('{subcategory}/products', [IntellectualPropertyRightSubcategoryController::class, 'products']);
    });
});
/** ./Intellectual Property Rights */

/** Localizations */
Route::prefix('localizations')->group(function () {
    Route::prefix('countries')->group(function () {
        Route::get('/', [CountryController::class,  'index']);
        Route::get('{country}/states', [CountryController::class, 'states']);
    });

    Route::prefix('states')->group(function () {
        Route::get('/', [StateController::class,  'index']);
        Route::get('{state}/cities', [StateController::class, 'cities']);
    });
});
/** ./Localizations */

Route::middleware(['check-client'])
    ->prefix('{client}')
    ->group(function () {

        Route::prefix('administrative_units')->group(function () {
            Route::get('/', [AdministrativeUnitController::class, 'index']);
            Route::get('{administrative_unit}/research_units', [AdministrativeUnitController::class, 'research_units']);
        });

        Route::prefix('unidades-investigativas')->group(function () {
            Route::get('/', [ResearchUnitController::class, 'index']);
            Route::get('{research_unit}/projects', [ResearchUnitController::class, 'projects']);
        });
    });
