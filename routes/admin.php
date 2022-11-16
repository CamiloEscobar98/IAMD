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

use App\Http\Controllers\Admin\IntellectualPropertyRight\IntellectualPropertyRightCategoryController;
use App\Http\Controllers\Admin\IntellectualPropertyRight\IntellectualPropertyRightProductController;
use App\Http\Controllers\Admin\IntellectualPropertyRight\IntellectualPropertyRightSubcategoryController;

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

Route::get('iniciar-sesion', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('iniciar-sesion', [LoginController::class, 'login'])->name('loggin');
Route::post('cerrar-sesion', [LoginController::class, 'logout'])->name('loggout');

Route::get('perfil', [HomeController::class, 'profile'])->name('profile');

Route::patch('actualizar-perfil', [HomeController::class, 'update'])->name('update-profile');
Route::patch('actualizar-contraseña', [HomeController::class, 'updatePassword'])->name('update-password');

Route::get('inicio', [HomeController::class, 'home'])->name('home');

Route::name('localizations.')->prefix('localizaciones')->group(function () {
    Route::name('countries.')->prefix('paises')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('index');
        Route::post('/', [CountryController::class, 'store'])->name('store');
        Route::get('registrar', [CountryController::class, 'create'])->name('create');
        Route::get('{country}', [CountryController::class, 'show'])->name('show');
        Route::get('{country}/editar', [CountryController::class, 'edit'])->name('edit');
        Route::put('{country}', [CountryController::class, 'update'])->name('update');
        Route::delete('{country}', [CountryController::class, 'destroy'])->name('destroy');
    });
    Route::name('states.')->prefix('departamentos')->group(function () {
        Route::get('/', [StateController::class, 'index'])->name('index');
        Route::post('/', [StateController::class, 'store'])->name('store');
        Route::get('registrar', [StateController::class, 'create'])->name('create');
        Route::get('{state}', [StateController::class, 'show'])->name('show');
        Route::get('{state}/editar', [StateController::class, 'edit'])->name('edit');
        Route::put('{state}', [StateController::class, 'update'])->name('update');
        Route::delete('{state}', [StateController::class, 'destroy'])->name('destroy');
    });
    Route::name('cities.')->prefix('ciudades')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('index');
        Route::post('/', [CityController::class, 'store'])->name('store');
        Route::get('registrar', [CityController::class, 'create'])->name('create');
        Route::get('{city}', [CityController::class, 'show'])->name('show');
        Route::get('{city}/editar', [CityController::class, 'edit'])->name('edit');
        Route::put('{city}', [CityController::class, 'update'])->name('update');
        Route::delete('{city}', [CityController::class, 'destroy'])->name('destroy');
    });
});

Route::name('creators.')->prefix('creadores')->group(function () {
    Route::name('document_types.')->prefix('tipos-de-documentos')->group(function () {
        Route::get('/', [DocumentTypeController::class, 'index'])->name('index');
        Route::post('/', [DocumentTypeController::class, 'store'])->name('store');
        Route::get('registrar', [DocumentTypeController::class, 'create'])->name('create');
        Route::get('{document_type}', [DocumentTypeController::class, 'show'])->name('show');
        Route::get('{document_type}/editar', [DocumentTypeController::class, 'edit'])->name('edit');
        Route::put('{document_type}', [DocumentTypeController::class, 'update'])->name('update');
        Route::delete('{document_type}', [DocumentTypeController::class, 'destroy'])->name('destroy');
    });
    Route::name('external_organizations.')->prefix('organizaciones-externas')->group(function () {
        Route::get('/', [ExternalOrganizationController::class, 'index'])->name('index');
        Route::post('/', [ExternalOrganizationController::class, 'store'])->name('store');
        Route::get('registrar', [ExternalOrganizationController::class, 'create'])->name('create');
        Route::get('{external_organization}', [ExternalOrganizationController::class, 'show'])->name('show');
        Route::get('{external_organization}/editar', [ExternalOrganizationController::class, 'edit'])->name('edit');
        Route::put('{external_organization}', [ExternalOrganizationController::class, 'update'])->name('update');
        Route::delete('{external_organization}', [ExternalOrganizationController::class, 'destroy'])->name('destroy');
    });
    Route::name('assigment_contracts.')->prefix('tipos-de-contratos')->group(function () {
        Route::get('/', [AssignmentContractController::class, 'index'])->name('index');
        Route::post('/', [AssignmentContractController::class, 'store'])->name('store');
        Route::get('registrar', [AssignmentContractController::class, 'create'])->name('create');
        Route::get('{assignment_contract}', [AssignmentContractController::class, 'show'])->name('show');
        Route::get('{assignment_contract}/editar', [AssignmentContractController::class, 'edit'])->name('edit');
        Route::put('{assignment_contract}', [AssignmentContractController::class, 'update'])->name('update');
        Route::delete('{assignment_contract}', [AssignmentContractController::class, 'destroy'])->name('destroy');
    });
});

