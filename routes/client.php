<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\Auth\LoginController;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\Auth\AuthController;

use App\Http\Controllers\Client\AdministrativeUnitController;
use App\Http\Controllers\Client\AcademicDepartmentController;
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
use App\Http\Controllers\Client\PermissionController;

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

Route::redirect('/', 'inicio');

Route::get('iniciar-sesion', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('iniciar-sesion', [LoginController::class, 'login'])->name('loggin');
Route::post('cerrar-sesion', [LoginController::class, 'logout'])->name('loggout');

Route::get('perfil', [HomeController::class, 'profile'])->name('profile');

Route::patch('actualizar-perfil', [AuthController::class, 'update'])->name('auth.update_information');

Route::patch('actualizar-contraseña', [AuthController::class, 'updatePassword'])->name('auth.update_password');

Route::get('inicio', [HomeController::class, 'home'])->name('home');

Route::name('administrative_units.')->prefix('facultades')->group(function () {
    Route::get('/', [AdministrativeUnitController::class, 'index'])->name('index');
    Route::post('/', [AdministrativeUnitController::class, 'store'])->name('store');
    Route::get('registrar', [AdministrativeUnitController::class, 'create'])->name('create');
    Route::get('{administrative_unit}', [AdministrativeUnitController::class, 'show'])->name('show');
    Route::get('{administrative_unit}/editar', [AdministrativeUnitController::class, 'edit'])->name('edit');
    Route::put('{administrative_unit}', [AdministrativeUnitController::class, 'update'])->name('update');
    Route::delete('{administrative_unit}', [AdministrativeUnitController::class, 'destroy'])->name('destroy');
});

Route::name('academic_departments.')->prefix('departamentos-academicos')->group(function () {
    Route::get('/', [AcademicDepartmentController::class, 'index'])->name('index');
    Route::post('/', [AcademicDepartmentController::class, 'store'])->name('store');
    Route::get('registrar', [AcademicDepartmentController::class, 'create'])->name('create');
    Route::get('{academic_department}', [AcademicDepartmentController::class, 'show'])->name('show');
    Route::get('{academic_department}/editar', [AcademicDepartmentController::class, 'edit'])->name('edit');
    Route::put('{academic_department}', [AcademicDepartmentController::class, 'update'])->name('update');
    Route::delete('{academic_department}', [AcademicDepartmentController::class, 'destroy'])->name('destroy');
});

Route::name('research_units.')->prefix('unidades-investigativas')->group(function () {
    Route::get('/', [ResearchUnitController::class, 'index'])->name('index');
    Route::post('/', [ResearchUnitController::class, 'store'])->name('store');
    Route::get('registrar', [ResearchUnitController::class, 'create'])->name('create');
    Route::get('{research_unit}', [ResearchUnitController::class, 'show'])->name('show');
    Route::get('{research_unit}/editar', [ResearchUnitController::class, 'edit'])->name('edit');
    Route::put('{research_unit}', [ResearchUnitController::class, 'update'])->name('update');
    Route::delete('{research_unit}', [ResearchUnitController::class, 'destroy'])->name('destroy');
});

Route::name('projects.')->prefix('proyectos')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::post('/', [ProjectController::class, 'store'])->name('store');
    Route::get('registrar', [ProjectController::class, 'create'])->name('create');
    Route::get('{project}', [ProjectController::class, 'show'])->name('show');
    Route::get('{project}/editar', [ProjectController::class, 'edit'])->name('edit');
    Route::put('{project}', [ProjectController::class, 'update'])->name('update');
    Route::delete('{project}', [ProjectController::class, 'destroy'])->name('destroy');
});

Route::name('creators.')->prefix('creadores')->group(function () {
    Route::name('internal.')->prefix('internos')->group(function () {
        Route::get('/', [CreatorInternalController::class, 'index'])->name('index');
        Route::post('/', [CreatorInternalController::class, 'store'])->name('store');
        Route::get('registrar', [CreatorInternalController::class, 'create'])->name('create');
        Route::get('{internal}', [CreatorInternalController::class, 'show'])->name('show');
        Route::get('{internal}/editar', [CreatorInternalController::class, 'edit'])->name('edit');
        Route::put('{internal}', [CreatorInternalController::class, 'update'])->name('update');
        Route::delete('{internal}', [CreatorInternalController::class, 'destroy'])->name('destroy');
    });
    Route::name('external.')->prefix('externos')->group(function () {
        Route::get('/', [CreatorExternalController::class, 'index'])->name('index');
        Route::post('/', [CreatorExternalController::class, 'store'])->name('store');
        Route::get('registrar', [CreatorExternalController::class, 'create'])->name('create');
        Route::get('{external}', [CreatorExternalController::class, 'show'])->name('show');
        Route::get('{external}/editar', [CreatorExternalController::class, 'edit'])->name('edit');
        Route::put('{external}', [CreatorExternalController::class, 'update'])->name('update');
        Route::delete('{external}', [CreatorExternalController::class, 'destroy'])->name('destroy');
    });
});

