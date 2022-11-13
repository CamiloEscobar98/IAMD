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
    Route::prefix('paises')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('countries.index');
        Route::post('/', [CountryController::class, 'store'])->name('countries.store');
        Route::get('registrar', [CountryController::class, 'create'])->name('countries.create');
        Route::get('{country}', [CountryController::class, 'show'])->name('countries.show');
        Route::get('{country}/editar', [CountryController::class, 'edit'])->name('countries.edit');
        Route::put('{country}', [CountryController::class, 'update'])->name('countries.update');
        Route::delete('{country}', [CountryController::class, 'destroy'])->name('countries.destroy');
    });
    Route::prefix('departamentos')->group(function () {
        Route::get('/', [StateController::class, 'index'])->name('states.index');
        Route::post('/', [StateController::class, 'store'])->name('states.store');
        Route::get('registrar', [StateController::class, 'create'])->name('states.create');
        Route::get('{state}', [StateController::class, 'show'])->name('states.show');
        Route::get('{state}/editar', [StateController::class, 'edit'])->name('states.edit');
        Route::put('{state}', [StateController::class, 'update'])->name('states.update');
        Route::delete('{state}', [StateController::class, 'destroy'])->name('states.destroy');
    });
    Route::prefix('ciudades')->group(function () {
        Route::get('/', [CityController::class, 'index'])->name('cities.index');
        Route::post('/', [CityController::class, 'store'])->name('cities.store');
        Route::get('registrar', [CityController::class, 'create'])->name('cities.create');
        Route::get('{city}', [CityController::class, 'show'])->name('cities.show');
        Route::get('{city}/editar', [CityController::class, 'edit'])->name('cities.edit');
        Route::put('{city}', [CityController::class, 'update'])->name('cities.update');
        Route::delete('{city}', [CityController::class, 'destroy'])->name('cities.destroy');
    });
});

Route::name('creators.')->prefix('creadores')->group(function () {
    Route::prefix('tipos-de-documentos')->group(function () {
        Route::get('/', [DocumentTypeController::class, 'index'])->name('document_types.index');
        Route::post('/', [DocumentTypeController::class, 'store'])->name('document_types.store');
        Route::get('registrar', [DocumentTypeController::class, 'create'])->name('document_types.create');
        Route::get('{document_type}', [DocumentTypeController::class, 'show'])->name('document_types.show');
        Route::get('{document_type}/editar', [DocumentTypeController::class, 'edit'])->name('document_types.edit');
        Route::put('{document_type}', [DocumentTypeController::class, 'update'])->name('document_types.update');
        Route::delete('{document_type}', [DocumentTypeController::class, 'destroy'])->name('document_types.destroy');
    });
    Route::prefix('organizaciones-externas')->group(function () {
        Route::get('/', [ExternalOrganizationController::class, 'index'])->name('external_organizations.index');
        Route::post('/', [ExternalOrganizationController::class, 'store'])->name('external_organizations.store');
        Route::get('registrar', [ExternalOrganizationController::class, 'create'])->name('external_organizations.create');
        Route::get('{external_organization}', [ExternalOrganizationController::class, 'show'])->name('external_organizations.show');
        Route::get('{external_organization}/editar', [ExternalOrganizationController::class, 'edit'])->name('external_organizations.edit');
        Route::put('{external_organization}', [ExternalOrganizationController::class, 'update'])->name('external_organizations.update');
        Route::delete('{external_organization}', [ExternalOrganizationController::class, 'destroy'])->name('external_organizations.destroy');
    });
    Route::prefix('tipos-de-contratos')->group(function () {
        Route::get('/', [AssignmentContractController::class, 'index'])->name('assignment_contracts.index');
        Route::post('/', [AssignmentContractController::class, 'store'])->name('assignment_contracts.store');
        Route::get('registrar', [AssignmentContractController::class, 'create'])->name('assignment_contracts.create');
        Route::get('{assignment_contract}', [AssignmentContractController::class, 'show'])->name('assignment_contracts.show');
        Route::get('{assignment_contract}/editar', [AssignmentContractController::class, 'edit'])->name('assignment_contracts.edit');
        Route::put('{assignment_contract}', [AssignmentContractController::class, 'update'])->name('assignment_contracts.update');
        Route::delete('{assignment_contract}', [AssignmentContractController::class, 'destroy'])->name('assignment_contracts.destroy');
    });
});

Route::name('intangible_assets.')->prefix('activos-intangibles')->group(function () {
    Route::prefix('estados')->group(function () {
        Route::get('/', [IntangibleAssetStateController::class, 'index'])->name('status.index');
        Route::post('/', [IntangibleAssetStateController::class, 'store'])->name('status.store');
        Route::get('registrar', [IntangibleAssetStateController::class, 'create'])->name('status.create');
        Route::get('{state}', [IntangibleAssetStateController::class, 'show'])->name('status.show');
        Route::get('{state}/editar', [IntangibleAssetStateController::class, 'edit'])->name('status.edit');
        Route::put('{state}', [IntangibleAssetStateController::class, 'update'])->name('status.update');
        Route::delete('{state}', [IntangibleAssetStateController::class, 'destroy'])->name('status.destroy');
    });
});

Route::name('intellectual_property_rights.')->prefix('derechos-de-propiedad-intelectual')->group(function () {
    Route::prefix('categorias')->group(function () {
        Route::get('/', [IntellectualPropertyRightCategoryController::class, 'index'])->name('categories.index');
        Route::post('/', [IntellectualPropertyRightCategoryController::class, 'store'])->name('categories.store');
        Route::get('registrar', [IntellectualPropertyRightCategoryController::class, 'create'])->name('categories.create');
        Route::get('{category}', [IntellectualPropertyRightCategoryController::class, 'show'])->name('categories.show');
        Route::get('{category}/editar', [IntellectualPropertyRightCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('{category}', [IntellectualPropertyRightCategoryController::class, 'update'])->name('categories.update');
        Route::delete('{category}', [IntellectualPropertyRightCategoryController::class, 'destroy'])->name('categories.destroy');
    });
    Route::prefix('subcategorias')->group(function () {
        Route::get('/', [IntellectualPropertyRightSubcategoryController::class, 'index'])->name('subcategories.index');
        Route::post('/', [IntellectualPropertyRightSubcategoryController::class, 'store'])->name('subcategories.store');
        Route::get('registrar', [IntellectualPropertyRightSubcategoryController::class, 'create'])->name('subcategories.create');
        Route::get('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'show'])->name('subcategories.show');
        Route::get('{subcategory}/editar', [IntellectualPropertyRightSubcategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'update'])->name('subcategories.update');
        Route::delete('{subcategory}', [IntellectualPropertyRightSubcategoryController::class, 'destroy'])->name('subcategories.destroy');
    });
    Route::prefix('productos')->group(function () {
        Route::get('/', [IntellectualPropertyRightProductController::class, 'index'])->name('products.index');
        Route::post('/', [IntellectualPropertyRightProductController::class, 'store'])->name('products.store');
        Route::get('registrar', [IntellectualPropertyRightProductController::class, 'create'])->name('products.create');
        Route::get('{product}', [IntellectualPropertyRightProductController::class, 'show'])->name('products.show');
        Route::get('{product}/editar', [IntellectualPropertyRightProductController::class, 'edit'])->name('products.edit');
        Route::put('{product}', [IntellectualPropertyRightProductController::class, 'update'])->name('products.update');
        Route::delete('{product}', [IntellectualPropertyRightProductController::class, 'destroy'])->name('products.destroy');
    });
});
