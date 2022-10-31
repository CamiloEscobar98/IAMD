<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Auth\LoginController;

use App\Http\Controllers\Client\HomeController;

use App\Http\Controllers\Client\AdministrativeUnitController;
use App\Http\Controllers\Client\Auth\AuthController;
use App\Http\Controllers\Client\ResearchUnitController;
use App\Http\Controllers\Client\ProjectController;

use App\Http\Controllers\Client\CreatorInternalController;
use App\Http\Controllers\Client\CreatorExternalController;
use App\Http\Controllers\Client\FinancingTypeController;
use App\Http\Controllers\Client\IntangibleAssetController;
use App\Http\Controllers\Client\IntangibleAssetFileController;
use App\Http\Controllers\Client\IntangibleAssetPhaseController;
use App\Http\Controllers\Client\IntangibleAssetReportController;
use App\Http\Controllers\Client\IntangibleAssetStrategyController;

use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\RoleController;

use App\Http\Controllers\Client\PriorityToolController;
use App\Http\Controllers\Client\ProjectContractTypeController;
use App\Http\Controllers\Client\ReportController;
use App\Http\Controllers\Client\StrategyCategoryController;
use App\Http\Controllers\Client\StrategyController;
use App\Http\Controllers\Client\SecretProtectionMeasureController;
use App\Http\Controllers\Client\UserFileReportController;

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

Route::patch('update_information', [AuthController::class, 'update'])->name('auth.update_information');

Route::patch('update_password', [AuthController::class, 'updatePassword'])->name('auth.update_password');

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

Route::get('intangible_assets/{intangible_asset}/generate_code', [IntangibleAssetController::class, 'updateCode'])->name('intangible_assets.generate_code');

Route::prefix('intangible_assets/{intangible_asset}/downloads')
    ->name('intangible_assets.downloads.')
    ->group(function () {
        Route::get('confidenciality_contract', [IntangibleAssetFileController::class, 'downloadConfidencialityContract'])->name('confidenciality_contract');
        Route::get('session_right_contract', [IntangibleAssetFileController::class, 'downloadSessionRightContract'])->name('session_right_contract');
    });

Route::prefix('intangible_assets/reports')
    ->name('intangible_assets.reports.')
    ->group(function () {
        Route::get('custom', [IntangibleAssetReportController::class, 'generateCustomReport'])->name('custom');
    });

Route::prefix('intangible_assets/{intangible_asset}/reports')
    ->name('intangible_assets.reports.')
    ->group(function () {
        Route::get('default', [IntangibleAssetReportController::class, 'generateDefaultReport'])->name('default');
    });

Route::patch('intangible_assets/{intangible_asset}/has_strategies', [IntangibleAssetStrategyController::class, 'updateHasStrategies'])
    ->name('intangible_assets.has_estrategies');

Route::get('intangible_assets/{intangible_asset}/strategies', [IntangibleAssetStrategyController::class, 'index'])->name('intangible_assets.strategies.index');

Route::post('intangible_assets/{intangible_asset}/strategies', [IntangibleAssetStrategyController::class, 'store'])->name('intangible_assets.strategies.store');

Route::delete('intangible_assets/{intangible_asset}/strategies/{intangible_asset_strategy}', [IntangibleAssetStrategyController::class, 'destroy'])->name('intangible_assets.strategies.destroy');

Route::prefix('intangible_assets/{intangible_asset}/phases')
    ->name('intangible_assets.phases.')
    ->group(function () {
        Route::patch('phase_one', [IntangibleAssetPhaseController::class, 'updatePhaseOne'])->name('one');
        Route::patch('phase_two', [IntangibleAssetPhaseController::class, 'updatePhaseTwo'])->name('two');
        Route::patch('phase_three', [IntangibleAssetPhaseController::class, 'updatePhaseThree'])->name('three');
        Route::patch('phase_four', [IntangibleAssetPhaseController::class, 'updatePhaseFour'])->name('four');
        Route::patch('phase_five', [IntangibleAssetPhaseController::class, 'updatePhaseFive'])->name('five');
        Route::patch('phase_six', [IntangibleAssetPhaseController::class, 'updatePhaseSix'])->name('six');
        Route::patch('phase_seven', [IntangibleAssetPhaseController::class, 'updatePhaseSeven'])->name('seven');
        Route::patch('phase_ eight', [IntangibleAssetPhaseController::class, 'updatePhaseEight'])->name('eight');
        Route::patch('phase_ nine', [IntangibleAssetPhaseController::class, 'updatePhaseNine'])->name('nine');
    });

Route::prefix('reports')
    ->name('reports.')
    ->group(function () {
        Route::get('generated_reports', [UserFileReportController::class, 'index'])->name('generated');
        Route::get('download_report/{reportId}', [UserFileReportController::class, 'downloadIntangibleAssetReportSingle'])->name('download.report');

        Route::name('custom.')
            ->group(function () {
                Route::get('custom', [ReportController::class, 'index'])->name('index');
            });
    });

Route::resource('users', UserController::class);

Route::resource('roles', RoleController::class);

Route::resource('priority_tools', PriorityToolController::class);

Route::resource('strategies', StrategyController::class);

Route::resource('strategy_categories', StrategyCategoryController::class);

Route::resource('financing_types', FinancingTypeController::class);

Route::resource('project_contract_types', ProjectContractTypeController::class);

Route::resource('secret_protection_measures', SecretProtectionMeasureController::class);