Route::name('intangible_assets.')->prefix('activos-intangibles')->group(function () {
    Route::get('/', [IntangibleAssetController::class, 'index'])->name('index');
    Route::post('/', [IntangibleAssetController::class, 'store'])->name('store');
    Route::get('registrar', [IntangibleAssetController::class, 'create'])->name('create');
    Route::get('{intangible_asset}', [IntangibleAssetController::class, 'show'])->name('show');
    Route::get('{intangible_asset}/editar', [IntangibleAssetController::class, 'edit'])->name('edit');
    Route::put('{intangible_asset}', [IntangibleAssetController::class, 'update'])->name('update');
    Route::delete('{intangible_asset}', [IntangibleAssetController::class, 'destroy'])->name('destroy');

    Route::get('{intangible_asset}/generar-codigo', [IntangibleAssetController::class, 'updateCode'])->name('generate_code');
});


Route::prefix('activos-intangibles/{intangible_asset}/descargas')->name('intangible_assets.downloads.')->group(function () {
    Route::get('contrato-de-confidencialidad', [IntangibleAssetFileController::class, 'downloadConfidencialityContract'])->name('confidenciality_contract');
    Route::get('contrato-de-sesion-de-derechos', [IntangibleAssetFileController::class, 'downloadSessionRightContract'])->name('session_right_contract');
    Route::get('acto-administrativo', [IntangibleAssetFileController::class, 'downloadSessionRightContract'])->name('academic_record');
});

Route::prefix('intangible_assets/reports')->name('intangible_assets.reports.')->group(function () {
    Route::get('custom', [IntangibleAssetReportController::class, 'generateCustomReport'])->name('custom');
});

Route::prefix('activos-intangibles/{intangible_asset}/reportes')->name('intangible_assets.reports.')->group(function () {
    Route::get('default', [IntangibleAssetReportController::class, 'generateDefaultReport'])->name('default');
});

Route::patch('activos-intangibles/{intangible_asset}/actualizar-si-tiene-estrategias', [IntangibleAssetStrategyController::class, 'updateHasStrategies'])
    ->name('intangible_assets.has_estrategies');

Route::get('activos-intangibles/{intangible_asset}/estrategias-de-gestion', [IntangibleAssetStrategyController::class, 'index'])->name('intangible_assets.strategies.index');

Route::post('activos-intangibles/{intangible_asset}/estrategias-de-gestion', [IntangibleAssetStrategyController::class, 'store'])->name('intangible_assets.strategies.store');

Route::delete('activos-intangibles/{intangible_asset}/estrategias-de-gestion/{intangible_asset_strategy}', [IntangibleAssetStrategyController::class, 'destroy'])->name('intangible_assets.strategies.destroy');

Route::prefix('activos-intangibles/{intangible_asset}/fases')
    ->name('intangible_assets.phases.')
    ->group(function () {
        Route::patch('primera-fase', [IntangibleAssetPhaseController::class, 'updatePhaseOne'])->name('one');
        Route::patch('segunda-fase', [IntangibleAssetPhaseController::class, 'updatePhaseTwo'])->name('two');
        Route::patch('tercera-fase', [IntangibleAssetPhaseController::class, 'updatePhaseThree'])->name('three');
        Route::patch('cuarta-fase', [IntangibleAssetPhaseController::class, 'updatePhaseFour'])->name('four');
        Route::patch('quinta-fase', [IntangibleAssetPhaseController::class, 'updatePhaseFive'])->name('five');
        Route::patch('sexta-fase', [IntangibleAssetPhaseController::class, 'updatePhaseSix'])->name('six');
        Route::patch('septima-fase', [IntangibleAssetPhaseController::class, 'updatePhaseSeven'])->name('seven');
        Route::patch('octava-fase', [IntangibleAssetPhaseController::class, 'updatePhaseEight'])->name('eight');
        Route::patch('novena-fase', [IntangibleAssetPhaseController::class, 'updatePhaseNine'])->name('nine');
    });

Route::prefix('reportes')
    ->name('reports.')
    ->group(function () {
        Route::get('reportes-generados', [UserFileReportController::class, 'index'])->name('generated');
        Route::get('descargar-reportes/{reportId}', [UserFileReportController::class, 'downloadIntangibleAssetReportSingle'])->name('download.report');

        Route::name('custom.')
            ->group(function () {
                Route::get('personalizado', [ReportController::class, 'index'])->name('index');
            });
    });

