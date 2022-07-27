<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\Admin\Localization\CountryController;
use App\Http\Controllers\Admin\Localization\StateController;
use App\Http\Controllers\Admin\Localization\CityController;

use App\Http\Controllers\Admin\Creator\DocumentTypeController;
use App\Http\Controllers\Admin\Creator\ExternalOrganizationController;
use App\Http\Controllers\Admin\Creator\AssignmentContractController;
use App\Http\Controllers\Admin\IntangibleAsset\IntangibleAssetStateController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'login'])->name('admin.loggin');
Route::post('logout', [LoginController::class, 'logout'])->name('admin.loggout');

Route::get('profile', [HomeController::class, 'profile'])->name('admin.profile');

Route::patch('update-profile', [HomeController::class, 'update'])->name('admin.update-profile');
Route::patch('update-password', [HomeController::class, 'updatePassword'])->name('admin.update-password');

Route::get('home', [HomeController::class, 'home'])->name('admin.home');

Route::prefix('localizations')->group(function () {
    Route::resource('countries', CountryController::class, ['as' => 'admin.localizations']);
    Route::resource('states', StateController::class, ['as' => 'admin.localizations']);
    Route::resource('cities', CityController::class, ['as' => 'admin.localizations']);
});

Route::prefix('creators')->group(function () {
    Route::resource('document_types', DocumentTypeController::class, ['as' => 'admin.creators']);
    Route::resource('external_organizations', ExternalOrganizationController::class, ['as' => 'admin.creators']);
    Route::resource('assignment_contracts', AssignmentContractController::class, ['as' => 'admin.creators']);
});

Route::prefix('intangible_assets')->group(function () {
    Route::resource('states', IntangibleAssetStateController::class, ['as' => 'admin.intangible_assets']);
});
