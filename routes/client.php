<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Auth\LoginController;

use App\Http\Controllers\Client\HomeController;

use App\Http\Controllers\Client\AdministrativeUnitController;
use App\Http\Controllers\Client\ResearchUnitController;
use App\Http\Controllers\Client\ProjectController;
use App\Http\Controllers\Client\CreatorInternalController;
use App\Http\Controllers\Client\CreatorExternalController;
use App\Http\Controllers\Client\IntangibleAssetController;
use App\Http\Controllers\Client\IntangibleAssetPhaseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('loggin');
Route::post('logout', [LoginController::class, 'logout'])->name('loggout');

Route::get('profile', [HomeController::class, 'profile'])->name('profile');

Route::get('home', [HomeController::class, 'home'])->name('home');

Route::resource('administrative_units', AdministrativeUnitController::class);

Route::resource('research_units', ResearchUnitController::class);

Route::resource('projects', ProjectController::class);

Route::name('creators.')
    ->prefix('creators')
    ->group(function () {
        Route::resource('internal', CreatorInternalController::class);
        Route::resource('external', CreatorExternalController::class);
    });

Route::resource('intangible_assets', IntangibleAssetController::class);

Route::prefix('intangible_assets/{intangible_asset}/phases')
    ->name('intangible_assets.phases.')
    ->group(function () {
        Route::patch('phase_one', [IntangibleAssetPhaseController::class, 'updatePhaseOne'])->name('one');
        Route::patch('phase_two', [IntangibleAssetPhaseController::class, 'updatePhaseTwo'])->name('two');
        Route::patch('phase_three', [IntangibleAssetPhaseController::class, 'updatePhaseThree'])->name('three');
        Route::patch('phase_four', [IntangibleAssetPhaseController::class, 'updatePhaseFour'])->name('four');
    });