Route::name('users.')->prefix('usuarios')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('registrar', [UserController::class, 'create'])->name('create');
    Route::get('{user}', [UserController::class, 'show'])->name('show');
    Route::get('{user}/editar', [UserController::class, 'edit'])->name('edit');
    Route::put('{user}', [UserController::class, 'update'])->name('update');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::name('roles.')->prefix('roles-del-sistema')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::post('/', [RoleController::class, 'store'])->name('store');
    Route::get('registrar', [RoleController::class, 'create'])->name('create');
    Route::get('{role}', [RoleController::class, 'show'])->name('show');
    Route::get('{role}/editar', [RoleController::class, 'edit'])->name('edit');
    Route::put('{role}', [RoleController::class, 'update'])->name('update');
    Route::delete('{role}', [RoleController::class, 'destroy'])->name('destroy');
});

Route::name('priority_tools.')->prefix('herramientas-de-priorizacion')->group(function () {
    Route::get('/', [PriorityToolController::class, 'index'])->name('index');
    Route::post('/', [PriorityToolController::class, 'store'])->name('store');
    Route::get('registrar', [PriorityToolController::class, 'create'])->name('create');
    Route::get('{priority_tool}', [PriorityToolController::class, 'show'])->name('show');
    Route::get('{priority_tool}/editar', [PriorityToolController::class, 'edit'])->name('edit');
    Route::put('{priority_tool}', [PriorityToolController::class, 'update'])->name('update');
    Route::delete('{priority_tool}', [PriorityToolController::class, 'destroy'])->name('destroy');
});

Route::name('strategy_categories.')->prefix('categorias-de-las-estrategias-de-gestion')->group(function () {
    Route::get('/', [StrategyCategoryController::class, 'index'])->name('index');
    Route::post('/', [StrategyCategoryController::class, 'store'])->name('store');
    Route::get('registrar', [StrategyCategoryController::class, 'create'])->name('create');
    Route::get('{strategy_category}', [StrategyCategoryController::class, 'show'])->name('show');
    Route::get('{strategy_category}/editar', [StrategyCategoryController::class, 'edit'])->name('edit');
    Route::put('{strategy_category}', [StrategyCategoryController::class, 'update'])->name('update');
    Route::delete('{strategy_category}', [StrategyCategoryController::class, 'destroy'])->name('destroy');
});


Route::name('strategies.')->prefix('estrategias-de-gestion')->group(function () {
    Route::get('/', [StrategyController::class, 'index'])->name('index');
    Route::post('/', [StrategyController::class, 'store'])->name('store');
    Route::get('registrar', [StrategyController::class, 'create'])->name('create');
    Route::get('{strategy}', [StrategyController::class, 'show'])->name('show');
    Route::get('{strategy}/editar', [StrategyController::class, 'edit'])->name('edit');
    Route::put('{strategy}', [StrategyController::class, 'update'])->name('update');
    Route::delete('{strategy}', [StrategyController::class, 'destroy'])->name('destroy');
});

Route::name('financing_types.')->prefix('financiacion-de-proyectos')->group(function () {
    Route::get('/', [FinancingTypeController::class, 'index'])->name('index');
    Route::post('/', [FinancingTypeController::class, 'store'])->name('store');
    Route::get('registrar', [FinancingTypeController::class, 'create'])->name('create');
    Route::get('{financing_type}', [FinancingTypeController::class, 'show'])->name('show');
    Route::get('{financing_type}/editar', [FinancingTypeController::class, 'edit'])->name('edit');
    Route::put('{financing_type}', [FinancingTypeController::class, 'update'])->name('update');
    Route::delete('{financing_type}', [FinancingTypeController::class, 'destroy'])->name('destroy');
});

Route::name('project_contract_types.')->prefix('contratos-para-proyectos')->group(function () {
    Route::get('/', [ProjectContractTypeController::class, 'index'])->name('index');
    Route::post('/', [ProjectContractTypeController::class, 'store'])->name('store');
    Route::get('registrar', [ProjectContractTypeController::class, 'create'])->name('create');
    Route::get('{project_contract_type}', [ProjectContractTypeController::class, 'show'])->name('show');
    Route::get('{project_contract_type}/editar', [ProjectContractTypeController::class, 'edit'])->name('edit');
    Route::put('{project_contract_type}', [ProjectContractTypeController::class, 'update'])->name('update');
    Route::delete('{project_contract_type}', [ProjectContractTypeController::class, 'destroy'])->name('destroy');
});

Route::name('secret_protection_measures.')->prefix('medidas-secretas-de-proteccion')->group(function () {
    Route::get('/', [SecretProtectionMeasureController::class, 'index'])->name('index');
    Route::post('/', [SecretProtectionMeasureController::class, 'store'])->name('store');
    Route::get('registrar', [SecretProtectionMeasureController::class, 'create'])->name('create');
    Route::get('{secret_protection_measure}', [SecretProtectionMeasureController::class, 'show'])->name('show');
    Route::get('{secret_protection_measure}/editar', [SecretProtectionMeasureController::class, 'edit'])->name('edit');
    Route::put('{secret_protection_measure}', [SecretProtectionMeasureController::class, 'update'])->name('update');
    Route::delete('{secret_protection_measure}', [SecretProtectionMeasureController::class, 'destroy'])->name('destroy');
});