Route::name('intangible_assets.')->prefix('activos-intangibles')->group(function () {
    Route::name('status.')->prefix('estados')->group(function () {
        Route::get('/', [IntangibleAssetStateController::class, 'index'])->name('index');
        Route::post('/', [IntangibleAssetStateController::class, 'store'])->name('store');
        Route::get('registrar', [IntangibleAssetStateController::class, 'create'])->name('create');
        Route::get('{state}', [IntangibleAssetStateController::class, 'show'])->name('show');
        Route::get('{state}/editar', [IntangibleAssetStateController::class, 'edit'])->name('edit');
        Route::put('{state}', [IntangibleAssetStateController::class, 'update'])->name('update');
        Route::delete('{state}', [IntangibleAssetStateController::class, 'destroy'])->name('destroy');
    });
});

Route::name('intellectual_property_rights.')->prefix('derechos-de-propiedad-intelectual')->group(function () {
    Route::name('categories.')->prefix('categorias')->group(function () {
        Route::get('/', [IntellectualPropertyRightCategoryController::class, 'index'])->name('index');
        Route::post('/', [IntellectualPropertyRightCategoryController::class, 'store'])->name('store');
        Route::get('registrar', [IntellectualPropertyRightCategoryController::class, 'create'])->name('create');
        Route::get('{category}', [IntellectualPropertyRightCategoryController::class, 'show'])->name('show');
        Route::get('{category}/editar', [IntellectualPropertyRightCategoryController::class, 'edit'])->name('edit');
        Route::put('{category}', [IntellectualPropertyRightCategoryController::class, 'update'])->name('update');
        Route::delete('{category}', [IntellectualPropertyRightCategoryController::class, 'destroy'])->name('destroy');
    });
    Route::name('subcategories.')->prefix('subcategorias')->group(function () {
        Route::get('/', [IntellectualPropertyRightSubcategoryController::class, 'index'])->name('index');
        Route::post('/', [IntellectualPropertyRightSubcategoryController::class, 'store'])->name('store');
        Route::get('registrar', [IntellectualPropertyRightSubcategoryController::class, 'create'])->name('create');
        Route::get('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'show'])->name('show');
        Route::get('{subcategory}/editar', [IntellectualPropertyRightSubcategoryController::class, 'edit'])->name('edit');
        Route::put('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'update'])->name('update');
        Route::delete('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'destroy'])->name('destroy');
    });
    Route::name('products.')->prefix('productos')->group(function () {
        Route::get('/', [IntellectualPropertyRightProductController::class, 'index'])->name('index');
        Route::post('/', [IntellectualPropertyRightProductController::class, 'store'])->name('store');
        Route::get('registrar', [IntellectualPropertyRightProductController::class, 'create'])->name('create');
        Route::get('{product}', [IntellectualPropertyRightProductController::class, 'show'])->name('show');
        Route::get('{product}/editar', [IntellectualPropertyRightProductController::class, 'edit'])->name('edit');
        Route::put('{product}', [IntellectualPropertyRightProductController::class, 'update'])->name('update');
        Route::delete('{product}', [IntellectualPropertyRightProductController::class, 'destroy'])->name('destroy');
    });
});
